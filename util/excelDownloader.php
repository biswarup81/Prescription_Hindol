<?php

function csvToExcelDownloadFromResult($result, $showColumnHeaders = true, $asFilename = 'data.csv') {
    setExcelContentType();
    setDownloadAsHeader($asFilename);
    return csvFileFromResult('php://output', $result, $showColumnHeaders);
}

function csvFileFromResult($filename, $result, $showColumnHeaders = true) {
    $fp = fopen($filename, 'w');
    $rc = csvFromResult($fp, $result, $showColumnHeaders);
    fclose($fp);
    return $rc;
}

function csvFromResult($stream, $result, $showColumnHeaders = true) {
    if($showColumnHeaders) {
        $columnHeaders = array();
        $nfields = mysql_num_fields($result);
        for($i = 0; $i < $nfields; $i++) {
            $field = mysql_fetch_field($result, $i);
            $columnHeaders[] = $field->name;
        }
        fputcsv($stream, $columnHeaders);
    }

    $nrows = 0;
    while($row = mysql_fetch_row($result)) {
        fputcsv($stream, $row);
        $nrows++;
    }

    return $nrows;
}

function setExcelContentType() {
    if(headers_sent())
        return false;

    header('Content-type: application/vnd.ms-excel');
    return true;
}

function setDownloadAsHeader($filename) {
    if(headers_sent())
        return false;

    header('Content-disposition: attachment; filename=' . $filename);
    return true;
}
require_once "../datacon.php";

/*$mode = $_GET["MODE"];

if($mode == "PATIENTDATA"){
    
} */

$sql1 = "";

if(isset($_GET['CI']) ){
	$ci = $_GET["CI"];
	$sql1 = "SELECT a.clinical_impression_id, a.prescription_id, b.visit_id, c.patient_id,
		d.GENDER, d.patient_first_name, d.patient_last_name, d.patient_name, d.patient_city, d.patient_dob, 
		d.age, d.patient_cell_num, d.data_entry_date, d.patient_address, d.patient_email, c.visit_date, TIMESTAMPDIFF(YEAR, d.patient_dob, CURDATE()) AS patient_age
		FROM prescribed_cf a, prescription b, visit c, patient d, clinical_impression e
		WHERE e.TYPE ='".$ci."'
		and e.ID = a.clinical_impression_id
		and a.prescription_id=b.prescription_id
		and b.visit_id = c.visit_id
		and c.patient_id = d.patient_id
		ORDER BY d.patient_first_name ASC";
}

if(isset($_GET['MEDICINE_NAME']) ){
	$medicine_name = $_GET['MEDICINE_NAME'];
	$sql1 = "select pm.PRESCRIPTION_ID, pm.MEDICINE_NAME, v.visit_date,  p.patient_first_name, p.patient_last_name, p.GENDER, 
			TIMESTAMPDIFF(YEAR, p.patient_dob, CURDATE()) AS age, p.patient_id, v.visit_id
			from precribed_medicine pm, prescription pres, visit v, patient p 
			where MEDICINE_NAME like '%".$medicine_name."%' and
			pm.PRESCRIPTION_ID=pres.PRESCRIPTION_ID and
			pres.visit_id = v.visit_id and
			v.patient_id = p.patient_id";
}

$result = mysqli_query($con,$sql1);
csvToExcelDownloadFromResult($result);

?>
