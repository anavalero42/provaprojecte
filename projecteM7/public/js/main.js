window.addEventListener("load", function(){
    $('.btn-like').css('cursor','pointer');
    $('.btn-dislike').css('cursor','pointer');
});

function like(){
    $('.btn-dislike').unbind('click').click(function(){
        console.log('like');
        $(this).addClass('btn-like').removeClass('btn-dislike');
        $(this).attr('src','images/heart-r.png');

        $.ajax({
            url: url+'/like/'+$(this).data('id'),
            type: 'GET',
        });
    });
}
