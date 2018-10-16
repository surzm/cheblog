
<?
use app\assets\ErrorAsset;

ErrorAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Страница не найдена</title>
    <link rel="stylesheet" href="/nassets/styles/error40.css">

    <?php $this->head() ?>
</head>
<body class="site">
  <!-- SVG спрайт -->
  <svg width="0" height="0" style="position:absolute"><symbol viewBox="0 0 12 20" id="social-links--fb_icon"><path d="M4 20h4l-.3-9.5h4.1l.2-3.6H7.8l.1-3.1 3.9-.4L12 0 4 .3v6.4H.1L0 10.4h4z"></path></symbol><symbol viewBox="0 0 18 20" id="social-links--instagram_icon"><path d="M0 1v18l18-.2V1H0zm15.9 15.6l-13.6.1V3.4l13.5.1.1 13.1z"></path><path d="M9 5.9c-.9 0-2.6 1-2.6 1s-.9.9-1.2 1.5c-.3.5-.4 1.6-.4 1.6s.3 1.7.7 2.3c.3.5 1 1 1.7 1.3.9.4 1.8.4 1.8.4s1-.1 1.9-.5c.8-.3 1.4-1.1 1.4-1.1s.9-1.6.9-2.5c0-.7-.5-2-.5-2s-.7-.8-1.2-1.2c-.3-.3-1.2-.6-1.2-.6s-.8-.2-1.3-.2zM9 12c-.4 0-.9-.3-.9-.3l-.7-.6S7 10.4 7 10c0-.4.1-1 .1-1s.1-.3.6-.7c.5-.4.8-.5 1.3-.5s.9.2.9.2l.6.6.4.6s.1.4.1.8-.2.8-.2.8-.1.3-.6.8c-.4.3-.7.4-1.2.4zM13.5 6.8c-.2 0-.3 0-.5-.1s-.5-.4-.5-.4-.2-.3-.2-.4v-.3c0-.2.1-.5.1-.5s.2-.3.3-.4.3-.2.5-.3c.1 0 .4-.1.4-.1s.5.1.7.2c.1.1.3.5.3.5s.1.4.1.5c0 .2-.2.6-.2.6s-.3.4-.5.5c-.1.1-.3.2-.5.2z"></path></symbol><symbol viewBox="0 0 18 20" id="social-links--instagram_icon_gradient"><linearGradient id="ca" gradientUnits="userSpaceOnUse" x1="15.104" y1="22.672" x2="2.81" y2="1.378" gradientTransform="matrix(1 0 0 -1 0 22)"><stop offset="0" stop-color="#4845a2"></stop><stop offset=".059" stop-color="#4f45a2"></stop><stop offset=".146" stop-color="#6345a2"></stop><stop offset=".251" stop-color="#8344a1"></stop><stop offset=".348" stop-color="#a844a1"></stop><stop offset=".391" stop-color="#ab429a"></stop><stop offset=".452" stop-color="#b43c88"></stop><stop offset=".523" stop-color="#c33269"></stop><stop offset=".602" stop-color="#d7243f"></stop><stop offset=".604" stop-color="#d7243e"></stop><stop offset=".687" stop-color="#e24c36"></stop><stop offset=".78" stop-color="#ec722f"></stop><stop offset=".866" stop-color="#f38d2a"></stop><stop offset=".942" stop-color="#f79d27"></stop><stop offset="1" stop-color="#f9a326"></stop></linearGradient><path d="M0 1v18l18-.2V1H0zm15.9 15.6l-13.6.1V3.4l13.5.1.1 13.1z" fill="url(#ca)"></path><linearGradient id="cb" gradientUnits="userSpaceOnUse" x1="11.046" y1="15.581" x2="6.966" y2="8.514" gradientTransform="matrix(1 0 0 -1 0 22)"><stop offset="0" stop-color="#a844a1"></stop><stop offset=".08" stop-color="#ab429a"></stop><stop offset=".194" stop-color="#b43c88"></stop><stop offset=".327" stop-color="#c33269"></stop><stop offset=".475" stop-color="#d7243f"></stop><stop offset=".478" stop-color="#d7243e"></stop><stop offset=".702" stop-color="#d7263e"></stop><stop offset=".783" stop-color="#d92d3c"></stop><stop offset=".84" stop-color="#dc383a"></stop><stop offset=".886" stop-color="#e14937"></stop><stop offset=".926" stop-color="#e75f33"></stop><stop offset=".961" stop-color="#ee7b2e"></stop><stop offset=".992" stop-color="#f79a28"></stop><stop offset="1" stop-color="#f9a326"></stop></linearGradient><path d="M9 5.9c-.9 0-2.6 1-2.6 1s-.9.9-1.2 1.5c-.3.5-.4 1.6-.4 1.6s.3 1.7.7 2.3c.3.5 1 1 1.7 1.3.9.4 1.8.4 1.8.4s1-.1 1.9-.5c.8-.3 1.4-1.1 1.4-1.1s.9-1.6.9-2.5c0-.7-.5-2-.5-2s-.7-.8-1.2-1.2c-.3-.3-1.2-.6-1.2-.6s-.8-.2-1.3-.2zM9 12c-.4 0-.9-.3-.9-.3l-.7-.6S7 10.4 7 10c0-.4.1-1 .1-1s.1-.3.6-.7c.5-.4.8-.5 1.3-.5s.9.2.9.2l.6.6.4.6s.1.4.1.8-.2.8-.2.8-.1.3-.6.8c-.4.3-.7.4-1.2.4z" fill="url(#cb)"></path><path d="M13.5 6.8c-.2 0-.3 0-.5-.1s-.5-.4-.5-.4-.2-.3-.2-.4v-.3c0-.2.1-.5.1-.5s.2-.3.3-.4.3-.2.5-.3c.1 0 .4-.1.4-.1s.5.1.7.2c.1.1.3.5.3.5s.1.4.1.5c0 .2-.2.6-.2.6s-.3.4-.5.5c-.1.1-.3.2-.5.2z" fill="#a844a1"></path></symbol><symbol viewBox="0 0 22 20" id="social-links--vk_icon"><path d="M0 4.2L3.2 2l5.6 8.5.1-9h4.4v7.4L19 1.8l3 1.9-5.7 7.7 4.6 4-2.1 3.1-5.9-5-.3 5H9.3z"></path></symbol></svg>
  <!-- SVG спрайт -->
  <div class="error-page error-page_state_not_phone">
    <div class="pre-loader pre-loader_state_hide pre-loader_type_game">
    </div>
    <div class="error-page__wrapper">
      <div class="error-page__img" style="background-image: url(/nassets/img_static/error_animation_fon.svg);">
        <div class="error-page__img-person" style="background-image: url(/nassets/img_static/error_animation_sprite.svg);">
        </div>
      </div>
      <div class="error-page__overview">
        <h1 class="error-page__title">404!</h1>
        <p class="error-page__text">Упс, такой страницы не&nbsp;существует...</p>
        <p class="error-page__text-additional">
          Начните с <a href="/" class="link"> главной страницы</a>
        </p>
      </div>
    </div>
  </div>
</body>
</html>
