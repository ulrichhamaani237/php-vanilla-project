<?php

use Illuminate\Support\Facades\Broadcast;

Broadcast::channel('delivery', function ($user) {
    return (int) $user->id === 2;
});