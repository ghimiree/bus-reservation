<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Bus;
use App\Models\Reservation;
use Illuminate\Support\Facades\Date;
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
        $reservations = Reservation::whereYear('created_at', date('Y'))->get();
        $yerlyEarnings = 0;
        foreach ($reservations as $reservation) {
            $yerlyEarnings += $reservation->bus->fare;
        }
        $reservations = Reservation::whereYear('created_at', date('Y'))->whereMonth('created_at', date('m'))->get();
        $monthlyEarnings = 0;
        foreach ($reservations as $reservation) {
            $monthlyEarnings += $reservation->bus->fare;
        }
        $busCount = Bus::count();
        $pendingCount = auth()->user()->unreadNotifications->count();

        $weeklyReservations = Reservation::with('bus')
        ->selectRaw('sum(buses.fare) as total, DAYNAME(reservations.created_at) as day')
        ->join('buses', 'reservations.bus_id', '=', 'buses.id')
        ->groupBy('day')
        ->orderBy('day')
        ->get();

        $weeklyReservations = collect([
            ['day' => 'Monday', 'total' => 0],
            ['day' => 'Tuesday', 'total' => 0],
            ['day' => 'Wednesday', 'total' => 0],
            ['day' => 'Thursday', 'total' => 0],
            ['day' => 'Friday', 'total' => 0],
            ['day' => 'Saturday', 'total' => 0],
            ['day' => 'Sunday', 'total' => 0],
        ])->map(function ($day) use ($weeklyReservations) {
            $day['total'] = floor($weeklyReservations->where('day', $day['day'])->first()->total ?? 0);
            return $day;
        });

        return view('admin.dashboard')->with([
            'yearly_earnings' => $yerlyEarnings,
            'monthly_earnings' => $monthlyEarnings,
            'busCount' => $busCount,
            'pendingCount' => $pendingCount,
            'weeklyReservations' => $weeklyReservations
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
        return $user->notification;
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
