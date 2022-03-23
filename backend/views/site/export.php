<?php
use yii\helpers\Html;
use yii\grid\GridView;

/** @var yii\web\View $this */

$this->title = 'My Yii Application';
?>
<!-- 引入 layui.css -->
<link rel="stylesheet" href="js/layui-v2.6.8/layui/css/layui.css">
<style>

</style>

<div class="site-index">
    <form class="layui-form" autocomplete="off" method="post" action="">
        <input type="hidden" name="ids" value="<?=$ids?>" />
        <div class="layui-form-item">
            <label class="layui-form-label" style="width: 130px;">请选择导出字段</label>
            <div class="layui-input-inline" style="width: 60px;">
                <input type="checkbox" name="fields[]" value="id" title="ID" lay-skin="primary" disabled checked>
            </div>
            <div class="layui-input-inline" style="width: 60px;">
                <input type="checkbox" name="fields[]" value="name" title="名称" lay-skin="primary" checked>
            </div>
            <div class="layui-input-inline" style="width: 60px;">
                <input type="checkbox" name="fields[]" value="code" title="代码" lay-skin="primary" checked>
            </div>
            <div class="layui-input-inline" style="width: 60px;">
                <input type="checkbox" name="fields[]" value="t_status" title="状态" lay-skin="primary" checked>
            </div>
        </div>
        <div class="layui-form-item">
            <button class="layui-btn" lay-submit lay-filter="formsub">确认</button>
        </div>
    </form>
</div>

<!-- 引入 jquery -->
<script src="js/jquery.min.js"></script>
<!-- 引入 layui.js -->
<script src="js/layui-v2.6.8/layui/layui.js"></script>
<script>
    layui.use(['layer', 'form'], function(){
        var layer = layui.layer, form = layui.form;
    });
</script>