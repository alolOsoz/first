@extends('layouts.app')
@section('content')
    <div class="container">


        <div class="content">
            <div class="title m-b-md">
                Hspitals
            </div>

            <table class="table table-striped">
                <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">name</th>
                    <th scope="col">address</th>
                    <th scope="col">{{__('messages.operation')}}</th>
                </tr>
                </thead>
                <tbody>
                @if(isset($hospitals)&& $hospitals ->count()>0)

                    @foreach($hospitals as $hospital)
                        <tr>
                            <th scope="row">{{$hospital ->id}}</th>
                            <td>{{$hospital ->name}}</td>
                            <td>{{$hospital ->address}}</td>
                            <td><a href="{{route('hospital.doctors',$hospital ->id)}}" class="btn btn-success">Show Doctors</a></td>
                            <td><a href="{{route('hospital.delete',$hospital ->id)}}" class="btn btn-danger">Delete</a></td>
                        </tr>
                    @endforeach
                @endif

                </tbody>
            </table>


        </div>
    </div>

@stop

