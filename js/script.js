$(document).ready(function () {
    $('.card-block').click(function () {
        $newsId = $(this).attr('news-id');
        $(this).find('.card-text:last-child').toggleClass('hided',300, "easeOutSine");

    });

    $('#adminToggleEvent').change(function() {

            $('.card .closeButton').toggleClass('hided')

    });

    $('.delete').on('click',function(){
        var id = $(this).parents('.card').attr('news-id');
        $.post( "functions.php", { id: id, action: "del" } );
        alert('la nouvelle numéro '+ id + ' à été supprimée');
        history.go(0);
    });
    $('.edit').on('click',function(){
        var id = $(this).parents('.card').attr('news-id');
        var titre = $(this).parents('.card').find('.card-title').contents()[0].textContent;
        var description = $(this).parents('.card').find('.card-text').contents()[0].textContent;
        var date = $(this).parents('.card').find('.card-details').text().trim();
        var text = $(this).parents('.card').find('.card-text').text();

        date = new Date().toISOString().substring(0, 10);

        $.post( "_editForm.php", { id: id, action:'edit',titre: titre, description:description ,date:date, text:text } ).done(function( data ) {
            $('#newscontainer').html(data);
        });

    });

    $('addNews').click(function () {
        $.post("index.php", {action:'add'});
        history.go(0);
    });

    $('#close_edit').click(function () {
        $(this).find('.writeEditArticle').toggleClass('hided',300, "easeOutSine");

    });
    $('#addForm').validate(
    {
        rules: {
            newsTitre: {
                required: true
            },
            newsDescription: {
                required: true
            },
            newsContent: {
                required: true
            },
            newsDate: {
                required: true
            }
        },
        errorPlacement: function(error, element) {
                error.text('.writeEditArticle label');
        },
        submitHandler: function(form){
            form.submit();
            $('.writeEditArticle').hide();

            /*if (window.parent.location.href.match(/action=/)){
                if (typeof (history.pushState) != "undefined") {
                    var obj = { Title: document.title, Url: window.parent.location.pathname };
                    history.pushState(obj, obj.Title, obj.Url);
                } else {
                    window.parent.location = window.parent.location.pathname;
                }
            }*/
            window.location = window.location.href+"?rnd="+Math.random();
        }

    });


});
