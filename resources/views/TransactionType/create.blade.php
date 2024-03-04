@extends('Layout.admin-template')
@section('title', 'Tambah Jenis Transaksi')
@section('content')
    <div class="container">
        <h1>Create Transaction Type</h1>

        <form method="POST" action="{{ route('transactiontype.store') }}">
            @csrf

            <div class="form-group">
                <label for="name">Name</label>
                <input type="text" name="name" id="name" class="form-control" required>
            </div>

            <div class="form-group">
                <label for="price">Price</label>
                <input type="number" name="price" id="price" class="form-control" required>
            </div>

            <button type="submit" class="btn btn-primary">Create</button>
        </form>
    </div>
@endsection
