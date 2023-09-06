<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Validation Language Lines
    |--------------------------------------------------------------------------
    |
    | The following language lines contain the default error messages used by
    | the validator class. Some of these rules have multiple versions such
    | as the size rules. Feel free to tweak each of these messages here.
    |
    */

    'accepted' => ':attribute debe ser aceptado.',
    'active_url' => 'La :attribute no es una URL validaL.',
    'after' => ':attribute debe ser una fecha despues :date.',
    'after_or_equal' => ':attribute debe ser una fecha igual o posterior a :date.',
    'alpha' => ':attribute solo debe tener letras.',
    'alpha_dash' => ':attribute solo debe tener letras, numeros, guion bajo.',
    'alpha_num' => ':attribute solo debe tener numeros o letras.',
    'array' => ':attribute debe ser un arreglo.',
    'before' => ':attribute debe ser una fecha anterior a :date.',
    'before_or_equal' => ':attribute debe ser una fecha igual o anterior a :date.',
    'between' => [
        'numeric' => ':attribute debe estar entre :min y :max.',
        'file' => ':attribute debe estar entre :min y :max kilobytes.',
        'string' => ':attribute debe estar entre :min y :max caracteres.',
        'array' => ':attribute debe tener entre :min y :max items.',
    ],
    'boolean' => ':attribute debe ser true o false.',
    'confirmed' => ':attribute de confirmacion no concuerda.',
    'date' => ':attribute no es una fecha valida.',
    'date_equals' => ':attribute debe ser una fecha igual a :date.',
    'date_format' => ':attribute no corresponde al formato :format.',
    'different' => ':attribute y :other deben ser diferentes.',
    'digits' => ':attribute deben ser :digits digitos.',
    'digits_between' => ':attribute debe estar entre :min y :max digitos.',
    'dimensions' => ':attribute tiene dimensiones de imagen invalidas.',
    'distinct' => 'El campo :attribute tiene valores duplicados.',
    'email' => ':attribute debe ser un email valido.',
    'ends_with' => ':attribute debe termina con uno de los siguientes: :values.',
    'exists' => ':attribute seleccionado es invalido.',
    'file' => ':attribute debe ser un archivo.',
    'filled' => 'El campo :attribute debe tener un valor.',
    'gt' => [
        'numeric' => ':attribute debe ser mayor a :value.',
        'file' => ':attribute debe ser mayor :value kilobytes.',
        'string' => ':attribute debe tener mas que :value caracteres.',
        'array' => ':attribute debe tener mas de :value items.',
    ],
    'gte' => [
        'numeric' => ':attribute debe ser mayor o igual :value.',
        'file' => ':attribute debe ser mayor o igual a :value kilobytes.',
        'string' => ':attribute debe tener igual o mayor a :value caracteres.',
        'array' => ':attribute debe tener:value items o mas.',
    ],
    'image' => ':attribute debe ser una imagen.',
    'in' => ':attribute selecionado es invalido.',
    'in_array' => 'El campo :attribute no existe en :other.',
    'integer' => ':attribute debe ser un entero.',
    'ip' => ':attribute debe ser una direccion IP valida.',
    'ipv4' => ':attribute debe ser una direccion IPv4 valida.',
    'ipv6' => ':attribute debe ser una direccion IPv6 valida.',
    'json' => ':attribute debe ser una arreglo JSON valido.',
    'lt' => [
        'numeric' => ':attribute debe ser menor a :value.',
        'file' => ':attribute debe ser menos que :value kilobytes.',
        'string' => ':attribute debe tener menos de :value caracteres.',
        'array' => ':attribute tener menos de :value items.',
    ],
    'lte' => [
        'numeric' => ':attribute debe ser igual o menor a :value.',
        'file' => ':attribute debe ser igual o menor :value kilobytes.',
        'string' => ':attribute debe tener igual o menos de :value caracteres.',
        'array' => ':attribute debe tener no mas de :value items.',
    ],
    'max' => [
        'numeric' => ':attribute debe no ser mayor a :max.',
        'file' => ':attribute no debe ser mayor que :max kilobytes.',
        'string' => ':attribute no debe tener mas que :max caracteres.',
        'array' => ':attribute no debe tener mas que :max items.',
    ],
    'mimes' => ':attribute debe ser un archivo del los tipos: :values.',
    'mimetypes' => ':attribute debe ser un archivo del tipo: :values.',
    'min' => [
        'numeric' => ':attribute debe ser al menos :min.',
        'file' => ':attribute debe tener al menos :min kilobytes.',
        'string' => ':attribute debe tener al menos :min caracteres.',
        'array' => ':attribute debe tener al menos :min items.',
    ],
    'not_in' => ':attribute selecionado es invalido.',
    'not_regex' => 'El formato de :attribute es invalido.',
    'numeric' => ':attribute debe ser un numero.',
    'password' => 'La contraseña es incorrecta.',
    'present' => 'El campo :attribute debe estar presente.',
    'regex' => 'El formato de :attribute es invalido.',
    'required' => 'El campo :attribute es requerido.',
    'required_if' => 'El campo :attribute es requerido cuando :other es :value.',
    'required_unless' => 'El campo :attribute es requerido al menos que :other esta en :values.',
    'required_with' => 'El campo :attribute es requerido cuando :values esta presente.',
    'required_with_all' => 'El campo :attribute es requerido cuando :values estan presentes.',
    'required_without' => 'El campo :attribute es requerido cuando :values no esta presente.',
    'required_without_all' => 'El campo :attribute es requerido cuando ninguno de los :values estan presentes.',
    'same' => ':attribute y :other deben coincidir.',
    'size' => [
        'numeric' => ':attribute debe ser :size.',
        'file' => ':attribute debe tener :size kilobytes.',
        'string' => ':attribute debe tener :size caracteres.',
        'array' => ':attribute debe contener :size items.',
    ],
    'starts_with' => ':attribute debe comenzar con uno de los siguientes: :values.',
    'string' => ':attribute debe ser una cadena.',
    'timezone' => ':attribute debe ser una zona horaria valida.',
    'unique' => ':attribute ya se encuentra tomado.',
    'uploaded' => ':attribute fallo en subir.',
    'url' => 'El formato de :attribute invalido.',
    'uuid' => ':attribute debe ser una UUID valida.',

    /*
    |--------------------------------------------------------------------------
    | Custom Validation Language Lines
    |--------------------------------------------------------------------------
    |
    | Here you may specify custom validation messages for attributes using the
    | convention "attribute.rule" to name the lines. This makes it quick to
    | specify a specific custom language line for a given attribute rule.
    |
    */

    'custom' => [
        'attribute-name' => [
            'rule-name' => 'custom-message',
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Custom Validation Attributes
    |--------------------------------------------------------------------------
    |
    | The following language lines are used to swap our attribute placeholder
    | with something more reader friendly such as "E-Mail Address" instead
    | of "email". This simply helps us make our message more expressive.
    |
    */

    'attributes' => [],

];
