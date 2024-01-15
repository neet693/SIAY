@extends('Layout.app')
@section('content')
    <!-- resources/views/registration/step2.blade.php -->

    <form action="{{ route('registration.store') }}" method="post">
        @csrf
        <input type="hidden" name="step" value="2">

        <label for="address">Alamat:</label>
        <input type="text" name="address" value="{{ $step1Data['address'] }}" required>

        <label for="phone">Nomor Telepon:</label>
        <input type="text" name="phone" value="{{ $step1Data['phone'] }}" required>

        <!-- Tambahkan input lainnya sesuai kebutuhan -->

        <button type="submit">Submit</button>
    </form>
@endsection
