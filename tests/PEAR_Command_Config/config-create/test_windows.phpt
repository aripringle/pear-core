--TEST--
config-create command --windows
--SKIPIF--
<?php
if (!getenv('PHP_PEAR_RUNTESTS')) {
    echo 'skip';
}
?>
--FILE--
<?php
error_reporting(E_ALL);
require_once dirname(dirname(__FILE__)) . DIRECTORY_SEPARATOR . 'setup.php.inc';
$temp_path2 = str_replace(DIRECTORY_SEPARATOR, '\\', $temp_path);
$e = $command->run('config-create', array('windows' => true), array($temp_path2 . DIRECTORY_SEPARATOR . 'nomake', $temp_path . DIRECTORY_SEPARATOR
    . 'remote.ini'));
$phpunit->assertEquals(array (
  0 => 
  array (
    'info' => 
    array (
      'caption' => 'Configuration (channel pear.php.net):',
      'data' => 
      array (
        'Internet Access' => 
        array (
          0 => 
          array (
            0 => 'Auto-discover new Channels',
            1 => 'auto_discover',
            2 => NULL,
          ),
          1 => 
          array (
            0 => 'Default Channel',
            1 => 'default_channel',
            2 => 'pear.php.net',
          ),
          2 => 
          array (
            0 => 'HTTP Proxy Server Address',
            1 => 'http_proxy',
            2 => NULL,
          ),
          3 => 
          array (
            0 => 'PEAR server [DEPRECATED]',
            1 => 'master_server',
            2 => NULL,
          ),
          4 => 
          array (
            0 => 'Default Channel Mirror',
            1 => 'preferred_mirror',
            2 => NULL,
          ),
          5 => 
          array (
            0 => 'Remote Configuration File',
            1 => 'remote_config',
            2 => NULL,
          ),
        ),
        'File Locations' => 
        array (
          0 => 
          array (
            0 => 'PEAR executables directory',
            1 => 'bin_dir',
            2 => '' . $temp_path2 . '\\nomake\\pear',
          ),
          1 => 
          array (
            0 => 'PEAR documentation directory',
            1 => 'doc_dir',
            2 => '' . $temp_path2 . '\\nomake\\pear\\docs',
          ),
          2 => 
          array (
            0 => 'PHP extension directory',
            1 => 'ext_dir',
            2 => '' . $temp_path2 . '\\nomake\\pear\\ext',
          ),
          3 => 
          array (
            0 => 'PEAR directory',
            1 => 'php_dir',
            2 => '' . $temp_path2 . '\\nomake\\pear\\php',
          ),
        ),
        'File Locations (Advanced)' => 
        array (
          0 => 
          array (
            0 => 'PEAR Installer cache directory',
            1 => 'cache_dir',
            2 => '' . $temp_path2 . '\\nomake\\pear\\cache',
          ),
          1 => 
          array (
            0 => 'PEAR data directory',
            1 => 'data_dir',
            2 => '' . $temp_path2 . '\\nomake\\pear\\data',
          ),
          2 => 
          array (
            0 => 'PHP CLI/CGI binary',
            1 => 'php_bin',
            2 => NULL,
          ),
          3 => 
          array (
            0 => 'PEAR test directory',
            1 => 'test_dir',
            2 => '' . $temp_path2 . '\\nomake\\pear\\tests',
          ),
        ),
        'Advanced' => 
        array (
          0 => 
          array (
            0 => 'Cache TimeToLive',
            1 => 'cache_ttl',
            2 => NULL,
          ),
          1 => 
          array (
            0 => 'Preferred Package State',
            1 => 'preferred_state',
            2 => NULL,
          ),
          2 => 
          array (
            0 => 'Unix file mask',
            1 => 'umask',
            2 => NULL,
          ),
          3 => 
          array (
            0 => 'Debug Log Level',
            1 => 'verbose',
            2 => NULL,
          ),
        ),
        'Maintainers' => 
        array (
          0 => 
          array (
            0 => 'PEAR password (for maintainers)',
            1 => 'password',
            2 => NULL,
          ),
          1 => 
          array (
            0 => 'Signature Handling Program',
            1 => 'sig_bin',
            2 => NULL,
          ),
          2 => 
          array (
            0 => 'Signature Key Directory',
            1 => 'sig_keydir',
            2 => NULL,
          ),
          3 => 
          array (
            0 => 'Signature Key Id',
            1 => 'sig_keyid',
            2 => NULL,
          ),
          4 => 
          array (
            0 => 'Package Signature Type',
            1 => 'sig_type',
            2 => NULL,
          ),
          5 => 
          array (
            0 => 'PEAR username (for maintainers)',
            1 => 'username',
            2 => NULL,
          ),
        ),
        'Config Files' => 
        array (
          0 => 
          array (
            0 => 'User Configuration File',
            1 => 'Filename',
            2 => $temp_path . DIRECTORY_SEPARATOR . 'remote.ini',
          ),
          1 => 
          array (
            0 => 'System Configuration File',
            1 => 'Filename',
            2 => '#no#system#config#',
          ),
        ),
      ),
    ),
    'cmd' => 'config-show',
  ),
  1 => 
  array (
    'info' => 'Successfully created default configuration file "' .
    $temp_path . DIRECTORY_SEPARATOR . 'remote.ini"',
    'cmd' => 'config-create',
  ),
), $fakelog->getLog(), 'log');
$phpunit->assertFileExists($temp_path . DIRECTORY_SEPARATOR . 'remote.ini', 'not created');
$contents = explode("\n", implode('', file($temp_path . DIRECTORY_SEPARATOR . 'remote.ini')));
$contents = unserialize($contents[1]);
$config->readConfigFile($temp_path . DIRECTORY_SEPARATOR . 'remote.ini');
$phpunit->assertEquals(array (
  '__channels' => 
  array (
    'pecl.php.net' => 
    array (
    ),
    '__uri' => 
    array (
    ),
  ),
  'php_dir' => $temp_path2 . '\\nomake\\pear\\php',
  'data_dir' => $temp_path2 . '\\nomake\\pear\\data',
  'ext_dir' => $temp_path2 . '\\nomake\\pear\\ext',
  'doc_dir' => $temp_path2 . '\\nomake\\pear\\docs',
  'test_dir' => $temp_path2 . '\\nomake\\pear\\tests',
  'cache_dir' => $temp_path2 . '\\nomake\\pear\\cache',
  'bin_dir' => $temp_path2 . '\\nomake\\pear',
), $contents, 'ok');
echo 'tests done';
?>
--EXPECT--
tests done
