<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
  <meta charset="utf-8">
  <meta
    content="IE=edge"
    http-equiv="X-UA-Compatible"
  >
  <meta
    content="width=device-width,initial-scale=1"
    name="viewport"
  >
  <meta
    content="#FFFFFF"
    name="theme-color"
  />
  <link
    href="/app.webmanifest"
    rel="manifest"
  >

  @vite(['resources/css/app.css', 'resources/ts/app.ts'])

  {{ $head }}
</head>

<body>
  <div x-data="clientError" x-on:error.window="report($event)"></div>
  <x-noscript />

  {{ $body }}
</body>

</html>
