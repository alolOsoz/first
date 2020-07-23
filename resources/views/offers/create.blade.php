<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>

        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">

        <!-- Styles -->
        <style>
            html, body {
                background-color: #fff;
                color: #636b6f;
                font-family: 'Nunito', sans-serif;
                font-weight: 200;
                height: 100vh;
                margin: 0;
            }

            .full-height {
                height: 100vh;
            }

            .flex-center {
                align-items: center;
                display: flex;
                justify-content: center;
            }

            .position-ref {
                position: relative;
            }

            .top-right {
                position: absolute;
                right: 10px;
                top: 18px;
            }

            .content {
                text-align: center;
            }

            .title {
                font-size: 84px;
            }

            .links > a {
                color: #636b6f;
                padding: 0 25px;
                font-size: 13px;
                font-weight: 600;
                letter-spacing: .1rem;
                text-decoration: none;
                text-transform: uppercase;
            }

            .m-b-md {
                margin-bottom: 30px;
            }
        </style>
    </head>
    <body>

    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <a class="navbar-brand" href="#">Navbar</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav mr-auto">
                    @foreach(LaravelLocalization::getSupportedLocales() as $localeCode => $properties)
                        <li class="nav-item active">
                            <a class="nav-link"
                               href="{{ LaravelLocalization::getLocalizedURL($localeCode, null, [], true) }}"> {{ $properties['native'] }}
                                <span class="sr-only">(current)</span></a>
                        </li>
                    @endforeach


                </ul>
            <form class="form-inline my-2 my-lg-0">
                <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search">
                <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
            </form>
        </div>
    </nav>
        <div class="flex-center position-ref full-height">
            @if (Route::has('login'))
                <div class="top-right links">
                    @auth
                        <a href="{{ url('/home') }}">Home</a>
                    @else
                        <a href="{{ route('login') }}">Login</a>

                        @if (Route::has('register'))
                            <a href="{{ route('register') }}">Register</a>
                        @endif
                    @endauth
                </div>
            @endif

            <div class="content">
                <div class="title m-b-md">
                  {{__('messages.add your offer')}}
                </div>
                @if(Session::has('sucess'))
                <div class="alert alert-success" role="alert">
                    {{Session::get('sucess')}}
                </div>
                <br>
                @endif
                <form method="POST" action="{{route('offers.store')}}" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <label for="exampleInputEmail1">{{__('messages.offer name en')}}</label>
                        <input type="text" class="form-control"  name="name_en" placeholder="{{__('messages.offer name en')}}">
                        @error('name_en')
                        <small id="emailHelp" class="form-text text-danger">{{$message}}.</small>
                        @enderror
                    </div><div class="form-group">
                        <label for="exampleInputEmail1">{{__('messages.offer name ar')}}</label>
                        <input type="text" class="form-control"  name="name_ar" placeholder="{{__('messages.offer name ar')}}">
                        @error('name_ar')
                        <small id="emailHelp" class="form-text text-danger">{{$message}}.</small>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="exampleInputPassword1">{{__('messages.offer price')}}</label>
                        <input type="text" class="form-control" name="price" placeholder="{{__('messages.offer price')}}" >
                        @error('price')
                        <small id="emailHelp" class="form-text text-danger">{{$message}}.</small>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="exampleInputPassword1">{{__('messages.offer details en')}}</label>
                        <input type="text" class="form-control" name="details_en" placeholder="{{__('messages.offer details en')}}">
                        @error('details_en')
                        <small id="emailHelp" class="form-text text-danger">{{$message}}.</small>
                        @enderror
                    </div><div class="form-group">
                        <label for="exampleInputPassword1">{{__('messages.offer details ar')}}</label>
                        <input type="text" class="form-control" name="details_ar" placeholder="{{__('messages.offer details ar')}}">
                        @error('details_ar')
                        <small id="emailHelp" class="form-text text-danger">{{$message}}.</small>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="exampleInputPassword1">{{__('messages.offer photo')}}</label>
                        <input type="file" class="form-control" name="photo"  >
                        @error('photo')
                        <small id="emailHelp" class="form-text text-danger">{{$message}}.</small>
                        @enderror
                    </div>

                    <button type="submit" class="btn btn-primary">{{__('messages.offer store')}}</button>
                </form>

                </div>
            </div>
    </body>
</html>
