<?php
 $config = array(
'DB_TYPE' => 'mysql',
'DB_HOST' => 'localhost',
'DB_NAME' => 'wms',
'DB_USER' => 'root',
'DB_PWD' => 'root',
'DB_PORT' => '3306',
'DB_PREFIX' => 'pes_',
'PRIVATE_KEY' => '818c71f811',
'USER_KEY' => '98e9fe095c',
'ERROR_PROMPT' => '/Core/Theme/error.php',
'APP_GROUP_LIST' => 'Form,Ticket',
'DEFAULT_GROUP' => 'Form',
'FILE_CACHE_PATH' => '/Temp',
'FILE_CACHE_TIME' => '1800',
'LOG_PATH' => '/log',
'LOG_DELETE' => '7',
'UPLOAD_PATH' => '/upload',
'URLMODEL' => array(
'INDEX' => '0',
'SUFFIX' => '1',
),);
$configPath = dirname(__FILE__) . '/Config/';
$configFile = scandir($configPath);
//长度少于等于2结束植入检测.
if (count($configFile) <= '2') {
    return $config;
}

foreach ($configFile as $value) {
    if ($value != '.' && $value != '..' && $value != '.DS_Store') {
        $tmpArray = require $configPath . $value;
        if (is_array($tmpArray)) {
            $config['APP_GROUP_LIST'] = empty($tmpArray['GROUP']) ? $config['APP_GROUP_LIST'] : "{$config['APP_GROUP_LIST']},{$tmpArray['GROUP']}";
            $config = array_merge($config, $tmpArray);
        }
    }
}
return $config;
