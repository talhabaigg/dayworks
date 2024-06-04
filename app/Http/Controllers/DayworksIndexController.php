<?php

namespace App\Http\Controllers;

use App\Models\Project;
use App\Models\DayworkOrder;
use Illuminate\Http\Request;

class DayworksIndexController extends Controller
{
    public function showDayworkIndex($id)
    {
        $daywork_orders = DayworkOrder::where('project_id', $id)->get();
        $project = Project::find($id);
        return view('dayworks.index', compact('daywork_orders', 'project'));
    }
}
