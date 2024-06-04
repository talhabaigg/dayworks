<?php

namespace App\Http\Controllers;

use File;
use App\Models\Project;
use App\Models\LineItem;
use Illuminate\Http\Request;
use App\Models\ItemMasterData;
use PhpOffice\PhpWord\PhpWord;
use Barryvdh\DomPDF\Facade\Pdf;
use PhpOffice\PhpWord\Writer\Word2007;
use Illuminate\Support\Facades\Storage;
use PhpOffice\PhpWord\TemplateProcessor;


class DayworkPDFController extends Controller
{
    public function showdayworksform($id)
    {
        $project = Project::find($id);
        $supplier_names = ItemMasterData::select('supplier_name')->distinct()->get();
        return view('dayworks.create', ['project' => $project, 'supplier_names' => $supplier_names]);
    }
    
    public function generateppdf(Request $request, $id)
{
   

    // Process line items
    $lineItems = [];
    $labourItems = [];
    $manufacturerNames = $request->input('manufacturer_name');
    $item_codes = $request->input('item_code');
    $item_qtys = $request->input('item_qty');
    $item_rates = $request->input('item_rate');
    $item_totals = $request->input('item_total');
    $item_descriptions = $request->input('item_description');

    foreach ($manufacturerNames as $key => $manufacturerName) {
        $lineItems[] = [
            'manufacturerName' => $manufacturerName,
            'item_code' => $item_codes[$key],
            'item_qty' => $item_qtys[$key],
            'item_rate' => $item_rates[$key],
            'item_total' => $item_totals[$key],
            'item_description' => $item_descriptions[$key],
            // Add other line item fields as needed
        ];
    }

    $labour_names = $request->input('labour_name');
    $labour_dates = $request->input('labour_date');
    $labour_qtys = $request->input('labour_qty');
    $labour_rates = $request->input('labour_rate');
    $labour_totals = $request->input('labour_total');

    foreach ($labour_names as $i => $labour_name) {
        $labourItems[] = [
            'labour_name' => $labour_name,
            'labour_date' => $labour_dates[$i],
            'labour_qty' => $labour_qtys[$i],
            'labour_rate' => $labour_rates[$i],
            'labour_total' => $labour_totals[$i],
            // Add other line item fields as needed
        ];
    }

    $pdfData = [
        'date' => $request->input('dayworks_date'),
        'site_induction_no' => $request->input('site_induction_no'),
        'dayworks_ref_no' => $request->input('dayworks_ref_no'),
        'project_name' => $request->input('project_name'),
        'description' => $request->input('description_of_work'),
        'site_instruction_no' => $request->input('site_instruction_no'),
        'issued_by' => $request->input('issued_by'),
     
        
        'signature' => $request->input('signature'),
        'lineItems' => $lineItems,
        'labourItems' => $labourItems,
        // Add other data needed for the PDF
    ];

    $pdf = PDF::loadView('pdf.template', $pdfData);
        $pdfFileName = 'invoice_' . '.pdf';
        $pdf->save(public_path($pdfFileName));

        // Stream the PDF to the browser
        // return $pdf->download($pdfFileName);
        return view('pdf.view', ['pdfFileName' => $pdfFileName]);
}
}