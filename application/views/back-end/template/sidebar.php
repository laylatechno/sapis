<!-- ========== Left Sidebar Start ========== -->
<div class="vertical-menu">

    <div data-simplebar class="h-100">

        <!--- Sidemenu -->
        <div id="sidebar-menu" class="mm-active">
            <!-- Left Menu Start -->
            <ul class="metismenu list-unstyled mm-show" id="side-menu">
                <?php
                    //tampil main menu
                  $roleid = $this->session->userdata('RoleID');

                  $sqlgroup = "SELECT * FROM menugroup WHERE GroupID IN(SELECT GroupID FROM menuaccess WHERE RoleID = $roleid)";
                  $groupmenu = $this->db->query($sqlgroup)->result();

                  foreach($groupmenu as $gm){
                      echo '<li class="menu-title">'.$gm->GroupTitle.'</li>';

                      $sqlmenu = "SELECT * FROM menumaster WHERE GroupID = $gm->GroupID AND MenuType = 0";
                      $mainmenu = $this->db->query($sqlmenu)->result();

                      foreach($mainmenu as $mm){
                        $checksub = $this->db->query("SELECT MenuType FROM menumaster WHERE MenuLink = '".$this->uri->segment(1)."'")->result();
                        $submenu = $this->db->query("SELECT * FROM menumaster WHERE MenuType = '$mm->MenuID'");

                        if($submenu->num_rows() > 0 ){
                          $active = "";
                          foreach ($checksub as $ck) {
                              if($ck->MenuType == $mm->MenuID){
                                  $active = "mm-active";
                              } else {
                                  $active = "";
                              }
                          }
                          echo '<li class="'.$active.'">
                                  <a href="javascript: void(0);" class="has-arrow waves-effect">
                                      <i class="'.$mm->MenuIcon.'"></i>
                                      <span>'.$mm->MenuTitle.'</span>
                                  </a>
                                  <ul class="sub-menu" aria-expanded="false">';
                                  foreach ($submenu->result() as $sm) {
                                    echo'<li class="'.$active.'">'.anchor($sm->MenuLink, '<span>'.$sm->MenuTitle).'</span></a></li>';
                                  }
                           echo '</ul>
                                 </li>';
                        } else {
                          if($mm->MenuLink == $this->uri->segment(1)){
                              $activeli = "mm-active";
                              $activeclass = "active";
                          } else {
                              $activeli ="";
                              $activeclass = "";
                          }
                          echo'<li class="'.$activeli.'">'.anchor($mm->MenuLink,'<i class="'.$mm->MenuIcon.'"></i><span>'.ucwords($mm->MenuTitle), array('class'=>'waves-effect '.$activeclass)).'</span></a></li>';
                        }
                      }
                    }
                  ?>
            </ul>
        </div>
        <!-- Sidebar -->
    </div>
</div>
<!-- Left Sidebar End -->
