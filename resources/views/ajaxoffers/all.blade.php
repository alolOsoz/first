@extends('layouts.app')
@section('content')

    <div class="alert alert-success" id="success_msg"  style="display: none" role="alert">
        {{__('messages.sucess')}}
    </div>
    <br>

    <table id="" class="table table-striped">
        <thead>
        <tr >
            <th scope="col">#</th>
            <th scope="col">{{__('messages.offer name')}}</th>
            <th scope="col">{{__('messages.offer price')}}</th>
            <th scope="col">{{__('messages.offer details')}}</th>
            <th scope="col">{{__('messages.offer photos')}}</th>
            <th scope="col">{{__('messages.operation')}}</th>
        </tr>
        </thead>
        <tbody>
        @foreach($offers as $offer)
            <tr class="offerrow{{$offer ->id}}">
                <th scope="row">{{$offer ->id}} </th>
                <td>{{$offer ->name}}</td>
                <td>{{$offer ->price}}</td>
                <td>{{$offer ->details}}</td>
                <td><img style="width: 90px; height: 90px;" src="{{asset('images/offers/'.$offer->photo)}}"></td>
                <td><a href="{{url('offers/edit/'.$offer ->id)}}" class="btn btn-success">{{__('messages.update')}}</a></td>

                <td> <a href="{{route('ajax.offers.edit',$offer -> id)}}" class="btn btn-success"> تعديل</a></td>

                <td><a href="{{route('offers.delete',$offer ->id)}}" class="btn btn-danger">{{__('messages.delete')}}</a></td>
                <td><a href="" offer_id="{{$offer -> id}}" class="delete_btn btn btn-danger"> حذف اجاكس </a></td>
            </tr>
        @endforeach
        </tbody>
    </table>
@stop
@section('scripts')
    <script>
        $(document).on('click', '.delete_btn', function (e) {
            e.preventDefault();

            var offer_id = $(this).attr('offer_id');

            $.ajax({
                type: 'post',
                url: "{{route('ajax.offers.delete')}}",
                data: {
                    '_token': "{{csrf_token()}}",
                    'id': offer_id
                },

                success: function (data) {
                    if (data.status == true) {
                        $('#success_msg').show();

                    }
                    $('.offerrow'+data.id).remove();

                },
            })
        })

    </script>
@stop
