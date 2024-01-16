<?php

function flash_in($type, $message) {
    if(empty($_SESSION['message'])) {
        $_SESSION['message'] = [];
    }
        $_SESSION['message'][] = [$type, $message];
}

function flash_out() {
    if (!empty($_SESSION['message'])) {
        foreach ($_SESSION['message'] as $m) {
            $alertClass = 'alert-danger';
            if ($m[0] === 'success') {
                $alertClass = 'alert-success';
            }

            echo '<p class="alert ' . $alertClass . '">' . $m[1] . '</p>';
        }
    }
    $_SESSION['message'] = [];
}