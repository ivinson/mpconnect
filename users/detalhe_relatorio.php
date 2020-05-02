<?php
require_once 'init.php';
require_once $abs_us_root . $us_url_root . 'users/includes/header.php';
require_once $abs_us_root . $us_url_root . 'users/includes/navigation.php';
?>
<?php if (!securePage($_SERVER['PHP_SELF'])) {
  die();
}
if ($settings->messaging != 1) {
  Redirect::to('account.php?err=Messaging+is+disabled');
}

?>
<style>
.block-titulo{
  border-left:  3px solid;
  border-left-color: teal;
  padding-left:  10px;
  background-color: white;


}
.block-titulo-mes{
  border-left:  3px solid;
  border-left-color: indigo;
  padding-left:  10px;
  background-color: white;


}

.block-titulo p {
  /* border-left:  3px solid; */
  /* padding-left:  10px; */
  padding-bottom:  5px;
  display: flex;
  /* vertical-align: middle; */
  

}


.verticalTableHeader {
    text-align:center;
    white-space:nowrap;
    transform: rotate(-90deg);
}
.verticalTableHeader p {
    margin:0 -999px;/* virtually reduce space needed on width to very little */
    display:inline-block;
}
.verticalTableHeader p:before {
    content:'';
    width:0;
    padding-top:110%;
    /* takes width as reference, + 10% for faking some extra padding */
    display:inline-block;
    vertical-align:middle;
}
table {
    text-align:center;
}
</style>

<?php
##Primeiro buscar o relatório
$relatorios = $db->findById($_GET['idrelatorio'], 'relatoriomensal');


// dump($relatorios);

$mes_relatorio = $relatorios->results()[0]->mes;
$ano_relatorio = $relatorios->results()[0]->ano;
$cidade_relatorio = $relatorios->results()[0]->idcidade;
$agendadopor      = $relatorios->results()[0]->preenchidopor;
$descricao_mes = $relatorios->results()[0]->descritivo;
$cidade = $db->findById($cidade_relatorio, 'cidades');
// dump($cidade);
$nomecidade =  $cidade->results()[0]->nome_cidade;
#------------
// $agendado_por =  $db->findById($cidade_relatorio, 'users')->results()[0]->nome_cidade;

//  echoId($agendadopor,"users","fname");

#

$lista_atividadedes_totais = $db->query("
SELECT 
  b.descricaocurta as nome , 
  count(a.idtipoatividadea) as total
    FROM 
    atividadescidade a
        join tipoatividade b on (a.idtipoatividadea = b.id)                   
    WHERE idcidade = " . $cidade_relatorio . "              
        and MONTH(a.datainicio) = " . $mes_relatorio . " 
        and YEAR(a.datainicio) = " . $ano_relatorio . "
        and a.status = 'feedback'
        GROUP by b.descricaocurta
    ORDER BY a.id DESC
    
    
    ")->results();



?>


<div class="block-titulo">
  <br>
  <div class="col-12">
      <h1> RELATÓRIO</h1> 

    </div>
  
    
    <div class="col-md-4"><p> <i class="material-icons">storage</i>&nbsp;&nbsp;&nbsp;Cidade : <b><?=utf8_encode($nomecidade);?></b></p></div>
    <div class="col-md-4"><p> <i class="material-icons">today</i>&nbsp;&nbsp;&nbsp;Mês de Referencia <b>: <?=$mes_relatorio ."/".$ano_relatorio;?></b></p></div>
    <div class="col-md-4"><p> <i class="material-icons">supervisor_account</i>&nbsp;&nbsp;&nbsp;Gerado por <b>: <?=echoId($agendadopor,"users","fname");?></b></p></div>
    <br>
    <br>

 <br>
  
</div>










<br><br>
<div class="row clearfix">
<?php foreach ($lista_atividadedes_totais as $card) {
        
?>

          <!-- <h1>Atividade </h1> -->

      
  <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
    
      <div class="info-box bg-indigo hover-expand-effect">
        <div class="icon">
          <!-- <i class="material-icons">schedule</i> -->
          <span style="font-size: 45px;"> <?=$card->total ;?> </span>
        </div>
        <!-- <center> -->
        <div class="content">
          <!-- <div class="number count-to" data-from="0" data-to="125" data-speed="15" data-fresh-interval="20"><?=$card->total ;?> </div> -->
          <div class="text" style="margin-top: 0px;font-size: 18px;"><?=utf8_encode($card->nome) ;?></div>
        </div>
      <!-- </center> -->
      </div>
    
  </div>

<?php } ?>

</div>



<div class="col s12 m7">
    <h3 class="header">Resumo do Mês</h3>
    <div class="card horizontal">

      <div class="card-stacked">
        <div class="card-content block-titulo-mes">
          <br>
        <p><i class="material-icons">person</i> <b> Diga pra gente <?=echoId($agendadopor,"users","fname");?></b> </p>
          <p><?php echo utf8_encode($descricao_mes); ?></p>
          <br>
        </div>      
      </div>
    </div>
  </div>


  <div class="col s12 m7">
  <div class="card horizontal">
  <table class="table table-dark">
  <thead>
    <tr>
      <!-- <th scope="col">#</th> -->

      
      <!-- <th class="rotate" scope="col"><div><span>Atividade</span></div></th> -->

      <!-- <th class="rotate" scope="col"><div><span></span></div></th>
      <th class="rotate" scope="col"><div><span>Público</span></div></th>
      <th class="rotate" scope="col"><div><span>Discipulado</span></div></th>
      <th class="rotate" scope="col"><div><span>Decisão</span></div></th>
      <th class="rotate" scope="col"><div><span>Interesse</span></div></th>
      <th class="rotate" scope="col"><div><span>Reconciliação</span></div></th>
      <th class="rotate" scope="col"><div><span>Consagração</span></div></th> -->

      <th class="verticalTableHeader" ><p></p></th>
      <th class="verticalTableHeader" ><p>Público</p></th>
      <th class="verticalTableHeader" ><p>Discipulado</p></th>
      <th class="verticalTableHeader" ><p>Decisão</p></th>
      <th class="verticalTableHeader" ><p>Interesse</p></th>
      <th class="verticalTableHeader" ><p>Reconciliação</p></th>
      <!-- <th class="verticalTableHeader" ><p>Consagração</p></th> -->
      <!-- <th class="verticalTableHeader" scope="col">Atividade</th>
      <th class="verticalTableHeader" scope="col">Público</th>
      <th class="verticalTableHeader" scope="col">Discipulado</th>
      <th class="verticalTableHeader" scope="col">Decisão</th>
      <th class="verticalTableHeader" scope="col">Interesse</th>
      <th class="verticalTableHeader" scope="col">Reconciliação</th>
      <th class="verticalTableHeader" scope="col">Consagração</th> -->
      <!-- <th scope="col">Telefonemas pós</th> -->
      <!-- <th scope="col">Last</th>
      <th scope="col">Handle</th> -->
    </tr>
  </thead>
  <tbody>

  <?php

$lista_atividades_quantidades = $db->query("
SELECT 
b.descricaocurta as nome 
, a.qtddecisao
, a.qtdinteresse
, a.qtdreconciliacao
, a.qtdconsagracao
, a.qtdligacoes_para_interessados
, a.qtddiscipulado
, a.publicoestimado 
    FROM 
    atividadescidade a
        join tipoatividade b on (a.idtipoatividadea = b.id)                   
    WHERE idcidade = " . $cidade_relatorio . "              
        and MONTH(a.datainicio) = " . $mes_relatorio . " 
        and YEAR(a.datainicio) = " . $ano_relatorio . "
        and a.status = 'feedback'
    
    ORDER BY a.id DESC")->results();

// dump($lista_atividadedes);
      foreach ($lista_atividades_quantidades as $v1) {

        // dump($card1);
         $nome_atividade_qt     =  $v1->nome  ;
        //  $data_ativi =  $card1->DataCompleta  ;
        //  $depoimento_ativi =  $card1->descricaogeral  ;
        //  $nome_ativi =  $card1->descricaocurtaa  ;
echo "    <tr>
          
          <td>".utf8_encode($v1->nome)  ."</td>
          <td>".utf8_encode($v1->publicoestimado)  ."</td>
          <td>".utf8_encode($v1->qtddiscipulado)  ."</td>
          <td>".utf8_encode($v1->qtddecisao)  ."</td>
          <td>".utf8_encode($v1->qtdinteresse)  ."</td>
          <td>".utf8_encode($v1->qtdreconciliacao)  ."</td>
          
          
          
          </tr>";


      }
       
        ?>

</tbody>
</table>
  </div>
  </div>














  <h3 class="header">Atividades detalhadas</h3>
      <?php

$lista_atividadedes = $db->query("
SELECT 
a.* 
,DATE_FORMAT(STR_TO_DATE(a.datainicio, '%Y-%m-%d'), '%m/%Y') as mesano
,DATE_FORMAT(STR_TO_DATE(a.datainicio, '%Y-%m-%d'), '%d/%m/%Y') as DataCompleta 
, b.descricaocurta as descricaocurtaa
    FROM 
    atividadescidade a
        join tipoatividade b on (a.idtipoatividadea = b.id)                   
    WHERE idcidade = " . $cidade_relatorio . "              
        and MONTH(a.datainicio) = " . $mes_relatorio . " 
        and YEAR(a.datainicio) = " . $ano_relatorio . "
        and a.status = 'feedback'
    
    ORDER BY a.id DESC")->results();

// dump($lista_atividadedes);
      foreach ($lista_atividadedes as $card1) {

        // dump($card1);
         $nome_ativi =  $card1->descricaocurtaa  ;
         $data_ativi =  $card1->DataCompleta  ;
         $depoimento_ativi =  $card1->descricaogeral  ;
        //  $nome_ativi =  $card1->descricaocurtaa  ;
       
        ?>



<div class="block-titulo">
  <hr>
  <h4> <?php   echo utf8_encode($nome_ativi);?></h4> 
  <!-- <h4> <?php   echo  "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;".utf8_encode($nome_ativi);?></h4>  -->
  <!-- <p><i class="material-icons">storage</i>Cidade : <b><?=$nomecidade;?></b></p> -->
  <p><i class="material-icons">date_range</i><b>&nbsp;&nbsp;&nbsp; <?=$data_ativi;?></b></p>
  <p><i class="material-icons">assignment_ind</i> <b> &nbsp;&nbsp;&nbsp;&nbsp;<?=echoId($agendadopor,"users","fname");?></b> </p>
  <p><?=utf8_encode($depoimento_ativi);?>&nbsp;&nbsp;&nbsp;</p>
  <hr>
</div>

      <?php
    }

    ?>


<!-- footers -->
<?php require_once $abs_us_root . $us_url_root . 'users/includes/page_footer.php';
?>

<!-- Place any per-page javascript here -->

<?php require_once $abs_us_root . $us_url_root . 'users/includes/html_footer.php';
?>