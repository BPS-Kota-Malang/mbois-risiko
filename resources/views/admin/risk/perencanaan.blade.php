<x-admin-layout>
    <div class="flex justify-center mt-10">
        <div class="bg-white shadow-md rounded-lg p-6 w-full">
            <h1 class="text-2xl font-bold mb-6">Perencanaan</h1>
            <!-- Filter Form -->
            <form id="analisisResikoForm" action="{{ route('admin.perencanaan.index') }}" method="GET">
                <div class="mb-4">
                    <label class="block text-gray-700 mb-2" for="tim">Tim/Bidang</label>
                    <select id="tim" name="tim" class="w-full p-2 border rounded-lg">
                        <option value="">-- Pilih Tim/Bidang --</option>
                        @foreach ($timProjects as $tim)
                            <option value="{{ $tim->id }}" {{ request('tim') == $tim->id ? 'selected' : '' }}>
                                {{ $tim->name }}
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
                                {{ $proses->name }}
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
                            <th class="px-6 py-3 text-middle text-xs font-medium text-gray-500 uppercase tracking-wider border-r border-gray-200 text-center"
                                style="width: 100px;">No</th>
                            <th class="px-6 py-3 text-middle text-xs font-medium text-gray-500 uppercase tracking-wider border-r border-gray-200 text-center"
                                style="width: 300px;">Prioritas</th>
                            <th class="px-6 py-3 text-middle text-xs font-medium text-gray-500 uppercase tracking-wider border-r border-gray-200 text-center"
                                style="width: 300px;">Pernyataan Resiko</th>
                            <th class="px-6 py-3 text-middle text-xs font-medium text-gray-500 uppercase tracking-wider border-r border-gray-200 text-center"
                                style="width: 300px;">Aktual</th>
                            <th class="px-6 py-4 text-middle text-xs font-medium text-gray-500 uppercase tracking-wider border-r border-gray-200 text-center"
                                style="width: 300px;">Residual</th>
                            <th class="px-6 py-3 text-middle text-xs font-medium text-gray-500 uppercase tracking-wider border-r border-gray-200 text-center"
                                style="width: 300px;">Rencana Tindak Penanganan</th>
                        </tr>
                    </thead>
                    <tbody>
                        
                            <td class="px-6 py-4 text-center border-r border-gray-200">3</td>
                            <td class="px-6 py-4 text-center border-r border-gray-200">Rendah</td>
                            <td class="px-6 py-4 border-r border-gray-200">Resiko keterlambatan proyek karena kendala logistik</td>
                            <td class="px-6 py-4 text-center border-r border-gray-200">20%</td>
                            <td class="px-6 py-4 text-center border-r border-gray-200">15%</td>
                            <td class="px-6 py-4 text-center border-r border-gray-200">
                                <button onclick="openEditModal()" class="inline-block p-2 rounded-md border border-blue-500 text-blue-500 hover:bg-blue-100">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 24 24" fill="currentColor">
                                        <path d="M11.293 2.293a1 1 0 011.414 0l8.586 8.586a1 1 0 010 1.414L11 22H3v-8l8.293-8.293zM13 4L4 13v2h2L20 6l-7-2zm-9 13.5V21h3.5L17 10.5l-3-3L4 17.5z" />
                                    </svg>
                                </button>
                            </td>
                            
                        </tr>
                    </tbody>
                </table>
            </div>

           {{-- Modal --}}
            <div id="editModal" class="fixed inset-0 hidden flex items-center justify-center z-50">
                <!-- Overlay -->
                <div class="fixed inset-0 bg-black opacity-50"></div>
                <!-- Modal Content -->
                <div class="relative bg-white rounded-lg shadow-lg w-3/4 p-6" style="margin-left: 250px;">
                    <div class="flex justify-between items-center bg-gray-100 px-4 py-3 rounded-t-lg">
                        <h2 class="text-lg font-semibold">Rencana Tindak Penanganan</h2>
                        <button class="text-gray-500 hover:text-gray-700" onclick="closeModal()">✕</button>
                    </div>
                    <div class="p-4">
                        <div class="mb-4">
                            <p><strong>Risiko:</strong> Inda tidak fokus saat pelatihan</p>
                            <p><strong>Level Kemungkinan:</strong> [3] Kadang Terjadi</p>
                            <p><strong>Level Dampak:</strong> [3] Cukup Signifikan (Moderat)</p>
                            <p><strong>Besaran Risiko:</strong> 14</p>
                        </div>
                        <div class="mb-4 flex justify-start gap-4">
                            <button class="bg-blue-500 text-white px-4 py-2 rounded-md hover:bg-blue-600" onclick="refreshTable()">
                                Refresh
                            </button>
                            
                            <button class="bg-green-500 text-white px-4 py-2 rounded-md hover:bg-green-600" onclick="openTambahModal()">
                                Tambah
                            </button>
                        </div>
                        <table class="w-full border-collapse border border-gray-300">
                            <thead>
                                <tr class="bg-gray-200 text-left">
                                    <th class="border border-gray-300 px-2 py-1">No</th>
                                    <th class="border border-gray-300 px-2 py-1">Rencana Tindak Penanganan</th>
                                    <th class="border border-gray-300 px-2 py-1">Target Output</th>
                                    <th class="border border-gray-300 px-2 py-1">Target Waktu</th>
                                    <th class="border border-gray-300 px-2 py-1">Penanggung Jawab</th>
                                    <th class="border border-gray-300 px-2 py-1">Level Kemungkinan</th>
                                    <th class="border border-gray-300 px-2 py-1">Level Dampak</th>
                                    <th class="border border-gray-300 px-2 py-1">Besaran Risiko</th>
                                    <th class="border border-gray-300 px-2 py-1 text-center">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr class="odd:bg-white even:bg-gray-100">
                                    <td class="border border-gray-300 px-2 py-1">1</td>
                                    <td class="border border-gray-300 px-2 py-1">Pengawasan/supervisi pelatihan lebih diintensifkan</td>
                                    <td class="border border-gray-300 px-2 py-1">Inda menjadi lebih fokus dalam penyampaian materi</td>
                                    <td class="border border-gray-300 px-2 py-1">17/02/2023</td>
                                    <td class="border border-gray-300 px-2 py-1"></td>
                                    <td class="border border-gray-300 px-2 py-1">[2] Jarang Terjadi</td>
                                    <td class="border border-gray-300 px-2 py-1">[4] Signifikan</td>
                                    <td class="border border-gray-300 px-2 py-1">13</td>
                                    <td class="border border-gray-300 px-2 py-1 text-center">
                                        <div class="flex justify-center gap-4">
                                            <button class="bg-blue-500 text-white px-2 py-1 rounded-md hover:bg-blue-600">✎</button>
                                            <button class="bg-red-500 text-white px-2 py-1 rounded-md hover:bg-red-600">🗑</button>
                                        </div>
                                    </td>
                                </tr>
                                <tr class="odd:bg-white even:bg-gray-100">
                                    <td class="border border-gray-300 px-2 py-1">2</td>
                                    <td class="border border-gray-300 px-2 py-1">Dimintakan feedback peserta pelatihan terhadap/tingkat kepuasan terhadap proses transfer pengetahuan dan kemampuan Inda secara keseluruhan</td>
                                    <td class="border border-gray-300 px-2 py-1">Mengetahui kelemahan dan kelebihan Inda</td>
                                    <td class="border border-gray-300 px-2 py-1">28/02/2023</td>
                                    <td class="border border-gray-300 px-2 py-1"></td>
                                    <td class="border border-gray-300 px-2 py-1">[2] Jarang Terjadi</td>
                                    <td class="border border-gray-300 px-2 py-1">[4] Signifikan</td>
                                    <td class="border border-gray-300 px-2 py-1">13</td>
                                    <td class="border border-gray-300 px-2 py-1 text-center">
                                        <div class="flex justify-center gap-4">
                                            <button class="bg-blue-500 text-white px-2 py-1 rounded-md hover:bg-blue-600">✎</button>
                                            <button class="bg-red-500 text-white px-2 py-1 rounded-md hover:bg-red-600">🗑</button>
                                        </div>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            

        <!-- Modal Tambah Perencanaan -->
        <div id="tambahModal" class="fixed inset-0 hidden flex items-center justify-center z-50 bg-transparent bg-opacity-50">

            <!-- Overlay -->
            <div class="fixed inset-0 bg-black opacity-50"></div>

            <div class="relative bg-white rounded-lg shadow-lg w-3 p-3">
                <div class="flex justify-between items-center bg-gray-100 px-4 py-3 rounded-t-lg">
                    <h2 class="text-lg font-semibold">TAMBAH PERENCANAAN</h2>
                    <button class="text-gray-500 hover:text-gray-700" onclick="closeTambahModal()">
                        ✕
                    </button>
                </div>
                <div class="p-4">
                    <form>
                        <div class="grid grid-cols-2 gap-4">
                            <!-- RTP -->
                            <div>
                                <label for="rtp" class="block text-sm font-medium">RTP</label>
                                <input id="rtp" type="text" class="w-full border border-gray-300 rounded-md px-3 py-2" placeholder="Rencana Tindak Penanganan">
                            </div>
                            <!-- Target Output -->
                            <div>
                                <label for="targetOutput" class="block text-sm font-medium">Target Output</label>
                                <input id="targetOutput" type="text" class="w-full border border-gray-300 rounded-md px-3 py-2" placeholder="Target Output">
                            </div>
                            <!-- Penanggung Jawab -->
                            <div>
                                <label for="penanggungJawab" class="block text-sm font-medium">Penanggung Jawab</label>
                                <select id="penanggungJawab" class="w-full border border-gray-300 rounded-md px-3 py-2">
                                    <option>--Penanggung Jawab--</option>
                                    <option>Person A</option>
                                    <option>Person B</option>
                                </select>
                            </div>
                            <!-- Target Waktu -->
                            <div>
                                <label for="targetWaktu" class="block text-sm font-medium">Target Waktu</label>
                                <input id="targetWaktu" type="date" class="w-full border border-gray-300 rounded-md px-3 py-2">
                            </div>
                        </div>
                        <div class="mt-6 flex justify-end">
                            <button type="submit" class="bg-green-500 text-white px-4 py-2 rounded-md hover:bg-green-600">SAVE</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>



        </div>
        <div class="flex justify-center mt-4">
            <!-- Pagination -->
            <nav class="inline-flex">
                <!-- Placeholder for pagination links if necessary -->
            </nav>
        </div>
    </div>
    @include('admin.risk.components.modal-uraian')

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const uraianModal = document.getElementById('uraianModal');
            const closeModal4 = document.getElementById('closeModal4');
            const openAdduraianModal = document.getElementById('openAddUraianModal');
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
                    hasilLevelResiko.classList.remove('bg-red-600', 'bg-orange-600', 'bg-yellow-500',
                        'bg-green-600', 'bg-blue-600', 'text-white');
                    if (result) {
                        if (result.hasil_level_resiko === 'Sangat Tinggi') {
                            hasilLevelResiko.classList.add('bg-red-600', 'text-white');
                        } else if (result.hasil_level_resiko === 'Tinggi') {
                            hasilLevelResiko.classList.add('bg-orange-600', 'text-white');
                        } else if (result.hasil_level_resiko === 'Sedang') {
                            hasilLevelResiko.classList.add('bg-yellow-500', 'text-white');
                        } else if (result.hasil_level_resiko === 'Rendah') {
                            hasilLevelResiko.classList.add('bg-green-600', 'text-white');
                        } else if (result.hasil_level_resiko === 'Sangat Rendah') {
                            hasilLevelResiko.classList.add('bg-blue-600', 'text-white');
                        }
                    }
                } else {
                    hasilLevelResiko.innerText = 'cukitdulit';
                    hasilLevelResiko.classList.remove('bg-red-600', 'bg-orange-600', 'bg-yellow-500',
                        'bg-green-600', 'bg-blue-600', 'text-white');
                }
            }

            levelKemungkinanSelects.forEach(select => {
                select.addEventListener('change', () => updateHasilLevelResiko(select));
            });

            levelDampakSelects.forEach(select => {
                select.addEventListener('change', () => updateHasilLevelResiko(select));
            });

            document.querySelectorAll('#btnEdit').forEach(editBtn => {
                editBtn.addEventListener('click', function (event) {
                    event.preventDefault();
                    const rowId = this.getAttribute('data-id');
                    const levelKemungkinanSelect = document.getElementById('levelKemungkinan' + rowId);
                    const levelDampakSelect = document.getElementById('levelDampak' + rowId);
                    const efektivitasSelect = document.getElementById('efektivitas' + rowId);

                    if (levelKemungkinanSelect) levelKemungkinanSelect.disabled = false;
                    if (levelDampakSelect) levelDampakSelect.disabled = false;
                    if (efektivitasSelect) efektivitasSelect.disabled = false;

                    const saveBtn = this.closest('tr').querySelector('#saveanalisisBtn');
                    if (saveBtn) saveBtn.disabled = false;
                });
            });

            document.querySelectorAll('#saveanalisisBtn').forEach(saveBtn => {
                saveBtn.addEventListener('click', function (event) {
                    event.preventDefault();
                    const rowId = this.closest('tr').querySelector('input[name="manajemen_resiko_ids[]"]').value;
                    const levelKemungkinanSelect = document.getElementById('levelKemungkinan' + rowId);
                    const levelDampakSelect = document.getElementById('levelDampak' + rowId);
                    const efektivitasSelect = document.getElementById('efektivitas' + rowId);

                    // Save functionality here
                });
            });
        });

            function closeModal() {
            document.getElementById('editModal').classList.add('hidden');
        }

        function openEditModal() {
            document.getElementById('editModal').classList.remove('hidden');
        }

        document.getElementById('editModal').addEventListener('click', function (event) {
            if (event.target.id === 'editModal') {
                closeModal();
            }
        });

        function openTambahModal() {
            document.getElementById('tambahModal').classList.remove('hidden');
        }

        function closeTambahModal() {
            document.getElementById('tambahModal').classList.add('hidden');
        }

        function refreshTable() {
            // Logika untuk memperbarui data tabel
            console.log("Refreshing table...");

            // Jika menggunakan DataTables
            if ($.fn.DataTable.isDataTable('#yourTableId')) {
                $('#yourTableId').DataTable().ajax.reload(null, false); // Reload data tanpa mengubah halaman
            }
        }




    </script>
</x-admin-layout>
