<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2022/3/23
 * Time: 14:31
 */

namespace common\models;

use Yii;
use yii\data\ActiveDataProvider;

class Supplier extends BaseModel
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%supplier}}';
    }

    public function rules()
    {
        return [
            [['id'], 'integer'],
            [['name','code','t_status'], 'string'],
        ];
    }

    public function attributeLabels(){
        return [
            'id' => 'ID',
            'name' => '名称',
            'code' => '代码',
            't_status' => '状态',
            'created_at' => '创建时间',
            'updated_at' => '更新时间',
        ];
    }

    //根据搜索条件搜索
    public function search($params) {
        $query = self::find();
        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'pagination' => [
                'pagesize' => 10
            ],
        ]);
        $this->load($params,'');
        if(!$this->validate()) return $dataProvider;

        $query->andFilterWhere(['id' => $this->id]);
        $query->andFilterWhere(['like', 'name', $this->name]);
        $query->andFilterWhere(['like', 'code', $this->code]);
        $query->andFilterWhere(['t_status' => $this->t_status]);

        return $dataProvider;
    }
}