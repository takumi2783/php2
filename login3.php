<?php
//Auth classの宣言：ログインのセッションに関するクラス
class Auth
{
private $authname;
private $sessname;
public function _construct()
    {

    }
public function set_authname($name){
  $this->authname=$name;
}
public function get_authname(){
return $this->authname;
}
public function set_sessname($name){
  $this->sessname=$name;
}
public function get_sessname(){
return $this->sessname;
}
public function start()
{
//開始しているときは何もしない
  if(session_status()===PHP_SESSION_ACTIVE){
  return;
  }
  if($this->sessname!=""){
    session_name($this->sessname);
  }
  //セッション開始
  session_start();
}
//認証情報の確認
public function check(){
if (!empty($SESSION[$this->get_authname()])&&$_SESSION[$this->get_authname()]['id']>=1) {
  return true;
  }
}

public function logout(){
$_SESSION=[];
  if(ini_get("session.use_cookies")){
$params=session_get_cookie_params();
setcookie(session_name(),'',time()-42000,$params["path"],$params["domain"],$params["secue"],$params["httponly"]);

  }
session_destroy();
}

}
?>
<?php
$auth=new Auth;
$auth->set_authname(auth_info);
$auth->set_sessname(sess_name);
$auth->start();
if(!empty($_POST['username'])&&!empty($_POST['password'])){
  if($_POST['username']=="t"&&$_POST['password']=="u")
  {
    $_SESSION['id']=1;
    echo "ok <p>";

  }
}
 ?>
 <HTML>
   <head>
     <TITLE> </TITLE>
     <meta charset="utf-8">
     <meta http-equiv="X-UA-Compatible" content="IE=edge">
   </head>
   <body>
     <form method="post" >
       名前：
       <input type=text name="username" >
       <P>
        パスワード
       <input type=text name="password" >
       <p>
       <input type=submit value="submit" >
     </form>

   </body>
   </html>
