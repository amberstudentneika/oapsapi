<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::get('/get/relation',[\App\Http\Controllers\NecessaryController::class, 'relationType']);

//Parent Registration
Route::post('/add/parent',[\App\Http\Controllers\ParentController::class, 'store']);
Route::post('/login',[\App\Http\Controllers\HomeController::class, 'index']);
//Parent routes
Route::post('/search/child',[\App\Http\Controllers\ParentController::class, 'searchChild']);
Route::post('/create/child',[\App\Http\Controllers\ParentController::class, 'addChild']);
Route::get('/relationship/{parent}/{child}',[\App\Http\Controllers\ParentController::class, 'findRelationship']);

Route::get('/relationships',[\App\Http\Controllers\ParentController::class, 'allRelationship']);
Route::get('/view/EV/{id}',[\App\Http\Controllers\ParentController::class, 'allEV']);
Route::get('/verify/parent/{id}/{id1}',[\App\Http\Controllers\ParentController::class, 'verifyRelationship']);
Route::get('/verify/parent/deny/{id}/{id1}',[\App\Http\Controllers\ParentController::class, 'verifyRelationshipDeny']);
Route::get('/find/all/{id}',[\App\Http\Controllers\ParentController::class, 'findAllRelationships']);
Route::get('/eVoucher/details',[\App\Http\Controllers\ParentController::class, 'eVoucherDetails']);
Route::post('/payment',[\App\Http\Controllers\eVoucherPaymentDetailsController::class, 'store']);

//CS Staff
Route::get('/search/voucher/number/{id}',[\App\Http\Controllers\NecessaryController::class, 'searchVN']);
Route::get('/clock/{csID}/{id}',[\App\Http\Controllers\NecessaryController::class, 'clock']);
Route::post('/change/password/{id}',[\App\Http\Controllers\NecessaryController::class, 'changePassword']);

//User routes
Route::get('student/show',[\App\Http\Controllers\StudentController::class, 'index']);
Route::post('/student/create',[\App\Http\Controllers\StudentController::class, 'store']);
Route::get('/student/edit/{id}',[\App\Http\Controllers\StudentController::class, 'edit']);
Route::post('/student/update/{id}',[\App\Http\Controllers\StudentController::class, 'update']);
Route::get('/staff/show',[\App\Http\Controllers\CanteenStaffController::class, 'index']);
Route::post('/staff/create',[\App\Http\Controllers\CanteenStaffController::class, 'store']);
Route::get('/staff/edit/{id}',[\App\Http\Controllers\CanteenStaffController::class, 'edit']);
Route::post('/staff/update/{id}',[\App\Http\Controllers\CanteenStaffController::class, 'update']);
Route::get('/stats',[\App\Http\Controllers\HomeController::class, 'stats']);
