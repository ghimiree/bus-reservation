<?php

namespace Database\Seeders;

use App\Models\Bus;
use App\Models\Seat;
use Illuminate\Database\Seeder;

class BusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $buses = [
            [
                'name' => 'Highway Deluxe',
                'bus_code' => 'NA 3 KHA 4576',
                'from' => 'KTM ',
                'to' => 'POKHARA',
                'arrival_days' => 'Every day',
                'arrival_time' => '11:00',
                'fare' => '200',
                'driver_name' => 'Sanjeev',
                'status' => '1',
                'seats' => '50',
            ],
            [
                'name' => 'Supreme 12 Deluxe',
                'bus_code' => 'NA 32 KHA 7676',
                'from' => 'CHITWAN',
                'to' => 'KATHMANDU',
                'arrival_days' => 'Every day except sunday',
                'arrival_time' => '12:00',
                'fare' => '300',
                'driver_name' => 'Smith',
                'status' => '1',
                'seats' => '50',
            ],
            [
                'name' => 'Monkai speedy',
                'bus_code' => 'NA 25 KHA 9776',
                'from' => 'MECHI',
                'to' => 'MAHAKALI',
                'arrival_days' => 'Sunday',
                'arrival_time' => '12:00',
                'fare' => '300',
                'driver_name' => 'Rnonny',
                'status' => '1',
                'seats' => '50',
            ],

            [
                'name' => 'Supreme New Deluxe 12',
                'bus_code' => 'NA 67 KHA 9766',
                'from' => 'PALPA',
                'to' => 'SANGJYA',
                'arrival_days' => 'Monday',
                'arrival_time' => '12:00',
                'fare' => '305',
                'driver_name' => 'Michal',
                'status' => '1',
                'seats' => '50',
            ],

            [
                'name' => 'Ment 12 Bull',
                'bus_code' => 'NA 47 KHA 6576',
                'from' => 'CHITWAN',
                'to' => 'POKHARA',
                'arrival_days' => 'Every day',
                'arrival_time' => '12:00',
                'fare' => '255',
                'driver_name' => 'Munic',
                'status' => '1',
                'seats' => '50',
            ],

            [
                'name' => 'Speedy Bus',
                'bus_code' => 'NA 39 KHA 4556',
                'from' => 'CHITWAN',
                'to' => 'POKHARA',
                'arrival_days' => 'Every day',
                'arrival_time' => '12:00',
                'fare' => '345',
                'driver_name' => 'Petty',
                'status' => '1',
                'seats' => '50',
            ],
            [
                'name' => 'Night Bus101',
                'bus_code' => 'NA 3 GHA 4176',
                'from' => 'PALPA',
                'to' => 'SAYNGYA',
                'arrival_days' => 'Every day',
                'arrival_time' => '12:00',
                'fare' => '550',
                'driver_name' => 'Beya',
                'status' => '1',
                'seats' => '50',
            ],
            [
                'name' => 'EveryDay Bus 2',
                'bus_code' => 'NA 47 GHA 4999',
                'from' => 'CHITWAN',
                'to' => 'DHARAN',
                'arrival_days' => 'Everyday',
                'arrival_time' => '12:00',
                'fare' => '235',
                'driver_name' => 'Sush',
                'status' => '1',
                'seats' => '50',
            ],

        ];

        foreach ($buses as $index => $bus) {
            $i = $index + 1;
            $bus = Bus::factory()->create([
                'name' => $bus['name'],
                'bus_code' => $bus['bus_code'],
                'img' =>  'images/bus/' . $i . '.jpg',
                'from' => $bus['from'],
                'to' => $bus['to'],
                'arrival_days' => $bus['arrival_days'],
                'arrival_time' => $bus['arrival_time'],
                'fare' => $bus['fare'],
                'driver_name' => $bus['driver_name'],
                'status' => $bus['status'],
                'seats' => $bus['seats'],
            ]);
            $this->createSeatsForBus($bus);
        }
    }
    private function createSeatsForBus(Bus $bus)
    {
        $totalSeats = $bus->seats;

        for ($seatNumber = 1; $seatNumber <= $totalSeats; $seatNumber++) {
            Seat::factory()->create([
                'bus_id' => $bus->id,
                'seat_number' => $seatNumber,

                // You can add other seat attributes here if needed
            ]);
        }
    }
}
