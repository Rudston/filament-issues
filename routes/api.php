<?php

// use App\Http\Controllers\Applications\Admin\ReviewEntryController;

use App\Http\Controllers\EolItemController;
// use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ApiController;
use App\Http\Middleware\ApiCustom;
// use App\Http\Middleware\AdminUser;
// use App\Http\Middleware\StudentUser;

/* ===========================================================================
ApiCustom middleware group is used to guard direct Api calls from the VLE
Uses its own enhanced expiring token access logic - which is better than Sanctum's static bearer token.
=========================================================================== */
Route::middleware([ApiCustom::class])->group(function() {

    Route::get('/scan-user-course-lookup-errors/{lookupId}', 'App\Http\Controllers\Api\ScanUserCourseLookupErrorsController@index')->name('api.scan.user.course.lookup-errors');

});

