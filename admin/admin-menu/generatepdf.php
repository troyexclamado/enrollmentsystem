<?php
include('dbconnection.php');

if(isset($_POST['addtransaction'])){
    $studentNumber = $_POST['studentNumber'];
    require('fpdf184/fpdf.php');
    $querystudentdetails = "SELECT * FROM tblstudents WHERE studentNumber = $studentNumber";
    $sql = mysqli_query($conn, $querystudentdetails);
    if(mysqli_num_rows($sql) > 0){
        $row = mysqli_fetch_array($sql);
        $queryname = "SELECT * FROM tblstudentaccounts WHERE studentNumber = $studentNumber";
        $sql2 = mysqli_query($conn, $queryname);
        if(mysqli_num_rows($sql2) > 0){
            $name = mysqli_fetch_array($sql2);

            //A4 WIDTH: 219mm
            //DEFAULT MARGIN: 10mm each side
            //WRITE HORIZONTAL: 219 (10*2)=189mm

            //cell (width, height, text, border, endline, [align])
            $pdf = new FPDF('p','mm','A4');

            $pdf->AddPage();
            $pdf->SetFont('Arial', 'B', 14);

            //header part
            $pdf->Cell(130,10,'UNIVERSITY OF CALOOCAN CITY',1,0);
            $pdf->Cell(59,10,'CAMPUS: CONGRESS',1,1);

            //DETAILS
            $pdf->Cell(89,5,'NAME',1,0,'C');
            $pdf->Cell(50,5,'STUDENT NUMBER',1,0,'C');
            $pdf->Cell(50,5,'DATE',1,1,'C');
            $pdf->Cell(89,5,$name['lastname'].' '.$name['firstname'].' '.$name['middlename'],1,0,'C');
            $pdf->Cell(50,5,$studentNumber,1,0,'C');
            $pdf->Cell(50,5,$row['dateOfEnrollment'],1,1,'C');
            
            $courseID = $row['courseID'];
            $querycourse = "SELECT * FROM tblcoursedetails WHERE courseID = $courseID";
            $sql3 = mysqli_query($conn, $querycourse);
            if(mysqli_num_rows($sql3) > 0){
                $courseDetails = mysqli_fetch_array($sql3);

                $pdf->Cell(70,5,'COURSE/YEAR/SECTION',1,0,'C');
                $pdf->Cell(39.66,5,'SEMESTER',1,0,'C');
                $pdf->Cell(39.66,5,'SCHOOL YEAR',1,0,'C');
                $pdf->Cell(39.66,5,'SCHEME',1,1,'C');
                $pdf->Cell(70,5,$courseDetails['courseAbbr'].' '.$courseDetails['year'].'-'.$courseDetails['section'],1,0,'C');
                $pdf->Cell(39.66,5,$courseDetails['semester'],1,0,'C');
                $pdf->Cell(39.66,5,$courseDetails['schoolYear'],1,0,'C');
                $pdf->Cell(39.66,5,$row['scheme'],1,1,'C');
            }
            
            $pdf->Cell(189,5,'SUBJECTS',1,1);
            //subjects
            if($row['studentType'] == 'REGULAR'){
                $querysubjects = "SELECT * FROM tblsubjects WHERE courseID = $courseID";
                $sql4 = mysqli_query($conn, $querysubjects);
                if(mysqli_fetch_array($sql4) > 0){
                    while($subjects = mysqli_fetch_array($sql4)){
                        $pdf->Cell(30,5,$subjects['subjectCode'],1,0);
                        $pdf->Cell(9,5,$subjects['subjectUnits'],1,0);
                        $pdf->Cell(150,5,$subjects['subjectDescription'],1,1);
                    }
                }
            }
            $pdf->Cell(139,5,'REMARS/PAYMENT',1,0,'C');
            $pdf->Cell(50,5,'MIS',1,1,'C');
            
            $querytransaction = "SELECT * FROM tblstudenttransactions WHERE studentNumber = $studentNumber";
            $sql5 = mysqli_query($conn, $querytransaction);
            if(mysqli_num_rows($sql5) > 0){
                $transaction = mysqli_fetch_array($sql5);

                $pdf->Cell(100,5,'TF OR# '.$transaction['OR_NUMBER'],1,0,'L');
                $pdf->Cell(39,5,$transaction['TF_AMOUNT'],1,0,'C');
                $pdf->Cell(50,5,'TROY',1,1,'C');
                $pdf->Cell(100,5,'MF OR# '.$transaction['OR_NUMBER'],1,0,'L');
                $pdf->Cell(39,5,$transaction['MF_AMOUNT'],1,0,'C');
                $pdf->Cell(50,5,'PC',1,1,'C');
                $pdf->Cell(100,5,'TOTAL PAYMENT',1,0,'L');
                $pdf->Cell(39,5,$transaction['totalAmount'],1,0,'C');
                $pdf->Cell(50,5,$row['dateOfEnrollment'],1,1,'C');
                $pdf->Cell(100,5,'OR DATE',1,0,'L');
                $pdf->Cell(39,5,$transaction['OR_DATE'],1,0,'C');
                $pdf->Cell(50,5,'',1,1,'C');
                $pdf->Cell(100,5,'AMOUNT DUE',1,0,'L');
                $pdf->Cell(39,5,$transaction['totalAmount'],1,0,'C');
                $pdf->Cell(50,5,'',1,1,'C');
                $pdf->Cell(100,5,'BALANCE',1,0,'L');
                $pdf->Cell(39,5,$transaction['balance'],1,0,'C');
                $pdf->Cell(50,5,'',1,1,'C');
                $pdf->Cell(100,5,'PENALTY',1,0,'L');
                $pdf->Cell(39,5,$transaction['penalty'],1,0,'C');
                $pdf->Cell(50,5,'',1,1,'C');
                $pdf->Cell(100,5,'TNC',1,0,'L');
                $pdf->Cell(39,5,$transaction['TNC'],1,0,'C');
                $pdf->Cell(50,5,'',1,1,'C');          
            }
            $pdf->Output();
        }

    }

    
}
?>