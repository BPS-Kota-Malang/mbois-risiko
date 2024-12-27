<x-admin-layout>
    <div class="p-4 mb-4 bg-white border-2 border-white rounded-lg">
        <h3 class="text-2xl font-medium text-gray-700">Dampak</h3>
    </div>

    <!-- Form Pencarian -->
    <div class="flex items-center justify-between mb-4">
        <form action="{{ route('admin.dampak.index') }}" method="GET" class="flex items-center">
            <label for="search" class="mr-2">Cari:</label>
            <input type="text" name="search" id="search" class="px-2 py-1 border border-gray-300 rounded-md" value="{{ request('search') }}">
            <button type="submit" class="px-4 py-1 ml-2 text-white bg-blue-500 rounded">Cari</button>
        </form>
    </div>

    <!-- Pesan Sukses -->
    @if (session('success'))
        <div class="p-4 mb-4 text-center text-white bg-green-500 border-2 border-white rounded-lg">
            {{ session('success') }}
        </div>
    @endif

    <!-- Tabel Dampak -->
    <div class="overflow-x-auto bg-white rounded-lg shadow-md">
        <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-gray-50">
                <tr>
                    <th scope="col" class="px-6 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase">No</th>
                    <th scope="col" class="px-6 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase">Dampak</th>
                    <th scope="col" class="px-6 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase">Status</th>
                    <th scope="col" class="px-6 py-3 text-xs font-medium tracking-wider text-center text-gray-500 uppercase">Actions</th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
                @forelse ($dampak as $item)
                <tr>
                    <td class="px-6 py-4 whitespace-nowrap">{{ $loop->iteration + ($dampak->currentPage() - 1) * $dampak->perPage() }}</td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <span id="dampak-text-{{ $item->id }}" class="cursor-pointer dampak-text" onclick="editDampak({{ $item->id }})">
                            {{ $item->name }}
                        </span>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <span id="status-{{ $item->id }}" class="status-label @if($item->status == 'On Progress') bg-yellow-500 text-yellow-800 @elseif($item->status == 'Accepted') bg-green-500 text-green-800 @elseif($item->status == 'Rejected') bg-red-500 text-red-800 @else bg-gray-500 text-gray-800 @endif font-semibold px-2 py-1 rounded">
                            {{ $item->status }}
                        </span>
                    </td>
                    <td class="px-6 py-4 text-center whitespace-nowrap">
                        <div class="inline-flex items-center justify-center space-x-4">
                            <button onclick="updateStatus({{ $item->id }}, 'Accepted')" class="p-2 text-green-500 border-2 border-green-500 rounded-lg hover:text-white hover:bg-green-500" title="Accept">
                                <i class="fas fa-check"></i>
                            </button>
                            <button onclick="updateStatus({{ $item->id }}, 'Rejected')" class="p-2 text-red-500 border-2 border-red-500 rounded-lg hover:text-white hover:bg-red-500" title="Reject">
                                <i class="fas fa-times"></i>
                            </button>
                            <form action="{{ route('admin.dampak.destroy', $item->id) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus dampak ini?');" class="inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="p-2 text-gray-500 border-2 border-gray-500 rounded-lg hover:text-white hover:bg-gray-500" title="Delete">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="4" class="px-6 py-4 text-center text-gray-500">Data Dampak Belum Ada</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <!-- Pagination -->
    <div class="mt-4">
        {{ $dampak->appends(request()->except('page'))->links('pagination::tailwind') }}
    </div>

    <!-- Struktur Modal -->
    <div id="editModal" class="fixed inset-0 flex items-center justify-center hidden">
        <div class="w-1/3 p-6 bg-white rounded-lg shadow-lg">
            <div class="flex items-center justify-between pb-2 mb-4 border-b">
                <h2 class="text-xl font-bold">Edit Dampak</h2>
                <button id="closeModal" class="text-xl text-gray-700">&times;</button>
            </div>
            <form id="editForm" action="" method="POST">
                @csrf
                @method('PUT')
                <div class="mb-4">
                    <label for="dampak" class="block text-sm font-medium text-gray-700">Dampak</label>
                    <input type="text" name="dampak" id="dampakInput" class="block w-full mt-1 border border-gray-300 rounded-md shadow-sm" required>
                </div>
                <div class="mb-4">
                    <label for="status" class="block text-sm font-medium text-gray-700">Status</label>
                    <select name="status" id="statusInput" class="block w-full mt-1 border border-gray-300 rounded-md shadow-sm" required>
                        <option value="On Progress">On Progress</option>
                        <option value="Accepted">Accepted</option>
                        <option value="Rejected">Rejected</option>
                    </select>
                </div>
                <div class="flex justify-end">
                    <button type="submit" class="px-4 py-2 text-white bg-blue-600 rounded">Simpan</button>
                </div>
            </form>
        </div>
    </div>


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

                dampakText.innerHTML = `<input type="text" value="${currentText}" class="p-1 border border-gray-300 rounded-md">`;

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
                            name: newValue,
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
