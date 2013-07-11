<?php
/**
 * User: Joe Linn
 * Date: 7/9/13
 * Time: 11:25 AM
 */

error_reporting(E_ALL | E_STRICT);

require_once 'PHPUnit/TextUI/TestRunner.php';

//composer autoloader
$autoloader = require dirname(__DIR__) . '/vendor/autoload.php';


$config = json_decode(file_get_contents($_SERVER['CONFIG']), true);

\Guzzle\Tests\GuzzleTestCase::setServiceBuilder(Guzzle\Service\Builder\ServiceBuilder::factory(array(
    'test.mixpanel' => array(
        'class' => 'MixGuzzle\MixGuzzleClient',
        'params' => $config
    )
)));