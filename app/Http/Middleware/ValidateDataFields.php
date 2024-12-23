<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Symfony\Component\HttpFoundation\Response;

class ValidateDataFields
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $validator = Validator::make($request->all(), [
            'dato1' => 'nullable|numeric',
            'dato2' => 'nullable|numeric',
            'dato3' => 'nullable|numeric',
            'dato4' => 'nullable|numeric',
            'dato5' => 'nullable|numeric',
            'dato6' => 'nullable|numeric',
            'dato7' => 'nullable|numeric',
            'dato8' => 'nullable|numeric',
            'dato9' => 'nullable|numeric',
            'dato10' => 'nullable|numeric',
            'dato11' => 'nullable|numeric',
            'dato12' => 'nullable|numeric',
            'dato13' => 'nullable|numeric',
            'dato14' => 'nullable|numeric',
            'dato15' => 'nullable|numeric',
            'dato16' => 'nullable|numeric',
            'dato17' => 'nullable|numeric',
            'dato18' => 'nullable|numeric',
            'dato19' => 'nullable|numeric',
            'dato20' => 'nullable|numeric',
        ]);

        $datos = $request->only([
            'dato1', 'dato2', 'dato3', 'dato4', 'dato5', 'dato6', 'dato7', 'dato8', 
            'dato9', 'dato10', 'dato11', 'dato12', 'dato13', 'dato14', 'dato15', 
            'dato16', 'dato17', 'dato18', 'dato19', 'dato20'
        ]);

        if (collect($datos)->filter()->isEmpty()) {
            return response()->json([
                'message' => 'Validation failed',
                'errors' => 'At least one dato field must have a value',
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
