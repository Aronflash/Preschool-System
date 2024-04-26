<?php
    $pdf->SetFont('Arial', '', 7);
    $pdf->SetY(-45);
    $pdf->Line(40, $pdf->GetY(), 180, $pdf->GetY());
    $pdf->Ln(5);
    $pdf->MultiCell(190, 5, "AV. GUAYANA SECTOR LO KIOSCOS DIAGONAL A LAS TORRES MILITARES
    TELEFONO INSTITUCIONAL: 0276-3415275
    Correo: ceiscongresoa@gmail.com
", 0, 'C');