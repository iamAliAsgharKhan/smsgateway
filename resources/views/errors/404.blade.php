@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-danger">
                <div class="panel-heading">
                    {{ $exception->getStatusCode() }}
                </div>
                <div class="panel-body text-center">
                    <h2>{{ $exception->getMessage() }}</h2>
                    <a href="{{ route('app') }}" class="btn btn-default">
                        <i class="glyphicon glyphicon-home"></i>
                        Home
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
