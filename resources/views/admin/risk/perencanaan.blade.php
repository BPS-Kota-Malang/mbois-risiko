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
                    @if ($manajemenResikos->isEmpty())
                        <tr>
                            <td colspan="15" class="text-center py-4">
                                Data Tidak Ada
                            </td>
                        </tr>
                    @else
                    @foreach ($manajemenResikos as $ManajemenResiko)



                    </form>
                    @endforeach
                    @endif
                </table>
            </div>
        </div>
        <div class="flex justify-center mt-4">
            {{ $manajemenResikos->links() }}
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
                    hasilLevelResiko.innerText = 'cukitdulit'; // Clear the value
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

            // Edit Button functionality
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

            // Save Button functionality
            document.querySelectorAll('#saveanalisisBtn').forEach(saveBtn => {
                saveBtn.addEventListener('click', function (event) {
                    event.preventDefault();
                    const rowId = this.closest('tr').querySelector('input[name="manajemen_resiko_ids[]"]').value;
                    const levelKemungkinanSelect = document.getElementById('levelKemungkinan' + rowId);
                    const levelDampakSelect = document.getElementById('levelDampak' + rowId);
                    const efektivitasSelect = document.getElementById('efektivitas' + rowId);

                    if (levelKemungkinanSelect) levelKemungkinanSelect.disabled = true;
                    if (levelDampakSelect) levelDampakSelect.disabled = true;

                    this.closest('form').submit();
                });
            });




            document.addEventListener('click', function (event) {
                if (event.target.classList.contains('openUraianModal')) {
                    event.preventDefault();
                    selectedManajemenResikoId = event.target.getAttribute('data-manajemen-resiko-id');
                    selectedUraianID = event.target.getAttribute('data-uraian-id');

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
                    if (openAdduraianModal) openAdduraianModal.classList.add('hidden');
                }
            });

            if (closeModal4) {
                closeModal4.addEventListener('click', function () {
                    uraianModal.classList.add('hidden');
                    openAdduraianModal.classList.remove('hidden');
                });
            }

            // Initialize Uraian Table
            initializeUraianTable();




        });

        document.addEventListener('DOMContentLoaded', function () {
            // Set nilai respon yang disimpan di localStorage saat halaman dimuat
            document.querySelectorAll('select[id^="responResiko"]').forEach(selectElement => {
                const rowId = selectElement.id.replace('responResiko', '');
                const savedValue = localStorage.getItem('responResiko' + rowId);
                if (savedValue) {
                    selectElement.value = savedValue;
                    updatePrioritas(selectElement); // Memperbarui prioritas sesuai pilihan yang tersimpan
                }
            });
        });

        function updatePrioritas(selectElement) {
            const rowId = selectElement.id.replace('responResiko', ''); // Mendapatkan id dari baris
            const prioritasElement = document.getElementById('prioritas' + rowId);

            let prioritasValue;

            // Menyimpan nilai respon resiko ke localStorage
            localStorage.setItem('responResiko' + rowId, selectElement.value);

            // Menggunakan if-else untuk menentukan nilai prioritas
            if (selectElement.value === 'Mengurangi Risiko') {
                prioritasValue = 1;
            } else if (selectElement.value === 'Mengalihkan Risiko') {
                prioritasValue = 2;
            } else if (selectElement.value === 'Menghindari Risiko') {
                prioritasValue = 3;
            } else if (selectElement.value === 'Menerima Risiko') {
                prioritasValue = 4;
            } else {
                prioritasValue = '-';
            }

            // Update elemen prioritas dengan nilai yang baru
            prioritasElement.textContent = prioritasValue;
        }

    </script>

</x-admin-layout>
