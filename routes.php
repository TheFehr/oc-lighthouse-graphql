<?php
Route::group(config('thefehr.lighthouse::route', []), function (): void {
    $routeName = config('thefehr.lighthouse::route_name', 'graphql');
    $controller = config('thefehr.lighthouse::controller');

    $methods = config('thefehr.lighthouse::route_enable_get', false)
    ? ['GET', 'POST']
    : ['POST'];

    Route::match($methods, $routeName, [
        'as' => 'lighthouse.graphql',
        'uses' => $controller,
    ]);
});

 Route::get('graphql/schema.graphql', function () {
    return TheFehr\Lighthouse\Models\Settings::get('base_schema');
 });
