
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


      
        <a href="<?php echo site_url() ?>Administrator/index" class="list-group-item list-group-item-action ahover">
          <span class="material-icons" style="vertical-align: bottom;">dashboard</span>
          Dashboard
        </a>

        <a href="<?php echo site_url() ?>Administrator/Manage_Accounts" class="list-group-item list-group-item-action ahover">
          <span class="material-icons" style="vertical-align: bottom;">account_box</span>
          Manage Accounts
        </a>
    

        <a href="<?php echo site_url() ?>Administrator/Legality" class="list-group-item list-group-item-action ahover">
          <span class="material-icons" style="vertical-align: bottom;">assignment</span>
          Legality
        </a>
      
        <a href="<?php echo site_url() ?>Administrator/Vehicle" class="list-group-item list-group-item-action ahover">
          <span class="material-icons" style="vertical-align: bottom;">commute</span>
          Vehicle
        </a>
        
        <a href="<?php echo site_url() ?>Administrator/Activities" class="list-group-item list-group-item-action ahover">
          <span class="material-icons" style="vertical-align: bottom;">electric_car</span>
          Activities
        </a>
        <a href="<?php echo site_url() ?>Administrator/Realization" class="list-group-item list-group-item-action ahover">
          <span class="material-icons" style="vertical-align: bottom;">emoji_transportation</span>
          Realization
        </a>
      </div>
    </div>


    