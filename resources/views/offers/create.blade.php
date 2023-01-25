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


            @if(Session::has('success'))
            <div class='alert alert-success'>
                {{Session::get('success')}}
            </div>
            @endif

        <form action='{{route('offers.store')}}' method="POST" enctype="multipart/form-data">
            @csrf
            <h1 class='text-center'>
                <span class='text-center'>{{__('translate.Add your offer')}}</span>
            </h1>

            <div class="form-group">
              <input type="file" name="file" class="form-control">
              @error('file')
              <div class='alert alert-danger'>{{$message}}</div>
              @enderror
            </div>
            <div class="form-group">
                <label for="exampleInputEmail1">offer name arabic</label>
                <input type="text" name="name_ar" class="form-control">
                @error('name_ar')
                <div class='alert alert-danger'>{{$message}}</div>
                @enderror
            </div>
            <div class="form-group">
                <label for="exampleInputEmail1">offer name english</label>
                <input type="text" name="name_en" class="form-control">
                @error('name_en')
                <div class='alert alert-danger'>{{$message}}</div>
                @enderror
            </div>

            <div class="form-group">
                <label for="exampleInputEmail1">price</label>
                <input type="text" name="price" class="form-control">
                @error('price')
                <div class='alert alert-danger'>{{$message}}</div>
                @enderror
            </div>

            <div class="form-group">
                <label for="exampleInputEmail1">details arabic</label>
                <input type="text" name="details_ar" class="form-control">
                @error('details_ar')
                <div class='alert alert-danger'>{{$message}}</div>
                @enderror
            </div>
            <div class="form-group">
                <label for="exampleInputEmail1">details english</label>
                <input type="text" name="details_en" class="form-control">
                @error('details_en')
                <div class='alert alert-danger'>{{$message}}</div>
                @enderror
            </div>
            <button type="submit" class="btn btn-success">Upload</button>
          </form>
        </div>



    </body>
</html>
