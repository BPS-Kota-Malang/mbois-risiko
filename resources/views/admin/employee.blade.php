<x-admin-layout>
    <div class="bg-white p-4 mb-4 border-2 border-white rounded-lg">
        <h3 class="text-gray-700 text-2xl font-medium">Data Pegawai BPS Kota Malang</h3>
    </div>
    <div class="flex justify-between items-center mb-4">
        <div class="flex flex-row items-center">
            <div class="flex flex-col">
                <a href="{{ route('admin.employee.create') }}" class="px-6 py-3 bg-green-500 rounded-md text-white font-medium tracking-wide hover:bg-green-600">Tambah Data Pegawai</a>
            </div>
            <div class="ml-4">
                <form action="{{ route('admin.employee.upload') }}" method="POST" enctype="multipart/form-data" class="border border-gray-300 rounded-md p-2 flex items-center">
                    @csrf
                    <input type="file" name="excel_file" accept=".xlsx, .xls" required class="mr-4">
                    <button type="submit" class="px-6 py-3 bg-blue-500 rounded-md text-white font-medium tracking-wide hover:bg-blue-600">Upload Excel</button>
                </form>
            </div>
        </div>
        <div class="flex items-center">
            <label for="search" class="mr-2">Search:</label>
            <input type="text" id="search" class="px-2 py-1 border border-gray-300 rounded-md">
        </div>
    </div>
    @if (session('success'))
        <div class="bg-green-500 p-4 mb-4 border-2 border-white rounded-lg text-white text-center">
            {{ session('success') }}
        </div>
    @endif
    <div class="overflow-x-auto bg-white shadow-md rounded-lg">
        <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-gray-50">
                <tr>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nama</th>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Email</th>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">NIP</th>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Jabatan</th>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Pangkat</th>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Golongan</th>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Tim</th>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">No. HP</th>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Action</th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
                @foreach ($employees as $employee)
                    <tr>
                        <td class="px-6 py-4 whitespace-nowrap">
                            @php
                                for(
                                    $i = 0;
                                    $i < count($users);
                                    $i++
                                ) {
                                    if($users[$i]->id == $employee->user_id) {
                                        echo $users[$i]->name;
                                    }
                                };
                            @endphp
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            @php
                                for(
                                    $i = 0;
                                    $i < count($users);
                                    $i++
                                ) {
                                    if($users[$i]->id == $employee->user_id) {
                                        echo $users[$i]->email;
                                    }
                                };
                            @endphp
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">{{ $employee->nip }}</td>
                        <td class="px-6 py-4 whitespace-nowrap">{{ $employee->jabatan }}</td>
                        <td class="px-6 py-4 whitespace-nowrap">{{ $employee->pangkat }}</td>
                        <td class="px-6 py-4 whitespace-nowrap">{{ $employee->golongan }}</td>
                        <td class="px-6 py-4 whitespace-nowrap">{{ $employee->tim }}</td>
                        <td class="px-6 py-4 whitespace-nowrap">{{ $employee->no_hp }}</td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <a href="{{ route('admin.employee.edit', $employee->user_id) }}" class="text-indigo-600 hover:text-indigo-900 border border-indigo-600 hover:border-indigo-900 rounded px-2 py-1" title="Edit">Edit</a>
                            <a href="{{ route('admin.employee.destroy', $employee->user_id) }}" class="text-red-600 hover:text-red-900 border border-red-600 hover:border-red-900 rounded px-2 py-1" title="Delete">Delete</a>
                        </td>
                        </td>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

</x-admin-layout>

