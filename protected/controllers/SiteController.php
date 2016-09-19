<?php

class SiteController extends Controller {

    /**
     * Declares class-based actions.
     */
    public function actions() {
        return array(
            // captcha action renders the CAPTCHA image displayed on the contact page
            'captcha' => array(
                'class' => 'CCaptchaAction',
                'backColor' => 0xFFFFFF,
            ),
        );
    }

    /**
     * Отображает главную страницу
     */
    public function actionIndex() {
        $model = new Feedback();
        if (isset($_POST['Feedback'])) {
            $model->attributes = $_POST['Feedback'];
            if ($model->save()) {
                if ($model->sendEmail()) {
                    Yii::app()->user->setFlash('success', 'Сообщение отправлено. Спасибо за то что связались с нами.');
                } else {
                    Yii::app()->user->setFlash('error', 'Во время отправки сообщения произошла ошибка.');
                }
                
                $this->refresh();
            }
        }
        
        $this->render('index', array('model' => $model));
    }

    /**
     * This is the action to handle external exceptions.
     */
    public function actionError() {
        if ($error = Yii::app()->errorHandler->error) {
            if (Yii::app()->request->isAjaxRequest)
                echo $error['message'];
            else
                $this->render('error', $error);
        }
    }

}
