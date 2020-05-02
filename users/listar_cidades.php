<?php
  require_once 'init.php';
  require_once $abs_us_root.$us_url_root.'users/includes/header.php';
  require_once $abs_us_root.$us_url_root.'users/includes/navigation.php';
?>
  <style>
    .my-card {
      /* position:absolute;
    left:40%;
    top:-20px;
    border-radius:50%; */
    }

    a:hover {
      text-decoration: none;
    }

    a:visited {
      text-decoration: none;
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
    , count(users.id) as Usuarios
    , cidades.id

   from cidades
        join regioes on (cidades.idregiao = regioes.id)
        left outer join users on (users.idcidade = cidades.id)

 ". $swhere ."

  GROUP by cidades.idregiao, cidades.uf, cidades.nome_cidade
  order by cidades.idregiao, cidades.uf, cidades.nome_cidade
");

$messages =  $messagesQ->results();

?>
    <div class="block-header">
      <h3>CIDADES</h3>
    </div>

    <div class="row clearfix">


      <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
        <a href="listar_cidades.php">
          <div class="info-box bg-light-green hover-expand-effect">
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
        <a href="listar_cidades.php?filter=1">
          <div class="info-box bg-light-green hover-expand-effect">
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
        <a href="listar_cidades.php?filter=2">
          <div class="info-box bg-light-green hover-expand-effect">
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
        <a href="listar_cidades.php?filter=3">
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
        <a href="listar_cidades.php?filter=4">
          <div class="info-box bg-light-green hover-expand-effect">
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
        <a href="listar_cidades.php?filter=5">
          <div class="info-box bg-light-green hover-expand-effect">
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
        <a href="cidade.php">
          <div class="info-box bg-cyan hover-expand-effect">
            <div class="icon">
              <i class="material-icons">add</i>
            </div>
            <div class="content">
              <div class="text">INCLUIR NOVA CIDADE</div>
              <div class="number count-to" data-from="0" data-to="1225" data-speed="1000" data-fresh-interval="20"></div>
            </div>
          </div>
        </a>
      </div>      
      

    </div>


<a src="https://app.mpc.org.br/users/bolsas_cidades.php" > 
 <div class="icon">
              <i class="material-icons">chart</i>
            </div>
  Relatório de bolsas </a>



<div class="row clearfix">
	  <div class="col-12">
			<form class="">
				<!-- <label for="system-search">Search:</label> -->
				<div class="input-group">
                    <input class="form-control form-control-lg" style="font-size: 28px; height: 60px;"
                           id="system-search" name="q" placeholder="  Digite o nome da cidade " type="text">
        </div>
			</form>
		</div>

</div>



    <!-- Tabs With Icon Title -->
    <div class="row clearfix">
      <div class="col-12">
        <div class="card">
          <div class="body">

            <!-- Content Goes Here. Class width can be adjusted -->
            <table class="table table-hover" id="tbcidades">
              <thead>
                <tr>
                  <th>Região</th>
                  <th>Estado</th>
                  <th>Cidade</th>
                  <th>Qtd Usuarios</th>
                  <th></th>
                  <!--                             <th>Data Envio</th> -->
                  <!--                             <th>Lider</th> -->
                </tr>
              </thead>
              <tbody>
                <?php 
                    $tr = "";
                      foreach($messages as $m){                         
                        $tr = $tr . "<tr>";
                        $tr = $tr . "<td>".utf8_encode($m->Regiao) ."</td>";                        
                        $tr = $tr . "<td>".utf8_encode($m->Estado) ."</td>";
                        $tr = $tr . "<td>".utf8_encode($m->Cidade) ."</td>";
                        $tr = $tr . "<td>".utf8_encode($m->Usuarios) ."</td>";
                        $tr = $tr . "<td><a href='cidade.php?id=" . $m->id   ."' type='button' class='btn btn-info'>Editar</a></td>";
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

    <!-- footers -->
    <?php require_once $abs_us_root.$us_url_root.'users/includes/page_footer.php'; // the final html footer copyright row + the external js calls ?>

    <!-- Place any per-page javascript here -->

    <?php require_once $abs_us_root.$us_url_root.'users/includes/html_footer.php'; // currently just the closing /body and /html ?>

    <script type="text/javascript">
      $('#dtinicio').bootstrapMaterialDatePicker({
        format: 'DD/MM/YYYY',
        time: false
      });
      $('#dtfim').bootstrapMaterialDatePicker({
        format: 'DD/MM/YYYY',
        time: false
      });
      

    </script>
    <!-- Place any per-page javascript here -->


<script>
	$(document).ready(function() {
		$("#system-search").on("keyup", function() {

			//  $("#system-search").bind("keyup change", function(e) {
			// $("#system-search").on("keyup change", function() {
			var value = $(this).val().toLowerCase();
			// $("#myTable tr").filter(function() {
			//   $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
			// });
			// $("#ul-convidados li").filter(function() {
			$("#tbcidades tr ").filter(function() {
				$(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
			});
		});
	});
</script>
