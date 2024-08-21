<div id="context1" class="tab-content hidden">
    <section class="bg-white dark:bg-white">
        <div class="-my-2 py-2 overflow-x-auto sm:-mx-6 sm:px-6 lg:-mx-8 lg:px-8">
            <div
                class="align-middle inline-block min-w-full shadow overflow-hidden sm:rounded-lg border-b border-gray-200">
                <button onclick="toggleModal('tambahpemangkuKepentinganModal')"
                class="px-4 py-2 mb-2 bg-blue-500 rounded-md text-white font-medium tracking-wide hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-opacity-50 transition duration-300">
                    Tambah
                </button>
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-medium text-black-500 uppercase tracking-wider">No
                            </th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-black-500 uppercase tracking-wider">
                                Pemangku Kepentingan</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-black-500 uppercase tracking-wider">
                                Kelompok Pemangku Kepentingan</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-black-500 uppercase tracking-wider">
                                Hubungan</th>
                                <th class="px-6 py-3 text-center pl-6 pr-1 text-xs font-medium text-black-500 uppercase tracking-wider">
                                    Actions
                                </th>
                                
                                
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @foreach ($pemangkuKepentingan as $pemangku)
                        <tr>
                            <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-200">
                                {{ $loop->iteration }}
                            </td>
                            <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-200">
                                {{ $pemangku->pemangku_kepentingan }}
                            </td>
                            <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-200">
                                {{ $pemangku->kelompok_pemangku_kepentingan }}
                            </td>
                            <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-200">
                                {{ $pemangku->hubungan ?? '-' }}
                            </td>
                            <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-200 text-center">
                                <div class="inline-flex space-x-4">
                                    <button
                                        onclick="openEditPemangkuKepentinganModal('{{ route('admin.pemangkukepentingan.update', $pemangku->id) }}', '{{ $pemangku->pemangku_kepentingan }}', '{{ $pemangku->kelompok_pemangku_kepentingan }}', '{{ $pemangku->hubungan ?? '' }}')"
                                        class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2">
                                        Edit
                                    </button>
                                    <form action="{{ route('admin.pemangkukepentingan.destroy', $pemangku->id) }}" method="POST" class="inline"
                                        onsubmit="return confirm('Are you sure you want to delete this pemangku kepentingan?');">
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
                <div id="tambahpemangkuKepentinganModal" class="fixed inset-0 flex items-center justify-center hidden">
                    <div class="absolute inset-0 bg-gray-900 opacity-50"></div>
                    <div
                        class="bg-white border border-black shadow-md rounded-lg p-6 modal modal-content relative z-10">
                        <div class="flex justify-between items-center mb-4">
                            <h2 class="text-xl font-bold">Tambah Pemangku Kepentingan</h2>
                            <button onclick="toggleModal('tambahpemangkuKepentinganModal')" class="text-gray-500 text-2xl ml-4">&times;</button>
                        </div>
                        <form action="{{ route('admin.pemangkukepentingan.store') }}" method="POST">
                            @csrf
                            <div class="mb-4">
                                <label class="block text-gray-700 mb-2" for="pemangku-kepentingan">Pemangku
                                    Kepentingan</label>
                                <input type="text" name="pemangku_kepentingan" id="pemangku-kepentingan"
                                    value="{{ old('pemangku_kepentingan') }}"
                                    class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
                                    required>
                                @error('pemangku_kepentingan')
                                    <p class="text-red-500 text-sm mt-2">{{ $message }}</p>
                                @enderror
                            </div>
                            <div class="mb-4">
                                <label class="block text-gray-700 mb-2" for="kelompok-pemangku-kepentingan">Kelompok
                                    Pemangku Kepentingan</label>
                                <input type="text" name="kelompok_pemangku_kepentingan"
                                    id="kelompok-pemangku-kepentingan"
                                    value="{{ old('kelompok_pemangku_kepentingan') }}"
                                    class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
                                    required>
                                @error('kelompok_pemangku_kepentingan')
                                    <p class="text-red-500 text-sm mt-2">{{ $message }}</p>
                                @enderror
                            </div>
                            <div class="mb-4">
                                <label class="block text-gray-700 mb-2" for="hubungan">Hubungan (opsional)</label>
                                <input type="text" name="hubungan" id="hubungan" value="{{ old('hubungan') }}"
                                    class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                                @error('hubungan')
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


                <div id="editpemangkuKepentinganModal" class="fixed inset-0 flex items-center justify-center hidden">
                    <div class="absolute inset-0 bg-gray-900 opacity-50"></div>
                    <div
                        class="bg-white border border-black shadow-md rounded-lg p-6 modal modal-content relative z-10">
                        <div class="flex justify-between items-center mb-4">
                            <h2 class="text-xl font-bold">Edit Pemangku Kepentingan</h2>
                            <button onclick="toggleModal('editpemangkuKepentinganModal')"
                                class="text-gray-500 text-2xl ml-4">&times;</button>
                        </div>
                        <form id="editPemangkuKepentinganForm" method="POST">
                            @csrf
                            @method('PUT')
                            <div class="mb-4">
                                <label class="block text-gray-700 mb-2" for="pemangku_kepentingan_edit">Pemangku
                                    Kepentingan</label>
                                <input type="text" name="pemangku_kepentingan" id="pemangku_kepentingan_edit"
                                    class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
                                    required>
                                @error('pemangku_kepentingan')
                                    <p class="text-red-500 text-sm mt-2">{{ $message }}</p>
                                @enderror
                            </div>
                            <div class="mb-4">
                                <label class="block text-gray-700 mb-2"
                                    for="kelompok_pemangku_kepentingan_edit">Kelompok Pemangku Kepentingan</label>
                                <input type="text" name="kelompok_pemangku_kepentingan"
                                    id="kelompok_pemangku_kepentingan_edit"
                                    class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
                                    required>
                                @error('kelompok_pemangku_kepentingan')
                                    <p class="text-red-500 text-sm mt-2">{{ $message }}</p>
                                @enderror
                            </div>
                            <div class="mb-4">
                                <label class="block text-gray-700 mb-2" for="hubungan_edit">Hubungan
                                    (opsional)</label>
                                <input type="text" name="hubungan" id="hubungan_edit"
                                    class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                                @error('hubungan')
                                    <p class="text-red-500 text-sm mt-2">{{ $message }}</p>
                                @enderror
                            </div>
                            <div class="flex items-center justify-end">
                                <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded-md">Ubah
                                </button>
                            </div>
                        </form>
                    </div>
                </div>

            </div>
        </div>
    </section>
</div>

<script>
    function toggleModal() {
        document.getElementById(modalId).classList.toggle('hidden');
    }

    // function toggleEditModal() {
    //     document.getElementById('editpemangkuKepentinganModal').classList.toggle('hidden');
    // }

    function openEditPemangkuKepentinganModal(url, pemangkuKepentingan, kelompokPemangkuKepentingan, hubungan) {
        const editPemangkuKepentinganForm = document.getElementById('editPemangkuKepentinganForm');
        editPemangkuKepentinganForm.action = url;
        document.getElementById('pemangku_kepentingan_edit').value = pemangkuKepentingan;
        document.getElementById('kelompok_pemangku_kepentingan_edit').value = kelompokPemangkuKepentingan;
        document.getElementById('hubungan_edit').value = hubungan || '';
        toggleModal('editpemangkuKepentinganModal');
    }
</script>
