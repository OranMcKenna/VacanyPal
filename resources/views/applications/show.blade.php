<x-layout>
    <x-ui.breadcrumb class="my-3" :crumbs="[
        'Home' => route('home'),
        'Vacancies' => route('vacancies.index'),
        $application->vacancy_id => route('vacancies.show', $application->id),
        $application->name => '',
    ]" />

    <x-ui.card>
        <x-ui.header>
            <meta charset="UTF-8" />
            <title>Show Application</title>
            <h2>Application (#{{ $application->id }})</h2>
            <a href="{{ route('vacancies.show', $application->vacancy_id) }}" class="regbuttons">Back</a>
        </x-ui.header>

        <body>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

                {{-- <div>
                    <h4 class="font-bold">Vacancy</h4>
                    <p>{{ $vacancy->job_title ?? 'Unknown Vacancy Title.' }} (ID: {{ $vacancy->id }}) </p>
                </div> --}}

                <div>
                    <h4 class="font-bold">Applicant Name</h4>
                    <p>{{ $application->name ?? 'Unknown name.' }}</p>
                </div>

                <div>
                    <h4 class="font-bold">Applicant Email</h4>
                    <p>{{ $application->email ?? 'Unknown email.' }}</p>
                </div>

                <div>
                    <h4 class="font-bold">Mobile Number</h4>
                    <p>{{ $application->mobile_number ?? 'Unknown mobile number.' }}</p>
                </div>

                <div>
                    <h4 class="font-bold">Statement</h4>
                    <p>{{ $application->statement ?? 'Statement not provided.' }}</p>
                </div>

                <div>
                    <h4 class="font-bold">Cv</h4>
                    @if ($application->cv)
                        <a href="{{ asset('storage/' . $application->cv) }}" target="_blank"
                            class="text-blue-500 hover:underline">
                            View / Download
                        </a>
                    @endif
                </div>
            </div>

            <div class="mt-4">
                @can('delete', $application)
                    <a x-data @click="$dispatch('open-modal')" class="modbuttonsdel">Delete</a>
                @endcan
            </div>


        </body>
    </x-ui.card>

    <x-ui.modal>
        <x-slot:title>Delete Application</x-slot:title>
        <p>Are you sure you want to delete this application?</p>
        <x-slot:footer>
            <form method="POST" action="{{ route('applications.destroy', $application->id) }}">
                @csrf
                @method('DELETE')
                <button type="submit" class="modbuttonsdel">Delete</button>
                <a x-data @click="$dispatch('close-modal')" class="regbuttons">Cancel</a>
            </form>
        </x-slot:footer>
    </x-ui.modal>

</x-layout>
