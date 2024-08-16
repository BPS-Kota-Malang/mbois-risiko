<div id="context5" class="tab-content hidden">
    <section class="bg-white dark:bg-white">
        <div class="-my-2 py-2 overflow-x-auto sm:-mx-6 sm:px-6 lg:-mx-8 lg:px-8">
            <div
                class="align-middle inline-block min-w-full shadow overflow-hidden sm:rounded-lg border-b border-gray-200">
                <button onclick="toggleModal('tambahSumberResikoModal')"
                    class="px-4 py-2 mb-2 bg-blue-500 rounded-full text-white font-medium tracking-wide hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-opacity-50 transition duration-300">
                    Tambah Sumber Resiko
                </button>
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                No
                            </th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Kode
                            </th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Sumber Resiko
                            </th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Actions
                            </th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @foreach ($sumberResiko as $sumber)
                            <tr>
                                <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-200">
                                    {{ $loop->iteration }}
                                </td>
                                <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-200">
                                    {{ $sumber->kode }}
                                </td>
                                <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-200">
                                    {{ $sumber->sumber_resiko }}
                                </td>
                                <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-200">
                                    <a href="javascript:void(0)"
                                        onclick="openEditSumberResikoModal('{{ route('admin.sumber-resiko.update', $sumber->id) }}', '{{ $sumber->kode }}', '{{ $sumber->sumber_resiko }}')"
                                        class="text-indigo-600 hover:text-indigo-900 ml-4">Edit</a>
                                    <form action="{{ route('admin.sumber-resiko.delete', $sumber->id) }}" method="POST"
                                        class="inline ml-4"
                                        onsubmit="return confirm('Are you sure you want to delete this sumber resiko?');">
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
                <div id="tambahSumberResikoModal" class="fixed inset-0 flex items-center justify-center hidden">
                    <div class="absolute inset-0 bg-gray-900 opacity-50"></div>
                    <div
                        class="bg-white border border-black shadow-md rounded-lg p-6 modal modal-content relative z-10">
                        <div class="flex justify-between items-center mb-4">
                            <h2 class="text-xl font-bold">Tambah Sumber Resiko</h2>
                            <button onclick="toggleModal('tambahSumberResikoModal')"
                                class="text-gray-500 text-2xl ml-4">&times;</button>
                        </div>
                        <form action="{{ route('admin.sumber-resiko.store') }}" method="POST">
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
                                <label class="block text-gray-700 mb-2" for="sumber_resiko">Sumber Resiko</label>
                                <input type="text" name="sumber_resiko" id="sumber_resiko"
                                    value="{{ old('sumber_resiko') }}"
                                    class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
                                    required>
                                @error('sumber_resiko')
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
                <div id="editSumberResikoModal" class="fixed inset-0 flex items-center justify-center hidden">
                    <div class="absolute inset-0 bg-gray-900 opacity-50"></div>
                    <div
                        class="bg-white border border-black shadow-md rounded-lg p-6 modal modal-content relative z-10">
                        <div class="flex justify-between items-center mb-4">
                            <h2 class="text-xl font-bold">Edit Sumber Resiko</h2>
                            <button onclick="toggleModal('editSumberResikoModal')"
                                class="text-gray-500 text-2xl ml-4">&times;</button>
                        </div>
                        <form id="editSumberResikoForm" method="POST">
                            @csrf
                            @method('PUT')
                            <div class="mb-4">
                                <label class="block text-gray-700 mb-2" for="kode_edit_sumber_resiko">Kode</label>
                                <input type="text" name="kode" id="kode_edit_sumber_resiko"
                                    class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
                                    required>
                                @error('kode')
                                    <p class="text-red-500 text-sm mt-2">{{ $message }}</p>
                                @enderror
                            </div>
                            <div class="mb-4">
                                <label class="block text-gray-700 mb-2" for="sumber_resiko_edit">Sumber Resiko</label>
                                <input type="text" name="sumber_resiko" id="sumber_resiko_edit"
                                    class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
                                    required>
                                @error('sumber_resiko')
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

    function openEditSumberResikoModal(url, kode, sumberResiko) {
        const editSumberResikoForm = document.getElementById('editSumberResikoForm');
        editSumberResikoForm.action = url;
        document.getElementById('kode_edit_sumber_resiko').value = kode;
        document.getElementById('sumber_resiko_edit').value = sumberResiko;
        toggleModal('editSumberResikoModal');
    }
</script>
