<?php
/**
 * test
 */

class nocacheTest extends PHPUnit\Framework\TestCase{
	private $fs;
	private $utils;

	public function setUp() : void{
		mb_internal_encoding('UTF-8');
		$this->fs = new tomk79\filesystem();
		require_once(__DIR__.'/libs/utils.php');
		$this->utils = new \tests\utils();
	}


	/**
	 * 普通に実行してみるテスト
	 */
	public function testStandard(){
		$this->fs->copy(
			__DIR__.'/testdata/src_px2/px-files/test_confs/config_nocache.php',
			__DIR__.'/testdata/src_px2/px-files/config.php'
		);

		$output = $this->utils->px_execute(
			'/src_px2/.px_execute.php' ,
			'/' ,
		);
		// var_dump($output);
		$this->assertTrue( $this->utils->common_error( $output ) );

		$output = $this->utils->px_execute(
			'/src_px2/.px_execute.php',
			'/common/styles/test1.css'
		);
		// var_dump($output);
		$this->assertTrue( $this->utils->common_error( $output ) );
		$this->assertEquals( preg_match( '/'.preg_quote('.test-a .test-b .test-b p {', '/').'/s', $output ), 1 );

		// --------------------------------------
		// キャッシュが生成されているか
		$realpath_cache = __DIR__.'/testdata/src_px2/px-files/_sys/ram/caches/px2scss/';
		// var_dump( $this->fs->ls($realpath_cache) );
		$this->assertFalse( $this->fs->is_dir($realpath_cache) );
		$this->assertFalse( $this->fs->is_file($realpath_cache.'fba7e2963c69f52af670c991e4011e35') );
	}

	/**
	 * パブリッシュしてみるテスト
	 */
	public function testPublish(){
		// パブリッシュ
		$output = $this->utils->px_execute(
			'/src_px2/.px_execute.php',
			'/?PX=publish.run'
		);
		// var_dump($output);
		$this->assertTrue( $this->utils->common_error( $output ) );
		clearstatcache();

		$output = $this->fs->read_file( __DIR__.'/testdata/dist/common/styles/test1.css' );
		$this->assertEquals( preg_match( '/'.preg_quote('.test-a .test-b .test-b p {', '/').'/s', $output ), 1 );
	}


	/**
	 * 後片付け
	 */
	public function testCleaning(){
		$this->fs->copy(
			__DIR__.'/testdata/src_px2/px-files/test_confs/config.php',
			__DIR__.'/testdata/src_px2/px-files/config.php'
		);

		$output = $this->utils->px_execute(
			'/src_px2/.px_execute.php',
			'/?PX=clearcache'
		);
		clearstatcache();
		$this->assertTrue( $this->utils->common_error( $output ) );
		$this->assertTrue( !is_dir( __DIR__.'/testdata/src_px2/caches/p/' ) );
	}

}
