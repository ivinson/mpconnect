<?php
require_once 'init.php';
require_once $abs_us_root.$us_url_root.'users/includes/header.php';
require_once $abs_us_root.$us_url_root.'users/includes/navigation.php';
?>

<?php if (!securePage($_SERVER['PHP_SELF'])){die();}
if($settings->messaging != 1){
  Redirect::to('account.php?err=Messaging+is+disabled');
}


//Cidades e Funcoes
$tbtipo = $db->query("SELECT * FROM tipoatividade order by descricaocurta");
$selectTipo = "";
foreach ($tbtipo->results() as $row) {
    $selectTipo = $selectTipo . "<option value={$row->id}> 
    ".  utf8_encode($row->descricaocurta)." </option>";
}
?>


<?php
$messagesQ = $db->query("

select relatoriomensal.id as idrelatorio, cidades.*,relatoriomensal.* from relatoriomensal
  join cidades on (cidades.id = relatoriomensal.idcidade)
        WHERE relatoriomensal.idcidade = ?  ORDER BY relatoriomensal.mes DESC",array($user->data()->idcidade));
$messages =  $messagesQ->results();

?>
<div class="block-header">
    <h3>RELATÓRIOS MINISTERIAIS </h3>
</div>


<!-- Tabs With Icon Title -->
<div class="row clearfix">
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <div class="card">
            <div class="body">

                      <!-- Content Goes Here. Class width can be adjusted -->
                      <table class="table table-hover">
                        <thead>
                          <tr>
                            <th></th>
                            <th>Cidade</th>
                            <th>Ref</th>
                          </tr>
                        </thead>
                        <tbody>
                  <?php 
                    $tr = "";
                      foreach($messages as $m){  
                       
                        $dataEvento =  date('d/m/Y',strtotime($m->dataenvio));


                        $tr = $tr . "<tr><td><img src='".$us_url_root."images/checked.png' width=40 height=40 class=rounded-circle>  Enviado em <b>{$dataEvento}</b> por <b> ". echousername($m->preenchidopor)."</b></td>";
                        $tr = $tr . "<td>".utf8_encode($m->nome_cidade) ."</td>";
                        $tr = $tr . "<td><a href='detalhe_relatorio.php?idrelatorio=".$m->idrelatorio."'>".$m->mes."/".$m->ano." </a></td>";
                        $tr = $tr . "</tr>";


                        } //end foreach 

                        echo $tr;
                  ?>
                      </tbody>
                          </table>
                          <!-- End of main content section -->        

                    </div>
                    <div class="panel-footer"></div>

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

$('#dtinicio').bootstrapMaterialDatePicker({ format : 'DD/MM/YYYY', time: false});
$('#dtfim').bootstrapMaterialDatePicker({ format : 'DD/MM/YYYY', time: false});


</script>