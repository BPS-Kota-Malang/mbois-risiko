<x-admin-layout>
    <div class="flex justify-center mt-10">
        <div class="bg-white shadow-md rounded-lg p-6 w-full">
            <h1 class="text-2xl font-bold mb-6">Analysis Risiko</h1>
            <!-- Filter Form -->
            <form id="analisisResikoForm" action="{{ route('admin.analisis.index') }}" method="GET">
                <div class="mb-4">
                    <label class="block text-gray-700 mb-2" for="tim-bidang">Tim/Bidang</label>
                    <select id="tim" name="tim" class="w-full p-2 border rounded-lg">
                        <option value="">-- Pilih Tim/Bidang --</option>
                        @foreach ($timProjects as $tim)
                            <option value="{{ $tim->id }}" {{ request('tim') == $tim->id ? 'selected' : '' }}>
                                {{ $tim->nama_team }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="mb-4">
                    <label class="block text-gray-700 mb-2" for="proses-bisnis">Proses Bisnis</label>
                    <select id="proses_bisnis" name="proses_bisnis" class="w-full p-2 border rounded-lg">
                        <option value="">-- Pilih Proses Bisnis --</option>
                        @foreach ($ProsesBisnis as $proses)
                            <option value="{{ $proses->id }}"
                                {{ request('proses_bisnis') == $proses->id ? 'selected' : '' }}>
                                {{ $proses->proses_bisnis }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded">Filter</button>
            </form>
        </div>
    </div>
    <div class="flex justify-between items-center mb-4 space-x-4"> </div>
    <div class="overflow-x-auto bg-white shadow-md rounded-lg">
        <table class="min-w-full divide-y divide-gray-200" id="riskTable">
            <thead class="bg-gray-50">
                <tr>
                    <th class="px-6 py-3 text-middle text-xs font-medium text-gray-500 uppercase tracking-wider border-r border-gray-200"
                        style="width: 50px;">No</th>
                    <th class="px-6 py-3 text-middle text-xs font-medium text-gray-500 uppercase tracking-wider border-r border-gray-200"
                        style="width: 150px;">Proses Bisnis</th>
                    <th class="px-6 py-3 text-middle text-xs font-medium text-gray-500 uppercase tracking-wider border-r border-gray-200"
                        style="width: 150px;">Tim</th>
                    <th class="px-6 py-3 text-middle text-xs font-medium text-gray-500 uppercase tracking-wider border-r border-gray-200"
                        style="width: 200px;">Pernyataan Risiko</th>
                    <th class="px-6 py-4 text-middle text-xs font-medium text-gray-500 uppercase tracking-wider border-r border-gray-200"
                        style="width: 100px;">Jenis</th>
                    <th class="px-6 py-3 text-middle text-xs font-medium text-gray-500 uppercase tracking-wider border-r border-gray-200"
                        style="width: 100px;">Sumber</th>
                    <th class="px-6 py-3 text-middle text-xs font-medium text-gray-500 uppercase tracking-wider border-r border-gray-200"
                        style="width: 100px;">Kategori</th>
                    <th class="px-6 py-3 text-middle text-xs font-medium text-gray-500 uppercase tracking-wider border-r border-gray-200"
                        style="width: 150px;">Area Dampak</th>
                    <th class="px-6 py-3 text-middle text-xs font-medium text-gray-500 uppercase tracking-wider border-r border-gray-200"
                        style="width: 150px;">Penyebab</th>
                    <th class="px-6 py-3 text-middle text-xs font-medium text-gray-500 uppercase tracking-wider border-r border-gray-200"
                        style="width: 150px;">Dampak</th>
                    <th class="px-6 py-3 text-middle text-xs font-medium text-gray-500 uppercase tracking-wider border-r border-gray-200"
                        style="width: 200px;">Level Kemungkinan</th>
                    <th class="px-6 py-3 text-middle text-xs font-medium text-gray-500 uppercase tracking-wider border-r border-gray-200"
                        style="width: 200px;">Level Dampak</th>
                    <th class="px-6 py-3 text-middle text-xs font-medium text-gray-500 uppercase tracking-wider border-r border-gray-200"
                        style="width: 200px;">Level Risiko</th>
                    <th class="px-6 py-3 text-middle text-xs font-medium text-gray-500 uppercase tracking-wider border-r border-gray-200"
                        style="width: 200px;">Uraian</th>
                    <th class="px-6 py-3 text-middle text-xs font-medium text-gray-500 uppercase tracking-wider border-r border-gray-200"
                        style="width: 100px;">Efektivitas</th>
                    <th class="px-6 py-3 text-middle text-xs font-medium text-gray-500 uppercase tracking-wider border-r border-gray-200"
                        style="width: 100px;">Action</th>
                </tr>
            </thead>

            @foreach ($ManajemenResiko as $ManajemenResiko)
                <form action="{{ route('admin.analisis.store') }}" method="POST">
                    @csrf
                    <tr>
                        <input type="hidden" name="manajemen_resiko_ids[]" value="{{ $ManajemenResiko->id }}">
                        <td class="px-6 py-4 whitespace-nowrap">{{ $loop->iteration }}</td>
                        <td class="px-6 py-4 whitespace-nowrap">{{ $ManajemenResiko->prosesbisnis->proses_bisnis }}
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">{{ $ManajemenResiko->tim_project->nama_team }}</td>
                        <td class="px-6 py-4 whitespace-nowrap">{{ $ManajemenResiko->resiko->resiko }}</td>
                        <td class="px-6 py-4 whitespace-nowrap">{{ $ManajemenResiko->jenisResiko->jenis_resiko }}</td>
                        <td class="px-6 py-4 whitespace-nowrap">{{ $ManajemenResiko->sumberResiko->sumber_resiko }}
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">{{ $ManajemenResiko->kategoriResiko->deskripsi }}</td>
                        <td class="px-6 py-4 whitespace-nowrap">{{ $ManajemenResiko->areaDampak->area_dampak }}</td>
                        <td class="px-6 py-4 whitespace-nowrap border-r border-gray-200">
                            {{ $ManajemenResiko->penyebab ? $ManajemenResiko->penyebab->penyebab : 'Tidak ada penyebab' }}
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap border-r border-gray-200">
                            {{ $ManajemenResiko->dampak ? $ManajemenResiko->dampak->dampak : 'Tidak ada dampak' }}</td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <select name="level_kemungkinan[]" class="form-select pr-8 py-2 border"
                                id="levelKemungkinan{{ $ManajemenResiko->id }}"
                                {{ !is_null($ManajemenResiko->id_level_kemungkinan) ? 'disabled' : '' }}>
                                <option value="">-- Pilih Level Kemungkinan --</option>
                                @foreach ($levelKemungkinan as $kemungkinan)
                                    <option value="{{ $kemungkinan->id }}"
                                        {{ $kemungkinan->id == $ManajemenResiko->id_level_kemungkinan ? 'selected' : '' }}>
                                        {{ $kemungkinan->level_kemungkinan }}
                                    </option>
                                @endforeach
                            </select>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <select name="level_dampak[]" class="form-select pr-8 py-2 border"
                                id="levelDampak{{ $ManajemenResiko->id }}"
                                {{ !is_null($ManajemenResiko->id_level_dampak) ? 'disabled' : '' }}>
                                <option value="">-- Pilih Level Dampak --</option>
                                @foreach ($levelDampak as $dampak)
                                    <option value="{{ $dampak->id }}"
                                        {{ $dampak->id == $ManajemenResiko->id_level_dampak ? 'selected' : '' }}>
                                        {{ $dampak->level_dampak }}
                                    </option>
                                @endforeach
                            </select>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <input type="text" name="hasil_level_resiko[]" class="form-input border"
                                id="hasilLevelResiko{{ $ManajemenResiko->id }}" readonly>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <button class="bg-blue-500 text-white px-4 py-2 rounded" id="openModal">Tambah
                                Uraian</button>
                            <div id="selectedPenyebab" class="mt-2"></div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap border-r border-gray-200">
                            <select class="w-48 p-2 border-2 border-gray-300 rounded-lg shadow-sm effectiveness"
                                data-row="{{ $ManajemenResiko->id }}">
                                <option value="" {{ is_null($ManajemenResiko->efektivitas) ? 'selected' : '' }}>
                                    -- Pilih Efektivitas --</option>
                                <option value="efektif"
                                    {{ $ManajemenResiko->efektivitas === 'efektif' ? 'selected' : '' }}>Efektif
                                </option>
                                <option value="tidak_efektif"
                                    {{ $ManajemenResiko->efektivitas === 'tidak_efektif' ? 'selected' : '' }}>Tidak
                                    Efektif</option>
                            </select>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <a class="bg-blue-500 text-white width-mt-2 px-2 py-2 rounded cursor-pointer"
                                id="btnEdit" data-id="{{ $ManajemenResiko->id }}">Edit</a>
                            <button type="submit" class="bg-green-500 text-white px-2 py-1 rounded"
                                id="saveanalisisBtn">Save</button>
                </form>
                </td>

                </tr>
                </form>
            @endforeach
        </table>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const matriksAnalisisResiko = @json($matriksAnalisisResiko);
            const levelKemungkinanSelects = document.querySelectorAll('select[name="level_kemungkinan[]"]');
            const levelDampakSelects = document.querySelectorAll('select[name="level_dampak[]"]');

            function updateHasilLevelResiko(selectElement) {
                const rowId = selectElement.id.replace(/\D/g, '');
                const levelKemungkinanSelect = document.getElementById('levelKemungkinan' + rowId);
                const levelDampakSelect = document.getElementById('levelDampak' + rowId);
                const hasilLevelResikoInput = document.getElementById('hasilLevelResiko' + rowId);

                const idLevelKemungkinan = levelKemungkinanSelect.value;
                const idLevelDampak = levelDampakSelect.value;

                if (idLevelKemungkinan && idLevelDampak) {
                    const result = matriksAnalisisResiko.find(item =>
                        item.id_level_kemungkinan == idLevelKemungkinan &&
                        item.id_level_dampak == idLevelDampak
                    );
                    hasilLevelResikoInput.value = result ? result.hasil_level_resiko : '';
                } else {
                    hasilLevelResikoInput.value = '';
                }
            }
            levelKemungkinanSelects.forEach(select => {
                select.addEventListener('change', () => updateHasilLevelResiko(select));
            });

            levelDampakSelects.forEach(select => {
                select.addEventListener('change', () => updateHasilLevelResiko(select));
            });
        });
    </script>

</x-admin-layout>
