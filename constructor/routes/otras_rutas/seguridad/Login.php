<?php

use Illuminate\Support\Facades\Auth;

    Route::group(['prefix' => 'seguridad', 'namespace' => 'Front_End\Seguridad'], function () {
        Route::get('login', 'LoginController@index')->name('login');  
        Route::post('login', 'LoginController@login')->name('login');    
        Route::post('logout', 'LoginController@logout')->name('logout');    
        Route::get('password/reset', 'Auth\ForgotPasswordController@showLinkRequestForm')->name('password.request');
        Route::post('password/email', 'Auth\ForgotPasswordController@sendResetLinkEmail')->name('password.email');
        Route::get('password/reset/{token}', 'Auth\ResetPasswordController@showResetForm')->name('password.reset');
        Route::post('password/reset', 'Auth\ResetPasswordController@reset')->name('password.update');
    }); 
    
?>