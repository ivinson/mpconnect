<?php require_once 'init.php'; ?>
<?php require_once $abs_us_root . $us_url_root . 'users/includes/header.php'; ?>
<?php require_once $abs_us_root . $us_url_root . 'users/includes/navigation.php'; ?>

<?php if (!securePage($_SERVER['PHP_SELF'])) {
  die();
} ?>
<?php

//dealing with if the user is logged in
if ($user->isLoggedIn() || !$user->isLoggedIn() && !checkMenu(2, $user->data()->id)) {
  if (($settings->site_offline == 1) && (!in_array($user->data()->id, $master_account)) && ($currentPage != 'login.php') && ($currentPage != 'maintenance.php')) {
    $user->logout();
    Redirect::to($us_url_root . 'users/maintenance.php');
  }
}
$grav = get_gravatar(strtolower(trim($user->data()->email)));
$get_info_id = $user->data()->id;
// $groupname = ucfirst($loggedInUser->title);
$raw = date_parse($user->data()->join_date);
$signupdate = $raw['month'] . "/" . $raw['year'];
$userdetails = fetchUserDetails(NULL, NULL, $get_info_id); //Fetch user details
?>
<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.2.0/css/all.css" integrity="sha384-hWVjflwFxL6sNzntih27bfxkr27PmbbK/iSvJ+a4+0owXq79v+lsFkW54bOGbiDQ" crossorigin="anonymous">
<?php
$messagesQ = $db->query("
SELECT *, p.nome as nomeprojeto, a.id as idatividade FROM 
         atividadescidade a
    join tipoatividade b on (a.idtipoatividadea = b.id)
    join projetos p on (p.id = b.idprojeto)

 WHERE idcidade = ? 
 
 ORDER BY a.datainicio DESC", array($user->data()->idcidade));
$messages =  $messagesQ->results();

?>


<style>
  h1,
  h2,
  h3 {
    font-weight: 300;
  }

  .container {
    padding: 1em;
  }


  @media screen and (min-width: 40em) {
    .container {
      max-width: 1000px;
      margin: 0 auto;
    }



    ul.timeline {
      list-style-type: none;
      position: relative;
    }

    ul.timeline:before {
      content: ' ';
      background: #d4d9df;
      display: inline-block;
      position: absolute;
      left: 29px;
      width: 2px;
      height: 100%;
      z-index: 1;
    }

    ul.timeline>li {
      margin: 20px 0;
      padding-left: 20px;
    }

    ul.timeline>li:before {
      content: ' ';
      background: white;
      display: inline-block;
      position: absolute;
      border-radius: 50%;
      border: 3px solid #22c0e8;
      left: 20px;
      width: 20px;
      height: 20px;
      z-index: 1;
    }
  }
</style>

<body>


  <?php
  // echo $user->data()->idcidade; 
  if (($user->data()->idcidade <= 0) || empty($user->data()->idcidade)) {
  ?>

    <div class="card card-outline-danger text-center">
      <span class="pull-right clickable close-icon" data-effect="fadeOut"><i class="fa fa-times"></i></span>
      <div class="card-block">
        <blockquote class="card-blockquote">
          <p>Olá, <?php

                  echoId($user->data()->id, 'users', 'fname');

                  ?>. <br>Percebemos que alguns dados do seu cadastro não estão preenchidos! </p>
          <footer>Por favor, faça agora <cite title="Source Title">para não gerar problema nos relatórios da sua cidade.</cite></footer>
        </blockquote>
      </div>
    </div>



  <?php } ?>




  <div class="card">
    <div class="header"></div>

    <div class="container mt-5 mb-5">
      <div class="row">
        <div class="col-md-12 offset-md-3">
          <h4>Ultimas atividades</h4>

          <?php


          ?>
          <ul class="timeline">

            <?php
            //	dump($messages);
            foreach ($messages as $m) {
              $dataEvento =  date('d/m/Y', strtotime($m->datainicio));
              $msgDescricao = utf8_encode($m->descricaocurta);
              $msgDescricaoC = utf8_encode($m->descricaogeral);
            ?>


              <li>
                <!-- 					<a target="_blank" href="https://www.totoprayogo.com/#">New Web Design</a> -->
                <a href="edit-feedback_atividades_ministeriais.php?id=<?=$m->idatividade?>" class="float-right"> <?= utf8_encode($m->nomeprojeto) ?> / <?= $dataEvento ?></a>
                <p><b><?= $msgDescricao . "</b> - " .  $msgDescricaoC ?></p>
              </li>
            <?php } //end foreach 
            ?>
          </ul>
        </div>
      </div>
    </div>










  </div>
</body>

<!-- footers -->
<?php require_once $abs_us_root . $us_url_root . 'users/includes/page_footer.php'; // the final html footer copyright row + the external js calls 
?>

<!-- Place any per-page javascript here -->

<?php require_once $abs_us_root . $us_url_root . 'users/includes/html_footer.php'; // currently just the closing /body and /html 
?>

<script>
  $('.close-icon').on('click', function() {
    $(this).closest('.card').fadeOut();
  })
</script>