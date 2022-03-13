<?php
if (!function_exists('chart_url')) {
    /**
     * @param $name
     * @param array $route_params
     * @return string
     */
    function chart_url($name, array $route_params = []): string
    {
        $routeNamePrefix = config('charts.global_route_name_prefix');
        return route("$routeNamePrefix." . $name, $route_params);
    }
}