<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Project;
use App\Models\DayworkOrder;
use Illuminate\Http\Request;
use App\Models\ItemMasterData;

class DayworkOrderEditController extends Controller
{
    public function editDayworkOrder($id)
    {
        $supplier_names = ItemMasterData::select('supplier_name')->distinct()->get();
        
        $dayworkOrder = DayworkOrder::with('items', 'labourItems', 'attachments')->findOrFail($id);
        $project = Project::find($dayworkOrder->project_id);
        $user = User::find($dayworkOrder->issued_by);
        return view('dayworks.edit', compact('dayworkOrder', 'supplier_names', 'project', 'user'));
    }

    public function saveEditedDayworkOrder(Request $request, $id) {
        // Validate your input data here
        $request->validate([
            'dayworks_date' => 'required',
            'dayworks_ref_no' => 'required',
            'description_of_work' => 'required',
            'status' => 'required',

            'manufacturer_name.*' => 'required',
            'item_code.*' => 'required',
            'item_qty.*' => 'required',
            'item_rate.*' => 'required',
            'item_total.*' => 'required',
            

            'labour_name.*' => 'required',
            'labour_date.*' => 'required',
            'labour_qty.*' => 'required',
            'labour_rate.*' => 'required',
            'labour_total.*' => 'required',

            
            // Add other validation rules as needed
        ]);
    
        $dayworkOrder = DayworkOrder::findOrFail($id);
    
        $newdayworkOrder = [
            'daywork_order_date' => $request->input('dayworks_date'),
            'issued_by' => $request->input('issued_by'),
            'daywork_ref_no' => $request->input('dayworks_ref_no'),
            'project_id' => $request->input('project_id'),
            'description' => $request->input('description_of_work'),
            'daywork_order_status' => $request->input('status'),
        ];
    
        $dayworkOrder->update($newdayworkOrder);
    
        // Delete old child records
        
    
        $lineItems = []; // initiate an array to store the line
    
        $manufacturerNames = $request->input('manufacturer_name');
        $item_codes = $request->input('item_code');
        $item_qtys = $request->input('item_qty');
        $item_rates = $request->input('item_rate');
        $item_totals = $request->input('item_total');
        $item_descriptions = $request->input('item_description');
    
        foreach ($manufacturerNames as $key => $manufacturerName) {
            
            $lineItems[] = [
                'supplier_name' =>  isset($manufacturerName) ? $manufacturerName : '',
                'item_code' => isset($item_codes[$key]) ? $item_codes[$key] : '',
                'qty' => isset($item_qtys[$key]) ? $item_qtys[$key] : '',
                'rate' => isset($item_rates[$key]) ? $item_rates[$key] : '',
                'total' => isset($item_totals[$key]) ? $item_totals[$key] : '',
            ];
        }
        $dayworkOrder->items()->delete();
        $dayworkOrder->labourItems()->delete();
        // Insert new child records
        $dayworkOrder->items()->createMany($lineItems);

        // Create an object to accept the labour values and insert into the table daywork_order_labours
        $labourItems = [];
        $labour_names = $request->input('labour_name');
        $labour_dates = $request->input('labour_date');
        $labour_qtys = $request->input('labour_qty');
        $labour_rates = $request->input('labour_rate');
        $labour_totals = $request->input('labour_total');

        foreach ($labour_names as $i => $labour_name) {
            $labourItems[] = [
                'labour_name' => $labour_name,
                'date' => $labour_dates[$i],
                'qty' => $labour_qtys[$i],
                'rate' => $labour_rates[$i],
                'total' => $labour_totals[$i],
                // Add other line item fields as needed
            ];
        }


        foreach ($labourItems as $labourData) {
            $dayworkOrder->labourItems()->create($labourData);
        }
    
        if ($request->hasFile('attachments')) {
            $file = $request->file('attachments');
            $extension = $file->getClientOriginalExtension();

            // Generate a formatted current date and time
            $currentDateTime = now()->format('YmdHis');
            $dayworkOrderId = $dayworkOrder->id;
            // Construct the new file name with the prefix, current date and time, and the original file extension
            $newFileName = 'attachment-' . $dayworkOrderId . '.' . $extension;

            // Store the file with the new name
            $filePath = $file->storeAs('public/attachments', $newFileName);
            $filePath = 'public/attachments/' . $newFileName;
            $fileItems = [
                'file_path' => $filePath,
            ];
            
            foreach ($fileItems as $key => $value) {
                $dayworkOrder->attachments()->create([$key => $value]);
            }
        }

        return redirect()->route('edit.daywork_orders', ['id' => $id])->with('success', 'Daywork Updated successfully.');
    }
    
}
