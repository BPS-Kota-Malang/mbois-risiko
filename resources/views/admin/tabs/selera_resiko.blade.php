
<div id="context13" class="tab-content hidden">
    <section class="bg-white dark:bg-white">
        <div class="-my-2 py-2 overflow-x-auto sm:-mx-6 sm:px-6 lg:-mx-8 lg:px-8">
            <div class="align-middle inline-block min-w-full shadow overflow-hidden sm:rounded-lg border-b border-gray-200">
                @if (auth()->check() && auth()->user()->hasRole('admin'))
                <button onclick="toggleModal('tambahSeleraResikoModal')"
                    class="px-4 py-2 mb-2 bg-blue-500 rounded-full text-white font-medium tracking-wide hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-opacity-50 transition duration-300">
                    Tambah Selera Resiko
                </button>
                @endif
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                No
                            </th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Kategori Resiko
                            </th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Resiko Minimum (Negatif)
                            </th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Resiko Minimum (Positif)
                            </th>
                            @if (auth()->check() && auth()->user()->hasRole('admin'))
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Actions
                            </th>
                            @endif
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @foreach ($seleraResiko as $selera)
                            <tr>
                                <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-200">
                                    {{ $loop->iteration }}
                                </td>
                                <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-200">
                                    {{ $selera->kategoriResiko->deskripsi }}
                                </td>
                                <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-200">
                                    {{ $selera->resiko_minimum_negatif }}
                                </td>
                                <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-200">
                                    {{ $selera->resiko_minimum_positif }}
                                </td>
                                @if (auth()->check() && auth()->user()->hasRole('admin'))
                                <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-200">
                                    <a href="javascript:void(0)"
                                        onclick="openEditseleraResikoModal('{{ route('admin.seleraresiko.update', $selera->id) }}', '{{ $selera->id_kategori_resiko }}', '{{ $selera->resiko_minimum_negatif }}', '{{ $selera->resiko_minimum_positif }}')"
                                        class="text-indigo-600 hover:text-indigo-900 ml-4">Edit</a>
                                    <form action="{{ route('admin.seleraresiko.destroy', $selera->id) }}" method="POST"
                                        class="inline ml-4"
                                        onsubmit="return confirm('Are you sure you want to delete this selera resiko?');">
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

                <div id="tambahSeleraResikoModal" class="fixed inset-0 flex items-center justify-center hidden">
                    <div class="absolute inset-0 bg-gray-900 opacity-50"></div>
                    <div
                        class="bg-white border border-black shadow-md rounded-lg p-6 modal modal-content relative z-10">
                        <div class="flex justify-between items-center mb-4">
                            <h2 class="text-xl font-bold">Tambah Selera Resiko</h2>
                            <button onclick="toggleModal('tambahseleraResikoModal')"
                                class="text-gray-500 text-2xl ml-4">&times;</button>
                        </div>
                        <form action="{{ route('admin.seleraresiko.store') }}" method="POST">
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
                                <label class="block text-gray-700 mb-2" for="resiko_minimum_negatif">Resiko Minimum (Negatif)</label>
                                <input type="text" name="resiko_minimum_negatif" id="resiko_minimum_negatif"
                                    value="{{ old('resiko_minimum_negatif') }}"
                                    class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
                                    required>
                                @error('resiko_minimum_negatif')
                                    <p class="text-red-500 text-sm mt-2">{{ $message }}</p>
                                @enderror
                            </div>
                            <div class="mb-4">
                                <label class="block text-gray-700 mb-2" for="resiko_minimum_positif">Resiko Minimum (Positif)</label>
                                <input type="text" name="resiko_minimum_positif" id="resiko_minimum_positif"
                                    value="{{ old('resiko_minimum_positif') }}"
                                    class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                                @error('resiko_minimum_positif')
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

                <div id="editseleraResikoModal" class="fixed inset-0 flex items-center justify-center hidden">
                    <div class="absolute inset-0 bg-gray-900 opacity-50"></div>
                    <div
                        class="bg-white border border-black shadow-md rounded-lg p-6 modal modal-content relative z-10">
                        <div class="flex justify-between items-center mb-4">
                            <h2 class="text-xl font-bold">Edit Selera Resiko</h2>
                            <button onclick="toggleModal('editseleraResikoModal')"
                                class="text-gray-500 text-2xl ml-4">&times;</button>
                        </div>
                        <form id="editseleraResikoForm" method="POST">
                            @csrf
                            @method('PUT')
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
                                <label class="block text-gray-700 mb-2" for="resiko_minimum_negatif_edit">Resiko Minimum (Negatif)</label>
                                <input type="text" name="resiko_minimum_negatif" id="resiko_minimum_negatif_edit"
                                    class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
                                    required>
                                @error('resiko_minimum_negatif')
                                    <p class="text-red-500 text-sm mt-2">{{ $message }}</p>
                                @enderror
                            </div>
                            <div class="mb-4">
                                <label class="block text-gray-700 mb-2" for="resiko_minimum_positif_edit">Resiko Minimum (Positif)</label>
                                <input type="text" name="resiko_minimum_positif" id="resiko_minimum_positif_edit"
                                    class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                                @error('resiko_minimum_positif')
                                    <p class="text-red-500 text-sm mt-2">{{ $message }}</p>
                                @enderror
                            </div>
                            <div class="flex items-center justify-end">
                                <button type="submit"
                                    class="bg-blue-500 text-white px-4 py-2 rounded-md">Simpan</button>
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

    function openEditseleraResikoModal(url, idKategoriResiko, resikominimumnegatif, resikominimumpositif) {
        const editseleraResikoForm = document.getElementById('editseleraResikoForm');
        editseleraResikoForm.action = url;

        document.getElementById('edit_id_kategori_resiko').value = idKategoriResiko;
        document.getElementById('resiko_minimum_negatif_edit').value = resikominimumnegatif;
        document.getElementById('resiko_minimum_positif_edit').value = resikominimumpositif;
        toggleModal('editseleraResikoModal');
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
