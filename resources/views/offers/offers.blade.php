<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@200;600&display=swap" rel="stylesheet">

        <!-- Styles -->

        <!-- Bootstrap -->
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@3.4.1/dist/css/bootstrap.min.css" integrity="sha384-HSMxcRTRxnN+Bdg0JdbxYKrThecOKuH5zCYotlSAcp1+c8xmyTe9GYg1l9a69psu" crossorigin="anonymous">
    </head>
    <body>
        <div>
            @if(Session::has('success'))
            <div class='alert alert-success'>
                {{Session::get('success')}}
            </div>
            @endif


            <nav class="navbar navbar-expand-lg navbar-light bg-light">
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul>
                        @foreach(LaravelLocalization::getSupportedLocales() as $localeCode => $properties)
                            <li>
                                <a rel="alternate" hreflang="{{ $localeCode }}" href="{{ LaravelLocalization::getLocalizedURL($localeCode, null, [], true) }}">
                                    {{ $properties['native'] }}
                                </a>
                            </li>
                        @endforeach

                    </ul>
                </div>
              </nav>


            <form class='login' action='{{route('offers.store2')}}' method='GET'>

                @csrf
                <h1 class='text-center'>
                <span class='text-center'>{{__('messages.Add your offer')}}</span>
                </h1>
                <label>{{__('messages.Offer Name')}}</label>
                <input  class='form-control'  type='text' name='name' >
                @error('name')
                <div class='alert alert-danger'>{{$message}}</div>
                @enderror
                <label>{{__('messages.Offer price')}}</label>
                <input  class='form-control'  type='text' name='price' >
                @error('price')
                <div class='alert alert-danger'>{{$message}}</div>
                @enderror
                <label>{{__('messages.Offer details')}}</label>
                <input  class='form-control'  type='text' name='details' >
                @error('details')
                <div class='alert alert-danger'>{{$message}}</div>
                @enderror
                <input  class='btn btn-primary btn-block' type='submit' value='{{__('messages.add')}}'>
            </form>

        </div>


    </body>
</html>
