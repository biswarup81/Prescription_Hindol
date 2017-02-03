<?php
require_once "inc/config.php";
$cfname = $_GET['cfname'];
$cfvalue = str_replace("PLUS","+",$_GET['cfvalue']);
$visit_id = $_GET['visit_id'];
//GET ID of the TYPE

$query = "select ID from patient_health_details_master where NAME = '$cfname'";


$result = mysql_query($query);
$id = "";
if(mysql_num_rows($result) > 0){
    //Clinical Impression Type exists in the Database. Get the ID
    while($rs = mysql_fetch_array($result)){
        $id = $rs['ID'];
    }
} else {
    //Insert into master and then add
    $query = "insert into patient_health_details_master (NAME) values('$cfname')";
    mysql_query($query);
    $id = mysql_insert_id();
}
$query = "insert into patient_health_details(ID, VALUE, VISIT_ID) 
            values('$id' , '$cfvalue', '$visit_id')";
mysql_query($query);

$q15 = "select a.VALUE, b.NAME, a.ID from
                            patient_health_details a ,patient_health_details_master b
                            where
                            a.ID = b.ID
                            and a.VISIT_ID = '$visit_id'";
$rsd1 = mysql_query($q15);


/*while($rs = mysql_fetch_array($rsd1)) {
    //$name = $rs['NAME'];
    //$value = $rs['VALUE'];
    //$id = $rs['ID'];
    echo"<table><tr>";

    echo "<td width='100%' >".$rs['NAME']."</td>";
    echo "<td width='100%' ><input type='text' id='CF_".$rs['ID']."' class='input_box_small' style='width: 40px;' value='".$rs['VALUE']."' /></td>";
    echo"<td ><input type='button' class='update_row' onclick='updateDeleteCF(".$rs['ID'].",".$visit_id.",UPDATE)'/></td>";

    echo"</tr></table> ";

}*/

while($rs = mysql_fetch_array($rsd1)) {
            $name = $rs['NAME'];
            $value = $rs['VALUE'];
            $id = $rs['ID'];
            
            echo"<table>";
            if($id == '1' || $id == '2' || $id == '3') {
                echo"<tr>
                            <td width='100%' >$name</td>
                            <td width='100%' >$value</td>
                            <td >&nbsp;
                            </td> 
                        </tr>"; 
            } else {
            echo"<tr>";

            echo "<td width='100%' >$name</td>";
            echo "<td width='100%' ><input type='text'  class='input_box_small' id='CF_".$id."' style='width: 40px;' value='".$rs['VALUE']."' /><a id='minus7' href='#' ></a></td>";
            
            ?>
            
            <td><input type="button" class="update_row" onclick="updateDeleteCF('<?php echo $id ; ?>','<?php echo $visit_id; ?>','UPDATE')"/>
            </td>
            <?php    
            echo"</tr>";
            }
            echo"</table>";

    }

?>
