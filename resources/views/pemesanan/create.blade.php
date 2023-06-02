<x-app-layout>
    @include('sweetalert::alert')

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Pemesanan Mobil') }}
        </h2>
    </x-slot>
    {{-- {{ $carData }} --}}
    @if($dataMobil->stok <= 0 ) <div class="mt-10 py-8 text-center bg-white text-gray-900 dark:text-gray-100 dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
        SOLD OUT
        </div>
        @else

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 grid grid-cols-2 grid-flow-col gap-6 items-center text-gray-900 dark:text-gray-100">
                        <div>
                            <h5>
                                {{ $dataMobil->merek }}
                            </h5>
                            <h2 class="text-2xl">
                                {{ $dataMobil->tipe }} 2022
                            </h2>
                            <h2 class="text-xl text-gray-400">
                                {{-- Digunakan Untuk memisahkan integer dengan titik --}}
                                Rp. {{ number_format($dataMobil->harga, 0, ',', '.') }}
                            </h2>
                            <br>
                            <br>
                            <img src="{{ url('images/cars/'.$dataMobil->gambar)  }}" class="max-h-72" alt="">
                            <br>
                            <br>
                        </div>
                        <div class="">
                            <form onsubmit="return validateForm()" action="/pemesanan/{{ $id }}/konfirmasi" method="post">
                                @csrf
                                <div class="mb-6">
                                    <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white"> {{ __("Informasi Konsumen") }}
                                    </label>
                                    <span> {{ Auth::user()->name  }}</span>
                                    <span>({{ Auth::user()->email  }})</span>
                                </div>

                                <div class="mb-6">
                                    <label for="recipient_name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white"> {{ __("Nama Penerima") }}
                                    </label>
                                    <input type="text" name="recipient_name" id="recipient_name" class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500 dark:shadow-sm-light" placeholder="Nama Penerima" value="{{ Auth::user()->name  }}" required>
                                </div>
                                <div class="mb-6">
                                    <label for="recipient_phone_number" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white"> {{ __("Nomor Penerima") }}
                                    </label>
                                    <input type="number" name="recipient_phone_number" id="recipient_phone_number" class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500 dark:shadow-sm-light" placeholder="Nomor Telepon" value="{{ Auth::user()->phone_number  }}" required>
                                </div>
                                <div class="mb-6">
                                    <label for="recipient_address" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white"> {{ __("Alamat Penerima") }}
                                    </label>
                                    <input type="text" name="recipient_address" id="recipient_address" class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500 dark:shadow-sm-light" placeholder="Alamat Penerima" required>
                                </div>
                                <div class="mb-6">
                                    <label for="qty" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white"> {{ __("Jumlah beli") }}
                                    </label>
                                    <input type="number" oninput="priceTotal({{ $dataMobil->harga }});" name="qty" id="qty" min="1" max="{{ $dataMobil->stok }}" class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500 dark:shadow-sm-light" placeholder="5" value="0" required>
                                </div>
                                <label class="font-bold" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white"> {{ __("Harga Total") }}
                                </label>
                                <div class="flex mb-6 font-bold">
                                    <h2 class="text-2xl me-1">Rp.</h2>
                                    <input type="text" name="totalPrice" id="totalPrice" class="bg-transparent border-0 text-2xl p-0" name="userId" value="0" readonly />
                                </div>
                                <input type="hidden" name="userId" value="{{ Auth::user()->id }}" />
                                <input type="hidden" name="carID" value="{{ $dataMobil->id }}" />
                                <button type="submit" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 justify-center inline-flex items-center mr-2 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800 w-full">
                                    Selanjutnya
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @endif

        <script src="https://code.jquery.com/jquery-3.6.3.min.js"></script>
        <script>
            function priceTotal(value) {
                var qty = document.querySelector("#qty");
                var totalPrice = document.querySelector("#totalPrice");
                console.log(totalPrice);
                // var totalPrice = document.getElementById("totalPrice")

                totalPrice.value = (qty.value * value).toLocaleString().replace(/,/g, '.');;
                // totalPrice.innerText = (qty.value * value).toLocaleString(); // Digunakan untuk memisahkan integer dengan titik
            }

            function validateForm() {
                var totalPriceInput = document.getElementById('totalPrice');

                if (totalPriceInput.value == 0) {
                    alert('Nilai tidak boleh sama dengan 0');
                    return false; // Menghentikan pengiriman formulir jika validasi gagal
                }

                return true; // Melanjutkan pengiriman formulir jika validasi berhasil
            }

        </script>

</x-app-layout>
