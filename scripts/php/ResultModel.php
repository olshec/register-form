<?php 

namespace application;

include 'ApplicationError.php';

class ResultModel 
{
    public $textMesage;
    public $listApplicationError;
    public $hasError;

    function __construct()
    {
        $this->listApplicationError = [];
    }
    
    public function addError($textError, $typeError) 
    {
        $this->listApplicationError[] = 
            new ApplicationError($textError, $typeError);
    }
    
    /**
     * @return mixed
     */
    public function getHasError()
    {
        return $this->hasError;
    }
    
    /**
     * @return mixed
     */
    public function getTextMesage()
    {
        return $this->textMesage;
    }

    /**
     * @param mixed $textMesage
     */
    public function setTextMessage($textMesage)
    {
        $this->textMesage = $textMesage;
    }

    /**
     * @param mixed $hasError
     */
    public function setHasError($hasError)
    {
        $this->hasError = $hasError;
    }
}

