<x-admin-layout>
    <div class="bg-white p-4 mb-4 border-2 border-white rounded-lg">
        <h3 class="text-gray-700 text-2xl font-medium">Resiko</h3>
    </div>
    <div class="flex justify-between items-center mb-4">
        <form action="{{ route('admin.resiko.index') }}" method="GET" class="flex items-center">
            <label for="search" class="mr-2">Cari:</label>
            <input type="text" name="search" id="search" class="px-2 py-1 border border-gray-300 rounded-md" value="{{ request('search') }}">
            <button type="submit" class="ml-2 bg-blue-500 text-white px-4 py-1 rounded">Cari</button>
        </form>
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
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Resiko</th>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                    <th scope="col" class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
                @foreach ($resiko as $resiko)
                <tr>
                    <td class="px-6 py-4 whitespace-nowrap">{{ $loop->iteration }}</td>
                    <td class="px-6 py-4 whitespace-nowrap">{{ $resiko->resiko }}</td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <span class="
                            @if($resiko->status == 'On Progress') 
                                bg-yellow-500 text-yellow-800 
                            @elseif($resiko->status == 'Accepted') 
                                bg-green-500 text-green-800 
                            @elseif($resiko->status == 'Rejected') 
                                bg-red-500 text-red-800 
                            @else 
                                bg-gray-500 text-gray-800 
                            @endif
                        font-semibold px-2 py-1 rounded">
                            {{ $resiko->status }}
                        </span>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-center">
                        <div class="inline-flex space-x-4 justify-center items-center">
                            <a href="javascript:void(0);" 
                               onclick="openModal('{{ route('admin.resiko.update', $resiko->id) }}', '{{ $resiko->resiko }}', '{{ $resiko->status }}')" 
                               class="bg-blue-600 text-white hover:bg-blue-700 border border-blue-700 rounded px-4 py-2 transition duration-300 ease-in-out" 
                               title="Edit">
                                Edit
                            </a>
                            <form action="{{ route('admin.resiko.destroy', $resiko->id) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit" 
                                        class="bg-red-600 text-white hover:bg-red-700 border border-red-700 rounded px-4 py-2 transition duration-300 ease-in-out" 
                                        title="Delete">
                                    Delete
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <!-- Modal Overlay -->
    <div id="modalOverlay" class="fixed inset-0 bg-gray-900 opacity-50 hidden"></div>

    <!-- Modal Structure -->
    <div id="editModal" class="fixed inset-0 flex items-center justify-center hidden">
        <div class="bg-white p-6 rounded-lg shadow-lg w-1/3">
            <div class="flex justify-between items-center border-b pb-2 mb-4">
                <h2 class="text-xl font-bold">Edit Resiko</h2>
                <button id="closeModal" class="text-gray-700 text-xl">&times;</button>
            </div>
            <form id="editForm" action="" method="POST" class="mt-4">
                @csrf
                @method('PUT')
                <div class="mb-4">
                    <label for="resiko" class="block text-sm font-medium text-gray-700">Resiko</label>
                    <input type="text" name="resiko" id="resikoInput" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm" required>
                </div>
                <div class="mb-4">
                    <label for="status" class="block text-sm font-medium text-gray-700">Status</label>
                    <select name="status" id="statusInput" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm" required>
                        <option value="On Progress">On Progress</option>
                        <option value="Accepted">Accepted</option>
                        <option value="Rejected">Rejected</option>
                    </select>
                </div>
                <div class="flex justify-end">
                    <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded">Simpan</button>
                </div>
            </form>
        </div>
    </div>

    <!-- JavaScript to Handle Modal -->
    <script>
    function openModal(action, resiko, status) {
    document.getElementById('editForm').action = action;
    document.getElementById('resikoInput').value = resiko;
    document.getElementById('statusInput').value = status;

    document.getElementById('editModal').classList.remove('hidden');
    document.getElementById('modalOverlay').classList.remove('hidden');
}


    document.getElementById('closeModal').addEventListener('click', function() {
        document.getElementById('editModal').classList.add('hidden');
        document.getElementById('modalOverlay').classList.add('hidden');
    });

    </script>

</x-admin-layout>
