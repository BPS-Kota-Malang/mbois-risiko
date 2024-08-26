<div x-cloak :class="sidebarOpen ? 'block' : 'hidden'" @click="sidebarOpen = false"
    class="fixed inset-0 z-20 transition-opacity bg-black opacity-50 lg:hidden"></div>

<div x-cloak :class="sidebarOpen ? 'translate-x-0 ease-out' : '-translate-x-full ease-in'"
    class="fixed inset-y-0 left-0 z-30 w-64 overflow-y-auto transition duration-300 transform bg-blue-500 lg:translate-x-0 lg:static lg:inset-0">
    <div class="flex items-center justify-center mt-8">
        <div class="flex items-center">
            <image src="{{ asset('images/MBOIS1.png') }}" x="0" y="0" width="250" height="250" />



        {{-- <span class="mx-2 text-2xl font-semibold text-white">BPS</span> --}}
        </div>
    </div>

    <nav class="mt-10">
        <a class="flex items-center px-6 py-2 mt-4 {{ Route::currentRouteNamed('admin.risk.context') ? 'text-white' : 'text-white' }} hover:bg-gray-700 hover:bg-opacity-25"
            href="{{ route('admin.risk.context') }}">
            <svg class="w-6 h-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M11 3.055A9.001 9.001 0 1020.945 13H11V3.055z" />
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M20.488 9H15V3.512A9.025 9.025 0 0120.488 9z" />
            </svg>

            <span class="mx-3">Dashboard</span>
        </a>

        {{-- <a class="flex items-center px-6 py-2 mt-4 {{ Route::currentRouteNamed('admin.forms') ? 'text-white' : 'text-white' }} hover:bg-gray-700 hover:bg-opacity-25"
            href="{{ route('admin.forms') }}">
            <svg class="w-6 h-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M17 14v6m-3-3h6M6 10h2a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v2a2 2 0 002 2zm10 0h2a2 2 0 002-2V6a2 2 0 00-2-2h-2a2 2 0 00-2 2v2a2 2 0 002 2zM6 20h2a2 2 0 002-2v-2a2 2 0 00-2-2H6a2 2 0 00-2 2v2a2 2 0 002 2z" />
            </svg>
            <span class="mx-3">Forms</span>
        </a> --}}

        <div class="relative group ">
            <button id="dropdown-button"
                class="flex items-center px-6 py-2 mt-4 {{ Route::currentRouteNamed('admin.risk.context') || Route::currentRouteNamed('admin.risk.identification') || Route::currentRouteNamed('admin.risk.analysis') || Route::currentRouteNamed('admin.risk.evaluation') || Route::currentRouteNamed('admin.risk.action_plan') ? 'text-white' : 'text-white' }} hover:bg-gray-700 hover:bg-opacity-25">
                <svg class="h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none"
                    viewBox="0 0 24 24"stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z">
                    </path>
                </svg>
                <span class="mx-3 ">Risk Management</span>
                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 ml-2 -mr-1" viewBox="0 0 20 20"
                    fill="currentColor" aria-hidden="true">
                    <path fill-rule="evenodd"
                        d="M6.293 9.293a1 1 0 011.414 0L10 11.586l2.293-2.293a1 1 0 111.414 1.414l-3 3a1 1 0 01-1.414 0l-3-3a1 1 0 010-1.414z"
                        clip-rule="evenodd" />
                </svg>
            </button>
            <div id="dropdown-menu" class="dropdown_branding w-full">
                <a class="flex items-center px-6 py-2 mt-4 ml-5 {{ Route::currentRouteNamed('admin.risk.context') ? 'text-white' : 'text-white' }} hover:bg-gray-700 hover:bg-opacity-25"
                    href="{{ route('admin.risk.context') }}">
                    <svg class="w-6 h-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M17 14v6m-3-3h6M6 10h2a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v2a2 2 0 002 2zm10 0h2a2 2 0 002-2V6a2 2 0 00-2-2h-2a2 2 0 00-2 2v2a2 2 0 002 2zM6 20h2a2 2 0 002-2v-2a2 2 0 00-2-2H6a2 2 0 00-2 2v2a2 2 0 002 2z" />
                    </svg>
                    <span class="mx-3">Context Setting</span>
                </a>

                <a class="flex items-center px-6 py-2 mt-4 ml-5 {{ Route::currentRouteNamed('admin.risk.identification') ? 'text-white' : 'text-white' }} hover:bg-gray-700 hover:bg-opacity-25"
                    href="{{ route('admin.risk.identification') }}">
                    <svg class="w-6 h-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10" />
                    </svg>
                    <span class="mx-3">Risk Identification</span>
                </a>

                <a class="flex items-center px-6 py-2 mt-4 ml-5 {{ Route::currentRouteNamed('admin.risk.analysis') ? 'text-white' : 'text-white' }} hover:bg-gray-700 hover:bg-opacity-25"
                    href="{{ route('admin.risk.analysis') }}">
                    <svg class="w-6 h-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                    </svg>
                    <span class="mx-3">Risk Analysis</span>
                </a>

                <a class="flex items-center px-6 py-2 mt-4 ml-5 {{ Route::currentRouteNamed('admin.risk.evaluation') ? 'text-white' : 'text-white' }} hover:bg-gray-700 hover:bg-opacity-25"
                    href="{{ route('admin.risk.evaluation') }}">
                    <svg class="w-6 h-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                    </svg>
                    <span class="mx-3">Risk Evaluation</span>
                </a>

                <a class="flex items-center px-6 py-2 mt-4 ml-5 {{ Route::currentRouteNamed('admin.risk.action_plan') ? 'text-white' : 'text-white' }} hover:bg-gray-700 hover:bg-opacity-25"
                    href="{{ route('admin.risk.action_plan') }}">
                    <svg class="w-6 h-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                    </svg>
                    <span class="mx-3">Action Plan</span>
                </a>
            </div>
        </div>
        <a class="flex items-center px-6 py-2 mt-4 {{ Route::currentRouteNamed('admin.employee') ? 'text-white' : 'text-white' }} hover:bg-gray-700 hover:bg-opacity-25"
            href="{{ route('admin.employee') }}">
            <svg class="w-6 h-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
            stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                d="M17 14v6m-3-3h6M6 10h2a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v2a2 2 0 002 2zm10 0h2a2 2 0 002-2V6a2 2 0 00-2-2h-2a2 2 0 00-2 2v2a2 2 0 002 2zM6 20h2a2 2 0 002-2v-2a2 2 0 00-2-2H6a2 2 0 00-2 2v2a2 2 0 002 2z" />
            </svg>
            <span class="mx-3">Data Pegawai</span>
        </a>

        <a class="flex items-center px-6 py-2 mt-4 {{ Route::currentRouteNamed('admin.resiko') ? 'text-white' : 'text-white' }} hover:bg-gray-700 hover:bg-opacity-25"
        href="{{ route('admin.resiko.index') }}">
        <svg class="w-6 h-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                d="M12 2a10 10 0 00-10 10 10 10 0 0010 10 10 10 0 0010-10A10 10 0 0012 2zm0 18a8 8 0 110-16 8 8 0 010 16zm0-11a1 1 0 00-1 1v4a1 1 0 002 0v-4a1 1 0 00-1-1zm0 6a1.5 1.5 0 110 3 1.5 1.5 0 010-3z"/>
        </svg>
        <span class="mx-3">Resiko</span>
    </a>
    

        <a class="flex items-center px-6 py-2 mt-4 {{ Route::currentRouteNamed('admin.penyebab') ? 'text-white' : 'text-white' }} hover:bg-gray-700 hover:bg-opacity-25"
        href="{{ route('admin.penyebab.index') }}">
            <svg class="w-6 h-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <!-- Ganti path dengan SVG icon yang sesuai untuk "Penyebab" -->
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                d="M12 6a6 6 0 016 6v6a6 6 0 01-6 6H6a6 6 0 01-6-6V12a6 6 0 016-6h6zm0 2H6a4 4 0 00-4 4v6a4 4 0 004 4h6a4 4 0 004-4v-6a4 4 0 00-4-4zm0 2a2 2 0 00-2 2v4a2 2 0 002 2 2 2 0 002-2v-4a2 2 0 00-2-2z" />
            </svg>
            <span class="mx-3">Penyebab</span>
        </a>
        
        <!-- "Dampak"  -->
            <a class="flex items-center px-6 py-2 mt-4 {{ Route::currentRouteNamed('admin.dampak') ? 'text-white' : 'text-white' }} hover:bg-gray-700 hover:bg-opacity-25"
            href="{{ route('admin.dampak.index') }}">
            <svg class="w-6 h-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M10.29 3.86L1.82 18c-.58 1.01.16 2.25 1.29 2.25h18.78c1.13 0 1.87-1.24 1.29-2.25L13.71 3.86a1.5 1.5 0 00-2.42 0zM12 9v4m0 4h.01" />
            </svg>
            <span class="mx-3">Dampak</span>
            </a>


        {{-- <a class="flex items-center px-6 py-2 mt-4 {{ Route::currentRouteNamed('admin.tables') ? 'text-white' : 'text-white' }} hover:bg-gray-700 hover:bg-opacity-25 hover:text-white"
            href="{{ route('admin.tables') }}">
            <svg class="w-6 h-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M17 14v6m-3-3h6M6 10h2a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v2a2 2 0 002 2zm10 0h2a2 2 0 002-2V6a2 2 0 00-2-2h-2a2 2 0 00-2 2v2a2 2 0 002 2zM6 20h2a2 2 0 002-2v-2a2 2 0 00-2-2H6a2 2 0 00-2 2v2a2 2 0 002 2z" />
            </svg>

            <span class="mx-3">Tables</span>
        </a> --}}

        {{-- <a class="flex items-center px-6 py-2 mt-4 {{ Route::currentRouteNamed('admin.ui-elements') ? 'text-white' : 'text-white' }} hover:bg-gray-700 hover:bg-opacity-25 hover:text-white"
            href="{{ route('admin.ui-elements') }}">
            <svg class="w-6 h-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M17 14v6m-3-3h6M6 10h2a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v2a2 2 0 002 2zm10 0h2a2 2 0 002-2V6a2 2 0 00-2-2h-2a2 2 0 00-2 2v2a2 2 0 002 2zM6 20h2a2 2 0 002-2v-2a2 2 0 00-2-2H6a2 2 0 00-2 2v2a2 2 0 002 2z" />
            </svg>

            <span class="mx-3">UI Elements</span>
        </a> --}}

        @php
            $userRole = auth()->user()->role; // Assuming the user's role is stored in the 'role' column of the users table
        @endphp

        @if ($userRole != 'ketua_tim' && $userRole != 'anggota_tim')
            <div class="relative group">
                <button id="new-dropdown-button"
                    class="flex items-center px-6 py-2 mt-4 {{ Route::currentRouteNamed('admin.users.index') || Route::currentRouteNamed('admin.roles.index') || Route::currentRouteNamed('admin.permissions.index') ? 'text-white' : 'text-white' }} hover:bg-gray-700 hover:bg-opacity-25 hover:text-white">
                    <svg class="h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z">
                        </path>
                    </svg>
                    <span class="mx-3">Configurations</span>
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 ml-2 -mr-1" viewBox="0 0 20 20"
                        fill="currentColor" aria-hidden="true">
                        <path fill-rule="evenodd"
                            d="M6.293 9.293a1 1 0 011.414 0L10 11.586l2.293-2.293a1 1 0 111.414 1.414l-3 3a1 1 0 01-1.414 0l-3-3a1 1 0 010-1.414z"
                            clip-rule="evenodd" />
                    </svg>
                </button>
                <div id="new-dropdown-menu" class="dropdown_branding w-full">
                    <a class="flex items-center px-6 py-2 mt-4 ml-5 {{ Route::currentRouteNamed('admin.users.index') ? 'text-white' : 'text-white' }} hover:bg-gray-700 hover:bg-opacity-25 hover:text-white"
                        href="{{ route('admin.users.index') }}">
                        <svg class="w-6 h-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M17 14v6m-3-3h6M6 10h2a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v2a2 2 0 002 2zm10 0h2a2 2 0 002-2V6a2 2 0 00-2-2h-2a2 2 0 00-2 2v2a2 2 0 002 2zM6 20h2a2 2 0 002-2v-2a2 2 0 00-2-2H6a2 2 0 00-2 2v2a2 2 0 002 2z" />
                        </svg>

                        <span class="mx-3">User</span>
                    </a>

                    <a class="flex items-center px-6 py-2 mt-4 ml-5 {{ Route::currentRouteNamed('admin.roles.index') ? 'text-white' : 'text-white' }} hover:bg-gray-700 hover:bg-opacity-25 hover:text-white"
                        href="{{ route('admin.roles.index') }}">
                        <svg class="w-6 h-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10" />
                        </svg>

                        <span class="mx-3">Role</span>
                    </a>

                    <a class="flex items-center px-6 py-2 mt-4 ml-5 {{ Route::currentRouteNamed('admin.permissions.index') ? 'text-white' : 'text-white' }} hover:bg-gray-700 hover:bg-opacity-25 hover:text-white"
                        href="{{ route('admin.permissions.index') }}">
                        <svg class="w-6 h-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                        </svg>

                        <span class="mx-3">Permission</span>
                    </a>
                </div>
            </div>
        @endif

    </nav>
</div>


<script>
    document.addEventListener('DOMContentLoaded', function() {
        // JavaScript to toggle the dropdown
        const dropdownButton = document.getElementById('dropdown-button');
        const dropdownMenu = document.getElementById('dropdown-menu');
        const newDropdownButton = document.getElementById('new-dropdown-button');
        const newDropdownMenu = document.getElementById('new-dropdown-menu');
        let isOpen = true; // Set to true to open the dropdown by default

        // Function to toggle the dropdown state
        function toggleDropdown() {
            isOpen = !isOpen;
            dropdownMenu.classList.toggle('hidden', !isOpen);
        }

        // Function to toggle the new dropdown state
        function toggleNewDropdown() {
            isOpen = !isOpen;
            newDropdownMenu.classList.toggle('hidden', !isOpen);
        }

        // Set initial state
        toggleDropdown();
        toggleNewDropdown();

        dropdownButton.addEventListener('click', () => {
            toggleDropdown();
        });


        newDropdownButton.addEventListener('click', () => {
            toggleNewDropdown();
        });

        document.addEventListener('click', function(event) {
            if (!dropdownButton.contains(event.target) && !dropdownMenu.contains(event.target)) {
                dropdownMenu.classList.add('hidden');
            }
            if (!newDropdownButton.contains(event.target) && !newDropdownMenu.contains(event.target)) {
                newDropdownMenu.classList.add('hidden');
            }
        });
    });
</script>
