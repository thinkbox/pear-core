--TEST--
PEAR_DependencyDB->getDependentPackages()
--SKIPIF--
<?php
if (!getenv('PHP_PEAR_RUNTESTS')) {
    echo 'skip';
}
?>
--FILE--
<?php
require_once dirname(__FILE__) . DIRECTORY_SEPARATOR . 'setup.php.inc';
copyItem('registry'); //setup for nice clean rebuild
$db = &PEAR_DependencyDB::singleton($config);
$p = array('package' => 'PEAR', 'channel' => 'pear.php.net');
$phpunit->assertEquals(array (
  0 => 
  array (
    'channel' => 'pear.php.net',
    'package' => 'db',
  ),
  1 => 
  array (
    'channel' => 'pear.php.net',
    'package' => 'liveuser',
  ),
  2 => 
  array (
    'channel' => 'pear.php.net',
    'package' => 'mdb2',
  ),
  3 => 
  array (
    'channel' => 'pear.php.net',
    'package' => 'pear',
  ),
  4 => 
  array (
    'channel' => 'pear.php.net',
    'package' => 'peartests',
  ),
  5 => 
  array (
    'channel' => 'pear.php.net',
    'package' => 'pear_info',
  ),
  6 => 
  array (
    'channel' => 'pear.php.net',
    'package' => 'pear_packagefilemanager',
  ),
  7 => 
  array (
    'channel' => 'pear.php.net',
    'package' => 'php_parser',
  ),
  8 => 
  array (
    'channel' => 'pear.php.net',
    'package' => 'xml_parser',
  ),
  9 => 
  array (
    'channel' => 'pear.php.net',
    'package' => 'xml_serializer',
  ),
  10 => 
  array (
    'channel' => 'pear.php.net',
    'package' => 'xml_util',
  ),
), $db->getDependentPackages($p), 'PEAR');
$p = array('package' => 'LiveUser', 'channel' => 'pear.php.net');
$phpunit->assertEquals(false, $db->getDependentPackages($p), 'LiveUser');
$p = array('package' => 'Slonk', 'channel' => 'pear.php.net');
$phpunit->assertEquals(false, $db->getDependentPackages($p), 'Slonk');
echo 'tests done';
?>
--EXPECT--
tests done