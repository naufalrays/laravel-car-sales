<x-app-layout>
    @include('sweetalert::alert')

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Upload Bukti Pembayaran') }}
            <span class="mt-1 text-sm font-medium text-gray-900 flex dark:text-gray-300">Mandiri: 12211212 (PT Citra Asri Buana)
            </span>
            <span class="text-sm font-medium text-gray-900 dark:text-gray-300">BCA: 221312123 (PT Citra Asri Buana)
            </span>
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <form action="/pemesanan/{{ $dataPemesanan->id }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="mb-6">
                            <label for="name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white"> {{ __("Penerima") }}
                            </label>
                            <input type="text" name="name" id="name" class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500 dark:shadow-sm-light" value="{{ $dataPemesanan->nama_penerima }}" required>
                        </div>
                        <div class="mb-6">
                            <label for="number" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white"> {{ __("Nomor Penerima") }}
                            </label>
                            <input type="number" name="number" id="number" class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500 dark:shadow-sm-light" value="{{ $dataPemesanan->nomor_penerima }}" required>
                        </div>
                        <div class="mb-6">
                            <label for="address" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white"> {{ __("Alamat Penerima") }}
                            </label>
                            <input type="text" name="address" id="address" class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500 dark:shadow-sm-light" value="{{ $dataPemesanan->alamat_penerima }}" required>
                        </div>
                        <div class="mb-6">
                            <label for="image" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white"> {{ __("Upload Bukti Pembayaran") }} </label>
                            <label for="image" class="sr-only">Upload Bukti Pembayaran</label>
                            @if($dataPemesanan->gambar != null)
                            <img src="{{ url('images/buktiPembayaran/'.$dataPemesanan->gambar) }}" id="img-view" style="" class="max-h-64 w-96 mb-2 object-cover">
                            @endif
                            <input type="file" accept=".jpg, .jpeg, .png" name="image" id="image" class="block w-full border border-gray-200 shadow-sm rounded-md text-sm focus:z-10 focus:border-blue-500 focus:ring-blue-500 dark:bg-slate-900 dark:border-gray-700 dark:text-gray-400 file:bg-transparent file:border-0 file:bg-gray-100 file:mr-4 file:py-3 file:px-4 dark:file:bg-gray-700 dark:file:text-gray-400" required>
                        </div>
                        <button type="submit" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Kirim</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.6.3.min.js"></script>
    <script src="{{ url('js/img_preview.js') }}"></script>
</x-app-layout>
