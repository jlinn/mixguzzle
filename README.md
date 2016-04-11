MixGuzzle, a PHP [Mixpanel](http://mixpanel.com) data export API client using [Guzzle](https://github.com/guzzle/guzzle)
================================================================================================

Operations are named based on their request URIs as outlined in Mixpanel's [API documentation](https://mixpanel.com/docs/api-documentation/data-export-api).

```php
//example client instantiation and API call
$client = MixGuzzle\MixGuzzleClient::factory(array(
    'api_key' => 'your_api_key',
    'api_secret' => 'your_api_secret'
));
$command = $client->getCommand('events', array(
    'event' => array('Homepage Visit'),
    'type' => 'unique',
    'unit' => 'day',
    'interval' => 10
));
$response = $client->execute($command);
```

### Installing via [Composer](http://getcomposer.org):

```bash
# Install Composer
curl -sS https://getcomposer.org/installer | php

# Add MixGuzzle as a dependency
php composer.phar require jlinn/mixguzzle
```

After installing, you need to require Composer's autoloader:

```php
require 'vendor/autoload.php';
```
