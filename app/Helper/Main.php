<?php

if (!function_exists('_fixDirSeparator')) {
    function _fixDirSeparator($path) {
        return str_replace(['\\', '/'], DIRECTORY_SEPARATOR, $path);
    }
}

if(!function_exists('action_table_delete')) {
    function action_table_delete($route,$index = 0) {
        return '<form action="' . $route . '" method="post" id="form_'.$index.'">
        <input name="_method" type="hidden" value="delete">
        <input type="hidden" name="_token" id="csrf-token" value="' . Session::token() . '" />
        <a class="btn btn-outline-danger btn-sm row_deleted" data-bs-toggle="modal" data-id="'.$index.'" data-bs-target="#staticBackdrop">
            <i class="bx bx-trash"></i>
        </a>
        </form>';
    }
}

if (!function_exists('getSettings')) {
    function getSettings($var = null, $default = null,$trans = false)
    {
        $settings = \App\Models\Setting::get()->toArray();
        $data = array_column($settings, 'value', 'key');
        if(is_null($var)) {
            return $data;
        }
        return isset($data[$var]) ? $data[$var] : $default;
    }
}
