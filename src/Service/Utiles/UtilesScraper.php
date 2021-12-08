<?php

declare(strict_types=1);

namespace App\Service\Utiles;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;
use DOMDocument;


class UtilesScraper
{
    const URL_PRINCIPAL = 'https://www.milanuncios.com'; 

    public static function curlWeb(string $url,bool $retornoString = false) {

        $curl = curl_init($url); // Inicia sesión cURL
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, TRUE); // Configura cURL para devolver el resultado como cadena
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false); // Configura cURL para que no verifique el peer del certificado dado que nuestra URL utiliza el protocolo HTTPS
        $page = curl_exec($curl); // Establece una sesión cURL y asigna la información a la variable $info        
        curl_close($curl); // Cierra sesión cURL          
        if($retornoString){
            return $page;
        }else{
            $doc = new DOMDocument;
            libxml_use_internal_errors(true);
            $doc->loadHTML($page);
            return $doc;
        }
    } 
    public static function atributo($objeto,string $key){                        
        $retorno=[];        
        foreach($objeto as $obj){
            if($obj->hasAttribute($key)){
                $valor = $obj->getAttribute($key);                
                $retorno['atributo'] = $obj->nodeValue ;
                $retorno['obj'] = $obj;
                $retorno['valor'] = utf8_decode($valor);                            
                break;
            }
        }                            
        return $retorno;                       
    }
    public static function atributoValor($objeto,string $att,string $valor){                
        $retornoTotal = [];        
        foreach($objeto as $obj){        
            if($obj->getAttribute($att) === $valor ){                
                $retorno=[];
                $valor = $obj->getAttribute($att);                
                $retorno['atributo'] = $valor;
                $retorno['obj'] = $obj;
                $retorno['valor'] = utf8_decode($obj->nodeValue);                    
                $retornoTotal[] =  $retorno;                             
            }
        }     
        return $retornoTotal;                                       
    }
}
