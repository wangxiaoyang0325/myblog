<?php 
	return array(
		'database' => array(
			'user'=>'root',
			'password'=>'aa',
			'dbname'=>'php17'
		),
		'app' => array(
			'pagesize'=>2,
			'debug'=>true,	//true表示开发模式。
			'upload_path'=>'./Public/Uploads/',
			'upload_size'=>'123456',
			'upload_type'=>array('image/png','image/gif','image/jpeg'),
			'default_platform' => 'Home',
			'default_controller' => 'Index',
			'default_action' => 'index'
		)
	);

 ?>