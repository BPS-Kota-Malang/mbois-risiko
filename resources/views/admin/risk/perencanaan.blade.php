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
                        <!-- Data Dummy -->
                        <tr>
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
                        <tr>
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
                        <tr>
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

            <!-- Modal -->
        <div id="editModal" class="fixed z-10 inset-0 hidden overflow-y-auto" aria-labelledby="modal-title" aria-hidden="true">
            <div class="flex items-center justify-center min-h-screen px-4 text-center">
                <div class="bg-white rounded-lg shadow-xl w-full max-w-2xl p-6">
                    <div class="flex items-left justify-between mb-4">
                        <h3 class="text-lg font-medium text-gray-900" id="modal-title">Pilih Rencana</h3>
                        <button onclick="closeEditModal()" class="text-gray-400 hover:text-gray-600">
                            &times;
                        </button>
                    </div>
                    <div class="mb-4 text-left">
                        <button class="bg-blue-500 text-white px-4 py-2 rounded-md hover:bg-blue-600">
                            Perencanaan
                        </button>
                    </div>
                    
                    <table id="editTable" class="min-w-full border border-gray-300">
                        <thead class="bg-gray-100">
                            <tr>
                                <th class="px-4 py-2">Search</th>
                                <th class="px-4 py-2">Search</th>
                                <th class="px-4 py-2">Search</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td colspan="3" class="text-center py-4 text-gray-500">No data available in table</td>
                            </tr>
                        </tbody>
                    </table>
                    <div class="flex items-center justify-between mt-4">
                        <span>Showing 0 to 0 of 0 entries</span>
                        <div class="space-x-2">
                            <button class="bg-gray-200 text-gray-700 px-3 py-1 rounded-md">Previous</button>
                            <button class="bg-gray-200 text-gray-700 px-3 py-1 rounded-md">Next</button>
                        </div>
                    </div>
                    <div class="mt-6 text-right">
                        <button onclick="closeEditModal()" class="bg-green-500 text-white px-4 py-2 rounded-md hover:bg-green-600">
                            Simpan
                        </button>
                    </div>
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

        function openEditModal() {
                const modal = document.getElementById('editModal');
                modal.classList.remove('hidden');
            }

            function closeEditModal() {
                const modal = document.getElementById('editModal');
                modal.classList.add('hidden');
            }

    </script>
</x-admin-layout>
