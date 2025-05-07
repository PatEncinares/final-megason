<?php

use App\Http\Controllers\AppointmentController;
use App\Http\Controllers\DoctorController;
use App\Http\Controllers\TransactionsController;

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


Route::post('/signin','SigninController@authenticate')->name('signin');
Route::get('/staff_panel_login', function() {
   return view('auth.staff_login_page'); 
});

Route::post('/staff_signin','SigninController@authenticate_staff_login')->name('staff_signin');

Route::get('/home/validate-otp', function () {
    return view('home_otp'); // Ensure this matches your actual Blade file
})->name('validate-otp');

Route::get('/', function () {
    if(!Auth::check())
    {
        // echo "landingpage";
        return view('landingpage');
    }else{
        return redirect('/home');
    }
});

Route::get('/about', function () {
    
    return view('about');
    
});


Route::get('/contact', function () {
    
    return view('contact');
    
});

Route::get('/services', function() {
    
    return view('services');

});

Auth::routes();


Route::middleware('auth')->group(function () {
    // Routes for authenticated users

    Route::post('/logout', [App\Http\Controllers\Auth\LoginController::class, 'logout'])->name('logout');

    Route::get('/home', 'HomeController@index')->name('home');

    Route::get('/home_dashboard', 'HomeController@overview');
    Route::get('/home/new-otp','HomeController@requestNewOtp')->name('new-otp');
    Route::post('/home/validate-otp','HomeController@validateOTP')->name('validate-otp');

    // Patient Management
    Route::get('/patients-list',"PatientController@index")->name('patients-list');
    Route::get('/patients-list/view/{id}',"PatientController@view")->name('view-patient');
    Route::get('/patients-list/edit/{id}',"PatientController@edit")->name('edit-patient');
    Route::post('/patients-list/update',"PatientController@update")->name('update-patient');
    Route::get('/patients-list/delete/{id}',"PatientController@delete")->name('delete-patient');
    Route::post('/patients-list/delete/{id}',"PatientController@deleteConfirm")->name('delete-patient-confirm');
    Route::get('/patients-list/medical-history/create/{id}','PatientController@createMedicalHistory')->name('create-medical-history');
    Route::post('/patients-list/medical-history/save','PatientController@saveMedicalHistory')->name('save-medical-history');

    Route::get('/userdetails', function(){
        return Auth::user();
    });

    Route::get('/getPatientList', "PatientController@getPatients")->name('get-patient-list');
    


    // Appointment Schedule
    Route::get('/appointments',"AppointmentController@index")->name('appointment');
    Route::get('/appointments/create',"AppointmentController@create")->name('create_appointment');
    Route::post('/appointments/create',"AppointmentController@save")->name('save-appointment');

    Route::get('/appointments/check-availability','AppointmentController@checkAvailability')->name('check-availability');
    Route::post('/appointments/check-availability','AppointmentController@checkSchedule')->name('check-availability');
    Route::post('/saveAppointment',"AppointmentController@saveAppointment")->name('save-appointment');
    Route::get('/get-appointments','AppointmentController@getList')->name('get-appointments');
    Route::get('/appointments/view/{id}','AppointmentController@view')->name('view-appointment');
    Route::get('/appointments/approve/{id}','AppointmentController@approve')->name('approve-appointment');
    Route::get('/appointments/cancel/{id}','AppointmentController@cancel')->name('cancel-appointment');

    Route::get('/profile','PatientController@profile')->name('patient-profile');

    Route::get('/doctor-schedule/{id}', 'AppointmentController@getDoctorSchedule');
    Route::get('/doctor-availability/{doctorId}/{date}', 'AppointmentController@getDoctorAvailability');
    Route::get('/appointments/doctors-by-specialization/{id}', [AppointmentController::class, 'getDoctorsBySpecialization']);



    //doctors
    Route::get('/getDoctorsList', "DoctorController@getDoctors")->name('get-doctor-list');
    Route::get('/doctors-list', "DoctorController@index")->name('doctors-list');
    Route::get('/doctors-list/edit/{id}',"DoctorController@edit")->name('edit-doctor');
    Route::post('/doctors-list/update',"DoctorController@update")->name('update-doctor');
    Route::get('/doctors-list/delete/{id}',"DoctorController@delete")->name('delete-doctor');
    Route::post('/doctors-list/delete',"DoctorController@deleteDoctor")->name('delete-doctor-confirm');

    // lab results
    Route::get('/lab-result/list','LabResultController@getLabResults')->name('lab-results-list');
    Route::get('/lab-result/{id}/{procedure_id}','LabResultController@viewlabResult')->name('view-lab-result');
    Route::get('/lab-result/edit/{id}','LabResultController@editlabResult')->name('edit-lab-result');
    Route::post('/lab-result/update','LabResultController@updateLabResult')->name('update-lab-result');
    Route::get('/lab-result/delete/{id}','LabResultController@deleteLabResult')->name('delete-lab-result');
    Route::get('/create-lab-result','LabResultController@createLabResult')->name('new-lab-result');
    Route::post('/lab-result/save','LabResultController@save')->name('save-lab-result');
    Route::get('/lab-result/attachment/download/{id}','LabResultController@download')->name('download-labresult-attachment');
    Route::post('/lab-result/procedure','LabResultController@procedure')->name('lab-result-procedure');
    Route::post('/lab-result/saveFecalysis','LabResultController@saveFecalysis')->name('save-fecalysis');
    Route::post('/lab-result/saveHematology','LabResultController@saveHematology')->name('save-hematology');
    Route::post('/lab-result/saveUrinalysis','LabResultController@saveUrinalysis')->name('save-urinalysis');
    Route::post('/lab-result/saveXray','LabResultController@saveXray')->name('save-xray');
    Route::post('/lab-result/saveUltrasound','LabResultController@saveUltrasound')->name('save-ultrasound');
    // employees
    Route::get('/employees/list','EmployeeController@getList')->name('get-employees-list');
    Route::get('/employees/timesheet/{id}','EmployeeController@timesheet')->name('employee-timesheet');
    Route::post('/employees/payroll','EmployeeController@savePayroll')->name('save-payroll');
    Route::get('/payroll/{id}','EmployeeController@getPayroll')->name('get-payroll');
    Route::get('/payroll','EmployeeController@payrollList')->name('payroll-list');
    Route::get('/employees/edit-daily-rate/{id}','EmployeeController@editDailyRate')->name('edit-daily-rate');
    Route::post('/employees/edit-daily-rate/save','EmployeeController@saveDailyRate')->name('save-daily-rate');
    Route::get('/employees/time-in','EmployeeController@timeIn')->name('time-in');
    Route::get('/employees/time-out','EmployeeController@timeOut')->name('time-out');

    // category
    Route::get('/category/list','CategoryController@list')->name('get-category-list');
    Route::get('/category/edit/{id}','CategoryController@edit')->name('edit-category');
    Route::post('/category/update','CategoryController@update')->name('update-category');
    Route::get('/category/delete/{id}','CategoryController@delete')->name('delete-category');
    Route::get('/category/create','CategoryController@create')->name('create-category');
    Route::post('/category/save','CategoryController@save')->name('save-category');
    // inventory
    Route::get('/inventory/list','InventoryController@list')->name('get-inventory-list');
    Route::get('/inventory/edit/{id}','InventoryController@edit')->name('edit-inventory');
    Route::post('/inventory/update','InventoryController@update')->name('update-inventory');
    Route::get('/inventory/delete/{id}','InventoryController@delete')->name('delete-inventory');
    Route::get('/inventory/create','InventoryController@create')->name('create-inventory');
    Route::post('/inventory/save','InventoryController@save')->name('save-inventory');
    Route::post('/inventory/saveAddStock','InventoryController@saveAddStock')->name('save-add-stock');
    Route::post('/inventory/savePullOut','InventoryController@savePullOut')->name('save-pull-out');
    Route::get('/inventory/addStock/{id}','InventoryController@addStock')->name('add-stock');
    Route::get('/inventory/pullOut/{id}','InventoryController@pullOut')->name('pull-out');

    // transactions
    Route::get('/transactions/list','TransactionsController@list')->name('get-transactions-list');
    Route::get('/transactions/create','TransactionsController@create')->name('create-transaction');
    Route::post('/transactions/save','TransactionsController@saveTransaction')->name('save-transaction');
    Route::get('/transactions/edit/{id}','TransactionsController@edit')->name('edit-transaction');
    Route::post('/transactions/update','TransactionsController@update')->name('update-transaction');
    Route::get('/transactions/delete/{id}','TransactionsController@delete')->name('delete-transaction');
    // Route::get('/transactions/mark_as_paid/{id}','TransactionsController@markAsPaid')->name('mark-as-paid');
    Route::post('/transactions/mark_as_paid', [TransactionsController::class, 'markAsPaid'])->name('mark-as-paid');

    Route::get('/transactions/view/{id}','TransactionsController@view')->name('view-transaction');
    // accounting
    Route::get('/accounting/financial-report','AccountingController@index')->name('financial-report');
    Route::get('/accounting/daily-earnings-report','AccountingController@dailyEarningsReport')->name('daily-earnings-report');
    // user accounts
    Route::get('/users/list','UsersController@list')->name('user-list');
    Route::get('/users/create','UsersController@create')->name('create-user');
    Route::post('/users/save','UsersController@save')->name('save-user');
    Route::get('/users/edit/{id}','UsersController@edit')->name('edit-user');
    Route::post('/users/update','UsersController@update')->name('update-user');
    Route::get('/users/delete/{id}','UsersController@delete')->name('delete-user');
    Route::get('/users/activity-log','UsersController@getActivities')->name('activity-log');

    // settings
    Route::get('/settings','SettingsController@index')->name('get-settings');
    Route::get('/settings/edit','SettingsController@edit')->name('edit-settings');
    Route::post('/settings/save','SettingsController@save')->name('save-settings');

    //user 
    Route::get('/profile','UsersController@profile')->name('get-profile');
    Route::get('/profile/edit/{id}','UsersController@editProfile')->name('edit-profile');
    Route::get('/profile/update','UsersController@updateProfile')->name('update-profile');
    Route::get('/auth/change-password/{id}','UsersController@changePassword')->name('change-password');
    Route::post('/auth/change-new-password','UsersController@savePassword')->name('save-new-password');

    Route::get('/specialization/list','SpecializationController@list')->name('get-specialization-list');
    Route::get('/specialization/edit/{id}','SpecializationController@edit')->name('edit-specialization');
    Route::post('/specialization/update','SpecializationController@update')->name('update-specialization');
    Route::get('/specialization/delete/{id}','SpecializationController@delete')->name('delete-specialization');
    Route::get('/specialization/create','SpecializationController@create')->name('create-specialization');
    Route::post('/specialization/save','SpecializationController@save')->name('save-specialization');
   
    Route::get('/smstest','HomeController@testSMS')->name('smstest');

    Route::post('/logout', 'Auth\LoginController@logout')->name('logout');

});

