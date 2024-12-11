<x-admin-layout>
    <x-slot name="title">Custom Login</x-slot>

    <div class="container mx-auto py-6">
        <h1 class="text-2xl font-bold mb-4">Update Login Logo</h1>

        {{-- Pesan sukses --}}
        @if(session('success'))
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
                {{ session('success') }}
            </div>
        @endif

        {{-- Validasi error --}}
        @if ($errors->any())
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        {{-- Form upload logo --}}
        <form action="{{ route('admin.custom-login.update') }}" method="POST" enctype="multipart/form-data" class="bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4">
            @csrf
            <div class="mb-4">
                <label for="logo" class="block text-gray-700 text-sm font-bold mb-2">Upload Logo:</label>
                <input 
                    type="file" 
                    id="logo" 
                    name="logo" 
                    required 
                    class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                >
            </div>
        
            <div class="flex items-center justify-between">
                <button 
                    type="submit" 
                    class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline"
                >
                    Upload
                </button>
            </div>
        </form>
        
    </div>
</x-admin-layout>