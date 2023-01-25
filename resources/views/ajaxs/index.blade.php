@extends('layouts.app')
@section('content')
    <div class="alert alert-success" id='ajax-msg' style="display: none">
        تم الحذف بنجاح
    </div>
    @if(Session::has('error'))
    <div class='alert alert-danger'> {{Session::get('error')}} </div>
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
            <th scope="col">photo</th>
            <th scope="col">operation</th>
        </tr>
        </thead>
        <tbody>


        @foreach($offers as $offer)
            <tr class='ajaxrowintable{{$offer -> id}}'>
                <th scope="row">{{$offer -> id}}</th>
                <td>{{$offer->name}}</td>
                <td>{{$offer->price}}</td>
                <td>{{$offer->details}}</td>
                <td><img  style="width: 60px; height: 60px;" src="{{asset('uploads/offers/'.$offer->file)}}"></td>
                <td>
                    <a href="{{route('ajax.edit',$offer->id)}}" class='btn btn-success'>Edit</a>
                    <a data_id='{{$offer->id}}' class="delete_btn btn btn-danger"> Delete</a>

                 </td>

            </tr>
            @endforeach

        </tbody>
    </table>

@endsection

@section('scripts')
    <script>

/////////////////////////////////////////Start Delete///////////////////////////////////////////

            $(document).on('click', '.delete_btn', function (e) {
                e.preventDefault();
                var ID = $(this).attr('data_id');

            $.ajax({
                type: 'post',
                url: "{{route('ajax.delete')}}",
                data: {
                    '_token'     :"{{csrf_token()}}",
                    'id'         :ID
                },
                success: function (data) {
                    if(data.status == true)
                    {
                        $('#ajax-msg').show();
                    }

                    $('.ajaxrowintable'+data.id).remove();

                },error: function (reject) {
                }
        });
        });

/////////////////////////////////////////End Delete///////////////////////////////////////////


    </script>
@endsection

