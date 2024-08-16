<div id="context7" class="tab-content hidden">
    <section class="bg-white dark:bg-gray-100">
        <div class="-my-2 py-2 overflow-x-auto sm:-mx-6 sm:px-6 lg:-mx-8 lg:px-8">
            <div
                class="align-middle inline-block min-w-full shadow overflow-hidden sm:rounded-lg border-b border-gray-200">
                <button onclick="toggleModal('tambahAreaDampakModal')"
                    class="px-4 py-2 mb-2 bg-blue-500 rounded-md text-white font-medium tracking-wide hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-opacity-50 transition duration-300">
                    Tambah Area Dampak
                </button>
                <button
                    class="px-4 py-2 mb-2 bg-gray-300 rounded-md text-gray-800 font-medium tracking-wide hover:bg-gray-400 focus:outline-none focus:ring-2 focus:ring-gray-500 focus:ring-opacity-50 transition duration-300">
                    Refresh
                </button>
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                No
                            </th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Area Dampak
                            </th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Actions
                            </th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @foreach ($areaDampak as $area)
                            <tr>
                                <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-200">
                                    {{ $loop->iteration }}
                                </td>
                                <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-200">
                                    {{ $area->area_dampak }}
                                </td>
                                <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-200">
                                    <a href="javascript:void(0)"
                                        onclick="openEditAreaDampakModal('{{ route('admin.area-dampak.update', $area->id) }}', '{{ $area->area_dampak }}')"
                                        class="text-indigo-600 hover:text-indigo-900 ml-4">Edit</a>
                                    <form action="{{ route('admin.area-dampak.delete', $area->id) }}" method="POST"
                                        class="inline ml-4"
                                        onsubmit="return confirm('Are you sure you want to delete this area dampak?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-red-600 hover:text-red-900">Delete</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>

                <div id="tambahAreaDampakModal" class="fixed inset-0 flex items-center justify-center hidden">
                    <div class="absolute inset-0 bg-gray-900 opacity-50"></div>
                    <div
                        class="bg-white border border-black shadow-md rounded-lg p-6 modal modal-content relative z-10">
                        <div class="flex justify-between items-center mb-4">
                            <h2 class="text-xl font-bold">Tambah Area Dampak</h2>
                            <button onclick="toggleModal('tambahAreaDampakModal')"
                                class="text-gray-500 text-2xl ml-4">&times;</button>
                        </div>
                        <form action="{{ route('admin.area-dampak.store') }}" method="POST">
                            @csrf
                            <div class="mb-4">
                                <label class="block text-gray-700 mb-2" for="area_dampak">Area Dampak</label>
                                <input type="text" name="area_dampak" id="area_dampak"
                                    value="{{ old('area_dampak') }}"
                                    class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
                                    required>
                                @error('area_dampak')
                                    <p class="text-red-500 text-sm mt-2">{{ $message }}</p>
                                @enderror
                            </div>
                            <div class="flex items-center justify-end">
                                <button type="submit"
                                    class="bg-blue-500 text-white px-4 py-2 rounded-md">Tambah</button>
                            </div>
                        </form>
                    </div>
                </div>

                <div id="editAreaDampakModal" class="fixed inset-0 flex items-center justify-center hidden">
                    <div class="absolute inset-0 bg-gray-900 opacity-50"></div>
                    <div
                        class="bg-white border border-black shadow-md rounded-lg p-6 modal modal-content relative z-10">
                        <div class="flex justify-between items-center mb-4">
                            <h2 class="text-xl font-bold">Edit Area Dampak</h2>
                            <button onclick="toggleModal('editAreaDampakModal')"
                                class="text-gray-500 text-2xl ml-4">&times;</button>
                        </div>
                        <form id="editAreaDampakForm" method="POST">
                            @csrf
                            @method('PUT')
                            <div class="mb-4">
                                <label class="block text-gray-700 mb-2" for="area_dampak_edit">Area Dampak</label>
                                <input type="text" name="area_dampak" id="area_dampak_edit"
                                    class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
                                    required>
                                @error('area_dampak')
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
        </div>
    </section>
</div>

<script>
    function toggleModal(modalId) {
        document.getElementById(modalId).classList.toggle('hidden');
    }

    function openEditAreaDampakModal(url, areaDampak) {
        const editAreaDampakForm = document.getElementById('editAreaDampakForm');
        editAreaDampakForm.action = url;
        document.getElementById('area_dampak_edit').value = areaDampak;
        toggleModal('editAreaDampakModal');
    }
</script>
