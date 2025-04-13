<x-app-layout>
    <div class="max-w-6xl mx-auto p-4">
        <h1 class="text-3xl font-bold mb-6">Public Assets</h1>
        @if(session('success'))
            <div class="mb-4 p-3 bg-green-100 border border-green-400 text-green-700 rounded">
                {{ session('success') }}
            </div>
        @endif
    
        @auth
        <!-- Add Button + Modal -->
        <button onclick="document.getElementById('uploadModal').classList.remove('hidden')" 
            class="mb-4 px-4 py-2 bg-blue-600 text-white rounded">+ Add Asset</button>

        <!-- Modal -->
        <div id="uploadModal" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center hidden">
            <form method="POST" action="{{ route('assets.store') }}" class="bg-white p-6 rounded w-96 space-y-4">
                @csrf
                <input name="title" placeholder="Asset Title" class="w-full border p-2" required>
                <input name="thumbnail" placeholder="Thumbnail URL" class="w-full border p-2" required>
                <input name="download_link" placeholder="Download Link" class="w-full border p-2" required>
                <div class="flex justify-end gap-2">
                    <button type="button" onclick="document.getElementById('uploadModal').classList.add('hidden')" class="px-4 py-2 bg-gray-300">Cancel</button>
                    <button type="submit" class="px-4 py-2 bg-green-600 text-white">Upload</button>
                </div>
            </form>
        </div>
        @endauth

        <!-- Asset Cards -->
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-6">
            @foreach($assets as $asset)
            <div class="bg-white rounded-xl shadow-md overflow-hidden">
                <img src="{{ $asset->thumbnail }}" alt="Thumbnail" class="w-full h-48 object-cover">
                <div class="p-4">
                    <h2 class="text-lg font-semibold">{{ $asset->title }}</h2>
                    <p class="text-sm text-gray-500">Uploaded by {{ $asset->user->name }}</p>
                    <a href="{{ $asset->download_link }}" target="_blank" class="inline-block mt-2 px-3 py-1 bg-blue-500 text-white rounded">Download</a>
                </div>
            </div>
            @auth
                @if(auth()->id() === $asset->user_id)
                    <form method="POST" action="{{ route('assets.destroy', $asset->id) }}" onsubmit="return confirm('Are you sure you want to delete this asset?');" class="mt-2">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="px-3 py-1 bg-red-600 text-white rounded">Delete</button>
                    </form>
                @endif
            @endauth
            @endforeach
        </div>
    </div>
</x-app-layout>
