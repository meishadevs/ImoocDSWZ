<?php

//�������ݿ�
require_once('connect.php');

//���ʡ�����ı���
$code = $_GET['citycode'];

//���callbackֵ����������jsonp
$callback = $_GET['callback'];

//��־λ���������ֵ�ǰ��õ���ʡ/��/����ʡ��1���У�2������3��
$flag = $_GET['flag'];

//��ȡʡ������
if($flag == 1) {
	$query= mysqli_query($link, "select * from province order by id");
	
//��ȡ�е����� 
}else if($flag == 2) {
	$query = mysqli_query($link, "select * from city where provincecode = '".$code."' order by id" );
	
//��ȡ��������
}else if($flag == 3) {
	$query = mysqli_query($link, "select * from area where citycode = '".$code."' order by id" );
}

//�������飬��Ż�ȡ������
$sayList = [];

while ($row=mysqli_fetch_array($query)) {
	$sayList[] = array(
		'code'=>$row['code'],
		'name'=>$row['name']
    );
}

//�����ȡ�������ݣ�����һ��json�ַ���
if($sayList) {
	echo $callback.'('.json_encode($sayList).')';
}else{
	echo $callback.'('.'[]'.')';
}

?>