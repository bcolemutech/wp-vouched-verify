<?php

interface wp_wrapper_interface
{
    public function get_option(string $string);

    public function wp_remote_post(string $url, array $args): array;

    public function wp_remote_retrieve_response_code(array $response): int;

    public function wp_remote_retrieve_body(array $response): string;

    public function add_user_meta(int $user_id, string $meta_key, $meta_value, bool $unique): bool;

    public function get_user_meta(int $user_id, string $meta_key): mixed;
}