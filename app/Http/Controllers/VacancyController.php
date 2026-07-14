<?php

namespace App\Http\Controllers;

use App\Models\Vacancy;
use App\Models\Industry;
use App\Models\Application;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Illuminate\Validation\Rules\File;

class VacancyController extends Controller
{
    public function index(Request $request)
    {
        if (!Gate::allows('viewAny', Vacancy::class)) {
            return redirect()->route('home')->with('info', 'You are not authorised to view vacancies');
        }
        $size = $request->input('size', 20);
        $sort = $request->input('sort', 'reference_number');
        $direction = $request->input('direction', 'asc');
        $search = $request->input('search', '');

        $vacancies = Vacancy::with('industry')
            ->search($search)
            ->sortable($sort, $direction)
            ->paginate($size)
            ->withQueryString();
        return view('vacancies.index', ['vacancies' => $vacancies, 'search' => $search]);
    }

    public function create()
    {
        if (!Gate::allows('create', Vacancy::class)) {
            return redirect()->route('home')->with('info', 'You are not authorised to create vacancies');
        }

        $vacancy = new Vacancy;
        $industries = Industry::all()->pluck('name', 'id');

        return view('vacancies.create', ['vacancy' => $vacancy, 'industries' => $industries]);
    }

    public function store(Request $request)
    {

        // Authorise
        if (!Gate::allows('create', Vacancy::class)) {
            return redirect()->route('home')->with('info', 'You are not authorised to create vacancies');
        }

        // Validate the incoming request
        $validatedData = $request->validate([
            'reference_number' => 'required|unique:vacancies|integer|min:10000|max:99999',
            'job_title' => 'required|string|max:255',
            'vacancy_type' => 'required|string|max:50',
            'job_description' => 'required|string',
            'company_name' => 'required|string|max:255',
            'industry_id' => 'required|exists:industries,id', // Ensure valid industry
            'skills_required' => 'required|string',
            'application_open' => 'required|date',
            'application_close' => 'required|date|after_or_equal:application_open',
            'image' => 'nullable',
        ]);

        if ($request->hasFile('image')) {
            $file = $request->image;

            $validatedData['image'] = 'data:' . $file->getMimeType() . ';base64,' . base64_encode(file_get_contents($file));
        }

        // Create the vacancy record
        Vacancy::create($validatedData);

        // Redirect to vacancies index with success message
        return redirect()->route('vacancies.index')->with('success', 'Vacancy created successfully!');
    }


    public function show(int $id)
    {

        if (!Gate::allows('view', Vacancy::class)) {
            return redirect()->route('home')->with('info', 'You are not authorised to view vacancies');
        }
        $vacancy = Vacancy::with(['applications', 'industry'])->findOrFail($id);

        return view('vacancies.show', compact('vacancy'));
    }

    public function edit(int $id)
    {
        if (!Gate::allows('update', Vacancy::class)) {
            return redirect()->route('home')->with('info', 'You are not authorised to edit vacancies');
        }

        $vacancy = Vacancy::findOrFail($id);
        $industries = Industry::all()->pluck('name', 'id');
        return view('vacancies.edit', ['vacancy' => $vacancy, 'industries' => $industries]);
    }

    public function update(Request $request, Vacancy $vacancy)
    {
        if (!Gate::allows('update', Vacancy::class)) {
            return redirect()->route('home')->with('info', 'You are not authorised to edit vacancies');
        }

        $data = $request->validate([
            'job_title' => 'required|string|max:255',
            'job_description' => 'required|string',
            'company_name' => 'required|string|max:255',
            'industry_id' => 'required|exists:industries,id',
            'skills_required' => 'required|string',
            'application_open' => 'required|date',
            'application_close' => 'required|date',
            'vacancy_type' => 'required|string|max:50',
            'image' => ['nullable', File::types(['png', 'jpg'])->max(1024)],
        ]);

        if ($request->hasFile('image')) {
            $file = $request->file('image');

            $mimeType = $file->getMimeType(); // often "image/png" or "image/jpeg"

            $data['image'] = 'data:' . $mimeType . ';base64,' . base64_encode(file_get_contents($file));
        } else {
            unset($data['image']);
        }

        $vacancy->update($data);

        return redirect()->route('vacancies.show', $vacancy->id)->with('success', 'Vacancy updated successfully!');
    }

    public function destroy(int $id)
    {
        if (!Gate::allows('delete', Vacancy::class)) {
            return redirect()->route('home')->with('info', 'You are not authorised to delete vacancies');
        }

        $vacancy = Vacancy::findOrFail($id);
        $vacancy->delete();

        return redirect()->route('vacancies.index')->with('success', 'Vacancy deleted successfully!');
    }
}
