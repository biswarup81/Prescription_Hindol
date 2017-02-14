/* THIS IS A CUSTOM JAVASCRIPT FILE */


function deleteClinicalImpression(ci_id, pres_id){
    //alert("ID -> "+ci_id);
    //alert("Prescription Id -> "+pres_id);
    if (window.XMLHttpRequest){
  		xmlhttp=new XMLHttpRequest();
    }else{
            xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
    }

            xmlhttp.onreadystatechange=function(){
            if (xmlhttp.readyState==4 && xmlhttp.status==200){
                
                document.getElementById("CI").innerHTML=xmlhttp.responseText;
        }
    }
    str = "ajax/delete_clinical_impression.php?mode=DELETE_CLINICAL_IMPRESSION&ID="+ci_id+"&PRESCRIPTION_ID="+pres_id;

    xmlhttp.open("GET",str,true);
    xmlhttp.send();
    document.getElementById("CI").focus();
    return false;
}


function deletePastMedicalHistory(ci_id, pres_id){
    //alert("ID -> "+ci_id);
    //alert("Prescription Id -> "+pres_id);
    if (window.XMLHttpRequest){
  		xmlhttp=new XMLHttpRequest();
    }else{
            xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
    }

            xmlhttp.onreadystatechange=function(){
            if (xmlhttp.readyState==4 && xmlhttp.status==200){
                
                document.getElementById("PastMedical").innerHTML=xmlhttp.responseText;
        }
    }

	str = "ajax/delete_past_medical_history.php?mode=DELETE_CLINICAL_IMPRESSION&ID="+ci_id+"&PRESCRIPTION_ID="+pres_id;
    xmlhttp.open("GET",str,true);
    xmlhttp.send();
    document.getElementById("PastMedical").focus()
    return false;
}

function addClinicalImpression(prescriptionid){
    //alert("TYPE -> "+type);
    //alert("Prescription Id -> "+prescriptionid);
    var citype = document.getElementById("txtCI").value;
    //alert("TYPE ->"+ citype);
    if(citype == "" || citype == null)
    {
        alert ("Clinical Impression cannot be blank")
    } else {

        if (window.XMLHttpRequest){
                    xmlhttp=new XMLHttpRequest();
        }else{
                xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
        }

                xmlhttp.onreadystatechange=function(){
                if (xmlhttp.readyState==4 && xmlhttp.status==200){
                    //document.getElementById("CI").innerHTML = "";
                    //alert(xmlhttp.responseText);
                    document.getElementById("CI").innerHTML=xmlhttp.responseText;
                    document.getElementById("txtCI").value = "";
                    
            }
        }
        
        
        str = "ajax/add_clinical_impression.php?mode=ADD_CLINICAL_IMPRESSION&TYPE="+citype+"&prescription_id="+prescriptionid;

        xmlhttp.open("GET",str,true);
        xmlhttp.send();
    }
    document.getElementById("txtCI").focus();
    return false;
}

function addPastMedicalHistory(prescriptionid){
    //alert("TYPE -> "+type);
    //alert("Prescription Id -> "+prescriptionid);
    var citype = document.getElementById("txtPastMedical").value;
    //alert("TYPE ->"+ citype);
    if(citype == "" || citype == null)
    {
        alert ("Past Medical History cannot be blank")
    } else {
        citype = citype.toUpperCase();
        if (window.XMLHttpRequest){
                    xmlhttp=new XMLHttpRequest();
        }else{
                xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
        }

                xmlhttp.onreadystatechange=function(){
                if (xmlhttp.readyState==4 && xmlhttp.status==200){
                    //document.getElementById("CI").innerHTML = "";
                    //alert(xmlhttp.responseText);
                    document.getElementById("PastMedical").innerHTML=xmlhttp.responseText;
                    document.getElementById("txtPastMedical").value = "";
                    
            }
        }
        
        
        str = "ajax/add_past_medical_history.php?mode=ADD_CLINICAL_IMPRESSION&TYPE="+citype+"&prescription_id="+prescriptionid;

        xmlhttp.open("GET",str,true);
        xmlhttp.send();
    }
    document.getElementById("txtPastMedical").focus();
    return false;
}

function addPatient(){
       
    var patient_name = document.getElementById("patient_name").value;
    var sex = document.getElementById("sex").value;
    var age = document.getElementById("age").value;
    var cell = document.getElementById("cell").value;
    if(patient_name == "" || patient_name == null) {
        alert ("Patient Name cannot be blank");
        return false;
    } else if(sex == "" || sex == null)  {
        alert ("Sex Value cannot be blank");
        return false;
    } else if(age == "" || age == null) {
        alert ("Age cannot be blank");
        return false;
    } else if(cell == "" || cell == null)  {
        alert ("Mobile number cannot be blank");
        return false;
    } else {
        return true;
        /*
        //Add in dadabase
        if (window.XMLHttpRequest){
                    xmlhttp=new XMLHttpRequest();
        }else{
                xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
        }

                xmlhttp.onreadystatechange=function(){
                if (xmlhttp.readyState==4 && xmlhttp.status==200){

                    //document.getElementById("CF").innerHTML=xmlhttp.responseText;
                    alert("SUCCESS");
                    //var respText = "Patient added with patient ID : "+xmlhttp.responseText;
                    //document.getElementById("add_success").innerHTML=respText;
                   
            }
        }
        str = "ajax/add_patient.php?patient_name="+patient_name+"&sex="+sex+"&age="+age+"&cell="+cell;

        xmlhttp.open("GET",str,true);
        xmlhttp.send();
        */
    }
}
   
function addCF(visit_id){
    //alert("visit_id -> "+visit_id);
    //alert("Prescription Id -> "+prescriptionid);
    var cfname = document.getElementById("txtCFName").value;
    var cfvalue = document.getElementById("txtCFValue").value;
    //alert("TYPE ->"+ citype);
    if(cfname == "" || cfname == null) {
        alert ("C/F Name cannot be blank")
    } else if(cfvalue == "" || cfvalue == null)  {
        alert ("C/F Value cannot be blank")
    }else {
        if(cfvalue == '+'){
            cfvalue = 'PLUS';
        }
        if (window.XMLHttpRequest){
                    xmlhttp=new XMLHttpRequest();
        }else{
                xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
        }

                xmlhttp.onreadystatechange=function(){
                if (xmlhttp.readyState==4 && xmlhttp.status==200){
                    //document.getElementById("CI").innerHTML = "";
                    //alert(xmlhttp.responseText);
                    document.getElementById("CF").innerHTML=xmlhttp.responseText;
                    document.getElementById("txtCFName").value = "";
                    document.getElementById("txtCFValue").value = "";
                    
            }
        }
        
        
        str = "ajax/add_cf.php?mode=ADD_CF&cfname="+cfname+"&cfvalue="+cfvalue+"&visit_id="+visit_id;

        xmlhttp.open("GET",str,true);
        xmlhttp.send();
    }
    document.getElementById("txtCFName").focus();
    return false;
}

function updateDeleteCF(cf_id, visit_id, mode){
    //alert("ID -> "+ci_id);
    //alert("Prescription Id -> "+pres_id);
    //alert(thisObj.parentNode.parentNode.childNodes[0].innerText);
    
    var cfvalue = document.getElementById("CF_"+cf_id).value;
    //alert(cf_id +" "+visit_id+"  "+mode);
    //alert(cfvalue);
    if(cfvalue == "" || cfvalue == null)  {
        alert ("C/F Value cannot be blank")
    } else {
        if(cfvalue == '+'){
            cfvalue = 'PLUS';
        }
        if (window.XMLHttpRequest){
                    xmlhttp=new XMLHttpRequest();
        }else{
                xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
        }

                xmlhttp.onreadystatechange=function(){
                if (xmlhttp.readyState==4 && xmlhttp.status==200){

                    document.getElementById("CF").innerHTML=xmlhttp.responseText;
            }
        }
        str = "ajax/delete_cf.php?mode=ADD_CF&ID="+cf_id+"&visit_id="+visit_id+"&mode="+mode+"&cfvalue="+cfvalue;

        xmlhttp.open("GET",str,true);
        xmlhttp.send();
    }
    document.getElementById("txtCFName").focus();
    return false;
}



function deleteAllergy(allergy_id, pres_id){
    //alert("social_history_id -> "+social_history_id);
    //alert("Prescription Id -> "+pres_id);
    if (window.XMLHttpRequest){
  		xmlhttp=new XMLHttpRequest();
    }else{
            xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
    }

            xmlhttp.onreadystatechange=function(){
            if (xmlhttp.readyState==4 && xmlhttp.status==200){
                
                document.getElementById("ALLERGY").innerHTML=xmlhttp.responseText;
        }
    }
    str = "ajax/delete_allergy.php?mode=DELETE_ALLERGY&ID="+allergy_id+"&PRESCRIPTION_ID="+pres_id;

    xmlhttp.open("GET",str,true);
    xmlhttp.send();
    document.getElementById("ALLERGY").focus();
    return false;
}

function addSocialHistory(prescriptionid){
    //alert("TYPE -> "+type);
    //alert("Prescription Id -> "+prescriptionid);
    var socialHistory = document.getElementById("txtSocialHistory").value;
    alert("TYPE ->"+ socialHistory);
    
    if(socialHistory == "" || socialHistory == null)
    {
        alert ("Social History Cannot be blank")
    } else {

        if (window.XMLHttpRequest){
                    xmlhttp=new XMLHttpRequest();
        }else{
                xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
        }

                xmlhttp.onreadystatechange=function(){
                if (xmlhttp.readyState==4 && xmlhttp.status==200){
                    //document.getElementById("CI").innerHTML = "";
                    //alert(xmlhttp.responseText);
                    document.getElementById("SOCIAL_HISTORY").innerHTML=xmlhttp.responseText;
                    document.getElementById("txtSocialHistory").value = "";
                    
            }
        }
        
        
        str = "ajax/add_social_history.php?mode=ADD_SOCIAL_HISTORY&TYPE="+socialHistory+"&prescription_id="+prescriptionid;

        xmlhttp.open("GET",str,true);
        xmlhttp.send();
        
    }
    document.getElementById("txtSocialHistory").focus(); 
    return false;
}

function addAllergy(prescriptionid){
    //alert("TYPE -> "+type);
    //alert("Prescription Id -> "+prescriptionid);
    var allergy = document.getElementById("txtAllergy").value;
    //alert("Allergy ->"+ allergy);
    
    if(allergy === "" || allergy === null)
    {
        alert ("Allergy Cannot be blank");
    } else {

        if (window.XMLHttpRequest){
                    xmlhttp=new XMLHttpRequest();
        }else{
                xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
        }

                xmlhttp.onreadystatechange=function(){
                if (xmlhttp.readyState==4 && xmlhttp.status==200){
                    //document.getElementById("CI").innerHTML = "";
                    //alert(xmlhttp.responseText);
                    document.getElementById("ALLERGY").innerHTML=xmlhttp.responseText;
                    document.getElementById("txtAllergy").value = "";
                    
            }
        }
        
        
        str = "ajax/add_allergy.php?mode=ADD_ALLERGY&TYPE="+allergy+"&prescription_id="+prescriptionid;

        xmlhttp.open("GET",str,true);
        xmlhttp.send();
    }
    document.getElementById("txtAllergy").focus();
    return false;
}

function deleteSocialHistory(social_history_id, pres_id){
    alert("social_history_id -> "+social_history_id);
    alert("Prescription Id -> "+pres_id);
    if (window.XMLHttpRequest){
  		xmlhttp=new XMLHttpRequest();
    }else{
            xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
    }

            xmlhttp.onreadystatechange=function(){
            if (xmlhttp.readyState==4 && xmlhttp.status==200){
                
                document.getElementById("txtSocialHistory").innerHTML=xmlhttp.responseText;
        }
    }
    str = "ajax/delete_social_history.php?mode=DELETE_SOCIAL_HISTORY&ID="+social_history_id+"&PRESCRIPTION_ID="+pres_id;

    xmlhttp.open("GET",str,true);
    xmlhttp.send();
    document.getElementById("txtSocialHistory").focus();
    return false;
}

function saveResult()
{
/*if (str.length==0)
  {
  document.getElementById("medicine").innerHTML="";
  document.getElementById("medicine").style.border="0px";
  return;
  }*/
if (window.XMLHttpRequest)
  {// code for IE7+, Firefox, Chrome, Opera, Safari
  xmlhttp=new XMLHttpRequest();
  }
else
  {// code for IE6, IE5
  xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
  }
  ///////////////////////////////////////
  var medicine_name = document.getElementById("course").value;
  var dose1 = document.getElementById("dose1").value;
  
  var dose1dir = getCheckedRadio("bfradio");
  var dose2 = document.getElementById("dose2").value;
  var dose2dir = getCheckedRadio("lradio");
  var dose3 = document.getElementById("dose3").value;
  var dose3dir = getCheckedRadio("dradio")
  var duration = document.getElementById("duration_count").value + " "+document.getElementById("duration_type").value
  var dosage = "";
  
  if(dose1dir != ""){
      dosage = dosage +dose1+ " "+ dose1dir+" breakfast for "+duration;
  }
  if(dose2dir != ""){
      dosage = dosage +dose2+ " "+ dose2dir+" lunch for "+duration;
  }
  if(dose3dir != ""){
      dosage = dosage +dose3+ " "+ dose3dir+" dinner for "+duration;
  }
  
  alert(dosage);
 
 
  var patient_id = document.getElementById("patient_id").value;
  var PRESCRIPTION_ID = document.getElementById("PRESCRIPTION_ID").value;
  var VISIT_ID = document.getElementById('VISIT_ID').value;
  
  if(medicine_name == ""){
	  alert("Name should not be Blank");
          document.getElementById("course").focus();
	  return false;
  }else if(dosage == ""){
	  alert("Dosage Should not be blank");
          document.getElementById("dose1").focus();
	  return false;
  }
  
 // alert(medicine_name + dose + direction + timing + patient_id);
  //////////////////////////////////////
  


  
xmlhttp.onreadystatechange=function() {
  if (xmlhttp.readyState==4 && xmlhttp.status==200) {
        document.getElementById("medicine").innerHTML=xmlhttp.responseText;
      	
        document.getElementById("course").value = "";
        document.getElementById("dose1").value = "";
        document.getElementById("dose2").value = "";
        document.getElementById("dose3").value = "";
        //Clear All Radio Button
        clearAllRadioButton();
        document.getElementById("course").focus();
        
    }
  }
  str = "ajax/livesearch.php?mode=ADD_MEDICINDE&medicine_name="+medicine_name+"&dose="
            +dosage+"&patient_id="+patient_id+"&PRESCRIPTION_ID="
            +PRESCRIPTION_ID+"&VISIT_ID="+VISIT_ID+"&dose1="+dose1+"&dose2="+dose2+"&dose3="+dose3;
  //alert(str);
  
  
  
  
  xmlhttp.open("GET",str,true);
  xmlhttp.send();
  
  
  return false;
}

function del(k,pid){
	alert("Medicine ID="+k);
        alert("pRESCRIPTION id = "+pid);
  if (window.XMLHttpRequest){
  		xmlhttp=new XMLHttpRequest();
  }else{
  	xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
  }
  
	xmlhttp.onreadystatechange=function(){
  	if (xmlhttp.readyState==4 && xmlhttp.status==200){
            document.getElementById("medicine").innerHTML=xmlhttp.responseText;
            document.getElementById("course").focus();
    }
  }
  str = "ajax/delete_precribed_medicine.php?mode=DELETE_MEDICINE&MEDICINE_ID="+k+"&PRES_ID="+pid;
  
  xmlhttp.open("GET",str,true);
  xmlhttp.send();
  
  return false;
  
}


function addInvestigation(type){
    var invname ;
    var divObj = null;
    var PRESCRIPTION_ID = document.getElementById("PRESCRIPTION_ID").value;
    //alert('prescription id -> '+PRESCRIPTION_ID);
    if(type == 'TYPE1'){
            //alert( document.getElementById("invest1").value);
            invname = document.getElementById("invest1").value;
            divObj = document.getElementById("tab111");
            document.getElementById("invest1").value = "";
            document.getElementById("invest1").focus();
    } else if (type == 'TYPE2'){
           // alert( document.getElementById("invest2").value);
            invname = document.getElementById("invest2").value;
            divObj = document.getElementById("tab112");
            document.getElementById("invest2").value = "";
            document.getElementById("invest2").focus();
    } else if (type == 'TYPE3'){
            //alert( document.getElementById("invest3").value);
            invname = document.getElementById("invest3").value;
            divObj = document.getElementById("tab113");
            document.getElementById("invest3").value = "";
            document.getElementById("invest3").focus();
    } else if (type == 'TYPE4'){
           // alert( document.getElementById("invest4").value);
            invname = document.getElementById("invest4").value;
            divObj = document.getElementById("tab114");
            document.getElementById("invest4").value = "";
            document.getElementById("invest4").focus();
    } else if (type == 'TYPE5'){
            //alert( document.getElementById("invest5").value);
            invname = document.getElementById("invest5").value;
            divObj = document.getElementById("tab115");
            document.getElementById("invest5").value = "";
            document.getElementById("invest5").focus();
    } else if (type == 'TYPE6'){
            //alert( document.getElementById("invest6").value);
            invname = document.getElementById("invest6").value;
            divObj = document.getElementById("tab116");
            document.getElementById("invest6").value = "";
            document.getElementById("invest6").focus();
    } else if (type == 'TYPE7'){
            //alert( document.getElementById("invest7").value);
            invname = document.getElementById("invest7").value;
            divObj = document.getElementById("tab117");
            document.getElementById("invest7").value = "";
            document.getElementById("invest7").focus();
    } else if (type == 'TYPE8'){
            //alert( document.getElementById("invest7").value);
            invname = document.getElementById("invest8").value;
            divObj = document.getElementById("tab118");
            document.getElementById("invest8").value = "";
            document.getElementById("invest8").focus();
    } else if (type == 'TYPE9'){
            //alert( document.getElementById("invest7").value);
            invname = document.getElementById("invest9").value;
            divObj = document.getElementById("tab119");
            document.getElementById("invest9").value = "";
            document.getElementById("invest9").focus();
    } else if (type == 'TYPE10'){
            //alert( document.getElementById("invest7").value);
            invname = document.getElementById("invest10").value;
            divObj = document.getElementById("tab1110");
            document.getElementById("invest10").value = "";
            document.getElementById("invest10").focus();
    } else if (type == 'TYPE11'){
            //alert( document.getElementById("invest7").value);
            invname = document.getElementById("invest11").value;
            divObj = document.getElementById("tab1111");
            document.getElementById("invest11").value = "";
            document.getElementById("invest11").focus();
    } else if (type == 'TYPE12'){
            //alert( document.getElementById("invest7").value);
            invname = document.getElementById("invest12").value;
            divObj = document.getElementById("tab1112");
            document.getElementById("invest12").value = "";
            document.getElementById("invest12").focus();
    } else if (type == 'TYPE13'){
            //alert( document.getElementById("invest7").value);
            invname = document.getElementById("invest13").value;
            divObj = document.getElementById("tab1113");
            document.getElementById("invest13").value = "";
            document.getElementById("invest13").focus();
    }
    if (window.XMLHttpRequest) {// code for IE7+, Firefox, Chrome, Opera, Safari
        xmlhttp=new XMLHttpRequest();
    } else
    {// code for IE6, IE5
    xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
    }

    xmlhttp.onreadystatechange=function(){
    if (xmlhttp.readyState==4 && xmlhttp.status==200){
        //divObj.innerHTML=divObj.innerHTML+xmlhttp.responseText;
        var element = document.createElement("input");
 
        //Assign different attributes to the element.
        element.setAttribute("type", "checkbox");
        element.setAttribute("value", xmlhttp.responseText);
        element.setAttribute("name", xmlhttp.responseText);
        element.setAttribute("checked", true);
        divObj.appendChild(element);
        var txt = document.createTextNode(" "+xmlhttp.responseText+" "); 
        divObj.appendChild(txt);
        
        }
    }
    str = "ajax/inserintoinvmaster.php?mode=ADD_INVESTIGATION&investigation_name="
            +invname+"&investigation_type="+type+"&PRESCRIPTION_ID="+PRESCRIPTION_ID;
    xmlhttp.open("GET",str,true);
    xmlhttp.send();
    return false;
}

function removeVisit(visit_id){
  //alert(visit_id)  ;
  if (window.XMLHttpRequest){
  		xmlhttp=new XMLHttpRequest();
  }else{
  	xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
  }
  
  xmlhttp.onreadystatechange=function(){
    if (xmlhttp.readyState==4 && xmlhttp.status==200){
           //alert(xmlhttp.responseText);
           document.getElementById("visit_list").innerHTML=xmlhttp.responseText;
           
    }
  };
  str = "ajax/removevisit.php?mode=REMOVE_VISIT&VISIT_ID="+visit_id;
  //alert(str);
  xmlhttp.open("GET",str,true);
  xmlhttp.send();
  
  return false;  
}

function backtoVisit(){
  location.href= "visit_list.php";
}

function startPrescription(patientId){
    alert(patientId);
}


function addPatientInvestigation(patientid, visit_id){
    //alert("TYPE -> "+type);
    //alert("Prescription Id -> "+prescriptionid);
    var invName = document.getElementById("investigation").value;
    var invVal = document.getElementById("txtPatientInvval").value;
    //alert("TYPE ->"+ citype);
    if(invName == "" || invName == null )
    {
        alert ("Investigation Name cannot be blank");
        document.getElementById("txtPatientInv").focus();
    }if(invVal == "" || invVal == null )
    {
        alert ("Investigation Value cannot be blank");
        document.getElementById("txtPatientInvval").focus();
    } else {

        if (window.XMLHttpRequest){
                    xmlhttp=new XMLHttpRequest();
        }else{
                xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
        }

                xmlhttp.onreadystatechange=function(){
                if (xmlhttp.readyState==4 && xmlhttp.status==200){
                    //document.getElementById("CI").innerHTML = "";
                    //alert(xmlhttp.responseText);
                    window.location.reload();
                    document.getElementById("INV").innerHTML=xmlhttp.responseText;
                    document.getElementById("investigation").value = "";
                    document.getElementById("txtPatientInvval").value = "";
                    document.getElementById("investigation").focus();
                    
            }
        }
        
        
        str = "ajax/add_patient_investigation.php?mode=ADD_PATIENT_INVESTIGATION"+
            "&patientid="+patientid+"&visit_id="+visit_id+"&invName="+invName+"&invVal="+invVal;
        
        xmlhttp.open("GET",str,true);
        xmlhttp.send();
    }
    document.getElementById("txtCI").focus();
    return false;
}

function deletePatientInvestigation(visit_id, investigation_id){
    //alert('Delete Patient Investigation -> '+visit_id+'  '+investigation_id);
    
     if (window.XMLHttpRequest){
                    xmlhttp=new XMLHttpRequest();
        }else{
                xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
        }

                xmlhttp.onreadystatechange=function(){
                if (xmlhttp.readyState==4 && xmlhttp.status==200){
                    xmlDoc = xmlhttp.responseText;
                    window.location.reload();
                    //document.getElementById("new").innerHTML = xmlhttp.responseText;
                    //document.getElementById("investigation").focus();
                   
            }
        }
        
        
        str = "ajax/delete_patient_investigation.php?mode=DELETE_PATIENT_INVESTIGATION"+
            "&INVESTIGATION_ID="+investigation_id+"&VISIT_ID="+visit_id;
        
        xmlhttp.open("GET",str,true);
        xmlhttp.send();
    
    
    return false;
}

$(document).ready(function(){
    $("#investigation").autocomplete("get_investigation_list.php", 

    {
            width: 260,
            matchContains: true,
            //mustMatch: true,
            //minChars: 0,
            //multiple: true,
            //highlight: false,
            //multipleSeparator: ",",
            selectFirst: false
    });
    
	//List of Investigation types #inv_type
	$("#inv_type").autocomplete("get_InvestigationType.php", {
		width: 260,
		matchContains: true,
		//mustMatch: true,
		//minChars: 0,
		//multiple: true,
		//highlight: false,
		//multipleSeparator: ",",
		selectFirst: false
	});
    
    //#course : Medicaine List Start
    $("#course").autocomplete("get_course_list.php", {
		width: 260,
		matchContains: true,
		//mustMatch: true,
		//minChars: 0,
		//multiple: true,
		//highlight: false,
		//multipleSeparator: ",",
		selectFirst: false
	});
    
        $("#dose1").autocomplete("get_dose_list.php", {
		width: 260,
		matchContains: true,
		//mustMatch: true,
		//minChars: 0,
		//multiple: true,
		//highlight: false,
		//multipleSeparator: ",",
		selectFirst: false
	});
        $("#dose1").autocomplete("get_dose_list.php", {
		width: 260,
		matchContains: true,
		//mustMatch: true,
		//minChars: 0,
		//multiple: true,
		//highlight: false,
		//multipleSeparator: ",",
		selectFirst: false
	});
        $("#dose2").autocomplete("get_dose_list.php", {
		width: 260,
		matchContains: true,
		//mustMatch: true,
		//minChars: 0,
		//multiple: true,
		//highlight: false,
		//multipleSeparator: ",",
		selectFirst: false
	});
        $("#dose3").autocomplete("get_dose_list.php", {
		width: 260,
		matchContains: true,
		//mustMatch: true,
		//minChars: 0,
		//multiple: true,
		//highlight: false,
		//multipleSeparator: ",",
		selectFirst: false
	});
        $("#direction").autocomplete("get_direction_list.php", {
		width: 260,
		matchContains: true,
		//mustMatch: true,
		//minChars: 0,
		//multiple: true,
		//highlight: false,
		//multipleSeparator: ",",
		selectFirst: false
	});
         $("#timing").autocomplete("get_timing_list.php", {
		width: 260,
		matchContains: true,
		//mustMatch: true,
		//minChars: 0,
		//multiple: true,
		//highlight: false,
		//multipleSeparator: ",",
		selectFirst: false
	});
        $("#txtCI").autocomplete("get_clinical_impression.php", {
		width: 260,
		matchContains: true,
		//mustMatch: true,
		//minChars: 0,
		//multiple: true,
		//highlight: false,
		//multipleSeparator: ",",
		selectFirst: false
	});
        $("#txtPastMedical").autocomplete("get_past_medical_history.php", {
		width: 260,
		matchContains: true,
		//mustMatch: true,
		//minChars: 0,
		//multiple: true,
		//highlight: false,
		//multipleSeparator: ",",
		selectFirst: false
	});
        $("#txtAllergy").autocomplete("get_allergy_list.php", {
		width: 260,
		matchContains: true,
		//mustMatch: true,
		//minChars: 0,
		//multiple: true,
		//highlight: false,
		//multipleSeparator: ",",
		selectFirst: false
	});
        
        $("#txtCFName").autocomplete("get_cf.php", {
		width: 260,
		matchContains: true,
		//mustMatch: true,
		//minChars: 0,
		//multiple: true,
		//highlight: false,
		//multipleSeparator: ",",
		selectFirst: false
	});
        $("#txtSocialHistory").autocomplete("get_social_history.php", {
		width: 260,
		matchContains: true,
		//mustMatch: true,
		//minChars: 0,
		//multiple: true,
		//highlight: false,
		//multipleSeparator: ",",
		selectFirst: false
	});
        $( "#datepicker1" ).datepicker({
                changeMonth: true,
                changeYear: true,
                showOn: "button",
                buttonImage: "images/calendar.gif",
                buttonImageOnly: true,
                dateFormat: "dd-mm-yy"
        });
	$('#plus7').click(function(e) {
            e.preventDefault();
        });
        $('#minus7').click(function(e) {
            e.preventDefault();
        });
        $('a').click(function (e) {
            e.preventDefault();
          });
 });

function getCheckedRadio(elementName) {
    var radioButtons = document.getElementsByName(elementName);
    var result = "";
    for (var x = 0; x < radioButtons.length; x ++) {
        if (radioButtons[x].checked) {
            result = radioButtons[x].value;
        }
    }
    return result;
}

function clearAllRadioButton(){
    clearRadioButtonGroup("bfradio");
    
    
 
    clearRadioButtonGroup("lradio");
    
    
    clearRadioButtonGroup("dradio");
    
   return false;
}
function clearRadioButtonGroup(elementName){
    var radioButtons = document.getElementsByName(elementName); 
    
    for (var x = 0; x < radioButtons.length; x ++) {
        radioButtons[x].checked = false;
    }
    
    return false;
}