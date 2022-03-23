<?php

use yii\grid\GridView;

/** @var yii\web\View $this */

$this->title = 'My Yii Application';
?>
<!-- 引入 layui.css -->
<link rel="stylesheet" href="assets/layui-v2.6.8/layui/css/layui.css">
<style>
    .check-label{
        margin-bottom: 0;
    }
    .check-label input{
        margin-right: 10px;
    }
</style>

<div class="site-index">
    <form class="layui-form" autocomplete="off" action="">
        <div class="layui-form-item">
            <div class="layui-inline">
                <label class="layui-form-label">ID</label>
                <div class="layui-input-inline" style="width: 100px;">
                    <input type="text" id="id" name="id" value="<?=$id?>" class="layui-input" />
                </div>
            </div>
            <div class="layui-inline">
                <label class="layui-form-label">名称</label>
                <div class="layui-input-inline" style="width: 100px;">
                    <input type="text" id="name" name="name" value="<?=$name?>" class="layui-input" />
                </div>
            </div>
            <div class="layui-inline">
                <label class="layui-form-label">代码</label>
                <div class="layui-input-inline" style="width: 100px;">
                    <input type="text" id="code" name="code" value="<?=$code?>" class="layui-input" />
                </div>
            </div>
            <div class="layui-inline">
                <label class="layui-form-label">状态</label>
                <div class="layui-input-inline" style="width: 100px;">
                    <select id="t_status" name="t_status" lay-verify="">
                        <option value="">请选择</option>
                        <option value="ok" <?php if($t_status=='ok')echo 'selected';?>>ok</option>
                        <option value="hold" <?php if($t_status=='hold')echo 'selected';?>>hold</option>
                    </select>
                </div>
            </div>
            <div class="layui-inline">
                <button class="layui-btn" lay-submit lay-filter="formsub">立即提交</button>
            </div>
        </div>
    </form>
    <div class="data-table">
        <?php
        try {
            echo GridView::widget([
                'dataProvider' => $dataProvider,
                'columns' => [
                    [
                        'attribute' => '',
                        'format' => ['raw'],
                        'label' => "全/反选",
                        'headerOptions' => ['width' => '50','style'=>'cursor:pointer'],
                        'contentOptions' => ['align'=>'center'],
                        'header'=>"<label class='check-label' title='全选'><input id='all-check' type='checkbox' autocomplete='off' />全选</label>",
                        'value' => function ($data) {
                            return "<input type='checkbox' class='i-checks' value={$data['id']} autocomplete='off' />";
                        },
                    ],
                    'id',
                    'name',
                    'code',
                    't_status',
                    [
                        'attribute' => 'created_at',
                        'format' => ['date', 'Y-m-d H:i:s'],
                    ],
                    [
                        'attribute' => 'updated_at',
                        'format' => ['date', 'Y-m-d H:i:s'],
                    ]
                ]
            ]);
        } catch (\Exception $e) {
            // todo
        }
        ?>
    </div>
</div>

<!-- 引入 jquery -->
<script src="assets/jquery.min.js"></script>
<!-- 引入 layui.js -->
<script src="assets/layui-v2.6.8/layui/layui.js"></script>
<script>
    layui.use(['layer', 'form'], function(){
        var layer = layui.layer, form = layui.form;

        //全选/反选
        $('#all-check').click(function(){
            var isCheckd = $(this).is(':checked');
            var checkList = $(".data-table .i-checks");
            $(checkList).each(function(){
                $(this).prop('checked',isCheckd);
            });
        });

        //表单提交
        form.on('submit(formsub)', function(data){
            var formData = data.field;
            var urlParams = Object.keys(formData).map(function (key) {
                return encodeURIComponent(key) + "=" + encodeURIComponent(formData[key]);
            }).join("&");
            location.href = 'index.php?'+urlParams;
            return false;
        });
    });
</script>