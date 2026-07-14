@php
    use App\Enums\Role;
@endphp

<x-layout>

    <x-ui.breadcrumb class="my-3" :crumbs="[
        'Home' => '',
    ]" />
    <section class="bg-white">
        <div class="flex flex-col items-center justify-center py-8 px-4 mx-auto max-w-screen-xl lg:py-16">
            <h1>Welcome to VacancyPAL!</h1>
            <h3>Your trusty job finding service</h3>
            <marquee behavior="alternate" scrollamount="15" direction="left">Welcome!</marquee>


        </div>

    </section>
    <br>
    <x-ui.card>
        <h1>Role:</h1>
        @guest
            <h3>Please log in or register to view our vacancy list and recieve a role.</h3>
        @endguest
        @auth
            @if (auth()->user()->role == Role::GUEST)
                <div>
                    <h3>As a <strong>Guest</strong>, feel free to browse our vacancies.
                        Feel free to make any of your own applications
                    </h3>
                </div>
            @endif

            @if (auth()->user()->role == Role::EMPLOYER)
                <div>
                    <h3>As an <strong>Employer</strong>, you have access to vacancies and applications. You can create, edit
                        and
                        delete vacancies, but you cannot create applications. Your moderator actions are displayed as a
                        yellow button.
                    </h3>
                </div>
            @endif

            @if (auth()->user()->role == Role::ADMIN)
                <div>
                    <h3>As an <strong>Admin</strong>, you have access to almost anything on the site. You can view, edit and
                        delete
                        vacancies. You can view and delete applications. Your moderator actions are displayed as a yellow
                        button.
                    </h3>
                </div>
            @endif
        @endauth
    </x-ui.card>

</x-layout>
