<div id="context12" class="hidden tab-content">
    <section class="bg-white">
        <div class="py-2 -my-2 overflow-x-auto sm:-mx-6 sm:px-6 lg:-mx-8 lg:px-8">
            <div
                class="inline-block min-w-full overflow-hidden align-middle border-b border-gray-200 shadow sm:rounded-lg">
                <form method="GET" action="{{ route('admin.risk.context') }}" class="mb-4">
                    <div class="flex items-end space-x-4">
                        <div class="relative w-48">
                            <label class="block mb-2 text-gray-700" for="filter_area_dampak">Filter Area Dampak</label>
                            <select name="filter_area_dampak" id="filter_area_dampak"
                                class="block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                                <option value="">Semua Area Dampak</option>
                                @foreach ($areaDampak as $area)
                                    <option value="{{ $area->id }}"
                                        {{ request('filter_area_dampak') == $area->id ? 'selected' : '' }}>
                                        {{ $area->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="relative w-48">
                            <label class="block mb-2 text-gray-700" for="filter_level_dampak">Filter Level
                                Dampak</label>
                            <select name="filter_level_dampak" id="filter_level_dampak"
                                class="block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                                <option value="">Semua Level Dampak</option>
                                @foreach ($levelDampak as $level)
                                    <option value="{{ $level->id }}"
                                        {{ request('filter_level_dampak') == $level->id ? 'selected' : '' }}>
                                        {{ $level->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="flex flex-col justify-end">
                            <button type="submit"
                                class="px-4 py-2 font-medium tracking-wide text-white transition duration-300 bg-blue-500 rounded-md hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-opacity-50">
                                Filter
                            </button>
                        </div>
                    </div>
                </form>
                @if (auth()->check() && auth()->user()->hasRole('admin'))
                <button onclick="toggleModal('tambahKriteriaDampakModal')"
                    class="px-4 py-2 mb-2 font-medium tracking-wide text-white transition duration-300 bg-blue-500 rounded-md hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-opacity-50">
                    Tambah Kriteria Dampak
                </button>
                @endif

                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-6 py-3 text-xs font-medium tracking-wider text-left uppercase text-black-500">
                                No
                            </th>
                            <th class="px-6 py-3 text-xs font-medium tracking-wider text-left uppercase text-black-500">
                                Area Dampak
                            </th>
                            <th class="px-6 py-3 text-xs font-medium tracking-wider text-left uppercase text-black-500">
                                Level Dampak
                            </th>
                            <th class="px-6 py-3 text-xs font-medium tracking-wider text-left uppercase text-black-500">
                                Deskripsi Negatif
                            </th>
                            <th class="px-6 py-3 text-xs font-medium tracking-wider text-left uppercase text-black-500">
                                Deskripsi Positif
                            </th>
                            @if (auth()->check() && auth()->user()->hasRole('admin'))
                            <th class="px-6 py-3 text-xs font-medium tracking-wider text-center uppercase text-black-500">
                                Actions
                            </th>
                            @endif
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @foreach ($kriteriaDampak as $kriteria)
                            <tr>
                                <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-200">
                                    {{ $loop->iteration }}
                                </td>
                                <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-200">
                                    {{ $kriteria->areaDampak->name }}
                                </td>
                                <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-200">
                                    {{ $kriteria->levelDampak->name }}
                                </td>
                                <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-200">
                                    {{ $kriteria->deskripsi_negatif }}
                                </td>
                                <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-200">
                                    {{ $kriteria->deskripsi_positif }}
                                </td>
                                @if (auth()->check() && auth()->user()->hasRole('admin'))
                                <td class="px-6 py-4 text-center whitespace-no-wrap border-b border-gray-200">
                                    <div class="inline-flex justify-center space-x-4">
                                        <button
                                            onclick="openEditKriteriaDampakModal('{{ route('admin.kriteriadampak.update', $kriteria->id) }}', '{{ $kriteria->id_area_dampak }}', '{{ $kriteria->id_level_dampak }}', '{{ $kriteria->deskripsi_negatif }}', '{{ $kriteria->deskripsi_positif }}')"
                                            class="px-4 py-2 text-white bg-blue-600 rounded hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2">
                                            Edit
                                        </button>
                                        <form action="{{ route('admin.kriteriadampak.destroy', $kriteria->id) }}" method="POST" class="inline"
                                            onsubmit="return confirm('Are you sure you want to delete this kriteria dampak?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="px-4 py-2 text-white bg-red-600 rounded hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-offset-2">
                                                Delete
                                            </button>
                                        </form>
                                    </div>
                                </td>
                                @endif

                            </tr>
                        @endforeach
                    </tbody>
                </table>

                <!-- Modal Tambah Kriteria Dampak -->
                <div id="tambahKriteriaDampakModal" class="fixed inset-0 flex items-center justify-center hidden">
                    <div class="absolute inset-0 bg-gray-900 opacity-50"></div>
                    <div
                        class="relative z-10 p-6 bg-white border border-black rounded-lg shadow-md modal modal-content">
                        <div class="flex items-center justify-between mb-4">
                            <h2 class="text-xl font-bold">Tambah Kriteria Dampak</h2>
                            <button onclick="toggleModal('tambahKriteriaDampakModal')"
                                class="text-2xl text-gray-500">&times;</button>
                        </div>

                        <form action="{{ route('admin.kriteriadampak.store') }}" method="POST">
                            @csrf
                            <div class="mb-4">
                                <label class="block mb-2 text-gray-700" for="id_area_dampak">Area Dampak</label>
                                <select name="id_area_dampak" id="id_area_dampak"
                                    class="block w-full px-3 py-2 mt-1 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
                                    required>
                                    @foreach ($areaDampak as $area)
                                        <option value="{{ $area->id }}">{{ $area->name }}</option>
                                    @endforeach
                                </select>
                                @error('id_area_dampak')
                                    <p class="mt-2 text-sm text-red-500">{{ $message }}</p>
                                @enderror
                            </div>
                            <div class="mb-4">
                                <label class="block mb-2 text-gray-700" for="id_level_dampak">Level Dampak</label>
                                <select name="id_level_dampak" id="id_level_dampak"
                                    class="block w-full px-3 py-2 mt-1 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
                                    required>
                                    @foreach ($levelDampak as $level)
                                        <option value="{{ $level->id }}">{{ $level->name }}</option>
                                    @endforeach
                                </select>
                                @error('id_level_dampak')
                                    <p class="mt-2 text-sm text-red-500">{{ $message }}</p>
                                @enderror
                            </div>
                            <div class="mb-4">
                                <label class="block mb-2 text-gray-700" for="deskripsi_negatif">Deskripsi
                                    Negatif</label>
                                <input type="text" name="deskripsi_negatif" id="deskripsi_negatif"
                                    value="{{ old('deskripsi_negatif') }}"
                                    class="block w-full px-3 py-2 mt-1 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
                                    required>
                                @error('deskripsi_negatif')
                                    <p class="mt-2 text-sm text-red-500">{{ $message }}</p>
                                @enderror
                            </div>
                            <div class="mb-4">
                                <label class="block mb-2 text-gray-700" for="deskripsi_positif">Deskripsi
                                    Positif</label>
                                <input type="text" name="deskripsi_positif" id="deskripsi_positif"
                                    value="{{ old('deskripsi_positif') }}"
                                    class="block w-full px-3 py-2 mt-1 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
                                    required>
                                @error('deskripsi_positif')
                                    <p class="mt-2 text-sm text-red-500">{{ $message }}</p>
                                @enderror
                            </div>
                            <div class="flex justify-end">
                                <button type="submit"
                                    class="px-4 py-2 font-medium tracking-wide text-white transition duration-300 bg-blue-500 rounded-md hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-opacity-50">
                                    Simpan
                                </button>
                                <button type="button" onclick="toggleModal('tambahKriteriaDampakModal')"
                                    class="px-4 py-2 ml-2 font-medium tracking-wide text-gray-800 transition duration-300 bg-gray-300 rounded-md hover:bg-gray-400 focus:outline-none focus:ring-2 focus:ring-gray-500 focus:ring-opacity-50">
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
                        class="relative z-10 p-6 bg-white border border-black rounded-lg shadow-md modal modal-content">
                        <div class="flex items-center justify-between mb-4">
                            <h2 class="text-xl font-bold">Edit Kriteria Dampak</h2>
                            <button onclick="toggleModal('editKriteriaDampakModal')"
                                class="ml-4 text-2xl text-gray-500">&times;</button>
                        </div>
                        <form id="editKriteriaDampakForm" method="POST">
                            @csrf
                            @method('PUT')
                            <div class="mb-4">
                                <label class="block mb-2 text-gray-700" for="edit_id_area_dampak">Area Dampak</label>
                                <select name="id_area_dampak" id="edit_id_area_dampak"
                                    class="block w-full px-3 py-2 mt-1 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
                                    required>
                                    @foreach ($areaDampak as $area)
                                        <option value="{{ $area->id }}">{{ $area->name }}</option>
                                    @endforeach
                                </select>
                                @error('edit_id_area_dampak')
                                    <p class="mt-2 text-sm text-red-500">{{ $message }}</p>
                                @enderror
                            </div>
                            <div class="mb-4">
                                <label class="block mb-2 text-gray-700" for="edit_id_level_dampak">Level
                                    Dampak</label>
                                <select name="id_level_dampak" id="edit_id_level_dampak"
                                    class="block w-full px-3 py-2 mt-1 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
                                    required>
                                    @foreach ($levelDampak as $level)
                                        <option value="{{ $level->id }}">{{ $level->name }}</option>
                                    @endforeach
                                </select>
                                @error('edit_id_level_dampak')
                                    <p class="mt-2 text-sm text-red-500">{{ $message }}</p>
                                @enderror
                            </div>
                            <div class="mb-4">
                                <label class="block mb-2 text-gray-700" for="edit_deskripsi_negatif">Deskripsi
                                    Negatif</label>
                                <input type="text" name="deskripsi_negatif" id="edit_deskripsi_negatif"
                                    class="block w-full px-3 py-2 mt-1 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
                                    required>
                                @error('edit_deskripsi_negatif')
                                    <p class="mt-2 text-sm text-red-500">{{ $message }}</p>
                                @enderror
                            </div>
                            <div class="mb-4">
                                <label class="block mb-2 text-gray-700" for="edit_deskripsi_positif">Deskripsi
                                    Positif</label>
                                <input type="text" name="deskripsi_positif" id="edit_deskripsi_positif"
                                    class="block w-full px-3 py-2 mt-1 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
                                    required>
                                @error('edit_deskripsi_positif')
                                    <p class="mt-2 text-sm text-red-500">{{ $message }}</p>
                                @enderror
                            </div>
                            <div class="flex justify-end">
                                <button type="submit"
                                    class="px-4 py-2 font-medium tracking-wide text-white transition duration-300 bg-blue-500 rounded-md hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-opacity-50">
                                    Simpan
                                </button>
                                <button type="button" onclick="toggleModal('editKriteriaDampakModal')"
                                    class="px-4 py-2 ml-2 font-medium tracking-wide text-gray-800 transition duration-300 bg-gray-300 rounded-md hover:bg-gray-400 focus:outline-none focus:ring-2 focus:ring-gray-500 focus:ring-opacity-50">
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
