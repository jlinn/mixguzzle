<?php
/**
 * User: Joe Linn
 * Date: 7/10/13
 * Time: 11:48 AM
 */

namespace Mixpanel\Tests\Command;

use \Mixpanel\Tests\MixpanelTestCase;

class EventsTest extends MixpanelTestCase{
    public function testEvents(){
        $command = $this->client->getCommand('events', array(
            'event' => array('Homepage Visit'),
            'type' => 'unique',
            'unit' => 'day',
            'interval' => 1
        ));

        //queue up the mock response
        $this->setMockResponse($this->client, $this->mockResponseDir.'Events.txt');

        //send the request
        $response = $this->client->execute($command);
        $request = $command->getRequest();

        $this->assertContainsOnly($request, $this->getMockedRequests());
        $this->assertEquals($request, $this->getMockedRequests()[0]);
    }
}
