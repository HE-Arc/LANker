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
});
