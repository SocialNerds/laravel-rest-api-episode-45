<?php
Route::get('/books', 'BookController@all');
Route::get('/books/{id}', 'BookController@get');

Route::middleware(['auth.basic'])->group(function () {
    Route::post('/books', 'BookController@create');
    Route::delete('/books/{id}', 'BookController@delete');

    Route::get('/favorites', 'FavoritesController@userFavorites');
    Route::get('/favorites/{id}', 'FavoritesController@get');
    Route::post('/favorites', 'FavoritesController@create');
    Route::delete('/favorites/{id}', 'FavoritesController@delete');
});

