<?php

namespace App\Http\Controllers;

use App\Models\Vacancy;
use App\Models\Application;
use Illuminate\Http\Request;

class ApplicationController extends Controller
{
    public function index(Vacancy $vacancy)
    {
        $applications = Application::with('vacancy')->get();
        return view('applications.index', compact('vacancy', 'applications'));
    }

    public function show(int $id)
    {
        $application = Application::with('vacancy')->findOrFail($id);
        return view('applications.show', ['application' => $application]);
    }

    public function create(int $id)
    {
        $application = new Application;
        $application->vacancy_id = $id;

        return view('applications.create', ['application' => $application]);
    }

    public function store(Request $request, $id)
{
    $data = $request->validate([
        'name' => 'required|string|max:255',
        'email' => 'required|email|max:255',
        'mobile_number' => 'required|string|max:12',
        'statement' => 'nullable|string',
        'cv' => 'nullable|file|mimes:pdf,doc,docx|max:2048',
    ]);

    $vacancy = Vacancy::findOrFail($id);

    if ($request->hasFile('cv')) {
        $data['cv'] = $request->file('cv')->store('uploads/cvs', 'public');
    }

    $data['vacancy_id'] = $vacancy->id;

    Application::create($data);

    return redirect()->route('vacancies.show', $vacancy->id)->with('success', 'Application created successfully!');
}


    public function destroy(int $id)
    {
        $application = Application::with(['vacancy'])->findOrFail($id);

        $vacancy = $application->vacancy;

        $application->delete();

        $vacancy->save();

        return redirect()->route('vacancies.show', $vacancy->id)
            ->with('success', 'Application deleted successfully!');
    }
}
