<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use common\models\Usuario;

$this->registerJsFile('@web/general.js');
$this->registerJsFile('@web/js/taller.js');
$this->registerCssFile('@web/css/general.css');
$id_usuario = Yii::$app->user->identity->id_usuario;
$rol = Yii::$app->user->identity->id_rol;

$this->title = 'Actualizar Taller';
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="taller-form">

    <div class="inicial00" align="center">
        <?= Html::submitButton("Actualizar Taller",array('class'=>'btn btn-success','onclick'=>'js:enviar_data();')); ?>
    </div>
    
    <?php $form = ActiveForm::begin(); ?>
    <input type='hidden' id='asignador' name='asignador' value='<?= $id_usuario; ?>' />
    <?= $form->field($model, 'id_vehiculo')->hiddenInput()->label(false) ?>
    <?= $form->field($model, 'id_transaccion')->hiddenInput()->label(false) ?>
    <?= $form->field($model, 'pagador')->hiddenInput()->label(false) ?>
    <?= $form->field($model, 'numero_atencion')->textInput(['readonly'=>true, 'class'=>'texto texto-ec']) ?>
    <input type="hidden" id='rol' name='rol' value="<?= $rol ?>" />
    <br />
    <table class="tablas tablas1">
        <tr>
            <th colspan="5" align="center">
                <b>DATOS DEL VEHICULO</b>
            </th>
        </tr>
        <tr>
            <td align="left">
                <b>Placa</b><br />
                <input class="texto texto-corto" id="v_placa" readonly="true" />
            </td>
            <td align="left">
                <b>Modelo</b><br />
                <input class="texto texto-corto" id="v_modelo" readonly="true" />
            </td>
            <td align="left">
                <b>Tipo</b><br />
                <input class="texto texto-corto" id="v_tipo" readonly="true" />
            </td>
            <td align="left">
                <b>Año</b><br />
                <input class="texto texto-corto" id="v_anio" readonly="true" />
            </td>
            <td align="left">
                <b>Color</b><br />
                <input class="texto texto-corto" id="v_color" readonly="true" />
            </td>
        </tr>
    </table>

    <table class="tablas tablas1">
        <tr>
            <th colspan="8" align="center">
                <b>Servicios Solicitados</b>
                <label id='mensaje_alerta' style='visibility: hidden' class='alerta_msj'></label>
            </th>
        </tr>
        <tr>
            <td>
                Fila<br />
                <input id="d_fila" maxlength="5" class="texto texto-xc" onkeypress="return entero(event);" />
                <input id="tipo_item" type="hidden" />
                <input id="i_items" name="i_items" type="hidden" />
            </td>
            <td>
                Cod. de Item *<br />
                <?= $form->field($model, 'd_codigo')->label(false)->widget(\yii\jui\AutoComplete::classname(), [
                        'clientOptions' => [
                            'source' => $items,
                        ],
                        'options' => ['class' => 'texto texto-ec izq','onblur'=>'js: carga_servicios()'],
                    ]) 
                ?>
            </td>
            <td colspan="4">
                Descripci&oacute;n *<br />
                <input id="d_nombre" maxlength="120" class="texto texto-largo" readonly />
            </td> 
            <td valign="button" rowspan="3">
                <button type="button" class="btn btn-primary" id="d_agregar" onclick="valida_detalle()">Actualizar</button>
            </td>
        </tr>
        <tr>
            <td>
                Cantidad *<br />
                <input id="d_cantidad" maxlength="10" class="texto texto-xc" 
                 onkeypress="return entero(event);" onkeyup="valida_cantidad(this.id)" onblur="calcula_subtotal()" />
            </td>
            <td>
                Precio *<br />
                <input id="d_precio" maxlength="20" class="texto texto-corto" readonly="true" />
            </td>
            <td>
                IVA<br />
                <select class="texto texto-xc" id="d_iva" onchange="calcula_subtotal()"></select>
            </td>
            <td>
                Impuesto<br />
                <input id="d_impuesto" readonly maxlength="20" class="texto texto-ec" />
            </td>
            <td>
                Total Item<br />
                <input id="d_total" readonly maxlength="20" class="texto texto-ec" />
            </td>
        </tr>
        <tr>
            <td colspan='2'>
                Mecánico*<br />
                <select id="d_mecanico" class="texto texto-medio">
                    <option value=''>Seleccione</option>
                    <?= $mecanico ?>
                </select>
            </td>
            <td colspan='3'>
                Observación<br />
                <input id='d_observacion' class="texto texto-largo" />
            </td>
        </tr>    
    </table>
    <div class="row" align="center">
        <h3 class="text-danger" id='h_bloqueo'></h3>
    </div>
    <table class="tablas inicial00" id="listado_detalle">
        <tr>
            <th>Nro</th>
            <th>Código</th>
            <th>Descripción</th>
            <th>Cantidad</th>
            <th>Precio</th>
            <th>Tax</th>
            <th>Total</th>
            <th>Serv</th>
            <th>Imp</th>
            <th>Mecánico</th>
            <th>Observación</th>
            <th>Opt</th>
        </tr>
    </table>
    
    <?php ActiveForm::end(); ?>

</div>
