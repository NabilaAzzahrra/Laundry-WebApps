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
                }, {
                    data: 'dibayar',
                    render: function(data, type, row) {
                        if (data == 'belum_dibayar') {
                            return '<div style="text-align: center;"><i class="fa-solid fa-circle-xmark" style="color: #f90101; font-size:20px;"></i></div>';
                        } else {
                            return '<div style="text-align: center;"><i class="fa-solid fa-circle-check" style="color: #63E6BE; font-size:20px;"></i><</div>';
                        }
                    }
                }, {
                    data: 'karyawan_name',
                }, {
                    data: {
                        id: 'id',
                        kode_invoice: 'kode_invoice',
                    },
                    render: (data, type, row) => {
                        let editUrl = "{{ route('transaksi.edit', ':id') }}".replace(':id', data
                            .id);
                        return `
        <a href="${editUrl}" class="edit-link bg-green-300 hover:bg-green-500 mr-2 px-3 py-1 rounded-md text-xs text-white">
            <i class="fa-solid fa-money-bill-wave"></i>
        </a>
    `;


                        //     let deditUrl = `<a href="${editUrl}" class="edit-link bg-green-300 hover:bg-green-500 mr-2 px-3 py-1 rounded-md text-xs text-white">
                    //     <i class="fa-solid fa-money-bill-wave"></i>
                    // </a>`;


                        // let deleteUrl =
                        //     `<a onclick="return memberDelete('${data.id}','${data.kode_invoice}')" class="bg-red-500 hover:bg-bg-red-300 px-3 py-1 rounded-md text-xs text-white"><i class="fas fa-trash"></i></a>`;
                        // return `${deditUrl} ${deleteUrl}`;
                    }
                }, ],
            });
        });
    </script>
</x-app-layout>
