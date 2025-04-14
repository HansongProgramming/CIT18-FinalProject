<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    {{ __("You're logged in!") }}
                </div>
            </div>
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-6">
                @foreach($assets as $asset)
                <div class="bg-white rounded-xl shadow-md overflow-hidden flex h-48">
                    <!-- Thumbnail -->
                    <div class="w-1/3 h-full">
                        <img src="{{ $asset->thumbnail }}" alt="Thumbnail" class="object-cover w-full h-full">
                    </div>
    
                    <!-- Content -->
                    <div class="w-2/3 p-4 flex flex-col justify-between">
                        <div>
                            <h2 class="text-lg font-semibold">{{ $asset->title }}</h2>
                            <p class="text-sm text-gray-500">Uploaded by: {{ $asset->user->name }}</p>
                        </div>
    
                        <div class="flex justify-between items-center mt-2">
                            <a href="{{ $asset->download_link }}" target="_blank" class="px-3 py-1 bg-blue-500 text-white rounded">Download</a>
    
                            @auth
                                @if(auth()->id() === $asset->user_id)
                                    <form method="POST" action="{{ route('assets.destroy', $asset->id) }}" onsubmit="return confirm('Are you sure you want to delete this asset?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="px-3 py-1 bg-red-600 text-white rounded">Delete</button>
                                    </form>
                                @endif
                            @endauth
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>
</x-app-layout>
