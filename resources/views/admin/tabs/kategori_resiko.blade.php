<div id="context7" class="hidden tab-content">
    <section class="bg-white dark:bg-gray-100">
        <div class="py-2 -my-2 overflow-x-auto sm:-mx-6 sm:px-6 lg:-mx-8 lg:px-8">
            <div
                class="inline-block min-w-full overflow-hidden align-middle border-b border-gray-200 shadow sm:rounded-lg">
                @if (auth()->check() && auth()->user()->hasRole('admin'))
                <button onclick="toggleModal('tambahKategoriResikoModal')"
                    class="px-4 py-2 mb-2 font-medium tracking-wide text-white transition duration-300 bg-blue-500 rounded-md hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-opacity-50">
                    Tambah Kategori Resiko
                </button>
                @endif

                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-6 py-3 text-xs font-medium tracking-wider text-left uppercase text-black-500">
                                No
                            </th>
                            <th class="px-6 py-3 text-xs font-medium tracking-wider text-left uppercase text-black-500">
                                Deskripsi
                            </th>
                            <th class="px-6 py-3 text-xs font-medium tracking-wider text-left uppercase text-black-500">
                                Definisi
                            </th>
                            @if (auth()->check() && auth()->user()->hasRole('admin'))
                            <th class="px-6 py-3 text-xs font-medium tracking-wider text-center uppercase text-black-500">
                                Actions
                            </th>
                            @endif
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @foreach ($kategoriResiko as $kategori)
                            <tr>
                                <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-200">
                                    {{ $loop->iteration }}
                                </td>
                                <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-200">
                                    {{ $kategori->deskripsi }}
                                </td>
                                <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-200">
                                    {{ $kategori->definisi }}
                                </td>
                                @if (auth()->check() && auth()->user()->hasRole('admin'))
                                <td class="flex items-center justify-center px-6 py-4 space-x-4 text-center whitespace-no-wrap border-b border-gray-200">
                                    <a href="javascript:void(0)"
                                        onclick="openEditKategoriResikoModal('{{ route('admin.kategoriresiko.update', $kategori->id) }}', '{{ $kategori->deskripsi }}', '{{ $kategori->definisi }}')"
                                        class="px-4 py-2 text-white bg-blue-600 rounded hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2">Edit</a>
                                    <form action="{{ route('admin.kategoriresiko.destroy', $kategori->id) }}"
                                        method="POST" class="inline"
                                        onsubmit="return confirm('Are you sure you want to delete this kategori resiko?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="px-4 py-2 text-white bg-red-600 rounded hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-offset-2">Delete</button>
                                    </form>
                                </td>
                                @endif

                            </tr>
                        @endforeach
                    </tbody>
                </table>

                <div id="tambahKategoriResikoModal" class="fixed inset-0 flex items-center justify-center hidden">
                    <div class="absolute inset-0 bg-gray-900 opacity-50"></div>
                    <div
                        class="relative z-10 p-6 bg-white border border-black rounded-lg shadow-md modal modal-content">
                        <div class="flex items-center justify-between mb-4">
                            <h2 class="text-xl font-bold">Tambah Kategori Resiko</h2>
                            <button onclick="toggleModal('tambahKategoriResikoModal')"
                                class="ml-4 text-2xl text-gray-500">&times;</button>
                        </div>
                        <form action="{{ route('admin.kategoriresiko.store') }}" method="POST">
                            @csrf
                            <div class="mb-4">
                                <label class="block mb-2 text-gray-700" for="deskripsi">Deskripsi</label>
                                <input type="text" name="deskripsi" id="deskripsi" value="{{ old('deskripsi') }}"
                                    class="block w-full px-3 py-2 mt-1 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
                                    required>
                                @error('deskripsi')
                                    <p class="mt-2 text-sm text-red-500">{{ $message }}</p>
                                @enderror
                            </div>
                            <div class="mb-4">
                                <label class="block mb-2 text-gray-700" for="definisi">Definisi</label>
                                <input type="text" name="definisi" id="definisi" value="{{ old('definisi') }}"
                                    class="block w-full px-3 py-2 mt-1 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
                                    required>
                                @error('definisi')
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

                <div id="editKategoriResikoModal" class="fixed inset-0 flex items-center justify-center hidden">
                    <div class="absolute inset-0 bg-gray-900 opacity-50"></div>
                    <div
                        class="relative z-10 p-6 bg-white border border-black rounded-lg shadow-md modal modal-content">
                        <div class="flex items-center justify-between mb-4">
                            <h2 class="text-xl font-bold">Edit Kategori Resiko</h2>
                            <button onclick="toggleModal('editKategoriResikoModal')"
                                class="ml-4 text-2xl text-gray-500">&times;</button>
                        </div>
                        <form id="editKategoriResikoForm" method="POST">
                            @csrf
                            @method('PUT')
                            <div class="mb-4">
                                <label class="block mb-2 text-gray-700"
                                    for="deskripsi_kategori_resiko_edit">Deskripsi</label>
                                <input type="text" name="deskripsi" id="deskripsi_kategori_resiko_edit"
                                    class="block w-full px-3 py-2 mt-1 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
                                    required>
                                @error('deskripsi')
                                    <p class="mt-2 text-sm text-red-500">{{ $message }}</p>
                                @enderror
                            </div>
                            <div class="mb-4">
                                <label class="block mb-2 text-gray-700" for="definisi_edit">Definisi</label>
                                <input type="text" name="definisi" id="definisi_edit"
                                    class="block w-full px-3 py-2 mt-1 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
                                    required>
                                @error('definisi')
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

    function openEditKategoriResikoModal(url, deskripsi, definisi) {
        const editKategoriResikoForm = document.getElementById('editKategoriResikoForm');
        editKategoriResikoForm.action = url;
        document.getElementById('deskripsi_kategori_resiko_edit').value = deskripsi;
        document.getElementById('definisi_edit').value = definisi;
        toggleModal('editKategoriResikoModal');
    }
</script>
