<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>__NAME_CN__</title>
    <link rel="shortcut icon" href="./lib/tpl/imgs/logo.png">
    <link rel="stylesheet" href="./lib/tpl/css/bootstrap.min.css">
    <!-- Special Page -->
    <link rel="stylesheet" href="./lib/tpl/css/fontawesome-all.min.css">
    <script src="./lib/tpl/js/jquery-3.2.1.min.js" charset="utf-8"></script>
    <script src="./lib/tpl/js/bootstrap.bundle.min.js" charset="utf-8"></script>
    <script src="./lib/tpl/js/guide.js" charset="utf-8"></script>
  </head>
  <body>

    <div class="container mt-4" id="container">
      {_warning_}
      <div class="row">

        <div class="col-md-12 col-sm-12 mb-2" id="s0">
          <div class="card">
            <div class="card-header bg-dark text-white">
              <span class="font-weight-bold"><img src="./lib/tpl/imgs/logo.png" width="21" height="21" alt="logo">欢迎使用 / Welcome</span>
            </div>
            <div class="card-body table-responsive">
              <p>欢迎使用__NAME__云存储解决方案。<br />
                请仔细阅读下方引导文案，并在下方的卡片中完成配置引导以便__NAME__对接您的存储中心。
              </p>
              <hr />
              <h3># 非首次安装出现此页面</h3>
              <ol>
                <li>没有完善设置，或系统无法读取设置。</li>
                <li>请查看根目录是否存在"config.inc.php"文件。</li>
              </ol>
              <hr />
              <h3># 首次安装程序</h3>
              <ol>
                <!-- <li>请按<a href="http://jokin1999.github.io/PrivacyCloud/manual/start.html" target="_blank">教程（版本信息请参考下方）</a>仔细填写下方信息表。</li> -->
                <li>请按下方分步引导程序进行设置</li>
              </ol>
              <hr />
              <h3># 版本信息</h3>
              <ol>
                <li>主程序版本：<span class="text-danger">__VERSION__</span></li>
              </ol>
              <hr />
              <h3># 许可与声明</h3>
              <ol>
                <li>License：MIT</li>
                <li>官网：<a href="http://jokin1999.github.io/FoxPan/" target="_blank">FoxPan</a></li>
                <li><strong>一旦您完成设置并开始使用，即视为您已阅读并接受免责声明！</strong></li>
              </ol>
            </div>
          </div>
        </div>

        <div class="col-md-12 col-sm-12">
          <div class="card">
            <div class="card-header bg-dark text-white">
              <span class="font-weight-bold">全局设置</span>
            </div>
            <div class="card-body table-responsive">
              <!-- S1 -->
              <div class="" id="s1">
                <h3 class="text-center">免责声明</h3>
                <ol>
                  <li>基础功能免费开源不收取任何资费（请于官网免费下载），由于第三方存储产生的资费请自行负责，与本程序开发组无关;</li>
                  <li>我们不会向开发者递交任何隐私信息，所有联网操作（除文件管理外）均为单向获取;</li>
                  <li>此项目仅为第三方对象存储的管理方案，请自行确保文件托管的安全性，丢失损坏本程序开发组无法负责;</li>
                  <li>本程序页面中提供的第三方信息如流量等仅供参考，具体使用情况以用户自行选择的服务提供商（SP）提供的数据为准;</li>
                  <li><span class='text-danger'>您的AK/SK信息将直接保存于根目录cnofig.inc.php文件中，一旦发生泄露，请立刻前往服务提供商控制台删除这对AK/SK;</span></li>
                  <li>设置过程中，除非您点击最后的提交/保存按钮，程序不会提交任何信息至服务器，即没有即时保存功能；</li>
                  <li><span class='text-danger'>页面中有红色提示版本为alpha或者beta版本时，程序将不保证数据安全性，操作可能造成数据损坏或丢失！</span></li>
                </ol>
                <button type="button" class="btn btn-outline-danger btn-block" onclick="accept_a();">我已阅读上方免责声明并接受，继续设置</button>
              </div>
              <!-- S2 -->
              <div class="d-none" id="s2" name="s2">
                <div class="input-group mb-3">
                  <div class="input-group-prepend">
                    <label class="input-group-text" for="sp">服务提供商 SP</label>
                  </div>
                  <select class="custom-select" id="sp">
                    <option value="null" selected>请选择服务提供商</option>
                    <option value="QINIU">七牛云</option>
                    <option value="null" disabled>待开放</option>
                  </select>
                </div>

                <div class="input-group mb-3">
                  <div class="input-group-prepend">
                    <span class="input-group-text" id="_ak">Access Key</span>
                  </div>
                  <input type="text" class="form-control" id="ak" aria-describedby="_ak" placeholder="请输入Access Key" value="__AK__">
                </div>

                <div class="input-group mb-3">
                  <div class="input-group-prepend">
                    <span class="input-group-text" id="_sk">Secret Key</span>
                  </div>
                  <input type="text" class="form-control" id="sk" aria-describedby="_sk" placeholder="请输入Secret Key" value="__SK__">
                </div>

                <hr />

                <div class="clearfix">
                  <button type="button" class="btn btn-outline-danger float-right" onclick="accept_b();">继续设置</button>
                  <button type="button" class="btn btn-outline-secondary float-right mr-2" onclick="back2a();">上一步</button>
                </div>
              </div>
              <!-- S3 -->
              <div class="d-none" id="s3" name="s3">
                <p class="text-center" id="bkt_p"><i class="fa-spin fab fa-cloudscale"></i> 获取BKT信息中，请稍候。。。</p>
                <div class="alert alert-primary"><strong>提醒！</strong>如“自动获取”的Bucket中没有您想要填写的名称，直接在下方输入框中填写即可。</div>
                <div class="input-group mb-3" id="_bkt_select">
                  <div class="input-group-prepend">
                    <label class="input-group-text" for="bkt_a">自动获取Bucket</label>
                  </div>
                  <select class="custom-select" id="bkt_a" onchange="$('#bkt').val(this.value==='null'?'':this.value);console.log(this.value);">
                    <option value="null" selected>请选择Bucket</option>
                  </select>
                </div>

                <div class="input-group mb-3" id="_bkt_manual">
                  <div class="input-group-prepend">
                    <span class="input-group-text" id="_bkt">Bucket名称 BKT</span>
                  </div>
                  <input type="text" class="form-control" id="bkt" aria-describedby="_bkt" placeholder="请输入Bucket名称" value="__BKT__">
                </div>

                <hr />

                <div class="clearfix">
                  <button type="button" class="btn btn-outline-danger float-right" onclick="accept_c();">继续设置</button>
                  <button type="button" class="btn btn-outline-secondary float-right mr-2" onclick="back2b();">上一步</button>
                </div>
              </div>
              <!-- S4 -->
              <div class="d-none" id="s4" name="s4">
                <p class="text-center" id="domain_p"><i class="fa-spin fab fa-cloudscale"></i> 获取BKT信息中，请稍候。。。</p>

                <div class="alert alert-danger" role="alert">
                  已为您自动填写最新的数据，如无需修改，请参照下方原信息<strong>重新填写</strong>。
                </div>

                <div class="input-group mb-3">
                  <div class="input-group-prepend">
                    <span class="input-group-text" id="_dm">使用域名 DM</span>
                  </div>
                  <input type="text" class="form-control" id="dm" aria-describedby="_dm" placeholder="请输入域名" value="__DM__">
                </div>

                <div class="alert alert-primary" role="alert">
                  DM原设置值（不修改请复制下面的信息至上方输入框）：<br />
                  __DM__
                </div>

                <div class="input-group mb-3">
                  <div class="input-group-prepend">
                    <span class="input-group-text" id="_qd">流量查询域名 QD</span>
                  </div>
                  <input type="text" class="form-control" id="qd" aria-describedby="_qd" placeholder="请输入域名" value="__QD__">
                </div>

                <div class="alert alert-primary" role="alert">
                  QD原设置值（不修改请复制下方的信息至上方输入框）：<br />
                  __QD__
                </div>

                <hr />

                <div class="clearfix">
                  <button type="button" class="btn btn-outline-danger float-right" onclick="accept_d();">继续设置</button>
                  <button type="button" class="btn btn-outline-secondary float-right mr-2" onclick="back2c();">上一步</button>
                </div>
              </div>
              <!-- S5 -->
              <div class="d-none" id="s5" name="s5">

                <div class="alert alert-danger" role="alert">
                  <strong>警告！</strong>下方密码设置后请一定牢记，下次打开需要填写密码才可以进入！留空则取消密码。
                </div>

                <div class="input-group mb-3">
                  <div class="input-group-prepend">
                    <span class="input-group-text" id="_auth_pw">授权密码 AUTH_PW</span>
                  </div>
                  <input type="text" class="form-control" id="auth_pw" aria-describedby="_auth_pw" placeholder="请输入授权密码" value="__AUTH_PW__">
                </div>

                <hr />

                <div class="clearfix">
                  <button type="button" class="btn btn-outline-danger float-right" onclick="accept();" id='btn_accept'>保存设置</button>
                  <button type="button" class="btn btn-outline-secondary float-right mr-2" onclick="back2d();">上一步</button>
                </div>
              </div>

            </div>
          </div>
        </div>

      </div>

    </div>

  </body>
</html>
