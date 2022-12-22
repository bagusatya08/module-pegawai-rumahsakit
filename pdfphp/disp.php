<?php

    require "../dbConnection.php";

    $sql = "SELECT * FROM project_pdf";

    $result = mysqli_query($conn, $sql);

    // $user = mysqli_fetch_array($result);

?>

<?php while ($user = mysqli_fetch_array($result)) : ?>
    <ul>
        <li>
            <iframe src="data:application/pdf;base64, <?php echo base64_encode($user['pdf_doc']) ?>" frameborder="0"></iframe>
            <object data="data:application/pdf;base64, <?php echo base64_encode($user['pdf_doc']) ?>" type="application/pdf" style= "height:200px;width:60%"></object>
            <a title="Download PDF" download="Sample.PDF" href="data:application/pdf;base64, <?php echo base64_encode($user['pdf_doc']) ?>">Click here to download</a>        
        </li>
    </ul>
<?php endwhile; ?>