<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\PelamarApiController;

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

// API routes untuk pelamar data
Route::middleware('auth')->group(function () {
    Route::get('/pelamar/{id}/interview', [PelamarApiController::class, 'getInterviewData']);
    Route::get('/pelamar/{id}/personal', [PelamarApiController::class, 'getPersonalData']);
    Route::get('/pelamar/{id}/sosmed', [PelamarApiController::class, 'getSosmedData']);
});