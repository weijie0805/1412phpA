<?php 

/**
 * 创建数据模型   （test）
 */
namespace app\models;
use yii\db\ActiveRecord;
class Test extends ActiveRecord{
	//声明表名
	public static function tableName(){
		return 'test';
	}
	public function rules(){
		return [
			['title', 'string'] ,
			['content', 'string']
		];
	}
}