
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


      
        <a href="<?php echo site_url() ?>User/index" class="list-group-item list-group-item-action ahover">
          <span class="material-icons" style="vertical-align: bottom;">account_balance</span>
          Dashboard
        </a>


        <a href="<?php echo site_url() ?>User/Legality" class="list-group-item list-group-item-action ahover">
          <span class="material-icons" style="vertical-align: bottom;">account_balance</span>
          Legality
        </a>
      
        <a href="<?php echo site_url() ?>User/Vehicle" class="list-group-item list-group-item-action ahover">
          <span class="material-icons" style="vertical-align: bottom;">commute</span>
          Vehicle
        </a>
        

        <a href="<?php echo site_url() ?>User/realisasi" class="list-group-item list-group-item-action ahover">
          <span class="material-icons" style="vertical-align: bottom;">commute</span>
          Activities
        </a>
        <a href="<?php echo site_url() ?>User/realisasi" class="list-group-item list-group-item-action ahover">
          <span class="material-icons" style="vertical-align: bottom;">commute</span>
          Realization
        </a>

      </div>
    </div>