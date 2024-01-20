<?php

return [
    'mode' => env('ARAMEX_MODE', 'test'),

    'test' => [
        'version' => 'v1.0',
        'locationURL' => 'https://ws.sbx.aramex.net/shippingapi.v2/location/service_1_0.svc?wsdl',
        'rateURL' => 'https://ws.sbx.aramex.net/ShippingAPI.V2/RateCalculator/Service_1_0.svc?wsdl',
        'shippingURL' => 'https://ws.sbx.aramex.net/shippingapi.v2/shipping/service_1_0.svc?wsdl',
        'trackingURL' => 'https://ws.sbx.aramex.net/ShippingAPI.V2/tracking/Service_1_0.svc?wsdl',
    ],

    'live' => [
        'version' => 'v1.0',
        'locationURL' => 'https://ws.aramex.net/shippingapi.v2/location/service_1_0.svc?wsdl',
        'rateURL' => 'https://ws.aramex.net/ShippingAPI.V2/RateCalculator/Service_1_0.svc?wsdl',
        'shippingURL' => 'https://ws.aramex.net/shippingapi.v2/shipping/service_1_0.svc?wsdl',
        'trackingURL' => 'https://ws.aramex.net/ShippingAPI.V2/tracking/Service_1_0.svc?wsdl',
    ],
];
