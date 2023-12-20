@extends('app.work.layouts.app')

@section('content')

<div class="card">
    <div class="card-header">
        <h3>Admin: Profile</h3>
    </div>
    <div class="icon-and-text-button-demo">
        <a href="{{route('work.admin.edit',['id'=>$admin->id])}}">
            <button type="button" class="btn btn-primary waves-effect">
                <i class="fa fa-edit"></i>
                <span>{{ __('Edit') }}</span>
            </button>
        </a>
        
    </div>

    <div class="card-block">
        <table class="table table-striped">
            <thead>
                <tr>
                    <th></th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>{{ __('Username') }}</td>
                    <td>
                        <h4 style="color:#00b1b1;">{!!$admin->name!!} 
                    </td>
                </tr>
                <tr>
                    <td>Display Name:</td>
                    <td>{!!$admin->display_name!!}</td>
                </tr>
                <tr>
                    <td>{{ __('Email') }}:</td>
                    <td>{!!$admin->email!!}</td>
                </tr>
                <tr>
                    <td>Created:</td>
                    <td>{!!$admin->created_at!!}</td>
                </tr>

            </tbody>
        </table>
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
<hr />

@endsection
@section('mainjs_script')
<script src="https://code.jquery.com/jquery-2.2.4.min.js"></script>
@endsection