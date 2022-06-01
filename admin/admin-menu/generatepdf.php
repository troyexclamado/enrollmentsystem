<?php
include('dbconnection.php');
session_start();

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
            $pdf->Image('ucclogo.jpg',10,10,10,10);
            $pdf->Cell(10,10,'','TLB',0);
            $pdf->Cell(120,10,'UNIVERSITY OF CALOOCAN CITY','TB',0);
            $pdf->Cell(59,10,'CAMPUS: CONGRESS','TRB',1);

            //DETAILS
            $pdf->Cell(189,3,'',0,1);
            $pdf->Cell(189,1,'','TRL',1);
            $pdf->SetFont('Arial', 'B', 14);
            $pdf->Cell(89,5,'NAME','L',0,'C');
            $pdf->Cell(50,5,'STUDENT NUMBER',0,0,'C');
            $pdf->Cell(50,5,'DATE','R',1,'C');
            $pdf->SetFont('Arial', '', 12);
            $pdf->Cell(89,5,$name['lastname'].' '.$name['firstname'].' '.$name['middlename'],'L',0,'C');
            $pdf->Cell(50,5,$studentNumber,0,0,'C');
            $pdf->Cell(50,5,$row['dateOfEnrollment'],'R',1,'C');
            
            $courseID = $row['courseID'];
            $querycourse = "SELECT * FROM tblcoursedetails WHERE courseID = $courseID";
            $sql3 = mysqli_query($conn, $querycourse);
            if(mysqli_num_rows($sql3) > 0){
                $courseDetails = mysqli_fetch_array($sql3);

                $pdf->Cell(189,2,'','LR',1);
                $pdf->SetFont('Arial', 'B', 14);
                $pdf->Cell(70,5,'COURSE/YEAR/SECTION','L',0,'C');
                $pdf->Cell(39.66,5,'SEMESTER',0,0,'C');
                $pdf->Cell(39.66,5,'SCHOOL YEAR',0,0,'C');
                $pdf->Cell(39.66,5,'SCHEME','R',1,'C');
                $pdf->SetFont('Arial', '', 12);
                $pdf->Cell(70,5,$courseDetails['courseAbbr'].' '.$courseDetails['year'].'-'.$courseDetails['section'],'L',0,'C');
                $pdf->Cell(39.66,5,$courseDetails['semester'],0,0,'C');
                $pdf->Cell(39.66,5,$courseDetails['schoolYear'],0,0,'C');
                $pdf->Cell(39.66,5,$row['scheme'],'R',1,'C');
            }
            $pdf->Cell(189,2,'','T',1);
            $pdf->SetFont('Arial', 'B', 14);
            $pdf->Cell(189,2,'','TRL',1);
            $pdf->Cell(189,5,'SUBJECTS','LR',1);
            $pdf->Cell(189,1,'','BRL',1);
            //subjects
                $subjects1 = "SELECT subjectCode FROM tblenrolledsubjects WHERE studentNumber = $studentNumber AND courseID = $courseID";
                $result = mysqli_query($conn, $subjects1);
                if(mysqli_num_rows($result) > 0){
                    while($row1 = mysqli_fetch_array($result)){
                        $subjectCode = $row1['subjectCode'];
                        $querysubjects = "SELECT * FROM tblsubjects WHERE subjectCode = '$subjectCode'";
                        $sql4 = mysqli_query($conn, $querysubjects);
                        if(mysqli_num_rows($sql4) > 0){
                            $pdf->SetFont('Arial', '', 12);
                            $subjects = mysqli_fetch_array($sql4);
                            $pdf->Cell(30,5,$subjects['subjectCode'],'LB',0);
                            $pdf->Cell(9,5,$subjects['subjectUnits'],'B',0);
                            $pdf->Cell(150,5,$subjects['subjectDescription'],'RB',1);
                        }
                    }
                }
            $pdf->Cell(189,2,'',0,1);
            $pdf->Cell(139,2,'','TL',0);
            $pdf->Cell(50,2,'','TLR',1);
            $pdf->SetFont('Arial', 'B', 14);
            $pdf->Cell(139,5,'REMARS/PAYMENT','L',0,'C');
            $pdf->Cell(50,5,'MIS','LR',1,'C');
            $pdf->Cell(139,2,'','BL',0);
            $pdf->Cell(50,2,'','BLR',1);
            
            $querytransaction = "SELECT * FROM tblstudenttransactions WHERE studentNumber = $studentNumber";
            $sql5 = mysqli_query($conn, $querytransaction);
            if(mysqli_num_rows($sql5) > 0){
                $transaction = mysqli_fetch_array($sql5);

                $pdf->Cell(139,2,'','L',0);
                $pdf->Cell(50,2,'','LR',1);
                $pdf->Cell(100,5,'TF OR# '.$transaction['OR_NUMBER'],'LB',0,'L');
                $pdf->SetFont('Arial', '', 12);
                $pdf->Cell(39,5,$transaction['TF_AMOUNT'],'B',0,'C');
                $pdf->Cell(50,5,$_SESSION['FIRSTNAME'],'LRB',1,'C');
                $pdf->SetFont('Arial', 'B', 14);
                $pdf->Cell(100,5,'MF OR# '.$transaction['OR_NUMBER'],'LB',0,'L');
                $pdf->SetFont('Arial', '', 12);
                $pdf->Cell(39,5,$transaction['MF_AMOUNT'],'B',0,'C');
                $pdf->Cell(50,5,'PC','LRB',1,'C');
                $pdf->SetFont('Arial', 'B', 14);
                $pdf->Cell(100,5,'TOTAL PAYMENT','LB',0,'L');
                $pdf->SetFont('Arial', '', 12);
                $pdf->Cell(39,5,$transaction['totalAmount'],'RB',0,'C');
                $pdf->Cell(50,5,$row['dateOfEnrollment'],1,1,'C');
                $pdf->SetFont('Arial', 'B', 14);
                $pdf->Cell(100,5,'OR DATE','LB',0,'L');
                $pdf->SetFont('Arial', '', 12);
                $pdf->Cell(39,5,$transaction['OR_DATE'],'RB',0,'C');
                $pdf->Cell(50,5,'',1,1,'C');
                $pdf->SetFont('Arial', 'B', 14);
                $pdf->Cell(100,5,'AMOUNT DUE','LB',0,'L');
                $pdf->SetFont('Arial', '', 12);
                $pdf->Cell(39,5,$transaction['totalAmount'],'RB',0,'C');
                $pdf->Cell(50,5,'',1,1,'C');
                $pdf->SetFont('Arial', 'B', 14);
                $pdf->Cell(100,5,'BALANCE','LB',0,'L');
                $pdf->SetFont('Arial', '', 12);
                $pdf->Cell(39,5,$transaction['balance'],'RB',0,'C');
                $pdf->Cell(50,5,'',1,1,'C');
                $pdf->SetFont('Arial', 'B', 14);
                $pdf->Cell(100,5,'PENALTY','LB',0,'L');
                $pdf->SetFont('Arial', '', 12);
                $pdf->Cell(39,5,$transaction['penalty'],'RB',0,'C');
                $pdf->Cell(50,5,'',1,1,'C');
                $pdf->SetFont('Arial', 'B', 14);
                $pdf->Cell(100,5,'TNC','LB',0,'L');
                $pdf->SetFont('Arial', '', 12);
                $pdf->Cell(39,5,$transaction['TNC'],'RB',0,'C');
                $pdf->Cell(50,5,'',1,1,'C');          
            }
            $pdf->Output();
        }

    }

    
}
?>