<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Authentication Language Lines
    |--------------------------------------------------------------------------
    |
    | The following language lines are used during authentication for various
    | messages that we need to display to the user. You are free to modify
    | these language lines according to your application's requirements.
    |
    */

    'failed'                     =>  'As credenciais informadas não foram encontradas',
    'incorret_params'            =>  'Não foi possível completar sua requisição, verifique os parâmetros enviados.',
    'throttle'                   =>  'Muitas tentativas de login. Tente novamente em :seconds segundos.',
    'success_logout'             =>  'Usuário desconectado com sucesso.',
    'failed_logout'              =>  'Houve um poblema ao desconectar usuário.',
    'sended_sms'                 =>  'Um SMS foi enviado para este número com as informações para a recuperação de senha.',
    'not_sended_sms'             =>  'Não foi possível enviar o sms neste momento.',
    'invalid_token'              =>  'o token de acesso da api é inválido',
    'expired_token'              =>  'o token de acesso da api está expirado',
    'not_found_token'            =>  'o token de acesso da api não foi encontrado',
    'expired_cms_access_token'   =>  'o token de acesso obtido no cms está expirado',

    'customer' => [
        'title'                                =>  'Login Cliente',
        'message' => [
            'cannot_access_this_account'       =>  'não ativo para acesso, verifique com o administrador do sistema.',
            'finish_account_register'          =>  'pre-cadastrado. Conclua seu cadastro para continuar.',
        ],
    ]

];
