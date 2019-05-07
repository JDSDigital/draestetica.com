<?php

use yii\db\Migration;

/**
 * Class m190413_144436_init_rbac
 */
class m190413_144436_init_rbac extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $auth = Yii::$app->authManager;

        // add "seeDashboard" permission
        $seeDashboard = $auth->createPermission('seeDashboard');
        $seeDashboard->description = 'See the dashboard';
        $auth->add($seeDashboard);

        // add "seeUsers" permission
        $seeUsers = $auth->createPermission('seeUsers');
        $seeUsers->description = 'See the users module';
        $auth->add($seeUsers);

        // add "seeSocial" permission
        $seeSocial = $auth->createPermission('seeSocial');
        $seeSocial->description = 'See the social module';
        $auth->add($seeSocial);

        // add "seeBlog" permission
        $seeBlog = $auth->createPermission('seeBlog');
        $seeBlog->description = 'See the blog module';
        $auth->add($seeBlog);

        // add "seeClinic" permission
        $seeClinic = $auth->createPermission('seeClinic');
        $seeClinic->description = 'See the clinic module';
        $auth->add($seeClinic);

        // add "seeClients" permission
        $seeClients = $auth->createPermission('seeClients');
        $seeClients->description = 'See the clients module';
        $auth->add($seeClients);

        // add "seePartners" permission
        $seePartners = $auth->createPermission('seePartners');
        $seePartners->description = 'See the partners module';
        $auth->add($seePartners);

        // add "admin" role and give this role permissions
        $admin = $auth->createRole('admin');
        $auth->add($admin);
        $auth->addChild($admin, $seeDashboard);
        $auth->addChild($admin, $seeUsers);
        $auth->addChild($admin, $seeSocial);
        $auth->addChild($admin, $seeBlog);
        $auth->addChild($admin, $seeClinic);
        $auth->addChild($admin, $seeClients);
        $auth->addChild($admin, $seePartners);

        // add "doctor" role and give this role permissions
        $doctor = $auth->createRole('doctor');
        $auth->add($doctor);
        $auth->addChild($doctor, $seeDashboard);
        $auth->addChild($doctor, $seeClients);

        $auth->assign($admin, 1);
        $auth->assign($doctor, 2);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $auth = Yii::$app->authManager;

        $auth->removeAll();
    }
}
