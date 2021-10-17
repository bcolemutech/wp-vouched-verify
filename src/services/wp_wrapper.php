<?php

class wp_wrapper implements wp_wrapper_interface
{

    public function get_option(string $string)
    {
        return get_option($string);
    }

    public function wp_remote_post(string $url, array $args): array
    {
        return wp_remote_post($url, $args);
    }

    public function wp_remote_retrieve_response_code(array $response): int
    {
        return wp_remote_retrieve_response_code($response);
    }

    public function wp_remote_retrieve_body(array $response): string
    {
        return wp_remote_retrieve_body($response);
    }

    public function add_user_meta(int $user_id, string $meta_key, $meta_value, bool $unique): bool
    {
        return add_user_meta($user_id, $meta_key, $meta_value, $unique);
    }

    public function get_user_meta(int $user_id, string $meta_key): mixed
    {
        return get_user_meta($user_id, $meta_key, true);
    }
}