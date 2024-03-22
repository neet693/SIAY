@extends('Layout.admin-template')
@section('title', 'Jenis Transaksi')
@section('content')
    <div class="content">
        <div class="row">
            <div class="col-12 col-md-6 col-lg-4">

                <div class="statistics-card">
                    <div class="d-flex justify-content-between align-items-center">
                        <div class="d-flex flex-column justify-content-between align-items-start">
                            <h5 class="content-desc">Jenis Transaksi</h5>

                            <h3 class="statistics-value">{{ $transactionType->count() }}</h3>
                        </div>

                        {{-- <a href="{{ route('admin.interviews.create') }}" class="btn-statistics"> --}}
                        <a href="{{ route('transactiontype.create') }}" class="btn-statistics">
                            <img src="{{ asset('template/assets/img/global/times.svg') }}" alt="">
                        </a>
                    </div>
                </div>
            </div>
            <div class="container">
                <table id="transactiotypeTable" class="table table-striped" style="width:100%">
                    <thead>
                        <tr>
                            <th>No.</th>
                            <th>Nama</th>
                            <th>Harga</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($transactionType as $item)
                            <tr class="justify-content-center">
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $item->name }}</td>
                                <td>Rp {{ number_format($item->price, 2, ',', '.') }}</td>
                                <td>
                                    <a class="text-decoration-none link-warning" title="edit {{ $item->name }}"
                                        href="{{ route('transactiontype.edit', $item->id) }}">
                                        <i class="bi bi-pencil-square"></i>
                                    </a>
                                    <form action="{{ route('transactiontype.destroy', $item->id) }}" method="POST"
                                        class="d-inline" title="hapus {{ $item->name }}">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="link-danger text-decoration-none btn">
                                            <i class="bi bi-trash-fill"></i>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                    <tfoot>
                        <tr>
                            <th>No.</th>
                            <th>Nama</th>
                            <th>Harga</th>
                            <th>Aksi</th>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>

        <script>
            $(document).ready(function() {
                $('#transactiotypeTable').DataTable(); // #example adalah ID tabel yang ingin Anda terapkan DataTables
            });
        </script>
    </div>
@endsection
