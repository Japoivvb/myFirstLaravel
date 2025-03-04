<x-app-layout>
    <x-layout>
        <x-slot:title>
            Editing Job {{ $job->title }}
        </x-slot:title>
        <div class="container">
            <form method="POST" action="/jobs/{{ $job->id }}">
                {{-- to avoid cross site request forgery --}}
                @csrf
                {{-- to send form as patch action --}}
                @method('PATCH')
                <div class="space-y-12">
                    <div class="border-b border-gray-900/10 pb-12">
                        <p class="mt-1 text-sm/6 text-gray-600">This information will be used to publish a new job.</p>

                        <div class="mt-10 grid grid-cols-1 gap-x-6 gap-y-8 sm:grid-cols-6">
                            <div class="sm:col-span-4">
                                <label for="username" class="block text-sm/6 font-medium text-gray-900">Username</label>
                                <div class="mt-2">
                                    <div
                                        class="flex items-center rounded-md bg-white pl-3 border border-black outline-1 -outline-offset-1 outline-gray-300 focus-within:outline-2 focus-within:-outline-offset-2 focus-within:outline-indigo-600">
                                        <input type="text" name="username" id="username"
                                            class="block min-w-0 grow py-1.5 pr-3 pl-1 text-base text-gray-900 placeholder:text-gray-400 focus:outline-none sm:text-sm/6"
                                            value="{{ $job->name }}" placeholder="janesmith" required>
                                    </div>
                                    {{-- in case error in validate name --}}
                                    @error('username')
                                        <p class="text-red-500">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>
                            <div class="sm:col-span-4">
                                <label for="usermail" class="block text-sm/6 font-medium text-gray-900">Usermail</label>
                                <div class="mt-2">
                                    <div
                                        class="flex items-center rounded-md bg-white pl-3 border border-black outline-1 -outline-offset-1 outline-gray-300 focus-within:outline-2 focus-within:-outline-offset-2 focus-within:outline-indigo-600">
                                        <input type="text" name="usermail" id="usermail"
                                            class="block min-w-0 grow py-1.5 pr-3 pl-1 text-base text-gray-900 placeholder:text-gray-400 focus:outline-none sm:text-sm/6"
                                            value="{{ $job->email }}" placeholder="janesmith@gmail.com" required>
                                    </div>
                                    {{-- in case error in validate mail --}}
                                    @error('usermail')
                                        <p class="text-red-500">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>
                            <div class="sm:col-span-4">
                                <label for="title" class="block text-sm/6 font-medium text-gray-900">Title</label>
                                <div class="mt-2">
                                    <div
                                        class="flex items-center rounded-md bg-white pl-3 border border-black outline-1 -outline-offset-1 outline-gray-300 focus-within:outline-2 focus-within:-outline-offset-2 focus-within:outline-indigo-600">
                                        <input type="text" name="title" id="title"
                                            class="block min-w-0 grow py-1.5 pr-3 pl-1 text-base text-gray-900 placeholder:text-gray-400 focus:outline-none sm:text-sm/6"
                                            value="{{ $job->title }}" placeholder="Fire Fighter" required>
                                    </div>
                                    {{-- in case error in validate title --}}
                                    @error('title')
                                        <p class="text-red-500">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>
                            <div class="sm:col-span-4">
                                <label for="salay" class="block text-sm/6 font-medium text-gray-900">Salary</label>
                                <div class="mt-2">
                                    <div
                                        class="flex items-center rounded-md bg-white pl-3 border border-black outline-1 -outline-offset-1 outline-gray-300 focus-within:outline-2 focus-within:-outline-offset-2 focus-within:outline-indigo-600">
                                        <input type="text" name="salary" id="salary"
                                            class="block min-w-0 grow py-1.5 pr-3 pl-1 text-base text-gray-900 placeholder:text-gray-400 focus:outline-none sm:text-sm/6"
                                            value="{{ $job->salary }}" placeholder="$14,000" required>
                                    </div>
                                    {{-- in case error in validate salary --}}
                                    @error('salary')
                                        <p class="text-red-500">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        {{-- <div class="mt-10">
                        @if ($errors->any())
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li class="text-red-500">{{ $error }}</li>
                                @endforeach
                            </ul>
                        @endif
                    </div> --}}
                    </div>
                </div>

                <div class="mt-6 flex items-center justify-between">
                    <div class="flex items-center gap-x-6">
                        <button form="delete-form" type="submit"
                            class="rounded-md bg-red-600 px-3 py-2 text-sm font-semibold text-white shadow-xs hover:bg-red-500 focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">Delete</button>
                    </div>
                    <div class="flex items-center gap-x-6">
                        <a href="/jobs/{{ $job->id }}" class="text-sm/6 font-semibold text-gray-900">Cancel</a>
                        <button type="submit"
                            class="rounded-md bg-indigo-600 px-3 py-2 text-sm font-semibold text-white shadow-xs hover:bg-indigo-500 focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">Update</button>
                    </div>
                </div>
            </form>

            <form method="POST" action="/jobs/{{ $job->id }}" class="hidden" id="delete-form">
                @csrf
                @method('DELETE')
            </form>

            {{-- to redirect back --}}
            <a href="{{ route('jobs') }}" class="btn btn-primary">Back to Jobs</a>
        </div>
    </x-layout>
</x-app-layout>
