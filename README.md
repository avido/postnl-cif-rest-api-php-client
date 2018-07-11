
[![Build Status](https://travis-ci.com/avido/postnl-cif-rest-api-php-client.svg?branch=master)](https://travis-ci.com/avido/postnl-cif-rest-api-php-client)
[![Latest Stable Version](https://poser.pugx.org/avido/postnl-cif-rest-api-php-client/v/stable)](https://packagist.org/packages/avido/postnl-cif-rest-api-php-client)
[![Total Downloads](https://poser.pugx.org/avido/postnl-cif-rest-api-php-client/downloads)](https://packagist.org/packages/avido/postnl-cif-rest-api-php-client)
[![License](https://poser.pugx.org/avido/postnl-cif-rest-api-php-client/license)](https://packagist.org/packages/avido/postnl-cif-rest-api-php-client)


# PostNL CIF Rest Webservices API Client for PHP

Open source PHP client for the [PostNL Rest CIF Webservices] (https://developer.postnl.nl/).

## Installation
Get it with [composer](https://getcomposer.org)

Run the command:
```
composer require avido/postnl-cif-rest-api-php-client
```
## client initialization: 

```php
require __DIR__ . '/vendor/autoload.php';
use Avido\PostNLCifClient\CifApi;

$apikey = '--YOUR APIKEY --';
$client = new CifApi($apiKey);
```

## Example: Retrieve nearest locations based on address information
```php
use Avido\PostNLCifClient\Request\DeliveryOptions\Locations\NearestLocationsRequest;

// get nearest locations based on address information
$request = new NearestLocationsRequest();
$request->setCountryCode('NL')
    ->setPostalcode('2132WT')
    ->setCity('Hoofddorp')
    ->setStreet('Siriusdreef')
    ->setHouseNumber(42)
    ->setDeliveryDate('01-01-2999')
    ->setOpeningTime('09:00:00')
    ->addDeliveryOptions('PG');
// load api "getAPI" based on required services.
$response = $client->getAPI('location')->getNearestLocations($request);
```

## Unit tests
```xml
<phpunit>
  ...
    <php>
        <env name="PHP_APIKEY" value="--YOUR APIKEY--"/>
    </php>
</phpunit>
```

# Implementation Status

This library is still in development, new releases / implementations will follow.

## Delivery Options

### Deliverydate webservice
| Service                                            | Implemented | Version |
|-----------------------------------------------|:-----------:|:-------:|
|**Delivery date webservice**                      |             |         |
| Deliverydate                                     |      ✓      |   2_2   |
| Shippingdate                                     |      ✓      |   2_2   |
|**Location webservice**                       |             |         |
| Nearest Locations                              |      ✓      |   2_1   |
| Nearest based on Geo location             |      ✓      |   2_1   |
| Nearest based on Area                         |      ✓      |   2_1   |
| Location lookup                                   |      ✓      |   2_1   |
|**Timeframe webservice**                      |             |         |
| timeframes                                     |      ✓      |   2_1   |


## Send & Track

### Barcode webservice
| Service                                       | Implemented   | Version   |
|-----------------------------------------------|:-------------:|:---------:|
|**Barcode service**                            |               |           |
| Barcode (generate)                            |      ✗        |   N/A     |
|###Labelling webservice                        |               |           |
| Label (generate)                              |      ✗        |   N/A     |
|###Confirming webservice                       |               |           |
| Confirm                                       |      ✗        |   N/A     |
|###Shippingstatus webservice                   |               |           |
| Status by barcode                             |      ✗        |   N/A     |
| Status by reference id                        |      ✗        |   N/A     |
| Status by reference id                        |      ✗        |   N/A     |
| Status by kid ('kennisgeving id')             |      ✗        |   N/A     |
| Search                                        |      ✗        |   N/A     |
| Signature                                     |      ✗        |   N/A     |

## Fraud Prevention

### IBAN Check National
| Service                                            | Implemented | Version |
|-----------------------------------------------|:-----------:|:-------:|
| Validate IBAN                                     |      ✗      |   N/A   |
| Calculate (bankaccountnumber => iban) |      ✗      |   N/A   |


### Kreditcheck Zakelijk
| Service                                            | Implemented | Version |
|-----------------------------------------------|:-----------:|:-------:|
| Company Search API                            |      ✗      |   N/A   |
| Credit Flag API                                    |      ✗      |   N/A   |
| Credit Advice API                                 |      ✗      |   N/A   |
| Creditworthiness API                              |      ✗      |   N/A   |
| Creditworthiness API Large                    |      ✗      |   N/A   |


## Customer overview

### Bedrijfscheck Nationaal
| Service                                            | Implemented | Version |
|-----------------------------------------------|:-----------:|:-------:|
| Companysearch                                 |      ✗      |   N/A   |
| Companyname and address               |      ✗      |   N/A   |
| Company address                               |      ✗      |   N/A   |
| Company phone                                 |      ✗      |   N/A   |
| Company details                               |      ✗      |   N/A   |
| Company details extra                         |      ✗      |   N/A   |
| Authorized Signatory                          |      ✗      |   N/A   |
| Cocextract                                        |      ✗      |   N/A   |


## Mail
| Service                                            | Implemented | Version |
|-----------------------------------------------|:-----------:|:-------:|
| N/A                                                   |      ✗      |   N/A   |
