
<div id="context15" class="hidden tab-content">
    <section class="bg-white dark:bg-white">
        <div class="py-2 -my-2 overflow-x-auto sm:-mx-6 sm:px-6 lg:-mx-8 lg:px-8">
            <div class="inline-block min-w-full overflow-hidden align-middle border-b border-gray-200 shadow sm:rounded-lg">
                @if (auth()->check() && auth()->user()->hasRole('admin'))
                <button onclick="toggleModal('tambahopsiPenangananModal')"
                    class="px-4 py-2 mb-2 font-medium tracking-wide text-white transition duration-300 bg-blue-500 rounded-full hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-opacity-50">
                    Tambah Opsi Penanganan
                </button>
                @endif
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-6 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase">
                                No
                            </th>
                            <th class="px-6 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase">
                                Opsi Penanganan
                            </th>
                            <th class="px-6 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase">
                                Deskripsi
                            </th>
                            <th class="px-6 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase">
                                Jenis Resiko
                            </th>
                            @if (auth()->check() && auth()->user()->hasRole('admin'))
                            <th class="px-6 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase">
                                Actions
                            </th>
                            @endif
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @foreach ($opsiPenanganan as $opsi)
                            <tr>
                                <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-200">
                                    {{ $loop->iteration }}
                                </td>
                                <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-200">
                                    {{ $opsi->name }}
                                </td>
                                <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-200">
                                    {{ $opsi->deskripsi }}
                                </td>
                                <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-200">
                                    {{ $opsi->jenisResiko->name}}
                                </td>
                                @if (auth()->check() && auth()->user()->hasRole('admin'))
                                <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-200">
                                    <a href="javascript:void(0)"
                                        onclick="openEditopsiPenangananModal('{{ route('admin.opsipenanganan.update', $opsi->id) }}', '{{ $opsi->name }}', '{{ $opsi->deskripsi }}', '{{ $opsi->id_jenis_resiko }}')"
                                        class="ml-4 text-indigo-600 hover:text-indigo-900">Edit</a>
                                    <form action="{{ route('admin.opsipenanganan.destroy', $opsi->id) }}" method="POST"
                                        class="inline ml-4"
                                        onsubmit="return confirm('Are you sure you want to delete this opsi penanganan?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-red-600 hover:text-red-900">Delete</button>
                                    </form>
                                </td>
                                @endif
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                <div class="flex flex-col items-center px-5 py-5 bg-white border-t xs:flex-row xs:justify-between">
                    <div class="inline-flex mt-2 xs:mt-0">
                        <button
                            class="px-4 py-2 text-sm font-semibold text-gray-800 bg-gray-300 rounded-l hover:bg-gray-400">&lt;</button>
                        <div class="flex items-center mx-2">
                            <input type="text"
                                class="w-12 py-2 font-semibold text-center text-gray-800 border border-gray-300"
                                value="1" readonly />
                        </div>
                        <button
                            class="px-4 py-2 text-sm font-semibold text-gray-800 bg-gray-300 rounded-r hover:bg-gray-400">&gt;</button>
                    </div>
                </div>

                <div id="tambahopsiPenangananModal" class="fixed inset-0 flex items-center justify-center hidden">
                    <div class="absolute inset-0 bg-gray-900 opacity-50"></div>
                    <div
                        class="relative z-10 p-6 bg-white border border-black rounded-lg shadow-md modal modal-content">
                        <div class="flex items-center justify-between mb-4">
                            <h2 class="text-xl font-bold">Tambah Opsi Penanganan</h2>
                            <button onclick="toggleModal('tambahopsiPenangananModal')"
                                class="ml-4 text-2xl text-gray-500">&times;</button>
                        </div>
                        <form action="{{ route('admin.opsipenanganan.store') }}" method="POST">
                            @csrf
                            <div class="mb-4">
                                <label class="block mb-2 text-gray-700" for="name">Opsi Penanganan</label>
                                <input type="text" name="name" id="name"
                                    value="{{ old('name') }}"
                                    class="block w-full px-3 py-2 mt-1 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
                                    required>
                                @error('name')
                                    <p class="mt-2 text-sm text-red-500">{{ $message }}</p>
                                @enderror
                            </div>
                            <div class="mb-4">
                                <label class="block mb-2 text-gray-700" for="deskripsi">Deskripsi</label>
                                <input type="text" name="deskripsi" id="deskripsi"
                                    value="{{ old('deskripsi') }}"
                                    class="block w-full px-3 py-2 mt-1 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
                                    required>
                                @error('deskripsi')
                                    <p class="mt-2 text-sm text-red-500">{{ $message }}</p>
                                @enderror
                            </div>
                            <div class="mb-4">
                                <label class="block mb-2 text-gray-700" for="id_jenis_resiko">Jenis Resiko</label>
                                <select name="id_jenis_resiko" id="id_jenis_resiko"
                                    class="block w-full px-3 py-2 mt-1 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
                                    required>
                                    @foreach ($jenisResiko as $jenis)
                                        <option value="{{ $jenis->id }}">{{ $jenis->name }}</option>
                                    @endforeach
                                </select>
                                @error('id_jenis_resiko')
                                    <p class="mt-2 text-sm text-red-500">{{ $message }}</p>
                                @enderror
                            </div>
                            <div class="mt-4">
                                <button type="submit"
                                class="px-4 py-2 text-white bg-blue-500 rounded-md">Tambah</button>
                            </div>
                        </form>
                    </div>
                </div>

                <div id="editopsiPenangananModal" class="fixed inset-0 flex items-center justify-center hidden">
                    <div class="absolute inset-0 bg-gray-900 opacity-50"></div>
                    <div class="relative z-10 p-6 bg-white border border-black rounded-lg shadow-md modal modal-content">
                        <div class="flex items-center justify-between mb-4">
                            <h2 class="text-xl font-bold">Edit Opsi Penanganan</h2>
                            <button onclick="toggleModal('editopsiPenangananModal')" class="ml-4 text-2xl text-gray-500">&times;</button>
                        </div>
                        <form id="editopsiPenangananForm" method="POST">
                            @csrf
                            @method('PUT')
                            <div class="mb-4">
                                <label class="block mb-2 text-gray-700" for="name_edit">Opsi Penanganan</label>
                                <input type="text" name="name" id="name_edit"
                                    class="block w-full px-3 py-2 mt-1 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
                                    required>
                                @error('name')
                                    <p class="mt-2 text-sm text-red-500">{{ $message }}</p>
                                @enderror
                            </div>
                            <div class="mb-4">
                                <label class="block mb-2 text-gray-700" for="deskripsi_edit1">Deskripsi</label>
                                <input type="text" name="deskripsi" id="deskripsi_edit"
                                    class="block w-full px-3 py-2 mt-1 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
                                    required>
                                @error('deskripsi')
                                    <p class="mt-2 text-sm text-red-500">{{ $message }}</p>
                                @enderror
                            </div>
                            <div class="mb-4">
                                <label class="block mb-2 text-gray-700" for="edit_id_jenis_resiko">Jenis Resiko</label>
                                <select name="id_jenis_resiko" id="edit_id_jenis_resiko"
                                    class="block w-full px-3 py-2 mt-1 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
                                    required>
                                    @foreach ($jenisResiko as $opsi)
                                        <option value="{{ $opsi->id }}">{{ $opsi->name }}</option>
                                    @endforeach
                                </select>
                                @error('id_jenis_resiko')
                                    <p class="mt-2 text-sm text-red-500">{{ $message }}</p>
                                @enderror
                            </div>
                            <div class="flex items-center justify-end">
                                <button type="submit" class="px-4 py-2 text-white bg-blue-500 rounded-md">Simpan</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

<script>

    function toggleModal(modalId) {
        document.getElementById(modalId).classList.toggle('hidden');
    }

    function openEditopsiPenangananModal(url, name, deskripsi, idJenisResiko) {
        const editopsiPenangananForm = document.getElementById('editopsiPenangananForm');
        editopsiPenangananForm.action = url;

        document.getElementById('name_edit').value = name;
        document.getElementById('deskripsi_edit1').value = deskripsi;
        document.getElementById('edit_id_jenis_resiko').value = idJenisResiko;
        toggleModal('editopsiPenangananModal');
    }

    document.addEventListener('click', function(event) {
        const modals = document.querySelectorAll('.modal');
        modals.forEach(modal => {
            if (!modal.contains(event.target) && !event.target.closest('[onclick]')) {
                modal.classList.remove('flex');
                modal.classList.add('hidden');
            }
        });
    });
</script>
