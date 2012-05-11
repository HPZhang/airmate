<?php

/**
 *
 */
class SiteController extends CController
{
    /**
     * @return array
     */
    public function actions()
	{
		return array(
			// captcha action renders the CAPTCHA image displayed on the contact page
			'captcha'=>array(
				'class'=>'CCaptchaAction',
				'backColor'=>0xFFFFFF,
			),
			// page action renders "static" pages stored under 'protected/views/site/pages'
			// They can be accessed via: index.php?r=site/page&view=FileName
			'page'=>array(
				'class'=>'CViewAction',
			),
		);
	}

	/**
	 * This is the default 'index' action that is invoked
	 * when an action is not explicitly requested by users.
	 */
	public function actionIndex()
	{
		$pageTitle = "艾美特电器(深圳)有限公司 -- 52天1度电";
        $this->setPageTitle($pageTitle);
		$this->render('index');
	}

    /**
     */
    public function actionActivity()
    {
        $pageTitle = "艾美特电器(深圳)有限公司 -- 低碳风 行天下抽奖活动";
        $this->setPageTitle($pageTitle);
        $this->render('activity');
    }

    /**
     */
    public function actionDetail()
    {
        $pageTitle = "艾美特电器(深圳)有限公司 -- 低碳风 行天下抽奖活动";
        $this->setPageTitle($pageTitle);
        $this->render('detail');
    }

    /**
     */
    public function actionLotteryDraw()
    {
        $app = Yii::app();
        $request = $app->request;
        if(!$request->isAjaxRequest)
        {
            $url = $this->createUrl('activity');
            $this->redirect($url);
        }
        if(!$request->isPostRequest)
        {
            /* 不被允许的请求方法 */
            $result = array('state' => 405);
            echo json_encode($result);
            $app->end();
        }
        $customer = new Customer();
        $customer->attributes = $_POST['Customer'];
        $attributes = array('name', 'num_phone', 'num_card', 'num_product', 'num_flow', 'address', 'province', 'city', 'date_add');
        if($customer->validate($attributes))
        {
            // 抽奖
            $params = $app->params;
            $lotteryDraw = new LotteryDraw($customer->num_card, $customer->num_product, $customer->num_flow);
            $lotteryDraw->setNow(time());
            $lotteryDraw->setQuantity($params['quantity']);
            $lotteryDraw->setTimes($params['times']);
            $number = $lotteryDraw->doIt();
            $customer->id_product = $number;
            $customer->save(false);
            if(1 <= $number && 500 >= $number)
            {
                // 返回得奖信息
                $mark = Product::model()->findByPk($number)->mark;
                $result = array('state' => 200, 'mark' => $mark, 'number' => $number);
            }
            else
            {
                // 返回不得奖信息
                $result = array('state' => 200, 'number' => $number);
            }
            echo json_encode($result);
        }
        else
        {
            // 验证失败
            $errors = $customer->getErrors();
            $result = array('state' => 404, 'errors' => $errors);
            echo json_encode($result);
        }
    }

	/**
	 * This is the action to handle external exceptions.
	 */
	public function actionError()
	{
        header("Content-type:text/html;charset=utf-8");
	    if($error = Yii::app()->errorHandler->error)
	    {
	    	if(Yii::app()->request->isAjaxRequest)
	    		echo $error['message'];
	    	else
	        	echo "对不起，您访问的资源不存在！";
	    }
	}

    /**
     * @return array
     */
    public function filters()
    {
        return array(
            array('system.web.widgets.COutputCache +index', 'duration' => 3600 * 24 * 30)
        );
    }
}