<?php

$senha = "vixpark";

$senhaCript = password_hash("vixpark", PASSWORD_DEFAULT);
echo $senhaCript;

if(password_verify("vixpark", $senhaCript)){
    echo "lara linda";
}