@extends('layouts.app')
@section('content')
    <div class="container">


        <div class="content">
            <div class="title m-b-md">
                {{__('messages.add your offer')}}
            </div>

            <div class="alert alert-success" id="success_msg" style="display: none" role="alert">
                {{__('messages.sucess')}}
            </div>
            <br>

            <form method="POST" id="offerForm" enctype="multipart/form-data">
                @csrf
                <div class="form-group">
                    <label for="exampleInputEmail1">{{__('messages.offer name en')}}</label>
                    <input type="text" class="form-control" name="name_en"
                           placeholder="{{__('messages.offer name en')}}">
                    <small id="name_en_error" class="form-text text-danger"></small>
                </div>
                <div class="form-group">
                    <label for="exampleInputEmail1">{{__('messages.offer name ar')}}</label>
                    <input type="text" class="form-control" name="name_ar"
                           placeholder="{{__('messages.offer name ar')}}">
                    <small id="name_ar_error" class="form-text text-danger"></small>

                </div>
                <div class="form-group">
                    <label for="exampleInputPassword1">{{__('messages.offer price')}}</label>
                    <input type="text" class="form-control" name="price"
                           placeholder="{{__('messages.offer price')}}">
                    <small id="price_error" class="form-text text-danger"></small>
                </div>
                <div class="form-group">
                    <label for="exampleInputPassword1">{{__('messages.offer details en')}}</label>
                    <input type="text" class="form-control" name="details_en"
                           placeholder="{{__('messages.offer details en')}}">
                    <small id="details_en_error" class="form-text text-danger"></small>
                </div>
                <div class="form-group">
                    <label for="exampleInputPassword1">{{__('messages.offer details ar')}}</label>
                    <input type="text" class="form-control" name="details_ar"
                           placeholder="{{__('messages.offer details ar')}}">
                    <small id="details_ar_error" class="form-text text-danger"></small>
                </div>
                <div class="form-group">
                    <label for="exampleInputPassword1">{{__('messages.offer photo')}}</label>
                    <input type="file" class="form-control" name="photo">

                    <small id="photo_error" class="form-text text-danger"></small>

                </div>

                <button id="saveOffer" class="btn btn-primary">{{__('messages.offer store')}}</button>
            </form>

        </div>
    </div>
    </div>
@stop

@section('scripts')
    <script>
        $(document).on('click', '#saveOffer', function (e) {
            e.preventDefault();
            $('#name_en_error').text('');
            $('#name_ar_error').text('');
            $('#price_error').text('');
            $('#details_en_error').text('');
            $('#details_ar_error').text('');
            $('#photo_error').text('');
            var formData = new FormData($('#offerForm')[0]);

            $.ajax({
                type: 'post',
                enctype: 'multipart/form-data',
                url: "{{route('ajaxoffers.save')}}",
                data: formData,
                processData: false,
                contentType: false,
                cache: false,
                success: function (data) {
                    if (data.status == true) {
                        $('#success_msg').show();
                    }
                }, error: function (reject) {
                    var response = $.parseJSON(reject.responseText);
                    $.each(response.errors, function (key, val){
                    $("#" + key + "_error").text(val[0]);

                })
        }
        })
        })

    </script>
@stop
