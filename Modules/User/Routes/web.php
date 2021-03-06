<?php
// use App\Http\Controllers\PDFController;
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

Route::prefix('user')->middleware('checkLoginUser')->group(function() {
    Route::get('/', 'UserDashboardController@index')->name('get_user.dashboard');
    Route::post('/', 'UserDashboardController@replaceOrder')->name('get_user.replaceOrder');
    Route::get('transaction', 'UserTransactionController@index')->name('get_user.transaction');

    Route::group(['prefix' => 'transaction'], function(){
        Route::get('/', 'UserTransactionController@index')->name('get_user.transaction');
        Route::get('{idTransaction}/view', 'UserTransactionController@viewTransaction')->name('get_user.transaction.view');
        Route::get('{idTransaction}/view/course/{idCourse}', 'UserCourseByOrderController@viewCourse')->name('get_user.transaction.view_course');
        Route::get('{idTransaction}/view/course/vote/{idCourse}', 'UserVoteController@vote')->name('get_user.transaction.vote');
        Route::post('{idTransaction}/view/course/vote/{idCourse}', 'UserVoteController@storeVote');
    });
    Route::get('favourite', 'UserFavouriteController@index')->name('get_user.favourite');
    Route::get('info', 'UserInfoController@index')->name('get_user.info');
    Route::get('info/edit/{id}', 'UserInfoController@edit')->name('get_user.info.edit');
    Route::post('info/edit/{id}', 'UserInfoController@update');

    Route::prefix('cart')->group(function (){
        Route::post('save/{type}', 'UserPayController@processPayCart')->name('post_user.cart.pay');
        Route::get('{id}/{type}/add', 'UserShoppingCartController@processCart')->name('get_user.cart.add');
    });
    Route::prefix('favourite')->group(function (){
        Route::post('save/{type}', 'UserPayController@processPayCart')->name('post_user.cart.pay');
        Route::post('{id}/{type}/add', 'UserFavouriteController@processFavourite')->name('get_user.favourite.add');
    });

    Route::prefix('jobs')->group(function (){
        Route::get('/', 'UserJobsController@index')->name('get_user.jobs');
        Route::get('/addjob', 'UserJobsController@create')->name('get_user.addjobs');
        Route::post('/addjob', 'UserJobsController@addJobs');
        Route::get('/editjob/{id}', 'UserJobsController@edit')->name('get_user.editJobs');
        Route::post('/editjob/{id}', 'UserJobsController@update');
        Route::get('/{id}', 'UserJobsController@delete')->name('get_user.delete');
    });
});

Route::middleware('checkLoginUser')->group(function() {
    Route::get('thanh-toan.html', 'UserPayController@getPay')->name('get_user.pay');
    Route::post('thanh-toan.html', 'UserPayController@popupGuide')->name('get_user.popupGuide');
    Route::get('hoan-tat-don-hang.html', 'UserPayController@getPaySuccsess')->name('get_user.paysuccsess');
    Route::get('gio-hang.html', 'UserCartController@index')->name('get_user.cart');
    Route::get('xoa-san-pham/{id}', 'UserCartController@deletecart')->name('get_user.deletecart');
    Route::get('in-pdf.html', 'UserCartController@generatePDF')->name('get_user.generatePDF');
    Route::post('in-pdf.html', 'UserCartController@viewPDF');
    Route::get('down-pdf.html', 'UserCartController@downPDF')->name('get_user.downPDF');
    // Route::post('down-pdf.html', 'UserCartController@downF');
    // Route::post('down-pdf.html', 'UserCartController@downPDF');
    // Route::post('in-pdf.html', 'UserCartController@downloadPDF');
});


