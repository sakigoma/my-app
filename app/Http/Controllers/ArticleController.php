<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class ArticleController extends Controller
{
    public function index() {
        $users = User::all();
        return view('article', compact('users'));
    }
}
