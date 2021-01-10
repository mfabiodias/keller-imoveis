<?php

/**
 * Helpers ref.: https://dev.to/kingsconsult/how-to-create-laravel-8-helpers-function-global-function-d8n
 * Ao adicionar funções rodar sempre composer dump-autoload
 * 
 * Adicionar o helper em composer.json em autoload files
 */
// composer dump-autoload


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

function numberOnly($n)
{
    return preg_replace("/[^0-9]/", "",$n);
}