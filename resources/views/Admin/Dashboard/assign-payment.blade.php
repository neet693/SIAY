@extends('Layout.app2')
@section('title', 'Daftar Transaksi Student')
@section('content')
    <h2>Daftar Transaksi</h2>

    @foreach ($unpaidTransactions as $transaction)
        <p><strong>{{ $transaction->transaction_type->name }}</strong> - {{ $transaction->total_price }}</p>

        <form method="post" action="{{ route('dashboard.assign', [$transaction->id]) }}">
            @csrf
            <select name="student_id">
                @foreach ($students as $student)
                    <option value="{{ $student->id }}">{{ $student->name }}</option>
                @endforeach
            </select>
            <button type="submit">Assign</button>
        </form>
    @endforeach
@endsection
