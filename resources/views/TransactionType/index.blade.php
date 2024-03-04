@extends('Layout.admin-template')
@section('title', 'Jenis Transaksi')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-12 col-md-6 col-lg-4">

                <div class="statistics-card">
                    <div class="d-flex justify-content-between align-items-center">
                        <div class="d-flex flex-column justify-content-between align-items-start">
                            <h5 class="content-desc">Total Interview</h5>

                            <h3 class="statistics-value">{{ $transactionType->count() }}</h3>
                        </div>

                        {{-- <a href="{{ route('admin.interviews.create') }}" class="btn-statistics"> --}}
                        <a href="{{ route('transactiontype.create') }}" class="btn-statistics">
                            <img src="{{ asset('template/assets/img/global/times.svg') }}" alt="">
                        </a>
                    </div>
                </div>

            </div>
            <div class="col-12 col-md-6 col-lg-4">

                <div class="statistics-card">
                    <div class="d-flex justify-content-between align-items-center">
                        <div class="d-flex flex-column justify-content-between align-items-start">
                            <h5 class="content-desc">Interview Selesai</h5>

                            <h3 class="statistics-value"></h3>
                        </div>
                    </div>
                </div>

            </div>
            <div class="col-12 col-md-6 col-lg-4">

                <div class="statistics-card">
                    <div class="d-flex justify-content-between align-items-center">
                        <div class="d-flex flex-column justify-content-between align-items-start">
                            <h5 class="content-desc">Interview Dibatalkan</h5>

                            <h3 class="statistics-value"></h3>
                        </div>
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
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $item->name }}</td>
                                <td>Rp {{ number_format($item->price, 2, ',', '.') }}</td>
                                <td>
                                    <div class="dropdown">
                                        <button class="btn btn-secondary dropdown-toggle" type="button"
                                            data-bs-toggle="dropdown" aria-expanded="false">
                                            Dropdown button
                                        </button>
                                        <ul class="dropdown-menu">
                                            <li><a class="dropdown-item"
                                                    href="{{ route('transactiontype.show', $item->id) }}">Detail</a></li>
                                            <li><a class="dropdown-item"
                                                    href="{{ route('transactiontype.edit', $item->id) }}">Edit</a>
                                            </li>
                                            <li>
                                                <form action="{{ route('transactiontype.destroy', $item->id) }}"
                                                    method="POST">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger">Delete
                                                    </button>
                                                </form>
                                            </li>
                                        </ul>
                                        <ul class="dropdown-menu">
                                            <li>
                                                <a href="" class=" btn btn-action">
                                                    <img src="{{ asset('template/assets/img/global/eye.svg') }}"
                                                        alt="">
                                                </a>
                                            </li>
                                            <li>
                                                <a href="" class="btn-action">
                                                    <img src="{{ asset('template/assets/img/global/edit.svg') }}"
                                                        alt="">
                                                </a>
                                            </li>
                                            <li>
                                                <form action="{{ route('transactiontype.destroy', $item->id) }}"
                                                    method="POST">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-action">
                                                        <img src="{{ asset('template/assets/img/global/trash.svg') }}"
                                                            alt="">
                                                    </button>
                                                </form>
                                            </li>
                                        </ul>
                                    </div>
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
