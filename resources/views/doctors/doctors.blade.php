@extends('layouts.app')
@section('content')
    <div class="container">


            <div class="content">
                <div class="title m-b-md">
                    Doctors
                </div>

                <table class="table table-striped">
                    <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">name</th>
                        <th scope="col">title</th>
                        <th scope="col">gender</th>
                        <th scope="col">{{__('messages.operation')}}</th>
                    </tr>
                    </thead>
                    <tbody>
                    @if(isset($doctors)&& $doctors ->count()>0)

                        @foreach($doctors as $doctor)
                            <tr>
                                <th scope="row">{{$doctor ->id}}</th>
                                <td>{{$doctor ->name}}</td>
                                <td>{{$doctor ->title}}</td>
                                <td>{{$doctor ->gender}}</td>
                                <td><a href="{{route('doctors.service',$doctor ->id)}}" class="btn btn-success">Show Services</a></td>
                            </tr>
                        @endforeach
                    @endif
                    </tbody>
                </table>


            </div>
        </div>
@stop

