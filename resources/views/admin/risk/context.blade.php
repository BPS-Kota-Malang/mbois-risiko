<x-admin-layout>
    <div class="p-4 mb-4 bg-white border-2 border-white rounded-lg">
        <h3 class="text-2xl font-medium text-gray-700">Penetapan konteks resiko BPS Malang</h3>
    </div>
    <div class="mt-4">
    </div>
    <div class="p-2 mb-2 bg-white border-2 border-white rounded-lg">
        <div class="overflow-x-auto">
            <ul
                class="flex text-sm font-medium text-center text-gray-500 border-b border-gray-200 flex-nowrap dark:border-gray-700 dark:text-gray-400">
                @php
                    $tabs = [
                        'Pemangku kepentingan',
                        'Peraturan Perundang-undangan',
                        'Tim Project',
                        'Sub Team',
                        'Kegiatan',
                        'Jenis Resiko',
                        'Sumber Resiko',
                        'Kategori Resiko',
                        'Area Dampak',
                        'Level Kemungkinan',
                        'Level Dampak',
                        'Kriteria Kemungkinan',
                        'Kriteria Dampak',
                        'Level Resiko',
                        'Selera Resiko',
                        'Opsi Penanganan',
                        'Proses Bisnis',
                    ];
                @endphp

                @foreach ($tabs as $index => $tab)
                    <li class="me-2">
                        <a href="javascript:void(0)" id="tab-{{ $index + 1 }}"
                            class="tab-link inline-block duration-500 p-6 rounded-t-lg hover:text-gray-600 hover:bg-white dark:hover:bg-white dark:hover:text-gray-800 min-w-[50px] whitespace-nowrap"
                            data-tab="context{{ $index + 1 }}"
                            onclick="openTab(event, 'context{{ $index + 1 }}')">
                            {{ $tab }}
                        </a>
                    </li>
                @endforeach
            </ul>
        </div>

        <div class="mt-4">
        </div>

        @include('admin.tabs.pemangku_kepentingan')
        @include('admin.tabs.peraturan_perundang_undangan')
        @include('admin.tabs.team_project')
        @include('admin.tabs.sub_team')
        @include('admin.tabs.kegiatan')
        @include('admin.tabs.jenis_resiko')
        @include('admin.tabs.sumber_resiko')
        @include('admin.tabs.kategori_resiko')
        @include('admin.tabs.area_dampak')
        @include('admin.tabs.level_kemungkinan')
        @include('admin.tabs.level_dampak')
        @include('admin.tabs.kriteria_kemungkinan')
        @include('admin.tabs.kriteria_dampak')
        @include('admin.tabs.level_resiko')
        @include('admin.tabs.selera_resiko')
        @include('admin.tabs.opsi_penanganan')
        @include('admin.tabs.proses_bisnis')
    </div>
    </div>
    <script>
        function openTab(evt, tabName) {
            var i, tabcontent, tablinks;

            sessionStorage.setItem('lastActiveTab', tabName);

            tabcontent = document.getElementsByClassName("tab-content");
            for (i = 0; i < tabcontent.length; i++) {
                tabcontent[i].classList.add("hidden");
            }

            console.log(tabcontent);

            tablinks = document.getElementsByClassName("tab-link");

            for (i = 0; i < tablinks.length; i++) {
                tablinks[i].classList.remove("text-gray-700", "bg-gray-100", "border-b-2", "border-gray-700", "rounded-md");
                tablinks[i].classList.add("text-gray-400", "bg-white", "border-b-2", "border-transparent", "rounded-md");
            }

            document.getElementById(tabName).classList.remove("hidden");
            evt.currentTarget.classList.add("text-gray-700", "bg-gray-100", "border-b-2", "border-gray-700", "rounded-md");
            evt.currentTarget.classList.remove("text-gray-400", "bg-white", "border-b-2", "border-transparent");

            // Scroll tab into view
            evt.currentTarget.scrollIntoView({
                behavior: 'smooth',
                inline: 'center'
            });
        }


        document.addEventListener('DOMContentLoaded', (event) => {

            const lastTab = sessionStorage.getItem('lastActiveTab') ||
                'context1';
            if (lastTab) {
                const tabLink = document.querySelector(`.tab-link[data-tab="${lastTab}"]`);
                if (tabLink) {
                    tabLink.click();
                }
            }
        });
    </script>
</x-admin-layout>
