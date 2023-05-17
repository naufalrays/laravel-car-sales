<x-app-layout>
    @include('sweetalert::alert')

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Daftar Akun') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <button class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800" onclick="location.href='{{ route('users.create') }}'" type="button">
                <p class="text-lg leading-none text-white">Buat akun baru</p>
            </button>

            <div class="mt-5 overflow-auto rounded-lg shadow">

                <table class="w-full">
                    <thead class="border-b-2 border-gray-100 dark:border-gray-900">
                        <tr class="bg-gray-200 dark:bg-gray-800 dark:text-white">
                            <th class="py-3 px-6 text-left font-semibold tracking-wide text-left">No.</th>
                            <th class="py-3 px-6 text-left font-semibold tracking-wide text-left">Nama</th>
                            <th class="py-3 px-6 text-left font-semibold tracking-wide text-left">Email</th>
                            <th class="py-3 px-6 text-left font-semibold tracking-wide text-left">Nomor Telepon</th>
                            <th class="py-3 px-6 text-left font-semibold tracking-wide text-left">Peran</th>
                            <th class="py-3 px-6 text-left font-semibold tracking-wide text-left">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100 dark:divide-gray-700">
                        @foreach ($users as $index => $usersData)
                        <tr class="odd:bg-white even:bg-slate-50 dark:even:bg-gray-800 dark:odd:bg-gray-700 dark:text-white">
                            <td class="py-3 px-6 text-left whitespace-nowrap"> {{ $index+1 }} </td>
                            <td class="py-3 px-6 text-left whitespace-nowrap"> {{ $usersData->name }} </td>
                            <td class="py-3 px-6 text-left whitespace-nowrap"> {{ $usersData->email }} </td>
                            <td class="py-3 px-6 text-left whitespace-nowrap"> {{ $usersData->phone_number ?? '-'}} </td>
                            @foreach ($usersData->roles as $r )
                            <td class="py-3 px-6 text-left whitespace-nowrap"> {{ $r->name }} </td>
                            @endforeach
                            <td class="py-3 px-6 text-left whitespace-nowrap">

                                <div class="flex item-center w-auto">
                                    <a href="{{ route('users.edit', $usersData->id) }}" class="text-gray-400 hover:text-gray-100  mr-2">
                                        <div class="bg-gray-200 p-2 rounded-lg mr-2 text-green-600 hover:text-black ">
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L6.832 19.82a4.5 4.5 0 01-1.897 1.13l-2.685.8.8-2.685a4.5 4.5 0 011.13-1.897L16.863 4.487zm0 0L19.5 7.125" />
                                            </svg>
                                        </div>
                                    </a>
                                    <form action="{{ route('users.destroy', $usersData->id) }} onclick=" return confirm('Yakin ingin menghapus data?')" method="post">
                                        @csrf
                                        @method('delete')
                                        <button type="submit" class="btn btn-danger btn-block">
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
                        @endforeach

                    </tbody>
                </table>
            </div>
        </div>

</x-app-layout>
