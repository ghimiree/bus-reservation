<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Bus;
use App\Models\Reservation;
use RealRashid\SweetAlert\Facades\Alert;
use Yajra\DataTables\DataTables;

class AdminController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function dashboard()
    {
        $reservations = Reservation::all();
        $earnings = 0;
        foreach ($reservations as $reservation) {
            $earnings += $reservation->bus->fare;
        }
        $busCount = Bus::count();
        $pendingCount = auth()->user()->notifications->count();
        return view('admin.dashboard')->with([
            'earnings' => $earnings,
            'busCount' => $busCount,
            'pendingCount' => $pendingCount
        ]);
    }

    public function download($earnings)
    {
        return response()->download(public_path('assets/' . $earnings));
    }


    public function buses()
    {
        return view('admin.buses');
    }
    public function notifications()
    {
        $user = auth()->user();
        return $user->notifications;
    }
    public function unreadNotifications()
    {
        $user = auth()->user();
        return $user->unreadNotifications;
    }
    public function readNotifications()
    {
        $user = auth()->user();
        return $user->readNotifications;
    }
}
