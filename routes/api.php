<?php

use Illuminate\Http\Request;

/**
 *   API
 */
Route::middleware('cors')->group(function (){
});

Route::post(('/user/login'), '\App\Http\Controllers\Auth\AuthController@login')
    ->name('login');
Route::post(('/user/register'), '\App\Http\Controllers\Auth\AuthController@register')
    ->name('register');
    Route::post(('/message'),'MessageController@sentMessage');

Route::get(('/message'),'MessageController@fetchMessages');
Route::get(('/des'),'MessageController@discusion');
Route::post(('/track'),'LocationController@sentLocation');
Route::group(
    ['middleware' => 'auth.jwt'],
    function () {
        Route::group(
            [
                'middleware' => 'DeliveryMan',
                'prefix'  =>'deliveryMan',
                'as' => 'DeliveryMan',
            ],
            function () {
                Route::post(('/request'), '\App\Http\Controllers\DeliveryManParcelsController@sendRequest')
                 ->name('sendRequest');
                Route::get(('/request'), '\App\Http\Controllers\DeliveryManParcelsController@GetRequest')
                    ->name('GetRequest');


                Route::delete(('/request'), '\App\Http\Controllers\DeliveryManParcelsController@CancelRequest')
                    ->name('CancelRequest');

                Route::put('/parcelDone/{id}', '\App\Http\Controllers\ParcelController@Done')
                    ->name('parcelDone');
                    Route::put('/parcel/{id}', '\App\Http\Controllers\ParcelController@ParcelToPick')
                    ->name('TakeParcel');

                Route::get('/parcels', '\App\Http\Controllers\ParcelController@getAll')
                    ->name('DeliveryParcel');
                Route::get('/parcel/{id} ', '\App\Http\Controllers\ParcelController@DeliveryParcel')
                    ->name('detailsparcel');
                Route::get('/parcels/{id} ', '\App\Http\Controllers\ParcelController@show')
                    ->name('detailsparcels');
                Route::get('/parcel', '\App\Http\Controllers\ParcelController@DeliveryParcel')
                    ->name('getUserParcels');
                Route::post('/DeliveryMAnInfo', '\App\Http\Controllers\DeliveryMAnInfoController@store')
                    ->name('storeDL_info');
                    Route::post(
                        '/parcel/{id}/reclamation','ReclamationController@store')
                        ->name('CreateReclamationcLivreur');

                        Route::post('/notification/{client_id}/{distance}','\App\Http\Controllers\ParcelController@SendInClose')
                        ->name('SendInClose');


                    }
        );



          Route::get('/parcels','\App\Http\Controllers\ParcelController@getAll')
                    ->name('getAllParcel');
        Route::put(('/user/profil/{id}'), '\App\Http\Controllers\UserController@update')
            ->name('update');
                    Route::post(
                        '/parcel/{id}/reclamation','ReclamationController@store')
                        ->name('CreateReclamationcLivreur');
Route::get(('/dess'),'MessageController@discusion');

        Route::group(
            [
                'middleware' => 'Client',
                'prefix'  =>'client',
                'as' => 'Client',
            ],
            function () {
                Route::put('/parcel/{id}/{delivery_man_id}', '\App\Http\Controllers\ParcelController@ParcelToPick')
                ->name('TakeParcels');

                Route::get(('/showProfils'), '\App\Http\Controllers\DeliveryManParcelsController@showProfils')
                ->name('showProfils');
               Route::get('/parcel', '\App\Http\Controllers\ParcelController@index')
                    ->name('getUserParcel');
                Route::post('/parcel','\App\Http\Controllers\ParcelController@store')
                    ->name('CreateParcel');
                    Route::put('/parcel/{id}','\App\Http\Controllers\ParcelController@update')
                    ->name('updateParcel');
                Route::put('/parcelReady/{id}/{IDoperation}/{Scanner}', '\App\Http\Controllers\ParcelController@active')
                    ->name('parcelReady');

                Route::get('/parcel/{id}','\App\Http\Controllers\ParcelController@show')
                    ->name('detailsparcel');
                Route::post(
                    '/parcel/{id}/reclamation','ReclamationController@store')
                    ->name('CreateReclamationc');
                Route::put(
                    '/parcel/{id}/reclamation/{rec_id}','ReclamationController@showDetail')
                    ->name('CreateReclamationc');
                Route::get(
                    '/parcel/{id}/reclamation','ReclamationController@show')
                    ->name('clientParcelReclamation');
            }
        );
        Route::post('/user/logout', '\App\Http\Controllers\Auth\AuthController@logout')->name('logout');
    }
);

