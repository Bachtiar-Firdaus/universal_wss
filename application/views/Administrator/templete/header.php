<style type="text/css">
  .hoverl:hover{
  color: white;

}
  .btn-primary{
      border: 1px solid white;
  }

  .btn-primary:hover{
      color: white;
      border: 1px solid white;
      
  }

  .btn:focus, .btn.focus {
    outline: 0;
    box-shadow: none;
    
}

.show a:hover{
color: white;
}

.dropdown-menu-right a {
color: #495057;
}


 .material-icons:hover{
  color: white;
}

.navbar-light .navbar-nav .nav-link:hover {
  background-color: #30a6b1;
    color: white;
}

</style>


<nav class="navbar navbar-expand-lg navbar-light border-bottom" style="background-color: #39C0CC;">
        <button class="btn btn-custome1" id="menu-toggle" ><span class="material-icons">
vertical_split
</span></button>

        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
          <ul class="navbar-nav ml-auto mt-2 mt-lg-0">
            <li class="nav-item dropdown">
              <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="     color: white;    position: relative; top: -6px; font-weight: 500;">
                <span class="material-icons" style="vertical-align: bottom; color: white;">account_circle</span>
                <b style="color: white;">Administrator</b>
              </a>
              <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                <a class="dropdown-item" href="<?php echo base_url().'login/logout'?>">Logout</a>
              </div>
            </li>
          </ul>
        </div>
      </nav>

