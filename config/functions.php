<?php

funtion redirect($path){
    header("Location:" . BASE_URL . $path);
    exit;
}


?> 