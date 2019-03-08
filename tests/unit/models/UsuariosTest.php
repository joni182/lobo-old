<?php

namespace tests\unit\models;

use app\models\Usuarios;
use tests\unit\fixtures\UsuariosFixture;

class UsuariosTest extends \Codeception\Test\Unit
{
    public function _fixtures()
    {
        return [
            [
                'class' => UsuariosFixture::class,
            ],
        ];
    }

    public function testHayUsuarios()
    {
        expect(Usuarios::find()->count())->notEquals(0);
    }
}
