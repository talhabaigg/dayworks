@extends('layout')

@section('content')
    <div class="flex justify-center items-center ">
        <div class="w-full lg:w-full px-1 py-1 sm:px-2 sm:py-1">

            <div class="flex justify-between py-1">
                <h1 class="text-xl  sm:text-2xl font-bold">USERS</h1>
                <button
                    class="px-3 py-2 text-xs font-medium text-gray-900 focus:outline-none bg-white rounded-lg border border-gray-200 hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-4 focus:ring-gray-200 dark:focus:ring-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:hover:text-white dark:hover:bg-gray-700"><a
                        href="/projects/new">ADD</a></button>

            </div>

            <table id="projectsTable" class="w-full min-w-full divide-y divide-gray-300 rounded-lg shadow-md ">
                <thead class="text-xs text-gray-700 uppercase bg-gray-100 dark:bg-gray-700 dark:text-gray-400">
                    <tr>
                        <th scope="col" class="px-6 py-3 rounded-s-lg hidden sm:table-cell">Id</th>
                        <th scope="col" class="px-6 py-3 text-left ">Full Name</th>
                        <th scope="col" class="px-8 py-3 text-left hidden sm:table-cell">Email</th>
                        <th scope="col" class="px-8 py-3 text-left">Permission</th>
                    </tr>
                </thead>



                <tbody>
                    @foreach ($users as $user)
                        <tr
                            class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                            <td class="px-6 py-3 hidden sm:table-cell"><a
                                    class=
                                    "text-blue-600 hover:text-blue-900"
                                    href="/user/edit/{{ $user->id }}">{{ $user->id }}</a>
                            </td>
                            <td class="px-6 py-3">{{ $user->first_name . ' ' . $user->last_name }}
                            </td>
                            <td class="px-6 py-3">
                                <a href="mailto:{{ $user->email }}">{{ $user->email }}</a>
                            </td>
                            <td class="px-6 py-4 hidden sm:table-cell">
                                <div>
                                    {{ $user->userDetail->access_level }}
                                </div>
                            </td>
                            </button>
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
