<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "note_tag".
 *
 * @property int $note_id
 * @property int $tag_id
 *
 * @property Note $notes
 * @property Tag $tag
 */
class NoteTag extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'note_tag';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['note_id', 'tag_id'], 'integer'],
            [['note_id', 'tag_id'], 'unique', 'targetAttribute' => ['note_id', 'tag_id']],
            [['note_id'], 'exist', 'skipOnError' => true, 'targetClass' => Note::class, 'targetAttribute' => ['note_id' => 'id']],
            [['tag_id'], 'exist', 'skipOnError' => true, 'targetClass' => Tag::class, 'targetAttribute' => ['tag_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'note_id' => 'Заметка',
            'tag_id' => 'Теги',
        ];
    }

    /**
     * Gets query for [[Note]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getNote()
    {
        return $this->hasOne(Note::class, ['id' => 'note_id']);
    }

    /**
     * Gets query for [[Tag]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getTag()
    {
        return $this->hasOne(Tag::class, ['id' => 'tag_id']);
    }
}
