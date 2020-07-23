@extends('layouts.app')
@section('content')
    <div class="container">

        @if(Session::has('sucess'))
            <div class="alert alert-success" role="alert">
                {{Session::get('sucess')}}
            </div>
            <br>
        @endif

        <div class="content">
            <div class="title m-b-md">
                Doctors
            </div>

            <table class="table table-striped">
                <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">name</th>
                </tr>
                </thead>
                <tbody>
                @if(isset($services)&& $services ->count()>0)

                    @foreach($services as $service)
                        <tr>
                            <th scope="row">{{$service ->id}}</th>
                            <td>{{$service ->name}}</td>

                        </tr>
                    @endforeach
                @endif
                </tbody>
            </table>
            <br> <br>
            <form method="POST" action="{{route('save.doctors.service')}}">
                @csrf
                <div class="form-group">
                    <label for="exampleInputEmail1">Choose Doctor</label>
                    <select class="form-control" name="doctor_id">
                        @if(isset($doctors)&& $doctors ->count()>0)

                            @foreach($doctors as $doctor)

                                <option value="{{$doctor->id}}">{{$doctor->name}}</option>

                            @endforeach
                        @endif
                    </select>
                </div>


                <div class="form-group">
                    <label for="exampleInputEmail1">Choose Service</label>
                    <select class="form-control" name="services_id[]" multiple>
                        @if(isset($doctors)&& $doctors ->count()>0)

                            @foreach($allservices as $allservice)

                                <option value="{{$allservice->id}}">{{$allservice->name}}</option>

                            @endforeach
                        @endif


                    </select>
                </div>
                <button type="submit" class="btn btn-primary">{{__('messages.offer store')}}</button>

            </form>


@stop

