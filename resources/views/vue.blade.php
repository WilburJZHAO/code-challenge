<?php

use App\Utilities\Unplash;

$result = Unplash::getImages('London');

dd($result);