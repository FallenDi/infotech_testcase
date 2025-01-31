<?
namespace app\commands;

use Yii;
use yii\console\Controller;
use yii\rbac\DbManager;

class RbacController extends Controller
{
    public function actionInit()
    {
        $auth = Yii::$app->authManager;

        // Создание ролей
        $guest = $auth->createRole('guest');
        $user = $auth->createRole('user');

        $auth->add($guest);
        $auth->add($user);

        // Создание разрешений
        $viewBooks = $auth->createPermission('viewBooks');
        $viewBooks->description = 'Просмотр книг';
        $auth->add($viewBooks);

        $manageBooks = $auth->createPermission('manageBooks');
        $manageBooks->description = 'Управление книгами';
        $auth->add($manageBooks);

        $viewAuthors = $auth->createPermission('viewAuthors');
        $viewAuthors->description = 'Просмотр авторов';
        $auth->add($viewAuthors);

        $manageAuthors = $auth->createPermission('manageAuthors');
        $manageAuthors->description = 'Управление авторами';
        $auth->add($manageAuthors);

        // Назначаем разрешения ролям
        $auth->addChild($guest, $viewBooks);
        $auth->addChild($user, $viewBooks);
        $auth->addChild($user, $manageBooks);
        $auth->addChild($guest, $viewAuthors);
        $auth->addChild($user, $viewAuthors);
        $auth->addChild($user, $manageAuthors);

        echo "RBAC инициализирован!\n";
    }

    public function actionAssign($roleName, $userId)
    {
        $auth = Yii::$app->authManager;
        $role = $auth->getRole($roleName);
        
        if (!$role) {
            echo "Роль $roleName не найдена.\n";
            return;
        }
        
        $auth->assign($role, $userId);
        echo "Роль $roleName назначена пользователю $userId\n";
    }
}