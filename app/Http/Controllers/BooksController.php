<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Book;
use App\Http\Controllers\Controller;


class BooksController extends Controller {
    public function store(){
        $book = Book::create($this->validateRequest());
        return redirect('/books/' . $book->isbn);
    }
    public function update(Book $book){
        $book->update($this->validateRequest());
        return redirect('/books/' . $book->isbn);
    }
    public function destroy(Book $book){
        $book->delete();
        return redirect('/books');
    }

    //  ...Helpers
    private function validateRequest(){
        return request()->validate([ 'isbn' => 'required', 'title' => 'required' ]);
    }
}

