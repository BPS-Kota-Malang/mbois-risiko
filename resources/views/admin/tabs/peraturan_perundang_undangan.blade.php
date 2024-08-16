<div id="context2" class="tab-content hidden">
    <section class="bg-white dark:bg-gray-100">
        <div class="-my-2 py-2 overflow-x-auto sm:-mx-6 sm:px-6 lg:-mx-8 lg:px-8">
            <div
                class="align-middle inline-block min-w-full shadow overflow-hidden sm:rounded-lg border-b border-gray-200">
                <!-- Button to open the modal -->
                <button onclick="toggleModal('tambahperaturanModal')"
                    class="px-4 py-2 mb-2 bg-blue-500 rounded-md text-white font-medium tracking-wide hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-opacity-50 transition duration-300">
                    Tambah
                </button>
                <!-- Refresh button -->
                <button onclick="refreshTable()"
                    class="px-4 py-2 mb-2 bg-blue-500 rounded-md text-white font-medium tracking-wide hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-opacity-50 transition duration-300">
                    Refresh
                </button>
                <!-- Table -->
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                No</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Peraturan Perundang-undangan</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Amanat</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Actions</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @foreach ($peraturanPerundangUndangan as $item)
                            <tr>
                                <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-200">{{ $loop->iteration }}
                                </td>
                                <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-200">
                                    {{ $item->peraturan_perundang_undangan }}</td>
                                <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-200">{{ $item->amanat }}
                                </td>
                                <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-200">
                                    <a href="javascript:void(0)"
                                        onclick="openEditPPUModal('{{ route('admin.peraturan-perundang-undangan.update', $item->id) }}', '{{ $item->peraturan_perundang_undangan }}', '{{ $item->amanat }}')"
                                        class="text-indigo-600 hover:text-indigo-900 ml-4">Edit</a>
                                    <form action="{{ route('admin.peraturan-perundang-undangan.delete', $item->id) }}"
                                        method="POST" class="inline ml-4"
                                        onsubmit="return confirm('Are you sure you want to delete this item?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-red-600 hover:text-red-900">Delete</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </section>

    <!-- Add Modal -->
    <div id="tambahperaturanModal" class="fixed inset-0 flex items-center justify-center hidden">
        <div class="absolute inset-0 bg-gray-500" style="background-color: rgba(107, 114, 128, 0.5);"></div>
        <div class="bg-white border border-black shadow-md rounded-lg p-6 modal modal-content relative z-10">
            <div class="flex justify-between items-center mb-4">
                <h2 class="text-xl font-bold">Tambah Peraturan Perundang-undangan</h2>
                <button onclick="toggleModal('tambahperaturanModal')" class="text-gray-500 text-2xl ml-4">&times;</button>
            </div>
            <form action="{{ route('admin.peraturan-perundang-undangan.store') }}" method="POST">
                @csrf
                <div class="mb-4">
                    <label class="block text-gray-700 mb-2" for="peraturan-perundang-undangan">Peraturan
                        Perundang-undangan</label>
                    <input type="text" name="peraturan_perundang_undangan" id="peraturan-perundang-undangan"
                        value="{{ old('peraturan_perundang_undangan') }}"
                        class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
                        required>
                    @error('peraturan_perundang_undangan')
                        <p class="text-red-500 text-sm mt-2">{{ $message }}</p>
                    @enderror
                </div>
                <div class="mb-4">
                    <label class="block text-gray-700 mb-2" for="amanat">Amanat</label>
                    <input type="text" name="amanat" id="amanat" value="{{ old('amanat') }}"
                        class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                    @error('amanat')
                        <p class="text-red-500 text-sm mt-2">{{ $message }}</p>
                    @enderror
                </div>
                <div class="flex items-center justify-end">
                    <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded-md">Tambah</button>
                </div>
            </form>
        </div>
    </div>

    <!-- Edit Modal -->
    <div id="editPPUModal" class="fixed inset-0 flex items-center justify-center hidden">
        <div class="absolute inset-0 bg-gray-500" style="background-color: rgba(107, 114, 128, 0.5);"></div>
        <div class="bg-white border border-black shadow-md rounded-lg p-6 modal modal-content relative z-10">
            <div class="flex justify-between items-center mb-4">
                <h2 class="text-xl font-bold">Edit Peraturan Perundang-undangan</h2>
                <button onclick="toggleModal('editPPUModal')" class="text-gray-500 text-2xl ml-4">&times;</button>
            </div>
            <form id="editPPUForm" method="POST">
                @csrf
                @method('PUT')
                <div class="mb-4">
                    <label class="block text-gray-700 mb-2" for="peraturan_perundang_undangan_edit">Peraturan
                        Perundang-undangan</label>
                    <input type="text" name="peraturan_perundang_undangan" id="peraturan_perundang_undangan_edit"
                        class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
                        required>
                    @error('peraturan_perundang_undangan')
                        <p class="text-red-500 text-sm mt-2">{{ $message }}</p>
                    @enderror
                </div>
                <div class="mb-4">
                    <label class="block text-gray-700 mb-2" for="amanat_edit">Amanat</label>
                    <input type="text" name="amanat" id="amanat_edit"
                        class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                    @error('amanat')
                        <p class="text-red-500 text-sm mt-2">{{ $message }}</p>
                    @enderror
                </div>
                <div class="flex items-center justify-end">
                    <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded-md">Ubah</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    function toggleModal() {
        document.getElementById(ModalID).classList.toggle('hidden');
    }

    // function toggleEditPPUModal() {
    //     document.getElementById('editPPUModal').classList.toggle('hidden');
    // }

    function openEditPPUModal(url, peraturanPerundangUndangan, amanat) {
        const editPPUForm = document.getElementById('editPPUForm');
        editPPUForm.action = url;
        document.getElementById('peraturan_perundang_undangan_edit').value = peraturanPerundangUndangan;
        document.getElementById('amanat_edit').value = amanat;
        toggleModal('editPPUModal');
    }

    function refreshTable() {
        location.reload();
    }
</script>
