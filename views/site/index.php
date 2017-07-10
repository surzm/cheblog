<main class="site-content">
    <div class="wrapper">
        <h1 class="h1-display txt-center">Наш блог</h1>

        <section class="blog-list">
            <?php /** @var \app\models\Post $post */
            foreach ($posts as $post) {
                ?>
                <article class="blog-post">
                    <?php if ($post->getImg()) { ?>
                        <a href="post/<?= $post->getId() ?>" class="blog-post__img-wrap">
                            <img src="/image/post<?= $post->getId() . '/main.small.png' ?>"
                                 alt="<?= $post->getTitle() ?>" title="<?= $post->getTitle() ?>">
                        </a>
                    <?php } ?>
                    <div class="blog-post__about">
                        <h3 class="blog-post__title">
                            <a href="post/<?= $post->getId() ?>"
                               title="<?= $post->getTitle() ?>"><?= $post->getTitle() ?></a>
                        </h3>
                        <p class="blog-post__text"><?= trim(strip_tags($post->getExcerpt())) ?>
                        </p>
                        <div class="blog-post__info">
                            <img class="blog-post__author-img" src="<?= $post->getUserAvatar() ?>" width="40"
                                 height="40" alt="<?= $post->getUserName() ?>">
                            <div class="blog-post__author">
                                <p class="blog-post__author-name"><?= $post->getUserName() ?></p>
                            </div>
                            <a href="post/<?= $post->getId() ?>">
                                <button type="button" class="btn btn_type_secondary_white blog-post__btn">Читать
                                    дальше
                                </button>
                            </a>
                        </div>
                    </div>
                </article>
            <?php } ?>
        </section>
    </div>
    <section class="email-subscription">
        <div class="wrapper email-subscription__wrapper">
            <div class="email-subscription__icon">
                <svg class="ui-Icon-Image " width="351" height="326">
                    <use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#static--сhevostik_with_envelope"></use>
                </svg>
            </div>
            <div class="email-subscription__about">
                <p class="email-subscription__text">У Чевостика только хорошие новости. <br>Подпишись и будь в курсе:
                </p>
                <ul class="email-subscription__list">
                    <li class="email-subscription__item">скидок на подписку</li>
                    <li class="email-subscription__item">новых познавательных уроков</li>
                    <li class="email-subscription__item">свежих статей в блоге</li>
                </ul>
                <form method="post" action="" class="email-subscription__filed js-form-subscription">
                    <input class="email-subscription__input" type="email" placeholder="Электронная почта"
                           id="email-subscription" name="email" required/>
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
            <a href="https://www.facebook.com/chevostik/" target="_blank"
               class="social-links__item social-links__item_type_fb">
                <svg class="ui-Icon-Image" width="12" height="20">
                    <use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#static--fb_icon"></use>
                </svg>
            </a>
            <a href="https://www.instagram.com/chevostik.ru/" target="_blank"
               class="social-links__item social-links__item_type_insta">
                <svg class="ui-Icon-Image" width="18" height="20">
                    <use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#static--instagram_icon_gradient"></use>
                </svg>
            </a>
        </nav>

    </section>
</main>