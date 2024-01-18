@extends('Layout.app')
@section('content')
    Page Halaman Transfer
    <div class="content">
        <div class="row">
            {{-- Student Statistics --}}
            <div class="col-12 col-md-6 col-lg-4">

                <div class="statistics-card">
                    <div class="d-flex justify-content-between align-items-center">
                        <div class="d-flex flex-column justify-content-between align-items-center">
                            <h5 class="content-desc">Selamat, putra anda sudah terdaftar</h5>

                            <h3 class="statistics-value">{{ $student->fullname }}</h3>
                        </div>
                    </div>
                    {{-- <a href="{{ route('ppdb.process') }}">Proses Bayar Online</a> --}}
                    <button class="btn btn-success" id="pay-button">Bayar Sekarang</button>
                    <pre><div id="result-json">JSON result will appear here after payment:<br></div></pre>
                </div>
            </div>
        </div>
    </div>

    <script src="https://app.sandbox.midtrans.com/snap/snap.js" data-client-key="{{ env('MIDTRANS_CLIENT_KEY ') }}">
    </script>
    <script type="text/javascript">
        document.getElementById('pay-button').onclick = function() {
            // SnapToken acquired from previous step
            snap.pay('{{ $snapToken }}', {
                // Optional
                onSuccess: function(result) {
                    /* You may add your own js here, this is just example */
                    document.getElementById('result-json').innerHTML += JSON.stringify(result, null, 2);
                },
                // Optional
                onPending: function(result) {
                    /* You may add your own js here, this is just example */
                    document.getElementById('result-json').innerHTML += JSON.stringify(result, null, 2);
                },
                // Optional
                onError: function(result) {
                    /* You may add your own js here, this is just example */
                    document.getElementById('result-json').innerHTML += JSON.stringify(result, null, 2);
                }
            });
        };
    </script>
@endsection
