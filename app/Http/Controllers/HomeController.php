<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\Room;
use Illuminate\Http\Request;
use Xendit\Xendit;

class HomeController extends Controller
{

    public function index()
    {
        $user = auth()->user();
        return view('frontend.home', compact('user'));
    }

    public function rooms()
    {
        $rooms = Room::all();
        return view('frontend.rooms', compact('rooms'));
    }

    public function facility(){
        return view('frontend.partials.fasilitas');
    }

    public function contact(){
        return view('frontend.partials.cta');
    }

}
