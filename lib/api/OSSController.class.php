<?php
// +----------------------------------------------------------------------
// | Constructed by Jokin [ Think & Do & To Be Better ]
// +----------------------------------------------------------------------
// | Copyright (c) 2016-2018 Jokin All rights reserved.
// +----------------------------------------------------------------------
// | Author: Jokin <Jokin@twocola.com>
// +----------------------------------------------------------------------
class OSSController {
  public function del(){
    if( isset($_POST['key']) && !empty($_POST['key']) ){
      $res = fp\sdk\oss::del(C('AK'), C('SK'), C('BKT'), $_POST['key']);
      if($res){
        $err['code'] = "JPCAE02";
        $err['msg'] = $res->message();
        $err['msg_zh'] = "删除失败";
        echo json_encode($err);
      }else{
        $err['code'] = "0";
        $err['msg'] = "success";
        $err['msg_zh'] = "删除成功";
        echo json_encode($err);
      }
    }else{
      $err['code'] = "JPCAE01";
      $err['msg'] = "bad infomation";
      $err['msg_zh'] = "提交的数据不合法";
      echo json_encode($err);
    }
  }
  public function download(){
    if( isset($_GET['url']) && !empty($_GET['url']) ){
      $res = fp\sdk\oss::getDownloadUrl(C('AK'), C('SK'), $_GET['url']);
      $err['code'] = "0";
      $err['msg'] = "success";
      $err['msg_zh'] = "成功获取下载链接";
      $err['data'] = $res;
      echo json_encode($err);
    }else{
      $err['code'] = "JPCAE01";
      $err['msg'] = "bad infomation";
      $err['msg_zh'] = "提交的数据不合法";
      echo json_encode($err);
    }
  }
  public function rename(){
    if( isset($_POST['okey']) && !empty($_POST['key']) ){
      $res = fp\sdk\oss::rename(C('AK'), C('SK'), C('BKT'), $_POST['okey'], $_POST['key'], true);
      if ($res) {
        $err['code'] = "0";
        $err['msg'] = "success";
        $err['msg_zh'] = "重命名成功";
        $err['data'] = $res;
        echo json_encode($err);
      }else{
        $err['code'] = "-1";
        $err['msg'] = "failed";
        $err['msg_zh'] = "重命名失败";
        $err['data'] = $res;
        echo json_encode($err);
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
