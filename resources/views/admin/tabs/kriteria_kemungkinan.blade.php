<div id="context10" class="tab-content hidden">
    <section class="bg-white">
        <div class="-my-2 py-2 overflow-x-auto sm:-mx-6 sm:px-6 lg:-mx-8 lg:px-8">
            <div
                class="align-middle inline-block min-w-full shadow overflow-hidden sm:rounded-lg border-b border-gray-200">
                <form method="GET" action="{{ route('admin.risk.context') }}" class="mb-4">
                    <div class="flex items-end space-x-4">
                        <div class="relative w-48">
                            <label class="block text-gray-700 mb-2" for="filter_kategori_resiko">Filter Kategori
                                Resiko</label>
                            <select name="filter_kategori_resiko" id="filter_kategori_resiko"
                                class="block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                                <option value="">Semua Kategori</option>
                                @foreach ($kategoriResiko as $kategori)
                                    <option value="{{ $kategori->id }}"
                                        {{ request('filter_kategori_resiko') == $kategori->id ? 'selected' : '' }}>
                                        {{ $kategori->deskripsi }}
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

                <button onclick="toggleModal('tambahKriteriaKemungkinanModal')"
                    class="px-4 py-2 mb-2 bg-blue-500 rounded-md text-white font-medium tracking-wide hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-opacity-50 transition duration-300">
                    Tambah Kriteria Kemungkinan
                </button>
                
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-medium text-black-500 uppercase tracking-wider">
                                No
                            </th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-black-500 uppercase tracking-wider">
                                Kategori Resiko
                            </th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-black-500 uppercase tracking-wider">
                                Level Kemungkinan
                            </th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-black-500 uppercase tracking-wider">
                                Presentase Kemungkinan
                            </th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-black-500 uppercase tracking-wider">
                                Jumlah Frekuensi
                            </th>
                            <th class="px-6 py-3 text-center text-xs font-medium text-black-500 uppercase tracking-wider">
                                Actions
                            </th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @foreach ($kriteriaKemungkinan as $kriteria)
                            <tr>
                                <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-200">
                                    {{ $loop->iteration }}
                                </td>
                                <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-200">
                                    {{ $kriteria->kategoriResiko->deskripsi }}
                                </td>
                                <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-200">
                                    {{ $kriteria->levelKemungkinan->level_kemungkinan }}
                                </td>
                                <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-200">
                                    {{ $kriteria->presentase_kemungkinan }}
                                </td>
                                <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-200">
                                    {{ $kriteria->jumlah_frekuensi }}
                                </td>
                                <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-200 text-center">
                                    <div class="inline-flex space-x-4 justify-center">
                                        <button
                                            onclick="openEditKriteriaKemungkinanModal('{{ route('admin.kriteriakemungkinan.update', $kriteria->id) }}', '{{ $kriteria->id_kategori_resiko }}', '{{ $kriteria->id_level_kemungkinan }}', '{{ $kriteria->presentase_kemungkinan }}', '{{ $kriteria->jumlah_frekuensi }}')"
                                            class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2">
                                            Edit
                                        </button>
                                        <form action="{{ route('admin.kriteriakemungkinan.destroy', $kriteria->id) }}" method="POST" class="inline"
                                            onsubmit="return confirm('Are you sure you want to delete this kriteria kemungkinan?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="bg-red-600 text-white px-4 py-2 rounded hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-offset-2">
                                                Delete
                                            </button>
                                        </form>
                                    </div>
                                </td>
                                
                            </tr>
                        @endforeach
                    </tbody>
                </table>

                <div id="tambahKriteriaKemungkinanModal" class="fixed inset-0 flex items-center justify-center hidden">
                    <div class="absolute inset-0 bg-gray-900 opacity-50"></div>
                    <div
                        class="bg-white border border-black shadow-md rounded-lg p-6 modal modal-content relative z-10">
                        <div class="flex justify-between items-center mb-4">
                            <h2 class="text-xl font-bold">Tambah Kriteria Kemungkinan</h2>
                            <button onclick="toggleModal('tambahKriteriaKemungkinanModal')"
                                class="text-gray-500 text-2xl ml-4">&times;</button>
                        </div>
                        <form action="{{ route('admin.kriteriakemungkinan.store') }}" method="POST">
                            @csrf
                            <div class="mb-4">
                                <label class="block text-gray-700 mb-2" for="id_kategori_resiko">Kategori Resiko</label>
                                <select name="id_kategori_resiko" id="id_kategori_resiko"
                                    class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
                                    required>
                                    @foreach ($kategoriResiko as $kategori)
                                        <option value="{{ $kategori->id }}">{{ $kategori->deskripsi }}</option>
                                    @endforeach
                                </select>
                                @error('id_kategori_resiko')
                                    <p class="text-red-500 text-sm mt-2">{{ $message }}</p>
                                @enderror
                            </div>
                            <div class="mb-4">
                                <label class="block text-gray-700 mb-2" for="id_level_kemungkinan">Level
                                    Kemungkinan</label>
                                <select name="id_level_kemungkinan" id="id_level_kemungkinan"
                                    class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
                                    required>
                                    @foreach ($levelKemungkinan as $level)
                                        <option value="{{ $level->id }}">{{ $level->level_kemungkinan }}</option>
                                    @endforeach
                                </select>
                                @error('id_level_kemungkinan')
                                    <p class="text-red-500 text-sm mt-2">{{ $message }}</p>
                                @enderror
                            </div>
                            <div class="mb-4">
                                <label class="block text-gray-700 mb-2" for="presentase_kemungkinan">Presentase
                                    Kemungkinan</label>
                                <input type="text" name="presentase_kemungkinan" id="presentase_kemungkinan"
                                    value="{{ old('presentase_kemungkinan') }}"
                                    class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
                                    required>
                                @error('presentase_kemungkinan')
                                    <p class="text-red-500 text-sm mt-2">{{ $message }}</p>
                                @enderror
                            </div>
                            <div class="mb-4">
                                <label class="block text-gray-700 mb-2" for="jumlah_frekuensi">Jumlah Frekuensi</label>
                                <input type="text" name="jumlah_frekuensi" id="jumlah_frekuensi"
                                    value="{{ old('jumlah_frekuensi') }}"
                                    class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
                                    required>
                                @error('jumlah_frekuensi')
                                    <p class="text-red-500 text-sm mt-2">{{ $message }}</p>
                                @enderror
                            </div>
                            <div class="flex items-center space-x-4">
                                <button type="submit"
                                    class="px-4 py-2 bg-blue-500 rounded-md text-white font-medium tracking-wide hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-opacity-50 transition duration-300">
                                    Tambah
                                </button>
                                <button type="button" onclick="toggleModal('tambahKriteriaKemungkinanModal')"
                                    class="px-4 py-2 bg-gray-300 rounded-md text-gray-800 font-medium tracking-wide hover:bg-gray-400 focus:outline-none focus:ring-2 focus:ring-gray-500 focus:ring-opacity-50 transition duration-300">
                                    Batal
                                </button>
                            </div>
                        </form>
                    </div>
                </div>

                <div id="editKriteriaKemungkinanModal" class="fixed inset-0 flex items-center justify-center hidden">
                    <div class="absolute inset-0 bg-gray-900 opacity-50"></div>
                    <div
                        class="bg-white border border-black shadow-md rounded-lg p-6 modal modal-content relative z-10">
                        <div class="flex justify-between items-center mb-4">
                            <h2 class="text-xl font-bold">Edit Kriteria Kemungkinan</h2>
                            <button onclick="toggleModal('editKriteriaKemungkinanModal')"
                                class="text-gray-500 text-2xl ml-4">&times;</button>
                        </div>
                        <form id="editKriteriaKemungkinanForm" method="POST">
                            @csrf
                            @method('PUT')
                            <div class="mb-4">
                                <label class="block text-gray-700 mb-2" for="edit_id_kategori_resiko">Kategori
                                    Resiko</label>
                                <select name="id_kategori_resiko" id="edit_id_kategori_resiko"
                                    class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
                                    required>
                                    @foreach ($kategoriResiko as $kategori)
                                        <option value="{{ $kategori->id }}">{{ $kategori->deskripsi }}</option>
                                    @endforeach
                                </select>
                                @error('id_kategori_resiko')
                                    <p class="text-red-500 text-sm mt-2">{{ $message }}</p>
                                @enderror
                            </div>
                            <div class="mb-4">
                                <label class="block text-gray-700 mb-2" for="edit_id_level_kemungkinan">Level
                                    Kemungkinan</label>
                                <select name="id_level_kemungkinan" id="edit_id_level_kemungkinan"
                                    class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
                                    required>
                                    @foreach ($levelKemungkinan as $level)
                                        <option value="{{ $level->id }}">{{ $level->level_kemungkinan }}</option>
                                    @endforeach
                                </select>
                                @error('id_level_kemungkinan')
                                    <p class="text-red-500 text-sm mt-2">{{ $message }}</p>
                                @enderror
                            </div>
                            <div class="mb-4">
                                <label class="block text-gray-700 mb-2" for="edit_presentase_kemungkinan">Presentase
                                    Kemungkinan</label>
                                <input type="text" name="presentase_kemungkinan" id="edit_presentase_kemungkinan"
                                    value="{{ old('presentase_kemungkinan') }}"
                                    class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
                                    required>
                                @error('presentase_kemungkinan')
                                    <p class="text-red-500 text-sm mt-2">{{ $message }}</p>
                                @enderror
                            </div>
                            <div class="mb-4">
                                <label class="block text-gray-700 mb-2" for="edit_jumlah_frekuensi">Jumlah
                                    Frekuensi</label>
                                <input type="text" name="jumlah_frekuensi" id="edit_jumlah_frekuensi"
                                    value="{{ old('jumlah_frekuensi') }}"
                                    class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
                                    required>
                                @error('jumlah_frekuensi')
                                    <p class="text-red-500 text-sm mt-2">{{ $message }}</p>
                                @enderror
                            </div>
                            <div class="flex items-center space-x-4">
                                <button type="submit"
                                    class="px-4 py-2 bg-blue-500 rounded-md text-white font-medium tracking-wide hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-opacity-50 transition duration-300">
                                    Simpan
                                </button>
                                <button type="button" onclick="toggleModal('editKriteriaKemungkinanModal')"
                                    class="px-4 py-2 bg-gray-300 rounded-md text-gray-800 font-medium tracking-wide hover:bg-gray-400 focus:outline-none focus:ring-2 focus:ring-gray-500 focus:ring-opacity-50 transition duration-300">
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

    function openEditKriteriaKemungkinanModal(actionUrl, idKategoriResiko, idLevelKemungkinan, presentaseKemungkinan,
        jumlahFrekuensi) {
        const form = document.getElementById('editKriteriaKemungkinanForm');
        form.action = actionUrl;

        document.getElementById('edit_id_kategori_resiko').value = idKategoriResiko;
        document.getElementById('edit_id_level_kemungkinan').value = idLevelKemungkinan;
        document.getElementById('edit_presentase_kemungkinan').value = presentaseKemungkinan;
        document.getElementById('edit_jumlah_frekuensi').value = jumlahFrekuensi;

        toggleModal('editKriteriaKemungkinanModal');
    }

    document.addEventListener('click', function(event) {
        const modals = document.querySelectorAll('.modal');
        modals.forEach(modal => {
            if (!modal.contains(event.target) && !event.target.closest('[onclick]')) {
                modal.classList.remove('flex');
                modal.classList.add('hidden');
            }
        });
    });
</script>