<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Book;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    /**
     * Display the admin dashboard with key statistics.
     */
    public function dashboard(){

        $userCount = User::count();
        $bookCount = Book::count();
        $recentUsers = User::latest()->take(5)->get();
        $recentBooks = Book::latest()->take(5)->get();
        
        // Additional statistics can be fetched here

        return view('book.admin.dashboard', compact('userCount', 'bookCount', 'recentUsers', 'recentBooks'));
    }
}
