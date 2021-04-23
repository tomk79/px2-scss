<?php
namespace tomk79\pickles2\px2scss;

/**
 * px2-scss
 */
class scss{

	/**
	 * SASS変換処理の実行
	 * @param object $px Picklesオブジェクト
	 * @param object $plugin_options プラグイン設定
	 */
	public static function processor( $px, $plugin_options ){
		$plugin_options = (object) $plugin_options;
		if( !property_exists($plugin_options, 'enable_cache') || is_null($plugin_options->enable_cache) ){
			$plugin_options->enable_cache = true;
		}

		if( $plugin_options->enable_cache ){
			$realpath_cache = $px->get_realpath_homedir();
			$realpath_cache .= '_sys/ram/caches/px2scss/';
			if( !$px->fs()->is_dir($realpath_cache) ){
				$px->fs()->mkdir($realpath_cache);
			}
		}

		foreach( $px->bowl()->get_keys() as $key ){
			$src = $px->bowl()->pull( $key );

			// キャッシュチェック
			if( $plugin_options->enable_cache ){
				$src_md5 = md5($src);
				clearstatcache();
				if( $px->fs()->is_file($realpath_cache.$src_md5) ){
					// キャッシュがあったらそのまま返す
					$src = file_get_contents($realpath_cache.$src_md5);
					$px->bowl()->replace( $src, $key );
					continue;
				}
			}


			$tmp_current_dir = realpath('./');

			chdir( dirname( $_SERVER['SCRIPT_FILENAME'] ) );

			$scss = null;
			if (class_exists('\ScssPhp\ScssPhp\Compiler')) {
				$scss = new \ScssPhp\ScssPhp\Compiler();
			} elseif (class_exists('\Leafo\ScssPhp\Compiler')) {
				$scss = new \Leafo\ScssPhp\Compiler();
			}else{
				trigger_error('SCSS Proccessor is NOT available.');
				continue;
			}

			$src = $scss->compile( $src );

			chdir( $tmp_current_dir );

			// キャッシュする
			if( $plugin_options->enable_cache ){
				$px->fs()->save_file($realpath_cache.$src_md5, $src);
			}

			$px->bowl()->replace( $src, $key );
		}

		return true;
	}
}
