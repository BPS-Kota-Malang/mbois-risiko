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

    <div class="container mx-auto mt-10">
        <div class="flex justify-between items-center mb-4 space-x-4">
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
                        <form action="{{ route('admin.analisis.update', $ManajemenResiko->id) }}" method="POST">
                            @csrf
                            @method('PUT')
                            <tr>
                                <input type="hidden" name="manajemen_resiko_ids[]" value="{{ $ManajemenResiko->id }}">
                                <td class="px-6 py-4 whitespace-nowrap border-r border-gray-200">
                                    {{ $loop->iteration }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap border-r border-gray-200">
                                    {{ $ManajemenResiko->prosesbisnis->proses_bisnis }}</td>
                                <td class="px-6 py-4 whitespace-nowrap border-r border-gray-200">
                                    {{ $ManajemenResiko->tim_project->nama_team }}</td>
                                <td class="px-6 py-4 whitespace-nowrap border-r border-gray-200">
                                    {{ $ManajemenResiko->resiko->resiko }}</td>
                                <td class="px-6 py-4 whitespace-nowrap border-r border-gray-200">
                                    @if ($ManajemenResiko->jenisResiko)
                                        {{ $ManajemenResiko->jenisResiko->jenis_resiko }}
                                    @else<span class="text-red-500">Data Tidak Tersedia</span>
                                    @endif
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap border-r border-gray-200">
                                    @if ($ManajemenResiko->sumberResiko)
                                        {{ $ManajemenResiko->sumberResiko->sumber_resiko }}
                                    @else<span class="text-red-500">Data Tidak Tersedia</span>
                                    @endif
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap border-r border-gray-200">
                                    @if ($ManajemenResiko->kategoriResiko)
                                        {{ $ManajemenResiko->kategoriResiko->deskripsi }}
                                    @else<span class="text-red-500">Data Tidak Tersedia</span>
                                    @endif
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap border-r border-gray-200">
                                    @if ($ManajemenResiko->areaDampak)
                                        {{ $ManajemenResiko->areaDampak->area_dampak }}
                                    @else<span class="text-red-500">Data Tidak Tersedia</span>
                                    @endif
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap border-r border-gray-200">
                                    @if ($ManajemenResiko->id_penyebab)
                                        @php
                                            $penyebabIds = json_decode($ManajemenResiko->id_penyebab, true);
                                            $penyebabNames = \App\Models\Penyebab::whereIn('id', $penyebabIds)
                                                ->pluck('penyebab')
                                                ->toArray();
                                        @endphp
                                        @foreach ($penyebabNames as $penyebab)
                                            <li class="list-disc">{{ $penyebab }}</li>
                                        @endforeach
                                    @else
                                        Tidak ada penyebab
                                    @endif
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap border-r border-gray-200">
                                    @if ($ManajemenResiko->id_dampak)
                                        @php
                                            $dampakIds = json_decode($ManajemenResiko->id_dampak, true);
                                            $dampakNames = \App\Models\Dampak::whereIn('id', $dampakIds)
                                                ->pluck('dampak')
                                                ->toArray();
                                        @endphp
                                        @foreach ($dampakNames as $dampak)
                                            <li class="list-disc">{{ $dampak }}</li>
                                        @endforeach
                                    @else
                                        Tidak ada dampak
                                    @endif
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap border-r border-gray-200">
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
                                <td class="px-6 py-4 whitespace-nowrap border-r border-gray-200">
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
                                <td class="px-6 py-4 whitespace-nowrap border-r border-gray-200 
                                {{ is_null($ManajemenResiko->id_matriks_analisis_resiko)
                                    ? ''
                                    : ($ManajemenResiko->matriksAnalisisResiko->hasil_level_resiko === 'Sangat Tinggi'
                                        ? 'bg-red-500 text-white'
                                        : ($ManajemenResiko->matriksAnalisisResiko->hasil_level_resiko === 'Tinggi'
                                            ? 'bg-yellow-500 text-black'
                                            : ($ManajemenResiko->matriksAnalisisResiko->hasil_level_resiko === 'Sedang'
                                                ? 'bg-yellow-200 text-black'
                                                : ($ManajemenResiko->matriksAnalisisResiko->hasil_level_resiko === 'Rendah'
                                                    ? 'bg-green-300 text-black'
                                                    : ($ManajemenResiko->matriksAnalisisResiko->hasil_level_resiko === 'Sangat Rendah'
                                                        ? 'bg-green-500 text-white'
                                                        : ''))))) }}"
                                    id="hasilLevelResiko{{ $ManajemenResiko->id }}">
                                    @if (is_null($ManajemenResiko->id_matriks_analisis_resiko))
                                        Data tidak tersedia
                                    @else
                                        {{ $ManajemenResiko->matriksAnalisisResiko->hasil_level_resiko ?? 'Level Resiko Tidak Ditemukan' }}
                                    @endif
                                </td>

                                <td class="px-6 py-4 whitespace-nowrap border-r border-gray-200">
                                    <button class="bg-blue-500 text-white px-4 py-2 rounded openUraianModal"
                                        data-manajemen-resiko-id="{{ $ManajemenResiko->id }}"
                                        data-uraian-id="{{ $ManajemenResiko->id_uraian }}"> Pilih Uraian </button>
                                    <div id="selectedUraian" class="mt-2">
                                        @php
                                            $uraianIds = json_decode($ManajemenResiko->id_uraian, true);
                                        @endphp

                                        @if (is_array($uraianIds))
                                            @foreach ($uraianIds as $item)
                                                @foreach ($uraian as $uraianItem)
                                                    @if ($uraianItem->id == $item)
                                                        @php
                                                            $uraianHapus = array_diff($uraianIds, [$item]);
                                                        @endphp
                                                        <a href="#"
                                                            class="text-black-50">{{ $uraianItem->uraian }}</a>
                                                        <a href="/admin/analisis/hapusuraian/{{ $ManajemenResiko->id }}/{{ $item }}"
                                                            class="text-red-500" id="hapusUraian">Hapus</a>
                                                        <br>
                                                    @endif
                                                @endforeach
                                            @endforeach
                                        @else
                                            <p>Tidak ada Uraian yang dipilih</p>
                                        @endif
                                    </div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap border-r border-gray-200">
                                    <select name="efektivitas" class="form-select pr-8 py-2 border"
                                        id="efektivitas{{ $ManajemenResiko->id }}"
                                        {{ is_null($ManajemenResiko->efektivitas) ? 'disabled' : '' }}
                                        @disabled(true)>
                                        <option value="">
                                            -- Pilih Efektivitas --
                                        </option>
                                        <option value="efektif"
                                            {{ $ManajemenResiko->efektivitas === 'Efektif' ? 'selected' : '' }}>
                                            Efektif
                                        </option>
                                        <option value="Tidak_efektif"
                                            {{ $ManajemenResiko->efektivitas === 'Tidak_efektif' ? 'selected' : '' }}>
                                            Tidak Efektif
                                        </option>
                                    </select>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap border-r border-gray-200">
                                    <a class="bg-blue-500 text-white width-mt-2 px-2 py-2 rounded cursor-pointer"
                                        id="btnEdit" data-id="{{ $ManajemenResiko->id }}">Edit</a>
                                    <button type="submit"
                                        class="bg-green-500 text-white px-2 py-1 rounded">Save</button>
                        </form>
                        </td>
                        </tr>
                        </form>
                    @endforeach
                </table>
            </div>
        </div>
    </div>
    @include('admin.risk.components.modal-uraian')

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const uraianModal = document.getElementById('uraianModal');
            const closeModal4 = document.getElementById('closeModal4');
            const openAdduraianModal = document.getElementById('openAddUraianModal');
            const openModal = document.getElementById('openModal');
            const cancelUraianBtn = document.getElementById('cancelUraianBtn');
            const saveUraianBtn = document.getElementById('saveUraianBtn');
            const matriksAnalisisResiko = @json($matriksAnalisisResiko);
            const levelKemungkinanSelects = document.querySelectorAll('select[name="level_kemungkinan[]"]');
            const levelDampakSelects = document.querySelectorAll('select[name="level_dampak[]"]');

            let selectedManajemenResikoId = null;

            window.selectedUraianIds = [];

            function updateHasilLevelResiko(selectElement) {
                const rowId = selectElement.id.replace(/\D/g, '');
                const levelKemungkinanSelect = document.getElementById('levelKemungkinan' + rowId);
                const levelDampakSelect = document.getElementById('levelDampak' + rowId);
                const hasilLevelResiko = document.getElementById('hasilLevelResiko' + rowId);

                const idLevelKemungkinan = levelKemungkinanSelect.value;
                const idLevelDampak = levelDampakSelect.value;

                if (idLevelKemungkinan && idLevelDampak) {
                    const result = matriksAnalisisResiko.find(item =>
                        item.id_level_kemungkinan == idLevelKemungkinan &&
                        item.id_level_dampak == idLevelDampak
                    );
                    hasilLevelResiko.innerText = result ? result.hasil_level_resiko : '';
                    hasilLevelResiko.classList.remove('bg-red-500', 'bg-yellow-500', 'bg-yellow-200',
                        'bg-green-300', 'bg-green-500', 'text-white', 'text-black');
                    if (result) {
                        if (result.hasil_level_resiko === 'Sangat Tinggi') {
                            hasilLevelResiko.classList.add('bg-red-500', 'text-white');
                        } else if (result.hasil_level_resiko === 'Tinggi') {
                            hasilLevelResiko.classList.add('bg-yellow-500', 'text-black');
                        } else if (result.hasil_level_resiko === 'Sedang') {
                            hasilLevelResiko.classList.add('bg-yellow-200', 'text-black');
                        } else if (result.hasil_level_resiko === 'Rendah') {
                            hasilLevelResiko.classList.add('bg-green-300', 'text-white');
                        } else if (result.hasil_level_resiko === 'Sangat Rendah') {
                            hasilLevelResiko.classList.add('bg-green-500', 'text-white');
                        }
                    }
                } else {
                    hasilLevelResiko.value = 'cukitdulit';
                    hasilLevelResiko.classList.remove('bg-red-500', 'bg-yellow-500', 'bg-yellow-200',
                        'bg-green-300', 'bg-green-500', 'text-white', 'text-black');
                }
            }
            levelKemungkinanSelects.forEach(select => {
                select.addEventListener('change', () => updateHasilLevelResiko(select));
            });

            levelDampakSelects.forEach(select => {
                select.addEventListener('change', () => updateHasilLevelResiko(select));
            });

            document.querySelectorAll('#btnEdit').forEach(editBtn => {
                editBtn.addEventListener('click', function(event) {
                    event.preventDefault();
                    const rowId = this.getAttribute('data-id');
                    const levelKemungkinanSelect = document.getElementById('levelKemungkinan' +
                        rowId);
                    const levelDampakSelect = document.getElementById('levelDampak' + rowId);
                    const efektivitasSelect = document.getElementById('efektivitas' + rowId);

                    if (levelKemungkinanSelect) levelKemungkinanSelect.disabled = false;
                    if (levelDampakSelect) levelDampakSelect.disabled = false;
                    if (efektivitasSelect) efektivitasSelect.disabled = false;

                    const saveBtn = this.closest('tr').querySelector('#saveanalisisBtn');
                    saveBtn.disabled = false;
                });
            });

            document.querySelectorAll('#saveanalisisBtn').forEach(saveBtn => {
                saveBtn.addEventListener('click', function(event) {
                    event.preventDefault();
                    const rowId = this.closest('tr').querySelector(
                        'input[name="manajemen_resiko_ids[]"]').value;
                    const levelKemungkinanSelect = document.getElementById('levelKemungkinan' +
                        rowId);
                    const levelDampakSelect = document.getElementById('levelDampak' + rowId);
                    const efektivitasSelect = document.getElementById('efektivitas' + rowId);

                    if (levelKemungkinanSelect) levelKemungkinanSelect.disabled = true;
                    if (levelDampakSelect) levelDampakSelect.disabled = true;
                    if (efektivitasSelect) efektivitasSelect.disabled = true;

                    this.closest('form').submit();
                });
            });

            // document.querySelectorAll('#btnEdit').forEach(editBtn => {
            //     editBtn.addEventListener('click', function(event) {
            //         event.preventDefault();
            //         const rowId = this.getAttribute('data-id');
            //         const levelKemungkinanSelect = document.getElementById('levelKemungkinan-' +
            //             rowId);
            //         const levelDampakSelect = document.getElementById('levelDampak-' + rowId);
            //         const efektivitasSelect = document.getElementById('efektivitas-' + rowId);

            //         if (levelKemungkinanSelect) levelKemungkinanSelect.disabled = false;
            //         if (levelDampakSelect) levelDampakSelect.disabled = false;
            //         if (efektivitasSelect) efektivitasSelect.disabled = false;

            //         const saveBtn = this.closest('tr').querySelector('#saveanalisisBtn');
            //         if (saveBtn) saveBtn.disabled = false;
            //     });
            // });

            // document.querySelectorAll('#saveanalisisBtn').forEach(saveBtn => {
            //     saveBtn.addEventListener('click', function(event) {
            //         event.preventDefault();
            //         const rowId = this.closest('tr').querySelector(
            //             'input[name="manajemen_resiko_ids[]"]').value;
            //         const levelKemungkinanSelect = document.getElementById('levelKemungkinan-' +
            //             rowId);
            //         const levelDampakSelect = document.getElementById('levelDampak-' + rowId);
            //         const efektivitasSelect = document.getElementById('efektivitas-' + rowId);

            //         if (levelKemungkinanSelect) levelKemungkinanSelect.disabled = true;
            //         if (levelDampakSelect) levelDampakSelect.disabled = true;
            //         if (efektivitasSelect) efektivitasSelect.disabled = true;

            //         this.closest('form').submit();
            //     });
            // });




            function initializeUraianTable() {
                const uraianTable = $('#uraian-table').DataTable({
                    processing: true,
                    serverSide: true,
                    ajax: {
                        url: "{{ route('admin.geturaiandata') }}",
                        type: "GET",
                        error: function(xhr, error, thrown) {
                            console.error('Error fetching data:', error);
                            console.error('Response:', xhr.responseText);
                        }
                    },
                    columns: [{
                            data: "id",
                            render: function(data, type, row) {
                                var isDisabled = (row.status === 'Rejected' || row.status ===
                                    'On Progress') ? 'disabled' : '';
                                var disabledColor = (row.status === 'Rejected') ? 'bg-red-500' : (
                                        row.status === 'On Progress') ? 'bg-orange-500' :
                                    'bg-green-500';
                                var isChecked = window.selectedUraianIds && window.selectedUraianIds
                                    .includes(String(data)) ? 'checked disabled' : '';
                                console.log(row);
                                console.log(isChecked);
                                console.log(window.selectedUraianIds)
                                return '<input type="checkbox" class="uraian-checkbox" data-uraian-id="' +
                                    data + '" ' + isChecked + ' ' + isDisabled + '>';
                            }
                        },
                        {
                            data: "uraian"
                        },
                        {
                            data: "status",
                            render: function(data, type, row) {
                                var color = '';
                                if (data === 'Accepted') {
                                    color = 'green';
                                    row.status =
                                        'Accepted';
                                } else if (data === 'On Progress') {
                                    color = 'orange';
                                } else if (data === 'Rejected') {
                                    color = 'red';
                                }
                                return '<span style="border: 2px solid ' + color +
                                    '; background-color: ' + color +
                                    '; color: white; padding: 2px 5px; border-radius: 4px;">' +
                                    data + '</span>';
                            }
                        },
                        {
                            data: "status",
                            visible: false,
                            render: function(data, type, row) {
                                if (data === 'Accepted') {
                                    return 1;
                                } else if (data === 'On Progress') {
                                    return 2;
                                } else if (data === 'Rejected') {
                                    return 3;
                                }
                                return 4;
                            }
                        }
                    ],
                    order: [
                        [3, 'asc']
                    ],
                    createdRow: function(row, data, dataIndex) {
                        if (data.status === 'Rejected') {
                            $(row).addClass('bg-red-200');
                        }
                    },
                    initComplete: function(settings, json) {
                        this.api().columns().every(function() {
                            var column = this;
                            var input = $(
                                    '<input type="text" placeholder="Search" class="w-full text-sm p-1 border rounded" />'
                                )
                                .appendTo($(column.header()).empty())
                                .on('keyup change clear', function() {
                                    if (column.search() !== this.value) {
                                        column.search(this.value).draw();
                                    }
                                });
                        });
                    }
                });
            }

            document.addEventListener('click', function(event) {
                if (event.target.classList.contains('openUraianModal')) {
                    event.preventDefault();
                    selectedManajemenResikoId = event.target.getAttribute('data-manajemen-resiko-id');
                    selectedUraianID = event.target.getAttribute('data-uraian-id');
                    console.log('Manajemen Resiko ID:', selectedManajemenResikoId);
                    console.log('Uraian ID:', selectedUraianID);

                    if (selectedUraianID && selectedUraianID.trim() !== '') {
                        try {
                            window.selectedUraianIds = JSON.parse(selectedUraianID);
                            if (!Array.isArray(window.selectedUraianIds)) {
                                window.selectedUraianIds = [];
                            }
                        } catch (e) {
                            console.error('Error parsing JSON:', e);
                            window.selectedUraianIds = [];
                        }
                    } else {
                        window.selectedUraianIds = [];
                    }
                    uraianModal.classList.remove('hidden');
                    if ($.fn.DataTable.isDataTable('#uraian-table')) {
                        $('#uraian-table').DataTable().ajax
                            .reload();
                    } else {
                        initializeUraianTable();
                    }
                }
            });

            if (open) {
                closeModal4.addEventListener('click', function() {
                    uraianModal.classList.add('hidden');
                });
            }
            if (closeModal4) {
                closeModal4.addEventListener('click', function() {
                    uraianModal.classList.add('hidden');
                });
            }

            if (openAdduraianModal) {
                openAdduraianModal.addEventListener('click', function() {
                    addUraianModal.classList.remove('hidden');
                });
            }

            if (cancelUraianBtn) {
                cancelUraianBtn.addEventListener('click', function() {
                    addUraianModal.classList.add('hidden');
                });
            }

            if (saveUraianBtn) {
                saveUraianBtn.addEventListener('click', function() {
                    const selectedUraian = [];
                    document.querySelectorAll('.uraian-checkbox:checked').forEach(function(checkbox) {
                        selectedUraian.push(checkbox.getAttribute(
                            'data-uraian-id'));
                    });
                    console.log(selectedUraian);
                    if (selectedUraian.length > 0) {
                        fetch('{{ route('admin.analisis.saveuraian') }}', {
                                method: 'POST',
                                headers: {
                                    'Content-Type': 'application/json',
                                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                                },
                                body: JSON.stringify({
                                    uraian: selectedUraian,
                                    manajemen_resiko_id: selectedManajemenResikoId
                                })
                            })
                            .then(response => response.json())
                            .then(data => {
                                if (data.success) {
                                    console.log(selectedUraian);
                                    alert('Uraian berhasil disimpan!');
                                    uraianModal.classList.add('hidden');
                                    location.reload();
                                } else {
                                    alert('Terjadi kesalahan saat menyimpan uraian.');
                                }
                            })
                            .catch(error => console.error('Error:', error));
                    } else {
                        alert('Pilih setidaknya satu uraian.');
                    }
                });
            }
        });
    </script>

</x-admin-layout>
