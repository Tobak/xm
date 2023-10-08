<?php

if (!function_exists('vite_asset')) {
    function vite_asset($path)
    {
        $manifestPath = public_path('build/manifest.json');
        $manifest = file_exists($manifestPath) ? json_decode(file_get_contents($manifestPath), true) : [];

        $key = "resources/{$path}";
        return array_key_exists($key, $manifest) ? url("/build/{$manifest[$key]['file']}") : url($key);
    }
}
