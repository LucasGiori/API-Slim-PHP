<?php

declare(strict_types=1);

namespace Alfa\App;

class ValidateEntity 
{
    protected $classReflectionEntity;
    protected array $requests;
    protected array $paramNotRequired;

    public function __construct($classReflectionEntity, array $requests,array $paramNotRequired)
    {
        $this->classReflectionEntity = $classReflectionEntity;
        $this->requests = $requests;
        $this->paramNotRequired = $paramNotRequired;
    }

    public function validateParamRequiredExists(){
        $properties = $this->classReflectionEntity->getProperties();
        $array = ['message'=>''];
        foreach ($properties as $value) {
            // se in_array propriedade conter dentro do array not required significa que não precisa validar 
            if(!in_array($value->name,$this->paramNotRequired)){
               if(!array_key_exists($value->name, $this->requests)){
                    $array['message'] .= " | parâmetro ".$value->name." é obrigatório!";
               }
               if($this->requests[$value->name] == '' ||  is_null($this->requests[$value->name])){
                    $array['message'] .= " |parâmetro ".$value->name." não pode ser vazio ou nulo!!";
               }                
            }
        }
        return $array;
    }
}