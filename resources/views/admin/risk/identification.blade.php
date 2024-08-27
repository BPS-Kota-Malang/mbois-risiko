<x-admin-layout>
    <div class="flex justify-center mt-10">
        <div class="bg-white shadow-md rounded-lg p-6 w-full ">
            <h1 class="text-2xl font-bold mb-6">Identifikasi Risiko</h1>
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
            </form>
        </div>
    </div>
    <div class="container mx-auto mt-10">
        <div class="flex justify-between items-center mb-4 space-x-4">
            <div class="flex space-x-4">
                <button id="refreshBtn" class="bg-blue-500 text-white px-4 py-2 rounded-full border border-blue-500">Refresh</button>
                <button id="tambahresiko" class="bg-red-500 text-white px-4 py-2 rounded-full border border-red-500">Tambah Risiko</button>
            </div>
            <input type="text" id="searchInput" class="p-2 border rounded-lg" placeholder="Cari..." />
        </div>

        <div class="overflow-x-auto bg-white shadow-md rounded-lg">
            <table class="min-w-full divide-y divide-gray-200" id="riskTable">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-3 text-middle text-xs font-medium text-gray-500 uppercase tracking-wider">No</th>
                        <th class="px-6 py-3 text-middle text-xs font-medium text-gray-500 uppercase tracking-wider">Proses Bisnis</th>
                        <th class="px-6 py-3 text-middle text-xs font-medium text-gray-500 uppercase tracking-wider">Tim</th>
                        <th class="px-6 py-3 text-middle text-xs font-medium text-gray-500 uppercase tracking-wider">Pernyataan Risiko</th>
                        <th class="px-6 py-4 text-middle text-xs font-medium text-gray-500 uppercase tracking-wider">Jenis</th>
                        <th class="px-6 py-3 text-middle text-xs font-medium text-gray-500 uppercase tracking-wider">Sumber</th>
                        <th class="px-6 py-3 text-middle text-xs font-medium text-gray-500 uppercase tracking-wider">Kategori</th>
                        <th class="px-6 py-3 text-middle text-xs font-medium text-gray-500 uppercase tracking-wider">Area Dampak</th>
                        <th class="px-6 py-3 text-middle text-xs font-medium text-gray-500 uppercase tracking-wider">Penyebab</th>
                        <th class="px-6 py-3 text-middle text-xs font-medium text-gray-500 uppercase tracking-wider">Dampak</th>
                        <th class="px-6 py-3 text-middle text-xs font-medium text-gray-500 uppercase tracking-wider">Action</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @foreach ($ManajemenResikos as $ManajemenResiko)
                        <tr>
                            <td class="px-6 py-4 whitespace-nowrap">{{ $loop->iteration }}</td>
                            <td class="px-6 py-4 whitespace-nowrap">{{ $ManajemenResiko->prosesbisnis->proses_bisnis }}</td>
                            <td class="px-6 py-4 whitespace-nowrap">{{ $ManajemenResiko->tim_project->nama_team }}</td>
                            <td class="px-6 py-4 whitespace-nowrap">{{ $ManajemenResiko->resiko->resiko }}</td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <select name="jenis_resiko[]" class="form-select pr-8 py-2 border">
                                    @foreach ($jenisResiko as $jenis)
                                        <option value="{{ $jenis->id }}"> {{ $jenis->jenis_resiko }}</option>
                                    @endforeach
                                </select>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <select name="sumber_resiko[]" class="form-select pr-8 py-2 border">
                                    @foreach ($sumberResiko as $sumber)
                                        <option value="{{ $sumber->id }}">{{ $sumber->sumber_resiko }}</option>
                                    @endforeach
                                </select>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <select name="kategori_resiko[]" class="form-select pr-8 py-2 border">
                                    @foreach ($kategoriResiko as $kategori)
                                        <option value="{{ $kategori->id }}">{{ $kategori->deskripsi }}</option>
                                    @endforeach
                                </select>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <select name="area_dampak[]" class="form-select pr-8 py-2 border">
                                    @foreach ($areaDampak as $area)
                                        <option value="{{ $area->id }}">{{ $area->area_dampak }}</option>
                                    @endforeach
                                </select>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <button class="bg-blue-500 text-white px-4 py-2 rounded" id="openModal">Pilih Penyebab</button>
                                <div id="selectedPenyebab" class="mt-2"></div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <button class="bg-blue-500 text-white px-4 py-2 rounded" id="openModal2">Pilih Dampak</button>
                                <div id="selectedDampak" class="mt-2"></div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <button class="bg-red-500 text-white px-2 py-1 rounded">Delete</button>
                                <button class="bg-blue-500 text-white px-2 py-1 rounded">Edit</button>
                                <button class="bg-green-500 text-white px-2 py-1 rounded" id="saveRiskBtn">Save</button>
                            </td>
                        </tr>
                    @endforeach
                    </tr>
                </tbody>
            </table>
        </div>
        <div class="flex justify-center mt-4">
            <nav class="inline-flex rounded-md shadow">
                <a href="#" class="px-3 py-2 rounded-l-md bg-white text-sm font-medium text-gray-500 hover:bg-gray-50">Previous</a>
                <a href="#" class="px-3 py-2 bg-white text-sm font-medium text-gray-700 hover:bg-gray-50">1</a>
                <a href="#" class="px-3 py-2 bg-white text-sm font-medium text-gray-700 hover:bg-gray-50">2</a>
                <a href="#" class="px-3 py-2 bg-white text-sm font-medium text-gray-700 hover:bg-gray-50">3</a>
                <a href="#" class="px-3 py-2 bg-white text-sm font-medium text-gray-700 hover:bg-gray-50">Next</a>
            </nav>
        </div>
    </div>


    <!-- Modal Resiko Main-->
    <div class="modal fixed w-full h-full top-0 left-0 flex items-center justify-center hidden" id="resikoModal">
        <div class="modal-overlay absolute w-full h-full bg-blue-900 opacity-50"></div>
        <div class="modal-container bg-gray-100 w-full md:max-w-4xl mx-auto h-screen md:h-4/5 rounded-lg shadow-lg z-50 overflow-y-auto ">
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
                    <button id="refreshBtn" class="bg-gray-500 text-white px-4 py-2 rounded-md">Refresh</button>
                    <button id="addRowBtn" class="bg-blue-500 text-white px-4 py-2 rounded-md">Buat Baru</button>
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
                    <button id="cancelBtn" class="bg-red-500 text-white px-4 py-2 rounded-md">Batal</button>
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
                    <button class="bg-red-500 text-white px-4 py-2 rounded-full" id="cancelAddResiko">Batal</button>
                    <button class="bg-green-500 text-white px-4 py-2 rounded-full" id="saveResikoBtn">Simpan</button>
                </div>
            </div>
        </div>
    </div>

    

    <!-- Modal Penyebab -->
    <div class="modal fixed w-full h-full top-0 left-0 flex items-center justify-center hidden"  id="penyebabModal">
        <div class="modal-overlay absolute w-full h-full bg-blue-900 opacity-50"></div>
        <div class="modal-container bg-gray-100 w-11/12 md:max-w-md mx-auto rounded-lg shadow-lg z-50 overflow-y-auto">
            <div class="modal-content py-4 text-left px-6">
                <!-- Title -->
                <div class="flex justify-between items-center pb-2">
                    <p class="text-xl font-bold">Pilih Penyebab</p>
                    <div class="modal-close cursor-pointer z-50" id="closeModal">
                        <svg class="fill-current text-black" xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 18 18">
                            <path d="M14.53 3.47a.75.75 0 00-1.06 0L9 7.94 4.53 3.47a.75.75 0 00-1.06 1.06L7.94 9l-4.47 4.47a.75.75 0 001.06 1.06L9 10.06l4.47 4.47a.75.75 0 001.06-1.06L10.06 9l4.47-4.47a.75.75 0 000-1.06z"></path>
                        </svg>
                    </div>
                </div>
                <!-- Body -->
                <div class="flex justify-between items-center mb-4">
                    <button id="addCauseBtn" class="bg-blue-500 text-white px-4 py-2 rounded-full">Tambah Penyebab</button>
                    <div class="relative text-gray-600">
                        <input type="search" id="searchInput" name="search" placeholder="Cari" class="bg-white h-8 px-3 pr-8 rounded-full text-sm focus:outline-none">
                        <button type="submit" class="absolute right-0 top-0 mt-2 mr-3">
                        <svg class="text-gray-600 h-3 w-3 fill-current" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 56.966 56.966" style="enable-background:new 0 0 56.966 56.966;">
                            <path d="M55.146,51.887L41.588,38.329c3.486-4.146,5.594-9.43,5.594-15.17C47.182,10.366,36.815,0,24.09,0 C11.366,0,1,10.366,1,23.159c0,12.794,10.366,23.159,23.159,23.159c5.74,0,11.023-2.108,15.17-5.594l13.558,13.558 c0.391,0.391,0.902,0.586,1.414,0.586s1.023-0.195,1.414-0.586C55.928,53.933,55.928,52.669,55.146,51.887z M24.159,40.318 c-9.449,0-17.159-7.71-17.159-17.159S14.71,6,24.159,6s17.159,7.71,17.159,17.159S33.608,40.318,24.159,40.318z" />
                        </svg>
                        </button>
                    </div>
                </div>
                <div class="mt-3">
                    <table id="penyebab-table" class="min-w-full bg-white text-sm">
                        <thead>
                            <tr>
                                <th class="px-3 py-2">CEK</th>
                                <th class="px-3 py-2">PENYEBAB</th>
                                <th class="px-3 py-2">STATUS</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($penyebab as $penyebab)
                            <tr class="bg-gray-100">
                                <td class="border px-3 py-1">
                                    <input type="checkbox" class="penyebab-checkbox" data-penyebab="{{ $penyebab->penyebab }}" title="Pilih Penyebab">
                                </td>
                                <td class="border px-3 py-1">{{ $penyebab->penyebab }}</td>
                                <td class="border px-3 py-1">{{ $penyebab->status }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <!-- Modal "Tambah Penyebab" -->
                <div id="causeModal" class="fixed z-10 inset-0 overflow-y-auto hidden">
                    <div class="flex items-center justify-center min-h-screen px-4">
                        <form action="{{ route('admin.penyebab.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="bg-white rounded-lg shadow-xl overflow-hidden max-w-sm w-full">
                                <div class="px-4 py-3 border-b border-gray-200">
                                    <h3 class="text-lg leading-6 font-medium text-gray-900">Tambah Penyebab</h3>
                                </div>
                                <div class="px-4 py-5">
                                    <label for="penyebab" class="block text-sm font-medium text-gray-700">Nama Penyebab</label>
                                    <input type="text" id="penyebab" name="penyebab" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm" required>
                                </div>
                                <div class="px-4 py-3 bg-gray-50 text-right">
                                    <button id="saveBtn" type="submit" class="bg-blue-500 text-white px-4 py-2 rounded-md">Simpan</button>
                                    <button id="cancelCauseBtn" class="bg-red-500 text-white px-4 py-2 rounded-md">Batal</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                
                <!-- Footer -->
                <div class="flex justify-end pt-2">
                </div>
            </div>
        </div>
    </div>


    <!-- Modal "Tambah Dampak" -->
    <div id="addImpactModal" class="fixed z-10 inset-0 overflow-y-auto hidden">
        <div class="flex items-center justify-center min-h-screen px-4">
            <form action="{{ route('admin.dampak.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="bg-white rounded-lg shadow-xl overflow-hidden max-w-sm w-full">
                    <div class="px-4 py-3 border-b border-gray-200">
                        <h3 class="text-lg leading-6 font-medium text-gray-900">Tambah Dampak</h3>
                    </div>
                    <div class="px-4 py-5">
                        <label for="dampak" class="block text-sm font-medium text-gray-700">Nama Dampak</label>
                        <input type="text" id="dampak" name="dampak" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm" required>
                    </div>
                    <div class="px-4 py-3 bg-gray-50 text-right">
                        <button id="saveBtndampak" type="submit" class="bg-blue-500 text-white px-4 py-2 rounded-md">Simpan</button>
                        <button id="cancelImpactBtn" class="bg-red-500 text-white px-4 py-2 rounded-md">Batal</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <!-- Modal Dampak -->
    <div class="modal fixed w-full h-full top-0 left-0 flex items-center justify-center hidden" id="dampakModal">
        <div class="modal-overlay absolute w-full h-full bg-blue-900 opacity-50"></div>
        <div class="modal-container bg-gray-100 w-11/12 md:max-w-md mx-auto rounded-lg shadow-lg z-50 overflow-y-auto">
            <div class="modal-content py-4 text-left px-6">
                <!-- Title -->
                <div class="flex justify-between items-center pb-3">
                    <p class="text-2xl font-bold text-black">Pilih Dampak</p>
                    <div class="modal-close cursor-pointer z-50" id="closeModal2">
                        <svg class="fill-current text-black" xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 18 18">
                            <path d="M14.53 3.47a.75.75 0 00-1.06 0L9 7.94 4.53 3.47a.75.75 0 00-1.06 1.06L7.94 9l-4.47 4.47a.75.75 0 001.06 1.06L9 10.06l4.47 4.47a.75.75 0 001.06-1.06L10.06 9l4.47-4.47a.75.75 0 000-1.06z"></path>
                        </svg>
                    </div>
                </div>
                <!-- Body -->
                <div class="flex justify-between items-center mb-4">
                    <button id="openAddImpactModal" class="bg-blue-500 text-white px-4 py-2 rounded-full">Tambah Dampak</button>

                    <div class="relative text-gray-300">
                        <input type="search" name="search" placeholder="Cari" class="bg-white h-10 px-5 pr-10 rounded-full text-sm focus:outline-none">
                        <button type="submit" class="absolute right-0 top-0 mt-3 mr-4">
                            <svg class="text-gray-500 h-4 w-4 fill-current" xmlns="http://www.w3.org/2000/svg" version="1.1" id="Capa_1" x="0px" y="0px"
                                viewBox="0 0 56.966 56.966"
                                style="enable-background:new 0 0 56.966 56.966;" xml:space="preserve"
                                width="512px" height="512px">
                                <path d="M55.146,51.887L41.588,38.329c3.486-4.146,5.594-9.43,5.594-15.17C47.182,10.366,36.815,0,24.09,0
                                C11.366,0,1,10.366,1,23.159c0,12.794,10.366,23.159,23.159,23.159c5.74,0,11.023-2.108,15.17-5.594l13.558,13.558
                                c0.391,0.391,0.902,0.586,1.414,0.586s1.023-0.195,1.414-0.586C55.928,53.933,55.928,52.669,55.146,51.887z M24.159,40.318
                                c-9.449,0-17.159-7.71-17.159-17.159S14.71,6,24.159,6s17.159,7.71,17.159,17.159S33.608,40.318,24.159,40.318z" />
                            </svg>
                        </button>
                    </div>
                </div>

                <div class="mt-4">
                    <table class="min-w-full bg-white">
                        <thead>
                            <tr>
                                <th class="px-4 py-2">CEK</th>
                                <th class="px-4 py-2">DAMPAK</th>
                                <th class="px-4 py-2">STATUS</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($dampak as $dampak)
                            <tr class="bg-gray-100">
                                <td class="border px-3 py-1">
                                    <input type="checkbox" class="dampak-checkbox" data-dampak="{{ $dampak->dampak }}" title="Pilih Dampak">
                                </td>
                                <td class="border px-3 py-1">{{ $dampak->dampak }}</td>
                                <td class="border px-3 py-1">{{ $dampak->status }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <script>

    document.addEventListener('DOMContentLoaded', function () {
        const tambahResikoBtn = document.getElementById('tambahresiko');
        const resikoModal = document.getElementById('resikoModal');
        const closeModalBtn = document.getElementById('closeModal');
        const simpanResikoBtn = document.getElementById('simpanResiko');
        const addResikoBtn = document.getElementById('addResikoBtn');
        const tambahResikoModal = document.getElementById('TambahresikoModal');
        const cancelResikoBtn = document.getElementById('cancelResikoBtn');

        /**
         * Risk Modal Script
        */

        var table = $('#resiko-table').DataTable({
            processing : true,
            serverSide: true,
            ajax: "{{ route('admin.getresikodata') }}", // Adjust with your route for fetching data
            columns: [
                {
                    data: "id",
                    render: function(data, type, row) {
                        // return '<input type="checkbox" class="row-checkbox" value="' + data + '">';
                        var isDisabled = (row.status === 'rejected' || row.status === 'onprogress') ? 'disabled' : '';
                        return '<input type="checkbox" class="row-checkbox" value="' + data + '" ' + isDisabled + '>';
                    }
                },
                { data: "resiko" },
                { data: "status" }
            ],
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
                        // $('#resiko-table tbody').append('<tr><td><input type="checkbox"></td><td>' + response.resiko + '</td><td>' + response.status + '</td></tr>');
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
                    data : selected, 
                    formValues: formValues,
                    _token: $('meta[name="csrf-token"]').attr('content')},
                
                success: function(response) {
                    if (response.errors) {
                        // Handle validation errors
                        console.log(response.errors);
                        // Display errors in the modal or elsewhere
                    } else if (response.success) {
                        // Handle successful submission
                        console.log(response.success);
                        // Close the modal and/or update the UI as needed
                        resikoModal.classList.add('hidden');
                        table.ajax.reload(null, false);
                    }
                },
                error: function(xhr) {
                    console.error('Error:', xhr.responseText);
                }
            });
        });




















        
        // Tampilkan modal "Pilih Resiko"
        tambahResikoBtn.addEventListener('click', function () {
            resikoModal.classList.remove('hidden');
        });

        // Tutup modal "Pilih Resiko"
        closeModalBtn.addEventListener('click', function () {
            resikoModal.classList.add('hidden');
        });

        // Simpan resiko
        simpanResikoBtn.addEventListener('click', function () {
            const timProject = document.getElementById('tim_project').value;
            const prosesBisnis = document.getElementById('proses_bisnis').value;
            const resikoCheckboxes = document.querySelectorAll('.resiko-checkbox:checked');
            const resikoIds = Array.from(resikoCheckboxes).map(checkbox => checkbox.value);

            const riskData = {
                timProject: timProject,
                prosesBisnis: prosesBisnis,
                resikoIds: resikoIds
            };

            fetch('/manajemenresiko/store', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                },
                body: JSON.stringify(riskData)
            })
            .then(response => response.json())
            .then(data => {
                alert(data.message);
                // Optionally, refresh the table or add the new row dynamically
                resikoModal.classList.add('hidden');
            })
            .catch(error => {
                console.error('Error:', error);
            });
        });

        // Tampilkan modal "Tambah Resiko"
        addResikoBtn.addEventListener('click', function() {
            tambahResikoModal.classList.remove('hidden');
        });

        // Sembunyikan modal "Tambah Resiko"
        cancelResikoBtn.addEventListener('click', function() {
            tambahResikoModal.classList.add('hidden');
        });
    });




            // Tampilkan modal "Pilih Penyebab"
        document.getElementById('openModal').addEventListener('click', function() {
            document.getElementById('penyebabModal').classList.remove('hidden');
        });

        // Tutup modal "Pilih Penyebab"
        document.getElementById('closeModal').addEventListener('click', function() {
            document.getElementById('penyebabModal').classList.add('hidden');
        });

        // Tampilkan modal "Tambah Penyebab"
        document.getElementById('addCauseBtn').addEventListener('click', function() {
            document.getElementById('causeModal').classList.remove('hidden');
        });

        // Tutup modal "Tambah Penyebab"
        document.getElementById('cancelCauseBtn').addEventListener('click', function() {
            document.getElementById('causeModal').classList.add('hidden');
        });
        // perintah cekbox penyebab
        document.addEventListener('DOMContentLoaded', function () {
            const checkboxes = document.querySelectorAll('.penyebab-checkbox');
            const selectedPenyebabContainer = document.getElementById('selectedPenyebab');
            let selectedPenyebab = [];

            checkboxes.forEach(checkbox => {
                checkbox.addEventListener('change', function () {
                    const penyebab = this.getAttribute('data-penyebab');
                    if (this.checked) {
                        selectedPenyebab.push(penyebab);
                    } else {
                        selectedPenyebab = selectedPenyebab.filter(item => item !== penyebab);
                    }
                    updateSelectedPenyebab();
                });
            });

            function updateSelectedPenyebab() {
                selectedPenyebabContainer.innerHTML = '';
                if (selectedPenyebab.length > 0) {
                    const ul = document.createElement('ul');
                    selectedPenyebab.forEach((penyebab, index) => {
                        const li = document.createElement('li');
                        li.textContent = penyebab;
                        const destroyButton = document.createElement('button');
                        destroyButton.textContent = 'Destroy';
                        destroyButton.classList.add('bg-red-500', 'text-white', 'px-1', 'py-0.5', 'rounded', 'ml-2');
                        destroyButton.addEventListener('click', function () {
                            selectedPenyebab = selectedPenyebab.filter(item => item !== penyebab);
                            updateSelectedPenyebab();
                        });
                        li.appendChild(destroyButton);
                        ul.appendChild(li);
                    });
                    selectedPenyebabContainer.appendChild(ul);
                }
            }
        });


    // Tampilkan modal "Pilih Dampak"
    document.getElementById('openModal2').addEventListener('click', function() {
        document.getElementById('dampakModal').classList.remove('hidden');
    });

    // Tutup modal "Pilih Dampak"
    document.getElementById('closeModal2').addEventListener('click', function() {
        document.getElementById('dampakModal').classList.add('hidden');
    });

    // Tampilkan modal "Tambah Dampak"
    document.getElementById('openAddImpactModal').addEventListener('click', function() {
        document.getElementById('addImpactModal').classList.remove('hidden');
    });

    // Tutup modal "Tambah Dampak"
    document.getElementById('cancelImpactBtn').addEventListener('click', function() {
        document.getElementById('addImpactModal').classList.add('hidden');
    });
    // perintah cekbox Dampak
    document.addEventListener('DOMContentLoaded', function () {
        const dampakCheckboxes = document.querySelectorAll('.dampak-checkbox');
        const selectedDampakContainer = document.getElementById('selectedDampak');
        let selectedDampak = [];

        dampakCheckboxes.forEach(checkbox => {
            checkbox.addEventListener('change', function () {
                const dampak = this.getAttribute('data-dampak');
                if (this.checked) {
                    selectedDampak.push(dampak);
                } else {
                    selectedDampak = selectedDampak.filter(item => item !== dampak);
                }
                updateSelectedDampak();
            });
        });

        function updateSelectedDampak() {
            selectedDampakContainer.innerHTML = '';
            if (selectedDampak.length > 0) {
                const ul = document.createElement('ul');
                selectedDampak.forEach((dampak, index) => {
                    const li = document.createElement('li');
                    li.textContent = dampak;
                    const destroyButton = document.createElement('button');
                    destroyButton.textContent = 'Destroy';
                    destroyButton.classList.add('bg-red-500', 'text-white', 'px-2', 'py-1', 'rounded', 'ml-2');
                    destroyButton.addEventListener('click', function () {
                        selectedDampak = selectedDampak.filter(item => item !== dampak);
                        updateSelectedDampak();
                    });
                    li.appendChild(destroyButton);
                    ul.appendChild(li);
                });
                selectedDampakContainer.appendChild(ul);
            }
        }
    });

    //SAVE RESIKO
    document.addEventListener('DOMContentLoaded', function () {
        const saveRiskBtn = document.getElementById('saveRiskBtn');

        saveRiskBtn.addEventListener('click', function () {
            // Ambil data dari form
            const timProject = document.querySelector('select[name="tim_project"]').value;
            const prosesBisnis = document.querySelector('select[name="proses_bisnis"]').value;
            const resiko = document.querySelector('select[name="resiko"]').value;
            const jenisRisiko = document.querySelector('select[name="jenis_resiko[]"]').value;
            const sumberRisiko = document.querySelector('select[name="sumber_resiko[]"]').value;
            const kategoriRisiko = document.querySelector('select[name="kategori_resiko[]"]').value;
            const areaDampak = document.querySelector('select[name="area_dampak[]"]').value;

            const penyebab = Array.from(document.getElementById('selectedPenyebab').querySelectorAll('li')).map(li => li.textContent.replace('Destroy', '').trim());
            const dampak = Array.from(document.getElementById('selectedDampak').querySelectorAll('li')).map(li => li.textContent.replace('Destroy', '').trim());

            const riskData = {
                timProject: timProject,
                prosesBisnis: prosesBisnis,
                resiko: resiko,
                jenisRisiko: jenisRisiko,
                sumberRisiko: sumberRisiko,
                kategoriRisiko: kategoriRisiko,
                areaDampak: areaDampak,
                penyebab: penyebab,
                dampak: dampak
            };

            fetch('{{ route('admin.manajemenrisiko.store') }}', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                body: JSON.stringify(riskData)
            })
            .then(response => response.json())
            .then(data => {
                alert(data.message);
                // Reset form after successful save
                document.getElementById('riskForm').reset();
                document.getElementById('selectedPenyebab').innerHTML = '';
                document.getElementById('selectedDampak').innerHTML = '';
            })
            .catch(error => {
                console.error('Error:', error);
            });
        });
    });

    </script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.3/js/jquery.dataTables.min.js"></script>

    <script>
        $(document).ready(function() {
            $('#resiko-table').DataTable({
                "processing": true,
                "serverSide": true,
                "lengthChange": false, // Menyembunyikan "Show entries"
                "searching": false // Menyembunyikan kotak "Search"
                "pageLength": 10,      // Menampilkan 10 baris per halaman
                "paging": true
                "ajax": {
                    "url": "{{ url('/api/resiko') }}",
                    "type": "GET"
                },
                "columns": [
                    { "data": "id", "render": function(data, type, row) {
                        return '<input type="checkbox" class="resiko-checkbox" value="' + data + '" title="Pilih Resiko">';
                    }},
                    { "data": "resiko" },
                    { "data": "status" }
                ]
            });
        });
    </script>

    <!-- Include DataTables CSS -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.3/css/jquery.dataTables.min.css">

</x-admin-layout>
