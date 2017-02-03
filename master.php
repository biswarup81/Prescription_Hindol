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
                if(document.getElementById("s_p_id").value == "" && document.getElementById("s_p_name").value == ""){
                    alert("Please Give some Input");
                    return false;
                } else {
                    var patient_id = document.getElementById("s_p_id").value;
                    var patient_name = document.getElementById("s_p_name").value;
            
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
                    var url = "ajax/searchPatient.php?mode=SEARCH_PATIENT&patient_id="+patient_id+"&patient_name="+patient_name;   
                    xmlhttp.open("GET",url,true);
                    xmlhttp.send();
                }
        
            }
            
            function searchMedicine(){
                //alert(document.getElementById("s_p_id").value);
                //alert(document.getElementById("s_p_name").value);
                if(document.getElementById("medicine_name").value == "" ){
                    alert("Please Give some Input");
                    return false;
                } else {
                    
                    var medicine_name = document.getElementById("medicine_name").value;
            
                    if (window.XMLHttpRequest){
                        xmlhttp=new XMLHttpRequest();
                    }else{
                        xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
                    }

                    xmlhttp.onreadystatechange=function(){
                        if (xmlhttp.readyState==4 && xmlhttp.status==200){
                            document.getElementById("searchMedicineDiv").innerHTML=xmlhttp.responseText;
                        }
                    }
                    //str = "delete_precribed_medicine.php?MEDICINE_ID="+k+"&PRES_ID="+pid;
                    var url = "ajax/searchMedicine.php?medicine_name="+medicine_name;   
                    xmlhttp.open("GET",url,true);
                    xmlhttp.send();
                }
        
            }
        function searchInvestigation()
        {
                //alert(document.getElementById("s_p_id").value);
                //alert(document.getElementById("s_p_name").value);
                
                    
                    var invest_name = document.getElementById("investigation").value;
            
                    if (window.XMLHttpRequest){
                        xmlhttp=new XMLHttpRequest();
                    }else{
                        xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
                    }

                    xmlhttp.onreadystatechange=function(){
                        if (xmlhttp.readyState==4 && xmlhttp.status==200){
                            document.getElementById("searchInvestDiv").innerHTML=xmlhttp.responseText;
                        }
                    }
                    //str = "delete_precribed_medicine.php?MEDICINE_ID="+k+"&PRES_ID="+pid;
                    var url = "ajax/searchInvestigation.php?invest_name="+invest_name;   
                    xmlhttp.open("GET",url,true);
                    xmlhttp.send();
                
        
            }
        
        
        function deleteInvest(investID){
            
            //alert(medincineID);
            var invest_name = document.getElementById("investigation").value;
            if (window.XMLHttpRequest){
                xmlhttp=new XMLHttpRequest();
            }else{
                xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
            }

            xmlhttp.onreadystatechange=function(){
                if (xmlhttp.readyState==4 && xmlhttp.status==200){
                    document.getElementById("searchInvestDiv").innerHTML=xmlhttp.responseText;
                }
            }
            //str = "delete_precribed_medicine.php?MEDICINE_ID="+k+"&PRES_ID="+pid;
            var url = "ajax/editInvestigation.php?MODE=DELETE&investID="+investID+"&invest_name="+invest_name;   

            xmlhttp.open("GET",url,true);
            xmlhttp.send();
                
        }
        
        function editInvest(investID){
            
            //alert(medincineID);
            var invest_name = document.getElementById("investigation").value;
            if (window.XMLHttpRequest){
                xmlhttp=new XMLHttpRequest();
            }else{
                xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
            }

            xmlhttp.onreadystatechange=function(){
                if (xmlhttp.readyState==4 && xmlhttp.status==200){
                    document.getElementById("searchInvestDiv").innerHTML=xmlhttp.responseText;
                }
            }
            //str = "delete_precribed_medicine.php?MEDICINE_ID="+k+"&PRES_ID="+pid;
            var url = "ajax/editInvestigation.php?MODE=EDIT&investID="+investID+"&invest_name="+invest_name;   

            xmlhttp.open("GET",url,true);
            xmlhttp.send();
                
        }
        
        function upDateInvest(investID){
            
            var inv_name = document.getElementById("inv_name").value;
            var invest_name = document.getElementById("investigation").value;
			var invest_type = document.getElementById("investigation_type").value;
            
            if (window.XMLHttpRequest){
                xmlhttp=new XMLHttpRequest();
            }else{
                xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
            }

            xmlhttp.onreadystatechange=function(){
                if (xmlhttp.readyState==4 && xmlhttp.status==200){
                    document.getElementById("searchInvestDiv").innerHTML=xmlhttp.responseText;
                }
            }
            //str = "delete_precribed_medicine.php?MEDICINE_ID="+k+"&PRES_ID="+pid;
            var url = "ajax/editInvestigation.php?MODE=UPDATE&investID="+investID+"&invest_name="+invest_name+"&inv_name="+inv_name+"&inv_type="+invest_type;   

            xmlhttp.open("GET",url,true);
            xmlhttp.send();
        }
        
        
        function deleteMedicine(medincineID){
            
            //alert(medincineID);
            var medicine_name = document.getElementById("medicine_name").value;
            if (window.XMLHttpRequest){
                xmlhttp=new XMLHttpRequest();
            }else{
                xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
            }

            xmlhttp.onreadystatechange=function(){
                if (xmlhttp.readyState==4 && xmlhttp.status==200){
                    document.getElementById("searchMedicineDiv").innerHTML=xmlhttp.responseText;
                }
            }
            //str = "delete_precribed_medicine.php?MEDICINE_ID="+k+"&PRES_ID="+pid;
            var url = "ajax/editMedicine.php?MODE=DELETE&medincineID="+medincineID+"&medicine_name="+medicine_name;   

            xmlhttp.open("GET",url,true);
            xmlhttp.send();
                
        }
        
        function editMedicine(medincineID){
            
            //alert(medincineID);
            var medicine_name = document.getElementById("medicine_name").value;
            if (window.XMLHttpRequest){
                xmlhttp=new XMLHttpRequest();
            }else{
                xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
            }

            xmlhttp.onreadystatechange=function(){
                if (xmlhttp.readyState==4 && xmlhttp.status==200){
                    document.getElementById("searchMedicineDiv").innerHTML=xmlhttp.responseText;
                }
            }
            //str = "delete_precribed_medicine.php?MEDICINE_ID="+k+"&PRES_ID="+pid;
            var url = "ajax/editMedicine.php?MODE=EDIT&medincineID="+medincineID+"&medicine_name="+medicine_name;   

            xmlhttp.open("GET",url,true);
            xmlhttp.send();
                
        }
        
        function upDateMedicine(medicineID){
            
            var med_name = document.getElementById("med_name").value;
            var medicine_name = document.getElementById("medicine_name").value;
            
            alert(medicineID);
            alert(med_name);
            if (window.XMLHttpRequest){
                xmlhttp=new XMLHttpRequest();
            }else{
                xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
            }

            xmlhttp.onreadystatechange=function(){
                if (xmlhttp.readyState==4 && xmlhttp.status==200){
                    document.getElementById("searchMedicineDiv").innerHTML=xmlhttp.responseText;
                }
            }
            //str = "delete_precribed_medicine.php?MEDICINE_ID="+k+"&PRES_ID="+pid;
            var url = "ajax/editMedicine.php?MODE=UPDATE&medincineID="+medicineID+"&medicine_name="+medicine_name+"&med_name="+med_name;   

            xmlhttp.open("GET",url,true);
            xmlhttp.send();
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
                                            <li><a href="#tab1">Patient Master</a></li>
                                            <li><a href="#tab2">Medicine Master</a></li>
                                            <li><a href="#tab3">Investigation Master</a></li>
                                        </ul>

                                        <!--BEGIN tab1-->
                                        <div id="tab1" class="tabdiv">



                                            <!--BEGIN search-->
                                            <div class="patientDetails">

                                                <span><p>Patient ID</p><input id="s_p_id" name="patient_id" type="text" class="input_box_add" value="" /></span>                
                                                <span><p>Patient Name</p><input id="s_p_name" name="patient_name" type="text" class="input_box_big" value="" /></span>               
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
                                                <span><p>Medicine Name</p><input id="medicine_name" name="medicine_name" type="text" class="input_box_big" value="" /></span>               
                                                <span><p>&nbsp;</p><input type="submit" value="Search" name="search" class="btn" onclick="searchMedicine();" /></span>


                                            </div>
                                            <!--END of search-->

                                            <!--BEGIN search results-->
                                            <div class="searchResults" id="searchMedicineDiv">

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
                                                <span><p>Investigation Name</p><input id="investigation" name="invest_name" type="text" class="input_box_big" value="" /></span>               
                                                <span><p>&nbsp;</p><input type="submit" value="Search" name="search" class="btn" onclick="searchInvestigation();" /></span>


                                            </div>
                                            <!--END of search-->

                                            <!--BEGIN search results-->
                                            <div class="searchResults" id="searchInvestDiv">

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
