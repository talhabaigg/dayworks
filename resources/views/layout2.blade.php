<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>DAYWORKS APP</title>
    <!-- Include the Tailwind CSS stylesheet -->
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link rel="icon" type="image/png" href="{{ asset('icons/logo_icon.ico') }}">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/signature_pad/1.5.3/signature_pad.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/docxtemplater/3.23.0/docxtemplater.js"></script>
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.2/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.3.4/css/buttons.dataTables.min.css">
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    @yield('scripts')
</head>

<body class="bg-white flex flex-col min-h-screen">

    <!-- Header Section -->
    <header class="bg-black py-4">
        <div class="container mx-auto flex items-center justify-between">

            <div class ="flex items-center space-x-1">
                <a href="/">
                    <img src="/logo.png" alt="Logo" class="ml-5">
                </a><!-- Logo Placeholder (Adjust the src attribute accordingly) -->
                @auth
                    <div class="text-white">
                        <a href="/admin">
                            <button class=" hover:bg-blue-700 text-white font-bold py-1 px-2 rounded">MANAGE</button>
                        </a>

                    </div>
                @else
                @endauth
            </div>

            @auth
                <form action="/logout" method="POST" class="d-inline">
                    @csrf

                    <div class="hover:bg-blue-700 text-white font-bold py-1 px-2 m-1 rounded">
                        <button class = "font-bold">LOGOUT</button>
                    </div>
                </form>
            @else
            @endauth

        </div>

    </header>


    @if (session()->has('success'))
        <div class=" text-center py-4 lg:px-4">
            <div class="p-2 bg-indigo-800 items-center text-indigo-100 leading-none lg:rounded-full flex lg:inline-flex"
                role="alert">
                <span class="flex rounded-full bg-indigo-500 uppercase px-2 py-1 text-xs font-bold mr-3">New</span>
                <span class="font-semibold mr-2 text-left flex-auto"> {{ session('success') }}</span>
                <svg class="fill-current opacity-75 h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                    <path d="M12.95 10.707l.707-.707L8 4.343 6.586 5.757 10.828 10l-4.242 4.243L8 15.657l4.95-4.95z" />
                </svg>
            </div>
        </div>
    @endif
    @if (session('errors'))
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <div class=" text-center py-4 lg:px-4">
                        <div class="p-2 bg-indigo-800 items-center text-indigo-100 leading-none lg:rounded-full flex lg:inline-flex"
                            role="alert">
                            <span
                                class="flex rounded-full bg-indigo-500 uppercase px-2 py-1 text-xs font-bold mr-3">New</span>
                            <span class="font-semibold mr-2 text-left flex-auto">{{ $error }}</span>
                            <svg class="fill-current opacity-75 h-4 w-4" xmlns="http://www.w3.org/2000/svg"
                                viewBox="0 0 20 20">
                                <path
                                    d="M12.95 10.707l.707-.707L8 4.343 6.586 5.757 10.828 10l-4.242 4.243L8 15.657l4.95-4.95z" />
                            </svg>
                        </div>
                    </div>
                @endforeach
            </ul>
        </div>
    @endif



    @yield('content')


    @yield('scripts2')



</body>



</html>
