<?php

return [

	'allowed_origins' => env('CORS_ALLOWED_ORIGINS', env('SUBDOMAIN_API', '')),

];