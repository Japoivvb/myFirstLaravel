<x-layout>
    <x-slot:title>
        JOB
    </x-slot:title>
    <div class="container">
        <h2>{{ $job['name'] }}</h2>
        <p><strong>Email:</strong> {{ $job['email'] }}</p>
        {{-- to redirect back --}}
        <a href="{{ route('jobs') }}" class="btn btn-primary">Back to Jobs</a>
    </div>   
</x-layout>