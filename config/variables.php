<?php

return [

    'nfs' => [
        ['id' => '1','description'=>'NFE'],
        ['id' => '2','description'=>'M4']
    ],

    'payment_forms' => [
        ['id' => '1','description'=>'À VISTA'],
        ['id' => '2','description'=>'BOLETO'],
        ['id' => '3','description'=>'CARTEIRA'],
        ['id' => '4','description'=>'CARTÃO DE DÉBITO'],
        ['id' => '5','description'=>'CARTÃO DE CRÉDITO'],
        ['id' => '6','description'=>'DINHEIRO'],
    ],

    'freights' => [
    	['id' => '1','description'=>'CLIENTE'],
    	['id' => '2','description'=>'LOJA'],
    	['id' => '3','description'=>'PARCIAL'],
    	['id' => '4','description'=>'SEM FRETE'],
    ],

    'outputs' => [
    	['id' => '1','description'=>'MOTO-BOY'],
    	['id' => '2','description'=>'OFFICE-BOY'],
    	['id' => '3','description'=>'VEM BUSCAR'],
    	['id' => '4','description'=>'CORREIOS'],
    	['id' => '5','description'=>'CATEX'],
    	['id' => '6','description'=>'TRANSPORTADORA'],
    	['id' => '7','description'=>'MOTO-TERCERIZADO'],
    ],

    'periods' => [
    	['id' => '1','description'=>'MANHÃ'],
    	['id' => '2','description'=>'TARDE'],
    	['id' => '3','description'=>'URGENTE'],
    	['id' => '4','description'=>'OUTRO'],
    ],

    'request_status' => [
    	['id' => '1','description'=>'EM ANDAMENTO'],
    	['id' => '2','description'=>'AGUARDANDO SEPARAÇÃO'],
    	['id' => '3','description'=>'SEPARANDO'],
    	['id' => '4','description'=>'AGUARDANDO FATURAMENTO'],
        ['id' => '5','description'=>'FATURADO'],
        ['id' => '6','description'=>'PENDENTE'],
        ['id' => '7','description'=>'CANCELADO'],
        ['id' => '8','description'=>'QUITADO'],
        ['id' => '9','description'=>'AGUARDANDO APROVAÇÃO GERENTE'],
        ['id' => '10','description'=>'AGUARDANDO APROVAÇÃO FINANCEIRO'],
    ],

];
