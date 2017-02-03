<?php include "datacon.php"; ?>

<?php 
$_SESSION['NAVIGATION'] = 'visit_list';
?>
<?php include "header.html"; ?>
<body>

<?php 
if(isset($_SESSION['user_type'])) {

?>

<!--BEGIN wrapper-->
<div id="wrapper">
    <div class="container">
       
    <!--BEGIN header-->
            <?php include("banner.php") ?>
            
    <!--END of header-->
    
    <!--BEGIN details-->
    <div class="invest">  
        <div class="invest_inner"> 
        <!--BEGIN tab2-->
            



               
                <!--END of search-->

                <!--BEGIN search results-->
                <div class="searchResults" id="searchDiv" style="border:none; margin-top:0px;">
                    <div class="headings"><img src="images/Briefcase-Medical.png" />&nbsp;Visit List</div>
                    <table width='888' border='0' cellspacing='0' cellpadding='0'>
                        <tr>
                        <td class='bg_tble' id="visit_list">                    
                            <table width='100%' border='0' cellspacing='1' cellpadding='0'>
                    
                                                <tr>
                                                    <td class="head_tbl" width="207">Patient Name</td>
                                                    <td class="head_tbl" align="left" width="149">Cell Number</td>
                                                    <td class="head_tbl" align="center" width="150">Booking Date</td>
                                                    <td class="head_tbl" align="center" width="150">Booking Time</td>
                                                    <td class="head_tbl" align="center" width="150">Action</td>
                                                </tr>
<?php
//$result = mysql_query("select a.visit_id, a.patient_id, b.patient_first_name, b.patient_last_name, b.patient_cell_num, a.VISIT_DATE from visit a, patient b where a.patient_id = b.patient_id order by a.visit_id desc");


$result = mysql_query("SELECT a.visit_id, b.patient_id, a.visited, b.patient_first_name, 
                        b.patient_last_name, b.patient_name, b.patient_cell_num, a.VISIT_DATE
                        FROM visit a, patient b
                        WHERE a.patient_id = b.patient_id
                        AND a.visited =  'no' AND a.visit_id
                        in ( SELECT max( visit_id )
                            FROM visit c
                            WHERE c.visited = 'no'
                            GROUP BY patient_id)
                            order by VISIT_DATE desc") ;

while ($row = mysql_fetch_array($result)) {
    ?>
                <tr >
                    <td class='odd'><a href="create_prescription.php?patient_id=<?php echo $row['patient_id'] ?>&VISIT_ID=<?php echo $row['visit_id']; ?>">
                        <?php if($row['patient_name'] == null || $row['patient_name'] == ""){
                         echo $row['patient_first_name'] . " " . $row['patient_last_name']; } else { echo $row['patient_name']; }?></a></td>
                    <td class='odd'><?php echo $row['patient_cell_num']; ?></td>
                    <td class='odd' align="center"><?php echo date("d / m / Y", strtotime($row['VISIT_DATE'])); ?></td>
                    <td class='odd' align="center"><?php echo date("h:i A", strtotime($row['VISIT_DATE'])); ?></td>
                    <td class='odd' align="center"><input type="button" value="Cancel Booking" onclick="removeVisit('<?php echo $row['visit_id']; ?>')" /> </td>
                </tr>
    <?php
}
//mysql_close($con);
?>
                                            </table></td></tr></table>


                </div>
                <!--END of results-->

            
        </div>
        
    </div>
    <!--BEGIN footer-->
    <?php include "footer_pg.html"; ?> 
    <!--END of footer-->
    </div></div>
       <?php if( $_SESSION['user_type'] == "DOCTOR"){ ?>
           <div class="btn_wrap2">
            <!--<form id="form2" action="doc_add_patient.php" method="POST"> -->
            <form id="form2" action="index.php" method="POST">
            <input type="submit" id="ADD" value="Add Patient"  class="btn"/>
            </form>
                 
    </div>
     <?php  } else { ?>
           <div class="btn_wrap2">
               
            <form id="form2" action="index.php" method="POST">
            <input type="submit" id="ADD" value="Add Patient"  class="btn"/>
            </form>
      <?php } ?>            
    



<?php } else {
    header("location:index_login.php");
} ?>
</body>
</html>