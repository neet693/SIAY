@extends('Layout.admin-template')
@section('title', 'Tambah Jenis Transaksi')
@section('content')
    <div class="container">
        <h1>Edit Transaction Type</h1>

        <form method="POST" action="{{ route('transactiontype.update', $transactionType->id) }}">
            @csrf
            @method('PUT')

            <div class="form-group">
                <label for="name">Name</label>
                <input type="text" name="name" id="name" class="form-control" value="{{ $transactionType->name }}"
                    required>
            </div>

            <div class="form-group">
                <label for="price">Price</label>
                <input type="number" name="price" id="price" class="form-control"
                    value="{{ $transactionType->price }}" required>
            </div>

            <button type="submit" class="btn btn-primary">Update</button>
        </form>
    </div>
@endsection
