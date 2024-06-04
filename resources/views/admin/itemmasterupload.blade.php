@extends('layout')

@section('content')
    <div class="flex justify-center items-center">

        <div class="bg-white p-6 rounded-lg  w-full sm:w-96">
            <form action="/uploaddb" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="flex items-center">
                    <input type="file" name="csv_file" accept=".csv">
                    <button class="bg-black hover:bg-blue-700 text-white font-bold py-1 px-2 border border-blue-700 rounded"
                        type="submit">Upload</button>
                </div>
            </form>
        </div>
    </div>
    <div class="flex justify-center items-center">
        <div class="lg:w-full px-5 py-1">

            <div class="flex justify-between py-1">
                <h1 class="text-xl  sm:text-2xl font-bold">ITEMS</h1>
                <button
                    class="px-3 py-1 text-xs font-medium text-gray-900 focus:outline-none bg-white rounded-lg border border-gray-200 hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-4 focus:ring-gray-200 dark:focus:ring-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:hover:text-white dark:hover:bg-gray-700"><a
                        href="/addproject">ADD</a></button>

            </div>

            <table id="itemTable" class="w-full min-w-full divide-y divide-gray-300 rounded-lg shadow-md ">
                <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                    <tr>
                        <th scope="col" class="px-6 py-3 rounded-s-lg">ITEM CODE</th>
                        <th scope="col" class="px-6 py-3 text-left hidden sm:table-cell">Item Description</th>
                        <th scope="col" class="px-8 py-3 text-left">Suppplier Name</th>
                        <th scope="col" class="px-8 py-3 text-left">Cost Code</th>

                    </tr>
                </thead>



                <tbody>
                    @foreach ($data as $datatables)
                        <tr
                            class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                            <td class="px-6 py-3">{{ $datatables->item_code }}</td>
                            <td class="px-6 py-3 hidden sm:table-cell">{{ $datatables->item_description }}</td>
                            <td class="px-6 py-3">{{ $datatables->supplier_name }}</td>
                            <td class="px-6 py-3">{{ $datatables->cost_code }}</td>
                    @endforeach
                </tbody>


            </table>
        </div>

    </div>
@endsection
@section('scripts2')
    <script type="text/javascript" charset="utf8" src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.13.2/js/jquery.dataTables.min.js">
    </script>
    <script type="text/javascript" charset="utf8"
        src="https://cdn.datatables.net/buttons/2.3.4/js/dataTables.buttons.min.js"></script>
    <script type="text/javascript" charset="utf8" src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js">
    </script>
    <script type="text/javascript" charset="utf8"
        src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
    <script type="text/javascript" charset="utf8" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js">
    </script>
    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/buttons/2.3.4/js/buttons.html5.min.js">
    </script>
    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/buttons/2.3.4/js/buttons.print.min.js">
    </script>


    <script>
        $(document).ready(function() {
            $('#itemTable').DataTable({
                dom: 'Bfrtip',

                buttons: [
                    'csv'
                ],
                columnDefs: [{
                        className: 'text-left',
                        targets: '_all'
                    } // Use Tailwind CSS class to center-align text
                ]

            });
        });
    </script>
@endsection
