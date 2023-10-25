
$(function() {
    // Add quick view of upload image
    $('input.upload-image').on('change', function () {
        $('img.preview').remove();
        $('div.preview').append(
            //     // build  a fake path string for each File
            //     // all that is really needed to display the image
            '<img class="preview img-thumbnail" src="' + URL.createObjectURL(event.target.files[0]) + '">');
    });

    $('.product-per-page').on('change', function(){
        let limit = $('.product-per-page').find(":selected").val();
        window.location.href = 'http://localhost/blog?page=1&limit=' + limit;
    });


    // edit blog
    $('form.form-data').on('submit', function(e){
        id =  $('form.form-data').find("#id").val();
        // ignore when creating a new post
        if (id){
            e.preventDefault();
            data = new FormData(this);
            $.ajax({
                url: '/blog/' + id + '/edit/',
                type: "POST",
                data:  data,
                contentType: false,
                cache: false,
                processData:false,
                beforeSend : function()
                {
                    $("#err").fadeOut();
                },
                success: function(data)
                {
                    console.log('success');
                    window.location.href = 'http://localhost/blog';
                },
                error: function(e)
                {
                    console.log(e);
                }
            });
        }
    });
})


