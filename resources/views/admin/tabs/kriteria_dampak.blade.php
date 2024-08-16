<div id="context11" class="tab-content hidden">
    <section class="bg-white">
        <div class="-my-2 py-2 overflow-x-auto sm:-mx-6 sm:px-6 lg:-mx-8 lg:px-8">
            <div
                class="align-middle inline-block min-w-full shadow overflow-hidden sm:rounded-lg border-b border-gray-200">
                <form method="GET" action="{{ route('admin.risk.context') }}" class="mb-4">
                    <div class="flex items-end space-x-4">
                        <div class="relative w-48">
                            <label class="block text-gray-700 mb-2" for="filter_area_dampak">Filter Area Dampak</label>
                            <select name="filter_area_dampak" id="filter_area_dampak"
                                class="block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                                <option value="">Semua Area Dampak</option>
                                @foreach ($areaDampak as $area)
                                    <option value="{{ $area->id }}"
                                        {{ request('filter_area_dampak') == $area->id ? 'selected' : '' }}>
                                        {{ $area->area_dampak }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="relative w-48">
                            <label class="block text-gray-700 mb-2" for="filter_level_dampak">Filter Level
                                Dampak</label>
                            <select name="filter_level_dampak" id="filter_level_dampak"
                                class="block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                                <option value="">Semua Level Dampak</option>
                                @foreach ($levelDampak as $level)
                                    <option value="{{ $level->id }}"
                                        {{ request('filter_level_dampak') == $level->id ? 'selected' : '' }}>
                                        {{ $level->level_dampak }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="flex flex-col justify-end">
                            <button type="submit"
                                class="px-4 py-2 bg-blue-500 rounded-md text-white font-medium tracking-wide hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-opacity-50 transition duration-300">
                                Filter
                            </button>
                        </div>
                    </div>
                </form>

                <button onclick="toggleModal('tambahKriteriaDampakModal')"
                    class="px-4 py-2 mb-2 bg-blue-500 rounded-md text-white font-medium tracking-wide hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-opacity-50 transition duration-300">
                    Tambah Kriteria Dampak
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
                                Level Dampak
                            </th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Deskripsi Negatif
                            </th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Deskripsi Positif
                            </th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Actions
                            </th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @foreach ($kriteriaDampak as $kriteria)
                            <tr>
                                <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-200">
                                    {{ $loop->iteration }}
                                </td>
                                <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-200">
                                    {{ $kriteria->areaDampak->area_dampak }}
                                </td>
                                <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-200">
                                    {{ $kriteria->levelDampak->level_dampak }}
                                </td>
                                <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-200">
                                    {{ $kriteria->deskripsi_negatif }}
                                </td>
                                <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-200">
                                    {{ $kriteria->deskripsi_positif }}
                                </td>
                                <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-200">
                                    <a href="javascript:void(0)"
                                        onclick="openEditKriteriaDampakModal('{{ route('admin.kriteria-dampak.update', $kriteria->id) }}', '{{ $kriteria->id_area_dampak }}', '{{ $kriteria->id_level_dampak }}', '{{ $kriteria->deskripsi_negatif }}', '{{ $kriteria->deskripsi_positif }}')"
                                        class="text-indigo-600 hover:text-indigo-900 ml-4">Edit</a>
                                    <form action="{{ route('admin.kriteria-dampak.delete', $kriteria->id) }}"
                                        method="POST" class="inline ml-4"
                                        onsubmit="return confirm('Are you sure you want to delete this kriteria dampak?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-red-600 hover:text-red-900">Delete</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>

                <!-- Modal Tambah Kriteria Dampak -->
                <div id="tambahKriteriaDampakModal" class="fixed inset-0 flex items-center justify-center hidden">
                    <div class="absolute inset-0 bg-gray-900 opacity-50"></div>
                    <div
                        class="bg-white border border-black shadow-md rounded-lg p-6 modal modal-content relative z-10">
                        <div class="flex justify-between items-center mb-4">
                            <h2 class="text-xl font-bold">Tambah Kriteria Dampak</h2>
                            <button onclick="toggleModal('tambahKriteriaDampakModal')"
                                class="text-gray-500 text-2xl ml-4">&times;</button>
                        </div>
                        <form action="{{ route('admin.kriteria-dampak.store') }}" method="POST">
                            @csrf
                            <div class="mb-4">
                                <label class="block text-gray-700 mb-2" for="id_area_dampak">Area Dampak</label>
                                <select name="id_area_dampak" id="id_area_dampak"
                                    class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
                                    required>
                                    @foreach ($areaDampak as $area)
                                        <option value="{{ $area->id }}">{{ $area->area_dampak }}</option>
                                    @endforeach
                                </select>
                                @error('id_area_dampak')
                                    <p class="text-red-500 text-sm mt-2">{{ $message }}</p>
                                @enderror
                            </div>
                            <div class="mb-4">
                                <label class="block text-gray-700 mb-2" for="id_level_dampak">Level Dampak</label>
                                <select name="id_level_dampak" id="id_level_dampak"
                                    class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
                                    required>
                                    @foreach ($levelDampak as $level)
                                        <option value="{{ $level->id }}">{{ $level->level_dampak }}</option>
                                    @endforeach
                                </select>
                                @error('id_level_dampak')
                                    <p class="text-red-500 text-sm mt-2">{{ $message }}</p>
                                @enderror
                            </div>
                            <div class="mb-4">
                                <label class="block text-gray-700 mb-2" for="deskripsi_negatif">Deskripsi
                                    Negatif</label>
                                <input type="text" name="deskripsi_negatif" id="deskripsi_negatif"
                                    value="{{ old('deskripsi_negatif') }}"
                                    class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
                                    required>
                                @error('deskripsi_negatif')
                                    <p class="text-red-500 text-sm mt-2">{{ $message }}</p>
                                @enderror
                            </div>
                            <div class="mb-4">
                                <label class="block text-gray-700 mb-2" for="deskripsi_positif">Deskripsi
                                    Positif</label>
                                <input type="text" name="deskripsi_positif" id="deskripsi_positif"
                                    value="{{ old('deskripsi_positif') }}"
                                    class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
                                    required>
                                @error('deskripsi_positif')
                                    <p class="text-red-500 text-sm mt-2">{{ $message }}</p>
                                @enderror
                            </div>
                            <div class="flex justify-end">
                                <button type="submit"
                                    class="px-4 py-2 bg-blue-500 rounded-md text-white font-medium tracking-wide hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-opacity-50 transition duration-300">
                                    Simpan
                                </button>
                                <button type="button" onclick="toggleModal('tambahKriteriaDampakModal')"
                                    class="ml-2 px-4 py-2 bg-gray-300 rounded-md text-gray-800 font-medium tracking-wide hover:bg-gray-400 focus:outline-none focus:ring-2 focus:ring-gray-500 focus:ring-opacity-50 transition duration-300">
                                    Batal
                                </button>
                            </div>
                        </form>
                    </div>
                </div>

                <!-- Modal Edit Kriteria Dampak -->
                <div id="editKriteriaDampakModal" class="fixed inset-0 flex items-center justify-center hidden">
                    <div class="absolute inset-0 bg-gray-900 opacity-50"></div>
                    <div
                        class="bg-white border border-black shadow-md rounded-lg p-6 modal modal-content relative z-10">
                        <div class="flex justify-between items-center mb-4">
                            <h2 class="text-xl font-bold">Edit Kriteria Dampak</h2>
                            <button onclick="toggleModal('editKriteriaDampakModal')"
                                class="text-gray-500 text-2xl ml-4">&times;</button>
                        </div>
                        <form id="editKriteriaDampakForm" method="POST">
                            @csrf
                            @method('PUT')
                            <div class="mb-4">
                                <label class="block text-gray-700 mb-2" for="edit_id_area_dampak">Area Dampak</label>
                                <select name="id_area_dampak" id="edit_id_area_dampak"
                                    class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
                                    required>
                                    @foreach ($areaDampak as $area)
                                        <option value="{{ $area->id }}">{{ $area->area_dampak }}</option>
                                    @endforeach
                                </select>
                                @error('edit_id_area_dampak')
                                    <p class="text-red-500 text-sm mt-2">{{ $message }}</p>
                                @enderror
                            </div>
                            <div class="mb-4">
                                <label class="block text-gray-700 mb-2" for="edit_id_level_dampak">Level
                                    Dampak</label>
                                <select name="id_level_dampak" id="edit_id_level_dampak"
                                    class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
                                    required>
                                    @foreach ($levelDampak as $level)
                                        <option value="{{ $level->id }}">{{ $level->level_dampak }}</option>
                                    @endforeach
                                </select>
                                @error('edit_id_level_dampak')
                                    <p class="text-red-500 text-sm mt-2">{{ $message }}</p>
                                @enderror
                            </div>
                            <div class="mb-4">
                                <label class="block text-gray-700 mb-2" for="edit_deskripsi_negatif">Deskripsi
                                    Negatif</label>
                                <input type="text" name="deskripsi_negatif" id="edit_deskripsi_negatif"
                                    class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
                                    required>
                                @error('edit_deskripsi_negatif')
                                    <p class="text-red-500 text-sm mt-2">{{ $message }}</p>
                                @enderror
                            </div>
                            <div class="mb-4">
                                <label class="block text-gray-700 mb-2" for="edit_deskripsi_positif">Deskripsi
                                    Positif</label>
                                <input type="text" name="deskripsi_positif" id="edit_deskripsi_positif"
                                    class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
                                    required>
                                @error('edit_deskripsi_positif')
                                    <p class="text-red-500 text-sm mt-2">{{ $message }}</p>
                                @enderror
                            </div>
                            <div class="flex justify-end">
                                <button type="submit"
                                    class="px-4 py-2 bg-blue-500 rounded-md text-white font-medium tracking-wide hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-opacity-50 transition duration-300">
                                    Simpan
                                </button>
                                <button type="button" onclick="toggleModal('editKriteriaDampakModal')"
                                    class="ml-2 px-4 py-2 bg-gray-300 rounded-md text-gray-800 font-medium tracking-wide hover:bg-gray-400 focus:outline-none focus:ring-2 focus:ring-gray-500 focus:ring-opacity-50 transition duration-300">
                                    Batal
                                </button>
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

    function openEditKriteriaDampakModal(url, areaDampakId, levelDampakId, deskripsiNegatif, deskripsiPositif) {
        const form = document.getElementById('editKriteriaDampakForm');
        form.action = url;
        document.getElementById('edit_id_area_dampak').value = areaDampakId;
        document.getElementById('edit_id_level_dampak').value = levelDampakId;
        document.getElementById('edit_deskripsi_negatif').value = deskripsiNegatif;
        document.getElementById('edit_deskripsi_positif').value = deskripsiPositif;
        toggleModal('editKriteriaDampakModal');
    }
</script>
