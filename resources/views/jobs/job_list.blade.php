@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">Job List</div>

                    <div class="panel-body">
                        <table>
                            <th width="150px">Title</th>
                            <th width="350px">Description</th>
                            <th>Poster</th>
                        @foreach ($data as $job)
                            <tr>
                                <td><a href="{{ url("jobs/" . $job->id) }}">{{$job->title}}</a></td>
                                <td>{{$job->description}}</td>
                                <td>{{$job->poster->email}}</td>
                            </tr>
                        @endforeach
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
