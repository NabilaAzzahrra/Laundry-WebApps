<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Master') }}
        </h2>
    </x-slot>

    {{-- START MEMBER --}}
    <div class="py-12">
        <div class="flex">
            <div class="max-w-8xl w-1/2 mx-auto sm:px-6 lg:px-8">
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="bg-gray-300">
                        <h1 class="p-4 font-bold">TAMBAH DATA MEMBER</h1>
                    </div>
                    <div class="p-6 text-gray-900 dark:text-gray-100">
                        <form action="{{ route('member.store') }}" method="post">
                            @csrf
                            <label for="">
                                <span
                                    class="block font-semibold mb-1 text-slate-700 after:content-['*'] after:text-pink-500 after:ml-0.5 dark:text-white">Nama
                                    Lengkap</span>
                                <input type="text" name="nama" onkeyup="this.value = this.value.toUpperCase()"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                                    placeholder="Masukan Nama Lengkap..." required>
                                <span class="text-sm m-l text-red-500">{{ $errors->first('nama') }}</span>
                            </label><br>
                            <label for="">
                                <span
                                    class="block font-semibold mb-1 text-slate-700 after:content-['*'] after:text-pink-500 after:ml-0.5 dark:text-white">Alamat</span>
                                <input type="text" name="alamat" onkeyup="this.value = this.value.toUpperCase()"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                                    placeholder="Masukan Alamat..." required>
                                <span class="text-sm m-l text-red-500">{{ $errors->first('alamat') }}</span>
                            </label><br>
                            <label for="">
                                <span
                                    class="block font-semibold mb-1 text-slate-700 after:content-['*'] after:text-pink-500 after:ml-0.5 dark:text-white">Jenis
                                    Kelamin</span>
                                <select class="js-example-basic-single js-states form-control w-full m-6 border"
                                    name="jenis_kelamin" data-placeholder="Pilih Jenis Kelamin">
                                    <option value="">Pilih...</option>
                                    <option value="L">Laki-laki</option>
                                    <option value="P">Perempuan</option>
                                </select><br>
                                <span class="text-sm m-l text-red-500">{{ $errors->first('jenis_kelamin') }}</span>
                            </label><br>
                            <label for="">
                                <span
                                    class="block font-semibold mb-1 text-slate-700 after:content-['*'] after:text-pink-500 after:ml-0.5 dark:text-white">Telepon</span>
                                <input type="text" name="telp" onkeyup="this.value = this.value.toUpperCase()"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                                    placeholder="Masukan Telepon..." required>
                                <span class="text-sm m-l text-red-500">{{ $errors->first('telp') }}</span>
                            </label><br>
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
            <div class="max-w-8xl w-1/2 mx-auto sm:px-6 lg:px-8">
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900 dark:text-gray-100">
                        <table class="table table-bordered" id="member-datatable">
                            <thead>
                                <tr>
                                    <th>No.</th>
                                    <th>Nama</th>
                                    <th>Alamat</th>
                                    <th>Jenis Kelamin</th>
                                    <th>Telepon</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                        </table>
                    </div>
                </div>
            </div>
            <div class="fixed inset-0 flex items-center justify-center z-50 hidden" id="sourceModal">
                <div class="fixed inset-0 bg-black opacity-50"></div>
                <div class="fixed inset-0 flex items-center justify-center">
                    <div class="w-full md:w-1/2 relative bg-white rounded-lg shadow mx-5">
                        <div class="flex items-start justify-between p-4 border-b rounded-t">
                            <h3 class="text-xl font-semibold text-gray-900" id="title_source">
                                Tambah Sumber Database
                            </h3>
                            <button type="button" onclick="sourceModalClose(this)" data-modal-target="sourceModal"
                                class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ml-auto inline-flex justify-center items-center"
                                data-modal-hide="defaultModal">
                                <i class="fa-solid fa-xmark"></i>
                            </button>
                        </div>
                        <form method="POST" action="{{ route('member.store') }}" id="formSourceModal">
                            @csrf
                            <div class="p-4 space-y-6">
                                <label for="">
                                    <span
                                        class="block font-semibold mb-1 text-slate-700 after:content-['*'] after:text-pink-500 after:ml-0.5 dark:text-white">Nama
                                        Lengkap</span>
                                    <input type="text" id="nama" name="nama"
                                        onkeyup="this.value = this.value.toUpperCase()"
                                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                                        placeholder="Masukan Nama Lengkap..." required>
                                    <span class="text-sm m-l text-red-500">{{ $errors->first('nama') }}</span>
                                </label><br>
                                <label for="">
                                    <span
                                        class="block font-semibold mb-1 text-slate-700 after:content-['*'] after:text-pink-500 after:ml-0.5 dark:text-white">Alamat</span>
                                    <input type="text" id="alamat" name="alamat"
                                        onkeyup="this.value = this.value.toUpperCase()"
                                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                                        placeholder="Masukan Alamat..." required>
                                    <span class="text-sm m-l text-red-500">{{ $errors->first('alamat') }}</span>
                                </label><br>
                                <label for="">
                                    <span
                                        class="block font-semibold mb-1 text-slate-700 after:content-['*'] after:text-pink-500 after:ml-0.5 dark:text-white">Jenis
                                        Kelamin</span>
                                    <select class="js-example-basic-single js-states form-control  m-6 border"
                                        style="width: 100%!important" name="jenis_kelamin"
                                        data-placeholder="Pilih Jenis Kelamin" id="jenis_kelamin">
                                        <option value="">Pilih...</option>
                                        <option value="L">Laki-laki</option>
                                        <option value="P">Perempuan</option>
                                    </select><br>
                                    <span class="text-sm m-l text-red-500">{{ $errors->first('jenis_kelamin') }}</span>
                                </label><br>
                                <label for="">
                                    <span
                                        class="block font-semibold mb-1 text-slate-700 after:content-['*'] after:text-pink-500 after:ml-0.5 dark:text-white">Telepon</span>
                                    <input type="text" id="telp" name="telp"
                                        onkeyup="this.value = this.value.toUpperCase()"
                                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                                        placeholder="Masukan Telepon..." required>
                                    <span class="text-sm m-l text-red-500">{{ $errors->first('telp') }}</span>
                                </label><br>
                            </div>
                            <div class="flex items-center p-4 space-x-2 border-t border-gray-200 rounded-b">
                                <button type="submit" id="formSourceButton"
                                    class="bg-green-400 m-2 w-40 h-10 rounded-xl hover:bg-green-500">Simpan</button>
                                <button type="button" data-modal-target="sourceModal"
                                    onclick="changeSourceModal(this)"
                                    class="bg-red-500 m-2 w-40 h-10 rounded-xl text-white hover:shadow-lg hover:bg-red-600">Batal</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    {{-- END MEMBER --}}

    {{-- START OUTLET --}}
    <div class="py-12">
        <div class="flex">
            <div class="max-w-8xl w-1/2 mx-auto sm:px-6 lg:px-8">
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="bg-gray-300">
                        <h1 class="p-4 font-bold">TAMBAH DATA OUTLET</h1>
                    </div>
                    <div class="p-6 text-gray-900 dark:text-gray-100">
                        <form action="{{ route('outlet.store') }}" method="post">
                            @csrf
                            <label for="">
                                <span
                                    class="block font-semibold mb-1 text-slate-700 after:content-['*'] after:text-pink-500 after:ml-0.5 dark:text-white">Nama
                                    Outlet</span>
                                <input type="text" name="nama" onkeyup="this.value = this.value.toUpperCase()"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                                    placeholder="Masukan Nama Lengkap..." required>
                                <span class="text-sm m-l text-red-500">{{ $errors->first('nama') }}</span>
                            </label><br>
                            <label for="">
                                <span
                                    class="block font-semibold mb-1 text-slate-700 after:content-['*'] after:text-pink-500 after:ml-0.5 dark:text-white">Alamat</span>
                                <input type="text" name="alamat" onkeyup="this.value = this.value.toUpperCase()"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                                    placeholder="Masukan Alamat..." required>
                                <span class="text-sm m-l text-red-500">{{ $errors->first('alamat') }}</span>
                            </label><br>
                            <label for="">
                                <span
                                    class="block font-semibold mb-1 text-slate-700 after:content-['*'] after:text-pink-500 after:ml-0.5 dark:text-white">Telepon</span>
                                <input type="text" name="telp" onkeyup="this.value = this.value.toUpperCase()"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                                    placeholder="Masukan Telepon..." required>
                                <span class="text-sm m-l text-red-500">{{ $errors->first('telp') }}</span>
                            </label><br>
                            <div class="pt-2">
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
                        </form>
                    </div>
                </div>
            </div>
            <div class="max-w-8xl w-1/2 mx-auto sm:px-6 lg:px-8">
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900 dark:text-gray-100">
                        <table class="table table-bordered" id="outlet-datatable">
                            <thead>
                                <tr>
                                    <th>No.</th>
                                    <th>Nama</th>
                                    <th>Alamat</th>
                                    <th>Telepon</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                        </table>
                    </div>
                </div>
            </div>
            <div class="fixed inset-0 flex items-center justify-center z-50 hidden" id="sourceModal-outlet">
                <div class="fixed inset-0 bg-black opacity-50"></div>
                <div class="fixed inset-0 flex items-center justify-center">
                    <div class="w-full md:w-1/2 relative bg-white rounded-lg shadow mx-5">
                        <div class="flex items-start justify-between p-4 border-b rounded-t">
                            <h3 class="text-xl font-semibold text-gray-900" id="title_source_outlet">
                                fd
                            </h3>
                            <button type="button" onclick="sourceModalCloseOutlet(this)"
                                data-modal-target="sourceModal-outlet"
                                class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ml-auto inline-flex justify-center items-center"
                                data-modal-hide="defaultModal">
                                <i class="fa-solid fa-xmark"></i>
                            </button>
                        </div>
                        <form method="POST" action="{{ route('outlet.store') }}" id="formSourceModal-outlet">
                            @csrf
                            <div class="p-4 space-y-6">
                                <label for="">
                                    <span
                                        class="block font-semibold mb-1 text-slate-700 after:content-['*'] after:text-pink-500 after:ml-0.5 dark:text-white">Nama
                                        Lengkap</span>
                                    <input type="text" id="nama_outlet" name="nama"
                                        onkeyup="this.value = this.value.toUpperCase()"
                                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                                        placeholder="Masukan Nama Lengkap..." required>
                                    <span class="text-sm m-l text-red-500">{{ $errors->first('nama') }}</span>
                                </label><br>
                                <label for="">
                                    <span
                                        class="block font-semibold mb-1 text-slate-700 after:content-['*'] after:text-pink-500 after:ml-0.5 dark:text-white">Alamat</span>
                                    <input type="text" id="alamat_outlet" name="alamat"
                                        onkeyup="this.value = this.value.toUpperCase()"
                                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                                        placeholder="Masukan Alamat..." required>
                                    <span class="text-sm m-l text-red-500">{{ $errors->first('alamat') }}</span>
                                </label><br>
                                <label for="">
                                    <span
                                        class="block font-semibold mb-1 text-slate-700 after:content-['*'] after:text-pink-500 after:ml-0.5 dark:text-white">Telepon</span>
                                    <input type="text" id="telp_outlet" name="telp"
                                        onkeyup="this.value = this.value.toUpperCase()"
                                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                                        placeholder="Masukan Telepon..." required>
                                    <span class="text-sm m-l text-red-500">{{ $errors->first('telp') }}</span>
                                </label><br>
                            </div>
                            <div class="flex items-center p-4 space-x-2 border-t border-gray-200 rounded-b">
                                <button type="submit" id="formSourceButtonOutlet"
                                    class="bg-green-400 m-2 w-40 h-10 rounded-xl hover:bg-green-500">Simpan</button>
                                <button type="button" data-modal-target="sourceModal"
                                    onclick="changeSourceModal(this)"
                                    class="bg-red-500 m-2 w-40 h-10 rounded-xl text-white hover:shadow-lg hover:bg-red-600">Batal</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    {{-- END OUTLET --}}

    {{-- START PAKET --}}
    <div class="py-12">
        <div class="flex">
            <div class="max-w-8xl w-1/2 mx-auto sm:px-6 lg:px-8">
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="bg-gray-300">
                        <h1 class="p-4 font-bold">TAMBAH DATA OUTLET</h1>
                    </div>
                    <div class="p-6 text-gray-900 dark:text-gray-100">
                        <form action="{{ route('outlet.store') }}" method="post">
                            @csrf
                            <label for="">
                                <span
                                    class="block font-semibold mb-1 text-slate-700 after:content-['*'] after:text-pink-500 after:ml-0.5 dark:text-white">Nama
                                    Outlet</span>
                                <input type="text" name="nama" onkeyup="this.value = this.value.toUpperCase()"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                                    placeholder="Masukan Nama Lengkap..." required>
                                <span class="text-sm m-l text-red-500">{{ $errors->first('nama') }}</span>
                            </label><br>
                            <label for="">
                                <span
                                    class="block font-semibold mb-1 text-slate-700 after:content-['*'] after:text-pink-500 after:ml-0.5 dark:text-white">Alamat</span>
                                <input type="text" name="alamat" onkeyup="this.value = this.value.toUpperCase()"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                                    placeholder="Masukan Alamat..." required>
                                <span class="text-sm m-l text-red-500">{{ $errors->first('alamat') }}</span>
                            </label><br>
                            <label for="">
                                <span
                                    class="block font-semibold mb-1 text-slate-700 after:content-['*'] after:text-pink-500 after:ml-0.5 dark:text-white">Telepon</span>
                                <input type="text" name="telp" onkeyup="this.value = this.value.toUpperCase()"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                                    placeholder="Masukan Telepon..." required>
                                <span class="text-sm m-l text-red-500">{{ $errors->first('telp') }}</span>
                            </label><br>
                            <div class="pt-2">
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
                        </form>
                    </div>
                </div>
            </div>
            <div class="max-w-8xl w-1/2 mx-auto sm:px-6 lg:px-8">
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900 dark:text-gray-100">
                        <table class="table table-bordered" id="outlet-datatable">
                            <thead>
                                <tr>
                                    <th>No.</th>
                                    <th>Nama</th>
                                    <th>Alamat</th>
                                    <th>Telepon</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                        </table>
                    </div>
                </div>
            </div>
            <div class="fixed inset-0 flex items-center justify-center z-50 hidden" id="sourceModal-outlet">
                <div class="fixed inset-0 bg-black opacity-50"></div>
                <div class="fixed inset-0 flex items-center justify-center">
                    <div class="w-full md:w-1/2 relative bg-white rounded-lg shadow mx-5">
                        <div class="flex items-start justify-between p-4 border-b rounded-t">
                            <h3 class="text-xl font-semibold text-gray-900" id="title_source_outlet">
                                fd
                            </h3>
                            <button type="button" onclick="sourceModalCloseOutlet(this)"
                                data-modal-target="sourceModal-outlet"
                                class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ml-auto inline-flex justify-center items-center"
                                data-modal-hide="defaultModal">
                                <i class="fa-solid fa-xmark"></i>
                            </button>
                        </div>
                        <form method="POST" action="{{ route('outlet.store') }}" id="formSourceModal-outlet">
                            @csrf
                            <div class="p-4 space-y-6">
                                <label for="">
                                    <span
                                        class="block font-semibold mb-1 text-slate-700 after:content-['*'] after:text-pink-500 after:ml-0.5 dark:text-white">Nama
                                        Lengkap</span>
                                    <input type="text" id="nama_outlet" name="nama"
                                        onkeyup="this.value = this.value.toUpperCase()"
                                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                                        placeholder="Masukan Nama Lengkap..." required>
                                    <span class="text-sm m-l text-red-500">{{ $errors->first('nama') }}</span>
                                </label><br>
                                <label for="">
                                    <span
                                        class="block font-semibold mb-1 text-slate-700 after:content-['*'] after:text-pink-500 after:ml-0.5 dark:text-white">Alamat</span>
                                    <input type="text" id="alamat_outlet" name="alamat"
                                        onkeyup="this.value = this.value.toUpperCase()"
                                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                                        placeholder="Masukan Alamat..." required>
                                    <span class="text-sm m-l text-red-500">{{ $errors->first('alamat') }}</span>
                                </label><br>
                                <label for="">
                                    <span
                                        class="block font-semibold mb-1 text-slate-700 after:content-['*'] after:text-pink-500 after:ml-0.5 dark:text-white">Telepon</span>
                                    <input type="text" id="telp_outlet" name="telp"
                                        onkeyup="this.value = this.value.toUpperCase()"
                                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                                        placeholder="Masukan Telepon..." required>
                                    <span class="text-sm m-l text-red-500">{{ $errors->first('telp') }}</span>
                                </label><br>
                            </div>
                            <div class="flex items-center p-4 space-x-2 border-t border-gray-200 rounded-b">
                                <button type="submit" id="formSourceButtonOutlet"
                                    class="bg-green-400 m-2 w-40 h-10 rounded-xl hover:bg-green-500">Simpan</button>
                                <button type="button" data-modal-target="sourceModal"
                                    onclick="changeSourceModal(this)"
                                    class="bg-red-500 m-2 w-40 h-10 rounded-xl text-white hover:shadow-lg hover:bg-red-600">Batal</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    {{-- END PAKET --}}

    {{-- START MEMBER --}}
    <script>
        $(document).ready(function() {
            console.log('RUN!');
            $('#member-datatable').DataTable({
                ajax: {
                    url: 'api/member',
                    dataSrc: 'member'
                },
                columns: [{
                    data: 'no',
                    render: (data, type, row, meta) => {
                        return meta.row + 1;
                    }
                }, {
                    data: 'nama',
                }, {
                    data: 'alamat',
                }, {
                    data: 'jenis_kelamin',
                }, {
                    data: 'telp',
                }, {
                    data: {
                        no: 'no',
                        name: 'name'
                    },
                    render: (data) => {
                        let editUrl =
                            `<button type="button" data-id="${data.id}"
                                                        data-modal-target="sourceModal" data-nama="${data.nama}" data-alamat="${data.alamat}" data-jenis_kelamin="${data.jenis_kelamin}" data-telp="${data.telp}"
                                                        onclick="editSourceModal(this)"
                                                        class="bg-amber-500 hover:bg-amber-600 px-3 py-1 rounded-md text-xs text-white">
                                                       <i class="fas fa-edit"></i>
                                                    </button>`;
                        let deleteUrl =
                            `<button onclick="return memberDelete('${data.id}','${data.nama}')" class="bg-red-500 hover:bg-bg-red-300 px-3 py-1 rounded-md text-xs text-white"><i class="fas fa-trash"></i></button>`;
                        return `${editUrl} ${deleteUrl}`;
                    }
                }, ],
            });
        });

        const editSourceModal = (button) => {
            const formModal = document.getElementById('formSourceModal');
            const modalTarget = button.dataset.modalTarget;
            const id = button.dataset.id;
            const nama = button.dataset.nama;
            const alamat = button.dataset.alamat;
            const jenis_kelamin = button.dataset.jenis_kelamin;
            const telp = button.dataset.telp;
            let url = "{{ route('member.update', ':id') }}".replace(':id', id);
            let status = document.getElementById(modalTarget);

            document.getElementById('title_source').innerText = `Update Member ${nama}`;
            document.getElementById('nama').value = nama;
            document.getElementById('alamat').value = alamat;

            // Definisi variabel selectElement
            const selectElement = $('#jenis_kelamin');

            // Set nilai Select2 dan memicu perubahan
            selectElement.val(jenis_kelamin).trigger('change');

            // Log nilai selectElement untuk debug
            console.log(selectElement.val());

            document.getElementById('telp').value = telp;
            document.getElementById('formSourceButton').innerText = 'Simpan';
            document.getElementById('formSourceModal').setAttribute('action', url);

            let csrfToken = document.createElement('input');
            csrfToken.setAttribute('type', 'hidden');
            csrfToken.setAttribute('value', '{{ csrf_token() }}');
            formModal.appendChild(csrfToken);

            let methodInput = document.createElement('input');
            methodInput.setAttribute('type', 'hidden');
            methodInput.setAttribute('name', '_method');
            methodInput.setAttribute('value', 'PATCH');
            formModal.appendChild(methodInput);

            status.classList.toggle('hidden');
        }

        const sourceModalClose = (button) => {
            const modalTarget = button.dataset.modalTarget;
            let status = document.getElementById(modalTarget);
            status.classList.toggle('hidden');
        }

        const memberDelete = async (id, nama) => {
            let tanya = confirm(`Apakah anda yakin untuk menghapus ${nama} ?`);
            if (tanya) {
                await axios.post(`/member/${id}`, {
                        '_method': 'DELETE',
                        '_token': $('meta[name="csrf-token"]').attr('content')
                    })
                    .then(function(response) {
                        // Handle success
                        location.reload();
                    })
                    .catch(function(error) {
                        // Handle error
                        alert('Error deleting record');
                        console.log(error);
                    });
            }
        }
    </script>
    {{-- END MEMBER --}}

    {{-- START OUTLET --}}
    <script>
        $(document).ready(function() {
            console.log('RUN!');
            $('#outlet-datatable').DataTable({
                ajax: {
                    url: 'api/outlet',
                    dataSrc: 'outlet'
                },
                columns: [{
                    data: 'no',
                    render: (data, type, row, meta) => {
                        return meta.row + 1;
                    }
                }, {
                    data: 'nama',
                }, {
                    data: 'alamat',
                }, {
                    data: 'tlp',
                }, {
                    data: {
                        no: 'no',
                        name: 'name'
                    },
                    render: (data) => {
                        let editUrl =
                            `<button type="button" data-id="${data.id}"
                                                        data-modal-target="sourceModal-outlet" data-nama="${data.nama}" data-alamat="${data.alamat}" data-telp="${data.tlp}"
                                                        onclick="editSourceModalOutlet(this)"
                                                        class="bg-amber-500 hover:bg-amber-600 px-3 py-1 rounded-md text-xs text-white">
                                                       <i class="fas fa-edit"></i>
                                                    </button>`;
                        let deleteUrl =
                            `<button onclick="return memberDeleteOutlet('${data.id}','${data.nama}')" class="bg-red-500 hover:bg-bg-red-300 px-3 py-1 rounded-md text-xs text-white"><i class="fas fa-trash"></i></button>`;
                        return `${editUrl} ${deleteUrl}`;
                    }
                }, ],
            });
        });

        const editSourceModalOutlet = (button) => {
            const formModal = document.getElementById('formSourceModal-outlet');
            const modalTarget = button.dataset.modalTarget;
            const id = button.dataset.id;
            const nama = button.dataset.nama;
            const alamat = button.dataset.alamat;
            const telp = button.dataset.telp;
            let url = "{{ route('outlet.update', ':id') }}".replace(':id', id);
            let status = document.getElementById(modalTarget);

            document.getElementById('title_source_outlet').innerText = `Update Outlet ${nama}`;
            document.getElementById('nama_outlet').value = nama;
            document.getElementById('alamat_outlet').value = alamat;
            document.getElementById('telp_outlet').value = telp;
            document.getElementById('formSourceButtonOutlet').innerText = 'Simpan';
            document.getElementById('formSourceModal-outlet').setAttribute('action', url);

            let csrfToken = document.createElement('input');
            csrfToken.setAttribute('type', 'hidden');
            csrfToken.setAttribute('value', '{{ csrf_token() }}');
            formModal.appendChild(csrfToken);

            let methodInput = document.createElement('input');
            methodInput.setAttribute('type', 'hidden');
            methodInput.setAttribute('name', '_method');
            methodInput.setAttribute('value', 'PATCH');
            formModal.appendChild(methodInput);

            status.classList.toggle('hidden');
        }

        const sourceModalCloseOutlet = (button) => {
            const modalTarget = button.dataset.modalTarget;
            let status = document.getElementById(modalTarget);

            // Check if the element is found before accessing properties
            if (status) {
                status.classList.toggle('hidden');
            } else {
                console.error('Element not found with ID:', modalTarget);
            }
        };

        const memberDeleteOutlet = async (id, nama) => {
            let tanya = confirm(`Apakah anda yakin untuk menghapus ${nama} ?`);
            if (tanya) {
                await axios.post(`/outlet/${id}`, {
                        '_method': 'DELETE',
                        '_token': $('meta[name="csrf-token"]').attr('content')
                    })
                    .then(function(response) {
                        // Handle success
                        location.reload();
                    })
                    .catch(function(error) {
                        // Handle error
                        alert('Error deleting record');
                        console.log(error);
                    });
            }
        }
    </script>
    {{-- END OUTLET --}}
</x-app-layout>
