<?php

/**
 * Helpers ref.: https://dev.to/kingsconsult/how-to-create-laravel-8-helpers-function-global-function-d8n
 * Ao adicionar funções rodar sempre composer dump-autoload
 * 
 * Adicionar o helper em composer.json em autoload files
 */
// composer dump-autoload

use Claudsonm\CepPromise\CepPromise;

function cepPromise(&$lthis)
{
    cleanAddress($lthis);

    try {
        $cep = CepPromise::fetch($lthis->end_cep);
        
        if($cep->zipCode) {
            $lthis->end_cep    = $cep->zipCode;
            $lthis->end_rua    = $cep->street;
            $lthis->end_bairro = $cep->district;
            $lthis->end_cidade = $cep->city;
            $lthis->end_estado = $cep->state;
        }
    } catch (\Exception $e) {
        $lthis->addError('end_cep', 'CEP não encontrado!');
    }
    
    $lthis->dispatchBrowserEvent('closeLoader');
}

function cleanAddress(&$lthis) 
{
    $lthis->end_rua         = ""; 
    $lthis->end_numero      = ""; 
    $lthis->end_complemento = "";
    $lthis->end_bairro      = ""; 
    $lthis->end_cidade      = ""; 
    $lthis->end_estado      = "";
}


# Função para limpar aributos com prefixo
function resetAttributes(&$_this, $prefix) 
{
    # Use column prefix xxx_ | Exe: "end_", "cli_"
    # All attributes with "end_XXXXXX" is set null ($this->end_XXXXXX = null)
    foreach(array_keys((array)$_this) as $obj) {
        if(!is_array($prefix)) {
            $prefix = [$prefix];
        }

        foreach($prefix as $pre)
        {
            if(strpos($obj, $pre) !== false) { 
                $_this->$obj = null;
            }
        }
    }
}

# Funcão que preenche variáveis da classe
function bindData(&$_this, $prefix, $data)
{
    $varData = [];
    
    # Recupera dados da tabela
    foreach((array)$data as $key => $obj) {
        if(strpos($key, "attributes") !== false) {
            $varData = (array)$obj;
        }
    }
    
    # Realiza bind na variáveis da classe
    foreach ($varData as $key => $val) 
    {
        $attr = $prefix.$key;

        if(property_exists($_this, $attr)) {
            $_this->$attr = $val;
        }
    }
}

function inputError($attr)
{
    $validator = \Validator::make(request()->all(), [
        $attr => 'required'
    ]);
    
    return $validator->validate();
}

function number_only($n)
{
    return preg_replace("/[^0-9]/", "",$n);
}

function my_route($page="")
{
    $uri = trim($_SERVER["REQUEST_URI"], "/");

    return $uri == $page;
}