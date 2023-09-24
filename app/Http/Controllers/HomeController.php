<?php

namespace App\Http\Controllers;

use App\Models\Bus;
use App\Models\Seat;
use Illuminate\Http\Request;

class HomeController extends Controller
{
  public function index()
  {
    $buses = Bus::latest()->take(4)->get();
    return view('home.index')->with([
      'buses' => $buses
    ]);
  }

  public function search(Request $request)
  {
    if ($request->arrivalLocation && $request->destination && $request->arrivalDays) {
      $data = Bus::where([
        ['from', 'LIKE', '%' . $request->arrivalLocation . '%'],
        ['to', 'LIKE', '%' . $request->destination . '%'],
        ['arrival_days', 'LIKE', '%' . $request->arrivalDays . '%'],
      ]);
    } else if ($request->q) {
      $data = Bus::where('name', 'LIKE', '%' . $request->q . '%');
    } else if ($request->arrivalDays) {
      $data = Bus::where('arrival_days', 'LIKE', '%' . $request->arrivalDays . '%');
    } else if ($request->arrivalLocation) {
      $data = Bus::where('from', 'LIKE', '%' . $request->arrivalLocation . '%');
    } else {
      $data = Bus::latest();
    }
    $arrivalLocations = Bus::take(20)->get(['from']);
    $buses = $data->paginate(6);
    return view('home.list', compact('buses', 'arrivalLocations'));
  }

  public function show(Bus $bus)
  {

    $seats = $bus->seats()->orderBy('seat_number')->get();

    // You can adjust the number of rows and columns as per your bus layout
    $rows = 0;
    $columns = 4;

    // Organize the seats into rows and columns
    $arrangedSeats = [];
    $currentRow = 1;
    foreach ($seats as $seat) {
      $arrangedSeats[$currentRow][] = $seat;
      if (count($arrangedSeats[$currentRow]) >= $columns) {
        $currentRow++;
      }
    }

    // Get all seats associated with the bus

    return view('home.show', compact('bus', 'arrangedSeats'));
  }
}
