@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div id="real-estate-app">
            <real-estate-app></real-estate-app>
        </div>
    </div>
</div>
<script src="{{ asset('js/app.js') }}"></script>
@endsection
