<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-8xl w-full mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="bg-gray-300">
                    <div class="flex justify-between">
                        <h1 class="p-4 font-bold">DATA TRANSAKSI</h1>
                        <a href="{{ route('transaksi.create') }}" class="p-4 font-bold bg-sky-400 text-white"><i
                                class="fas fa-plus"></i> Tambah Transaksi</a>
                    </div>
                </div>
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <table class="table table-bordered" id="transaksi-datatable">
                        <thead>
                            <tr>
                                <th>No.</th>
                                <th>Kode Invoice</th>
                                <th>Member</th>
                                <th>Tanggal</th>
                                <th>Batas Waktu</th>
                                <th>Tanggal Bayar</th>
                                <th>Status</th>
                                <th>Jumlah Bayar</th>
                                <th>Karyawan</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <script>
        $(document).ready(function() {
            console.log('RUN!');
            $('#transaksi-datatable').DataTable({
                ajax: {
                    url: 'api/transaksi',
                    dataSrc: 'transaksi'
                },
                initComplete: function() {
                    $('#transaksi-datatable thead th').css('text-align', 'center');
                },
                columns: [{
                    data: 'no',
                    render: (data, type, row, meta) => {
                        return meta.row + 1;
                    }
                }, {
                    data: 'kode_invoice',
                }, {
                    data: 'member_name',
                }, {
                    data: 'tgl',
                    render: function(data, type, row) {
                        return new Date(data).toLocaleDateString('id-ID', {
                            day: '2-digit',
                            month: '2-digit',
                            year: 'numeric'
                        }).replaceAll('/', '-');
                    }
                }, {
                    data: 'batas_waktu',
                    render: function(data, type, row) {
                        return new Date(data).toLocaleDateString('id-ID', {
                            day: '2-digit',
                            month: '2-digit',
                            year: 'numeric'
                        }).replaceAll('/', '-');
                    }
                }, {
                    data: 'tgl_bayar',
                    render: function(data, type, row) {
                        return new Date(data).toLocaleDateString('id-ID', {
                            day: '2-digit',
                            month: '2-digit',
                            year: 'numeric'
                        }).replaceAll('/', '-');
                    }
                }, {
                    data: 'status',
                    render: function(data, type, row) {
                        if (data == 'baru') {
                            return `    
                            <ol class="justify-center items-center sm:flex">
                                <li class="relative mb-6 sm:mb-0">
                                    <div class="flex items-center">
                                        <div class="z-10 flex items-center justify-center w-12 h-6 bg-blue-100 rounded-full ring-0 ring-white dark:bg-blue-900 sm:ring-8 dark:ring-gray-900 shrink-0">
                                            <svg class="w-2.5 h-2.5 text-blue-800 dark:text-blue-300" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                                                <path d="M20 4a2 2 0 0 0-2-2h-2V1a1 1 0 0 0-2 0v1h-3V1a1 1 0 0 0-2 0v1H6V1a1 1 0 0 0-2 0v1H2a2 2 0 0 0-2 2v2h20V4ZM0 18a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2V8H0v10Zm5-8h10a1 1 0 0 1 0 2H5a1 1 0 0 1 0-2Z"/>
                                            </svg>
                                        </div>
                                        <div class="hidden sm:flex w-[40px] bg-gray-200 h-0.5 dark:bg-gray-700"></div>
                                    </div>
                                    <div class="mt-3 sm:pe-8">
                                        <p class="text-md font-semibold text-gray-900 dark:text-white">Baru</p>
                                    </div>
                                </li>
                                <li class="relative mb-6 sm:mb-0">
                                    <div class="flex items-center">
                                        <div class="z-10 flex items-center justify-center w-12 h-6 bg-gray-200 rounded-full ring-0 ring-white dark:bg-gray-200 sm:ring-8 dark:ring-gray-900 shrink-0">
                                            <svg class="w-2.5 h-2.5 bg-gray-200 dark:bg-gray-200" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                                                <path d="M20 4a2 2 0 0 0-2-2h-2V1a1 1 0 0 0-2 0v1h-3V1a1 1 0 0 0-2 0v1H6V1a1 1 0 0 0-2 0v1H2a2 2 0 0 0-2 2v2h20V4ZM0 18a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2V8H0v10Zm5-8h10a1 1 0 0 1 0 2H5a1 1 0 0 1 0-2Z"/>
                                            </svg>
                                        </div>
                                        <div class="hidden sm:flex w-[40px] bg-gray-200 h-0.5 dark:bg-gray-200"></div>
                                    </div>
                                    <div class="mt-3 sm:pe-8">
                                        <p class="text-md font-semibold text-gray-900 dark:text-white">Proses</p>
                                    </div>
                                </li>
                                <li class="relative mb-6 sm:mb-0">
                                    <div class="flex items-center">
                                        <div class="z-10 flex items-center justify-center w-12 h-6 bg-gray-200 rounded-full ring-0 ring-white dark:bg-gray-200 sm:ring-8 dark:ring-gray-900 shrink-0">
                                            <svg class="w-2.5 h-2.5 bg-gray-200 dark:bg-gray-200" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                                                <path d="M20 4a2 2 0 0 0-2-2h-2V1a1 1 0 0 0-2 0v1h-3V1a1 1 0 0 0-2 0v1H6V1a1 1 0 0 0-2 0v1H2a2 2 0 0 0-2 2v2h20V4ZM0 18a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2V8H0v10Zm5-8h10a1 1 0 0 1 0 2H5a1 1 0 0 1 0-2Z"/>
                                            </svg>
                                        </div>
                                        <div class="hidden sm:flex w-[40px] bg-gray-200 h-0.5 dark:bg-gray-200"></div>
                                    </div>
                                    <div class="mt-3 sm:pe-8">
                                        <p class="text-md font-semibold text-gray-900 dark:text-white">Selesai</p>
                                    </div>
                                </li>
                                <li class="relative mb-6 sm:mb-0">
                                    <div class="flex items-center">
                                        <div class="z-10 flex items-center justify-center w-12 h-6 bg-gray-200 rounded-full ring-0 ring-white dark:bg-gray-200 sm:ring-8 dark:ring-gray-900 shrink-0">
                                            <svg class="w-2.5 h-2.5 bg-gray-200 dark:bg-gray-200" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                                                <path d="M20 4a2 2 0 0 0-2-2h-2V1a1 1 0 0 0-2 0v1h-3V1a1 1 0 0 0-2 0v1H6V1a1 1 0 0 0-2 0v1H2a2 2 0 0 0-2 2v2h20V4ZM0 18a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2V8H0v10Zm5-8h10a1 1 0 0 1 0 2H5a1 1 0 0 1 0-2Z"/>
                                            </svg>
                                        </div>
                                    </div>
                                    <div class="mt-3 sm:pe-8">
                                        <p class="text-md font-semibold text-gray-900 dark:text-white">Diambil</p>
                                    </div>
                                </li>
                            </ol>
                        `;
                        } else if (data == 'proses') {
                            return `    
                            <ol class="justify-center items-center sm:flex">
                                <li class="relative mb-6 sm:mb-0">
                                    <div class="flex items-center">
                                        <div class="z-10 flex items-center justify-center w-12 h-6 bg-gray-200 rounded-full ring-0 ring-white dark:bg-gray-200 sm:ring-8 dark:ring-gray-900 shrink-0">
                                            <svg class="w-2.5 h-2.5 bg-gray-200 dark:bg-gray-200" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                                                <path d="M20 4a2 2 0 0 0-2-2h-2V1a1 1 0 0 0-2 0v1h-3V1a1 1 0 0 0-2 0v1H6V1a1 1 0 0 0-2 0v1H2a2 2 0 0 0-2 2v2h20V4ZM0 18a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2V8H0v10Zm5-8h10a1 1 0 0 1 0 2H5a1 1 0 0 1 0-2Z"/>
                                            </svg>
                                        </div>
                                        <div class="hidden sm:flex w-[40px] bg-gray-200 h-0.5 dark:bg-gray-200"></div>
                                    </div>
                                    <div class="mt-3 sm:pe-8">
                                        <p class="text-md font-semibold text-gray-900 dark:text-white">Baru</p>
                                    </div>
                                </li>
                                <li class="relative mb-6 sm:mb-0">
                                    <div class="flex items-center">
                                        <div class="z-10 flex items-center justify-center w-12 h-6 bg-blue-100 rounded-full ring-0 ring-white dark:bg-blue-900 sm:ring-8 dark:ring-gray-900 shrink-0">
                                            <svg class="w-2.5 h-2.5 text-blue-800 dark:text-blue-300" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                                                <path d="M20 4a2 2 0 0 0-2-2h-2V1a1 1 0 0 0-2 0v1h-3V1a1 1 0 0 0-2 0v1H6V1a1 1 0 0 0-2 0v1H2a2 2 0 0 0-2 2v2h20V4ZM0 18a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2V8H0v10Zm5-8h10a1 1 0 0 1 0 2H5a1 1 0 0 1 0-2Z"/>
                                            </svg>
                                        </div>
                                        <div class="hidden sm:flex w-[40px] bg-gray-200 h-0.5 dark:bg-gray-700"></div>
                                    </div>
                                    <div class="mt-3 sm:pe-8">
                                        <p class="text-md font-semibold text-gray-900 dark:text-white">Proses</p>
                                    </div>
                                </li>
                                <li class="relative mb-6 sm:mb-0">
                                    <div class="flex items-center">
                                        <div class="z-10 flex items-center justify-center w-12 h-6 bg-gray-200 rounded-full ring-0 ring-white dark:bg-gray-200 sm:ring-8 dark:ring-gray-900 shrink-0">
                                            <svg class="w-2.5 h-2.5 bg-gray-200 dark:bg-gray-200" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                                                <path d="M20 4a2 2 0 0 0-2-2h-2V1a1 1 0 0 0-2 0v1h-3V1a1 1 0 0 0-2 0v1H6V1a1 1 0 0 0-2 0v1H2a2 2 0 0 0-2 2v2h20V4ZM0 18a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2V8H0v10Zm5-8h10a1 1 0 0 1 0 2H5a1 1 0 0 1 0-2Z"/>
                                            </svg>
                                        </div>
                                        <div class="hidden sm:flex w-[40px] bg-gray-200 h-0.5 dark:bg-gray-200"></div>
                                    </div>
                                    <div class="mt-3 sm:pe-8">
                                        <p class="text-md font-semibold text-gray-900 dark:text-white">Selesai</p>
                                    </div>
                                </li>
                                <li class="relative mb-6 sm:mb-0">
                                    <div class="flex items-center">
                                        <div class="z-10 flex items-center justify-center w-12 h-6 bg-gray-200 rounded-full ring-0 ring-white dark:bg-gray-200 sm:ring-8 dark:ring-gray-900 shrink-0">
                                            <svg class="w-2.5 h-2.5 bg-gray-200 dark:bg-gray-200" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                                                <path d="M20 4a2 2 0 0 0-2-2h-2V1a1 1 0 0 0-2 0v1h-3V1a1 1 0 0 0-2 0v1H6V1a1 1 0 0 0-2 0v1H2a2 2 0 0 0-2 2v2h20V4ZM0 18a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2V8H0v10Zm5-8h10a1 1 0 0 1 0 2H5a1 1 0 0 1 0-2Z"/>
                                            </svg>
                                        </div>
                                    </div>
                                    <div class="mt-3 sm:pe-8">
                                        <p class="text-md font-semibold text-gray-900 dark:text-white">Diambil</p>
                                    </div>
                                </li>
                            </ol>
                        `;
                        } else if (data == 'selesai') {
                            return `    
                            <ol class="justify-center items-center sm:flex">
                                <li class="relative mb-6 sm:mb-0">
                                    <div class="flex items-center">
                                        <div class="z-10 flex items-center justify-center w-12 h-6 bg-gray-200 rounded-full ring-0 ring-white dark:bg-gray-200 sm:ring-8 dark:ring-gray-900 shrink-0">
                                            <svg class="w-2.5 h-2.5 bg-gray-200 dark:bg-gray-200" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                                                <path d="M20 4a2 2 0 0 0-2-2h-2V1a1 1 0 0 0-2 0v1h-3V1a1 1 0 0 0-2 0v1H6V1a1 1 0 0 0-2 0v1H2a2 2 0 0 0-2 2v2h20V4ZM0 18a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2V8H0v10Zm5-8h10a1 1 0 0 1 0 2H5a1 1 0 0 1 0-2Z"/>
                                            </svg>
                                        </div>
                                        <div class="hidden sm:flex w-[40px] bg-gray-200 h-0.5 dark:bg-gray-200"></div>
                                    </div>
                                    <div class="mt-3 sm:pe-8">
                                        <p class="text-md font-semibold text-gray-900 dark:text-white">Baru</p>
                                    </div>
                                </li>
                                <li class="relative mb-6 sm:mb-0">
                                    <div class="flex items-center">
                                        <div class="z-10 flex items-center justify-center w-12 h-6 bg-gray-200 rounded-full ring-0 ring-white dark:bg-gray-200 sm:ring-8 dark:ring-gray-900 shrink-0">
                                            <svg class="w-2.5 h-2.5 bg-gray-200 dark:bg-gray-200" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                                                <path d="M20 4a2 2 0 0 0-2-2h-2V1a1 1 0 0 0-2 0v1h-3V1a1 1 0 0 0-2 0v1H6V1a1 1 0 0 0-2 0v1H2a2 2 0 0 0-2 2v2h20V4ZM0 18a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2V8H0v10Zm5-8h10a1 1 0 0 1 0 2H5a1 1 0 0 1 0-2Z"/>
                                            </svg>
                                        </div>
                                        <div class="hidden sm:flex w-[40px] bg-gray-200 h-0.5 dark:bg-gray-200"></div>
                                    </div>
                                    <div class="mt-3 sm:pe-8">
                                        <p class="text-md font-semibold text-gray-900 dark:text-white">Proses</p>
                                    </div>
                                </li>
                                <li class="relative mb-6 sm:mb-0">
                                    <div class="flex items-center">
                                        <div class="z-10 flex items-center justify-center w-12 h-6 bg-blue-100 rounded-full ring-0 ring-white dark:bg-blue-900 sm:ring-8 dark:ring-gray-900 shrink-0">
                                            <svg class="w-2.5 h-2.5 text-blue-800 dark:text-blue-300" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                                                <path d="M20 4a2 2 0 0 0-2-2h-2V1a1 1 0 0 0-2 0v1h-3V1a1 1 0 0 0-2 0v1H6V1a1 1 0 0 0-2 0v1H2a2 2 0 0 0-2 2v2h20V4ZM0 18a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2V8H0v10Zm5-8h10a1 1 0 0 1 0 2H5a1 1 0 0 1 0-2Z"/>
                                            </svg>
                                        </div>
                                        <div class="hidden sm:flex w-[40px] bg-gray-200 h-0.5 dark:bg-gray-700"></div>
                                    </div>
                                    <div class="mt-3 sm:pe-8">
                                        <p class="text-md font-semibold text-gray-900 dark:text-white">Selesai</p>
                                    </div>
                                </li>
                                <li class="relative mb-6 sm:mb-0">
                                    <div class="flex items-center">
                                        <div class="z-10 flex items-center justify-center w-12 h-6 bg-gray-200 rounded-full ring-0 ring-white dark:bg-gray-200 sm:ring-8 dark:ring-gray-900 shrink-0">
                                            <svg class="w-2.5 h-2.5 bg-gray-200 dark:bg-gray-200" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                                                <path d="M20 4a2 2 0 0 0-2-2h-2V1a1 1 0 0 0-2 0v1h-3V1a1 1 0 0 0-2 0v1H6V1a1 1 0 0 0-2 0v1H2a2 2 0 0 0-2 2v2h20V4ZM0 18a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2V8H0v10Zm5-8h10a1 1 0 0 1 0 2H5a1 1 0 0 1 0-2Z"/>
                                            </svg>
                                        </div>
                                    </div>
                                    <div class="mt-3 sm:pe-8">
                                        <p class="text-md font-semibold text-gray-900 dark:text-white">Diambil</p>
                                    </div>
                                </li>
                            </ol>
                        `;
                        } else if (data == 'diambil') {
                            return `    
                            <ol class="justify-center items-center sm:flex">
                                <li class="relative mb-6 sm:mb-0">
                                    <div class="flex items-center">
                                        <div class="z-10 flex items-center justify-center w-12 h-6 bg-gray-200 rounded-full ring-0 ring-white dark:bg-gray-200 sm:ring-8 dark:ring-gray-900 shrink-0">
                                            <svg class="w-2.5 h-2.5 bg-gray-200 dark:bg-gray-200" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                                                <path d="M20 4a2 2 0 0 0-2-2h-2V1a1 1 0 0 0-2 0v1h-3V1a1 1 0 0 0-2 0v1H6V1a1 1 0 0 0-2 0v1H2a2 2 0 0 0-2 2v2h20V4ZM0 18a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2V8H0v10Zm5-8h10a1 1 0 0 1 0 2H5a1 1 0 0 1 0-2Z"/>
                                            </svg>
                                        </div>
                                        <div class="hidden sm:flex w-[40px] bg-gray-200 h-0.5 dark:bg-gray-200"></div>
                                    </div>
                                    <div class="mt-3 sm:pe-8">
                                        <p class="text-md font-semibold text-gray-900 dark:text-white">Baru</p>
                                    </div>
                                </li>
                                <li class="relative mb-6 sm:mb-0">
                                    <div class="flex items-center">
                                        <div class="z-10 flex items-center justify-center w-12 h-6 bg-gray-200 rounded-full ring-0 ring-white dark:bg-gray-200 sm:ring-8 dark:ring-gray-900 shrink-0">
                                            <svg class="w-2.5 h-2.5 bg-gray-200 dark:bg-gray-200" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                                                <path d="M20 4a2 2 0 0 0-2-2h-2V1a1 1 0 0 0-2 0v1h-3V1a1 1 0 0 0-2 0v1H6V1a1 1 0 0 0-2 0v1H2a2 2 0 0 0-2 2v2h20V4ZM0 18a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2V8H0v10Zm5-8h10a1 1 0 0 1 0 2H5a1 1 0 0 1 0-2Z"/>
                                            </svg>
                                        </div>
                                        <div class="hidden sm:flex w-[40px] bg-gray-200 h-0.5 dark:bg-gray-200"></div>
                                    </div>
                                    <div class="mt-3 sm:pe-8">
                                        <p class="text-md font-semibold text-gray-900 dark:text-white">Proses</p>
                                    </div>
                                </li>
                                <li class="relative mb-6 sm:mb-0">
                                    <div class="flex items-center">
                                        <div class="z-10 flex items-center justify-center w-12 h-6 bg-gray-200 rounded-full ring-0 ring-white dark:bg-gray-200 sm:ring-8 dark:ring-gray-900 shrink-0">
                                            <svg class="w-2.5 h-2.5 bg-gray-200 dark:bg-gray-200" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                                                <path d="M20 4a2 2 0 0 0-2-2h-2V1a1 1 0 0 0-2 0v1h-3V1a1 1 0 0 0-2 0v1H6V1a1 1 0 0 0-2 0v1H2a2 2 0 0 0-2 2v2h20V4ZM0 18a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2V8H0v10Zm5-8h10a1 1 0 0 1 0 2H5a1 1 0 0 1 0-2Z"/>
                                            </svg>
                                        </div>
                                        <div class="hidden sm:flex w-[40px] bg-gray-200 h-0.5 dark:bg-gray-200"></div>
                                    </div>
                                    <div class="mt-3 sm:pe-8">
                                        <p class="text-md font-semibold text-gray-900 dark:text-white">Selesai</p>
                                    </div>
                                </li>
                                <li class="relative mb-6 sm:mb-0">
                                    <div class="flex items-center">
                                        <div class="z-10 flex items-center justify-center w-12 h-6 bg-blue-100 rounded-full ring-0 ring-white dark:bg-blue-900 sm:ring-8 dark:ring-gray-900 shrink-0">
                                            <svg class="w-2.5 h-2.5 text-blue-800 dark:text-blue-300" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                                                <path d="M20 4a2 2 0 0 0-2-2h-2V1a1 1 0 0 0-2 0v1h-3V1a1 1 0 0 0-2 0v1H6V1a1 1 0 0 0-2 0v1H2a2 2 0 0 0-2 2v2h20V4ZM0 18a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2V8H0v10Zm5-8h10a1 1 0 0 1 0 2H5a1 1 0 0 1 0-2Z"/>
                                            </svg>
                                        </div>
                                    </div>
                                    <div class="mt-3 sm:pe-8">
                                        <p class="text-md font-semibold text-gray-900 dark:text-white">Diambil</p>
                                    </div>
                                </li>
                            </ol>
                        `;
                        }
                    }
                }, {
                    data: 'dibayar',
                    render: function(data, type, row) {
                        if (data == 'belum_dibayar') {
                            return '<div style="text-align: center;"><i class="fa-solid fa-circle-xmark" style="color: #f90101; font-size:20px;"></i></div>';
                        } else {
                            return '<div style="text-align: center;"><i class="fa-solid fa-circle-check" style="color: #63E6BE; font-size:20px;"></i></div>';
                        }
                    }
                }, {
                    data: 'karyawan_name',
                }, {
                    data: {
                        id: 'id',
                        kode_invoice: 'kode_invoice',
                        dibayar: 'dibayar' // Tambahan properti untuk menunjukkan status pembayaran
                    },
                    render: (data, type, row) => {
                        let editUrl = "{{ route('transaksi.edit', ':id') }}".replace(':id', data
                            .id);
                        let printUrl = "{{ route('transaksi.print', ':id') }}".replace(':id',
                            data
                            .id);
                        if (data.status == 'diambil') {
                            if (data.dibayar === 'lunas' && data.status == 'diambil' || data
                                .status == 'selesai') {
                                return `
                                <a href="${editUrl}" class="edit-link bg-green-300 hover:bg-green-500 mr-2 px-3 py-1 rounded-md text-xs text-white">
                                        <i class="fa-solid fa-money-bill-wave"></i> Rincian
                                    </a>

                                <a href="${printUrl}" target="_blank" class="edit-link bg-sky-300 hover:bg-sky-400 mr-3 px-3 py-1 rounded-md text-xs text-white">
                                    <i class="fas fa-print"></i> Cetak
                                    </a>
                            `;
                            } else {
                                return `
                                <a href="${editUrl}" class="edit-link bg-green-300 hover:bg-green-500 mr-2 px-3 py-1 rounded-md text-xs text-white">
                                    <i class="fa-solid fa-money-bill-wave"></i> Rincian
                                </a>
                                <button onclick="return bayarLaundry('${data.id}','${data.kode_invoice}')" class="edit-link bg-yellow-200 hover:bg-yellow-400 mr-2 px-3 py-1 rounded-md text-xs text-white">
                                    <i class="fa-solid fa-handshake"></i> Bayar
                                </button>
                            `;
                            }
                        } else {
                            if (data.dibayar === 'lunas' && data.status == 'diambil' || data
                                .status == 'selesai') {
                                return `
                                <a href="${editUrl}" class="edit-link bg-green-300 hover:bg-green-500 mr-2 px-3 py-1 rounded-md text-xs text-white">
                                        <i class="fa-solid fa-money-bill-wave"></i>
                                    </a>

                                <a href="${printUrl}" target="_blank" class="edit-link bg-sky-300 hover:bg-sky-400 mr-3 px-3 py-1 rounded-md text-xs text-white">
                                    <i class="fas fa-print"></i>
                                    </a>

                                    <div class="relative inline-block text-left">
                                        <div>
                                            <button type="button" onclick="showNav('${data.id}')" class="inline-flex w-full justify-center gap-x-1.5 rounded-md bg-white px-3 py-2 text-sm font-semibold text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 hover:bg-gray-50" id="menu-button" aria-expanded="true" aria-haspopup="true">
                                                <i class="fa-solid fa-bars"></i>
                                            <svg class="-mr-1 h-5 w-5 text-gray-400" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                                <path fill-rule="evenodd" d="M5.23 7.21a.75.75 0 011.06.02L10 11.168l3.71-3.938a.75.75 0 111.08 1.04l-4.25 4.5a.75.75 0 01-1.08 0l-4.25-4.5a.75.75 0 01.02-1.06z" clip-rule="evenodd" />
                                            </svg>
                                            </button>
                                        </div>

                                        <div id="nav-${data.id}" class="hidden absolute right-0 z-10 mt-2 w-56 origin-top-right rounded-md bg-white shadow-lg ring-1 ring-black ring-opacity-5 focus:outline-none" role="menu" aria-orientation="vertical" aria-labelledby="menu-button" tabindex="-1">
                                            <div class="py-1" role="none">
                                            <!-- Active: "bg-gray-100 text-gray-900", Not Active: "text-gray-700" -->
                                            <button href="#" onclick="return prosesLaundry('${data.id}','${data.kode_invoice}')" class="text-gray-700 block px-4 py-2 text-sm" role="menuitem" tabindex="-1" id="menu-item-0">Proses</button>
                                            <button href="#" onclick="return selesaiLaundry('${data.id}','${data.kode_invoice}')" class="text-gray-700 block px-4 py-2 text-sm" role="menuitem" tabindex="-1" id="menu-item-1">Selesai</button>
                                            <button href="#" onclick="return diambilLaundry('${data.id}','${data.kode_invoice}')" class="text-gray-700 block px-4 py-2 text-sm" role="menuitem" tabindex="-1" id="menu-item-2">Diambil</button>
                                            </div>
                                        </div>
                                    </div>
                            `;
                            } else {
                                return `
                                <a href="${editUrl}" class="edit-link bg-green-300 hover:bg-green-500 mr-2 px-3 py-1 rounded-md text-xs text-white">
                                    <i class="fa-solid fa-money-bill-wave"></i> Rincian
                                </a>
                                <button onclick="return bayarLaundry('${data.id}','${data.kode_invoice}')" class="edit-link bg-yellow-200 hover:bg-yellow-400 mr-2 px-3 py-1 rounded-md text-xs text-white">
                                    <i class="fa-solid fa-handshake"></i> Bayar
                                </button>

                                <div class="relative inline-block text-left">
                                    <div>
                                        <button type="button" onclick="showNav('${data.id}')" class="inline-flex w-full justify-center gap-x-1.5 rounded-md bg-white px-3 py-2 text-sm font-semibold text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 hover:bg-gray-50" id="menu-button" aria-expanded="true" aria-haspopup="true">
                                        Status
                                        <svg class="-mr-1 h-5 w-5 text-gray-400" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                            <path fill-rule="evenodd" d="M5.23 7.21a.75.75 0 011.06.02L10 11.168l3.71-3.938a.75.75 0 111.08 1.04l-4.25 4.5a.75.75 0 01-1.08 0l-4.25-4.5a.75.75 0 01.02-1.06z" clip-rule="evenodd" />
                                        </svg>
                                        </button>
                                    </div>

                                    <div id="nav-${data.id}" class="hidden absolute right-0 z-10 mt-2 w-56 origin-top-right rounded-md bg-white shadow-lg ring-1 ring-black ring-opacity-5 focus:outline-none" role="menu" aria-orientation="vertical" aria-labelledby="menu-button" tabindex="-1">
                                        <div class="py-1" role="none">
                                        <!-- Active: "bg-gray-100 text-gray-900", Not Active: "text-gray-700" -->
                                        <button href="#" onclick="return prosesLaundry('${data.id}','${data.kode_invoice}')" class="text-gray-700 block px-4 py-2 text-sm" role="menuitem" tabindex="-1" id="menu-item-0">Proses</button>
                                        <button href="#" onclick="return selesaiLaundry('${data.id}','${data.kode_invoice}')" class="text-gray-700 block px-4 py-2 text-sm" role="menuitem" tabindex="-1" id="menu-item-1">Selesai</button>
                                        <button href="#" onclick="return diambilLaundry('${data.id}','${data.kode_invoice}')" class="text-gray-700 block px-4 py-2 text-sm" role="menuitem" tabindex="-1" id="menu-item-2">Diambil</button>
                                        </div>
                                    </div>
                                </div>
                            `;
                            }
                        }

                    }
                }, ],
            });
        });

        const showNav = (id) => {
            document.getElementById(`nav-${id}`).classList.toggle('hidden');
        }

        const bayarLaundry = async (id, nama) => {
            let tanya = confirm(`Bayar faktur laundry dengan nomor ${nama}`);
            if (tanya) {
                const csrftoken = $('meta[name="csrf-token"]').attr('content');
                await axios.post(`/transaksi/${id}`, {
                        '_method': 'PATCH',
                        '_token': $('meta[name="csrf-token"]').attr('content')
                    })
                    .then(function(response) {
                        console.log(response);
                        location.reload();
                    })
                    .catch(function(error) {
                        alert('Error deleting record');
                        console.log(error);
                    });
            }
        };

        const prosesLaundry = async (id, nama) => {
            let tanya = confirm(`Proses laundry dengan nomor ${nama}`);
            if (tanya) {
                try {
                    const csrftoken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
                    const response = await axios.post(`/transaksi/proses/${id}`, {
                        _method: 'PATCH',
                        _token: csrftoken
                    });
                    console.log(response);
                    location.reload();
                } catch (error) {
                    alert('Error processing laundry');
                    console.error(error);
                }
            }
        };

        const selesaiLaundry = async (id, nama) => {
            let tanya = confirm(`Proses laundry dengan nomor ${nama} Sudah Selesai`);
            if (tanya) {
                try {
                    const csrftoken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
                    const response = await axios.post(`/transaksi/selesai/${id}`, {
                        _method: 'PATCH',
                        _token: csrftoken
                    });
                    console.log(response);
                    location.reload();
                } catch (error) {
                    alert('Error processing laundry');
                    console.error(error);
                }
            }
        };

        const diambilLaundry = async (id, nama) => {
            let tanya = confirm(`Ambil laundry dengan nomor ${nama}`);
            if (tanya) {
                try {
                    const csrftoken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
                    const response = await axios.post(`/transaksi/diambil/${id}`, {
                        _method: 'PATCH',
                        _token: csrftoken
                    });
                    console.log(response);
                    location.reload();
                } catch (error) {
                    alert('Error processing laundry');
                    console.error(error);
                }
            }
        };
    </script>
</x-app-layout>
