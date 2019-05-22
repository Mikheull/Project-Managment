<?php

class friend extends db_connect {

    function __construct($connect){
        parent::__construct($connect);
    }



/******************************************************************************/

    /**
     * Verifie une relation
     * 
     * Cherche si l'user A suis l'user B
     *
     * @access public
     * @author Mikhaël Bailly
     * @param string $follower sender
     * @param string $following receiver
     * @return boolean
     */

    function isFollowing($follower, $following) {
        $request = $this -> _db -> query("SELECT * FROM `imp_follow` WHERE (`follower` = '$follower' AND `following` = '$following') OR (`follower` = '$follower' AND `following` = '$following') ");
        $res = $request->fetch();
        
        if($res){
            return true;        
        }
        return false;
    } 


/******************************************************************************/



/**
 * function follow($follower, $following)
 * 
 * Suis un utilisateur
 * @param 1 = Le token de l'utilisateur A
 * @param 2 = Le token de l'utilisateur B
 * @return array
*/
    function follow($follower, $following) {

        $req = $this -> _db -> prepare("INSERT INTO `imp_follow` (`follower`, `following`) VALUES (:follower, :following)");

        $req->bindParam(':follower', $follower);
        $req->bindParam(':following', $following);

        $req->execute();
        $count = $req->rowCount();

        if($count !== 1){
            return (['success' => false, 'message' => ['text' => 'Une erreur est survenue !', 'theme' => 'light', 'timeout' => 2000] ]);
        }
        $notif_content = 
            [
                'sender' => $follower,
                'message' => $follower.' vous suit désormais'
            ];
        $notif_content = json_encode($notif_content);
        $exec = $this -> _db -> exec("INSERT INTO `imp_notification`( `user_public_token`, `type`, `content`) VALUES ('$following', 'follow', '$notif_content') ");
        
        return (['success' => true, 'message' => ['text' => 'Vous avez suivi l utilisateur !', 'theme' => 'light', 'timeout' => 2000] ]);
    } 


 /**
 * function unfollow($follower, $following)
 * 
 * Ne suis plus un utilisateur
 * @param 1 = Le token de l'utilisateur A
 * @param 2 = Le token de l'utilisateur B
 * @return array
*/
    function unfollow($follower, $following) {

        $req = $this -> _db -> prepare("DELETE FROM `imp_follow` WHERE (`follower` = :follower AND `following` = :following) OR (`follower` = :following AND `following` = :follower) AND `status` = '1' ");

        $req->bindParam(':follower', $follower);
        $req->bindParam(':following', $following);

        $req->execute();
        $count = $req->rowCount();

        if($count !== 1){
            return (['success' => false, 'message' => ['text' => 'Une erreur est survenue !', 'theme' => 'light', 'timeout' => 2000] ]);
        }
        return (['success' => true, 'message' => ['text' => 'Vous ne suivez plus l utilisateur !', 'theme' => 'light', 'timeout' => 2000] ]);
    }    


/**
 * function getFollowers($user_token)
 * 
 * Récupère les followers d'un user
 * @param 1 = Le token de l'utilisateur
 * @return array
*/
    function getFollowers($user_token) {
        $request = $this -> _db -> query("SELECT * FROM `imp_follow` WHERE `following` = '$user_token' ");
        return $request->fetchAll();
    }


/**
 * function getFollowings($user_token)
 * 
 * Récupère les followings d'un user
 * @param 1 = Le token de l'utilisateur
 * @return array
*/
    function getFollowings($user_token) {
        $request = $this -> _db -> query("SELECT * FROM `imp_follow` WHERE `follower` = '$user_token' ");
        return $request->fetchAll();
    }


}