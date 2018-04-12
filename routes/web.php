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

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/',function(){
	return view('index');
});

Route::get('/laporan',function(){
	return view('laporan');
});

Route::get('/survey',function(){
	return view('survey');
});
// Route::get('/survey/search',function(){
//   var keyword = req.body.s;
//   var resRef = penduduk.where("nama_lengkap",keyword);
// 	return view('survey',{keyword:keyword,resident:resident});
// });

Route::get('/login',function(){
	return view('login');
});

Route::get('/analitik',function(){
	return view('analitik');
});

Route::get('/cari',function(){
  // return view('cari');
	return view('search');
});

Route::get('/rt/{provinsi}/{kota}/{kecamatan}/{kelurahan}/{rw}/{rt}',function($provinsi,$kota,$kecamatan,$kelurahan,$rw,$rt){
	return view('rt',['provinsi'=>$provinsi,'kota'=>$kota,'kecamatan'=>$kecamatan,'kelurahan'=>$kelurahan,'rw'=>$rw,'rt'=>$rt]);
});

Route::get('/rw/{provinsi}/{kota}/{kecamatan}/{kelurahan}/{rw}',function($provinsi,$kota,$kecamatan,$kelurahan,$rw){
	return view('rw',['provinsi'=>$provinsi,'kota'=>$kota,'kecamatan'=>$kecamatan,'kelurahan'=>$kelurahan,'rw'=>$rw]);
});

Route::get('/kelurahan/{provinsi}/{kota}/{kecamatan}/{kelurahan}',function($provinsi,$kota,$kecamatan,$kelurahan){
	return view('kel',['provinsi'=>$provinsi,'kota'=>$kota,'kecamatan'=>$kecamatan,'kelurahan'=>$kelurahan]);
});

Route::get('/kecamatan/{provinsi}/{kota}/{kecamatan}',function($provinsi,$kota,$kecamatan){
	return view('kec',['provinsi'=>$provinsi,'kota'=>$kota,'kecamatan'=>$kecamatan]);
});

Route::get('/kota/{provinsi}/{kota}',function($provinsi,$kota){
	return view('kota',['provinsi'=>$provinsi,'kota'=>$kota]);
});

Route::get('/provinsi/{provinsi}',function($provinsi){
	return view('prov',['provinsi'=>$provinsi]);
});

Route::get('/penduduk',function(){
	return view('penduduk');
});

Route::get('/penduduk-create',function(){
	return view('penduduk-create');
});

Route::get('/penduduk-detail/{id}',function($id){
	return view('penduduk-detail',['id'=>$id]);
});

Route::get('/penduduk-edit/{id}',function($id){
	return view('penduduk-edit',['id'=>$id]);
});

Route::get('/profile',function(){
  return view('profile');
});

Route::get('/profile-edit',function(){
  return view('profile-edit');
});

Route::get('/profile/change-password',function(){
  return view('change-password');
});


Route::get('/anggota-detail/{kkId}/{id}',function($kkId,$id){
	return view('anggota-detail',['kkId'=>$kkId,'id'=>$id]);
});

Route::get('/anggota-edit/{kkId}/{id}',function($kkId,$id){
	return view('anggota-edit',['kkId'=>$kkId,'id'=>$id]);
});

Route::get('/anggota-create/{kkId}',function($kkId){
	return view('anggota-create',['kkId'=>$kkId]);
});

Route::get('/user',function(){
	return view('user');
});

Route::get('/user-detail',function(){
	return view('user-detail');
});

Route::get('/user-editor',function(){
	return view('user-editor');
});
Route::get('/slum',function(){
	return view('slum');
});
Route::get('/slum-create',function(){
	return view('slum-create');
});
Route::get('/slum-detail/{id}',function($id){
	return view('slum-detail',['id'=>$id]);
});
Route::get('/slum-edit/{id}',function($id){
	return view('slum-edit',['id'=>$id]);
});
Route::get('/slum-history/{prov}/{kota}/{kec}',function($prov,$kota,$kec){
	return view('slum-history',['prov'=>$prov,'kota'=>$kota,'kec'=>$kec]);
});
Route::get('getpenduduk/{nik}', 'ApiController@getDataPenduduk');