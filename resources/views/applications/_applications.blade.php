@if ($applications->isEmpty())
    <p>No applications yet for this vacancy.</p>
@else
    <div class="applications-list">
        @foreach ($applications as $application)
            <div class="application-card mb-4 p-4 border rounded shadow-sm">
                <div>
                    <h4 class="font-bold">{{ $application->name }}</h4>
                </div>
                <div>
                    <p><strong>Email:</strong> {{ $application->email }}</p>
                </div>
                <div>
                    <p><strong>Mobile:</strong> {{ $application->mobile_number }}</p>
                </div>
                <div>
                    <p><strong>Statement:</strong> {{ $application->statement }}</p>
                </div>

            </div>
        @endforeach
    </div>
@endif
