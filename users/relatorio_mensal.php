<?php
require_once 'init.php';
require_once $abs_us_root.$us_url_root.'users/includes/header.php';
require_once $abs_us_root.$us_url_root.'users/includes/navigation.php';
?>

<?php if (!securePage($_SERVER['PHP_SELF'])){die();}
if($settings->messaging != 1){
  Redirect::to('account.php?err=Messaging+is+disabled');
}

//dump($_POST);


if(!empty($_POST)){
  
  
  //$date = date("Y-m-d H:i:s");

  $thread = array(
    'datainicio'    => date('Y-m-d H:i:s',strtotime(Input::get("dtinicio"))),
    'datafim'      => date('Y-m-d H:i:s',strtotime(Input::get("dtfim"))),
    'idtipoatividadea' => Input::get('tipoatividade'),
    'publicoestimado' => Input::get('publicoestimado'),
    'local' => Input::get('local'),
    'status' => 'agendado',
    'idcidade' => $user->data()->idcidade,
    'agendadopor' => $user->data()->id,
    
  );

  //dump($thread);
  //die();
//   $db->insert('atividadescidade',$thread);\
//   Redirect::to('agendamento.php?msg=<h1>Feito!</h1>');
}


?>


<?php

// $messagesQ = $db->query("
//       SELECT * FROM 
//                atividadescidade a
//           join tipoatividade b on (a.idtipoatividadea = b.id)
//               WHERE id = ? ORDER BY a.id DESC",$_GET['mes']);

// $messages =  $messagesQ->results();

// foreach($messages as $m){  
//       //$dataEvento =  date('d/m/Y',strtotime($m->datainicio));
//       //<td><?= utf8_encode($m->descricaocurta)."( ".$m->local.")"
//       //echo "{$m->idcidade}";
//      //} 

//     //Cidades e Funcoes
//     $tbtipo = $db->query("SELECT * FROM tipoatividade where id = {$m->idtipoatividadea} ");
//     foreach ($tbtipo->results() as $row ) {}
    
//   }

    //dump($messagesQ);

//     SELECT `atividadescidade`.`id`,
//     `atividadescidade`.`datainicio`,
//     `atividadescidade`.`datafim`,
//     `atividadescidade`.`idtipoatividadea`,
//     `atividadescidade`.`publicoestimado`,
//     `atividadescidade`.`local`,
//     `atividadescidade`.`status`,
//     `atividadescidade`.`idcidade`,

//     `atividadescidade`.`agendadopor`,

//     `atividadescidade`.`fichasregistradasnoevento`,
//     `atividadescidade`.`qtddecisao`,
//     `atividadescidade`.`qtdinteresse`,
//     `atividadescidade`.`qtdreconciliacao`,
//     `atividadescidade`.`qtdconsagracao`,
//     `atividadescidade`.`qtdligacoes_para_interessados`,
//     `atividadescidade`.`qtddiscipulado`,
//     `atividadescidade`.`acompanhamento_pos`


//     `atividadescidade`.`radio`,
//     `atividadescidade`.`televisao`,
//     `atividadescidade`.`internet`,


//     `atividadescidade`.`descricaogeral`
// FROM `mpconnect1`.`atividadescidade`;

// < ? = $row->descricaocurta ? >

 //} 



//echo $row->descricaocurta;


//dump($row);

?>


            <!-- Tabs With Icon Title -->
            <div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="header bg-indigo">
                            <h2>
                                Relatório Mensal                      
                            </h2>
                            
                        </div>
                      
                         
            <div class="body">
                            <form id="form_validation" method="POST" novalidate="novalidate">
                                

                              
                                              <!-- LINHA 002 -->
                <div class="row">
                  <div class="col-md-12">

<!--                     <input class="form-control" id="descricaogeral" name="descricaogeral" /> -->
            <h2 class="card-inside-title">   Referente ao mês </h2>        
<div class="row clearfix">
    <div class="col-sm-12">
        <div class="form-group">
            <div class="form-line">
              
<span>
     <select  onchange="reset_dpano(this);" name="dpmes" id="dpmes">
        <option value="0">Escolha um mês</option>
        <option value="1">Janeiro</option>
        <option value="2">Fevereiro</option>
        <option value="3">Março</option>
        <option value="4">Abril</option>
        <option value="5">Maio</option>
        <option value="6">Junho</option>
        <option value="7">Julho</option>
        <option value="8">Augosto</option>
        <option value="9">Septembro</option>
        <option value="10">Outubro</option>
        <option value="11">Novembro</option>
        <option value="12">Dezembro</option> -->
     </select> 
</span>
<span>
     <select name="dpano" id="dpano"  onchange="get_lista_atividades(this);">
     <option  value="0">Escolha uma data</option>
          <option  value="2020">2020</option>
          <option  value="2019">2019</option>
          <option value="2018">2018</option>
          <option value="2017">2017</option>                   
     </select>
</span>              
              
              
<!--             <input id="dtinicio" name="dtinicio" type="text"  class="form-control input-md" value=''> -->
            </div>
        </div>
                    
         
      
          </div>
</div>  
      
                    
                  </div>
                </div>
                              
                              
                   <!-- LINHA 002 -->
                                           
                              
                              
                              
                              
<!--                                 <div class="form-group form-float">
                                    <div class="form-line">
                                        <input type="text" class="form-control date">
                                        <label class="form-label">Data do preenchimento</label>
                                      
                                    </div>
                                </div> -->
<!--                               <div class="form-group form-float">
                                    <div class="form-line">
                                        <input type="text" class="form-control" name="name" required="" aria-required="true">
                                        <label class="form-label">Relatório preenchido por</label>
                                    </div>
                                </div> -->
     
                              <label>
                                Atividades de apoio realizadas neste mês
                              </label>
                              

<?php
// $messagesQ = $db->query("
// SELECT * FROM 
//          atividadescidade a
//     join tipoatividade b on (a.idtipoatividadea = b.id)

//  WHERE idcidade = ?  ORDER BY a.id DESC",array($user->data()->idcidade));
// $messages =  $messagesQ->results();

?>                      
              
                              <table class="table table-hover" id="tbatividades">
                        <tbody >


                          <tr>

                            </tbody>
                          </table>









<div id="divFechamento" style="display:none;">

                              
                              <!-- <div class="list-group"> -->
                                                                
                                <!-- <a href="javascript:void(0);" class="list-group-item"> -->
                                  <!-- <div class="row ">                                    
                                    <div class="col-sm-9">
                                        Aconselhamento
                                    </div>                                  
                                    <div class="col-sm-3 ">
                                      <div class="switch right">
                                        <label>Não<input type="checkbox"><span class="lever"></span>Sim</label>
                                         <label>Não<input type="checkbox" checked><span class="lever"></span>Sim</label> 
                                      </div>
                                    </div> 
                                    
                                  </div>
                                </a> -->
                                
                                <!-- <a href="javascript:void(0);" class="list-group-item">
                                  <div class="row ">
                                   <div class="col-sm-9">
                                    Reunião de Equipe
                                    </div>
                                   <div class="col-sm-3">
                                      <div class="switch right">
                                        <label>Não<input type="checkbox"><span class="lever"></span>Sim</label>
                                      </div>
                                    </div> 
                                  </div>
                                </a> -->
                                
                                <!-- <a href="javascript:void(0);" class="list-group-item">                                 
                                  <div class="row ">
                                   <div class="col-sm-9">
                                    Levantamento de Fundos
                                    </div>
                                   <div class="col-sm-3">
                                      <div class="switch right">
                                        <label>Não<input type="checkbox"><span class="lever"></span>Sim</label>
                                      </div>
                                    </div> 
                                  </div>
                                </a> -->
                                
<!--                                 <a href="javascript:void(0);" class="list-group-item">
                                  <div class="row ">
                                   <div class="col-sm-9">
                                    Discipulado
                                    </div>
                                   <div class="col-sm-3">
                                      <div class="switch right">
                                        <label>Não<input type="checkbox"><span class="lever"></span>Sim</label>
                                      </div>
                                    </div> 
                                  </div>                                    
                                </a> -->
                                
<!--                                 <a href="javascript:void(0);" class="list-group-item">
                                  <div class="row ">
                                   <div class="col-sm-9">
                                    Grupo Musical (ensaios)
                                    </div>
                                   <div class="col-sm-3">
                                      <div class="switch right">
                                        <label>Não<input type="checkbox"><span class="lever"></span>Sim</label>
                                      </div>
                                    </div> 
                                  </div>  
                                </a> -->
                                
<!--                                 <a href="javascript:void(0);" class="list-group-item">
                                  <div class="row ">
                                   <div class="col-sm-9">
                                    Grupo Teatral (ensaios)
                                    </div>
                                   <div class="col-sm-3">
                                      <div class="switch right">
                                        <label>Não<input type="checkbox"><span class="lever"></span>Sim</label>
                                      </div>
                                    </div> 
                                  </div>  
                                </a> -->
<!--                                 
                                <a href="javascript:void(0);" class="list-group-item">
                                  <div class="row ">
                                   <div class="col-sm-9">
                                    Consolidação de Frutos
                                    </div>
                                   <div class="col-sm-3">
                                      <div class="switch right">
                                        <label>Não<input type="checkbox"><span class="lever"></span>Sim</label>
                                      </div>
                                    </div> 
                                  </div>                                     
                                </a> -->
<!--                                 <a href="javascript:void(0);" class="list-group-item">
                                  <div class="row ">
                                   <div class="col-sm-9">
                                    Reunião com Direção da Escola
                                    </div>
                                   <div class="col-sm-3">
                                      <div class="switch right">
                                        <label>Não<input type="checkbox"><span class="lever"></span>Sim</label>
                                      </div>
                                    </div> 
                                  </div>                                        
                                </a> -->
                                
<!--                                 <a href="javascript:void(0);" class="list-group-item">
                                  <div class="row ">
                                   <div class="col-sm-9">
                                    Reunião de Oração
                                    </div>
                                   <div class="col-sm-3">
                                      <div class="switch right">
                                        <label>Não<input type="checkbox"><span class="lever"></span>Sim</label>
                                      </div>
                                    </div> 
                                  </div> 
                                </a> -->
                                
                            <!-- </div> -->


                              
<div class="row">
  <div class="col-md-12">

  <!--                     <input class="form-control" id="descricaogeral" name="descricaogeral" /> -->
    <h2 class="card-inside-title">Observações </h2>        
    <div class="row clearfix">
          <div class="col-sm-12">
                <div class="form-group">
                          <div class="form-line">
                          <textarea  id="descricaogeral" name="descricaogeral" rows="4" class="form-control no-resize" placeholder="Descreva os detalhes das atividades deste mês, avanços e dificuldades enfrentadas. Digite aqui tudo o que quiser falar sobre esse tempo. Seus gestores estão anciosos para saber como foi esse mês, celebrar junto e saber como ajudar sua equipe."></textarea>
                          </div>
                </div>
          </div>
    </div>  


  </div>
</div>                                                                                           

                              
<a href="javascript:set_novo_relatorio();" type="button" class="btn-lg btn-success waves-effect">Fechar Relatório Mensal</a> 
</form>

</div>

</div>
                      
                      
                      
                      
                      
                      
                      
                        

                    </div>
                </div>



            </div>







    <!-- footers -->
    <?php require_once $abs_us_root.$us_url_root.'users/includes/page_footer.php'; // the final html footer copyright row + the external js calls ?>

    <!-- Place any per-page javascript here -->

    <?php require_once $abs_us_root.$us_url_root.'users/includes/html_footer.php'; // currently just the closing /body and /html ?>

<script type="text/javascript">
  
// $(function() {              
//     $('#dtinicio').datepicker({
//         dateFormat: 'dd/mm/yyyy'
//     });
//     $('#dtfim').datepicker({
//         dateFormat: 'dd/mm/yyyy'
//     });


//    $("#dtinicio").mask("99/99/9999");
//    $("#dtfim").mask("99/99/9999");


// });   

// function bNext(tabname){
//   $("#"+tabname).click();
// }


$('#dtinicio').bootstrapMaterialDatePicker({ format : 'MM/YYYY', time: false, day:false});
// $('#dtfim').bootstrapMaterialDatePicker({ format : 'DD/MM/YYYY', time: false});

// function view_form(){
//  $('.painel_fichas').toggle();
// }

// function view_form_upload(){
//  // $('.painel_fichas').toggle();
//  $('.painel_upload').toggle();
//  }


function reset_dpano(){
  // $("#dpano").val(0);
 console.log('reset');
 $(document).ready(function() {
    // $("#dpano option[value='0']").attr('selected', true);
    $("#dpano").val("0").trigger("change");
    // you need to specify id of combo to set right combo, if more than one combo
});

}



function get_lista_atividades(item){


  var ano = $( "#dpano option:selected" ).val();
  var mes = $( "#dpmes option:selected" ).val();
  // var idcidade = 17;
  // alert(item);
   $(document).ready(function() {
    $.ajax({
              url: "process-relatorio.php?act=atividades-mes&ano="+ano + "&mes="+mes, 
             type: "POST",
          // data: "idcidade=" + item ,					
         dataType: "html",		
      success: function(resposta) {
            var table = $('#tbatividades');
            table.find("tbody tr").remove();
            // table.find("tbody tr h2").remove();
            table.append(resposta);

            var valida = $("#tbatividades").find("h2:contains('##3333')").parent().length; 
            console.log(valida);
             if ( valida == 0 ) {
               get_valida_mes();
             }else{
              $("#divFechamento").hide();

             }

      },
      beforeSend: function(){
        // $('.loader').css({display:"block"});
      },
      complete: function(){
        // $('.loader').css({display:"none"});
      }
    });
    });
}


function get_valida_mes(item){


var ano = $( "#dpano option:selected" ).val();
var mes = $( "#dpmes option:selected" ).val();
// var idcidade = 17;
// alert(item);
 $(document).ready(function() {
  $.ajax({
            url: "process-relatorio.php?act=validar-mes-fechamento&ano="+ano + "&mes="+mes, 
           type: "POST",
       dataType: "html",		
    success: function(resposta) {
          // var table = $('#tbatividades');
          // table.find("tbody tr").remove();
          // table.find("tbody tr h2").remove();
          // table.append(resposta);
          console.log( resposta );
          if(resposta == "true"){
            $("#divFechamento").show();
          }else{
            $("#divFechamento").hide();
          }
    },
    beforeSend: function(){
      // $('.loader').css({display:"block"});
    },
    complete: function(){
      // $('.loader').css({display:"none"});
    }
  });
  });
}




    //	Inserir um novo plano
    function set_novo_relatorio() {      
       
      // var descricao   = encodeURIComponent( $("#descricaogeral").val());
      var descricao   = $("#descricaogeral").val();
      var ano = $("#dpano option:selected").val();
      var mes = $("#dpmes option:selected").val();
      // var idcidade = 17;

      $.ajax({
         url: "process-relatorio.php?act=fechar-relatorio-mes&ano="+ano + "&mes="+mes + "&descricao="+descricao, 
        type: "POST"
        // data: "descricao="  + descricao    
        ,dataType: "html"
      }).done(function(resposta) {
        console.log(resposta);
        window.location.href = "relatorios_cidade.php?id="+resposta;
      }).fail(function(jqXHR, textStatus) {
        // console.log("Request failed: " + textStatus);

      }).always(function() {
//         console.log("completou");
        

      });

      
  }
  
  

</script>