<?php
if (!isset($_SESSION['user']) || !isset($_SESSION['rol']) )
{
    header("Location:../index.html");
    exit();
}
?>