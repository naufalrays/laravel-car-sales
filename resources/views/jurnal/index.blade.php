<x-app-layout>
    @include('sweetalert::alert')

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Jurnal') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="mt-5 overflow-auto rounded-lg shadow">

                <table class="w-full">
                    <thead class="border-b-2 border-gray-100 dark:border-gray-900">
                        <tr class="bg-gray-200 dark:bg-gray-800 dark:text-white">
                            <th class="py-3 px-6 text-left font-semibold tracking-wide text-left">Tanggal</th>
                            <th class="py-3 px-6 text-left font-semibold tracking-wide text-left">Keterangan</th>
                            <th class="py-3 px-6 text-left font-semibold tracking-wide text-left">Debit</th>
                            <th class="py-3 px-6 text-left font-semibold tracking-wide text-left">Kredit</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100 dark:divide-gray-700">
                        @foreach ($jurnals as $index => $jurnal)
                        <tr class="odd:bg-white even:bg-slate-50 dark:even:bg-gray-800 dark:odd:bg-gray-700 dark:text-white">
                            <td class="py-3 px-6 text-left whitespace-nowrap"> {{ $jurnal->tanggal }} </td>
                            <td class="py-3 px-6 text-left whitespace-nowrap"> {{ $jurnal->keterangan }} </td>
                            <td class="py-3 px-6 text-left whitespace-nowrap"> {{ $jurnal->debit }} </td>
                            <td class="py-3 px-6 text-left whitespace-nowrap"> {{ $jurnal->kredit }} </td>
                        </tr>
                        @endforeach

                    </tbody>
                </table>
            </div>
        </div>

</x-app-layout>
