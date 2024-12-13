<div id="context9" class="hidden tab-content">
    <section class="bg-white dark:bg-gray-100">
        <div class="py-2 -my-2 overflow-x-auto sm:-mx-6 sm:px-6 lg:-mx-8 lg:px-8">
            <div
                class="inline-block min-w-full overflow-hidden align-middle border-b border-gray-200 shadow sm:rounded-lg">
                @if (auth()->check() && auth()->user()->hasRole('admin'))
                <button onclick="toggleModal('tambahLevelKemungkinanModal')"
                    class="px-4 py-2 mb-2 font-medium tracking-wide text-white transition duration-300 bg-blue-500 rounded-md hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-opacity-50">
                    Tambah Level Kemungkinan
                </button>
                @endif

                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-6 py-3 text-xs font-medium tracking-wider text-center uppercase text-black-500">
                                No
                            </th>
                            <th class="px-6 py-3 text-xs font-medium tracking-wider text-center uppercase text-black-500">
                                Level Kemungkinan
                            </th>
                            @if (auth()->check() && auth()->user()->hasRole('admin'))
                            <th class="px-6 py-3 text-xs font-medium tracking-wider text-center uppercase text-black-500">
                                Actions
                            </th>
                            @endif
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @foreach ($levelKemungkinan as $level)
                            <tr>
                                <td class="px-6 py-4 text-center whitespace-no-wrap border-b border-gray-200">
                                    {{ $loop->iteration }}
                                </td>
                                <td class="px-6 py-4 text-center whitespace-no-wrap border-b border-gray-200">
                                    {{ $level->name }}
                                </td>
                                @if (auth()->check() && auth()->user()->hasRole('admin'))
                                <td class="px-6 py-4 text-center whitespace-no-wrap border-b border-gray-200">
                                    <div class="inline-flex justify-center space-x-4">
                                        <button
                                            onclick="openEditLevelKemungkinanModal('{{ route('admin.levelkemungkinan.update', $level->id) }}', '{{ $level->name }}')"
                                            class="px-4 py-2 text-white bg-blue-600 rounded hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2">
                                            Edit
                                        </button>
                                        <form action="{{ route('admin.levelkemungkinan.destroy', $level->id) }}" method="POST" class="inline"
                                            onsubmit="return confirm('Are you sure you want to delete this level kemungkinan?');">
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

                <div id="tambahLevelKemungkinanModal" class="fixed inset-0 flex items-center justify-center hidden">
                    <div class="absolute inset-0 bg-gray-900 opacity-50"></div>
                    <div
                        class="relative z-10 p-6 bg-white border border-black rounded-lg shadow-md modal modal-content">
                        <div class="flex items-center justify-between mb-4">
                            <h2 class="text-xl font-bold">Tambah Level Kemungkinan</h2>
                            <button onclick="toggleModal('tambahLevelKemungkinanModal')"
                                class="ml-4 text-2xl text-gray-500">&times;</button>
                        </div>
                        <form action="{{ route('admin.levelkemungkinan.store') }}" method="POST">
                            @csrf
                            <div class="mb-4">
                                <label class="block mb-2 text-gray-700" for="name">Level
                                    Kemungkinan</label>
                                <input type="text" name="name" id="level_kemungkinan"
                                    value="{{ old('name') }}"
                                    class="block w-full px-3 py-2 mt-1 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
                                    required>
                                @error('level_kemungkinan')
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

                <div id="editLevelKemungkinanModal" class="fixed inset-0 flex items-center justify-center hidden">
                    <div class="absolute inset-0 bg-gray-900 opacity-50"></div>
                    <div
                        class="relative z-10 p-6 bg-white border border-black rounded-lg shadow-md modal modal-content">
                        <div class="flex items-center justify-between mb-4">
                            <h2 class="text-xl font-bold">Edit Level Kemungkinan</h2>
                            <button onclick="toggleModal('editLevelKemungkinanModal')"
                                class="ml-4 text-2xl text-gray-500">&times;</button>
                        </div>
                        <form id="editLevelKemungkinanForm" method="POST">
                            @csrf
                            @method('PUT')
                            <div class="mb-4">
                                <label class="block mb-2 text-gray-700" for="level_kemungkinan_edit">Level
                                    Kemungkinan</label>
                                <input type="text" name="name" id="level_kemungkinan_edit"
                                    class="block w-full px-3 py-2 mt-1 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
                                    required>
                                @error('name')
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

    function openEditLevelKemungkinanModal(url, levelKemungkinan) {
        const editLevelKemungkinanForm = document.getElementById('editLevelKemungkinanForm');
        editLevelKemungkinanForm.action = url;
        document.getElementById('level_kemungkinan_edit').value = levelKemungkinan;
        toggleModal('editLevelKemungkinanModal');
    }
</script>
