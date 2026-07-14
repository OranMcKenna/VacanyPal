<x-layout>
    <x-ui.breadcrumb class="my-3" :crumbs="[
        'Home' => route('home'),
        'Vacancies' => route('vacancies.index'),
        $vacancy->job_title => route('vacancies.show', $vacancy->id),
        'Edit' => '',
    ]" />

    <x-ui.card>
        <x-ui.header>
            <h2>Edit Vacancy</h2>
            <a href="{{ route('vacancies.index') }}" class="regbuttons">Back</a>
        </x-ui.header>

        <form action="{{ route('vacancies.update', $vacancy->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            @include('vacancies._inputs', ['vacancy' => $vacancy, 'industries' => $industries])

            <button type="submit" class="regbuttonspurp">Update</button>
            <a href="{{ route('vacancies.index') }}" class="regbuttons">Cancel</a>
        </form>
    </x-ui.card>
</x-layout>
