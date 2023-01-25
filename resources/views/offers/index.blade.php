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
        <div class='container'>
        @if(Session::has('success'))
        <div class='alert alert-success'>
            {{Session::get('success')}}
        </div>
        @endif

        @if(Session::has('error'))
        <div class='alert alert-danger'>
            {{Session::get('error')}}
        </div>
        @endif

        <ul>
            @foreach(LaravelLocalization::getSupportedLocales() as $localeCode => $properties)
                <li>
                    <a rel="alternate" hreflang="{{ $localeCode }}" href="{{ LaravelLocalization::getLocalizedURL($localeCode, null, [], true) }}">
                        {{ $properties['native'] }}
                    </a>
                </li>
            @endforeach
        </ul>

        <table class="table">
            <thead>
          <tr  >
                <th scope="col">#</th>
                <th scope="col">Offer Name</th>
                <th scope="col">Offer Price</th>
                <th scope="col">Offer details</th>
                <th scope="col">operation</th>
            </tr>
            </thead>
            <tbody>


            @foreach($offers as $offer)
                <tr>
                    <th scope="row">{{$offer -> id}}</th>
                    <td>{{$offer->name}}</td>
                    <td>{{$offer->price}}</td>
                    <td>{{$offer->details}}</td>
                    <td>
                        <a href="{{url('offers/edit/'.$offer -> id)}}" class="btn btn-success"> Edit</a>
                        <a href="{{route('offers.delete',$offer->id)}}" class="btn btn-danger"> Delete</a>

                     </td>

                </tr>
                @endforeach

            </tbody>
        </table>
        <div class="text-center">{{$offers -> links()}}</div>
    </div>


    </body>
</html>
