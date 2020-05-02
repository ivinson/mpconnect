<?php
  require_once 'init.php';
  require_once $abs_us_root.$us_url_root.'users/includes/header.php';
  require_once $abs_us_root.$us_url_root.'users/includes/navigation.php';

  if (!securePage($_SERVER['PHP_SELF'])){die();}
    if($settings->messaging != 1){
      Redirect::to('account.php?err=Messaging+is+disabled');
   }

//dump($_POST);

if(!empty($_POST)){
  
  
  $date = date("Y-m-d H:i:s");
  
  
//   id,
//   datainicio,
//   datafim,
//   idtipoatividadea,
//   publicoestimado,
//   local,
//   idcidade,
//   agendadopor,
  
//   status,
//   qtddecisao,
//   qtdinteresse,
//   qtdreconciliacao,
//   qtdconsagracao,

//   radio,  
//   televisao,
//   internet,

//   fichasregistradasnoevento,
//   acompanhamento_pos,
//   qtdligacoes_para_interessados,
//   qtddiscipulado,
//   descricaogeral
  
  $radio      = "off";
  $televisao  = "off";
  $internet   = "off";

  if(Input::get('chkradio') == "on"){    
    $radio = "on";
  }
  if(Input::get('chktelevisao') == "on"){    
    $televisao = "on";
  }
  if(Input::get('chkinternet') == "on"){    
    $internet = "on";
  }
  
//     echo "<pre>".    Input::get('chkradio') . "</pre>";
//   echo "<pre>".    Input::get('chktelevisao') . "</pre>";
//   echo "<pre>".    Input::get('chkinternet') . "</pre>";

$dateinicio = strtr(Input::get("txtDataInicio") , '/', '-');
$dt = date('Y-m-d', strtotime($dateinicio));
  
  $thread = array(
//     'datainicio'    => date('Y-m-d H:i:s',strtotime(Input::get("dtinicio"))),
//     'datafim'      => date('Y-m-d H:i:s',strtotime(Input::get("dtfim"))),
//     'idtipoatividadea' => Input::get('tipoatividade'),
//     'publicoestimado' => Input::get('publicoestimado'),
//     'local' => Input::get('local'),
//     'idcidade' => $user->data()->idcidade,
//     'agendadopor' => $user->data()->id,
    'id'                  => Input::get('IDA'),
    'status'              => 'feedback',
    'qtddecisao'          => Input::get('qtddecisao'),
    'qtdinteresse'        => Input::get('qtdinteresse'),
    'qtdreconciliacao'    => Input::get('qtdreconciliacao'),
    'qtdconsagracao'      => Input::get('qtdconsagracao'),
    'fichasregistradasnoevento'         => Input::get('fichasregistradasnoevento'),
    'acompanhamento_pos'                => Input::get('acompanhamento_pos'),
    'qtdligacoes_para_interessados'     => Input::get('qtdligacoes_para_interessados'),
    'qtddiscipulado'      => Input::get('qtddiscipulado'),
    'descricaogeral'      => Input::get('descricaogeral'),
    'local'               => Input::get('txtlocal'),
    'datainicio'               => $dt,
    'radio'               => $radio,  
    'televisao'           => $televisao,
    'internet'            => $internet
    
  );
  
//   echo "<pre>".    dump($thread) . "</pre>";
//   echo "<pre>".    Input::get('chkradio') . "</pre>";
//   echo "<pre>".    Input::get('chktelevisao') . "</pre>";
//   echo "<pre>".    Input::get('chkinternet') . "</pre>";
  
  
  
  //die();
  
  
  $Id = Input::get('IDA');
    // die();
    $db->update('atividadescidade',$Id,$thread);
    $successes[]='Feedback atualizado.';
//     die();
//   $db->insert('atividadescidade',$thread);
  Redirect::to('feedback_atividades_ministeriais.php?msg=<h1>Feito!</h1>');
}


//$user->data()->idcidade

$atividade = $db->query("
SELECT *,a.id as IDA FROM 
         atividadescidade a
    join tipoatividade b on (a.idtipoatividadea = b.id)
        WHERE a.id = ? ",array($_GET['id']));

$ativ =  $atividade->results();


  $radio      = "";
  $televisao  = "";
  $internet   = "";

  if($ativ[0]->radio == "on"){    
    $radio = "checked";
  }
  if($ativ[0]->televisao == "on"){    
    $televisao = "checked";
  }
  if($ativ[0]->internet == "on"){    
    $internet = "checked";
  }



//  var_dump($ativ);

// echo '-----'. utf8_encode($ativ[0]->descricaocurta);



?>
<!--     <div class="block-header">
      <h2>RELATÓRIO MINISTERIAL - PREENCHIMENTO</h2>
    </div> -->

    <!-- Tabs With Icon Title -->
    <div class="row clearfix">
      <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <div class="card">
          <div class="header bg-teal">
            <h2>

              <span class="font-20 badge bg-teal">  <?=utf8_encode($ativ[0]->descricaocurta)?> 
                      </span>
            </h2>
          </div>
          <div class="body">
            
            
            
            
            
            
            
            
            <!-- Nav tabs -->
            <ul class="nav nav-tabs " role="tablist">
              <li role="presentation" class=" active">
                <a href="#home_with_icon_title" data-toggle="tab" id="tab_info">
                                        <i class="material-icons  ">description</i> INFORMAÇÕES GERAIS
                                    </a>
              </li>
              <li role="presentation">
                <a href="#profile_with_icon_title" data-toggle="tab" id="tab_fichas">
                 <i class="material-icons">list</i> 1 - FICHAS</a>
              </li>
              <li role="presentation">
                <a href="#messages_with_icon_title" data-toggle="tab" id="tab_divulgacao">
                                        <i class="material-icons">record_voice_over</i>2 -  DIVULGAÇÃO
                                    </a>
              </li>
<!--               <li role="presentation">
                <a href="#settings_with_icon_title" data-toggle="tab" id="tab_midia">
                                        <i class="material-icons">settings</i> FOTOS E VIDEOS
                                    </a>
              </li> -->
              <li role="presentation">
                <a href="#descricao_tab" data-toggle="tab" id="tab_description">
                                        <i class="material-icons">speaker_notes</i> 3 - COMO FOI
                                    </a>
              </li>
            </ul>

            
<form role="form" action='edit-feedback_atividades_ministeriais.php' method='post'>            
  
   <input type="hidden" id="IDA" name="IDA" value="<?=$ativ[0]->IDA?>">
            
<!-- Tab panes -->
<div class="tab-content">
  <div role="tabpanel" class="tab-pane fade in active" id="home_with_icon_title">

    
    
    
    <!-- LINHA 001 -->
    <div class="row">
      <div class="col-md-12">
        <div class="alert bg-teal"> INFORMAÇÕES GERAIS</div>
                    
                    
              <div class="col-md-4">
                  <b>Data do evento</b>
                  <div class="input-group">
                      <span class="input-group-addon">
                          <i class="material-icons">date_range</i>
                      </span>


                      <!-- <div class="col-md-6">
                      <label for="Inicio em">
                        Inicio em :
                      </label>
                      <input id="dtinicio" name="dtinicio" type="text"  class="form-control input-md" value=''>
                      </div> -->


                      <div class="form-line">
                          <input type="text"  name="txtDataInicio" id="txtDataInicio" class="form-control date" value="<?php 
  
  
                $date = new DateTime($ativ[0]->datainicio);
                echo $date->format('d/m/Y');
                                                                              
                                                                              ?>" >
                      </div>
                  </div>
              </div>

              <div class="col-md-4">
                  <b>Local do evento</b>
                  <div class="input-group">
                      <span class="input-group-addon">
                          <i class="material-icons">map</i>
                      </span>
                      <div class="form-line">
                          <input  name="txtlocal" type="text" class="form-control date" value="<?=$ativ[0]->local?>" >
                      </div>
                  </div>
              </div>

              <div class="col-md-4">
                  <b>Agendado por</b>
                  <div class="input-group">
                      <span class="input-group-addon">
                          <i class="material-icons">account_circle</i>
                      </span>
                      <div class="form-line">
                          <input type="text" class="form-control date" value="<?=echousername($ativ[0]->agendadopor)?>" disabled>
                      </div>
                  </div>
              </div>                    
                    
            </div>
          </div>
          <!-- Fim linha 001 -->


<!--     <div class="form-group">
      <a role="presentation" type="button" onclick="bNext('tab_fichas');" href="#profile_with_icon_title" data-toggle="tab" class="btn btn-info">
          <i class="fa fa-plus fa-1x" ></i> Proxima 
      </a>
    </div> -->


</div>
              <div role="tabpanel" class="tab-pane fade" id="profile_with_icon_title">



                <!-- 
                                  //     `atividadescidade`.`fichasregistradasnoevento`,
                                  //     `atividadescidade`.`qtddecisao`,
                                  //     `atividadescidade`.`qtdinteresse`,
                                  //     `atividadescidade`.`qtdreconciliacao`,
                                  //     `atividadescidade`.`qtdconsagracao`,
                                  //     `atividadescidade`.`qtdligacoes_para_interessados`,
                                  //     `atividadescidade`.`qtddiscipulado`,
                                  //     `atividadescidade`.`acompanhamento_pos` -->


                <div class="row clearfix">
                  <div class="col-md-12">
                    <div class="alert bg-teal">
                      Foi distribuido fichas de decisão?</div>
                    <div class="switch">
                      <label>NÃO
                          <input type="checkbox" name="termoadesao" id="termoadesao" onchange="view_form();"  >
                        <span class="lever"></span>SIM</label>
                    </div>
                    <!-- </div> -->

                    <br><br>
                    <div class="painel_fichas" style="display: none ;">
                      <!-- LINHA 001 -->
                      <div class="row">

                        <div class="col-md-3">
                          <label for="publicoestimado">Quantas fichas recolheram?</label>
                          <input class="form-control" id="fichasregistradasnoevento" name="fichasregistradasnoevento" value="<?=$ativ[0]->fichasregistradasnoevento?> " />
                        </div>

                        <div class="col-md-3">
                          <label for="publicoestimado">Decisões</label>
                          <input class="form-control" id="qtddecisao" name="qtddecisao" value="<?=$ativ[0]->qtddecisao?>" />
                        </div>

                        <div class="col-md-3">
                          <label for="publicoestimado">Interesse</label>
                          <input class="form-control" id="qtdinteresse" name="qtdinteresse" value="<?=$ativ[0]->qtdinteresse?>" />
                        </div>

                        <div class="col-md-3">
                          <label for="publicoestimado">Reconciliação</label>
                          <input class="form-control" id="qtdreconciliacao" name="qtdreconciliacao" value="<?=$ativ[0]->qtdreconciliacao?>" />
                        </div>

                        <div class="col-md-3">
                          <label for="publicoestimado">Quantas ligações</label>
                          <input class="form-control" id="qtdligacoes_para_interessados" name="qtdligacoes_para_interessados" value="<?=$ativ[0]->qtdligacoes_para_interessados?>" />
                        </div>

                        <div class="col-md-3">
                          <label for="publicoestimado">Discipulados</label>
                          <input class="form-control" id="qtddiscipulado" name="qtddiscipulado" value="<?=$ativ[0]->qtddiscipulado?>" />
                        </div>
                        
                        <div class="col-md-3">
                          <label for="publicoestimado">Consagrações</label>
                          <input class="form-control" id="qtdconsagracao" name="qtdconsagracao" value="<?=$ativ[0]->qtdconsagracao?>" />
                        </div>

                        <div class="col-md-3">
                          <label for="publicoestimado">Acompanhamento pós-evento</label>
                          <input class="form-control" id="acompanhamento_pos" name="acompanhamento_pos" value="<?=$ativ[0]->acompanhamento_pos?>" />
                        </div>


                      </div>
                      <!-- Fim linha 001 -->




                    </div>
                  </div>
                </div>


<!-- <div class="form-group">
  <a role="presentation" type="button" onclick="bBack('tab_info');" href="#profile_with_icon_title" data-toggle="tab" class="btn btn-info">
  <i class="fa fa-plus fa-1x" ></i> Anterior 
  </a>
  <a role="presentation" type="button" onclick="bNext('tab_divulgacao');" href="#profile_with_icon_title" data-toggle="tab" class="btn btn-success">
  <i class="fa fa-plus fa-1x" ></i> Proxima 
  </a>


</div> -->
              </div>
  
  
  
              <div role="tabpanel" class="tab-pane fade" id="messages_with_icon_title">
                <div class="alert bg-teal">SOBRE A DIVULGAÇÃO</div>
                <p>

                  <div class="col-md-4">
                    <label for="publicoestimado">Radio</label>
                    <div class="switch">
                      <label>NÃO
                          <input type="checkbox" name="chkradio" id="chkradio" <?=$radio?>  >
                        <span class="lever"></span>SIM</label>
                    </div>
                  </div>

                  <div class="col-md-4">
                    <label for="publicoestimado">Televisão</label>
                    <div class="switch">
                      <label>NÃO
                        <input type="checkbox" name="chktelevisao" id="chktelevisao"  <?=$televisao?> >
                      <span class="lever"></span>SIM</label>
                    </div>
                  </div>

                  <div class="col-md-4">
                    <label for="publicoestimado"> Internet</label>
                    <div class="switch">
                      <label>NÃO
                      <input type="checkbox" name="chkinternet" id="chkinternet"  <?=$internet?>>
                    <span class="lever"></span>SIM</label>
                    </div>
                  </div>


                </p>
          
<!--                 <div class="form-group">
                  <a role="presentation" type="button" onclick="bNext('tab_fichas');" href="#profile_with_icon_title" data-toggle="tab" class="btn btn-success">
                                          <i class="fa fa-plus fa-1x" ></i> Proxima 
                                        </a>
                  <a role="presentation" type="button" onclick="bBack('tab_info');" href="#profile_with_icon_title" data-toggle="tab" class="btn btn-success">
                                          <i class="fa fa-plus fa-1x" ></i> Proxima 
                                        </a>

                </div> -->

  <br><br>
              </div>
<!--               <div role="tabpanel" class="tab-pane fade" id="settings_with_icon_title">
                <div class="row clearfix">
                  <div class="col-md-12">


                    <div class="alert bg-green">MIDIA KIT - TEM REGISTRO EM FOTO OU VIDEO DESSE EVENTO?</div>



                    <div class="row">
                      <div class="col-md-2">
                        <div class="switch">
                          <label>NÃO
                                            <input type="checkbox" name="termoadesao" id="termoadesao" onchange="view_form_upload();"  >
                                          <span class="lever"></span>SIM</label>
                        </div>
                      </div>

                      <div class="painel_upload" style="display: none ;">

                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                          <div class="card">
                            <div class="header">
                              <h2>
                                COLE A URL DA IMAGEM AQUI
                                <small>Por exemplo, se a imagem estiver no facebook, clique com o botao direito na imagem e clique em "Copiar endefreço da imagem"</small>
                              </h2>
                              <ul class="header-dropdown m-r--5">
                                <li class="dropdown">
                                  <a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                                        <i class="material-icons">more_vert</i>
                                    </a>
                                  <ul class="dropdown-menu pull-right">
                                    <li><a href="javascript:void(0);" class=" waves-effect waves-block">Action</a></li>
                                    <li><a href="javascript:void(0);" class=" waves-effect waves-block">Another action</a></li>
                                    <li><a href="javascript:void(0);" class=" waves-effect waves-block">Something else here</a></li>
                                  </ul>
                                </li>
                              </ul>
                            </div>
                            <div class="body">
                              <div class="row">
                                <div class="col-xs-6 col-md-3">
                                  <a href="javascript:void(0);" class="thumbnail">
                                        <img src="http://placehold.it/500x300" class="img-responsive">
                                    </a>
                                </div>
                                <div class="col-xs-6 col-md-3">
                                  <a href="javascript:void(0);" class="thumbnail">
                                        <img src="http://placehold.it/500x300" class="img-responsive">
                                    </a>
                                </div>
                                <div class="col-xs-6 col-md-3">
                                  <a href="javascript:void(0);" class="thumbnail">
                                        <img src="http://placehold.it/500x300" class="img-responsive">
                                    </a>
                                </div>
                                <div class="col-xs-6 col-md-3">
                                  <a href="javascript:void(0);" class="thumbnail">
                                        <img src="http://placehold.it/500x300" class="img-responsive">
                                    </a>
                                </div>
                              </div>
                            </div>
                          </div>
                        </div>



                      </div>














                    </div>


                  </div>
                </div> -->
<!--               </div> -->



              <!--                                 <div role="tabpanel" class="tab-pane fade" id="messages_with_icon_title"> -->
              <div role="tabpanel" class="tab-pane fade" id="descricao_tab">



                <div class="alert bg-teal"> CONTE COMO FOI O EVENTO NO GERAL</div>

                <!-- LINHA 002 -->
                <div class="row">
                  <div class="col-md-12">

<!--                     <input class="form-control" id="descricaogeral" name="descricaogeral" /> -->
            <h2 class="card-inside-title">Observações </h2>        
<div class="row clearfix">
    <div class="col-sm-12">
        <div class="form-group">
            <div class="form-line">
                <textarea  id="descricaogeral" name="descricaogeral" rows="8" class="form-control no-resize" placeholder="Digite aqui tudo o que quiser sobre esse evento que estamos fazendo o feedback... Seus gestores estão anciosos para saber como foi e celebrar com você."><?=$ativ[0]->descricaogeral?></textarea>
            </div>
        </div>
                    
                    
                    <button type="submit" class="btn bg-indigo waves-effect">
                                    <i class="material-icons">trending_up</i>
                                    <span>ENVIAR FEEDBACK</span>
                                </button>
      
          </div>
</div>  
      
                    
                  </div>
                </div>
                <!-- Fim linha 002 -->

<!--                 <div class="form-group">
                  <a role="presentation" type="button" onclick="bNext('tab_fichas');" href="#profile_with_icon_title" data-toggle="tab" class="btn btn-success">
                                      <i class="fa fa-plus fa-1x" ></i> Proxima 
                                  </a>


                </div> -->


              </div>


            </div>

</form>


          </div>

        </div>
      </div>



    </div>







    <!-- footers -->
    <?php require_once $abs_us_root.$us_url_root.'users/includes/page_footer.php'; // the final html footer copyright row + the external js calls ?>

    <!-- Place any per-page javascript here -->

    <?php require_once $abs_us_root.$us_url_root.'users/includes/html_footer.php'; // currently just the closing /body and /html ?>

    <script type="text/javascript">
      $(function() {  

        $('#txtDataInicio').bootstrapMaterialDatePicker({ 
          
          format : 'DD/MM/YYYY', 
          time: false,
          minDate : new Date(2019, 1, 1) 
          
          });
// $('#dtfim').bootstrapMaterialDatePicker({ format : 'DD/MM/YYYY', time: false});



          // $('#txtDataInicio').datepicker({
          //     dateFormat: 'dd/mm/yyyy'
          // });
      //     $('#dtfim').datepicker({
      //         dateFormat: 'dd/mm/yyyy'
      //     });


        //  $("#txtDataInicio").mask("99/99/9999");
      //    $("#dtfim").mask("99/99/9999");
      // $('#txtDataInicio').bootstrapMaterialDatePicker({ format : 'DD/MM/YYYY', time: false});

      });   

      function bNext(tabname) {
        $("#" + tabname).click();
      }


      // $('#dtinicio').bootstrapMaterialDatePicker({
      //   format: 'DD/MM/YYYY',
      //   time: false,

      // });
      // $('#dtfim').bootstrapMaterialDatePicker({
      //   format: 'DD/MM/YYYY',
      //   time: false
      // });

      function view_form() {
        $('.painel_fichas').toggle();
      }

      function view_form_upload() {
        // $('.painel_fichas').toggle();
        $('.painel_upload').toggle();
      }
    </script>