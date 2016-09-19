<?php

/**
 * This is the model class for table "feedback".
 *
 * The followings are the available columns in table 'feedback':
 * @property integer $id
 * @property string $name
 * @property string $email
 * @property string $message
 */
class Feedback extends CActiveRecord {
    
    public $verifyCode;

    /**
     * @return string the associated database table name
     */
    public function tableName() {
        return 'feedback';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules() {
        return array(
            array('name, email, message', 'required'),
            array('name, email', 'length', 'max' => 128),
            array('email', 'email'),
            array('id, name, email, message', 'safe', 'on' => 'search'),
            array('verifyCode', 'captcha', 'allowEmpty'=>!CCaptcha::checkRequirements()),
        );
    }

    /**
     * @return array relational rules.
     */
    public function relations() {
        return array(
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels() {
        return array(
            'id' => 'ID',
            'name' => 'Имя',
            'email' => 'Email',
            'message' => 'Сообщение',
            'verifyCode' => 'Код подтверждения'
        );
    }

    public function search() {
        $criteria = new CDbCriteria;

        $criteria->compare('id', $this->id);
        $criteria->compare('name', $this->name, true);
        $criteria->compare('email', $this->email, true);
        $criteria->compare('message', $this->message, true);

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
        ));
    }

    /**
     * Returns the static model of the specified AR class.
     * Please note that you should have this exact method in all your CActiveRecord descendants!
     * @param string $className active record class name.
     * @return Feedback the static model class
     */
    public static function model($className = __CLASS__) {
        return parent::model($className);
    }
    
    /**
     * Отправка email
     * @return boolean
     */
    public function sendEmail() {
        $result = false;
        $name = '=?UTF-8?B?' . base64_encode($this->name) . '?=';
        $subject = '=?UTF-8?B?' . base64_encode("Обратная связь") . '?=';
        $headers = "From: $name <{$this->email}>\r\n" .
                    "Reply-To: {$this->email}\r\n" .
                    "MIME-Version: 1.0\r\n" .
                    "Content-Type: text/plain; charset=UTF-8";

        if (mail(Yii::app()->params['email'], $subject, $this->message, $headers)) {
            $result = true;
        }
        
        return $result;
    }

}
