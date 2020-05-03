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

  if(!empty($_REQUEST['act'] )){  
      $id_atividade = $_REQUEST['id_atividade'];
      //  echo "oooooooooo " . $id_atividade;  
      //echo $msg = "Msg -> ".  
//         $db->query("update atividadescidade  set status = 'cancelado' where id = ". $id_atividade)->results();
    
      $fields=array('status'=>'cancelado');
      $db->update('atividadescidade',$id_atividade,$fields);

  }




if(!empty($_POST)){
  
  
  
  $dateinicio = strtr(Input::get("dtinicio") , '/', '-');
  $datefim = strtr(Input::get("dtfim") , '/', '-');
//   echo " <br> -- ". date('Y-m-d', strtotime($dateinicio));
//   echo " <br> -- ". date('Y-m-d', strtotime($datefim));
  
  
  //$date = date("Y-m-d H:i:s");
//   echo Input::get("dtinicio") . ' 00:00:00';
//   echo "<br>";
//   echo date('d/m/Y',strtotime(Input::get("dtinicio")));

  $thread = array(
    'datainicio'    => date('Y-m-d', strtotime($dateinicio)),
//     'datainicio'      => Input::get("dtinicio") . ' 00:00:00',
//     'datafim'      => Input::get("dtfim") . ' 00:00:00',
    'datafim'      => date('Y-m-d', strtotime($datefim)),
    'idtipoatividadea' => Input::get('tipoatividade'),
    'publicoestimado' => Input::get('publicoestimado'),
    'local' => Input::get('local'),
    'status' => 'agendado',
    'idcidade' => $user->data()->idcidade,
    'agendadopor' => $user->data()->id,
    
  );

//     dump($thread);
  //die();
     $db->insert('atividadescidade',$thread);
  
  Redirect::to('agendamento.php?msg=<h1>Feito!</h1>');
}

//Cidades e Funcoes
$tbtipo = $db->query("SELECT * FROM tipoatividade order by descricaocurta");
$selectTipo = "";
foreach ($tbtipo->results() as $row) {
    $selectTipo = $selectTipo . "<option value={$row->id}> 
    ".  utf8_encode($row->descricaocurta)." </option>";
}

$messagesQ = $db->query("
SELECT *, a.id as id_atividade FROM 
         atividadescidade a
    join tipoatividade b on (a.idtipoatividadea = b.id)

 WHERE idcidade = ?  and status <> 'cancelado'  ORDER BY a.id DESC",array($user->data()->idcidade));
$messages =  $messagesQ->results();

?>
<div class="block-header">
    <h2>AGENDAMENTO DE ATIVIDADES</h2>
</div>


            <!-- Tabs With Icon Title -->
            <div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="body">
                            <!-- Nav tabs -->
                            <ul class="nav nav-tabs" role="tablist">
                                <li role="presentation" class="active">
                                    <a href="#home_with_icon_title" data-toggle="tab">
                                        <i class="material-icons">assignment_turned_in</i> AGENDAR NOVA ATIVIDADE
                                    </a>
                                </li>
                                <li role="presentation">
                                    <a href="#profile_with_icon_title" data-toggle="tab">
                                        <i class="material-icons">timeline</i> EVENTOS AGENDADOS
                                    </a>
                                </li>

                            </ul>

    <!-- Tab panes -->
    <div class="tab-content">
        <div role="tabpanel" class="tab-pane fade in active" id="home_with_icon_title">
            <div class="header">
              <h2>
                  AGENDAMENTO
                  <small> Aqui é onde os eventos e atividades que constarão em seu relatório ministerial devem ser agendados.Tambem serão mostrados na agenda do Site da MPC</small>
              </h2>
            </div>              
               
            <div class="body">

              <div class="row">
                <div class="col-md-12">
                  <form role="form" action='agendamento.php' method='post'>
                    
                    <div class="form-group">
                       
                      <label for="tipoevento">
                        Qual atividade/evento irá fazer?
                      </label>
                      <select name="tipoatividade" style="width: 260px;">
                        <?=$selectTipo;?>
                      </select>
                    </div>


                      <div class="row">
                      <div class="col-md-8">
                       
                      <label for="Local">
                        Local do evento (Nome da Escola, igreja, espaço)
                      </label>
                      <input name="local"  class="form-control" id="local" />
                      </div>
                      <div class="col-md-4">
                       
                      <label for="publicoestimado">
                        Quantas pessoas participarão?
                      </label>
                      <input class="form-control" id="publicoestimado" name="publicoestimado" />
                      </div>

                  </div>

                    <div class="row">
                      <div class="col-md-6">
                      <label for="Inicio em">
                        Inicio em :
                      </label>
                      <input id="dtinicio" name="dtinicio" type="text"  class="form-control input-md" value=''>
                      </div>
                      <div class="col-md-6">                    
                      <label for="Termino em">
                        Termino em:
                      </label>
                      <input id="dtfim"   name="dtfim" type="text" class="form-control input-md" value=''>
            </div>
                    </div>

<!--                     <div class="col-md-3">
                      <label >
                        MOSTRAR NO SITE?
                      </label>
                                    <div class="switch">
                                    <label>NÃO<input type="checkbox" name="chksite">
                                        <span class="lever"></span>SIM</label>
                                    </div>
                      </div> -->




                      <div class="form-group">       
                      <button type="submit" class="btn btn-success" name="criar_agendamento">
                          <i class="fa fa-plus fa-1x" ></i> AGENDAR 
                      </button>
                      </div>


                  </form>
                </div>
              </div>
            </div>




          
            </div>
            <div role="tabpanel" class="tab-pane fade" id="profile_with_icon_title">
          
              <div class="panel-group">
                <div class="panel panel-default">
                  <div class="panel-heading">
                    <h4 class="panel-title">
                      <a data-toggle="collapse" href="#collapse1">Atividades/Eventos agendados</a>
                    </h4>
                  </div>
                  <div id="collapse1" class="panel-collapse collapse in">
                    <div class="panel-body">

                      <!-- Content Goes Here. Class width can be adjusted -->
                      <table class="table table-hover">
                        <thead>
                          <tr>
                            <th>Evento</th>
                            <th>Data</th>
                            <th></th>
<!--                             <th>Público</th> -->
                          </tr>
                        </thead>
                        <tbody>


                          <tr>
                        <?php 
                            
                            
//                             dump($messages);

                            foreach($messages as $m){  
                              $dataEvento =  date('d/m/Y',strtotime($m->datainicio));
                        ?>            
                            <td>
                              <b><?= utf8_encode($m->descricaocurta)."( ".$m->local.")"?></b>
                              <br>  <?= utf8_encode($m->status)?> por
                              <?= echousername($m->agendadopor)?>
                              </td>
                              <td><?=$dataEvento?></td>
                            
                            <?php if ($m->status == 'agendado') {  ?>
                            
                            <td> 
                              <!-- <?=$m->status?>   -->
                            <a class="btn btn-danger" href="agendamento.php?act=cancel&id_atividade=<?=$m->id_atividade;?>"> Cancelar Agendamento</a></td> 
                              
                            <?php } else { ?>
                            <td>  Não pode ser cancelado </td> 
                            <?php } ?>
                            
                              </tr>
                              <?php } //end foreach ?>
                            </tbody>
                          </table>
                          <!-- End of main content section -->        


                    </div>
                    <div class="panel-footer"></div>
                  </div>
                </div>
              </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- #END# Tabs With Icon Title -->




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

$('#dtinicio').bootstrapMaterialDatePicker({ format : 'DD/MM/YYYY', time: false});
$('#dtfim').bootstrapMaterialDatePicker({ format : 'DD/MM/YYYY', time: false});


</script>