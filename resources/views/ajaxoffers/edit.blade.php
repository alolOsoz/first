@extends('layouts.app')
@section('content')
    <div class="container">


        <div class="content">
            <div class="title m-b-md">
                {{__('messages.add your offer')}}
            </div>

            <div class="alert alert-success" id="success_msg"  style="display: none" role="alert">
                {{__('messages.sucess')}}
            </div>
            <br>

            <form method="POST" id="offerFormUpdate" enctype="multipart/form-data">
                @csrf
                <div class="form-group">
                    <input type="text" style="display: none" class="form-control" name="offer_id" value="{{$offer->id}}"

                    <label for="exampleInputEmail1">{{__('messages.offer name en')}}</label>
                    <input type="text" class="form-control" name="name_en" value="{{$offer->name_en}}"
                           placeholder="{{__('messages.offer name en')}}">
                    @error('name_en')
                    <small id="emailHelp" class="form-text text-danger">{{$message}}.</small>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="exampleInputEmail1">{{__('messages.offer name ar')}}</label>
                    <input type="text" class="form-control" name="name_ar" value="{{$offer->name_ar}}"
                           placeholder="{{__('messages.offer name ar')}}">
                    @error('name_ar')
                    <small id="emailHelp" class="form-text text-danger">{{$message}}.</small>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="exampleInputPassword1">{{__('messages.offer price')}}</label>
                    <input type="text" class="form-control" name="price" value="{{$offer->price}}"
                           placeholder="{{__('messages.offer price')}}">
                    @error('price')
                    <small id="emailHelp" class="form-text text-danger">{{$message}}.</small>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="exampleInputPassword1">{{__('messages.offer details en')}}</label>
                    <input type="text" class="form-control" name="details_en" value="{{$offer->details_en}}"
                           placeholder="{{__('messages.offer details en')}}">
                    @error('details_en')
                    <small id="emailHelp" class="form-text text-danger">{{$message}}.</small>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="exampleInputPassword1">{{__('messages.offer details ar')}}</label>
                    <input type="text" class="form-control" name="details_ar" value="{{$offer->details_ar}}"
                           placeholder="{{__('messages.offer details ar')}}">
                    @error('details_ar')
                    <small id="emailHelp" class="form-text text-danger">{{$message}}.</small>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="exampleInputPassword1">{{__('messages.offer photo')}}</label>
                    <input type="file" class="form-control" name="photo">
                    @error('photo')
                    <small id="emailHelp" class="form-text text-danger">{{$message}}.</small>
                    @enderror
                </div>

                <button id="updateOffer" class="btn btn-primary">{{__('messages.offer store')}}</button>
            </form>

        </div>
    </div>
    </div>
@stop

@section('scripts')
    <script>
        $(document).on('click', '#updateOffer', function (e) {
            $('#name_en_error').text('');
            $('#name_ar_error').text('');
            $('#price_error').text('');
            $('#details_en_error').text('');
            $('#details_ar_error').text('');
            $('#photo_error').text('');
            e.preventDefault();
            var formData = new FormData($('#offerFormUpdate')[0]);

            $.ajax({
                type: 'post',
                enctype: 'multipart/form-data',
                url: "{{route('ajax.offers.update')}}",
                data: formData,
                processData: false,
                contentType: false,
                cache: false,
                success: function (data) {
                    if (data.status == true){
                        $('#success_msg').show();

                    }

                },error: function (reject) {
                    var response = $.parseJSON(reject.responseText);
                    $.each(response.errors, function (key, val){
                        $("#" + key + "_error").text(val[0]);

                    })

                })
        })

    </script>
@stop
