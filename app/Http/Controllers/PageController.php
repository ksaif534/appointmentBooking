<?php

namespace App\Http\Controllers;

use App\Models\Service;
use Illuminate\Http\Request;

class PageController extends Controller
{
    public function home()
    {
        return view('home');
    }

    public function about()
    {
        return view('about');
    }

    public function services()
    {
        $services = Service::where('is_active', true)->get();
        return view('services', compact('services'));
    }
}
