<x-app-layout>
    @include('sweetalert::alert')

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Retur') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    {{-- <form action="/retur/{{ $dataPemesanan->id }}" method="POST" enctype="multipart/form-data"> --}}
                    <form method="POST" action="{{ route('retur.store') }}">
                        @csrf
                        <div class="mb-6 flex">
                            <div class="mr-4">
                                <label for="no_retur" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white"> {{ __("No Retur") }}
                                </label>
                                <input type="text" name="no_retur" id="no_retur" class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500 dark:shadow-sm-light" value="Retur{{ $dataPemesanan->id }}{{ date('dmy') }}" required readonly>
                            </div>
                            <!-- Add an additional input field -->
                            <div class="mr-4">
                                <label for="mobil" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white"> {{ __("Mobil") }}
                                </label>
                                <input type="text" name="mobil" id="mobil" class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500 dark:shadow-sm-light" value="{{ $dataPemesanan->mobil->merek }} {{ $dataPemesanan->mobil->tipe }}" readonly>
                            </div>
                        </div>
                        <div class="mb-6 flex">
                            <div class="mr-4">
                                <label for="jumlah_beli" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white"> {{ __("Jumlah Beli") }}
                                </label>
                                <input type="number" name="jumlah_beli" id="jumlah_beli" class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500 dark:shadow-sm-light" value="{{ $dataPemesanan->jumlah }}" readonly>
                            </div>
                            <!-- Add an additional input field -->
                            <div class="mr-4">
                                <label for="jumlah_retur" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white"> {{ __("Jumlah Retur") }}
                                </label>
                                <input type="number" name="jumlah_retur" min="1" max="{{ $dataPemesanan->jumlah }}" id="jumlah_retur" class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500 dark:shadow-sm-light" value="" placeholder="0" required>
                            </div>
                        </div>

                        <div class="mb-6">
                            <label for="alasan_retur" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white"> {{ __("Alasan Retur") }}
                            </label>
                            <input type="text" name="alasan_retur" id="alasan_retur" class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500 dark:shadow-sm-light" value="" placeholder="Tidak Sesuai" required>
                        </div>
                        <input type="text" name="pemesanan_id" id="pemesanan_id" value="{{ $dataPemesanan->id  }}" required hidden>
                        <button type="submit" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Simpan</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
