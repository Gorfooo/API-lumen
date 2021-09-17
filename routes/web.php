<?php

$router->get('/', 'EmpresaController@paginatedEmpresa');

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

$router->group(['prefix' => 'consultas'], function () use ($router) {
    $router->get('empresa', 'EmpresaController@showEmpresas');
    $router->get('produto', 'ProdutoController@showProdutos');
    $router->get('usuario', 'UsuarioController@showUsuarios');
});

$router->group(['prefix' => 'cadastros'], function () use ($router) {
    $router->post('empresa', 'EmpresaController@registerEmpresa');
    $router->post('produto', 'ProdutoController@registerProduto');
    $router->post('usuario', 'UsuarioController@registerUsuario');
});