<form method="GET" action="{{ route('vacancies.index') }}" class="flex items-center gap-2 mb-4">
    <div class="flex-1">
        <x-ui.form.input name="search" value="{{ $search }}" class="text-xs" placeholder="Search..." />
    </div>
    <button type="submit" class="regbuttons">
        Search
    </button>

    <a href="{{ route('vacancies.index') }}" class="regbuttons">
        Clear
    </a>
</form>
