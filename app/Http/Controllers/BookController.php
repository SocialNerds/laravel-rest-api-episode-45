<?php

namespace App\Http\Controllers;


use App\Http\Resources\BookCollection;
use App\Http\Resources\BookResource;
use App\Models\Book;
use Illuminate\Http\Request;

class BookController
{

    /**
     * Get all books.
     */
    public function all()
    {
        return new BookCollection(Book::paginate(15));
    }

    /**
     * Get a specific book.
     *
     * @param $id
     *
     * @return \App\Http\Resources\BookResource
     */
    public function get($id)
    {
        return new BookResource(Book::find($id));
    }

    /**
     * Create new book.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function create(Request $request)
    {

        $book = new Book(
          [
            'title'       => $request->input('title'),
            'description' => $request->input('description'),
            'isbn'        => $request->input('isbn'),
          ]
        );
        $book->save();

        return (new BookResource($book))
          ->response()
          ->setStatusCode(201);
    }

    /**
     * Delete a book.
     *
     * @param $id
     */
    public function delete($id)
    {
        $book = Book::find($id);

        $book->delete();

        return response('Deleted!', 202);
    }
}