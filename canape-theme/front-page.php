<?php
/**
 * The front page template file.
 *
 * If the user has selected a static page for their homepage, this is what will
 * appear. Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 * @package Canape
 */

if ('posts' == get_option('show_on_front')) :

    get_template_part('index');

else :

    ?>

    <?php get_header(); ?>

    <?php while (have_posts()) : the_post(); ?>

    <div id="primary" class="content-area front-page-content-area">
    <?php if (has_post_thumbnail()) : ?>
        <div class="hero" id="hero"
             style="background-image: url( '<?php echo esc_url(wp_get_attachment_image_src(get_post_thumbnail_id($post->ID), 'full')[0]); ?>' );">
            <?php the_post_thumbnail('canape-hero-thumbnail'); ?>
        </div>
    <?php endif; ?>

    <div class="hero-container-outer">
    <div class="hero-container-inner">
    <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
        <header class="entry-header">
            <?php the_title('<h1 class="entry-title">', '</h1>'); ?>
        </header>
        <!-- .entry-header -->

        <div class="entry-content">
            <?php the_content(); ?>
        </div>
        <!-- .entry-content -->
        <?php edit_post_link(__('Edit', 'canape'), '<footer class="entry-meta"><span class="edit-link">', '</span></footer>'); ?>
    </article>
    <!-- #post-## -->

    <!-- start dabe gallery -->

    <h2 class="gallery-caption">???? ????</h2>
    <div class="gallery-container">
    <table class="table dish-gallery-table">
        <tbody>
        <tr>
            <td class="preview-container">
                <?php $loop = new WP_Query(array('post_type' => 'nova_menu_item'));
                if (post_type_exists('nova_menu_item') && $loop->have_posts()) :
                    while ($loop->have_posts()) : $loop->the_post();?>

                        <?php if ('' != get_the_content()) : ?>
                            <div class="entry-content preview-item" id="post-<?php the_ID(); ?>">
                                <?php the_content(); ?>
                            </div><!-- .entry-content -->
                        <?php endif; ?>

                    <?php endwhile; // end of the Menu Item Loop
                    wp_reset_postdata();
                endif;?>

            </td>
            <td id="gallery-container"></td>
        </tr>
        <!--  <tr>
              <td>Jacob</td>
              <td>Thornton</td>
          </tr>-->
        </tbody>
    </table></div>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.2/jquery.min.js"></script>
    <script>
        $(document).ready(function () {
            $(".preview-item").mouseover(function () {
                updateGallery(this);
            });
        });

        function updateGallery(activeElement) {
            var gallery = $("#gallery-container");
            var idForInsert = $(activeElement).attr("id");
            var loadedId = gallery.attr("attr-id");
            if (loadedId != idForInsert) {
                gallery.attr("attr-id", idForInsert);
                loadItemToGallery(gallery, $(activeElement));
            }
        }

        function loadItemToGallery(target, itemForInsert) {
            var insertedItem = itemForInsert.clone();
            $('img', insertedItem).attr("width", "auto").attr("height", "auto");
            target.children().remove();
            target.append(insertedItem);
        }
    </script>
    <style>
        .gallery-container {
            padding: 5px;
            border: 2px solid #ece8e0;
        }

        .preview-container {
            width: 210px;
            padding: 0;
        }

        .dish-gallery-table {
            margin-left: auto;
            margin-right: auto;
            border-top: none;
        }

        .dish-gallery-table p {
            margin-bottom: 0;
        }

        .dish-gallery-table td{
            border-bottom: none;
        }

        .preview-container .preview-item-caption {
            position: relative;
            top: -4ex;
            line-height: 1;
            color: white;
            text-shadow: 1px 1px 2px black, 0 0 1em black;
            text-align: center;
            padding-left: 2px;
            padding-right: 2px;
        }

        .preview-item {
            margin-bottom: 5px;
        }

        .preview-container .preview-item {

            height: 140px;
        }

        .preview-container .dish-info {
            display: none;
        }

        #gallery-container {
            padding-top: 0;
            padding-bottom: 0;
        }

        #gallery-container .preview-item-caption, .gallery-caption {
            text-align: center;
            font-size: 32px;
            font-size: 3.2rem;
            line-height: 1.75;
            clear: both;
            font-family: 'Playfair Display', sans-serif;
            font-weight: 400;
            margin: 0;
            margin-bottom: .8750em;
        }

        .gallery-caption{
            margin: 30px 0 0;
        }

    </style>
    <script>
        $(".menu-group-header").remove();
        updateGallery($(".preview-item").first());
        $('.preview-item p:not(:has(img))').addClass("preview-item-caption");
    </script>
    <!-- end dabe gallery -->


    <!-- start dabe form -->
    <article id="order-block"
             class="nova_menu_item type-nova_menu_item status-publish hentry language-ru nova_menu-vegetarian-menu has-post-thumbnail-prev">
        <div>
            <form id="order-form">
                <h3>??????? ?????</h3>
                <input name="DATA[NAME]" type="text" placeholder="???*" required/>
                <input id="client-phone" name="DATA[PHONE]" type="text" placeholder="???????*" required/>

                <p>

                <div id="person-drop-box">????? ??? <select name="DATA[TITLE]">
                        <option value="1-person" selected="selected">1 ????????</option>
                        <option value="2-person"> 2 ???????</option>
                        <option value="3-person"> 3 ???????</option>
                        <option value="4-person"> 4 ???????</option>
                        <option value="6-person"> 6 ???????</option>
                    </select></div>
                </p>
                <textarea name="DATA[COMMENTS]" placeholder="???????????"></textarea>
                <input style="width: auto;" type="submit" value="??????? ?????"/></form>
        </div>
    </article>
    <style>
        #order-block {
            border: 2px solid #eee;
            background: #f9f5ed;
        }

        #order-block p {
            margin-bottom: 0;
        }

        #order-form {
            min-width: 300px;
            max-width: 700px;
            margin-left: auto;
            margin-right: auto;
            text-align: center;
        }

        #order-form h3 {
            text-align: center;
            margin: 10px;
        }

        #order-form input, #order-form textarea, #person-drop-box {
            margin: 5px;
            width: 100%;
        }

        #person-drop-box {
            border: 2px solid #eee;
            border-radius: 2px;
            font-size: 14px;
            font-size: 1.4rem;
            padding: .7em;
            transition: .2s ease-in-out;
            -webkit-transition: .3s ease-in-out;
            background-color: white;
            text-align: left;
            margin-bottom: 5px;
            margin-top: 5px;
            cursor: pointer;
        }

        #person-drop-box select {
            border: none;
        }

        table.dish-info {
            margin-left: auto;
            margin-right: auto;
            border: 2px solid #eee;
            background: #f9f5ed;
        }

        .dish-info td {
            text-align: center;
        }
    </style>
    <p style="display: none;">
        <script src="https://code.jquery.com/jquery-1.11.2.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.maskedinput/1.4.1/jquery.maskedinput.min.js"
                type="text/javascript"></script>
        <script>// <![CDATA[
            $("#order-form").submit(function () {
                $.ajax({ type: "POST", url: "/engine/rest.php", data: $(this).serialize() }).done(function () {
                    console.log("DONE");
                    alert("??????? ?? ??? ?????!");
                });
                return false;
            });
            $(window).load(function () {
                $("#client-phone").mask("+7 (999) 999-99-99", {placeholder: "_"});
            });
            // ]]></script>
    </p>

    <!-- end dabe form -->

    </div>
    </div>

    </div><!-- #primary -->
<?php endwhile; ?>

    <?php get_template_part('template-parts/content', 'front-menu'); ?>







    <?php
    if (1 == get_theme_mod('canape_front_testimonials', 1)) {
        get_template_part('template-parts/content', 'front-testimonial');
    }
    ?>

    <?php get_sidebar('front-page'); ?>

<?php endif; ?>

<?php get_footer(); ?>
