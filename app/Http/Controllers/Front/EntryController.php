<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Models\Entry;

class EntryController extends Controller
{
    function listEntries(Request $request)
    {
        return response()->json([
            'data' => Entry::paginate(10)
        ], Response::HTTP_OK);
    }
}
