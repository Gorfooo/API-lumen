<?php

$router->group(['middleware' => ['auth']], function () use ($router) {
    $router->group(['prefix' => 'jsons'], function () use ($router) {
        $router->get('empresa/all', 'EmpresaController@allEmpresa');
        $router->get('produto/all', 'ProdutoController@allProduto');
        $router->get('usuario/all', 'UsuarioController@allUsuario');
        $router->get('empresa', 'EmpresaController@paginatedEmpresa');
        $router->get('produto', 'ProdutoController@paginatedProduto');
        $router->get('usuario', 'UsuarioController@paginatedUsuario');
        $router->get('empresa/{id}', 'EmpresaController@findEmpresa');
        $router->get('produto/{id}', 'ProdutoController@findProduto');
        $router->get('usuario/{id}', 'UsuarioController@findUsuario');
    });
    
    $router->group(['prefix' => 'cadastros'], function () use ($router) {
        $router->post('empresa', 'EmpresaController@registerEmpresa');
        $router->post('produto', 'ProdutoController@registerProduto');
        $router->post('usuario', 'UsuarioController@registerUsuario');
    });
});

$router->group(['prefix' => 'consultas'], function () use ($router) {
    $router->get('empresa', 'EmpresaController@showEmpresas');
    $router->get('produto', 'ProdutoController@showProdutos');
    $router->get('usuario', 'UsuarioController@showUsuarios');
});

$router->group(['prefix' => 'api'], function () use ($router) {
    //JWT routes
    $router->post('register', 'AuthController@register');
    $router->post('login', 'AuthController@login');

    //ADMIN login routes
    $router->get('adminLogin', ['as' => 'adminLogin', 'uses' => 'AdminController@showLogin']);
    $router->post('admin', ['as' => 'admin', 'uses' => 'AdminController@login']);
    $router->group(['middleware' => ['login']], function () use ($router) {
        $router->get('adminView', ['as' => 'adminView', 'uses' => 'AdminController@showView']);
    });
    $router->get('adminLogout', ['as' => 'adminLogout', 'uses' => 'AdminController@logout']);

    //ADMIN actions routes
    $router->post('revoke_token', ['as' => 'revoke_token', 'uses' => 'AdminController@revokeToken']);
    $router->post('remove_token', ['as' => 'remove_token', 'uses' => 'AdminController@removeToken']);
});