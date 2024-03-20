<?php

use Diglactic\Breadcrumbs\Breadcrumbs;
use Diglactic\Breadcrumbs\Generator as BreadcrumbTrail;

//ホーム画面 第1階層
Breadcrumbs::for('home.index', function (BreadcrumbTrail $trail) {
    $trail->push('ホーム', route('home.index'));
});

//ホーム(投票)画面 第2階層
Breadcrumbs::for('home.vote', function (BreadcrumbTrail $trail) {
    $trail->parent('home.index');
    $trail->push('投票', route('home.index'));
});

//ホーム(コメント)画面 第2階層
Breadcrumbs::for('home.comment', function (BreadcrumbTrail $trail) {
    $trail->parent('home.index');
    $trail->push('コメント', route('home.index'));
});

//ホーム(議論)画面 第2階層
Breadcrumbs::for('home.discussion', function (BreadcrumbTrail $trail) {
    $trail->parent('home.index');
    $trail->push('議論', route('home.index'));
});

//ランキング画面 第n階層
Breadcrumbs::for('ranking.index', function (BreadcrumbTrail $trail, array $breadcrumbs) {
    $trail->parent('home.index');
    $trail->push('ランキング', route('ranking.index'));
    for ($i = count($breadcrumbs) - 1; 0 <= $i; $i--) {
        $trail->push($breadcrumbs[$i]['name'], route('ranking.index', "{$breadcrumbs[$i]['id']}"));
    }
});

//検索 第2階層
Breadcrumbs::for('search.index', function (BreadcrumbTrail $trail) {
    $trail->parent('home.index');
    $trail->push('検索', route('search.index'));
});

//通知 第2階層
Breadcrumbs::for('notifications.index', function (BreadcrumbTrail $trail) {
    $trail->parent('home.index');
    $trail->push('通知', route('notifications.index'));
});

//議論 第2階層
Breadcrumbs::for('discussions.index', function (BreadcrumbTrail $trail) {
    $trail->parent('home.index');
    $trail->push('議論', route('discussions.index'));
});

//議論 第3階層
Breadcrumbs::for('discussions.detail', function (BreadcrumbTrail $trail, $itemData) {
    $trail->parent('discussions.index');
    $trail->push('詳細', 'discussions.detail');
    $trail->push('詳細', route('discussions.detail'));
});
