
@extends('layouts.app')

@section('content')
    <div id="app">
        <welcome :title="'This cool app'"></welcome>
    </div>
    <link href="{{ asset('css/frontend_css/comments.css') }}" rel="stylesheet" type="text/css">
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">Example Page {{ $pageId }}</div>

                    <div class="panel-body">
                        This is an example page

                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12" style="background:white;">
                <comment comment-url="{{ $pageId }}"></comment>
            </div>
        </div>
    </div>
    <script type="text/javascript" src="{{ asset('js/app1.js') }}"></script>
@endsection