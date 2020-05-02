<?php
// header("charset=UTF-8",true)
require_once 'init.php';
  $db = DB::getInstance();

//   $settingsQ = $db->query("Select * FROM settings");
//   $settings = $settingsQ->first();
    
  
//   echo "<pre>";
//         // echo var_dump($_POST)  ;
//     var_dump( $settings);
//         echo "</pre>";

  // include "header.php";
  // include "navbar.php"; 
  // include "asidebar.php"; 
  //$userID =   $user->id;
  $fields = "";
  //Cidade do usuario que está fechando
  //   echo $idcidade;
  //ID do cliente
  //   $array = explode('#', Input::get('idcidade'));
  //   $idcidade = $array[0];
  $json = "";
  //   $customer_id = $array[0];
  //    echo "<br>IdCidade<br>". $idcidade . "<br>--------------<br>";
  
  if ( isset($_GET['act']) ) {
      
      //  Se salvar for chamado da tela de share
      if ( $_GET['act'] == 'atividades-mes' )  {             
          
          $idcidade = $user->data()->idcidade;



            #	Monta as abas do UTD
            //$cliente_id =  $_GET['customer_id'];
            $lista_atividadedesQ = $db->query("
            SELECT 
            a.* 
            ,DATE_FORMAT(STR_TO_DATE(a.datainicio, '%Y-%m-%d'), '%m/%Y') as mesano
            ,DATE_FORMAT(STR_TO_DATE(a.datainicio, '%Y-%m-%d'), '%d/%m/%Y') as DataCompleta 
            , b.descricaocurta as descricaocurta
                FROM 
                atividadescidade a
                    join tipoatividade b on (a.idtipoatividadea = b.id)                   
                WHERE idcidade = ".$idcidade."              
                    and MONTH(a.datainicio) = ".$_GET['mes'] . " 
                    and YEAR(a.datainicio) = " . $_GET['ano'] ."
                
                ORDER BY a.id DESC");
            $results_atividades = $lista_atividadedesQ->results();
                            


                    $tr = "";
                        
                        foreach($results_atividades as $m){  
                            
                            
                            
                            if ($m->status == "agendado"){
                                $tr =$tr . "<tr class='bg-warning'>";

                            $dataEvento =  date('d/m/Y',strtotime($m->datainicio));
                            $tr = $tr . "<td><img src='".$us_url_root."images/warning.png' width=40 height=40 class=rounded-circle> ".$dataEvento."</td>";
                            $tr = $tr . "<td><b>"
                                    .  utf8_encode($m->descricaocurta)."( ".$m->local.")</b>
                            <br>  " .
                            //   utf8_encode($m->status)." por  " . echousername($m->agendadopor)."
                            
                            " Evento sem informações de feedback.
                            <a href='edit-feedback_atividades_ministeriais.php?id=". $m->id ."'>
                            Clique aqui </a> para dar o feedback desse evento ou peça para ".echousername($m->agendadopor)." fazê-lo. </td>";
                        
                            $tr = $tr. "</tr>";
                            
                            
                            }else{

                                
                                
                                
                                $tr =$tr . "<tr>";
                                
                                $dataEvento =  date('d/m/Y',strtotime($m->datainicio));
                                $tr = $tr . "<td><img src='".$us_url_root."images/checked.png' width=40 height=40 class=rounded-circle> ".$dataEvento."</td>";
                                $tr = $tr . "<td><b>"
                                .  utf8_encode($m->descricaocurta)."( ".$m->local.")</b>
                                <br>  " .  utf8_encode($m->status)." por  " . echousername($m->agendadopor)."</td>";
                                
                                $tr = $tr. "</tr>";
                            }
                        }
                        if(count($results_atividades) > 0 ){   
                            echo $tr;
                        } else {

                            echo "<tr><td><h2> Não existem atividades para essse mês selecionado [##3333]</h2><td></tr>";
                        }
                            



            }else  if ( $_GET['act'] == 'validar-mes-fechamento' )  {         


                $idcidade = $user->data()->idcidade;
							#	Monta as abas do UTD
							//$cliente_id =  $_GET['customer_id'];
							$lista_atividadedesQ = $db->query("
                            SELECT 
                            a.* 
                             FROM 
                                atividadescidade a
                                             
                                WHERE idcidade = ".$idcidade."              
                                  and MONTH(a.datainicio) = ".$_GET['mes'] . " 
                                  and YEAR(a.datainicio) = " . $_GET['ano'] ."
                                  and a.status = 'agendado'
                                ORDER BY a.id DESC");
                            $results_atividades = $lista_atividadedesQ->results();
                            if(count($results_atividades) > 0) {
                                echo "false";
                            } else{ 
                                    echo "true" ;
                            }

        }else  if ( $_GET['act'] == 'fechar-relatorio-mes' )  {         


                        $idcidade = $user->data()->idcidade;
                        $mes = $_GET['mes'];
                        $ano = $_GET['ano'];



            
              //  Campos passados por POST via ajax 
              $fieldsDados = array(                
                //'nome'        => Input::get('inputnomecliente'),
                'mes'        => $mes,
                'ano'        => $ano,
                'idcidade'   => $idcidade,                
                
                // 'qtd_voluntarios_ocasionais'   => $idcidade,
                'dataenvio'         => date("Y-m-d H:i:s")  ,
                'preenchidopor'     => $user->data()->id,
                'validadopor'       => $user->data()->id,
                'descritivo'        => Input::get('descricao')
   
              );            
            
            
            //  var_dump($fieldsDados);

            //echo "nome do cliente : " . Input::get('inputnomecliente');
            // echo stripslashes(Input::get('inputnomecliente'));
            // echo Input::get('produto2');
            $i = $db->insert('relatoriomensal', $fieldsDados);
            // echo $i;          
            $idrelatorio = $db->lastId();
            echo $idrelatorio;
            //  Redirect::to($us_url_root."users/detalhe-relatorio.php?id=".$idrelatorio);
            //echo "<br> Atualizado!";        

        }



};

?>