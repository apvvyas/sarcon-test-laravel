<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Front\EntryController;
use App\Http\Controllers\Admin\EntryController as AdminEntryController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});


Route::get('/entries', [EntryController::class, 'listEntries']);

Route::prefix('/admin')->group(function(){
    Route::prefix('/activate')->group(function(){
        Route::post('/join-as-audience/{entry}', [AdminEntryController::class, 'activateJoinAsAudience']);
        Route::post('/join-as-speaker/{entry}', [AdminEntryController::class, 'activateJoinAsSpeaker']);
        Route::post('/add-to-my-schedule/{entry}', [AdminEntryController::class, 'activateAddToMySchedule']);
        Route::post('/add-to-calendar/{entry}', [AdminEntryController::class, 'activateAddToCalendar']);
    });
});

