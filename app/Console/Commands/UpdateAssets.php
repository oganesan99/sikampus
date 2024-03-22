<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Contracts\Process\ProcessResult;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Process;
use Illuminate\Support\Facades\Route;
use RecursiveDirectoryIterator;
use RecursiveIteratorIterator;
use RecursiveRegexIterator;
use RegexIterator;

class UpdateAssets extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'update:assets';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Update assets and routes';

    /**
     * Get all files with the given extension.
     *
     * @internal
     *
     * @since 1.0.0
     *
     * @version 1.0.0
     */
    private function getFiles(string $extension): Collection
    {
        $directory = new RecursiveDirectoryIterator(resource_path());
        $iterator = new RecursiveIteratorIterator($directory);

        $regex = new RegexIterator($iterator, '/^.+\.'.$extension.'(?<!\.d\.'.$extension.')$/i', RecursiveRegexIterator::GET_MATCH);

        $files = collect();

        foreach ($regex as $file) {
            $files->push(str_replace(base_path(), '', $file[0]));
        }

        return $files->sort();
    }

    /**
     * Build the assets and routes for the service worker.
     *
     * @internal
     *
     * @since 1.0.0
     *
     * @version 1.0.0
     */
    private function build(): ProcessResult
    {
        $assets = json_encode(collect()
            ->merge($this->getFiles('css'))
            ->merge($this->getFiles('ts'))
            ->toArray());

        File::put(base_path('vite.assets.js'), "export const assets = $assets");

        return Process::run('npm run build');
    }

    /**
     * Get the asset path for the service worker.
     *
     * @internal
     *
     * @since 1.0.0
     *
     * @version 1.0.0
     */
    private function getAssetPath(): Collection
    {
        $assets = collect(['/app.webmanifest']);

        foreach (json_decode(File::get(public_path('build/manifest.json'))) as $key) {
            if (property_exists($key, 'src') && $key->src !== 'resources/ts/sw.ts') {
                $assets->push(str($key->file)->start('/build/'));
            }
        }

        if (File::exists(public_path('static'))) {
            foreach (File::allFiles(public_path('static')) as $file) {
                $assets->push(str($file->getRelativePathname())->start('/static/'));
            }
        }

        return $assets->values();
    }

    /**
     * Get the page path for the service worker.
     *
     * @internal
     *
     * @since 1.0.0
     *
     * @version 1.0.0
     */
    private function getPagePath(): Collection
    {
        return collect(Route::getRoutes())->filter(function ($route) {
            return $route->getName()
                && ! str($route->getName())->startsWith(['temporary-file', 'sanctum', 'ignition'])
                && ! str_contains($route->uri, '{');
        })->map(function ($route) {
            return str($route->uri)->start('/');
        })->values();
    }

    /**
     * Get the offline page for the service worker.
     *
     * @internal
     *
     * @since 1.0.0
     *
     * @version 1.0.0
     */
    private function getOfflinePage(): string
    {
        $html = File::get(resource_path('views/errors/offline.html'));

        $pattern = [
            '/>\s+</' => '><', // Remove whitespace between HTML tags
            '/\s+/' => ' ', // Replace multiple spaces with a single space
            '/<!--(.|\s)*?-->/' => '', // Remove HTML comments
            '/\>[^\S ]+/s' => '>', // Remove trailing whitespace after a '>'
            '/[^\S ]+\</s' => '<', // Remove leading whitespace before a '<'
            '/\s+\/>/' => '/>', // Remove whitespace before a self-closing tag '/>'
            '/\/\s*>/' => '>', // Remove whitespace between '/' and '>'
            '!/\*[^*]*\*+([^/][^*]*\*+)*/!' => '', // Remove CSS comments
            '/\s*([{}|:;,])\s+/' => '$1', // Remove whitespace around CSS delimiters
            '/;}/' => '}', // Remove unnecessary semicolon before '}'
            '/\s+!important/' => '!important', // Remove whitespace before '!important'
            '/\.\s+</' => '.<', // Remove whitespace between '.' and '<'
            '/\s+$/s' => '', // Remove trailing whitespace
        ];

        return preg_replace(array_keys($pattern), $pattern, $html);
    }

    /**
     * Generate a new asset version for the service worker.
     *
     * @internal
     *
     * @since 1.0.0
     *
     * @version 1.0.0
     */
    private function getAssetVersion(): string
    {
        $content = File::exists(public_path('/sw.js')) ? File::get(public_path('/sw.js')) : '';

        if (preg_match('/const\s+(\w+)="(v\d+)"/', $content, $matches)) {
            $version = preg_replace_callback('/\d+$/', function ($matches) {
                return $matches[0] + 1;
            }, $matches[2]);
        } else {
            $version = 'v1';
        }

        return $version;
    }

    /**
     * Run the post build process for the service worker.
     *
     * @internal
     *
     * @since 1.0.0
     *
     * @version 1.0.0
     */
    private function runPostBuild(): void
    {
        foreach (json_decode(File::get(public_path('build/manifest.json'))) as $key) {
            if (property_exists($key, 'src') && $key->src === 'resources/ts/sw.ts') {
                $pattern = '/(const\s+\w+=)"[^"]*",\s*(\w+=)\[\],\s*(\w+=)\[\],\s*(\w+=)"[^"]*",/';
                $values = [
                    str($this->getAssetVersion())->wrap('"'),
                    $this->getAssetPath(),
                    $this->getPagePath(),
                    str($this->getOfflinePage())->wrap("'"),
                ];

                File::copy(public_path('/build/'.$key->file), public_path('/sw.js'));

                File::put(public_path('/sw.js'), preg_replace_callback(
                    $pattern,
                    function ($matches) use ($values) {
                        $replacement = [];
                        for ($i = 1; $i <= 4; $i++) {
                            $replacement[] = $matches[$i].$values[$i - 1];
                        }

                        return implode(',', $replacement).',';
                    }, File::get(public_path('/sw.js')), 1));

                break;
            }
        }
    }

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $build = $this->build();

        if ($build->successful()) {
            echo $build->output();
            $this->runPostBuild();
        } else {
            echo $build->errorOutput();
        }
    }
}
