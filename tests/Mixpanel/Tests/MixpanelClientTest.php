<?php
/**
 * User: Joe Linn
 * Date: 7/9/13
 * Time: 2:49 PM
 */

namespace Mixpanel\Tests;


class MixpanelClientTest extends \Guzzle\Tests\GuzzleTestCase {

    public function testClientInstantiation(){
        /**
         * @var \Mixpanel\MixpanelClient $client
         */
        $client = $this->getServiceBuilder()->get('test.mixpanel');
        $this->assertEquals('http://mixpanel.com/api/2.0/', $client->getBaseUrl());
    }
}
