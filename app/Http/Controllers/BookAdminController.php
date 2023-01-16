<?php

namespace App\Http\Controllers;
use App\Models\Book;
use App\Models\Category;

use Illuminate\Http\Request;

class BookAdminController extends Controller
{
    public function index()
    {
         $books = Book::orderBy('id','desc')->paginate(5);
         $categories = Category::orderBy('id','desc')->paginate(5);

        return view('admin.books.index', compact('books', 'categories'));
    }

    /**
    * Display the specified resource.
    *
    * @param  \App\Book  $movie
    * @return \Illuminate\Http\Response
    */
    public function show(Request $request)
    {
        $book = Book::find($request->id)->where('id',$request->id)->paginate(5);
 
        return view('admin.books.details', compact('book'));

        }



        
      /**
    * Show the form for editing the specified resource.
    *
    * @param  \App\Book  $book
    * @return \Illuminate\Http\Response
    */

    public function edit(Request $request)
    {
        $book = Book::find($request->id)->where('id',$request->id)->paginate(5);
        $categories = Category::orderBy('id','desc')->paginate(5);

        return view('admin.books.edit',compact('book','categories'));
    }


      /**
    * Update the specified resource in storage.
    *
    * @param  \Illuminate\Http\Request  $request
    * @param  \App\Category  $movie
    * @return \Illuminate\Http\Response
    */
    public function update(Request $request, Category $category)
    {
        $request->validate([
            'book_name' => 'required',
            'author' => 'required',
            'quote' => 'required',
            'description' => 'required',
            'price' => 'required',
            'category_id' => 'required',
            'sale_price' => 'required',
            'video' => 'required',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:3048',
            'image_01' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:3048',
            'image_02' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:3048',
            'image_03' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:3048',

    
          
        ]);
        $input = $request->all();
        // $category->fill($input)->save();
        Book::create($input);

        return redirect()->route('categories.index')->with('success','category Has Been updated successfully');
    }

}
