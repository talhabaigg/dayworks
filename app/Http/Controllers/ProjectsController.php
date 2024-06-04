<?php

namespace App\Http\Controllers;

use App\Models\Project;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use League\Csv\Writer; 

class ProjectsController extends Controller
{
    public function projectindex()
    {
        $projects = Project::all();
        return view('homepage', ['data' => $projects]);
    }
        
        public function showaddprojectpage()
        {
            return view('forms.addproject');
        }

        public function store(Request $request)
        {
        
            $incomingFields = $request->validate([
                'project_number' => 'required',
                'project_name' => 'required',
                'address' => 'nullable',
                'primary_contact_name' => 'nullable',
                'primary_contact_email' => 'nullable',
                'primary_contact_mobile' => 'nullable',
            ]);
            
            Project::create($incomingFields);
            return redirect('/projects')->with('success', 'Project created successfully.');
        }

        public function edit($id)
            {
            // Fetch the model instance based on the ID
                $item = Project::find($id);

                return view('forms.editproject', ['item' => $item]);
            }

        public function update(Request $request, $id)
            {
                $item = Project::find($id);

                $incomingFields = $request->validate([
                    'project_number' => 'required',
                    'project_name' => 'required',
                    'address' => 'nullable',
                    'primary_contact_name' => 'nullable',
                    'primary_contact_email' => 'nullable',
                    'primary_contact_mobile' => 'nullable',
                ]);

                $item->update($incomingFields);

                return redirect('/projects')->with('success', 'Project edited successfully.');
            }

        public function destroy($id)
            {
                $item = Project::find($id);
                $item->delete();

                return redirect('/projects')->with('success', 'Project deleted successfully.');
            }


            public function exportCsv()
            {
                // Fetch all records from the Project model
                $projects = Project::all();
        
                // Create a CSV file
                $csv = Writer::createFromFileObject(new \SplTempFileObject());
        
                // Add headers to the CSV
                $csv->insertOne(['ID', 'Project Number', 'Description', 'Created At', 'Updated At']);
        
                // Add data to the CSV
                foreach ($projects as $project) {
                    $csv->insertOne([$project->id, $project->project_number, $project->project_name]);
                }
        
                // Download the CSV file
                return Response::stream(
                    function () use ($csv) {
                        $csv->output('projects.csv');
                    },
                    200,
                    [
                        'Content-Type' => 'text/csv',
                        'Content-Disposition' => 'attachment; filename="projects.csv"',
                    ]
                );
            }
    }
