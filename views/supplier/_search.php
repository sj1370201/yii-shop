<?php

use app\constants\SupplierConstant;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\SupplierSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="wrapper">
    <div class="box box-primary">

        <?php $form = ActiveForm::begin([
            'action' => ['index'],
            'method' => 'get',
        ]); ?>
        <div class="box-body row align-items-center">
            <div class=" form-group col-md-3 field-suppliersearch-id  form-inline ">
                <label class="control-label" for="suppliersearch-id">ID</label>
                <select type="" id="suppliersearch-id_symbol" class="form-control col-md-4"
                        name="SupplierSearch[id_symbol]">
                    <?php
                    foreach (SupplierConstant::$idSymbolArr as $k => $v) {
                        ?>
                        <option value="<?= $k ?>" <?= (isset($requestParams['SupplierSearch']['id_symbol']) && SupplierConstant::$idSymbolArr[$requestParams['SupplierSearch']['id_symbol']] == $v) ? "selected" : "" ?> > <?= $v ?></option>'
                        <?php
                    }
                    ?>
                </select>
                <input type="text" id="suppliersearch-id" class="form-control col-md-4" name="SupplierSearch[id]"
                       value="<?= isset($requestParams['SupplierSearch']['id']) ? $requestParams['SupplierSearch']['id'] : "" ?>">
            </div>
            <div class=" form-group col-md-3 form-inline ">
                <?= $form->field($model, 'name')->input('text',['class' => 'form-control col-md-6']) ?>
            </div>
            <div class=" form-group col-md-3 form-inline ">
                <?= $form->field($model, 'code')->input('text', ['class' => 'form-control col-md-6']) ?>
            </div>
            <div class=" form-group col-md-3 form-inline ">
                <?= $form->field($model, 't_status')->dropDownList(SupplierConstant::$tStatusArr) ?>
            </div>
            <div class=" form-group col-md-3 field-suppliersearch-code  form-inline ">
                <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
                <?= Html::button('Export', ['class' => 'btn btn-primary supplier-export']) ?>
            </div>
            <?php ActiveForm::end(); ?>
        </div>
    </div>
