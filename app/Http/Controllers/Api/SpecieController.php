<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class SpecieController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index($region)
    {
        $object = Http::get("https://apiv3.iucnredlist.org/api/v3/species/region/$region/page/0?token=9bb4facb6d23f48efbf424bb05c0c1ef1cf6f468393bc745d42179ac4aca5fee")->object();
        
        return response()->json([
            'error' => false,
            'data' => $object,
        ]);
    }
}

