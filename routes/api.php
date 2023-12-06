<?php

use App\Http\Controllers\Api\Card\CardController;
use App\Http\Controllers\Api\Duel\DuelController;
use App\Http\Controllers\Api\User\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\Authorization\LoginController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::post('login', [LoginController::class, 'login']);
Route::post('logout', [LoginController::class, 'logout']);

Route::group(['middleware' => ['auth:sanctum']], function () {
    // User controller
    Route::get('user-data', [UserController::class, 'me']);

    // Cards controller
    Route::post('cards', [CardController::class, 'draw']);

    // Duels controller
    Route::post('duels', [DuelController::class, 'start']);
    Route::get('duels/active', [DuelController::class, 'active']);
    Route::post('duels/action', [DuelController::class, 'selectCard']);

    //DUELS HISTORY
    Route::get('duels', function (Request $request) {
        return [
            [
                "id" => 1,
                "player_name" => "Jan Kowalski",
                "opponent_name" => "Piotr Nowak",
                "won" => 0
            ],
            [
                "id" => 2,
                "player_name" => "Jan Kowalski",
                "opponent_name" => "Tomasz Kaczyński",
                "won" => 1
            ],
            [
                "id" => 3,
                "player_name" => "Jan Kowalski",
                "opponent_name" => "Agnieszka Tomczak",
                "won" => 1
            ],
            [
                "id" => 4,
                "player_name" => "Jan Kowalski",
                "opponent_name" => "Michał Bladowski",
                "won" => 1
            ],
        ];
    });
});
