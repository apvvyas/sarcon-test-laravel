<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Models\Entry;

use App\Events\{ ActivateAddToCalendar, ActivateAddToMySchedule, ActivateJoinAsAudience, ActivateJoinAsSpeaker};

class EntryController extends Controller
{
    
    function listEntries(Request $request)
    {
        return response()->json([
            'data' => Entry::paginate(10)
        ], Response::HTTP_OK);
    }

    function activateJoinAsAudience(Request $request, Entry $entry)
    {
        $entry->toggle('activate_join_as_audience');

        broadcast(new ActivateJoinAsAudience($entry));

        return response()->json($entry->refresh());
    }

    function activateJoinAsSpeaker(Request $request, Entry $entry)
    {
        $entry->toggle('activate_join_as_speaker');

        broadcast(new ActivateJoinAsSpeaker($entry));

        return response()->json($entry->refresh());
    }

    function activateAddToMySchedule(Request $request, Entry $entry)
    {
        $entry->toggle('activate_add_to_my_schedule');

        broadcast(new ActivateAddToMySchedule($entry));

        return response()->json($entry->refresh());
    }

    function activateAddToCalendar(Request $request, Entry $entry)
    {
        $entry->toggle('activate_add_to_calendar');

        broadcast(new ActivateAddToCalendar($entry));

        return response()->json($entry->refresh());
    }
}
