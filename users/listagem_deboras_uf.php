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




$messagesQ = $db->query("
select cidade, estado, count(id) as total
from deboras 
  group by cidade, estado

order by total desc

LIMIT 500
");
// echo htmlentities($_GET['filter']); 
$messages =  $messagesQ->results();




$estadosQ = $db->query("
  select  estado, count(id) as total
  from deboras 
    group by  estado

  order by total desc
");
// echo htmlentities($_GET['filter']); 
$estados =  $estadosQ->results();


// $total_cidades_tot = count($messages);


// $total_cidades = $db->query("select idregiao, count(*) as total from cidades group by idregiao")->results();


?>
  <div class="block-header">
    <h1>RESUMO DEBORAS</h1>
  </div>

  <div class="row clearfix" >
    
    <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
      <div class="card">
        <div class="header">
          <h2>
            TOTAL POR CIDADES
            <!--                                 <small>Add the badges component to any list group item and it will automatically be positioned on the right.</small> -->
          </h2>

        </div>
        <div class="body">
          <ul class="list-group">
            <?php  foreach($estados as $e){  ?>
            <li class="list-group-item">
              <?PHP echo utf8_encode($e->estado);  ?> <span class="badge bg-teal"><?PHP echo utf8_encode($e->total);  ?></span></li>
            <?PHP }?>
          </ul>
        </div>
      </div>
    </div>    
    
    
    <!-- Basic Examples -->
    <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
      <div class="card">
        <div class="header">
          <h2>
            TOTAL POR CIDADES
            <!--                                 <small>The most basic list group is simply an unordered list with list items, and the proper classes.</small> -->
          </h2>
        </div>
        <div class="body">
          <ul class="list-group">
            <?php  foreach($messages as $m){  ?>
            <li class="list-group-item">
              <?PHP echo utf8_encode($m->cidade) . "(". utf8_encode($m->estado) .")";  ?> <span class="badge bg-purple"><?PHP echo utf8_encode($m->total);  ?></span></li>
            <?PHP }?>
          </ul>
        </div>
      </div>
    </div>
    <!-- #END# Basic Examples -->
    <!-- Badges -->

    <!-- #END# Badges -->
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
      window.location.href = "listagem_deboras.php?filter=" + this.value;
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