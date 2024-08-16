<x-admin-layout>
    <div class="bg-white p-4 mb-4 border-2 border-white rounded-lg">
        <h3 class="text-gray-700 text-2xl font-medium">Tambah Data Pegawai</h3>
    </div>
    @if (session('success'))
        <div class="bg-green-500 p-4 mb-4 border-2 border-white rounded-lg text-white text-center">
            {{ session('success') }}
        </div>
    @elseif (session('error'))
        <div class="bg-red-500 p-4 mb-4 border-2 border-white rounded-lg text-white text-center">
            {{ session('error') }}
        </div>
    @endif
    <form action="{{ route('admin.employee.store') }}" method="POST" class="bg-white p-4 mb-4 border-2 border-white rounded-lg">
        @csrf
        <div class="grid grid-cols-2 gap-4">
            <div>
                <label for="name" class="block text-sm font-medium text-gray-700">Nama</label>
                <input type="text" name="name" id="name" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-1 px-2 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
            </div>
            <div>
                <label for="name" class="block text-sm font-medium text-gray-700">Email</label>
                <input type="text" name="email" id="email" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-1 px-2 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
            </div>
            <div>
                <label for="name" class="block text-sm font-medium text-gray-700">Password</label>
                <input type="text" name="password" id="password" value="bpsmalang123" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-1 px-2 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" readonly>
            </div>
            <div>
                <label for="nip" class="block text-sm font-medium text-gray-700">NIP</label>
                <input type="text" name="nip" id="nip" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-1 px-2 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
            </div>
            <div>
                <label for="jabatan" class="block text-sm font-medium text-gray-700">Jabatan</label>
                <input type="text" name="jabatan" id="jabatan" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-1 px-2 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
            </div>
            <div>
                <label for="pangkat" class="block text-sm font-medium text-gray-700">Pangkat</label>
                <input type="text" name="pangkat" id="pangkat" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-1 px-2 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
            </div>
            <div>
                <label for="golongan" class="block text-sm font-medium text-gray-700">Golongan</label>
                <input type="text" name="golongan" id="golongan" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-1 px-2 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
            </div>
            <div>
                <label for="tim" class="block text-sm font-medium text-gray-700">Tim</label>
                <input type="text" name="tim" id="tim" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-1 px-2 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
            </div>
            <div>
                <label for="no_hp" class="block text-sm font-medium text-gray-700">No. HP</label>
                <input type="text" name="no_hp" id="no_hp" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-1 px-2 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
            </div>
        </div>
        <div class="mt-4">
            <button type="submit" class="px-6 py-3 bg-green-500 rounded-md text-white font-medium tracking-wide hover:bg-green-600">Tambah Data Pegawai</button>
        </div>
    </form>
</x-admin-layout>
