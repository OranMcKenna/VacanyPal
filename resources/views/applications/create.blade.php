<x-layout>
    <x-ui.breadcrumb class="my-3" :crumbs="[
        'Home' => route('home'),
        'Vacancies' => route('vacancies.index'),
        $application->vacancy_id => route('vacancies.show', $application->vacancy_id),
        'Apply' => '',
    ]" />
    <x-ui.card>
        <x-ui.header>
            <h3>Application for {{ $application->vacancy->job_title }}</h3>
            <a href="{{ route('vacancies.show', $application->vacancy_id) }}" class="regbuttons">Back</a>
        </x-ui.header>


        <form method="POST" action="{{ route('applications.store', $application->vacancy_id) }}"
            enctype="multipart/form-data">
            @csrf
            <div class="flex items-center mb-4">
                <label for="name" class="text-gray-700 mr-4" style="width: 8%;">Name</label>
                <input type="text" name="name" id="name" value="{{ old('name', $application->name ?? '') }}"
                    class="form-control">
                @error('name')
                    <p class="text-red-500">{{ $message }}</p>
                @enderror
            </div>

            <div class="flex items-center mb-4">
                <label for="email" class="text-gray-700 mr-4" style="width: 8%;">Email</label>
                <input type="email" name="email" id="email"
                    value="{{ old('email', $application->email ?? '') }}" class="form-control">
                @error('email')
                    <p class="text-red-500">{{ $message }}</p>
                @enderror
            </div>

            <div class="flex items-center mb-4">
                <label for="mobile_number" class="text-gray-700 mr-4" style="width: 8%;">Mobile Number</label>
                <input type="text" name="mobile_number" id="mobile_number"
                    value="{{ old('mobile_number', $application->mobile_number ?? '') }}" class="form-control">
                @error('mobile_number')
                    <p class="text-red-500">{{ $message }}</p>
                @enderror
            </div>

            <div class="flex items-center mb-4">
                <label for="statement" class="text-gray-700 mr-4" style="width: 8%;">Statement</label>
                <input type="text" name="statement" id="statement"
                    value="{{ old('statement', $application->statement ?? '') }}" class="form-control">
                @error('statement')
                    <p class="text-red-500">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-4">
                <label for="cv" class="text-gray-700 mr-4" style="width: 8%;">CV / Resume</label>
                <input type="file" name="cv" id="cv" class="border rounded p-2 w-full"
                    accept=".pdf,.doc,.docx" />
                @error('cv')
                    <p class="text-red-500">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <button class="regbuttons" type="submit">Apply</button>
                <a href="{{ route('vacancies.show', $application->vacancy_id) }}">Cancel</a>
            </div>

        </form>
    </x-ui.card>
</x-layout>
