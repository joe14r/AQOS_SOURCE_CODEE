
<?php
Broadcast::channel('order-channel', function ($user) {
    return true; // or auth logic
});
