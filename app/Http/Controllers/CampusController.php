<?php

namespace App\Http\Controllers;

use App\Models\Campus;
use Illuminate\Http\Request;

class CampusController extends Controller
{
    //
    public function search(Request $request)
    {
        $search = $request->get('q');

        // Mengambil 10 kampus yang namanya mirip dengan yang diketik
        $campuses = Campus::where('name', 'LIKE', "%{$search}%")
                          ->limit(10)
                          ->get(['id', 'name']);

        return response()->json($campuses);
    }

}
