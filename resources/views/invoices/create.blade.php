@extends('layouts.app')

@section('content')
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Create Invoices') }}</div>
                    <form action="{{ route('invoices.store') }}" method="post">
                        @csrf
                        <div class="card-body">
                            <div class="container">
                            <div class="row clearfix">
                                <div class="col-md-4">
                                    Invoice Number
                                    <br />
                                    <input type="text" name="invoice[invoice_number]" class="form-control mb-2" placeholder="AA001" required />
                                    Invoice Date
                                    <br />
                                    <input type="date" name="invoice[invoice_date]" class="form-control" value="{{ date('Y-m-d') }}" required />
                                </div>
                                <div class="col-md-8">
                                    <div class="row">
                                        <div class="col-md-6">
                                            Name*: <input type="text" name="customer[name]" class="form-control" required />
                                            Address*: <input type="text" name="customer[address]" class="form-control" required />
                                            Postcode/ZIP: <input type="text" name="customer[post_code]" class="form-control" />
                                            City*: <input type="text" name="customer[city]" class="form-control" required />

                                        </div>
                                        <div class="col-md-6">
                                            State: <input type="text" name="customer[state]" class="form-control" />
                                            Country*: <input type="text" name="customer[country]" class="form-control" required />
                                            Phone: <input type="text" name="customer[phone]" class="form-control" />
                                            Email: <input type="email" name="customer[email]" class="form-control" />

                                            <br />
                                            <b>Additional fields</b> (optional):
                                            <br />
                                            <table class="table table-bordered table-hover">
                                                <tbody>
                                                <tr>
                                                    <th class="text-center">Field</th>
                                                    <th class="text-center">Value</th>
                                                </tr>
                                                @for ($i = 0; $i <= 1; $i++)
                                                    <tr>
                                                        <td class="text-center">
                                                            <input type="text" name="customer_fields[{{ $i }}][field_key]" class="form-control" />
                                                        </td>
                                                        <td class="text-center">
                                                            <input type="text" name="customer_fields[{{ $i }}][field_value]" class="form-control" />
                                                        </td>
                                                    </tr>
                                                @endfor
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
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
                                        <tr id='addr0'>
                                            <td>1</td>
                                            <td><input type="text" name="product[]"  placeholder='Enter Product Name' class="form-control"/></td>
                                            <td><input type="number" name="qty[]" placeholder='Enter Qty' class="form-control qty" step="0" min="0"/></td>
                                            <td><input type="number" name="price[]" placeholder='Enter Unit Price' class="form-control price" step="0.00" min="0"/></td>
                                            <td><input type="number" name="total[]" placeholder='0.00' class="form-control total" readonly/></td>
                                        </tr>
                                        <tr id='addr1'></tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <div class="row clearfix">
                                <div class="col-md-12 mt-2">
                                    <button id="add_row" class="btn btn-primary text-white float-start">Add Row</button>
                                    <button id='delete_row' class="float-end text-white btn btn-info">Delete Row</button>
                                </div>
                            </div>
                            <div class="row clearfix" style="margin-top:20px">
                                <div class="d-flex justify-content-between">
                                    <div></div>
                                    <div class="col-md-4">
                                    <table class="table table-bordered table-hover" id="tab_logic_total">
                                        <tbody>
                                        <tr>
                                            <th class="text-center">Sub Total</th>
                                            <td class="text-center"><input type="number" name='sub_total' placeholder='0.00' class="form-control" id="sub_total" readonly/></td>
                                        </tr>
                                        <tr>
                                            <th class="text-center">Tax</th>
                                            <td class="text-center"><div class="input-group mb-2 mb-sm-0">
                                                    <input type="number" class="form-control" id="tax" placeholder="0" name="invoice[tax_percent]">
                                                    <div class="input-group-addon">
                                                        <span class="m-1"> % </span></div>
                                                </div></td>
                                        </tr>
                                        <tr>
                                            <th class="text-center">Tax Amount</th>
                                            <td class="text-center"><input type="number" name='tax_amount' id="tax_amount" placeholder='0.00' class="form-control" readonly/></td>
                                        </tr>
                                        <tr>
                                            <th class="text-center">Grand Total</th>
                                            <td class="text-center"><input type="number" name='total_amount' id="total_amount" placeholder='0.00' class="form-control" readonly/></td>
                                        </tr>
                                        </tbody>
                                    </table>
                                </div>
                                </div>
                            </div>
                                <input type="submit" class="btn btn-primary text-white" value="Save Data" />
                        </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('after-script')
   <script>
       document.addEventListener("DOMContentLoaded", function(){
           var i=1;

           $("#add_row").click(function(e){
               e.preventDefault();
               b=i-1;
               $('#addr'+i).html($('#addr'+b).html()).find('td:first-child').html(i+1);
               $('#tab_logic').append('<tr id="addr'+(i+1)+'"></tr>');
               i++;

               isDisabled(false);
           });
           $("#delete_row").click(function(){
               if(i>1){
                   $("#addr"+(i-1)).html('');
                   i--;
               }
               calc();
           });

           $('#tab_logic tbody').on('keyup change',function(){
               calc();
           });
           $('#tax').on('keyup change',function(){
               calc_total();
           });

           return true;
       });

       function calc()
       {
           $('#tab_logic tbody tr').each(function(i, element) {
               var html = $(this).html();
               if(html!='')
               {
                   var qty = $(this).find('.qty').val();
                   var price = $(this).find('.price').val();
                   $(this).find('.total').val(qty*price);

                   calc_total();
               }
           });
       }

       function calc_total()
       {
           total=0;
           $('.total').each(function() {
               total += parseInt($(this).val());
           });
           $('#sub_total').val(total.toFixed(2));
           tax_sum=total/100*$('#tax').val();
           $('#tax_amount').val(tax_sum.toFixed(2));
           $('#total_amount').val((tax_sum+total).toFixed(2));
       }
   </script>
@endpush
