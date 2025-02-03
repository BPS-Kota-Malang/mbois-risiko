<x-admin-layout>
    <x-slot name="header">
        <h1 class="text-2xl font-bold">Create User</h1>
    </x-slot>

    <div class="bg-white dark:bg-gray-800 p-6 rounded-lg shadow-md">
        <form action="{{ route('admin.users.store') }}" method="POST">
            @csrf

            <div class="mb-4">
                <label for="name" class="block text-sm font-medium text-gray-700 dark:text-gray-200">Name</label>
                <input type="text" id="name" name="name" value="{{ old('name') }}" 
                    class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring focus:ring-indigo-500 focus:ring-opacity-50" 
                    required>
                @error('name')
                    <span class="text-red-600 text-sm">{{ $message }}</span>
                @enderror
            </div>

            <div class="mb-4">
                <label for="email" class="block text-sm font-medium text-gray-700 dark:text-gray-200">Email</label>
                <input type="email" id="email" name="email" value="{{ old('email') }}" 
                    class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring focus:ring-indigo-500 focus:ring-opacity-50" 
                    required>
                @error('email')
                    <span class="text-red-600 text-sm">{{ $message }}</span>
                @enderror
            </div>

            <div class="mb-4">
                <label for="password" class="block text-sm font-medium text-gray-700 dark:text-gray-200">Password</label>
                <input type="password" id="password" name="password" 
                    class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring focus:ring-indigo-500 focus:ring-opacity-50" 
                    required>
                @error('password')
                    <span class="text-red-600 text-sm">{{ $message }}</span>
                @enderror
            </div>

            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700 dark:text-gray-200">Roles</label>
                @foreach($roles as $role)
                    <div class="flex items-center mb-2">
                        <input 
                            type="checkbox" 
                            id="role_{{ $role->id }}" 
                            name="roles[]" 
                            value="{{ $role->id }}" 
                            data-role="{{ strtolower(str_replace(' ', '_', $role->name)) }}" 
                            {{ in_array($role->id, old('roles', [])) ? 'checked' : '' }}
                            class="role-checkbox mr-2">
                        <label for="role_{{ $role->id }}" class="text-sm text-gray-900 dark:text-gray-100">{{ $role->name }}</label>
                    </div>
                @endforeach
                @error('roles')
                    <span class="text-red-600 text-sm">{{ $message }}</span>
                @enderror
            </div>

            <div class="flex items-center justify-between">
                <a href="{{ route('admin.users.index') }}" class="inline-flex items-center px-4 py-2 bg-red-600 border border-transparent rounded-md font-semibold text-white text-xs uppercase tracking-widest shadow-sm hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500">
                    Back to Users List
                </a>
                <button type="submit" class="inline-flex items-center px-4 py-2 bg-indigo-600 border border-transparent rounded-md font-semibold text-white text-xs uppercase tracking-widest shadow-sm hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                    Create User
                </button>
            </div>
        </form>
    </div>
    <script>
        document.addEventListener('DOMContentLoaded', () => {
    const checkboxes = document.querySelectorAll('.role-checkbox');

    checkboxes.forEach(checkbox => {
        checkbox.addEventListener('change', () => {
            const role = checkbox.getAttribute('data-role');

            if (checkbox.checked) {
                // Jika "ketua_tim" dicentang, otomatis uncheck "anggota_tim"
                if (role === 'ketua_tim') {
                    toggleCheckbox('anggota_tim', false);
                }
                // Jika "anggota_tim" dicentang, otomatis uncheck "ketua_tim"
                else if (role === 'anggota_tim') {
                    toggleCheckbox('ketua_tim', false);
                }
            }
        });
    });

    function toggleCheckbox(role, isChecked) {
        checkboxes.forEach(cb => {
            if (cb.getAttribute('data-role') === role) {
                cb.checked = isChecked;
            }
        });
    }
});

    </script>
</x-admin-layout>
