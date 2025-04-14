<div class="max-w-6xl mx-auto p-4">
    <h1 class="text-3xl text-gray-500 font-bold mb-6">💎 Treasures : </h1>
    @if(session('success'))
        <div class="mb-4 p-3 bg-green-100 border border-green-400 text-green-700 rounded">
            {{ session('success') }}
        </div>
    @endif

    @auth
    <!-- Add Button + Modal -->
    <button onclick="document.getElementById('uploadModal').classList.remove('hidden')" 
        class="mb-4 px-4 py-2 bg-blue-600 text-white rounded">+ share your treasure</button>

    <!-- Modal -->
    <div id="uploadModal" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center hidden">
        <form method="POST" action="{{ route('assets.store') }}" class="bg-white p-6 rounded w-96 space-y-4" class="bg-gray-900 p-6 rounded w-96 space-y-4 text-white" >
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
        <div class="bg-gray-800 rounded-xl shadow-md overflow-hidden flex h-48 text-white">
            <!-- Thumbnail -->
            <div class="w-1/3 h-full">
                <img src="{{ $asset->thumbnail }}" alt="Thumbnail" class="object-cover w-full h-full">
            </div>

            <!-- Content -->
            <div class="w-2/3 p-4 flex flex-col justify-between">
                <div>
                    <h2 class="text-lg font-semibold">{{ $asset->title }}</h2>
                    <p class="text-sm text-gray-300">Uploaded by: {{ $asset->user->name }}</p>
                </div>

                <div class="flex justify-between items-center mt-2">
                    <a href="{{ $asset->download_link }}" target="_blank" class="px-3 py-1 bg-blue-500 text-white rounded">Download</a>

                    @auth
                        @if(auth()->id() === $asset->user_id)
                            <form method="POST" action="{{ route('assets.destroy', $asset->id) }}" onsubmit="return confirm('Are you sure you want to delete this asset?');" >
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