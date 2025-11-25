<?php

use Illuminate\Support\Facades\Route;

// Keep this minimal — only app-level endpoints go here.
// All schedule module routes live in schedule-module/routes/api.php

Route::get('/ping', function () {
    return response()->json(['status' => 'OK'], 200);
});
