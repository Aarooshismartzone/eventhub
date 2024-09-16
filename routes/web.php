<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PaymentController;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

Route::get('/', function () {
   // dd(Hash::make('admin@123'));
    return view('index');
})->name('landingpage');



//Route::group([ 'namespace' => 'Shop','middleware' => ['auth', 'auth:admin'], 'prefix' => 'shop'], function () {});

Route::get('/get_state', 'App\Http\Controllers\HomeController@getState');
Route::get('/get_city', 'App\Http\Controllers\HomeController@getCity');
Route::get('images/{flolder?}/{file?}/{user?}', ['as' => 'image.get', 'uses' => '\App\Http\Controllers\FileController@getFile']);

Route::group(['middleware' => ['auth']], function () {
    Route::get('stripe', [PaymentController::class, 'stripe']);
    Route::post('stripe', [PaymentController::class, 'stripePost'])->name('stripe.post');


    Route::get('/event/{company}/{slug}', 'App\Http\Controllers\HomeController@eventPage');
    // Route::get('/company/event-page/{slug}','App\Http\Controllers\HomeController@eventPage');
    Route::get('/company/landingpage', 'App\Http\Controllers\CompanyController@landingPage');
    /* Company */

    Route::get('/company', 'App\Http\Controllers\CompanyController@dashboard');

    Route::get('/company/info', 'App\Http\Controllers\CompanyController@companyInfo');
    Route::post('/company/info-store', 'App\Http\Controllers\CompanyController@companyInfoStore');

    Route::get('/company/event-list', 'App\Http\Controllers\CompanyController@eventList');
    Route::get('/company/add-event', 'App\Http\Controllers\CompanyController@addEvent');
    Route::post('/add-event-details', 'App\Http\Controllers\CompanyController@addEventDetails');
    Route::post('/add-room-and-booking', 'App\Http\Controllers\CompanyController@roomAndBooking');
    Route::post('/eventPagePreview', 'App\Http\Controllers\CompanyController@eventPagePreview');
    Route::post('/addEventPageDetails', 'App\Http\Controllers\CompanyController@addEventPageDetails');
    Route::post('/updateEvent', 'App\Http\Controllers\CompanyController@updateEvent');
    Route::get('/company/booking-list', 'App\Http\Controllers\CompanyController@bookingList');
    Route::get('/getEventDetails', 'App\Http\Controllers\CompanyController@getEventDetails');

    Route::get('/company/subscription', 'App\Http\Controllers\CompanyController@subscription');
    Route::get('/agentDetails/{id}', 'App\Http\Controllers\CompanyController@agentDetails');
    Route::post('/updateAgent', 'App\Http\Controllers\CompanyController@updateAgent');
    Route::post('/deleteAgent', 'App\Http\Controllers\CompanyController@deleteAgent');

    Route::get('/company/logout', 'App\Http\Controllers\CompanyController@logout');

    /** User */

    Route::get('/user', 'App\Http\Controllers\UserController@dashboard');
    Route::get('/user/event-list', 'App\Http\Controllers\UserController@eventlist');

    Route::get('/user/event/{id}', 'App\Http\Controllers\UserController@eventBookingPage');

    Route::post('/booking/contactInfo', 'App\Http\Controllers\UserController@contactInfo');
    Route::post('/booking/roomInfo', 'App\Http\Controllers\UserController@roomInfo');
    Route::post('/booking/packageInfo', 'App\Http\Controllers\UserController@packageInfo');
    Route::post('/booking/travelerInfo', 'App\Http\Controllers\UserController@travelerInfo');
    Route::post('/booking/policyInfo', 'App\Http\Controllers\UserController@policyInfo');
    Route::post('/payment', 'App\Http\Controllers\UserController@paymentInfo');

    // Route::post('/booking','App\Http\Controllers\UserController@booking');    
    Route::get('/user/logout', 'App\Http\Controllers\UserController@logout');

    /** Admin */

    Route::get('/admin', 'App\Http\Controllers\AdminController@dashboard');
    Route::get('/admin/companies', 'App\Http\Controllers\AdminController@companies');
    Route::get('/admin/events', 'App\Http\Controllers\AdminController@events');
    Route::get('/admin/users', 'App\Http\Controllers\AdminController@users');
    Route::get('/admin/logout', 'App\Http\Controllers\AdminController@logout');
});

Route::get('/admin/login', function () {
    return view('admin/login');
});
Route::post('/admin/loginchk', 'App\Http\Controllers\AdminController@login');

//company loginpage

Route::get('/company/enroll', function () {
    if (auth()->user()) {
        return redirect('/');
    }
    return view('company/login', ['type' => "registration"]);
});
Route::post('/company/registration', 'App\Http\Controllers\CompanyController@registration');

Route::get('/company/setpass', function () {
    if (!Session::get('user')) {
        return redirect('/company/enroll');
    }
    return view('company/login', ['type' => "setpass"]);
});
Route::post('/company/setpass', 'App\Http\Controllers\CompanyController@setpass');

Route::get('/company/getotp', function () {
    if (!Session::get('user')) {
        return redirect('/company/enroll');
    }
    return view('company/login', ['type' => "getotp"]);
});
Route::post('/company/getotp', 'App\Http\Controllers\CompanyController@getotp');


Route::get('/company/setotp', function () {
    if (!Session::get('user')) {
        return redirect('/company/enroll');
    }
    return view('company/login', ['type' => "setotp"]);
});
Route::post('/company/setotp', 'App\Http\Controllers\CompanyController@setotp');

Route::get('/company/login', function () {
    return view('company/login', ['type' => "conflogin"]);
});
Route::post('/company/loginchk', 'App\Http\Controllers\CompanyController@login');

Route::get('/company/normallogin', function () {
    return view('company/login', ['type' => "normallogin"]);
});



//user loginpage

Route::get('/user/registration', function () {
    return view('user/login', ['type' => "login"]);
});

Route::post('/user/registration', 'App\Http\Controllers\UserController@registration');

Route::get('/user/getotp', function () {
    return view('user/login', ['type' => "getotp"]);
});

Route::post('/user/getotp', 'App\Http\Controllers\UserController@getotp');

Route::get('/user/setotp', function () {
    return view('user/login', ['type' => "setotp"]);
});

Route::post('/user/setotp', 'App\Http\Controllers\UserController@setotp');

Route::get('/user/login', function () {
    return view('user/login', ['type' => "conflogin"]);
});
Route::post('/user/loginchk', 'App\Http\Controllers\UserController@login');


Route::get('/user/normallogin', function () {
    return view('user/login', ['type' => "normallogin"]);
});


//landing pages

// Route::get('/', function () {
//     return view('landingpage');
// })->name('landingpage');
