<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Default Filesystem Disk
    |--------------------------------------------------------------------------
    |
    | Here you may specify the default filesystem disk that should be used
    | by the framework. The "local" disk, as well as a variety of cloud
    | based disks are available to your application. Just store away!
    |
    */

    'default' => env('FILESYSTEM_DRIVER', 'local'),

    /*
    |--------------------------------------------------------------------------
    | Filesystem Disks
    |--------------------------------------------------------------------------
    |
    | Here you may configure as many filesystem "disks" as you wish, and you
    | may even configure multiple disks of the same driver. Defaults have
    | been setup for each driver as an example of the required options.
    |
    | Supported Drivers: "local", "ftp", "sftp", "s3"
    |
    */

    'disks' => [

        'local' => [
            'driver' => 'local',
            'root' => storage_path('app'),
        ],

        'public' => [
            'driver' => 'local',
            'root' => storage_path('app/public'),
            'url' => env('APP_URL').'/storage',
            'visibility' => 'public',
        ],

        's3' => [
            'driver' => 's3',
            'key' => env('AWS_ACCESS_KEY_ID'),
            'secret' => env('AWS_SECRET_ACCESS_KEY'),
            'region' => env('AWS_DEFAULT_REGION'),
            'bucket' => env('AWS_BUCKET'),
            'url' => env('AWS_URL'),
            'endpoint' => env('AWS_ENDPOINT'),
            'use_path_style_endpoint' => env('AWS_USE_PATH_STYLE_ENDPOINT', false),
        ],
        'gcs' => [
            'driver' => 'gcs',
            // 'key_file_path' => env('GOOGLE_CLOUD_KEY_FILE', null), // optional: /path/to/service-account.json
            'key_file' => [
                "type"=> "service_account",
                "project_id"=> "tab-kanban",
                "private_key_id"=> "3afb80c4aaf0a8468e4f020198aa1814e8f6c7c2",
                "private_key"=> "-----BEGIN PRIVATE KEY-----\nMIIEugIBADANBgkqhkiG9w0BAQEFAASCBKQwggSgAgEAAoIBAQCHnYULGvB0LVlC\nZ2B6pZJn1j2RPrvu1AIrFl+oyC3lJqW/3vsOokrUG9IBxW+VN3fzmIKsmwDVLqyA\nBRcPiSOqeJ3abDbCgON2btURKh2hjfoX5ak1YY4PtiOvZvCXowkzMJDmGnRIZ8Tf\ntJqDU+k348GyyoQ2oUkh4dmq1rrEXljZEaLoILonpU3utJ08cn7/6mRQQaib3B+P\nUldjTsoEeG9mjJHIlWZwjxXHbkmTbThU2lxZA8VDUz689G6iCxaEXqHqq7eAiF3d\n3vDdWuXdnuSO5mEZ2FAh+SYcGI6q2DSiyUTHm1jL6/G9gFcQpck8bPCFYpI3nTju\ntrGZ9W7XAgMBAAECgf9mJsDlxzpYSHseXxV395UlohBo1624DaTpz8XpMjVf5pHz\ndS1Rre2vgpqDEF/R23ZUhwyR94UpD381mfVE6TLJtbvcS1Ge28x6lAGVFvmQN4xV\nc9OBN3qgBb0w4i6tX0wOwwZiTTWfVIrMob3Bg/NS+2bBcMp7sVblBA/Gyk2PRmk9\nWS1HoV4xFgMewELg9s23SfNfbIvzCI9ta7aoiNpMSLvF2SMy2Joetfk/08wBBdTx\n0gmlvFhW14LgJch+soblPDRlPaNjkA+xOkrpRD4dZRiK1XuY55wzEg3WXTV7n3t+\nw9QwfmM3/VvI2SRjEjclnbSCAo3YK/xafdhpTCUCgYEAvYue/F6QyPMtNexrw0/5\ng5zm0f09FYo/WrgqHUaU3vI8RaMDoRPK8qq7WMGcpNR5O+6sg9GBnQJQmgNq1VOA\nZjYNYEgbGNMHObgrz4J8RhvW9jK3F2R971wZIgf/bY+uI6z0/7FGNRxXAnBBjxrU\ncVWBFSGiq9zCk8Pdh3a9ryMCgYEAtyl68rPbo46VeN6Igsul4JioaWXFLeYjgS+v\n5QrqzWxUBIQlRSqGIC5KNeJ1wi0o3T6XoeuZLa+dSGQkDNZsICQmpCT16bwP69RV\njnlTPwBvz3d+PryVLfcypwyvFVxwQJiSH/nN2J4LNRPinLkhTeCB2QM3E+gpaynF\npp2bdr0CgYB5YGIzu569f7NQ149+Z8Ug+aV5jM/D7l55ins1ehA04CumcCgPyuvo\nD1qfEIRtrL3hmgoQ82UrlOLmbQ/JgYo0aaKRKDtp3yC+Xmh3nlhUUNmLmJhUO37F\ne1WAzFxN3Xcm00ekQPHzaq1xG09wAz9NP/LEBGD16w0SsJc4etomvwKBgFxlTGRK\nXq3vK2/BslNor9DQsYQZlpJE2fw9Nhnwm+nsj6WHk9WEUgzBzSXJi2XcqhSRkqRX\n2Pm28TynZ5giQoEkO2nqSzMRb2ajwlUQ1vGdIsohmUnEj+yUGrUyLNA1xVqQnIYM\n2c5AS58G3PX6XdaPPnFesdYU82/frpkSQG5xAoGAOaVfomw3pobN1nfzyajxSUc9\n442JtaV8G/0NDx2DjgDvbZz8/Qf9+i3sywCMuRBSLkIs7J1bn9DzxqpOpbib1utk\nGz46jxaEYnqyWtRQjJ+7wCpXRhyBNIeir26y1lnVyP+noYIm+KP/e+32yR5qNqBi\nX7H/bWhFk9v0VJEL/Tw=\n-----END PRIVATE KEY-----\n",
                "client_email"=> "kanban-storage@tab-kanban.iam.gserviceaccount.com",
                "client_id"=> "107711948736298407896",
                "auth_uri"=> "https://accounts.google.com/o/oauth2/auth",
                "token_uri"=> "https://oauth2.googleapis.com/token",
                "auth_provider_x509_cert_url"=> "https://www.googleapis.com/oauth2/v1/certs",
                "client_x509_cert_url"=> "https://www.googleapis.com/robot/v1/metadata/x509/kanban-storage%40tab-kanban.iam.gserviceaccount.com"              
            ], // optional: Array of data that substitutes the .json file (see below)
            // 'project_id' => env('GOOGLE_CLOUD_PROJECT_ID', 'tab-kanban'), // optional: is included in key file
            'bucket' => env('GOOGLE_CLOUD_STORAGE_BUCKET', 'data-inspecciones'),
            'path_prefix' => env('GOOGLE_CLOUD_STORAGE_PATH_PREFIX', ''), // optional: /default/path/to/apply/in/bucket
            'apiEndpoint' => env('GOOGLE_CLOUD_STORAGE_API_URI', null), // see: Public URLs below
            'visibility' => 'private', // optional: public|private
            'metadata' => ['cacheControl'=> 'public,max-age=86400'], // optional: default metadata
            'throw' => true
        ],

    ],

    /*
    |--------------------------------------------------------------------------
    | Symbolic Links
    |--------------------------------------------------------------------------
    |
    | Here you may configure the symbolic links that will be created when the
    | `storage:link` Artisan command is executed. The array keys should be
    | the locations of the links and the values should be their targets.
    |
    */

    'links' => [
        public_path('storage') => storage_path('app/public'),
    ],

];
