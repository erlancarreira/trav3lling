$('.rtw-form').submit(function(e)
    {
        var form = $(this);
        var action = form.attr('data-controller');
        var dados = new FormData($(this)[0]);

        $.ajax({
            url: action,
            data: dados,
            type: 'POST',
            dataType: 'json',
            processData: false,
            contentType: false,
            beforeSend: function(data)
            {

            },
            success: function(data)
            {

            }

        });
        e.preventDefault();
    });



no seu form

<form data-controller="http://localhost/seuprojeto/controller/action" method="post" class=" rtw-form" enctype="multipart/form-data">

<button não use o type submit>Cadastrar</button>