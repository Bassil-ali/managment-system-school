<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| student Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

//==============================Translate all pages============================
Route::group(
    [
        'prefix' => LaravelLocalization::setLocale(),
        'middleware' => ['localeSessionRedirect', 'localizationRedirect', 'localeViewPath', 'auth:teacher']
    ], function () {

    //==============================dashboard============================
    Route::get('/teacher/dashboard', function () {
       

       $ids = DB::table('teacher_section')->where('teacher_id',auth()->user()->id)->pluck('section_id');
       $data['count_sections'] =  $ids->count();
       $data['count_students'] = DB::table('students')->whereIn('section_id',$ids)->count();
       $data['students'] = DB::table('students')->whereIn('section_id',$ids)->get();
       return view('pages.Teachers.dashboard.dashboard',$data);
    });

     Route::group(['namespace' => 'Teachers\dashboard'], function () {
        //==============================students============================
     Route::get('student','StudentController@index')->name('student.index');
      Route::get('sections','StudentController@sections')->name('sections');
     Route::post('attendance','StudentController@attendance')->name('attendance');
     Route::post('edit_attendance','StudentController@editAttendance')->name('attendance.edit');

    });

});
