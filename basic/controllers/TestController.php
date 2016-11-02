<?php  
//命名空间
namespace app\controllers;
use yii\web\Controller;
use app\models\Test;
use yii\helpers\Url;
use yii\data\Pagination;
/**
 * name  测试(留言板增删改查)
 * 
 */
class TestController extends Controller{
	public $enableCsrfValidation = false; //关闭表单验证
	/**
	 * 执行添加的动作
	 */
	public function actionAddMessage(){
		//增加数据
		$test = new Test;
		$test->validate();
		if($test->hasErrors()){
			echo 'data is error';
			die;
		}
		$request = \YII::$app->request; //全局变量 YII
		$title = $request->post('title');//post传值
		$content = $request->post('content');
		// echo $title;
		// echo $content;die;
		$test->title = $title;
		$test->content = $content;
		$result = $test->save();
		//如果添加成功  查询出来所有的留言 显示出来
		if($result){
			//查询数据
			// $sql = 'select * from test'; //:id 占位符
			// $res = Test::findBySql($sql)->asArray()->all();  //all返回全部数据
			//分页查询
			$arr = Test::find();
			$pages = new Pagination([
				'totalCount'=>$arr->count(),//总记录数
				'pageSize'=>5 //每页显示的条数
			]);
			$str = $arr
			->select('*')
			->from('test')
			->offset($pages->offset)
			->limit($pages->limit)
			->orderBy('id DESC')
			->asArray()
			->all();
			// $countQuery = clone $query;
			// $command = \Yii::$app->db->createCommand('SELECT * FROM test ORDER BY id DESC');
			// $posts = $command->queryAll();
			echo json_encode($str);
		}else{
			echo "no";
		}
	}

	/**
	 * name 执行删除的方法  【动作】
	 * int  要删除的id
	 * out  bool
	 */
	public function actionDel(){
		$request = \YII::$app->request; //全局变量 YII
		$id =  $request->get('id'); //get传值
		$res = Test::deleteAll('id=:id',array(':id'=>$id));
		if($res){
			$this->redirect('?r=hello/show');
		}else{
			echo "delete fals";
		}
	}

	//声明用layout 里面的common.php文件当头文件
	public $layout = 'common';
	/**
	 * @name 修改
	 * @name 先查找出要修改的这一条数据
	 * @int  要修改的这一条数据的 id
	 * @out  array  要修改的这条数据
	 */
	public function actionEdit(){
		$id = $_GET['id']; //获取要修改的id
		// echo $id;
		$res = \Yii::$app->db->createCommand('SELECT * FROM test WHERE id='.$id)->queryOne();
		// print_r($res);die;
		return $this->render('test_edit',['data'=>$res,'id'=>$id]);
	}
	/**
	 * 执行修改的方法  [动作]
	 * 进行修改
	 */
	public function actionUpdate(){
		$id = \yii::$app->request->post('id');
		$title = \yii::$app->request->post('title');
		$content = \yii::$app->request->post('content');
		$res = \Yii::$app->db->createCommand("UPDATE test SET `title`='$title',`content`='$content' WHERE id=".$id)->execute();
		if($res){
			return $this->redirect('?r=hello/show');
		}else{
			echo "update false";
		}
	}

}