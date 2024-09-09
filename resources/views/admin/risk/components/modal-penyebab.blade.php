<!-- Modal Penyebab -->
<div class="modal fixed w-full h-full top-0 left-0 flex items-center justify-center hidden" id="penyebabModal">
    <div class="modal-overlay absolute w-full h-full bg-blue-900 opacity-50"></div>
    <div class="modal-container bg-gray-100 w-11/12 md:max-w-md mx-auto rounded-lg shadow-lg z-50 overflow-y-auto">
        <div class="modal-content py-4 text-left px-6">
            <!-- Title -->
            <div class="flex justify-between items-center pb-2">
                <p class="text-xl font-bold">Pilih Penyebab</p>
                <div class="modal-close cursor-pointer z-50" id="closeModal3">
                    <svg class="fill-current text-black" xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 18 18">
                        <path d="M14.53 3.47a.75.75 0 00-1.06 0L9 7.94 4.53 3.47a.75.75 0 00-1.06 1.06L7.94 9l-4.47 4.47a.75.75 0 001.06 1.06L9 10.06l4.47 4.47a.75.75 0 001.06-1.06L10.06 9l4.47-4.47a.75.75 0 000-1.06z"></path>
                    </svg>
                </div>
            </div>
            <!-- Body -->
            <div class="flex justify-between items-center mb-4">
                <button id="openAddCauseModal" class="bg-blue-500 text-white px-4 py-2 rounded-full">Tambah Penyebab</button>
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
                        <!-- Data will be fetched using DataTables -->
                    </tbody>
                </table>
            </div>
            <!-- Modal "Tambah Penyebab" -->
            <div id="addCauseModal" class="fixed z-10 inset-0 overflow-y-auto hidden">
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
                                <button id="cancelCauseBtn" type="button" class="bg-red-500 text-white px-4 py-2 rounded-md">Batal</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>

            <!-- Footer -->
            <div class="flex justify-end pt-2">
                <button id="savePenyebabBtn" class="bg-blue-500 text-white px-4 py-2 rounded-md">Simpan</button>
            </div>
        </div>
    </div>
</div>

