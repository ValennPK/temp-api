<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Thermometer;
use App\Models\thermometer_to_testigo;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;

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

        Thermometer::create([
            'username' => 'testigo1',
            'password' => Hash::make('password123'),
            'has_permission' => true
        ]);

        Thermometer::create([
            'username' => 'testigo2',
            'password' => Hash::make('password123'),
            'has_permission' => true
        ]);

        Thermometer::create([
            'username' => 'testigo3',
            'password' => Hash::make('password123'),
            'has_permission' => true
        ]);

        $thermometers = Thermometer::pluck('username');


        foreach ($thermometers as $thermometer) {
            if (!Schema::hasTable($thermometer)) {
                Schema::create($thermometer, function (Blueprint $table) {
                    $table->id();
                    $table->decimal('port1', 6, 3)->nullable();
                    $table->decimal('port2', 6, 3)->nullable();
                    $table->decimal('port3', 6, 3)->nullable();
                    $table->decimal('port4', 6, 3)->nullable();
                    $table->decimal('port5', 6, 3)->nullable();
                    $table->decimal('port6', 6, 3)->nullable();
                    $table->decimal('port7', 6, 3)->nullable();
                    $table->decimal('port8', 6, 3)->nullable();
                    $table->timestamps();
                    $table->softDeletes();
                });
            }
            for ($i = 1; $i <= 10; $i++) {
                DB::table( $thermometer)->insert([
                    'port1' => $i,
                    'port2' => $i,
                    'port3' => $i,
                    'port4' => $i,
                    'port5' => $i,
                    'port6' => $i,
                    'port7' => $i,
                    'port8' => $i,
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }
        }

        thermometer_to_testigo::create([
            'thermometer_id' => 1,
            'testigo_id' => 4
        ]);

        thermometer_to_testigo::create([
            'thermometer_id' => 2,
            'testigo_id' => 5
        ]);

        thermometer_to_testigo::create([
            'thermometer_id' => 3,
            'testigo_id' => 6
        ]);


    }
}
