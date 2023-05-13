<?php

namespace App\Helpers\App;

class MenuHelper
{
    public function getMenu($is_auth_user)
    {
        $header_buttons = [
            'Главная' => 'home',
            'Личный кабинет' => 'profile',
            'Мои проекты' => 'projects',
            'О нас' => 'about',
            'Связаться с нами' => 'connect'
        ];

        $auth_buttons = ['Выйти' => 'users.logout'];

        if (!$is_auth_user) {
            array_splice($header_buttons, 1, 2);
            $auth_buttons = ['Войти' => 'login'];
        }

        $menu = [
            'header_buttons' => $header_buttons,
            'auth_buttons' => $auth_buttons,
        ];

        return $menu;
    }
}
