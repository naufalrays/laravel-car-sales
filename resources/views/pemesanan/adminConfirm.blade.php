<x-app-layout>
    @include('sweetalert::alert')

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Konfirmasi Pembayaran') }}
        </h2>
    </x-slot>
    {{-- {{ $carData }} --}}
    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="p-6 grid grid-cols-2 grid-flow-col gap-6 items-center   text-gray-900 dark:text-gray-100">
                <div class="p-6 bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="mb-6">
                        <label class="block mb-2 font-bold text-xl text-gray-900 dark:text-white"> {{ __("Informasi Pemesanan") }}
                        </label>
                    </div>
                    <div class="grid grid-cols-2 gap-4 text-xs py-2">
                        <div class="text-gray-400">Merek</div>
                        <span id="dataMobil" class="text-right font-medium text-gray-900 dark:text-white">{{ $dataPemesanan->mobil->merek }} {{ $dataPemesanan->mobil->tipe }}</span>
                    </div>
                    <div class="grid grid-cols-2 gap-4 text-xs py-2">
                        <div class="text-gray-400">Jumlah</div>
                        <span id="dataSpan2" class="text-right font-medium text-gray-900 dark:text-white">{{ $dataPemesanan->jumlah }}</span>
                    </div>
                    <div class="grid grid-cols-2 gap-4 text-xs py-2">
                        <div class="text-gray-400">Harga</div>
                        <div class="text-right font-medium text-gray-900 dark:text-white">Rp.{{ number_format($dataPemesanan->mobil->harga, 0, ',', '.') }}</div>
                    </div>
                    <div class="grid grid-cols-2 gap-4 text-xs py-2">
                        <div class="text-gray-400 ">Nama Penerima</div>
                        <div class="text-right font-medium text-gray-900 dark:text-white">{{ $dataPemesanan->nama_penerima }}</div>
                    </div>
                    <div class="grid grid-cols-2 gap-4 text-xs py-2">
                        <div class="text-gray-400 ">Email Penerima</div>
                        <div class="text-right font-medium text-gray-900 dark:text-white">{{ $dataPemesanan->user->email }}</div>
                    </div>
                    <div class="grid grid-cols-2 gap-4 text-xs py-2">
                        <div class="text-gray-400">Nomor Penerima</div>
                        <div class="text-right font-medium text-gray-900 dark:text-white">{{ $dataPemesanan->nomor_penerima }}</div>
                    </div>
                    <div class="grid grid-cols-2 gap-4 text-xs py-2">
                        <div class="text-gray-400">Alamat Penerima</div>
                        <div class="text-right font-medium text-gray-900 dark:text-white">{{ $dataPemesanan->alamat_penerima }}</div>
                    </div>
                    <div class="grid grid-cols-2 gap-4 text-xs py-2">
                        <div class="text-gray-400">Total</div>
                        <div class="text-right font-bold text-xl text-gray-900 dark:text-white">Rp. {{ number_format($dataPemesanan->harga_total, 0, ',', '.') }}</div>
                    </div>
                    <div class="flex">
                        <a href="{{ route('pemesanan.updateKonfirmasiPembayaran',['id' => $dataPemesanan->id, 'bool' => 'gagal']) }}" class="text-white mt-3 bg-red-600 hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-200 font-medium rounded-lg text-sm px-5 py-2.5 justify-center inline-flex items-center mr-2 dark:bg-red-600 dark:hover:bg-red-800 dark:focus:ring-red-600 w-full">
                            Batalkan
                        </a>
                        <a href="{{ route('pemesanan.updateKonfirmasiPembayaran',['id' => $dataPemesanan->id, 'bool' => 'berhasil']) }}" class="text-white mt-3 bg-green-700 hover:bg-green-800 focus:ring-4 focus:outline-none focus:ring-green-300 font-medium rounded-lg text-sm px-5 py-2.5 justify-center inline-flex items-center dark:bg-green-600 dark:hover:bg-green-700 dark:focus:ring-green-800 w-full">
                            Konfirmasi
                        </a>
                    </div>
                </div>
                <div>
                    <label class="block mb-2 font-bold text-xl text-gray-900 dark:text-white"> {{ __("Bukti Pembayaran :") }}
                    </label>
                    <img src="{{ url('images/buktiPembayaran/'.$dataPemesanan->gambar)  }}" class="max-h-72" alt="">
                </div>
            </div>
        </div>
    </div>

</x-app-layout>
