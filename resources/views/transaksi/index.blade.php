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
                        <a href="{{route('transaksi.create')}}" class="p-4 font-bold bg-sky-400 text-white"><i class="fas fa-plus"></i> Tambah Transaksi</a>
                    </div>
                </div>
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <table class="table table-bordered" id="transaksi-datatable">
                        <thead>
                            <tr>
                                <th>No.</th>
                                <th>Outlet</th>
                                <th>Kode Invoice</th>
                                <th>Member</th>
                                <th>Tanggal</th>
                                <th>Batas Waktu</th>
                                <th>Tanggal Bayar</th>
                                <th>Biaya Tambahan</th>
                                <th>Diskon</th>
                                <th>Pajak</th>
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
</x-app-layout>
