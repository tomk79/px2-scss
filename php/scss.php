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
		foreach( $px->bowl()->get_keys() as $key ){
			$src = $px->bowl()->pull( $key );

			$tmp_current_dir = realpath('./');
			chdir( dirname( $_SERVER['SCRIPT_FILENAME'] ) );
			$scss = new \Leafo\ScssPhp\Compiler();
			$src = $scss->compile( $src );
			chdir( $tmp_current_dir );

			$px->bowl()->replace( $src, $key );
		}

		return true;
	}
}
