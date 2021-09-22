<?php
/*
 Template Name: LP-stulysura
*/

//get_header('lp');
get_header(); ?>

<div class="infoblock">
    <span></span>
    <div class="close-info">&times;</div>
</div><!--.infoblock-->

<?php /* Скрываем блок старого баннера <div class="block-1">
    <div class="wrap">
        <h1 class="fs1">Доставим кровать-машину домой от 3-х дней<br>с оплатой при получении</h1>
        <div class="top-form right">
			<?php echo do_shortcode('[contact-form-7 id="4538" title="Скидка 3000 руб. (Баннер лендинг кроватки)"]') ;?>
            <!-- <div class="hear right">
                <div class="hear-body">
                    <img src="<?php echo get_template_directory_uri() . '/img-lp/bel-hand-min.png'; ?>" alt="" class="bel-hand">
                    <img src="<?php echo get_template_directory_uri() . '/img-lp/bel-body-min.png'; ?>" alt="" class="bel-body">
                </div>
            </div>-->		
        </div>
        <div class="clear"></div>
    </div>
</div><?php */?>

<div class="block-3">
    <div class="wrap">
        <h2>ОБЗОР НАШИХ КРОВАТОК ЗА 55 СЕКУНД</h2>
        <iframe src="https://www.youtube.com/embed/v7eE4o3zN2I?rel=0&amp;showinfo=0" frameborder="0" allowfullscreen
                width="1000px" height="562px" class="center-block"></iframe>
    </div>
</div><!--/.block-3-->

<div class="block-2">
    <div class="wrap">
        <h2>5 причин, по которым выбирают нас</h2>
        <div class="block2-content">
            <div class="plus-block">
                <img src="<?php echo get_template_directory_uri() . '/img-lp/bitmap.png'; ?>" alt="">
                <div class="plus-text">
                    <h3>Уникальность</h3>
                    <p>Изображения на кроватях отрисованы вручную художником-иллюстратором.</p>
                </div>
            </div>
            <hr>
            <div class="plus-block">
                <img src="<?php echo get_template_directory_uri() . '/img-lp/bitmap2.png'; ?>" alt="">
                <div class="plus-text">
                    <h3>Специальные технологии</h3>
                    <p>Элементы рисунков, рекомендованные педиатрами, помогут уснуть.</p>
                </div>
            </div>
            <hr>
            <div class="plus-block">
                <img src="<?php echo get_template_directory_uri() . '/img-lp/bitmap3.png'; ?>" alt="">
                <div class="plus-text">
                    <h3>Безопасность</h3>
                    <p>Отсутствие острых углов и специальные бортики.</p>
                </div>
            </div>
            <hr>
            <div class="plus-block">
                <img src="<?php echo get_template_directory_uri() . '/img-lp/bitmap4.png'; ?>" alt="">
                <div class="plus-text">
                    <h3>Прочность</h3>
                    <p>Дети могут смело прыгать, а взрослые прилечь рядом с ребенком.</p>
                </div>
            </div>
            <hr>
            <div class="plus-block">
                <img src="<?php echo get_template_directory_uri() . '/img-lp/bitmap5.png'; ?>" alt="">
                <div class="plus-text">
                    <h3>Удобство</h3>
                    <p>Форма боковин позволяет удобно сидеть взрослым и забираться на кровать даже самым маленьким детям</p>
                </div>
            </div>
        </div>
    </div>
</div><!--/.block-2-->

<div class="block-4 form-block">
    <div class="wrap">
        <div class="dots"></div>
		<?php echo do_shortcode('[contact-form-7 id="3272" title="Задать вопрос" html_id="questions"]'); ?>
        <div class="dots"></div>
    </div>
</div>

<div class="block-5 clearfix">
    <div class="wrap">
        <h2 class="hear-h">ДИЗАЙНЕРСКИЕ КРОВАТИ-МАШИНКИ С ДОСТАВКОЙ НА ДОМ!</h2>
		
		<?php if( have_rows('main_models_carousel') ): ?>
	 
				<?php while( have_rows('main_models_carousel') ): the_row(); ?>
				<div class="type main_models">
					<h3><a href="#popup-type" class="open-popup-type" data-text='<h2><?php the_sub_field('title_2'); ?></h2>
					<!--<img src="--><?php //echo get_template_directory_uri() . '/img-lp/bond1-min.jpg'; ?><!--">--><?php the_sub_field('text'); ?><!--<div class="block-for-form"></div>--><div class="price"><span class="sum summa"> </span><span class="rub">руб.</span></div>'
                   data-cost="<?php the_sub_field('price'); ?>" data-yaTarget="<?php echo the_sub_field('ya_target');?>" data-source-description="<?php echo the_sub_field('source_description')?>"><?php the_sub_field('title_main'); ?> <span class="ip-hidden"><?php the_sub_field('dop_title_main'); ?></span></a></h3>
					<div class="price"><span class="sum"><?php the_sub_field('price'); ?></span> <span class="rub">руб.</span></div>
					
					<?php 

					$images = get_sub_field('gallery');

					if( $images ): ?>
						<div class="slider1 slider">
								<?php foreach( $images as $image ): ?>
									<div class="slide">
									<a href="<?php echo $image['url']; ?>" class="image-popup">
										<img src="<?php echo $image['sizes']['large']; ?>" alt="<?php echo $image['alt']; ?>">
									</a>
									</div><!--/.slide-->
								<?php endforeach; ?>						
						</div><!--/.slider-->
					<?php endif; ?>				
						
				</div><!--/.type-->						
							
				<?php endwhile; ?>     
			<?php endif; ?>
			
    </div><!--/.wrap-->
</div><!--/.block-5-->

<div class="block-6">
    <div class="wrap clearfix">
        <h2>ВЫБЕРИТЕ ОДНУ ИЗ 30 ЭКСКЛЮЗИВНЫХ <br> МОДЕЛЕЙ <a class="open-popup-type" href="#call">ЗДЕСЬ</a></h2>
        <a class="open-popup-type" href="#call">
            <button class="bg-padding big-btn"><span>В каталог</span></button>
        </a>
        <div class="dots"></div>
    </div>
</div><!--/.block-6-->

<div class="block-7">
    <div class="wrap clearfix">
        <h2>ПОДБЕРИТЕ ДОПОЛНИТЕЛЬНЫЕ ТОВАРЫ К КРОВАТКАМ</h2>
        <div class="tabs-block">
            <div class="tabs-list">
                <a href="#popup-type" id="tab-link" style="display:none;" class="open-popup-type"></a>
                <div class="tab"
                     data-text='<h2>Матрас пружинный "Дельта"</h2><p><span class="bold">Размер кровати (см):</span> 160x70x18 (ДxШxВ)</p><p><span class="bold">Состав слоёв:</span> Ткань матрасная "жаккард",стеганая синтепоном. Спанбонд. Материал "лайтек" , толщиной 22мм. Пружинный блок "боннель"</p><p><span class="bold">Жёсткость:</span> средняя</p><p>Матрас поставляется в скрученном виде в вакуумной упаковке. Содержимое не деформируется!</p>'
                     data-cost="2990"
                     data-image="<?php echo get_template_directory_uri() . '/img-lp/delta-min.jpg'; ?>"
                     data-source-description="Подробнее матрас Дельта">
                    <div class="image-block"><img src="<?php echo get_template_directory_uri() . '/img-lp/delta-prev.jpg'; ?>" alt="" class="img-responsive"></div>
                    <h3>Матрас пружинный "Дельта"</h3>
                </div><!--/.tab-->
                <div class="tab"
                     data-text='<h2>Матрас пружинный "Уют"</h2><p><span class="bold">Размер кровати (см):</span> 160х70х15 (ДхШхВ)</p><p><span class="bold">Состав слоёв:</span> Поролон пропитанный латексом. Ткань матрасная «жаккард», синтетический, стеганая синтепоном.</p><p><span class="bold">Жёсткость:</span> высокая</p><p>Матрас поставляется в скрученном виде в вакуумной упаковке. Содержимое не деформируется!</p>'
                     data-cost="4190"
                     data-source-description="Подробнее матрас Уют"
                     data-image="<?php echo get_template_directory_uri() . '/img-lp/uyut-min.jpg'; ?>">
                    <div class="image-block"><img src="<?php echo get_template_directory_uri() . '/img-lp/uyut-prev.jpg'; ?>" alt=""></div>
                    <h3>Матрас беспружинный "Уют"</h3>
                </div><!--/.tab-->
                <div class="tab"
                     data-text='<h2>Матрас пружинный "Альфа"</h2><p><span class="bold">Размер кровати (см):</span> 160x70x15 (ДxШxВ) (ДxШxВ)</p><p><span class="bold">Состав слоёв:</span> Чехол — ткань “Жаккард” стеганный синтепоном 100 гр./м.кв. Поролон, термовойлок. Блок независимых пружин с поролоном по периметру.</p><p><span class="bold">Жёсткость:</span> высокая</p><p>Матрас поставляется в скрученном виде в вакуумной упаковке. Содержимое не деформируется!</p>'
                     data-cost="4190"
                     data-source-description="Подробнее матрас Альфа"
                     data-image="<?php echo get_template_directory_uri() . '/img-lp/alfa-min.jpg'; ?>">
                    <div class="image-block"><img src="<?php echo get_template_directory_uri() . '/img-lp/alfa-prev.jpg'; ?>" alt=""></div>
                    <h3>Матрас пружинный "Альфа"</h3>
                </div><!--/.tab-->
                <div class="tab" data-text='<h2>Комплект постельного белья</h2>
				<p><span class="bold">Размеры:</span><br> Наволочка 70*70 см, <br>Простыня 150*215 см, <br>Пододеяльник 145*215 см. <br>Материал: бязь </p>'
                     data-cost="950"
                     data-source-description="Подробнее КПБ"
                     data-image="<?php echo get_template_directory_uri() . '/img-lp/post-belie-min.jpg'; ?>">
                    <div class="image-block"><img src="<?php echo get_template_directory_uri() . '/img-lp/post-belie-prev.jpg'; ?>" alt=""></div>
                    <h3>Комплект постельного белья</h3>
                </div><!--/.tab-->
                <div class="tab" data-text='<h2>Пластиковые колёса</h2><p><span class="bold">Состав:</span> Комплект состоит из 2 колес, изготовленных из безвредного ABS пластика, и фурнитуры для их крепления к кровати.</p>'
                     data-cost='1200'
                     data-source-description="Подробнее Колеса"
                     data-image="<?php echo get_template_directory_uri() . '/img-lp/022.jpg"'; ?>">
                    <div class="image-block"><img src="<?php echo get_template_directory_uri() . '/img-lp/0211-prev.jpg'; ?>" alt=""></div>
                    <h3>Пластиковые колёса</h3>
                </div><!--/.tab-->
                <div class="tab"
                     data-text='<h2>Светодиодная подсветка</h2><p><span class="bold">Применение:</span> Подсветка представляет из себя светодиодную ленту, которая располагается под днищем кровати. Она работает от розетки, длина провода составляет 1,1 м. Инструкция по установке светодиодной подсветки прилагается в комплекте.
Можно использовать в качестве ночника.
Напряжение 12В</p><div class="tab-form"><div class="block-for-form"></div></div>'
                     data-cost='1500'
                     data-source-description="Подробнее Подсветка"
                     data-image="<?php echo get_template_directory_uri() . '/img-lp/svet-big.jpg'; ?>">
                    <div class="image-block"><img src="<?php echo get_template_directory_uri() . '/img-lp/svet-prev.jpg'; ?>" alt=""></div>
                    <h3>Светодиодная подсветка</h3>
                </div><!--/.tab-->
            </div>

            <div class="tabs-info clearfix">
                <div class="image-block">
                    <div class="price"><span class="sum"> </span> <span class="rub"> руб.</span></div>
                    <img src="" alt="">
                </div>
                <div class="text-block"></div>
                <div class="tab-form"><?php echo do_shortcode("[contact-form-7 id=\"3823\" title=\"Форма для LP в товарах\"]")?></div>
            </div>
        </div>


    </div>
</div>

<div class="block-8 form-block">
    <div class="wrap">
        <div class="dots"></div>
		<?php echo do_shortcode('[contact-form-7 id="3273" title="Подбор варианта доставки" html_id="delivery"]');?>
        <div class="dots"></div>
    </div>
</div><!--/.block-8-->

<div class="block-9">
    <div class="wrap">
        <h2>ОТЗЫВЫ РОДИТЕЛЕЙ</h2>

        <div class="slider6 slider">
            <div class="slide">
                <div class="image-block">
                    <a href="<?php echo get_template_directory_uri() . '/img-lp/otz/alinali.jpg'; ?>" class="image-popup"><img src="<?php echo get_template_directory_uri() . '/img-lp/otz/alinali.jpg'; ?>" alt=""></a>
                </div>
                <div class="text-block">
                    <h3>Алина Ли</h3>
                    <p>Бельмарко, спасибо вам огромное!!!!! Кроватка нереальная!!!! Советуем друзьям и знакомым ваш магазин!</p>
                </div>
                <a class="read" href="https://vk.com/albums-73325540?z=photo-73325540_456241375%2Fphotos-73325540"
                   target="_blank"><span>прочитать отзыв</span></a>
            </div>

            <div class="slide">
                <div class="image-block">
                    <a href="<?php echo get_template_directory_uri() . '/img-lp/otz/Fiana_Kargashina.jpg'; ?>" class="image-popup"><img src="<?php echo get_template_directory_uri() . '/img-lp/otz/Fiana_Kargashina.jpg'; ?>" alt=""></a>
                </div>
                <div class="text-block">
                    <h3>Фаина Каргашина</h3>
                    <p>Сынок очень ждал эту машинку и очень обрадовался ей. Пока папа ее собирал, он все время крутился
                        рядом и чем смог,тем помогал ему)</p>
                </div>
                <a class="read" href="https://vk.com/photo-73325540_456239700?rev=1"
                   target="_blank"><span>прочитать отзыв</span></a>
            </div>

            <div class="slide">
                <div class="image-block">
                    <a href="<?php echo get_template_directory_uri() . '/img-lp/otz/Vera_Saiagusheva.jpg'; ?>" class="image-popup"><img src="<?php echo get_template_directory_uri() . '/img-lp/otz/Vera_Saiagusheva.jpg'; ?>" alt=""></a>
                </div>
                <div class="text-block">
                    <h3>Вера Сайгушева</h3>
                    <p>Ребенок счастлив,просто восторге!спасибо за быструю доставку</p>
                </div>
                <a class="read" href="https://vk.com/photo-73325540_456239899?rev=1"
                   target="_blank"><span>прочитать отзыв</span></a>
            </div>


            <div class="slide">
                <div class="image-block">
                    <a href="<?php echo get_template_directory_uri() . '/img-lp/otz/Ariska Alekseeva.jpg'; ?>" class="image-popup"><img src="<?php echo get_template_directory_uri() . '/img-lp/otz/Ariska Alekseeva.jpg'; ?>" alt=""></a>
                </div>
                <div class="text-block">
                    <h3>Аришка Алексеева</h3>
                    <p>Кроватка дошла за одну неделю до Великого Новгорода. Муж собрал минут за 15. Сказать что
                        понравилась, это ничего не сказать! Просто Очень Классная! Хоть и написано что она с 2 лет, но
                        мы купили сыну, ему 1,2. Хозяин кровати Доволен🎉 Очень удобная, достаточно высокие бортики, сам
                        залезает и слезает с нее. Спасибо!!! </p>
                </div>
                <a class="read" href="https://vk.com/photo-73325540_456240258?rev=1"
                   target="_blank"><span>прочитать отзыв</span></a>
            </div>


            <div class="slide">
                <div class="image-block">
                    <a href="<?php echo get_template_directory_uri() . '/img-lp/otz/Galina_priobrazenskaia.jpg'; ?>" class="image-popup"><img src="<?php echo get_template_directory_uri() . '/img-lp/otz/Galina_priobrazenskaia.jpg'; ?>" alt=""></a>
                </div>
                <div class="text-block">
                    <h3>Галина Преображенская</h3>
                    <p>Получили свою кроватку! Очень довольны! Ребенок в восторге! Спасибо "Бельмарко"!!!!</p>
                </div>
                <a class="read" href="https://vk.com/photo-73325540_456240618?rev=1"
                   target="_blank"><span>прочитать отзыв</span></a>
            </div>


            <div class="slide">
                <div class="image-block">
                    <a href="<?php echo get_template_directory_uri() . '/img-lp/otz/Oksana_pestova.jpg'; ?>" class="image-popup"><img src="<?php echo get_template_directory_uri() . '/img-lp/otz/Oksana_pestova.jpg'; ?>" alt=""></a>
                </div>
                <div class="text-block">
                    <h3>Оксана Пестова</h3>
                    <p>Собирается легко,ребёнку очень понравилась!</p>
                </div>
                <a class="read" href="https://vk.com/photo-73325540_456241036?rev=1"
                   target="_blank"><span>прочитать отзыв</span></a>
            </div>


            <div class="slide">
                <div class="image-block">
                    <a href="<?php echo get_template_directory_uri() . '/img-lp/otz/Anastasiya_shukova.jpg'; ?>" class="image-popup"><img src="<?php echo get_template_directory_uri() . '/img-lp/otz/Anastasiya_shukova.jpg'; ?>" alt=""></a>
                </div>
                <div class="text-block">
                    <h3>Анастасiя Жукова</h3>
                    <p>Вот и у нас теперь есть такая замечательная кроватка) Сынуля очень обрадовался, когда придя из
                        садика, увидел такую большую машинку) Заказывали вместе с матрасом и подсветкой. Доставка
                        быстрая, сборка заняла минут 15-20. Качеством и внешним видом очень довольны. Спасибо Вам! </p>
                </div>
                <a class="read" href="https://vk.com/photo-73325540_456241204?rev=1"
                   target="_blank"><span>прочитать отзыв</span></a>
            </div>


            <div class="slide">
                <div class="image-block">
                    <a href="<?php echo get_template_directory_uri() . '/img-lp/otz/Albina_ Basharova.jpg'; ?>" class="image-popup"><img src="<?php echo get_template_directory_uri() . '/img-lp/otz/Albina_ Basharova.jpg'; ?>" alt=""></a>
                </div>
                <div class="text-block">
                    <h3>Альбина Башарова</h3>
                    <p>Сынуля безумно рад своей кроватке "Тачка красная". кровать очень яркая,интересная,простая в
                        сборке</p>
                </div>
                <a class="read" href="https://vk.com/photo-73325540_456239256?rev=1"
                   target="_blank"><span>прочитать отзыв</span></a>
            </div>

            <div class="slide">
                <div class="image-block">
                    <a href="<?php echo get_template_directory_uri() . '/img-lp/otz/Svetlana_Davidenko.jpg'; ?>" class="image-popup"><img src="<?php echo get_template_directory_uri() . '/img-lp/otz/Svetlana_Davidenko.jpg'; ?>" alt=""></a>
                </div>
                <div class="text-block">
                    <h3>Светлана Давыденко</h3>
                    <p>Отличная кровать от компании Бельмарко! Сын доволен и счастлив! Крутая тачка!</p>
                </div>
                <a class="read" href="https://vk.com/photo-73325540_438769603?rev=1"
                   target="_blank"><span>прочитать отзыв</span></a>
            </div>
        </div>
    </div>
</div><!--/.block-9-->

<div class="block-10">
	<div class="wrap">
        <h2>ВИДЕО ОТЗЫВЫ НАШИХ КЛИЕНТОВ</h2>
        <div class="slider7 slider">
            <div class="slide">
                <a href="https://www.youtube.com/watch?v=QxHoeS0uQwY" class="popup-youtube" rel="nofollow">
                    <img src="<?php echo get_template_directory_uri() . '/img-lp/otz1-min.jpg'; ?>" alt="">
                </a>
            </div>

            <div class="slide">
                <a href="https://www.youtube.com/watch?v=YnbKgJMXulQ" class="popup-youtube" rel="nofollow">
                    <img src="<?php echo get_template_directory_uri() . '/img-lp/otz2-min.jpg'; ?>" alt="">
                </a>
            </div>

            <div class="slide">
                <a href="https://www.youtube.com/watch?v=9N-QVBWBN8w" class="popup-youtube" rel="nofollow">
                    <img src="<?php echo get_template_directory_uri() . '/img-lp/otz3-min.jpg'; ?>" alt="">
                </a>
            </div>
            <div class="slide">
                <a href="https://www.youtube.com/watch?v=xnSirjxxGMU" class="popup-youtube" rel="nofollow">
                    <img src="<?php echo get_template_directory_uri() . '/img-lp/otz4-min.jpg'; ?>" alt="">
                </a>
            </div>
            <div class="slide">
                <a href="https://www.youtube.com/watch?v=gEwf29nmwRc" class="popup-youtube" rel="nofollow">
                    <img src="<?php echo get_template_directory_uri() . '/img-lp/otz5-min.jpg'; ?>" alt="">
                </a>
            </div>
            <div class="slide">
                <a href="https://www.youtube.com/watch?v=zfn05-ohebA" class="popup-youtube" rel="nofollow">
                    <img src="<?php echo get_template_directory_uri() . '/img-lp/otz6-min.jpg'; ?>" alt="">
                </a>
            </div>
        </div>

        <!-- <a href="https://vk.com/belmarco" class="vk-group" target="_blank"> <span>Вступите в нашу <br class="ip-hidden mb-visible"> группу в контакте</span></a>
         -->

        <!-- VK Widget -->
        <div class="vk-block">
            <div class="subscription-text">
                <p>
                    <span>Более 150 тыс. родителей</span> получают полезную информацию для детей каждый день. Получайте и Вы! <br>Подпишитесь прямо сейчас!</p>
                <img src="<?php echo get_template_directory_uri() . '/img-lp/strela.svg'; ?>" alt="">
            </div>
            <div id="vk_groups"> </div>
            <script type="text/javascript">
                VK.Widgets.Group("vk_groups", {mode: 3, no_cover: 1, width: "300"}, 73325540);
            </script>

            <div class="insta-block">
                <?php 
                    the_widget("Wpzoom_Instagram_Widget", 
                        array(
                            "title" => "Instagram", 
                            "image-limit" => 7,
                            "images-per-row" => 7,
                            "image-width" => 40,
                            "image-spacing" => 10,
                            "button_text" => "Подписаться"
                        )
                    );
                ?>
            </div>


        </div>
    </div><!--/.wrap-->
</div><!--/.block-10-->   

    <div class="block-11">
		<div class="wrap">
			<div class="dots"></div>
			<h2>Наши сертификаты и награды</h2>
				<div class="sert-block">
					<a href="<?php echo get_template_directory_uri() . '/sert/iso-min.jpg'; ?>" class="image-popup"><img src="<?php echo get_template_directory_uri() . '/img-lp/img-1-min.png'; ?>" alt=""></a>
					<a href="<?php echo get_template_directory_uri() . '/sert/eco-min.jpg'; ?>" class="image-popup"><img src="<?php echo get_template_directory_uri() . '/img-lp/img-2-min.png'; ?>" alt=""></a>
					<a href="<?php echo get_template_directory_uri() . '/sert/EAC-min.jpg'; ?>" class="image-popup"><img src="<?php echo get_template_directory_uri() . '/img-lp/img-3-min.png'; ?>" alt=""></a>
					<a href="<?php echo get_template_directory_uri() . '/sert/gost-min.jpg'; ?>" class="image-popup"><img src="<?php echo get_template_directory_uri() . '/img-lp/img-4-min.png'; ?>" alt=""></a>
					<a href="<?php echo get_template_directory_uri() . '/sert/Brend_goda-min.jpg'; ?>" class="image-popup"><img src="<?php echo get_template_directory_uri() . '/img-lp/img-5-min.png'; ?>" alt=""></a>
				</div>
				<div class="dots"></div>
		</div><!--/.wrap-->	
        
		
    </div><!--/.block-11-->

    <div class="block-12 form-block">
        <div class="wrap">
            <div class="dots"></div>
			<?php echo do_shortcode('[contact-form-7 id="3274" title="Остались вопросы?" html_id="questions_remained"]');?>
            <div class="dots"></div>
        </div>
    </div>

    
    <div id="popup-type" class="popup mfp-hide">
        <div class="text-block"></div>
        <div class="block-form"><?php echo do_shortcode("[contact-form-7 id=\"3823\" title=\"Форма для LP в товарах\"]")?></div>
        <!--<div class="price"><span class="sum summa"></span> <span class="rub">руб.</span></div>-->
    </div>
    <a href="#popup-thks" class="open-popup-type" id="thks" style="display:none;"></a>
    <div id="popup-thks" class="popup mfp-hide">
        <p>Спасибо за заявку! Мы свяжемся с Вами.</p>
    </div>

    <div id="call" class="popup mfp-hide">
        <a href="https://belmarco.ru/product-category/car-beds/" target="_blank">
            <button type="submit" name="submit" class="bg-padding2 big-btn2">
                <span>В каталог</span>
            </button>
        </a>
		<?php echo do_shortcode('[contact-form-7 id="3245" title="Заказать звонок" html_id="callme"]'); ?>
    </div>
<?php
get_footer();
//get_footer('lp');
