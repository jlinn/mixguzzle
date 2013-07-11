<?php
/**
 * User: Joe Linn
 * Date: 7/9/13
 * Time: 12:26 PM
 */

namespace Mixpanel\Plugin;

use Guzzle\Http\Url;
use Guzzle\Http\QueryString;
use Guzzle\Common\Event;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;

class MixpanelAuthPlugin implements EventSubscriberInterface{
    /**
     * @var string
     */
    protected $apiKey;

    /**
     * @var string
     */
    protected $apiSecret;

    /**
     * @var int
     */
    protected $expire;

    /**
     * @param string $apiKey
     * @param string $apiSecret
     * @param int $expire
     */
    public function __construct($apiKey, $apiSecret, $expire = 30){
        $this->apiKey = $apiKey;
        $this->apiSecret = $apiSecret;
        $this->expire = $expire;
    }

    /**
     * Returns an array of event names this subscriber wants to listen to.
     *
     * The array keys are event names and the value can be:
     *
     *  * The method name to call (priority defaults to 0)
     *  * An array composed of the method name to call and the priority
     *  * An array of arrays composed of the method names to call and respective
     *    priorities, or 0 if unset
     *
     * For instance:
     *
     *  * array('eventName' => 'methodName')
     *  * array('eventName' => array('methodName', $priority))
     *  * array('eventName' => array(array('methodName1', $priority), array('methodName2'))
     *
     * @return array The event names to listen to
     *
     * @api
     */
    public static function getSubscribedEvents()
    {
        return array('request.before_send' => 'onRequestBeforeSend');
    }

    /**
     * Add the requisite Mixpanel authentication parameters to the request's query string
     * @param Event $event
     * @return array
     */
    public function onRequestBeforeSend(Event $event){
        /**
         * @var \Guzzle\Http\Message\Request $request
         */
        $request = $event['request'];
        $params = $request->getQuery()->getAll();
        $params['api_key'] = $this->apiKey;
        $params['expire'] = time() + $this->expire;
        $args = $params;
        ksort($args);   //sort args alphabetically by key
        $signaturePieces = array();
        foreach($args as $key => $value){
            $signaturePieces[] = $key.'='.$value;
        }
        $signature = md5(implode('', $signaturePieces) . $this->apiSecret);
        $params['sig'] = $signature;
        $url = Url::factory($request->getUrl())->setQuery('')->setFragment(NULL);
        $queryString = new QueryString($params);
        $request->setUrl($url.'?'.$queryString);
        return $params;
    }
}