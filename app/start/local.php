<?php

function asset_with_ts($asset) {
    return asset($asset) . "?nocache=" . File::lastModified(base_path('public/' . $asset));
}