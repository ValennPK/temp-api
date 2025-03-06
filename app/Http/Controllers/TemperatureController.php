<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use App\Services\TableService;
use App\models\Thermometer;
// use App\models\ThermometerToTestigo;

use App\Services\StoreService;

class TemperatureController extends Controller
{
    public function store(Request $request, $ThermometerName)
    {

        TableService::thermometerTableCheck($ThermometerName);

        TableService::setpointRegisterCheck($ThermometerName);

        StoreService::storeTemperature($ThermometerName, $request);

        return response()->json(['message'=>'Temperature stored successfully'], 201);
    }

    public function mass_store(Request $request, $ThermometerName)
    {

        TableService::thermometerTableCheck($ThermometerName);

        TableService::setpointRegisterCheck($ThermometerName);

        StoreService::storeMassTemperature($ThermometerName, $request);

        return response()->json(['message'=>'Multiple temperature stored successfully'], 201);
    }

    public function store_testigo(Request $request, $ThermometerName)
    {
        TableService::thermometerTableCheck($ThermometerName);

        StoreService::storeTemperature($ThermometerName, $request);

        return response()->json(['message'=>'Temperature stored successfully'], 201);
    }

    public function index_testigo($ThermometerName){
        $thermometer_id = Thermometer::where('username', $ThermometerName)->first()->id;
        // return $thermometer_id;
        $testigo_id = DB::table('thermometer_to_testigos')->where('thermometer_id', $thermometer_id)->first()->testigo_id;
        return $testigo_id;
        $testigo_name = Thermometer::where('id', $testigo_id)->first()->username;
        $lastTemp = DB::table($testigo_name)->latest('created_at')->get("port1")->first();

        if (!$lastTemp) {
            return response()->json(['message' => 'No data found'], 404);
        }
        
        return $lastTemp;
    }

    public function index($ThermometerName, $days)
    {
        if (!Schema::hasTable($ThermometerName)) {
            return response()->json(['message' => 'La tabla no existe'], 404);
        }
    
        $temperatures = DB::table($ThermometerName)
            ->where('created_at', '>=', now()->subDays($days))
            ->orderBy('created_at', 'desc')
            ->get();
    
        if ($temperatures->isEmpty()) {
            return response()->json(['message' => 'No se encontraron datos'], 404);
        }
    
        $allTemperatures = [];
    
        foreach ($temperatures as $temperature) {
            foreach (['port1', 'port2', 'port3', 'port4', 'port5', 'port6', 'port7', 'port8'] as $port) {
                if ($temperature->{$port} != null) {
                    $allTemperatures[] = [
                        'name' => $ThermometerName,
                        'port' => $port,
                        'valor' => $temperature->{$port},
                        'entry_id' => $temperature->id,
                        'read_at' => $temperature->created_at,
                        'status' => 0,
                    ];
                }
            }
        }
    
        return response()->json($allTemperatures, 200);
    }

    public function index_port($ThermometerName, $days, $PortName)
    {     
        if (!Schema::hasTable($ThermometerName)) {
            return response()->json(['message' => 'La tabla no existe'], 404);
        }

        if (!Schema::hasColumn($ThermometerName, $PortName)) {
            return response()->json(['message' => 'La columna no existe'], 404);
        }

        $temperatures = DB::table($ThermometerName)->where('created_at', '>=', now()->subDays($days))->get();

        if ($temperatures->isEmpty()) {
            return response()->json(['message' => 'No se encontraron datos'], 404);
        }

        $portTemperatures = [];
    
        foreach ($temperatures as $temperature) {
            if ($temperature->{$PortName} != null) {
                $portTemperatures[] = [
                    'name' => $ThermometerName,
                    'port' => $PortName,
                    'valor' => $temperature->{$PortName},
                    'entry_id' => $temperature->id,
                    'read_at' => $temperature->created_at,
                    'status' => 0,
                ];
            }
            
        }

        return response()->json($portTemperatures, 200);
    }

    public function last($ThermometerName)
    {
        if (!Schema::hasTable($ThermometerName)) {
            return response()->json(['message' => 'La tabla no existe'], 404);
        }

        
        $last = DB::table($ThermometerName)->orderBy('created_at', 'desc')->latest('created_at')->first();

        if ($last==null ) {
            return response()->json(['message' => 'No se encontraron datos'], 404);
        }

        return response()->json($last, 200);
    }

    public function last_port($ThermometerName, $PortName)
    {
        if (!Schema::hasTable($ThermometerName)) {
            return response()->json(['message' => 'La tabla no existe'], 404);
        }

        if (!Schema::hasColumn($ThermometerName, $PortName)) {
            return response()->json(['message' => 'La columna no existe'], 404);
        }
        
        $last = DB::table($ThermometerName)->orderBy('created_at', 'desc')->latest('created_at')->first();

        if ($last==null ) {
            return response()->json(['message' => 'No se encontraron datos'], 404);
        }


        $response = [
            'id' => $last->id,
            $PortName => $last->{$PortName},
            'created_at' => $last->created_at,
            'updated_at' => $last->updated_at,
            'deleted_at' => $last->deleted_at,
        ];


        return response()->json($response, 200);
    }

    public function show($thermometerName)
    {
        return view('thermometer.temperatures', compact('thermometerName'));
    }

}
