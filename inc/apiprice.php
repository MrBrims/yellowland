<?php

class Pricelist
{
    public function __construct()
    {
        add_action('rest_api_init', [$this, 'register_json_file_route']);
    }

    public function register_json_file_route()
    {
        function get_json_file()
        {

            // Получаем содержимое файла
            $file_content = file_get_contents(get_template_directory_uri() . '/data/pricelist.json');

            // Парсим JSON и возвращаем его
            $json_data = json_decode($file_content, true);

            return $json_data;
        }
        register_rest_route('my-data/v2', '/pricelist', array(
            'methods' => 'GET',
            'callback' => 'get_json_file',
        ));
    }
}

new Pricelist;
