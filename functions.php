<?

function error_msg($mess) {
ob_start();
?>
      <center>
        <font size="4">Error</font><br />
      </center>
      <div class="text_stand">
        <p><ul><? echo $mess; ?></ul></p>
        <p><input type="button" onclick="history.back()" value="Back" /></p>
      </div>
<?
$func = ob_get_contents();
ob_end_clean();
return $func;
}

function comfirm($mess,$des,$place) {
ob_start();
?>
      <center>
        <font size="4">Confirmation</font><br />
      </center>
      <div class="text_stand">
        <p><? echo $mess; ?></p>
        <p><input type="button" onclick="location.href='<? echo $des; ?>'" value="<? echo $place;?>" /></p>
      </div>
<?
$func = ob_get_contents();
ob_end_clean();
return $func;
}

?>