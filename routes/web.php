<?php

$router->get('/', 'EmpresaController@paginatedEmpresa');

$router->group(['prefix' => 'jsons'], function () use ($router) {
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
    $router->get('empresa', 'UsuarioController@showUsuarios');
});