<?php
try {
 include "DatabaseConnection.php";
 $sql = "SELECT id, project_name
 FROM project_pdf
 ORDER BY project_name ASC;";
 $result = $pdo->query($sql);
 foreach ($result as $row) {
 $records[] = [
 'id' => $row['id'],
 'project_name' => $row['project_name']
 ];
 }
 $title = 'Display PDF File';
 ob_start();
 include "display.html.php";
 $output = ob_get_clean();
} catch (PDOException $e) {
 echo 'Database Error '. $e->getMessage(). ' in '. $e->getFile().
 ': '. $e->getLine(); 
}
include "base.html.php";