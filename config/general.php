<?php
/**
 * General Configuration
 *
 * All of your system's general configuration settings go in here. You can see a
 * list of the available settings in vendor/craftcms/cms/src/config/GeneralConfig.php.
 *
 * @see \craft\config\GeneralConfig
 */

return [
    '*' => [
        'aliases' => [
            '@web' => getenv('PRIMARY_SITE_URL'),
            '@websiteUrl' => getenv('WEBSITE_URL'),
        ],
        'headlessMode' => true,
        'allowAdminChanges' => false,
        'allowedFileExtensions' => ['jpg', 'png', 'jpeg', 'webp', 'gif', 'svg', 'mp4', 'pdf', 'zip', 'csv'],
        'maxUploadFileSize' => '50MB',
        'allowUpdates' => false,
        'cacheDuration' => 14400,
        'defaultTokenDuration' => 'P2W',
        'defaultSearchTermOptions' => [
            'subLeft' => true,
            'subRight' => true,
        ],
        'disallowRobots' => true,
        'errorTemplatePrefix' => '_pages/errors/',
        'generateTransformsBeforePageLoad' => true,
        'limitAutoSlugsToAscii' => true,
        'maxRevisions' => 5,
        'omitScriptNameInUrls' => true,
        'runQueueAutomatically' => true,
        'securityKey' => getenv('CRAFT_SECURITY_KEY'),
    ],

    'production'  => [
        'devMode' => false,
        'disallowRobots' => false,
    ],

    'staging'  => [
        'testToEmailAddress' => getenv('TEST_EMAIL_ADDRESS') ?: null,
    ],

    'dev'  => [
        'allowAdminChanges' => true,
        'allowUpdates' => true,
        'enableTemplateCaching' => false,
        'testToEmailAddress' => getenv('TEST_EMAIL_ADDRESS') ?: null,
        'disabledPlugins' => [
            // 'seomatic', // for better performance measuring
        ],
        'runQueueAutomatically' => true,
    ],
];
