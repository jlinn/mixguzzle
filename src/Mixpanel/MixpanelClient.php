<?php
/**
 * User: Joe Linn
 * Date: 7/9/13
 * Time: 11:55 AM
 */

namespace Mixpanel;

use Guzzle\Common\Collection;
use Guzzle\Service\Client;
use Guzzle\Service\Description\ServiceDescription;

/**
 * Class MixpanelClient
 * @package Mixpanel
 * @link https://mixpanel.com/docs/api-documentation/data-export-api
 */
class MixpanelClient extends Client{
    /**
     * Factory method to create a new MixpanelClient
     * The following keys and values are available options:
     * - base_url: base url of the mixpanel web service (optional)
     * - scheme: URI scheme: http or https (optional, defaults to http)
     * - api_key: your Mixpanel api key (required)
     * - api_secret: your Mixpanel api secret (required)
     * - expire: timeout in seconds for all api requests (optional, defaults to 30)
     * @param array $config configuration data
     * @return MixpanelClient
     */
    public static function factory($config = array()){
        $default = array(
            'base_url' => '{scheme}://mixpanel.com/api/2.0/',
            'scheme' => 'http',
            'expire' => 30
        );
        $required = array('api_key', 'api_secret');
        $config = Collection::fromConfig($config, $default, $required);
        $client = new self($config->get('base_url'), $config);

        $auth = new Plugin\MixpanelAuthPlugin($config['api_key'], $config['api_secret'], $config['expire']);
        $client->getEventDispatcher()->addSubscriber($auth);

        //attach a service description to the client
        $description = ServiceDescription::factory(__DIR__ . '/service.json');
        $client->setDescription($description);

        return $client;
    }
}