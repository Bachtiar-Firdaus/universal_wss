<!DOCTYPE html>
<html>
<head>
  <title>Warehouse Security system</title>
  <link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/css_login/css/style.css')?>">
  <link href="https://fonts.googleapis.com/css?family=Poppins:600&display=swap" rel="stylesheet">
  <script src="https://kit.fontawesome.com/a81368914c.js"></script>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <script src='https://www.google.com/recaptcha/api.js'></script>
</head>

<style type="text/css">
  
.login-content{
  justify-content: center;
}
.content{
  display: flex;
  background: #fff;
  justify-content: space-around;
  position: relative;
  box-shadow: 0 4px 8px 0 rgba(0,0,0,0.2);
  transition: 0.3s;

}

.kiri1{
  position: absolute;
  left:0;
  width: 30%;
  height: 100%;
  margin-left: -2px;

}

.container{
  padding: 40px !important;
  background-color: #05919E;
}



.img{
  align-self: center;
}

.img1 img{
  width: 400px;
}


</style>


<body>
  <div class="container">
    <div class="content">

    <img class="kiri1" src="<?php echo base_url('assets/css_login/img/kiri1.png')?>" width="100" height="100">

    <div class="img">

      <div class="img1" style="position: relative; top: -16px;">
      <img src="<?php echo base_url('assets/css_login/img/logo-bgr.png')?>">
    </div>

    <div class="img1" style="position: relative;">
            <img src="<?php echo base_url('assets/css_login/img/okok.png')?>">
          </div>
          </div>


    <div class="login-content">
      <div class="card">
          <form role="form" method="post" action="<?php echo base_url().'Login/Auth'?>">
        <img src="<?php echo base_url('assets/css_login/img/avatar.svg')?>">

        <h2 class="title">Welcome</h2>
              <div class="input-div one">
                 <div class="i">
                    <i class="fas fa-user"></i>
                 </div>
                 <div class="div">
                    <h5>Username</h5>
                    <input type="text" name="Username" class="input" autocomplete="off" required>
                 </div>
              </div>
              <div class="input-div pass">
                 <div class="i"> 
                    <i class="fas fa-lock"></i>
                 </div>
                 <div class="div">
                    <h5>Password</h5>
                    <input type="Password" name="Password" class="input" autocomplete="off" required>
                 </div>

              </div>
              <input type="submit" class="btn" value="Login">

              <div class="g-recaptcha" data-sitekey="6Lfml9wZAAAAAC-NdtrRfOrbsxw6eXRvHmKsv7Al"></div>
            </form>
            </div>
        </div>
  </div>
  </div>


    <script type="text/javascript" src="<?php echo base_url('assets/css_login/js/main.js') ?>"></script>
</body>
</html>
