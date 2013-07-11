<?php
/**
 * User: Joe Linn
 * Date: 7/9/13
 * Time: 2:49 PM
 */

namespace MixGuzzle\Tests;


class MixGuzzleClientTest extends \Guzzle\Tests\GuzzleTestCase {

    public function testClientInstantiation(){
        /**
         * @var \MixGuzzle\MixGuzzleClient $client
         */
        $client = $this->getServiceBuilder()->get('test.mixpanel');
        $this->assertEquals('http://mixpanel.com/api/2.0/', $client->getBaseUrl());
    }
}
