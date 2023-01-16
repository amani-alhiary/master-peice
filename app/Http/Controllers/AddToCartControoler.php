<?php

namespace App\Http\Controllers;
use App\Models\Cart;
use App\Models\Book;
use Illuminate\Http\Request;

class AddToCartControoler extends Controller
{
    public function storeStepOne(Request $request)
    {
        $cart = $request->session()->get('cart');
        $validated = $request->validate([
            'book_id' => ['required'],
            // 'user_id' => ['required'],
            'quantity' => ['required'], 
        ]);

        if (empty($request->session()->get('cart'))) {
            $cart = new Cart();
            $cart->fill($validated);
            $request->session()->put('cart', $cart);
        } else {
            $cart = $request->session()->get('cart');
            $cart->fill($validated);
            $request->session()->put('cart', $cart);
        }
        $books = Book::findOrFail($cart['book_id']);
 
        $books = $books->orderByDesc('id')->where('id',$cart['book_id'])->paginate(5);

        // print_r($books);
        return view('pages.cart', compact('cart','books'));  
    }

    
    
}
