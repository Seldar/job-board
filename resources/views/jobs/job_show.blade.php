@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">Job Details</div>

                    <div class="panel-body">
                        <table>
                            <tr>
                                <td><strong>Title:</strong></td>
                                <td>{{$job->title}}</td>
                            </tr>
                            <tr>
                                <td><strong>Description:</strong></td>
                                <td>{{$job->description}}</td>
                            </tr>
                            <tr>
                                <td><strong>Poster:</strong></td>
                                <td>{{$job->poster->email}}</td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
