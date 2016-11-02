@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">Post Job</div>

                    <div class="panel-body">
                        A new user posted a job. Please review and approve or mark it as a spam accordingly.
                        Title: {{$params['title']}}<br>
                        Description:{{$params['description']}}<br>
                        <a href="{{$params['approveUrl']}}">Approve</a> | <a href="{{$params['spamUrl']}}">Mark it as spam</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
