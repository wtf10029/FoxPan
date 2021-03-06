<?php
// +----------------------------------------------------------------------
// | Constructed by Jokin [ Think & Do & To Be Better ]
// +----------------------------------------------------------------------
// | Copyright (c) 2016-2018 Jokin All rights reserved.
// +----------------------------------------------------------------------
// | Author: Jokin <Jokin@twocola.com>
// +----------------------------------------------------------------------
/**
 * Main API
 * @version  1.2.0
 * @author Jokin
**/
class install {
  public function getBkt(){
    if( isset($_POST['ak'], $_POST['sk'], $_POST['sp']) ){
      self::sdkNeeded();
      $bkt = fp\sdk\oss::getBucket($_POST['ak'], $_POST['sk']);
      if( !$bkt ){
        $err['code'] = "JPCAE03";
        $err['msg'] = "failed to get Bucket";
        $err['msg_zh'] = "获取Bucket失败";
        exit(json_encode($err));
      }else{
        $err['code'] = "0";
        $err['msg'] = "success";
        $err['msg_zh'] = "成功获取";
        $err['data'] = $bkt;
        exit(json_encode($err));
      }
    }else{
      $err['code'] = "JPCAE01";
      $err['msg'] = "bad infomation";
      $err['msg_zh'] = "提交的数据不合法";
      exit(json_encode($err));
    }
  }
  public function getDomain(){
    self::sdkNeeded();
    if( isset($_POST['ak'], $_POST['sk'], $_POST['bkt'], $_POST['sp']) ){
      $domain = fp\sdk\oss::getDoamin($_POST['ak'], $_POST['sk'], $_POST['bkt']);
      if( method_exists($domain, "message") ){
        $err['code'] = "JPCAE02";
        $err['msg'] = $domain->message();
        $err['msg_zh'] = "获取Domain失败";
        exit(json_encode($err));
      }else{
        $err['code'] = "0";
        $err['msg'] = "success";
        $err['msg_zh'] = "成功获取";
        $err['data'] = $domain;
        exit(json_encode($err));
      }
    }else{
      $err['code'] = "JPCAE01";
      $err['msg'] = "bad infomation";
      $err['msg_zh'] = "提交的数据不合法";
      exit(json_encode($err));
    }
  }
  public function setOptions(){
    if( isset($_POST['ak'], $_POST['sk'], $_POST['bkt'], $_POST['sp'], $_POST['dm'], $_POST['qd'], $_POST['auth_pw']) ){
      if( !is_file("./config.inc.php") ){
        $err['code'] = "JPCAD03";
        $err['msg'] = "confinguration file lost";
        $err['msg_zh'] = "设置文件丢失";
        exit(json_encode($err));
      }
      $config = include "./config.inc.php";
      $config["SP"] = $_POST['sp'];
      $config["AK"] = $_POST['ak'];
      $config["SK"] = $_POST['sk'];
      $config["BKT"] = $_POST['bkt'];
      $config["DM"] = $_POST['dm'];
      $config["QD"] = $_POST['qd'];
      $config["AUTH_PW"] = ($_POST['auth_pw'] === '') ? C('AUTH_PW') : md5($_POST['auth_pw']);
      $linefeed = PHP_EOL;
      $content = "<?php{$linefeed}return ".var_export($config,true).";";
      $res = file_put_contents("./config.inc.php", $content);
      if( $res ){
        $err['code'] = "0";
        $err['msg'] = "success";
        $err['msg_zh'] = "设置成功";
        exit(json_encode($err));
      }else{
        $err['code'] = "JPCAD04";
        $err['msg'] = "failed to write confinguration file";
        $err['msg_zh'] = "设置文件无法写入";
        exit(json_encode($err));
      }
    }else{
      $err['code'] = "JPCAE01";
      $err['msg'] = "bad infomation";
      $err['msg_zh'] = "提交的数据不合法";
      exit(json_encode($err));
    }
  }
  private static function sdkNeeded(){
    if( class_exists('\fp\sdk\oss') ){
      return ;
    }
    $path = './lib/sdk/'.strtolower($_POST['sp']).'.class.php';
    if( is_file($path) ){
      include_once $path;
      fp\sdk\oss::init();
    }else{
      $err['code'] = "JPCAE07";
      $err['msg'] = "bad env";
      $err['msg_zh'] = "程序运行时出错";
      exit(json_encode($err));
    }
  }
}
?>
