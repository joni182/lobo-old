<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\AnimalesSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Animales';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="animales-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Animales', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php echo $this->render('_search', ['model' => $searchModel]); ?>



<ul class="cards">
  <li class="cards__item">
    <div class="card">
      <div class="card__image card__image--fence"><img src="http://localhost/rest/web/images/155966382992330" alt=""></div>
      <div class="card__content">
        <div class="card__title">Flex</div>
        <p class="card__text">This is the shorthand for flex-grow, flex-shrink and flex-basis combined. The second and third parameters (flex-shrink and flex-basis) are optional. Default is 0 1 auto. </p>
        <button class="btn btn--block card__btn">Button</button>
      </div>
    </div>
  </li>
  <li class="cards__item">
    <div class="card">
      <div class="card__image card__image--river"><img src="http://localhost/rest/web/images/155966382992330" alt=""></div>
      <div class="card__content">
        <div class="card__title">Flex Grow</div>
        <p class="card__text">This defines the ability for a flex item to grow if necessary. It accepts a unitless value that serves as a proportion. It dictates what amount of the available space inside the flex container the item should take up.</p>
        <button class="btn btn--block card__btn">Button</button>
      </div>
    </div>
  </li>
  <li class="cards__item">
    <div class="card">
      <div class="card__image card__image--record"><img src="http://localhost/rest/web/images/155966383000775" alt=""></div>
      <div class="card__content">
        <div class="card__title">Flex Shrink</div>
        <p class="card__text">This defines the ability for a flex item to shrink if necessary. Negative numbers are invalid.</p>
        <button class="btn btn--block card__btn">Button</button>
      </div>
    </div>
  </li>
  <li class="cards__item">
    <div class="card">
      <div class="card__image card__image--flowers"><img src="http://localhost/rest/web/images/155966382992330" alt=""></div>
      <div class="card__content">
        <div class="card__title">Flex Basis</div>
        <p class="card__text">This defines the default size of an element before the remaining space is distributed. It can be a length (e.g. 20%, 5rem, etc.) or a keyword. The auto keyword means "look at my width or height property."</p>
        <button class="btn btn--block card__btn">Button</button>
      </div>
    </div>
  </li>
</ul>


</div>
