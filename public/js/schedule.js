jQuery(function ($) {
		
    function exibirAgendamento(data) {
        if($('#datas_'+data).hasClass("hide")){
            $('#datas_'+data).slideDown( 400 ).removeClass('hide').addClass('show');
        } 
    } 

    function removerAgendamento(data) {
        if($('#datas_'+data).hasClass("hide")){
        } else {
            $('#datas_'+data).slideUp( 450 );
            setTimeout(function() {
                $('#datas_'+data).removeClass("show").addClass("hide");
            }, 400);
        }
    }

    $(".btnDatas").click( function()
       {
        var idData = $(this).attr('id');
        idData = idData.split('-');
        idData = idData[1];
        $('#diaSelecionado').val(idData);
        if($('#diaDaSemSelecionado').attr('data-content') == ''){
            $('#diaDaSemSelecionado').attr('data-content',$(this).attr('data-content'));
            $(this).addClass("selected");
            var data = $(this).attr('data-content').split(' ');
            exibirAgendamento(idData);
        }else if($(this).attr('data-content') == $('#diaDaSemSelecionado').attr('data-content')){
                //caso ja esteja selecionado e o proximo clique for p fechar essa data
                $('#diaDaSemSelecionado').attr('data-content','')
                $(this).removeClass("selected");
                removerAgendamento(idData);
        } else	{
            $('#diaDaSemSelecionado').attr('data-content',$(this).attr('data-content'));
            var idDataAntigo = $(".btnDiaSemana.btnDatas.selected").attr("id");
            idDataAntigo = idDataAntigo.split('-');
            idDataAntigo = idDataAntigo[1];
            removerAgendamento(idDataAntigo);
            $(".btnDatas.selected").removeClass("selected");
            $(this).addClass("selected");
            var data = $(this).attr('data-content').split(' ');
            setTimeout(function() {
                exibirAgendamento(idData);
            }, 300);
        }

       }
    );
  
 function removerHorario(id,horariosId,horarios){
    if ($("#"+id).hasClass("gridHighlight")){
        $("#"+id).removeClass("gridHighlight");
        arrayHorariosID = JSON.parse(horariosId);
        arrayHorarios = JSON.parse(horarios);
        arrayHorariosID.splice(arrayHorariosID.indexOf(id),1)
        arrayHorarios.splice(arrayHorarios.indexOf($("#"+id).attr('data-horario-selecionado')),1)
        $('#horariosId').val(JSON.stringify(arrayHorariosID) == '[]' ? '' : JSON.stringify(arrayHorariosID)); //store array
        $('#horarios').val(JSON.stringify(arrayHorarios) == '[]' ? '' : JSON.stringify(arrayHorarios)); //store array
        console.log(arrayHorariosID.indexOf(id),1);
        console.log($('#horariosId').val())
        console.log($('#horarios').val())
        atualizarSpanHorario();
        return false;
    }
    return true;
}

function atualizarSpanHorario(){
    var horarios = $('#horarios').val();
    horarios = horarios.replace("[","");
    horarios = horarios.replace("]","");
    horarios = horarios.replace(/"/g,"");
    horarios = horarios.split(",");

    _agendamento1 = horarios[0] == undefined ? '' : horarios[0].split(' ');
    _agendamento1 = (_agendamento1[0] == undefined || _agendamento1[1] == undefined) ? '' : ' ' + _agendamento1[0] + ' as ' + _agendamento1[1];
    
    
    $('#agendamentoUm').attr('data-content', _agendamento1);
    
    
    if($('#agendamentoUm').attr('data-content') != '') {
        $('#agendamentoUmRelogio').removeClass('hide');
        $('.confirmarAgendamento').removeClass('hide');
    }else{
        $('#agendamentoUmRelogio').addClass('hide');
        $('.confirmarAgendamento').addClass('hide');
    }

}


$( ".adicionaHorario" ).click(function() {

    var id  = $(this).attr("id");
    var horarios = $('#horarios').val();
    var horariosId = $('#horariosId').val();
    var dia = $(".btnDiaSemana.btnDatas.selected").attr("data-input");

    var retorno = removerHorario(id,horariosId,horarios)
    if(!retorno){
        return;
    }

    if(horarios == ""){
        arrayHorarios = [];
    }else{
        var arrayHorarios = JSON.parse(horarios);
    }

    if(horariosId == ""){
        arrayHorariosID = [];
    }else{
        var arrayHorariosID = JSON.parse(horariosId);
    }
    
    if(arrayHorarios.length < 1){
        arrayHorarios.push(dia+" "+$(this).attr("value"));
        arrayHorariosID.push($(this).attr('id'));
        $(this).addClass("gridHighlight").attr('data-horario-selecionado',dia+" "+$(this).attr("value"));
        $('#horarios').val(JSON.stringify(arrayHorarios)); //store array
        $('#horariosId').val(JSON.stringify(arrayHorariosID)); //store array
        // adicionar valor nas divs de exibição
        atualizarSpanHorario();
        
    }else {
        alert("Datas máximas de agendamento atingidas!");
    }

});

$(".confirmarAgendamento").on("click", function(event) {
    var horarios = $('#horarios').val();
    //var pacient = $('#idPacient').val();

    horarios = horarios.replace("[","");
    horarios = horarios.replace("]","");
    horarios = horarios.replace(/"/g,"");
    horarios = horarios.split(",");
    if(horarios.length==0 || horarios == ""){
        alert("Selecione suas datas de agendamento")
        return;
    }
    else if(horarios.length<1){
        alert("Selecione a data de agendamento")
        return;
    }else if (horarios.length > 1){
        alert("Você só pode agendar um dia")
        return;
    }


    console.log(horarios);
    var agendamento = {horarios:horarios};
    var dados = JSON.stringify(agendamento);


    JSON.parse(dados, function(k, v) {
if (v && typeof v === 'object' && !Array.isArray(v)) {
 return Object.assign(Object.create(null), v);
}
return v;
});
    console.log(agendamento);
    jQuery(document).ready(function(){        
            $.ajax({
            url: '/register-exame-schedule',
            type: 'POST',
            data: {data: dados},
            success: function(result){
            // Retorno se tudo ocorreu normalmente
           console.log('sucesso');
            },
            error: function(jqXHR, textStatus, errorThrown) {
            // Retorno caso algum erro ocorra
            alert('erro');
            }
        });
                    
    });

    
});



});