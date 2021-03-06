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
 * @version  1.0.1
 * @author   Jokin
 */
class main {
  public function login(){
    if( isset($_POST['pw']) && !empty($_POST['pw']) ){
      if( md5($_POST['pw']) === C("AUTH_PW") ){
        $token = \fp\safety::authorizate(md5($_POST['pw']));
        setcookie("token", $token, time() + 3600);
        $err['code'] = "0";
        $err['msg'] = "success";
        $err['msg_zh'] = "登录成功";
        echo json_encode($err);
      }else{
        $err['code'] = "JPCAE005";
        $err['msg'] = "bad token.";
        $err['msg_zh'] = "口令不合法或错误";
        exit(json_encode($err));
      }
    }else{
      $err['code'] = "JPCAE01";
      $err['msg'] = "bad infomation";
      $err['msg_zh'] = "提交的数据不合法";
      echo json_encode($err);
    }
  }
  public function logout(){
    setcookie("token", null, time()-1 );
    fp\router::redirect("login");
  }
  public function update(){
    // update
    if( isset($_GET['version']) && !empty($_GET['version']) ){
      // 生成备份
      $zip = new fp\ziper("./_pcbkup.zip", "c");
      if(!$zip){
        $err['code'] = "JPCUD05";
        $err['msg'] = "failed to create backup";
        $err['msg_zh'] = "无法生成备份";
        echo json_encode($err);
        exit();
      }else{
        $zip->addFolder("./lib");
        $zip->addFile("./index.php");
      }
      if($zip->errnum !== 0){
        $err['code'] = "JPCUD05";
        $err['msg'] = "failed to create backup";
        $err['msg_zh'] = "无法生成备份";
        echo json_encode($err);
        exit();
      }
      // 升级
      $basic_url = C("update_basic_url");
      $filename = $_GET['version'].".zip";
      $file = @file_get_contents($basic_url."update/".$filename);
      if( $file ){
        $file_md5 = mb_strtoupper(MD5($file), "utf-8");
        // 验证md5
        $_md5 = file_get_contents($basic_url."release/support_status.md");
        $_md5 = htmlspecialchars_decode($_md5);
        $_md5 = json_decode($_md5, true); // 解析为数组
        $_md5 = $_md5[VERSION]['md5'];
        if( $file_md5 != $_md5 ){
          $err['code'] = "JPCUD07";
          $err['msg'] = "bad file";
          $err['msg_zh'] = "升级文件校验失败";
          echo json_encode($err);
          exit();
        }
        if( !file_put_contents("./_update.zip", $file) ){
          $err['code'] = "JPCUD08";
          $err['msg'] = "failed to put file";
          $err['msg_zh'] = "升级文件放置失败";
          echo json_encode($err);
          exit();
        }
        $zip = new \ZipArchive;
        if( $zip->open("./_update.zip") ){
          if( $zip->extractTo("./") ){
            $zip->close();
            $err['code'] = "0";
            $err['msg'] = "success";
            $err['msg_zh'] = "升级准备就绪";
            echo json_encode($err);
            exit();
          }else{
            $err['code'] = "JPCUD10";
            $err['msg'] = "failed to extract update file";
            $err['msg_zh'] = "展开升级文件包失败";
            echo json_encode($err);
            exit();
          }
        }else{
          $err['code'] = "JPCUD09";
          $err['msg'] = "failed to open update file";
          $err['msg_zh'] = "打开升级文件包失败";
          echo json_encode($err);
          exit();
        }
      }else{
        $err['code'] = "JPCUD06";
        $err['msg'] = "failed to download update file";
        $err['msg_zh'] = "升级文件下载失败";
        echo json_encode($err);
        exit();
      }
    }else{
      $err['code'] = "JPCAE01";
      $err['msg'] = "bad infomation";
      $err['msg_zh'] = "提交的数据不合法";
      echo json_encode($err);
    }
  }
}
?>
