<x-layout>
    <x-slot:title>
        JOBS
    </x-slot:title>
    <div class="space-y-4">
        <x-button href="/jobs/create">Create your new job</x-button>
        @foreach ($jobs as $job)
            <a href="/jobs/{{ $job['id'] }}" class="block px-4 py-6 border border-gray-200 rounded-lg">
                <div>
                    <p class="font-bold">{{ $job['title'] }}</p>
                    <p>{{ $job['salary'] }}</p>
                </div>
                <div>
                    Employer: 
                    <p class="text-blue-500">{{$job->employer->name}}</p>
                </div>
                {{-- <li>{{$job->name }}</li> --}}
                {{-- <p>{{ $job->email }}</p> --}}
            </a>
        @endforeach
        <div>
            {{-- to include links for pagination  --}}
            {{$jobs->links()}}
        </div>
    </div>
</x-layout>
