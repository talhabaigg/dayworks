@extends('layout')

@section('content')
    <div class="w-full mx-auto max-w-7xl py-6 px-4 sm:px-6">
        <form method="POST" action="" class="mx-auto mt-8 max-w-md">
            @csrf
            <div class="my-2 w-100%">
                <img style="width: 100%; height: 200px; object-fit: cover;  border-radius: 1rem; ; box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06);"
                    src="/1.png" alt="">
            </div>
            <label for="project_number" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Project
                Number:</label>
            <input type="text" id="project_number" name="project_number"
                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                value="{{ $item->project_number }}">

            <label for="project_name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Project
                Name:</label>
            <input type="text" id="project_name" name="project_name"
                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                value="{{ $item->project_name }}">

            <label for="address" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Address:</label>
            <input type="text" id="address" name="address"
                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                value="{{ $item->address }}">

            <label for="primary_contact_name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Primary
                Contact Name:</label>
            <input type="text" id="primary_contact_name" name="primary_contact_name"
                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                value="{{ $item->primary_contact_email }}">

            <label for="primary_contact_email" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Primary
                Contact Email:</label>
            <input type="text" id="primary_contact_email" name="primary_contact_email"
                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                value="{{ $item->primary_contact_mobile }}">

            <label for="primary_contact_mobile" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Primary
                Contact Mobile:</label>
            <input type="text" id="primary_contact_mobile" name="primary_contact_mobile"
                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                value="{{ $item->project_number }}">

            <div class="my-2 ">
                <iframe
                    src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3516.9941383727546!2d153.5425787613379!3d-28.177093725816075!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x6b910027d1133959%3A0xa055e6ee1e5aba08!2sThe%20Tweed%20Hospital!5e0!3m2!1sen!2sau!4v1703045785425!5m2!1sen!2sau"
                    width="100%" height="400"
                    style="border-radius: 1rem; ; box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06);"
                    allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
            </div>

            <div class="py-5 flex
                items-center justify-between">
                <button type="submit"
                    class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Submit</button>

            </div>

        </form>
    </div>
@endsection
