<?php

namespace application;

class ApplicationError
{
    public $textError;
    public $typeError;
    
    function __construct($textError, $typeError)
    {
        $this->setTextError($textError);
        $this->setTypeError($typeError);
    }

    /**
     * @return mixed
     */
    public function getTextError()
    {
        return $this->textError;
    }

    /**
     * @return mixed
     */
    public function getTypeError()
    {
        return $this->typeError;
    }

    /**
     * @param mixed $textError
     */
    public function setTextError($textError)
    {
        $this->textError = $textError;
    }

    /**
     * @param mixed $typeError
     */
    public function setTypeError($typeError)
    {
        $this->typeError = $typeError;
    }
}
