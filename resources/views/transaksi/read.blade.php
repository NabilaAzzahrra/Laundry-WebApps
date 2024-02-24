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
                    <div class="p-6 pb-0 text-gray-900 dark:text-gray-100">
                        <div class="flex justify-between">
                            <div>
                                <table>
                                    <tr>
                                        <td>Tanggal</td>
                                        <td>:</td>
                                        <td>{{ date('d-m-Y', strtotime($transaksi->tgl)) }}</td>
                                    </tr>
                                    <tr>
                                        <td>Batas Waktu</td>
                                        <td>:</td>
                                        <td>{{ date('d-m-Y', strtotime($transaksi->batas_waktu)) }}</td>
                                    </tr>
                                    @php
                                        if ($transaksi->tgl_bayar) {
                                            $tgl_bayar = date('d-m-Y', strtotime($transaksi->tgl_bayar));
                                        } else {
                                            $tgl_bayar = '00-00-0000';
                                        }
                                    @endphp

                                    <tr>
                                        <td>Tanggal Bayar</td>
                                        <td>:</td>
                                        <td>{{ $tgl_bayar }}</td>
                                    </tr>

                                </table>
                            </div>
                            <div>
                                <table>
                                    <tr>
                                        <td>Status</td>
                                        <td>:</td>
                                        <td>{{ $transaksi->status }}</td>
                                    </tr>
                                    @if ($transaksi->dibayar == 'belum_dibayar')
                                        <tr>
                                            <td>Pembayaran</td>
                                            <td>:</td>
                                            <td>BELUM DIBAYAR</td>
                                        </tr>
                                    @else
                                        <tr>
                                            <td>Pembayaran</td>
                                            <td>:</td>
                                            <td>LUNAS</td>
                                        </tr>
                                    @endif
                                    <tr>
                                        <td>Karyawan</td>
                                        <td>:</td>
                                        <td>{{ $transaksi->karyawan->name }}</td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                        @php
                            $jharga = 0;
                        @endphp
                        @foreach ($transaksi->detailtransaksi as $detail)
                            @php
                                $harga = $detail->qty * $detail->paket->harga;
                                $jharga += $harga;
                                $biayatambahan = $transaksi->biaya_tambahan;
                                $totalharga = $jharga + $biayatambahan;
                                $pajak = $transaksi->pajak * $totalharga;
                                $diskon = $transaksi->diskon / 100;
                                $totaldiskon = $diskon * ($totalharga + $pajak);
                                $totalbayar = $totalharga + $pajak - $totaldiskon;
                            @endphp
                            <div class="flex gap-4 my-4">
                                <div class="w-full">
                                    <label for="">
                                        <span
                                            class="block font-semibold mb-1 text-slate-700 after:text-pink-500 after:ml-0.5 dark:text-white">Id
                                            Transaksi
                                            <input type="text" name="id_transaksi"
                                                onkeyup="this.value = this.value.toUpperCase()"
                                                value="{{ $detail->id_transaksi }}"
                                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                                                placeholder="0" readonly>
                                        </span>
                                    </label><br>
                                </div>
                                <div class="w-full">
                                    <label for="">
                                        <span
                                            class="block font-semibold mb-1 text-slate-700 after:text-pink-500 after:ml-0.5 dark:text-white">Paket
                                            <input type="text" name="id_paket"
                                                onkeyup="this.value = this.value.toUpperCase()"
                                                value="{{ $detail->paket->nama_paket }}"
                                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                                                placeholder="0" readonly>
                                        </span>
                                    </label><br>
                                </div>
                                <div class="w-full">
                                    <label for="">
                                        <span
                                            class="block font-semibold mb-1 text-slate-700 after:text-pink-500 after:ml-0.5 dark:text-white">Keterangan
                                            <input type="text" name="keterangan"
                                                onkeyup="this.value = this.value.toUpperCase()"
                                                value="{{ $detail->keterangan }}"
                                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                                                placeholder="0" readonly>
                                        </span>
                                    </label><br>
                                </div>
                                <div class="w-full">
                                    <label for="">
                                        <span
                                            class="block font-semibold mb-1 text-slate-700 after:text-pink-500 after:ml-0.5 dark:text-white">Harga
                                            <input type="number" name="harga" id="harga" onkeyup="updateTotal()"
                                                value="{{ $detail->paket->harga }}"
                                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                                                placeholder="0" readonly>
                                        </span>
                                    </label><br>
                                </div>
                                <div class="w-full">
                                    <label for="">
                                        <span
                                            class="block font-semibold mb-1 text-slate-700 after:text-pink-500 after:ml-0.5 dark:text-white">QTY
                                            <input type="number" name="qty" id="qty" onkeyup="updateTotal()"
                                                value="{{ $detail->qty }}"
                                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                                                placeholder="0" readonly>
                                        </span>
                                    </label><br>
                                </div>
                                <div class="w-full">
                                    <label for="">
                                        <span
                                            class="block font-semibold mb-1 text-slate-700 after:text-pink-500 after:ml-0.5 dark:text-white">Total
                                            Harga
                                            <input type="number" name="total" id="total"
                                                onkeyup="this.value = this.value.toUpperCase()"
                                                value="{{ $detail->qty * $detail->paket->harga }}"
                                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                                                placeholder="0" readonly>
                                        </span>
                                    </label><br>
                                </div>
                            </div>
                        @endforeach
                        <div class="flex gap-4 my-4">
                            <div class="w-full">
                                <label for="">
                                    <span
                                        class="block font-semibold mb-1 text-slate-700 after:text-pink-500 after:ml-0.5 dark:text-white">
                                    </span>
                                </label><br>
                            </div>
                            <div class="w-full">
                                <label for="">
                                    <span
                                        class="block font-semibold mb-1 text-slate-700 after:text-pink-500 after:ml-0.5 dark:text-white">
                                    </span>
                                </label><br>
                            </div>
                            <div class="w-full">
                                <label for="">
                                    <span
                                        class="block font-semibold mb-1 text-slate-700 after:text-pink-500 after:ml-0.5 dark:text-white">
                                    </span>
                                </label><br>
                            </div>
                            <div class="w-full">
                                <label for="">
                                    <span
                                        class="block font-semibold mb-1 text-slate-700 after:text-pink-500 after:ml-0.5 dark:text-white">
                                    </span>
                                </label><br>
                            </div>
                            <div class="w-full">
                                <label for="">
                                    <span
                                        class="text-right block font-semibold mb-1 mt-2 text-slate-700 after:text-pink-500 after:ml-0.5 dark:text-white">
                                        Total Harga
                                    </span>
                                </label><br>
                            </div>
                            <div class="w-full">
                                <label for="">
                                    <span
                                        class="block font-semibold mb-1 text-slate-700 after:text-pink-500 after:ml-0.5 dark:text-white">
                                        <input type="number" name="total_harga" id="total_harga"
                                            onkeyup="this.value = this.value.toUpperCase()" value="{{ $jharga }}"
                                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                                            placeholder="0" readonly>
                                    </span>
                                </label><br>
                            </div>
                        </div>
                        <div class="flex gap-4 my-4">
                            <div class="w-full">
                                <label for="">
                                    <span
                                        class="block font-semibold mb-1 text-slate-700 after:text-pink-500 after:ml-0.5 dark:text-white">
                                    </span>
                                </label><br>
                            </div>
                            <div class="w-full">
                                <label for="">
                                    <span
                                        class="block font-semibold mb-1 text-slate-700 after:text-pink-500 after:ml-0.5 dark:text-white">
                                    </span>
                                </label><br>
                            </div>
                            <div class="w-full">
                                <label for="">
                                    <span
                                        class="block font-semibold mb-1 text-slate-700 after:text-pink-500 after:ml-0.5 dark:text-white">
                                    </span>
                                </label><br>
                            </div>
                            <div class="w-full">
                                <label for="">
                                    <span
                                        class="block font-semibold mb-1 text-slate-700 after:text-pink-500 after:ml-0.5 dark:text-white">
                                    </span>
                                </label><br>
                            </div>
                            <div class="w-full">
                                <label for="">
                                    <span
                                        class="text-right block font-semibold mb-1 mt-2 text-slate-700 after:text-pink-500 after:ml-0.5 dark:text-white">
                                        Biaya Tambahan
                                    </span>
                                </label><br>
                            </div>
                            <div class="w-full">
                                <label for="">
                                    <span
                                        class="block font-semibold mb-1 text-slate-700 after:text-pink-500 after:ml-0.5 dark:text-white">
                                        <input type="number" name="total_harga" id="total_harga"
                                            onkeyup="this.value = this.value.toUpperCase()"
                                            value="{{ $biayatambahan }}"
                                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                                            placeholder="0" readonly>
                                    </span>
                                </label><br>
                            </div>
                        </div>
                        <div class="flex gap-4 my-4">
                            <div class="w-full">
                                <label for="">
                                    <span
                                        class="block font-semibold mb-1 text-slate-700 after:text-pink-500 after:ml-0.5 dark:text-white">
                                    </span>
                                </label><br>
                            </div>
                            <div class="w-full">
                                <label for="">
                                    <span
                                        class="block font-semibold mb-1 text-slate-700 after:text-pink-500 after:ml-0.5 dark:text-white">
                                    </span>
                                </label><br>
                            </div>
                            <div class="w-full">
                                <label for="">
                                    <span
                                        class="block font-semibold mb-1 text-slate-700 after:text-pink-500 after:ml-0.5 dark:text-white">
                                    </span>
                                </label><br>
                            </div>
                            <div class="w-full">
                                <label for="">
                                    <span
                                        class="block font-semibold mb-1 text-slate-700 after:text-pink-500 after:ml-0.5 dark:text-white">
                                    </span>
                                </label><br>
                            </div>
                            <div class="w-full">
                                <label for="">
                                    <span
                                        class="text-right block font-semibold mb-1 mt-2 text-slate-700 after:text-pink-500 after:ml-0.5 dark:text-white">
                                        Pajak
                                    </span>
                                </label><br>
                            </div>
                            <div class="w-full">
                                <label for="">
                                    <span
                                        class="block font-semibold mb-1 text-slate-700 after:text-pink-500 after:ml-0.5 dark:text-white">
                                        <input type="number" name="total_harga" id="total_harga"
                                            onkeyup="this.value = this.value.toUpperCase()"
                                            value="{{ $pajak }}"
                                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                                            placeholder="0" readonly>
                                    </span>
                                </label><br>
                            </div>
                        </div>
                        <div class="flex gap-4 my-4">
                            <div class="w-full">
                                <label for="">
                                    <span
                                        class="block font-semibold mb-1 text-slate-700 after:text-pink-500 after:ml-0.5 dark:text-white">
                                    </span>
                                </label><br>
                            </div>
                            <div class="w-full">
                                <label for="">
                                    <span
                                        class="block font-semibold mb-1 text-slate-700 after:text-pink-500 after:ml-0.5 dark:text-white">
                                    </span>
                                </label><br>
                            </div>
                            <div class="w-full">
                                <label for="">
                                    <span
                                        class="block font-semibold mb-1 text-slate-700 after:text-pink-500 after:ml-0.5 dark:text-white">
                                    </span>
                                </label><br>
                            </div>
                            <div class="w-full">
                                <label for="">
                                    <span
                                        class="block font-semibold mb-1 text-slate-700 after:text-pink-500 after:ml-0.5 dark:text-white">
                                    </span>
                                </label><br>
                            </div>
                            <div class="w-full">
                                <label for="">
                                    <span
                                        class="text-right block font-semibold mb-1 mt-2 text-slate-700 after:text-pink-500 after:ml-0.5 dark:text-white">
                                        Diskon
                                    </span>
                                </label><br>
                            </div>
                            <div class="w-full">
                                <label for="">
                                    <span
                                        class="block font-semibold mb-1 text-slate-700 after:text-pink-500 after:ml-0.5 dark:text-white">
                                        <input type="number" name="total_harga" id="total_harga"
                                            onkeyup="this.value = this.value.toUpperCase()"
                                            value="{{ $totaldiskon }}"
                                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                                            placeholder="0" readonly>
                                    </span>
                                </label><br>
                            </div>
                        </div>
                        <div class="flex gap-4 my-4">
                            <div class="w-full">
                                <label for="">
                                    <span
                                        class="block font-semibold mb-1 text-slate-700 after:text-pink-500 after:ml-0.5 dark:text-white">
                                    </span>
                                </label><br>
                            </div>
                            <div class="w-full">
                                <label for="">
                                    <span
                                        class="block font-semibold mb-1 text-slate-700 after:text-pink-500 after:ml-0.5 dark:text-white">
                                    </span>
                                </label><br>
                            </div>
                            <div class="w-full">
                                <label for="">
                                    <span
                                        class="block font-semibold mb-1 text-slate-700 after:text-pink-500 after:ml-0.5 dark:text-white">
                                    </span>
                                </label><br>
                            </div>
                            <div class="w-full">
                                <label for="">
                                    <span
                                        class="block font-semibold mb-1 text-slate-700 after:text-pink-500 after:ml-0.5 dark:text-white">
                                    </span>
                                </label><br>
                            </div>
                            <div class="w-full">
                                <label for="">
                                    <span
                                        class="text-right block font-semibold mb-1 mt-2 text-slate-700 after:text-pink-500 after:ml-0.5 dark:text-white">
                                        Total Bayar
                                    </span>
                                </label><br>
                            </div>
                            <div class="w-full">
                                <label for="">
                                    <span
                                        class="block font-semibold mb-1 text-slate-700 after:text-pink-500 after:ml-0.5 dark:text-white">
                                        <input type="number" name="total_harga" id="total_harga"
                                            onkeyup="this.value = this.value.toUpperCase()"
                                            value="{{ $totalbayar }}"
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
        <script>
            function updateTotal() {
                const qty = document.querySelectorAll('[name="qty"]');
                const harga = document.querySelectorAll('[name="harga"]');
                const total = document.querySelectorAll('[name="total"]');

                let total_harga = 0;

                qty.forEach((qtyInput, index) => {
                    let hargaVal = parseFloat(harga[index].value);
                    let qtyVal = parseFloat(qtyInput.value);
                    total[index].value = hargaVal * qtyVal;
                    total_harga += parseFloat(total[index].value);
                });

                document.getElementById('total_harga').value = total_harga.toFixed(2);
                document.getElementById('total_bayar').value = totalBayarInput.value;
            }
        </script>
</x-app-layout>
