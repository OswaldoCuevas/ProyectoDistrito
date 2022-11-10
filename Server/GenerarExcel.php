<?php
require ('conexion.php');
require('../Class/Users.php');
require('../Class/Title.php');
require('../Class/Document.php');
require('../Class/Investment.php');
require ('../Library/vendor/autoload.php');
require ('validityAdmin.php');

use PhpOffice\PhpSpreadsheet\{Spreadsheet,IOFactory};
if(isset($_GET['Document'])){
    switch ($_GET['Document']) {
        case 'Usuarios':getUsuarios();     break;
        case 'Padron de usuarios':getPadronDeUsuarios();     break;
        case 'Usuarios sociales':getUsuariosSociales(); break;
        case 'Usuarios privados':getUsuariosPrivados(); break;
        case 'Titulos':getTitles(); break;
        case 'Inversiones':getInversiones();break;
        case 'Document_Title':getTitlesDocument($_GET['Document_Id'],explode(".", $_GET['Name']) );break;
        case 'Document_User':getPadronDeUsuariosDocument($_GET['Document_Id'],explode(".", $_GET['Name']) );break;
        case 'Document_Inversion':getInversionesDocument($_GET['Document_Id'],explode(".", $_GET['Name']) );break;

    }
}
function getUsuarios(){
    $excel = new Spreadsheet();
    $hojaActiva =$excel -> getActiveSheet();
    $nameExcel="Usuarios";
    $Users = new Users();
    $hojaActiva -> getTitle("$nameExcel");
    $hojaActiva -> setCellValue('A1','No. control');
    $hojaActiva -> getColumnDimension('A')->setWidth(11);
    $hojaActiva -> setCellValue('B1','Usuario');
    $hojaActiva -> getColumnDimension('B')->setWidth(40);
    $hojaActiva -> setCellValue('C1','Sector');
    $hojaActiva -> getColumnDimension('C')->setWidth(8);
    $hojaActiva -> setCellValue('D1','CURP');
    $hojaActiva -> getColumnDimension('D')->setWidth(22);
    $hojaActiva -> setCellValue('E1','RFC');
    $hojaActiva -> getColumnDimension('E')->setWidth(16);
    $hojaActiva -> setCellValue('F1','Número de teléfono');
    $hojaActiva -> getColumnDimension('F')->setWidth(12);
    $hojaActiva -> setCellValue('G1','Correo electrónico');
    $hojaActiva -> getColumnDimension('G')->setWidth(23);
    $fila = 2;
    foreach ($Users -> getUsers() as $User) {
        $hojaActiva -> setTitle("$nameExcel");
        $hojaActiva -> setCellValue('A'.$fila,$User['Control_Num']);
        $hojaActiva -> setCellValue('B'.$fila,$User['Full_Name']);
        $hojaActiva -> setCellValue('C'.$fila,$User['Type_User']);
        $hojaActiva -> setCellValue('D'.$fila,$User['CURP']);
        $hojaActiva -> setCellValue('E'.$fila,$User['RFC']);
        $hojaActiva -> setCellValue('F'.$fila,$User['Phone_Number']);
        $hojaActiva -> setCellValue('G'.$fila,$User['Email']); 
        $fila++;  
    } 
    header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
    header('Content-Disposition: attachment;filename="'.$nameExcel.'.xlsx"');
    header('Cache-Control: max-age=0');
    
    $writer = IOFactory::createWriter($excel, 'Xlsx');
    $writer->save('php://output');
    exit;
}
function getUsuariosSociales(){
    $excel = new Spreadsheet();
    $hojaActiva =$excel -> getActiveSheet();
    $nameExcel="Usuarios sector social";
    $Users = new Users();
    $hojaActiva -> getTitle("$nameExcel");
    $hojaActiva -> setCellValue('A1','No. control');
    $hojaActiva -> getColumnDimension('A')->setWidth(11);
    $hojaActiva -> setCellValue('B1','Usuario');
    $hojaActiva -> getColumnDimension('B')->setWidth(40);
    $hojaActiva -> setCellValue('C1','Sector');
    $hojaActiva -> getColumnDimension('C')->setWidth(8);
    $hojaActiva -> setCellValue('D1','CURP');
    $hojaActiva -> getColumnDimension('D')->setWidth(22);
    $hojaActiva -> setCellValue('E1','RFC');
    $hojaActiva -> getColumnDimension('E')->setWidth(16);
    $hojaActiva -> setCellValue('F1','Número de teléfono');
    $hojaActiva -> getColumnDimension('F')->setWidth(12);
    $hojaActiva -> setCellValue('G1','Correo electrónico');
    $hojaActiva -> getColumnDimension('G')->setWidth(23);
    $fila = 2;
    foreach ($Users -> getUsersSociales() as $User) {
        $hojaActiva -> setTitle("$nameExcel");
        $hojaActiva -> setCellValue('A'.$fila,$User['Control_Num']);
        $hojaActiva -> setCellValue('B'.$fila,$User['Full_Name']);
        $hojaActiva -> setCellValue('C'.$fila,$User['Type_User']);
        $hojaActiva -> setCellValue('D'.$fila,$User['CURP']);
        $hojaActiva -> setCellValue('E'.$fila,$User['RFC']);
        $hojaActiva -> setCellValue('F'.$fila,$User['Phone_Number']);
        $hojaActiva -> setCellValue('G'.$fila,$User['Email']); 
        $fila++;  
    } 
    header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
    header('Content-Disposition: attachment;filename="'.$nameExcel.'.xlsx"');
    header('Cache-Control: max-age=0');
    
    $writer = IOFactory::createWriter($excel, 'Xlsx');
    $writer->save('php://output');
    exit;
}
function getUsuariosPrivados(){
    $excel = new Spreadsheet();
    $hojaActiva =$excel -> getActiveSheet();
    $nameExcel="Usuarios sector privado";
    $Users = new Users();
    $hojaActiva -> getTitle("$nameExcel");
    $hojaActiva -> setCellValue('A1','No. control');
    $hojaActiva -> getColumnDimension('A')->setWidth(11);
    $hojaActiva -> setCellValue('B1','Usuario');
    $hojaActiva -> getColumnDimension('B')->setWidth(40);
    $hojaActiva -> setCellValue('C1','Sector');
    $hojaActiva -> getColumnDimension('C')->setWidth(8);
    $hojaActiva -> setCellValue('D1','CURP');
    $hojaActiva -> getColumnDimension('D')->setWidth(22);
    $hojaActiva -> setCellValue('E1','RFC');
    $hojaActiva -> getColumnDimension('E')->setWidth(16);
    $hojaActiva -> setCellValue('F1','Número de teléfono');
    $hojaActiva -> getColumnDimension('F')->setWidth(12);
    $hojaActiva -> setCellValue('G1','Correo electrónico');
    $hojaActiva -> getColumnDimension('G')->setWidth(23);
    $fila = 2;
    foreach ($Users -> getUsersPrivados() as $User) {
        $hojaActiva -> setTitle("$nameExcel");
        $hojaActiva -> setCellValue('A'.$fila,$User['Control_Num']);
        $hojaActiva -> setCellValue('B'.$fila,$User['Full_Name']);
        $hojaActiva -> setCellValue('C'.$fila,$User['Type_User']);
        $hojaActiva -> setCellValue('D'.$fila,$User['CURP']);
        $hojaActiva -> setCellValue('E'.$fila,$User['RFC']);
        $hojaActiva -> setCellValue('F'.$fila,$User['Phone_Number']);
        $hojaActiva -> setCellValue('G'.$fila,$User['Email']); 
        $fila++;  
    } 
    header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
    header('Content-Disposition: attachment;filename="'.$nameExcel.'.xlsx"');
    header('Cache-Control: max-age=0');
    
    $writer = IOFactory::createWriter($excel, 'Xlsx');
    $writer->save('php://output');
    exit;
}
function getInversiones(){
    $excel = new Spreadsheet();
    $hojaActiva =$excel -> getActiveSheet();
    $nameExcel="Inversiones";
    $Investments = new  Investment();
    $hojaActiva -> getTitle("$nameExcel");
    $hojaActiva -> setCellValue('A1','No. control');
    $hojaActiva -> getColumnDimension('A')->setWidth(11);
    $hojaActiva -> setCellValue('B1','Usuario');
    $hojaActiva -> getColumnDimension('B')->setWidth(40);
    $hojaActiva -> setCellValue('C1','Lote');
    $hojaActiva -> getColumnDimension('C')->setWidth(8);
    $hojaActiva -> setCellValue('D1','Colonia');
    $hojaActiva -> getColumnDimension('D')->setWidth(22);
    $hojaActiva -> setCellValue('E1','Sistema');
    $hojaActiva -> getColumnDimension('E')->setWidth(16);
    $hojaActiva -> setCellValue('F1','Hectareas');
    $hojaActiva -> getColumnDimension('F')->setWidth(12);
    $hojaActiva -> setCellValue('G1','AÑO');
    $hojaActiva -> getColumnDimension('G')->setWidth(23);
    $fila = 2;
    foreach ($Investments -> getInversiones() as $Investment) {
        $hojaActiva -> setTitle("$nameExcel");
        $hojaActiva -> setCellValue('A'.$fila,$Investment['User_Id']);
        $hojaActiva -> setCellValue('B'.$fila,$Investment['Full_Name']);
        $hojaActiva -> setCellValue('C'.$fila,$Investment['Plot']);
        $hojaActiva -> setCellValue('D'.$fila,$Investment['Cologne']);
        $hojaActiva -> setCellValue('E'.$fila,$Investment['System_']);
        $hojaActiva -> setCellValue('F'.$fila,$Investment['Hectare']);
        $hojaActiva -> setCellValue('G'.$fila,$Investment['Investments_Date']); 
        $fila++;  
    } 
    header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
    header('Content-Disposition: attachment;filename="'.$nameExcel.'.xlsx"');
    header('Cache-Control: max-age=0');
    
    $writer = IOFactory::createWriter($excel, 'Xlsx');
    $writer->save('php://output');
    exit;
}
function getInversionesDocument($id, $name){
    $excel = new Spreadsheet();
    $hojaActiva =$excel -> getActiveSheet();
    $nameExcel=$name[0];
    $_Document = new Document();
    $hojaActiva -> getTitle("$nameExcel");
    $hojaActiva -> setCellValue('A1','No.');
    $hojaActiva -> getColumnDimension('A')->setWidth(11);
    $hojaActiva -> setCellValue('B1','Usuario');
    $hojaActiva -> getColumnDimension('B')->setWidth(40);
    $hojaActiva -> setCellValue('C1','Lote');
    $hojaActiva -> getColumnDimension('C')->setWidth(8);
    $hojaActiva -> setCellValue('D1','Colonia');
    $hojaActiva -> getColumnDimension('D')->setWidth(22);
    $hojaActiva -> setCellValue('E1','Sistema');
    $hojaActiva -> getColumnDimension('E')->setWidth(16);
    $hojaActiva -> setCellValue('F1','Sup.');
    $hojaActiva -> getColumnDimension('F')->setWidth(12);
    $hojaActiva -> setCellValue('G1','AÑO');
    $hojaActiva -> getColumnDimension('G')->setWidth(15);
    $fila = 2;
    foreach ($_Document -> getInvestments($id) as $Investment) {
        $hojaActiva -> setTitle("$nameExcel");
        $hojaActiva -> setCellValue('A'.$fila,$Investment['Program']);
        $hojaActiva -> setCellValue('B'.$fila,$Investment['User']);
        $hojaActiva -> setCellValue('C'.$fila,$Investment['Plot']);
        $hojaActiva -> setCellValue('D'.$fila,$Investment['Cologne']);
        $hojaActiva -> setCellValue('E'.$fila,$Investment['System_']);
        $hojaActiva -> setCellValue('F'.$fila,$Investment['Hectare']);
        $hojaActiva -> setCellValue('G'.$fila,$Investment['Investments_Date']); 
        $fila++;  

       
    } 
    header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
    header('Content-Disposition: attachment;filename="'.$nameExcel.'.xlsx"');
    header('Cache-Control: max-age=0');
    
    $writer = IOFactory::createWriter($excel, 'Xlsx');
    $writer->save('php://output');
    exit;
}
function getPadronDeUsuarios(){
    $excel = new Spreadsheet();
    $hojaActiva =$excel -> getActiveSheet();
    $nameExcel="Padrón de usuarios";
    $Users = new Users();
    $hojaActiva -> getTitle("$nameExcel");
    $hojaActiva -> setCellValue('A1','No. control');
    $hojaActiva -> getColumnDimension('A')->setWidth(11);
    $hojaActiva -> setCellValue('B1','Usuario');
    $hojaActiva -> getColumnDimension('B')->setWidth(40);
    $hojaActiva -> setCellValue('C1','Sector');
    $hojaActiva -> getColumnDimension('C')->setWidth(8);
    $hojaActiva -> setCellValue('D1','Colonia');
    $hojaActiva -> getColumnDimension('D')->setWidth(20);
    $hojaActiva -> setCellValue('E1','Lote');
    $hojaActiva -> getColumnDimension('E')->setWidth(13);
    $hojaActiva -> setCellValue('F1','CURP');
    $hojaActiva -> getColumnDimension('F')->setWidth(22);
    $hojaActiva -> setCellValue('G1','RFC');
    $hojaActiva -> getColumnDimension('G')->setWidth(16);
    
    $fila = 2;
    foreach ($Users -> getPadronDeUsuarios() as $User) {
        $hojaActiva -> setTitle("$nameExcel");
        $hojaActiva -> setCellValue('A'.$fila,$User['Control_Num']);
        $hojaActiva -> setCellValue('B'.$fila,$User['Full_Name']);
        $hojaActiva -> setCellValue('C'.$fila,$User['Type_User']);
        $hojaActiva -> setCellValue('D'.$fila,$User['Cologne']);
        $hojaActiva -> setCellValue('E'.$fila,$User['Plot']);
        $hojaActiva -> setCellValue('F'.$fila,$User['CURP']);
        $hojaActiva -> setCellValue('G'.$fila,$User['RFC']); 
        $fila++;  
    } 
    header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
    header('Content-Disposition: attachment;filename="'.$nameExcel.'.xlsx"');
    header('Cache-Control: max-age=0');
    
    $writer = IOFactory::createWriter($excel, 'Xlsx');
    $writer->save('php://output');
    exit;
}
function getPadronDeUsuariosDocument($id, $name){
    $excel = new Spreadsheet();
    $hojaActiva =$excel -> getActiveSheet();
    $nameExcel=$name[0];
    $_Document = new Document();
    $hojaActiva -> getTitle("$nameExcel");
    $hojaActiva -> setCellValue('A1','No.');
    $hojaActiva -> getColumnDimension('A')->setWidth(11);
    $hojaActiva -> setCellValue('B1','Usuario');
    $hojaActiva -> getColumnDimension('B')->setWidth(40);
    $hojaActiva -> setCellValue('C1','CURP');
    $hojaActiva -> getColumnDimension('C')->setWidth(22);
    $hojaActiva -> setCellValue('D1','RFC');
    $hojaActiva -> getColumnDimension('D')->setWidth(16);
    $hojaActiva -> setCellValue('E1','Número de teléfono');
    $hojaActiva -> getColumnDimension('E')->setWidth(16);
    $hojaActiva -> setCellValue('F1','Correo');
    $hojaActiva -> getColumnDimension('F')->setWidth(8);

    
  
    $fila = 2;
    foreach ($_Document -> getUsers($id) as $User) {
        $hojaActiva -> setTitle("$nameExcel");
        $hojaActiva -> setCellValue('A'.$fila,$User['Program']);
        $hojaActiva -> setCellValue('B'.$fila,$User['User']);
        $hojaActiva -> setCellValue('C'.$fila,$User['CURP']);
        $hojaActiva -> setCellValue('D'.$fila,$User['RFC']);
        $hojaActiva -> setCellValue('E'.$fila,$User['Phone_Number']);
        $hojaActiva -> setCellValue('F'.$fila,$User['Email']);
        $fila++;  
    } 
    header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
    header('Content-Disposition: attachment;filename="'.$nameExcel.'.xlsx"');
    header('Cache-Control: max-age=0');
    
    $writer = IOFactory::createWriter($excel, 'Xlsx');
    $writer->save('php://output');
    exit;
}
function getTitles(){
    $excel = new Spreadsheet();
    $hojaActiva =$excel -> getActiveSheet();
    $nameExcel="Títulos de concesión";
    $_Title = new Title();
    $hojaActiva -> getTitle("$nameExcel");
    $hojaActiva -> setCellValue('A1','NO. CONTROL');
    $hojaActiva -> getColumnDimension('A')->setWidth(11);
    $hojaActiva -> setCellValue('B1','USUARIO');
    $hojaActiva -> getColumnDimension('B')->setWidth(40);
    $hojaActiva -> setCellValue('C1','LOTE');
    $hojaActiva -> getColumnDimension('C')->setWidth(8);
    $hojaActiva -> setCellValue('D1','COLONIA');
    $hojaActiva -> getColumnDimension('D')->setWidth(20);
    $hojaActiva -> setCellValue('E1','SECTOR');
    $hojaActiva -> getColumnDimension('E')->setWidth(13);
    $hojaActiva -> setCellValue('F1','NO. DE TÍTULO');
    $hojaActiva -> getColumnDimension('F')->setWidth(22);
    $hojaActiva -> setCellValue('G1','VIGENCIA');
    $hojaActiva -> getColumnDimension('G')->setWidth(13);
    $hojaActiva -> setCellValue('H1','FECHA DE INICIO');
    $hojaActiva -> getColumnDimension('H')->setWidth(16);
    $hojaActiva -> setCellValue('I1','PRORROGA');
    $hojaActiva -> getColumnDimension('I')->setWidth(16);
    $hojaActiva -> setCellValue('J1','DOTACION');
    $hojaActiva -> getColumnDimension('J')->setWidth(11);
    $hojaActiva -> setCellValue('K1','LATITUD');
    $hojaActiva -> getColumnDimension('K')->setWidth(12);
    $hojaActiva -> setCellValue('L1','LONGITUD');
    $hojaActiva -> getColumnDimension('L')->setWidth(12);
    
    $fila = 2;
    foreach ($_Title -> getTitles() as $Title) {
        $hojaActiva -> setTitle("$nameExcel");
        $hojaActiva -> setCellValue('A'.$fila,$Title['User_Id']);
        $hojaActiva -> setCellValue('B'.$fila,$Title['Full_Name']);
        $hojaActiva -> setCellValue('C'.$fila,$Title['Plot']);
        $hojaActiva -> setCellValue('D'.$fila,$Title['Cologne']);
        $hojaActiva -> setCellValue('E'.$fila,$Title['Type_User']);
        $hojaActiva -> setCellValue('F'.$fila,$Title['Title_Number']);
        $hojaActiva -> setCellValue('G'.$fila,$Title['Validity']); 
        $hojaActiva -> setCellValue('H'.$fila,$Title['Initial_Date']);
        $hojaActiva -> setCellValue('I'.$fila,$Title['Extend']); 
        $hojaActiva -> setCellValue('J'.$fila,$Title['Water_Supply']); 
        $hojaActiva -> setCellValue('K'.$fila,$Title['Latitude']); 
        $hojaActiva -> setCellValue('L'.$fila,$Title['Longitude']); 

        $fila++;  
    } 
    header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
    header('Content-Disposition: attachment;filename="'.$nameExcel.'.xlsx"');
    header('Cache-Control: max-age=0');
    
    $writer = IOFactory::createWriter($excel, 'Xlsx');
    $writer->save('php://output');
    exit;
}
function getTitlesDocument($Document_Id, $name){
    $excel = new Spreadsheet();
    $hojaActiva = $excel -> getActiveSheet();
    $nameExcel=$name[0];
    $_Document = new Document();
    $hojaActiva -> getTitle("$nameExcel");
    $hojaActiva -> setCellValue('A1','NO.');
    $hojaActiva -> getColumnDimension('A')->setWidth(11);
    $hojaActiva -> setCellValue('B1','USUARIO');
    $hojaActiva -> getColumnDimension('B')->setWidth(40);
    $hojaActiva -> setCellValue('C1','LOTE');
    $hojaActiva -> getColumnDimension('C')->setWidth(8);
    $hojaActiva -> setCellValue('D1','COLONIA');
    $hojaActiva -> getColumnDimension('D')->setWidth(20);
    $hojaActiva -> setCellValue('E1','SECTOR');
    $hojaActiva -> getColumnDimension('E')->setWidth(13);
    $hojaActiva -> setCellValue('F1','NO. DE TÍTULO');
    $hojaActiva -> getColumnDimension('F')->setWidth(22);
    $hojaActiva -> setCellValue('G1','VIGENCIA');
    $hojaActiva -> getColumnDimension('G')->setWidth(13);
    $hojaActiva -> setCellValue('H1','FECHA DE INICIO');
    $hojaActiva -> getColumnDimension('H')->setWidth(16);
    $hojaActiva -> setCellValue('I1','PRORROGA');
    $hojaActiva -> getColumnDimension('I')->setWidth(16);
    $hojaActiva -> setCellValue('J1','DOTACION');
    $hojaActiva -> getColumnDimension('J')->setWidth(11);
    $hojaActiva -> setCellValue('K1','LATITUD');
    $hojaActiva -> getColumnDimension('K')->setWidth(12);
    $hojaActiva -> setCellValue('L1','LONGITUD');
    $hojaActiva -> getColumnDimension('L')->setWidth(12);
    
    $fila = 2;
    foreach ($_Document -> getTitles($Document_Id) as $Document) {
        $hojaActiva -> setTitle("$nameExcel");
        $hojaActiva -> setCellValue('A'.$fila,$Document['Program']);
        $hojaActiva -> setCellValue('B'.$fila,$Document['User']);
        $hojaActiva -> setCellValue('C'.$fila,$Document['Plot']);
        $hojaActiva -> setCellValue('D'.$fila,$Document['Cologne']);
        $hojaActiva -> setCellValue('E'.$fila,$Document['Type_User']);
        $hojaActiva -> setCellValue('F'.$fila,$Document['Title_Number']);
        $hojaActiva -> setCellValue('G'.$fila,$Document['Validity']); 
        $hojaActiva -> setCellValue('H'.$fila,$Document['Initial_Date']);
        $hojaActiva -> setCellValue('I'.$fila,$Document['Extend']); 
        $hojaActiva -> setCellValue('J'.$fila,$Document['Water_Supply']); 
        $hojaActiva -> setCellValue('K'.$fila,$Document['Latitude']); 
        $hojaActiva -> setCellValue('L'.$fila,$Document['Longitude']); 

        $fila++;  
    } 
    header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
    header('Content-Disposition: attachment;filename="'.$nameExcel.'.xlsx"');
    header('Cache-Control: max-age=0');
    
    $writer = IOFactory::createWriter($excel, 'Xlsx');
    $writer->save('php://output');
    exit;
}

