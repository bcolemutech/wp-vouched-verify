<?php

interface wp_wrapper_interface
{
    public function get_option(string $string);

    public function wp_remote_post(string $url, array $args): WP_Error;

    public function wp_remote_retrieve_response_code(WP_Error $response): int;

    public function wp_remote_retrieve_body(WP_Error $response): string;

    public function add_user_meta(int $user_id, string $meta_key, $meta_value, bool $unique): bool;
}