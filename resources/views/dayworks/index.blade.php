@extends('layout')

@section('content')
    <div class="flex justify-center items-center m-1">
        <div class="w-full lg:w-5/6 px-1 py-2 sm:px-2 sm:py-5">
            @php
                $capitalizedProjectName = strtoupper($project->project_name);
            @endphp
            <h1 class="text-xl  sm:text-2xl font-bold ">DAYWORKS FOR "{{ $capitalizedProjectName }}"</h1>
            <div class="flex justify-between py-4">
                <button
                    class="px-3 py-2 text-xs font-medium text-gray-900 focus:outline-none bg-white rounded-lg border border-gray-200 hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-4 focus:ring-gray-200 dark:focus:ring-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:hover:text-white dark:hover:bg-gray-700"><a
                        href="/projects">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" data-slot="icon"
                            class="w-4 h-4">
                            <path fill-rule="evenodd"
                                d="M9.53 2.47a.75.75 0 0 1 0 1.06L4.81 8.25H15a6.75 6.75 0 0 1 0 13.5h-3a.75.75 0 0 1 0-1.5h3a5.25 5.25 0 1 0 0-10.5H4.81l4.72 4.72a.75.75 0 1 1-1.06 1.06l-6-6a.75.75 0 0 1 0-1.06l6-6a.75.75 0 0 1 1.06 0Z"
                                clip-rule="evenodd" />
                        </svg></a>
                </button>

                <button
                    class="px-3 py-2 text-xs font-medium text-gray-900 focus:outline-none bg-white rounded-lg border border-gray-200 hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-4 focus:ring-gray-200 dark:focus:ring-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:hover:text-white dark:hover:bg-gray-700"><a
                        href="/createdayworks/{{ $project->id }}">ADD</a></button>

            </div>

            <table id="projectsTable" class="w-full min-w-full divide-y divide-gray-300 rounded-lg shadow-md ">
                <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                    <tr>
                        <th scope="col" class="px-6 py-3 rounded-s-lg">ID</th>
                        <th scope="col" class="px-6 py-3 text-left">DATE</th>
                        <th scope="col" class="px-8 py-3 text-left hidden sm:table-cell">DESCRIPTION</th>
                        <th scope="col" class="px-8 py-3 text-left"> STATUS</th>
                        <th scope="col" class="px-8 py-3 text-left">Actions</th>
                    </tr>
                </thead>



                <tbody>
                    @foreach ($daywork_orders as $datatables)
                        <tr
                            class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                            <td class="px-6 py-3"><a
                                    class=
                                    "text-blue-600 hover:text-blue-900"
                                    href="/daywork_orders/{{ $datatables->id }}">{{ $datatables->id }}</a>
                            </td>
                            <td class="px-6 py-3 text-sm text-gray-500">{{ $datatables->daywork_order_date }}</td>
                            <td class="px-6 py-3 text-sm text-gray-500 hidden sm:table-cell">{{ $datatables->description }}
                            </td>
                            <td class="px-6 py-3 ">
                                <div>
                                    <button
                                        class="{{ $datatables->daywork_order_status === 'Completed' ? 'bg-gray-100 text-gray-900 inline-flex items-center rounded-md px-1.5 py-0.5 text-xs font-medium' : 'bg-blue-500 text-white inline-flex items-center rounded-md px-1.5 py-0.5 text-xs font-medium' }} ">
                                        {{ $datatables->daywork_order_status }} @if ($datatables->daywork_order_status === 'Completed')
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                                stroke-width="1.5" stroke="currentColor" data-slot="icon" class="w-4 h-4">
                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                    d="M16.5 10.5V6.75a4.5 4.5 0 1 0-9 0v3.75m-.75 11.25h10.5a2.25 2.25 0 0 0 2.25-2.25v-6.75a2.25 2.25 0 0 0-2.25-2.25H6.75a2.25 2.25 0 0 0-2.25 2.25v6.75a2.25 2.25 0 0 0 2.25 2.25Z" />
                                            </svg>
                                        @endif
                                </div>
                            </td>
                            </button>



                            <td class="px-6 py-4">
                                <div class="flex space-x-1 items-left">
                                    <a href="/daywork_order/{{ $datatables->id }}">
                                        <button
                                            class="px-3 py-2 text-xs font-medium text-gray-900 focus:outline-none bg-white rounded-lg border border-gray-200 hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-4 focus:ring-gray-200 dark:focus:ring-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:hover:text-white dark:hover:bg-gray-700">
                                            SHOW
                                        </button>
                                    </a>

                                    @if ($datatables->daywork_order_status == 'Ongoing')
                                        <a href="/daywork_order/edit/{{ $datatables->id }}"> <button type="submit"
                                                class="px-3 py-2 text-xs font-medium text-gray-900 focus:outline-none bg-white rounded-lg border border-gray-200 hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-4 focus:ring-gray-200 dark:focus:ring-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:hover:text-white dark:hover:bg-gray-700">
                                                EDIT
                                            </button></a>
                                    @endif
                                </div>
                            </td>
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
            $('#projectsTable').DataTable({
                dom: 'Bfrtip',

                buttons: [
                    ''
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
