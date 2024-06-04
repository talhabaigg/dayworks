@extends('layout2')

@section('content')
    <div class="bg-white flex flex-col items-center my-20 ">


        <div class="mx-auto max-w-7xl py-6 px-4 sm:px-6">
            <form action="/login" method="POST" class="">
                @csrf
                <div class="mb-4">
                    <div class="col-md mr-0 pr-md-0 mb-3 mb-md-0">
                        <label for="email" class="block text-gray-700 text-sm font-bold mb-2">Email</label>
                        <input name="email"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-80 p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                            type="text" placeholder="email" autocomplete="off" />
                    </div>
                    <div class="mb-4">
                        <label for="password" class="block text-gray-700 text-sm font-bold mb-2">Password</label>
                        <input name="password"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-80 p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                            type="password" placeholder="Password" />
                    </div>
                    <div class="mb-4 flex
                items-center justify-between">
                        <button
                            class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">Sign
                            In</button>
                        <p
                            class = "inline-flex items-center font-medium text-blue-600 dark:text-blue-500 hover:underline mr-2">
                            <a href="/register">Register Here</a>
                        </p>
                    </div>

                </div>
            </form>
        </div>
    </div>
@endsection
