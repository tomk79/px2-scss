<?php
namespace tomk79\pickles2\px2scss;

/**
 * px2-scss
 */
class scss{

	/**
	 * SASS変換処理の実行
	 * @param object $px Picklesオブジェクト
	 * @param object $json プラグイン設定
	 */
	public static function processor( $px, $json ){
		$realpath_cache = $px->get_realpath_homedir();
		$realpath_cache .= '_sys/ram/caches/px2scss/';
		if( !is_dir($realpath_cache) ){
			$px->fs()->mkdir($realpath_cache);
		}

		foreach( $px->bowl()->get_keys() as $key ){
			$src = $px->bowl()->pull( $key );

			// キャッシュチェック
			$src_md5 = md5($src);
			clearstatcache();
			if( $px->fs()->is_file($realpath_cache.$src_md5) ){
				// キャッシュがあったらそのまま返す
				$src = file_get_contents($realpath_cache.$src_md5);
				$px->bowl()->replace( $src, $key );
				continue;
			}


			$tmp_current_dir = realpath('./');
			chdir( dirname( $_SERVER['SCRIPT_FILENAME'] ) );
			$scss = new \Leafo\ScssPhp\Compiler();
			$src = $scss->compile( $src );
			chdir( $tmp_current_dir );

			// キャッシュする
			file_put_contents($realpath_cache.$src_md5, $src);

			$px->bowl()->replace( $src, $key );
		}

		return true;
	}
}
