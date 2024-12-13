<div id="context10" class="hidden tab-content">
    <section class="bg-white dark:bg-gray-100">
        <div class="py-2 -my-2 overflow-x-auto sm:-mx-6 sm:px-6 lg:-mx-8 lg:px-8">
            <div
                class="inline-block min-w-full overflow-hidden align-middle border-b border-gray-200 shadow sm:rounded-lg">
                @if (auth()->check() && auth()->user()->hasRole('admin'))
                <button onclick="toggleModal('tambahLevelDampakModal')"
                    class="px-4 py-2 mb-2 font-medium tracking-wide text-white transition duration-300 bg-blue-500 rounded-md hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-opacity-50">
                    Tambah Level Dampak
                </button>
                @endif

                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-6 py-3 text-xs font-medium tracking-wider text-center uppercase text-black-500">
                                No
                            </th>
                            <th class="px-6 py-3 text-xs font-medium tracking-wider text-center uppercase text-black-500">
                                Level Dampak
                            </th>
                            <th class="px-6 py-3 text-xs font-medium tracking-wider text-center uppercase text-black-500">
                                Deskripsi
                            </th>
                            @if (auth()->check() && auth()->user()->hasRole('admin'))
                            <th class="px-6 py-3 text-xs font-medium tracking-wider text-center uppercase text-black-500">
                                Actions
                            </th>
                            @endif
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @foreach ($levelDampak as $leveldampak)
                            <tr>
                                <td class="px-6 py-4 text-center whitespace-no-wrap border-b border-gray-200">
                                    {{ $loop->iteration }}
                                </td>
                                <td class="px-6 py-4 text-center whitespace-no-wrap border-b border-gray-200">
                                    {{ $leveldampak->name }}
                                </td>
                                <td class="px-6 py-4 text-center whitespace-no-wrap border-b border-gray-200">
                                    {{ $leveldampak->deskripsi }}
                                </td>
                                @if (auth()->check() && auth()->user()->hasRole('admin'))
                                <td class="px-6 py-4 text-center whitespace-no-wrap border-b border-gray-200">
                                    <div class="inline-flex justify-center space-x-4">
                                        <button
                                            onclick="openEditLevelDampakModal('{{ route('admin.leveldampak.update', $leveldampak->id) }}', '{{ $leveldampak->name }}', '{{ $leveldampak->deskripsi }}')"
                                            class="px-4 py-2 text-white bg-blue-600 rounded hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2">
                                            Edit
                                        </button>
                                        <form action="{{ route('admin.leveldampak.destroy', $leveldampak->id) }}" method="POST" class="inline"
                                            onsubmit="return confirm('Are you sure you want to delete this level dampak?');">
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

                <div id="tambahLevelDampakModal" class="fixed inset-0 flex items-center justify-center hidden">
                    <div class="absolute inset-0 bg-gray-900 opacity-50"></div>
                    <div
                        class="relative z-10 p-6 bg-white border border-black rounded-lg shadow-md modal modal-content">
                        <div class="flex items-center justify-between mb-4">
                            <h2 class="text-xl font-bold">Tambah Level Dampak</h2>
                            <button onclick="toggleModal('tambahLevelDampakModal')"
                                class="ml-4 text-2xl text-gray-500">&times;</button>
                        </div>
                        <form action="{{ route('admin.leveldampak.store') }}" method="POST">
                            @csrf
                            <div class="mb-4">
                                <label class="block mb-2 text-gray-700" for="name">Level Dampak</label>
                                <input type="text" name="name" id="level_dampak"
                                    value="{{ old('name') }}"
                                    class="block w-full px-3 py-2 mt-1 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
                                    required>
                                @error('name')
                                    <p class="mt-2 text-sm text-red-500">{{ $message }}</p>
                                @enderror
                            </div>
                            <div class="mb-4">
                                <label class="block mb-2 text-gray-700" for="deskripsi">Deskripsi</label>
                                <input type="text" name="deskripsi" id="deskripsi" value="{{ old('deskripsi') }}"
                                    class="block w-full px-3 py-2 mt-1 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
                                    required>
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

                <div id="editLevelDampakModal" class="fixed inset-0 flex items-center justify-center hidden">
                    <div class="absolute inset-0 bg-gray-900 opacity-50"></div>
                    <div
                        class="relative z-10 p-6 bg-white border border-black rounded-lg shadow-md modal modal-content">
                        <div class="flex items-center justify-between mb-4">
                            <h2 class="text-xl font-bold">Edit Level Dampak</h2>
                            <button onclick="toggleModal('editLevelDampakModal')"
                                class="ml-4 text-2xl text-gray-500">&times;</button>
                        </div>
                        <form id="editLevelDampakForm" method="POST">
                            @csrf
                            @method('PUT')
                            <div class="mb-4">
                                <label class="block mb-2 text-gray-700" for="level_dampak_edit">Level Dampak</label>
                                <input type="text" name="name" id="level_dampak_edit"
                                    class="block w-full px-3 py-2 mt-1 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
                                    required>
                                @error('name')
                                    <p class="mt-2 text-sm text-red-500">{{ $message }}</p>
                                @enderror
                            </div>
                            <div class="mb-4">
                                <label class="block mb-2 text-gray-700"
                                    for="deskripsi_level_dampak_edit">Deskripsi</label>
                                <input type="text" name="deskripsi" id="deskripsi_level_dampak_edit"
                                    class="block w-full px-3 py-2 mt-1 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
                                    required>
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
    function toggleModal(modalId) {
        document.getElementById(modalId).classList.toggle('hidden');
    }

    function openEditLevelDampakModal(url, level_dampak, deskripsi) {
        const editLevelDampakForm = document.getElementById('editLevelDampakForm');
        editLevelDampakForm.action = url;
        document.getElementById('level_dampak_edit').value = level_dampak;
        document.getElementById('deskripsi_level_dampak_edit').value = deskripsi;
        toggleModal('editLevelDampakModal');
    }
</script>
