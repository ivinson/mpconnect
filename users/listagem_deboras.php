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




/**
Cancelar uma debora / Excluir
*/
  if(!empty($_REQUEST['act'] )){   
      $id_debora = $_REQUEST['id'];
      $fields=array('status'=>'cancelado');
      $db->update('deboras',$id_debora,$fields);

  }






?>


  <?php


if(isset($_GET['filter']) ){
    $swhere = " and estado  like   '%". $_GET['filter']."%'   ";
}else{
    $swhere = "   ";
}

$messagesQ = $db->query("
select 
* 
from
deboras

where status <> 'cancelado'

   ". $swhere ."    
  order by id desc
  limit 5000
");

// echo htmlentities($_GET['filter']); 



$messages =  $messagesQ->results();


// $total_cidades_tot = count($messages);


// $total_cidades = $db->query("select idregiao, count(*) as total from cidades group by idregiao")->results();


?>
      <h1>DESPERTA DEBORA</h1>
<!--     <div class="block-header"> -->
<!--     </div> -->


<div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="body">




              <div class="row">
                <div class="col-md-12">
                  <form role="form" action='listagem_deboras.php' method='post'>
                    
                    <div class="form-group">
                       
                      <label for="tipoevento">
                       Qual Estado quer filtrar
                      </label>
                          <?php
                            //Cidades e Funcoes
                            $tbtipo = $db->query("SELECT distinct estado  FROM deboras order by estado asc");
                            $selectTipo = "";
                            foreach ($tbtipo->results() as $row) {
                              $selectTipo = $selectTipo . "<option value={$row->estado}> ".  utf8_encode($row->estado)." </option>";
                            }
//                             echo $selectTipo;
                          ?>
                      <select class="form-control" name="cidade" id="cidade">
                        <?=$selectTipo;?>
                      </select>
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


<!-- 

                      <div class="form-group">       
                      <button type="submit" class="btn btn-success" name="criar_agendamento">
                          <i class="fa fa-plus fa-1x" ></i> FILTRAR 
                      </button>
                      </div>
 -->
<br/>
<input type="button" id="btnExport" value=" Gerar planilha " /> 
                    | 
                    
                    <a href="listagem_deboras_uf.php" > Totais por estado</a>
<!--                     <input type="button" id="btnExport" value=" Torais por estado " />  -->
                    
                    
<br/>
                  </form>
                </div>
              </div>
  

                        </div>
                    </div>
                </div>
      
            <!-- #END# Tabs With Icon Title -->

</div>







      

    <div class="row clearfix">


<!--       <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
        <a href="cidades_all.php">
          <div class="info-box bg-teal hover-expand-effect">
            <div class="icon">
              <i class="material-icons">list</i>
            </div>
            <div class="content">
              <div class="text">TODAS AS DEBORAS</div>
              <div class="number count-to" data-from="0" data-to="125" data-speed="15" data-fresh-interval="20"> </div>
            </div>
          </div>
        </a>

      </div> -->


      

      
      

      











    </div>


    <!-- Tabs With Icon Title -->
    <div class="row clearfix">
      <div class="col-12">
        <div class="card">
          <div class="body">
            
                      <div class="row">
                      <div class="col-md-8">
                       
                      <label for="Local">
                        Local do evento (Nome da Escola, igreja, espaço)
                      </label>
<!--                       <input name="local"  class="form-control" id="local" /> -->
                        
                  <input class="form-control"  id="system-search" name="q" placeholder="  Digite o nome da cidade " type="text">
  
                      </div>


                  </div>            
            

            <!-- Content Goes Here. Class width can be adjusted -->
            <table class="table table-hover" id="tbcidades">
              <thead>
                <tr>
                  <th>Nome</th>
                  <th>Telefone</th>
                  <th>Cidade</th>
                  <th>Estado</th>
                  <th>Situação</th>
                  <th></th>
                  <!--                             <th>Data Envio</th> -->
                  <!--                             <th>Lider</th> -->
                </tr>
              </thead>
              <tbody>
                <?php 
                    $tr = "";
                    $debora_anterior = "" ;
                $total_duplicados = 0;
                      foreach($messages as $m){                         
                       
                        if($debora_anterior == $m->nome){                          
//                           $tr = $tr . "<tr style='background-color: #ffbc40;'>";
                          $tr = $tr . "<tr>";
                          $total_duplicados++;
                        }else{                          
                          $tr = $tr . "<tr>";
                        }
                        
                        
                        
                        
                        $tr = $tr . "<td>".utf8_encode(strtoupper($m->nome)) ."</td>";                        
                        $tr = $tr . "<td>".utf8_encode($m->telefone) ."</td>";
                        $tr = $tr . "<td>".utf8_encode(strtoupper($m->cidade)) ."</td>";
                        $tr = $tr . "<td>".utf8_encode(strtoupper($m->estado)) ."</td>";
//                         $tr = $tr . "<td>".utf8_encode($m->Usuarios) ."</td>";
                        
                    
                        if($debora_anterior == $m->nome){                          
//                           $tr = $tr . "<tr style='background-color: #ffbc40;'>";
                          $tr = $tr . "<td> <span class='badge bg-orange'>Duplicado</span></td>";
                          
                        }else{                          
//                           $tr = $tr . "<tr>";
                                                  if($m->status == 'ativo'){
                        $tr = $tr . "<td> <span class='badge bg-light-green'>".utf8_encode($m->status) ."</span></td>";
                     }else{
                        $tr = $tr . "<td> <span class='badge bg-orange'>".utf8_encode($m->status) ."</span></td>";
                          
                        }
                        }                        
                        
                        

                          //Colocar novamento botao de editar, diminuiu perfromance
                        //<a href='cadastro_debora_interno.php?id=" . $m->id   ."' type='button' class='btn btn-info'>Editar</a>
                          $tr = $tr . "<td>
                          
                           <a href='listagem_deboras.php?id=" . $m->id   ."&act=cancel' type='button' class='btn btn-danger'>Excluir</a>
                          
                           </td>";
                        $tr = $tr . "</tr>";
                        
                        $debora_anterior = $m->nome;
                          
                        } //end foreach 
                      echo $tr;
                  ?>
              </tbody>
            </table>
            <!-- End of main content section -->

            <h1>
              Total de <?=$total_duplicados?>
            </h1>
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

// // manda o filtro
// $('#cidade').change(function() {
//   // set the window's location property to the value of the option the user has selected
//   window.location =  'listagem_deboras.php' +  $(this).val();
// });

  
  $('#cidade').on('change', function() {
//   alert( this.value );
     window.location.href="listagem_deboras.php?filter=" + this.value; 
});
  
  
  
  $("#btnExport").click(function(e) {
  var a = document.createElement('a');
  var data_type = 'data:application/vnd.ms-excel';
  var table_div = document.getElementById('tbcidades');
  var table_html = table_div.outerHTML.replace(/ /g, '%20');
  a.href = data_type + ', ' + table_html;
  a.download = 'arquivo_.xls';
  a.click();
  e.preventDefault();
});
  
</script>
