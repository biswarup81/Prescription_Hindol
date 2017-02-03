<div class='check_fields' >
<?php

require_once "inc/config.php";
$investigation_name =$_GET["investigation_name"];
$type = $_GET["investigation_type"];

$sql = "insert into investigation_master(investigation_name,investigation_type) values ('$investigation_name','$type')";
mysql_query($sql) or die(mysql_error());

$query = "select * from investigation_master where investigation_type = '$type'";
                                $result = mysql_query($query);
                                    while($rs = mysql_fetch_array($result)) {
                                            $cname = $rs['investigation_name'];
                                            echo "<input name='".$cname."' type='checkbox' value='".$cname."' />".$cname;
                                    } 

?>
</div>
 <div  class="addfileds">
 <?php 
    if($type == 'TYPE1'){
            echo "<input id='invest1' type='text' value=''/>";
    } else if ($type == 'TYPE2'){
            echo "<input id='invest2' type='text' value=''/>";
    } else if ($type == 'TYPE3'){
            echo "<input id='invest3' type='text' value=''/>";
    } else if ($type == 'TYPE4'){
            echo "<input id='invest4' type='text' value=''/>";
    } else if ($type == 'TYPE5'){
            echo "<input id='invest5' type='text' value=''/>";
    } else if ($type == 'TYPE6'){
            echo "<input id='invest6' type='text' value=''/>";
    } else if ($type == 'TYPE7'){
            echo "<input id='invest7' type='text' value=''/>";
    }
 ?>
                                
                                <input type="button" class="delete_row" name="" onclick="return addInvestigation('<?php echo $type ?>')" value="" />
                                
                            </div>  