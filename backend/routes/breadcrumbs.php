<?php

use Diglactic\Breadcrumbs\Breadcrumbs;
use Diglactic\Breadcrumbs\Generator as BreadcrumbTrail;
use App\Models\Item;

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
Breadcrumbs::for('ranking.index', function (BreadcrumbTrail $trail, ?string $itemId = null) {
    //項目情報とその項目に紐づく項目情報を全て取得する
    $item = Item::with(['item'])->find($itemId);

    // パンくずリスト用の配列を生成する
    $breadcrumbs = [];
    while (!empty($item)) {
        isset($item->name) ? $breadcrumbs[] = ['id' => $item->id, 'name' => $item->name] : '';
        $item = isset($item->item) ? $item->item : '';
    }
    $breadcrumbs = array_reverse($breadcrumbs);

    // パンくずリストを生成する
    $trail->parent('home.index');
    $trail->push('ランキング', route('ranking.index'));
    foreach ($breadcrumbs as $breadcrumb) {
        $trail->push($breadcrumb['name'], route('ranking.index', "{$breadcrumb['id']}"));
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
Breadcrumbs::for('discussions.detail', function (BreadcrumbTrail $trail) {
    $trail->parent('discussions.index');
    $trail->push('詳細', 'discussions.detail');
    $trail->push('詳細', route('discussions.detail'));
});

//議論 第3階層
Breadcrumbs::for('setting.index', function (BreadcrumbTrail $trail) {
    $trail->parent('home.index');
    $trail->push('設定', route('setting.index'));
});
