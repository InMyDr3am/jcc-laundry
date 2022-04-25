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

Route::get('/', function () {
    return view('auth.login');
});

Route::resource('role_user', 'RoleUserController')->middleware('cek_role');
Route::resource('user', 'UserController')->middleware('cek_role');

Route::group(['middleware' => ['auth']], function () {

    Route::resource('penyucian', 'PenyucianController');
    Route::resource('detail_penyucian', 'DetailPenyucianController');
    Route::get('/penyucian/{id}/tambah', 'PenyucianController@tambah');
    Route::post('/penyucian/simpan', 'PenyucianController@simpan');
    Route::get('/export-penyucian/toExcel', 'PenyucianController@toExcel');
    Route::get('/export-penyucian/{id}/toPDF', 'PenyucianController@toPDF');

    Route::get('/jenis_cuci', 'JenisController@index');
    Route::get('/jenis_cuci/tambah', 'JenisController@tambah');
    Route::post('/jenis_cuci/store', 'JenisController@store');
    Route::get('/jenis_cuci/edit/{id}', 'JenisController@edit');
    Route::put('/jenis_cuci/update/{id}', 'JenisController@update');
    Route::get('/jenis_cuci/hapus/{id}', 'JenisController@hapus');
    Route::get('/jenis_cuci/toexcel', 'JenisController@toExcel');

    Route::get('/pendapatan', 'PendapatanController@index');
    Route::get('/pendapatan-today', 'PendapatanController@pendapatantoday');
    Route::get('/pendapatan/{tanggal}', 'PendapatanController@show');
    Route::get('/export-pendapatan/toExcel', 'PendapatanController@toExcel');
    Route::get('/export-pendapatan/todaytoExcel', 'PendapatanController@todaytoExcel');

    Route::get('/home', 'HomeController@index')->name('home');
});

Auth::routes();
