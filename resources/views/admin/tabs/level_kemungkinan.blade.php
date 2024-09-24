<div id="context8" class="tab-content hidden">
    <section class="bg-white dark:bg-gray-100">
        <div class="-my-2 py-2 overflow-x-auto sm:-mx-6 sm:px-6 lg:-mx-8 lg:px-8">
            <div
                class="align-middle inline-block min-w-full shadow overflow-hidden sm:rounded-lg border-b border-gray-200">
                @if (auth()->check() && auth()->user()->hasRole('admin'))
                <button onclick="toggleModal('tambahLevelKemungkinanModal')"
                    class="px-4 py-2 mb-2 bg-blue-500 rounded-md text-white font-medium tracking-wide hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-opacity-50 transition duration-300">
                    Tambah Level Kemungkinan
                </button>
                @endif

                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-6 py-3 text-center text-xs font-medium text-black-500 uppercase tracking-wider">
                                No
                            </th>
                            <th class="px-6 py-3 text-center text-xs font-medium text-black-500 uppercase tracking-wider">
                                Level Kemungkinan
                            </th>
                            @if (auth()->check() && auth()->user()->hasRole('admin'))
                            <th class="px-6 py-3 text-center text-xs font-medium text-black-500 uppercase tracking-wider">
                                Actions
                            </th>
                            @endif
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @foreach ($levelKemungkinan as $level)
                            <tr>
                                <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-200 text-center">
                                    {{ $loop->iteration }}
                                </td>
                                <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-200 text-center">
                                    {{ $level->level_kemungkinan }}
                                </td>
                                @if (auth()->check() && auth()->user()->hasRole('admin'))
                                <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-200 text-center">
                                    <div class="inline-flex space-x-4 justify-center">
                                        <button
                                            onclick="openEditLevelKemungkinanModal('{{ route('admin.levelkemungkinan.update', $level->id) }}', '{{ $level->level_kemungkinan }}')"
                                            class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2">
                                            Edit
                                        </button>
                                        <form action="{{ route('admin.levelkemungkinan.destroy', $level->id) }}" method="POST" class="inline"
                                            onsubmit="return confirm('Are you sure you want to delete this level kemungkinan?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="bg-red-600 text-white px-4 py-2 rounded hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-offset-2">
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

                <div id="tambahLevelKemungkinanModal" class="fixed inset-0 flex items-center justify-center hidden">
                    <div class="absolute inset-0 bg-gray-900 opacity-50"></div>
                    <div
                        class="bg-white border border-black shadow-md rounded-lg p-6 modal modal-content relative z-10">
                        <div class="flex justify-between items-center mb-4">
                            <h2 class="text-xl font-bold">Tambah Level Kemungkinan</h2>
                            <button onclick="toggleModal('tambahLevelKemungkinanModal')"
                                class="text-gray-500 text-2xl ml-4">&times;</button>
                        </div>
                        <form action="{{ route('admin.levelkemungkinan.store') }}" method="POST">
                            @csrf
                            <div class="mb-4">
                                <label class="block text-gray-700 mb-2" for="level_kemungkinan">Level
                                    Kemungkinan</label>
                                <input type="text" name="level_kemungkinan" id="level_kemungkinan"
                                    value="{{ old('level_kemungkinan') }}"
                                    class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
                                    required>
                                @error('level_kemungkinan')
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

                <div id="editLevelKemungkinanModal" class="fixed inset-0 flex items-center justify-center hidden">
                    <div class="absolute inset-0 bg-gray-900 opacity-50"></div>
                    <div
                        class="bg-white border border-black shadow-md rounded-lg p-6 modal modal-content relative z-10">
                        <div class="flex justify-between items-center mb-4">
                            <h2 class="text-xl font-bold">Edit Level Kemungkinan</h2>
                            <button onclick="toggleModal('editLevelKemungkinanModal')"
                                class="text-gray-500 text-2xl ml-4">&times;</button>
                        </div>
                        <form id="editLevelKemungkinanForm" method="POST">
                            @csrf
                            @method('PUT')
                            <div class="mb-4">
                                <label class="block text-gray-700 mb-2" for="level_kemungkinan_edit">Level
                                    Kemungkinan</label>
                                <input type="text" name="level_kemungkinan" id="level_kemungkinan_edit"
                                    class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
                                    required>
                                @error('level_kemungkinan')
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
    function toggleModal(modalId) {
        document.getElementById(modalId).classList.toggle('hidden');
    }

    function openEditLevelKemungkinanModal(url, levelKemungkinan) {
        const editLevelKemungkinanForm = document.getElementById('editLevelKemungkinanForm');
        editLevelKemungkinanForm.action = url;
        document.getElementById('level_kemungkinan_edit').value = levelKemungkinan;
        toggleModal('editLevelKemungkinanModal');
    }
</script>
