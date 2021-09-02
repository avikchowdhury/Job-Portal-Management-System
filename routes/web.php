<?php

use Illuminate\Support\Facades\Route;

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

//jobs
Route::get('/','App\Http\Controllers\JobController@index');
Route::get('/jobs/{id}/{job}','App\Http\Controllers\JobController@show')->name('jobs.show');
Route::get('/jobs/create','App\Http\Controllers\JobController@create')->name('job.create');
Route::post('/jobs/create','App\Http\Controllers\JobController@store')->name('job.store');
Route::get('/jobs/my-job','App\Http\Controllers\JobController@myjob')->name('my.job');

Route::get('/jobs/{id}/edit','App\Http\Controllers\JobController@edit')->name('job.edit');

Route::post('/jobs/{id}/edit','App\Http\Controllers\JobController@update')->name('job.update');

Route::delete('/jobs/{id}', 'App\Http\Controllers\JobController@destroy')->name('job.destroy');

Route::get('/jobs/search','App\Http\Controllers\JobController@searchJobs');

Route::get('/jobs/applications','App\Http\Controllers\JobController@applicant')->name('applicant');
Route::get('/jobs/alljobs','App\Http\Controllers\JobController@allJobs')->name('alljobs');
Route::post('/applications/{id}','App\Http\Controllers\JobController@apply')->name('apply');

Auth::routes();
//company
Route::get('/company/{id}/{company}','App\Http\Controllers\CompanyController@index')->name('company.index');
Route::get('company/create','App\Http\Controllers\CompanyController@create')->name('company.view');
Route::post('company/create','App\Http\Controllers\CompanyController@store')->name('company.store');
Route::post('company/coverphoto','App\Http\Controllers\CompanyController@coverPhoto')->name('cover.photo');
Route::post('company/logo','App\Http\Controllers\CompanyController@companyLogo')->name('company.logo');


//user profile
Route::get('user/profile','App\Http\Controllers\UserController@index')->name('user.profile');
Route::post('user/profile/create','App\Http\Controllers\UserController@store')->name('profile.create');
Route::post('user/coverletter','App\Http\Controllers\UserController@coverletter')->name('cover.letter');
Route::post('user/resume','App\Http\Controllers\UserController@resume')->name('resume');
Route::post('user/avatar','App\Http\Controllers\UserController@avatar')->name('avatar');



//employer view
Route::view('employer/register','auth.employer-register')->name('employer.register');

Route::post('employer/register','App\Http\Controllers\EmployerRegisterController@employerRegister')->name('emp.register');

Route::post('/applications/{id}','App\Http\Controllers\JobController@apply')->name('apply');



Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');



//save and unsave job
Route::post('/save/{id}','App\Http\Controllers\FavouriteController@saveJob');

Route::post('/unsave/{id}','App\Http\Controllers\FavouriteController@unSaveJob');


//category
Route::get('/category/{id}/jobs','App\Http\Controllers\CategoryController@index')->name('category.index');

//company
Route::get('/companies','App\Http\Controllers\CompanyController@company')->name('company');

//admin
Route::get('/dashboard','App\Http\Controllers\DashboardController@index')->middleware('admin');
Route::get('/dashboard/create','App\Http\Controllers\DashboardController@create')->middleware('admin');
Route::post('/dashboard/create','App\Http\Controllers\DashboardController@store')->name('post.store')->middleware('admin');
Route::post('/dashboard/destroy','App\Http\Controllers\DashboardController@destroy')->name('post.delete')->middleware('admin');

Route::get('/dashboard/{id}/edit','App\Http\Controllers\DashboardController@edit')->name('post.edit')->middleware('admin');
Route::post('/dashboard/{id}/update','App\Http\Controllers\DashboardController@update')->name('post.update')->middleware('admin');

Route::get('/dashboard/trash','App\Http\Controllers\DashboardController@trash')->middleware('admin');

Route::get('/dashboard/{id}/trash','App\Http\Controllers\DashboardController@restore')->name('post.restore')->middleware('admin');

Route::get('/dashboard/{id}/toggle','App\Http\Controllers\DashboardController@toggle')->name('post.toggle')->middleware('admin');
Route::get('/posts/{id}/{slug}','App\Http\Controllers\DashboardController@show')->name('post.show');

Route::get('/dashboard/jobs','App\Http\Controllers\DashboardController@getAllJobs')->middleware('admin');
Route::get('/dashboard/{id}/jobs','App\Http\Controllers\DashboardController@changeJobStatus')->name('job.status')->middleware('admin');






//testimonial
Route::get('testimonial','App\Http\Controllers\TestimonialController@index')->middleware('admin');

Route::get('testimonial/create','App\Http\Controllers\TestimonialController@create')->middleware('admin');
Route::post('testimonial/create','App\Http\Controllers\TestimonialController@store')->name('testimonial.store')->middleware('admin');

//email
Route::post('/job/mail','App\Http\Controllers\EmailController@send')->name('mail');