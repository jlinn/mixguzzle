<?php
/**
 * User: Joe Linn
 * Date: 7/9/13
 * Time: 12:47 PM
 */

namespace MixGuzzle\Tests\Plugin;

use Guzzle\Common\Event;
use Guzzle\Http\Client;
use MixGuzzle\Plugin\MixGuzzleAuthPlugin;

class MixGuzzleAuthPluginTest extends \PHPUnit_Framework_TestCase {
    public function testAddMixpanelAuthentication(){
        $plugin = new MixGuzzleAuthPlugin('key', 'secret');
        $client = new Client('http://test.com/');
        $client->getEventDispatcher()->addSubscriber($plugin);
        $request = $client->get('/');
        $event = new Event(array(
            'request' => $request,
            'timestamp' => 123456789
        ));
        $params = $plugin->onRequestBeforeSend($event);
        $this->assertArrayHasKey('sig', $params);
    }
}
