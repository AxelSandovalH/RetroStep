<?php
    require('connection.php');
    require('fpdf/fpdf.php');

    class PDF extends FPDF
    {
    // Cabecera de página
    function Header()
    {
        // Logo
        $this->Image('img/RS_completo.jpg',87,8,33);
        //Espacio en blanco
        $this->Cell(10, 12, '', 0, 1);
        // Arial bold 15
        $this->SetFont('Arial','B',18);
        // Movernos a la derecha
        $this->Cell(60);
        // Título
        $this->Cell(67,20,'Inventory Report',0,0,'C');
        // Salto de línea
        $this->Ln(20);

        // Celdas de título de cada columna
        $this->SetFont('Arial','B',14);
        // ancho, alto, texto, borde, salto de línea, centrado, relleno
        $this->Cell(38, 15,'Name', 1, 0, 'C', 0);
        $this->Cell(38, 15,'Brand', 1, 0, 'C', 0);
        $this->Cell(38, 15, 'Category', 1, 0, 'C', 0);
        $this->Cell(38, 15, 'Price', 1, 0, 'C', 0);
        $this->Cell(38, 15, 'Stock', 1, 1, 'C', 0);
    }

    // Pie de página
    function Footer()
    {
        // Posición: a 1,5 cm del final
        $this->SetY(-15);
        // Arial italic 8
        $this->SetFont('Arial','I',8);
        // Número de página
        $this->Cell(0,10,utf8_decode('Página ').$this->PageNo().'/{nb}',0,0,'C');
    }
    }

    // Consultas SQL
    $querySneakers = mysqli_query($connection, "SELECT s.sneaker_name, s.brand_name, s.category_name, s.price, st.stock_quantity
                                                FROM stock st
                                                INNER JOIN sneaker s ON st.sneaker_id = s.sneaker_id
                                                WHERE st.deleted_at IS NULL
                                                ORDER BY st.updated_at DESC;");

    $pdf = new PDF();
    $pdf-> AliasNbPages(); // Generar pies de páginas
    $pdf->AddPage();
    $pdf->SetFont('Arial','',10);

    // Bucle para mostrar cada fila del query (tabla)
    while($row = $querySneakers->fetch_assoc()){
        // ancho, alto, texto, borde, salto de línea, centrado, relleno
        $pdf->Cell(38, 10, $row['sneaker_name'], 1, 0, 'C', 0);
        $pdf->Cell(38, 10, $row['brand_name'], 1, 0, 'C', 0);
        $pdf->Cell(38, 10, $row['category_name'], 1, 0, 'C', 0);
        $pdf->Cell(38, 10, $row['price'], 1, 0, 'C', 0);
        $pdf->Cell(38, 10, $row['stock_quantity'], 1, 1, 'C', 0);
    }

    $pdf->Output();
?>