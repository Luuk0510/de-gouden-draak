<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Session;
use App\Http\Controllers\AccountController;
use App\Http\Controllers\DishesController;
use App\Http\Controllers\PlanningController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\SalesController;
use App\Http\Controllers\WebsiteController;
use App\Http\Controllers\RestaurantController;
use App\Http\Middleware\SetLocale;

Route::middleware([SetLocale::class])->group(function () {
    Route::get('/', [WebsiteController::class, 'index']);
    Route::get('/menukaart', [WebsiteController::class, 'menu'])->name('menu');
    Route::get('/nieuws', [WebsiteController::class, 'news'])->name('news');
    Route::get('/contact', [WebsiteController::class, 'contact'])->name('contact');
});

Route::get('/download-menu', [WebsiteController::class, 'downloadMenu'])->name('download.menu');

Route::get('setlocale/{locale}', function ($locale) {
    Session::put('locale', $locale);
    return redirect()->back();
})->name('setlocale');


Route::prefix('kassa')->group(function () {
    Route::get('login', [AccountController::class, 'showLoginForm'])->name('login');
    Route::post('login', [AccountController::class, 'login']);
    Route::post('logout', [AccountController::class, 'logout'])->name('logout');
    Route::get('index', [RegisterController::class, 'index'])->name('register-index');
    Route::get('dishes', [RegisterController::class, 'dishes'])->name('register-dishes');
    Route::get('sales', [RegisterController::class, 'sales'])->name('register-sales');
});

Route::post('/register', [RegisterController::class, 'store']);
Route::post('/api/sales', [SalesController::class, 'getSalesData']);

Route::prefix('admin')->group(function () {
    Route::get('/', function () {
        return view('admin.index');
    })->name('admin.index');

    Route::prefix('dishes')->group(function () {
        Route::get('/', [DishesController::class, 'index'])->name('admin.dishes.index');
        Route::get('/create', [DishesController::class, 'create'])->name('admin.dishes.create');
        Route::post('/', [DishesController::class, 'store'])->name('admin.dishes.store');
        Route::get('/{id}/edit', [DishesController::class, 'edit'])->name('admin.dishes.edit');
        Route::put('/{id}', [DishesController::class, 'update'])->name('admin.dishes.update');
        Route::delete('/{id}', [DishesController::class, 'destroy'])->name('admin.dishes.destroy');
        Route::get('/{id}/copy', [DishesController::class, 'copy'])->name('admin.dishes.copy');
    });

    Route::get('/planning', [PlanningController::class, 'index'])->name('planning.index');
    Route::post('/planning', [PlanningController::class, 'store'])->name('planning.store');
});

Route::get('restaurant/index', [RestaurantController::class, 'index'])->name('restaurant.index');

//TODO authentication
Route::get('restaurant/register', [RestaurantController::class, 'registerCustomer'])->name('restaurant.registerCustomer');
Route::post('restaurant/storeCustomer', [RestaurantController::class, 'storeCustomer'])->name('restaurant.storeCustomer');
Route::get('restaurant/table', [RestaurantController::class, 'table'])->name('restaurant.table');
Route::get('restaurant/order', [RestaurantController::class, 'order'])->name('restaurant.order');
Route::post('/restaurant/order/customer', [RestaurantController::class, 'orderCustomer'])->name('restaurant.orderCustomer');
Route::get('restaurant/order/pdf/{id}', [RestaurantController::class, 'pdf'])->name('restaurant.pdf');
Route::get('restaurant/order/all', [RestaurantController::class, 'allOrders'])->name('restaurant.allOrders'); 
Route::get('restaurant/order/start', [RestaurantController::class, 'startOrder'])->name('restaurant.startOrder');
Route::post('restaurant/order/start', [RestaurantController::class, 'processStartOrder'])->name('restaurant.processStartOrder');
//Klant tablet
Route::get('restaurant/order/food', [RestaurantController::class, 'orderOverview'])->name('restaurant.orderOverview'); 
Route::post('restaurant/order/registerRound', [RestaurantController::class, 'registerRound'])->name('restaurant.registerRound'); 
Route::get('restaurant/order/finished/{id}', [RestaurantController::class, 'orderFinished'])->name('restaurant.orderFinished');
