@extends('layout')
@section('content')
    <form action="/user/edit/{{ $user->id }}"class="mx-auto mt-8 max-w-md" method="POST">
        @csrf
        <h1>About</h1>

        <label for="first_name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">First Name</label>
        <input type="text" name="first_name" id="first_name"
            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
            value="{{ $user->first_name }}">

        <label for="last_name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Last Name</label>
        <input type="text" name="last_name" id="last_name"
            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
            value="{{ $user->last_name }}">

        <label for="email" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Email</label>
        <input type="text" name="email" id="email"
            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
            value="{{ $user->email }}">

        <label for="first_name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">ROLE</label>


        @if (!isset($user->user_details->role))
            <select name="role" id="role" class="w-full"
                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                <option
                    value="ca"{{ isset($user->userDetail->role) && $user->userDetail->role === 'ca' ? 'selected' : '' }}>
                    Contracts Admin</option>
                <option value="director"
                    {{ isset($user->userDetail->role) && $user->userDetail->role === 'director' ? 'selected' : '' }}>
                    Director</option>
            </select>
        @endif

        <label for="first_name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Permission</label>
        <select name="access_level" id="access_level" class="w-full"
            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
            <option value="basic"
                {{ isset($user->userDetail->access_level) && $user->userDetail->access_level === 'basic' ? 'selected' : '' }}>
                Basic</option>
            <option value="admin"
                {{ isset($user->userDetail->access_level) && $user->userDetail->access_level === 'admin' ? 'selected' : '' }}>
                Admin</option>
        </select>

        <div class="py-5 flex items-center justify-between">
            <button type="submit"
                class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">SAVE</button>

        </div>

    </form>
@endsection
