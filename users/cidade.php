<?php
?>
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
  
  
  
  $dateinicio = strtr(Input::get("dtinicio") , '/', '-');
  $datefim = strtr(Input::get("dtfim") , '/', '-');
//   echo " <br> -- ". date('Y-m-d', strtotime($dateinicio));
//   echo " <br> -- ". date('Y-m-d', strtotime($datefim));
  
  
  //$date = date("Y-m-d H:i:s");
//   echo Input::get("dtinicio") . ' 00:00:00';
//   echo "<br>";
//   echo date('d/m/Y',strtotime(Input::get("dtinicio")));

  $thread = array(
    
    
    
    'desde'    => date('Y-m-d', strtotime($dateinicio)),
    //     'datainicio'      => Input::get("dtinicio") . ' 00:00:00',
    //     'datafim'      => Input::get("dtfim") . ' 00:00:00',
    //     'datafim'      => date('Y-m-d', strtotime($datefim)),
    'idregiao'  => Input::get('regiao'),
    'nome_cidade'      => Input::get('nome'),
    'endereco'  => Input::get('endereco'),
    'uf'        => Input::get('estado'),
    'cep'       => Input::get('CEP'),
    'status'       => Input::get('status'),
    'lider'     => Input::get('lider'),
    'bolsa_financeira_2019' =>  Input::get('bolsa_finaceira')
    
    
  );

//     dump($thread); 
//   die();
 
  
//   echo "get id" . $_GET['id'];
  
  if(!empty($_GET['id'])){
      //Atualiza cidade
      $iid =  $db->update('cidades',$_GET['id'],$thread);  
      Redirect::to('listar_cidades.php?msg=<h1>Atualizado com sucesso</h1> ->' . $iid );    
    echo 'Atualiza';
  }else{
    //Insere uma nova cidade
    $iid =  $db->insert('cidades',$thread);
    Redirect::to('listar_cidades.php?msg=<h1>Cidade incluida com sucesso</h1>->' . $iid );    
  echo 'Incluida';
  }
  
}


?>


<?php



 if(!empty($_GET["id"])){
   
  $cidadeQ = $db->query(" SELECT 
  *,
     DATE_FORMAT(desde, '%d-%m-%Y') as dt
  
  FROM cidades WHERE id = ". $_GET["id"]);
  $cidade =  $cidadeQ->results()[0];
   
//   echo "<br>";
//   echo "<br>";
//   echo "<br>";
//   echo "<br>";
//   echo "<br>";
//   echo "<br>". "SELECT * FROM cidades WHERE id = ". $_GET["id"];
 }

//Cidades e Funcoes
$tbtipo = $db->query("SELECT * FROM regioes order by nome");
$selectTipo = "";
$selected = "";
foreach ($tbtipo->results() as $row) {
  
  if($cidade->idregiao == $row->id){
    $selected = " selected ";
  }else{
    $selected = "  ";
    
  }
  
  
    $selectTipo = $selectTipo . "<option  ". $selected ."  value={$row->id}> ".  utf8_encode($row->nome)." </option>";
}


?>
<!-- <div class="block-header">
    <h2>CADASTRO DE CIDADES</h2>
</div> -->


            <!-- Tabs With Icon Title -->
            <div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="body">
                            <!-- Nav tabs -->
                            <ul class="nav nav-tabs" role="tablist">
                              
                                <li role="presentation" class="active">
                                    <a href="#home_with_icon_title" data-toggle="tab">
                                        <i class="material-icons">assignment_turned_in</i> CIDADES QUE FAZEM PARTE DA MPC BRASIL
                                    </a>
                                </li>
                              
                                <li role="presentation" class="">
                                    <a href="#home_with_icon_desconto" data-toggle="tab">
                                        <i class="material-icons">assignment_turned_in</i> DESCONTO PARA TEMPORADA
                                    </a>
                                </li>
                              

                            </ul>

    <!-- Tab panes -->
    <div class="tab-content">            
      <div role="tabpanel" class="tab-pane fade " id="home_with_icon_desconto">
      
        <h1>
          Desconto da cidade
        </h1>
        
        
<?
  //          
  //Cidades e Funcoes
  $tb_relatorios_enviados = $db->query("
  
  
select 
  nome
  , uf
  ,nome_cidade
  , DataEnvio
  -- ,sum(porcentagem) as porcentagem
  , porcentagem
  ,bolsa_financeira_2019,mes
from vw_bolsas_cidades
 where idcidade = ". $_GET["id"]. "
 order by mes asc
"
   );

        

        

?>
        
<!-- Tabs With Icon Title -->
<div class="row clearfix">
    <div class="col-12">
        <div class="card">
            <div class="body">

                      <!-- Content Goes Here. Class width can be adjusted -->
                      <table class="table table-hover">
                        <thead>
                          <tr>
<!--                             <th>Região</th> -->
                            <th>Cidade</th>
                            <th>Mês</th>
                            <th>Data do Envio</th>
                            <th>Ministerial %</th>
<!--                             <th>Financeiro</th> -->
<!--                             <th>Data Envio</th> -->
<!--                             <th>Fechado por</th> -->
                          </tr>
                        </thead>
                        <tbody>
                  <?php 
                    $tr = "";
//                     $total_cidade = 0;      
//                     $cidade_anterior = 0;

                    //comecar percorrer                           
//                     foreach($messages as $m){  
                      
//                       //Verificação se ja imprimimos as infromações ou continuamos a contagem
//                       if($cidade_anterior == $m->idcidade){
// //                         echo "<br>" . $m->nome_cidade ." Total " . $total_cidade;
//                         $total_cidade = $total_cidade + $m->Porcentagem;                        
//                         echo "" . $m->nome_cidade  . "- " .$total_cidade;
                                                
//                       }else{
// //                         $total_cidade = 0;
// //                         echo "<br> cidade igual " ;
// //                         echo " " . $m->idcidade;
// //                         $cidade_anterior = $m->idcidade;
//                         $total_cidade = $total_cidade + $m->Porcentagem;
//                       }
                      
//                         $cidade_anterior = $m->idcidade;
                      

//                     }
                          
                          
                      foreach($tb_relatorios_enviados->results() as $m){  
                       
                        // $dataEvento =  date('d/m/Y',strtotime($m->dataenvio));
  

                        // $tr = $tr . "<tr><td><img src='".$us_url_root."images/checked.png' width=40 height=40 class=rounded-circle>  Enviado em <b>{$m->DataEnvio}</b> por <b> ". echousername($m->ResponsavelFechamento)."</b></td>";
                        $tr = $tr . "<tr>";
//                         $tr = $tr . "<td>".utf8_encode($m->nome) ."</td>";                        
                        $tr = $tr . "<td>".utf8_encode($m->nome_cidade) ."</td>";
                        $tr = $tr . "<td>".utf8_encode($m->mes) ."</td>";
//                         $tr = $tr . "<td>".utf8_encode($m->uf) ."</td>";
                        $tr = $tr . "<td>".utf8_encode($m->DataEnvio) ."</td>";
//                         $tr = $tr . "<td><a href='detalhe_relatorio.php?idrelatorio=".$m->idrelatorio."'>".utf8_encode($m->Ref) ."</a></td>";
//                         $tr = $tr . "<td>".utf8_encode($m->DataEnvio) ."</td>";
                        $tr = $tr . "<td><b>". utf8_encode($m->porcentagem) . "</b></td>";                        
//                         $tr = $tr . "<td><b>". utf8_encode($m->bolsa_financeira_2019) . "</b></td>";                        
//                         $tr = $tr . "<td><b>???</b></td>";                        
                        $tr = $tr . "</tr>";


                        } //end foreach 

                        echo $tr;

                  ?>
                      </tbody>
                          </table>
                          <!-- End of main content section -->        

                    </div>
                    <div class="panel-footer">
          
          
          

          </div>

            </div>
        </div>
    </div>        
        
        <hr>
        <h3>
         
        </h3>
        
      </div>
          
          
          <div role="tabpanel" class="tab-pane fade in active" id="home_with_icon_title">
         
               
            <div class="body">

              <div class="row">
                <div class="col-md-12">
                  <form role="form" action='cidade.php?id=<?=$_GET["id"]?>' method='post'>
                    
                    <div class="form-group">
                       
                      <label for="regiao">
                        Região
                      </label>
                      <select class="form-control" name="regiao">
                        <?=$selectTipo;?>
                      </select>
                    </div>


                      <div class="row">
                      <div class="col-md-4">
                       
                      <label for="nome">
                       Nome da cidade
                      </label>
                      <input name="nome"  class="form-control" id="nome" value="<?=utf8_encode($cidade->nome_cidade); ?>" />
                      </div>
                      <div class="col-md-8">
                       
                      <label for="endereco">
                        Endereco
                      </label>
                      <input class="form-control" id="endereco" name="endereco" value="<?=utf8_encode($cidade->endereco); ?>"/>
                      </div>

                  </div>
                    
                  <div class="row">
                      <div class="col-md-4">
                       
                      <label for="estado">
                       Estado
                      </label>
                      <input name="estado"  class="form-control" id="estado" value="<?=utf8_encode($cidade->uf); ?>" />
                      </div>
<!--                       <div class="col-md-4">
                       
                      <label for="pais">
                        Pais
                      </label>
                      <input class="form-control" id="pais" name="pais" />
                      </div>                       -->
                    
                    <div class="col-md-4">
                       
                      <label for="CEP">
                        CEP
                      </label>
                      <input class="form-control" id="CEP" name="CEP"  value="<?=utf8_encode($cidade->cep); ?>"/>
                      </div>

                  </div>                  
                    
                    
                    
                    
                    

                    <div class="row">
                      <div class="col-md-4">
                      <label for="Inicio em">
                        Cadastrada desde  :
                      </label>
                      <input id="dtinicio" name="dtinicio" type="text"  class="form-control input-md" value="<?=$cidade->dt ?>">
                      </div>
                      
                      <div class="col-md-8">
                      <label for="Inicio em">
                       Nome do lider Local
                      </label>
                      <input id="lider" name="lider" type="text"  class="form-control input-md" value="<?=utf8_encode($cidade->lider); ?>">
                      </div>

                    </div>

                    <div class="form-group">
                      <label for="bolsa_finaceira">
                      Desconto financeiro 2019
                      </label>
                      <input id="bolsa_finaceira" name="bolsa_finaceira" type="text"  class="form-control input-md" value="<?=utf8_encode($cidade->bolsa_financeira_2019); ?>">
                      </div>                    
                    
                         <div class="form-group">
                       
                      <label for="status">
                        Status da Cidade
                      </label>
                      <select class="form-control" name="status">
                        <option  <?php if($cidade->status == 'ativo'){      echo ' selected '; }  ?>  value='ativo'>Ativo</option>
                        <option  <?php if($cidade->status == 'inativo'){    echo ' selected '; }  ?> value='inativo'>Inativo</option>
                        <option  <?php if($cidade->status == 'pendente'){   echo ' selected '; }  ?> value='pendente'>Pendente</option>
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




                      <div class="form-group">       
                      <button type="submit" class="btn btn-success" name="criar_agendamento">
                          <i class="fa fa-plus fa-1x" ></i> S A L V A R  
                      </button>
                      </div>


                  </form>
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
  
$(function() {              
//     $('#dtinicio').datepicker({
//         dateFormat: 'dd/mm/yyyy'
//     });
//     $('#dtfim').datepicker({
//         dateFormat: 'dd/mm/yyyy'
//     });


//    $("#dtinicio").mask("99/99/9999");
//    $("#dtfim").mask("99/99/9999");


});   

$('#dtinicio').bootstrapMaterialDatePicker({ format : 
                                            'DD/MM/YYYY HH:mm', 
                                            time: true,
                                            cancelText: 'Descartar',
    clearText: 'Limpar',
    lang: 'pt-br'
                                           });
// $('#dtfim').bootstrapMaterialDatePicker({ format : 'DD/MM/YYYY', time: false});

//           $('#dtinicio').inputmask('DD/MM/YYYY', {
//             placeholder: 'DD/MM/YYYY'
//           });

//   
//   $('#dtinicio').mask("99/99/9999").val("dd/mm/aaaa");
</script>