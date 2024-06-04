<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        body {
            font-family: 'Arial', sans-serif;
            font-size: 10px;
            color: #333;
            /* Default text color */
        }



        table {
            width: 100%;
            border-collapse: collapse;
            margin: 20px auto;
            /* Center the table */
        }

        th {
            border: 1px solid #333;
            /* Dark border for table cells */
            padding: 2px;
            text-align: left;
        }

        .header th {
            background-color: #000;
            /* Black background for header cells */
            color: #fff;
            /* White text color for header cells */
        }

        td {
            border: 1px solid #333;
            /* Dark border for table cells */
            padding: 2px;
            text-align: left;
        }

        td.noborder {
            border: none;

            /* Add top border */
        }

        td.topborder {
            border-top: 1px solid #333;
            /* Add top border */
        }

        .signature {
            width: 200px;
            height: 75px;
        }
    </style>

    <title>New DayWorks</title>
</head>


<body>
    <img class = "signature" src="https://i.ibb.co/hRg9mPS/logo1.jpg" alt="">
    <h2>MATERIAL REQUISITION</h2>
    {{-- <h4> VARIATION NO </h4> --}}

    <div>
        <table>
            <tr>
                <th> DATE:</th>
                <td> </td>
                <th>DATE REQUIRED: </th>
                <td> {{ $date }}</td>
            </tr>
            <tr>
                <th> SUPPLIER:</th>
                <td> -</td>
                <th>JOB NO: </th>
                <td></td>
            </tr>
            <tr>
                <th> SITE REF NO:</th>
                <td></td>
                <th>JOB NAME: </th>
                <td></td>
            </tr>
        </table>
    </div>
    <br>

    <div>
        <table>
            <tr class ="header">
                <th>NOTES:</th>
            </tr>
            <tr>
                <td>{{ $notes }}</td>
            </tr>
        </table>
    </div>
    <div>
        <table>
            <thead class ="header">
                <tr>

                    <th>Item Code</th>
                    <th style="width: 280px">Description</th>
                    <th style="width: 60px">Quantity</th>
                    <th style="width: 60px;">Rate</th>
                    <th style="width: 60px;">Total</th>
                    {{-- <th>Description</th> --}}
                    <!-- Add other headers for line items as needed -->
                </tr>
            </thead>
            <tbody>
                @foreach ($lineItems as $item)
                    <tr>

                        <td>{{ $item['item_code'] }}</td>
                        <td>{{ $item['description'] }}</td>
                        <td>{{ number_format($item['qty'], 2) }}</td>
                        <td> $ {{ number_format($item['rate'], 2) }}</td>
                        <td> $ {{ number_format($item['total'], 2) }}</td>
                        {{-- <td>{{ $item['description'] }}</td> --}}
                        <!-- Display other line item fields as needed -->
                    </tr>
                @endforeach

                {{-- @if ($lineItemsitem_code->count() > 0)
                    @php
                        $totalSum = 0;
                        foreach ($dayworkOrder->Items as $item) {
                            $totalSum += $item['total'];
                        }

                        $margin = $totalSum * 0.1;
                        $Chargeable = $totalSum + $margin;
                    @endphp --}}
                {{-- <tr>
                        <td class="noborder"></td>
                        <td class="noborder"></td>
                        <td class="noborder"> </td>
                        <td class="noborder">Sub-Total:</td>
                        <td> $ {{ number_format($totalSum, 2) }}</td>

                    </tr>
                    <tr>
                        <td class="noborder"></td>
                        <td class="noborder"></td>
                        <td class="noborder"> </td>
                        <td class="noborder">Margin 10%:</td>
                        <td> $ {{ number_format($margin, 2) }}</td>

                    </tr>
                    <tr>
                        <td class="noborder"></td>
                        <td class="noborder"></td>
                        <td class="noborder"> </td>
                        <td class="noborder">Total:</td>
                        <td> $ {{ number_format($Chargeable, 2) }}</td>

                    </tr>
                @endif --}}
                <!-- Display other line item fields as needed -->

            </tbody>


        </table>

    </div>

    {{-- <div>
        <table>
            <thead class ="header">
                <tr>
                    <th>Labour</th>
                    <th style="width: 60px;">Date</th>
                    <th style="width: 60px">Hours</th>
                    <th style="width: 60px;">Rate</th>
                    <th style="width: 60px;">Total</th>


                    <!-- Add other headers for line items as needed -->
                </tr>
            </thead>
            <tbody>
                @foreach ($dayworkOrder->labourItems as $labour)
                    <tr>
                        <td>{{ $labour['labour_name'] }}</td>
                        <td>{{ $labour['date'] }}</td>
                        <td>{{ number_format($labour['qty'], 2) }}</td>
                        <td> $ {{ number_format($labour['rate'], 2) }}</td>
                        <td> $ {{ number_format($labour['total'], 2) }}</td>

                        <!-- Display other line item fields as needed -->
                    </tr>
                @endforeach

                @if ($dayworkOrder->Items->count() > 0)
                    @php
                        $totalLabour = 0;
                        foreach ($dayworkOrder->labourItems as $item) {
                            $totalLabour += $item['total'];
                        }
                        $totalVariation = $totalLabour + $Chargeable;

                    @endphp
                    <tr>
                        <td class="noborder"></td>
                        <td class="noborder"></td>
                        <td class="noborder"> </td>
                        <td class="noborder">Sub-Total:</td>
                        <td> $ {{ number_format($totalLabour, 2) }}</td>

                    </tr>

                    <tr>
                        <td class="noborder"></td>
                        <td class="noborder"></td>
                        <td class="noborder"> </td>
                        <td class="noborder">
                            <h3>TOTAL VARIATION</h3>
                        </td>
                        <td>
                            <h3> $ {{ number_format($totalVariation, 2) }}</h4>
                        </td>
                    </tr>
                @endif
            </tbody>


        </table>

    </div> --}}
    {{-- <div>
        <img class = "signature" src="{{ $signature }}" alt="">
    </div> --}}
    <div>
        {{-- <h4>
            The works described above constitute a variation to contract and authorisation is hereby given to proceed
            with the work described above. The material and hours are true and accurate for tasks nominated above.
        </h4>
        <h4>
            The works completed as noted.
            Signed:
        </h4>
        <div>
            {{-- <img class = "signature" src="{{ $signature }}" alt=""> --}}
        {{-- <h6>------------------------------------------------------------------------------------------------------
            </h6> --}}
    </div>
    </div>

</body>

</html>
