<x-admin-layout>
    <div class="flex justify-center mt-10">
        <div class="bg-white shadow-md rounded-lg p-6 w-full max-w-screen-lg">
            <h1 class="text-2xl font-bold mb-6">Identifikasi Risiko</h1>
            <form>
                <div class="mb-4">
                    <label class="block text-gray-700 mb-2" for="satuan-kerja">Satuan Kerja</label>
                    <select id="satuan-kerja" class="w-full p-2 border rounded-lg">
                        <option value="">Pilih Satuan Kerja</option>
                    </select>
                </div>
                <div class="mb-4">
                    <label class="block text-gray-700 mb-2" for="tim-bidang">Tim/Bidang</label>
                    <input type="text" id="tim-bidang" class="w-full p-2 border rounded" placeholder="Masukkan Tim/Bidang">
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
                <button class="bg-red-500 text-white px-4 py-2 rounded-full border border-red-500">Tambah Risiko</button>
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
                    @for ($i = 0; $i < 5; $i++)
                        <tr>
                            <td class="px-6 py-4 whitespace-nowrap">{{ $i + 1 }}</td>
                            <td class="px-6 py-4 whitespace-nowrap">4</td>
                            <td class="px-6 py-4 whitespace-nowrap">18</td>
                            <td class="px-6 py-4 whitespace-nowrap">Inda tidak fokus saat pelatihan</td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <select class="form-select pr-8 py-2 border">
                                    <option>Negatif</option>
                                    <option>Positif</option>
                                </select>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <select class="form-select pr-8 py-2 border">
                                    <option>Internal</option>
                                    <option>External</option>
                                </select>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <select class="form-select pr-8 py-2 border">
                                    <option>Risiko Kepatuhan</option>
                                    <option>Risiko Operasional</option>
                                </select>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">Area Dampak</td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <button class="bg-blue-500 text-white px-4 py-2 rounded" id="openModal">Pilih Penyebab</button>
                            </td>
                            <!-- Modal -->
                            <div class="modal opacity-0 pointer-events-none fixed w-full h-full top-0 left-0 flex items-center justify-center" id="penyebabModal">
                                <div class="modal-overlay absolute w-full h-full bg-gray-900 opacity-50"></div>

                                <div class="modal-container bg-white w-11/12 md:max-w-md mx-auto rounded shadow-lg z-50 overflow-y-auto">

                                    <div class="modal-content py-4 text-left px-6">
                                        <!-- Title -->
                                        <div class="flex justify-between items-center pb-3">
                                            <p class="text-2xl font-bold">Pilih Penyebab</p>
                                            <div class="modal-close cursor-pointer z-50" id="closeModal">
                                                <svg class="fill-current text-black" xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 18 18">
                                                    <path d="M14.53 3.47a.75.75 0 00-1.06 0L9 7.94 4.53 3.47a.75.75 0 00-1.06 1.06L7.94 9l-4.47 4.47a.75.75 0 001.06 1.06L9 10.06l4.47 4.47a.75.75 0 001.06-1.06L10.06 9l4.47-4.47a.75.75 0 000-1.06z"></path>
                                                </svg>
                                            </div>
                                        </div>

                                        <!-- Body -->
                                        <div>
                                            <button class="bg-blue-500 text-white px-4 py-2 rounded-full border border-blue-500">Tambah Penyebab</button>
                                        </div>
                                        <div class="mt-4">
                                            <label class="block text-gray-700 mb-2" for="penyebab">Data Penyebab</label>
                                            <div class="flex items-center mb-2">
                                                <input type="checkbox" id="penyebab1" class="mr-2">
                                                <label for="penyebab1">Penyebab 1</label>
                                            </div>
                                            <div class="flex items-center mb-2">
                                                <input type="checkbox" id="penyebab2" class="mr-2">
                                                <label for="penyebab2">Penyebab 2</label>
                                            </div>
                                            <div class="flex items-center mb-2">
                                                <input type="checkbox" id="penyebab3" class="mr-2">
                                                <label for="penyebab3">Penyebab 3</label>
                                            </div>
                                            <!-- Add more data penyebab here -->
                                        </div>

                                        <!-- Footer -->
                                        <div class="flex justify-end pt-2">
                                            <button class="focus:outline-none modal-close px-4 bg-gray-400 p-3 rounded-lg text-black hover:bg-gray-300" id="closeModal2">Tutup</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <button class="bg-blue-500 text-white px-4 py-2 rounded" id="openModal2">Pilih Dampak</button>
                            </td>
                            <!-- Modal -->
                            <div class="modal opacity-0 pointer-events-none fixed w-full h-full top-0 left-0 flex items-center justify-center" id="dampakModal">
                                <div class="modal-overlay absolute w-full h-full bg-gray-900 opacity-50"></div>

                                <div class="modal-container bg-white w-11/12 md:max-w-md mx-auto rounded shadow-lg z-50 overflow-y-auto">

                                    <div class="modal-content py-4 text-left px-6">
                                        <!-- Title -->
                                        <div class="flex justify-between items-center pb-3">
                                            <p class="text-2xl font-bold">Pilih Dampak</p>
                                            <div class="modal-close cursor-pointer z-50" id="closeModal2">
                                                <svg class="fill-current text-black" xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 18 18">
                                                    <path d="M14.53 3.47a.75.75 0 00-1.06 0L9 7.94 4.53 3.47a.75.75 0 00-1.06 1.06L7.94 9l-4.47 4.47a.75.75 0 001.06 1.06L9 10.06l4.47 4.47a.75.75 0 001.06-1.06L10.06 9l4.47-4.47a.75.75 0 000-1.06z"></path>
                                                </svg>
                                            </div>
                                        </div>

                                        <!-- Body -->
                                        <div>
                                            <button class="bg-blue-500 text-white px-4 py-2 rounded-full border border-blue-500">Tambah Dampak</button>
                                        </div>
                                        <div class="mt-4">
                                            <label class="block text-gray-700 mb-2" for="penyebab">Data Dampak</label>
                                            <div class="flex items-center mb-2">
                                                <input type="checkbox" id="penyebab1" class="mr-2">
                                                <label for="penyebab1">Dampak 1</label>
                                            </div>
                                            <div class="flex items-center mb-2">
                                                <input type="checkbox" id="penyebab2" class="mr-2">
                                                <label for="penyebab2">Dampak 2</label>
                                            </div>
                                            <div class="flex items-center mb-2">
                                                <input type="checkbox" id="penyebab3" class="mr-2">
                                                <label for="penyebab3">Dampak 3</label>
                                            </div>
                                            <!-- Add more data penyebab here -->
                                        </div>

                                        <!-- Footer -->
                                        <div class="flex justify-end pt-2">
                                            <button class="focus:outline-none modal-close px-4 bg-gray-400 p-3 rounded-lg text-black hover:bg-gray-300" id="closeModal2">Tutup</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <button class="bg-red-500 text-white px-2 py-1 rounded">Delete</button>
                                <button class="bg-blue-500 text-white px-2 py-1 rounded">Edit</button>
                                <button class="bg-green-500 text-white px-2 py-1 rounded">Save</button>
                            </td>
                        </tr>
                    @endfor
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

    <!-- JavaScript to handle refresh button and search functionality -->
    <script>
        document.getElementById('refreshBtn').addEventListener('click', function() {
            location.reload();
        });

        document.getElementById('searchInput').addEventListener('input', function() {
            const searchValue = this.value.toLowerCase();
            const rows = document.querySelectorAll('#riskTable tbody tr');

            rows.forEach(row => {
                const cells = row.querySelectorAll('td');
                let isVisible = false;

                cells.forEach(cell => {
                    if (cell.textContent.toLowerCase().includes(searchValue)) {
                        isVisible = true;
                    }
                });

                row.style.display = isVisible ? '' : 'none';
            });
        });
    </script>
</x-admin-layout>
