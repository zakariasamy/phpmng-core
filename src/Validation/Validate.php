<?php

namespace Phpmng\Validation;

use Phpmng\URL\URL;
use Phpmng\Http\Request;
use Phpmng\Session\Session;
use Rakit\Validation\Validator;
use Phpmng\Validation\Rules\UniqueRule;

class Validate
{

    /**
     * Validation function
     * 
     * @param array $rules
     * @param bool $json : choose return errors as json or not
     * 
     * @return mixed
     */
    public static function validate(array $rules, $json)
    {

        $validator = new Validator;

        $validator->addValidator('unique', new UniqueRule()); // Add unique rule
        
        // make it
        $validation = $validator->make($_POST + $_FILES, $rules);

        // then validate
        $validation->validate();

        if ($validation->fails()) {
            // handling errors
            $errors = $validation->errors();
            if($json)
                return ['errors' => $errors->firstOfAll()];
            else{
                Session::set('errors', $errors); //erros
                Session::set('old', Request::all()); // Get old data
                return URL::redirect(URL::previous());
                
            }
        }
    }
}

