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
Auth::routes(['reset'=>false]);
Route::get('/', function () {
    return view('auth.login');
});

Route::get('/home', 'HomeController@index')->name('home');



Route::get('raport', function () { return view('raport'); })->middleware('checkRole:Admin,kurikulum,siswa,walas');
// Route::get('hubin','HubinController@index')->name('hubin')->middleware(['checkRole:admin']);


// ADMIN
Route::get('/admin', 'HomeController@admin')->name('admin.home')->middleware(['checkRole:Admin']);

// Data Master (Admin)

// Siswa 
Route::resource('/siswa', 'SiswaController')->middleware(['checkRole:Admin']);
Route::get('/siswa-show={id}', 'SiswaController@show')->name('siswa.show')->middleware(['checkRole:Admin']);
Route::get('/siswa-detail={id}', 'SiswaController@detail')->name('siswa.detail')->middleware(['checkRole:Admin']);


// Kelas
Route::resource('/kelas', 'KelasController')->middleware(['checkRole:Admin']);

// Mapel
Route::resource('/mapel', 'MapelController')->middleware(['checkRole:Admin']);

// Guru
Route::resource('/guru', 'GuruController')->middleware(['checkRole:Admin']);
Route::get('/guru-jabatan={jabatan}', 'GuruController@detail')->name('guru.detail')->middleware(['checkRole:Admin']);
// Route::get('siswa', function () { return view('siswa'); });

// Modul Adm Guru

// KD
Route::resource('/KD', 'KDController')->middleware(['checkRole:Admin,Guru,Siswa']);
Route::get('/KD={guru_id}', 'KDController@detail')->name('KD.detail')->middleware(['checkRole:Admin,Guru,Siswa']);
Route::get('/kpdf/guru={guru_id}', 'KDController@cetak_pdf')->name('KD.print')->middleware(['checkRole:Admin,Guru,Siswa']);
// Route::middleware(['auth'])->group(function () {
//     Route::middleware(['checkRole:Admin'])->group(function () {
//     Route::resource('/siswa', 'SiswaController');
//   });
// });
