<x-admin-layout>
    <div class="flex justify-center mt-10">
        <div class="bg-white shadow-md rounded-lg p-6 w-full">
            <h1 class="text-2xl font-bold mb-6">Evaluasi Risiko</h1>
            <!-- Filter Form -->
            <form id="analisisResikoForm" action="{{ route('admin.evaluation.index') }}" method="GET">
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
                            <th class="px-6 py-3 text-middle text-xs font-medium text-gray-500 uppercase tracking-wider border-r border-gray-200"
                                style="width: 50px;">No</th>
                            <th class="px-6 py-3 text-middle text-xs font-medium text-gray-500 uppercase tracking-wider border-r border-gray-200"
                                style="width: 150px;">Proses Bisnis</th>
                            <th class="px-6 py-3 text-middle text-xs font-medium text-gray-500 uppercase tracking-wider border-r border-gray-200"
                                style="width: 150px;">Tim</th>
                            <th class="px-6 py-3 text-middle text-xs font-medium text-gray-500 uppercase tracking-wider border-r border-gray-200"
                                style="width: 200px;">Pernyataan Risiko</th>
                            <th class="px-6 py-4 text-middle text-xs font-medium text-gray-500 uppercase tracking-wider border-r border-gray-200"
                                style="width: 100px;">Jenis</th>
                            <th class="px-6 py-3 text-middle text-xs font-medium text-gray-500 uppercase tracking-wider border-r border-gray-200"
                                style="width: 100px;">Sumber</th>
                            <th class="px-6 py-3 text-middle text-xs font-medium text-gray-500 uppercase tracking-wider border-r border-gray-200"
                                style="width: 100px;">Kategori</th>
                            <th class="px-6 py-3 text-middle text-xs font-medium text-gray-500 uppercase tracking-wider border-r border-gray-200"
                                style="width: 150px;">Area Dampak</th>
                            <th class="px-6 py-3 text-middle text-xs font-medium text-gray-500 uppercase tracking-wider border-r border-gray-200"
                                style="width: 150px;">Penyebab</th>
                            <th class="px-6 py-3 text-middle text-xs font-medium text-gray-500 uppercase tracking-wider border-r border-gray-200"
                                style="width: 150px;">Dampak</th>
                            <th class="px-6 py-3 text-middle text-xs font-medium text-gray-500 uppercase tracking-wider border-r border-gray-200"
                                style="width: 200px;">Level Kemungkinan</th>
                            <th class="px-6 py-3 text-middle text-xs font-medium text-gray-500 uppercase tracking-wider border-r border-gray-200"
                                style="width: 200px;">Level Dampak</th>
                            <th class="px-6 py-3 text-middle text-xs font-medium text-gray-500 uppercase tracking-wider border-r border-gray-200"
                                style="width: 200px;">Level Risiko</th>
                            <th class="px-6 py-3 text-middle text-xs font-medium text-gray-500 uppercase tracking-wider border-r border-gray-200"
                                style="width: 200px;">Uraian</th>
                            <th class="px-6 py-3 text-middle text-xs font-medium text-gray-500 uppercase tracking-wider border-r border-gray-200"
                                style="width: 100px;">Efektivitas</th>
                            <th class="px-6 py-3 text-middle text-xs font-medium text-gray-500 uppercase tracking-wider border-r border-gray-200"
                                style="width: 100px;">Respon Resiko</th>
                            <th class="px-6 py-3 text-middle text-xs font-medium text-gray-500 uppercase tracking-wider border-r border-gray-200"
                                style="width: 100px;">Prioritas</th>
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

                        @if (is_null($ManajemenResiko->id_jenis_resiko) || is_null($ManajemenResiko->id_sumber_resiko) || is_null($ManajemenResiko->id_kategori_resiko) || is_null($ManajemenResiko->id_area_dampak) || is_null($ManajemenResiko->id_level_kemungkinan) || is_null($ManajemenResiko->id_level_dampak) || is_null($ManajemenResiko->id_matriks_analisis_resiko) || is_null($ManajemenResiko->id_uraian) || is_null($ManajemenResiko->efektivitas))
                            @continue
                        @endif
                        <form action="{{ route('admin.analisis.update', $ManajemenResiko->id) }}" method="POST">
                            @csrf
                            @method('PUT')
                            <tr>
                                <input type="hidden" name="manajemen_resiko_ids[]" value="{{ $ManajemenResiko->id }}">
                                <td class="px-6 py-4 whitespace-nowrap border-r border-gray-200">
                                    {{ $loop->iteration + (($manajemenResikos->currentPage() - 1) * $manajemenResikos->perPage()) }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap border-r border-gray-200">
                                    {{ $ManajemenResiko->prosesbisnis->name }}</td>
                                <td class="px-6 py-4 whitespace-nowrap border-r border-gray-200">
                                    {{ $ManajemenResiko->tim_project->name }}</td>
                                <td class="px-6 py-4 whitespace-nowrap border-r border-gray-200">
                                    {{ $ManajemenResiko->resiko->name }}</td>
                                <td class="px-6 py-4 whitespace-nowrap border-r border-gray-200">
                                    @if ($ManajemenResiko->jenisResiko)
                                        {{ $ManajemenResiko->jenisResiko->name }}
                                    @else<span class="text-red-500 text-center block">-</span>
                                    @endif
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap border-r border-gray-200">
                                    @if ($ManajemenResiko->sumberResiko)
                                        {{ $ManajemenResiko->sumberResiko->name }}
                                    @else<span class="text-red-500 text-center block">-</span>
                                    @endif
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap border-r border-gray-200">
                                    @if ($ManajemenResiko->kategoriResiko)
                                        {{ $ManajemenResiko->kategoriResiko->deskripsi }}
                                    @else<span class="text-red-500 text-center block">-</span>
                                    @endif
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap border-r border-gray-200">
                                    @if ($ManajemenResiko->areaDampak)
                                        {{ $ManajemenResiko->areaDampak->name }}
                                    @else<span class="text-red-500 text-center block">-</span>
                                    @endif
                                </td>

                                {{-- PENYEBAB --}}
                                <td class="px-6 py-4 whitespace-nowrap border-r border-gray-200">
                                    @if ($ManajemenResiko->id_penyebab)
                                        @php
                                            $penyebabIds = json_decode($ManajemenResiko->id_penyebab, true);
                                            $penyebabNames = \App\Models\Penyebab::whereIn('id', $penyebabIds)
                                                ->pluck('name')
                                                ->toArray();
                                        @endphp
                                        @foreach ($penyebabNames as $penyebab)
                                        <li class="list-disc">{{ $penyebab }}</li>
                                        @endforeach
                                    @else
                                        <span class="text-red-500 text-center block">-</span>
                                    @endif
                                </td>


                                {{-- DAMPAK --}}
                                <td class="px-6 py-4 whitespace-nowrap border-r border-gray-200">
                                    @if ($ManajemenResiko->id_dampak)
                                        @php
                                            $dampakIds = json_decode($ManajemenResiko->id_dampak, true);
                                            $dampakNames = \App\Models\Dampak::whereIn('id', $dampakIds)
                                                ->pluck('name')
                                                ->toArray();
                                        @endphp
                                        @foreach ($dampakNames as $dampak)
                                            <li class="list-disc">{{ $dampak }}</li>
                                        @endforeach
                                    @else
                                        <span class="text-red-500 text-center block">-</span>
                                    @endif
                                </td>

                                {{-- LEVEL KEMUNGKINAN --}}
                                <td class="px-6 py-4 whitespace-nowrap border-r border-gray-200">
                                    @if (!is_null($ManajemenResiko->id_level_kemungkinan))
                                        <span class="text-gray-700">
                                            {{ $levelKemungkinan->firstWhere('id', $ManajemenResiko->id_level_kemungkinan)->name ?? 'Tidak Ada Data' }}
                                        </span>
                                    @else
                                        <span class="text-black text-center block">-</span>
                                    @endif
                                </td>


                               {{-- LEVEL DAMPAK --}}
                                <td class="px-6 py-4 whitespace-nowrap border-r border-gray-200">
                                    @if (!is_null($ManajemenResiko->id_level_dampak))
                                        <span class="text-gray-700">
                                            {{ $levelDampak->firstWhere('id', $ManajemenResiko->id_level_dampak)->name ?? 'Tidak Ada Data' }}
                                        </span>
                                    @else
                                        <span class="text-black text-center block">-</span>
                                    @endif
                                </td>


                                {{-- LEVEL RESIKO --}}
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
                                        <span class="text-black text-center block">-</span>
                                    @else
                                        {{ $ManajemenResiko->matriksAnalisisResiko->hasil_level_resiko ?? 'Level Resiko Tidak Ditemukan' }}
                                    @endif
                                </td>

                                {{-- URAIAN --}}
                                <td class="px-6 py-4 whitespace-nowrap border-r border-gray-200">
                                    @if ($ManajemenResiko->id_uraian)
                                        @php
                                            $uraianIds = json_decode($ManajemenResiko->id_uraian, true);
                                            $uraianNames = \App\Models\Uraian::whereIn('id', $uraianIds)
                                                ->pluck('name')
                                                ->toArray();
                                        @endphp
                                        @foreach ($uraianNames as $uraian)
                                            <li class="list-disc">{{ $uraian }}</li>
                                        @endforeach
                                    @else
                                        <span class="text-red-500 text-center block">-</span>
                                    @endif
                                </td>


                                {{-- EFEKTIVITAS --}}
                                <td class="px-6 py-4 whitespace-nowrap border-r border-gray-200">
                                    @if (is_null($ManajemenResiko->efektivitas))
                                        <span class="text-black text-center block">-</span>
                                    @else
                                        <span class="text-black">{{ $ManajemenResiko->efektivitas }}</span>
                                    @endif
                                </td>


                           {{-- RESPON RESIKO --}}
                            @if (auth()->check() && (auth()->user()->hasRole('admin') || auth()->user()->hasRole('ketua_tim')))
                            <td class="px-6 py-4 whitespace-nowrap border-r border-gray-200">
                                <select class="form-select pr-8 py-2 border rounded-lg" onchange="updatePrioritas(this)" id="responResiko{{ $ManajemenResiko->id }}">
                                    <option value="">-- Pilih Respon Risiko --</option>
                                    <option value="Mengurangi Risiko" {{ $ManajemenResiko->respon_resiko == 'Mengurangi Risiko' ? 'selected' : '' }}>Mengurangi Risiko</option>
                                    <option value="Mengalihkan Risiko" {{ $ManajemenResiko->respon_resiko == 'Mengalihkan Risiko' ? 'selected' : '' }}>Mengalihkan Risiko</option>
                                    <option value="Menghindari Risiko" {{ $ManajemenResiko->respon_resiko == 'Menghindari Risiko' ? 'selected' : '' }}>Menghindari Risiko</option>
                                    <option value="Menerima Risiko" {{ $ManajemenResiko->respon_resiko == 'Menerima Risiko' ? 'selected' : '' }}>Menerima Risiko</option>
                                </select>
                            </td>
                            @endif

                            {{-- PRIORITAS --}}
                            <td class="px-6 py-4 whitespace-nowrap border-r border-gray-200 text-center">
                                <span id="prioritas{{ $ManajemenResiko->id }}" class="text-center">
                                    @if ($ManajemenResiko->respon_resiko == 'Mengurangi Risiko')
                                        1
                                    @elseif ($ManajemenResiko->respon_resiko == 'Mengalihkan Risiko')
                                        2
                                    @elseif ($ManajemenResiko->respon_resiko == 'Menghindari Risiko')
                                        3
                                    @elseif ($ManajemenResiko->respon_resiko == 'Menerima Risiko')
                                        4
                                    @else
                                        -
                                    @endif
                                </span> <!-- Nilai prioritas akan ditampilkan sesuai respon risiko -->
                            </td>
                    @endforeach
                    @endif
                </table>
            </div>
        </div>
        <div class="flex justify-center mt-4">
            {{ $manajemenResikos->links() }}
        </div>
    </div>


    <script>
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

        function updatePrioritas(selectElement) {
            const rowId = selectElement.id.replace('responResiko', ''); // Mendapatkan ID dari baris
            const prioritasElement = document.getElementById('prioritas' + rowId);

            // Mengirim data ke server melalui AJAX
            fetch(`/update-respon-resiko/${rowId}`, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                },
                body: JSON.stringify({
                    respon_resiko: selectElement.value,
                }),
            })
            .then(response => response.json())
            .then(data => {
                if (data.prioritas) {
                    // Update elemen prioritas dengan nilai yang baru dari server
                    prioritasElement.textContent = data.prioritas;
                } else {
                    prioritasElement.textContent = '-';
                }
            })
            .catch(error => console.error('Error:', error));
        }

    </script>



</x-admin-layout>
