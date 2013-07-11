<?php
/**
 * User: Joe Linn
 * Date: 7/10/13
 * Time: 11:45 AM
 */

namespace MixGuzzle\Tests;


class MixGuzzleTestCase extends \Guzzle\Tests\GuzzleTestCase{
    /**
     * @var \MixGuzzle\MixGuzzleClient
     */
    protected $client;

    /**
     * @var string
     */
    protected $mockResponseDir;

    protected function setUp(){
        parent::setUp();
        $this->client = $this->getServiceBuilder()->get('test.mixpanel');
        $this->mockResponseDir = __DIR__.'/../../mock/';
    }
}