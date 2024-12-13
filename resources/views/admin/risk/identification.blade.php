<x-admin-layout>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>


    <div class="flex justify-center mt-10">
        <div class="w-full p-6 bg-white rounded-lg shadow-md ">
            <h1 class="mb-6 text-2xl font-bold" id="cek">Identifikasi Risiko</h1>
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
            <div class="flex space-x-4">
                <button id="refreshIdentificationBtn"
                    class="px-4 py-2 text-white bg-blue-500 border border-blue-500 rounded-full">Refresh</button>
                @if ((auth()->check() && auth()->user()->hasRole('admin')) || auth()->user()->hasRole('ketua_tim'))
                    <button id="tambahresiko"
                        class="px-4 py-2 text-white bg-gray-500 border border-gray-500 rounded-full" disabled>Tambah
                        Risiko</button>
                @endif
            </div>
            <input type="text" id="searchInput" class="p-2 border rounded-lg" placeholder="Cari..." />
        </div>

        <div class="overflow-x-auto bg-white rounded-lg shadow-md">
            <table class="min-w-full border border-collapse border-gray-300" id="riskTable">
                <thead class="bg-gray-50">
                    <tr class="bg-gray-100 border border-gray-300">
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
                            class="px-6 py-3 text-xs font-medium tracking-wider text-gray-500 uppercase border border-gray-300 text-middle">
                            Jenis</th>
                        <th
                            class="px-6 py-3 text-xs font-medium tracking-wider text-gray-500 uppercase border border-gray-300 text-middle">
                            Sumber</th>
                        <th
                            class="px-6 py-3 text-xs font-medium tracking-wider text-gray-500 uppercase border border-gray-300 text-middle">
                            Kategori</th>
                        <th
                            class="px-6 py-3 text-xs font-medium tracking-wider text-gray-500 uppercase border border-gray-300 text-middle">
                            Area Dampak</th>
                        <th
                            class="px-6 py-3 text-xs font-medium tracking-wider text-gray-500 uppercase border border-gray-300 text-middle">
                            Penyebab</th>
                        <th
                            class="px-6 py-3 text-xs font-medium tracking-wider text-gray-500 uppercase border border-gray-300 text-middle">
                            Dampak</th>
                        @if ((auth()->check() && auth()->user()->hasRole('admin')) || auth()->user()->hasRole('ketua_tim'))
                            <th
                                class="px-6 py-3 text-xs font-medium tracking-wider text-gray-500 uppercase border border-gray-300 text-middle">
                                Action</th>
                        @endif
                    </tr>

                </thead>

                <tbody class="bg-white divide-y divide-gray-200">
                    @if ($manajemenResikos->isEmpty())
                        <tr>
                            <td colspan="15" class="py-4 text-center">
                                Data Tidak Ada
                            </td>
                        </tr>
                    @else
                        @foreach ($manajemenResikos as $ManajemenResiko)
                            <form action="{{ route('admin.manajemenrisiko.store') }}" method="POST">
                                @csrf
                                <tr class="bg-white border border-gray-300">
                                    <input type="hidden" name="manajemen_resiko_ids[]"
                                        value="{{ $ManajemenResiko->id }}">
                                    <td class="px-6 py-4 border border-gray-300 whitespace-nowrap">
                                        {{ $loop->iteration + (($manajemenResikos->currentPage() - 1) * $manajemenResikos->perPage()) }}</td>
                                    <td class="px-6 py-4 border border-gray-300 whitespace-nowrap">
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
                                    <td class="px-6 py-4 border border-gray-300 whitespace-nowrap">
                                        {{ $ManajemenResiko->resiko->name }}</td>
                                    <td class="px-6 py-4 border border-gray-300 whitespace-nowrap">
                                        <p style="color: black" class="text-center" id="alertjenis{{ $ManajemenResiko->id }}"
                                            {{ is_null($ManajemenResiko->id_jenis_resiko) ? '' : 'hidden' }}>-</p>
                                        <span id="jenisResikoText{{ $ManajemenResiko->id }}"
                                            {{ is_null($ManajemenResiko->id_jenis_resiko) ? 'hidden' : '' }}>
                                            {{ $ManajemenResiko->jenisResiko->name ?? '' }}
                                        </span>
                                        <select name="jenis_resiko[]" class="py-2 pr-8 border form-select"
                                            id="jenisResiko{{ $ManajemenResiko->id }}" style="display: none;">
                                            <option value="">-- Pilih Jenis Resiko --</option>
                                            @foreach ($jenisResiko as $jenis)
                                                <option value="{{ $jenis->id }}"
                                                    {{ $jenis->id == $ManajemenResiko->id_jenis_resiko ? 'selected' : '' }}>
                                                    {{ $jenis->name }}</option>
                                            @endforeach
                                        </select>
                                    </td>
                                    <td class="px-6 py-4 border border-gray-300 whitespace-nowrap">
                                        <p style="color: black" class="text-center" id="alertsumber{{ $ManajemenResiko->id }}"
                                            {{ is_null($ManajemenResiko->id_sumber_resiko) ? '' : 'hidden' }}>-</p>
                                        <span id="sumberResikoText{{ $ManajemenResiko->id }}"
                                            {{ is_null($ManajemenResiko->id_sumber_resiko) ? 'hidden' : '' }}>
                                            {{ $ManajemenResiko->sumberResiko ? $ManajemenResiko->sumberResiko->name : '' }}
                                        </span>
                                        <select name="sumber_resiko[]" class="py-2 pr-8 border form-select"
                                            id="sumberResiko{{ $ManajemenResiko->id }}" style="display: none;">
                                            <option value="">-- Pilih Sumber Resiko --</option>
                                            @foreach ($sumberResiko as $sumber)
                                                <option value="{{ $sumber->id }}"
                                                    {{ $sumber->id == $ManajemenResiko->id_sumber_resiko ? 'selected' : '' }}>
                                                    {{ $sumber->name }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </td>
                                    <td class="px-6 py-4 border border-gray-300 whitespace-nowrap">
                                        <p style="color: black" class="text-center" id="alertskategori{{ $ManajemenResiko->id }}"
                                            {{ is_null($ManajemenResiko->id_kategori_resiko) ? '' : 'hidden' }}>-</p>
                                        <span id="kategoriResikoText{{ $ManajemenResiko->id }}"
                                            {{ is_null($ManajemenResiko->id_kategori_resiko) ? 'hidden' : '' }}>
                                            {{ $ManajemenResiko->kategoriResiko ? $ManajemenResiko->kategoriResiko->deskripsi : 'N/A' }}
                                        </span>
                                        <select name="kategori_resiko[]" class="py-2 pr-8 border form-select"
                                            id="kategoriResiko{{ $ManajemenResiko->id }}" style="display: none;">
                                            <option value="">-- Pilih Kategori Resiko --</option>
                                            @if (!empty($kategoriResiko))
                                                @foreach ($kategoriResiko as $kategori)
                                                    <option value="{{ $kategori->id }}"
                                                        {{ $kategori->id == $ManajemenResiko->id_kategori_resiko ? 'selected' : '' }}>
                                                        {{ $kategori->deskripsi }}
                                                    </option>
                                                @endforeach
                                            @endif
                                        </select>
                                    </td>
                                    <td class="px-6 py-4 border border-gray-300 whitespace-nowrap">
                                        <p style="color: black" class="text-center" id="alertarea{{ $ManajemenResiko->id }}"
                                            {{ is_null($ManajemenResiko->id_area_dampak) ? '' : 'hidden' }}>-
                                        </p>
                                        <span id="areaDampakText{{ $ManajemenResiko->id }}"
                                            {{ is_null($ManajemenResiko->id_area_dampak) ? 'hidden' : '' }}>
                                            {{ $ManajemenResiko->areaDampak ? $ManajemenResiko->areaDampak->name : 'N/A' }}
                                        </span>
                                        <select name="area_dampak[]" class="py-2 pr-8 border form-select"
                                            id="areadampak{{ $ManajemenResiko->id }}" style="display: none;">
                                            <option value="">-- Pilih Area Dampak --</option>
                                            @if (isset($areaDampak) && count($areaDampak) > 0)
                                                @foreach ($areaDampak as $area)
                                                    <option value="{{ $area->id }}"
                                                        {{ $area->id == $ManajemenResiko->id_area_dampak ? 'selected' : '' }}>
                                                        {{ $area->name }}
                                                    </option>
                                                @endforeach
                                            @endif
                                        </select>
                                    </td>

                                    {{-- Penyebab --}}
                                    @if ((auth()->check() && auth()->user()->hasRole('admin')) || (auth()->user()->hasRole('ketua_tim') && optional(auth()->user()->pegawai)->team_id == $ManajemenResiko->activity->subteam->team_id))
                                        <td class="px-6 py-4 border border-gray-300 whitespace-nowrap">
                                            <div class="flex flex-col items-center">
                                                <!-- Tombol Pilih Penyebab dipusatkan -->
                                                <button class="px-4 py-2 text-white bg-blue-500 rounded openCauseModal"
                                                    data-manajemen-resiko-id="{{ $ManajemenResiko->id }}"
                                                    data-penyebab-id="{{ $ManajemenResiko->id_penyebab }}">
                                                    Pilih Penyebab
                                                </button>

                                                <!-- Daftar Penyebab, ditampilkan rata kiri di bawah tombol -->
                                                <div id="selectedPenyebab" class="w-full mt-4 text-left">
                                                    @php
                                                        // Decode the JSON string into a PHP array
                                                        $penyebabIds = json_decode($ManajemenResiko->id_penyebab, true);
                                                    @endphp

                                                    @if (is_array($penyebabIds) && count($penyebabIds) > 0)
                                                        <ul class="ml-4 text-gray-800 list-disc list-inside">
                                                            @foreach ($penyebabIds as $item)
                                                                @foreach ($penyebab as $penyebabItem)
                                                                    @if ($penyebabItem->id == $item)
                                                                        @php
                                                                            // Membuat variabel yang menyimpan id dampak dalam bentuk json tanpa id yang dipilih
                                                                            $penyebabHapus = array_diff($penyebabIds, [$item]);
                                                                        @endphp
                                                                        <li class="flex items-center justify-between">
                                                                            <span>{{ $penyebabItem->name }}</span>
                                                                            <a href="javascript:void(0);"
                                                                                class="ml-2 text-red-500 hover:text-red-700 hapus-penyebab"
                                                                                data-url="{{ url('/admin/manajemenresiko/hapuspenyebab/' . $ManajemenResiko->id . '/' . $item) }}">
                                                                                <i class="fas fa-trash-alt"></i>
                                                                            </a>
                                                                        </li>
                                                                    @endif
                                                                @endforeach
                                                            @endforeach
                                                        </ul>
                                                    @else
                                                        <!-- Jika tidak ada penyebab yang dipilih -->
                                                        <p class="ml-4 italic text-center text-black">-</p>
                                                    @endif
                                                </div>

                                            </div>
                                        </td>
                                    @else
                                        <td class="px-6 py-4 border border-gray-300 whitespace-nowrap">
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
                                                                        $penyebabHapus = array_diff($penyebabIds, [
                                                                            $item,
                                                                        ]);
                                                                    @endphp
                                                                    <li class="list-disc ">
                                                                        <span>{{ $penyebabItem->name }}</span>
                                                                    </li>
                                                                @endif
                                                            @endforeach
                                                        @endforeach
                                                    </ul>
                                                @else
                                                    <!-- Jika tidak ada penyebab yang dipilih -->
                                                    <p class="ml-4 italic text-center text-black">-
                                                    </p>
                                                @endif
                                            </div>
                                        </td>
                                    @endif


                                    {{-- Dampak --}}
                                    @if ((auth()->check() && auth()->user()->hasRole('admin')) || (auth()->user()->hasRole('ketua_tim') && optional(auth()->user()->pegawai)->team_id == $ManajemenResiko->activity->subteam->team_id))
                                        <td class="px-6 py-4 border border-gray-300 whitespace-nowrap">
                                            <div class="flex flex-col items-center">
                                                <!-- Tombol Pilih Dampak dipusatkan -->
                                                <button
                                                    class="px-4 py-2 text-white bg-blue-500 rounded openImpactModal"
                                                    data-manajemen-resiko-id="{{ $ManajemenResiko->id }}"
                                                    data-dampak-id="{{ $ManajemenResiko->id_dampak }}">
                                                    Pilih Dampak
                                                </button>

                                                <!-- Daftar Dampak, ditampilkan rata kiri di bawah tombol -->
                                                <div id="selectedDampak" class="w-full mt-4 text-left">
                                                    @php
                                                        // Decode the JSON string into a PHP array
                                                        $dampakIds = json_decode($ManajemenResiko->id_dampak, true);
                                                    @endphp

                                                    @if (is_array($dampakIds) && count($dampakIds) > 0)
                                                        <ul class="ml-4 text-gray-800 list-disc list-inside">
                                                            @foreach ($dampakIds as $item)
                                                                @foreach ($dampak as $dampakItem)
                                                                    @if ($dampakItem->id == $item)
                                                                        @php
                                                                            // Membuat variabel yang menyimpan id dampak dalam bentuk json tanpa id yang dipilih
                                                                            $dampakHapus = array_diff($dampakIds, [$item]);
                                                                        @endphp
                                                                        <li class="flex items-center justify-between">
                                                                            <span>{{ $dampakItem->name }}</span>
                                                                            <a href="javascript:void(0);"
                                                                                class="ml-2 text-red-500 hover:text-red-700 hapus-dampak"
                                                                                data-url="{{ url('/admin/manajemenresiko/hapusdampak/' . $ManajemenResiko->id . '/' . $item) }}">
                                                                                <i class="fas fa-trash-alt"></i>
                                                                            </a>
                                                                        </li>
                                                                    @endif
                                                                @endforeach
                                                            @endforeach
                                                        </ul>
                                                    @else
                                                        <!-- Jika tidak ada dampak yang dipilih -->
                                                        <p class="ml-4 italic text-center text-black">-</p>
                                                    @endif
                                                </div>

                                            </div>
                                        </td>
                                    @else
                                        <td class="px-6 py-4 border border-gray-300 whitespace-nowrap">
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
                                                                        <span>{{ $dampakItem->name }}</span>
                                                                    </li>
                                                                @endif
                                                            @endforeach
                                                        @endforeach
                                                    </ul>
                                                @else
                                                    <!-- Jika tidak ada dampak yang dipilih -->
                                                    <p class="ml-4 italic text-center text-black">-
                                                    </p>
                                                @endif
                                            </div>
                                        </td>
                                    @endif



                            @if (Auth::check() && Auth::user()->hasRole('admin'))
                                <td class="px-6 py-4 border border-gray-300 whitespace-nowrap">
                                    <a class="px-3 py-2 text-white bg-blue-500 rounded cursor-pointer width-mt-2 btnEdit"
                                        data-id="{{ $ManajemenResiko->id }}">Edit</a>
                                    <button type="submit" class="px-2 py-1 text-white bg-green-500 rounded"
                                        id="saveidentificationBtn">
                                        Save
                                    </button>
                                </form>

                                    <form action="{{ route('admin.manajemenrisiko.destroy', $ManajemenResiko->id) }}"
                                        method="POST" style="display:inline;" class="delete-form">
                                        @csrf
                                        @method('DELETE')
                                        <button class="px-3 py-1 text-white bg-red-500 rounded cursor-pointer width-mt-2 btnDelete"
                                            type="button" data-id="{{ $ManajemenResiko->id }}">Delete</button>
                                    </form>
                                </td>
                            @elseif (auth()->user()->hasRole('ketua_tim'))
                            @if ((optional(auth()->user()->pegawai)->id_tim == $ManajemenResiko->activity->subteam->tim_project_id))
                                <td class="px-6 py-4 border border-gray-300 whitespace-nowrap">
                                    <a class="px-3 py-2 text-white bg-blue-500 rounded cursor-pointer width-mt-2 btnEdit"
                                        data-id="{{ $ManajemenResiko->id }}">Edit</a>
                                    <button type="submit" class="px-2 py-1 text-white bg-green-500 rounded"
                                        id="saveidentificationBtn">Save</button>
                                </form>
                                    <form action="{{ route('admin.manajemenrisiko.destroy', $ManajemenResiko->id) }}"
                                        method="POST" style="display:inline;" class="delete-form">
                                        @csrf
                                        @method('DELETE')
                                        <button class="px-3 py-1 text-white bg-red-500 rounded cursor-pointer width-mt-2 btnDelete"
                                            type="button" data-id="{{ $ManajemenResiko->id }}">Delete</button>
                                    </form>
                                </td>
                            @else
                                <td class="px-6 py-4 border border-gray-300 whitespace-nowrap">
                                    <p class="text-center text-red-500">Tidak Memiliki Izin Beda TIM</p>
                                </td>
                            @endif
                        @endif

                                </tr>
                    @endforeach
                    @endif
                </tbody>
            </table>
        </div>
        <div class="flex justify-center mt-4">
            {{ $manajemenResikos->links() }}
        </div>
    </div>


    <!-- Modal Resiko Main-->
    <div class="fixed top-0 left-0 flex items-center justify-center hidden w-full h-full modal" id="resikoModal">
        <div class="absolute bg-blue-900 opacity-50 modal-overlay"></div>
        <div class="z-50 mx-auto overflow-y-auto bg-gray-100 rounded-lg shadow-lg modal-container md:max-w-4xl md:h-4/5 "
            style="width: 1000px">
            <div class="px-6 py-4 text-left modal-content">
                <div class="flex items-center justify-between pb-2">
                    <p class="text-xl font-bold">Pilih Resiko</p>
                    <div class="z-50 cursor-pointer modal-close" id="closeModal" title="Tutup Modal">
                        <svg class="text-black fill-current" xmlns="http://www.w3.org/2000/svg" width="16"
                            height="16" viewBox="0 0 18 18">
                            <path
                                d="M14.53 3.47a.75.75 0 00-1.06 0L9 7.94 4.53 3.47a.75.75 0 00-1.06 1.06L7.94 9l-4.47 4.47a.75.75 0 001.06 1.06L9 10.06l4.47 4.47a.75.75 0 001.06-1.06L10.06 9l4.47-4.47a.75.75 0 000-1.06z">
                            </path>
                        </svg>
                    </div>
                </div>
                <div class="flex items-center justify-between mb-4">
                    <input type="search" id="searchInput" placeholder="Masukkan kata kunci pencarian"
                        class="w-full border-gray-300 rounded-md shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm" />
                </div>
                <div class="flex justify-between mb-4">
                    <button id="refreshResikomodalBtn"
                        class="px-4 py-2 text-white bg-blue-500 rounded-md">Refresh</button>
                    <button id="addRowBtn" class="px-4 py-2 text-white bg-green-500 rounded-md">Buat Baru</button>
                </div>
                <div class="mt-3">
                    <table id="resiko-table" class="min-w-full text-sm bg-white">
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
                    <button id="cancelBtn" class="px-4 py-2 mr-2 text-white bg-red-500 rounded-md">Batal</button>
                    <button id="saveBtn" class="px-4 py-2 text-white bg-green-500 rounded-md">Simpan</button>
                </div>
            </div>

        </div>
    </div>

    {{-- <!-- Modal Tambah Resiko -> --}}
    <div id="addResikoModal" class="fixed top-0 left-0 flex items-center justify-center hidden w-full h-full modal">
        <div class="absolute w-full h-full bg-gray-900 opacity-50 modal-overlay"></div>
        <div class="z-50 w-11/12 mx-auto overflow-y-auto bg-white rounded-lg shadow-lg modal-container md:max-w-md">
            <div class="px-6 py-4 text-left modal-content">
                <!-- Title -->
                <div class="flex items-center justify-between pb-2">
                    <p class="text-xl font-bold">Tambah Resiko</p>
                    <div class="z-50 cursor-pointer modal-close" id="closeAddModal" title="Tutup Modal">
                        <svg class="text-black fill-current" xmlns="http://www.w3.org/2000/svg" width="16"
                            height="16" viewBox="0 0 18 18">
                            <path
                                d="M14.53 3.47a.75.75 0 00-1.06 0L9 7.94 4.53 3.47a.75.75 0 00-1.06 1.06L7.94 9l-4.47 4.47a.75.75 0 001.06 1.06L9 10.06l4.47 4.47a.75.75 0 001.06-1.06L10.06 9l4.47-4.47a.75.75 0 000-1.06z">
                            </path>
                        </svg>
                    </div>
                </div>
                <!-- Body -->
                <div>
                    <form id="addResikoForm">
                        <div class="mb-4">
                            <label for="resikoName" class="block text-sm font-medium text-gray-700">Nama
                                Resiko</label>
                            <input type="text" id="resikoName" name="resikoName"
                                class="block w-full mt-1 border-gray-300 rounded-md shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm"
                                required>
                        </div>
                    </form>
                </div>
                <!-- Footer -->
                <div class="flex justify-end pt-2">
                    <button class="px-4 py-2 mr-2 text-white bg-red-500 rounded-md"
                        id="cancelAddResiko">Batal</button>
                    <button class="px-4 py-2 text-white bg-green-500 rounded-md" id="saveResikoBtn">Simpan</button>
                </div>
            </div>
        </div>
    </div>



    @include('admin.risk.components.modal-penyebab')
    @include('admin.risk.components.modal-dampak')

    <script>
        // Mendapatkan status role dari Laravel blade
        var isAdmin = @json(auth()->user()->hasRole('admin'));
        var isKetuaTim = @json(auth()->user()->hasRole('ketua_tim'));
        var userTeamId = @json(optional(auth()->user()->pegawai)->id_tim);
    </script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            //resiko
            // Mendapatkan elemen tombol dan dropdown
            const tambahResikoBtn = document.getElementById('tambahresiko');
            const timDropdown = document.getElementById('tim'); // Dropdown Tim
            const subteamDropdown = document.getElementById('subteam'); // Dropdown Tim
            const prosesBisnisDropdown = document.getElementById('proses_bisnis'); // Dropdown Proses Bisnis
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
                    columns: [{
                            data: "id",
                            render: function(data, type, row) {
                                var isDisabled = (row.status === 'Rejected' || row.status ===
                                    'On Progress') ? 'disabled' : '';
                                var disabledColor = (row.status === 'Rejected') ? 'bg-red-500' : (
                                        row.status === 'On Progress') ? 'bg-orange-500' :
                                    'bg-green-500';
                                // Ensure proper comparison by converting to string
                                var isChecked = window.selectedPenyebabIds && window
                                    .selectedPenyebabIds.includes(String(data)) ?
                                    'checked disabled' : '';
                                console.log(row);
                                console.log(isChecked);
                                console.log(window.selectedPenyebabIds)
                                return '<input type="checkbox" class="penyebab-checkbox" data-penyebab-id="' +
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
                                    'Accepted'; // Add this line to modify the status value
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
                    order: [
                        [3, 'asc']
                    ], // Sort by the hidden status column in ascending order
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
                }); // Initialize DataTable
            }

            // Delegasi event listener untuk tombol "Pilih penyebab"
            document.addEventListener('click', function(event) {
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
                        $('#penyebab-table').DataTable().ajax
                    .reload(); // Reload data if DataTable is already initialized
                    } else {
                        initializePenyebabTable(); // Initialize DataTable if not yet initialized
                    }
                }
            });

            if (open) {
                closeModal3.addEventListener('click', function() {
                    penyebabModal.classList.add('hidden');
                });
            }
            if (closeModal3) {
                closeModal3.addEventListener('click', function() {
                    penyebabModal.classList.add('hidden');
                });
            }

            if (openAddCauseModal) {
                openAddCauseModal.addEventListener('click', function() {
                    addCauseModal.classList.remove('hidden');
                });
            }

            if (cancelCauseBtn) {
                cancelCauseBtn.addEventListener('click', function() {
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
                            fetch('{{ route('admin.manajemenresiko.savepenyebab') }}', {
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
                                    console.log(selectedPenyebab);
                                    Swal.fire({
                                        title: 'Berhasil!',
                                        text: 'Penyebab berhasil disimpan!',
                                        icon: 'success',
                                        confirmButtonText: 'OK'
                                    }).then(() => {
                                        penyebabModal.classList.add('hidden');
                                        location.reload();
                                    });
                                } else {
                                    Swal.fire({
                                        title: 'Gagal!',
                                        text: 'Terjadi kesalahan saat menyimpan penyebab.',
                                        icon: 'error',
                                        confirmButtonText: 'Coba Lagi'
                                    });
                                }
                            })
                            .catch(error => {
                                console.error('Error:', error);
                                Swal.fire({
                                    title: 'Kesalahan!',
                                    text: 'Terjadi kesalahan saat menyimpan penyebab.',
                                    icon: 'error',
                                    confirmButtonText: 'OK'
                                });
                            });
                        } else {
                            Swal.fire({
                                title: 'Peringatan!',
                                text: 'Pilih setidaknya satu penyebab.',
                                icon: 'warning',
                                confirmButtonText: 'OK'
                            });
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
                    columns: [{
                            data: "id",
                            render: function(data, type, row) {
                                var isDisabled = (row.status === 'Rejected' || row.status ===
                                    'On Progress') ? 'disabled' : '';
                                var disabledColor = (row.status === 'Rejected') ? 'bg-red-500' : (
                                        row.status === 'On Progress') ? 'bg-orange-500' :
                                    'bg-green-500';
                                // Ensure proper comparison by converting to string
                                var isChecked = window.selectedDampakIds && window.selectedDampakIds
                                    .includes(String(data)) ? 'checked disabled' : '';
                                console.log(row);
                                console.log(isChecked);
                                console.log(window.selectedDampakIds)
                                return '<input type="checkbox" class="dampak-checkbox" data-dampak-id="' +
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
                                    'Accepted'; // Add this line to modify the status value
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
                    order: [
                        [3, 'asc']
                    ], // Sort by the hidden status column in ascending order
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
                }); // Initialize DataTable
            }

            // Delegasi event listener untuk tombol "Pilih dampak"
            document.addEventListener('click', function(event) {
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
                        $('#dampak-table').DataTable().ajax
                    .reload(); // Reload data if DataTable is already initialized
                    } else {
                        initializeDampakTable(); // Initialize DataTable if not yet initialized
                    }
                }
            });

            if (closeModal2) {
                closeModal2.addEventListener('click', function() {
                    dampakModal.classList.add('hidden');
                });
            }

            if (openAddImpactModal) {
                openAddImpactModal.addEventListener('click', function() {
                    addImpactModal.classList.remove('hidden');
                });
            }

            if (cancelImpactBtn) {
                cancelImpactBtn.addEventListener('click', function() {
                    addImpactModal.classList.add('hidden');
                });
            }

            if (saveDampakBtn) {
                saveDampakBtn.addEventListener('click', function () {
                    const selectedDampak = [];
                    document.querySelectorAll('.dampak-checkbox:checked').forEach(function (checkbox) {
                        selectedDampak.push(checkbox.getAttribute('data-dampak-id')); // Pastikan atribut ini adalah ID dampak
                    });
                    console.log(selectedDampak);

                    if (selectedDampak.length > 0) {
                        fetch('{{ route('admin.manajemenresiko.savedampak') }}', {
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
                                console.log(selectedDampak);
                                Swal.fire({
                                    title: 'Berhasil!',
                                    text: 'Dampak berhasil disimpan!',
                                    icon: 'success',
                                    confirmButtonText: 'OK'
                                }).then(() => {
                                    dampakModal.classList.add('hidden');
                                    location.reload();
                                });
                            } else {
                                Swal.fire({
                                    title: 'Gagal!',
                                    text: 'Terjadi kesalahan saat menyimpan dampak.',
                                    icon: 'error',
                                    confirmButtonText: 'Coba Lagi'
                                });
                            }
                        })
                        .catch(error => {
                            console.error('Error:', error);
                            Swal.fire({
                                title: 'Kesalahan!',
                                text: 'Terjadi kesalahan saat menyimpan dampak.',
                                icon: 'error',
                                confirmButtonText: 'OK'
                            });
                        });
                    } else {
                        Swal.fire({
                            title: 'Peringatan!',
                            text: 'Pilih setidaknya satu dampak.',
                            icon: 'warning',
                            confirmButtonText: 'OK'
                        });
                    }
                });
            }

            // Fungsi untuk mengecek apakah kedua dropdown sudah dipilih dan memeriksa role
            function checkDropdowns() {
                console.log('Checking dropdown values:', timDropdown.value, prosesBisnisDropdown.value);
                console.log('isAdmin:', isAdmin, 'isKetuaTim:', isKetuaTim, 'userTeamId:', userTeamId);

                if (isAdmin) {
                    // Jika Admin, tombol hidup selama kedua dropdown terpilih
                    if (timDropdown.value !== '' && prosesBisnisDropdown.value !== '') {
                        tambahResikoBtn.disabled = false;
                        tambahResikoBtn.style.backgroundColor = 'red'; // Ubah warna tombol menjadi merah
                    } else {
                        tambahResikoBtn.disabled = true;
                        tambahResikoBtn.style.backgroundColor = 'gray'; // Kembali ke abu-abu
                    }
                } else if (isKetuaTim) {
                    // Jika Ketua Tim, hanya bisa memilih tim sendiri
                    if (parseInt(timDropdown.value) === parseInt(userTeamId) && prosesBisnisDropdown.value !== '') {
                        tambahResikoBtn.disabled = false;
                        tambahResikoBtn.style.backgroundColor = 'red'; // Tombol aktif
                    } else {
                        tambahResikoBtn.disabled = true;
                        tambahResikoBtn.style.backgroundColor = 'gray'; // Tombol nonaktif
                    }
                } else {
                    // Role lain tidak bisa menambah risiko
                    tambahResikoBtn.disabled = true;
                    tambahResikoBtn.style.backgroundColor = 'gray'; // Tombol tetap nonaktif
                }
            }

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

            // Menambahkan event listener untuk dropdown
            if (timDropdown && prosesBisnisDropdown) {
                // timDropdown.addEventListener('change', checkDropdowns);
                timDropdown.addEventListener('change', function () {
                    checkDropdowns();
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
            // Pengecekan awal saat halaman dimuat
            checkDropdowns();

            /**
             * Risk Modal Script
             */

            const resikoTable = $('#resiko-table').DataTable({
                processing: true,
                serverSide: true,
                ajax: "{{ route('admin.getresikodata') }}", // Adjust with your route for fetching data
                columns: [{
                        data: "id",
                        render: function(data, type, row) {
                            var isDisabled = (row.status === 'Rejected' || row.status ===
                                'On Progress') ? 'disabled' : '';
                            return '<input type="checkbox" class="row-checkbox" value="' + data +
                                '" ' + isDisabled + '>';
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
                            } else if (data === 'On Progress') {
                                color = 'orange';
                            } else if (data === 'Rejected') {
                                color = 'red';
                            }
                            return '<span style="border: 2px solid ' + color +
                                '; background-color: ' + color +
                                '; color: white; padding: 2px 5px; border-radius: 4px;">' + data +
                                '</span>';
                        }
                    }
                ],
                order: [
                    [2, 'asc']
                ], // Sort by status column in ascending order
                initComplete: function() {
                    // Adding search boxes to each column
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

                    if (jenisResiko && sumberResiko && kategoriResiko && areaDampak && alertjenis &&
                        alertsumber && alertskategori && alertarea) {
                        // Switch to edit mode
                        jenisResiko.style.display = 'inline'; // Show dropdown
                        sumberResiko.style.display = 'inline'; // Show dropdown
                        kategoriResiko.style.display = 'inline'; // Show dropdown
                        areaDampak.style.display = 'inline'; // Show dropdown

                        alertjenis.style.display = 'none'; // Hide text
                        alertsumber.style.display = 'none'; // Hide text
                        alertskategori.style.display = 'none'; // Hide text
                        alertarea.style.display = 'none'; // Hide text

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
                var rows = table.rows({
                    'search': 'applied'
                }).nodes();
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

                if (resikoName.trim() !== '') {
                    // Optionally, you can send the data to the server via AJAX.
                    // Example:

                    $.ajax({
                        url: '{{ route('admin.resiko.store') }}',
                        method: 'POST',
                        data: {
                            name: resikoName, // Ganti 'resiko' menjadi 'name'
                            _token: $('meta[name="csrf-token"]').attr('content') // Laravel CSRF token
                        },
                        success: function(response) {
                            // Handle success (e.g., add the new resiko to the table)
                            $('#addResikoModal').addClass('hidden');

                            table.ajax.reload(null, false);
                        },
                        error: function(error) {
                            // Handle error
                            console.error('Error:', error);
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
                    activity: $('#activity').val(),
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
                tambahResikoBtn.addEventListener('click', function() {
                    resikoModal.classList.remove('hidden');
                });
            } else {
                console.error('Element not found: tambahResikoBtn');
            }

            // Tutup modal "Pilih Resiko"
            if (closeModalBtn) {
                closeModalBtn.addEventListener('click', function() {
                    resikoModal.classList.add('hidden');
                });
            } else {
                console.error('Element not found: closeModalBtn');
            }


        });


        document.addEventListener('DOMContentLoaded', function () {
        const deleteLinks = document.querySelectorAll('.hapus-penyebab');

        deleteLinks.forEach(link => {
            link.addEventListener('click', function (e) {
                e.preventDefault();

            const url = this.getAttribute('data-url');

            Swal.fire({
                title: 'Konfirmasi',
                text: 'Anda yakin ingin menghapus item ini?',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Ya, hapus!',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location.href = url;
                }
            });
        });
    });
});


document.addEventListener('DOMContentLoaded', function () {
    const deleteLinks = document.querySelectorAll('.hapus-dampak');

    deleteLinks.forEach(link => {
        link.addEventListener('click', function (e) {
            e.preventDefault();

            const url = this.getAttribute('data-url');

            Swal.fire({
                title: 'Konfirmasi',
                text: 'Anda yakin ingin menghapus item ini?',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Ya, hapus!',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location.href = url;
                }
            });
        });
    });
});

document.addEventListener('DOMContentLoaded', function () {
    const deleteButtons = document.querySelectorAll('.btnDelete');

    deleteButtons.forEach(button => {
        button.addEventListener('click', function (e) {
            e.preventDefault();

            const form = this.closest('.delete-form');
            const manajemenResikoId = this.getAttribute('data-id');

            Swal.fire({
                title: 'Konfirmasi',
                text: `Anda yakin ingin menghapus Manajemen Risiko dengan ID ${manajemenResikoId}?`,
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Ya, hapus!',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {
                    form.submit();
                }
            });
        });
    });
});



    </script>


</x-admin-layout>
