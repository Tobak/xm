<?php

if (!function_exists('vite_asset')) {
    function vite_asset($path)
    {
        static $manifest = null;

        if (app()->isLocal()) {
            return "build/{$path}";
        }

        if ($manifest === null) {
            $manifestPath = public_path('build/manifest.json');
            $manifest = file_exists($manifestPath) ? json_decode(file_get_contents($manifestPath), true) : [];
        }

        $key = "assets/{$path}";
        return array_key_exists($key, $manifest) ? "/build/{$manifest[$key]['file']}" : $path;
    }
}
