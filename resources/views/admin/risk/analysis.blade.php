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
                            <option value="{{ $proses->id }}" {{ request('proses_bisnis') == $proses->id ? 'selected' : '' }}>
                                {{ $proses->proses_bisnis }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded">Filter</button>
            </form>
        </div>
    </div>

    {{-- tabel analisis resiko --}}
    <div class="container mx-auto mt-10">
        <div class="flex justify-between items-center mb-4 space-x-4">
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

                        @foreach ($ManajemenResiko as $ManajemenResiko)

                        <form action="{{ route('admin.analisis.store') }}" method="POST">
                            @csrf
                            <tr>
                                <input type="hidden" name="manajemen_resiko_ids[]" value="{{ $ManajemenResiko->id }}">
                                <td class="px-6 py-4 whitespace-nowrap">{{ $loop->iteration }}</td>
                                <td class="px-6 py-4 whitespace-nowrap">{{ $ManajemenResiko->prosesbisnis->proses_bisnis }}</td>
                                <td class="px-6 py-4 whitespace-nowrap">{{ $ManajemenResiko->tim_project->nama_team }}</td>
                                <td class="px-6 py-4 whitespace-nowrap">{{ $ManajemenResiko->resiko->resiko }}</td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    @if($ManajemenResiko->jenisResiko){{ $ManajemenResiko->jenisResiko->jenis_resiko }}
                                    @else<span class="text-red-500">Data Tidak Tersedia</span>
                                    @endif</td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    @if($ManajemenResiko->sumberResiko){{ $ManajemenResiko->sumberResiko->sumber_resiko }}
                                    @else<span class="text-red-500">Data Tidak Tersedia</span>
                                    @endif</td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    @if($ManajemenResiko->kategoriResiko){{ $ManajemenResiko->kategoriResiko->deskripsi }}
                                    @else<span class="text-red-500">Data Tidak Tersedia</span>
                                    @endif</td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    @if($ManajemenResiko->areaDampak){{ $ManajemenResiko->areaDampak->area_dampak }}
                                    @else<span class="text-red-500">Data Tidak Tersedia</span>
                                    @endif</td>
                                <td class="px-6 py-4 whitespace-nowrap border-r border-gray-200">
                                    @if($ManajemenResiko->id_penyebab)
                                        @php
                                            $penyebabIds = json_decode($ManajemenResiko->id_penyebab, true);
                                            $penyebabNames = \App\Models\Penyebab::whereIn('id', $penyebabIds)->pluck('penyebab')->toArray();
                                        @endphp
                                        @foreach ($penyebabNames as $penyebab)
                                            <li class="list-disc">{{ $penyebab }}</li>
                                        @endforeach
                                    @else
                                        Tidak ada penyebab
                                    @endif
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap border-r border-gray-200">
                                    @if($ManajemenResiko->id_dampak)
                                        @php
                                            $dampakIds = json_decode($ManajemenResiko->id_dampak, true);
                                            $dampakNames = \App\Models\Dampak::whereIn('id', $dampakIds)->pluck('dampak')->toArray();
                                        @endphp
                                        @foreach ($dampakNames as $dampak)
                                            <li class="list-disc">{{ $dampak }}</li>
                                        @endforeach
                                    @else
                                        Tidak ada dampak
                                    @endif
                                </td>
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
                                <td class="px-6 py-4 whitespace-nowrap border-r border-gray-200" id="hasilLevelResiko{{ $ManajemenResiko->id }}">
                                    <!-- Level Risiko akan diupdate di sini -->
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <button class="bg-blue-500 text-white px-4 py-2 rounded openUraianModal" data-manajemen-resiko-id="{{ $ManajemenResiko->id }}" data-uraian-id="{{ $ManajemenResiko->id_uraian }}"> Pilih Uraian </button>
                                    <div id="selectedUraian" class="mt-2">
                                        @php
                                            // Decode the JSON string into a PHP array
                                            $uraianIds = json_decode($ManajemenResiko->id_uraian, true);
                                        @endphp

                                        @if (is_array($uraianIds))
                                            @foreach ($uraianIds as $item)
                                                @foreach ($uraian as $uraianItem)
                                                    @if ($uraianItem->id == $item)
                                                        @php
                                                            //membuat variabel yang menyimpan id dampak dalam bentuk json tanpa id yang dipilih
                                                            $uraianHapus = array_diff($uraianIds, [$item]);
                                                        @endphp
                                                        <a href="#" class="text-black-50">{{ $uraianItem->uraian }}</a>
                                                        {{-- berikan link untuk menghapus dampak yg dipilih --}}
                                                        <a href="/admin/analisis/hapusuraian/{{ $ManajemenResiko->id }}/{{ $item }}" class="text-red-500" id="hapusUraian">Hapus</a>
                                                        <br>
                                                    @endif
                                                @endforeach
                                            @endforeach
                                        @else
                                            <!-- Handle the case where id_dampak is not an array or is invalid -->
                                            <p>Tidak ada Uraian yang dipilih</p>
                                        @endif
                                    </div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap border-r border-gray-200">
                                    <select class="w-48 p-2 border-2 border-gray-300 rounded-lg shadow-sm effectiveness" data-row="{{ $ManajemenResiko->id }}">
                                        <option value="" {{ is_null($ManajemenResiko->efektivitas) ? 'selected' : '' }}>-- Pilih Efektivitas --</option>
                                        <option value="efektif" {{ $ManajemenResiko->efektivitas === 'efektif' ? 'selected' : '' }}>Efektif</option>
                                        <option value="tidak_efektif" {{ $ManajemenResiko->efektivitas === 'tidak_efektif' ? 'selected' : '' }}>Tidak Efektif</option>
                                    </select>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <a  class="bg-blue-500 text-white width-mt-2 px-2 py-2 rounded cursor-pointer" id="btnEdit" data-id="{{ $ManajemenResiko->id }}">Edit</a>
                                    <button type="submit" class="bg-green-500 text-white px-2 py-1 rounded" id="saveanalisisBtn">Save</button>
                                </form>
                                </td>
                            </tr>
                            </form>
                    @endforeach
                </table>
            </div>
        </div>
    </div>
    {{-- modal uraian --}}
    @include('admin.risk.components.modal-uraian')

    <script>
         document.addEventListener('DOMContentLoaded', function () {
            //urian modal
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

                    hasilLevelResiko.classList.remove('bg-red-500', 'bg-yellow-500', 'bg-yellow-200', 'bg-green-300', 'bg-green-500', 'text-white', 'text-black');

                // Apply background color based on risk level
                if (result) {
                    if (result.hasil_level_resiko === 'Sangat Tinggi') {
                        hasilLevelResiko.classList.add('bg-red-500', 'text-white');
                    } else if (result.hasil_level_resiko === 'Tinggi') {
                        hasilLevelResiko.classList.add('bg-yellow-500', 'text-black');
                    } else if (result.hasil_level_resiko === 'Sedang') {
                        hasilLevelResiko.classList.add('bg-yellow-200', 'text-black');
                    } else if (result.hasil_level_resiko === 'Rendah') {
                        hasilLevelResiko.classList.add('bg-green-300', 'text-black');
                    } else if (result.hasil_level_resiko === 'Sangat Rendah') {
                        hasilLevelResiko.classList.add('bg-green-500', 'text-white');
                    }
                }
                } else {
                    hasilLevelResiko.value = 'KONTOL';
                    hasilLevelResiko.classList.remove('bg-red-500', 'bg-yellow-500', 'bg-yellow-200', 'bg-green-300', 'bg-green-500', 'text-white', 'text-black');
                }
            }
            levelKemungkinanSelects.forEach(select => {
                select.addEventListener('change', () => updateHasilLevelResiko(select));
            });

            levelDampakSelects.forEach(select => {
                select.addEventListener('change', () => updateHasilLevelResiko(select));
            });


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
                columns: [
                    {
                        data: "id",
                        render: function(data, type, row) {
                            var isDisabled = (row.status === 'Rejected' || row.status === 'On Progress') ? 'disabled' : '';
                            var disabledColor = (row.status === 'Rejected' ) ? 'bg-red-500' : (row.status === 'On Progress') ? 'bg-orange-500' : 'bg-green-500';
                            // Ensure proper comparison by converting to string
                            var isChecked = window.selectedUraianIds && window.selectedUraianIds.includes(String(data)) ? 'checked disabled' : '';
                            console.log(row);
                            console.log(isChecked);
                            console.log(window.selectedUraianIds)
                            return '<input type="checkbox" class="uraian-checkbox" data-uraian-id="' + data + '" ' + isChecked + ' ' + isDisabled + '>';
                        }
                    },
                    { data: "uraian" },
                    {
                        data: "status",
                        render: function(data, type, row) {
                            var color = '';
                            if (data === 'Accepted') {
                                color = 'green';
                                row.status = 'Accepted'; // Add this line to modify the status value
                            } else if (data === 'On Progress') {
                                color = 'orange';
                            } else if (data === 'Rejected') {
                                color = 'red';
                            }
                            return '<span style="border: 2px solid ' + color + '; background-color: ' + color + '; color: white; padding: 2px 5px; border-radius: 4px;">' + data + '</span>';
                        }
                    },
                    {
                        data: "status",
                        visible: false, // Kolom ini akan disembunyikan
                        render: function(data, type, row) {
                            if (data === 'Accepted') {
                                return 1;
                            } else if (data === 'On Progress') {
                                return 2;
                            } else if (data === 'Rejected') {
                                return 3;
                            }
                            return 4; // Default value for other statuses
                        }
                    }
                ],
                order: [[3, 'asc']], // Sort by the hidden status column in ascending order
                createdRow: function(row, data, dataIndex) {
                    // Apply background color based on the status
                    if (data.status === 'Rejected') {
                        $(row).addClass('bg-red-200'); // Add your desired class here
                    }
                },
                initComplete: function(settings, json) {
                    // Adding search boxes to each column
                    this.api().columns().every(function() {
                        var column = this;
                        var input = $('<input type="text" placeholder="Search" class="w-full text-sm p-1 border rounded" />')
                            .appendTo($(column.header()).empty())
                            .on('keyup change clear', function() {
                                if (column.search() !== this.value) {
                                    column.search(this.value).draw();
                                }
                            });
                    });
                }
            });// Initialize DataTable
        }

            // Delegasi event listener untuk tombol "Pilih uraian"
            document.addEventListener('click', function (event) {
                if (event.target.classList.contains('openUraianModal')) {
                    event.preventDefault(); // Mencegah perilaku default
                    selectedManajemenResikoId = event.target.getAttribute('data-manajemen-resiko-id');
                    selectedUraianID = event.target.getAttribute('data-uraian-id');
                    // Log or use these IDs as needed
                    console.log('Manajemen Resiko ID:', selectedManajemenResikoId);
                    console.log('Uraian ID:', selectedUraianID);

                    // Store the uraianId for later use
                    // Check if selectedUraianID is null or empty
                    if (selectedUraianID && selectedUraianID.trim() !== '') {
                        try {
                            // Parse the JSON string safely
                            window.selectedUraianIds = JSON.parse(selectedUraianID);

                            // Ensure it's an array
                            if (!Array.isArray(window.selectedUraianIds)) {
                                window.selectedUraianIds = [];
                            }
                        } catch (e) {
                            // Handle JSON parsing error
                            console.error('Error parsing JSON:', e);
                            window.selectedUraianIds = [];
                        }
                    } else {
                        // If null or empty, initialize as an empty array
                        window.selectedUraianIds = [];
                    }
                    uraianModal.classList.remove('hidden');

                    // Initialize or redraw the DataTable (if necessary)
                    if ($.fn.DataTable.isDataTable('#uraian-table')) {
                        $('#uraian-table').DataTable().ajax.reload(); // Reload data if DataTable is already initialized
                    } else {
                        initializeUraianTable(); // Initialize DataTable if not yet initialized
                    }
                }
            });

            if (open) {
                closeModal4.addEventListener('click', function () {
                    uraianModal.classList.add('hidden');
                });
            }
            if (closeModal4) {
                closeModal4.addEventListener('click', function () {
                    uraianModal.classList.add('hidden');
                });
            }

            if (openAdduraianModal) {
                openAdduraianModal.addEventListener('click', function () {
                    addUraianModal.classList.remove('hidden');
                });
            }

            if (cancelUraianBtn) {
                cancelUraianBtn.addEventListener('click', function () {
                    addUraianModal.classList.add('hidden');
                });
            }

            if (saveUraianBtn) {
                saveUraianBtn.addEventListener('click', function () {
                    const selectedUraian = [];
                    document.querySelectorAll('.uraian-checkbox:checked').forEach(function (checkbox) {
                        selectedUraian.push(checkbox.getAttribute('data-uraian-id')); // Pastikan atribut ini adalah ID uraian
                    });
                    console.log(selectedUraian);
                    if (selectedUraian.length > 0) {
                        fetch('{{ route("admin.analisis.saveuraian") }}', {
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

