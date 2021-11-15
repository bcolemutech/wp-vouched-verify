<?php

class wp_wrapper implements wp_wrapper_interface
{

    public function get_option(string $string)
    {
        return get_option($string);
    }

    /**
     * @throws Exception
     */
    public function wp_remote_post(string $url, array $args): array
    {
        $response = wp_remote_post($url, $args);

        if (is_wp_error($response)) {
            throw new Exception($response->get_error_message());
        }

        return $response;
    }

    public function wp_remote_retrieve_response_code(array $response): int
    {
        return wp_remote_retrieve_response_code($response);
    }

    public function add_user_meta(int $user_id, string $meta_key, $meta_value, bool $unique): bool
    {
        return add_user_meta($user_id, $meta_key, $meta_value, $unique);
    }

    public function get_user_meta(int $user_id, string $meta_key): string
    {
        return get_user_meta($user_id, $meta_key, true);
    }

    public function wp_remote_get(string $url, array $args): array
    {
        return wp_remote_get($url, $args);
    }

    public function query_users_with_meta_query(array $query): array
    {
        $user_query = new WP_User_Query($query);

        return $user_query->get_results();
    }
}