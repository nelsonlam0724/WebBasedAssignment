<?php
include '../_base.php';
auth('Root','Admin');

if (isset($_GET['file'])) {
    $fileName = basename($_GET['file']);
    $filePath = '../backup/' . $fileName;

    if (file_exists($filePath)) {
        // Set temporary message for successful download
        temp('info', 'Database Backup File Downloaded Successfully.');
        header('Content-Type: application/sql');
        header('Content-Disposition: attachment; filename="' . $fileName . '"');
        header('Content-Length: ' . filesize($filePath));
        readfile($filePath);
        exit();
    } else {
        temp('info', 'Error: File not found.');
        redirect('backup.php');
    }
} else {
    temp('info', 'Error: No file specified.');
    redirect('backup.php');
}
