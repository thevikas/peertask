<?php
/* @var $this ApersonController */
/* @var $model Person */

$this->breadcrumbs=array(
	'People'=>array('index'),
	$model->id_person,
);

$this->menu=array(
	array('label'=>'List Person', 'url'=>array('index')),
	array('label'=>'Create Person', 'url'=>array('create')),
	array('label'=>'Update Person', 'url'=>array('update', 'id'=>$model->id_person)),
	array('label'=>'Delete Person', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id_person),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Person', 'url'=>array('admin')),
);
?>

<h1>View Person #<?php echo $model->id_person; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id_person',
		'created',
		'updated',
		'first_name',
		'last_name',
		'email',
		'dob',
		'gender',
		'source',
	),
)); ?>
