@extends('layouts.app')

@section('content')
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header"> {{ config('invoice.header_text') }}</div>
                        <div class="card-body">
                            <div class="container">
                                <div class="row mb-4 d-flex align-items-center">
                                    <div class="col-2">
                                            <img src="{{ asset(config('invoice.logo_invoice')) }}" alt="logo" />
                                    </div>
                                    <div class="col-10">
                                            Invoice Number : {{ $invoice->invoice_number }}
                                            <br />
                                            Invoice Date : {{ $invoice->invoice_date }}
                                    </div>
                                </div>
                                <div class="row clearfix">
                                <div class="col-md-8 mt-4">
                                    <div class="row">
                                        <div class="col-md-12">
                                         <b>To :</b>
                                            {{ $invoice->customer->name }}
                                            <br /> <br />
                                         <b>Address</b>
                                            {{ $invoice->customer->address }},
                                            @if ($invoice->customer->post_code != '') {{ $invoice->customer->post_code }},
                                            @endif
                                            {{ $invoice->customer->city }},
                                            @if($invoice->customer->state != '') {{ $invoice->customer->state }},
                                            @endif
                                            {{ $invoice->customer->country }}
                                            @if($invoice->customer->phone != '')
                                                Phone : {{ $invoice->customer->phone }},
                                            @endif
                                            @if($invoice->customer->email != '')
                                                Email : {{ $invoice->customer->email }},
                                            @endif

                                            @if($invoice->customer->customerFields)
                                                @foreach($invoice->customer->customerFields as $field)
                                                    {{ $field->field_key }} : {{ $field->field_value }},
                                                @endforeach
                                            @endif

                                        </div>

                                    </div>
                                </div>
                                <div class="col-md-4 mt-4">
                                    <b>Seller Details:</b>
                                    <br />
                                    From : {{ config('invoice.seller.name') }}
                                    <br />
                                    Address : {{ config('invoice.seller.address') }}
                                    <br />
                                    @if(config('invoice.seller.email') != '')
                                        Email : {{ config('invoice.seller.email') }}
                                        <br />
                                    @endif

                                    @if(is_array(config('invoice.seller.additional_info')))
                                        @foreach(config('invoice.seller.additional_info') as $key => $value)
                                            <br />
                                            <b> {{ $key }} </b> : {{ $value }}
                                        @endforeach
                                    @endif

                                </div>
                            </div>
                                <div class="row clearfix mt-4">
                                    <div class="col-md-12">
                                        <table class="table table-bordered table-hover" id="tab_logic">
                                            <thead>
                                            <tr>
                                                <th class="text-center"> # </th>
                                                <th class="text-center"> Product </th>
                                                <th class="text-center"> Qty </th>
                                                <th class="text-center"> Price </th>
                                                <th class="text-center"> Total </th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            @foreach($invoice->invoice_items as $item)
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>
                                                <td>{{ $item->name }}</td>
                                                <td class="text-center">{{ $item->quantity }}</td>
                                                <td class="text-end">{{ number_format($item->price, 2) }}</td>
                                                <td class="text-end">{{ number_format($item->quantity *  $item->price, 2) }}</td>
                                            </tr>
                                            @endforeach
                                        </table>
                                    </div>
                                </div>
                                <div class="row clearfix" style="margin-top:20px">
                                    <div class="d-flex justify-content-between">
                                        <div class="col-md-8"></div>
                                        <div class="col-md-4">
                                            <table class="table table-bordered table-hover" id="tab_logic_total">
                                                <tbody>
                                                <tr>
                                                    <th class="text-center">Sub Total</th>
                                                    <td class="text-end">{{ number_format($invoice->total_amount, 2) }}</td>
                                                </tr>
                                                <tr>
                                                    <th class="text-center">Tax</th>
                                                    <td class="text-end">
                                                        {{ number_format($invoice->tax_percent, 2) }} %
                                                     </td>
                                                </tr>
                                                <tr>
                                                    <th class="text-center">Tax Amount</th>
                                                    <td class="text-end">
                                                        {{ number_format( $invoice->total_amount * $invoice->tax_percent / 100, 2) }}
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <th class="text-center">Grand Total</th>
                                                    <td class="text-end">
                                                        {{ number_format($invoice->total_amount +  ($invoice->total_amount * $invoice->tax_percent / 100), 2) }}
                                                    </td>
                                                </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                        </div>
                </div>
            </div>
        </div>
    </div>
@endsection
