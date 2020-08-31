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


// if(isset($_GET['filter']) ){
//     $swhere = " and regioes.id =  ". $_GET['filter'];
// }else{
//     $swhere = "";
// }

$messagesQ = $db->query("
select

  -- cristao
  -- nap cristao
  -- appoio
      p.nome as projeto,
      tp.descricaocurta as atividade,
      sum(atv.publicoestimado) as estimado,
      sum(atv.qtddecisao) as decisao,
      sum(atv.qtdinteresse) as interesse,
      sum(atv.qtdreconciliacao) as reconciliacao,
      sum(atv.qtdconsagracao) as consagracao,
      sum(atv.qtdligacoes_para_interessados) as interessados,
      sum(atv.qtddiscipulado) as discipulado,
      sum( atv.acompanhamento_pos) as acompanhamento,
      sum( atv.fichasregistradasnoevento) as fichas,
      sum(atv.total_gasto) as custo,
      -- fichas
      count(atv.id) as totalatividades
  
  FROM atividadescidade atv 
  JOIN tipoatividade tp on (atv.idtipoatividadea = tp.id)
  JOIN projetos p on (p.id = tp.idprojeto)
  
where 

    year( atv.datainicio ) = 2019

    GROUP by p.nome, tp.id


");

$messages =  $messagesQ->results();

// dump($messages);
// die();


// $total_cidades_tot = count($messages);


// $total_cidades = $db->query("select idregiao, count(*) as total from cidades where status like 'ativo' group by idregiao")->results();


?>
    <div class="block-header">
      <h3>RELATORIO GERAL 2019</h3>
    </div>

    <div class="row clearfix">
    </div>


<div class="row clearfix">
	  <div class="col-12">
			<form class="">
				<!-- <label for="system-search">Search:</label> -->
				<div class="input-group">
                    <input class="form-control form-control-lg" style="font-size: 28px; height: 60px;"
                           id="system-search" name="q" placeholder="  Digite o nome do projeto ou atividade " type="text">
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


                  <th> projeto </th>
                  <th> atividade </th>
                  <th>  estimado</th>
                  <th>  decisao</th>
                  <th> interesse </th>
                  <th> reconciliacao </th>
                  <th> consagracao </th>
                  <th> discipulado </th>
                  <th> acompanhamento </th>
                  <th> fichas </th>
                  <th> custo </th>
                  <th> totalatividades </th>
                  <!-- <th>  </th>
                  <th>  </th> -->
                  <!--                             <th>Data Envio</th> -->
                  <!--                             <th>Lider</th> -->
                </tr>
              </thead>
              <tbody>
                <?php 
                    $tr = "";
                      foreach($messages as $m){                         
                        $tr = $tr . "<tr>";

                        $tr = $tr . "<td>".utf8_encode($m->projeto) ."</td>";                        
                        $tr = $tr . "<td>".utf8_encode($m->atividade) ."</td>";
                        $tr = $tr . "<td>".utf8_encode($m->estimado) ."</td>";
                        $tr = $tr . "<td>".utf8_encode($m->decisao) ."</td>";
                        $tr = $tr . "<td>".utf8_encode($m->interesse) ."</td>";
                        $tr = $tr . "<td>".utf8_encode($m->reconciliacao) ."</td>";
                        $tr = $tr . "<td>".utf8_encode($m->consagracao) ."</td>";
                        $tr = $tr . "<td>".utf8_encode($m->discipulado) ."</td>";
                        $tr = $tr . "<td>".utf8_encode($m->acompanhamento) ."</td>";
                        $tr = $tr . "<td>".utf8_encode($m->fichas) ."</td>";
                        $tr = $tr . "<td>".utf8_encode($m->custo) ."</td>";
                        $tr = $tr . "<td>".utf8_encode($m->totalatividades) ."</td>";
// //                         $tr = $tr . "<td>".utf8_encode($m->Usuarios) ."</td>";
//                         if($m->status == 'ativo'){
//                         $tr = $tr . "<td> <span class='badge bg-light-green'>".utf8_encode($m->status) ."</span></td>";
//                      }else{
//                         $tr = $tr . "<td> <span class='badge bg-orange'>".utf8_encode($m->status) ."</span></td>";
                          
//                         }
                          
//                           $tr = $tr . "<td><a href='cidade.php?id=" . $m->id   ."' type='button' class='btn btn-info'>Editar</a></td>";
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
			$("#tbcidades tbody tr ").filter(function() {
				$(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
			});
		});
	});
</script>
