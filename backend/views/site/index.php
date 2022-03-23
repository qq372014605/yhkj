<?php
use yii\helpers\Html;
use yii\grid\GridView;

/** @var yii\web\View $this */

$this->title = 'My Yii Application';
?>
<!-- 引入 layui.css -->
<link rel="stylesheet" href="assets/layui-v2.6.8/layui/css/layui.css">

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
        <?= Html::a('导出全部结果', "javascript:void(0);", ['class' => 'btn btn-success gridview']) ?>
        <?php
        try {
            echo GridView::widget([
                'dataProvider' => $dataProvider,
                'options' => ['class' => 'grid-view','style'=>'overflow:auto', 'id' => 'grid'],
                'columns' => [
                    [
                        'class' => 'yii\grid\CheckboxColumn',
                        'name' => 'id',
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

            $this->registerJs('
            $(".gridview").on("click", function () {
                //注意这里的$("#grid")，要跟我们第一步设定的options id一致
                var ids = $("#grid").yiiGridView("getSelectedRows");
                if(ids.length==0){
                    alert("请选择需要导出的数据");
                }
                location.href = "index.php?r=site/export&ids="+ids.join(",");
            });
            ');
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