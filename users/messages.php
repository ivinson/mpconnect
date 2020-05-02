<?php
/*
UserSpice 4
An Open Source PHP User Management System
by the UserSpice Team at http://UserSpice.com

This program is free software: you can redistribute it and/or modify
it under the terms of the GNU General Public License as published by
the Free Software Foundation, either version 3 of the License, or
(at your option) any later version.

This program is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
GNU General Public License for more details.

You should have received a copy of the GNU General Public License
along with this program.  If not, see <http://www.gnu.org/licenses/>.
*/
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
?>
<?php
$messagesQ = $db->query("SELECT * FROM message_threads WHERE msg_to = ? OR msg_from = ? ORDER BY id DESC",array($user->data()->id,$user->data()->id));
$messages = $messagesQ->results();

?>





<div class="container">
    <div class="row profile">
        <div class="col-md-3">
        <?php include("includes/profile_sidebar.php"); ?>
        </div>
        <div class="col-md-9">
            <div class="profile-content">
               <div class="row">
                <div class="col-xs-12 col-md-10">
        <div class="row">
          <div class="col-sm-6">
            <a style="width: 174px !important; " class="btn btn-primary" href="create_message.php"> <i class="fa fa-plus fa-2x" ></i> Nova Mensagem </a>
          </div>

        <!-- Content Goes Here. Class width can be adjusted -->
        <table class="table table-hover">
          <thead>
            <tr>
              <th> </th>
              <th>Assunto</th>
              <th>De</th>
              <th>Para</th>
              
              <!-- <th>Ultima Atualização</th> -->
              <!-- <th>Ultima iteração</th> -->
            <!--   <th>Não Lida(s)</th> -->
              <!-- <th>Sent On</th> -->
              <!-- <th>Read</th> -->
            </tr>
          </thead>
          <tbody>


        
            <tr>
              <?php 






              foreach($messages as $m){

                $unreadQ = $db->query("SELECT * FROM messages WHERE msg_to = ? AND msg_thread = ? AND msg_read != 1",array($user->data()->id,$m->id));
                $unread = $unreadQ->count();


                if($unread>0){
                  echo "<tr     style='background-color: #e6f2ff!important;' >";

                }else{echo "<tr>";}


                #Prioridade 
                #0 Urgente/Determinação 
                #1 Recomendação
                #2 Sugestão/Orientação 
                $priority = $m->priority;

                $iconPrioridade = "";

                If($priority==0){
                  $iconPrioridade =  "<span class='label label-danger'>Urgente</span>";
                }
                If($priority==1){
                  $iconPrioridade ="<span class='label label-warning'>Recomendação</span>"; ;
                }
                If($priority==2){
                  $iconPrioridade = "<span class='label label-success'>Novidade</span>";
                }



               ?>
              <td><?php echo $iconPrioridade;?> </td>
                <td><a href="message.php?id=<?=$m->id?>"><?=$m->msg_subject?></a></td>
                <td><a href="message.php?id=<?=$m->id?>"><?php echouser($m->msg_from);?></a></td>
                <td><a href="message.php?id=<?=$m->id?>"><?php echouser($m->msg_to);?></a></td>
                
                <!-- <td><a href="message.php?id=<?=$m->id?>"><?=$m->last_update?></a></td> -->
                <!-- <td><a href="message.php?id=<?=$m->id?>"><?php echouser($m->last_update_by);?></a></td> -->
                <td>
                  <?php

                 
                  /*
                  if($unread > 0){ ?>
                    <font color = "red"><?=$unread?></font>
                    <?php }else{
                      echo "lida";
                    }

                    */
                    ?>


                  </td>


                </tr>
                <?php } //end foreach ?>
              </tbody>
            </table>
            <!-- End of main content section -->
          </div> <!-- /.col -->                   

                </div>
                </div>  
            </div>
        </div>
    </div>
</div>



    <!-- footers -->
    <?php require_once $abs_us_root.$us_url_root.'users/includes/page_footer.php'; // the final html footer copyright row + the external js calls ?>

    <!-- Place any per-page javascript here -->

    <?php require_once $abs_us_root.$us_url_root.'users/includes/html_footer.php'; // currently just the closing /body and /html ?>
