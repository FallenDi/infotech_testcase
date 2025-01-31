<?php

use yii\db\Migration;

/**
 * Class m250131_162727_create_seed_users
 */
class m250131_162727_create_seed_users extends Migration
{
    public function safeUp()
    {
        $this->batchInsert('users', ['username', 'email', 'password_hash', 'auth_key', 'role'], [
            ['user1', 'user1@example.com', Yii::$app->security->generatePasswordHash('password1'), Yii::$app->security->generateRandomString(), 'user'],
            ['user2', 'user2@example.com', Yii::$app->security->generatePasswordHash('password2'), Yii::$app->security->generateRandomString(), 'user'],
            ['user3', 'user3@example.com', Yii::$app->security->generatePasswordHash('password3'), Yii::$app->security->generateRandomString(), 'guest'],
            ['user4', 'user4@example.com', Yii::$app->security->generatePasswordHash('password4'), Yii::$app->security->generateRandomString(), 'guest'],
            ['user5', 'user5@example.com', Yii::$app->security->generatePasswordHash('password5'), Yii::$app->security->generateRandomString(), 'user'],
        ]);
    }

    public function safeDown()
    {
        $this->delete('users');
    }
}
