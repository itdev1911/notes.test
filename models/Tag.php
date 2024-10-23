<?php

namespace app\models;

use Yii;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "tag".
 *
 * @property int $id
 * @property string $name
 *
 * @property NoteTag[] $noteTags
 * @property Note[] $notes
 */
class Tag extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'tag';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name'], 'required'],
            [['name'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ИД',
            'name' => 'Тег',
        ];
    }

    /**
     * Gets query for [[NoteTags]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getNoteTags()
    {
        return $this->hasMany(NoteTag::class, ['tag_id' => 'id']);
    }

    /**
     * Gets query for [[Notes]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getNotes()
    {
        return $this->hasMany(Note::class, ['id' => 'note_id'])->viaTable('note_tag', ['tag_id' => 'id']);
    }

    public static function getList(){
        return ArrayHelper::map(self::find()->all(),'id','name');
    }
}
