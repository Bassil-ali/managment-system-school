<?php

use Illuminate\Support\Facades\Route;


//Auth::routes();

Route::get('/', 'HomeController@index')->name('selection');


Route::group(['namespace' => 'Auth'], function () {

Route::get('/login/{type}','LoginController@loginForm')->middleware('guest')->name('login.show');

Route::post('/login','LoginController@login')->name('login');

Route::get('/logout/{type}', 'LoginController@logout')->name('logout');


});

//==============================Translate all pages============================
Route::group(
    [
        'prefix' => LaravelLocalization::setLocale(),
        'middleware' => ['localeSessionRedirect', 'localizationRedirect', 'localeViewPath', 'auth']
    ],
    function () {

        //==============================dashboard============================
        Route::get('/dashboard', 'HomeController@dashboard')->name('dashboard');

        //==============================dashboard============================
        Route::group(['namespace' => 'Grades'], function () {
            Route::resource('Grades', 'GradeController');
        });

        //==============================Classrooms============================
        Route::group(['namespace' => 'Classrooms'], function () {
            Route::resource('Classrooms', 'ClassroomController');
            Route::post('delete_all', 'ClassroomController@delete_all')->name('delete_all');

            Route::post('Filter_Classes', 'ClassroomController@Filter_Classes')->name('Filter_Classes');
        });

        // =============================Sections===============================
        Route::group(['namespace' => 'Sections'], function () {

            Route::resource('Sections', 'SectionController');

            Route::get('/classes/{id}', 'SectionController@getclasses');
        });

        //==============================parents============================

        Route::view('add_parent', 'livewire.show_Form');


        //==============================Teachers============================
        Route::group(['namespace' => 'Teachers'], function () {
            Route::resource('Teachers', 'TeachersController');
        });


        //==============================Students============================
        Route::group(['namespace' => 'Students'], function () {
            Route::get('/indirect', 'OnlineClasseController@indirectCreate')->name('indirect.create');
            Route::post('/indirect', 'OnlineClasseController@storeIndirect')->name('indirect.store');
            Route::resource('online_classes', 'OnlineClasseController');
            Route::resource('Students', 'StudentController');
            Route::resource('Graduated', 'GraduatedController');
            Route::resource('Promotion', 'PromotionController');
            Route::resource('Fees_Invoices', 'FeesInvoicesController');
            Route::resource('Fees', 'FeesController');
            Route::resource('ProcessingFee', 'ProcessingFeeController');
            Route::resource('receipt_students', 'ReceiptStudentsController');
            Route::resource('Payment_students', 'PaymentController');
            Route::resource('Attendance', 'AttendanceController');
            Route::get('download_file/{filename}', 'LibraryController@downloadAttachment')->name('downloadAttachment');
            Route::resource('library', 'LibraryController');
            Route::get('/Attendance_tomo{id}', 'AttendanceController@Attendance_tomo')->name('Attendance_tomo');;
            Route::get('/Get_classrooms/{id}', 'StudentController@Get_classrooms');
            Route::get('/Get_Sections/{id}', 'StudentController@Get_Sections');
            Route::post('Upload_attachment', 'StudentController@Upload_attachment')->name('Upload_attachment');
            Route::get('Download_attachment/{studentsname}/{filename}', 'StudentController@Download_attachment')->name('Download_attachment');
            Route::post('Delete_attachment', 'StudentController@Delete_attachment')->name('Delete_attachment');
        });

        //==============================Subjects============================
        Route::group(['namespace' => 'Subjects'], function () {
            Route::resource('subjects', 'SubjectController');
        });

        //==============================Quizzes============================
        Route::group(['namespace' => 'Quizzes'], function () {
            Route::resource('Quizzes', 'QuizzController');
        });

        //==============================questions============================
        Route::group(['namespace' => 'questions'], function () {
            Route::resource('questions', 'QuestionController');
        });

        //==============================Setting============================
        Route::resource('settings', 'SettingController');
    }
);
