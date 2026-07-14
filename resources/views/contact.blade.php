<x-layout>

    <x-ui.breadcrumb class="my-3" :crumbs="[
        'Home' => route('home'),
        'Contact' => '',
    ]" />

    <x-ui.card>
        <h1>Contact</h1>

        <h3>You can contact us through the following means:</h3>
        <br>
        <br>
        <p><strong>Email:</strong> mckenna-o7@ulster.ac.uk</p>
        <br>
        <p><strong>Ulster Phone:</strong> 028 7012 3456</p>
        <br>
        <p><strong>Ulster Website: </strong><a href="https://www.ulster.ac.uk/" class="link">Ulster.ac.uk</a></p>
        <br>
        <p><strong>Ulster Address: </strong> Northland Rd, Derry, BT48 7JL</p>

    </x-ui.card>

</x-layout>
