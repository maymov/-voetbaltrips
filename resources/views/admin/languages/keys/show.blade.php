@extends('admin/layouts/default')

{{-- Page title --}}
@section('title')l
    language-key
@parent
@stop

@section('content')
<section class="content-header">
    <h1>Language-key</h1>
    <ol class="breadcrumb">
        <li>
            <a href="{{ route('dashboard') }}"> <i class="livicon" data-name="home" data-size="16" data-color="#000"></i>
                Dashboard
            </a>
        </li>
        <li>languages-keys</li>
        <li class="active">languages-keys</li>
    </ol>
</section>

<section class="content paddingleft_right15">
    <div class="row">
        <div class="panel panel-primary ">
            <div class="panel-heading clearfix">
                <h4 class="panel-title"> <i class="livicon" data-name="list-ul" data-size="16" data-loop="true" data-c="#fff" data-hc="white"></i>
                    Language-key {{ $key->id }}'s details
                </h4>
            </div>
            <br />
            <div class="panel-body" style="align-content: center">
                <table class="table">
                    @foreach($key->getValues as $k)
                        @foreach($key->getLanguages as $l)
                            @if($l->id == $k->languages_id)
                                <tr><td>{{$l->name}}</td><td>{{ $k->value }}</td></tr>
                            @endif
                        @endforeach
                    @endforeach
                </table>
            </div>
        </div>
    </div>
</div>
@stop