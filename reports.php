<?php include "header.html"; ?>        
        <script type="text/javascript">
            function myFocus(element) {
                if (element.value == element.defaultValue) {
                    element.value = '';
                }
            }
            function myBlur(element) {
                if (element.value == '') {
                    element.value = element.defaultValue;
                }
            }
            function check(){
                if(document.form1.fname.value == ""){
                    alert("Please Insert First Name.");
                    return false;
                }else if(document.form1.lname.value == ""){
                    alert("Please Insert Last Name Name.");
                    return false;
                }else if(document.form1.cellnum.value == ""){
                    alert("Please Insert Mobile Number.");
                    return false;
                }else{
                    return true;
                }
            }
            function checkSearch(){
                if(document.s_form.patient_id.value == "" && document.s_form.patient_name.value == ""){
                    alert("Please Give some Input");
                    return false;
                }
            }
            function search1(){
                //alert(document.getElementById("s_p_id").value);
                //alert(document.getElementById("s_p_name").value);
                if(document.getElementById("txtCI").value == ""){
                    alert("Please Give some Input");
                    return false;
                } else {
                    
                    var p_cl_imprssn = document.getElementById("txtCI").value;
            
                    if (window.XMLHttpRequest){
                        xmlhttp=new XMLHttpRequest();
                    }else{
                        xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
                    }

                    xmlhttp.onreadystatechange=function(){
                        if (xmlhttp.readyState==4 && xmlhttp.status==200){
                            document.getElementById("searchDiv").innerHTML=xmlhttp.responseText;
                        }
                    }
                    //str = "delete_precribed_medicine.php?MEDICINE_ID="+k+"&PRES_ID="+pid;
                    var url = "ajax/searchPatientClinicalImpression.php?mode=SEARCH_CI&CI="+p_cl_imprssn;   
                    xmlhttp.open("GET",url,true);
                    xmlhttp.send();
                }
        
            }
            
            function searchPatient(){
                //alert(document.getElementById("s_p_id").value);
                //alert(document.getElementById("patient_id").value);
                if(document.getElementById("patient_id").value == ""){
                    alert("Please Give some Input");
                    return false;
                } else {
                    
                    var patient_id = document.getElementById("patient_id").value;
            
                    if (window.XMLHttpRequest){
                        xmlhttp=new XMLHttpRequest();
                    }else{
                        xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
                    }

                    xmlhttp.onreadystatechange=function(){
                        if (xmlhttp.readyState==4 && xmlhttp.status==200){
                            //alert(xmlhttp.responseText);
                            document.getElementById("searchPatientDiv").innerHTML=xmlhttp.responseText;
                        }
                    }
                    //str = "delete_precribed_medicine.php?MEDICINE_ID="+k+"&PRES_ID="+pid;
                    var url = "ajax/searchPatientDataById.php?PATIENT_ID="+patient_id;   
                    xmlhttp.open("GET",url,true);
                    xmlhttp.send();
                }
        
            }

			function searchPatientByMedicineName(){
                //alert(document.getElementById("s_p_id").value);
                //alert(document.getElementById("patient_id").value);
                if(document.getElementById("course").value == ""){
                    alert("Please Give some Input");
                    return false;
                } else {
                    
                    var medicine_name = document.getElementById("course").value;
            
                    if (window.XMLHttpRequest){
                        xmlhttp=new XMLHttpRequest();
                    }else{
                        xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
                    }

                    xmlhttp.onreadystatechange=function(){
                        if (xmlhttp.readyState==4 && xmlhttp.status==200){
                            //alert(xmlhttp.responseText);
                            document.getElementById("searchPatientByMedicineDiv").innerHTML=xmlhttp.responseText;
                        }
                    }
                    //str = "delete_precribed_medicine.php?MEDICINE_ID="+k+"&PRES_ID="+pid;
                    var url = "ajax/searchPatientDataByMedicineName.php?MEDICINE_NAME="+medicine_name;   
                    xmlhttp.open("GET",url,true);
                    xmlhttp.send();
                }
        
            }
            
            
        </script>
        <script>

            $(function() {
                $( "#datepicker" ).datepicker({
                    changeMonth: true,
                    changeYear: true,
                    showOn: "button",
                    buttonImage: "images/calendar.gif",
                    buttonImageOnly: true,
                    dateFormat: "dd-mm-yy"
                });
            });

        </script>

    <body>
        <?php
        include "datacon.php";
        if (isset($_SESSION['user_type'])) {
            /* if($_SESSION['user_type'] == 'DOCTOR'){
              header("location:visit_list.php");
              } else if($_SESSION['user_type'] == 'RECEPTIONIST'){ */
            ?>

            <div id="wrapper">

                <div class="container">
                    <!--BEGIN header-->
                    <?php include("banner.php"); ?>

                    <div class="content">
                        <div class="invest">

                            <div class="headings"><img src="images/Briefcase-Medical.png" />&nbsp;Master Management</div>

                            <div class="invest_inner">

                                <div class="invest_inner">        

                                    <div id="tabvanilla" class="widget">            
                                        <ul class="tabnav">
                                            <li><a href="#tab1">Clinical Impression</a></li>
                                            <li><a href="#tab2">By Patient</a></li>
                                            <li><a href="#tab3">By Medicine</a></li>
                                        </ul>

                                        <!--BEGIN tab1-->
                                        <div id="tab1" class="tabdiv">



                                            <!--BEGIN search-->
                                            <div class="patientDetails">

                                                <span><p>Clinical Impression</p>
                                                   
                                                <input id="txtCI" name="patient_cl_imprssn" type="text" class="input_box_big" value="" /></span>                
                                                           
                                                <span><p>&nbsp;</p><input type="submit" value="Search" name="search" class="btn" onclick="search1();" /></span>


                                            </div>
                                            <!--END of search-->

                                            <!--BEGIN search results-->
                                            <div class="searchResults" id="searchDiv">

                                                <!--RESULT OF SEARCH -->


                                            </div>
                                            <!--END of results-->

                                        </div>
                                        <!--END of tab1-->
                                        
                                        <!--BEGIN tab2-->
                                        <div id="tab2" class="tabdiv">



                                            <!--BEGIN search-->
                                            <div class="patientDetails">
                                                <!--    
                                                <span><p>Patient ID</p><input id="s_p_id" name="patient_id" type="text" class="input_box_add" value="" /></span>                
                                                -->
                                                <span><p>Patient ID</p><input id="patient_id" name="patient_id" type="text" class="input_box_big" value="" /></span>               
                                                <span><p>&nbsp;</p><input type="submit" value="Search" name="search" class="btn" onclick="searchPatient();" /></span>


                                            </div>
                                            <!--END of search-->

                                            <!--BEGIN search results-->
                                            <div class="searchResults" id="searchPatientDiv">

                                                <!--RESULT OF SEARCH -->


                                            </div>
                                            <!--END of results-->

                                        </div>
                                        <!--END of tab2-->
                                        
                                        
                                        <!--BEGIN tab3-->
                                        <div id="tab3" class="tabdiv">



                                            <!--BEGIN search-->
                                            <div class="patientDetails">
                                                <!--    
                                                <span><p>Patient ID</p><input id="s_p_id" name="patient_id" type="text" class="input_box_add" value="" /></span>                
                                                -->
                                                <span><p>Medicine Name</p><input id="course" name="medicine_name" type="text" class="input_box_big" value="" /></span>               
                                                <span><p>&nbsp;</p><input type="submit" value="Search" name="search" class="btn" onclick="searchPatientByMedicineName();" /></span>


                                            </div>
                                            <!--END of search-->

                                            <!--BEGIN search results-->
                                            <div class="searchResults" id="searchPatientByMedicineDiv">

                                                <!--RESULT OF SEARCH -->


                                            </div>
                                            <!--END of results-->

                                        </div>
                                        <!--END of tab3-->
                                        
                                        
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>

                </div>

                <!--BEGIN footer-->
                <?php include "footer_pg.html"; ?> 
                <!--END of footer-->
            </div>

        </div>
        <!--END of wrapper-->
        <?php
    } /* } */ else {
        header("location:index_login.php");
    }
    ?>
</body>
</html>
<?php ob_flush() ?>