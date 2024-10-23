<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "notes".
 *
 * @property int $id
 * @property string $title
 * @property string $content
 * @property int $user_id
 * @property int $created_at
 * @property int $updated_at
 *
 * @property NoteTag[] $noteTags
 * @property Tag[] $tags
 * @property User $user
 */
class Note extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'note';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['title', 'content'], 'required'],
            [['content'], 'string'],
            [['user_id', 'created_at', 'updated_at'], 'integer'],
            [['title'], 'string', 'max' => 255],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::class, 'targetAttribute' => ['user_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ИД',
            'title' => 'Заголовок',
            'content' => 'Текст',
            'user_id' => 'Добавил',
            'created_at' => 'Добавлено в',
            'updated_at' => 'Обновлено в',
        ];
    }

    /**
     * Gets query for [[NoteTags]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getNoteTags()
    {
        return $this->hasMany(NoteTag::class, ['note_id' => 'id']);
    }

    /**
     * Gets query for [[Tags]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getTags()
    {
        return $this->hasMany(Tag::class, ['id' => 'tag_id'])->viaTable('note_tag', ['note_id' => 'id']);
    }

    /**
     * Gets query for [[User]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::class, ['id' => 'user_id']);
    }
}
