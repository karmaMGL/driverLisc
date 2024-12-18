<?php

namespace App\Http\Controllers;

use App\Models\documents_sections;
use App\Models\Section;
use Illuminate\Http\Request;

class bookController extends Controller
{
    public function index(Request $request)
    {
        // Get the document ID from the route parameter
        $documentId = $request->route('document');

        // Get the sections for the given document
        $sections = documents_sections::where('document_id', $documentId)->get();

        return view('sections', compact('sections'));
    }

    public function store(Request $request)
    {
        // Create a new section instance
        $section = new documents_sections;

        // Set the attributes from the request data
        $section->fill($request->all());

        // Save the section to the database
        $section->save();

        return redirect()->back();
    }

    public function edit(Request $request)
    {
        // Get the section ID from the route parameter
        $id = $request->route('id');

        // Find the section by ID
        $section = Section::find($id);

        // Return the edit view with the section data
        return view('sections', compact('section'));
    }

    public function update(Request $request)
    {
        // Get the section instance from the request data
        $section = Section::find($request->id);

        // Update the section attributes
        $section->fill($request->all());

        // Save the updated section to the database
        $section->save();

        return redirect()->back();
    }

    public function destroy(Request $request)
    {
        // Get the section ID from the route parameter
        $id = $request->route('id');

        // Find the section by ID and delete it
        Section::destroy($id);

        return redirect()->back();
    }
}
