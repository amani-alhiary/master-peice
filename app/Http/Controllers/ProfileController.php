<?php

namespace App\Http\Controllers;
use App\Models\Category;
use App\Models\User;

use App\Models\UserBook;
use App\Http\Controllers\Auth;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    public function index(Request $request)
    {

        $categories = Category::orderBy('id','desc')->paginate(10);
        $userid= User::findOrFail($request['id']) ;
        $books = UserBook::orderBy('id','desc')->where('user_id',$userid['id'])->paginate(20);
        // print_r($books);
        return view('pages.profile.profile', compact('categories','books'));
    }
}
