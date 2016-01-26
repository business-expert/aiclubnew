<?php include_once(CONTROLLERS_ADMIN."/".$_REQUEST['model'].".php"); 

$msg = $objComm->getSessionMessage('login');

if($msg == '')
	$msg = '<div class="alert alert-info"> Please login with your Username and Password. </div>';

?>
<div class="container-fluid">
  <div class="row-fluid">
    <div class="row-fluid">
      <div class="span12 center login-header">
        <h2>Welcome to AI Club</h2>
      </div>
      <!--/span--> 
    </div>
    <!--/row-->
    
    <div class="row-fluid">
      <div class="well span5 center login-box">
        <?=$msg?>
        
        <form class="form-horizontal" action="index.php?model=login&action=login" method="post">
          <fieldset>
            <div class="input-prepend" title="Username" data-rel="tooltip"> <span class="add-on"><i class="icon-user"></i></span>
              <input autofocus class="input-large span10" name="username" id="username" type="text" value="" />
            </div>
            <div class="clearfix"></div>
            <div class="input-prepend" title="Password" data-rel="tooltip"> <span class="add-on"><i class="icon-lock"></i></span>
              <input class="input-large span10" name="password" id="password" type="password" value="" />
            </div>
            <div class="clearfix"></div>
            <div class="input-prepend">
              <label class="remember" for="remember">
                <input type="checkbox" id="remember" />
                Remember me</label>
            </div>
            <div class="clearfix"></div>
            <p class="center span5">
              <button type="submit" class="btn btn-primary">Login</button>
            </p>
          </fieldset>
        </form>
      </div>
      <!--/span--> 
    </div>
    <!--/row--> 
  </div>
  <!--/fluid-row--> 
  
</div>
