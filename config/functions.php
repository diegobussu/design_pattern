<?php

function flash_in($type, $message) {
    if(empty($_SESSION['message'])) {
        $_SESSION['message'] = [];
    }
        $_SESSION['message'][] = [$type, $message];
}

function flash_out() {
    if(!empty($_SESSION['message'])) {
        foreach($_SESSION['message'] as $m) {
            echo '<p class="alert'.$m[0].'">'.$m[1].'</p>';
        }
    }
    $_SESSION['message'] = [];
}