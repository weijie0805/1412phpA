<?php 
namespace app\controllers;
use yii\web\Controller;
use app\models\Test;
use yii\data\Pagination;
class HelloController extends Controller{
	public function actionIndex(){
		$request = \YII::$app->request; //全局变量 YII
		$title = $request->post('title');//post传值
		$content = $request->post('content');
		echo $title;
		echo $content;
		//查询数据
		//$sql = 'select * from test where id=:id'; //:id 占位符
		//$results = Test::findBySql($sql,array(':id'=>'1 or 1=1'))->all();  //all返回全部数据 数组里面是对象  静态方法查找
		// $results = Test::find()->where(['like','title','title1'])->asArray()->all();   //>  ['>','id',0]  <= ['between','id',1,2]   like ['like','title','title']
		// print_r($results);
		//把查询结果转化成数组  要加->asArray()
		//批量查询
		// foreach(Test::find()->batch(2) as $tests){
			// print_r($tests);
		// }
		


		// $session = \YII::$app->session; 
		// $session->open();
		// $session->set('user','张三');  //存session
		// $session->remove('user');  //移除session
		// echo $session->get('user'); //取session
		// $session['user'] = "张三";//存session的另一种方法
		// if($session->isActive){
		// 	echo "session is active";
		// }
		// $request = \YII::$app->request; //全局变量 YII
		// echo $request->get('id'); //get传值
		// $request->post('name',123);//post传值
		// if($request->isGet){  //判断请求类型的方法
		// 	echo "this is gey method!";
		// }
		// 
		// echo $request->userIp; //获取用户ip
		// echo "hello world";
		// 
		// 
		// $res = \YII::$app->response;
		// $res->statusCode = '404'; //状态码设置
		// $res->headers->add('pragma','ro-cache'); //add添加
		// $res->headers->set('pragma','max-age=5');//set修改
		// $res->headers->remove('pragma');//remove删除
		// 
		// 跳转
		//$res->headers->add('location','http://www.baidu.com'); //跳转到百度
		//$this->redirect('http://www.baidu.com',302);
		//
		//文件下载
		//$res->headers->add('content-disposition', 'attachment; filename="a.jpg"');
		// $res->sendFile('./robots.txt');
		// 
		// 
		// 
		// 
		// return $this->renderPartial('index');
		// echo "";
	}
	public $layout = 'common';
	public function actionShow(){
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
		//查询数据
		// $sql = 'select * from test'; 
		// $command = \Yii::$app->db->createCommand('SELECT * FROM test ORDER BY id DESC');
		// $results = $command->queryAll();
		// $results = Test::findBySql($sql)->asArray()->all();
		// print_r($results);die;
		return $this->render('index',['data'=>$str,'pages'=>$pages]);
	}
}
