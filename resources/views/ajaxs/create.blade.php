@extends('layouts\app')
@section('content')

<div class="container">
    <div class="alert alert-success" id='success_msg' style="display: none">
        تم الحفظ بنجاح
    </div>
    <h1 class='text-center'>
        <span class='text-center'>{{__('translate.Add your offer')}}</span>
    </h1>



    <form method="POST"   id="offerForm" enctype="multipart/form-data">

    @csrf

    <div class="form-group">
      <input type="file" name="file" class="form-control" required='required'>
      <div id='file_error' class='text-danger'> </div>
    </div>

    <div class="form-group">
        <label for="exampleInputEmail1">offer name arabic</label>
        <input type="text" name="name_ar" class="form-control">
        <div id='name_ar_error' class='text-danger'> </div>
    </div>

    <div class="form-group">
        <label for="exampleInputEmail1">offer name english</label>
        <input type="text" name="name_en" class="form-control">
        <div id='name_en_error' class='text-danger'> </div>
    </div>

    <div class="form-group">
        <label for="exampleInputEmail1">price</label>
        <input type="text" name="price" class="form-control">
        <div id='price_error' class='text-danger'> </div>
    </div>

    <div class="form-group">
        <label for="exampleInputEmail1">details arabic</label>
        <input type="text" name="details_ar" class="form-control">
        <div id='details_ar_error' class='text-danger'> </div>
    </div>

    <div class="form-group">
        <label for="exampleInputEmail1">details english</label>
        <input type="text" name="details_en" class="form-control">
        <div id='details_en_error' class='text-danger'> </div>
    </div>

    <button id="save_offer" class="btn btn-success">ADD</button>
  </form>
</div>

@endsection

@section('scripts')
    <script>

            $(document).on('click', '#save_offer', function (e) {
                e.preventDefault('');

            $('#file_error').text('');
            $('#name_ar_error').text('');
            $('#name_en_error').text('');
            $('#price_error').text('');
            $('#details_ar_error').text('');
            $('#details_en_error').text('');
            
            var formData = new FormData($('#offerForm')[0]);

            $.ajax({
                type: 'post',
                enctype: 'multipart/form-data',
                url: "{{route('ajax.store')}}",
                data: formData,
                processData: false,
                contentType: false,
                cache: false,
                success: function (data) {
                    if(data.status == true)
                    {
                        $('#success_msg').show();
                    }

                },error: function (reject) {
                    var response = $.parseJSON(reject.responseText);
                    $.each(response.errors, function (key, val) {
                        $("#" + key + "_error").text(val[0]);
                    });

                }
        });
        });

/*
    {
    '_token'     :"{{csrf_token()}}",
    //'file'       : $("input[name='file']").val(),
    'name_ar'    : $("input[name='name_ar']").val(),
    'name_en'    : $("input[name='name_en']").val(),
    'details_ar' : $("input[name='details_ar']").val(),
    'details_en' : $("input[name='details_en']").val(),
    'price'      : $("input[name='price']").val(),
    }
*/
    </script>
@endsection
