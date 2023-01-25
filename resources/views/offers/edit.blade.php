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


        <div class="container">

            <form class='login' action='{{route('offers.update',$offers->id)}}' method='POST'>

                @csrf
                <h1 class='text-center'>
                <span class='text-center'>تعديل العرض</span>
                </h1>
                <label> العرض</label>
                <input  class='form-control' value='{{$offers->name_ar}}' type='text' name='name_ar' >
                @error('name_ar')
                <div class='alert alert-danger'>{{$message}}</div>
                @enderror
                <label> العرض بالانجليزى</label>
                <input  class='form-control' value='{{$offers->name_en}}' type='text' name='name_en' >
                @error('name_en')
                <div class='alert alert-danger'>{{$message}}</div>
                @enderror


                <label>السعر</label>
                <input  class='form-control'  value='{{$offers->price}}' type='text' name='price' >
                @error('price')
                <div class='alert alert-danger'>{{$message}}</div>
                @enderror


                <label>التفاصيل بالعربى</label>
                <input  class='form-control'  value='{{$offers->details_ar}}' type='text' name='details_ar' >
                @error('details_ar')
                <div class='alert alert-danger'>{{$message}}</div>
                @enderror
                <label>التفاصيل بالانجليزى</label>
                <input  class='form-control' value='{{$offers->details_en}}' type='text' name='details_en' >
                @error('details_en')
                <div class='alert alert-danger'>{{$message}}</div>
                @enderror
                <input  class='btn btn-primary btn-block' type='submit' value='Update'>
            </form>
        </div>



    </body>
</html>
