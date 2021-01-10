<?php

/**
 * Helpers ref.: https://dev.to/kingsconsult/how-to-create-laravel-8-helpers-function-global-function-d8n
 * Ao adicionar funções rodar sempre composer dump-autoload
 * 
 * Adicionar o helper em composer.json em autoload files
 */
// composer dump-autoload


# FUnção para limpar aributos com prefixo
function resetAttributes(&$localThis, $prefix) 
{
    # Use column prefix xxx_ | Exe: "end_", "cli_"
    # All attributes with "end_XXXXXX" is set null ($this->end_XXXXXX = null)
    foreach(array_keys((array)$localThis) as $obj) {
        if(!is_array($prefix)) {
            $prefix = [$prefix];
        }

        foreach($prefix as $pre)
        {
            if(strpos($obj, $pre) !== false) { 
                $localThis->$obj = null;
            }
        }
    }
}

function numberOnly($n)
{
    return preg_replace("/[^0-9]/", "",$n);
}