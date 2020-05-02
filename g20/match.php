<?php

/**
ok 1 - Cadastrar um volunatrio na tabela geracao
ok   - Pegar ultimo id do geracao inserido
ok 2 - Buscar primeira Debora (tabela deboras) sem idGeracao cadastrado
ok 3 - Update com id do Voluntario (1) na debora encontrada (2)
4 - Enviar email com instrucoes

**/


ob_start();
  header('X-Frame-Options: SAMEORIGIN');
  require_once '../users/init.php';
  $db = DB::getInstance();

if(!empty($_POST)){  
  $dt_nasc = date('Y-m-d',strtotime(strtr(Input::get("dtnascimento") , '/', '-')));   
  $thread = array(            
      'nome'             => Input::get('name'),    
      'whats'            => Input::get('whatsapp'),
      'endereco'         => Input::get('endereco'),
      'mpc_local'        => Input::get('mpclocal'),
      'email'            => Input::get('email'),
      'data_nascimento'  =>  $dt_nasc
  );

  //Registra o cadastro do cabdidato a filho
   $iid =  $db->insert('geracao',$thread);
  
?>


<!DOCTYPE HTML>
<!--
	Road Trip by TEMPLATED
	templated.co @templatedco
	Released for free under the Creative Commons Attribution 3.0 license (templated.co/license)
-->
<html>
	<head>
		<title>Geração Compromisso 2020</title>
		<meta charset="utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1" />
		<link rel="stylesheet" href="assets/css/main.css" />
    <style>
    
    .bxdPYX h1 b {
          color: rgb(4, 211, 97) !important;
          font-family: Roboto, Helvetica, Arial, sans-serif !important;
      }
    
    </style>
	</head>
	<body class="subpage">
			<section id="post" class="wrapper bg-img" data-bg="banner2.jpg" style="padding-top: 26px;">
				<div class="inner bxdPYX">
					<article class="box">
            <center><img src="images/branco.png" width=200 height=auto> </center>
	
							<h1>Olá, querido (a) <b><?=Input::get('name')?></b></h1>

						<div class="content">

<p>Estamos muito felizes em saber que você deseja fazer parte da Geração Compromisso! Essa é uma decisão muito importante que vai impactar a sua vida em todas as áreas e abrirá à sua frente um mundo de oportunidades para servir ao Senhor.</p>

<p>Dizer “sim” para o compromisso missionário que o Geração Compromisso propõe significa que você poderá tornar-se um missionário na sua escola, em outra cultura, como um(a) pastor(a), mantenedor de missões, intercessor… Em outras palavras:</p>

<h1>
<b>Quem é o Jovem da Geração Compromisso?</b>
</h1>

<ul>  
  <li>É um jovem salvo por Jesus Cristo, que conhece suas limitações, sabe que é um pecador, sujeito a tropeços e que, por isso mesmo, depende diariamente da atuação do Espírito Santo na sua vida.</li>
  <li>É um jovem que leva Deus a sério e que é um cidadão consciente de suas responsabilidades vendo a sua escola, a sua igreja, o seu trabalho, a sua vizinhança, a sua família, como campo missionário.</li>
  <li>É um jovem que está disposto a cumprir a vontade de Deus na sua vida, mesmo que isso implique em negar a sua própria vontade.</li>
</ul>              

  <p>E na sua retaguarda, orando por você e pedindo a Deus que o fortaleça, estará a sua “mãe de oração”, do Ministério Desperta Débora:
  <br>
  
O <b> "Desperta Débora” é um movimento de oração</b>, cujo alvo é despertar milhares de mães intercessoras, biológicas, adotivas, ou espirituais, de qualquer denominação, comprometidas em orar 15 minutos por dia, para que Deus opere um despertamento espiritual sem precedentes na história da juventude.</p>
 
<br>
<b>O que vem pela frente? </b>
<br>
Agora que temos seu contato, iremos conectar você à sua mãe de oração para se apresentarem e iniciarem uma amizade onde você poderá compartilhar testemunhos, pedidos de oração, pedidos de aconselhamento… Pedimos que aguarde e em breve ela entrará em contato com você. 

              <br><br>
Está ansioso para começar a amizade? Você também pode dar o primeiro passo!
              
<?php 
  
//     echo "<br> Resultado - > " . $iid;
  //Reserva seu id para atrelhar a uma mae
//   echo "<br> Ultimo id inserido - > " . $db->lastId();
  
  $id_geracao = $db->lastId();
  
  //Agora buscamos uma mae que nao tem nem uma ligacao com filho nenhum
  //Cidades e Funcoes
  $arrDeboras = $db->query("SELECT * FROM deboras where projeto_geracao = 'on' and id_filho_geracao is null limit 1;");
//   echo $arrDeboras->results()[0]->id;
  
  $idDebora           = $arrDeboras->results()[0]->id;
  $telefoneDebora     = $arrDeboras->results()[0]->telefone;
  $nomeDebora         = $arrDeboras->results()[0]->nome;
  $nomeEmail         = $arrDeboras->results()[0]->email;
  
  If(!count($arrDeboras) <= 0 ){
  //Atualizamos a mae com o codigo do filho recem cadastrado
  $arrUpdate = array( 'id_filho_geracao' =>$id_geracao );
    
    
    echo $arrDeboras->results()[0]->id . " - ultima debora <br>";
//     dump( $arrUpdate );
    
   $db->update('deboras',$idDebora,$arrUpdate);
    
  ?>
              
<center>
<!-- <img src="images/deb.png"> -->
<!-- <img src="https://media3.giphy.com/media/fH92WOykDEVsPIPuX4/source.gif" width=200 height=auto> -->
<img src="https://www.myherodesign.com/wp-content/uploads/2016/06/Asian_Female_Excited.gif" width=200 height=auto>
  <h1>
    
Essa é a  <b><?=$nomeDebora ?></b>, sua mãe de oração. 
    
    
 <br>
 Manda um whatsapp pra ela : <b> <?=$telefoneDebora?></b><br>
 Ahh, pode ser através do email também  <b><?=$nomeEmail ?></b><br>
  
  
  
</h1>
    <?php 
    
    
      
  
  //   Enviamos email para debora
   
  //   Enviamos email para o Filho geracao
   
  //   Segue a tela de parabens

  }else{
    
    echo "Aguarde... assim que acharmos um mae de oracao vc receber'a nosso email ta?";
    
  }
}
//       dump ($arrDeboras->results()[0]); 
    ?>

</center>
<br><br>
              
<h1>
  <b>E tem mais!!</b>
</h1>

Dizer sim ao chamado de Deus e ainda ganhar uma mãe comprometida em interceder por você é apenas o começo do que temos para você!

Também queremos te ajudar nesse processo de descobrir o seu chamado ao sinalizar para você cinco possibilidades de compromisso com o Reino de Deus. Aos poucos, buscando ao Senhor e ouvindo a Sua voz, você definirá onde deseja engajar-se:


<ul style="list-style-type:disc;">
	<li>Apoio Financeiro - Jovens que sentem ter um chamado para contribuir financeiramente com alguma missão/projeto.</li>
	<li>Chamado transcultural - Jovens que sentem um chamado para trabalhar com outra cultura e/ou país.</li>
	<li>Chamado Pastoral - Jovens que sentem ter um chamado para pastoreio</li>
	<li>Missão urbana - Jovens que sentem ter um chamado para servir a Deus na sua cidade e/ou envolvendo-se com algum ministério urbano brasileiro.</li>
	<li>Intercessão - Jovens que sentem um chamado para orar mais especificamente pela juventude brasileira.</li>
</ul>

<p>
Assuma o compromisso de fazer a diferença onde Deus te enviar. Essa é uma decisão que começa no seu coração e é concretizada quando você cumpre o chamado de Deus para sua vida. Compartilhe com a sua mãe de oração a respeito da área que mais chama o seu interesse e coloquem em oração para que Deus direcione a sua escolha!
</p>

<b>Você já conhece a Mocidade para Cristo?</b>


<P>
Queremos também te convidar a conhecer e ser um voluntário da Mocidade para Cristo do Brasil (MPC), onde o projeto Geração Compromisso nasceu.
A MPC é um movimento cristão que busca resgatar jovens através das boas novas de Deus. Tudo começou em 1940 nos Estados Unidos e hoje, a missão está presente em mais de 100 países, conta com dezenas de milhares de obreiros de tempo integral. parcial e voluntários que trabalham em parceria para dar a oportunidade de todo jovem ser um seguidor de Jesus. Nossa visão é: Cada jovem/adolescente, em cada grupo de pessoas, em cada país/cidade terá a oportunidade de ser um seguidor de Jesus Cristo.

</P>
              
<p>
<br>Siga a MPC nas redes
<br>Instagram @brasilmpc 
<br>Facebook MPC Brasil 
<br>www.mpc.org.br              
<br>whatsapp <a href="https://api.whatsapp.com/send?phone=5531971716413&text=Oi! Acabei de me inscrever no GC."> 31 97171 6413 </a>              
</p>
              </p>              

              <P>
                
<h1>
                Seja um voluntário da MPC! 
  
                </h1>
                Nossos líderes regionais estão aguardando seu contato para  ajudar você a se conectar ao líder da MPC na sua cidade:
              </P>
 
              
              <p>
                
                <h4>                  
                  <br>Região Centro-Oeste /Norte: Ernandes Lucas Alves dos Santos
                  <br>(66) 9221-5263/ 9281-1372 / hernandhes@gmail.com
                  <br><br>Região Nordeste: Max Pierre Fernandes Ferreira
                  <br>(99) 98110-1835 / 3663-2609 / maxepc1@hotmail.com
                  <br><br>Região Sudeste: Marcelle Nayda Pires Peixoto
                  <br>(21) 96428-5500 / 2663-3825 / cellenayda@yahoo.com.br
                  <br><br>Região Sul: Lívia Ribeiro Pavanello
                  <br>(55) 9655-9281 / (51) 9392-5883 / 3723 3448 / livinhaeng@hotmail.com
              </h4>
              </p>

 





              
              
            
            
            </div>
						<footer>
							<ul class="actions">
								<li><a href="#" class="button alt icon fa-chevron-left"><span class="label">Previous</span></a></li>
								<li><a href="#" class="button alt icon fa-chevron-right"><span class="label">Next</span></a></li>
							</ul>
						</footer>
					</article>
				</div>
			</section>

		<!-- Scripts -->
			<script src="assets/js/jquery.min.js"></script>
			<script src="assets/js/jquery.scrolly.min.js"></script>
			<script src="assets/js/jquery.scrollex.min.js"></script>
			<script src="assets/js/skel.min.js"></script>
			<script src="assets/js/util.js"></script>
			<script src="assets/js/main.js"></script>

	</body>
</html>



<?php 



?>
