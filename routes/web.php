<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\AgentController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\Backend\PropertyTypeController;
use App\Http\Controllers\Backend\PropertyController;

// Route::get('/', function () {
//     return view('welcome');
// });

// User Routes.
Route::get('/', [UserController::class, 'index']);
// End User Routes.


Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    
    Route::get('/user/profile', [UserController::class, 'UserProfile'])->name('user.profile');
    
    Route::post('/user/profile/store', [UserController::class, 'UserProfileStore'])->name('user.profile.store');
    
    Route::get('/user/logout', [UserController::class, 'UserLogout'])->name('user.logout');
    
    Route::get('/user/change_password', [UserController::class, 'UserChangePassword'])->name('user.change.password');
    
    Route::post('/user/update_password', [UserController::class, 'UserUpdatePassword'])->name('user.password.update');

});

require __DIR__.'/auth.php';

// Admin Group Middleware Start
Route::middleware(['auth','role:admin'])->group(function(){
    
    Route::get('/admin/dashboard', [AdminController::class, 'AdminDashboard'])->name('admin.dashboard');
    
    Route::get('/admin/logout', [AdminController::class, 'AdminLogout'])->name('admin.logout');
    
    Route::get('/admin/profile', [AdminController::class, 'AdminProfile'])->name('admin.profile');

    Route::post('/admin/profile/store', [AdminController::class, 'AdminProfileStore'])->name('admin.profile.store');

    Route::get('/admin/change_password', [AdminController::class, 'AdminChangePassword'])->name('admin.change.password');
    
    Route::post('/admin/update_password', [AdminController::class, 'AdminUpdatePassword'])->name('admin.update.password');

}); // End Group Admin Middleware

// Agent Group Middleware Start
Route::middleware(['auth','role:agent'])->group(function(){
    
    Route::get('/agent/dashboard', [AgentController::class, 'AgentController'])->name('agent.dashboard');
}); // End Group Agent Middleware

Route::get('/admin/login', [AdminController::class, 'AdminLogin'])->name('admin.login');


// Property Type All Route Start
Route::middleware(['auth','role:admin'])->group(function(){ // from laravel 9 and + is available Calling controller once for all.
    
    Route::controller(PropertyTypeController::class)->group(function(){
        
        Route::get('/all_ptype', 'AllType')->name('all.type');
        Route::get('/add_ptype', 'AddType')->name('add.type');
        Route::post('/store_property_type', 'StoreType')->name('store.type');
        Route::get('/edit_property_type/{id}', 'EditType')->name('edit.type');
        Route::post('/update_property_type', 'UpdateType')->name('update.type');
        Route::get('/delete_property_type/{id}', 'DeleteType')->name('delete.type');

    }); // End Property Type All Route.
    
    // Amenities Type Start It is created on PropertyType Controller because it is related to Property
    Route::controller(PropertyTypeController::class)->group(function(){
        
        Route::get('/all_amenities', 'AllAmenities')->name('all.amenities');
        Route::get('/add_amenitie', 'AddAmenities')->name('add.amenities');
        Route::post('/store/amenities', 'StoreAmenities')->name('store.amenities');
        Route::get('/edit/amenitied/{id}', 'EditAmenities')->name('edit.amenities');
        Route::post('/update_amenities', 'UpdateAmenities')->name('update.amenities');
        Route::get('/delete_amenities/{id}', 'DeleteAmenities')->name('delete.amenities');

    }); // End Amenities Type All Route.

    // Start Property Route 
    Route::controller(PropertyController::class)->group(function(){
    
        Route::get('/get_all_property', 'AllProperty')->name('all.property');
        Route::get('/add_property', 'AddProperty')->name('add.property');
        Route::post('/store_property', 'StoreProperty')->name('store.property');
        Route::get('/edit_property/{id}', 'EditProperty')->name('edit.property');
        Route::post('/update_property', 'UpdateProperty')->name('update.property');


    }); // End Property Route.

}); //End Admin