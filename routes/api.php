<?php

use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\BookController;
use App\Http\Controllers\CopyController;
use App\Http\Controllers\LendingController;
use App\Http\Controllers\ReservationController;
use App\Http\Controllers\UserController;
use App\Http\Middleware\Admin;
use App\Http\Middleware\Librarian;
use App\Http\Middleware\Warehouseman;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

//bárki által elérhető
Route::post('/register',[RegisteredUserController::class, 'store']);
Route::post('/login',[AuthenticatedSessionController::class, 'store']);

Route::get('/books-copies', [BookController::class, "booksFilterByUser"]);

//autintikált felhasználó
Route::middleware(['auth:sanctum'])
    ->group(function () {
        //profil kezelése
        Route::apiResource('/auth-users', UserController::class)->except(['destroy']);
        //kölcsönzések száma
        Route::get('/lendings-count', [LendingController::class, "lendingsCount"]);
        //hány könyv?
        Route::get('/lendings-count-distinct', [LendingController::class, 'lendingsCountDistinct']);
        //hány példány van nálam
        Route::get('/active-lendings-count', [LendingController::class, 'activeLendingsCount']);
        //milyen könyvek vannak nálam?
        Route::get('/active-lendings-data', [LendingController::class, 'activeLendingsData']);
        Route::get('/lendings-copies', [LendingController::class, "lendingsFilterByUser"]);

        Route::get('/user-lendings', [UserController::class, 'userLendingsFilterByUser']);

        Route::patch('update-password/{id}', [UserController::class, 'updatePassword']);
        Route::get('/reserved-books', [ReservationController::class, 'reservedBooks']);

        Route::get('/user-reservations', [UserController::class, 'userReservationsFilterByUser']);
        Route::get('/reserved-count', [ReservationController::class, 'reservedCount']);
        Route::get('books-i-lend-from', [LendingController::class, 'booksILendFrom']);
        Route::patch('/bring-back/{copy_id}/{start}', [LendingController::class, 'bringBack']);
        Route::middleware('auth')->group(function () {
        Route::get('/user/reservations/count', [UserController::class, 'countReservations']);
        Route::get('/books/group-by-authors', [BookController::class, 'groupBooksByAuthors']);

        Route::get('/authors/with-at-least-two-books', [BookController::class, 'authorsWithAtLeastTwoBooks']);

        Route::get('elojegyzes-megszamolas', [ReservationController::class, 'elojegyzesMegszamolas']);
        Route::get('ketto-konyv', [BookController::class, 'kettoKonyv']);
        Route::get('harom-Napnal-Regebbi-Foglalas', [ReservationController::class, 'haromNapnalRegebbiFoglalas']);
        });
        
        // Kijelentkezés útvonal
        Route::post('/logout', [AuthenticatedSessionController::class, 'destroy']);
});
//admin réteg
Route::middleware(['auth:sanctum', Admin::class])
    ->group(function () {
        //Route::get('/admin/users', [UserController::class, 'index']);
        //összes kérés egy útvonalon
        Route::apiResource('/admin/users', UserController::class);
});
//librarian réteg
Route::middleware(['auth:sanctum', Librarian::class])
    ->group(function () {
        Route::post('/store-lending', [LendingController::class, 'store']);
});
//warehouseman réteg
Route::middleware(['auth:sanctum', Warehouseman::class])
    ->group(function () {
        //útvonalak
        Route::get('/warehouseman/copies/{title}', [CopyController::class, 'bookCopyCount']);
});









