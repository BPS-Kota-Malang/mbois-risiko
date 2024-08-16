<div id="context3" class="tab-content hidden">
    <section class="bg-white dark:bg-white">
        <div class="-my-2 py-2 overflow-x-auto sm:-mx-6 sm:px-6 lg:-mx-8 lg:px-8">
            <div
                class="align-middle inline-block min-w-full shadow overflow-hidden sm:rounded-lg border-b border-gray-200">
                <button onclick="toggleTimProjectModal('tambah')"
                    class="px-4 py-2 mb-2 bg-blue-500 rounded-full text-white font-medium tracking-wide hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-opacity-50 transition duration-300">
                    Tambah
                </button>
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">No
                            </th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Nama Tim</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Deskripsi</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Actions</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @foreach ($timProjects as $timProject)
                            <tr>
                                <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-200">{{ $loop->iteration }}
                                </td>
                                <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-200">
                                    {{ $timProject->nama_team }}</td>
                                <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-200">
                                    {{ $timProject->deskripsi ?? '-' }}</td>
                                <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-200">
                                    <a href="javascript:void(0)"
                                        onclick="openEditTeamProjectModal('{{ route('admin.tim-project.update', $timProject->id) }}', '{{ $timProject->nama_team }}', '{{ $timProject->deskripsi ?? '' }}')"
                                        class="text-indigo-600 hover:text-indigo-900 ml-4">Edit</a>
                                    <form action="{{ route('admin.tim-project.delete', $timProject->id) }}"
                                        method="POST" class="inline ml-4"
                                        onsubmit="return confirm('Are you sure you want to delete this tim project?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-red-600 hover:text-red-900">Delete</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                <div class="px-5 py-5 bg-white border-t flex flex-col xs:flex-row items-center xs:justify-between">
                    <div class="inline-flex mt-2 xs:mt-0">
                        <button
                            class="text-sm bg-gray-300 hover:bg-gray-400 text-gray-800 font-semibold py-2 px-4 rounded-l">&lt;</button>
                        <div class="flex items-center mx-2">
                            <input type="text"
                                class="w-12 text-center border border-gray-300 text-gray-800 font-semibold py-2"
                                value="1" readonly />
                        </div>
                        <button
                            class="text-sm bg-gray-300 hover:bg-gray-400 text-gray-800 font-semibold py-2 px-4 rounded-r">&gt;</button>
                    </div>
                </div>

                <!-- Modal Tambah TimProject -->
                <div id="timProjectTambahModal" class="fixed inset-0 flex items-center justify-center hidden">
                    <div class="absolute inset-0 bg-gray-900 opacity-50"></div>
                    <div
                        class="bg-white border border-black shadow-md rounded-lg p-6 modal modal-content relative z-10">
                        <div class="flex justify-between items-center mb-4">
                            <h2 class="text-xl font-bold">Tambah Tim Project</h2>
                            <button onclick="toggleTimProjectModal('tambah')"
                                class="text-gray-500 text-2xl ml-4">&times;</button>
                        </div>
                        <form action="{{ route('admin.tim-project.store') }}" method="POST">
                            @csrf
                            <div class="mb-4">
                                <label class="block text-gray-700 mb-2" for="nama_team">Nama Tim</label>
                                <input type="text" name="nama_team" id="nama_team" value="{{ old('nama_team') }}"
                                    class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
                                    required>
                                @error('nama_team')
                                    <p class="text-red-500 text-sm mt-2">{{ $message }}</p>
                                @enderror
                            </div>
                            <div class="mb-4">
                                <label class="block text-gray-700 mb-2" for="deskripsi">Deskripsi</label>
                                <textarea name="deskripsi" id="deskripsi"
                                    class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">{{ old('deskripsi') }}</textarea>
                                @error('deskripsi')
                                    <p class="text-red-500 text-sm mt-2">{{ $message }}</p>
                                @enderror
                            </div>
                            <div class="flex items-center justify-end">
                                <button type="submit"
                                    class="bg-blue-500 text-white px-4 py-2 rounded-md">Tambah</button>
                            </div>
                        </form>
                    </div>
                </div>

                <!-- Modal Edit TimProject -->
                <div id="timProjectEditModal" class="fixed inset-0 flex items-center justify-center hidden">
                    <div class="absolute inset-0 bg-gray-900 opacity-50"></div>
                    <div
                        class="bg-white border border-black shadow-md rounded-lg p-6 modal modal-content relative z-10">
                        <div class="flex justify-between items-center mb-4">
                            <h2 class="text-xl font-bold">Edit Tim Project</h2>
                            <button onclick="toggleTimProjectModal('edit')"
                                class="text-gray-500 text-2xl ml-4">&times;</button>
                        </div>
                        <form id="timProjectEditForm" method="POST">
                            @csrf
                            @method('PUT')
                            <div class="mb-4">
                                <label class="block text-gray-700 mb-2" for="nama_team_edit">Nama Tim</label>
                                <input type="text" name="nama_team" id="nama_team_edit"
                                    class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
                                    required>
                                @error('nama_team')
                                    <p class="text-red-500 text-sm mt-2">{{ $message }}</p>
                                @enderror
                            </div>
                            <div class="mb-4">
                                <label class="block text-gray-700 mb-2" for="deskripsi_edit">Deskripsi</label>
                                <textarea name="deskripsi" id="deskripsi_edit"
                                    class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"></textarea>
                                @error('deskripsi')
                                    <p class="text-red-500 text-sm mt-2">{{ $message }}</p>
                                @enderror
                            </div>
                            <div class="flex items-center justify-end">
                                <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded-md">Ubah</button>
                            </div>
                        </form>
                    </div>
                </div>

            </div>
        </div>
    </section>
</div>

<script>
    function toggleTimProjectModal(action) {
        const modalId = action === 'tambah' ? 'timProjectTambahModal' : 'timProjectEditModal';
        document.getElementById(modalId).classList.toggle('hidden');
    }

    function openEditTeamProjectModal(url, namaTeam, deskripsi) {
        const editForm = document.getElementById('timProjectEditForm');
        editForm.action = url;
        document.getElementById('nama_team_edit').value = namaTeam;
        document.getElementById('deskripsi_edit').value = deskripsi || '';
        toggleTimProjectModal('timProjectEditModal');
    }
</script>
