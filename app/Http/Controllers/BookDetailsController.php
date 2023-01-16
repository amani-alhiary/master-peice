<?php

namespace App\Http\Controllers;
use App\Models\Book;
use Illuminate\Http\Request;

class BookDetailsController extends Controller
{

    public function show(Request $request)
    {
        $books = Book::findOrFail($request['id']);
        
        $book = $books->orderByDesc('id')->where('id',$request['id'])->paginate(5);
        $realtedbooks = $books->where('category_id',$book[0]->category_id)->paginate(6);
        // print_r($realtedbooks);
        return view('pages.bookdetails', compact('book','realtedbooks'));

        }
}
