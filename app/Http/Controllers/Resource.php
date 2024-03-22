<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Http\Middleware\HandlePrecognitiveRequests;
use Illuminate\Support\Facades\Route;

class Resource
{
    /**
     * Setups the resource routes.
     *
     * @api
     *
     * @since 1.0.0
     *
     * @version 1.0.0
     */
    public static function create(string $route, mixed $controller): void
    {
        Route::get("/$route", [$controller, 'index']);
        Route::get("/$route/tambah", [$controller, 'form']);
        Route::get("/$route/ubah", [$controller, 'form']);
        Route::get("/$route/tampil", [$controller, 'show']);

        Route::middleware(HandlePrecognitiveRequests::class)->group(function () use ($route, $controller) {
            Route::post("/$route/tambah", [$controller, 'store']);
            Route::put("/$route/ubah", [$controller, 'update']);
            Route::delete("/$route/hapus", [$controller, 'destroy']);
        });
    }
}
