<x-app-layout>
    @include('sweetalert::alert')

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Order') }}
        </h2>
    </x-slot>
    {{-- {{ $carData }} --}}
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 grid grid-cols-2 grid-flow-col gap-6 items-center text-gray-900 dark:text-gray-100">
                    <div>
                        <h5>
                            {{ 2}}
                        </h5>
                        <h2 class="text-2xl">
                            {{2 }} 2022
                        </h2>
                        <h2 class="text-xl text-gray-400">
                            {{-- Digunakan Untuk memisahkan integer dengan titik --}}
                            Rp. 2
                        </h2>
                        <br>
                        <br>
                        <img src="{{ url('images/cars/XL7.png')  }}" class="max-h-72" alt="">
                        <br>
                        <br>
                    </div>
                    <div class="">
                        <form action="/order" method="post">
                            @csrf
                            <div class="mb-6">
                                <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white"> {{ __("Contact Information") }}
                                </label>
                                <span> {{ 2  }}</span>
                                <span>({{ 2  }})</span>
                            </div>

                            <div class="mb-6">
                                <label for="recipient_name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white"> {{ __("Recipient's Name") }}
                                </label>
                                <input type="text" name="recipient_name" id="recipient_name" class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500 dark:shadow-sm-light" placeholder="Rayhan" value="{{ 1 }}" required>
                            </div>
                            <div class="mb-6">
                                <label for="recipient_phone_number" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white"> {{ __("Phone Number") }}
                                </label>
                                <input type="number" name="recipient_phone_number" id="recipient_phone_number" class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500 dark:shadow-sm-light" placeholder="Your phone number" value="{{ 2 }}" required>
                            </div>
                            <div class="mb-6">
                                <label for="recipient_address" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white"> {{ __("Recipient's Address") }}
                                </label>
                                <input type="text" name="recipient_address" id="recipient_address" class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500 dark:shadow-sm-light" placeholder="Jl. Jalan Terus" required>
                            </div>
                            <div class="mb-6">
                                <label for="qty" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white"> {{ __("Quantity") }}
                                </label>
                                <input type="number" oninput="2" name="qty" id="qty" min="1" class=" shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500 dark:shadow-sm-light" placeholder="5" value="1" required>
                            </div>
                            <label class="font-bold" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white"> {{ __("Total") }}
                            </label>
                            <div class="flex mb-6 font-bold">
                                <h2 class="text-2xl me-1">Rp.</h2>
                                <input type="text" name="totalPrice" id="totalPrice" class="bg-transparent border-0 text-2xl p-0" name="userID" value="{{ 2 }}" readonly />
                            </div>
                            <input type="hidden" name="userID" value="{{2}}" />
                            <input type="hidden" name="carID" value="{{ 2}}" />
                            <button type="submit" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 justify-center inline-flex items-center mr-2 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800 w-full">
                                <svg aria-hidden="true" class="w-5 h-5 mr-2 -ml-1" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M3 1a1 1 0 000 2h1.22l.305 1.222a.997.997 0 00.01.042l1.358 5.43-.893.892C3.74 11.846 4.632 14 6.414 14H15a1 1 0 000-2H6.414l1-1H14a1 1 0 00.894-.553l3-6A1 1 0 0017 3H6.28l-.31-1.243A1 1 0 005 1H3zM16 16.5a1.5 1.5 0 11-3 0 1.5 1.5 0 013 0zM6.5 18a1.5 1.5 0 100-3 1.5 1.5 0 000 3z"></path>
                                </svg>
                                Order Now
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.3.min.js"></script>
    <script>
        function priceTotal(value) {
            var qty = document.querySelector("#qty");
            var totalPrice = document.querySelector("#totalPrice");
            console.log(totalPrice);
            // var totalPrice = document.getElementById("totalPrice")

            totalPrice.value = (qty.value * value).toLocaleString();
            // totalPrice.innerText = (qty.value * value).toLocaleString(); // Digunakan untuk memisahkan integer dengan titik
        }

    </script>
</x-app-layout>
