<x-admin-layout>
    <div class="flex justify-center mt-10">
        <div class="bg-white shadow-md rounded-lg p-6 w-full">
            <h1 class="text-2xl font-bold mb-6">Identifikasi Risiko</h1>
            <!-- Filter Form -->
            <form id="identifikasiResikoForm" action="{{ route('admin.manajemenresiko.index') }}" method="GET">
                <div class="mb-4">
                    <label class="block text-gray-700 mb-2" for="tim-bidang">Tim/Bidang</label>
                    <select id="tim" name="tim" class="w-full p-2 border rounded-lg">
                        <option value="">-- Pilih Tim/Bidang --</option>
                        @foreach ($timProjects as $tim)
                            <option value="{{ $tim->id }}" {{ request('tim') == $tim->id ? 'selected' : '' }}>
                                {{ $tim->nama_team }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="mb-4">
                    <label class="block text-gray-700 mb-2" for="proses-bisnis">Proses Bisnis</label>
                    <select id="proses_bisnis" name="proses_bisnis" class="w-full p-2 border rounded-lg">
                        <option value="">-- Pilih Proses Bisnis --</option>
                        @foreach ($ProsesBisnis as $proses)
                            <option value="{{ $proses->id }}" {{ request('proses_bisnis') == $proses->id ? 'selected' : '' }}>
                                {{ $proses->proses_bisnis }}
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
            <div class="flex space-x-4">
                <button id="refreshBtn" class="bg-blue-500 text-white px-4 py-2 rounded-full border border-blue-500">Refresh</button>
                <button id="tambahresiko" class="bg-gray-500 text-white px-4 py-2 rounded-full border border-gray-500" disabled>Tambah Risiko</button>
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

                    @foreach ($ManajemenResiko as $ManajemenResiko)
                    <form action="{{ route('admin.manajemenrisiko.store') }}" method="POST">
                        @csrf
                        <tr>
                            <input type="hidden" name="manajemen_resiko_ids[]" value="{{ $ManajemenResiko->id }}">
                            <td class="px-6 py-4 whitespace-nowrap">{{ $loop->iteration }}</td>
                            <td class="px-6 py-4 whitespace-nowrap">{{ $ManajemenResiko->prosesbisnis->proses_bisnis }}</td>
                            <td class="px-6 py-4 whitespace-nowrap">{{ $ManajemenResiko->tim_project->nama_team }}</td>
                            <td class="px-6 py-4 whitespace-nowrap">{{ $ManajemenResiko->resiko->resiko }}</td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <p style="color: red" id="alertjenis{{ $ManajemenResiko->id }}"  {{ (is_null($ManajemenResiko->id_jenis_resiko))? "":"hidden" }} >Jenis Kosong</p>
                                <select name="jenis_resiko[]" class="form-select pr-8 py-2 border" id="jenisResiko{{ $ManajemenResiko->id }}" {{ (!is_null($ManajemenResiko->id_jenis_resiko))? "disabled":"hidden" }}>
                                    @foreach ($jenisResiko as $jenis)
                                        <option value="{{ $jenis->id }}" {{ $jenis->id == $ManajemenResiko->id_jenis_resiko? "selected":""}}> {{ $jenis->jenis_resiko }}</option>
                                    @endforeach
                                </select>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <p style="color: red" id="alertsumber{{ $ManajemenResiko->id }}"  {{ (is_null($ManajemenResiko->id_sumber_resiko))? "":"hidden" }}>Sumber Kosong</p>
                                <select name="sumber_resiko[]" class="form-select pr-8 py-2 border" id="sumberResiko{{ $ManajemenResiko->id }}"
                                    {{(!is_null($ManajemenResiko->id_sumber_resiko))? "disabled":"hidden" }}>
                                    @foreach ($sumberResiko as $sumber)
                                        <option value="{{ $sumber->id }}" {{ $sumber->id == $ManajemenResiko->id_sumber_resiko? "selected":"" }}>
                                            {{ $sumber->sumber_resiko }}
                                        </option>
                                    @endforeach
                                </select>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <p style="color: red" id="alertskategori{{ $ManajemenResiko->id }}" {{ (is_null($ManajemenResiko->id_kategori_resiko))? "":"hidden" }}>Kategori Kosong</p>
                                <select name="kategori_resiko[]" class="form-select pr-8 py-2 border" id="kategoriResiko{{ $ManajemenResiko->id }}"
                                    {{(!is_null($ManajemenResiko->id_kategori_resiko))? "disabled":"hidden" }}>
                                    @foreach ($kategoriResiko as $kategori)
                                        <option value="{{ $kategori->id }}" {{ $kategori->id == $ManajemenResiko->id_kategori_resiko? "selected":"" }}>
                                            {{ $kategori->deskripsi }}
                                        </option>
                                    @endforeach
                                </select>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <p style="color: red" id="alertarea{{ $ManajemenResiko->id }}" {{ (is_null($ManajemenResiko->id_area_dampak))? "":"hidden" }}>Area Kosong</p>
                                <select name="area_dampak[]" class="form-select pr-8 py-2 border" id="areadampak{{ $ManajemenResiko->id }}"
                                    {{(!is_null($ManajemenResiko->id_area_dampak))? "disabled":"hidden" }}>
                                    @foreach ($areaDampak as $area)
                                        <option value="{{ $area->id }}" {{ $area->id == $ManajemenResiko->id_area_dampak? "selected":"" }}>
                                            {{ $area->area_dampak }}
                                        </option>
                                    @endforeach
                                </select>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <button class="bg-blue-500 text-white px-4 py-2 rounded" id="openModal">Pilih Penyebab</button>
                                <div id="selectedPenyebab" class="mt-2"></div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <button class="bg-blue-500 text-white px-4 py-2 rounded" id="openModal2">Pilih Dampak</button>
                                <div id="selectedDampak" class="mt-2"></div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <a  class="bg-blue-500 text-white width-mt-2 px-3 py-2 rounded cursor-pointer" id="btnEdit" data-id="{{ $ManajemenResiko->id }}">Edit</a>
                                <button type="submit" class="bg-green-500 text-white px-2 py-1 rounded" id="saveidentificationBtn">Save</button>
                            </form>
                                <form action="{{ route('admin.manajemenrisiko.destroy', $ManajemenResiko->id) }}" method="POST" style="display:inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button class="bg-red-500 text-white width-mt-2 px-3 py-1 rounded cursor-pointer" type="submit" onclick="return confirm('Are you sure?')">Delete</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
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


    <!-- Modal Resiko Main-->
    <div class="modal fixed w-full h-full top-0 left-0 flex items-center justify-center hidden" id="resikoModal">
        <div class="modal-overlay absolute bg-blue-900 opacity-50"></div>
        <div class="modal-container bg-gray-100 md:max-w-4xl mx-auto md:h-4/5 rounded-lg shadow-lg z-50 overflow-y-auto " style="width: 1000px">
            <div class="modal-content py-4 text-left px-6">
                <div class="flex justify-between items-center pb-2">
                    <p class="text-xl font-bold">Pilih Resiko</p>
                    <div class="modal-close cursor-pointer z-50" id="closeModal" title="Tutup Modal">
                        <svg class="fill-current text-black" xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 18 18">
                            <path d="M14.53 3.47a.75.75 0 00-1.06 0L9 7.94 4.53 3.47a.75.75 0 00-1.06 1.06L7.94 9l-4.47 4.47a.75.75 0 001.06 1.06L9 10.06l4.47 4.47a.75.75 0 001.06-1.06L10.06 9l4.47-4.47a.75.75 0 000-1.06z"></path>
                        </svg>
                    </div>
                </div>
                <div class="flex justify-between items-center mb-4">
                    <input type="search" id="searchInput" placeholder="Masukkan kata kunci pencarian" class="w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm" />
                </div>
                <div class="flex justify-between mb-4">
                    <button id="refreshBtn" class="bg-gray-500 text-white px-4 py-2 rounded-md">Refresh</button>
                    <button id="addRowBtn" class="bg-blue-500 text-white px-4 py-2 rounded-md">Buat Baru</button>
                </div>
                <div class="mt-3">
                    <table id="resiko-table" class="min-w-full bg-white text-sm">
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
                    <button id="cancelBtn" class="bg-red-500 text-white px-4 py-2 rounded-md">Batal</button>
                    <button id="saveBtn" class="bg-green-500 text-white px-4 py-2 rounded-md">Simpan</button>
                </div>
            </div>
        </div>
    </div>

    {{-- <!-- Modal Tambah Resiko -> --}}
    <div id="addResikoModal" class="modal fixed w-full h-full top-0 left-0 flex items-center justify-center hidden">
        <div class="modal-overlay absolute w-full h-full bg-gray-900 opacity-50"></div>
        <div class="modal-container bg-white w-11/12 md:max-w-md mx-auto rounded-lg shadow-lg z-50 overflow-y-auto">
            <div class="modal-content py-4 text-left px-6">
                <!-- Title -->
                <div class="flex justify-between items-center pb-2">
                    <p class="text-xl font-bold">Tambah Resiko</p>
                    <div class="modal-close cursor-pointer z-50" id="closeAddModal" title="Tutup Modal">
                        <svg class="fill-current text-black" xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 18 18">
                            <path d="M14.53 3.47a.75.75 0 00-1.06 0L9 7.94 4.53 3.47a.75.75 0 00-1.06 1.06L7.94 9l-4.47 4.47a.75.75 0 001.06 1.06L9 10.06l4.47 4.47a.75.75 0 001.06-1.06L10.06 9l4.47-4.47a.75.75 0 000-1.06z"></path>
                        </svg>
                    </div>
                </div>
                <!-- Body -->
                <div>
                    <form id="addResikoForm">
                        <div class="mb-4">
                            <label for="resikoName" class="block text-sm font-medium text-gray-700">Nama Resiko</label>
                            <input type="text" id="resikoName" name="resikoName" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm" required>
                        </div>
                    </form>
                </div>
                <!-- Footer -->
                <div class="flex justify-end pt-2">
                    <button class="bg-red-500 text-white px-4 py-2 rounded-full" id="cancelAddResiko">Batal</button>
                    <button class="bg-green-500 text-white px-4 py-2 rounded-full" id="saveResikoBtn">Simpan</button>
                </div>
            </div>
        </div>
    </div>



    @include('admin.risk.components.modal-penyebab')
    @include('admin.risk.components.modal-dampak')




    <script>

    document.addEventListener('DOMContentLoaded', function () {
        const tambahResikoBtn = document.getElementById('tambahresiko');
        const timDropdown = document.getElementById('tim'); // Ganti dengan id dropdown tim Anda
        const prosesBisnisDropdown = document.getElementById('proses_bisnis'); // Ganti dengan id dropdown proses bisnis Anda
        const resikoModal = document.getElementById('resikoModal');
        const closeModalBtn = document.getElementById('closeModal');
        const simpanResikoBtn = document.getElementById('simpanResiko');
        const addResikoBtn = document.getElementById('addResikoBtn');
        const tambahResikoModal = document.getElementById('TambahresikoModal');
        const cancelResikoBtn = document.getElementById('cancelResikoBtn');

    // Fungsi untuk mengecek apakah kedua dropdown sudah dipilih
    function checkDropdowns() {
        console.log('Checking dropdown values:', timDropdown.value, prosesBisnisDropdown.value);
        if (timDropdown.value !== '' && prosesBisnisDropdown.value !== '') {
        tambahResikoBtn.disabled = false;
        tambahResikoBtn.style.backgroundColor = 'red';  // Change button color to red
    } else {
        tambahResikoBtn.disabled = true;
        }
    }

    timDropdown.addEventListener('change', checkDropdowns);
    prosesBisnisDropdown.addEventListener('change', checkDropdowns);




        /**
         * Risk Modal Script
        */

        var table = $('#resiko-table').DataTable({
            processing : true,
            serverSide: true,
            ajax: "{{ route('admin.getresikodata') }}", // Adjust with your route for fetching data
            columns: [
                {
                    data: "id",
                    render: function(data, type, row) {
                        // return '<input type="checkbox" class="row-checkbox" value="' + data + '">';
                        var isDisabled = (row.status === 'rejected' || row.status === 'onprogress') ? 'disabled' : '';
                        return '<input type="checkbox" class="row-checkbox" value="' + data + '" ' + isDisabled + '>';
                    }
                },
                { data: "resiko" },
                { data: "status" }
            ],
            initComplete: function() {
                // Adding search boxes to each column
                this.api().columns().every(function() {
                    var column = this;
                    var input = $('<input type="text" placeholder="Search" class="w-full text-sm p-1 border rounded" />')
                        .appendTo($(column.header()).empty())
                        .on('keyup change clear', function() {
                            if (column.search() !== this.value) {
                                column.search(this.value).draw();
                            }
                        });
                });
            }
        });



        document.querySelectorAll('#btnEdit').forEach(button => {
            button.addEventListener('click', () => {
                const jenisResiko = document.getElementById('jenisResiko' + button.dataset.id);
                const sumberResiko = document.getElementById('sumberResiko' + button.dataset.id);
                const kategoriResiko = document.getElementById('kategoriResiko' + button.dataset.id);
                const areaDampak = document.getElementById('areadampak' + button.dataset.id);

                const alertjenis = document.getElementById('alertjenis' + button.dataset.id);
                const alertsumber = document.getElementById('alertsumber' + button.dataset.id);
                const alertskategori = document.getElementById('alertskategori' + button.dataset.id);
                const alertarea = document.getElementById('alertarea' + button.dataset.id);


                jenisResiko.removeAttribute('disabled');
                sumberResiko.removeAttribute('disabled');
                kategoriResiko.removeAttribute('disabled');
                areaDampak.removeAttribute('disabled');

                jenisResiko.removeAttribute('hidden');
                sumberResiko.removeAttribute('hidden');
                kategoriResiko.removeAttribute('hidden');
                areaDampak.removeAttribute('hidden');

                alertjenis.setAttribute('hidden', true);
                alertsumber.setAttribute('hidden', true);
                alertskategori.setAttribute('hidden', true);
                alertarea.setAttribute('hidden', true);

            });
        });

        $('#selectAll').on('click', function() {
            var rows = table.rows({ 'search': 'applied' }).nodes();
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

            if(resikoName.trim() !== '') {
                // Optionally, you can send the data to the server via AJAX.
                // Example:

                $.ajax({
                    url: '{{ route('admin.resiko.store') }}',
                    method: 'POST',
                    data: {
                        resiko: resikoName,
                        _token: $('meta[name="csrf-token"]').attr('content') // Laravel CSRF token
                    },
                    success: function(response) {
                        // Handle success (e.g., add the new resiko to the table)
                        // $('#resiko-table tbody').append('<tr><td><input type="checkbox"></td><td>' + response.resiko + '</td><td>' + response.status + '</td></tr>');
                        $('#addResikoModal').addClass('hidden');
                        table.ajax.reload(null, false);
                    },
                    error: function(error) {
                        // Handle error
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
                tim: $('#tim').val(),
                proses_bisnis: $('#proses_bisnis').val()
            };
            console.log(selected);

            $.ajax({
                url: '{{ route('admin.manajemenresiko.initialstore') }}',
                type: 'POST',
                data: {
                    data : selected,
                    formValues: formValues,
                    _token: $('meta[name="csrf-token"]').attr('content')},

                success: function(response) {
                    if (response.errors) {
                        // Handle validation errors
                        console.log(response.errors);
                        // Display errors in the modal or elsewhere
                    } else if (response.success) {
                        // Handle successful submission
                        console.log(response.success);
                        // Close the modal and/or update the UI as needed
                        resikoModal.classList.add('hidden');
                        table.ajax.reload(null, false);
                    }
                },
                error: function(xhr) {
                    console.error('Error:', xhr.responseText);
                }
            });
        });





        // Tampilkan modal "Pilih Resiko"
        tambahResikoBtn.addEventListener('click', function () {
            resikoModal.classList.remove('hidden');
        });

        // Tutup modal "Pilih Resiko"
        closeModalBtn.addEventListener('click', function () {
            resikoModal.classList.add('hidden');
        });

        // Simpan resiko
        simpanResikoBtn.addEventListener('click', function () {
            const timProject = document.getElementById('tim_project').value;
            const prosesBisnis = document.getElementById('proses_bisnis').value;
            const resikoCheckboxes = document.querySelectorAll('.resiko-checkbox:checked');
            const resikoIds = Array.from(resikoCheckboxes).map(checkbox => checkbox.value);

            const riskData = {
                timProject: timProject,
                prosesBisnis: prosesBisnis,
                resikoIds: resikoIds
            };

            fetch('/manajemenresiko/store', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                },
                body: JSON.stringify(riskData)
            })
            .then(response => response.json())
            .then(data => {
                alert(data.message);
                // Optionally, refresh the table or add the new row dynamically
                resikoModal.classList.add('hidden');
            })
            .catch(error => {
                console.error('Error:', error);
            });
        });

        // Tampilkan modal "Tambah Resiko"
        addResikoBtn.addEventListener('click', function() {
            tambahResikoModal.classList.remove('hidden');
        });

        // Sembunyikan modal "Tambah Resiko"
        cancelResikoBtn.addEventListener('click', function() {
            tambahResikoModal.classList.add('hidden');
        });
    });





    // //SAVE RESIKO
    // document.addEventListener('DOMContentLoaded', function () {
    //     const saveRiskBtn = document.getElementById('saveRiskBtn');

    //     saveRiskBtn.addEventListener('click', function () {
    //         // Ambil data dari form
    //         const timProject = document.querySelector('select[name="tim_project"]').value;
    //         const prosesBisnis = document.querySelector('select[name="proses_bisnis"]').value;
    //         const resiko = document.querySelector('select[name="resiko"]').value;
    //         const jenisRisiko = document.querySelector('select[name="jenis_resiko[]"]').value;
    //         const sumberRisiko = document.querySelector('select[name="sumber_resiko[]"]').value;
    //         const kategoriRisiko = document.querySelector('select[name="kategori_resiko[]"]').value;
    //         const areaDampak = document.querySelector('select[name="area_dampak[]"]').value;

    //         const penyebab = Array.from(document.getElementById('selectedPenyebab').querySelectorAll('li')).map(li => li.textContent.replace('Destroy', '').trim());
    //         const dampak = Array.from(document.getElementById('selectedDampak').querySelectorAll('li')).map(li => li.textContent.replace('Destroy', '').trim());

    //         const riskData = {
    //             timProject: timProject,
    //             prosesBisnis: prosesBisnis,
    //             resiko: resiko,
    //             jenisRisiko: jenisRisiko,
    //             sumberRisiko: sumberRisiko,
    //             kategoriRisiko: kategoriRisiko,
    //             areaDampak: areaDampak,
    //             penyebab: penyebab,
    //             dampak: dampak
    //         };

    //         fetch('{{ route('admin.manajemenrisiko.store') }}', {
    //             method: 'POST',
    //             headers: {
    //                 'Content-Type': 'application/json',
    //                 'X-CSRF-TOKEN': '{{ csrf_token() }}'
    //             },
    //             body: JSON.stringify(riskData)
    //         })
    //         .then(response => response.json())
    //         .then(data => {
    //             alert(data.message);
    //             // Reset form after successful save
    //             document.getElementById('riskForm').reset();
    //             document.getElementById('selectedPenyebab').innerHTML = '';
    //             document.getElementById('selectedDampak').innerHTML = '';
    //         })
    //         .catch(error => {
    //             console.error('Error:', error);
    //         });
    //     });
    // });

    </script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.3/js/jquery.dataTables.min.js"></script>

    <script>
        $(document).ready(function() {
            $('#resiko-table').DataTable({
                "processing": true,
                "serverSide": true,
                "lengthChange": false, // Menyembunyikan "Show entries"
                "searching": false // Menyembunyikan kotak "Search"
                "pageLength": 10,      // Menampilkan 10 baris per halaman
                "paging": true
                "ajax": {
                    "url": "{{ url('/api/resiko') }}",
                    "type": "GET"
                },
                "columns": [
                    { "data": "id", "render": function(data, type, row) {
                        return '<input type="checkbox" class="resiko-checkbox" value="' + data + '" title="Pilih Resiko">';
                    }},
                    { "data": "resiko" },
                    { "data": "status" }
                ]
            });
        });
    </script>

    <!-- Include DataTables CSS -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.3/css/jquery.dataTables.min.css">

</x-admin-layout>
