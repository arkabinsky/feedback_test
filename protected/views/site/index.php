<?php
$this->pageTitle = Yii::app()->name;
?>

<h1>Обратная связь</h1>

<?php if (Yii::app()->user->hasFlash('success')) { ?>
    <div class="flash-success">
        <?php echo Yii::app()->user->getFlash('success'); ?>
    </div>
<?php } elseif (Yii::app()->user->hasFlash('error')) { ?>
    <div class="flash-error">
        <?php echo Yii::app()->user->getFlash('error'); ?>
    </div>
<?php } else { ?>
    <div class="form">
        <?php
        $form = $this->beginWidget('CActiveForm', array(
            'id' => 'feedback-form',
            'enableClientValidation' => true,
            'clientOptions' => array(
                'validateOnSubmit' => true,
            ),
        ));
        ?>
        <p class="note">Поля с <span class="required">*</span> обязательны для заполнения.</p>
            <?php echo $form->errorSummary($model); ?>
        <div class="row">
            <?php echo $form->labelEx($model, 'name'); ?>
            <?php echo $form->textField($model, 'name'); ?>
            <?php echo $form->error($model, 'name'); ?>
        </div>
        <div class="row">
            <?php echo $form->labelEx($model, 'email'); ?>
            <?php echo $form->textField($model, 'email'); ?>
            <?php echo $form->error($model, 'email'); ?>
        </div>
        <div class="row">
            <?php echo $form->labelEx($model, 'message'); ?>
            <?php echo $form->textArea($model, 'message', array('rows' => 6, 'cols' => 50)); ?>
            <?php echo $form->error($model, 'message'); ?>
        </div>
            <?php if (CCaptcha::checkRequirements()) { ?>
                <div class="row">
                    <?php echo $form->labelEx($model, 'verifyCode'); ?>
                <div>
                    <?php $this->widget('CCaptcha'); ?>
                    <?php echo $form->textField($model, 'verifyCode'); ?>
                </div>
                <div class="hint">
                    <?php echo $form->error($model, 'verifyCode'); ?>
                </div>
            <?php } ?>
        <div class="row buttons">
            <?php echo CHtml::submitButton('Отправить'); ?>
        </div>
    <?php $this->endWidget(); ?>
    </div><!-- form -->
<?php } ?>
