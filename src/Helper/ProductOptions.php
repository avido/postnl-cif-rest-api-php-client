<?php
namespace Avido\PostNLCifClient\Helper;

/**
  @File: ProductOptions.php
  @version 0.1.0
  @Encoding:  UTF-8
  @Package: postnl-cif-rest-api-php-client
  @copyright   Avido
  @Modified:
  @Description:
        Product Options Per Product Delivery Code
  @Dependencies:
*/

use Avido\PostNLCifClient\Exceptions\UnknownProductCodeException;
use Avido\PostNLCifClient\Helper\ProductOption;

abstract class ProductOptions
{
    private static $options =[
        '3085' => [
            'code' => '3085',
            'label' => 'Standard shipment',
            'isExtraCover' => false,
            'isEvening' => false,
            'isSunday' => false,
            'isCod' => false,
            'countryLimitation' => 'NL',
            'group' => 'standard_options'
        ],
        '3086' => [
            'code' => '3086',
            'label' => 'COD',
            'isExtraCover' => false,
            'isEvening' => true,
            'isSunday' => false,
            'isCod' => true,
            'countryLimitation' => 'NL',
            'group' => 'standard_options'
        ],
        '3091' => [
            'code' => '3091',
            'label' => 'COD + Extra cover',
            'isExtraCover' => true,
            'isEvening' => true,
            'isSunday' => false,
            'isCod' => true,
            'countryLimitation' => 'NL',
            'group' => 'standard_options'
        ],
        '3093' => [
            'code' => '3093',
            'label' => 'COD + Return when not home',
            'isExtraCover' => false,
            'isEvening' => true,
            'isSunday' => false,
            'isCod' => true,
            'countryLimitation'=> 'NL',
            'group' => 'standard_options'
        ],
        '3097' => [
            'code' => '3097',
            'label' => 'COD + Extra cover + Return when not home',
            'isExtraCover' => true,
            'isEvening' => true,
            'isSunday' => false,
            'isCod' => true,
            'countryLimitation'=> 'NL',
            'group' => 'standard_options'
        ],
        '3087' => [
            'code' => '3087',
            'label' => 'Extra Cover',
            'isExtraCover' => true,
            'isEvening' => true,
            'isSunday' => true,
            'isCod' => false,
            'countryLimitation' => 'NL',
            'group' => 'standard_options'
        ],
        '3094' => [
            'code' => '3094',
            'label' => 'Extra cover + Return when not home',
            'isEvening' => true,
            'isSunday' => true,
            'isExtraCover' => true,
            'isCod' => false,
            'countryLimitation'=> 'NL',
            'group' => 'standard_options'
        ],
        '3189' => [
            'code' => '3189',
            'label' => 'Signature on delivery',
            'isExtraCover' => false,
            'isEvening' => false,
            'isSunday' => false,
            'isCod' => false,
            'countryLimitation' => 'NL',
            'group' => 'standard_options'
        ],
        '3089' => [
            'code' => '3089',
            'label' => 'Signature on delivery + Delivery to stated address only',
            'isExtraCover' => false,
            'isEvening' => true,
            'isSunday' => true,
            'isCod' => false,
            'statedAddressOnly' => true,
            'isBelgiumOnly'     => false,
            'countryLimitation' => 'NL',
            'group' => 'standard_options'
        ],
        '3389' => [
            'code' => '3389',
            'label' => 'Signature on delivery + Return when not home',
            'isExtraCover' => false,
            'isEvening' => false,
            'isSunday' => false,
            'isCod' => false,
            'countryLimitation' => 'NL',
            'group' => 'standard_options'
        ],
        '3096' => [
            'code' => '3096',
            'label' => 'Signature on delivery + Deliver to stated address only + Return when not home',
            'isExtraCover' => false,
            'isEvening' => true,
            'isSunday' => true,
            'isCod' => false,
            'statedAddressOnly' => true,
            'isBelgiumOnly' => false,
            'countryLimitation' => 'NL',
            'group' => 'standard_options'
        ],
        '3090' => [
            'code' => '3090',
            'label' => 'Delivery to neighbour + Return when not home',
            'isExtraCover' => false,
            'isEvening' => true,
            'isSunday' => false,
            'isCod' => false,
            'countryLimitation' => 'NL',
            'group' => 'standard_options'
        ],
        '3385' => [
            'code' => '3385',
            'label' => 'Deliver to stated address only',
            'isExtraCover' => false,
            'isEvening' => true,
            'isSunday' => true,
            'isCod' => false,
            'statedAddressOnly' => true,
            'countryLimitation' => 'NL',
            'group' => 'standard_options'
        ],
        '3390' => [
            'code' => '3390',
            'label' => 'Deliver to stated address only + Return when not home',
            'isExtraCover' => false,
            'isEvening' => true,
            'isSunday' => true,
            'isCod' => false,
            'statedAddressOnly' => true,
            'countryLimitation' => 'NL',
            'group' => 'standard_options'
        ],
        '3535' => [
            'code' => '3535',
            'label' => 'Post Office + COD',
            'isExtraCover' => false,
            'isPge' => false,
            'isSunday' => false,
            'isCod' => true,
            'countryLimitation' => 'NL',
            'group' => 'pakjegemak_options'
        ],
        '3545' => [
            'code' => '3545',
            'label' => 'Post Office + COD + Notification',
            'isExtraCover' => false,
            'isSunday' => false,
            'isPge' => true,
            'isCod' => true,
            'countryLimitation' => 'NL',
            'group' => 'pakjegemak_options'
        ],
        '3536' => [
            'code' => '3536',
            'label' => 'Post Office + COD + Extra Cover',
            'isExtraCover' => false,
            'isSunday' => false,
            'isPge' => true,
            'isCod' => true,
            'countryLimitation' => 'NL',
            'group' => 'pakjegemak_options'
        ],
        '3546' => [
            'code' => '3546',
            'label' => 'Post Office + COD + Extra Cover + Notification',
            'isExtraCover' => true,
            'isPge' => true,
            'isSunday' => false,
            'isCod' => true,
            'countryLimitation' => 'NL',
            'group' => 'pakjegemak_options'
        ],
        '3534' => [
            'code' => '3534',
            'label' => 'Post Office + Extra Cover',
            'isExtraCover' => true,
            'isPge' => false,
            'isSunday' => false,
            'isCod' => false,
            'countryLimitation' => 'NL',
            'group' => 'pakjegemak_options'
        ],
        '3544' => [
            'code' => '3544',
            'label' => 'Post Office + Extra Cover + Notification',
            'isExtraCover' => true,
            'isPge' => true,
            'isSunday' => false,
            'isCod' => false,
            'countryLimitation' => 'NL',
            'group' => 'pakjegemak_options'
        ],
        '3533' => [
            'code' => '3533',
            'label' => 'Post Office + Signature on Delivery',
            'isExtraCover' => false,
            'isPge' => false,
            'isSunday' => false,
            'isCod' => false,
            'countryLimitation' => 'NL',
            'group' => 'pakjegemak_options'
        ],
        '3543' => [
            'code' => '3543',
            'label' => 'Post Office + Signature on Delivery + Notification',
            'isExtraCover' => false,
            'isSunday' => false,
            'isPge' => true,
            'isCod' => false,
            'countryLimitation' => 'NL',
            'group' => 'pakjegemak_options'
        ],
        '4952' => [
            'code' => '4952',
            'label' => 'EU Pack Special Consumer (incl. signature)',
            'isExtraCover' => false,
            'isSunday' => false,
            'countryLimitation' => false,
            'group' => 'eu_options',
        ],
        '4945' => [
            'code' => '4945',
            'label' => 'GlobalPack',
            'isExtraCover' => false,
            'isSunday' => false,
            'countryLimitation' => false,
            'group' => 'global_options'
        ],
        '4947' => [ // combiabel
            'code' => '4945',
            'label' => 'GlobalPack',
            'isExtraCover' => false,
            'isSunday' => false,
            'isCombiLabel' => true,
            'countryLimitation' => false,
            'group' => 'global_options'
        ],
        '3553' => [
            'code' => '3553',
            'label' => 'Parcel Dispenser',
            'isExtraCover' => false,
            'isSunday' => false,
            'countryLimitation' => 'NL',
            'group' => 'pakketautomaat_options'
        ],
        '2828' => [
            'code' => '2828',
            'label' => 'Letter Box Parcel',
            'isExtraCover' => false,
            'isSunday' => false,
            'countryLimitation' => 'NL',
            'group' => 'buspakje_options'
        ],
        '2928' => [
            'code' => '2928',
            'label' => 'Letter Box Parcel Extra',
            'isExtraCover' => false,
            'isSunday' => false,
            'countryLimitation' => 'NL',
            'group' => 'buspakje_options'
        ],
        '4970' => [
            'code' => '4970',
            'label' => 'Belgium Deliver to stated address only + Return when not home',
            'isExtraCover' => false,
            'isEvening' => false,
            'isSunday' => false,
            'isCod' => false,
            'statedAddressOnly' => true,
            'countryLimitation' => 'BE',
            'group' => 'standard_options'
        ],
        '4971' => [
            'code' => '4971',
            'label' => 'Belgium Return when not home',
            'isExtraCover' => false,
            'isEvening' => false,
            'isSunday' => false,
            'isCod' => false,
            'statedAddressOnly' => false,
            'countryLimitation' => 'BE',
            'group' => 'standard_options'
        ],
        '4972' => [
            'code' => '4972',
            'label' => 'Belgium Signature on delivery + Deliver to stated address only + Return when not home',
            'isExtraCover' => false,
            'isEvening' => false,
            'isSunday' => false,
            'isCod' => false,
            'statedAddressOnly' => true,
            'countryLimitation' => 'BE',
            'group' => 'standard_options'
        ],
        '4973' => [
            'code' => '4973',
            'label' => 'Belgium Signature on delivery + Return when not home',
            'isExtraCover' => false,
            'isEvening' => false,
            'isSunday' => false,
            'isCod' => false,
            'statedAddressOnly' => false,
            'countryLimitation' => 'BE',
            'group' => 'standard_options'
        ],
        '4974' => [
            'code' => '4974',
            'label' => 'Belgium COD + Return when not home',
            'isExtraCover' => false,
            'isEvening' => false,
            'isSunday' => false,
            'isCod' => true,
            'statedAddressOnly' => false,
            'countryLimitation' => 'BE',
            'group' => 'standard_options'
        ],
        '4975' => [
            'code' => '4975',
            'label' => 'Belgium Extra cover (EUR 500)+ Return when not home + Deliver to stated address only',
            'isExtraCover' => true,
            'extraCover' => 500,
            'isEvening' => false,
            'isSunday' => false,
            'isCod' => false,
            'statedAddressOnly' => true,
            'countryLimitation' => 'BE',
            'group' => 'standard_options'
        ],
        '4976' => [
            'code' => '4976',
            'label' => 'Belgium COD + Extra cover (EUR 500) + Return when not home',
            'isExtraCover' => true,
            'extraCover' => 500,
            'isEvening' => false,
            'isSunday' => false,
            'isCod' => true,
            'statedAddressOnly' => false,
            'countryLimitation' => 'BE',
            'group' => 'standard_options'
        ]
    ];
    
    /**
     * Get Product Code instance
     * @param string $code
     * @return ProductOption
     * @throws UnknownProductCodeException
     */
    public static function getProduct($code)
    {
        if (!isset(self::$options[$code])) {
            throw new UnknownProductCodeException($code);
        } else {
            return new ProductOption(self::$options[$code]);
        }
    }
}
