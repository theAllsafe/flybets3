<?php

use App\Http\Controllers\Dashboard\DashboardController;
use App\Http\Controllers\Dashboard\FirstLoginController;
use App\Http\Controllers\Dashboard\FlightPlanController;
use App\Http\Controllers\Dashboard\OrganisationController;
use App\Http\Controllers\Dashboard\UASOperatorController;
use App\Http\Controllers\Dashboard\UnmannedAircraftController;
use App\Http\Controllers\Dashboard\UserController;
use App\Http\Controllers\QrCodeController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Controller;
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

require __DIR__ . '/auth.php';

//Route::get('/', function () {
//    return view('myAuth.login');
//});

//isPilot    isProfileComplete


Route::get('/clear-cache-all', function() {
    Artisan::call('cache:clear');
    dd("Cache Clear All");

});
Route::get('/checkemailvalid', [Controller::class, 'checkemailvalid']);
Route::get('/checkregistervalid', [Controller::class, 'checkregistervalid']);
Route::get('/checkresetvalid', [Controller::class, 'checkresetvalid']);
Route::get('send-mail', function () {
   
    $details = [
        'title' => 'Mail from ItSolutionStuff.com',
        'body' => 'This is for testing email using smtp'
    ];
   
    \Mail::to('anilchetu11@gmail.com')->send(new \App\Mail\MyTestMail($details));
   
    dd("Email is Sent.");
});

Route::prefix('dashboard')->middleware(['auth'])->group(function () {
    Route::group(['middleware' => ['verified']], function() {
    
    Route::view('test', 'test');

    // First login routes to complete profile and create UAS Operator
    Route::get('first-login-edit-user', [FirstLoginController::class, 'editUser'])->name('first-login-edit-user');
    Route::put('first-login-update-user/{user}', [FirstLoginController::class, 'updateUser'])->name('first-login-update-user');
    Route::get('first-login-create-operator', [FirstLoginController::class, 'createOperator'])->name('first-login-create-operator');
    Route::put('first-login-store-operator/{user}', [FirstLoginController::class, 'storeOperator'])->name('first-login-store-operator');

    Route::middleware('isProfileComplete')->group(function () {
        // Route::get('unmanned-aircraft', [UnmannedAircraftController::class, 'search'])->name('unmanned-aircraft.index');

        Route::get('/', [DashboardController::class, 'index'])->name('dashboard');
        Route::resource('user', UserController::class);
        Route::resource('uas-operator', UASOperatorController::class);
        Route::resource('unmanned-aircraft', UnmannedAircraftController::class);
        Route::resource('flight-plan', FlightPlanController::class);
//        Route::resource('organisation', OrganisationController::class)->except(['edit', 'update']);

        // Route::post('unmanned-aircraft', [UnmannedAircraftController::class, 'search'])->name('unmanned-aircraft.index');

        Route::post('unmanned-aircraft/search', [UnmannedAircraftController::class, 'search'])->name('unmanned-aircraft.search');
        Route::post('uas-operator/search', [UASOperatorController::class, 'search'])->name('uas-operator.search');

        Route::get('uas-operator/pilot/{uas_operator}/edit', [UASOperatorController::class, 'editByUser'])->name('uas-operator.editByUser');
        Route::put('uas-operator/pilot/{uas_operator}/update', [UASOperatorController::class, 'updateByUser'])->name('uas-operator.updateByUser');
        Route::delete('uas-operator/pilot/{uas_operator}/delete', [UASOperatorController::class, 'deleteByUser'])->name('uas-operator.deleteByUser');

        Route::get('organisation', [OrganisationController::class, 'index'])->name('organisation.index');
        Route::get('organisation/invite', [OrganisationController::class, 'invitePage'])->name('organisation.invite');
        Route::post('organisation/invite', [OrganisationController::class, 'invite'])->name('organisation.invite');
        Route::get('organisation/create', [OrganisationController::class, 'create'])->name('organisation.create');
        Route::post('organisation/store', [OrganisationController::class, 'store'])->name('organisation.store');
        Route::get('organisation/edit', [OrganisationController::class, 'edit'])->name('organisation.edit');
        Route::put('organisation/{organisation}/update', [OrganisationController::class, 'update'])->name('organisation.update');
        Route::delete('organisation/delete', [OrganisationController::class, 'destroy'])->name('organisation.destroy');
        Route::delete('organisation/member/{uas_operator}/delete', [OrganisationController::class, 'deleteByUser'])->name('organisation.deleteByUser');


        Route::get('profile-switch/{id}', [DashboardController::class, 'switchProfile'])->name('profile-switch');


        Route::get('flight-plan-uas-pilot/{id?}', [FlightPlanController::class, 'getUASOperator'])->name('flight-plan-uas-pilot');
        Route::get('aircraft/{id?}', [FlightPlanController::class, 'getAircraft'])->name('aircraft');


    });

    Route::view('support/faqs', 'dashboard.support.faqs')->name('support.faqs');
    Route::view('support/guides-and-links', 'dashboard.support.guides')->name('support.guides');
    Route::view('support/contact-us', 'dashboard.support.contactUs')->name('support.contactUs');
    });
});

Route::get('/generate-qrcode', [QrCodeController::class, 'index']);
