<x-app-layout>
    @include('sweetalert::alert')

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Pembelian') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            @auth
            @role('admin')
            {{-- <button class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800" onclick="location.href='{{ route('cars.create') }}'" type="button">
            <p class="text-lg leading-none text-white">Create a new car</p>
            </button> --}}
            @endrole
            @endauth

            <div class="mt-5 overflow-auto rounded-lg shadow">

                <table class="w-full">
                    <thead class="border-b-2 border-gray-100 dark:border-gray-900">
                        <tr class="bg-gray-200 dark:bg-gray-800 dark:text-white">
                            <th class="py-3 px-6 text-left font-semibold tracking-wide text-left">Merek</th>
                            @role('admin')
                            <th class="py-3 px-6 text-left font-semibold tracking-wide text-left">User</th>
                            @endrole
                            <th class="py-3 px-6 text-left font-semibold tracking-wide text-left">Penerima</th>
                            <th class="py-3 px-6 text-left font-semibold tracking-wide text-left">Nomor Penerima</th>
                            <th class="py-3 px-6 text-left font-semibold tracking-wide text-left">Alamat Penerima</th>
                            <th class="py-3 px-6 text-left font-semibold tracking-wide text-left">Jumlah</th>
                            <th class="py-3 px-6 text-left font-semibold tracking-wide text-left">Harga Total</th>
                            <th class="py-3 px-6 text-left font-semibold tracking-wide text-left">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100 dark:divide-gray-700">
                        @foreach ($ordersData as $index => $data)
                        {{-- User hanya dapat melihat miliknya, tetapi admin dapat melihat semua datanya --}}
                        @if (Auth::user()->name === $data->user->name || Auth::user()->hasRole('admin') == 1)
                        <tr class="odd:bg-white even:bg-slate-50 dark:even:bg-gray-800 dark:odd:bg-gray-700 dark:text-white">
                            <td class="py-3 px-6 text-left whitespace-nowrap"><img src="{{ url('images/cars/'.$data->car->image) }}" class="max-h-32 w-48 mb-2 object-cover"></td>
                            {{-- Jika admin maka menampilkan akun pembeli --}}
                            @role('admin')
                            <td class="py-3 px-6 text-left whitespace-nowrap">{{ $data->user->name }}</td>
                            @endrole('admin')
                            <td class="py-3 px-6 text-left whitespace-nowrap">{{ $data->recipient_name }}</td>
                            <td class="py-3 px-6 text-left whitespace-nowrap">{{ $data->recipient_phone_number }}</td>
                            <td class="py-3 px-6 text-left whitespace-nowrap">{{ $data->recipient_address }}</td>
                            <td class="py-3 px-6 text-left whitespace-nowrap">{{ $data->quantity }}</td>
                            <td class="py-3 px-6 text-left whitespace-nowrap">{{ number_format($data->total_price, 0, ',', '.') }}</td>
                            <td class="py-3 px-6 text-left whitespace-nowrap">
                                <div class="flex item-center w-auto">
                                    @role('user')
                                    <a href="{{ route('payments.create') }}" class="hover:text-gray-100  mr-2">
                                        <div class="bg-blue-700 p-2 rounded-lg mr-2 text-white hover:text-black ">
                                            Pay now
                                        </div>
                                    </a>
                                    @endrole
                                    {{-- Button trash --}}
                                    <form action="{{ route('order.destroy', $data->id) }}" data-confirm="true" onclick="return confirm('Yakin ingin menghapus data?')" method="post">
                                        @csrf
                                        @method('delete')
                                        <button type="submit" class="btn btn-danger btn-block delete">
                                            <div class="bg-gray-200 p-2 rounded-lg mr-2 text-red-600 hover:text-black ">
                                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                                    <path stroke-linecap="round" stroke-linejoin="round" d="M14.74 9l-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 01-2.244 2.077H8.084a2.25 2.25 0 01-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 00-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 013.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 00-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 00-7.5 0" />
                                                </svg>
                                            </div>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        @endif
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
</x-app-layout>
