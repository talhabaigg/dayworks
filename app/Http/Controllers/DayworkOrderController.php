<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Project;
use App\Models\DayworkOrder;
use Illuminate\Http\Request;
use App\Models\ItemMasterData;
use App\Models\DayworkAttachment;

class DayworkOrderController extends Controller
{
    public function createNewDayworks($id)
    {
        $users = User::all();
        
        $project = Project::find($id);
        $supplier_names = ItemMasterData::select('supplier_name')->distinct()->get();

        return view('dayworks.create', compact('users', 'project', 'supplier_names'));
    }

    public function storeNewDayworks(Request $request)
    {
        
        $incomingFields = $request->validate([
            'dayworks_date' => 'required|date',
            'dayworks_ref_no' => 'required',
            'description_of_work' => 'required',
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

            'attachments' => 'required|file|mimes:jpg,jpeg,png',

        ]);

        
    


    // Create an object to accept the header values and insert into the table daywork_orders
    $dayworkOrder = [
        'daywork_order_date' => $request->input('dayworks_date'),
        'issued_by' => $request->input('issued_by'),
        'daywork_ref_no' => $request->input('dayworks_ref_no'),
        'project_id' => $request->input('project_id'),
        'description' => $request->input('description_of_work'),
        'daywork_order_status' =>  $request->input('status'),
    ];


        $dayworkOrder = DayworkOrder::create($dayworkOrder);
        
        // Header values are inserted into the table daywork_orders

        // Process line items in loops
        $lineItems = []; //initiate an array to store the line
       
        $manufacturerNames = $request->input('manufacturer_name');
        $item_codes = $request->input('item_code');
        $item_qtys = $request->input('item_qty');
        $item_rates = $request->input('item_rate');
        $item_totals = $request->input('item_total');
        $item_descriptions = $request->input('item_description');

    foreach ($manufacturerNames as $key => $manufacturerName) {
        $lineItems[] = [
            'supplier_name' => $manufacturerName,
            'item_code' => $item_codes[$key],
            'qty' => $item_qtys[$key],
            'rate' => $item_rates[$key],
            'total' => $item_totals[$key],
        ];
    }
    // Line items array is created
    //Initate a foreach loop to insert the line items into the table daywork_order_items
    // Laravel handles inserting the daywork_order_id into the table daywork_order_items

        foreach ($lineItems as $itemData) {
            $dayworkOrder->items()->create($itemData);
        }
        // Line items are inserted into the table daywork_order_items

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

        foreach ($labourItems as $itemData) {
            $dayworkOrder->labourItems()->create($itemData);
        }
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
        
        $signatureImageDataUrl = $request->input('signatureImage');

        // Convert the data URL to a file or process it as needed
        $imageData = base64_decode(preg_replace('#^data:image/\w+;base64,#i', '', $signatureImageDataUrl));

        // Save the image on the server
        $imagePath =  storage_path('app/public/signatures/') . 'signature-' . $dayworkOrderId . '.png';
        file_put_contents($imagePath, $imageData);
        // $dayworkOrder->attachments()->create($filePath);
        $imagePath = 'public/signatures/' . 'signature-' . $dayworkOrderId . '.png';
        $signatureItems = [
            'file_path' => $imagePath,
        ];

        foreach ($signatureItems as $key => $value) {
            $dayworkOrder->signatures()->create([$key => $value]);
        }
        
        return redirect()->route('projects.index')->with('success', 'Daywork order created successfully.');
    }

    public function loadDayworkOrder($id)
    {
        $dayworkOrder = DayworkOrder::with('items', 'labourItems', 'signatures', 'attachments')->findOrFail($id);
        $project = Project::find($dayworkOrder->project_id);
        $user = User::find($dayworkOrder->issued_by);
        return view('loadDaywork', compact('dayworkOrder', 'user', 'project'));
    }

    public function editDayworkOrder($id)
    {
        $supplier_names = ItemMasterData::select('supplier_name')->distinct()->get();
        
        $dayworkOrder = DayworkOrder::with('items', 'labourItems', 'signatures', 'attachments')->findOrFail($id);
        $project = Project::find($dayworkOrder->project_id);
        $user = User::find($dayworkOrder->issued_by);
        return view('dayworks.edit', compact('dayworkOrder', 'supplier_names', 'project', 'user'));
    }

    public function editAttachments($id)
    {
        $dayworkOrder = DayworkOrder::with('attachments')->findOrFail($id);
      
        
        return view('dayworks.viewattachments', compact('dayworkOrder'));
    }

    public function deleteAttachment($id)
    {
        $dayworkAttachment = DayworkAttachment::findOrFail($id);
        $dayworkOrderId = $dayworkAttachment->daywork_order_id;
        $dayworkAttachment->delete();
        // Fix the syntax error in the redirect()->route() call
    return redirect()->route('edit.daywork_orders', ['id' => $dayworkOrderId])
    ->with('success', 'Attachment deleted successfully.');
    }

    public function saveDayworkOrder(Request $request, $id) {
        // Validate your input data here
        $request->validate([
            'dayworks_date' => 'required',
            'dayworks_ref_no' => 'required',
            'description_of_work' => 'required',
            'status' => 'required',
            // Add other validation rules as needed
        ]);
    
        $dayworkOrder = DayworkOrder::findOrFail($id);
    
        $newdayworkOrder = [
            'daywork_order_date' => $request->input('dayworks_date'),
            'issued_by' => 1,
            'daywork_ref_no' => $request->input('dayworks_ref_no'),
            'project_id' => 1,
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
    
        return redirect()->route('edit.daywork_orders', ['id' => $id])->with('success', 'Daywork Updated successfully.');
    }
    
}