<?php
     
        Route::post(('/admin/login'), '\App\Http\Controllers\Auth\AuthController@login')
        ->name('loginn');
        Route::get(('/statsClient'), 'UserController@statsClient')
        ->name('client.stats');
        
        Route::get(('/statsDeliveryMan'), 'UserController@statsDeliveryMan')
        ->name('stats.DeliveryMan');
        
        Route::get(('/statsReports'), 'ReclamationController@ReportStats')
        ->name('stats.statsReports');
        
        Route::get(('/parcelStats'), 'ParcelController@parcelStats')
        ->name('parcel.Stats');
Route::group(
    ['middleware' => 'auth.jwt'],
    function () {
        Route::group(
            [
                'middleware' => 'Admin',
                'prefix' =>'admin',
                'as' => 'admin.',
            ],
            function () {
                /**
                 * Models Count : dashboard view
                 */
                Route::get(('/clientNumber'), '\App\Http\Controllers\UserController@clientCount')
                    ->name('clientCount');
                Route::get(('/DeliveryManNumber'), '\App\Http\Controllers\UserController@DeliveryManCount')
                    ->name('DeliveryManCount');
                Route::get(('/reclamationCount'), '\App\Http\Controllers\ReclamationController@ReclamationNumber')
                    ->name('ReclamationCount');
                Route::get(('/ParcelNumber'), '\App\Http\Controllers\ParcelController@ParcelNumber')
                    ->name('ParcelCount');
                /*
                 * chart API
                 */
          


                /**
                 * administration : view
                 */
                Route::delete(('/user/{id}'), 'UserController@destroy')
                    ->name('users.delete');
                Route::get(('/client'), '\App\Http\Controllers\UserController@client')
                    ->name('admin.index'); // Rename : client : index 
                    
                Route::get(('/deliveryMan'), '\App\Http\Controllers\UserController@deliveryMan')
                    ->name('admin.getAllDeliveryMan');
              
                Route::post(('/DeliveryManRequest/{id}'), 'UserController@DeliveryManRegistrationResponse')
                    ->name('deliveryMan.registrationResponse');
                Route::get(('/deliveryManRegistrationRequest'), '\App\Http\Controllers\UserController@registrationRequest')
                    ->name('admin.registrationRequest');
                
                /**
                 * Listes des colis : view
                 *
                 */
                Route::get('/parcels', '\App\Http\Controllers\ParcelController@getAllAdmin')
                    ->name('admin.getAllParcels');
                /**
                 * Listes des reclamation view
                 */
                Route::get('/reclamation', '\App\Http\Controllers\ReclamationController@index')
                    ->name('admin.getAllReclamations');
  
                 Route::get(('/user'), 'UserController@index')
                    ->name('users.index');
                  Route::get(('/me'), 'UserController@ConnectedUser')
                    ->name('user.me');
                Route::get(('/user/{id}'), '\App\Http\Controllers\UserController@show')
                    ->name('users.show');

               Route::get('/parcel/{id}/reclamation/{rec_id}', '\App\Http\Controllers\ReclamationController@show')
                    ->name('admin.showDetailReclamation');
                Route::post('/parcel/{id}/reclamation', '\App\Http\Controllers\ReclamationController@store')
                    ->name('admin.CreateReclamation');

            }
        );
    }
);
