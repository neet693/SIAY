<!-- resources/views/Admin/Dashboard/payment-assign.blade.php -->

@extends('Layout.admin-template')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Assign Payment Checklist</div>
                    <div class="card-body">
                        <form action="{{ route('admin.payment.assign') }}" method="POST">
                            @csrf
                            <div class="form-group">
                                <label for="student_id">Select Student:</label>
                                <select class="form-control" id="student_id" name="student_id">
                                    <option value="">Select student</option>
                                    @foreach ($students as $student)
                                        <option value="{{ $student->id }}">{{ $student->fullname }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="transaction_type_id">Select Transaction Type:</label>
                                <select class="form-control" id="transaction_type_id" name="transaction_type_id">
                                    <option value="">Select transaction type</option>
                                    @foreach ($transactionTypes as $item)
                                        <option value="{{ $item->id }}">{{ $item->name }}
                                            ({{ $item->price }})
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <button type="submit" class="btn btn-primary">Assign</button>
                        </form>

                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>Student Name</th>
                                    <th>Transaction Type</th>
                                    <th>Total Amount</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($assignedPayments as $assignedPayment)
                                    <tr>
                                        <td>{{ $assignedPayment->student->fullname }}</td>
                                        <td>{{ $assignedPayment->transactionType->name }}</td>
                                        <td>{{ $assignedPayment->transactionType->price }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
