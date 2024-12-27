<x-admin-layout>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>


    <div class="flex justify-center mt-10">
        <div class="w-full p-6 bg-white rounded-lg shadow-md ">
            <h1 class="mb-6 text-2xl font-bold" id="cek">Analisis Risiko</h1>
            <form id="identifikasiResikoForm">
                <div class="mb-4">
                    <label class="block mb-2 text-gray-700" for="tim-bidang">Tim/Bidang</label>
                    <select id="tim" name="tim" class="w-full p-2 border rounded-lg">
                        <option value="">-- Pilih Tim/Bidang --</option>
                        @foreach ($timProjects as $tim)
                            <option value="{{ $tim->id }}">{{ $tim->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="mb-4">
                    <label class="block mb-2 text-gray-700" for="tim-bidang">Sub Team / Bidang</label>
                    <select id="subteam" name="subteam" class="w-full p-2 border rounded-lg">
                    </select>
                </div>
                <div class="mb-4">
                    <label class="block mb-2 text-gray-700" for="activity">Kegiatan</label>
                    <select id="activity" name="activity" class="w-full p-2 border rounded-lg">
                    </select>
                </div>
                <div class="mb-4">
                    <label class="block mb-2 text-gray-700" for="proses-bisnis">Proses Bisnis</label>
                    <select id="proses_bisnis" name="proses_bisnis" class="w-full p-2 border rounded-lg">
                        <option value="">-- Pilih Proses Bisnis --</option>
                        @foreach ($ProsesBisnis as $proses)
                            <option value="{{ $proses->id }}">{{ $proses->name }}</option>
                        @endforeach
                    </select>
                </div>
                <button type="submit" class="px-4 py-2 text-white bg-blue-500 rounded">Filter</button>
            </form>
        </div>
    </div>

    <div class="container mx-auto mt-10">
        <div class="flex items-center justify-between mb-4 space-x-4">
            <div class="overflow-x-auto bg-white rounded-lg shadow-md">
                <table class="min-w-full divide-y divide-gray-200" id="riskTable">
                    <thead class="bg-gray-50">
                        <tr>
                            <th
                            class="px-6 py-3 text-xs font-medium tracking-wider text-gray-500 uppercase border border-gray-300 text-middle">
                            No</th>
                        <th
                            class="px-6 py-3 text-xs font-medium tracking-wider text-gray-500 uppercase border border-gray-300 text-middle">
                            Proses Bisnis</th>
                        <th
                            class="px-6 py-3 text-xs font-medium tracking-wider text-gray-500 uppercase border border-gray-300 text-middle">
                            Tim - Sub Team
                        </th>
                        <th
                            class="px-6 py-3 text-xs font-medium tracking-wider text-gray-500 uppercase border border-gray-300 text-middle">
                            Kegiatan
                        </th>
                        <th
                            class="px-6 py-3 text-xs font-medium tracking-wider text-gray-500 uppercase border border-gray-300 text-middle">
                            Pernyataan Risiko</th>
                        <th
                            <th class="px-6 py-4 text-xs font-medium tracking-wider text-gray-500 uppercase border-r border-gray-200 text-middle"
                                style="width: 100px;">Jenis</th>
                            <th class="px-6 py-3 text-xs font-medium tracking-wider text-gray-500 uppercase border-r border-gray-200 text-middle"
                                style="width: 100px;">Sumber</th>
                            <th class="px-6 py-3 text-xs font-medium tracking-wider text-gray-500 uppercase border-r border-gray-200 text-middle"
                                style="width: 100px;">Kategori</th>
                            <th class="px-6 py-3 text-xs font-medium tracking-wider text-gray-500 uppercase border-r border-gray-200 text-middle"
                                style="width: 150px;">Area Dampak</th>
                            <th class="px-6 py-3 text-xs font-medium tracking-wider text-gray-500 uppercase border-r border-gray-200 text-middle"
                                style="width: 150px;">Penyebab</th>
                            <th class="px-6 py-3 text-xs font-medium tracking-wider text-gray-500 uppercase border-r border-gray-200 text-middle"
                                style="width: 150px;">Dampak</th>
                            <th class="px-6 py-3 text-xs font-medium tracking-wider text-gray-500 uppercase border-r border-gray-200 text-middle"
                                style="width: 200px;">Level Kemungkinan</th>
                            <th class="px-6 py-3 text-xs font-medium tracking-wider text-gray-500 uppercase border-r border-gray-200 text-middle"
                                style="width: 200px;">Level Dampak</th>
                            <th class="px-6 py-3 text-xs font-medium tracking-wider text-gray-500 uppercase border-r border-gray-200 text-middle"
                                style="width: 200px;">Level Risiko</th>
                            <th class="px-6 py-3 text-xs font-medium tracking-wider text-gray-500 uppercase border-r border-gray-200 text-middle"
                                style="width: 200px;">Uraian</th>
                            <th class="px-6 py-3 text-xs font-medium tracking-wider text-gray-500 uppercase border-r border-gray-200 text-middle"
                                style="width: 100px;">Efektivitas</th>
                            @if ((auth()->check() && auth()->user()->hasRole('admin')) || auth()->user()->hasRole('ketua_tim'))
                            <th class="px-6 py-3 text-xs font-medium tracking-wider text-gray-500 uppercase border-r border-gray-200 text-middle"
                                style="width: 100px;">Action</th>
                            @endif
                        </tr>
                    </thead>
                    @if ($manajemenResikos->isEmpty())
                        <tr>
                            <td colspan="15" class="py-4 text-center">
                                Data Tidak Ada
                            </td>
                        </tr>
                    @else
                    @foreach ($manajemenResikos as $ManajemenResiko)

                        <form action="{{ route('admin.analisis.update', $ManajemenResiko->id) }}" method="POST">
                            @csrf
                            @method('PUT')
                            <tr>
                                <input type="hidden" name="manajemen_resiko_ids[]" value="{{ $ManajemenResiko->id }}">
                                <td class="px-6 py-4 border-r border-gray-200 whitespace-nowrap">
                                    {{ $loop->iteration + (($manajemenResikos->currentPage() - 1) * $manajemenResikos->perPage()) }}
                                </td>
                                <td class="px-6 py-4 border-r border-gray-200 whitespace-nowrap">
                                    {{ $ManajemenResiko->prosesbisnis->name }}</td>
                                <td class="px-6 py-4 border border-gray-300 whitespace-nowrap">
                                    <div>
                                        <span class="text-lg font-bold">{{ $ManajemenResiko->activity->subteam->timProject->name }}</span>
                                    </div>
                                    <div>
                                        <span class="text-sm">{{ $ManajemenResiko->activity->subteam->name }}</span>
                                    </div>
                                </td>
                                <td class="px-6 py-4 border border-gray-300 whitespace-nowrap">
                                    {{ $ManajemenResiko->activity->name }}
                                </td>
                                <td class="px-6 py-4 border-r border-gray-200 whitespace-nowrap">
                                    {{ $ManajemenResiko->resiko->name }}</td>
                                <td class="px-6 py-4 border-r border-gray-200 whitespace-nowrap">
                                    @if ($ManajemenResiko->jenisResiko)
                                        {{ $ManajemenResiko->jenisResiko->name }}
                                    @else<span class="block text-center text-black">-</span>
                                    @endif
                                </td>
                                <td class="px-6 py-4 border-r border-gray-200 whitespace-nowrap">
                                    @if ($ManajemenResiko->sumberResiko)
                                        {{ $ManajemenResiko->sumberResiko->name }}
                                    @else<span class="block text-center text-black">-</span>
                                    @endif
                                </td>
                                <td class="px-6 py-4 border-r border-gray-200 whitespace-nowrap">
                                    @if ($ManajemenResiko->kategoriResiko)
                                        {{ $ManajemenResiko->kategoriResiko->deskripsi }}
                                    @else<span class="block text-center text-black">-</span>
                                    @endif
                                </td>
                                <td class="px-6 py-4 border-r border-gray-200 whitespace-nowrap">
                                    @if ($ManajemenResiko->areaDampak)
                                        {{ $ManajemenResiko->areaDampak->name }}
                                    @else<span class="block text-center text-black">-</span>
                                    @endif
                                </td>
                                <td class="px-6 py-4 border-r border-gray-200 whitespace-nowrap">
                                    @if ($ManajemenResiko->id_penyebab)
                                        @php
                                            $penyebabIds = json_decode($ManajemenResiko->id_penyebab, true);
                                            $penyebabNames = \App\Models\Penyebab::whereIn('id', $penyebabIds)
                                                ->pluck('name') // Ganti 'penyebab' dengan 'name'
                                                ->toArray();
                                        @endphp
                                        @foreach ($penyebabNames as $penyebab)
                                            <li class="list-disc">{{ $penyebab }}</li>
                                        @endforeach
                                    @else
                                        <span class="block text-center text-black">-</span>
                                    @endif
                                </td>
                                <td class="px-6 py-4 border-r border-gray-200 whitespace-nowrap">
                                    @if ($ManajemenResiko->id_dampak)
                                        @php
                                            $dampakIds = json_decode($ManajemenResiko->id_dampak, true);
                                            $dampakNames = \App\Models\Dampak::whereIn('id', $dampakIds)
                                                ->pluck('name') // Ganti 'dampak' dengan 'name'
                                                ->toArray();
                                        @endphp
                                        @foreach ($dampakNames as $dampak)
                                            <li class="list-disc">{{ $dampak }}</li>
                                        @endforeach
                                    @else
                                        <span class="block text-center text-black">-</span>
                                    @endif
                                </td>
                                <td class="px-6 py-4 border-r border-gray-200 whitespace-nowrap">
                                    <select name="level_kemungkinan[]" class="py-2 pr-8 border rounded-lg form-select"
                                        id="levelKemungkinan{{ $ManajemenResiko->id }}"
                                        {{ !is_null($ManajemenResiko->id_level_kemungkinan) ? 'disabled' : '' }}>
                                        <option  value="">-- Pilih Level Kemungkinan --</option>
                                        @foreach ($levelKemungkinan as $kemungkinan)
                                            <option  value="{{ $kemungkinan->id }}"
                                                {{ $kemungkinan->id == $ManajemenResiko->id_level_kemungkinan ? 'selected' : '' }}>
                                                {{ $kemungkinan->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </td>
                                <td class="px-6 py-4 border-r border-gray-200 whitespace-nowrap">
                                    <select name="level_dampak[]" class="py-2 pr-8 border rounded-lg form-select"
                                        id="levelDampak{{ $ManajemenResiko->id }}"
                                        {{ !is_null($ManajemenResiko->id_level_dampak) ? 'disabled' : '' }}>
                                        <option value="">-- Pilih Level Dampak --</option>
                                        @foreach ($levelDampak as $dampak)
                                            <option value="{{ $dampak->id }}"
                                                {{ $dampak->id == $ManajemenResiko->id_level_dampak ? 'selected' : '' }}>
                                                {{ $dampak->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap border-r border-gray-200
                                    {{ is_null($ManajemenResiko->id_matriks_analisis_resiko)
                                        ? ''
                                        : ($ManajemenResiko->matriksAnalisisResiko->hasil_level_resiko === 'Sangat Tinggi'
                                            ? 'bg-red-600 text-white'
                                            : ($ManajemenResiko->matriksAnalisisResiko->hasil_level_resiko === 'Tinggi'
                                                ? 'bg-orange-600 text-white'
                                                : ($ManajemenResiko->matriksAnalisisResiko->hasil_level_resiko === 'Sedang'
                                                    ? 'bg-yellow-500 text-white'
                                                    : ($ManajemenResiko->matriksAnalisisResiko->hasil_level_resiko === 'Rendah'
                                                        ? 'bg-green-600 text-white'
                                                        : ($ManajemenResiko->matriksAnalisisResiko->hasil_level_resiko === 'Sangat Rendah'
                                                            ? 'bg-blue-600 text-white'
                                                            : ''))))) }}"
                                    id="hasilLevelResiko{{ $ManajemenResiko->id }}">
                                    @if (is_null($ManajemenResiko->id_matriks_analisis_resiko))
                                        Data tidak tersedia
                                    @else
                                        {{ $ManajemenResiko->matriksAnalisisResiko->hasil_level_resiko ?? 'Level Resiko Tidak Ditemukan' }}
                                    @endif
                                </td>

                                {{-- uraian --}}
                                {{-- @if ((auth()->check() && auth()->user()->hasRole('admin')) || (auth()->user()->hasRole('ketua_tim') && optional(auth()->user()->pegawai)->team_id == $ManajemenResiko->tim_project->id)) --}}
                                @if ((auth()->check() && auth()->user()->hasRole('admin')) || (auth()->user()->hasRole('ketua_tim') && optional(auth()->user()->pegawai)->team_id == $ManajemenResiko->activity->subteam->team_id))
                                <td class="px-6 py-4 border border-gray-300 whitespace-nowrap">
                                    <div class="flex flex-col items-center">
                                        <!-- Tombol Pilih Uraian dipusatkan -->
                                        <button class="px-4 py-2 text-white bg-blue-500 rounded openUraianModal"
                                                data-manajemen-resiko-id="{{ $ManajemenResiko->id }}"
                                                data-uraian-id="{{ $ManajemenResiko->id_uraian }}">
                                            Pilih Uraian
                                        </button>

                                        <!-- Daftar Uraian, ditampilkan rata kiri di bawah tombol -->
                                        <div id="selectedUraian" class="w-full mt-4 text-left">
                                            @php
                                                // Decode the JSON string into a PHP array
                                                $uraianIds = json_decode($ManajemenResiko->id_uraian, true);
                                            @endphp

                                            @if (is_array($uraianIds) && count($uraianIds) > 0)
                                                <ul class="ml-4 text-gray-800 list-disc list-inside">
                                                    @foreach ($uraianIds as $item)
                                                        @foreach ($uraian as $uraianItem)
                                                            @if ($uraianItem->id == $item)
                                                                @php
                                                                    // Membuat variabel yang menyimpan id uraian dalam bentuk json tanpa id yang dipilih
                                                                    $uraianHapus = array_diff($uraianIds, [$item]);
                                                                @endphp
                                                                <li class="flex items-center justify-between">
                                                                    <span>{{ $uraianItem->name }}</span>
                                                                    <a href="javascript:void(0);"
                                                                        class="ml-2 text-red-500 hover:text-red-700"
                                                                        onclick="hapusUraian('{{ url('/admin/analisis/hapusuraian/' . $ManajemenResiko->id . '/' . $item) }}');">
                                                                        <i class="fas fa-trash-alt"></i>
                                                                    </a>
                                                                </li>
                                                            @endif
                                                        @endforeach
                                                    @endforeach
                                                </ul>
                                            @else
                                                <!-- Jika tidak ada uraian yang dipilih -->
                                                <p class="ml-4 italic text-center text-gray-500">-</p>
                                            @endif
                                        </div>

                                    </div>
                                </td>
                                @else
                                <td class="px-6 py-4 border border-gray-300 whitespace-nowrap">
                                    <div class="">
                                        @php
                                            // Decode the JSON string into a PHP array
                                            $uraianIds = json_decode($ManajemenResiko->id_uraian, true);
                                        @endphp

                                        @if (is_array($uraianIds) && count($uraianIds) > 0)
                                        <ul class="px-6 py-4">
                                            @foreach ($uraianIds as $item)
                                                @foreach ($uraian as $uraianItem)
                                                    @if ($uraianItem->id == $item)
                                                        @php
                                                            // Membuat variabel yang menyimpan id uraian dalam bentuk json tanpa id yang dipilih
                                                            $uraianHapus = array_diff($uraianIds, [$item]);
                                                        @endphp
                                                        <li class="list-disc ">
                                                            <span>{{ $uraianItem->name }}</span>
                                                        </li>
                                                    @endif
                                                @endforeach
                                            @endforeach
                                        </ul>

                                        @else
                                            <!-- Jika tidak ada uraian yang dipilih -->
                                            <p class="ml-4 italic text-center text-red-500">-</p>
                                        @endif
                                    </div>
                                </td>
                                @endif

                                <td class="px-6 py-4 border-r border-gray-200 whitespace-nowrap">
                                    <select name="efektivitas[]" class="py-2 pr-8 border rounded-lg form-select"
                                        id="efektivitas{{ $ManajemenResiko->id }}"
                                        {{ is_null($ManajemenResiko->efektivitas) ? '' : 'disabled' }}>
                                        <option value="">-- Pilih Efektivitas --</option>
                                        <option value="Efektif"
                                            {{ $ManajemenResiko->efektivitas === 'Efektif' ? 'selected' : '' }}>
                                            Efektif
                                        </option>
                                        <option value="Tidak Efektif"
                                            {{ $ManajemenResiko->efektivitas === 'Tidak Efektif' ? 'selected' : '' }}>
                                            Tidak Efektif
                                        </option>
                                    </select>
                                </td>
                                @if (auth()->user()->hasRole('admin'))
                                    <!-- Admin specific content -->
                                    <td class="px-6 py-4 border-r border-gray-200 whitespace-nowrap">
                                        <a class="px-2 py-2 text-white bg-blue-500 rounded cursor-pointer width-mt-2"
                                            id="btnEdit" data-id="{{ $ManajemenResiko->id }}">Edit</a>
                                        <button type="submit"
                                            class="px-2 py-1 text-white bg-green-500 rounded">Save
                                        </button>
                                    </td>
                                @elseif (auth()->user()->hasRole('ketua_tim'))
                                    {{-- @if ((optional(auth()->user()->pegawai)->team_id == $ManajemenResiko->tim_project->id)) --}}
                                    @if ((optional(auth()->user()->pegawai)->id_tim == $ManajemenResiko->activity->subteam->tim_project_id))
                                        <td class="px-6 py-4 border-r border-gray-200 whitespace-nowrap">
                                            <a class="px-2 py-2 text-white bg-blue-500 rounded cursor-pointer width-mt-2"
                                                id="btnEdit" data-id="{{ $ManajemenResiko->id }}">Edit</a>
                                            <button type="submit"
                                                class="px-2 py-1 text-white bg-green-500 rounded">Save
                                            </button>
                                        </td>
                                    @else
                                        <td class="px-6 py-4 border border-gray-300 whitespace-nowrap">
                                            <p class="text-center text-red-500">Tidak Memiliki Izin Beda TIM</p>
                                        </td>
                                    @endif
                                @endif
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
        document.addEventListener('DOMContentLoaded', function() {
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


            document.querySelectorAll('#btnEdit').forEach(editBtn => {
                editBtn.addEventListener('click', function(event) {
                    event.preventDefault();
                    const rowId = this.getAttribute('data-id');
                    console.log('Editing row:', rowId);
                    const levelKemungkinanSelect = document.getElementById('levelKemungkinan' + rowId);
                    const levelDampakSelect = document.getElementById('levelDampak' + rowId);
                    const efektivitasSelect = document.getElementById('efektivitas' + rowId);

                    console.log('levelKemungkinanSelect:', levelKemungkinanSelect);
                    console.log('levelDampakSelect:', levelDampakSelect);
                    console.log('efektivitasSelect:', efektivitasSelect);

                    if (levelKemungkinanSelect) levelKemungkinanSelect.disabled = false;
                    if (levelDampakSelect) levelDampakSelect.disabled = false;
                    if (efektivitasSelect) efektivitasSelect.disabled = false;

                    const saveBtn = this.closest('tr').querySelector('#saveanalisisBtn');
                    if (saveBtn) saveBtn.disabled = false;
                });
            });

            document.querySelectorAll('#saveanalisisBtn').forEach(saveBtn => {
                saveBtn.addEventListener('click', function(event) {
                    event.preventDefault();
                    const rowId = this.closest('tr').querySelector('input[name="manajemen_resiko_ids[]"]').value;
                    console.log('Saving row:', rowId);
                    const levelKemungkinanSelect = document.getElementById('levelKemungkinan' + rowId);
                    const levelDampakSelect = document.getElementById('levelDampak' + rowId);
                    const efektivitasSelect = document.getElementById('efektivitas' + rowId);

                    console.log('levelKemungkinanSelect:', levelKemungkinanSelect);
                    console.log('levelDampakSelect:', levelDampakSelect);
                    console.log('efektivitasSelect:', efektivitasSelect);

                    if (levelKemungkinanSelect) levelKemungkinanSelect.disabled = true;
                    if (levelDampakSelect) levelDampakSelect.disabled = true;

                    this.closest('form').submit();
                });
            });



            /**
             * Part Sub Team
            */

            function fetchSubteams() {
                const timId = document.getElementById('tim').value;
                const subteamDropdown = document.getElementById('subteam');
                console.log("Masuk fetch");

                // Clear the current options
                subteamDropdown.innerHTML = '<option value="">-- Pilih Sub Tim/Bidang --</option>';

                if (timId) {
                    fetch(`/get-subteams/${timId}`)
                        .then(response => response.json())
                        .then(data => {
                            data.forEach(subteam => {
                                const option = document.createElement('option');
                                option.value = subteam.id;
                                option.textContent = subteam.name;
                                subteamDropdown.appendChild(option);
                            });
                        })
                        .catch(error => console.error('Error fetching subteams:', error));
                }
            }

            /**
             * Part Activity
            */
            function fetchActivities() {
                const subteamDropdown = document.getElementById('subteam').value;
                const activityDropdown = document.getElementById('activity');
                console.log("Masuk fetch activity");

                // Clear the current options
                activityDropdown.innerHTML = '<option value="">-- Pilih Kegiatan --</option>';

                if (subteamDropdown) {
                    fetch(`/get-activities/${subteamDropdown}`)
                        .then(response => response.json())
                        .then(data => {
                            data.forEach(activity => {
                                const option = document.createElement('option');
                                option.value = activity.id;
                                option.textContent = activity.name;
                                activityDropdown.appendChild(option);
                            });
                        })
                        .catch(error => console.error('Error fetching subteams:', error));
                }
            }

            const timDropdown = document.getElementById('tim'); // Dropdown Tim
            const prosesBisnisDropdown = document.getElementById('proses_bisnis'); // Dropdown Proses Bisnis
            const subteamDropdown = document.getElementById('subteam'); // Dropdown Tim


            if (timDropdown && prosesBisnisDropdown) {
                // timDropdown.addEventListener('change', checkDropdowns);
                timDropdown.addEventListener('change', function () {
                    // checkDropdowns();
                    fetchSubteams();
                });

                prosesBisnisDropdown.addEventListener('change', checkDropdowns);
            }

            if (subteamDropdown) {
                // timDropdown.addEventListener('change', checkDropdowns);
                subteamDropdown.addEventListener('change', function () {
                    checkDropdowns();
                    fetchActivities();
                });

                prosesBisnisDropdown.addEventListener('change', checkDropdowns);
            }
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
                    columns: [{
                            data: "id",
                            render: function(data, type, row) {
                                var isDisabled = (row.status === 'Rejected' || row.status ===
                                    'On Progress') ? 'disabled' : '';
                                var disabledColor = (row.status === 'Rejected') ? 'bg-red-500' : (
                                        row.status === 'On Progress') ? 'bg-orange-500' :
                                    'bg-green-500';
                                var isChecked = window.selectedUraianIds && window.selectedUraianIds
                                    .includes(String(data)) ? 'checked disabled' : '';
                                console.log(row);
                                console.log(isChecked);
                                console.log(window.selectedUraianIds)
                                return '<input type="checkbox" class="uraian-checkbox" data-uraian-id="' +
                                    data + '" ' + isChecked + ' ' + isDisabled + '>';
                            }
                        },
                        {
                            data: "name"
                        },
                        {
                            data: "status",
                            render: function(data, type, row) {
                                var color = '';
                                if (data === 'Accepted') {
                                    color = 'green';
                                    row.status =
                                        'Accepted';
                                } else if (data === 'On Progress') {
                                    color = 'orange';
                                } else if (data === 'Rejected') {
                                    color = 'red';
                                }
                                return '<span style="border: 2px solid ' + color +
                                    '; background-color: ' + color +
                                    '; color: white; padding: 2px 5px; border-radius: 4px;">' +
                                    data + '</span>';
                            }
                        },
                        {
                            data: "status",
                            visible: false,
                            render: function(data, type, row) {
                                if (data === 'Accepted') {
                                    return 1;
                                } else if (data === 'On Progress') {
                                    return 2;
                                } else if (data === 'Rejected') {
                                    return 3;
                                }
                                return 4;
                            }
                        }
                    ],
                    order: [
                        [3, 'asc']
                    ],
                    createdRow: function(row, data, dataIndex) {
                        if (data.status === 'Rejected') {
                            $(row).addClass('bg-red-200');
                        }
                    },
                    initComplete: function(settings, json) {
                        this.api().columns().every(function() {
                            var column = this;
                            var input = $(
                                    '<input type="text" placeholder="Search" class="w-full p-1 text-sm border rounded" />'
                                )
                                .appendTo($(column.header()).empty())
                                .on('keyup change clear', function() {
                                    if (column.search() !== this.value) {
                                        column.search(this.value).draw();
                                    }
                                });
                        });
                    }
                });
            }

            document.addEventListener('click', function(event) {
                if (event.target.classList.contains('openUraianModal')) {
                    event.preventDefault();
                    selectedManajemenResikoId = event.target.getAttribute('data-manajemen-resiko-id');
                    selectedUraianID = event.target.getAttribute('data-uraian-id');
                    console.log('Manajemen Resiko ID:', selectedManajemenResikoId);
                    console.log('Uraian ID:', selectedUraianID);

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
                    if ($.fn.DataTable.isDataTable('#uraian-table')) {
                        $('#uraian-table').DataTable().ajax
                            .reload();
                    } else {
                        initializeUraianTable();
                    }
                }
            });

            if (open) {
                closeModal4.addEventListener('click', function() {
                    uraianModal.classList.add('hidden');
                });
            }
            if (closeModal4) {
                closeModal4.addEventListener('click', function() {
                    uraianModal.classList.add('hidden');
                });
            }

            if (openAdduraianModal) {
                openAdduraianModal.addEventListener('click', function() {
                    addUraianModal.classList.remove('hidden');
                });
            }

            if (cancelUraianBtn) {
                cancelUraianBtn.addEventListener('click', function() {
                    addUraianModal.classList.add('hidden');
                });
            }

            if (saveUraianBtn) {
                saveUraianBtn.addEventListener('click', function () {
                    const selectedUraian = [];
                    document.querySelectorAll('.uraian-checkbox:checked').forEach(function (checkbox) {
                        selectedUraian.push(checkbox.getAttribute('data-uraian-id')); // Ensure this attribute is the ID of the uraian
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
                        .then(response => {
                            if (!response.ok) {
                                throw new Error('Network response was not ok');
                            }
                            return response.json();
                        })
                        .then(data => {
                            if (data.success) {
                                console.log(selectedUraian);
                                Swal.fire({
                                    title: 'Berhasil!',
                                    text: 'Uraian berhasil disimpan!',
                                    icon: 'success',
                                    confirmButtonText: 'OK'
                                }).then(() => {
                                    uraianModal.classList.add('hidden');
                                    location.reload();
                                });
                            } else {
                                Swal.fire({
                                    title: 'Gagal!',
                                    text: 'Terjadi kesalahan saat menyimpan uraian.',
                                    icon: 'error',
                                    confirmButtonText: 'Coba Lagi'
                                });
                            }
                        })
                        .catch(error => {
                            console.error('Error:', error);
                            Swal.fire({
                                title: 'Kesalahan!',
                                text: 'Terjadi kesalahan saat menyimpan uraian.',
                                icon: 'error',
                                confirmButtonText: 'OK'
                            });
                        });
                    } else {
                        Swal.fire({
                            title: 'Peringatan!',
                            text: 'Pilih setidaknya satu uraian.',
                            icon: 'warning',
                            confirmButtonText: 'OK'
                        });
                    }
                });
            }

        });

        function hapusUraian(url) {
        Swal.fire({
            title: 'Apakah Anda yakin?',
            text: 'Item ini akan dihapus secara permanen!',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonColor: '#3085d6',
            confirmButtonText: 'Ya, hapus!',
            cancelButtonText: 'Batal'
        }).then((result) => {
            if (result.isConfirmed) {
                window.location.href = url;
            }
        });
    }
    </script>

</x-admin-layout>
