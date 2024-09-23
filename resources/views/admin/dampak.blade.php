<x-admin-layout>
    <div class="bg-white p-4 mb-4 border-2 border-white rounded-lg">
        <h3 class="text-gray-700 text-2xl font-medium">Dampak</h3>
    </div>

    <!-- Form Pencarian -->
    <div class="flex justify-between items-center mb-4">
        <form action="{{ route('admin.dampak.index') }}" method="GET" class="flex items-center">
            <label for="search" class="mr-2">Cari:</label>
            <input type="text" name="search" id="search" class="px-2 py-1 border border-gray-300 rounded-md" value="{{ request('search') }}">
            <button type="submit" class="ml-2 bg-blue-500 text-white px-4 py-1 rounded">Cari</button>
        </form>
    </div>

    <!-- Pesan Sukses -->
    @if (session('success'))
        <div class="bg-green-500 p-4 mb-4 border-2 border-white rounded-lg text-white text-center">
            {{ session('success') }}
        </div>
    @endif

    <!-- Tabel Dampak -->
    <div class="overflow-x-auto bg-white shadow-md rounded-lg">
        <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-gray-50">
                <tr>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">No</th>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Dampak</th>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                    <th scope="col" class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
                @foreach ($dampak as $item)
                <tr>
                    <td class="px-6 py-4 whitespace-nowrap">{{ $loop->iteration + ($dampak->currentPage() - 1) * $dampak->perPage() }}</td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <span id="dampak-text-{{ $item->id }}" class="dampak-text cursor-pointer" onclick="editDampak({{ $item->id }})">
                            {{ $item->dampak }}
                        </span>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <span id="status-{{ $item->id }}" class="status-label @if($item->status == 'On Progress') bg-yellow-500 text-yellow-800 @elseif($item->status == 'Accepted') bg-green-500 text-green-800 @elseif($item->status == 'Rejected') bg-red-500 text-red-800 @else bg-gray-500 text-gray-800 @endif font-semibold px-2 py-1 rounded">
                            {{ $item->status }}
                        </span>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-center">
                        <div class="inline-flex space-x-4 justify-center items-center">
                            <button onclick="updateStatus({{ $item->id }}, 'Accepted')" class="border-2 border-green-500 text-green-500 hover:text-white hover:bg-green-500 p-2 rounded-lg" title="Accept">
                                <i class="fas fa-check"></i>
                            </button>
                            <button onclick="updateStatus({{ $item->id }}, 'Rejected')" class="border-2 border-red-500 text-red-500 hover:text-white hover:bg-red-500 p-2 rounded-lg" title="Reject">
                                <i class="fas fa-times"></i>
                            </button>
                            <form action="{{ route('admin.dampak.destroy', $item->id) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus dampak ini?');" class="inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="border-2 border-gray-500 text-gray-500 hover:text-white hover:bg-gray-500 p-2 rounded-lg" title="Delete">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <!-- Pagination -->
    <div class="mt-4">
        {{ $dampak->appends(request()->except('page'))->links('pagination::tailwind') }}
    </div>

    <!-- Struktur Modal -->
    <div id="editModal" class="fixed inset-0 flex items-center justify-center hidden">
        <div class="bg-white p-6 rounded-lg shadow-lg w-1/3">
            <div class="flex justify-between items-center border-b pb-2 mb-4">
                <h2 class="text-xl font-bold">Edit Dampak</h2>
                <button id="closeModal" class="text-gray-700 text-xl">&times;</button>
            </div>
            <form id="editForm" action="" method="POST">
                @csrf
                @method('PUT')
                <div class="mb-4">
                    <label for="dampak" class="block text-sm font-medium text-gray-700">Dampak</label>
                    <input type="text" name="dampak" id="dampakInput" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm" required>
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

    <!-- JavaScript untuk Menghandle Aksi -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/js/all.min.js"></script>
    <script>
        function updateStatus(id, status) {
            fetch(`{{ url('admin/dampak') }}/${id}`, {
                method: 'PUT',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                },
                body: JSON.stringify({ status }),
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    document.getElementById(`status-${id}`).className = `status-label ${status === 'On Progress' ? 'bg-yellow-500 text-yellow-800' : status === 'Accepted' ? 'bg-green-500 text-green-800' : 'bg-red-500 text-red-800'} font-semibold px-2 py-1 rounded`;
                    document.getElementById(`status-${id}`).textContent = status;
                } else {
                    alert('Gagal memperbarui status.');
                }
            })
            .catch(error => {
                console.error('Error:', error);
                alert('Terjadi kesalahan.');
            });
        }

        function editDampak(id) {
            const dampakText = document.getElementById(`dampak-text-${id}`);
            const statusText = document.getElementById(`status-${id}`).textContent;

            if (!dampakText.classList.contains('editing')) {
                dampakText.classList.add('editing');
                const currentText = dampakText.textContent.trim(); 

                dampakText.innerHTML = `<input type="text" value="${currentText}" class="border border-gray-300 rounded-md p-1">`;

                const inputField = dampakText.querySelector('input');
                inputField.focus();

                inputField.addEventListener('blur', function() {
                    const newValue = this.value.trim();

                    fetch(`{{ url('admin/dampak') }}/${id}`, {
                        method: 'PUT',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': '{{ csrf_token() }}',
                        },
                        body: JSON.stringify({
                            dampak: newValue,
                            status: statusText 
                        }),
                    })
                    .then(response => response.json())
                    .then(data => {
                        if (data.success) {
                            dampakText.textContent = newValue;
                            dampakText.classList.remove('editing');
                        } else {
                            alert('Gagal memperbarui dampak.');
                        }
                    })
                    .catch(error => {
                        console.error('Error:', error);
                        alert('Terjadi kesalahan.');
                    });
                });

                inputField.addEventListener('keypress', function(event) {
                    if (event.key === 'Enter') {
                        this.blur();
                    }
                });
            }
        }

        document.getElementById('closeModal').addEventListener('click', function() {
            document.getElementById('editModal').classList.add('hidden');
        });

    </script>
</x-admin-layout>
