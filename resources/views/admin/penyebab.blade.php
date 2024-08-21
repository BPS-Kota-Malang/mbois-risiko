<x-admin-layout>
    <div class="bg-white p-4 mb-4 border-2 border-white rounded-lg">
        <h3 class="text-gray-700 text-2xl font-medium">Penyebab Resiko</h3>
    </div>
    <div class="flex justify-between items-center mb-4">
        <div class="flex items-center">
            <label for="search" class="mr-2">Cari:</label>
            <input type="text" id="search" class="px-2 py-1 border border-gray-300 rounded-md">
        </div>
    </div>
    @if (session('success'))
        <div class="bg-green-500 p-4 mb-4 border-2 border-white rounded-lg text-white text-center">
            {{ session('success') }}
        </div>
    @endif
    <div class="overflow-x-auto bg-white shadow-md rounded-lg">
        <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-gray-50">
                <tr>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">No</th>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Penyebab</th>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
                <!-- Example data -->
                @foreach ($penyebab as $penyebab)
                    <tr>
                        <td class="px-6 py-4 whitespace-nowrap">{{ $loop->iteration }}</td>
                        <td class="px-6 py-4 whitespace-nowrap">{{ $penyebab->penyebab }}</td>
                        <td class="px-6 py-4 whitespace-nowrap">{{ $penyebab->status }}</td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <a href="" class="text-blue-600 hover:text-blue-900 border border-blue-600 hover:border-blue-900 rounded px-2 py-1" title="Edit">Edit</a>
                            <form action="{{ route('admin.penyebab.destroy', $penyebab->id) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-600 hover:text-red-900 border border-red-600 hover:border-red-900 rounded px-2 py-1" title="Delete">Delete</button>
                            </form>
                            @if (session('penyebab_deleted'))
                                <div class="text-red-600 mt-2">{{ session('penyebab_deleted') }}</div>
                            @endif
                        </td>
                        </td>
                    </tr>
                @endforeach
                <!-- Add more data here -->
            </tbody>
        </table>
    </div>
</x-admin-layout>
