<?php

namespace App\Http\Controllers;


use App\Http\Resources\BookCollection;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FavoritesController
{

    /**
     * Get current user favorites list.
     *
     * @return \App\Http\Resources\BookCollection
     */
    public function userFavorites()
    {
        return new BookCollection(Auth::user()->favorites()->paginate(15));
    }

    /**
     * Add a book to favorites list.
     */
    public function create(Request $request)
    {
        Auth::user()->favorites()->attach([$request->input('id')]);
        return response('Added!', 201);
    }

    /**
     * Get specific user favorites list.
     *
     * @param $id
     *
     * @return \App\Http\Resources\BookCollection
     */
    public function get($id) {
        return new BookCollection(User::find($id)->favorites);
    }

    /**
     * Delete a book from favorites list.
     */
    public function delete($id)
    {
        Auth::user()->favorites()->detach([$id]);

        return response('Deleted!', 202);
    }

}