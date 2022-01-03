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

// 一般ユーザー
Route::group(['middleware' => ['guest']], function () {
    
    // プレビューした瞬間の設定
    Route::get('/', 'ToppagesController@index');
    // ログイン認証系
    Route::get('login', 'Auth\LoginController@showLoginForm')->name('login');
    Route::post('login', 'Auth\LoginController@login')->name('login.post');
    // ユーザ登録系
    Route::get('signup', 'Auth\RegisterController@showRegistrationForm')->name('signup.get');
    Route::post('signup', 'Auth\RegisterController@register')->name('signup.post');

});

// ユーザー認証必要
Route::group(['middleware' => ['auth']], function () {
    
    // ログイン後のリダイレクト先
    Route::get('top', function () {
         return view('top');
    });
    
    // ログアウト
    Route::get('logout', 'Auth\LoginController@logout')->name('logout.get');
    
   //かな順に顧客一覧を並び替え
    Route::get('customers/order_by_kana', 'CustomersController@order_by_kana')->name('customers.order_by_kana');
    
    // 顧客関係
    Route::resource('customers', 'CustomersController');
    
    // 顧客削除
    Route::put('customers/{customer}/delete', 'CustomersController@delete')->name('customers.delete');
    //顧客削除解除
    Route::put('customers/{customer}/undelete', 'CustomersController@undelete')->name('customers.undelete');
    //削除顧客一覧
    Route::get('del_customers', 'CustomersController@deletes')->name('customers.deletes');
    
    //お気に入り
    Route::put('customers/{customer}/favorite', 'CustomersController@favorite')->name('customers.favorite');
    //お気に入り解除
    Route::put('customers/{customer}/unfavorite', 'CustomersController@unfavorite')->name('customers.unfavorite');
    //お気に入り顧客一覧取得
    Route::get('favorites', 'CustomersController@favorites')->name('customers.favorites');


    
    // 記録関係
    Route::resource('records', 'RecordsController');
    
    // 顧客表示フラグ関係
    Route::resource('flags', 'FlagsController');
    
    // 顧客検索
    Route::get('search_customers', 'CustomersController@search')->name('customers.search');
    Route::get('searchFav_customers', 'CustomersController@searchFav')->name('customers.searchFav');
    Route::get('searchDel_customers', 'CustomersController@searchDel')->name('customers.searchDel');
    
    // カレンダー
    Route::get('get_calendar', 'RecordsController@get_calendar');
    Route::get('create_record_from_calendar', 'RecordsController@create_record_from_calendar');


});

