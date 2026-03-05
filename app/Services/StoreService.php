<?php

namespace App\Services;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class StoreService
{
    public static function storeTemperature($ThermometerName, Request $request)
    {
        $now = now();
        $portData = $request->only([
            'port1', 'port2', 'port3', 'port4', 'port5', 'port6', 'port7', 'port8',
        ]);

        DB::table( $ThermometerName)->insert([
            'port1' => $portData['port1'] ?? null,
            'port2' => $portData['port2'] ?? null,
            'port3' => $portData['port3'] ?? null,
            'port4' => $portData['port4'] ?? null,
            'port5' => $portData['port5'] ?? null,
            'port6' => $portData['port6'] ?? null,
            'port7' => $portData['port7'] ?? null,
            'port8' => $portData['port8'] ?? null,
            'created_at' => $now,
            'updated_at' => $now,
        ]);

        self::updateLatestSnapshot($ThermometerName, $portData, $now);
    }

    public static function storeMassTemperature($ThermometerName, Request $request)
    {
        $lastRecord = DB::table($ThermometerName)->latest('created_at')->first();
        $lastTimestamp = $lastRecord ? strtotime($lastRecord->created_at) : time();
        $lastPort1Value = null;
        
        foreach ($request->all() as $key => $value) {
            if (str_starts_with($key, 'dato') && $value !== null) {
                $lastTimestamp += 10;
                $readAt = date('Y-m-d H:i:s', $lastTimestamp);
                
                DB::table($ThermometerName)->insert([
                    'port1' => $value,
                    'created_at' => $readAt,
                    'updated_at' => $readAt,
                ]);

                $lastPort1Value = $value;
            }
        }

        if ($lastPort1Value !== null) {
            self::updateLatestSnapshot(
                $ThermometerName,
                ['port1' => $lastPort1Value],
                date('Y-m-d H:i:s', $lastTimestamp)
            );
        }
    }

    private static function updateLatestSnapshot(string $thermometerName, array $portData, $readAt): void
    {
        $thermometerId = DB::table('thermometers')
            ->where('username', $thermometerName)
            ->value('id');

        if (!$thermometerId) {
            return;
        }

        $snapshotData = [];
        foreach (range(1, 8) as $index) {
            $port = "port{$index}";
            if (!array_key_exists($port, $portData) || $portData[$port] === null) {
                continue;
            }

            $snapshotData["{$port}_value"] = $portData[$port];
            $snapshotData["{$port}_read_at"] = $readAt;
        }

        if (empty($snapshotData)) {
            return;
        }

        $exists = DB::table('thermometer_latest')
            ->where('thermometer_id', $thermometerId)
            ->exists();

        if ($exists) {
            DB::table('thermometer_latest')
                ->where('thermometer_id', $thermometerId)
                ->update($snapshotData + ['updated_at' => now()]);
            return;
        }

        DB::table('thermometer_latest')->insert(
            ['thermometer_id' => $thermometerId] + $snapshotData + [
                'created_at' => now(),
                'updated_at' => now(),
            ]
        );
    }
}
