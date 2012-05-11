<!DOCTYPE html>
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

	<meta name="language" content="en" />
    
	<title><?php echo CHtml::encode($this->getPageTitle()); ?></title>

    <?php
    $app = Yii::app();
    $app->clientScript->registerPackage('css');
    $actionId = $this->action->id;
    if('activity' === $actionId)
    {
        $app->clientScript->registerPackage('js');
    }
    ?>
</head>

	<?php echo $content; ?>

</html>
