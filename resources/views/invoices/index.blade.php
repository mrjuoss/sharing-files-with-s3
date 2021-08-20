@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">{{ __('Invoices') }}</div>

                    <div class="card-body">
                        <a href="{{ route('invoices.create') }}" class="btn btn-primary float-end mb-2">Create Invoice</a>

                        <table class="table table-striped">
                            <tr>
                                <th>#</th>
                                <th>Invoice Date</th>
                                <th>Invoice Number</th>
                                <th>Customer Name</th>
                                <th>Total Amount</th>
                                <th></th>
                            </tr>
                            @forelse($invoices as $invoice)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $invoice->invoice_date }}</td>
                                    <td>{{ $invoice->invoice_number }}</td>
                                    <td>{{ $invoice->customer->name }}</td>
                                    <td>{{ number_format($invoice->total_amount, 2) }}</td>
                                    <td>
                                        <a href="{{ route('invoices.show', $invoice->id) }}" class="btn btn-info btn-sm">View Invoice</a>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="text-center">Tidak Ada Data</td>
                                </tr>
                            @endforelse

                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

