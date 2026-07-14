<div class="flex items-center mb-4">
    <label for="reference_number" class="text-gray-700 mr-4" style="width: 8%;">reference_number</label>
    <input type="text" name="reference_number" id="reference_number"
        value="{{ old('reference_number', $vacancy->reference_number ?? '') }}" class="form-control">
    @error('reference_number')
        <p class="text-red-500">{{ $message }}</p>
    @enderror
</div>

<div class="flex items-center mb-4">
    <label for="job_title" class="text-gray-700 mr-4" style="width: 8%;">Job Title</label>
    <input type="text" name="job_title" id="job_title" value="{{ old('job_title', $vacancy->job_title ?? '') }}"
        class="form-control">
    @error('job_title')
        <p class="text-red-500">{{ $message }}</p>
    @enderror
</div>

<div class="flex items-center mb-4">
    <label for="vacancy_type" class="text-gray-700 mr-4" style="width: 8%;">Type</label>
    <select id="vacancy_type" name="vacancy_type" class="form-control">
        <option disabled selected>Choose vacancy type</option>
        <option value="Full-time"
            {{ old('vacancy_type', $vacancy->vacancy_type ?? '') == 'Full-time' ? 'selected' : '' }}>Full-time</option>
        <option value="Part-time"
            {{ old('vacancy_type', $vacancy->vacancy_type ?? '') == 'Part-time' ? 'selected' : '' }}>Part-time</option>
        <option value="Contract"
            {{ old('vacancy_type', $vacancy->vacancy_type ?? '') == 'Contract' ? 'selected' : '' }}>Contract</option>
    </select>
    @error('vacancy_type')
        <p class="text-red-500">{{ $message }}</p>
    @enderror
</div>


<div class="flex items-center mb-4">
    <label for="job_description" class="text-gray-700 mr-4" style="width: 8%;">Job Description</label>
    <textarea name="job_description" id="job_description" class="form-control">{{ old('job_description', $vacancy->job_description ?? '') }}</textarea>
    @error('job_description')
        <p class="text-red-500">{{ $message }}</p>
    @enderror
</div>

<div class="flex items-center mb-4">
    <label for="company_name" class="text-gray-700 mr-4" style="width: 8%;">Company Name</label>
    <input type="text" name="company_name" id="company_name"
        value="{{ old('company_name', $vacancy->company_name ?? '') }}" class="form-control">
    @error('company_name')
        <p class="text-red-500">{{ $message }}</p>
    @enderror
</div>

<div class="flex items-center mb-4">
    <label for="industry_id" class="text-gray-700 mr-4" style="width: 8%;">Industry</label>
    <select id="industry_id" name="industry_id" class="form-control">
        <option disabled selected>Choose an industry</option>
        @foreach ($industries as $id => $name)
            <option value="{{ $id }}"
                {{ old('industry_id', $vacancy->industry_id ?? '') == $id ? 'selected' : '' }}>
                {{ $name }}
            </option>
        @endforeach
    </select>
    @error('industry_id')
        <p class="text-red-500">{{ $message }}</p>
    @enderror
</div>

<div class="flex items-center mb-4">
    <label for="skills_required" class="text-gray-700 mr-4" style="width: 8%;">Skills Required</label>
    <input type="text" name="skills_required" id="skills_required"
        value="{{ old('skills_required', $vacancy->skills_required ?? '') }}" class="form-control">
    @error('skills_required')
        <p class="text-red-500">{{ $message }}</p>
    @enderror
</div>

<div class="flex items-center mb-4">
    <label for="application_open" class="text-gray-700 mr-4" style="width: 8%;">Open Date</label>
    <input type="date" name="application_open" id="application_open"
        value="{{ old('application_open', $vacancy->application_open ?? '') }}" class="form-control">
    @error('application_open')
        <p class="text-red-500">{{ $message }}</p>
    @enderror
</div>

<div class="flex items-center mb-4">
    <label for="application_close" class="text-gray-700 mr-4" style="width: 8%;">Close Date</label>
    <input type="date" name="application_close" id="application_close"
        value="{{ old('application_close', $vacancy->application_close ?? '') }}" class="form-control">
    @error('application_close')
        <p class="text-red-500">{{ $message }}</p>
    @enderror
</div>

<div class="mt-2">
    <x-ui.form.input label="Cover" name="image" type="file" value="{{ old('image', $vacancy->image) }}" />
</div>

@if ($vacancy->image)
    <div class="mb-3">
        <img src="{{ $vacancy->image }}" alt="Vacancy Cover" style="max-width: 200px;">
    </div>
@endif
</div>
