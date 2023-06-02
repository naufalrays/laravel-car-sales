<x-app-layout>
    @include('sweetalert::alert')

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Cetak Penjualan') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            @auth
            @role('admin')
            {{-- <button class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-left text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800" onclick="location.href='{{ route('cars.create') }}'" type="button">
            <p class="text-lg leading-none text-white">Create a new car</p>
            </button> --}}
            @endrole
            @endauth

            <form action="{{ route('penjualan.store') }}" method="post">
                @csrf
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg p-6">
                    <div class="grid grid-flow-col gap-6">
                        <div class="col-span-1">
                            <div class="mb-6">
                                <h2 class="pb-2 dark:text-white font-semibold">Pilih Bulan</h2>
                                <select id="bulan" name="bulan" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" required autocomplete="roles">
                                    {{-- <option selected>Pilih Bulan</option> --}}
                                    <option value="januari">Januari</option>
                                    <option value="februari">Februari</option>
                                    <option value="maret">Maret</option>
                                    <option value="april">April</option>
                                    <option value="mei">Mei</option>
                                    <option value="juni">Juni</option>
                                    <option value="juli">Juli</option>
                                    <option value="agustus">Agustus</option>
                                    <option value="september">September</option>
                                    <option value="oktober">Oktober</option>
                                    <option value="november">November</option>
                                    <option value="desember">Desember</option>
                                </select>
                                <x-input-error :messages="$errors->get('bulan')" class="mt-2" />
                            </div>
                        </div>
                        <div class="col-span-10">
                            <h2 class="pb-2 dark:text-white font-semibold">Tahun</h2>
                            <input type="number" name="tahun" id="tahun" class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block  p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500 dark:shadow-sm-light" min="2000" max="2099" value="2023" required>
                        </div>
                    </div>
                    <button class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800" type="submit">
                        <p class="text-lg leading-none text-white">Update Laporan</p>
                    </button>
                </div>
            </form>

            <h2 class="mt-5 font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                {{ __('Tabel Laporan Penjualan') }}
            </h2>

            <div class="mt-5 rounded-lg overflow-auto w-1/2">
                <table class="table-auto w-full">
                    <thead class="border-b-2 border-gray-100 dark:border-gray-900">
                        <tr class="bg-gray-200 dark:bg-gray-800 dark:text-white">
                            <th class="p-3 w-32 text-left text-sm font-semibold tracking-wide">No.</th>
                            <th class="p-3 w-32 text-left text-sm font-semibold tracking-wide">Bulan</th>
                            <th class="p-3 w-32 text-left text-sm font-semibold tracking-wide">Tahun</th>
                            <th class="p-3 w-32 text-left text-sm font-semibold tracking-wide">Tanggal Update</th>
                            <th class="p-3 w-24 text-left text-sm font-semibold tracking-wide">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100 dark:divide-gray-700">
                        @foreach ($dataLaporan as $index => $data)
                        <tr class="odd:bg-white even:bg-slate-50 dark:even:bg-gray-800 dark:odd:bg-gray-700 dark:text-white">
                            <td class="p-3 text-left text-sm whitespace-nowrap">{{ $index+1 }}</td>
                            <td class="p-3 text-left text-sm whitespace-nowrap">{{ $data->bulan }}</td>
                            <td class="p-3 text-left text-sm whitespace-nowrap">{{ $data->tahun }}</td>
                            <td class="p-3 text-left text-sm whitespace-nowrap">{{ $data->updated_at }}</td>
                            <td class="p-3 text-left text-sm whitespace-nowrap">
                                <div class="flex item-center">
                                    <a href="{{ route('laporanPenjualan.cetak', $data->id) }}" class="hover:text-gray-100 mr-2">
                                        <div class="bg-green-700 p-2 rounded-lg mr-2 text-white hover:text-black">
                                            Lihat Laporan
                                        </div>
                                    </a>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <h2 class="mt-5 font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                {{ __('Tabel Penjualan') }}
            </h2>

            <div class="mt-5 overflow-auto rounded-lg shadow">
                <table class="w-full">
                    <thead class="border-b-2 border-gray-100 dark:border-gray-900">
                        <tr class="bg-gray-200 dark:bg-gray-800 dark:text-white">
                            <th class="p-3 w-32 text-left text-sm font-semibold tracking-wide">Nama Mobil</th>
                            @role('sales')
                            <th class="p-3 w-20 text-left text-sm font-semibold tracking-wide">User</th>
                            @endrole
                            <th class="p-3 w-20 text-left text-sm font-semibold tracking-wide">Penerima</th>
                            <th class="p-3 w-20 text-left text-sm font-semibold tracking-wide">Nomor Penerima</th>
                            <th class="p-3 w-48 text-left text-sm font-semibold tracking-wide">Alamat Penerima</th>
                            <th class="p-3 w-24 text-left text-sm font-semibold tracking-wide">Jumlah</th>
                            <th class="p-3 w-24 text-left text-sm font-semibold tracking-wide">Harga Total</th>
                            <th class="p-3 w-24 text-left text-sm font-semibold tracking-wide">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100 dark:divide-gray-700">
                        @foreach ($dataPenjualan as $index => $data)
                        {{-- User hanya dapat melihat miliknya, tetapi admin dapat melihat semua datanya --}}
                        <tr class="odd:bg-white even:bg-slate-50 dark:even:bg-gray-800 dark:odd:bg-gray-700 dark:text-white">
                            <td class="p-3 text-left text-sm whitespace-nowrap">{{ $data->pemesanan->mobil->merek }} {{ $data->pemesanan->mobil->tipe }}</td>
                            {{-- Jika admin maka menampilkan akun pembeli --}}
                            @role('sales')
                            <td class="p-3 text-left text-sm whitespace-nowrap">{{ $data->pemesanan->user->name }}</td>
                            @endrole('sales')
                            <td class="p-3 text-left text-sm whitespace-nowrap">{{ $data->pemesanan->nama_penerima }}</td>
                            <td class="p-3 text-left text-sm whitespace-nowrap">{{ $data->pemesanan->nomor_penerima }}</td>
                            <td class="p-3 text-left text-sm">{{ $data->pemesanan->alamat_penerima }}</td>
                            <td class="p-3 text-left text-sm whitespace-nowrap">{{ $data->pemesanan->jumlah }}</td>
                            <td class="p-3 text-left text-sm whitespace-nowrap">Rp. {{ number_format($data->pemesanan->harga_total, 0, ',', '.') }}</td>
                            <td class="p-3 text-left text-sm whitespace-nowrap">
                                <div class="flex item-center w-auto">
                                    <a href="{{ route('pemesanan.cetakInvoice', $data->pemesanan->id) }}" class="hover:text-gray-100  mr-2">
                                        <div class="bg-green-700 p-2 rounded-lg mr-2 text-white hover:text-black ">
                                            Invoice Pemesanan
                                        </div>
                                    </a>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

        {{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/1.6.5/datepicker.min.js"></script> --}}

</x-app-layout>
