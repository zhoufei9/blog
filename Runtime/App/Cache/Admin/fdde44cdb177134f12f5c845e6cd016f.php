<?php if (!defined('THINK_PATH')) exit();?><form action="/index.php/Admin/Public/changePwd" class="col-md-12 form-label-right center-margin" method="post" >
            <div class="pageContainer">
            <div class="form-row">
                <div class="form-label col-md-3">
                    <label for="">
                        旧密码：
                    </label>
                </div>
                <div class="form-input col-md-7">
                    <input type="password" name="oldpassword" value="" placeholder="旧密码" >
                </div>
            </div>

            <div class="form-row">
                <div class="form-label col-md-3">
                    <label for="">
                        新密码：
                    </label>
                </div>
                <div class="form-input col-md-7">
                    <input type="password"  name="password"  value="" placeholder="新密码" >
                </div>
            </div>

            <div class="form-row pad0B">
                <div class="form-label col-md-3">
                    <label for="">
                       确认密码：
                    </label>
                </div>
                <div class="form-input col-md-7">
                    <input type="password" class="" name="repassword" value="" placeholder="确认新密码" >
                </div>
            </div>
           </div>
            <div class="actionBar">
               
                <div class="form-input col-md-10 col-md-offset-3">
                    <button type="button" class="btn medium bg-blue xubox_yes"> <span class="button-content">保存</span></button>
            <button type="button" class="btn medium bg-red mrg15L xubox_close"><span class="button-content">取消</span></button>

                </div>
            </div>
            
           
        </form>