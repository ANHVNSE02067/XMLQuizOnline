<?php

require '../global.php';
Auth::unsetStaffAuthIdentity();
Auth::redirect(STAFF_URL);
