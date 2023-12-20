@extends('work.layouts.app')
@section('content')

@include('work.layouts.includes.datatables')

<div class="card">
    <div class="card-header">
        <h3>Coupons</h3>
    </div>
    <div class="icon-and-text-button-demo">
        <a href="{{ route('work.coupon.create') }}">
            <button type="button" class="btn btn-primary waves-effect">
                <i class="fa fa-plus-circle"></i>
                <span>{{ __('messages.Add') }}</span>
            </button>
        </a>
        <a href="">
            <button type="button" class="btn btn-warning waves-effect">
                <i class="fa fa-refresh"></i><span>{{ __('messages.Refresh') }}</span>
            </button>
        </a>

    </div>
    <div class="card-block">
        <div class="dt-responsive table-responsive">
            <div id="simpletable_wrapper" class="dataTables_wrapper dt-bootstrap4">

                <div class="row">
                    <div class="col-xs-12 col-sm-12">
                        <table id="data_table" class="table table-striped table-bordered nowrap dataTable" role="grid"
                            aria-describedby="simpletable_info">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Code</th>
                                    <th>% Off</th>
                                    <th>Applicable for New to Old Customers based on Signup(Days)</th>
                                    <th>Usage Remaining</th>
                                    <th>Usage Per Customer</th>
                                    <th>Min Cart Products</th>
                                    <th>Min Cart Items</th>
                                    <th>Min Amount</th>
                                    <th>Start Date</th>
                                    <th>End Date</th>
                                    <th>Status</th>
                                    <th>Created</th>
                                    <th>{{ __('messages.More') }}</th>
                                </tr>
                            </thead>

                        </table>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>

<style>
    div.container {
        width: 100%;
    }

    .btn i {
        margin-right: 0%;
    }
</style>

<script type="text/javascript">
    //           
// $.fn.dataTable.Responsive.breakpoints.push({
//    name: 'mobilep', width: 320
// })
            //get
            $(document).ready(function() {
                             $('#data_table').DataTable({
                                "processing": true,
                                "serverSide": true,
                                "responsive": true,
                                "language": 
                                        {          
                                "processing": "<i class='fa fa-spinner fa-pulse fa-3x fa-fw'></i>",
                                        },
                                "ajax": "{{ route('work.get_coupons_data') }}",
                                "columns":[
                                    { "data": "id" },
                                    { "data": "code" },
                                    { "data": "percentage_off" },
                                    { "data": "customer_age" },
                                    { "data": "usage_total" },
                                    { "data": "usage_per_customer" },
                                    { "data": "min_product" },
                                    { "data": "min_item" },
                                    { "data": "min_amount" },
                                    { "data": "start_date" },
                                    { "data": "end_date" },
                                    { "data": "status" },
                                    { "data": "created_at" },
                                    { "data": "action","searchable":false,"orderable":false}
                                ],
                                order:[ [0, 'desc'] ],
                                "dom": 'lBfrtip',
                                "buttons": ['copy', 'csv', 'excel', 'pdf', 'print']

                             });
                        });
</script>



<hr />

@endsection