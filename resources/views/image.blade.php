<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <title>W3path | @yield('title') - W3path.com</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/css/bootstrap.min.css" />
  <script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
  <link rel="icon" href="{{ url('public/image/w3path-favicon.png') }}" sizes="32x32" />
  <style>
   .container{
    padding: 0.5%;
   }
</style>
<script type="text/javascript">

    $(document).ready(function (e) {

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $('#image').change(function(){

            let reader = new FileReader();
            reader.onload = (e) => {
              $('#image_preview_container').attr('src', e.target.result);
            }
            reader.readAsDataURL(this.files[0]);

        });

        $('#upload_image_form').submit(function(e) {
            e.preventDefault();

            var formData = new FormData(this);

            $.ajax({
                type:'POST',
                url: "{{ url('/photo/save')}}",
                data: formData,
                cache:false,
                contentType: false,
                processData: false,
                success: (data) => {
                    this.reset();
                    alert('Image has been uploaded successfully');
                },
                error: function(data){
                    console.log(data);
                }
            });
        });
    });

</script>
</head>
<body>

  <nav class="navbar navbar-expand-sm bg-primary navbar-dark">
    <a class="navbar-brand" href="{{ url('/') }}">w3path</a>
  </nav>
    <div class="container mt-4">
        <div class="row">
            <div class="col-sm-12">
                <h4>Upload image using ajax</h4>
            </div>
        </div>
        <hr />

        <form method="POST" enctype="multipart/form-data" id="upload_image_form" action="javascript:void(0)" >

            <div class="row">
                <div class="col-md-12 mb-2">
                    <img id="image_preview_container" src="{{ asset('public/image/image-preview.png') }}"
                        alt="preview image" style="max-height: 150px;">
                </div>
                <div class="col-md-12">
                    <div class="form-group">
                        <input type="file" name="image" placeholder="Choose image" id="image">
                        <span class="text-danger">{{ $errors->first('title') }}</span>
                    </div>
                </div>


                <div class="col-md-12">
                    <button type="submit" class="btn btn-primary">Submit</button>
                </div>
            </div>
        </form>
    </div>
</body>
</html>
