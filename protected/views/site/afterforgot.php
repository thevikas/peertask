<div class="twelve columns">
    <!-- left column -->


      <ul class="breadcrumbs">
        <li><span>Home</span></li>
        <li><span>Forgot Password</span></li>
      </ul>

      <h2 class="h2-green">Forgot Password</h2>

      <hr>
      <br class="clear">

      <?php
if(isset($_GET['withcss']))
{
    Yii::app()->clientScript->registerCssFile(Yii::app()->request->baseUrl . '/css/style.css');
    Yii::app()->clientScript->registerCssFile(Yii::app()->request->baseUrl . '/css/form.css');
    Yii::app()->clientScript->registerCssFile(Yii::app()->request->baseUrl . '/css/layhome.css');
    $getops .= '&withcss=1';
}
?><p>
	<strong>Your login details have been sent to your mailbox.</strong>
</p>

    </div>
    <!-- end left column -->