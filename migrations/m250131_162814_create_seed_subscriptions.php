<?php

use yii\db\Migration;

/**
 * Class m250131_162814_create_seed_subscriptions
 */
class m250131_162814_create_seed_subscriptions extends Migration
{
    public function safeUp()
    {
        // Получаем ID пользователей и авторов
        $userIds = (new \yii\db\Query())->select('id')->from('users')->column();
        $authorIds = (new \yii\db\Query())->select('id')->from('authors')->column();

        foreach ($userIds as $index => $userId) {
            if (isset($authorIds[$index])) {
                $this->insert('subscriptions', ['user_id' => $userId, 'author_id' => $authorIds[$index]]);
            }
        }
    }

    public function safeDown()
    {
        $this->delete('subscriptions');
    }
}
