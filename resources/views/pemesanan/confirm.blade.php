<x-app-layout>
    @include('sweetalert::alert')

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Konfirmasi Pemesanan') }}
        </h2>
    </x-slot>
    {{-- {{ $carData }} --}}
    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="p-6 grid grid-cols-2 grid-flow-col gap-6 items-center   text-gray-900 dark:text-gray-100">
                <div class="p-6 bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                    <form action="/pemesanan" method="post">
                        @csrf
                        <input type="hidden" name="userId" value="{{ Auth::user()->id }}" />
                        <input type="hidden" name="carId" value="{{ $data_mobil->id }}" />
                        <input type="hidden" name="nama_penerima" value="{{ $nama_penerima }}" />
                        <input type="hidden" name="nomor_penerima" value="{{ $nomor_penerima }}" />
                        <input type="hidden" name="alamat_penerima" value="{{ $alamat_penerima }}" />
                        <input type="hidden" name="jumlah" value="{{ $jumlah }}" />
                        <input type="hidden" name="harga_total" value="{{ $harga_total }}" />
                        <div class="mb-6">
                            <label class="block mb-2 font-bold text-xl text-gray-900 dark:text-white"> {{ __("Informasi Pemesanan") }}
                            </label>
                        </div>
                        <div class="grid grid-cols-2 gap-4 text-xs py-2">
                            <div class="text-gray-400">Merek</div>
                            <span id="dataMobil" class="text-right font-medium text-gray-900 dark:text-white">{{ $data_mobil->merek }} {{ $data_mobil->tipe }}</span>
                        </div>
                        <div class="grid grid-cols-2 gap-4 text-xs py-2">
                            <div class="text-gray-400">Jumlah</div>
                            <span id="dataSpan2" class="text-right font-medium text-gray-900 dark:text-white">{{ $jumlah }}</span>
                        </div>
                        <div class="grid grid-cols-2 gap-4 text-xs py-2">
                            <div class="text-gray-400">Harga</div>
                            <div class="text-right font-medium text-gray-900 dark:text-white">Rp.{{ number_format($data_mobil->harga, 0, ',', '.') }}</div>
                        </div>
                        <div class="grid grid-cols-2 gap-4 text-xs py-2">
                            <div class="text-gray-400 ">Nama Penerima</div>
                            <div class="text-right font-medium text-gray-900 dark:text-white">{{ $nama_penerima }}</div>
                        </div>

                        <div class="grid grid-cols-2 gap-4 text-xs py-2">
                            <div class="text-gray-400">Nomor Penerima</div>
                            <div class="text-right font-medium text-gray-900 dark:text-white">{{ $nomor_penerima }}</div>
                        </div>
                        <div class="grid grid-cols-2 gap-4 text-xs py-2">
                            <div class="text-gray-400">Alamat Penerima</div>
                            <div class="text-right font-medium text-gray-900 dark:text-white">{{ $alamat_penerima }}</div>
                        </div>
                        <div class="grid grid-cols-2 gap-4 text-xs py-2">
                            <div class="text-gray-400">Total</div>
                            <div class="text-right font-bold text-xl text-gray-900 dark:text-white">Rp. {{ number_format($harga_total, 0, ',', '.') }}</div>
                        </div>
                        <label for="default-radio" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white"> {{ __("Metode Pembayaran") }}
                        </label>
                        <div class="flex items-center mb-lg-2">
                            <input checked id="default-radio-1" type="radio" value="" name="default-radio" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                            <label for="default-radio-1" class="ml-2 text-sm font-medium text-gray-900 dark:text-gray-300">Transfer </label>
                        </div>

                        <span class="mt-1 text-sm font-medium text-gray-900 flex dark:text-gray-300">Mandiri: 12211212 (PT Citra Asri Buana)
                        </span>
                        <span class="text-sm font-medium text-gray-900 dark:text-gray-300">BCA: 221312123 (PT Citra Asri Buana)
                        </span>

                        <button type="submit" class="text-white mt-3 bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 justify-center inline-flex items-center mr-2 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800 w-full">
                            <svg aria-hidden="true" class="w-5 h-5 mr-2 -ml-1" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                <path d="M3 1a1 1 0 000 2h1.22l.305 1.222a.997.997 0 00.01.042l1.358 5.43-.893.892C3.74 11.846 4.632 14 6.414 14H15a1 1 0 000-2H6.414l1-1H14a1 1 0 00.894-.553l3-6A1 1 0 0017 3H6.28l-.31-1.243A1 1 0 005 1H3zM16 16.5a1.5 1.5 0 11-3 0 1.5 1.5 0 013 0zM6.5 18a1.5 1.5 0 100-3 1.5 1.5 0 000 3z"></path>
                            </svg>
                            Beli Sekarang
                        </button>
                    </form>
                </div>
                <div>
                    <img src="{{ url('images/cars/'.$data_mobil->gambar)  }}" class="max-h-72" alt="">
                </div>
            </div>
        </div>
    </div>

</x-app-layout>
