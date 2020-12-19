<?php

use App\Models\AuthModel;

function getUser($token = null)
{
    $model = new AuthModel();
    if ($token) {
        $getToken = $model->getToken($token);
        return $model->getUser($getToken['user_id']);
    } else if (session('token')) {
        $getToken = $model->getToken(session('token'));
        return $model->getUser($getToken['user_id']);
    }
}
