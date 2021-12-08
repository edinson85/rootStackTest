<?php

declare(strict_types=1);

namespace App\Service\Categoria;

use App\Entity\Categoria;
use App\Exception\Categoria\CategoriaAlreadyExistException;
use App\Repository\CategoriaRepository;
use App\Service\Utiles\UtilesScraper;
use Throwable;

class CargarCategoriasService
{
    private CategoriaRepository $categoriaRepository;    

    public function __construct(
        CategoriaRepository $categoriaRepository
    ) {
        $this->categoriaRepository = $categoriaRepository;        
    }

    public function cargarDatos(): array
    {                
        try{   
            // inicia la transacción para evitar inconsistencias al momento de agregar elementos a la base de datos
            $this->categoriaRepository->getEntityManager()->beginTransaction();
                        
            $respuesta = [];
            $categoriasExistes = [];
            $respuesta['resultado'] = true;
            $respuesta['mensaje'] = "Datos Cargados exitosamente";       
            
            
            $dom = UtilesScraper::curlWeb(UtilesScraper::URL_PRINCIPAL);
            $todosDivs = $dom->getElementsByTagName( 'div' );
            $divCategorias = UtilesScraper::atributoValor($todosDivs,'class','ma-CategoriesCategory');                        

            foreach($divCategorias as $divCategoria){
                // bloque para cargar categorias

                $categorias = UtilesScraper::atributoValor($divCategoria['obj']->getElementsByTagName( 'div' ),'class','ma-MainCategory');                                
                foreach($categorias as $categoria){
                    $categoriaPadre = $this->crearCategoria($categoria);
                    if(is_null($categoriaPadre)){                    
                        continue;
                    }                                  
                       
                    $subCategorias = UtilesScraper::atributoValor($divCategoria['obj']->getElementsByTagName( 'li' ),'class','ma-SharedCrosslinks-size-s ma-SharedCrosslinks-type-neutral');                                                                        
                    foreach($subCategorias as $subCategoria){  
                        $categoriaHija = $this->crearSubCategoria($categoriaPadre,$subCategoria);                                           
                    }                    
                }                
            }

            $this->categoriaRepository->getEntityManager()->commit();

            return $respuesta;
            
            
            
        }catch(\Throwable $ex){            
            $this->categoriaRepository->getEntityManager()->rollback();            
            $respuesta['resultado'] = false;
            $respuesta['mensaje'] = $ex->getMessage() ;                 
            return $respuesta;
        }  
    }
    private function crearCategoria($categoria){

        $exiteCategoria = $this->categoriaRepository->findOneByNombre($categoria['valor']);                                        
        if(!is_null($exiteCategoria)){
            $categoriasExistes[] = $categoria['valor'];
            return null;
        }
        $datosInsert=[];
        $datosInsert ['nombre'] = $categoria['valor'];
                                                
        if(array_key_exists('obj',$categoria)){                        
            $enlaces = $categoria['obj']->getElementsByTagName('a');
            $infoEnlaces = UtilesScraper::atributo($enlaces,'data-test-maincategory-namelink');
            
            $infoEnlaces = UtilesScraper::atributo($enlaces,'href');
            if(is_array($infoEnlaces)){
                $datosInsert ['path'] = $infoEnlaces['valor'];                            
            }
        }
        $categoriaPadre = null;
        if(count($datosInsert) == 2){
            $categoriaPadre = new Categoria($datosInsert['nombre'],$datosInsert['path']);
            $this->categoriaRepository->save($categoriaPadre);                    
        }
        return $categoriaPadre;
        
    }
    private function crearSubCategoria($categoriaPadre,$subCategoria){

        $datosInsert=[];
        if(array_key_exists('obj',$subCategoria)){                        
            $enlaces = $subCategoria['obj']->getElementsByTagName('a');
            $infoEnlaces = UtilesScraper::atributo($enlaces,'title');
            if(is_array($infoEnlaces)){
                $datosInsert['title'] = $infoEnlaces['valor'];
            }    
            $infoEnlaces = UtilesScraper::atributo($enlaces,'href');
            if(is_array($infoEnlaces)){
                $datosInsert['path'] = $infoEnlaces['valor'];                            
            }
        }
        $categoriaNueva = null;
        if(count($datosInsert) == 2){ 
            $exiteCategoria = $this->categoriaRepository->findOneByNombre($datosInsert ['title']);                                        
            if(!is_null($exiteCategoria)){
                return null;
            }                           
            $categoriaNueva = new Categoria($datosInsert ['title'],$datosInsert ['path']);
            $categoriaNueva->setPadre($categoriaPadre);
            $this->categoriaRepository->save($categoriaNueva);                            
        } 
        return $categoriaNueva;
    }
}
