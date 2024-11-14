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
                                <a href="#" class="text-blue-500 hover:text-blue-700">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 inline" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5h6M5 5h6M9 3l3 3-3 3M5 13v2a2 2 0 002 2h12a2 2 0 002-2v-5a2 2 0 00-2-2h-7a2 2 0 00-2 2v1M15 7H7a2 2 0 00-2 2v8a2 2 0 002 2h2m10-10v4m-5-4v4" />
                                    </svg>
                                </a>
                            </td>
                        </tr>
                        <tr>
                            <td class="px-6 py-4 text-center border-r border-gray-200">3</td>
                            <td class="px-6 py-4 text-center border-r border-gray-200">Rendah</td>
                            <td class="px-6 py-4 border-r border-gray-200">Resiko keterlambatan proyek karena kendala logistik</td>
                            <td class="px-6 py-4 text-center border-r border-gray-200">20%</td>
                            <td class="px-6 py-4 text-center border-r border-gray-200">15%</td>
                            <td class="px-6 py-4 text-center border-r border-gray-200">
                                <a href="#" class="text-blue-500 hover:text-blue-700">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 inline" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5h6M5 5h6M9 3l3 3-3 3M5 13v2a2 2 0 002 2h12a2 2 0 002-2v-5a2 2 0 00-2-2h-7a2 2 0 00-2 2v1M15 7H7a2 2 0 00-2 2v8a2 2 0 002 2h2m10-10v4m-5-4v4" />
                                    </svg>
                                </a>
                            </td>
                        </tr>
                        <tr>
                            <td class="px-6 py-4 text-center border-r border-gray-200">3</td>
                            <td class="px-6 py-4 text-center border-r border-gray-200">Rendah</td>
                            <td class="px-6 py-4 border-r border-gray-200">Resiko keterlambatan proyek karena kendala logistik</td>
                            <td class="px-6 py-4 text-center border-r border-gray-200">20%</td>
                            <td class="px-6 py-4 text-center border-r border-gray-200">15%</td>
                            <td class="px-6 py-4 text-center border-r border-gray-200">
                                <a href="#" class="text-blue-500 hover:text-blue-700">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 inline" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5h6M5 5h6M9 3l3 3-3 3M5 13v2a2 2 0 002 2h12a2 2 0 002-2v-5a2 2 0 00-2-2h-7a2 2 0 00-2 2v1M15 7H7a2 2 0 00-2 2v8a2 2 0 002 2h2m10-10v4m-5-4v4" />
                                    </svg>
                                </a>
                            </td>
                        </tr>
                    </tbody>
                </table>
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
    </script>
</x-admin-layout>
