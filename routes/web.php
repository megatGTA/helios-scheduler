<?php

use Illuminate\Support\Facades\Route;

Route::get('/schedule/calendar', function () {
    return view('schedule.calendar');
});

Route::get('/schedule/timeline', function () {
    return view('schedule.timeline');
});
