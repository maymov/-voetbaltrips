@extends('admin/layouts/default')

{{-- Page title --}}
@section('title')
Language-keys List
@parent
@stop

{{-- Page content --}}
@section('content')
<section class="content-header">
    <h1>Language-keys</h1>
    <ol class="breadcrumb">
        <li>
            <a href="{{ route('dashboard') }}"> <i class="livicon" data-name="home" data-size="16" data-color="#000"></i>
                Dashboard
            </a>
        </li>
        <li>language-keys</li>
        <li class="active">language-keys</li>
    </ol>
</section>

<section class="content paddingleft_right15">
    <div class="row">
        <div class="panel panel-primary ">
            <div class="panel-heading clearfix">
                <h4 class="panel-title pull-left"> <i class="livicon" data-name="list-ul" data-size="16" data-loop="true" data-c="#fff" data-hc="white"></i>
                    Language-keys List
                </h4>
                <div class="pull-right">
                    <a href="{{ route('admin.language-keys.create') }}" class="btn btn-sm btn-default"><span class="glyphicon glyphicon-plus"></span> @lang('button.create')</a>
                </div>
            </div>
            <br />
            <div class="panel-body">
                <table class="table table-bordered " id="table">
                    <thead>
                        <tr class="filters">
                            <th>ID</th>
                            <th>Name</th>
                            @foreach($languages as $l)
                            <th>{{$l->code}}</th>
                            @endforeach
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($keys as $key)
                        <tr>
                            <td>{{$key->id}}</td>
                            <td>{{$key->name}}</td>
                            @foreach($key->getValues as $lan)
                                <td>{{$lan->value}}</td>
                            @endforeach
                            <td>
                                <a href="{{ route('admin.language-keys.show', $key->id) }}">
                                    <i class="livicon" data-name="info" data-size="18" data-loop="true" data-c="#428BCA" data-hc="#428BCA" title="view club"></i>
                                </a>
                                <a href="{{ route('admin.language-keys.edit', $key->id) }}">
                                    <i class="livicon" data-name="edit" data-size="18" data-loop="true" data-c="#428BCA" data-hc="#428BCA" title="edit club"></i>
                                </a>
                            </td>
                        </tr>
                        @endforeach

                    </tbody>
                </table>
            </div>
        </div>
    </div>    <!-- row-->
</section>
@stop

{{-- Body Bottom confirm modal --}}
@section('footer_scripts')
<div class="modal fade" id="delete_confirm" tabindex="-1" role="dialog" aria-labelledby="user_delete_confirm_title" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
    </div>
  </div>
</div>
<script>$(function () {$('body').on('hidden.bs.modal', '.modal', function () {$(this).removeData('bs.modal');});});</script>
@stop
