@php
    use App\Enums\Role;
@endphp
<x-layout>
    <x-ui.breadcrumb class="my-3" :crumbs="[
        'Home' => route('home'),
        'Vacancies' => '',
    ]" />

    @include('vacancies._search')

    <x-ui.card>

        <div class="header"> <!-- mod action -->
            <h2>Job Vacancies</h2>
            @can('create', App\Models\Vacancy::class)
                <div>
                    <a href="{{ route('vacancies.create') }}" class="modbuttons">Create</a>
                </div>
            @endcan
        </div>

        <table class="table">
            <thead>
                <tr>
                    <th>
                        <x-ui.link-sort name="reference_number">Reference Number</x-ui.link-sort>
                    </th>
                    <th>
                        <x-ui.link-sort name="job_title">Job Title</x-ui.link-sort>
                    </th>
                    <th>
                        <x-ui.link-sort name="vacancy_type">Job Type</x-ui.link-sort>
                    </th>
                    <th>
                        <x-ui.link-sort name="company_name">Company</x-ui.link-sort>
                    </th>
                    <th>
                        <x-ui.link-sort name="industry.name">Industry</x-ui.link-sort>
                    </th>
                    <th>
                        <x-ui.link-sort name="application_open">Open Date</x-ui.link-sort>
                    </th>
                    <th>
                        <x-ui.link-sort name="application_close">Close Date</x-ui.link-sort>
                    </th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($vacancies as $vacancy)
                    <tr>
                        <td>{{ $vacancy->reference_number }}</td>
                        <td>{{ $vacancy->job_title }}</td>
                        <td>{{ $vacancy->vacancy_type }}</td>
                        <td>{{ $vacancy->company_name }}</td>
                        <td>{{ $vacancy->industry->name ?? 'N/A' }}</td>
                        <td>{{ \Carbon\Carbon::parse($vacancy->application_open)->format('F j, Y') }}</td>
                        <td>{{ \Carbon\Carbon::parse($vacancy->application_close)->format('F j, Y') }}</td>
                        <td>
                            <a href="{{ route('vacancies.show', $vacancy->id) }}" class="regbuttons">View</a>
                            @can('update', $vacancy)
                                <a href="{{ route('vacancies.edit', $vacancy->id) }}" class="modbuttons">Edit</a>
                            @endcan
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="8" class="text-center">No vacancies available.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>

        <!-- Pagination Links -->
        <div>
            {{ $vacancies->links() }}
        </div>

    </x-ui.card>

</x-layout>
