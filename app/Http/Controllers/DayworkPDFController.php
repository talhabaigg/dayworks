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


class DayworkPDFController extends Controller
{
    public function showdayworksform($id)
    {
        $project = Project::find($id);
        $supplier_names = ItemMasterData::select('supplier_name')->distinct()->get();
        return view('dayworks.create', ['project' => $project, 'supplier_names' => $supplier_names]);
    }
    
    public function generatePDF(Request $request, $id)
{
   

    //Find Daywork by ID
    
    $dayworkOrder = DayworkOrder::with('items', 'labourItems', 'attachments')->findOrFail($id);
    $project = Project::find($dayworkOrder->project_id);
    $user = User::find($dayworkOrder->issued_by);

    $pdfData = [
        'dayworkOrder' => $dayworkOrder,
        'project' => $project,
        'user' => $user,
    ];


    $pdf = PDF::loadView('pdf.template', $pdfData);
        $pdfFileName = 'invoice_' . '.pdf';
        $pdf->save(public_path($pdfFileName));

        // Stream the PDF to the browser
        // return $pdf->download($pdfFileName);
        return view('pdf.view', ['pdfFileName' => $pdfFileName]);
}
}