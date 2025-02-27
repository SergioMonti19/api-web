<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ApiController extends Controller
{
    // Método para devolver un mensaje de éxito
    public function getSuccessMessage()
    {
        return response()->json(['message' => 'Success!'], 200);
    }

    // Método para devolver datos de ejemplo
    public function getData()
    {
        $data = [
            'id' => 1,
            'name' => 'Sample Data',
            'description' => 'This is a sample description.'
        ];

        return response()->json($data, 200);
    }
}
