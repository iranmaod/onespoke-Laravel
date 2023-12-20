<?php

/**
 * Copyright (c) Vincent Klaiber.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 *
 * @see https://github.com/vinkla/laravel-hashids
 */

use App\Models\Bike;
use App\Models\Conversation;
use App\Models\User;

return [

    /*
    |--------------------------------------------------------------------------
    | Default Connection Name
    |--------------------------------------------------------------------------
    |
    | Here you may specify which of the connections below you wish to use as
    | your default connection for all work. Of course, you may use many
    | connections at once using the manager class.
    |
    */

    'default' => 'main',

    /*
    |--------------------------------------------------------------------------
    | Hashids Connections
    |--------------------------------------------------------------------------
    |
    | Here are each of the connections setup for your application. Example
    | configuration has been included, but you may add as many connections as
    | you would like.
    |
    */

    'connections' => [

        User::class => [
            'salt' => User::class . '4664a78681f73ecfc3abc16b244384ca',
            'length' => 5,
        ],

        Bike::class => [
            'salt' => Bike::class . '56ce3e574ff7688b260611b23cd8cc4c',
            'length' => 5,
        ],

        Conversation::class => [
            'salt' => Conversation::class . '79abe4927c88053c7dbd877e75161527',
            'length' => 5,
        ],


    ],

];
