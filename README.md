# px2-scss

[Pickles 2](https://pickles2.pxt.jp/) に、SCSSプロセッサー機能を追加します。

[Pickles Framework 2](https://github.com/pickles2/px-fw-2.x) に内蔵されているSCSSプロセッサーの機能をベースに、結果をキャッシュして高速化する機能を追加しました。


## Usage - 使い方

### 1. Pickles 2 プロジェクト をセットアップ

[Pickles 2 のセットアップ手順](https://pickles2.pxt.jp/overview/setup/) を参照してください。

### 2. composer.json に追記

```
$ composer require tomk79/px2-scss
```

### 3. config.php を更新

```php
$conf->funcs->processor->scss = array(
    // SCSS文法を処理する
    'tomk79\pickles2\px2scss\scss::processor' ,

    // css のデフォルトの処理を追加
    $conf->funcs->processor->css ,
);
```


## Options - オプション

```php
$conf->funcs->processor->scss = array(
    // SCSS文法を処理する
    'tomk79\pickles2\px2scss\scss::processor('.json_encode([
        'enable_cache' => true, // キャッシュを有効にする (true = 有効, false = 無効, デフォルトは true)
    ]).')' ,

    // css のデフォルトの処理を追加
    $conf->funcs->processor->css ,
);
```


## 更新履歴 - Change log

### tomk79/px2-scss v0.2.1, v0.1.1 (リリース日未定)

- tomk79/px2-scss v0.2.x で、サポート環境を PHP 8 を含む PHP 7.3 以上に変更。 PHP 5.4 〜 7.2 へのサポートは、引き続き tomk79/px2-scss v0.1.x で継続します。
- 外部依存パッケージのバージョンを修正。
- オプション `enable_cache` を追加。

### tomk79/px2-scss v0.1.0 (2020年4月1日)

- Initial Release


## for Developer

### Test

```bash
$ cd {$documentRoot}
$ ./vendor/phpunit/phpunit/phpunit
```
