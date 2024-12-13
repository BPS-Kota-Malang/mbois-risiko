<div id="context4" class="hidden tab-content">
    <section class="bg-white dark:bg-white">
        <div class="py-2 -my-2 overflow-x-auto sm:-mx-6 sm:px-6 lg:-mx-8 lg:px-8">
            <div
                class="inline-block min-w-full overflow-hidden align-middle border-b border-gray-200 shadow sm:rounded-lg">
                @if (auth()->check() && auth()->user()->hasRole('admin'))
                <button onclick="toggleTimProjectModal('tambah')"
                class="px-4 py-2 mb-2 font-medium tracking-wide text-white transition duration-300 bg-blue-500 rounded-md hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-opacity-50">
                    Tambah
                </button>
                @endif
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-6 py-3 text-xs font-medium tracking-wider text-left uppercase text-black-500">No
                            </th>
                            <th class="px-6 py-3 text-xs font-medium tracking-wider text-left uppercase text-black-500">
                                Nama Sub Tim</th>
                            <th class="px-6 py-3 text-xs font-medium tracking-wider text-left uppercase text-black-500">
                                Deskripsi</th>
                                @if (auth()->check() && auth()->user()->hasRole('admin'))
                            <th class="px-6 py-3 text-xs font-medium tracking-wider text-center uppercase text-black-500">
                                Actions</th>
                                @endif
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @foreach ($subteams as $subteam)
                            <tr>
                                <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-200">{{ $loop->iteration }}
                                </td>
                                <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-200">
                                    {{ $subteam->name }}</td>
                                <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-200">
                                    {{ $subteam->deskripsi ?? '-' }}</td>
                                    @if (auth()->check() && auth()->user()->hasRole('admin'))
                                    <td class="px-6 py-4 text-center whitespace-no-wrap border-b border-gray-200">
                                        <div class="inline-flex space-x-4">
                                            <button
                                                onclick="openEditTeamProjectModal('{{ route('admin.subteam.update', $subteam->id) }}', '{{ $subteam->name }}', '{{ $subteam->deskripsi ?? '' }}')"
                                                class="px-4 py-2 text-white bg-blue-600 rounded hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2">
                                                Edit
                                            </button>
                                            <form action="{{ route('admin.subteam.destroy', $subteam->id) }}" method="POST" class="inline"
                                                onsubmit="return confirm('Are you sure you want to delete this tim project?');">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="px-4 py-2 text-white bg-red-600 rounded hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-offset-2">
                                                    Delete
                                                </button>
                                            </form>
                                        </div>
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

                <!-- Modal Tambah TimProject -->
                <div id="timProjectTambahModal" class="fixed inset-0 flex items-center justify-center hidden">
                    <div class="absolute inset-0 bg-gray-900 opacity-50"></div>
                    <div
                        class="relative z-10 p-6 bg-white border border-black rounded-lg shadow-md modal modal-content">
                        <div class="flex items-center justify-between mb-4">
                            <h2 class="text-xl font-bold">Tambah Sub Team Project</h2>
                            <button onclick="toggleTimProjectModal('tambah')"
                                class="ml-4 text-2xl text-gray-500">&times;</button>
                        </div>
                        <form action="{{ route('admin.timproject.store') }}" method="POST">
                            @csrf
                            <div class="mb-4">
                                <label class="block mb-2 text-gray-700" for="name">Nama Tim</label>
                                <input type="text" name="name" id="name" value="{{ old('name') }}"
                                    class="block w-full px-3 py-2 mt-1 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
                                    required>
                                @error('name')
                                    <p class="mt-2 text-sm text-red-500">{{ $message }}</p>
                                @enderror
                            </div>
                            <div class="mb-4">
                                <label class="block mb-2 text-gray-700" for="deskripsi">Deskripsi</label>
                                <textarea name="deskripsi" id="deskripsi"
                                    class="block w-full px-3 py-2 mt-1 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">{{ old('deskripsi') }}</textarea>
                                @error('deskripsi')
                                    <p class="mt-2 text-sm text-red-500">{{ $message }}</p>
                                @enderror
                            </div>
                            <div class="flex items-center justify-end">
                                <button type="submit"
                                    class="px-4 py-2 text-white bg-blue-500 rounded-md">Tambah</button>
                            </div>
                        </form>
                    </div>
                </div>

                <!-- Modal Edit TimProject -->
                <div id="timProjectEditModal" class="fixed inset-0 flex items-center justify-center hidden">
                    <div class="absolute inset-0 bg-gray-900 opacity-50"></div>
                    <div
                        class="relative z-10 p-6 bg-white border border-black rounded-lg shadow-md modal modal-content">
                        <div class="flex items-center justify-between mb-4">
                            <h2 class="text-xl font-bold">Edit Tim Project</h2>
                            <button onclick="toggleTimProjectModal('edit')"
                                class="ml-4 text-2xl text-gray-500">&times;</button>
                        </div>
                        <form id="timProjectEditForm" method="POST">
                            @csrf
                            @method('PUT')
                            <div class="mb-4">
                                <label class="block mb-2 text-gray-700" for="nama_team_edit">Nama Tim</label>
                                <input type="text" name="name" id="nama_team_edit"
                                    class="block w-full px-3 py-2 mt-1 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
                                    required>
                                @error('name')
                                    <p class="mt-2 text-sm text-red-500">{{ $message }}</p>
                                @enderror
                            </div>
                            <div class="mb-4">
                                <label class="block mb-2 text-gray-700" for="deskripsi_edit">Deskripsi</label>
                                <textarea name="deskripsi" id="deskripsi_edit"
                                    class="block w-full px-3 py-2 mt-1 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"></textarea>
                                @error('deskripsi')
                                    <p class="mt-2 text-sm text-red-500">{{ $message }}</p>
                                @enderror
                            </div>
                            <div class="flex items-center justify-end">
                                <button type="submit" class="px-4 py-2 text-white bg-blue-500 rounded-md">Ubah</button>
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
