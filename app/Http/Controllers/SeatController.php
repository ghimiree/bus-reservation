<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Seat;

class SeatController extends Controller
{
    public function showSeats()
    {
        $seats = Seat::all();
        return view('seats', compact('seats'));
    }
}
