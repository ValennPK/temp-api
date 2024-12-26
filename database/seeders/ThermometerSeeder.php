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
            'username' => 'thermometer1',
            'password' => Hash::make('password123'),
            'has_permission' => true
        ]);

        Thermometer::create([
            'username' => 'thermometer2',
            'password' => Hash::make('password123'),
            'has_permission' => true
        ]);

        Thermometer::create([
            'username' => 'thermometer3',
            'password' => Hash::make('password123'),
            'has_permission' => true
        ]);

        $thermometers = Thermometer::all();

        foreach ($thermometers as $thermometer) {
            TableService::thermometerTableCheck($thermometer);
            TableService::setpointRegisterCheck($thermometer);
            for ($i = 0; $i < 10; $i++) {
                StoreService::seederTemperature($thermometer, $i);
            }
        }

    }
}
