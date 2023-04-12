<?php
/**
 * Register Theme Instance with RPC API
 *
 * @package RemPublicamCapessere
 * @version 2.0.0
 * @since 2.0.0
 */

/**
 * Register Theme Instance with RPC API
 */
function registerAPI() {
    $key = bin2hex(random_bytes(32));
    return $key;
}
