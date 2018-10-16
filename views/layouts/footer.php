<?php
/**
 * Created by PhpStorm.
 * User: kukushkina
 * Date: 13.06.17
 * Time: 18:51
 */
?>

    <div  class="page-footer__video">
      <img src="/nassets/img_static/video.png" width="158" height="120" alt="Видео о Чевостике">
      <script>
        var showVideo = document.querySelector('.page-footer__video');
        var body = document.querySelector('body');
        var closeBtn = document.querySelector('.close-btn');
        var instruction = document.querySelector('.instruction')
        showVideo.onclick = function () {
          instruction.style.display = 'block';
          body.style.overflow = 'hidden';
        }
        closeBtn.onclick = function () {
          instruction.style.display = 'none';
          body.style.overflow = 'auto';
        }
      </script>
    </div>
    <small class="page-footer__copyright">© Чевостик, 2017</small>
    <h3 class="page-footer__title">Проект детского издательства <a href="http://www.1elena.ru/" target="_blank" class="link link_color_gray">Елена</a></h3>
    <nav class="bottom-nav page-footer__bottom-nav">
      <span class="bottom-nav__item">
        <a href="https://chevostik.ru/contacts" class="link link_color_gray">Контакты</a>
      </span>
        <span class="bottom-nav__item">
        <a href="https://chevostik.ru/agreement" class="link link_color_gray">Пользовательские соглашения</a>
      </span>
    </nav>
    <p class="page-footer__made-in">
        Сайт сделан в
        <a href="http://breadhead.ru" target="_blank" class="link link_color_gray">Breadhead</a>
    </p>

