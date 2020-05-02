<?php
  require_once 'init.php';
  require_once $abs_us_root.$us_url_root.'users/includes/header.php';
  require_once $abs_us_root.$us_url_root.'users/includes/navigation.php';
?>
<style> 
.my-card
{
    /* position:absolute;
    left:40%;
    top:-20px;
    border-radius:50%; */
}
a:hover{
    text-decoration:none;
}

a:visited{
    text-decoration:none;
}
</style>
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


if(isset($_GET['filter']) ){
    $swhere = " where regioes.id =  ". $_GET['filter'];
}else{
    $swhere = "";
}

$messagesQ = $db->query("
select 
      regioes.nome as Regiao
    , cidades.uf as Estado
    , cidades.nome_cidade as Cidade
    , Concat(relatoriomensal.mes,'/', relatoriomensal.ano) as Ref
    -- ,    relatoriomensal.*
    , relatoriomensal.dataenvio as DataEnvio
    , concat(users.fname,' ', users.lname) as ResponsavelFechamento
    , relatoriomensal.id as idrelatorio
    

   from relatoriomensal
        join cidades on (cidades.id = relatoriomensal.idcidade)
        join regioes on (cidades.idregiao = regioes.id)
        join users on (users.id = relatoriomensal.preenchidopor)

". $swhere ."

  order by cidades.idregiao, cidades.uf, cidades.nome_cidade,relatoriomensal.mes, relatoriomensal.ano
");





$messages =  $messagesQ->results();

?>
<div class="block-header">
    <h3>RELATÓRIOS MINISTERIAIS </h3>
</div>

<div class="row clearfix">


            <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                <a href="relatorios_regionais.php">
                <div class="info-box bg-pink hover-expand-effect">
                    <div class="icon">
                        <i class="material-icons">list</i>
                    </div>
                    <div class="content">
                        <div class="text">TODAS AS CIDADES</div>
                        <div class="number count-to" data-from="0" data-to="125" data-speed="15" data-fresh-interval="20"></div>
                    </div>
                </div>
                </a>

            </div>


                <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                    <a href="relatorios_regionais.php?filter=1">
                    <div class="info-box bg-pink hover-expand-effect">
                        <div class="icon">
                            <i class="material-icons">location_on</i>
                        </div>
                        <div class="content">
                            <div class="text">SUL</div>
                            <div class="number count-to" data-from="0" data-to="125" data-speed="15" data-fresh-interval="20"></div>
                        </div>
                    </div>
                    </a>

                </div>
                <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                <a href="relatorios_regionais.php?filter=2">
                    <div class="info-box bg-cyan hover-expand-effect">
                        <div class="icon">
                            <i class="material-icons">location_on</i>
                        </div>
                        <div class="content">
                            <div class="text">SUDESTE</div>
                            <div class="number count-to" data-from="0" data-to="257" data-speed="1000" data-fresh-interval="20"></div>
                        </div>
                    </div>
                    </a>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                <a href="relatorios_regionais.php?filter=3">
                    <div class="info-box bg-light-green hover-expand-effect">
                        <div class="icon">
                            <i class="material-icons">location_on</i>
                        </div>
                        <div class="content">
                            <div class="text">CENTRO-OESTE</div>
                            <div class="number count-to" data-from="0" data-to="243" data-speed="1000" data-fresh-interval="20"></div>
                        </div>
                    </div>
                </a>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                <a href="relatorios_regionais.php?filter=4">
                    <div class="info-box bg-orange hover-expand-effect">
                        <div class="icon">
                            <i class="material-icons">location_on</i>
                        </div>
                        <div class="content">
                            <div class="text">NORDESTE</div>
                            <div class="number count-to" data-from="0" data-to="1225" data-speed="1000" data-fresh-interval="20"></div>
                        </div>
                    </div>
                    </a>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                <a href="relatorios_regionais.php?filter=5">
                    <div class="info-box bg-orange hover-expand-effect">
                        <div class="icon">
                            <i class="material-icons">location_on</i>
                        </div>
                        <div class="content">
                            <div class="text">NORTE</div>
                            <div class="number count-to" data-from="0" data-to="1225" data-speed="1000" data-fresh-interval="20"></div>
                        </div>
                    </div>
                </a>
                </div>
  
  
       <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
        <a href="bolsas_cidades.php">
          <div class="info-box bg-cyan hover-expand-effect">
            <div class="icon">
              <i class="material-icons">description</i>
            </div>
            <div class="content">
              <div class="text"><h3>
                BOLSAS 2019
                
                </h3>
              </div>
              <div class="number count-to" data-from="0" data-to="1225" data-speed="1000" data-fresh-interval="20"></div>
            </div>
          </div>
        </a>
      </div>      
      

    </div>




<!-- Tabs With Icon Title -->
<div class="row clearfix">
    <div class="col-12">
        <div class="card">
            <div class="body">

                      <!-- Content Goes Here. Class width can be adjusted -->
                      <table class="table table-hover">
                        <thead>
                          <tr>
                            <th>Região</th>
                            <th>Estado</th>
                            <th>Cidade</th>
                            <th>Ref</th>
                            <th>Data Envio</th>
                            <th>Fechado por</th>
                          </tr>
                        </thead>
                        <tbody>
                  <?php 
                    $tr = "";
                      foreach($messages as $m){  
                       
                        // $dataEvento =  date('d/m/Y',strtotime($m->dataenvio));


                        // $tr = $tr . "<tr><td><img src='".$us_url_root."images/checked.png' width=40 height=40 class=rounded-circle>  Enviado em <b>{$m->DataEnvio}</b> por <b> ". echousername($m->ResponsavelFechamento)."</b></td>";
                        $tr = $tr . "<tr>";
                        $tr = $tr . "<td>".utf8_encode($m->Regiao) ."</td>";                        
                        $tr = $tr . "<td>".utf8_encode($m->Estado) ."</td>";
                        $tr = $tr . "<td>".utf8_encode($m->Cidade) ."</td>";
                        $tr = $tr . "<td><a href='detalhe_relatorio.php?idrelatorio=".$m->idrelatorio."'>".utf8_encode($m->Ref) ."</a></td>";
                        $tr = $tr . "<td>".utf8_encode($m->DataEnvio) ."</td>";
                        $tr = $tr . "<td>".utf8_encode($m->ResponsavelFechamento) ."</td>";                        
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
<!-- </div> -->
            <!-- #END# Tabs With Icon Title -->




    <!-- footers -->
    <?php require_once $abs_us_root.$us_url_root.'users/includes/page_footer.php'; // the final html footer copyright row + the external js calls ?>

    <!-- Place any per-page javascript here -->

    <?php require_once $abs_us_root.$us_url_root.'users/includes/html_footer.php'; // currently just the closing /body and /html ?>

<script type="text/javascript"> 

$('#dtinicio').bootstrapMaterialDatePicker({ format : 'DD/MM/YYYY', time: false});
$('#dtfim').bootstrapMaterialDatePicker({ format : 'DD/MM/YYYY', time: false});


</script>