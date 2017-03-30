<?php
class Auth 
{   
    private static $pdo=null;

    public static function login($details){
        $db=self::getDB();
        $sth=$db->prepare("SELECT * FROM users WHERE email=? AND status=1");
        $sth->execute(array($details['email']));
        $user=$sth->fetch();
        if (!$user) {
            return false;
        }
        if (password_verify($details['password'],$user->password)) {
            $sth=$db->prepare("SELECT * FROM users WHERE id=");
            return $user;
        }
        return false;
    }


    public static function isLogin(){
        if (isset($_SESSION['admin'])) {
            $id=json_decode($_SESSION['admin'])->id;
            $db=self::getDB();
            $sth=$db->prepare("SELECT * FROM users WHERE id=? AND status=1");
            $sth->execute(array($id));
            $user=$sth->fetch();
            return $user;
        }
        return false;
    }

    public static function forceLogin($return=''){
        if (!self::isLogin()) {
            $ret=$return?'?'.$return:'';
            if (Helper::isAjax()) {
                Json::make('0','Not Logged In')->withError(403)->response();
            }else{
                header('Location:/login'.$ret);    
            }
            die;
        }
    }
    public static function getRights(){
        $user=self::isLogin();
        $db=self::getDB();
        $sql="SELECT a.right_id AS id,b.name AS `right`,c.id AS section_id,c.name AS section FROM `user_rights` a LEFT JOIN rights b ON a.right_id=b.id LEFT JOIN sections c ON b.section_id=c.id where a.user_id=?";
        $sth=$db->prepare($sql);
        $sth->execute(array($user->id));
        $rights=$sth->fetchAll();
        return $rights;
    }
    public static function getSections(){
        $user=self::isLogin();
        $db=self::getDB();
        $sql="SELECT c.id AS id,c.name AS section FROM `user_rights` a LEFT JOIN rights b ON a.right_id=b.id LEFT JOIN sections c ON b.section_id=c.id  WHERE a.user_id=? GROUP BY c.id";
        $sth=$db->prepare($sql);
        $sth->execute(array($user->id));
        $sections=$sth->fetchAll();
        return $sections;   
    }
    public static function hasRight(Array $right,$write){
        $rights=Helper::getKey(self::getRights());
        $has=count(array_intersect($right, $rights));
        if (!$has) {
            return false;
        }
        if ($write==1 && !self::canWrite()) {
            return false;
        }
        return true;
    }
    public static function canWrite(){
        return self::isLogin()->can_write;
    }
    private static function getDB(){
        if (!isset(self::$pdo)) {
            $pdo=new PDO(DRIVER.':host='.DB_HOST.';dbname='.ADMIN_DB.';charset=utf8',DB_USER,DB_PASSWORD);
            $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ);
            self::$pdo=$pdo;
        }
        return self::$pdo;
    }
    public static function DB(){
        return self::getDB();
    }
}
?>