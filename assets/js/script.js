/**
 * AJAX vou comentar todo o código para estudo.
 * Tenho que: 
 * Arrumar o bug de atualização da edição
 * Sistema de úsuario.
 * Validar posição de hierarquia.
 */
$('#form1').submit(function(e){
    /**
     * preventDefault faz com que a pagina não atualize quando os dados forem enviados para o back-end
     */
    e.preventDefault(); 
    var u_id = $('#id').val();
    var u_name = $('#name').val();
    var u_comment = $('#comment').val();
    console.log(u_name.length, u_comment.length);

    /**Validação no lado do cliente.
     * Caso o nome e o comentario não sejam validos.
     */
    if(u_name.length <= 0){
        alert('Por favor digite seu nome.');
        $('#name').focus();
        return false;
    }
    if(u_comment.length <= 0){
        alert('Por favor digite o comentario.');
        $('#comment').focus();
        return false;
    }


    //console.log(u_name, u_comment); VALIDAR POR PARTE DO CLIENTE.
    $.ajax({
        url: 'http://localhost/ajax/enviar.php',
        method: 'POST',
        data: {id: u_id, name: u_name, comment:u_comment},
        dataType: 'json'
    }).done(function(result){
        if(result.status == 0){
            alert(`ERRO : ${result.msg}`);
            $('#name').focus(); //Coloca o cursor dentro do campo.
        }else{
            $('#id').val('');
            $('#name').val('');
            $('#comment').val('');
            console.log(result);
            getComments();
            alert(`SUCESSO : ${result.msg}`);
        }
    });
});

function getComments() {
    $.ajax({
        url: 'http://localhost/ajax/selecionar.php',
        method: 'GET',
        dataType: 'json'
    }).done(function(result){
        console.log(result);
        $('.box_comment').html('');// Limpa o conteúdo da div e reescreve novamente.
            //debugger;
        if(result.status == 1){
            for (var i = 0; i < result.msg.length; i++) {
                $('.box_comment').prepend('<div class="b_comm">' + 
                '<table class="full_width">' +
                    '<thead>' +
                        '<tr>' +
                            '<th id="font-primary">'+result.msg[i].name+'</th>' +
                        '</tr>' +
                    '</thead>' +
                    '<tbody>' +
                        '<tr>' +
                            '<td class="tdcomentario" id="font-secundary">'+result.msg[i].comment+'</td>' +
                            '<td class="acaotd" id="font-secundary"><a href="javascript:editar('+result.msg[i].id+')"><img class="botao_acao" src="../ajax/assets/img/edit.svg"></a> ' +
                            '<a href="javascript:excluir('+result.msg[i].id+')"><img class="botao_acao" src="../ajax/assets/img/excluir.svg"></a></td>' +
                        '</tr>' +
                    '</tbody>' +
                '</table>' +
                '</div>');
                console.log(result.msg[i]);
            }
        }else{
            $('.box_comment').prepend(`<h1>${result.msg}</h1>`);
        }
    });
}

editar = (id) => {
    $.ajax({
        url: 'http://localhost/ajax/pesquisa.php',
        method: 'GET',
        data: {id: id},
        dataType: 'json'
    }).done((result) => {
        if(result.status == 0){
            alert(`ERRO :  ${result.msg}`);
        }else{
            console.log(result.msg);
            $('#id').val(result.msg[0].id);
            $('#name').val(result.msg[0].name);
            $('#comment').val(result.msg[0].comment);
            $('html, body').scrollTop(0);
            $('#name').focus();
        }
    })
}
excluir = (id) => {
    if(confirm('Deseja realmente excluir esse registro?')){
        $.ajax({
            url: 'http://localhost/ajax/excluir.php',
            method: 'GET',
            data: {id: id},
            dataType: 'json'
        }).done((result) => {
            if(result.status == 0){
                alert(`ERRO :  ${result.msg}`);
            }else{
                getComments();
            }
        })  
    }
}

$(document).ready(function(){
    getComments();  
});

