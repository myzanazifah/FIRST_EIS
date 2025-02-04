@extends('layouts.app', [
    'class' => '',
    'elementActive' => 'purchaserequest'
])



@section('content')

<style>

span.select2-selection.select2-selection--single {
        border-radius: 0;
        padding: 0.25rem 0.5rem;
        padding-top: 0.25rem;
        padding-right: 0.5rem;
        padding-bottom: 0.25rem;
        padding-left: 0.5rem;
        height: auto;
    }
	/* Chrome, Safari, Edge, Opera */
		input::-webkit-outer-spin-button,
		input::-webkit-inner-spin-button {
		-webkit-appearance: none;
		margin: 0;
		}

		/* Firefox */
		input[type=number] {
		-moz-appearance: textfield;
		}
		[name="tax_percentage"],[name="discount_percentage"]{
			width:10vw;
		}


    
</style>
<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card card-info">
                    <div class="card-header">
                        <h3 class="card-title">Purchase Request</h3>
                        <div class="card-tools">
                            <button class="btn btn-sm btn-flat btn-success"  id="print" type="button">
                                <i class="fa fa-print"></i> Print
                            </button>
                        </div>
                    </div>
                    <div class="card-body" id="out_print">
                        <div class="row">
                            <div class="col-6 d-flex align-items-center">
                                <div>
                                    <p class="m-0">DELIVERY TO:</p>
                                    <p class="m-0"><b>TSK SYNERGY SDN BHD</b></p>
                                    <p class="m-0">NO. 19, JALAN MEGA 1/8, TAMAN PERINDUSTRIAN NUSA CEMERLANG</p>
                                    <p class="m-0">79200 ISKANDAR PUTERI, JOHOR</p>
                                </div>
                            </div>
                            <div class="col-6">
                                <center><img src="{{ url('storage/images/logo.png') }}" alt="" width="500px" height="200px"></center>
                                <h2 class="text-center"><b>PURCHASE REQUEST</b></h2>
                            </div>
                        </div>
                        <div class="row mb-2">
                            <div class="col-6">
                                <p class="m-0">TO:</p>
                                <div>
                                    <p class="m-0"><b>{{strtoupper($supplier->supplier_name)}}</b></p>
                                    <p class="m-0">{{$supplier->supplier_phone}}</p>
                                    <p class="m-0">{{strtoupper($supplier->supplier_address)}}</p>
                                </div>
                            </div>
                            <div class="col-6 row">
                                <div class="col-6">
                                    <p class="m-0"><b>P.R. #:</b></p>
                                    <p><b>{{$purchaserequest->id}}</b></p>
                                </div>
                                <div class="col-6">
                                    <p class="m-0"><b>Requested By: </b></p>
                                    <p><b>{{$purchaserequest->requestor}}</b></p>
                                </div>
                                <div class="col-6">
                                    <p class="m-0"><b>Date Created: </b></p>
                                    <p><b>{{$purchaserequest->created_at}}</b></p>
                                </div>
                                
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <table class="table table-striped table-bordered" id="item-list">
                                    <colgroup>
                                        <col width="10%">
                                        <col width="10%">
                                        <col width="20%">
                                        <col width="30%">
                                        <col width="15%">
                                        <col width="15%">
                                    </colgroup>
                                    <thead>
                                        <tr class="bg-navy disabled" style="">
                                            <th class="bg-navy px-1 py-1 text-center">Qty</th>
                                            <th class="bg-navy px-1 py-1 text-center">Unit</th>
                                            <th class="bg-navy px-1 py-1 text-center">Item</th>
                                            <th class="bg-navy px-1 py-1 text-center">Category</th>
                                            <th class="bg-navy px-1 py-1 text-center">Price</th>
                                            <th class="bg-navy px-1 py-1 text-center">Total</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @php
                                        $subtotal = 0;
                                        @endphp
                                        @foreach($request_items as $pr_items)
                                        <tr class="pr-items" data-id="">
                                            @php
                                            $subtotal += ($pr_items->product_quantity) * ($pr_items->product_unitprice)
                                            @endphp
                                            <td class="align-middle p-0 text-center">{{$pr_items->product_quantity}}</td>
                                            <td class="align-middle p-1 text-center">{{$pr_items->uom}}</td>
                                            <td class="align-middle p-1">{{$pr_items->product->product_name}}</td>
                                            <td class="align-middle p-1 item-description">{{$pr_items->product->productCategory->category_name}}</td>
                                            <td class="align-middle p-1 text-right">{{number_format($pr_items->product_unitprice, 2)}}</td>
                                            <td class="align-middle p-1 text-right total-price">{{number_format(($pr_items->product_quantity) * ($pr_items->product_unitprice), 2)}}</td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                    <tfoot>
                                        <tr class="bg-lightblue">
                                            <th class="p-1 text-right" colspan="5">Sub Total</th>
                                            <th class="p-1 text-right" id="sub_total">{{number_format($subtotal, 2)}}</th>
                                        </tr>
                                        <tr>
                                            <th class="p-1 text-right" colspan="5">Discount ({{$purchaserequest->discount_percentage ?? 0}}%)</th>
                                            <th class="p-1 text-right">{{number_format($purchaserequest->discount_amount ?? 0, 2)}}</th>
                                        </tr>
                                        <tr>
                                            <th class="p-1 text-right" colspan="5">Tax Inclusive ({{$purchaserequest->tax_percentage ?? 0}}%)</th>
                                            <th class="p-1 text-right">{{number_format($purchaserequest->tax_amount ?? 0, 2)}}</th>
                                        </tr>
                                        <tr>
                                            <th class="p-1 text-right" colspan="5">Total</th>
                                            <th class="p-1 text-right" id="total">RM {{number_format(($subtotal - $purchaserequest->discount_amount) + ($purchaserequest->tax_amount), 2)}}</th>
                                        </tr>
                                    </tfoot>
                                </table>
                                
                            </div>
                        </div>
                    </div>
                                    <div class="col-6">
                                        <p class="m-0" for="notes" class="control-label"><b>Notes: </b></p>
                                        
                                        <p class="m-0" for="notes" class="control-label"><b>{{$purchaserequest->notes}}</b></p>
                                        <br>
                                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

                    

<table class="d-none" id="item-clone">
	<tr class="pr-item" data-id="">
		<td class="align-middle p-1 text-center">
			<button class="btn btn-sm btn-danger py-0" type="button" onclick="rem_item($(this))"><i class="fa fa-times"></i></button>
		</td>
		<td class="align-middle p-0 text-center">
			<input type="number" class="text-center w-100 border-0" step="any" name="product_quantity[]"/>
		</td>
		<td class="align-middle p-1">
			<input type="text" class="text-center w-100 border-0" name="uom"/>
		</td>
		<td class="align-middle p-1">
        <input type="hidden" name="id[]">
			<input type="text" class="text-center w-100 border-0 id" required/>
		</td>
		<td class="align-middle p-1 item-description"></td>
		<td class="align-middle p-1">
			<input type="number" step="any" class="text-right w-100 border-0" name="product_unitprice[]" value="0"/>
		</td>
		<td class="align-middle p-1 text-right total-price">0</td>
	</tr>
</table>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
<script src="http://code.jquery.com/ui/1.10.3/jquery-ui.js"></script>


<script>
	
    
    function start_loader(){
	$('body').prepend('<div id="preloader"></div>')
}
function end_loader(){
	 $('#preloader').fadeOut('fast', function() {
        $(this).remove();
      })
}
    
    $(function(){
        $('#print').click(function(e){
            e.preventDefault();
            start_loader();
            var _h = $('head').clone();
            var _p = $('#out_print').clone();
            var _el = $('<div>');
            _p.find('tbody td').attr('style','border: 2px solid #000 !important');
            _p.find('thead th, tfoot th, tfoot td').attr('style','border: 1px solid #000 !important');

            _el.append(_h);
            _el.append(_p);

           var nw = window.open("", "purchaserequest.pdf","width=1200,height=950");
            nw.document.write(_el.html());
            nw.document.close();
            setTimeout(() => {
                nw.print();
                setTimeout(() => {
                    end_loader();
                    nw.close();
                }, 300);
            }, 200);
        });
    });

    
</script>

@endsection