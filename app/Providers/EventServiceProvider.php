<?php
protected $listen = [
    \SocialiteProviders\Manager\SocialiteWasCalled::class => [
        'SocialiteProviders\\Apple\\AppleExtendSocialite@handle',
    ],
];
