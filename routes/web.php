<?php

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

Route::get('/', 'DepartmentController@getDepartment')->name('get.department');
Route::post('/createdepartment', 'DepartmentController@createDepartment')->name('create');
Route::get('/deletedepartment/{department_id}','DepartmentController@getdeletedepartment')->name('department.delete');
Route::post('/edit','DepartmentController@posteditdepartment')->name('edit');
Route::get('/departments/{department}/employees', 'EmployeeController@getEmployees')->name('get.employees');
Route::post('/departments/{department}/createemployee', 'EmployeeController@createEmployee')->name('create.employee');
Route::post('/editemployee','EmployeeController@posteditEmployee')->name('edit.employee');
Route::get('/deleteemployee/{employee_id}','EmployeeController@getdeleteemployee')->name('employee.delete');