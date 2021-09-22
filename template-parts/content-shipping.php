<?php
/**
 * Template part for displaying Доставка и оплата.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package belmarco
 */

?>

<article id="post-<?php echo get_the_ID(); ?>" <?php post_class(); ?>>
	<header class="entry-header">
		<?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>
	</header><!-- .entry-header -->

	<div class="entry-content">
		<?php the_content(); ?>			
	</div><!--/.entry-content-->
	<h2 class="fs30 text-uppercase">Доставка</h2>
       <div class="row">
       	<div class="col-md-7 col-lg-6 hidden-sm hidden-xs">
        	<img src="<?php the_field('schema-desktop'); ?>" class="img-responsive center-block hidden-md">
        	<img src="<?php the_field('scheme_laptop'); ?>" class="img-responsive center-block hidden-lg">
        </div>
       
       	<div class="col-md-5 col-lg-6 column_2">
            <div class="section_1"><p><?php the_field('доставка_текст_1'); ?></p>
            <ul class="delivery_comp">
                <li><img src="<?php the_field('transcompany_1'); ?>"></li>
                <li><img src="<?php the_field('transcompany_2'); ?>"></li>
                <li><img src="<?php the_field('transcompany_3'); ?>"></li>
                <li><img src="<?php the_field('transcompany_4'); ?>"></li>
                <li><img src="<?php the_field('transcompany_5'); ?>"></li>
            </ul>
            <p><?php the_field('доставка_текст_2'); ?></p>
            </div><!--/.section_1-->
            
            <div class="section_2"><p><?php the_field('доставка_текст_3'); ?></p></div><!--/.section_2-->
            
            <div class="section_3"><p><?php the_field('доставка_текст_4'); ?></p></div><!--/.section_3-->
            
            <div class="section_4"><p><?php the_field('доставка_текст_5'); ?></p></div><!--/.section_4-->
			</div>
		</div><!--/.row-->
  		<div class="section_5">
            <div class="row">
       			<div class="col-md-8 col-md-offset-2 col-sm-10 col-sm-offset-1">
           		<div><b>При получении груза необходимо руководствоваться следующей инструкцией:</b></div>       
                <?php the_field('инструкция_при_получении'); ?>
            	</div>
        	</div><!--/.row-->
		</div>
        
        <!-- Оплата -->
        <h2 class="fs30 text-uppercase">Оплата</h2>
        <h3 class="h3 var"><span class="fs20">Варианты оплаты:</span></h3>
        <div class="row">
        	<div class="col-sm-6 col-md-5">
            	<h3 class="h3 var_1"><span class="fs20">Наложенный платёж</span></h3>
            <div class="section_6"><p><?php the_field('наложенный_платёж'); ?></p></div>
            </div>
            <div class="col-md-2"></div>
        	<div class="col-sm-6 col-md-5">
            	<h3 class="h3 var_2"><span class="fs20">Предоплата</span></h3>
                <div class="section_7"><p><?php the_field('предоплата_текст_1'); ?></p></div>
                
                <div class="section_8"><p><?php the_field('предоплата_текст_2'); ?></p>
                <p><?php the_field('предоплата_текст_3'); ?></p></div>
                <div class="section_9"><p><?php the_field('предоплата_текст_4'); ?></p></div>
                <div class="section_10"><p><?php the_field('предоплата_текст_5'); ?></p></div>          
            </div>
        
        </div><!--/.row-->
        <div class="section_11">
            <div class="row">
       			<div class="col-md-8 col-md-offset-2 col-sm-10 col-sm-offset-1">
           			<p><?php the_field('оплата_доставки'); ?></p>
            	</div>
        	</div><!--/.row-->
		</div>
        
        <!--Рассрочка-->
        	<h2 class="fs30 text-uppercase">Рассрочка</h2>
        	<div class="row">
        		<div class="col-xs-8 col-sm-6 col-sm-offset-2 pay_0"><p><?php the_field('рассрочка:_с_кем_сотрудничаем'); ?></p></div>
        		<div class="col-xs-4 col-sm-4 pay_0"><img src="<?php the_field('сервис_оплаты'); ?>" class="pay_sys center-block"></div>  
        	</div><!--/.row-->
        	<div class="row">                
            	<div class="col-sm-8 col-sm-offset-2">
                	<div class="marTop40"><p><?php the_field('описание_сервиса_он-лайн_оплаты'); ?></p></div>
                </div>     
        	</div><!--/.row-->
        	<div class="row">                
            	<div class="col-sm-8 col-sm-offset-2">
            		<h3 class="h3 fs20">Схема работы:</h3>
            		<div class="pay_1"><div><p><?php the_field('схема_работы:_текст-1'); ?></p></div></div>
            		<div class="pay_2"><div><p><?php the_field('схема_работы:_текст-2'); ?></p></div></div>
            		<div class="pay_3"><div><p><?php the_field('схема_работы:_текст-3'); ?></p></div></div>
            		<div class="pay_4"><div><p><?php the_field('схема_работы:_текст-4'); ?></p></div></div>
            		<div class="pay_5"><div><p><?php the_field('схема_работы:_текст-5'); ?></p></div></div>
                    </div>
            </div><!--/.row-->
            
            <div class="row">
            	<div class="col-sm-8 col-sm-offset-2 text-center marTop50"><p><?php the_field('рассрочка_текст_при_положительном_решении'); ?></p></div>
            </div><!--/.row-->        
    
</article><!--/#post-##-->
