@extends('app.work.layouts.app')


@section('content')


@include('app.work.layouts.includes.datatables')

<div class="card">
        <div class="card-header">
            <h5>&nbsp; Blog Posts</h5>
         </div> 
         <div class="icon-and-text-button-demo">
                <a href="{{ route('work.post.create') }}">
                    <button type="button" class="btn btn-primary waves-effect">
                            <i class="fa fa-plus-circle"></i>
                        <span>&nbsp; Add Post</span>
                    </button>
                </a>
                <a href="">
                <button type="button" class="btn btn-warning waves-effect">
                        <i class="fa fa-refresh"></i><span>Refresh</span>
                </button>
                </a>
    
            </div>
        <div class="card-block">
            <div class="dt-responsive table-responsive">
                <div id="simpletable_wrapper" class="dataTables_wrapper dt-bootstrap4">
                    
                    <div class="row">
                        <div class="col-xs-12 col-sm-12">
                            <table id="data_table" class="table table-striped table-bordered nowrap dataTable" role="grid" aria-describedby="simpletable_info">
                                <thead>
                                    <tr>
                                        <th>Id</th>
                                        <th>Title</th>
                                        <th>Image</th>
                                        <th>Author</th>
                                        <th>Date</th>
                                        <th>More</th>
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
        "ajax": "{{ route('work.get_posts_data') }}",
        "columns":[
            { "data": "id" },
            { "data": "title" },
            { "data": "image" },
            { "data": "author" },
            { "data": "created_at" },
            { "data": "action","searchable":false,"orderable":false}
        ],
        order:[ [0, 'desc'] ],
        "dom": 'Bfrtip',
        "buttons": ['pageLength','copy', 'csv', 'excel', 'pdf', 'print']

        });
});
</script>



<hr/>

@endsection
