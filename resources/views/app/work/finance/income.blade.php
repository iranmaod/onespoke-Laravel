@extends('app.work.layouts.app')


@section('content')

@include('app.work.layouts.includes.datatables')

<div class="card">
  <h2 class="class-center"> <i class="fa fa-money"></i> Income Totals</h2>
  <div class="col-sm-12">
    <div class="row clearfix">
      <div class="col-md-2">
        <fieldset>
          <legend class="text-center">Supplier</legend>
          <p class="text-center"> {{number_format($amount_supplier,2)}}</p>
        </fieldset>
      </div>
      <div class="col-md-1">
        <fieldset>
          <legend class="text-center">Cart</legend>
          <p class="text-center">{{number_format($amount_initial,2)}}</p>
        </fieldset>
      </div>
      <div class="col-md-2">
        <fieldset>
          <legend class="text-center">(-)Coupons</legend>
          <p class="text-center"> {{number_format($amount_coupon,2)}}</p>
        </fieldset>
      </div>
      <div class="col-md-2">
        <fieldset>
          <legend class="text-center">BeforeTAX</legend>
          <p class="text-center"> {{number_format($amount_without_tax,2)}}</p>
        </fieldset>
      </div>
      <div class="col-md-1">
        <fieldset>
          <legend class="text-center">(+)Tax</legend>
          <p class="text-center"> {{number_format($amount_tax,2)}}</p>
        </fieldset>
      </div>
      <div class="col-md-2">
        <fieldset>
          <legend class="text-center">AfterTAX</legend>
          <p class="text-center"> {{number_format($amount_with_tax,2)}}</p>
        </fieldset>
      </div>
      <div class="col-md-2">
        <fieldset>
          <legend class="text-center">Profit(Supplier - BeforeTAX)</legend>
          <p class="text-center">{{number_format($amount_profit,2)}}</p>
        </fieldset>
      </div>

    </div>
  </div>

</div>


<div class="card"><br>
  <div class="card-header">
    <h3>Income</h3>
  </div>
  <div class="col-md-12">
    <form class="example" action="" style="margin:auto;max-width:300px">
      <input type="text" placeholder="Search Invocie Number.." name="query">
      <button type="submit"><i class="fa fa-search"></i></button>
    </form>
  </div>
  <div class="col-md-12">
    <div class="col-md-9">
      <h6 class="result"><b>Query:</b> {{$query}}</h6>
    </div>
    <div class="col-md-3">
      <h6 class="result"><b>Total</b> {{$invoices->total()}} Showing {{$invoices->count()}} results</h6>
    </div>
  </div>

  <div class="body table-responsive">
    <table class="table table-bordered table-striped table-hover js-basic-example dataTable">
      <thead>
        <tr>
          <th>Date</th>
          <th>Inv Number</th>
          <th>Customer</th>
          <th>Initial Cart</th>
          <th>Coupon</th>
          <th>Profit</th>
          <th>Amount</th>
          <th>Tax</th>
          <th>Amount +Tax</th>
          <th>Link</th>
        </tr>
      </thead>
      <tbody>
        <?php $count = 0;?>
        @foreach($invoices as $invoice)
        <?php
                                $count ++;
                                
                              ?>
        <tr>
          <td>{{$invoice->created_at->toDateString()}}</td>
          <td><b>{{$invoice->invoice_number}}</b></td>
          <td>{{$invoice->user->name}}</td>
          <td>{!!$settings->currency->symbol!!}{{number_format($invoice->initial_amount,2)}}</td>
          <td>{!!$settings->currency->symbol!!}{{number_format($invoice->coupon_amount,2)}}</td>
          <td>{!!$settings->currency->symbol!!}{{number_format($invoice->amount_gain,2)}}</td>
          <td>{!!$settings->currency->symbol!!}{{number_format($invoice->total_amount_without_tax,2)}}</td>
          <td>{!!$settings->currency->symbol!!}{{number_format($invoice->tax_amount,2)}}</td>
          <td>{!!$settings->currency->symbol!!}{{number_format($invoice->total_amount_with_tax,2)}}</td>
          <td>
            <a href="{{route('work.invoice.view',$invoice->id)}}" class="btn btn-primary btn-xs" title="View"><i
                class="fa fa-eye"></i></a>
          </td>
        </tr>
        <!-- sub panel start -->
        <?php
                              $sub_invoices = $invoice->child;
                              $confirmation          = '\'Do you want to proceed? \'';
                              ?>
        <tr>
          <td colspan="6">
            <div class="panel panel-primary">
              <div class="panel-heading" role="tab" id="headingOne_{{$count}}">
                <h4 class="panel-title">
                  <a role="button" data-toggle="collapse" data-parent="#accordion_{{$count}}"
                    href="#collapseOne_{{$count}}" aria-expanded="false" aria-controls="collapseOne_{{$count}}"
                    class="collapsed">
                    --------------------- Breakdown -----------------<i class="fa fa-angle-down"></i>
                </h4></a>
              </div>
              <div id="collapseOne_{{$count}}" class="panel-collapse collapse" role="tabpane{{$count}}"
                aria-labelledby="headingOne_{{$count}}" aria-expanded="false" style="height: 0px;">
                <div class="panel-body">
                  <!-- sub table start -->
                  <div class="body table-responsive">
                    <table class="table table-bordered table-striped table-hover js-basic-example dataTable">
                      <thead>
                        <tr>
                          <th>Supplier</th>
                          <th>Product</th>
                          <th>Initial Cart</th>
                          <th>Coupon</th>
                          <th>Profit</th>
                          <th>Amount</th>
                          <th>Tax</th>
                          <th>Amount+[Tax]</th>
                          <th>CSV</th>
                        </tr>
                      </thead>
                      <tbody>
                        <!-- start loop -->
                        @foreach($sub_invoices as $sub_invoice)
                        <tr>
                          <td>{{$sub_invoice->supplier}}</td>
                          <td>{!! strip_tags(str_limit($sub_invoice->product_name, $limit = 20, $end = '...')) !!} </td>
                          <td>{!!$sub_invoice->currency_symbol!!}{{number_format($sub_invoice->initial_amount,2)}}</td>
                          <td>{!!$sub_invoice->currency_symbol!!}{{number_format($sub_invoice->coupon_amount,2)}}</td>
                          <td>{!!$sub_invoice->currency_symbol!!}{{number_format($sub_invoice->amount_gain,2)}}</td>
                          <td>{!!$sub_invoice->currency_symbol!!}{{number_format($sub_invoice->price_without_tax,2)}}
                          </td>
                          <td>{!!$sub_invoice->currency_symbol!!}{{number_format($sub_invoice->tax_amount,2)}}</td>
                          <td>{!!$sub_invoice->currency_symbol!!}{{number_format($sub_invoice->price_with_tax,2)}}</td>
                          <td><a href="{{route('work.income.sub.csv',$sub_invoice->id)}}" class="btn btn-danger btn-xs"
                              title="Download CSV"><i class="fa fa-upload" aria-hidden="true"></i></a></td>
                        </tr>
                        @endforeach
                        <!-- End loop -->
                      </tbody>
                    </table>
                  </div>
                  <!-- sub table end -->

                </div>
              </div>
            </div>
          </td>
        </tr>
        <!-- sub panel end -->
        @endforeach
      </tbody>
    </table>
    {{$invoices->appends(request()->query())->links()}}

  </div>

</div>
<style>
  form.example input[type=text] {
    padding: 10px;
    font-size: 17px;
    border: 1px solid grey;
    float: left;
    width: 80%;
    background: #f1f1f1;
  }

  form.example button {
    float: left;
    width: 20%;
    padding: 10px;
    background: #2196F3;
    color: white;
    font-size: 17px;
    border: 1px solid grey;
    border-left: none;
    cursor: pointer;
  }

  form.example button:hover {
    background: #0b7dda;
  }

  form.example::after {
    content: "";
    clear: both;
    display: table;
  }
</style>
<hr />

@endsection