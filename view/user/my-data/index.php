<?php
    header('Content-Type: application/json');


    require_once ('controller/user.php');
    require_once ('controller/friend.php');
    require_once ('controller/newsletter.php');
    require_once ('controller/project.php');

    $userToken = $main -> getToken();

    // ************************************************************************************************************************************************
    
    // Blocked user part
    $blockedUsers = $user -> getBlockedUser($userToken);
    $blockedUsersArray = [];
    foreach ($blockedUsers['content'] as $blocked) {
        $array = 
            [
                'username' => $utils -> getData('imp_user', 'username', 'public_token', $blocked['blocked_user_token'] ), 
                'profil_link' => 'https://improove.tk/member/'.$utils -> getData('imp_user', 'username', 'public_token', $blocked['blocked_user_token'] ),
            ];
        array_push($blockedUsersArray, $array);
    }

    // Follower user part
    $followers = $friend -> getFollowers($userToken);
    $followerUsersArray = [];
    foreach ($followers as $fol) {
        $array = 
            [
                'username' => $utils -> getData('imp_user', 'username', 'public_token', $fol['follower'] ), 
                'profil_link' => 'https://improove.tk/member/'.$utils -> getData('imp_user', 'username', 'public_token', $fol['follower'] ),
            ];
        array_push($followerUsersArray, $array);
    }
    
    // Following user part
    $followings = $friend -> getFollowings($userToken);
    $followingUsersArray = [];
    foreach ($followings as $fol) {
        $array = 
            [
                'username' => $utils -> getData('imp_user', 'username', 'public_token', $fol['following'] ), 
                'profil_link' => 'https://improove.tk/member/'.$utils -> getData('imp_user', 'username', 'public_token', $fol['following'] ),
            ];
        array_push($followingUsersArray, $array);
    }


    // ************************************************************************************************************************************************

    $getUserProjects = $project -> getUserProject( $userToken );
    $projectListArray = [];
    foreach($getUserProjects['content'] as $project) {
        $projectToken = $project['project_token'];
        $array = 
            [
                'identity' => 
                    [
                        'public_token' => $projectToken, 
                        'name' => $utils -> getData('pr_project', 'name', 'public_token', $projectToken ), 
                        'description' => $utils -> getData('pr_project', 'description', 'public_token', $projectToken ), 
                        'date_begin' => $utils -> getData('pr_project', 'date_begin', 'public_token', $projectToken ), 
                        'founder_token' => $utils -> getData('pr_project', 'founder_token', 'public_token', $projectToken ), 
                        'project_link' => 'https://improove.tk/app/project/'.$projectToken,
                    ],
            ];
        array_push($projectListArray, $array);
    }

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
                    'bio' => $utils -> getData('imp_user', 'bio', 'public_token', $userToken ), 
                    'language' => $utils -> getData('imp_user', 'lang', 'public_token', $userToken ), 
                    'date_join' => $utils -> getData('imp_user', 'date_join', 'public_token', $userToken ), 
                    'date_last_join' => $utils -> getData('imp_user', 'date_last_join', 'public_token', $userToken ), 
                    'newsletter' => $newsletter -> isSubscribe($utils -> getData('imp_user', 'mail', 'public_token', $userToken ) == true) ? false : true,

                    'blocked_user' => $blockedUsersArray ,
                    
                    'followers' => $followerUsersArray,

                    'followings' => $followingUsersArray,
                        
                ],

            'licences' => [],

            'projects' => $projectListArray,

        ];
    echo json_encode($data);