<?php
//require('checkSession.php');
include("connection.php");
require("../fpdf/mc_table.php");
//float w, float h, string txt [, mixed border [, string align [, boolean fill]]])

class PDF extends PDF_MC_Table 
{
    
    function Header()
    {
        if($this->PageNo()==1)
        {
        // Logo UIT
            $this->Image('../img/fssm.png',85,15,40,40);
        // Police Arial gras 15
        $this->Ln(50);
        //$this->SetTextColor(0,101,153);
        /*-----------*/
        $this->SetFont('Arial','B',8);
        // Décalage à droite
        $this->Cell(80);
        // Titre
        $this->Cell(30,10,utf8_decode('RELEVE DE NOTE'),0,0,'C');
        // Saut de ligne
        $this->Ln(10);
        /*-----------*/
        $this->SetFont('Arial','',16);
        // Décalage à droite
        $this->Cell(80);
        // Titre
        $this->Cell(30,10,utf8_decode('Session 1'),0,0,'C');
        // Saut de ligne
        $this->Ln(20);
        /*-----------*/
        }
    }
    
}
$pdf = new PDF();
$pdf->AliasNbPages();	
$pdf->Addpage();
$semestre = $_POST["semestre"];
$etudiant = $_POST["etudiant"];
/**
 *  
*/
    $statement = $pdo->prepare("SELECT s.intitule as semestre,e.filiere,m.intitule as module,e.nom,e.prenom,note,
                                    num_etudiant,id_semestre,id_module
                                    FROM notes n,etudiants e,semestres s,modules m
                                    WHERE n.num_etudiant=e.num
                                    AND n.id_semestre=s.id
                                    AND n.id_module=m.id
                                    AND s.id=:id
                                    AND e.num=:num
    ORDER BY s.intitule,e.filiere,m.intitule,e.nom,e.prenom;");
    $statement->execute(array(
        'num'   =>  $etudiant,
        'id'    =>  $semestre
    ));
    $result = $statement->fetchAll();
/**
 *  
*/
    $sql="SELECT * FROM etudiants WHERE num=:num";
    //$pdo->execute(array('num'=>$id));
    $statement = $pdo->prepare( $sql );
    $statement->execute(array('num'=>$etudiant));
    $info_etudiant = $statement->fetch(PDO::FETCH_ASSOC);

/**
 *  tableau
*/

    if(!empty($result)) {
        /**
         * 
        */
            // $x = 10;// Set X coordinate
            // $y = $pdf->GetY();// Get Y coordinates
            $pdf->SetTextColor(0,'','');
            $pdf->SetFont('Arial','',14);
            // $pdf->SetXY($x, $y);
            $pdf->MultiCell(40,0, utf8_decode('L\'étudiant :'),0,'L');
            $y=$pdf->GetY();
        /**
         * 
        */
            $pdf->SetTextColor(0,'','');
            $pdf->SetFont('Arial','B',14);
            // $x += 80;// update the X coordinate to account for the previous cell width
            $pdf->SetXY(70, $y);// set the XY Coordinates
            $pdf->MultiCell(40,0, $info_etudiant["nom"]." ".$info_etudiant["prenom"],0,'L');
            $pdf->ln(8);
        /**
         * 
        */
            $pdf->SetTextColor(0,'','');
            $pdf->SetFont('Arial','',14);
            $pdf->MultiCell(50,0,utf8_decode('N° :'),0,'L');
            $y=$pdf->GetY();
        /**
         * 
        */
            $pdf->SetTextColor(0,'','');
            $pdf->SetFont('Arial','B',14);		
            $pdf->SetXY(70,$y);
            $pdf->MultiCell(100,0,utf8_decode($info_etudiant['num']),0,'L');
            $pdf->Ln(8);
        /**
         * 
        */
            $pdf->SetTextColor(0,'','');
            $pdf->SetFont('Arial','',14);
            $pdf->MultiCell(50,0,utf8_decode('Inscrit en  :'),0,'L');
            $y=$pdf->GetY();
        /**
         * 
        */
            $pdf->SetTextColor(0,'','');
            $pdf->SetFont('Arial','B',14);		
            $pdf->SetXY(70,$y);
            $pdf->MultiCell(100,0,utf8_decode($info_etudiant['filiere']),0,'L');
            $pdf->Ln(10);
        /**
         * 
        */
            $pdf->SetTextColor(0,'','');
            $pdf->SetFont('Arial','',12);
            $pdf->MultiCell(0,0,utf8_decode('a obtenu les notes suivantes :'),0,'L');
            $y=$pdf->GetY();
            $pdf->Ln(5);

        /**
         * en-tête du tableau   
        */
            $pdf->SetFillColor(232,232,232);
            // $pdf->SetTextColor(0,101,153);
            $pdf->SetFont('Arial','',14);

            $x = 10;// Set X coordinate
            $y = $pdf->GetY();// Get Y coordinates
            $pdf->SetXY($x, $y);
            $pdf->MultiCell(100,12,utf8_decode('Module'),1,'C',1);// remplire la cellule

            $x += 100;// update the X coordinate to account for the previous cell width
            $pdf->SetXY($x, $y);// set the XY Coordinates
            $pdf->MultiCell(45,12,utf8_decode('Note/Barème'),1,'C',1);// remplire la cellule

            $x +=45;
            $pdf->SetXY($x,$y);
            $pdf->MultiCell(45,12,utf8_decode('Session'),1,'C',1);
        /**
         * 
        */
            $pdf->SetFont('Arial','',13);
            $pdf->SetTextColor(0,'','');
            $pdf->SetWidths(array(100,45,45));
            $pdf->SetAligns('L');
            $somme = 0;
            $nombre = 0;
            $moyenne = 0;
            foreach($result as $row) {
                $pdf->Row(array(utf8_decode($row['module']),$row['note']."/20",$row["semestre"]));
                $somme+=$row["note"];
                $nombre++;
            }
            $moyenne = $somme / $nombre;
            $pdf->ln(14);
        
        /**
         * 
        */
            $x = 10;// Set X coordinate
            $y = $pdf->GetY();// Get Y coordinates
            $pdf->SetTextColor(0,'','');
            $pdf->SetFont('Arial','B',14);
            $pdf->SetXY($x, $y);
            $pdf->MultiCell(150,0, utf8_decode('Résultat d\'admission session 1:'),0,'L');
            $y=$pdf->GetY();
        /**
         * 
        */
            $pdf->SetTextColor(0,'','');
            $pdf->SetFont('Arial','',14);
            $x += 80;// update the X coordinate to account for the previous cell width
            $pdf->SetXY($x, $y);// set the XY Coordinates
            $pdf->MultiCell(190,0, $moyenne."/20",0,'L');
    }


/**
 * Affichage PDF
*/
    $pdf->Output();