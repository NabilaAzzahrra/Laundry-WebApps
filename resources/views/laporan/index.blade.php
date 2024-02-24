<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Laporan') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-8xl w-full mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="bg-gray-300">
                    <div class="flex justify-between">
                        <div class="flex">
                            <div>
                                <h1 class="p-4 font-bold">LAPORAN</h1>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <div>
                        <div class="flex">
                            <div class="px-2 w-full">
                                <label for="">
                                    <span
                                        class="block font-semibold mb-1 text-slate-700  after:text-pink-500 after:ml-0.5 dark:text-white">Tanggal
                                        Awal
                                    </span>
                                    <input type="date" id="tgl_awal"
                                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
                                </label>
                            </div>
                            <div class="px-2 w-full">
                                <label for="">
                                    <span
                                        class="block font-semibold mb-1 text-slate-700  after:text-pink-500 after:ml-0.5 dark:text-white">Tanggal
                                        Akhir
                                    </span>
                                    <input type="date" id="tgl_akhir"
                                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
                                </label>
                            </div>
                            <div class="px-2 w-full">
                                <span
                                    class="block font-semibold mb-[-5px] text-slate-700  after:text-pink-500 after:ml-0.5 dark:text-white">
                                </span>
                                <button type="button" onclick="changeFilter()"
                                    class="bg-sky-400 h-10 w-28 mt-2 rounded-xl text-lime-50 hover:bg-sky-600 hover:shadow-sky-700 hover:shadow-md">
                                    <div class="">
                                        Filter
                                    </div>
                                </button>
                            </div>
                        </div><br>
                    </div>
                    <table class="table table-bordered" id="laporan-datatable">
                        <thead>
                            <tr>
                                <th>No.</th>
                                <th>Kode Invoice</th>
                                <th>Member</th>
                                <th>Tanggal</th>
                                <th>Pembayaran</th>
                                <th>Karyawan</th>
                            </tr>
                        </thead>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <script>
        let UrlAPI = 'api/transaksi';
        var dataTableInitialized = false;
        var dataTableInstance;
        var dataTransaksi;
        const changeFilter = () => {
            let queryParams = [];
            let tgl_awal = document.getElementById('tgl_awal').value || 'all';
            let tgl_akhir = document.getElementById('tgl_akhir').value || 'all';

            if (tgl_awal !== 'all') {
                queryParams.push(`tgl_awal=${tgl_awal}`);
            }
            if (tgl_akhir !== 'all') {
                queryParams.push(`tgl_akhir=${tgl_akhir}`);
            }

            let queryString = queryParams.join('&');
            UrlAPI = `api/transaksi?${queryString}`;

            if (dataTableInitialized) {
                dataTableInstance.ajax.url(UrlAPI).load();
            } else {
                getDataTable();
            }
        }

        const getDataTable = async () => {
            const dataTableConfig = {
                ajax: {
                    url: UrlAPI,
                    dataSrc: 'transaksi'
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
                }, ],
            }
            try {
                const response = await fetch(UrlAPI);
                const data = await response.json();
                dataTransaksi = data.transaksi;
                dataTableInstance = $('#laporan-datatable').DataTable(dataTableConfig);
                dataTableInitialized = true;
                setTimeout(() => {
                    changeFilter();
                }, 2000);
            } catch (error) {
                console.error("Error fetching data:", error);
                if (response) {
                    const text = await response.text();
                    console.error("Response text:", text);
                }
            }
        }

        getDataTable();

    </script>
</x-app-layout>
