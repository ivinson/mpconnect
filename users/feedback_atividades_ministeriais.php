<?php
require_once 'init.php';
require_once $abs_us_root.$us_url_root.'users/includes/header.php';
require_once $abs_us_root.$us_url_root.'users/includes/navigation.php';
?>


<?php

  if(!empty($_REQUEST['act'] )){  
      $id_atividade = $_REQUEST['id_atividade'];
      //  echo "oooooooooo " . $id_atividade;  
      //echo $msg = "Msg -> ".  
//         $db->query("update atividadescidade  set status = 'cancelado' where id = ". $id_atividade)->results();
    
      $fields=array('status'=>'cancelado');
      $db->update('atividadescidade',$id_atividade,$fields);

  }





$messagesQ = $db->query("
SELECT *,a.id as IDA FROM 
         atividadescidade a
    join tipoatividade b on (a.idtipoatividadea = b.id)

 WHERE agendadopor = ?  ORDER BY a.id DESC",array($user->data()->id));
$messages =  $messagesQ->results();

?>
<!-- <div class="block-header">
    <h2><b>FEEDBACK</b> DE ATIVIDADES</h2>
</div>
 -->

            <!-- Tabs With Icon Title -->
            <div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="body">
                            <!-- Nav tabs -->
                            <ul class="nav nav-tabs" role="tablist">
                                <li role="presentation" class="active">
                                    <a href="#profile_with_icon_title" data-toggle="tab">
                                        <i class="material-icons">assignment_turned_in</i> 
                                         <b>FEEDBACK</b> DE ATIVIDADES
                                    </a>
                                </li>

                            </ul>

    <!-- Tab panes -->
    <div class="tab-content">
        <div role="tabpanel" class="tab-pane fade in active" id="profile_with_icon_title">
            
               
            <div class="body">

              <div class="row">
                <div class="col-12">
                  <form role="form" action='agendamento.php' method='post'>
                    

                      <table class="table table-hover">
   
                        <tbody>


                          <tr>
                        <?php 

                            foreach($messages as $m){
                              
//                               echo $m->status; 
                              
                              $dataEvento =  date('d/m/Y',strtotime($m->datainicio));
                        ?>            
                              <td><a href="edit-feedback_atividades_ministeriais.php?id=<?=$m->IDA?>"> 
                                
                                
                                <i class="material-icons">
                                  
                                  
                                <?php 
                              if($m->status == 'agendado'){
                                echo  'comment';
                              }else{
                                
                                echo 'done';
                              }
                                ?>
                                
                                
                                
                                </i> </a></td>
                              <td><?= utf8_encode($m->descricaocurta)."( ".$m->local.")"?></td>
                              <td><?=$dataEvento?></td>

                                                        <?php if ($m->status == 'agendado') {  ?>
                            
                            <td>  <a class="btn btn-danger" href="feedback_atividades_ministeriais.php?act=cancel&id_atividade=<?=$m->IDA;?>"> Cancelar Agendamento</a></td> 
                              
                            <?php } else { ?>
                            <td>  Não pode ser cancelado </td> 
                            <? } ?>
                              </tr>
                              <?php } //end foreach ?>
                            </tbody>
                          </table>
                          <!-- End of main content section -->   
         


                  </form>





                </div>
              </div>
              
              
              <?php 
              

                            //   var_dump($user->data()->idtipo);

//                  var_dump(  hasPerm([3],$user->data()->id));
           if( ( $user->data()->idtipo  == 8 ) || ( $user->data()->idtipo  == 9 ) || ( $user->data()->idtipo  == 7 ) || (hasPerm([3],$user->data()->id))) {
        //    if($user->data()->idtipo  == 7 ) {
              
              ?>
                  <a href="relatorio_mensal.php" type="button" class="btn-lg btn-success waves-effect">Fechar Relatório Mensal</a>              
              
              <?php 
           
           } ?>
              
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
