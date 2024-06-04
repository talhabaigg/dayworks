@extends('layout')
@section('content')
    <div class="container mx-auto my-2">
        <div class="flex flex-wrap">
            <div class="mx-auto max-w-7xl py-6 px-4 sm:px-6  sm:p-6 md:p-8 ">
                <div class="mb-4">
                    <div class="mb-2 flex justify-between">
                        <button
                            class="bg-gray-300 hover:bg-gray-400 text-gray-800 font-bold py-2 px-4 rounded inline-flex items-center">
                            <svg class="fill-current w-4 h-4 mr-2" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                <path d="M13 8V2H7v6H2l8 8 8-8h-5zM0 18h20v2H0v-2z" />
                            </svg>
                            <span><a href="/daywork/order/{{ $dayworkOrder->id }}/print">Download</a></span>
                        </button>
                        {{-- <button
                            class="bg-gray-300 hover:bg-gray-400 text-gray-800 font-bold py-2 px-4 rounded inline-flex items-center">

                            <span>Print</span>
                        </button> --}}


                    </div>

                    <h1 class="text-sm font-semibold  bg-black text-white text-center p-1">VARIATION TO CONTRACT
                        #{{ $dayworkOrder->id }}</h1>
                    <div class="grid grid-cols-4 gap-2 divide-x divide-y border">
                        {{-- <p><strong> DAYWORK ID: </strong></p>
                        <p class="text-center"> {{ $dayworkOrder->id }}</p> --}}
                        <p class="p-1 text-xs sm:text-base md:text-m "><strong> DATE: </strong></p>
                        <p class="p-1 text-center text-xs sm:text-base md:text-m"> {{ $dayworkOrder->daywork_order_date }}
                        </p>

                        <p class="p-1 text-xs sm:text-base md:text-m"><strong> PROJECT NAME: </strong></p>
                        <p class="p-1 text-center text-xs sm:text-base md:text-m"> {{ $project->project_name }}</p>


                        <p class="p-1 text-xs sm:text-base md:text-m"><strong> DAYWORK REF NO: </strong></p>
                        <p class="p-1 text-center text-xs sm:text-base md:text-m"> {{ $dayworkOrder->daywork_ref_no }}</p>
                        <p class="p-1 text-left text-xs sm:text-base md:text-m"><strong> ISSUED BY: </strong></p>
                        <p class="p-1 text-center text-xs sm:text-base md:text-m">
                            {{ $user->first_name . ' ' . $user->last_name }}</p>
                        <p class="p-1 text-left text-xs sm:text-base md:text-m"><strong> DESCRIPTION: </strong></p>
                        <p class="p-1 text-left text-xs sm:text-base md:text-m col-span-3"> {{ $dayworkOrder->description }}
                        </p>
                    </div>

                    <h1 class="text-sm font-semibold  bg-black text-white text-center p-1">ITEMS</h1>

                    <div class="grid border grid-cols-7 gap-2 divide-x divide-y border">
                        @if ($dayworkOrder->items->count() > 0)
                            <table class="col-span-7 divide-x divide-y border">
                                <thead>
                                    <tr class="divide-x divide-y border text-center text-xs sm:text-base md:text-m">
                                        <th class="w-1/4">
                                            SUPPLIER NAME</th>
                                        <th class="w-1/4">ITEM CODE</th>
                                        <th class="w-auto"> QTY</th>
                                        <th class="w-auto">RATE</th>
                                        <th class="w-auto">TOTAL</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($dayworkOrder->items as $item)
                                        <tr class="divide-x divide-y border text-center">
                                            <td class="text-xs sm:text-base md:text-mn">
                                                {{ $item->supplier_name }}</td>
                                            <td class="text-left text-xs sm:text-base md:text-m">
                                                {{ $item->item_code }}</td>
                                            <td class="text-center text-xs sm:text-base md:text-m">
                                                {{ number_format($item->qty, 2) }}</td>
                                            <td class="text-center text-xs sm:text-base md:text-m ">

                                                ${{ number_format($item->rate, 2) }}

                                            </td>
                                            <td class="text-center text-xs sm:text-base md:text-m">
                                                ${{ number_format($item->total, 2) }}
                                            </td>
                                        </tr>
                                    @endforeach

                                </tbody>
                            @else
                                <p>No items found for this daywork order.</p>
                        @endif
                        </table>
                    </div>
                    <div class="grid grid-cols-4 gap-2 text-sm">
                        @if ($dayworkOrder->items->count() > 0)
                            @php
                                $totalSum = 0;
                            @endphp



                            @foreach ($dayworkOrder->items as $item)
                                @php
                                    $totalSum += $item->total;
                                    $margin = $totalSum * 0.1;
                                    $totalCharge = $margin + $totalSum;
                                @endphp
                            @endforeach
                            <p class="col-span-3 ">Sub Total: </p>
                            <p class=" border-black col-span-1 pl-2 text-center"> <strong> $
                                    {{ number_format($totalSum, 2) }}
                                </strong>
                            </p>
                            <p class="col-span-3 ml-auto">Margin 10%: </p>
                            <p class="border-b border-black col-span-1 pl-2 text-center"> <strong> +$
                                    {{ number_format($margin, 2) }}
                                </strong>
                            </p>
                            <p class="col-span-3 ml-auto">Total: </p>
                            <p class="border-b border-black col-span-1 pl-2 text-center"> <strong>$
                                    {{ number_format($totalCharge, 2) }}
                                </strong>
                            </p>
                    </div>
                    <br>
                    <h1 class="text-sm font-semibold  bg-black text-white text-center p-1">LABOUR</h1>

                    <div class="grid border grid-cols-4 gap-2 divide-x divide-y border">
                        @if ($dayworkOrder->labourItems->count() > 0)
                            <table class="col-span-4 divide-x divide-y border">
                                <thead>
                                    <tr class="divide-x divide-y border text-center text-xs sm:text-base md:text-m">
                                        <th class="w-1/3">TYPE</th>
                                        <th class="w-1/5">DATE</th>
                                        <th class="text-center">QTY</th>
                                        <th class="text-center">RATE</th>
                                        <th class="text-center">TOTAL</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($dayworkOrder->labourItems as $item)
                                        <tr class="divide-x divide-y border text-center">
                                            <td class="text-xs sm:text-base md:text-m">{{ $item->labour_name }}
                                            </td>
                                            <td class="text-xs sm:text-base md:text-m">{{ $item->date }}</td>
                                            <td class="text-xs sm:text-base md:text-m">{{ $item->qty }}</td>
                                            <td class="text-xs sm:text-base md:text-m">$
                                                {{ number_format($item->rate, 2) }}
                                            </td>
                                            <td class=" text-xs sm:text-base md:text-m">$
                                                {{ number_format($item->total, 2) }}
                                            </td>
                                        </tr>
                                    @endforeach

                                </tbody>
                            @else
                                <p>No items found for this daywork order.</p>
                        @endif
                        @endif
                        </table>
                    </div>
                    <div class="grid grid-cols-4 gap-2 text-sm">
                        @php
                            $totalSum = 0;
                        @endphp

                        @foreach ($dayworkOrder->labourItems as $item)
                            @php
                                $totalSum += $item->total;
                            @endphp
                        @endforeach
                        <p class="col-span-3"><strong>Total: </strong></p>
                        <p class="border-b border-black col-span-1 pl-2 text-center"> <strong> $ {{ $totalSum }}
                            </strong>
                        </p>
                    </div>
                    @if ($dayworkOrder->labourItems->count() > 0)
                        <div class="grid grid-cols-4 gap-2 text-sm">
                            <p class="col-span-3 ml-auto text-bold">TOTAL VARIATION: </p>
                            @php
                                $totalVariation = $totalSum + $totalCharge;
                            @endphp
                            <div class="bg-black text-white border border-black col-span-1 pl-2 text-center">
                                <p> <strong>$
                                        {{ number_format($totalVariation, 2) }}
                                    </strong>
                                </p>
                                <p class="ml-auto col-span-4 pl-2 text-center">
                                    ex GST

                                </p>
                            </div>
                        </div>
                    @endif
                    <br>
                    {{-- <div class="grid grid-cols-1 gap-2">
                        @forelse ($dayworkOrder->signatures as $signature)
                            <img class="border-b border-black"src="{{ Storage::url($signature->file_path) }}"
                                alt="" style="width: 250px;">
                        @endforeach

                    </div> --}}
                    <br>
                    <h1 class="text-sm font-semibold  bg-black text-white text-center p-1">ATTACHMENTS</h1>

                    <div class="border-t border-b grid grid-cols-2 gap-2 items-center justify-items-center">

                        @forelse ($dayworkOrder->attachments as $item)
                            <img class="border m-2 shadow col-span-2 rounded-lg shadow  "src="{{ Storage::url($item->file_path) }}"
                                alt="" style="max-height: 100px;">
                        @empty
                            <p>No attachments found for this daywork order.</p>
                        @endforelse

                    </div>

                </div>


            </div>
        </div>
    </div>

@endsection
