
<style type="text/css">

*{
  font-family: 'Poppins', sans-serif;
}

  .ahover{
    background-color: #39C0CC; 
    color: white; 
    /*padding: 20px;*/

  }

.ahover:hover{
  background-color: #12ACBA;
  color: white;
  border: 3px solid white;
  
}

.ahover-d:hover{
  background-color: #12ACBA;
  color: white;
  border: 3px solid white;


}


.ahover-d{
  transition: .3s;
}

.material-icons{
  padding-right: 5px;
}

.list-group-item{
  border: 1px solid #ffffff69;
}

a,span:hover{
  /*padding-left: 20px;*/
  transition: .5s;
  font-weight: 600;
}

.navbar {
  padding: 3px 7px;
}

</style>

<div class="border-right" id="sidebar-wrapper" style="background-color: #39C0CC;">
      <div class="sidebar-heading" style="background-color: white;"><img src="<?php echo base_url('assets/image/logo.png') ?>"></div>
      <div class="list-group list-group-flush" style="background-color: #39C0CC;     border-top: 2px solid #ffffff69;
    border-bottom: 2px solid #ffffff69;">


      
        <a href="<?php echo site_url() ?>welcome_admin/index" class="list-group-item list-group-item-action ahover">
          <span class="material-icons" style="vertical-align: bottom;">account_balance</span>
          Dashboard
        </a>
      
        <a href="<?php echo site_url() ?>welcome_admin/transportir" class="list-group-item list-group-item-action ahover">
          <span class="material-icons" style="vertical-align: bottom;">commute</span>
          Transportir
        </a>
        
        <a href="<?php echo site_url() ?>welcome_admin/car" class="list-group-item list-group-item-action ahover">
          <span class="material-icons" style="vertical-align: bottom;">arrow_forward</span>
          Car
        </a>

        <a href="<?php echo site_url() ?>welcome_admin/realisasi" class="list-group-item list-group-item-action ahover">
          <span class="material-icons" style="vertical-align: bottom;">arrow_forward</span>
          Realisasi
        </a>

        

       

<li class="nav-item dropdown" style="list-style: none; margin-top: 32px; border-bottom: 1px solid #ffffff69;">

<a class="nav-link dropdown-toggle ahover" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="color: white; margin-left: 7px;
margin-top: -27px;">
    <span class="material-icons" style="vertical-align: bottom;">speaker_notes</span>
    Help
</a>

<div class="dropdown-menu" aria-labelledby="navbarDropdown" style="background-color: #39C0CC; color: white; border: none; left: 10">
<a class="dropdown-item ahover-d" href="<?php echo site_url() ?>welcome_admin/help_transportir" style="color: white;">Help Transportir</a>
<a class="dropdown-item ahover-d" href="<?php echo site_url() ?>welcome_admin/help_car" style="color: white;">Help Car</a>
<a class="dropdown-item ahover-d" href="<?php echo site_url() ?>welcome_admin/help_realisasi" style="color: white;">Help Realisasi</a>



</div>
</li>





      </div>
    </div>