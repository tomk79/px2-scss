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

### tomk79/px2-scss v0.2.0 (リリース日未定)

- 外部依存パッケージのバージョンを修正。(`leafo/scssphp` -> `scssphp/scssphp`)

### tomk79/px2-scss v0.1.2 (2023年2月11日)

- 内部コードの細かい修正。

### tomk79/px2-scss v0.1.1 (2021年4月23日)

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
