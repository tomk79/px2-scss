# px2-scss

[Pickles 2](https://pickles2.pxt.jp/) に、SCSSプロセッサー機能を追加します。


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



## 更新履歴 - Change log

### tomk79/px2-scss v0.1.0 (リリース日未定)

- Initial Release


## for Developer

### Test

```bash
$ cd {$documentRoot}
$ ./vendor/phpunit/phpunit/phpunit
```
