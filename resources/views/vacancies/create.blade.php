<x-layout>
    <x-ui.breadcrumb class="my-3" :crumbs="[
        'Home' => route('home'),
        'Vacancies' => route('vacancies.index'),
        'Create' => '',
    ]" />
    <x-ui.card>
        <x-ui.header>
            <h2>Create Vacancy</h2>
            <a href="{{ route('vacancies.index') }}" class="regbuttons">Back</a>
        </x-ui.header>

        <form action="{{ route('vacancies.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            @include('vacancies._inputs', ['vacancy' => $vacancy, 'industries' => $industries])
            <button type="submit" class="regbuttonspurp">Create</button>
            <a href="{{ route('vacancies.index') }}" class="regbuttons">Cancel</a>
        </form>

    </x-ui.card>
</x-layout>
