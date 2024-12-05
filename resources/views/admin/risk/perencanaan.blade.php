<x-admin-layout>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

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
                        @php $counter = 1; @endphp

                        @foreach ($manajemenResikos as $ManajemenResiko)
                            @if ($ManajemenResiko->prioritas == 1 || $ManajemenResiko->prioritas == 2)
                                <tr>
                                    <td class="px-6 py-4 text-center border-r border-gray-200">{{ $counter }}</td>
                                    <td class="px-6 py-4 text-center border-r border-gray-200">
                                        {{ $ManajemenResiko->prioritas }}</td>
                                    <td class="px-6 py-4 border-r border-gray-200">{{ $ManajemenResiko->resiko->name }}
                                    </td>
                                    <td class="px-6 py-4 text-center border-r border-gray-200"></td>
                                    <td class="px-6 py-4 text-center border-r border-gray-200"></td>
                                    <td class="px-6 py-4 text-center border-r border-gray-200">
                                        <button
                                            class="inline-block p-2 rounded-md border border-blue-500 text-blue-500 hover:bg-blue-100 openModal"
                                            data-id="{{ $ManajemenResiko->id }}">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 24 24"
                                                fill="currentColor">
                                                <path
                                                    d="M11.293 2.293a1 1 0 011.414 0l8.586 8.586a1 1 0 010 1.414L11 22H3v-8l8.293-8.293zM13 4L4 13v2h2L20 6l-7-2zm-9 13.5V21h3.5L17 10.5l-3-3L4 17.5z" />
                                            </svg>
                                        </button>
                                    </td>
                                </tr>
                                @php $counter++; @endphp
                            @endif
                        @endforeach
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
                        <div class="mb-4 deskripsi-rtp">
                            <!-- Deskripsi RTP -->
                        </div>
                        <div class="mb-4 flex justify-start gap-4">
                            <button class="bg-blue-500 text-white px-4 py-2 rounded-md hover:bg-blue-600"
                                onclick="refreshTable()">
                                Refresh
                            </button>

                            <button class="bg-green-500 text-white px-4 py-2 rounded-md hover:bg-green-600"
                                onclick="openTambahModal()">
                                Tambah
                            </button>
                        </div>

                        <table class="w-full border-collapse border border-gray-300" id="rtpTable">
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
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>


            <!-- Modal Tambah Perencanaan -->
            <div id="tambahModal"
                class="fixed inset-0 hidden flex items-center justify-center z-50 bg-transparent bg-opacity-50">

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
                        <form id="tambahRtp" action="{{ route('admin.perencanaan.store') }}" method="POST" onsubmit="return validateForm()">
                            @csrf
                            <div class="grid grid-cols-2 gap-4">
                                <!-- RTP -->
                                <div>
                                    <label for="rtp" class="block text-sm font-medium">RTP</label>
                                    <input id="rtp" name="name" type="text"
                                        class="w-full border border-gray-300 rounded-md px-3 py-2"
                                        placeholder="Rencana Tindak Penanganan">
                                </div>
                                <!-- Target Output -->
                                <div>
                                    <label for="targetOutput" class="block text-sm font-medium">Target Output</label>
                                    <input id="targetOutput" name="target_output" type="text"
                                        class="w-full border border-gray-300 rounded-md px-3 py-2"
                                        placeholder="Target Output">
                                </div>
                                <!-- Penanggung Jawab -->
                                <div>
                                    <label for="penanggungJawab" class="block text-sm font-medium">Penanggung
                                        Jawab</label>
                                    <select id="penanggungJawab" name="id_data_pegawai"
                                        class="w-full border border-gray-300 rounded-md px-3 py-2">
                                        <option value="">-- Pilih Penanggung Jawab --</option>
                                        @foreach ($dataPegawai as $pegawai)
                                            <option value="{{ $pegawai->id }}">{{ $pegawai->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <!-- Target Waktu -->
                                <div>
                                    <label for="targetWaktu" class="block text-sm font-medium">Target Waktu</label>
                                    <input id="targetWaktu" name="target_waktu" type="date"
                                        class="w-full border border-gray-300 rounded-md px-3 py-2">
                                </div>
                                <!-- Level Kemungkinan -->
                                <div class="hidden">
                                    <label for="levelKemungkinan" class="block text-sm font-medium">Level
                                        Kemungkinan</label>
                                    <input type="text" name="id_level_kemungkinan" value="">
                                </div>
                                <!-- Level Dampak -->
                                <div class="hidden">
                                    <label for="levelDampak" class="block text-sm font-medium">Level Dampak</label>
                                    <input type="text" name="id_level_dampak" value="">
                                </div>
                                <!-- Besaran Risiko -->
                                <div class="hidden">
                                    <label for="besaranRisiko" class="block text-sm font-medium">Besaran
                                        Risiko</label>
                                    <input type="text" name="id_matriks_analisis_resiko" value="">
                                </div>
                                <!-- manajemen resiko -->
                                <div class="hidden">
                                    <label for="manajemenResiko" class="block text-sm font-medium">manajemen
                                        resiko</label>
                                    <input type="text" name="id_manajemen_resiko" value="">
                                </div>
                            </div>
                            <div class="mt-6 flex justify-end">
                                <button type="submit"
                                    class="bg-green-500 text-white px-4 py-2 rounded-md hover:bg-green-600">SAVE</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>



            <!-- Modal Edit -->
            <div id="editHandlingPlanModal"
                class="fixed inset-0 hidden flex items-center justify-center z-50 bg-transparent bg-opacity-50">
                <!-- Overlay -->
                <div class="fixed inset-0 bg-black opacity-50"></div>

                <div class="relative bg-white rounded-lg shadow-lg w-2/3">
                    <!-- Header -->
                    <div
                        class="flex justify-between items-center bg-gray-100 px-6 py-4 rounded-t-lg border-b border-gray-300">
                        <h2 class="text-xl font-bold">EDIT PERENCANAAN</h2>
                        <button class="text-red-500 hover:text-red-700 font-bold text-2xl"
                            onclick="closeEditHandlingPlanModal()">✖</button>
                    </div>

                    <!-- Content -->
                    <div class="p-6">
                        <form id="editForm" method="POST">
                            @csrf
                            @method('PUT')
                            <!-- Rencana Tindak Penanganan -->
                            <div>
                                <label for="rtpEdit" class="block text-sm font-bold mb-2">Rencana Tindak Penanganan
                                    (RTP)</label>
                                <input id="rtpEdit" type="text"
                                    class="w-full px-3 py-2 border border-gray-300 rounded focus:outline-none focus:ring-2 focus:ring-blue-500"
                                    placeholder="Rencana Tindak Penanganan">
                            </div>
                            <!-- Target Output -->
                            <div>
                                <label for="targetOutputEdit" class="block text-sm font-bold mb-2">Target
                                    Output</label>
                                <input id="targetOutputEdit" type="text"
                                    class="w-full px-3 py-2 border border-gray-300 rounded focus:outline-none focus:ring-2 focus:ring-blue-500"
                                    placeholder="Target Output">
                            </div>
                            <!-- Penanggung Jawab -->
                            <div>
                                <label for="penanggungJawabEdit" class="block text-sm font-bold mb-2">Penanggung
                                    Jawab</label>
                                <select name="id_data_pegawai" id="penanggungJawabEdit" class="form-control">
                                    <option value="">-- Pilih Penanggung Jawab --</option>
                                    @foreach ($dataPegawai as $pegawai)
                                        <option value="{{ $pegawai->id }}">{{ $pegawai->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <!-- Target Waktu -->
                            <div>
                                <label for="targetWaktuEdit" class="block text-sm font-bold mb-2">Target Waktu</label>
                                <input id="targetWaktuEdit" type="date"
                                    class="w-full px-3 py-2 border border-gray-300 rounded focus:outline-none focus:ring-2 focus:ring-blue-500">
                            </div>
                        </form>
                        <!-- Tombol -->
                        <div class="flex justify-left mt-6">
                            <button
                                class="bg-green-500 text-white px-12 py-2 rounded font-bold hover:bg-green-600 focus:outline-none focus:ring-2 focus:ring-green-500"
                                onclick="saveEditHandlingPlan()">SAVE</button>
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


    <script>
        document.addEventListener('DOMContentLoaded', function() {
            document.querySelectorAll('.openModal').forEach(function(button) {
                button.addEventListener('click', function() {
                    const selectedId = button.getAttribute('data-id');

                    // Ambil data deskripsi RTP
                    fetch('/getmanajemen/' + selectedId)
                        .then(response => response.json())
                        .then(data => {
                            document.querySelector('.deskripsi-rtp').innerHTML = `
                            <p><strong>Resiko:</strong> ${data.resiko}</p>
                            <p><strong>Level Kemungkinan:</strong> ${data.levelKemungkinan || '-'}</p>
                            <p><strong>Level Dampak:</strong> ${data.levelDampak || '-'}</p>
                            <p><strong>Besaran Risiko:</strong> ${data.matriksAnalisisResiko || '-'}</p>
                        `;

                            document.querySelector('input[name="id_level_kemungkinan"]').value =
                                data.level_kemungkinan || '-';
                            document.querySelector('input[name="id_level_dampak"]').value = data
                                .level_dampak || '-';
                            document.querySelector('input[name="id_matriks_analisis_resiko"]')
                                .value = data.matriksAnalisisResiko || '-';
                            document.querySelector('input[name="id_manajemen_resiko"]').value =
                                data.idManajemenResiko || '-';
                        });

                    // Ambil data tabel
                    fetch('/getmanajemenDetail/' + selectedId)
                        .then(response => response.json())
                        .then(data => {
                            const tbody = document.querySelector('#rtpTable tbody');
                            tbody.innerHTML = ''; // Kosongkan tabel terlebih dahulu
                            //ubah data menjadi array
                            data = Object.values(data);
                            console.log(data[0]);
                            if (data[0].length === 0) {
                                const tr = document.createElement('tr');
                                tr.innerHTML = `
                                <td class="border border-gray-300 px-2 py-1 text-center" colspan="9">Tidak ada data</td>
                            `;
                                tbody.appendChild(tr);
                            } else {

                                if (Array.isArray(data) && data.length > 0) {
                                    data[0].forEach((item, index) => {
                                        const tr = document.createElement('tr');
                                        tr.innerHTML = `
                                            <td class="border border-gray-300 px-2 py-1">${index + 1}</td>
                                            <td class="border border-gray-300 px-2 py-1">${item.name}</td>
                                            <td class="border border-gray-300 px-2 py-1">${item.target_output}</td>
                                            <td class="border border-gray-300 px-2 py-1">${item.target_waktu}</td>
                                            <td class="border border-gray-300 px-2 py-1">${item.id_data_pegawai}</td>
                                            <td class="border border-gray-300 px-2 py-1">${item.id_level_kemungkinan}</td>
                                            <td class="border border-gray-300 px-2 py-1">${item.id_level_dampak}</td>
                                            <td class="border border-gray-300 px-2 py-1">${item.id_matriks_analisis_resiko}</td>
                                            <td class="border border-gray-300 px-2 py-1 text-center">
                                                <button
                                                    class="bg-blue-500 text-white px-2 py-1 rounded-md hover:bg-blue-600"
                                                    data-rtp='${JSON.stringify(item)}'
                                                    onclick="openEditHandlingPlanModal(this)">
                                                    ✎
                                                </button>
                                                <button
                                                    class="bg-red-500 text-white px-2 py-1 rounded-md hover:bg-red-600"
                                                    onclick="deleteHandlingPlan(${item.id})">
                                                    🗑
                                                </button>
                                            </td>
                                        `;
                                        tbody.appendChild(tr);
                                    });
                                } else {
                                    console.error('Data yang diterima bukan array atau kosong:',
                                        data);
                                }

                            }
                        })
                        .catch(error => console.error('Error:', error));

                    // Tampilkan modal
                    openModal();
                });

            });
        });



        function validateForm() {
            let isValid = true;

            const rtp = document.getElementById('rtp');
            const targetOutput = document.getElementById('targetOutput');
            const penanggungJawab = document.getElementById('penanggungJawab');
            const targetWaktu = document.getElementById('targetWaktu');

            switch (true) {
            case !rtp.value:
                rtp.classList.add('border-red-500');
                alert('Rencana Tindak Penanganan harus diisi.');
                isValid = false;
                break;
            default:
                rtp.classList.remove('border-red-500');
            }

            switch (true) {
            case !targetOutput.value:
                targetOutput.classList.add('border-red-500');
                alert('Target Output harus diisi.');
                isValid = false;
                break;
            default:
                targetOutput.classList.remove('border-red-500');
            }

            switch (true) {
            case !penanggungJawab.value:
                penanggungJawab.classList.add('border-red-500');
                alert('Penanggung Jawab harus dipilih.');
                isValid = false;
                break;
            default:
                penanggungJawab.classList.remove('border-red-500');
            }

            switch (true) {
            case !targetWaktu.value:
                targetWaktu.classList.add('border-red-500');
                alert('Target Waktu harus diisi.');
                isValid = false;
                break;
            default:
                targetWaktu.classList.remove('border-red-500');
            }

            return isValid;
        }


        function closeModal() {
            document.getElementById('editModal').classList.add('hidden');
        }

        function openModal() {
            document.getElementById('editModal').classList.remove('hidden');

        }


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

        function openEditHandlingPlanModal(button) {
            const data = JSON.parse(button.getAttribute('data-rtp'));

            if (!data || !data.id_matriks_analisis_resiko) {
                console.error('Data tidak valid:', data);
                return;
            }
            document.getElementById('rtpEdit').value = data.name || '';
            document.getElementById('targetOutputEdit').value = data.target_output || '';
            document.getElementById('targetWaktuEdit').value = data.target_waktu || '';

            document.getElementById('editForm').action = `/perencanaan/${data.id}`;


            const penanggungJawabSelect = document.getElementById('penanggungJawabEdit');
            if (penanggungJawabSelect) {
                penanggungJawabSelect.value = data.id_data_pegawai || '';
            }

            document.getElementById('editHandlingPlanModal').classList.remove('hidden');
        }

        function closeEditHandlingPlanModal() {
            document.getElementById('editHandlingPlanModal').classList.add('hidden');
        }

        function saveEditHandlingPlan() {
            const rtp = document.getElementById('rtpEdit').value; // Nama rencana tindak penanganan
            const targetOutput = document.getElementById('targetOutputEdit').value; // Output target
            const targetWaktu = document.getElementById('targetWaktuEdit').value; // Waktu target
            const idDataPegawai = document.getElementById('penanggungJawabEdit').value; // ID pegawai yang bertanggung jawab
            const formData = {
                name: rtp,
                target_output: targetOutput,
                target_waktu: targetWaktu,
                id_data_pegawai: idDataPegawai
            };
            const formAction = document.getElementById('editForm').action;
                fetch(formAction, {
                        method: 'PUT',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                        },
                        body: JSON.stringify(formData)
                    })
                    .then(response => response.json())
                    .then(data => {
                        if (data.success === true) {
                            Swal.fire({
                                title: 'Berhasil!',
                                text: 'Data berhasil diperbarui!',
                                icon: 'success',
                                confirmButtonText: 'OK'
                            }).then(() => {
                                window.location.reload();
                            });
                        } else {
                            Swal.fire({
                                title: 'Gagal!',
                                text: 'Gagal memperbarui data: ' + (data.message || 'Tidak ada pesan error'),
                                icon: 'error',
                                confirmButtonText: 'Coba Lagi'
                            });
                        }
                    })
                    .catch(error => {
                        console.error('Error:', error);
                        Swal.fire({
                            title: 'Kesalahan!',
                            text: 'Terjadi kesalahan saat memperbarui data!',
                            icon: 'error',
                            confirmButtonText: 'OK'
                        });
                    });

        }

                        function deleteHandlingPlan(id) {
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
                            fetch(`/handling-plan/${id}`, {
                                method: 'DELETE',
                                headers: {
                                    'Content-Type': 'application/json',
                                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                                }
                            })
                            .then(response => {
                                if (response.ok) {
                                    Swal.fire({
                                        title: 'Berhasil!',
                                        text: 'Item berhasil dihapus.',
                                        icon: 'success',
                                        confirmButtonText: 'OK'
                                    }).then(() => {
                                        location.reload();
                                    });
                                } else {
                                    Swal.fire({
                                        title: 'Gagal!',
                                        text: 'Item gagal dihapus.',
                                        icon: 'error',
                                        confirmButtonText: 'OK'
                                    });
                                }
                            })
                            .catch(error => {
                                console.error('Error:', error);
                                Swal.fire({
                                    title: 'Kesalahan!',
                                    text: 'Terjadi kesalahan saat menghapus item.',
                                    icon: 'error',
                                    confirmButtonText: 'OK'
                                });
                            });
                        }
                    });
                }

    
    </script>
</x-admin-layout>
