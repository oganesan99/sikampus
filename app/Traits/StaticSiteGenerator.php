<?php

namespace App\Traits;

use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\File;

trait StaticSiteGenerator
{
    /**
     * Generate the static site.
     *
     * @api
     *
     * @since 1.0.0
     *
     * @version 1.0.0
     */
    private function generateHTML(string $path): View
    {
        return tap(view($path), function ($view) {
            $urlPath = str(request()->path())->explode('/');
            $file = str($urlPath->pop())->finish('.html');
            $directoryPath = public_path('/static/html/'.$urlPath->implode('/'));

            if (! File::isDirectory($directoryPath)) {
                File::makeDirectory($directoryPath, recursive: true);
            }

            File::put("$directoryPath/$file", preg_replace(
                ['/\s+/', '/> </', '/\/>/', '/\s+>/'],
                [' ', '><', '>', '>'],
                $view->render()
            ));
        });
    }
}
