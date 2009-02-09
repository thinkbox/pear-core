--TEST--
PEAR_Downloader_Package->initialize() with invalid abstract package (Package not found)
--SKIPIF--
<?php
if (!getenv('PHP_PEAR_RUNTESTS')) {
    echo 'skip';
}
?>
--FILE--
<?php
require_once dirname(__FILE__) . DIRECTORY_SEPARATOR . 'setup.php.inc';
$pathtopackagexml = dirname(__FILE__)  . DIRECTORY_SEPARATOR .
    'test_initialize_downloadurl'. DIRECTORY_SEPARATOR . 'test-1.0.tgz';

$reg = &$config->getRegistry();
$chan = &$reg->getChannel('pear.php.net');
$chan->setBaseURL('REST1.0', 'http://pear.php.net/rest/');
$reg->updateChannel($chan);

$GLOBALS['pearweb']->addHtmlConfig('http://www.example.com/test-1.0.tgz', $pathtopackagexml);

$pearweb->addRESTConfig("http://pear.php.net/rest/r/test/allreleases.xml", false, false);

$dp = &newDownloaderPackage(array());
$phpunit->assertNoErrors('after create');
$result = $dp->initialize('test');

$phpunit->assertErrors(array(
    array(
        'package' => 'PEAR_Error',
        'message' => 'No releases for package "pear/test" exist'
    ),
    array(
        'package' => 'PEAR_Error',
        'message' => "Cannot initialize 'test', invalid or missing package file"
    ),
), 'after initialize');

$phpunit->assertEquals(array (
  array (
    0 => 0,
    1 => 'No releases available for package "pear.php.net/test"',
  ),
), $fakelog->getLog(), 'log messages');

$phpunit->assertEquals(array (), $fakelog->getDownload(), 'download callback messages');
$phpunit->assertIsa('PEAR_Error', $result, 'after initialize');
$phpunit->assertNull($dp->getPackageFile(), 'downloadable test');

echo 'tests done';
?>
--CLEAN--
<?php
require_once dirname(__FILE__) . '/teardown.php.inc';
?>
--EXPECT--
tests done
