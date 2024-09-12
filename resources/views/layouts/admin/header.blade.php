<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sidebar Search</title>
    <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
    <style>
        /* Tailwind CSS styles can be included here atau linked externally */
    </style>
</head>
<body>
    <header class="flex items-center justify-between px-6 py-4 bg-white border-b-4 border-indigo-600">
        <div class="flex items-center">
            <button @click="sidebarOpen = true" class="text-gray-500 focus:outline-none lg:hidden">
                <svg class="w-6 h-6" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M4 6H20M4 12H20M4 18H11" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                </svg>
            </button>

            <div class="relative mx-4 lg:mx-0">
                <span class="absolute inset-y-0 left-0 flex items-center pl-3">
                    <svg class="w-5 h-5 text-gray-500" viewBox="0 0 24 24" fill="none">
                        <path d="M21 21L15 15M17 10C17 13.866 13.866 17 10 17C6.13401 17 3 13.866 3 10C3 6.13401 6.13401 3 10 3C13.866 3 17 6.13401 17 10Z" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                    </svg>
                </span>

                <input id="searchInput" class="w-32 pl-10 pr-4 rounded-md form-input sm:w-64 focus:border-indigo-600" type="text" placeholder="Search" onkeydown="if(event.key === 'Enter'){ searchFeature(); }">
            </div>
        </div>

        <div class="flex items-center">
            <div x-data="{ notificationOpen: false }" class="relative">
                <button @click="notificationOpen = ! notificationOpen" class="flex mx-4 text-gray-600 focus:outline-none">
                    <svg class="w-6 h-6" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M15 17H20L18.5951 15.5951C18.2141 15.2141 18 14.6973 18 14.1585V11C18 8.38757 16.3304 6.16509 14 5.34142V5C14 3.89543 13.1046 3 12 3C10.8954 3 10 3.89543 10 5V5.34142C7.66962 6.16509 6 8.38757 6 11V14.1585C6 14.6973 5.78595 15.2141 5.40493 15.5951L4 17H9M15 17V18C15 19.6569 13.6569 21 12 21C10.3431 21 9 19.6569 9 18V17M15 17H9" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                    </svg>
                </button>

                <div x-cloak x-show="notificationOpen" @click="notificationOpen = false" class="fixed inset-0 z-10 w-full h-full"></div>

                <div x-cloak x-show="notificationOpen" class="absolute right-0 z-10 mt-2 overflow-hidden bg-white rounded-lg shadow-xl w-80" style="width:20rem;">
                    <!-- Notifications content here -->
                    <a href="#" class="flex items-center px-4 py-3 -mx-2 text-gray-600 hover:text-white hover:bg-indigo-600">
                        <img class="object-cover w-8 h-8 mx-1 rounded-full" src="https://images.unsplash.com/photo-1494790108377-be9c29b29330?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=crop&w=334&q=80" alt="avatar">
                        <p class="mx-2 text-sm">
                            <span class="font-bold">Sara Salah</span> replied on the <span class="font-bold text-indigo-400">Upload Image</span> article . 2m
                        </p>
                    </a>
                    <!-- Add more notification items here -->
                </div>
            </div>

            <div x-data="{ dropdownOpen: false }" class="relative">
                <button @click="dropdownOpen = ! dropdownOpen" class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 dark:text-gray-400 bg-white dark:bg-gray-800 hover:text-gray-700 dark:hover:text-gray-300 focus:outline-none transition ease-in-out duration-150">
                    <div>{{ explode(' ', Auth::user()->name)[0] }}</div>
                    <svg class="w-4" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" stroke="#545454" stroke-width="0.00024000000000000003">
                        <path fill-rule="evenodd" clip-rule="evenodd" d="M12.7071 14.7071C12.3166 15.0976 11.6834 15.0976 11.2929 14.7071L6.29289 9.70711C5.90237 9.31658 5.90237 8.68342 6.29289 8.29289C6.68342 7.90237 7.31658 7.90237 7.70711 8.29289L12 12.5858L16.2929 8.29289C16.6834 7.90237 17.3166 7.90237 17.7071 8.29289C18.0976 8.68342 18.0976 9.31658 17.7071 9.70711L12.7071 14.7071Z" fill="#5c5c5c"></path>
                    </svg>
                </button>

                <div x-cloak x-show="dropdownOpen" @click="dropdownOpen = false" class="fixed inset-0 z-10 w-full h-full"></div>

                <div x-cloak x-show="dropdownOpen" class="absolute right-0 z-10 w-48 mt-2 overflow-hidden bg-white rounded-md shadow-xl">
                    <a href="#" class="block px-4 py-2 text-sm text-gray-700 hover:bg-indigo-600 hover:text-white">Setting</a>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <a class="block px-4 py-2 text-sm text-gray-700 hover:bg-indigo-600 hover:text-white" :href="route('logout')"
                                onclick="event.preventDefault(); this.closest('form').submit();">
                            Log Out
                        </a>
                    </form>
                </div>
            </div>
        </div>
    </header>

    <script>
        function searchFeature() {
            var input = document.getElementById('searchInput').value.toLowerCase();

            switch (input) {
                case 'dashboard':
                    window.location.href = '/dashboard';
                    break;
                case 'konteks':
                case 'context':
                case 'setting konteks':
                    window.location.href = '/context';
                    break;
                case 'identifikasi':
                    window.location.href = '/manajemenrisiko';
                    break;
                case 'analisis':
                case 'analysis':
                    window.location.href = '/analisis';
                    break;
                case 'data pegawai':
                case 'pegawai':
                    window.location.href = '/admin/employee';
                    break;
                case 'resiko':
                    window.location.href = '/resiko';
                    break;
                case 'penyebab':
                    window.location.href = '/penyebab';
                    break;
                case 'dampak':
                    window.location.href = '/dampak';
                    break;
                case 'uraian':
                    window.location.href = '/uraian';
                    break;
                case 'users':
                case 'user':
                    window.location.href = '/admin/users';
                    break;
                case 'role':
                case 'roles':
                    window.location.href = '/admin/roles';
                    break;
                case 'perizinan':
                    window.location.href = '/admin/permissions';
                    break;
                default:
                    alert('Fitur yang anda cari tidak tersedia');
                    break;
            }
        }
    </script>
</body>
</html>
