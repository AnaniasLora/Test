<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Horarios;

/**
 * SearchHorarios represents the model behind the search form about `app\models\Horarios`.
 */
class SearchHorarios extends Horarios
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'dia_mes'], 'integer'],
            [['tipo', 'frecuencia', 'diasemana', 'hora', 'region', 'instance_id', 'volume_id', 'encender', 'apagar', 'servidor_procesos', 'estatus'], 'safe'],
            [['instance_reboot'], 'boolean'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function search($params)
    {
        $query = Horarios::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        $query->andFilterWhere([
            'id' => $this->id,
            'dia_mes' => $this->dia_mes,
            'hora' => $this->hora,
            'encender' => $this->encender,
            'apagar' => $this->apagar,
            'instance_reboot' => $this->instance_reboot,
        ]);

        $query->andFilterWhere(['like', 'tipo', $this->tipo])
            ->andFilterWhere(['like', 'frecuencia', $this->frecuencia])
            ->andFilterWhere(['like', 'diasemana', $this->diasemana])
            ->andFilterWhere(['like', 'region', $this->region])
            ->andFilterWhere(['like', 'instance_id', $this->instance_id])
            ->andFilterWhere(['like', 'volume_id', $this->volume_id])
            ->andFilterWhere(['like', 'servidor_procesos', $this->servidor_procesos])
            ->andFilterWhere(['like', 'estatus', $this->estatus]);

        return $dataProvider;
    }
}
