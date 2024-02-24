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
                    <form action="{{ route('laporan.getLaporan') }}" method="get">
                        @csrf
                        <div class="flex">
                            <div class="px-2 w-full">
                                <label for="">
                                    <span
                                        class="block font-semibold mb-1 text-slate-700  after:text-pink-500 after:ml-0.5 dark:text-white">Tanggal Awal
                                        </span>
                                    <input type="date" id="tgl_awal" name="tgl_awal"
                                        onkeyup="this.value = this.value.toUpperCase()"
                                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
                                </label>
                            </div>
                            <div class="px-2 w-full">
                                <label for="">
                                    <span
                                        class="block font-semibold mb-1 text-slate-700  after:text-pink-500 after:ml-0.5 dark:text-white">Tanggal Akhir
                                        </span>
                                    <input type="date" id="tgl_akhir" name="tgl_akhir"
                                        onkeyup="this.value = this.value.toUpperCase()"
                                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
                                </label>
                            </div>
                            <div class="px-2 w-full">
                                <span
                                        class="block font-semibold mb-[-5px] text-slate-700  after:text-pink-500 after:ml-0.5 dark:text-white">
                                        </span>
                                <button type="submit"
                                    class="bg-sky-400 h-10 w-28 mt-2 rounded-xl text-lime-50 hover:bg-sky-600 hover:shadow-sky-700 hover:shadow-md">
                                    <div class="">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="inline text-white"
                                            height="16" width="14"
                                            viewBox="0 0 448 512"><!--!Font Awesome Free 6.5.1 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2023 Fonticons, Inc.-->
                                            <path
                                                d="M64 32C28.7 32 0 60.7 0 96V416c0 35.3 28.7 64 64 64H384c35.3 0 64-28.7 64-64V173.3c0-17-6.7-33.3-18.7-45.3L352 50.7C340 38.7 323.7 32 306.7 32H64zm0 96c0-17.7 14.3-32 32-32H288c17.7 0 32 14.3 32 32v64c0 17.7-14.3 32-32 32H96c-17.7 0-32-14.3-32-32V128zM224 288a64 64 0 1 1 0 128 64 64 0 1 1 0-128z" />
                                        </svg> Simpan
                                    </div>
                                </button>
                            </div>
                        </div><br>    
                    </form>
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
        $(document).ready(function() {
            console.log('RUN!');
            $('#laporan-datatable').DataTable({
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
            });
        });
    </script>
</x-app-layout>
