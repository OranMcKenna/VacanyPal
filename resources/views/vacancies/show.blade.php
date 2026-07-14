<x-layout>
    <x-ui.breadcrumb class="my-3" :crumbs="[
        'Home' => route('home'),
        'Vacancies' => route('vacancies.index'),
        $vacancy->job_title => '',
    ]" />

    <x-ui.card>
        <x-ui.header>
            <h2>{{ $vacancy->job_title }} <span class="text-gray-500">(#{{ $vacancy->reference_number }})</span></h2>
            <a href="{{ route('vacancies.index') }}" class="regbuttons">Back</a>
        </x-ui.header>

        <div class="flex items-center">
            <div class="w-full">

                <dl class="display">
                    <dt class="font-bold">Company Name</dt>
                    <dd>{{ $vacancy->company_name }}</dd>
                </dl>

                <dl class="display">
                    <dt class="font-bold">Industry</dt>
                    <dd>{{ $vacancy->industry->name ?? 'N/A' }}</dd>
                </dl>

                <dl class="display">
                    <dt class="font-bold">Vacancy Type</dt>
                    <dd>{{ $vacancy->vacancy_type }}</dd>
                </dl>

                <dl class="display">
                    <dt class="font-bold">Skills Required</dt>
                    <dd>{{ $vacancy->skills_required }}</dd>
                </dl>

                <dl class="display">
                    <dt class="font-bold">Application Open Date</dt>
                    <dd>{{ \Carbon\Carbon::parse($vacancy->application_open)->format('F j, Y') }}</dd>
                </dl>

                <dl class="display">
                    <dt class="font-bold">Application Close Date</dt>
                    <dd>{{ \Carbon\Carbon::parse($vacancy->application_close)->format('F j, Y') }}</dd>
                </dl>

                <dl class="display">
                    <dt class="font-bold">Job Description</dt>
                    <dd>{{ $vacancy->job_description }}</dd>
                </dl>

            </div>
            <div class="w-1/2">
                <img src="{{ $vacancy->image }}" alt="Vacancy Cover" style="max-width: 200px;" />
            </div>
        </div>

        <div class="mt-6 flex gap-4">
            @can('update', $vacancy)
                <a href="{{ route('vacancies.edit', $vacancy->id) }}" class="modbuttons">Edit</a>
            @endcan

            @can('view', \App\Models\Application::class)
                <a x-data @click="$dispatch('open-modal')" class="modbuttonsdel">Delete</a>
            @endcan
            @can('create', \App\Models\Application::class)
                <a class="regbuttons" href="{{ route('applications.create', $vacancy->id) }}">Apply</a>
            @endcan
        </div>


    </x-ui.card>
    <br>

    <x-ui.modal>
        <x-slot:title>Delete vacancy</x-slot:title>
        <p>Are you sure you want to delete this vacancy?</p>
        <x-slot:footer>
            <form method="POST" action="{{ route('vacancies.destroy', $vacancy->id) }}">
                @csrf
                @method('DELETE')
                <button type="submit" class="modbuttonsdel">Delete</button>
                <a x-data @click="$dispatch('close-modal')" class="regbuttons">Cancel</a>
            </form>
        </x-slot:footer>
    </x-ui.modal>

    @can('view', \App\Models\Application::class)
        <x-ui.card>
            <x-ui.header>
                <h3 class="font-bold mb-4">Applications:</h3>
            </x-ui.header>

            @if ($vacancy->applications->isEmpty())
                <p>No applications yet for this vacancy.</p>
            @else
                @foreach ($vacancy->applications as $application)
                    <div class="p-4 border rounded mb-4 shadow-sm">
                        <h4 class="font-bold">{{ $application->name }}</h4>
                        <p><strong>Email:</strong> {{ $application->email }}</p>
                        <p><strong>Mobile:</strong> {{ $application->mobile_number }}</p>
                        <p><strong>Statement:</strong> {{ str($application->statement)->take(50) }}...</p>

                        @can('view', \App\Models\Application::class)
                            <a href="{{ route('applications.show', $application->id) }}" class="regbuttons">
                                View
                            </a>
                        @endcan

                    </div>
                @endforeach
            @endif
        </x-ui.card>
    @endcan

</x-layout>
