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
                        <h1 class="p-4 font-bold">DATA TRANSAKSI / <span
                                class="text-red-500 font-bold">{{ $transaksi->kode_invoice }}</span> / <span
                                class="text-red-500 font-bold">{{ $transaksi->member->nama }}</span> </h1>
                    </div>
                </div>
                <div class="bg-white">
                    <div class="p-6 text-gray-900 dark:text-gray-100">
                        <div class="flex justify-between">
                            <div>
                                Tanggal : {{ date('d-m-Y', strtotime($transaksi->tgl)) }}<br>
                                Batas Waktu : {{ date('d-m-Y', strtotime($transaksi->batas_waktu)) }}<br>
                                Tanggal Bayar : {{ date('d-m-Y', strtotime($transaksi->tgl_bayar)) }}
                            </div>
                            <div>
                                Status : {{ $transaksi->status }}<br>
                                @if ($transaksi->dibayar == 'belum_dibayar')
                                    Pembayaran : BELUM DIBAYAR<br>
                                @else
                                    Pembayaran : LUNAS<br>
                                @endif
                                Karyawan : {{ $transaksi->karyawan->name }}<br>
                            </div>
                        </div>
                        <div class="flex gap-4 my-4">
                            <div class="w-full">
                                <label for="">
                                    <span
                                        class="block font-semibold mb-1 text-slate-700 after:text-pink-500 after:ml-0.5 dark:text-white">Biaya
                                        Tambahan
                                        <input type="number" name="biaya_tambahan"
                                            onkeyup="this.value = this.value.toUpperCase()"
                                            value="{{ $transaksi->biaya_tambahan }}"
                                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                                            placeholder="0" readonly>
                                    </span>
                                </label><br>
                            </div>
                            <div class="w-full">
                                <label for="">
                                    <span
                                        class="block font-semibold mb-1 text-slate-700 after:text-pink-500 after:ml-0.5 dark:text-white">Diskon
                                        <input type="number" name="diskon"
                                            onkeyup="this.value = this.value.toUpperCase()"
                                            value="{{ $transaksi->diskon / 100 }}"
                                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                                            placeholder="0" readonly>
                                    </span>
                                </label><br>
                            </div>
                            <div class="w-full">
                                <label for="">
                                    <span
                                        class="block font-semibold mb-1 text-slate-700 after:text-pink-500 after:ml-0.5 dark:text-white">Pajak
                                        <input type="number" name="diskon"
                                            onkeyup="this.value = this.value.toUpperCase()"
                                            value="{{ $transaksi->pajak }}"
                                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                                            placeholder="0" readonly>
                                    </span>
                                </label><br>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
</x-app-layout>
