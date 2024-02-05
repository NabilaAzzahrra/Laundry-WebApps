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
                        <h1 class="p-4 font-bold">TAMBAH DATA TRANSAKSI</h1>
                    </div>
                </div>
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <form action="{{ route('transaksi.store') }}" method="post">
                        @csrf
                        <div class="flex gap-4 my-4">
                            <div class="w-full">
                                <label for="">
                                    <span
                                        class="block font-semibold mb-1 text-slate-700 after:content-['*'] after:text-pink-500 after:ml-0.5 dark:text-white">Outlet
                                    </span>
                                    <select class="js-example-basic-single js-states form-control  m-6 border"
                                        style="width: 100%!important" name="id_outlet" data-placeholder="Pilih Outlet">
                                        <option value="">Pilih...</option>
                                        @foreach ($outlet as $o)
                                            <option value="{{ $o->id }}">{{ $o->nama }}</option>
                                        @endforeach
                                    </select><br>
                                    <span class="text-sm m-l text-red-500">{{ $errors->first('id_outlet') }}</span>
                                </label><br>
                            </div>
                            <div class="w-full">
                                <label for="">
                                    <span
                                        class="block font-semibold mb-1 text-slate-700 after:content-['*'] after:text-pink-500 after:ml-0.5 dark:text-white">Member
                                    </span>
                                    <select class="js-example-basic-single js-states form-control  m-6 border"
                                        style="width: 100%!important" name="id_member" data-placeholder="Pilih Member">
                                        <option value="">Pilih...</option>
                                        @foreach ($member as $m)
                                            <option value="{{ $m->id }}">{{ $m->nama }}</option>
                                        @endforeach
                                    </select><br>
                                    <span class="text-sm m-l text-red-500">{{ $errors->first('id_member') }}</span>
                                </label><br>
                            </div>
                        </div>

                        <div class="flex gap-4 my-4">
                            <div class="w-full">
                                <label for="">
                                    <span
                                        class="block font-semibold mb-1 text-slate-700 after:content-['*'] after:text-pink-500 after:ml-0.5 dark:text-white">Tanggal</span>
                                    <input type="date" name="tanggal" onkeyup="this.value = this.value.toUpperCase()"
                                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                                        placeholder="Masukan Tanggal..." required>
                                    <span class="text-sm m-l text-red-500">{{ $errors->first('tanggal') }}</span>
                                </label><br>
                            </div>
                            <div class="w-full">
                                <label for="">
                                    <span
                                        class="block font-semibold mb-1 text-slate-700 after:content-['*'] after:text-pink-500 after:ml-0.5 dark:text-white">Batas
                                        Waktu</span>
                                    <input type="date" name="batas_waktu"
                                        onkeyup="this.value = this.value.toUpperCase()"
                                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                                        placeholder="Masukan Batas Waktu..." required>
                                    <span class="text-sm m-l text-red-500">{{ $errors->first('batas_waktu') }}</span>
                                </label><br>
                            </div>
                            <div class="w-full">
                                <label for="">
                                    <span
                                        class="block font-semibold mb-1 text-slate-700 after:content-['*'] after:text-pink-500 after:ml-0.5 dark:text-white">Tanggal
                                        Bayar</span>
                                    <input type="date" name="tgl_bayar"
                                        onkeyup="this.value = this.value.toUpperCase()"
                                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                                        placeholder="Masukan Tanggal Bayar..." required>
                                    <span class="text-sm m-l text-red-500">{{ $errors->first('tgl_bayar') }}</span>
                                </label><br>
                            </div>
                        </div>


                        <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                            <div class="bg-gray-300">
                                <div class="flex justify-between">
                                    <h1 class="p-4 font-bold">TAMBAH PAKET</h1>
                                </div>
                            </div>

                            <div class="p-6 text-gray-900 dark:text-gray-100">

                                <button type="button" onclick="tambahForm()"
                                    class="bg-sky-400 text-white m-6 p-4 h-10 mt-7 pt-2 rounded-xl hover:shadow-sky-700 hover:shadow-md">
                                    (+)</button>
                                <button type="button" onclick="hapusForm()"
                                    class="bg-sky-400 text-white m-6 p-4 h-10 mt-7 pt-2 rounded-xl hover:shadow-sky-700 hover:shadow-md">
                                    (-)</button>

                                <div class="grid grid-cols-1 gap-4 my-4" id="hasil">
                                    <div class="flex gap-4">
                                        <div class="w-full">
                                            <label for="">
                                                <span
                                                    class="block font-semibold mb-1 text-slate-700 after:content-['*'] after:text-pink-500 after:ml-0.5 dark:text-white">Paket</span>
                                                <select
                                                    class="js-example-basic-single js-states form-control  m-6 border"
                                                    style="width: 100%!important" name="id_paket[]"
                                                    data-placeholder="Pilih Paket" onchange="return getpaket()">
                                                    <option value="">Pilih...</option>
                                                    @foreach ($paket as $p)
                                                        <option value="{{ $p->jenis }}">
                                                            {{ $p->nama_paket }}
                                                        </option>
                                                    @endforeach
                                                </select><br>
                                            </label><br>
                                        </div>
                                        <div class="w-full">
                                            <label for="">
                                                <span
                                                    class="block font-semibold mb-1 text-slate-700 after:text-pink-500 after:ml-0.5 dark:text-white">Jenis</span>
                                                <input type="text" id="jenis" name="jenis[]"
                                                    onkeyup="this.value = this.value.toUpperCase()"
                                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                                                    placeholder="Masukan Jenis..." readonly>
                                            </label><br>
                                        </div>
                                        <div class="w-full">
                                            <label for="">
                                                <span
                                                    class="block font-semibold mb-1 text-slate-700 after:text-pink-500 after:ml-0.5 dark:text-white">Harga</span>
                                                <input type="text" id="harga" name="harga[]"
                                                    onkeyup="updateTotal()"
                                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                                                    placeholder="Masukan Harga..." readonly>
                                            </label><br>
                                        </div>
                                        <div class="w-full">
                                            <label for="">
                                                <span
                                                    class="block font-semibold mb-1 text-slate-700 after:content-['*'] after:text-pink-500 after:ml-0.5 dark:text-white">QTY</span>
                                                <input type="number" name="qty[]" id="qty"
                                                    onkeyup="updateTotal()"
                                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                                                    placeholder="Masukan QTY..." required>
                                                <span
                                                    class="text-sm m-l text-red-500">{{ $errors->first('qty') }}</span>
                                            </label><br>
                                        </div>
                                        <div class="w-full">
                                            <label for="">
                                                <span
                                                    class="block font-semibold mb-1 text-slate-700 after:content-['*'] after:text-pink-500 after:ml-0.5 dark:text-white">Jumlah</span>
                                                <input type="number" name="total[]" id="total"
                                                    onkeyup="this.value = this.value.toUpperCase()"
                                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                                                    placeholder="Masukan Jumlah..." required readonly>
                                                <span
                                                    class="text-sm m-l text-red-500">{{ $errors->first('qty') }}</span>
                                            </label><br>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="flex gap-4 my-4">
                            <div class="w-full">
                                <label for="">
                                    <span
                                        class="block font-semibold mb-1 text-slate-700 after:text-pink-500 after:ml-0.5 dark:text-white">Biaya
                                        Tambahan</span>
                                    <input type="number" name="biaya_tambahan"
                                        onkeyup="this.value = this.value.toUpperCase()"
                                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                                        placeholder="Masukan Biaya Tambahar...">
                                </label><br>
                            </div>
                            <div class="w-full">
                                <label for="">
                                    <span
                                        class="block font-semibold mb-1 text-slate-700 after:text-pink-500 after:ml-0.5 dark:text-white">Diskon</span>
                                    <input type="number" name="diskon"
                                        onkeyup="this.value = this.value.toUpperCase()"
                                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                                        placeholder="Masukan Diskon...">
                                </label><br>
                            </div>
                            <div class="w-full">
                                <label for="">
                                    <span
                                        class="block font-semibold mb-1 text-slate-700 after:text-pink-500 after:ml-0.5 dark:text-white">Pajak</span>
                                    <input type="number" name="pajak"
                                        onkeyup="this.value = this.value.toUpperCase()"
                                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                                        placeholder="Masukan Pajak..." readonly>
                                </label><br>
                            </div>
                        </div>

                        <div class="pt-2">
                            <button type="submit"
                                class="bg-sky-400 h-10 w-28 mt-2 rounded-xl text-lime-50 hover:bg-sky-600 hover:shadow-sky-700 hover:shadow-md">
                                <div class="">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="inline text-white" height="16"
                                        width="14"
                                        viewBox="0 0 448 512"><!--!Font Awesome Free 6.5.1 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2023 Fonticons, Inc.-->
                                        <path
                                            d="M64 32C28.7 32 0 60.7 0 96V416c0 35.3 28.7 64 64 64H384c35.3 0 64-28.7 64-64V173.3c0-17-6.7-33.3-18.7-45.3L352 50.7C340 38.7 323.7 32 306.7 32H64zm0 96c0-17.7 14.3-32 32-32H288c17.7 0 32 14.3 32 32v64c0 17.7-14.3 32-32 32H96c-17.7 0-32-14.3-32-32V128zM224 288a64 64 0 1 1 0 128 64 64 0 1 1 0-128z" />
                                    </svg> Simpan
                                </div>
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <script>
        const getpaket = async () => {
            var base_url = $('#base_url').val();

            const paket = document.querySelectorAll('[name="id_paket[]"]');
            const jenis = document.querySelectorAll('[name="jenis[]"]');
            const harga = document.querySelectorAll('[name="harga[]"]');

            paket.forEach(async (paketElement, index) => {
                const selectedOption = paketElement.querySelector('option:checked');
                if (selectedOption) {
                    try {
                        const response = await axios.get(
                            `${base_url}/api/paket/jenis/${selectedOption.value}`);
                        jenis[index].value = response.data.jenis;
                        harga[index].value = response.data.harga;
                    } catch (error) {
                        console.error(error);
                    }
                }
            });
        };

        function updateTotal() {
            const paket = document.querySelectorAll('[name="id_paket[]"]');
            const qty = document.querySelectorAll('[name="qty[]"]');
            const harga = document.querySelectorAll('[name="harga[]"]');
            const total = document.querySelectorAll('[name="total[]"]');

            paket.forEach(async (paketElement, index) => {
                let hargaVal = harga[index].value;
                let qtyVal = qty[index].value;
                total[index].value = hargaVal * qtyVal;
            });
        }


        function tambahForm() {
            const element = `
            <div class="flex gap-4">
		        <div class="w-full">
                                        <label for="">
                                            <span
                                                class="block font-semibold mb-1 text-slate-700 after:content-['*'] after:text-pink-500 after:ml-0.5 dark:text-white">Paket</span>
                                            <select class="js-example-basic-single js-states form-control  m-6 border"
                                                style="width: 100%!important" name="id_paket[]"
                                                data-placeholder="Pilih Paket" onchange="return getpaket()">
                                                <option value="">Pilih...</option>
                                                @foreach ($paket as $p)
                                                    <option value="{{ $p->jenis }}">
                                                        {{ $p->nama_paket }}
                                                    </option>
                                                @endforeach
                                            </select><br>
                                        </label><br>
                                    </div>
                                    <div class="w-full">
                                        <label for="">
                                            <span
                                                class="block font-semibold mb-1 text-slate-700 after:text-pink-500 after:ml-0.5 dark:text-white">Jenis</span>
                                            <input type="text" id="jenis" name="jenis[]"
                                                onkeyup="this.value = this.value.toUpperCase()"
                                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                                                placeholder="Masukan Jenis..." readonly>
                                        </label><br>
                                    </div>
                                    <div class="w-full">
                                        <label for="">
                                            <span
                                                class="block font-semibold mb-1 text-slate-700 after:text-pink-500 after:ml-0.5 dark:text-white">Harga</span>
                                            <input type="text" id="harga" name="harga[]"
                                                    onkeyup="updateTotal()"
                                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                                                placeholder="Masukan Harga..." readonly>
                                        </label><br>
                                    </div>
                                    <div class="w-full">
                                        <label for="">
                                            <span
                                                class="block font-semibold mb-1 text-slate-700 after:content-['*'] after:text-pink-500 after:ml-0.5 dark:text-white">QTY</span>
                                            <input type="number" name="qty[]" id="qty"
                                                    onkeyup="updateTotal()"
                                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                                                placeholder="Masukan QTY..." required>
                                            <span class="text-sm m-l text-red-500">{{ $errors->first('qty') }}</span>
                                        </label><br>
                                    </div>
                                    <div class="w-full">
                                            <label for="">
                                                <span
                                                    class="block font-semibold mb-1 text-slate-700 after:content-['*'] after:text-pink-500 after:ml-0.5 dark:text-white">Jumlah</span>
                                                <input type="number" name="total[]" id="total"
                                                    onkeyup="this.value = this.value.toUpperCase()"
                                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                                                    placeholder="Masukan Jumlah..." required readonly>
                                                <span
                                                    class="text-sm m-l text-red-500">{{ $errors->first('jumlah') }}</span>
                                            </label><br>
                                        </div>
                                </div>
		`;
            const form = document.createElement("div");
            form.innerHTML = element;
            document.getElementById('hasil').appendChild(form);
            $('.js-example-basic-single').select2();
        }
    </script>
</x-app-layout>
