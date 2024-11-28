<div id="context4" class="tab-content hidden">
    <section class="bg-white dark:bg-white">
        <div class="-my-2 py-2 overflow-x-auto sm:-mx-6 sm:px-6 lg:-mx-8 lg:px-8">
            <div
                class="align-middle inline-block min-w-full shadow overflow-hidden sm:rounded-lg border-b border-gray-200">
                <button onclick="toggleModal('tambahJenisResikoModal')"
                class="px-4 py-2 mb-2 bg-blue-500 rounded-md text-white font-medium tracking-wide hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-opacity-50 transition duration-300">
                    Tambah Jenis Resiko
                </button>
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-6 py-3 text-center text-xs font-medium text-black-500 uppercase tracking-wider">
                                No
                            </th>
                            <th class="px-6 py-3 text-center text-xs font-medium text-black-500 uppercase tracking-wider">
                                Kode
                            </th>
                            <th class="px-6 py-3 text-center text-xs font-medium text-black-500 uppercase tracking-wider">
                                Jenis Resiko
                            </th>
                            <th class="px-6 py-3 text-center text-xs font-medium text-black-500 uppercase tracking-wider">
                                Actions
                            </th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @foreach ($jenisResiko as $jenis)
                            <tr>
                                <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-200 text-center">
                                    {{ $loop->iteration }}
                                </td>
                                <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-200 text-center">
                                    {{ $jenis->kode }}
                                </td>
                                <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-200 text-center">
                                    {{ $jenis->jenis_resiko }}
                                </td>
                                
                                <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-200 text-center">
                                    <div class="inline-flex space-x-4 justify-center">
                                        <button
                                            onclick="openEditJenisResikoModal('{{ route('admin.jenisresiko.update', $jenis->id) }}', '{{ $jenis->kode }}', '{{ $jenis->jenis_resiko }}')"
                                            class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2">
                                            Edit
                                        </button>
                                        <form action="{{ route('admin.jenisresiko.destroy', $jenis->id) }}" method="POST" class="inline"
                                            onsubmit="return confirm('Are you sure you want to delete this jenis resiko?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="bg-red-600 text-white px-4 py-2 rounded hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-offset-2">
                                                Delete
                                            </button>
                                        </form>
                                    </div>
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

                <!-- Tambah Jenis Resiko Modal -->
                <div id="tambahJenisResikoModal" class="fixed inset-0 flex items-center justify-center hidden">
                    <div class="absolute inset-0 bg-gray-900 opacity-50"></div>
                    <div
                        class="bg-white border border-black shadow-md rounded-lg p-6 modal modal-content relative z-10">
                        <div class="flex justify-between items-center mb-4">
                            <h2 class="text-xl font-bold">Tambah Jenis Resiko</h2>
                            <button onclick="toggleModal('tambahJenisResikoModal')"
                                class="text-gray-500 text-2xl ml-4">&times;</button>
                        </div>
                        <form action="{{ route('admin.jenisresiko.store') }}" method="POST">
                            @csrf
                            <div class="mb-4">
                                <label class="block text-gray-700 mb-2" for="kode">Kode</label>
                                <input type="text" name="kode" id="kode" value="{{ old('kode') }}"
                                    class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
                                    required>
                                @error('kode')
                                    <p class="text-red-500 text-sm mt-2">{{ $message }}</p>
                                @enderror
                            </div>
                            <div class="mb-4">
                                <label class="block text-gray-700 mb-2" for="jenis_resiko">Jenis Resiko</label>
                                <input type="text" name="jenis_resiko" id="jenis_resiko"
                                    value="{{ old('jenis_resiko') }}"
                                    class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
                                    required>
                                @error('jenis_resiko')
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

                <!-- Edit Jenis Resiko Modal -->
                <div id="editJenisResikoModal" class="fixed inset-0 flex items-center justify-center hidden">
                    <div class="absolute inset-0 bg-gray-900 opacity-50"></div>
                    <div
                        class="bg-white border border-black shadow-md rounded-lg p-6 modal modal-content relative z-10">
                        <div class="flex justify-between items-center mb-4">
                            <h2 class="text-xl font-bold">Edit Jenis Resiko</h2>
                            <button onclick="toggleModal('editJenisResikoModal')"
                                class="text-gray-500 text-2xl ml-4">&times;</button>
                        </div>
                        <form id="editJenisResikoForm" method="POST">
                            @csrf
                            @method('PUT')
                            <div class="mb-4">
                                <label class="block text-gray-700 mb-2" for="kode_edit">Kode</label>
                                <input type="text" name="kode" id="kode_edit"
                                    class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
                                    required>
                                @error('kode')
                                    <p class="text-red-500 text-sm mt-2">{{ $message }}</p>
                                @enderror
                            </div>
                            <div class="mb-4">
                                <label class="block text-gray-700 mb-2" for="jenis_resiko_edit">Jenis Resiko</label>
                                <input type="text" name="jenis_resiko" id="jenis_resiko_edit"
                                    class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
                                    required>
                                @error('jenis_resiko')
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

    function openEditJenisResikoModal(url, kode, jenisResiko) {
        const editJenisResikoForm = document.getElementById('editJenisResikoForm');
        editJenisResikoForm.action = url;
        document.getElementById('kode_edit').value = kode;
        document.getElementById('jenis_resiko_edit').value = jenisResiko;
        toggleModal('editJenisResikoModal');
    }
</script>
