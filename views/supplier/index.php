<?php

use app\models\Supplier;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\SupplierSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Suppliers';
$this->params['breadcrumbs'][] = $this->title;
$this->registerJsFile(
    '@web/js/supplier.js',
    ['depends' => [\yii\web\JqueryAsset::class], 'position' => $this::POS_END]
);

?>
<div class="supplier-index">
    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Supplier', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php echo $this->render('_search', ['model' => $searchModel, 'dataProvider' => $dataProvider, 'requestParams' => $requestParams]); ?>
    <p class="bg-light">
        <a style="display:none" id="SelectedSearch" href="javascript:void(0)"> Select all conversations that this
            search </a>
    </p>
    <p class="bg-light">
        <a style="display:none" id="SelectedClear" href="javascript:void(0)"> clear Selection </a>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
//        'filterModel' => $searchModel,
        'columns' => [
            [
                'class' => 'yii\grid\CheckboxColumn',
                'checkboxOptions' =>
                    function ($model) {
                        return ['value' => $model->id, 'class' => 'checkbox-row', 'id' => 'checkbox'];
                    },
                'cssClass' => 'fake'
            ],
            'id',
            'name',
            'code',
            't_status',
            [
                'class' => ActionColumn::className(),
                'urlCreator' => function ($action, Supplier $model, $key, $index, $column) {
                    return Url::toRoute([$action, 'id' => $model->id]);
                }
            ],
        ],
    ]); ?>
</div>
