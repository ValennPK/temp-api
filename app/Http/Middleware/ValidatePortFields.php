<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Symfony\Component\HttpFoundation\Response;

class ValidatePortFields
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $validator = Validator::make($request->all(), [
            'port1' => 'nullable|numeric',
            'port2' => 'nullable|numeric',
            'port3' => 'nullable|numeric',
            'port4' => 'nullable|numeric',
            'port5' => 'nullable|numeric',
            'port6' => 'nullable|numeric',
            'port7' => 'nullable|numeric',
            'port8' => 'nullable|numeric',
        ]);

        $datos = $request->only([
            'port1', 'port2', 'port3', 'port4', 'port5', 'port6', 'port7', 'port8',
        ]
        );

        if (collect($datos)->filter()->isEmpty()){
            return response()->json([
                'message' => 'Validation failed',
                'errors' => 'At least one port field must have a value',
            ], 422);
        }

        if ($validator->fails()) {
            return response()->json([
                'message' => 'Validation failed',
                'errors' => $validator->errors(),
            ], 422);
        }

        return $next($request);
    }
}
