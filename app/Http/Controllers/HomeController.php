<?php

namespace App\Http\Controllers;

use App\Models\Internships;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index(){
        $totalPemagang = Internships::where('status', 'active')->count();

        return view('homepage', compact('totalPemagang'));
    }
}
