@extends('Layout.admin-template')
@section('content')
    <section class="dashboard my-5">
        <div class="container">
            <div class="row text-left">
                <div class=" col-lg-12 col-12 header-wrap mt-4">
                    <p class="story">
                        DASHBOARD
                    </p>
                    <h2 class="primary-header ">
                        My Bootcamps
                    </h2>
                </div>
            </div>
            <div class="row my-5">
                <table class="table">
                    <tbody>
                        {{-- @foreach ($transaction as $item) --}}
                        <tr class="align-middle">
                            <td width="18%">
                                <img src="/assets/images/item_bootcamp.png" height="120" alt="">
                            </td>
                            <td>
                                <p class="mb-2">
                                    <strong>{{ $transaction->student->fullname }}</strong>
                                </p>
                                <p>
                                    {{ $transaction->created_at->format('d M Y') }}
                                </p>
                            </td>
                            <td>
                                <strong>Rp {{ number_format($transaction->price, 2, ',', '.') }}</strong>
                            </td>
                            <td>
                                @if ($transaction->payment_status == 'success')
                                    <span class="badge bg-success rounded-pill">Success</span>
                                    {{-- <strong>Waiting for Payment</strong> --}}
                                @endif
                            </td>
                            <td>
                                <a href="{{ route('transaction.process', ['student_id' => $transaction->student->id, 'transaction_type_id' => $transaction->transactionType->id]) }}"
                                    class="btn btn-primary">
                                    Bayar {{ $transaction->transactionType->name }} Sekarang
                                </a>
                            </td>
                        </tr>
                        {{-- @endforeach --}}

                        <tr class="align-middle">
                            <td width="18%">
                                <img src="/assets/images/item_bootcamp.png" height="120" alt="">
                            </td>
                            <td>
                                <p class="mb-2">
                                    <strong>Gila Belajar</strong>
                                </p>
                                <p>
                                    September 24, 2021
                                </p>
                            </td>
                            <td>
                                <strong>$280,000</strong>
                            </td>
                            <td>
                                <strong><span class="text-green">Payment Success</span></strong>
                            </td>
                            <td>
                                <a href="#" class="btn btn-primary">
                                    Get Invoice
                                </a>
                            </td>
                        </tr>
                        <tr class="align-middle">
                            <td width="18%">
                                <img src="/assets/images/item_bootcamp.png" height="120" alt=" ">
                            </td>
                            <td>
                                <p class=" mb-2 ">
                                    <strong>Gila Belajar</strong>
                                </p>
                                <p>
                                    September 24, 2021
                                </p>
                            </td>
                            <td>
                                <strong>$280,000</strong>
                            </td>
                            <td>
                                <strong><span class="text-red ">Canceled</span></strong>
                            </td>
                            <td>
                                <a href="# " class="btn btn-primary ">
                                    Get Invoice
                                </a>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </section>
@endsection
