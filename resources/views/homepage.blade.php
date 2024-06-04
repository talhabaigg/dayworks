@extends('layout')

@section('content')
    <div class="flex justify-center items-center ">
        <div class="w-full lg:w-full px-1 py-1 sm:px-2 sm:py-1">

            <div class="flex justify-between py-1">
                <h1 class="text-xl  sm:text-2xl font-bold">PROJECTS</h1>
                <button
                    class="px-3 py-2 text-xs font-medium text-gray-900 focus:outline-none bg-white rounded-lg border border-gray-200 hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-4 focus:ring-gray-200 dark:focus:ring-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:hover:text-white dark:hover:bg-gray-700"><a
                        href="/projects/new">ADD</a></button>

            </div>

            <table id="projectsTable" class="w-full min-w-full divide-y divide-gray-300 rounded-lg shadow-md ">
                <thead class="text-xs text-gray-700 uppercase bg-gray-100 dark:bg-gray-700 dark:text-gray-400">
                    <tr>
                        <th scope="col" class="px-6 py-3 rounded-s-lg hidden sm:table-cell">Project Number</th>
                        <th scope="col" class="px-6 py-3 text-left ">Project Name</th>
                        <th scope="col" class="px-8 py-3 text-left hidden sm:table-cell">Address</th>
                        <th scope="col" class="px-8 py-3 text-left">Actions</th>
                    </tr>
                </thead>



                <tbody>
                    @foreach ($data as $datatables)
                        <tr
                            class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                            <td class="px-6 py-3 hidden sm:table-cell">{{ $datatables->project_number }}</td>
                            <td class="px-6 py-3">{{ $datatables->project_name }}</td>
                            <td class="px-6 py-3 hidden sm:table-cell">{{ $datatables->address }}</td>
                            <td class="px-6 py-4">
                                <div class="flex space-x-1 items-left">
                                    <a href="/createdayworks/{{ $datatables->id }}"><button
                                            class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-2 py-2  dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">
                                            <svg class="h-4 w-4 text-white" fill="none" viewBox="0 0 24 24"
                                                stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                            </svg>

                                        </button></a>

                                    @if (Auth::check())
                                        @php
                                            $user = Auth::user();
                                            $userDetail = $user->userDetail;
                                        @endphp

                                        @if ($userDetail->access_level === 'admin')
                                            <form action="/project/edit/{{ $datatables->id }}" method="get">
                                                @csrf
                                                <button type="submit"
                                                    class = "py-2 px-2  text-sm font-medium text-gray-900 focus:outline-none bg-white rounded-lg border border-gray-200 hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-4 focus:ring-gray-200 dark:focus:ring-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:hover:text-white dark:hover:bg-gray-700"><svg
                                                        width="14" height="14" viewBox="0 0 24 24"
                                                        xmlns="http://www.w3.org/2000/svg" fill="none"
                                                        stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                                        stroke-linejoin="round">
                                                        <path d="M17 3a2.828 2.828 0 1 1 4 4L7.5 20.5 2 22l1.5-5.5L17 3z" />
                                                    </svg>

                                                </button>
                                            </form>
                                            {{-- ... other columns --}}
                                        @endif
                                    @endif

                                    <a href="/view/dayworks/{{ $datatables->id }}"><button
                                            class="text-xs px-2.5 py-1.5 bg-gray-100 text-gray-900 hover:bg-gray-200 focus:ring-gray-200 inline-flex items-center justify-center rounded-md border border-transparent font-medium shadow-sm focus:outline-none focus:ring-2 focus:ring-offset-2 sm:w-auto ml-2  xl:block">
                                            VIEW</button></a>
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
