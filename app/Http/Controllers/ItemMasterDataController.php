<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ItemMasterData;

class ItemMasterDataController extends Controller
{
    public function showItemIndex() {
        $itemMasterData = ItemMasterData::paginate(1000);
        return view('admin.itemmasterupload',['data' => $itemMasterData]);
    }

    public function replaceItems(Request $request){
        $request->validate([
            'csv_file' => 'required|file|mimes:csv,txt|max:2048',
        ]);

        $file = $request->file('csv_file');

        // Process the CSV file and update ItemMasterData
        $this->processCsv($file);

        return redirect()->route('/items')->with('success', 'CSV uploaded successfully.');
    }
    
    private function processCsv($file)
    {
        // Open and read the CSV file
        $csvData = array_map('str_getcsv', file($file->path()));
    
        // Truncate the existing data in the ItemMasterData model
        ItemMasterData::truncate();
        $headers = array_shift($csvData);
    
        // Insert new data from the CSV
        foreach ($csvData as $row) {
            
            $rowData = array_map('trim',$row);

    
            // Check if keys exist before trying to access them
            $itemCode = isset($rowData[0]) ? $rowData['0'] : "NotFound";
            $itemDescription = isset($rowData['1']) ? $rowData['1'] : "NotFound";
            $supplierName = isset($rowData['2']) ? $rowData['2'] : "NotFound";
            $costCode = isset($rowData['3']) ? $rowData['3'] : "NotFound";
    
            ItemMasterData::create([
                'item_code' => $itemCode,
                'item_description' => $itemDescription,
                'supplier_name' => $supplierName,
                'cost_code' => $costCode,
                // Add more columns as needed
            ]);
        }
    }
    
}
