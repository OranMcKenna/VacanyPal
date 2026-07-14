<x-layout>
    <x-ui.breadcrumb class="my-3" :crumbs="[
        'Home' => route('home'),
        'About' => '',
    ]" />

    <x-ui.card>

        <h1>About</h1>

        <p>VacancyPAL is a project created for COM621 to learn and strengthen the knowledge
            that the student has using laravel and tailwind css. This project is a vacancy database
            where users can register and login to view a list of vacancies. The user can also add
            vacancies, edit vacancies and delete vacancies. The user can view applications written for each
            vacancy, and even create their own.
            <br>
            <br>
            I encountered many challenges while creating this project. The first challenge for me
            was implementing the database with the list of vacancies(and displaying them correctly).
            The next challenge was implementing the vacancy industry. Lastly, authentication. My method
            of keeping on top of these challenges was to create a folder of different versions of
            this project. After i completed a 'milestone', i would save the project as a new version
            (for example i saved the project as 'VacancyPAL v6' after i added applications). This way i could
            always go back to a previous version if i made a mistake.
            <br>
            <br>
            Roles:
            <br>
            -The <strong>guest</strong> role allows the user to view the list of vacancies and create
            vacancy applications. (guset can only apply to listed vacancies, only other roles have more abilities).
            <br>
            -The <strong>employer</strong> role allows the user to view the list of vacancies, view vacancy applications
            and create
            their own vacancies. (Employer can do everything except create applications).
            Any moderator actions are displayed as a yellow button.
            <br>
            -The <strong>admin</strong> role allows the user to view list of vacancies, edit vacancies, delete
            vacancies, view vacancy
            applications and delete vacancy applications. (Admin can do everything except create vacancies or applications).
            Any moderator actions are displayed as a yellow button.
        </p>

    </x-ui.card>

</x-layout>
