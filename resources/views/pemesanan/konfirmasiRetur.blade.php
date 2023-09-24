<x-app-layout>
    @include('sweetalert::alert')

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Konfirmasi Retur') }}
        </h2>
    </x-slot>
    {{-- {{ $carData }} --}}

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <form action="/pemesanan/{{ $dataPemesanan->id }}/konfirmasiRetur" method="post">
                @csrf
                <div class="p-6 grid grid-cols-2 grid-flow-col gap-6 items-center   text-gray-900 dark:text-gray-100">
                    <div class="p-6 bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">

                        <div class="mb-6">
                            <label class="block mb-2 font-bold text-xl text-gray-900 dark:text-white"> {{ __("Informasi Retur") }}
                            </label>
                        </div>
                        <div class="grid grid-cols-2 gap-4 text-xs py-2">
                            <div class="text-gray-400">Merek</div>
                            <span id="dataMobil" class="text-right font-medium text-gray-900 dark:text-white">{{ $dataPemesanan->mobil->merek }} {{ $dataPemesanan->mobil->tipe }}</span>
                        </div>
                        <div class="grid grid-cols-2 gap-4 text-xs py-2">
                            <div class="text-gray-400">Jumlah Beli</div>
                            <span id="dataSpan2" class="text-right font-medium text-gray-900 dark:text-white">{{ $dataPemesanan->jumlah }}</span>
                        </div>
                        <div class="grid grid-cols-2 gap-4 text-xs py-2">
                            <div class="text-gray-400">Jumlah Retur</div>
                            <span id="dataSpan2" class="text-right font-medium text-gray-900 dark:text-white">{{ $dataRetur->jumlah_retur }}</span>
                        </div>
                        <div class="grid grid-cols-2 gap-4 text-xs py-2">
                            <div class="text-gray-400">Total Beli</div>
                            <div class="text-right font-medium text-gray-900 dark:text-white">Rp.{{ number_format($dataPemesanan->harga_total, 0, ',', '.') }}</div>
                        </div>
                        <div class="grid grid-cols-2 gap-4 text-xs py-2">
                            <div class="text-gray-400">Total Retur</div>
                            <div class="text-right font-medium text-gray-900 dark:text-white">Rp.{{ number_format($dataRetur->harga_total_retur, 0, ',', '.') }}</div>
                        </div>
                        <div class="grid grid-cols-2 gap-4 text-xs py-2">
                            <div class="text-gray-400 ">Nama Peretur</div>
                            <div class="text-right font-medium text-gray-900 dark:text-white">{{ $dataPemesanan->nama_penerima }}</div>
                        </div>
                        <div class="grid grid-cols-2 gap-4 text-xs py-2">
                            <div class="text-gray-400 ">Email Peretur</div>
                            <div class="text-right font-medium text-gray-900 dark:text-white">{{ $dataPemesanan->user->email }}</div>
                        </div>
                        <div class="grid grid-cols-2 gap-4 text-xs py-2">
                            <div class="text-gray-400">Nomor Peretur</div>
                            <div class="text-right font-medium text-gray-900 dark:text-white">{{ $dataPemesanan->nomor_penerima }}</div>
                        </div>
                        <div class="grid grid-cols-2 gap-4 text-xs py-2">
                            <div class="text-gray-400">Alamat Peretur</div>
                            <div class="text-right font-medium text-gray-900 dark:text-white">{{ $dataPemesanan->alamat_penerima }}</div>
                        </div>
                        <div class="grid grid-cols-2 gap-4 text-xs py-2">
                            <div class="text-gray-400">Alasan Retur</div>
                            <div class="text-right font-medium text-gray-900 dark:text-white">{{ $dataRetur->alasan_retur }}</div>
                        </div>
                        <div class="flex items-center mt-2 mb-4">
                            <input checked id="default-radio-1" type="radio" value="batal" name="confirm" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                            <label for="default-radio-1" class="ml-2 text-sm font-medium text-gray-900 dark:text-gray-300">Batalkan</label>
                        </div>
                        <div class="flex items-center">
                            <input id="default-radio-2" type="radio" value="sukses" name="confirm" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                            <label for="default-radio-2" class="ml-2 text-sm font-medium text-gray-900 dark:text-gray-300">Konfirmasi</label>
                        </div>
                        <button class="text-white mt-3 bg-green-700 hover:bg-green-800 focus:ring-4 focus:outline-none focus:ring-green-300 font-medium rounded-lg text-sm px-5 py-2.5 justify-center inline-flex items-center dark:bg-green-600 dark:hover:bg-green-700 dark:focus:ring-green-800 w-full">
                            Submit
                        </button>
                    </div>
                    <div>
                        <div id="text-field-container" style="display: block;" class="mt-6 mb-6">
                            <label for="alasan_batal" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white"> {{ __("Alasan Dibatalkan") }}
                            </label>
                            <input type="text" name="alasan_batal" id="alasan_batal" value="Alasan Tidak Jelas" class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500 dark:shadow-sm-light" placeholder="Alasan Dibatalkan" required>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <script>
        const radioBatalkan = document.getElementById('default-radio-1');
        const radioKonfirmasi = document.getElementById('default-radio-2');
        const textFieldContainer = document.getElementById('text-field-container');

        radioBatalkan.addEventListener('change', function() {
            if (radioBatalkan.checked) {
                textFieldContainer.style.display = 'block';
            }
        });

        radioKonfirmasi.addEventListener('change', function() {
            if (radioKonfirmasi.checked) {
                textFieldContainer.style.display = 'none';
            }
        });

    </script>
</x-app-layout>
