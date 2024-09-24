<div id="context12" class="tab-content hidden">
    <section class="bg-white dark:bg-gray-100">
        <div class="-my-2 py-2 overflow-x-auto sm:-mx-6 sm:px-6 lg:-mx-8 lg:px-8">
            <div
                class="align-middle inline-block min-w-full shadow overflow-hidden sm:rounded-lg border-b border-gray-200">
                @if (auth()->check() && auth()->user()->hasRole('admin'))
                <button
                    class="px-4 py-2 mb-2 bg-blue-500 rounded-md text-white font-medium tracking-wide hover:bg-blue-600"
                    onclick="toggleModal('addLevelResikoModal')">Tambah Level Resiko</button>
                <button
                    class="px-4 py-2 mb-2 bg-green-500 rounded-md text-white font-medium tracking-wide hover:bg-green-600"
                    onclick="refreshTable('levelResikoTable')">Refresh</button>
                @endif
                <table id="levelResikoTable" class="min-w-full">
                    <thead>
                        <tr>
                            <th
                                class="px-6 py-3 border-b border-gray-200 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">
                                No</th>
                            <th
                                class="px-6 py-3 border-b border-gray-200 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">
                                Level Resiko</th>
                            <th
                                class="px-6 py-3 border-b border-gray-200 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">
                                Rentang Besaran Resiko</th>
                            <th
                                class="px-6 py-3 border-b border-gray-200 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">
                                Tindakan</th>
                            <th
                                class="px-6 py-3 border-b border-gray-200 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">
                                Ket Warna</th>
                            <th
                                class="px-6 py-3 border-b border-gray-200 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">
                                Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @foreach ($levelResiko as $key => $levelResikoItem)
                            <tr>
                                <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-200">
                                    {{ $key + 1 }}
                                </td>
                                <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-200">
                                    {{ $levelResikoItem->level_resiko }}
                                </td>
                                <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-200">
                                    {{ $levelResikoItem->besaran_min }}-{{ $levelResikoItem->besaran_max }}
                                </td>
                                <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-200">
                                    {{ $levelResikoItem->tindakan }}
                                </td>
                                <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-200">
                                    {{ $levelResikoItem->ket_warna }}
                                </td>
                                <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-200">
                                    <button class="text-blue-500 hover:text-blue-700"
                                        onclick="openEditLevelResikoModal('{{ route('admin.levelresiko.update', $levelResikoItem->id) }}', '{{ $levelResikoItem->level_resiko }}', '{{ $levelResikoItem->besaran_min }}','{{ $levelResikoItem->besaran_max }}', '{{ $levelResikoItem->tindakan }}', '{{ $levelResikoItem->ket_warna }}')">
                                        Edit
                                    </button>
                                    <form action="{{ route('admin.levelresiko.destroy', $levelResikoItem->id) }}"
                                        method="POST" class="inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-red-500 hover:text-red-700">Delete</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>

                </table>
            </div>
            <div
                class="mt-8 align-middle inline-block min-w-full shadow overflow-hidden sm:rounded-lg border-b border-gray-200">
                @if (auth()->check() && auth()->user()->hasRole('admin'))
                <button
                    class="px-4 py-2 mb-2 bg-blue-500 rounded-md text-white font-medium tracking-wide hover:bg-blue-600"
                    onclick="toggleModal('addMatriksAnalisisResikoModal')">Tambah Matriks Analisis Resiko</button>
                <button
                    class="px-4 py-2 mb-2 bg-green-500 rounded-md text-white font-medium tracking-wide hover:bg-green-600"
                    onclick="refreshTable('matriksAnalisisResikoTable')">Refresh</button>
                @endif
                <table id="matriksAnalisisResikoTable" class="min-w-full">
                    <thead>
                        <tr>
                            <th
                                class="px-6 py-3 border-b border-gray-200 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">
                                No</th>
                            <th
                                class="px-6 py-3 border-b border-gray-200 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">
                                Level Kemungkinan</th>
                            <th
                                class="px-6 py-3 border-b border-gray-200 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">
                                Level Dampak</th>
                            <th
                                class="px-6 py-3 border-b border-gray-200 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">
                                Besaran Resiko</th>
                            <th
                                class="px-6 py-3 border-b border-gray-200 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">
                                Level Resiko</th>
                            <th
                                class="px-6 py-3 border-b border-gray-200 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">
                                Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white">
                        @foreach ($matriksAnalisisResiko as $key => $matriksAnalisisResiko)
                            <tr>
                                <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-200">{{ $key + 1 }}
                                </td>
                                <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-200">
                                    {{ $matriksAnalisisResiko->levelKemungkinan->level_kemungkinan }}</td>
                                <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-200">
                                    {{ $matriksAnalisisResiko->levelDampak->level_dampak }}</td>
                                <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-200">
                                    {{ $matriksAnalisisResiko->besaran_resiko }}</td>
                                <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-200">
                                    {{ $matriksAnalisisResiko->hasil_level_resiko }}</td>
                                <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-200">
                                    <button class="text-blue-500 hover:text-blue-700"
                                        onclick="openEditMatriksAnalisisResikoModal('{{ route('admin.matriksanalisisresiko.update', $matriksAnalisisResiko->id) }}', '{{ $matriksAnalisisResiko->id_level_kemungkinan }}', '{{ $matriksAnalisisResiko->id_level_dampak }}', '{{ $matriksAnalisisResiko->besaran_resiko }}', '{{ $matriksAnalisisResiko->hasil_level_resiko }}')">Edit</button>
                                    <form
                                        action="{{ route('admin.matriksanalisisresiko.destroy', $matriksAnalisisResiko->id) }}"
                                        method="POST" class="inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-red-500 hover:text-red-700">Delete</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </section>
</div>
    <div id="addLevelResikoModal"
        class="fixed inset-0 bg-gray-500 bg-opacity-75 flex items-center justify-center z-50 hidden">
        <div class="bg-white rounded-lg shadow-lg max-w-sm w-full p-4">
            <h2 class="text-xl font-semibold">Tambah Level Resiko</h2>
            <form action="{{ route('admin.levelresiko.store') }}" method="POST">
                @csrf
                <div class="mt-4">
                    <label class="block text-sm font-medium text-gray-700">Level Resiko</label>
                    <input type="text" name="level_resiko"
                        class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" required>
                </div>
                <div class="mt-4">
                    <label class="block text-sm font-medium text-gray-700">Besaran Min</label>
                    <input type="text" name="besaran_min"
                        class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" required>
                </div>
                <div class="mt-4">
                    <label class="block text-sm font-medium text-gray-700">Besaran Max</label>
                    <input type="text" name="besaran_max"
                        class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" required>
                </div>
                <div class="mt-4">
                    <label class="block text-sm font-medium text-gray-700">Tindakan</label>
                    <input type="text" name="tindakan" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm"
                        required>
                </div>
                <div class="mt-4">
                    <label class="block text-sm font-medium text-gray-700">Ket Warna</label>
                    <input type="text" name="ket_warna"
                        class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" required>
                </div>
                <div class="mt-4 flex justify-end">
                    <button type="submit" class="px-4 py-2 bg-blue-500 text-white rounded-md">Simpan</button>
                    <button type="button" class="px-4 py-2 ml-2 bg-gray-500 text-white rounded-md"
                        onclick="toggleModal('addLevelResikoModal')">Batal</button>
                </div>
            </form>
        </div>
    </div>
    <div id="editLevelResikoModal"
        class="fixed inset-0 bg-gray-500 bg-opacity-75 flex items-center justify-center z-50 hidden">
        <div class="bg-white rounded-lg shadow-lg max-w-sm w-full p-4">
            <h2 class="text-xl font-semibold">Edit Level Resiko</h2>
            <form id="editLevelResikoForm" method="POST">
                @csrf
                @method('PUT')
                <input type="hidden" id="editLevelResikoId" name="id">
                <div class="mt-4">
                    <label class="block text-sm font-medium text-gray-700">Level Resiko</label>
                    <input type="text" id="editLevelResiko" name="level_resiko"
                        class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" required>
                </div>
                <div class="mt-4">
                    <label class="block text-sm font-medium text-gray-700">Besaran Min</label>
                    <input type="text" id="editRentangBesaranResikoMin" name="besaran_min"
                        class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" required>
                </div>
                <div class="mt-4">
                    <label class="block text-sm font-medium text-gray-700">Besaran Max</label>
                    <input type="text" id="editRentangBesaranResikoMax" name="besaran_max"
                        class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" required>
                </div>
                <div class="mt-4">
                    <label class="block text-sm font-medium text-gray-700">Tindakan</label>
                    <input type="text" id="editTindakan" name="tindakan"
                        class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" required>
                </div>
                <div class="mt-4">
                    <label class="block text-sm font-medium text-gray-700">Ket Warna</label>
                    <input type="text" id="editKetWarna" name="ket_warna"
                        class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" required>
                </div>
                <div class="mt-4 flex justify-end">
                    <button type="submit" class="px-4 py-2 bg-blue-500 text-white rounded-md">Simpan</button>
                    <button type="button" class="px-4 py-2 ml-2 bg-gray-500 text-white rounded-md"
                        onclick="toggleModal('editLevelResikoModal')">Batal</button>
                </div>
            </form>
        </div>
    </div>
    <div id="addMatriksAnalisisResikoModal"
        class="fixed inset-0 bg-gray-500 bg-opacity-75 flex items-center justify-center z-50 hidden">
        <div class="bg-white rounded-lg shadow-lg max-w-sm w-full p-4">
            <h2 class="text-xl font-semibold">Tambah Matriks Analisis Resiko</h2>
            <form action="{{ route('admin.matriksanalisisresiko.store') }}" method="POST">
                @csrf
                <div class="mt-4">
                    <label class="block text-sm font-medium text-gray-700">Level Kemungkinan</label>
                    <select id="id_level_kemungkinan" name="id_level_kemungkinan"
                        class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" required>
                        <option value="" disabled selected>Pilih Level Kemungkinan</option>
                        @foreach ($levelKemungkinan as $kemungkinan)
                            <option value="{{ $kemungkinan->id }}">{{ $kemungkinan->level_kemungkinan }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="mt-4">
                    <label class="block text-sm font-medium text-gray-700">Level Dampak</label>
                    <select id="id_level_dampak" name="id_level_dampak"
                        class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" required>
                        <option value="" disabled selected>Pilih Level Dampak</option>
                        @foreach ($levelDampak as $dampak)
                            <option value="{{ $dampak->id }}">{{ $dampak->level_dampak }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="mt-4">
                    <label class="block text-sm font-medium text-gray-700">Besaran Resiko</label>
                    <input id="besaran_resiko_input" type="text" name="besaran_resiko"
                        class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" required>
                </div>
                <div class="mt-4">
                    <label class="block text-sm font-medium text-gray-700">Level Resiko</label>
                    <input type="text" name="hasil_level_resiko" id="hasil_level_resiko"
                        class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
                        required>
                </div>
                <div class="mt-4 flex justify-end">
                    <button type="submit" class="px-4 py-2 bg-blue-500 text-white rounded-md">Simpan</button>
                    <button type="button" class="px-4 py-2 ml-2 bg-gray-500 text-white rounded-md"
                        onclick="toggleModal('addMatriksAnalisisResikoModal')">Batal</button>
                </div>
            </form>
        </div>
    </div>
    <div id="editMatriksAnalisisResikoModal"
        class="fixed inset-0 bg-gray-500 bg-opacity-75 flex items-center justify-center z-50 hidden">
        <div class="bg-white rounded-lg shadow-lg max-w-sm w-full p-4">
            <h2 class="text-xl font-semibold">Edit Matriks Analisis Resiko</h2>
            <form id="editMatriksAnalisisResikoForm" method="POST">
                @csrf
                @method('PUT')
                <input type="hidden" id="editMatriksAnalisisResikoId" name="id">
                <div class="mt-4">
                    <label class="block text-sm font-medium text-gray-700">Level Kemungkinan</label>
                    <select id="editIdLevelKemungkinan" name="id_level_kemungkinan"
                        class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" required>
                        <option value="" disabled>Pilih Level Kemungkinan</option>
                        @foreach ($levelKemungkinan as $kemungkinan)
                            <option value="{{ $kemungkinan->id }}">{{ $kemungkinan->level_kemungkinan }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="mt-4">
                    <label class="block text-sm font-medium text-gray-700">Level Dampak</label>
                    <select id="editIdLevelDampak" name="id_level_dampak"
                        class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" required>
                        <option value="" disabled>Pilih Level Dampak</option>
                        @foreach ($levelDampak as $dampak)
                            <option value="{{ $dampak->id }}">{{ $dampak->level_dampak }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="mt-4">
                    <label class="block text-sm font-medium text-gray-700">Besaran Resiko</label>
                    <input id="editBesaranResiko" type="text" name="besaran_resiko"
                        class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" required>
                </div>

                <div class="mt-4">
                    <label class="block text-sm font-medium text-gray-700">Level Resiko</label>
                    <input type="text" name="hasil_level_resiko" id="editHasilLevelResiko"
                        class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
                        required>
                </div>

                <div class="mt-4 flex justify-end">
                    <button type="submit" class="px-4 py-2 bg-blue-500 text-white rounded-md">Simpan</button>
                    <button type="button" class="px-4 py-2 ml-2 bg-gray-500 text-white rounded-md"
                        onclick="toggleModal('editMatriksAnalisisResikoModal')">Batal</button>
                </div>
            </form>
        </div>
    </div>
    <script>
        const levelResikoRanges = @json($levelResiko);

        function updateLevelResiko() {
            const besaranResiko = parseFloat(document.getElementById('besaran_resiko_input').value);
            let levelResiko = '';

            for (let range of levelResikoRanges) {
                if (besaranResiko >= range.besaran_min && besaranResiko <= range.besaran_max) {
                    levelResiko = range.level_resiko;
                    break;
                }
            }

            document.getElementById('hasil_level_resiko').value = levelResiko;
        }

        function updateEditMatriksAnalisisResikoLevelResiko() {
            const besaranResiko = parseFloat(document.getElementById('editBesaranResiko').value);
            let levelResiko = '';

            for (let range of levelResikoRanges) {
                if (besaranResiko >= range.besaran_min && besaranResiko <= range.besaran_max) {
                    levelResiko = range.level_resiko;
                    break;
                }
            }

            document.getElementById('editHasilLevelResiko').value = levelResiko;
        }

        document.getElementById('besaran_resiko_input').addEventListener('input', updateLevelResiko);
        document.getElementById('editBesaranResiko').addEventListener('input', updateEditMatriksAnalisisResikoLevelResiko);

        function toggleModal(modalId) {
            const modal = document.getElementById(modalId);
            modal.classList.toggle('hidden');
        }

        function openEditLevelResikoModal(url, levelResiko, besaran_min, besaran_max, tindakan, ketWarna) {
            document.getElementById('editLevelResikoForm').action = url;
            document.getElementById('editLevelResiko').value = levelResiko;
            document.getElementById('editRentangBesaranResikoMin').value = besaran_min;
            document.getElementById('editRentangBesaranResikoMax').value = besaran_max;
            document.getElementById('editTindakan').value = tindakan;
            document.getElementById('editKetWarna').value = ketWarna;
            document.getElementById('editLevelResikoModal').classList.remove('hidden');
        }

        function closeEditLevelResikoModal() {
            document.getElementById('editLevelResikoModal').classList.add('hidden');
        }

        function openEditMatriksAnalisisResikoModal(url, id_level_kemungkinan, id_level_dampak, besaran_resiko,
        hasil_level_resiko) {
        document.getElementById('editMatriksAnalisisResikoModal').classList.remove('hidden');
        document.getElementById('editMatriksAnalisisResikoForm').action = url;
        document.getElementById('editIdLevelKemungkinan').value = id_level_kemungkinan;
        document.getElementById('editIdLevelDampak').value = id_level_dampak;
        document.getElementById('editBesaranResiko').value = besaran_resiko;
        document.getElementById('editHasilLevelResiko').value = hasil_level_resiko;
    }

        function closeEditMatriksAnalisisResikoModal() {
            document.getElementById('editMatriksAnalisisResikoModal').classList.add('hidden');
        }

        function refreshTable(tableId) {}
    </script>
