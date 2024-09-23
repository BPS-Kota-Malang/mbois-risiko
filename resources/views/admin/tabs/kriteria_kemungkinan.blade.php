<!-- Include jQuery and DataTables CSS & JS files -->
<link rel="stylesheet" href="https://cdn.datatables.net/1.11.3/css/jquery.dataTables.min.css">
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.datatables.net/1.11.3/js/jquery.dataTables.min.js"></script>

<!-- Blade HTML content -->
<div id="context10" class="tab-content hidden">
    <section class="bg-white">
        <div class="-my-2 py-2 overflow-x-auto sm:-mx-6 sm:px-6 lg:-mx-8 lg:px-8">
            <div class="align-middle inline-block min-w-full shadow overflow-hidden sm:rounded-lg border-b border-gray-200">

                <!-- Filter Form -->
                <form method="GET" action="#" class="mb-4">
                    <div class="flex items-end space-x-4">
                        <div class="relative w-48">
                            <label class="block text-gray-700 mb-2" for="filter_kategori_resiko">Filter Kategori Resiko</label>
                            <select name="filter_kategori_resiko" id="filter_kategori_resiko"
                                class="block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                                <option value="">Semua Kategori</option>
                                @foreach ($kategoriResiko as $kategori)
                                    <option value="{{ $kategori->deskripsi }}">{{ $kategori->deskripsi }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="flex flex-col justify-end">
                            <button type="button" id="filterButton"
                                class="px-4 py-2 bg-blue-500 rounded-md text-white font-medium tracking-wide hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-opacity-50 transition duration-300">
                                Filter
                            </button>
                        </div>
                    </div>
                </form>

                <div class="flex justify-end">
                    @if (auth()->check() && auth()->user()->hasRole('admin'))
                    <!-- Add Button -->
                    <button id="openTambahKriteriaKemungkinanModal" class="px-4 py-2 mb-2 bg-blue-500 rounded-md text-white font-medium tracking-wide hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-opacity-50 transition duration-300">
                        Tambah Kriteria Kemungkinan
                    </button>
                    @endif
                </div>

                <!-- DataTable -->
                <table id="riskTable" class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-medium text-black-500 uppercase tracking-wider">No</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-black-500 uppercase tracking-wider">Kategori Resiko</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-black-500 uppercase tracking-wider">Level Kemungkinan</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-black-500 uppercase tracking-wider">Presentase Kemungkinan</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-black-500 uppercase tracking-wider">Jumlah Frekuensi</th>
                            @if (auth()->check() && auth()->user()->hasRole('admin'))
                            <th class="px-6 py-3 text-center text-xs font-medium text-black-500 uppercase tracking-wider">Actions</th>
                            @endif
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @foreach ($kriteriaKemungkinan as $kriteria)
                            <tr>
                                <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-200">{{ $loop->iteration }}</td>
                                <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-200">{{ $kriteria->kategoriResiko->deskripsi }}</td>
                                <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-200">{{ $kriteria->levelKemungkinan->level_kemungkinan }}</td>
                                <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-200">{{ $kriteria->presentase_kemungkinan }}</td>
                                <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-200">{{ $kriteria->jumlah_frekuensi }}</td>
                                @if (auth()->check() && auth()->user()->hasRole('admin'))
                                <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-200 text-center">
                                    <div class="inline-flex space-x-4 justify-center">
                                        <button onclick="openEditKriteriaKemungkinanModal('{{ route('admin.kriteriakemungkinan.update', $kriteria->id) }}', '{{ $kriteria->id_kategori_resiko }}', '{{ $kriteria->id_level_kemungkinan }}', '{{ $kriteria->presentase_kemungkinan }}', '{{ $kriteria->jumlah_frekuensi }}')" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2">Edit</button>
                                        <form action="{{ route('admin.kriteriakemungkinan.destroy', $kriteria->id) }}" method="POST" class="inline" onsubmit="return confirm('Are you sure you want to delete this kriteria kemungkinan?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="bg-red-600 text-white px-4 py-2 rounded hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-offset-2">Delete</button>
                                        </form>
                                    </div>
                                </td>
                                @endif
                            </tr>
                        @endforeach
                    </tbody>
                </table>

                <!-- Modal for Tambah Kriteria Kemungkinan -->
<div id="tambahKriteriaKemungkinanModal" class="fixed inset-0 flex items-center justify-center hidden">
    <div class="absolute inset-0 bg-gray-900 opacity-50"></div>
    <div class="bg-white border border-black shadow-md rounded-lg p-6 relative z-10">
        <div class="flex justify-between items-center mb-4">
            <h2 class="text-xl font-bold">Tambah Kriteria Kemungkinan</h2>
            <button onclick="toggleModal('tambahKriteriaKemungkinanModal')" class="text-gray-500 text-2xl">&times;</button>
        </div>
        <form id="tambahKriteriaKemungkinanForm" action="{{ route('admin.kriteriakemungkinan.store') }}" method="POST">
            @csrf
            <div class="mb-4">
                <label class="block text-gray-700 mb-2" for="id_kategori_resiko">Kategori Resiko</label>
                <select name="id_kategori_resiko" id="id_kategori_resiko"
                    class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
                    required>
                    @foreach ($kategoriResiko as $kategori)
                        <option value="{{ $kategori->id }}">{{ $kategori->deskripsi }}</option>
                    @endforeach
                </select>
                @error('id_kategori_resiko')
                    <p class="text-red-500 text-sm mt-2">{{ $message }}</p>
                @enderror
            </div>
            <div class="mb-4">
                <label class="block text-gray-700 mb-2" for="id_level_kemungkinan">Level Kemungkinan</label>
                <select name="id_level_kemungkinan" id="id_level_kemungkinan"
                    class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
                    required>
                    @foreach ($levelKemungkinan as $level)
                        <option value="{{ $level->id }}">{{ $level->level_kemungkinan }}</option>
                    @endforeach
                </select>
                @error('id_level_kemungkinan')
                    <p class="text-red-500 text-sm mt-2">{{ $message }}</p>
                @enderror
            </div>
            <div class="mb-4">
                <label class="block text-gray-700 mb-2" for="presentase_kemungkinan">Presentase Kemungkinan</label>
                <input type="text" name="presentase_kemungkinan" id="presentase_kemungkinan"
                    value="{{ old('presentase_kemungkinan') }}"
                    class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
                    required>
                @error('presentase_kemungkinan')
                    <p class="text-red-500 text-sm mt-2">{{ $message }}</p>
                @enderror
            </div>
            <div class="mb-4">
                <label class="block text-gray-700 mb-2" for="jumlah_frekuensi">Jumlah Frekuensi</label>
                <input type="text" name="jumlah_frekuensi" id="jumlah_frekuensi"
                    value="{{ old('jumlah_frekuensi') }}"
                    class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
                    required>
                @error('jumlah_frekuensi')
                    <p class="text-red-500 text-sm mt-2">{{ $message }}</p>
                @enderror
            </div>
            <div class="flex justify-end">
                <button type="submit" class="px-4 py-2 bg-blue-500 text-white rounded-md hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-opacity-50">Simpan</button>
                <button type="button" onclick="toggleModal('tambahKriteriaKemungkinanModal')"
                    class="px-4 py-2 ml-2 bg-gray-500 text-white rounded-md hover:bg-gray-600 focus:outline-none focus:ring-2 focus:ring-gray-500 focus:ring-opacity-50">Batal</button>
            </div>
        </form>
    </div>
</div>


                <!-- Modal for Edit Kriteria Kemungkinan -->
                <div id="editKriteriaKemungkinanModal" class="fixed inset-0 flex items-center justify-center hidden">
                    <div class="absolute inset-0 bg-gray-900 opacity-50"></div>
                    <div class="bg-white border border-black shadow-md rounded-lg p-6 relative z-10">
                        <div class="flex justify-between items-center mb-4">
                            <h2 class="text-xl font-bold">Edit Kriteria Kemungkinan</h2>
                            <button onclick="toggleModal('editKriteriaKemungkinanModal')" class="text-gray-500 text-2xl">&times;</button>
                        </div>
                        <form id="editKriteriaKemungkinanForm" method="POST">
                            @csrf
                            @method('PUT') <!-- or 'PATCH', depending on your route -->
                            <input type="hidden" id="edit_id" name="id">
                            <div class="mb-4">
                                <label class="block text-gray-700 mb-2" for="edit_id_kategori_resiko">Kategori Resiko</label>
                                <select name="id_kategori_resiko" id="edit_id_kategori_resiko"
                                    class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
                                    required>
                                    @foreach ($kategoriResiko as $kategori)
                                        <option value="{{ $kategori->id }}">{{ $kategori->deskripsi }}</option>
                                    @endforeach
                                </select>
                                @error('id_kategori_resiko')
                                    <p class="text-red-500 text-sm mt-2">{{ $message }}</p>
                                @enderror
                            </div>
                            <div class="mb-4">
                                <label class="block text-gray-700 mb-2" for="edit_id_level_kemungkinan">Level Kemungkinan</label>
                                <select name="id_level_kemungkinan" id="edit_id_level_kemungkinan"
                                    class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
                                    required>
                                    @foreach ($levelKemungkinan as $level)
                                        <option value="{{ $level->id }}">{{ $level->level_kemungkinan }}</option>
                                    @endforeach
                                </select>
                                @error('id_level_kemungkinan')
                                    <p class="text-red-500 text-sm mt-2">{{ $message }}</p>
                                @enderror
                            </div>
                            <div class="mb-4">
                                <label class="block text-gray-700 mb-2" for="edit_presentase_kemungkinan">Presentase Kemungkinan</label>
                                <input type="text" name="presentase_kemungkinan" id="edit_presentase_kemungkinan"
                                    value="{{ old('presentase_kemungkinan') }}"
                                    class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
                                    required>
                                @error('presentase_kemungkinan')
                                    <p class="text-red-500 text-sm mt-2">{{ $message }}</p>
                                @enderror
                            </div>
                            <div class="mb-4">
                                <label class="block text-gray-700 mb-2" for="edit_jumlah_frekuensi">Jumlah Frekuensi</label>
                                <input type="text" name="jumlah_frekuensi" id="edit_jumlah_frekuensi"
                                    value="{{ old('jumlah_frekuensi') }}"
                                    class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
                                    required>
                                @error('jumlah_frekuensi')
                                    <p class="text-red-500 text-sm mt-2">{{ $message }}</p>
                                @enderror
                            </div>
                            <div class="flex justify-end">
                                <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2">Update</button>
                            </form>
                                <button type="button" onclick="toggleModal('editKriteriaKemungkinanModal')"
                                    class="px-4 py-2 ml-2 bg-gray-500 text-white rounded-md hover:bg-gray-600 focus:outline-none focus:ring-2 focus:ring-gray-500 focus:ring-opacity-50">Batal</button>
                            </div>
                        </form>
                    </div>
                </div>

            </div>
        </div>
    </section>
</div>

<!-- JavaScript to Initialize DataTables and Modal functionality -->
<script>
    $(document).ready(function() {
        // Initialize DataTables
        var table = $('#riskTable').DataTable({
            "paging": true,
            "info": true,
            "searching": true,
            "columnDefs": [
                { "orderable": false, "targets": 5 }  // Disable ordering on the 'Actions' column
            ]
        });

        // Event to filter table based on category risk
        $('#filterButton').click(function() {
            var selectedValue = $('#filter_kategori_resiko').val();
            if (selectedValue) {
                table.column(1).search('^' + selectedValue + '$', true, false).draw();
            } else {
                table.column(1).search('').draw();
            }
        });

        // Open "Tambah Kriteria Kemungkinan" modal
        $('#openTambahKriteriaKemungkinanModal').click(function() {
            $('#tambahKriteriaKemungkinanModal').removeClass('hidden');
        });

        // Close "Tambah Kriteria Kemungkinan" modal
        $('#tambahKriteriaKemungkinanModal .absolute').click(function() {
            $('#tambahKriteriaKemungkinanModal').addClass('hidden');
        });

        // Handle form submission in "Tambah Kriteria Kemungkinan" modal via AJAX
        $('#tambahKriteriaKemungkinanForm').submit(function(e) {
            e.preventDefault(); // Prevent form submission

            var form = $(this);
            var actionUrl = form.attr('action');
            var formData = form.serialize();

            $.ajax({
                url: actionUrl,
                method: "POST",
                data: formData,
                success: function(response) {
                    // Add new data to DataTables
                    var newRowData = [
                        response.no,
                        response.kategori_resiko,
                        response.level_kemungkinan,
                        response.presentase_kemungkinan,
                        response.jumlah_frekuensi,
                        '<button onclick="openEditKriteriaKemungkinanModal(\'' + response.edit_url + '\', \'' + response.id_kategori_resiko + '\', \'' + response.id_level_kemungkinan + '\', \'' + response.presentase_kemungkinan + '\', \'' + response.jumlah_frekuensi + '\')" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2">Edit</button> ' +
                        '<form action="' + response.delete_url + '" method="POST" class="inline" onsubmit="return confirm(\'Are you sure you want to delete this kriteria kemungkinan?\');">' +
                        '<input type="hidden" name="_token" value="' + response.csrf_token + '">' +
                        '<input type="hidden" name="_method" value="DELETE">' +
                        '<button type="submit" class="bg-red-600 text-white px-4 py-2 rounded hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-offset-2">Delete</button>' +
                        '</form>'
                    ];

                    table.row.add(newRowData).draw(false);

                    // Close modal after successful submission
                    $('#tambahKriteriaKemungkinanModal').addClass('hidden');

                    // Reset form
                    form.trigger("reset");
                },
                error: function(xhr) {
                    console.error(xhr.responseText);
                }
            });
        });

        // Handle opening "Edit Kriteria Kemungkinan" modal
        window.openEditKriteriaKemungkinanModal = function(editUrl, id_kategori_resiko, level_kemungkinan, presentase_kemungkinan, jumlah_frekuensi) {
            // Set form values
            $('#edit_id').val(id_kategori_resiko); // Assuming id_kategori_resiko is the identifier
            $('#edit_id_level_kemungkinan').val(level_kemungkinan);
            $('#edit_presentase_kemungkinan').val(presentase_kemungkinan);
            $('#edit_jumlah_frekuensi').val(jumlah_frekuensi);
            $('#editKriteriaKemungkinanForm').attr('action', editUrl);

            // Open modal
            $('#editKriteriaKemungkinanModal').removeClass('hidden');
        };

        $('#editKriteriaKemungkinanForm').submit(function(e) {
    e.preventDefault(); // Prevent default form submission

    var form = $(this);
    var actionUrl = form.attr('action');
    var formData = form.serialize();

    $.ajax({
        url: actionUrl,
        method: "POST",
        data: formData,
        success: function(response) {
            // Assuming response contains updated data
            var updatedRowData = [
                response.no,
                response.kategori_resiko,
                response.level_kemungkinan,
                response.presentase_kemungkinan,
                response.jumlah_frekuensi,
                '<button onclick="openEditKriteriaKemungkinanModal(\'' + response.edit_url + '\', \'' + response.id_kategori_resiko + '\', \'' + response.id_level_kemungkinan + '\', \'' + response.presentase_kemungkinan + '\', \'' + response.jumlah_frekuensi + '\')" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2">Edit</button> ' +
                '<form action="' + response.delete_url + '" method="POST" class="inline" onsubmit="return confirm(\'Are you sure you want to delete this kriteria kemungkinan?\');">' +
                '<input type="hidden" name="_token" value="' + response.csrf_token + '">' +
                '<input type="hidden" name="_method" value="DELETE">' +
                '<button type="submit" class="bg-red-600 text-white px-4 py-2 rounded hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-offset-2">Delete</button>' +
                '</form>'
            ];

            // Assuming you're editing the selected row
            var rowIndex = table.row('.selected').index();
            table.row(rowIndex).data(updatedRowData).draw(false);

            // Close modal
            $('#editKriteriaKemungkinanModal').addClass('hidden');

            // Reset form
            form.trigger("reset");
        },
        error: function(xhr) {
            console.error(xhr.responseText);
        }
    });
});

        // Function to toggle modal visibility
        function toggleModal(modalId) {
            $('#' + modalId).toggleClass('hidden');
        }
    });
</script>

