<?php

$conn = mysqli_connect('localhost','root','','test');

if (!$conn) {
    die("Connection failed:");
}