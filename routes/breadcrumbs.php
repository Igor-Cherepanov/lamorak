<?php

// Home
use DaveJamesMiller\Breadcrumbs\BreadcrumbsGenerator;
use Illuminate\Database\Eloquent\Model;

try {
    /**
     * Домашний маршрут
     */
    Breadcrumbs::for('home', function (BreadcrumbsGenerator $trail) {
        $trail->push('CRM', route('home'));
    });


    /**
     * Авторизация
     */
    Breadcrumbs::for('login', function (BreadcrumbsGenerator $trail) {
        $trail->parent('home');
        $trail->push('Вход в CRM', route('login'));
    });

    Breadcrumbs::for('password.request', function (BreadcrumbsGenerator $trail) {
        $trail->parent('login');
        $trail->push('Запрос на восстановление пароля', route('password.request'));
    });

    /**
     * Пользователи
     */
    Breadcrumbs::for('users.index', function (BreadcrumbsGenerator $trail) {
        $trail->parent('home');
        $trail->push('Пользователи', route('users.index'));
    });


    Breadcrumbs::for('users.create', function (BreadcrumbsGenerator $trail) {
        $trail->parent('users.index');
        $trail->push('Добавить', route('users.create'));
    });



} catch (\DaveJamesMiller\Breadcrumbs\Exceptions\DuplicateBreadcrumbException $e) {
    echo 'Ошибка генерации хлебрных крошек:' . $e->getMessage();
}
