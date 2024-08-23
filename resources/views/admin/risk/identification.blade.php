<x-admin-layout>
    <div class="flex justify-center mt-10">
        <div class="bg-white shadow-md rounded-lg p-6 w-full ">
            <h1 class="text-2xl font-bold mb-6">Identifikasi Risiko</h1>
            <form>
                <div class="mb-4">
                    <label class="block text-gray-700 mb-2" for="tim-bidang">Tim/Bidang</label>
                    <select id="proses-bisnis" class="w-full p-2 border rounded-lg">
                        @foreach ($timProjects as $tim)
                            <option value="{{ $tim->nama_team }}">{{ $tim->nama_team }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="mb-4">
                    <label class="block text-gray-700 mb-2" for="proses-bisnis">Proses Bisnis</label>
                    <select id="proses-bisnis" class="w-full p-2 border rounded-lg">
                        <option value="">Pilih Proses Bisnis</option>
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
                <button class="bg-green-500 text-white px-4 py-2 rounded-full border border-green-500">Simpan Perubahan</button>
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
                    <tr>
                        <td class="px-6 py-4 whitespace-nowrap"></td>
                        <td class="px-6 py-4 whitespace-nowrap">4</td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            @foreach ($timProjects as $tim)
                                @if ($tim->nama_team == $selectedTeam)
                                    {{ $tim->nama_team }}
                                @endif
                            @endforeach
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">Inda tidak fokus saat pelatihan</td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <select class="form-select pr-8 py-2 border">
                                @foreach ($jenisResiko as $jenis)
                                    <option> {{ $jenis->jenis_resiko }}</option>
                                @endforeach
                            </select>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <select class="form-select pr-8 py-2 border">
                                @foreach ($sumberResiko as $sumber)
                                    <option>{{ $sumber->sumber_resiko }}</option>
                                @endforeach
                            </select>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <select class="form-select pr-8 py-2 border">
                                @foreach ($kategoriResiko as $kategori)
                                    <option>{{ $kategori->deskripsi }}</option>
                                @endforeach
                            </select>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <select class="form-select pr-8 py-2 border">
                                @foreach ($areaDampak as $area)
                                    <option>{{ $area->area_dampak }}</option>
                                @endforeach
                            </select>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <button class="bg-blue-500 text-white px-4 py-2 rounded" id="openModal">Pilih Penyebab</button>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <button class="bg-blue-500 text-white px-4 py-2 rounded" id="openModal2">Pilih Dampak</button>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <button class="bg-red-500 text-white px-2 py-1 rounded">Delete</button>
                            <button class="bg-blue-500 text-white px-2 py-1 rounded">Edit</button>
                            <button class="bg-green-500 text-white px-2 py-1 rounded">Save</button>
                        </td>
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


    <!-- Modal Resiko -->
    <div class="modal fixed w-full h-full top-0 left-0 flex items-center justify-center hidden" id="resikoModal">
        <div class="modal-overlay absolute w-full h-full bg-blue-900 opacity-50"></div>
        <div class="modal-container bg-gray-100 w-11/12 md:max-w-md mx-auto rounded-lg shadow-lg z-50 overflow-y-auto">
            <div class="modal-content py-4 text-left px-6">
                <!-- Title -->
                <div class="flex justify-between items-center pb-2">
                    <p class="text-xl font-bold">Pilih Resiko</p>
                    <div class="modal-close cursor-pointer z-50" id="closeModal" title="Tutup Modal">
                        <svg class="fill-current text-black" xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 18 18">
                            <path d="M14.53 3.47a.75.75 0 00-1.06 0L9 7.94 4.53 3.47a.75.75 0 00-1.06 1.06L7.94 9l-4.47 4.47a.75.75 0 001.06 1.06L9 10.06l4.47 4.47a.75.75 0 001.06-1.06L10.06 9l4.47-4.47a.75.75 0 000-1.06z"></path>
                        </svg>
                    </div>
                </div>
                <!-- Body -->
                <div class="flex justify-between items-center mb-4">
                    <button id="addRiskBtn" class="bg-blue-500 text-white px-4 py-2 rounded-full">Tambah Resiko</button>
                    <div class="relative text-gray-600">
                        <input type="search" id="searchInput" name="search" placeholder="Cari" class="bg-white h-8 px-3 pr-8 rounded-full text-sm focus:outline-none" title="Cari Resiko">
                        <button type="submit" class="absolute right-0 top-0 mt-2 mr-3" title="Cari">
                            <svg class="text-gray-600 h-3 w-3 fill-current" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 56.966 56.966" style="enable-background:new 0 0 56.966 56.966;">
                                <path d="M55.146,51.887L41.588,38.329c3.486-4.146,5.594-9.43,5.594-15.17C47.182,10.366,36.815,0,24.09,0 C11.366,0,1,10.366,1,23.159c0,12.794,10.366,23.159,23.159,23.159c5.74,0,11.023-2.108,15.17-5.594l13.558,13.558 c0.391,0.391,0.902,0.586,1.414,0.586s1.023-0.195,1.414-0.586C55.928,53.933,55.928,52.669,55.146,51.887z M24.159,40.318 c-9.449,0-17.159-7.71-17.159-17.159S14.71,6,24.159,6s17.159,7.71,17.159,17.159S33.608,40.318,24.159,40.318z" />
                            </svg>
                        </button>
                    </div>
                </div>
                <div class="mt-3">
                    <table id="resiko-table" class="min-w-full bg-white text-sm">
                        <thead>
                            <tr>
                                <th class="px-3 py-2">CEK</th>
                                <th class="px-3 py-2">RESIKO</th>
                                <th class="px-3 py-2">STATUS</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($resiko as $resiko)
                            <tr class="bg-gray-100">
                                <td class="border px-3 py-1">
                                    <input type="checkbox" title="Pilih Resiko">
                                </td>
                                <td class="border px-3 py-1">{{ $resiko->resiko }}</td>
                                <td class="border px-3 py-1">{{ $resiko->status }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <!-- Modal "Tambah Resiko" -->
                <div id="resikoModal" class="fixed z-10 inset-0 overflow-y-auto hidden">
                    <div class="flex items-center justify-center min-h-screen px-4">
                        <form action="{{ route('admin.resiko.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="bg-white rounded-lg shadow-xl overflow-hidden max-w-sm w-full">
                                <div class="px-4 py-3 border-b border-gray-200">
                                    <h3 class="text-lg leading-6 font-medium text-gray-900">Tambah Resiko</h3>
                                </div>
                                <div class="px-4 py-5">
                                    <label for="resiko" class="block text-sm font-medium text-gray-700">Nama Resiko</label>
                                    <input type="text" id="resiko" name="resiko" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm" required>
                                </div>
                                <div class="px-4 py-3 bg-gray-50 text-right">
                                    <button id="saveBtn" type="submit" class="bg-blue-500 text-white px-4 py-2 rounded-md" title="Simpan Resiko">Simpan</button>
                                    <button id="cancelResikoBtn" type="button" class="bg-red-500 text-white px-4 py-2 rounded-md" title="Batal">Batal</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                <script>
                    document.getElementById('saveBtn').addEventListener('click', function() {
                        var resiko = document.getElementById('resiko').value;
                        if (resiko === '') {
                            alert('Nama Resiko belum terisi. Tidak bisa disimpan.');
                            return false;
                        }
                    });
                </script>
                <!-- Footer -->
                <div class="flex justify-end pt-2">
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
                    <table id="causes-table" class="min-w-full bg-white text-sm">
                        <thead>
                            <tr>
                                <th class="px-3 py-2">CEK</th>
                                <th class="px-3 py-2">PENYEBAB</th>
                                <th class="px-3 py-2">STATUS</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ( $penyebab as $penyebab )
                            <tr class="bg-gray-100">
                                <td class="border px-3 py-1">
                                    <input type="checkbox">
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
                <script>
                    document.getElementById('saveBtn').addEventListener('click', function() {
                        var penyebab = document.getElementById('penyebab').value;
                        if (penyebab === '') {
                            alert('Nama Penyebab belum terisi. Tidak bisa disimpan.');
                            return false;
                        }
                    });
                </script>
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
    <script>
        document.getElementById('saveBtndampak').addEventListener('click', function() {
            var dampak = document.getElementById('dampak').value;
            if (dampak === '') {
                alert('Nama Dampak belum terisi. Tidak bisa disimpan.');
                return false;
            }
        });
    </script>

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
                                    <input type="checkbox">
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

    // Tampilkan modal "Pilih Resiko"
    document.getElementById('tambahresiko').addEventListener('click', function() {
        document.getElementById('resikoModal').classList.remove('hidden');
    });

    // Tutup modal "Pilih Resiko"
    document.getElementById('closeModal').addEventListener('click', function() {
        document.getElementById('resikoModal').classList.add('hidden');
    });

    document.addEventListener('DOMContentLoaded', function() {
        // Tampilkan modal "Tambah Resiko"
        document.getElementById('addRiskBtn').addEventListener('click', function() {
            document.getElementById('resikoModal').classList.remove('hidden');
        });

        // Sembunyikan modal "Tambah Resiko"
        document.getElementById('cancelResikoBtn').addEventListener('click', function() {
            document.getElementById('resikoModal').classList.add('hidden');
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

    // // Simpan penyebab
    // document.addEventListener('DOMContentLoaded', function() {
    //     var saveCauseBtn = document.getElementById('saveCauseBtn');
    //     if (saveCauseBtn) {
    //         saveCauseBtn.addEventListener('click', function() {
    //             // Ambil data yang akan disimpan
    //             var penyebab = document.getElementById('causeName').value;
    //             var status = document.getElementById('causeStatus').value;

    //             // Kirim permintaan AJAX
    //             fetch('{{ route('admin.penyebab.store') }}', {
    //                 method: 'POST',
    //                 headers: {
    //                     'Content-Type': 'application/json',
    //                     'X-CSRF-TOKEN': '{{ csrf_token() }}'
    //                 },
    //                 body: JSON.stringify({ penyebab: penyebab, status: status })
    //             })
    //             .then(response => response.json())
    //             .then(data => {
    //                 alert(data.message);
    //                 // Sembunyikan modal setelah berhasil disimpan
    //                 var causeModal = document.getElementById('causeModal');
    //                 if (causeModal) {
    //                     causeModal.classList.add('hidden');
    //                 }
    //                 // Kosongkan input
    //                 document.getElementById('causeName').value = '';
    //                 document.getElementById('causeStatus').value = '';
    //             })
    //             .catch(error => {
    //                 console.error('Error:', error);
    //             });
    //         });
    //     }

    //     var cancelCauseBtn = document.getElementById('cancelCauseBtn');
    //     if (cancelCauseBtn) {
    //         cancelCauseBtn.addEventListener('click', function() {
    //             // Sembunyikan modal saat tombol Batal diklik
    //             var causeModal = document.getElementById('causeModal');
    //             if (causeModal) {
    //                 causeModal.classList.add('hidden');
    //             }
    //         });
    //     }
    // });

    </script>

</x-admin-layout>
