<?php

use Illuminate\Support\Facades\Route;

// Auth
\Auth::routes();

Route::post('/login', [\App\Http\Controllers\Main\Auth\LoginController::class,"store"])->name('login.check');

Route::get('/register', [\App\Http\Controllers\Main\Auth\RegisterController::class,"index"])->name('register');
Route::post('/register', [\App\Http\Controllers\Main\Auth\RegisterController::class,"store"])->name('register');

Route::get('/otp', [\App\Http\Controllers\Main\Auth\OTPController::class,"index"])->name('otp');
Route::post('/otp', [\App\Http\Controllers\Main\Auth\OTPController::class,"store"])->name('otp');

Route::get('/forget-password', [\App\Http\Controllers\Main\Auth\ForgetPasswordController::class,"index"])->name('forgetPassword');
Route::post('/forget-password', [\App\Http\Controllers\Main\Auth\ForgetPasswordController::class,"store"])->name('forgetPassword');

Route::get('/reset-password',  [\App\Http\Controllers\Main\Auth\ResetPasswordController::class,"index"])->name('resetPassword');
Route::post('/reset-password',  [\App\Http\Controllers\Main\Auth\ResetPasswordController::class,"store"])->name('resetPassword');
// ================ //




// ============================================ //
// Home
Route::get('/',[\App\Http\Controllers\Main\Home\HomeController::class, 'index'])->name("home.index");
// About
Route::get('/about',[\App\Http\Controllers\Main\About\AboutController::class, 'index'])->name("about");
// Terms
Route::get('/terms',[\App\Http\Controllers\Main\Terms\TermsController::class, 'index'])->name("terms");
// FAQ
Route::get('/faq',[\App\Http\Controllers\Main\FAQ\FAQController::class, 'index'])->name("faq");
// Contact
Route::get('/contact',[\App\Http\Controllers\Main\Contact\ContactController::class, 'index'])->name("contact");
Route::post('/contact',[\App\Http\Controllers\Main\Contact\ContactController::class, 'store'])->name("contact.store");
// Services
Route::get('/services/{service}',[\App\Http\Controllers\Main\Services\ServicesController::class, 'show'])->middleware("auth")->name("services.show");

Route::middleware("auth")->group(function () {
    Route::get('/logout',function() {
        \Auth::logout();
        return redirect()->back();
    })->name("logout");
    Route::post('/services/{service}',[\App\Http\Controllers\Main\Services\ServicesController::class, 'store'])->name("services.store");
    Route::name("profile.")->prefix("/profile")->group(function () {
        Route::get('/',[\App\Http\Controllers\Main\Profile\ProfileController::class, 'index'])->name("index");
        Route::post('/',[\App\Http\Controllers\Main\Profile\ProfileController::class, 'update'])->name("update");
        Route::post('/change-password',[\App\Http\Controllers\Main\Profile\ProfileController::class, 'changePassword'])->name("password.update");
        Route::post('/active-account',[\App\Http\Controllers\Main\Profile\ProfileController::class, 'activeAccount'])->name("activeAccount");
        // Notifications
        Route::get('/notifications',[\App\Http\Controllers\Main\Notifications\NotificationsController::class, 'index'])->name("notifications.index");
        Route::delete('/notifications/{notification}',[\App\Http\Controllers\Main\Notifications\NotificationsController::class, 'destroy'])->name("notifications.destroy");
        // Orders
        Route::get('/orders',[\App\Http\Controllers\Main\Orders\OrdersController::class, 'index'])->name("orders.index");
        Route::delete('/orders/{order}',[\App\Http\Controllers\Main\Orders\OrdersController::class, 'destroy'])->name("orders.destroy");
    });
});



Route::get('/re-send/{phone}', function($phone) {

    $user = \App\Models\User::where("phone",$phone)->first();
    if(is_null($user)) {
        return redirect()->back()->withErrors(["phone"=>"هذا الجوال غير موجود لدينا"]);
    }
    $otp = (env('SMS_SEND',false)) ? rand(1000,9999) : 1234;
    $user->update([
        "otp"   => $otp
    ]);
    if(env('SMS_SEND',false)) {
        (new \App\Support\Jawaly)->setPhone($user->phone)->setMessage($otp)->send();
    }
    return redirect()->back()->with("success","تم إعاده إرسال كود التحقق");
})->name('re-send');



Route::get('/home', function () {
    return redirect("/dashboard");
});

Route::name('admin.')->prefix('dashboard')->group(function () {
    \Auth::routes();
    // ================ //
    Route::get('/forget-password', function(){
        return view("admin.pages.auth.forget-password");
    })->name('forgetPassword.index');
    // ================ //
    Route::post('/forget-password', function(\App\Http\Requests\Dashboard\Auth\ForgetPasswordRequest $request) {
        $user = \App\Models\User::where("phone",$request->phone)->whereHas("roles",function($q){
            return $q->where("name","!=",\App\Models\User::TYPE_CUSTOMER);
        })->first();
        if(is_null($user)) {
            return redirect()->back()->withErrors(["phone"=>"هذا الجوال غير موجود لدينا"]);
        }

        $otp = (env('SMS_SEND',false)) ? rand(1000,9999) : 1234;
        $user->update([
            "otp"   => $otp
        ]);
        if(env('SMS_SEND',false)) {
            (new \App\Support\Jawaly)->setPhone($user->phone)->setMessage($otp)->send();
        }
        return redirect("/dashboard/reset-password?phone=$user->phone");
    })->name('forgetPassword.send');
    // ================ //
    // ================ //
    // ================ //
    Route::get('/reset-password', function() {
        return view("admin.pages.auth.reset-password");
    })->name('resetPassword.index');
    // ================ //
    Route::post('/reset-password', function(\App\Http\Requests\Dashboard\Auth\ResetPasswordRequest $request) {
        $user = \App\Models\User::where("phone",$request->phone)->first();
        if($user->otp != $request->otp) {
            return redirect()->back()->with("danger","كود التحقق غير صحيح");
        }
        $user->update([
            "password"  => \Hash::make($request->password)
        ]);
        \Auth::login($user);
        return redirect()->route("admin.home");
    })->name('resetPassword.send');
    // ================ //
    Route::middleware(['auth.dashboard',"auth.dashboardSuspend"])->group(function () {
        // Home
        Route::get('/', [\App\Http\Controllers\Dashboard\Home\HomeController::class, 'index'])->name('home');
        Route::get('/home', [\App\Http\Controllers\Dashboard\Home\HomeController::class, 'index'])->name('home.index');
        // Logout
        Route::get('/logout', [\App\Http\Controllers\Dashboard\Home\HomeController::class,'logout'])->name('logout');
        // Profile
        Route::get('/profile', [\App\Http\Controllers\Dashboard\Profile\ProfileController::class,'index'])->name('profile.index');
        Route::post('/profile', [\App\Http\Controllers\Dashboard\Profile\ProfileController::class,'store'])->name('profile.store');
        Route::get('/change_password', [\App\Http\Controllers\Dashboard\Profile\ProfileController::class, 'change_password'])->name('change_password.index');
        Route::post('/change_password', [\App\Http\Controllers\Dashboard\Profile\ProfileController::class, 'update_password'])->name('change_password.store');
        // ======================== //
        // Contact Us
        Route::resource('/contact-us', \App\Http\Controllers\Dashboard\ContactUs\ContactUsController::class)->only(['index','show','destroy','update']);
        // Settings
        Route::prefix('settings')->name('settings.')->group(function () {
            Route::get('/', [\App\Http\Controllers\Dashboard\Settings\SettingsController::class,'index'])->name('index');
            Route::get('/{group_by}', [\App\Http\Controllers\Dashboard\Settings\SettingsController::class,'edit'])->name('edit');
            Route::put('/{group_by}', [\App\Http\Controllers\Dashboard\Settings\SettingsController::class,'update'])->name('update');
        });
        // Users
        Route::post('/users/{user}/change-active', [\App\Http\Controllers\Dashboard\Users\UserController::class,'changeSuspended'])->name('users.activate')->where('user','[0-9]+');
        Route::resource('/users', \App\Http\Controllers\Dashboard\Users\UserController::class);
        // Customers
        Route::post('/customers/{customer}/change-active', [\App\Http\Controllers\Dashboard\Users\CustomersController::class,'changeSuspended'])->name('customers.activate')->where('customer','[0-9]+');
        Route::resource('/customers', \App\Http\Controllers\Dashboard\Users\CustomersController::class);

        // Roles
        Route::resource('/roles', \App\Http\Controllers\Dashboard\Roles\RoleController::class);

        // ************* About *********** //
        Route::resource('/contents', \App\Http\Controllers\Dashboard\Pages\PagesController::class);

        // ************* FAQ *********** //
        Route::resource('/faqs', \App\Http\Controllers\Dashboard\Pages\PagesController::class);

        // ************* Sliders *********** //
        Route::resource('/sliders', \App\Http\Controllers\Dashboard\Sliders\SlidersController::class);

        // ************* Services *********** //
        Route::resource('/services', \App\Http\Controllers\Dashboard\Services\ServicesController::class);

        // ************* Banks *********** //
        Route::resource('/banks', \App\Http\Controllers\Dashboard\Banks\BanksController::class);

        // ************* Banners *********** //
        Route::resource('/banners', \App\Http\Controllers\Dashboard\Banners\BannersController::class);

        // ************* Counters *********** //
        Route::resource('/counters', \App\Http\Controllers\Dashboard\Counters\CountersController::class);

        // ************* Entities *********** //
        Route::resource('/entitles', \App\Http\Controllers\Dashboard\Entitles\EntitlesController::class);

        // ************* Partners *********** //
        Route::resource('/partners', \App\Http\Controllers\Dashboard\Partners\PartnersController::class);

        // ************* Testimonials *********** //
        Route::resource('/testimonials', \App\Http\Controllers\Dashboard\Testimonials\TestimonialsController::class);

        // ************* Employers *********** //
        Route::resource('/employers', \App\Http\Controllers\Dashboard\Employers\EmployersController::class);

        // ************* Contents *********** //
        Route::resource('/terms', \App\Http\Controllers\Dashboard\Pages\TermsController::class);
        Route::resource('/contents', \App\Http\Controllers\Dashboard\Pages\PagesController::class);
        Route::resource('/abouts', \App\Http\Controllers\Dashboard\Pages\AboutsController::class);

        // ************* FAQS *********** //
        Route::resource('/faqs', \App\Http\Controllers\Dashboard\FAQS\FAQSController::class);

        // ************* Orders *********** //
        // Route::get('/orders/{order}/showPdf', [\App\Http\Controllers\Dashboard\Orders\OrdersController::class,"showPdf"])->name("orders.showPdf")->where("order","[0-9]+");
        Route::get('/orders/{order}/entitles/{entitle}', [\App\Http\Controllers\Dashboard\Orders\OrdersController::class,"sendPDF"])->name("orders.sendPDF")->where("order","[0-9]+")->where("entitle","[0-9]+");
        Route::resource('/orders', \App\Http\Controllers\Dashboard\Orders\OrdersController::class);

        // ************* Notifications *********** //
        Route::resource('/notifications', \App\Http\Controllers\Dashboard\Notifications\NotificationsController::class);

    });
});

Route::get('/pdf/{order}', [\App\Http\Controllers\Dashboard\Orders\OrdersController::class,"showPdf"])->name("pdf")->where("order","[0-9]+");
