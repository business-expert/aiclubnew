<?php
	include_once(CONTROLLERS."/login.php");
	$msg = $objComm->getSessionMessage('login');
?>

<?=$msg?>
<div class="box-content">
  <form class="form-horizontal" method="post" action="index.php">
  <input type="hidden" name="model" id="model" value='login'>
  <input type="hidden" name="action" id="action" value='login'>  
    <div class="control-group">
      <label for="focusedInput" class="control-label">Type of Member</label>
      <div class="controls">
        <select>
          <option>--SELECT--</option>
        </select>
      </div>
    </div>
    <div class="control-group">
      <label for="focusedInput" class="control-label">Login Name</label>
      <div class="controls">
        <input type="text" value="" id="username" name="username" class="input-xsmall focused">
      </div>
    </div>
    <div class="control-group">
      <label for="focusedInput" class="control-label">Password</label>
      <div class="controls">
        <input type="text" value="" id="password" name="password" class="input-xsmall focused">
      </div>
    </div>
    <div class="control-group">
      <div class="controls">
        <button class="btn btn-primary" type="submit">Login</button>
      </div>
    </div>
  </form>
</div>
