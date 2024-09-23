<x-admin-layout>



    <div class="flex justify-center mt-10">
        <div class="bg-white shadow-md rounded-lg p-6 w-full ">
            <h1 class="text-2xl font-bold mb-6" id="cek">Identifikasi Risiko</h1>
            <form id="identifikasiResikoForm">
                <div class="mb-4">
                    <label class="block text-gray-700 mb-2" for="tim-bidang">Tim/Bidang</label>
                    <select id="tim" name="tim" class="w-full p-2 border rounded-lg">
                        <option value="">-- Pilih Tim/Bidang --</option>
                        @foreach ($timProjects as $tim)
                            <option value="{{ $tim->id }}">{{ $tim->nama_team }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="mb-4">
                    <label class="block text-gray-700 mb-2" for="proses-bisnis">Proses Bisnis</label>
                    <select id="proses_bisnis" name="proses_bisnis"  class="w-full p-2 border rounded-lg">
                        <option value="">-- Pilih Proses Bisnis --</option>
                        @foreach ($ProsesBisnis as $proses)
                            <option value="{{ $proses->id }}">{{ $proses->proses_bisnis }}</option>
                        @endforeach
                    </select>
                </div>
                <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded">Filter</button>
            </form>
        </div>
    </div>
    <div class="container mx-auto mt-10">
        <div class="flex justify-between items-center mb-4 space-x-4">
            <div class="flex space-x-4">
                <button id="refreshIdentificationBtn" class="bg-blue-500 text-white px-4 py-2 rounded-full border border-blue-500">Refresh</button>
                @if (auth()->check() && auth()->user()->hasRole('admin') || auth()->user()->hasRole('ketua_tim'))
                <button id="tambahresiko" class="bg-gray-500 text-white px-4 py-2 rounded-full border border-gray-500" disabled>Tambah Risiko</button>
                @endif
            </div>
            <input type="text" id="searchInput" class="p-2 border rounded-lg" placeholder="Cari..." />
        </div>

        <div class="overflow-x-auto bg-white shadow-md rounded-lg">
            <table class="min-w-full border-collapse border border-gray-300" id="riskTable">
                <thead class="bg-gray-50">
                    <tr class="bg-gray-100 border border-gray-300">
                        <th class="px-6 py-3 border border-gray-300 text-middle text-xs font-medium text-gray-500 uppercase tracking-wider">No</th>
                    <th class="px-6 py-3 border border-gray-300 text-middle text-xs font-medium text-gray-500 uppercase tracking-wider">Proses Bisnis</th>
                    <th class="px-6 py-3 border border-gray-300 text-middle text-xs font-medium text-gray-500 uppercase tracking-wider">Tim</th>
                    <th class="px-6 py-3 border border-gray-300 text-middle text-xs font-medium text-gray-500 uppercase tracking-wider">Pernyataan Risiko</th>
                    <th class="px-6 py-3 border border-gray-300 text-middle text-xs font-medium text-gray-500 uppercase tracking-wider">Jenis</th>
                    <th class="px-6 py-3 border border-gray-300 text-middle text-xs font-medium text-gray-500 uppercase tracking-wider">Sumber</th>
                    <th class="px-6 py-3 border border-gray-300 text-middle text-xs font-medium text-gray-500 uppercase tracking-wider">Kategori</th>
                    <th class="px-6 py-3 border border-gray-300 text-middle text-xs font-medium text-gray-500 uppercase tracking-wider">Area Dampak</th>
                    <th class="px-6 py-3 border border-gray-300 text-middle text-xs font-medium text-gray-500 uppercase tracking-wider">Penyebab</th>
                    <th class="px-6 py-3 border border-gray-300 text-middle text-xs font-medium text-gray-500 uppercase tracking-wider">Dampak</th>
                    @if (auth()->check() && auth()->user()->hasRole('admin') || auth()->user()->hasRole('ketua_tim'))
                    <th class="px-6 py-3 border border-gray-300 text-middle text-xs font-medium text-gray-500 uppercase tracking-wider">Action</th>
                    @endif
                    </tr>

                </thead>

                <tbody class="bg-white divide-y divide-gray-200">

                    @foreach ($ManajemenResiko as $ManajemenResiko)
                    <form action="{{ route('admin.manajemenrisiko.store') }}" method="POST">
                        @csrf
                        <tr class="bg-white border border-gray-300">
                            <input type="hidden" name="manajemen_resiko_ids[]" value="{{ $ManajemenResiko->id }}">
                            <td class="px-6 py-4 whitespace-nowrap border border-gray-300">{{ $loop->iteration }}</td>
                            <td class="px-6 py-4 whitespace-nowrap border border-gray-300">{{ $ManajemenResiko->prosesbisnis->proses_bisnis }}</td>
                            <td class="px-6 py-4 whitespace-nowrap border border-gray-300">{{ $ManajemenResiko->tim_project->nama_team }}</td>
                            <td class="px-6 py-4 whitespace-nowrap border border-gray-300">{{ $ManajemenResiko->resiko->resiko }}</td>
                            <td class="px-6 py-4 whitespace-nowrap border border-gray-300">
                                <p style="color: red" id="alertjenis{{ $ManajemenResiko->id }}" {{ is_null($ManajemenResiko->id_jenis_resiko) ? "" : "hidden" }}>Jenis Kosong</p>
                                <span id="jenisResikoText{{ $ManajemenResiko->id }}" {{ is_null($ManajemenResiko->id_jenis_resiko) ? "hidden" : "" }}>
                                    {{ $ManajemenResiko->jenisResiko->jenis_resiko ?? '' }}
                                </span>
                                <select name="jenis_resiko[]" class="form-select pr-8 py-2 border" id="jenisResiko{{ $ManajemenResiko->id }}" style="display: none;">
                                    <option value="">-- Pilih Jenis Resiko --</option>
                                    @foreach ($jenisResiko as $jenis)
                                        <option value="{{ $jenis->id }}" {{ $jenis->id == $ManajemenResiko->id_jenis_resiko ? "selected" : "" }}> {{ $jenis->jenis_resiko }}</option>
                                    @endforeach
                                </select>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap border border-gray-300">
                                <p style="color: red" id="alertsumber{{ $ManajemenResiko->id }}"  {{ (is_null($ManajemenResiko->id_sumber_resiko))? "":"hidden" }}>Sumber Kosong</p>
                                <span id="sumberResikoText{{ $ManajemenResiko->id }}" {{ is_null($ManajemenResiko->id_sumber_resiko) ? "hidden" : "" }}>
                                    {{ $ManajemenResiko->sumberResiko ? $ManajemenResiko->sumberResiko->sumber_resiko : '' }}
                                </span>
                                <select name="sumber_resiko[]" class="form-select pr-8 py-2 border" id="sumberResiko{{ $ManajemenResiko->id }}" style="display: none;">
                                    <option value="">-- Pilih Sumber Resiko --</option>
                                    @foreach ($sumberResiko as $sumber)
                                        <option value="{{ $sumber->id }}" {{ $sumber->id == $ManajemenResiko->id_sumber_resiko? "selected":"" }}>
                                            {{ $sumber->sumber_resiko }}
                                        </option>
                                    @endforeach
                                </select>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap border border-gray-300">
                                <p style="color: red" id="alertskategori{{ $ManajemenResiko->id }}" {{ (is_null($ManajemenResiko->id_kategori_resiko))? "":"hidden" }}>Kategori Kosong</p>
                                <span id="kategoriResikoText{{ $ManajemenResiko->id }}" {{ is_null($ManajemenResiko->id_kategori_resiko) ? "hidden" : "" }}>
                                    {{ $ManajemenResiko->kategoriResiko ? $ManajemenResiko->kategoriResiko->deskripsi : 'N/A' }}
                                </span>
                                <select name="kategori_resiko[]" class="form-select pr-8 py-2 border" id="kategoriResiko{{ $ManajemenResiko->id }}" style="display: none;">
                                    <option value="">-- Pilih Kategori Resiko --</option>
                                    @if(!empty($kategoriResiko))
                                        @foreach ($kategoriResiko as $kategori)
                                            <option value="{{ $kategori->id }}" {{ $kategori->id == $ManajemenResiko->id_kategori_resiko? "selected":"" }}>
                                                {{ $kategori->deskripsi }}
                                            </option>
                                        @endforeach
                                    @endif
                                </select>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap border border-gray-300">
                                <p style="color: red" id="alertarea{{ $ManajemenResiko->id }}" {{ (is_null($ManajemenResiko->id_area_dampak))? "":"hidden" }}>Area Kosong</p>
                                <span id="areaDampakText{{ $ManajemenResiko->id }}" {{ is_null($ManajemenResiko->id_area_dampak) ? "hidden" : "" }}>
                                    {{ $ManajemenResiko->areaDampak ? $ManajemenResiko->areaDampak->area_dampak : 'N/A' }}
                                </span>
                                <select name="area_dampak[]" class="form-select pr-8 py-2 border" id="areadampak{{ $ManajemenResiko->id }}" style="display: none;">
                                    <option value="">-- Pilih Area Dampak --</option>
                                    @if(isset($areaDampak) && count($areaDampak) > 0)
                                        @foreach ($areaDampak as $area)
                                            <option value="{{ $area->id }}" {{ $area->id == $ManajemenResiko->id_area_dampak? "selected":"" }}>
                                                {{ $area->area_dampak }}
                                            </option>
                                        @endforeach
                                    @endif
                                </select>
                            </td>

                            {{-- Penyebab --}}
                            @if (auth()->check() && auth()->user()->hasRole('admin') || auth()->user()->hasRole('ketua_tim'))
                                <td class="px-6 py-4 whitespace-nowrap border border-gray-300">
                                    <div class="flex flex-col items-center">
                                        <!-- Tombol Pilih Penyebab dipusatkan -->
                                        <button class="bg-blue-500 text-white px-4 py-2 rounded openCauseModal"
                                                data-manajemen-resiko-id="{{ $ManajemenResiko->id }}"
                                                data-penyebab-id="{{ $ManajemenResiko->id_penyebab }}">
                                            Pilih Penyebab
                                        </button>

                                        <!-- Daftar Penyebab, ditampilkan rata kiri di bawah tombol -->
                                        <div id="selectedPenyebab" class="mt-4 text-left w-full">
                                            @php
                                                // Decode the JSON string into a PHP array
                                                $penyebabIds = json_decode($ManajemenResiko->id_penyebab, true);
                                            @endphp

                                            @if (is_array($penyebabIds) && count($penyebabIds) > 0)
                                            <ul class="list-disc list-inside text-gray-800 ml-4">
                                                @foreach ($penyebabIds as $item)
                                                    @foreach ($penyebab as $penyebabItem)
                                                        @if ($penyebabItem->id == $item)
                                                            @php
                                                                // Membuat variabel yang menyimpan id dampak dalam bentuk json tanpa id yang dipilih
                                                                $penyebabHapus = array_diff($penyebabIds, [$item]);
                                                            @endphp
                                                            <li class="flex justify-between items-center">
                                                                <span>{{ $penyebabItem->penyebab }}</span>
                                                                <a href="{{ url('/admin/manajemenresiko/hapuspenyebab/' . $ManajemenResiko->id . '/' . $item) }}"
                                                                    class="text-red-500 hover:text-red-700 ml-2"
                                                                    id="hapusPenyebab"
                                                                    onclick="return confirm('Anda yakin ingin menghapus item ini?');">
                                                                    <i class="fas fa-trash-alt"></i>
                                                                </a>
                                                            </li>
                                                        @endif
                                                    @endforeach
                                                @endforeach
                                            </ul>

                                            @else
                                                <!-- Jika tidak ada penyebab yang dipilih -->
                                                <p class="text-red-500 italic ml-4">Tidak ada Penyebab yang dipilih</p>
                                            @endif
                                        </div>
                                    </div>
                                </td>
                                @else
                                <td class="px-6 py-4 whitespace-nowrap border border-gray-300">
                                    <div class="">
                                        @php
                                            // Decode the JSON string into a PHP array
                                            $penyebabIds = json_decode($ManajemenResiko->id_penyebab, true);
                                        @endphp

                                        @if (is_array($penyebabIds) && count($penyebabIds) > 0)
                                        <ul class="px-6 py-4">
                                            @foreach ($penyebabIds as $item)
                                                @foreach ($penyebab as $penyebabItem)
                                                    @if ($penyebabItem->id == $item)
                                                        @php
                                                            // Membuat variabel yang menyimpan id dampak dalam bentuk json tanpa id yang dipilih
                                                            $penyebabHapus = array_diff($penyebabIds, [$item]);
                                                        @endphp
                                                        <li class="list-disc ">
                                                            <span>{{ $penyebabItem->penyebab }}</span>
                                                        </li>
                                                    @endif
                                                @endforeach
                                            @endforeach
                                        </ul>

                                        @else
                                            <!-- Jika tidak ada penyebab yang dipilih -->
                                            <p class="text-red-500 italic ml-4">Tidak ada Penyebab yang dipilih</p>
                                        @endif
                                    </div>
                                </td>
                                @endif


                             {{-- Dampak --}}
                             @if (auth()->check() && auth()->user()->hasRole('admin') || auth()->user()->hasRole('ketua_tim'))
                             <td class="px-6 py-4 whitespace-nowrap border border-gray-300">
                                <div class="flex flex-col items-center">
                                    <!-- Tombol Pilih Dampak dipusatkan -->
                                    <button class="bg-blue-500 text-white px-4 py-2 rounded openImpactModal"
                                            data-manajemen-resiko-id="{{ $ManajemenResiko->id }}"
                                            data-dampak-id="{{ $ManajemenResiko->id_dampak }}">
                                        Pilih Dampak
                                    </button>

                                    <!-- Daftar Dampak, ditampilkan rata kiri di bawah tombol -->
                                    <div id="selectedDampak" class="mt-4 text-left w-full">
                                        @php
                                            // Decode the JSON string into a PHP array
                                            $dampakIds = json_decode($ManajemenResiko->id_dampak, true);
                                        @endphp

                                        @if (is_array($dampakIds) && count($dampakIds) > 0)
                                        <ul class="list-disc list-inside text-gray-800 ml-4">
                                            @foreach ($dampakIds as $item)
                                                @foreach ($dampak as $dampakItem)
                                                    @if ($dampakItem->id == $item)
                                                        @php
                                                            // Membuat variabel yang menyimpan id dampak dalam bentuk json tanpa id yang dipilih
                                                            $dampakHapus = array_diff($dampakIds, [$item]);
                                                        @endphp
                                                        <li class="flex justify-between items-center">
                                                            <span>{{ $dampakItem->dampak }}</span>
                                                            <a href="{{ url('/admin/manajemenresiko/hapusdampak/' . $ManajemenResiko->id . '/' . $item) }}"
                                                                class="text-red-500 hover:text-red-700 ml-2"
                                                                id="hapusDampak"
                                                                onclick="return confirm('Anda yakin ingin menghapus item ini?');">
                                                                <i class="fas fa-trash-alt"></i>
                                                             </a>
                                                        </li>
                                                    @endif
                                                @endforeach
                                            @endforeach
                                        </ul>

                                        @else
                                            <!-- Jika tidak ada dampak yang dipilih -->
                                            <p class="text-red-500 italic ml-4">Tidak ada Dampak yang dipilih</p>
                                        @endif
                                    </div>
                                </div>
                            </td>
                            @else
                            <td class="px-6 py-4 whitespace-nowrap border border-gray-300">
                                <div class="">
                                    @php
                                        // Decode the JSON string into a PHP array
                                        $dampakIds = json_decode($ManajemenResiko->id_dampak, true);
                                    @endphp

                                    @if (is_array($dampakIds) && count($dampakIds) > 0)
                                    <ul class="px-6 py-4">
                                        @foreach ($dampakIds as $item)
                                            @foreach ($dampak as $dampakItem)
                                                @if ($dampakItem->id == $item)
                                                    @php
                                                        // Membuat variabel yang menyimpan id dampak dalam bentuk json tanpa id yang dipilih
                                                        $dampakHapus = array_diff($dampakIds, [$item]);
                                                    @endphp
                                                    <li class="list-disc ">
                                                        <span>{{ $dampakItem->dampak }}</span>
                                                    </li>
                                                @endif
                                            @endforeach
                                        @endforeach
                                    </ul>

                                    @else
                                        <!-- Jika tidak ada dampak yang dipilih -->
                                        <p class="text-red-500 italic ml-4">Tidak ada Dampak yang dipilih</p>
                                    @endif
                                </div>
                            </td>
                            @endif



                            </td>

                            @if (auth()->check() && auth()->user()->hasRole('admin') || auth()->user()->hasRole('ketua_tim'))
                            <td class="px-6 py-4 whitespace-nowrap border border-gray-300">
                                <a class="bg-blue-500 text-white width-mt-2 px-3 py-2 rounded cursor-pointer btnEdit" data-id="{{ $ManajemenResiko->id }}">Edit</a>
                                <button type="submit" class="bg-green-500 text-white px-2 py-1 rounded" id="saveidentificationBtn">Save</button>
                            </form>
                                <form action="{{ route('admin.manajemenrisiko.destroy', $ManajemenResiko->id) }}" method="POST" style="display:inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button class="bg-red-500 text-white width-mt-2 px-3 py-1 rounded cursor-pointer" type="submit" onclick="return confirm('Are you sure?')">Delete</button>
                                </form>
                            </td>
                            @endif


                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="flex justify-center mt-4">

        </div>
    </div>


    <!-- Modal Resiko Main-->
    <div class="modal fixed w-full h-full top-0 left-0 flex items-center justify-center hidden" id="resikoModal">
        <div class="modal-overlay absolute bg-blue-900 opacity-50"></div>
        <div class="modal-container bg-gray-100 md:max-w-4xl mx-auto md:h-4/5 rounded-lg shadow-lg z-50 overflow-y-auto " style="width: 1000px">
            <div class="modal-content py-4 text-left px-6">
                <div class="flex justify-between items-center pb-2">
                    <p class="text-xl font-bold">Pilih Resiko</p>
                    <div class="modal-close cursor-pointer z-50" id="closeModal" title="Tutup Modal">
                        <svg class="fill-current text-black" xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 18 18">
                            <path d="M14.53 3.47a.75.75 0 00-1.06 0L9 7.94 4.53 3.47a.75.75 0 00-1.06 1.06L7.94 9l-4.47 4.47a.75.75 0 001.06 1.06L9 10.06l4.47 4.47a.75.75 0 001.06-1.06L10.06 9l4.47-4.47a.75.75 0 000-1.06z"></path>
                        </svg>
                    </div>
                </div>
                <div class="flex justify-between items-center mb-4">
                    <input type="search" id="searchInput" placeholder="Masukkan kata kunci pencarian" class="w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm" />
                </div>
                <div class="flex justify-between mb-4">
                    <button id="refreshResikomodalBtn" class="bg-blue-500 text-white px-4 py-2 rounded-md">Refresh</button>
                    <button id="addRowBtn" class="bg-green-500 text-white px-4 py-2 rounded-md">Buat Baru</button>
                </div>
                <div class="mt-3">
                    <table id="resiko-table" class="min-w-full bg-white text-sm">
                        <thead>
                            <tr>
                                <th><input type="checkbox" id="selectAll" /></th>
                                <th>Pernyataan Resiko</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            <!-- Data will be loaded dynamically here -->
                        </tbody>
                    </table>
                </div>
                <div class="flex justify-end pt-2">
                    <button id="cancelBtn" class="bg-red-500 text-white px-4 py-2 rounded-md mr-2">Batal</button>
                    <button id="saveBtn" class="bg-green-500 text-white px-4 py-2 rounded-md">Simpan</button>
                </div>
            </div>

        </div>
    </div>

    {{-- <!-- Modal Tambah Resiko -> --}}
    <div id="addResikoModal" class="modal fixed w-full h-full top-0 left-0 flex items-center justify-center hidden">
        <div class="modal-overlay absolute w-full h-full bg-gray-900 opacity-50"></div>
        <div class="modal-container bg-white w-11/12 md:max-w-md mx-auto rounded-lg shadow-lg z-50 overflow-y-auto">
            <div class="modal-content py-4 text-left px-6">
                <!-- Title -->
                <div class="flex justify-between items-center pb-2">
                    <p class="text-xl font-bold">Tambah Resiko</p>
                    <div class="modal-close cursor-pointer z-50" id="closeAddModal" title="Tutup Modal">
                        <svg class="fill-current text-black" xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 18 18">
                            <path d="M14.53 3.47a.75.75 0 00-1.06 0L9 7.94 4.53 3.47a.75.75 0 00-1.06 1.06L7.94 9l-4.47 4.47a.75.75 0 001.06 1.06L9 10.06l4.47 4.47a.75.75 0 001.06-1.06L10.06 9l4.47-4.47a.75.75 0 000-1.06z"></path>
                        </svg>
                    </div>
                </div>
                <!-- Body -->
                <div>
                    <form id="addResikoForm">
                        <div class="mb-4">
                            <label for="resikoName" class="block text-sm font-medium text-gray-700">Nama Resiko</label>
                            <input type="text" id="resikoName" name="resikoName" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm" required>
                        </div>
                    </form>
                </div>
                <!-- Footer -->
                <div class="flex justify-end pt-2">
                    <button class="bg-red-500 text-white px-4 py-2 rounded-md mr-2" id="cancelAddResiko">Batal</button>
                    <button class="bg-green-500 text-white px-4 py-2 rounded-md" id="saveResikoBtn">Simpan</button>
                </div>
            </div>
        </div>
    </div>



    @include('admin.risk.components.modal-penyebab')
    @include('admin.risk.components.modal-dampak')


    <script>
        document.addEventListener('DOMContentLoaded', function () {
            //resiko
            const tambahResikoBtn = document.getElementById('tambahresiko');
            const timDropdown = document.getElementById('tim'); // Ganti dengan id dropdown tim Anda
            const prosesBisnisDropdown = document.getElementById('proses_bisnis'); // Ganti dengan id dropdown proses bisnis Anda
            const resikoModal = document.getElementById('resikoModal');
            const closeModalBtn = document.getElementById('closeModal');
            const simpanResikoBtn = document.getElementById('simpanResiko');
            const tambahResikoModal = document.getElementById('TambahresikoModal');

            const refreshBtn = document.getElementById('refreshIdentificationBtn');

            //penyebab
            const penyebabModal = document.getElementById('penyebabModal');
            const closeModal3 = document.getElementById('closeModal3');
            const openAddCauseModal = document.getElementById('openAddCauseModal');
            const addCauseModal = document.getElementById('addCauseModal');
            const cancelCauseBtn = document.getElementById('cancelCauseBtn');
            const savePenyebabBtn = document.getElementById('savePenyebabBtn');

            //dampak
            const dampakModal = document.getElementById('dampakModal');
            const closeModal2 = document.getElementById('closeModal2');
            const openAddImpactModal = document.getElementById('openAddImpactModal');
            const addImpactModal = document.getElementById('addImpactModal');
            const cancelImpactBtn = document.getElementById('cancelImpactBtn');
            const saveDampakBtn = document.getElementById('saveDampakBtn');

            // Definisikan variabel di luar event listener
            let selectedManajemenResikoId = null;

            window.selectedPenyebabIds = [];
            window.selectedDampakIds = [];

        //part penyebab

        function initializePenyebabTable() {
            const penyebabTable = $('#penyebab-table').DataTable({
                processing: true,
                serverSide: true,
                ajax: {
                    url: "{{ route('admin.getpenyebabdata') }}",
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
                            var isChecked = window.selectedPenyebabIds && window.selectedPenyebabIds.includes(String(data)) ? 'checked disabled' : '';
                            console.log(row);
                            console.log(isChecked);
                            console.log(window.selectedPenyebabIds)
                            return '<input type="checkbox" class="penyebab-checkbox" data-penyebab-id="' + data + '" ' + isChecked + ' ' + isDisabled + '>';
                        }
                    },
                    { data: "penyebab" },
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

            // Delegasi event listener untuk tombol "Pilih penyebab"
            document.addEventListener('click', function (event) {
                if (event.target.classList.contains('openCauseModal')) {
                    event.preventDefault(); // Mencegah perilaku default
                    selectedManajemenResikoId = event.target.getAttribute('data-manajemen-resiko-id');
                    selectedPenyebabID = event.target.getAttribute('data-penyebab-id');
                       // Log or use these IDs as needed
                    console.log('Manajemen Resiko ID:', selectedManajemenResikoId);
                    console.log('Penyebab ID:', selectedPenyebabID);

                     // Store the penyebabId for later use
                    // Check if selectedPenyebabID is null or empty
                    if (selectedPenyebabID && selectedPenyebabID.trim() !== '') {
                        try {
                            // Parse the JSON string safely
                            window.selectedPenyebabIds = JSON.parse(selectedPenyebabID);

                            // Ensure it's an array
                            if (!Array.isArray(window.selectedPenyebabIds)) {
                                window.selectedPenyebabIds = [];
                            }
                        } catch (e) {
                            // Handle JSON parsing error
                            console.error('Error parsing JSON:', e);
                            window.selectedPenyebabIds = [];
                        }
                    } else {
                        // If null or empty, initialize as an empty array
                        window.selectedPenyebabIds = [];
                    }
                    penyebabModal.classList.remove('hidden');

                            // Initialize or redraw the DataTable (if necessary)
                if ($.fn.DataTable.isDataTable('#penyebab-table')) {
                    $('#penyebab-table').DataTable().ajax.reload(); // Reload data if DataTable is already initialized
                } else {
                    initializePenyebabTable(); // Initialize DataTable if not yet initialized
                }
                }
            });
            if (open) {
                closeModal3.addEventListener('click', function () {
                    penyebabModal.classList.add('hidden');
                });
            }
            if (closeModal3) {
                closeModal3.addEventListener('click', function () {
                    penyebabModal.classList.add('hidden');
                });
            }

            if (openAddCauseModal) {
                openAddCauseModal.addEventListener('click', function () {
                    addCauseModal.classList.remove('hidden');
                });
            }

            if (cancelCauseBtn) {
                cancelCauseBtn.addEventListener('click', function () {
                    addCauseModal.classList.add('hidden');
                });
            }

            if (savePenyebabBtn) {
                savePenyebabBtn.addEventListener('click', function () {
                    const selectedPenyebab = [];
                    document.querySelectorAll('.penyebab-checkbox:checked').forEach(function (checkbox) {
                        selectedPenyebab.push(checkbox.getAttribute('data-penyebab-id')); // Pastikan atribut ini adalah ID penyebab
                    });
                    console.log(selectedPenyebab);
                    if (selectedPenyebab.length > 0) {
                        fetch('{{ route("admin.manajemenresiko.savepenyebab") }}', {
                            method: 'POST',
                            headers: {
                                'Content-Type': 'application/json',
                                'X-CSRF-TOKEN': '{{ csrf_token() }}'
                            },
                            body: JSON.stringify({
                                penyebab: selectedPenyebab,
                                manajemen_resiko_id: selectedManajemenResikoId
                            })
                        })
                        .then(response => response.json())
                        .then(data => {
                            if (data.success) {
                                console.log(selectedPenyebab)
                                alert('Penyebab berhasil disimpan!');
                                penyebabModal.classList.add('hidden');
                                location.reload();
                            } else {
                                alert('Terjadi kesalahan saat menyimpan penyebab.');
                            }
                        })
                        .catch(error => console.error('Error:', error));
                    } else {
                        alert('Pilih setidaknya satu penyebab.');
                    }
                });
            }

        //end penyebab

        //part dampak

        function initializeDampakTable() {
            const dampakTable = $('#dampak-table').DataTable({
                processing: true,
                serverSide: true,
                ajax: {
                    url: "{{ route('admin.getdampakdata') }}",
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
                            var isChecked = window.selectedDampakIds && window.selectedDampakIds.includes(String(data)) ? 'checked disabled' : '';
                            console.log(row);
                            console.log(isChecked);
                            console.log(window.selectedDampakIds)
                            return '<input type="checkbox" class="dampak-checkbox" data-dampak-id="' + data + '" ' + isChecked + ' ' + isDisabled + '>';
                        }
                    },
                    { data: "dampak" },
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

        // Delegasi event listener untuk tombol "Pilih dampak"
        document.addEventListener('click', function (event) {
                if (event.target.classList.contains('openImpactModal')) {
                    event.preventDefault(); // Mencegah perilaku default
                    selectedManajemenResikoId = event.target.getAttribute('data-manajemen-resiko-id');
                    selectedDampakID = event.target.getAttribute('data-dampak-id');
                       // Log or use these IDs as needed
                    console.log('Manajemen Resiko ID:', selectedManajemenResikoId);
                    console.log('Dampak ID:', selectedDampakID);

                     // Store the dampakId for later use
                    // Check if dampakID is null or empty
                    if (selectedDampakID && selectedDampakID.trim() !== '') {
                        try {
                            // Parse the JSON string safely
                            window.selectedDampakIds = JSON.parse(selectedDampakID);

                            // Ensure it's an array
                            if (!Array.isArray(window.selectedDampakIds)) {
                                window.selectedDamapakIds = [];
                            }
                        } catch (e) {
                            // Handle JSON parsing error
                            console.error('Error parsing JSON:', e);
                            window.selectedDampakIds = [];
                        }
                    } else {
                        // If null or empty, initialize as an empty array
                        window.selectedDampakIds = [];
                    }
                    dampakModal.classList.remove('hidden');

                            // Initialize or redraw the DataTable (if necessary)
                if ($.fn.DataTable.isDataTable('#dampak-table')) {
                    $('#dampak-table').DataTable().ajax.reload(); // Reload data if DataTable is already initialized
                } else {
                    initializeDampakTable(); // Initialize DataTable if not yet initialized
                }
            }
        });

        if (closeModal2) {
            closeModal2.addEventListener('click', function () {
                dampakModal.classList.add('hidden');
            });
        }

        if (openAddImpactModal) {
            openAddImpactModal.addEventListener('click', function () {
                addImpactModal.classList.remove('hidden');
            });
        }

        if (cancelImpactBtn) {
            cancelImpactBtn.addEventListener('click', function () {
                addImpactModal.classList.add('hidden');
            });
        }

        if (saveDampakBtn) {
            saveDampakBtn.addEventListener('click', function () {
                const selectedDampak = [];
                document.querySelectorAll('.dampak-checkbox:checked').forEach(function (checkbox) {
                    selectedDampak.push(checkbox.getAttribute('data-dampak-id')); // Pastikan atribut ini adalah ID penyebab
                });
                console.log(selectedDampak);
                if (selectedDampak.length > 0) {
                    fetch('{{ route("admin.manajemenresiko.savedampak") }}', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': '{{ csrf_token() }}'
                        },
                        body: JSON.stringify({
                            dampak: selectedDampak,
                            manajemen_resiko_id: selectedManajemenResikoId
                        })
                    })
                    .then(response => response.json())
                    .then(data => {
                        if (data.success) {
                            console.log(selectedDampak)
                            alert('Dampak berhasil disimpan!');
                            dampakModal.classList.add('hidden');
                            location.reload();
                        } else {
                            alert('Terjadi kesalahan saat menyimpan dampak.');
                        }
                    })
                    .catch(error => console.error('Error:', error));
                } else {
                    alert('Pilih setidaknya satu dampak.');
                }
            });
        }


        // end dampak



    // resiko

            // Fungsi untuk mengecek apakah kedua dropdown sudah dipilih
            function checkDropdowns() {
                console.log('Checking dropdown values:', timDropdown.value, prosesBisnisDropdown.value);
                if (timDropdown.value !== '' && prosesBisnisDropdown.value !== '') {
                    tambahResikoBtn.disabled = false;
                    tambahResikoBtn.style.backgroundColor = 'red';  // Change button color to red
                } else {
                    tambahResikoBtn.disabled = true;
                }
            }

            if (timDropdown && prosesBisnisDropdown) {
                timDropdown.addEventListener('change', checkDropdowns);
                prosesBisnisDropdown.addEventListener('change', checkDropdowns);
            }

            /**
             * Risk Modal Script
            */

            const resikoTable = $('#resiko-table').DataTable({
                processing: true,
                serverSide: true,
                ajax: "{{ route('admin.getresikodata') }}", // Adjust with your route for fetching data
                columns: [
                    {
                        data: "id",
                        render: function(data, type, row) {
                            var isDisabled = (row.status === 'Rejected' || row.status === 'On Progress') ? 'disabled' : '';
                            return '<input type="checkbox" class="row-checkbox" value="' + data + '" ' + isDisabled + '>';
                        }
                    },
                    { data: "resiko" },
                    {
                        data: "status",
                        render: function(data, type, row) {
                            var color = '';
                            if (data === 'Accepted') {
                                color = 'green';
                            } else if (data === 'On Progress') {
                                color = 'orange';
                            } else if (data === 'Rejected') {
                                color = 'red';
                            }
                            return '<span style="border: 2px solid ' + color + '; background-color: ' + color + '; color: white; padding: 2px 5px; border-radius: 4px;">' + data + '</span>';
                        }
                    }
                ],
                order: [[2, 'asc']], // Sort by status column in ascending order
                initComplete: function() {
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
            });
            document.querySelectorAll('.btnEdit').forEach(button => {
                button.addEventListener('click', () => {
                    const id = button.dataset.id;
                    const jenisResiko = document.getElementById('jenisResiko' + id);
                    const sumberResiko = document.getElementById('sumberResiko' + id);
                    const kategoriResiko = document.getElementById('kategoriResiko' + id);
                    const areaDampak = document.getElementById('areadampak' + id);

                    const alertjenis = document.getElementById('alertjenis' + id);
                    const alertsumber = document.getElementById('alertsumber' + id);
                    const alertskategori = document.getElementById('alertskategori' + id);
                    const alertarea = document.getElementById('alertarea' + id);

                    const jenisResikoText = document.getElementById('jenisResikoText' + id);
                    const sumberResikoText = document.getElementById('sumberResikoText' + id);
                    const kategoriResikoText = document.getElementById('kategoriResikoText' + id);
                    const areaDampakText = document.getElementById('areaDampakText' + id);

                    if (jenisResiko && sumberResiko && kategoriResiko && areaDampak && alertjenis && alertsumber && alertskategori && alertarea) {
                        // Switch to edit mode
                        jenisResiko.style.display = 'inline';  // Show dropdown
                        sumberResiko.style.display = 'inline';  // Show dropdown
                        kategoriResiko.style.display = 'inline';  // Show dropdown
                        areaDampak.style.display = 'inline';  // Show dropdown

                        alertjenis.style.display = 'none';  // Hide text
                        alertsumber.style.display = 'none';  // Hide text
                        alertskategori.style.display = 'none';  // Hide text
                        alertarea.style.display = 'none';  // Hide text

                        // Hide text
                        jenisResikoText.style.display = 'none';
                        sumberResikoText.style.display = 'none';
                        kategoriResikoText.style.display = 'none';
                        areaDampakText.style.display = 'none';

                        // Enable dropdowns
                        jenisResiko.disabled = false;
                        sumberResiko.disabled = false;
                        kategoriResiko.disabled = false;
                        areaDampak.disabled = false;
                    } else {
                        console.error('Element not found for button with dataset id:', id);
                    }
                });
            });


            $('#selectAll').on('click', function() {
                var rows = table.rows({ 'search': 'applied' }).nodes();
                $('input[type="checkbox"]', rows).prop('checked', this.checked);
            });

            $('#refreshBtn').on('click', function() {
                table.ajax.reload();
            });

            $('#addRowBtn').on('click', function() {
                $('#addResikoModal').removeClass('hidden');
            });

            // Close the modal
            $('#closeAddModal, #cancelAddResiko').on('click', function() {
                $('#addResikoModal').addClass('hidden');
            });

            // Handle form submission
            $('#saveResikoBtn').on('click', function() {
                var resikoName = $('#resikoName').val();

                if(resikoName.trim() !== '') {
                    // Optionally, you can send the data to the server via AJAX.
                    // Example:

                    $.ajax({
                        url: '{{ route('admin.resiko.store') }}',
                        method: 'POST',
                        data: {
                            resiko: resikoName,
                            _token: $('meta[name="csrf-token"]').attr('content') // Laravel CSRF token
                        },
                        success: function(response) {
                            // Handle success (e.g., add the new resiko to the table)
                            $('#addResikoModal').addClass('hidden');

                            table.ajax.reload(null, false);
                        },
                        error: function(error) {
                            // Handle error
                        }
                    });

                    // For now, simply close the modal
                    $('#addResikoModal').addClass('hidden');
                } else {
                    alert('Please enter a valid resiko name.');
                }
            });

            $('#saveBtn').on('click', function() {
                var selected = [];
                $('input.row-checkbox:checked').each(function() {
                    selected.push($(this).val());
                });

                var formValues = {
                    tim: $('#tim').val(),
                    proses_bisnis: $('#proses_bisnis').val()
                };
                console.log(selected);

                $.ajax({
                    url: '{{ route('admin.manajemenresiko.initialstore') }}',
                    type: 'POST',
                    data: {
                        data: selected,
                        formValues: formValues,
                        _token: $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function(response) {
                        console.log('AJAX request successful');
                        location.reload();
                        if (response.errors) {
                            // Handle validation errors
                            console.log(response.errors);
                            // Display errors in the modal or elsewhere
                            alert(response.errors);
                        } else if (response.success) {
                            // Handle successful submission
                            console.log(response.success);
                            // Close the modal and/or update the UI as needed
                            $('#resikoModal').addClass('hidden');
                            alert(response.success); // Tampilkan pesan sukses
                            // Reload the page immediately
                        }
                    },
                    error: function(xhr) {
                        console.error('Error:', xhr.responseText);
                        alert('Terjadi kesalahan saat menyimpan data.');
                    }
                });
            });

            if (refreshBtn) {
                refreshBtn.addEventListener('click', function() {
                    location.reload();
                });
            } else {
                console.error('Element not found: refreshIdentificationBtn');
            }

            if (refreshResikomodalBtn) {
                refreshResikomodalBtn.addEventListener('click', function() {
                    $('#resiko-table').DataTable().ajax.reload();
                });
            } else {
                console.error('Element not found: refreshIdentificationBtn');
            }

            // Tampilkan modal "Pilih Resiko"
            if (tambahResikoBtn) {
                tambahResikoBtn.addEventListener('click', function () {
                    resikoModal.classList.remove('hidden');
                });
            } else {
                console.error('Element not found: tambahResikoBtn');
            }

            // Tutup modal "Pilih Resiko"
            if (closeModalBtn) {
                closeModalBtn.addEventListener('click', function () {
                    resikoModal.classList.add('hidden');
                });
            } else {
                console.error('Element not found: closeModalBtn');
            }


        });
    </script>


</x-admin-layout>
