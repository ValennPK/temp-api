<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Thermometer;
use Illuminate\Support\Facades\Hash;
use app\Services\TableService;
use app\Services\StoreService;
use Illuminate\Contracts\Cache\Store;

class ThermometerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Thermometer::create([
            'name' => 'Thermometer 1',
            'username' => 'thermometer1',
            'password' => Hash::make('password123'),
            'location' => 'Location 1',
            'has_permission' => true
        ]);

        Thermometer::create([
            'name' => 'Thermometer 2',
            'username' => 'thermometer2',
            'password' => Hash::make('password123'),
            'location' => 'Location 2',
            'has_permission' => true
        ]);

        Thermometer::create([
            'name' => 'Thermometer 3',
            'username' => 'thermometer3',
            'password' => Hash::make('password123'),
            'location' => 'Location 3',
            'has_permission' => true
        ]);

        $thermometers = Thermometer::all();

        foreach ($thermometers as $thermometer) {
            TableService::thermometerTableCheck($thermometer);
            TableService::setpointRegisterCheck($thermometer);
            for ($i = 0; $i < 24; $i++) {
                $json = json_encode($i);
                StoreService::seederTemperature($thermometer, $i);
            }
        }

    }
}
