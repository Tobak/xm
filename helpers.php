<?php

if (!function_exists('vite_asset')) {
    function vite_asset($path)
    {
        static $manifest = null;

        if (app()->isLocal()) {
            return "/build/{$path}";
        }

        if ($manifest === null) {
            $manifestPath = public_path('build/manifest.json');
            $manifest = file_exists($manifestPath) ? json_decode(file_get_contents($manifestPath), true) : [];
        }

        return array_key_exists($path, $manifest) ? "/build/{$manifest[$path]['file']}" : $path;
    }
}
