<?php

function _debug($data) {
    echo "<pre/>";
    print_r($data);
    exit(1);
}

function SessionData() {

    $CI = &get_instance();
    $userdata = $CI->session->all_userdata();
    if (!empty($userdata['logged_in'])) {
        $data['session'] = true;
        $data['logged_in'] = $userdata['logged_in'];
        $data['user_id'] = $userdata['user_id'];
        $data['user'] = $userdata['user'];
    } else {
        $data['session'] = false;
        $data['logged_in'] = false;
    }
    return $data;
}

