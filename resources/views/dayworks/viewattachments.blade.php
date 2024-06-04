@extends('layout')

@section('content')
    <div class="container mx-auto my-8 p-4">
        <div class="flex flex-wrap">
            <div class="mx-auto max-w-7xl py-6 px-4 sm:px-6  sm:p-6 md:p-8 ">

                <div class="mb-4">

                    <h1
                        class="bg-clip-text text-transparent bg-gradient-to-r from-indigo-500 to-teal-500 text-4xl font-black">
                        EDIT ATTACHMENTS FOR #{{ $dayworkOrder->id }}</h1>
                    @if ($dayworkOrder->attachments->count() > 0)
                        @foreach ($dayworkOrder->attachments as $item)
                            <div
                                class=" grid grid-cols-2 gap-2 my-2 line-item bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block  p-2.5 ">


                                <div class="flex justify-between items-center">
                                    <img class="border m-2 shadow col-span-1 rounded-lg"src="{{ Storage::url($item->file_path) }}"
                                        alt="" style="max-height: 200px;">

                                    {{-- <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded"><a
                                            href="{{ Storage::url($item->file_path) }}" target="_blank">OPEN</a></button> --}}
                                    <form action="/daywork_order/attachment/{{ $item->id }} "method="POST">
                                        @csrf
                                        <button
                                            class="bg-transparent hover:bg-red-700 text-red-700 font-semibold hover:text-white py-2 px-4 border border-red-500 hover:border-transparent rounded">DELETE</button>
                                    </form>
                                </div>
                            </div>
                        @endforeach
                    @endif

                </div>
            </div>
        </div>
    </div>
@endsection
