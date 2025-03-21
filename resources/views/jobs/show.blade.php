<x-app-layout><x-layout>
        <x-slot:title>
            JOB
        </x-slot:title>
        <div class="container">
            <h2>{{ $job->name }}</h2>
            <p><strong>Email:</strong> {{ $job->email }}</p>
            <p><strong>Title:</strong> {{ $job->title }}</p>
            <p><strong>Salary:</strong> {{ $job->salary }}</p>

            {{-- to edit the job  --}}
            {{-- authorize, only show button if it can edit based on AppServiceProvider.boot --}}
            @can('edit-job', $job)
            <p class="mt-6 mb-6">
                <x-button href="/jobs/{{ $job->id }}/edit">Edit Job</x-button>
            </p>
            @endcan

            {{-- to redirect back --}}
            <p class="mt-6">
                <x-button href="{{ route('jobs') }}">Back to Jobs</x-button>
            </p>
        </div>
    </x-layout>
</x-app-layout>
