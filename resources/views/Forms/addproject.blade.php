@extends('layout')

@section('content')
    <div class="mx-auto max-w-7xl py-6 px-4 sm:px-6">
        <form method="POST" action="/projects/create" class="mx-auto mt-8 max-w-md">
            @csrf

            <label for="project_number" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Project
                Number:</label>
            <input type="text" id="project_number" name="project_number"
                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-80 p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">

            <label for="project_name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Project
                Name:</label>
            <input type="text" id="project_name" name="project_name"
                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-80 p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">

            <label for="address" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Address:</label>
            <input type="text" id="address" name="address"
                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-80 p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">

            <label for="primary_contact_name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Primary
                Contact Name:</label>
            <input type="text" id="primary_contact_name" name="primary_contact_name"
                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-80 p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">

            <label for="primary_contact_email" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Primary
                Contact Email:</label>
            <input type="text" id="primary_contact_email" name="primary_contact_email"
                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-80 p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">

            <label for="primary_contact_mobile" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Primary
                Contact Mobile:</label>
            <input type="text" id="primary_contact_mobile" name="primary_contact_mobile"
                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-80 p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">

            <div class="py-5 flex items-center justify-between">
                <button type="submit"
                    class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Submit</button>
            </div>
        </form>
    </div>
@endsection
