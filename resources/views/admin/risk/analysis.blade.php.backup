<x-admin-layout>

    <meta name="csrf-token" content="{{ csrf_token() }}">

    <div class="flex justify-center mt-10">
        <div class="bg-white shadow-md rounded-lg p-6 w-full">
            <h1 class="text-2xl font-bold mb-6" id="cek">Analisis Risiko</h1>
            <form id="identifikasiResikoForm">
                <div class="mb-4">
                    <label class="block text-gray-700 mb-2" for="tim-bidang">Tim/Bidang</label>
                    <select id="tim" name="tim" class="w-full p-2 border-2 border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500">
                        <option value="">-- Pilih Tim/Bidang --</option>
                        @foreach ($timProjects as $tim)
                            <option value="{{ $tim->id }}">{{ $tim->nama_team }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="mb-4">
                    <label class="block text-gray-700 mb-2" for="proses-bisnis">Proses Bisnis</label>
                    <select id="proses_bisnis" name="proses_bisnis" class="w-full p-2 border-2 border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500">
                        <option value="">-- Pilih Proses Bisnis --</option>
                        @foreach ($prosesBisnis as $proses)
                            <option value="{{ $proses->id }}">{{ $proses->proses_bisnis }}</option>
                        @endforeach
                    </select>
                </div>
            </form>
        </div>
    </div>
    <div class="container mx-auto mt-10">
        <div class="flex justify-between items-center mb-4 space-x-4">
            <div class="flex space-x-4">
                <button id="refreshBtn" class="bg-blue-500 text-white px-4 py-2 rounded-full border border-blue-500 hover:bg-blue-600">Refresh</button>
            </div>
            <input type="text" id="searchInput" class="p-2 border-2 border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500" placeholder="Cari..." />
        </div>

        <!-- Wrapper for horizontal scrolling -->
        <div class="overflow-x-auto bg-white shadow-md rounded-lg">
            <table class="min-w-full divide-y divide-gray-200" id="riskTable">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-3 text-middle text-xs font-medium text-gray-500 uppercase tracking-wider border-r border-gray-200" style="width: 50px;">No</th>
                        <th class="px-6 py-3 text-middle text-xs font-medium text-gray-500 uppercase tracking-wider border-r border-gray-200" style="width: 150px;">Proses Bisnis</th>
                        <th class="px-6 py-3 text-middle text-xs font-medium text-gray-500 uppercase tracking-wider border-r border-gray-200" style="width: 150px;">Tim</th>
                        <th class="px-6 py-3 text-middle text-xs font-medium text-gray-500 uppercase tracking-wider border-r border-gray-200" style="width: 200px;">Pernyataan Risiko</th>
                        <th class="px-6 py-4 text-middle text-xs font-medium text-gray-500 uppercase tracking-wider border-r border-gray-200" style="width: 100px;">Jenis</th>
                        <th class="px-6 py-3 text-middle text-xs font-medium text-gray-500 uppercase tracking-wider border-r border-gray-200" style="width: 100px;">Sumber</th>
                        <th class="px-6 py-3 text-middle text-xs font-medium text-gray-500 uppercase tracking-wider border-r border-gray-200" style="width: 100px;">Kategori</th>
                        <th class="px-6 py-3 text-middle text-xs font-medium text-gray-500 uppercase tracking-wider border-r border-gray-200" style="width: 150px;">Area Dampak</th>
                        <th class="px-6 py-3 text-middle text-xs font-medium text-gray-500 uppercase tracking-wider border-r border-gray-200" style="width: 150px;">Penyebab</th>
                        <th class="px-6 py-3 text-middle text-xs font-medium text-gray-500 uppercase tracking-wider border-r border-gray-200" style="width: 150px;">Dampak</th>
                        <th class="px-6 py-3 text-middle text-xs font-medium text-gray-500 uppercase tracking-wider border-r border-gray-200" style="width: 200px;">Level Kemungkinan</th>
                        <th class="px-6 py-3 text-middle text-xs font-medium text-gray-500 uppercase tracking-wider border-r border-gray-200" style="width: 200px;">Level Dampak</th>
                        <th class="px-6 py-3 text-middle text-xs font-medium text-gray-500 uppercase tracking-wider border-r border-gray-200" style="width: 200px;">Level Risiko</th>
                        <th class="px-6 py-3 text-middle text-xs font-medium text-gray-500 uppercase tracking-wider border-r border-gray-200" style="width: 200px;">Uraian</th>
                        <th class="px-6 py-3 text-middle text-xs font-medium text-gray-500 uppercase tracking-wider border-r border-gray-200" style="width: 100px;">Efektivitas</th>
                        <th class="px-6 py-3 text-middle text-xs font-medium text-gray-500 uppercase tracking-wider border-r border-gray-200" style="width: 100px;">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($manajemenResikos as $manajemenResiko)
                    <tr data-row="{{ $manajemenResiko->id }}">
                        <td class="px-6 py-4 whitespace-nowrap border-r border-gray-200">{{ $loop->iteration }}</td>
                        <td class="px-6 py-4 whitespace-nowrap border-r border-gray-200">{{ $manajemenResiko->prosesBisnis->proses_bisnis }}</td>
                        <td class="px-6 py-4 whitespace-nowrap border-r border-gray-200">{{ $manajemenResiko->tim_project->nama_team }}</td>
                        <td class="px-6 py-4 whitespace-nowrap border-r border-gray-200">{{ $manajemenResiko->resiko->resiko }}</td>
                        <td class="px-6 py-4 whitespace-nowrap border-r border-gray-200">{{ $manajemenResiko->jenisResiko->jenis_resiko }}</td>
                        <td class="px-6 py-4 whitespace-nowrap border-r border-gray-200">{{ $manajemenResiko->sumberResiko->sumber_resiko }}</td>
                        <td class="px-6 py-4 whitespace-nowrap border-r border-gray-200">{{ $manajemenResiko->kategoriResiko->kriteriaKemungkinan }}</td>
                        <td class="px-6 py-4 whitespace-nowrap border-r border-gray-200">{{ $manajemenResiko->areaDampak->area_dampak }}</td>
                        <td class="px-6 py-4 whitespace-nowrap border-r border-gray-200">{{ $manajemenResiko->penyebab ? $manajemenResiko->penyebab->penyebab : 'Tidak ada penyebab' }}</td>
                        <td class="px-6 py-4 whitespace-nowrap border-r border-gray-200">{{ $manajemenResiko->dampak ? $manajemenResiko->dampak->dampak : 'Tidak ada dampak' }}</td>
                        <td class="px-6 py-4 whitespace-nowrap border-r border-gray-200">
                            <select class="w-48 p-2 border-2 border-gray-300 rounded-lg shadow-sm likelihood" data-row="{{ $manajemenResiko->id }}">
                                <option value="" {{ is_null($manajemenResiko->id_level_kemungkinan) ? 'selected' : '' }}>-- Pilih Level Kemungkinan --</option>
                                @foreach ($levelKemungkinans as $levelKemungkinan)
                                    <option value="{{ $levelKemungkinan->id }}" {{ $manajemenResiko->id_level_kemungkinan === $levelKemungkinan->id ? 'selected' : '' }}>
                                        {{ $levelKemungkinan->level_kemungkinan }}
                                    </option>
                                @endforeach
                            </select>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap border-r border-gray-200">
                            <select class="w-48 p-2 border-2 border-gray-300 rounded-lg shadow-sm impact" data-row="{{ $manajemenResiko->id }}">
                                <option value="" {{ is_null($manajemenResiko->id_level_dampak) ? 'selected' : '' }}>-- Pilih Level Kemungkinan --</option>
                                @foreach ($levelDampaks as $levelDampak)
                                    <option value="{{ $levelDampak->id }}" {{ $manajemenResiko->id_level_dampak === $levelDampak->id ? 'selected' : '' }}>
                                        {{ $levelDampak->level_dampak }}
                                    </option>
                                @endforeach
                            </select>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap border-r border-gray-200" id="riskLevel{{ $manajemenResiko->id }}">
                            <!-- Level Risiko akan diupdate di sini -->
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap border-r border-gray-200">
                            @if($manajemenResiko->uraian)
                                {{ $manajemenResiko->uraian }}
                            @else
                                <button class="bg-blue-500 text-white px-4 py-2 rounded-lg edit-btn" data-row="{{ $manajemenResiko->id }}">
                                    Tambah Uraian
                                </button>
                            @endif
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap border-r border-gray-200">
                            <select class="w-48 p-2 border-2 border-gray-300 rounded-lg shadow-sm effectiveness" data-row="{{ $manajemenResiko->id }}">
                                <option value="" {{ is_null($manajemenResiko->efektivitas) ? 'selected' : '' }}>-- Pilih Efektivitas --</option>
                                <option value="efektif" {{ $manajemenResiko->efektivitas === 'efektif' ? 'selected' : '' }}>Efektif</option>
                                <option value="tidak_efektif" {{ $manajemenResiko->efektivitas === 'tidak_efektif' ? 'selected' : '' }}>Tidak Efektif</option>
                            </select>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap border-r border-gray-200">
                            <button class="bg-blue-500 text-white px-4 py-2 rounded-lg edit-btn" data-row="{{ $manajemenResiko->id }}">Edit</button>
                            <button class="bg-green-500 text-white px-4 py-2 rounded-lg ml-2 save-btn" data-row="{{ $manajemenResiko->id }}">Save</button>
                        </td>

                    </tr>
                    @endforeach
        </tbody>
            </table>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const riskLevels = {
                1: 'Sangat Rendah',
                2: 'Sangat Rendah',
                3: 'Sangat Rendah',
                4: 'Sangat Rendah',
                5: 'Sangat Rendah',
                6: 'Rendah',
                7: 'Rendah',
                8: 'Rendah',
                9: 'Rendah',
                10: 'Rendah',
                11: 'Sedang',
                12: 'Sedang',
                13: 'Sedang',
                14: 'Sedang',
                15: 'Sedang',
                16: 'Tinggi',
                17: 'Tinggi',
                18: 'Tinggi',
                19: 'Tinggi',
                20: 'Tinggi',
                21: 'Sangat Tinggi',
                22: 'Sangat Tinggi',
                23: 'Sangat Tinggi',
                24: 'Sangat Tinggi',
                25: 'Sangat Tinggi',
            };

            function calculateRiskLevel(likelihood, impact) {
                const combinedLevel = likelihood * impact;
                return riskLevels[combinedLevel] || 'Tidak Diketahui';
            }

            function updateRiskLevel(rowId) {
                const likelihood = parseInt(document.querySelector(`.likelihood[data-row="${rowId}"]`).value) || 0;
                const impact = parseInt(document.querySelector(`.impact[data-row="${rowId}"]`).value) || 0;
                const riskLevel = calculateRiskLevel(likelihood, impact);

                const riskLevelCell = document.getElementById(`riskLevel${rowId}`);
                riskLevelCell.textContent = riskLevel;

                riskLevelCell.classList.remove('bg-green-500', 'bg-yellow-500', 'bg-red-500');

                switch (riskLevel) {
                    case 'Sangat Rendah':
                        riskLevelCell.classList.add('bg-green-500');
                        break;
                    case 'Rendah':
                        riskLevelCell.classList.add('bg-yellow-500');
                        break;
                    case 'Sedang':
                        riskLevelCell.classList.add('bg-yellow-500');
                        break;
                    case 'Tinggi':
                        riskLevelCell.classList.add('bg-red-500');
                        break;
                    case 'Sangat Tinggi':
                        riskLevelCell.classList.add('bg-red-500');
                        break;
                    default:
                        riskLevelCell.classList.add('bg-gray-200');
                        break;
                }
            }

            document.querySelectorAll('.likelihood, .impact').forEach(select => {
                select.addEventListener('change', function() {
                    const rowId = this.dataset.row;
                    updateRiskLevel(rowId);
                });
            });

            document.getElementById('refreshBtn').addEventListener('click', function() {
                document.getElementById('identifikasiResikoForm').reset();
                document.getElementById('searchInput').value = '';
                const rows = document.querySelectorAll('#riskTable tbody tr');
                rows.forEach(row => row.style.display = '');
            });

            document.getElementById('searchInput').addEventListener('input', function() {
                const searchValue = this.value.toLowerCase();
                const rows = document.querySelectorAll('#riskTable tbody tr');

                rows.forEach(row => {
                    const cells = row.querySelectorAll('td');
                    let match = false;

                    cells.forEach(cell => {
                        if (cell.textContent.toLowerCase().includes(searchValue)) {
                            match = true;
                        }
                    });

                    row.style.display = match ? '' : 'none';
                });
            });

            document.querySelectorAll('.edit-btn').forEach(button => {
                button.addEventListener('click', function() {
                    const rowId = this.dataset.row;
                    toggleEditState(rowId, true);
                });
            });

            document.querySelectorAll('.save-btn').forEach(button => {
                button.addEventListener('click', function() {
                    const rowId = this.dataset.row;
                    saveData(rowId);
                    toggleEditState(rowId, false);
                });
            });

            function toggleEditState(rowId, isEditing) {
                const likelihood = document.querySelector(`.likelihood[data-row="${rowId}"]`);
                const impact = document.querySelector(`.impact[data-row="${rowId}"]`);
                const effectiveness = document.querySelector(`.effectiveness[data-row="${rowId}"]`);
                const editButton = document.querySelector(`.edit-btn[data-row="${rowId}"]`);
                const saveButton = document.querySelector(`.save-btn[data-row="${rowId}"]`);

                likelihood.disabled = !isEditing;
                impact.disabled = !isEditing;
                effectiveness.disabled = !isEditing;
                editButton.disabled = isEditing;
                saveButton.disabled = !isEditing;
            }

            function saveData(rowId) {
                const likelihoodElement = document.querySelector(`.likelihood[data-row="${rowId}"]`);
                const impactElement = document.querySelector(`.impact[data-row="${rowId}"]`);
                const effectivenessElement = document.querySelector(`.effectiveness[data-row="${rowId}"]`);

                if (!likelihoodElement || !impactElement || !effectivenessElement) {
                    console.error(`Tidak dapat menemukan dropdown likelihood, impact, atau effectiveness untuk data-row "${rowId}".`);
                    return;
                }

                const likelihood = likelihoodElement.value;
                const impact = impactElement.value;
                const effectiveness = effectivenessElement.value;

                const data = {
                    manajemen_resiko_id: rowId,
                    level_kemungkinan_id: likelihood,
                    level_dampak_id: impact,
                    efektivitas: effectiveness,
                    level_resiko_id: (likelihood * impact)
                };

                fetch(`/analisis/update/${rowId}`, {  // Pastikan URL sesuai dengan route Laravel
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                    },
                    body: JSON.stringify(data)
                })
                .then(response => {
                    if (!response.ok) {
                        throw new Error(`HTTP error! status: ${response.status}`);
                    }
                    return response.json();
                })
                .then(result => {
                    if (result.success) {
                        alert('Data berhasil disimpan!');
                    } else {
                        alert('Terjadi kesalahan dalam menyimpan data.');
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    alert('Terjadi kesalahan dalam menyimpan data.');
                });
            }

            function initializeState() {
                document.querySelectorAll('tr[data-row]').forEach(row => {
                    const rowId = row.dataset.row;
                    const likelihood = document.querySelector(`.likelihood[data-row="${rowId}"]`);
                    const impact = document.querySelector(`.impact[data-row="${rowId}"]`);
                    const effectiveness = document.querySelector(`.effectiveness[data-row="${rowId}"]`);
                    const editButton = document.querySelector(`.edit-btn[data-row="${rowId}"]`);
                    const saveButton = document.querySelector(`.save-btn[data-row="${rowId}"]`);

                    if (likelihood.value && impact.value && effectiveness.value) {
                        toggleEditState(rowId, false);
                        updateRiskLevel(rowId);
                    } else {
                        toggleEditState(rowId, true);
                    }
                });
            }

            initializeState();
        });
    </script>



</x-admin-layout>
