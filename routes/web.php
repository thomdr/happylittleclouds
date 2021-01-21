<?php

use Illuminate\Support\Facades\Route;

Route::get('/', 'HomeController@show')->name('home');
Route::get('/contact', 'ContactController@show')->name('contact.index');
Route::post('/contact', 'ContactController@mail')->name('contact.mail');
Route::get('/tentoonstellingen', 'ExhibitionsController@index')->name('exhibitions.index');
Route::get('/tentoonstellingen/{exhibition}', 'ExhibitionsController@show')->name('exhibitions.show');
Route::get('/meesterwerken', 'MasterworksController@index')->name('masterworks.index');

// * Masterworks
Route::get('/admin/meesterwerken', 'MasterworksController@admin')->name('masterworks.admin')->middleware('auth');
Route::post('/admin/meesterwerken', 'MasterworksController@store')->name('masterworks.store')->middleware('auth');
Route::get('/admin/meesterwerken/create', 'MasterworksController@create')->name('masterworks.create')->middleware('auth');
Route::get('/admin/meesterwerken/{masterwork}', function () {
    return redirect('/admin/meesterwerken');
})->middleware('auth');
Route::put('/admin/meesterwerken/{masterwork}', 'MasterworksController@update')->name('masterworks.update')->middleware('auth');
Route::delete('/admin/meesterwerken/{masterwork}', 'MasterworksController@delete')->name('masterworks.delete')->middleware('auth');
Route::get('/admin/meesterwerken/{masterwork}/edit', 'MasterworksController@edit')->name('masterworks.edit')->middleware('auth');

// * Users
Route::get('/admin/gebruikers', 'UsersController@admin')->name('users.admin')->middleware('auth');
Route::post('/admin/gebruikers', 'UsersController@store')->name('users.store')->middleware('auth');
Route::get('/admin/gebruikers/create', 'UsersController@create')->name('users.create')->middleware('auth');
Route::get('/admin/gebruikers/{user}', function () {
    return redirect('/admin/gebruikers');
})->middleware('auth');
Route::put('/admin/gebruikers/{user}', 'UsersController@update')->name('users.update')->middleware('auth');
Route::delete('/admin/gebruikers/{user}', 'UsersController@delete')->name('users.delete')->middleware('auth');
Route::get('/admin/gebruikers/{user}/edit', 'UsersController@edit')->name('users.edit')->middleware('auth');

// * Exhibitions
Route::get('/admin/tentoonstellingen', 'ExhibitionsController@admin')->name('exhibitions.admin')->middleware('auth');
Route::post('/admin/tentoonstellingen', 'ExhibitionsController@store')->name('exhibitions.store')->middleware('auth');
Route::get('/admin/tentoonstellingen/create', 'ExhibitionsController@create')->name('exhibitions.create')->middleware('auth');
Route::get('/admin/tentoonstellingen/{exhibition}', function () {
    return redirect('/admin/exhibitions');
})->middleware('auth');
Route::put('/admin/tentoonstellingen/{exhibition}', 'ExhibitionsController@update')->name('exhibitions.update')->middleware('auth');
Route::delete('/admin/tentoonstellingen/{exhibition}', 'ExhibitionsController@delete')->name('exhibitions.delete')->middleware('auth');
Route::get('/admin/tentoonstellingen/{exhibition}/edit', 'ExhibitionsController@edit')->name('exhibitions.edit')->middleware('auth');

// * Home
Route::get('/admin/home', 'HomeController@edit')->name('home.edit')->middleware('auth');
Route::put('/admin/home', 'HomeController@update')->name('home.update')->middleware('auth');

// * Contact
Route::get('/admin/contact', 'ContactController@edit')->name('contact.edit')->middleware('auth');
Route::put('/admin/contact', 'ContactController@update')->name('contact.update')->middleware('auth');

// * CKEditor horseshit
Route::get('/ckeditor/browse', 'CKEditorController@browse')->name('ckeditor.browse')->middleware('auth');
Route::delete('/ckeditor/browse', 'CKEditorController@delete')->name('ckeditor.delete')->middleware('auth');
Route::post('/ckeditor/upload', 'CKEditorController@upload')->name('ckeditor.upload')->middleware('auth');

// * Login
Route::get('login', 'Auth\LoginController@showLoginForm')->name('login');
Route::post('login', 'Auth\LoginController@login');
Route::post('logout', 'Auth\LoginController@logout')->name('logout');

// * Chat
Route::post('/chat/visitor/send', 'ChatController@visitorSend')->name('chat.visitor.send');
Route::post('/chat/visitor/retrieve', 'ChatController@retrieveVisitor')->name('chat.visitor.retrieve');
Route::get('/admin/chat', 'ChatController@admin')->name('chat.admin');
Route::get('/admin/chat/{conversation}', 'ChatController@employeeChat')->name('chat.employee.chat');
Route::post('/admin/chat/send', 'ChatController@employeeSend')->name('chat.employee.send');
Route::post('/admin/chat/retrieve', 'ChatController@retrieveEmployee')->name('chat.employee.retrieve');

// * Admin
Route::get('/admin', 'AdminController@index')->name('admin')->middleware('auth');
Route::get('/admin/{page}', 'AdminController@index')->middleware('auth');
