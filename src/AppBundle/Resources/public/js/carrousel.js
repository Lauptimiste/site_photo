$(function() {

    $('.img_to_click').click(function(){
        console.log($(this).data('img'));
        console.log($('#carrousel_route').html());
        url = $('#carrousel_route').html();
        $.ajax({
            method: "POST",
            url: url,
            data: { id: $(this).data('img')},
            dataType : 'html',
            async: true,
            success : function(data){
                $('body').prepend(data);
                $('.to_be_black').css('opacity','0.05');

           }
        });
    })
    
    $("body").on('click', '#close', function(){
        $('#myCarousel').remove();
        $('.to_be_black').css('opacity','1');
    })

});