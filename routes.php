<?php

///** @var \Illuminate\Contracts\Routing\Registrar $router */
//$router = app('router');
//
//$router->group(config('thefehr.lighthouse::route', []), function () use ($router): void {
//    $routeName = config('thefehr.lighthouse::route_name', 'graphql');
//    $controller = config('thefehr.lighthouse::controller');
//
//    $methods = config('thefehr.lighthouse::route_enable_get', false)
//    ? ['GET', 'POST']
//    : ['POST'];
//
//    $router->match($methods, $routeName, [
//        'as' => 'lighthouse.graphql',
//        'uses' => $controller,
//    ]);
//});

Route::group(config('thefehr.lighthouse::route', []), function () : void {
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


 Route::get('graphql/schema.graphql', function(){

     $schemesBody = '';
     $schemes = \TheFehr\Lighthouse\Models\Schema::published()->get();
     foreach ($schemes as $schema) {
         $schemesBody .= $schema->schema;
     }

     return $schemesBody;

 });
