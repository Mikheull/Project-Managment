<?php
    $userToken = $main -> getToken();

    header('Content-Type: application/json');

    $data = 
        [ 
            'user_informations' =>
                [ 
                    'identity' => 
                        [
                            'mail' => $utils -> getData('imp_user', 'mail', 'public_token', $userToken ), 
                            'username' => $utils -> getData('imp_user', 'username', 'public_token', $userToken ), 
                            'first_name' => $utils -> getData('imp_user', 'first_name', 'public_token', $userToken ), 
                            'last_name' => $utils -> getData('imp_user', 'last_name', 'public_token', $userToken ), 
                            'public_token' => $userToken, 
                        ],

                    'profil_image_name' => $utils -> getData('imp_user', 'profil_image', 'public_token', $userToken ), 
                    'profil_image_link' => 'https://improove.tk/dist/uploads/u/'.$userToken.'/profil_pic/'.$utils -> getData('imp_user', 'profil_image', 'public_token', $userToken ), 
                    'bio' => $utils -> getData('imp_user', 'bio', 'public_token', $userToken ), 
                    'language' => $utils -> getData('imp_user', 'lang', 'public_token', $userToken ), 
                    'date_join' => $utils -> getData('imp_user', 'date_join', 'public_token', $userToken ), 
                    'date_last_join' => $utils -> getData('imp_user', 'date_last_join', 'public_token', $userToken ), 
                    'newsletter' => false,

                    'blocked_user' => 
                        [
                            'public_token' => 'undefined', 
                        ],
                    
                    'followed_user' => 
                        [
                            'public_token' => 'undefined', 
                        ],
                        
                ],

            'licences' =>
                [ 
                    'token' => 
                        [
                            'date_begin' => $utils -> getData('imp_licence', 'date_begin', 'user_public_token', $userToken ), 
                            'date_end' => $utils -> getData('imp_licence', 'date_end', 'user_public_token', $userToken ), 
                            'renew' => $utils -> getData('imp_licence', 'renew', 'user_public_token', $userToken ), 
                            'enable' => $utils -> getData('imp_licence', 'enable', 'user_public_token', $userToken ), 
                        ],
                ],

            'reset-password' =>
                [ 
                    '1' => 
                        [
                            'token' => 'xxx', 
                            'date' => 'xxx', 
                            'enable' => true, 
                        ],
                ],


            'projects' =>
                [ 
                    
                ],

        ];
    echo json_encode($data);


?>
