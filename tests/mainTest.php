<?php
/**
 * test
 */

class mainTest extends PHPUnit_Framework_TestCase{
	private $fs;
	private $utils;

	public function setup(){
		mb_internal_encoding('UTF-8');
		$this->fs = new tomk79\filesystem();
		require_once(__DIR__.'/libs/utils.php');
		$this->utils = new \tests\utils();
	}


	/**
	 * 普通に実行してみるテスト
	 */
	public function testStandard(){
		$output = $this->utils->passthru( [
			'php',
			__DIR__.'/testdata/src_px2/.px_execute.php' ,
			'/' ,
		] );
		// var_dump($output);
		$this->assertTrue( $this->utils->common_error( $output ) );

		// パブリッシュ
		$output = $this->utils->passthru( [
			'php', __DIR__.'/testdata/src_px2/.px_execute.php', '/?PX=publish.run'
		] );
		// var_dump($output);
		$this->assertTrue( $this->utils->common_error( $output ) );
		clearstatcache();

		// 後始末
		$output = $this->utils->passthru( [
			'php', __DIR__.'/testdata/src_px2/.px_execute.php', '/?PX=clearcache'
		] );

		clearstatcache();
		$this->assertTrue( $this->utils->common_error( $output ) );
		$this->assertTrue( !is_dir( __DIR__.'/testdata/src_px2/caches/p/' ) );

	}

}
