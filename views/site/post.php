
<style>
    .blog-article__img{
     display: block;
        max-width: 100%;
        margin-bottom: 7%;
    }
</style>
  <main class="site-content">
    <div class="wrapper">

      <ul class="breadcrumbs">
        <li class="breadcrumbs__item">
          <a href="/" class="btn btn_size_l btn_type_secondary_white">
            <svg xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" width="9px" height="15px" viewBox="0 0 9 15"><polygon points="7.682,14.318 8.318,13.682 2.137,7.5 8.318,1.318 7.682,0.682 0.863,7.5 "/></svg>
            Все статьи
          </a>
        </li>
      </ul>

      <article class="blog-article">
      <div class="blog-article__img-wrap">
          <img  src="/image/post<?=$post->getId().'/'.$post->getAttachments()[0].'.png'?>" alt="<?= /** @var \app\models\Post $post */
        $post->getTitle()?>" class="blog-article__img">
      </div>
      <div class="blog-article__author">
        <small class="blog-article__author-label">Автор</small>
        <img class="blog-article__author-img" src="<?=$post->getUserAvatar()?>" width="40" height="40" alt="Юрий Норштейн">
        <p class="blog-article__author-info">
          <span class="blog-article__author-name"><?=$post->getUserName()?></span>
          <span class="blog-article__author-position"><?=$post->getUserNiceName()?></span>
        </p>
      </div>
      <h1 class="blog-article__title"><?=$post->getTitle()?></h1>
         <!-- <div>
              <?/*=$post->getContent()*/?>
          </div>-->
<!--      <p class="blog-article__main-text">С удовольствием представляем вам наш новый музейный аудиогид. На этот раз предмет исследования Чевостика — легендарная Государственная Третьяковская галерея.</p>-->
      <p class="blog-article__text">
      <?=$post->getExcerpt()?>
      </p>
      <!--<div class="blog-article__additional">
        <div class="blog-article__additional__img">
          <img src="./img_static/blog/blog-article-preview.jpg" alt="Подпись к иллюстации">
        </div>
        <div class="blog-article__additional__text">
          <p>Подпись к иллюстации<br>
            Автор иллюстрации:<br>
            Художилов Роман</p>
        </div>
      </div>-->

      <!--<p class="blog-article__text">
        Приокеаническая пустыня, если уловить хореический ритм или аллитерацию на "р", осознаёт британский протекторат. Рефлексия абсурдно отражает урбанистический акцент. Мелькание мыслей, как бы это ни казалось парадоксальным, косвенно. Баня-Лука иллюстрирует Бенгальский залив. Ударение иллюстрирует утконос.
      </p>-->
    </article>
    </div>

    <section class="email-subscription">
      <div class="wrapper email-subscription__wrapper">
        <div class="email-subscription__icon">
          <svg class="ui-Icon-Image " width="351" height="326">
            <use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#static--сhevostik_with_envelope"></use>
          </svg>
        </div>
        <div class="email-subscription__about">
          <p class="email-subscription__text">У Чевостика только хорошие новости. <br>Подпишись и будь в курсе:</p>
          <ul class="email-subscription__list">
            <li class="email-subscription__item">скидок на подписку</li>
            <li class="email-subscription__item">новых познавательных уроков</li>
            <li class="email-subscription__item">свежих статей в блоге</li>
          </ul>
          <form method="post" action="" class="email-subscription__filed js-form-subscription">
            <input class="email-subscription__input" type="email" placeholder="Электронная почта" id="email-subscription" name="email" required/>
            <button type="submit" class="email-subscription__btn">
              <svg class="ui-Icon-Image" width="40" height="40">
                <use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#static--go-on"></use>
              </svg>
              Отправить
            </button>
          </form>
        </div>
      </div>
    </section>

    <section class="socials-section">

      <nav class="socials-section__links social-links social-links_type_large">
        <a href="https://vk.com/izdelena" target="_blank" class="social-links__item social-links__item_type_vk">
          <svg class="ui-Icon-Image" width="22" height="20">
            <use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#static--vk_icon"></use>
          </svg>
        </a>
        <a href="https://www.facebook.com/chevostik/" target="_blank" class="social-links__item social-links__item_type_fb">
          <svg class="ui-Icon-Image" width="12" height="20">
            <use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#static--fb_icon"></use>
          </svg>
        </a>
        <a href="https://www.instagram.com/chevostik.ru/" target="_blank" class="social-links__item social-links__item_type_insta">
          <svg class="ui-Icon-Image" width="18" height="20">
            <use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#static--instagram_icon_gradient"></use>
          </svg>
        </a>
      </nav>

    </section>
  </main>

