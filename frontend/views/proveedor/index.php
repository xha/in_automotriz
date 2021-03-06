<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel frontend\models\ProveedorSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Proveedores';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="proveedor-index">

    
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Crear Proveedor', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'rowOptions' => function ($model, $index, $widget, $grid){
            if($model->Activo == 0) return ['style' => 'background-color: #FADCAC'];
        },
        'columns' => [
            'CodProv',
            'Descrip',
            //'TipoPrv',
            //'TipoID3',
            //'TipoID',
            'ID3',
            // 'DescOrder',
            // 'Clase',
            // 'Activo',
            // 'Represent',
            'Direc1',
            // 'Direc2',
            // 'Pais',
            // 'Estado',
            // 'Ciudad',
            // 'Municipio',
            // 'ZipCode',
            'Telef',
            [
                'filter' =>[frontend\models\Proveedor::ESTATUS_ACTIVE=>'SI', frontend\models\Proveedor::ESTATUS_INACTIVE=>'NO'],
                'header'=>'Activo',
                'attribute'=>'Activo',
                'value'=>'activo',
            ],
            // 'Movil',
            // 'Fax',
            // 'Email:email',
            // 'FechaE',
            // 'EsReten',
            // 'RetenISLR',
            // 'DiasCred',
            // 'Observa',
            // 'EsMoneda',
            // 'Saldo',
            // 'MontoMax',
            // 'PagosA',
            // 'PromPago',
            // 'RetenIVA',
            // 'FechaUC',
            // 'MontoUC',
            // 'NumeroUC',
            // 'FechaUP',
            // 'MontoUP',
            // 'NumeroUP',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
