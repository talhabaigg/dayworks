@extends('layout')
@section('content')
    <div class="container">
        <h2>Create Daywork Order</h2>

        <form method="post" action="{{ route('daywork_orders.store') }}">
            @csrf

            <label for="daywork_order_date">Daywork Order Date:</label>
            <input type="date" name="daywork_order_date" required>

            <label for="issued_by">Issued By:</label>
            <select name="issued_by" required>
                <!-- Populate the dropdown with users from your database -->
                @foreach ($users as $user)
                    <option value="{{ $user->id }}">{{ $user->name }}</option>
                @endforeach
            </select>

            <label for="project_id">Project:</label>
            <select name="project_id" required>
                <!-- Populate the dropdown with projects from your database -->
                @foreach ($projects as $project)
                    <option value="{{ $project->id }}">{{ $project->name }}</option>
                @endforeach
            </select>

            <label for="daywork_ref_no">Daywork Reference Number:</label>
            <input type="text" name="daywork_ref_no" required>

            <label for="description">Description:</label>
            <textarea name="description" required></textarea>

            <h3>Daywork Order Items</h3>

            <!-- You can dynamically add more item fields using JavaScript if needed -->

            <label for="supplier_name">Supplier Name:</label>
            <input type="text" name="items[0][supplier_name]" required>

            <label for="item_code">Supplier Name:</label>
            <input type="text" name="items[0][item_code]" required>

            <label for="qty">Quantity:</label>
            <input type="number" name="items[0][qty]" required>

            <label for="rate">Rate:</label>
            <input type="number" step="0.01" name="items[0][rate]" required>

            <label for="total">Total:</label>
            <input type="number" step="0.01" name="items[0][total]" required>

            <button type="submit">Submit</button>
        </form>
    </div>
@endsection
