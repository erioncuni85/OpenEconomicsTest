<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Species;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class SpecieController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request, $region)
    {
        $response = Http::get("https://apiv3.iucnredlist.org/api/v3/species/region/$region/page/0?token=9bb4facb6d23f48efbf424bb05c0c1ef1cf6f468393bc745d42179ac4aca5fee");
        $object = $response->json();
        $species = [];
        foreach ($object['result'] as $specie) {
            if ($request->get('class')) {
                if ($specie['class_name'] == $request->get('class')) {
                    $species[] = new Species($specie);
                } else {
                    continue;
                }
            }
            $species[] = new Species($specie);
        }
        return response()->json([
            'error' => false,
            'data' => $species,
        ]);
    }
}

