<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use App\Models\ItemMasterData;


class SearchItemsController extends Controller
{
    public function autocomplete(Request $request)
{
    $condition = $request->input('condition');
    $query = $request->input('query');

    $results = ItemMasterData::where('item_code', 'like', "%$query%")
        ->where('supplier_name', 'like', $condition)
        ->select('item_code', 'supplier_name', 'item_description') // Select only the necessary columns
        ->limit(15)
        ->get();

    return response()->json($results);
}

public function getItemDetails(Request $request) {
    $query = $request->input('item_code');

    $results = ItemMasterData::where('item_code', '=', $query)
        ->select('item_code', 'item_description', 'supplier_name', 'cost_code')
        ->first(); // Use first() to retrieve a single result or null

    if ($results !== null) {
        // Convert the result to an array
        $resultArray = $results->toArray();
        return response()->json($resultArray);
    } else {
        // No result found
        return response()->json(['message' => 'No result found']);
    }
}

}
