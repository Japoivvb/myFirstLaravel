<x-layout>
    <x-slot:title>
        JOB
    </x-slot:title>
    <div class="container">
        <h2>{{ $job['name'] }}</h2>
        <p><strong>Email:</strong> {{ $job['email'] }}</p>
        <p><strong>Title:</strong> {{ $job['title'] }}</p>
        <p><strong>Salary:</strong> {{ $job['salary'] }}</p>
        {{-- to redirect back --}}
        <a href="{{ route('jobs') }}" class="btn btn-primary">Back to Jobs</a>
    </div>   
</x-layout>