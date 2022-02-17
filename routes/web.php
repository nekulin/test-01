<?php

use App\Http\Controllers\NewsController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function(){
    return redirect(route('news.index'));
});

Route::get('/news/view/{slug}', [NewsController::class, 'view'])
    ->name('news.view');

Route::get('/news/{category?}/{sort?}', [NewsController::class, 'index'])
    ->name('news.index');

