<div class="page">
  <x-aside />
  <x-navbar />

  <div class="page-wrapper">
    @if ($head ?? false)
      <div class="page-header d-print-none">
        {{ $head }}
      </div>
    @endif

    <div class="page-body">
      {{ $slot }}
    </div>
  </div>
</div>
