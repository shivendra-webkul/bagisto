<?php

return [
    'checkout' => [
        'cart' => [
            'integrity' => [
                'qty-missing'   => 'At least one product should have more than 1 quantity.',
            ],

            'invalid-file-extension'   => 'Invalid file extension found.',
            'inventory-warning'        => 'The requested quantity is not available, please try again later.',
            'missing-links'            => 'Downloadable links are missing for this product.',
            'missing-options'          => 'Options are missing for this product.',
            'selected-products-simple' => 'Selected products must be of simple product type.',
        ],
    ],

    'datagrid' => [
        'copy-of-slug'                  => 'copy-of-:value',
        'copy-of'                       => 'Copy Of :value',
        'variant-already-exist-message' => 'Variant with same attribute options already exists.',
    ],

    'response' => [
        'product-can-not-be-copied' => 'Products of type :type can not be copied',
    ],

    'sort-by'  => [
        'options' => [
            'cheapest-first'  => 'Cheapest First',
            'expensive-first' => 'Expensive First',
            'from-a-z'        => 'From A-Z',
            'from-z-a'        => 'From Z-A',
            'latest-first'    => 'Newest First',
            'oldest-first'    => 'Oldest First',
        ],
    ],

    'type'     => [
        'abstract'     => [
            'offers' => 'Buy :qty for :price each and save :discount',
        ],

        'bundle'       => 'Bundle',
        'booking'      => 'Booking',
        'configurable' => 'Configurable',
        'downloadable' => 'Downloadable',
        'grouped'      => 'Grouped',
        'simple'       => 'Simple',
        'virtual'      => 'Virtual',
    ],
];
