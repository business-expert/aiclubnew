<?php
$msg = $objComm->getSessionMessage('activation');

include_once(VIEWS. "/header/header.php");
?>
<tr>
  <td colspan="2"><table border="0" cellpadding="0" cellspacing="5" width="70%" align="center" style="margin-top:10px;">
      <tbody>
        <tr>
          <td colspan="2"><?=$msg?></td>
        </tr>
      </tbody>
    </table></td>
</tr>
<?php include_once(VIEWS. "/footer/footer.php"); ?>
