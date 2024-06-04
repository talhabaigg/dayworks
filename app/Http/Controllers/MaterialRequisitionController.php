<?php

namespace App\Http\Controllers;

use File;
use App\Models\User;
use App\Models\Project;
use App\Models\LineItem;
use App\Models\DayworkOrder;
use Illuminate\Http\Request;
use App\Models\ItemMasterData;
use PhpOffice\PhpWord\PhpWord;
use Barryvdh\DomPDF\Facade\Pdf;
use PhpOffice\PhpWord\Writer\Word2007;
use Illuminate\Support\Facades\Storage;
use PhpOffice\PhpWord\TemplateProcessor;

class MaterialRequisitionController extends Controller
{
    public function displayCreateForm()
    {
        return view('materialRequisitionOrder.create');
    }

    public function createMaterialRequisitionOrder(Request $request) {
        // Process line items
        $lineItems = [];

       
        $item_codes = $request->input('item_code');
        $item_qtys = $request->input('item_qty');
        $item_rates = $request->input('item_rate');
        $item_totals = $request->input('item_total');
        $item_descriptions = $request->input('item_description');

    foreach ($item_codes as $key => $itemCode) {
        $lineItems[] = [
        
            'item_code' =>$itemCode,
            'qty' => $item_qtys[$key],
            'rate' => $item_rates[$key],
            'total' => $item_totals[$key],
            'description' => $item_descriptions[$key],
            // Add other line item fields as needed
        ];
    }
   
    $pdfData = [
        'date' => $request->input('date_required'),
        'notes' => $request->input('notes'),
       
        'lineItems' => $lineItems,

        // Add other data needed for the PDF
    ];

    $pdf = PDF::loadView('materialRequisitionOrder.template', $pdfData);
        $pdfFileName = 'invoice_' . '.pdf';
        $pdf->save(public_path($pdfFileName));

        // Stream the PDF to the browser
        // return $pdf->download($pdfFileName);
        return view('pdf.view', ['pdfFileName' => $pdfFileName]);

        return view('materialRequisitionOrder.create');
    }
}
