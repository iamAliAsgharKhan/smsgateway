@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <vue-progress-bar></vue-progress-bar>
            <router-view></router-view>
        </div>
    </div>
</div>
@endsection
