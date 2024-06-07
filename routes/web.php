<?php

use App\Http\Controllers\AccountController;
use App\Http\Controllers\GeneralController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LandingController;
use App\Http\Controllers\LocaleController;
use App\Http\Controllers\LogController;
use App\Http\Controllers\PasswordController;
use App\Http\Controllers\PrivigroupController;
use App\Http\Controllers\PrivilegesController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\SaleController;
use App\Http\Controllers\TicketController;
use App\Http\Controllers\TransactionController;
use App\Http\Controllers\UploadController;
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
//language locale
Route::get('/locale/{id}', [LocaleController::class, 'index'])->name('locale.index');

//submit password
Route::post('/password/post/{action}/{id}', [PasswordController::class, 'post'])->name('password.post');

Route::group(['middleware' => ['guest']], function () {
    //landing
    Route::get('/auth', [LandingController::class, 'index'])->name('auth.index');
    Route::post('/auth', [LandingController::class, 'auth'])->name('auth.post');

    //register
    Route::get('/register', [RegisterController::class, 'index'])->name('register.index');
    Route::post('/register/{action}', [RegisterController::class, 'register'])->name('register.post');

    //password
    Route::get('/password/new/{id}/{hash}', [PasswordController::class, 'new'])->name('password.new');
    Route::get('/password/forget', [PasswordController::class, 'forget'])->name('password.forget');
});

Route::group(['middleware' => ['auth']], function () {
    Route::get('/', [HomeController::class, 'index'])->name('home');
    Route::post('/', [HomeController::class, 'post'])->name('home.post');

    Route::get('/locale/datatables/json', [LocaleController::class, 'datatables'])->name('locale.datatables');
    Route::get('/logout', [LandingController::class, 'logout'])->name('auth.out');

    //profile
    Route::get('/profile', [ProfileController::class, 'index'])->name('account');

    //password
    Route::get('/password', [PasswordController::class, 'edit'])->name('password');

    //privilege
    Route::get('/privilege', [PrivilegesController::class, 'index'])->name('setting.privilege.index');
    Route::get('/privilege/list', [PrivilegesController::class, 'list'])->name('setting.privilege.list');
    Route::get('/privilege/add', [PrivilegesController::class, 'form'])->name('setting.privilege.add');
    Route::get('/privilege/edit/{id}', [PrivilegesController::class, 'form'])->name('setting.privilege.edit');
    Route::post('/privilege/post/{action}/{id}', [PrivilegesController::class, 'post'])->name('setting.privilege.post');

    //privigroup
    Route::get('/privigroup', [PrivigroupController::class, 'index'])->name('setting.privigroup.index');
    Route::get('/privigroup/list', [PrivigroupController::class, 'list'])->name('setting.privigroup.list');
    Route::get('/privigroup/add', [PrivigroupController::class, 'form'])->name('setting.privigroup.add');
    Route::get('/privigroup/edit/{id}', [PrivigroupController::class, 'form'])->name('setting.privigroup.edit');
    Route::post('/privigroup/post/{action}/{id}', [PrivigroupController::class, 'post'])->name('setting.privigroup.post');

    //account
    Route::get('/account', [AccountController::class, 'index'])->name('setting.account.index');
    Route::get('/account/list', [AccountController::class, 'list'])->name('setting.account.list');
    Route::get('/account/view/{id}', [AccountController::class, 'view'])->name('setting.account.view');
    Route::get('/account/add', [AccountController::class, 'form'])->name('setting.account.add');
    Route::get('/account/edit/{id}', [AccountController::class, 'form'])->name('setting.account.edit');
    Route::post('/account/post/{action}/{id}', [AccountController::class, 'post'])->name('setting.account.post');

    //general
    Route::get('/general', [GeneralController::class, 'index'])->name('setting.general.index');
    Route::post('/general/generate', [GeneralController::class, 'generateApiKey'])->name('setting.general.generate');
    Route::post('/general/post/{action}', [GeneralController::class, 'post'])->name('setting.general.post');

    //logs
    Route::get('/accactivity', [LogController::class, 'account'])->name('applog.accactivity.index');
    Route::get('/mailtrail', [LogController::class, 'mail'])->name('applog.mailtrail.index');
    Route::get('/apitrail', [LogController::class, 'api'])->name('applog.apitrail.index');
    Route::post('/log/list/{form}', [LogController::class, 'list'])->name('applog.log.list');

    //upload
    Route::get('/upload', [UploadController::class, 'index'])->name('master.upload.index');
    Route::post('/upload/post/{action}', [UploadController::class, 'post'])->name('master.upload.post');

    //transaction
    Route::get('/transaction', [TransactionController::class, 'index'])->name('master.transaction.index');
    Route::post('/transaction/list', [TransactionController::class, 'list'])->name('master.transaction.list');

    //sales
    Route::get('/sales', [SaleController::class, 'index'])->name('master.sales.index');
    Route::post('/sales/list', [SaleController::class, 'list'])->name('master.sales.list');
    Route::get('/sales/view/{id}', [SaleController::class, 'view'])->name('master.sales.view');

    //product
    Route::get('/product', [ProductController::class, 'index'])->name('master.product.index');
    Route::post('/product/list', [ProductController::class, 'list'])->name('master.product.list');

    //ticket
    Route::get('/ticket', [TicketController::class, 'index'])->name('master.ticket.index');
    Route::post('/ticket/list', [TicketController::class, 'list'])->name('master.ticket.list');
    Route::get('/ticket/view/{id}', [TicketController::class, 'view'])->name('master.ticket.view');
});
