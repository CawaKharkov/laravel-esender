<?php

Route::group(['prefix' => config('laravel_sender.prefix')], function () {
    Route::resource('jobs', '\CawaKharkov\LaravelSender\Controllers\JobController');
});
