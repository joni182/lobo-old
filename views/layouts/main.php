<?php

/* @var $this \yii\web\View */
/* @var $content string */

use app\models\Vacunaciones;

use app\widgets\Alert;
use yii\helpers\Url;
use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use app\assets\AppAsset;

AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?php $this->registerCsrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
    <?php $this->registerCssFile("@web/css/custom.css");
 ?>
 <script src="//code.jquery.com/jquery-3.3.1.min.js"></script>
 <link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/fancyapps/fancybox@3.5.7/dist/jquery.fancybox.min.css" />
 <script src="https://cdn.jsdelivr.net/gh/fancyapps/fancybox@3.5.7/dist/jquery.fancybox.min.js"></script>
 <link rel="stylesheet" href="css/jquery.justified.css" />
 <script src="js/jquery.justified.min.js"></script>
 <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>


</head>
<body>
<?php $this->beginBody() ?>

<div class="wrap">
    <?php
    NavBar::begin([
        'brandLabel' => '<img src="logo.png" alt="logo de lobo" class="pull-left brand-logo"/>',
        'brandUrl' => Yii::$app->homeUrl,
        'options' => [
            'class' => 'navbar-inverse navbar-fixed-top',
        ],
    ]);
    $alertas = Vacunaciones::find()->where('fecha::date = now()::date')->orderBy('fecha', 'DESC')->count();
    echo Nav::widget([
        'options' => ['class' => 'navbar-nav navbar-right'],
        'items' => [
            ['label' => 'Home','url' => ['site/index']],
            ['label' => 'Animales','url' => ['animales/index']],
            '<li><a href="'. Url::to(['site/alertas']) .'">Alertas <span class="badge">'. $alertas .'</span></a></li>',
            ['label' => 'Alertas' . $alertas,'url' => ['site/alertas']],
            ['label' => 'Tratamientos','url' => ['tratamientos/index']],
            ['label' => 'Adopcionens','url' => ['acogidas/index']],
            [
                'label' => 'Otros',
                'items' => [
                    ['label' => 'Colores','url' => ['colores/index']],
                    ['label' => 'Grupos','url' => ['especies/index']],
                    ['label' => 'Enfermedades', 'url' => ['/enfermedades/index']],
                ],
            ],
            Yii::$app->user->isGuest ? (
                ['label' => 'Login', 'url' => ['/site/login']]
            ) : (
                '<li>'. Html::a('Perfil', ['usuarios-info/update', 'id' => Yii::$app->user->id]) .'</li>'
                .'<li>'
                . Html::beginForm(['/site/logout'], 'post')
                . Html::submitButton(
                    'Logout (' . Yii::$app->user->identity->nombre . ')',
                    ['class' => 'btn btn-link logout']
                )
                . Html::endForm()
                . '</li>'
            )
        ],
    ]);
    NavBar::end();
    ?>

    <div class="container">
        <?= Breadcrumbs::widget([
            'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
        ]) ?>
        <?= Alert::widget() ?>
        <?= $content ?>
    </div>
</div>

<footer class="footer">
    <div class="container">
        <p class="pull-left"> Lobo <?= date('Y') ?></p>

    </div>

</footer>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
