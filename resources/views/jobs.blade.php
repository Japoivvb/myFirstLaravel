<x-layout>
    <x-slot:title>
        JOBS
    </x-slot:title>
    <ul>
    @foreach ( $jobs as $job )
    <a href="/jobs/{{ $job['id'] }}" class="text-blue-500 hover:underline">
        <li>{{ $job['name'] }}</li>
        <p>{{ $job['email'] }}</p>
        {{-- <li>{{$job->name }}</li> --}}
        {{-- <p>{{ $job->email }}</p> --}}
    </a>        
    @endforeach
    </ul>
</x-layout>