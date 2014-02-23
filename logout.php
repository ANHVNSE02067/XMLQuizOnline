<?php

require 'global.php';
Auth::unsetUserAuthIdentity();
Auth::redirect(SITE_URL);
