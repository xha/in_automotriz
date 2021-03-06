<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "ISAU_Alianza".
 *
 * @property integer $id_alianza
 * @property string $CodProv
 * @property string $porcentaje
 * @property integer $activo
 *
 * @property Proveedor $codProv
 * @property ISAUAlianzaTransaccion[] $iSAUAlianzaTransaccions
 */
class Alianza extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    const ESTATUS_ACTIVE=1;
    const ESTATUS_INACTIVE=0;
    public static function tableName()
    {
        return 'ISAU_Alianza';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['CodProv'], 'required'],
            [['CodProv', 'Descrip'], 'string'],
            [['porcentaje'], 'number'],
            [['activo'], 'integer'],
            [['CodProv'], 'exist', 'skipOnError' => true, 'targetClass' => Proveedor::className(), 'targetAttribute' => ['CodProv' => 'CodProv']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id_alianza' => 'Id Alianza',
            'CodProv' => 'Proveedor',
            'Descrip' => 'Razón Social',
            'porcentaje' => 'Porcentaje',
            'activo' => 'Activo',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCodProv()
    {
        return $this->hasOne(Proveedor::className(), ['CodProv' => 'CodProv']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getISAUAlianzaTransaccions()
    {
        return $this->hasMany(ISAUAlianzaTransaccion::className(), ['id_alianza' => 'id_alianza']);
    }

    public function getActivo(){
        $r = $this->activo;
        if($r == 1){
            $z = "SI";
        }else{
            $z = 'NO';
        }
        return $z;
    }
}
