<?php
/* @var $this ApersonController */
/* @var $model Person */

$this->breadcrumbs=array(
	'People'=>array('index'),
	$model->id_person=>array('view','id'=>$model->id_person),
	'Update',
);

$this->menu=array(
	array('label'=>'List Person', 'url'=>array('index')),
	array('label'=>'Create Person', 'url'=>array('create')),
	array('label'=>'View Person', 'url'=>array('view', 'id'=>$model->id_person)),
	array('label'=>'Manage Person', 'url'=>array('admin')),
);
?>

<h1>Update Person <?php echo $model->id_person; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>