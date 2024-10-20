<?php
if (!defined('ABSPATH')) {die;} // Cannot access directly.
/**

/
 * 作者唯一QQ：200933220 （油条）



 */

/**
 * the theme
 */

function cao_body_classes($classes) {

    $dark_session = (!empty($_SESSION['is_ripro_dark'])) ? true : false;
    $this_dark    = (_cao('is_ripro_dark')) ? 'ripro-dark' : '';
    if ($dark_session) {
        $this_dark = 'ripro-dark';
    }
    $classes[] = $this_dark;
    if (_cao('is_site_max_width', '0')) {
        $classes[] = 'max_width';
    }
    if (!is_singular()) {
        $classes[] = 'hfeed';
    }

    if (is_home()) {
        $classes[] = 'modular-title-2';
    }
    $navbar_style = _cao('navbar_style', 'sticky');
    if (is_singular('post') || is_page()) {
        $navbar_style = cao_compare_options($navbar_style, rwmb_meta('navbar_style'));
    }
    $classes[] = 'navbar-' . $navbar_style;

    if (_cao('navbar_full', false) == true) {
        $classes[] = 'navbar-full';
    }

    if (_cao('navbar_slide', false) == true) {
        $classes[] = 'navbar-slide';
    }

    if (cao_compare_options(_cao('navbar_hidden', false), rwmb_meta('navbar_hidden')) == true) {
        $classes[] = 'navbar-hidden';
    }

    if (_cao('disable_search', false) == true) {
        $classes[] = 'no-search';
    }

    $classes[] = 'sidebar-' . cao_sidebar();

    if (cao_show_hero()) {
        $classes[] = 'with-hero';

        if (is_home()) {
            $classes[] = 'hero-' . _cao('hero_home_style', 'none');
            $classes[] = 'hero-' . _cao('hero_home_content', 'image');
        } elseif (is_singular('post') || is_page()) {
            $classes[] = 'hero-' . cao_compare_options(_cao('hero_single_style', 'none'), rwmb_meta('hero_single_style'));
            $classes[] = get_post_format() ? 'hero-' . get_post_format() : 'hero-image';
        }
    }

    $classes[] = 'pagination-' . _cao('pagination', 'infinite_button');

    if (get_previous_posts_link()) {
        $classes[] = 'paged-previous';
    }

    if (get_next_posts_link()) {
        $classes[] = 'paged-next';
    }

    if ((is_singular('post') || is_page()) && rwmb_meta('cao_subheading') != '') {
        $classes[] = 'with-subheading';
    }

    if (!is_active_sidebar('off_canvas')) {
        $classes[] = 'no-off-canvas';
    }
    return $classes;
}
add_filter('body_class', 'cao_body_classes');


/**
 * [cao_entry_header 文章标题 meta统一调用]
 * @Author   Dadong2g
 * @DateTime 2021-01-12T10:30:58+0800
 * @param    array                    $options [description]
 * @return   [type]                            [description]
 */
function cao_entry_header( $options = array() ) {
  $options = array_merge( array( 'outside_loop' => false, 'container' => 'header', 'tag' => 'h2', 'link' => true, 'white' => false, 'author' => false, 'category' => false, 'date' => false, 'comment' => false, 'like' => false, 'edit' => false ), $options );
  $queried_object = get_queried_object();
  $post_id = $options['outside_loop'] ? $queried_object->ID : get_the_ID();
  $categories = get_the_category( $post_id ); ?>

  <?php echo '<' . $options['container'] . ' class="entry-header' . esc_attr( $options['white'] ? ' white' : '' ) . '">'; ?>
    <?php if ( $options['author'] || $options['category'] || $options['date'] || $options['comment'] || $options['like'] ) : ?>
      <div class="entry-meta">
        <?php if ( $options['author'] ) :
          $author_id = get_post_field( 'post_author', $post_id ); ?>
          <span class="meta-author">
            <a>
              <?php
                echo get_avatar( get_the_author_meta( 'email', $author_id ), '40', null, get_the_author_meta( 'display_name', $author_id ) );
                echo get_the_author_meta( 'display_name', $author_id );
              ?>
            </a>
          </span>
        <?php endif;

        if ( $categories && $options['category'] ) : ?>
          <span class="meta-category">
            <?php foreach ( $categories as $key=>$category ) :
              if ($key == 3) {break;}
            ?>
              <a<?php echo _target_blank();?> href="<?php echo esc_url( get_category_link( $category->term_id ) ); ?>" rel="category">
                  <i class="dot"></i><?php echo esc_html( $category->name ); ?>
              </a>
            <?php endforeach; ?>
          </span>
        <?php endif;

        if ( $options['date'] ) : ?>

        <?php endif;
        
        if ( $options['comment'] && ! post_password_required( $post_id ) && ( comments_open( $post_id ) || get_comments_number( $post_id ) ) ) : ?>
          <span class="meta-comment">
            <a<?php echo _target_blank();?> href="<?php echo esc_url( get_the_permalink( $post_id ) . '#comments' ); ?>">
              <?php printf( _n( '%s 评论', '%s 评论', esc_html( get_comments_number( $post_id ) ), 'cao' ), esc_html( number_format_i18n( get_comments_number( $post_id ) ) ) ); ?>
            </a>
          </span>
        <?php endif;

        if ($options['edit']) : ?>
            <span class="meta-edit"><?php edit_post_link('[编辑]'); ?></span>
        <?php endif;?>

      </div>
    <?php endif; ?>

    <?php
      if ( $options['link'] ) {
        echo '<' . $options['tag'] . ' class="entry-title"><a'. _target_blank() .' href="' . esc_url( get_permalink( $post_id ) ) . '" title="'.get_the_title( $post_id ).'" rel="bookmark">' . get_the_title( $post_id ) . '</a></' . $options['tag'] . '>';
      } else {
        echo '<' . $options['tag'] . ' class="entry-title">' . get_the_title( $post_id ) . '</' . $options['tag'] . '>';
      }
    ?>
  <?php echo '</' . $options['container'] . '>';
}



//缩略图比例
if (!function_exists('cao_thumbnail_ratio')):
    function cao_thumbnail_ratio() {
        // $thumbnail = wp_get_attachment_image_src( get_post_thumbnail_id(), $image_size );
        $thumbnail = _cao('thumbnail-px');
        if ($thumbnail['width'] && $thumbnail['height']) {
            return $thumbnail['height'] / $thumbnail['width'] * 100 . '%';
        } else {
            return 200 / 300 * 100 . '%';
        }
    }
endif;


// 获取图片高度 显示img标签
if (!function_exists('cao_entry_media')):
    function cao_entry_media() {
        global $post;
        $ratio = cao_thumbnail_ratio(); ?>
      <div class="entry-media">
        <div class="placeholder" style="padding-bottom: <?php echo esc_attr($ratio); ?>;">
          <a<?php echo _target_blank(); ?>  href="<?php echo esc_url(get_permalink()); ?>">
            <img class="lazyload" data-src="<?php echo esc_url(_get_post_timthumb_src()); ?>" src="data:image/gif;base64,R0lGODlhAQABAAAAACH5BAEKAAEALAAAAAABAAEAAAICTAEAOw==" alt="<?php echo get_the_title(); ?>">
          </a>
          <?php if (_cao('post_tim_rload', '0')) {?>
          <div class="cao-cover"><img src="<?php echo get_template_directory_uri(); ?>/assets/images/svg/rings.svg" width="50" height="50px"></div>
          <?php }?>
        </div>
        <?php get_template_part('parts/entry-format');?>
      </div>
      <?php

    }
endif;

/**
 * [cao_sidebar 修复默认文章无侧边栏问题]
 * @Author   Dadong2g
 * @DateTime 2021-01-12T09:51:31+0800
 * @return   [type]                   [description]
 */
function cao_sidebar() {
    if (is_singular('post') || is_page()) {
        global $post;
        $sidebar = get_post_meta($post->ID, 'post_style', true);
        if ($sidebar == 'no_sidebar') {
            $sidebar = 'none';
        } else {
            $sidebar = 'right';
        }
        return $sidebar;
    } else {
        return 'none';
    }

}

function cao_column_classes($sidebar) {
    $content_column_class = 'content-column col-lg-9';
    $sidebar_column_class = 'sidebar-column col-lg-3';
    if ($sidebar == 'none') {
        $content_column_class = 'col-lg-12';
    }
    return array($content_column_class, $sidebar_column_class);
}

function cao_side_thumbnail() {
    if ((is_singular('post') || is_page()) && has_post_thumbnail()) {
        $image_location = 'mixed';
        $featured_image = wp_get_attachment_image_src(get_post_thumbnail_id(get_the_ID()), 'full');

        if ((($image_location == 'mixed' && $featured_image[2] > $featured_image[1]) || $image_location == 'side') && !get_post_format()) {
            return true;
        }
    }

    return false;
}

function cao_show_hero() {

    global $post;
    if (is_singular('post') || is_page()) {
        $post_style = get_post_meta($post->ID, 'post_hero', true);
        if ($post_style) {
            return true;
        }

    }
    return false;
}

function cao_is_gif() {
    if (has_post_thumbnail()) {
        $featured_image = wp_get_attachment_image_src(get_post_thumbnail_id(get_the_ID()), 'full');
        $featured_image = $featured_image[0];

        $path_parts = pathinfo($featured_image);
        $extension  = $path_parts['extension'];

        return $extension == 'gif' ? true : false;
    }

    return false;
}

//文章图片赖加载，检测图片srcset后添加 lazyload  兼容处理 V6.3
if (!function_exists('cao_lazy_content_images')):
    function cao_lazy_content_images($content) {
        global $post;
        $_the_content = $content;
        if (is_feed() || is_preview() || (function_exists('is_mobile') && is_mobile())) {
            return $content;
        }
        if (false !== strpos($content, 'data-original')) {
            return $content;
        }
        return preg_replace_callback('/(<\s*img[^>]+)(src\s*=\s*"[^"]+")([^>]+>)/i', function ($matches) {
            $class_attr = '';
            if (!preg_match('/class\s*=\s*"/i', $matches[0])) {
                $class_attr = 'class="" ';
            }
            $replacement = $matches[1] . $class_attr . 'src="data:image/gif;base64,R0lGODlhAQABAAAAACH5BAEKAAEALAAAAAABAAEAAAICTAEAOw==" data-srcset' . substr($matches[2], 3) . $matches[3];
            $replacement = preg_replace('/class\s*=\s*"/i', 'class="lazyload ', $replacement);
            $replacement .= '<noscript>' . $matches[0] . '</noscript>';
            return $replacement;
        }, $content);
    }
    if (_cao('cao_lazy_content_images', false)) {
        add_filter('the_content', 'cao_lazy_content_images', 99);
    }

endif;

function cao_compare_options($global, $override) {
    if ($global == $override || $override == '') {
        return $global;
    } else {
        return $override;
    }
}

if (!function_exists('rwmb_meta')) {
    function rwmb_meta($key, $args = '', $post_id = null) {
        return false;
    }
}

function _the_theme_name() {
    $current_theme = wp_get_theme();
    return $current_theme->get('Name');
}

function _the_theme_version() {
    $current_theme = wp_get_theme();
    return $current_theme->get('Version');
}

function _the_theme_aurl() {
    $current_theme = wp_get_theme();
    return $current_theme->get('ThemeURI');
}

function _get_description_max_length() {
    return 200;
}

function _get_tax_meta($id = 0, $field = '') {
    $ops = get_option("_taxonomy_meta_$id");

    if (empty($ops)) {
        return '';
    }

    if (empty($field)) {
        return $ops;
    }

    return isset($ops[$field]) ? $ops[$field] : '';
}



//seo info 

function _get_delimiter() {
    return _cao('connector','-');
}
remove_action('wp_head', '_wp_render_title_tag', 1);

function _title() {

    if (_cao('del_ripro_seo', '0')) {
        return wp_title('-', true, 'right');
    }
    global $paged, $post;

    $html = '';
    $t    = trim(wp_title('', false));

    if ($t) {
        $html .= $t . _get_delimiter();
    }

    if (get_query_var('page')) {
        $html .= '第' . get_query_var('page') . '页' . _get_delimiter();
    }

    $html .= get_bloginfo('name');

    if (is_home()) {
        if ($paged > 1) {
            $html .= _get_delimiter() . '最新发布';
        } elseif (get_option('blogdescription')) {
            $html .= _get_delimiter() . get_option('blogdescription');
        }
    }

    if (is_category()) {
        global $wp_query;
        $cat_ID  = get_query_var('cat');
        $seo_str = get_term_meta($cat_ID, 'seo-title', true);
        $cat_tit = ($seo_str) ? $seo_str : _get_tax_meta($cat_ID, 'title');
        if ($cat_tit) {
            $html = $cat_tit;
        }
    } elseif (is_tag()) {
        $tagName   = single_tag_title('', false);
        $tagObject = get_term_by('name', $tagName, 'post_tag');
        $tagID     = $tagObject->term_id;
        $seo_str   = get_term_meta($tagID, 'seo-title', true);
        $html      = ($seo_str) ? trim($seo_str) : $tagName;
    } elseif (is_singular() && get_post_meta($post->ID, 'post_titie_s', true)) {
        $html = get_post_meta($post->ID, 'post_titie', true);
    }

    if ($paged > 1) {
        $html .= _get_delimiter() . '第' . $paged . '页';
    }

    return $html;
}

function _the_head() {
    _keywords();
    _description();
    _post_views_record();
    $css_str = _cao('web_css');
    if ($css_str) {
        echo '<style type="text/css">' . $css_str . '</style>';
    }
}
add_action('wp_head', '_the_head');

/**
 * [_keywords SEO关键词优化]
 * @Author   Dadong2g
 * @DateTime 2019-05-28T12:17:48+0800
 * @return   [type]                   [description]
 */
function _keywords() {
    if (_cao('del_ripro_seo', '0')) {
        return;
    }
    global $s, $post;
    $keywords = '';
    if (is_singular()) {
        if (get_the_tags($post->ID)) {
            foreach (get_the_tags($post->ID) as $tag) {
                $keywords .= $tag->name . ',';
            }

        }
        foreach (get_the_category($post->ID) as $category) {
            $keywords .= $category->cat_name . ', ';
        }

        if (get_post_meta($post->ID, 'post_keywords_s', true)) {
            $the = trim(get_post_meta($post->ID, 'keywords', true));
            if ($the) {
                $keywords = $the;
            }
        } else {
            $keywords = substr_replace($keywords, '', -2);
        }

    } elseif (is_home()) {
        $seo_opt  = _cao('seo');
        $keywords = (!empty($seo_opt['web_keywords'])) ? $seo_opt['web_keywords'] : '';
    } elseif (is_tag()) {
        $tagName   = single_tag_title('', false);
        $tagObject = get_term_by('name', $tagName, 'post_tag');
        $tagID     = $tagObject->term_id;
        $seo_str   = get_term_meta($tagID, 'seo-keywords', true);
        $keywords  = ($seo_str) ? trim($seo_str) : $tagName;
    } elseif (is_category()) {
        global $wp_query;
        $cat_ID   = get_query_var('cat');
        $seo_str  = get_term_meta($cat_ID, 'seo-keywords', true);
        $keywords = ($seo_str) ? trim($seo_str) : trim(wp_title('', false));
    } elseif (is_search()) {
        $keywords = esc_html($s, 1);
    } else {
        $keywords = trim(wp_title('', false));
    }
    if ($keywords) {
        echo "<meta name=\"keywords\" content=\"$keywords\">\n";
    }
}

/**
 * [_description SEO描述优化]
 * @Author   Dadong2g
 * @DateTime 2019-05-28T12:18:02+0800
 * @return   [type]                   [description]
 */
function _description() {
    if (_cao('del_ripro_seo', '0')) {
        return;
    }
    global $s, $post;
    $description = '';
    $blog_name   = get_bloginfo('name');
    if (is_singular()) {
        if (!empty($post->post_excerpt)) {
            $text = $post->post_excerpt;
        } else {
            $text = $post->post_content;
        }
        $description = trim(str_replace(array("\r\n", "\r", "\n", "　", " "), " ", str_replace("\"", "'", strip_tags($text))));
        $description = substr_ext(strip_tags(strip_shortcodes($description)), 0, 140, 'utf-8', '...');
        if (!($description)) {
            $description = $blog_name . "-" . trim(wp_title('', false));
        }
        if (get_post_meta($post->ID, 'post_description_s', true)) {
            $the = trim(get_post_meta($post->ID, 'description', true));
            if ($the) {
                $description = $the;
            }
        }

    } elseif (is_home()) {
        $seo_opt     = _cao('seo');
        $description = (!empty($seo_opt['web_description'])) ? $seo_opt['web_description'] : '';
    } elseif (is_tag()) {
        $tagName     = single_tag_title('', false);
        $tagObject   = get_term_by('name', $tagName, 'post_tag');
        $tagID       = $tagObject->term_id;
        $seo_str     = get_term_meta($tagID, 'seo-description', true);
        $description = ($seo_str) ? trim($seo_str) : trim(wp_title('', false));
    } elseif (is_category()) {
        global $wp_query;
        $cat_ID      = get_query_var('cat');
        $seo_str     = get_term_meta($cat_ID, 'seo-description', true);
        $description = ($seo_str) ? trim($seo_str) : trim(wp_title('', false));
    } elseif (is_archive()) {
        $description = $blog_name . "-" . trim(wp_title('', false));
    } elseif (is_search()) {
        $description = $blog_name . ": '" . esc_html($s, 1) . "' " . __('的搜索結果', 'haoui');
    } elseif (is_tag()) {

    } else {
        $description = $blog_name . "'" . trim(wp_title('', false)) . "'";
    }
    $description = mb_substr($description, 0, _get_description_max_length(), 'utf-8');
    echo "<meta name=\"description\" content=\"$description\">\n";
}

// Open Graph
function meta_og() {
    global $post;

    if (is_single()) {
        $img_src      = _get_post_thumbnail_url($post);
        $excerpt      = wp_trim_words(strip_shortcodes($post->post_content),120,'...');
        $excerpt_more = '';
        if (strlen($excerpt) > 155) {
            $excerpt      = substr($excerpt, 0, 155);
            $excerpt_more = ' ...';
        }
        $excerpt      = str_replace('"', '', $excerpt);
        $excerpt      = str_replace("'", '', $excerpt);
        $excerptwords = preg_split('/[\n\r\t ]+/', $excerpt, -1, PREG_SPLIT_NO_EMPTY);
        array_pop($excerptwords);
        $excerpt = implode(' ', $excerptwords) . $excerpt_more;
        ?>
        <meta property="og:title" content="<?php echo get_the_title(); ?>">
        <meta property="og:description" content="<?php echo $excerpt; ?>">
        <meta property="og:type" content="article">
        <meta property="og:url" content="<?php echo the_permalink(); ?>">
        <meta property="og:site_name" content="<?php echo get_bloginfo('name'); ?>">
        <meta property="og:image" content="<?php echo $img_src; ?>">
    <?php }
}

//是否开启meta_og协议
if (_cao('is_post_meta_og')) {
    add_action('wp_head', 'meta_og', 5);
}




/**
 * [cao_oauth_page_rewrite_rules OAuth登录处理页路由(/oauth)]
 * @Author   Dadong2g
 * @DateTime 2019-05-26T00:04:32+0800
 * @param    [type]                   $wp_rewrite [description]
 * @return   [type]                               [description]
 * (qq|weibo|weixin|...)
 */
function cao_oauth_page_rewrite_rules($wp_rewrite) {
    if ($ps = get_option('permalink_structure')) {
        $new_rules['oauth/([A-Za-z]+)$']          = 'index.php?oauth=$matches[1]';
        $new_rules['oauth/([A-Za-z]+)/callback$'] = 'index.php?oauth=$matches[1]&oauth_callback=1';
        $new_rules['^go'] = 'index.php?go=1';
        $wp_rewrite->rules = $new_rules + $wp_rewrite->rules;
    }
}
add_action('generate_rewrite_rules', 'cao_oauth_page_rewrite_rules');



/**
 * [cao_add_oauth_page_query_vars 自定义的Action页添加query_var白名单]
 * @Author   Dadong2g
 * @DateTime 2019-05-26T00:06:55+0800
 * @param    [type]                   $public_query_vars [description]
 * @return   [type]                                      [description]
 */
function cao_add_oauth_page_query_vars($public_query_vars) {
    if (!is_admin()) {
        $public_query_vars[] = 'oauth'; // 添加参数白名单oauth，代表是各种OAuth登录处理页
        $public_query_vars[] = 'oauth_callback'; // OAuth登录最后一步，整合WP账户，自定义用户名
        $public_query_vars[] = 'go'; //下载页跳转
        $public_query_vars[] = 'ref'; //下载页跳转
    }
    return $public_query_vars;
}
add_filter('query_vars', 'cao_add_oauth_page_query_vars');

/**
 * [cao_oauth_page_template OAuth登录处理页模板]
 * @Author   Dadong2g
 * @DateTime 2019-05-26T00:07:35+0800
 * @return   [type]                   [description]
 */
function cao_oauth_page_template() {
    $oauth          = strtolower(get_query_var('oauth')); //转换为小写
    $oauth_callback = get_query_var('oauth_callback');
    if ($oauth) {
        if (in_array($oauth, array('qq', 'qqagent', 'weixin', 'mpweixin', 'weixinagent', 'weibo', 'weiboagent'))):
            global $wp_query;
            $wp_query->is_home = false;
            $wp_query->is_page = true; //将该模板改为页面属性，而非首页
            $template          = $oauth_callback ? TEMPLATEPATH . '/inc/oauth/' . $oauth . '/callback.php' : TEMPLATEPATH . '/inc/oauth/' . $oauth . '/login.php';
            load_template($template);
            exit;
        else:
            // 非法路由处理
            unset($oauth);
            return;
        endif;
    }

    $goto = strtolower(get_query_var('go')); //转换为小写
    if ($goto==1) {
        $template = TEMPLATEPATH . '/inc/go.php';
        load_template($template);exit;
    }

    // 推荐ref
    $aff_id = get_query_var('ref');
    if (!empty($aff_id)) {
        $_SESSION['cao_from_user_id'] = absint($aff_id);
    }


}
add_action('template_redirect', 'cao_oauth_page_template', 5);


/**
 * [getQrcode 生产二维码]
 * @Author   Dadong2g
 * @DateTime 2020-09-29T19:22:06+0800
 * @param    [type]                   $url [description]
 * @return   [type]                        [description]
 */
function getQrcode($url) {
    $api_url = get_template_directory_uri() . '/inc/plugins/qrcode.php?data=';
    return $api_url . $url;
}

/*
Gravatar 自定义头像 Hook
 */
function cao_avatar_hook($avatar, $id_or_email, $size, $default, $alt, $str = 'img') {

// update_user_meta(1, 'user_avatar_type','weixin');

    $user = false;
    if (is_numeric($id_or_email)) {
        $id   = (int) $id_or_email;
        $user = get_user_by('id', $id);
    } elseif (is_object($id_or_email)) {
        if (!empty($id_or_email->user_id)) {
            $id   = (int) $id_or_email->user_id;
            $user = get_user_by('id', $id);
        }
    } else {
        $user = get_user_by('email', $id_or_email);
    }
    if ($user && is_object($user)) {

        $uid               = $user->data->ID;
        $user_email        = $user->data->user_email;
        $_qqAvatarAPI      = 'https://q.qlogo.cn/qqapp/';
        $_gravatarAPI      = 'https://cn.gravatar.com/avatar/';
        $_user_avatar_type = (get_user_meta($uid, 'user_avatar_type', true));

        // 判断头像类型
        switch ($_user_avatar_type) {
        case 'gravatar':
            $user_custom_avatar = get_user_meta($uid, 'user_custom_avatar', true);
            $avatar_url         = ($user_custom_avatar) ? $user_custom_avatar : _the_theme_avatar();
            break;
        case 'qq':
            $qqConfig   = _cao('oauth_qq');
            $avatar_url = $_qqAvatarAPI . $qqConfig['appid'] . '/' . get_user_meta($uid, 'open_qq_openid', true) . '/100';
            // $avatar_url = set_url_scheme(get_user_meta($uid, 'open_qq_avatar', true ));
            break;
        case 'weibo':
            $avatar_url = set_url_scheme(get_user_meta($uid, 'open_weibo_avatar', true));
            break;
        case 'weixin':
            $avatar_url = set_url_scheme(get_user_meta($uid, 'open_weixin_avatar', true));
            break;
        case 'custom':
            $avatar_url = set_url_scheme(get_user_meta($uid, 'user_custom_avatar', true));
        default:
            $avatar_url = _the_theme_avatar();
        }
        if ($str == 'img') {
            if (is_admin()) {
                $avatar = "<img alt='{$alt}' src='{$avatar_url}' class='avatar avatar-{$size} photo {$_user_avatar_type}' height='{$size}' width='{$size}' />";
            } else {
                $avatar = "<img alt='{$alt}' data-src='{$avatar_url}' class='lazyload avatar avatar-{$size} photo {$_user_avatar_type}' height='{$size}' width='{$size}' />";
            }

        } else {
            $avatar = $avatar_url;
        }

    }

    return $avatar;
}
add_filter('get_avatar', 'cao_avatar_hook', 1, 5);

function _the_theme_avatar() {
    return get_template_directory_uri() . '/assets/images/avatar/1.png';
}

function _is_bind_openid($type = 'qq') {
    global $current_user;
    $uid   = $current_user->ID;
    $_bind = (int) get_user_meta($uid, 'open_' . $type . '_bind', true);
    return ($_bind) ? true : false;
}

//社交登录按钮
function _the_open_oauth_login_btn() {
    if (_cao('is_oauth_qq') || _cao('is_oauth_weixin') || _cao('is_oauth_mpweixin') || _cao('is_oauth_weibo')) {
        $oauthArr = array('qq', 'weixin', 'mpweixin', 'weibo');
        echo '<div class="open-oauth  text-center">';
        $rurl = home_url(add_query_arg(array()));
        foreach ($oauthArr as $value) {
            if (_cao('is_oauth_' . $value)) {
                if ($value == 'mpweixin') {
                    echo '<a href="' . esc_url(home_url('/oauth/mpweixin')) . '" class="go-mpweixin btn btn-' . $value . '"><i class="fa fa-weixin"></i></a>';
                } else {
                    echo '<a href="' . esc_url(home_url('/oauth/' . $value . '?rurl=' . $rurl)) . '" class="btn btn-' . $value . '"><i class="fa fa-' . $value . '"></i></a>';
                }
            }
        }
        echo '</div>';
        echo '<div class="or-text"><span>or</span></div>';
    }
}
//获取用户社交登录按钮
function _the_open_oauth_btn() {
    $oauthArr = array('qq', 'weixin', 'mpweixin', 'weibo');
    foreach ($oauthArr as $value) {
        switch ($value) {
        case 'qq':
            $opname = 'QQ';
            $fa     = 'qq';
            break;
        case 'weixin':
            $opname = '微信';
            $fa     = 'weixin';
            break;
        case 'mpweixin':
            $opname = '公众号';
            $fa     = 'weixin';
            break;
        case 'weibo':
            $opname = '微博';
            $fa     = 'weibo';
            break;
        }
        if (_cao('is_oauth_' . $value)) {
            if (_is_bind_openid($value)) {
                echo '<a href="javascript: void(0);" title="' . $opname . '登录" class="btn unset-bind" data-id="' . $value . '"><i class="fa fa-' . $fa . '"></i> 解绑' . $opname . '</a>';
            } else {
                if ($value == 'mpweixin') {
                    echo '<a href="' . esc_url(home_url('/oauth/mpweixin')) . '" title="' . $opname . '登录" class="bind-mpweixin btn"><i class="fa fa-' . $fa . '"></i> 绑定' . $opname . '</a>';
                } else {
                    echo '<a href="' . esc_url(home_url('/oauth/' . $value)) . '" title="' . $opname . '登录" class="btn"><i class="fa fa-' . $fa . '"></i> 绑定' . $opname . '</a>';
                }

            }
        }
    }
}
//获取用户头像地址 根据类型
function _get_user_avatar_url($type = 'gravatar', $user_id = 0) {
    if ($user_id > 0) {
        $uid = $user_id;
    } else {
        global $current_user;
        $uid = $current_user->ID;
    }

    $user              = get_user_by('id', $uid);
    $user_email        = $user->data->user_email;
    $_user_avatar_type = (get_user_meta($uid, 'user_avatar_type', true));

    if ($type == 'user') {
        $this_type = $_user_avatar_type;
    } else {
        $this_type = $type;
    }

    $_qqAvatarAPI = 'https://q.qlogo.cn/qqapp/';
    $_gravatarAPI = 'https://cn.gravatar.com/avatar/';

    // 判断头像类型
    switch ($this_type) {
    case 'gravatar':
        $user_custom_avatar = get_user_meta($uid, 'user_custom_avatar', true);
        $avatar_url         = ($user_custom_avatar) ? $user_custom_avatar : _the_theme_avatar();
        break;
    case 'qq':
        $qqConfig   = _cao('oauth_qq');
        $avatar_url = $_qqAvatarAPI . $qqConfig['appid'] . '/' . get_user_meta($uid, 'open_qq_openid', true) . '/100';
        break;
    case 'weibo':
        $avatar_url = set_url_scheme(get_user_meta($uid, 'open_weibo_avatar', true));
        break;
    case 'weixin':
        $avatar_url = set_url_scheme(get_user_meta($uid, 'open_weixin_avatar', true));
        break;
    case 'custom':
        $avatar_url = set_url_scheme(get_user_meta($uid, 'user_custom_avatar', true));
    default:
        $avatar_url = _the_theme_avatar();
    }

    return $avatar_url;

}

/**
 * [_get_user_avatar 获取头像]
 * @Author   Dadong2g
 * @DateTime 2019-05-28T12:17:13+0800
 * @param    string                   $user_email [description]
 * @param    boolean                  $src        [description]
 * @param    integer                  $size       [description]
 * @return   [type]                               [description]
 */
function _get_user_avatar($user_email = '', $src = false, $size = 50) {
    global $current_user;
    if (!$user_email) {
        $user_email = $current_user->user_email;
    }

    $avatar = get_avatar($user_email, $size);
    if ($src) {
        return $avatar;
    } else {
        return $avatar;
    }

}

// 文章是否下载资源文章
function _get_post_shop_status() {
    global $post;
    $post_ID = $post->ID;
    if (get_post_meta($post_ID, 'cao_status', true)) {
        return true;
    }
    return false;
}

//检测文章是否付费查看内容
function _get_post_shop_hide() {
    global $post;
    if (has_shortcode($post->post_content, 'rihide')) {
        return true;
    }
    return false;
}

//检测文章是否付费观看内容
function _get_post_video_status() {
    global $post;
    $post_ID = $post->ID;
    if (get_post_meta($post_ID, 'cao_video', true)) {
        return true;
    }
    return false;
}

//检测文章是否有设置视频
function _get_post_video_url() {
    global $post;
    $video_url = get_post_meta($post->ID, 'video_url', true);
    if ($video_url != '') {
        return $video_url;
    }
    return false;
}

//文章资源价格
function _get_post_price() {
    global $post;
    $post_ID  = $post->ID;
    $price    = get_post_meta($post_ID, 'cao_price', true);
    $priceVal = ($price) ? $price : '0';
    // $after = _cao('site_money_ua');
    return $priceVal;
}

//文章分类信息
function _get_post_cat() {
    global $post;
    $post_ID   = $post->ID;
    $category  = get_the_category($post->ID);
    $cat_neme  = $category[0]->cat_name;
    $cat_links = get_category_link($category[0]->cat_ID);
    return '<a href="' . $cat_links . '">' . $cat_neme . '</a>';
}

/**
 * post 文章阅读次数
 */
function _post_views_record() {
    if (is_singular()) {
        global $post;
        $post_ID = $post->ID;
        if ($post_ID) {
            $post_views = (int) get_post_meta($post_ID, 'views', true);
            if (!update_post_meta($post_ID, 'views', ($post_views + 1))) {
                add_post_meta($post_ID, 'views', 1, true);
            }
        }
    }
}

function _get_post_views($before = '', $after = '') {
    global $post;
    $post_ID = $post->ID;
    $views   = (int) get_post_meta($post_ID, 'views', true);
    if ($views >= 1000) {
        $views = round($views / 1000, 2) . 'K';
    }
    return $before . $views . $after;
}

/**
 * [_set_postthumbnail 自动设置文章缩略图]
 * @Author   Dadong2g
 * @DateTime 2019-05-28T12:27:23+0800
 */
if (_cao('set_postthumbnail') && !function_exists('_set_postthumbnail')):
    function _set_postthumbnail() {
        global $post;
        if (empty($post)) {
            return;
        }

        $already_has_thumb = has_post_thumbnail($post->ID);
        if (!$already_has_thumb) {
            $attached_image = get_children("post_parent=$post->ID&post_type=attachment&post_mime_type=image&numberposts=1");
            if ($attached_image) {
                foreach ($attached_image as $attachment_id => $attachment) {
                    set_post_thumbnail($post->ID, $attachment_id);
                }
            }
        }
    }

    // add_action('the_post', '_set_postthumbnail');
    add_action('save_post', '_set_postthumbnail');
    add_action('draft_to_publish', '_set_postthumbnail');
    add_action('new_to_publish', '_set_postthumbnail');
    add_action('pending_to_publish', '_set_postthumbnail');
    add_action('future_to_publish', '_set_postthumbnail');
endif;

/**
 * [_the_theme_thumb 默认缩略图]
 * @Author   Dadong2g
 * @DateTime 2019-05-29T10:35:28+0800
 * @return   [type]                   [description]
 */
function _the_theme_thumb() {
    return _cao('post_default_thumb')['url'] ? _cao('post_default_thumb')['url'] : get_template_directory_uri() . '/assets/images/thumb/1.jpg';
    $rand = mt_rand(1, 10);
    return get_template_directory_uri() . '/assets/images/thumb/' . $rand . '.jpg';
}

function _the_theme_thumb_full() {
    return get_template_directory_uri() . '/assets/images/thumb/full.jpg';
}

function _the_loader_img() {
    return get_template_directory_uri() . '/assets/images/loader/preloader.gif';
}

/**
 * [_get_post_thumbnail_url 输出缩略图地址]
 * @Author   Dadong2g
 * @DateTime 2019-05-28T12:16:30+0800
 * @param    [type]                   $post [post]
 * @return   [type]                         [description]
 */
if (!function_exists('_get_post_thumbnail_url')):
    function _get_post_thumbnail_url($post = null, $size = null) {
        if ($post === null) {
            global $post;
        }
        if (is_numeric($post)) {
            $post = get_post($post);
        }

        if (empty($post)) {
            return _the_theme_thumb();
        }

        //获取默认缩略图大小设置
        $thumbnail_def_get_size = ($size) ? $size : _cao('thumbnail_def_get_size', 'full') ;

        // cao_is_gif()
        if (has_post_thumbnail($post)) {
            //如果有特色缩略图，则输出缩略图地址
            $image              = wp_get_attachment_image_src(get_post_thumbnail_id($post->ID), $thumbnail_def_get_size);
            $post_thumbnail_src = $image[0];
        } else {
            $post_thumbnail_src = '';
            @$output            = preg_match_all('/<img.+src=[\'"]([^\'"]+)[\'"].*>/i', $post->post_content, $matches);
            if (!empty($matches[1][0])) {
                global $wpdb;
                $att = $wpdb->get_row($wpdb->prepare("SELECT ID FROM $wpdb->posts WHERE guid LIKE '%s'", $matches[1][0]));
                if ($att) {
                    $post_thumbnail_src = $att->ID;
                } else {
                    $post_thumbnail_src = $matches[1][0];
                }
            } else {
                $post_thumbnail_src = _the_theme_thumb();
            }
        }
        return $post_thumbnail_src;
    }
endif;
/**
 * [timthumb 图像裁切]
 * @Author   Dadong2g
 * @DateTime 2019-05-28T12:16:48+0800
 * @param    [type]                   $src  [description]
 * @param    [type]                   $size [description]
 * @param    [type]                   $set  [description]
 * @return   [type]                         [description]
 */
if (!function_exists('timthumb')):
    function timthumb($src, $size = null, $set = null) {
        if (cao_is_gif()) {
            return $src;
        }
        $modular = _cao('thumbnail_handle');
        if (is_numeric($src)) {
            if ($modular == 'timthumb_mi') {
                $src = image_downsize($src, 'thumbnail');
            } else {
                $src = image_downsize($src, 'full');
            }
            $src = $src[0];
        }
        if ($set == 'original') {
            return $src;
        }
        if ($modular == 'timthumb_php' || empty($modular) || $set == 'tim') {
            return get_template_directory_uri() . '/timthumb.php?src=' . $src . '&h=' . $size["h"] . '&w=' . $size['w'] . '&zc=1&a=c&q=100&s=1';
        } elseif ($modular == 'other') {
        $thumbnail_other = _cao('thumbnail_other', '');
        return $src . $thumbnail_other;
    } else {
        return $src;
    }
}
endif;

/**
 * [_get_post_thumbnail 获取缩略图代码]
 * @Author   Dadong2g
 * @DateTime 2019-05-28T12:16:54+0800
 * @return   [type]                   [description]
 */
if (!function_exists('_get_post_timthumb_src')):
    function _get_post_timthumb_src() {
        $thum_px = _cao('thumbnail-px');
        $img_w   = ($thum_px) ? $thum_px['width'] : '300';
        $img_h   = ($thum_px) ? $thum_px['height'] : '200';
        $src     = timthumb(_get_post_thumbnail_url(), array('w' => $img_w, 'h' => $img_h));
        return $src;
    }
endif;

/**
 * [_str_cut description]
 * @Author   Dadong2g
 * @DateTime 2019-05-28T12:15:45+0800
 * @param    [type]                   $str        [description]
 * @param    [type]                   $start      [description]
 * @param    [type]                   $width      [description]
 * @param    [type]                   $trimmarker [description]
 * @return   [type]                               [description]
 */
function _str_cut($str, $start, $width, $trimmarker) {
    $output = preg_replace('/^(?:[\x00-\x7F]|[\xC0-\xFF][\x80-\xBF]+){0,' . $start . '}((?:[\x00-\x7F]|[\xC0-\xFF][\x80-\xBF]+){0,' . $width . '}).*/s', '\1', $str);
    return $output . $trimmarker;
}

// 分享文字处理

function substr_ext($str, $start = 0, $length, $charset = 'utf-8', $suffix = '') {
    if (function_exists('mb_substr')) {
        return mb_substr($str, $start, $length, $charset) . $suffix;
    }
    if (function_exists('iconv_substr')) {
        return iconv_substr($str, $start, $length, $charset) . $suffix;
    }
    $re['utf-8']  = '/[-]|[?-?][?-?]|[?-?][?-?]{2}|[?-?][?-?]{3}/';
    $re['gb2312'] = '/[-]|[?-?][?-?]/';
    $re['gbk']    = '/[-]|[?-?][@-?]/';
    $re['big5']   = '/[-]|[?-?]([@-~]|?-?])/';
    preg_match_all($re[$charset], $str, $match);
    $slice = join('', array_slice($match[0], $start, $length));
    return $slice . $suffix;
}

function mi_str_encode($string) {
    return $string;
    $len = strlen($string);
    $buf = '';
    $i   = 0;
    while ($i < $len) {
        if (ord($string[$i]) <= 127) {
            $buf .= $string[$i];
        } elseif (ord($string[$i]) < 192) {
            $buf .= '&#xfffd;';
        } elseif (ord($string[$i]) < 224) {
            $buf .= sprintf('&#%d;', ord($string[$i + 0]) + ord($string[$i + 1]));
            $i = $i + 1;
            $i += 1;
        } elseif (ord($string[$i]) < 240) {
            ord($string[$i + 2]);
            $buf .= sprintf('&#%d;', ord($string[$i + 0]) + ord($string[$i + 1]) + ord($string[$i + 2]));
            $i = $i + 2;
            $i += 2;
        } else {
            ord($string[$i + 2]);
            ord($string[$i + 3]);
            $buf .= sprintf('&#%d;', ord($string[$i + 0]) + ord($string[$i + 1]) + ord($string[$i + 2]) + ord($string[$i + 3]));
            $i = $i + 3;
            $i += 3;
        }
        $i = $i + 1;
    }
    return $buf;
}

function draw_txt_to($card, $pos, $str, $iswrite, $font_file) {
    $_str_h      = $pos['top'];
    $fontsize    = $pos['fontsize'];
    $width       = $pos['width'];
    $margin_lift = $pos['left'];
    $hang_size   = $pos['hang_size'];
    $temp_string = '';
    $tp          = 0;
    $font_color  = imagecolorallocate($card, $pos['color'][0], $pos['color'][1], $pos['color'][2]);
    $i           = 0;
    $str         = strip_tags(str_replace('&nbsp;', '', $str));
    while ($i < mb_strlen($str)) {
        $box            = imagettfbbox($fontsize, 0, $font_file, mi_str_encode($temp_string));
        $_string_length = $box[2] - $box[0];
        $temptext       = mb_substr($str, $i, 1);
        $temp           = imagettfbbox($fontsize, 0, $font_file, mi_str_encode($temptext));
        if ($_string_length + $temp[2] - $temp[0] < $width) {
            $temp_string .= mb_substr($str, $i, 1);
            if ($i == mb_strlen($str) - 1) {
                $_str_h = $_str_h + $hang_size;
                $_str_h += $hang_size;
                $tp = $tp + 1;
                if ($iswrite) {
                    imagettftext($card, $fontsize, 0, $margin_lift, $_str_h, $font_color, $font_file, mi_str_encode($temp_string));
                }
            }
        } else {
            $texts   = mb_substr($str, $i, 1);
            $isfuhao = preg_match('/[\\pP]/u', $texts) ? true : false;
            if ($isfuhao) {
                $temp_string .= $texts;
                $f  = mb_substr($str, $i + 1, 1);
                $fh = preg_match('/[\\pP]/u', $f) ? true : false;
                if ($fh) {
                    $temp_string .= $f;
                    $i = $i + 1;
                }
            } else {
                $i = $i+-1;
            }
            $tmp_str_len = mb_strlen($temp_string);
            $s           = mb_substr($temp_string, $tmp_str_len - 1, 1);
            if (is_firstfuhao($s)) {
                $temp_string = rtrim($temp_string, $s);
                $i           = $i+-1;
            }
            $_str_h = $_str_h + $hang_size;
            $_str_h += $hang_size;
            $tp = $tp + 1;
            if ($iswrite) {
                imagettftext($card, $fontsize, 0, $margin_lift, $_str_h, $font_color, $font_file, mi_str_encode($temp_string));
            }
            $temp_string = '';
        }
        $i = $i + 1;
    }
    return $tp * $hang_size;
}

function is_firstfuhao($str) {
    $fuhaos = array('0' => '"', '1' => '“', '2' => '\'', '3' => '<', '4' => '《');
    return in_array($str, $fuhaos);
}


// 分享文字处理END

function _excerpt_length($length) {
    return _cao('_site_excerpt_length', '42');
}
add_filter('excerpt_length', '_excerpt_length');

/**
 * [_get_excerpt 截取文章摘要]
 * @Author   Dadong2g
 * @DateTime 2019-05-28T12:15:48+0800
 * @param    integer                  $limit [长度]
 * @param    string                   $after [description]
 * @return   [type]                          [description]
 */
function _get_excerpt($limit = 40, $after = '...') {
    $excerpt = get_the_excerpt();
    $limit   = _cao('_site_excerpt_length', '42');
    if (mb_strlen($excerpt) > $limit) {
        return _str_cut(strip_tags($excerpt), 0, $limit, $after);
    } else {
        return $excerpt;
    }
}

/**
 * [_get_category_tags 获取文章标签 10条]
 * @Author   Dadong2g
 * @DateTime 2019-05-28T12:20:43+0800
 * @param    [type]                   $args [description]
 * @return   [type]                         [description]
 */
function _get_category_tags($args) {
    if (empty($args['categories'])) {
        return false;
    }
    global $wpdb;

    $tags_num = (int)_cao('filter_item_tags_num',10);
    $tags = $wpdb->get_results
        ("
        SELECT DISTINCT terms2.term_id as tag_id, terms2.name as tag_name
        FROM
            $wpdb->posts as p1
            LEFT JOIN $wpdb->term_relationships as r1 ON p1.ID = r1.object_ID
            LEFT JOIN $wpdb->term_taxonomy as t1 ON r1.term_taxonomy_id = t1.term_taxonomy_id
            LEFT JOIN $wpdb->terms as terms1 ON t1.term_id = terms1.term_id,

            $wpdb->posts as p2
            LEFT JOIN $wpdb->term_relationships as r2 ON p2.ID = r2.object_ID
            LEFT JOIN $wpdb->term_taxonomy as t2 ON r2.term_taxonomy_id = t2.term_taxonomy_id
            LEFT JOIN $wpdb->terms as terms2 ON t2.term_id = terms2.term_id
        WHERE
            t1.taxonomy = 'category' AND p1.post_status = 'publish' AND terms1.term_id IN (" . $args['categories'] . ") AND
            t2.taxonomy = 'post_tag' AND p2.post_status = 'publish'
            AND p1.ID = p2.ID
        ORDER by tag_name LIMIT {$tags_num}
    ");
    $count = 0;

    if (!empty($tags)) {
        foreach ($tags as $tag) {
            $mytag[$count] = get_term_by('id', $tag->tag_id, 'post_tag');
            $count++;
        }
    } else {
        $mytag = null;
    }

    return $mytag;
}

/**
 * [_get_post_comments 文章评论]
 * @Author   Dadong2g
 * @DateTime 2019-05-28T12:20:33+0800
 * @param    string                   $before [description]
 * @param    string                   $after  [description]
 * @return   [type]                           [description]
 */
function _get_post_comments($before = '<i class="fa fa-comments-o"></i> ', $after = '') {
    return $before . get_comments_number('0', '1', '%') . $after;
}

/**
 * [_get_post_time 文章时间]
 * @Author   Dadong2g
 * @DateTime 2019-05-28T12:18:48+0800
 * @return   [type]                   [description]
 */
function _get_post_time() {
    if (_cao('post_is_timeago', '1')) {
        return sprintf( __( '%s前','rizhuti-v2' ), human_time_diff( get_the_time( 'U' ), current_time( 'timestamp' ) ) );
    }
    return get_the_date('Y-m-d');
}


function cao_comment($comment, $args, $depth) {
    $GLOBALS['comment'] = $comment;

    if ('pingback' == $comment->comment_type || 'trackback' == $comment->comment_type): ?>

  <li id="comment-<?php comment_ID();?>" <?php comment_class();?>>
    <div class="comment-body">
      <?php esc_html_e('Pingback:', 'cao');?> <?php comment_author_link();?> <?php edit_comment_link(esc_html__('编辑', 'cao'), '<span class="edit-link">', '</span>');?>
    </div>

  <?php else: ?>

  <li id="comment-<?php comment_ID();?>" <?php comment_class(empty($args['has_children']) ? '' : 'parent');?>>
    <article id="div-comment-<?php comment_ID();?>" class="comment-wrapper u-clearfix" itemscope itemtype="https://schema.org/Comment">
      <div class="comment-author-avatar vcard">
        <?php echo get_avatar($comment->comment_author_email); ?>
      </div>

      <div class="comment-content">
        <div class="comment-author-name vcard" itemprop="author">
          <?php $CaoUser = new CaoUser($comment->user_id);
    if ($CaoUser->vip_status()) {
        $vip_name_class = 'fn vip';
    } else {
        $vip_name_class = 'fn';
    }
    printf('<cite class="%s"><i class="fa fa-diamond"></i> %s</cite>', $vip_name_class, $CaoUser->vip_name() . ' ' . get_comment_author_link());
    ?>
        </div>

        <div class="comment-metadata">
          <time datetime="<?php comment_time('c');?>" itemprop="datePublished">
            <?php printf(_x('%1$s at %2$s', '1: date, 2: time', 'cao'), get_comment_date(), get_comment_time());?>
          </time>

          <?php edit_comment_link(esc_html__('编辑', 'cao'), ' <span class="edit-link">', '</span>');
		    comment_reply_link(array_merge($args, array(
		        'add_below' => 'div-comment',
		        'depth'     => $depth,
		        'max_depth' => $args['max_depth'],
		        'before'    => '<span class="reply-link">',
		        'after'     => '</span>',
		    )));?>
        </div>

        <div class="comment-body" itemprop="comment">
          <?php comment_text();?>
        </div>

        <?php if ('0' == $comment->comment_approved): ?>
          <p class="comment-awaiting-moderation"><?php esc_html_e('你的评论正在等待审核.', 'cao');?></p>
        <?php endif;?>
      </div>
    </article> <?php

    endif;
}

/**
 * [_paging 分页导航]
 * @Author   Dadong2g
 * @DateTime 2019-05-29T11:35:44+0800
 * @return   [type]                   [description]
 */
if (!function_exists('_paging')):

    function _paging() {
        global $wp_query;

        $total = $wp_query->max_num_pages;
        $big   = 999999999;

        if ($total > 1) {
            if (!$current_page = get_query_var('paged')) {
                $current_page = 1;
            }

            if (get_option('permalink_structure')) {
                $format = 'page/%#%/';
            } else {
                $format = '&paged=%#%';
            }

            echo '<div class="col-12"><div class="numeric-pagination">';
            echo paginate_links(array(
                'base'      => str_replace($big, '%#%', esc_url(get_pagenum_link($big))),
                'format'    => $format,
                'current'   => max(1, get_query_var('paged')),
                'total'     => $total,
                'mid_size'  => 3,
                'type'      => 'list',
                'prev_text' => '<i class="mdi mdi-chevron-left"></i>',
                'next_text' => '<i class="mdi mdi-chevron-right"></i>',
            ));
            echo '</div></div>';
        }
    }

endif;

/**
 * [cao_the_pagenavi 分页自定义]
 * @Author   Dadong2g
 * @DateTime 2019-06-06T09:58:21+0800
 * @param    [type]                   $total_count     [总数]
 * @param    integer                  $number_per_page [每页数量]
 * @param    integer                  $paged           [当前页数]
 * @param    [type]                   $the_url         [当前页面]
 * @return   [type]                                    [htm]
 */
function cao_the_pagenavi($total_count, $number_per_page = 15, $paged, $the_url) {

    $current_page = $paged;
    $base_url     = add_query_arg($_GET, $the_url);
    $total_pages  = ceil($total_count / $number_per_page);

    $first_page_url = $base_url . '&amp;paged=1';
    $last_page_url  = $base_url . '&amp;paged=' . $total_pages;
    if ($current_page > 1 && $current_page < $total_pages) {
        $prev_page     = $current_page - 1;
        $prev_page_url = $base_url . '&amp;paged=' . $prev_page;

        $next_page     = $current_page + 1;
        $next_page_url = $base_url . '&amp;paged=' . $next_page;
    } elseif ($current_page == 1) {
        $prev_page_url  = '#';
        $first_page_url = '#';
        if ($total_pages > 1) {
            $next_page     = $current_page + 1;
            $next_page_url = $base_url . '&amp;paged=' . $next_page;
        } else {
            $next_page_url = '#';
            $class         = 'class="disabled"';
        }
    } elseif ($current_page == $total_pages) {
        $prev_page     = $current_page - 1;
        $prev_page_url = $base_url . '&amp;paged=' . $prev_page;
        $next_page_url = '#';
        $last_page_url = '#';
    }
    ?>
    <div class="cao-pagination pagination-area">
        <nav aria-label="Page navigation">
          <ul class="pagination cao-pagination">
            <!-- <li><span>共<?php //echo $total_count;;?>条</span></li> -->
            <li>
              <a href="<?php echo $first_page_url; ?>" aria-label="Previous">
                <span aria-hidden="true">&laquo;</span>
              </a>
            </li>
            <li><a href="<?php echo $prev_page_url; ?>">上一页</a></li>
            <li><span>第<?php echo $current_page; ?>页,共<?php echo $total_pages; ?>页</span></li>
            <li><a href="<?php echo $next_page_url; ?>">下一页</a></li>
            <li>
              <a href="<?php echo $last_page_url; ?>" aria-label="Next">
                <span aria-hidden="true">&raquo;</span>
              </a>
            </li>
          </ul>
        </nav>

    </div>
    <?php
}

function cao_admin_pagenavi($total_count, $number_per_page = 20) {

    $current_page = isset($_GET['paged']) ? $_GET['paged'] : 1;

    if (isset($_GET['paged'])) {
        unset($_GET['paged']);
    }

    $base_url = add_query_arg($_GET, admin_url('admin.php'));

    @$total_pages = ceil($total_count / $number_per_page);

    $first_page_url = $base_url . '&amp;paged=1';
    $last_page_url  = $base_url . '&amp;paged=' . $total_pages;

    if ($current_page > 1 && $current_page < $total_pages) {
        $prev_page     = $current_page - 1;
        $prev_page_url = $base_url . '&amp;paged=' . $prev_page;

        $next_page     = $current_page + 1;
        $next_page_url = $base_url . '&amp;paged=' . $next_page;
    } elseif ($current_page == 1) {
        $prev_page_url  = '#';
        $first_page_url = '#';
        if ($total_pages > 1) {
            $next_page     = $current_page + 1;
            $next_page_url = $base_url . '&amp;paged=' . $next_page;
        } else {
            $next_page_url = '#';
        }
    } elseif ($current_page == $total_pages) {
        $prev_page     = $current_page - 1;
        $prev_page_url = $base_url . '&amp;paged=' . $prev_page;
        $next_page_url = '#';
        $last_page_url = '#';
    }
    ?>
    <div class="tablenav">
        <div class="tablenav-pages">
            <span class="displaying-num ">每页 <?php echo $number_per_page; ?> 共 <?php echo $total_count; ?></span>
            <span class="pagination-links">
                <a class="first-page button <?php if ($current_page == 1) {
        echo 'disabled';
    }
    ?>" title="前往第一页" href="<?php echo $first_page_url; ?>"><<</a>
                <a class="prev-page button <?php if ($current_page == 1) {
        echo 'disabled';
    }
    ?>" title="前往上一页" href="<?php echo $prev_page_url; ?>"><</a>
                <span class="paging-input ">第 <?php echo $current_page; ?> 页，共 <span class="total-pages"><?php echo $total_pages; ?></span> 页</span>
                <a class="next-page button <?php if ($current_page == $total_pages) {
        echo 'disabled';
    }
    ?>" title="前往下一页" href="<?php echo $next_page_url; ?>">></a>
                <a class="last-page button <?php if ($current_page == $total_pages) {
        echo 'disabled';
    }
    ?>" title="前往最后一页" href="<?php echo $last_page_url; ?>">>></a>
            </span>
        </div>
        <br class="clear">
    </div>
    <?php
}

// 下载文件缓存
function _download_file($file_dir) {
    $file_dir = urldecode($file_dir);
    // 远程文件异步下载 直接跳转URL
    if (substr($file_dir, 0, 7) == 'http://' || substr($file_dir, 0, 8) == 'https://' || substr($file_dir, 0, 10) == 'thunder://' || substr($file_dir, 0, 7) == 'magnet:' || substr($file_dir, 0, 5) == 'ed2k:') {
        $file_path = chop($file_dir);
        echo "<script type='text/javascript'>window.location='$file_path';setTimeout(function(){window.close()},5000)</script>";
        exit;
    }

    // 本地缓冲下载文件
    $file_dir = ABSPATH . '/' . chop($file_dir);
    if (!file_exists($file_dir)) {
        header('HTTP/1.1 404 NOT FOUND');
        return false;
    }
    $pathinfoarr = pathinfo($file_dir);
    $file_name   = time() . mt_rand(1000, 9999) . '.' . $pathinfoarr['extension'];
    //以只读和二进制模式打开文件
    $file = fopen($file_dir, "rb");
    header('Content-Description: File Transfer');
    //告诉浏览器这是一个文件流格式的文件
    Header("Content-type: application/octet-stream");
    //请求范围的度量单位
    Header("Accept-Ranges: bytes");
    //Content-Length是指定包含于请求或响应中数据的字节长度
    Header("Accept-Length: " . filesize($file_dir));
    //用来告诉浏览器，文件是可以当做附件被下载，下载后的文件名称为$file_name该变量的值。
    Header("Content-Disposition: attachment; filename=" . $file_name);
    //读取文件内容并直接输出到浏览器
    echo fread($file, filesize($file_dir));
    fclose($file);
    exit();
}

/**
 * [cao_get_referral_link 生成推广链接]
 * @Author   Dadong2g
 * @DateTime 2019-06-11T16:43:08+0800
 * @param    integer                  $user_id   [description]
 * @param    string                   $base_link [description]
 * @return   [type]                              [description]
 */
function cao_get_referral_link($user_id = 0, $base_link = '') {
    if (!$base_link) {
        $base_link = home_url();
    }

    if (!$user_id) {
        $user_id = get_current_user_id();
    }

    return add_query_arg(array('ref' => $user_id), $base_link);
}

/**
 * [cao_retrieve_referral_keyword 捕获链接中的推广者]
 * @Author   Dadong2g
 * @DateTime 2019-06-11T16:45:37+0800
 * @return   [type]                   [description]
 */
function cao_retrieve_referral_keyword() {
    $ref_from = (isset($_SESSION['cao_from_user_id'])) ? absint($_SESSION['cao_from_user_id']) : 0;
    if (isset($_REQUEST['ref']) && $ref_from == 0) {
        $ref                          = absint($_REQUEST['ref']);
        $from_user_id                 = $ref;
        $_SESSION['cao_from_user_id'] = $from_user_id;
    }
    // return $ref;
}
add_action('template_redirect', 'cao_retrieve_referral_keyword');
add_action('admin_menu', 'cao_retrieve_referral_keyword');

// 关注用户
function _cao_add_follow_user($uid = '', $to_uid = '') {
    $_meta_key = 'follow_user';

    if (get_userdata($to_uid) == false) {
        return 'false';
    }

    $old_follow = get_user_meta($uid, $_meta_key, true); # 获取...

    if (is_array($old_follow)) {
        $new_follow = $old_follow;
    } else {
        $new_follow = array(0);
    }
    if (!in_array($to_uid, $new_follow)) {
        // 新关注 开始处理
        array_push($new_follow, $to_uid);
    }
    return update_user_meta($uid, $_meta_key, $new_follow);
}

// 取消关注
function _cao_del_follow_user($uid = '', $to_uid = '') {
    $_meta_key = 'follow_user';
    if (get_userdata($to_uid) == false) {
        return false;
    }

    $follow_users = get_user_meta($uid, $_meta_key, true); # 获取...
    if (!is_array($follow_users)) {
        return false;
    }
    if (!in_array($to_uid, $follow_users)) {
        return false;
    }
    foreach ($follow_users as $key => $user_id) {
        if ($user_id == $to_uid) {
            unset($follow_users[$key]);
            break;
        }
    }
    return update_user_meta($uid, $_meta_key, $follow_users);
}

// 收藏文章
function _cao_add_follow_post($uid = '', $to_post = '') {
    $_meta_key = 'follow_post';
    $to_post   = (int) $to_post;
    if (get_post_status($to_post) === false) {
        return 'false';
    }

    $old_follow = get_user_meta($uid, $_meta_key, true); # 获取...

    if (is_array($old_follow)) {
        $new_follow = $old_follow;
    } else {
        $new_follow = array(0);
    }
    if (!in_array($to_post, $new_follow)) {
        // 新关注 开始处理
        array_push($new_follow, $to_post);
    }
    return update_user_meta($uid, $_meta_key, $new_follow);
}

function is_get_post_fav($post_id) {
    $user_id = get_current_user_id();
    if (!$user_id) {
        return false;
    }
    $old_follow = get_user_meta($user_id, 'follow_post', true); # 获取...
    if (empty($old_follow) || !is_array($old_follow)) {
        return false;
    }
    if (in_array($post_id, $old_follow)) {
        return true;
    } else {
        return false;
    }
}

// 取消收藏文章
function _cao_del_follow_post($uid = '', $to_post = '') {
    $_meta_key = 'follow_post';
    $to_post   = (int) $to_post;
    if (get_post_status($to_post) === false) {
        return 'false';
    }

    $follow_users = get_user_meta($uid, $_meta_key, true); # 获取...
    if (!is_array($follow_users)) {
        return false;
    }
    if (!in_array($to_post, $follow_users)) {
        return false;
    }
    foreach ($follow_users as $key => $user_id) {
        if ($user_id == $to_post) {
            unset($follow_users[$key]);
            break;
        }
    }
    return update_user_meta($uid, $_meta_key, $follow_users);
}

// 收藏文章
function _cao_user_is_qiandao($users_id = 0) {
    global $current_user;
    if (!is_user_logged_in()) {
        return false;
    }
    $uid = (!$users_id) ? $current_user->ID : $users_id;

    $_meta_key = 'cao_qiandao_time';

    // 会员当前签到时间
    $this_user_qiandao_time = (get_user_meta($uid, $_meta_key, true) > 0) ? get_user_meta($uid, $_meta_key, true) : 0;

    // 自动更新时间
    $getTime  = getTime();
    $thenTime = time();
    // 获取用户结束时间
    if ($getTime['star'] < $this_user_qiandao_time && $getTime['end'] > $this_user_qiandao_time) {
        return true;
    }
    return false;
}

// 发放充值佣金 根据当前用户计算推荐人
function add_to_user_bonus($this_user_id = 0, $charge_money = 0) {
    if (!$this_user_id || !_cao('is_charge_ref_float', false)) {
        return false;
    }
    // 查询上级id
    $form_uid         = get_user_meta($this_user_id, 'cao_ref_from', true);
    $cao_ref_from_uid = ($form_uid) ? (int) $form_uid : 0;
    $charge_rate      = (int) _cao('site_change_rate'); //充值比例
    // 有推介人 发放
    if ($cao_ref_from_uid) {
        //计算应发金额  获取后台佣金比例
        $site_novip_ref_float = _cao('site_novip_ref_float');
        $site_vip_ref_float   = _cao('site_vip_ref_float');
        $CaoUser              = new CaoUser($cao_ref_from_uid);
        if ($CaoUser->vip_status()) {
            $amount = sprintf('%0.2f', $charge_money * $site_vip_ref_float / $charge_rate);
        } else {
            $amount = sprintf('%0.2f', $charge_money * $site_novip_ref_float / $charge_rate);
        }
        //
        $Reflog = new Reflog($cao_ref_from_uid);
        $Reflog->add_total_bonus($amount); //添加佣金 .
    }
    return;
}

// 发放作者佣金 文章作者奖励
function add_post_author_bonus($author_id = 0, $pay_price = 0) {
    if (!$author_id || !_cao('site_postpay_ref_float', false)) {
        return false;
    }
    // 查询汇率
    $charge_rate      = (int) _cao('site_change_rate'); //充值比例
    $charge_ref_float = _cao('site_postpay_ref_float'); //当前分红比例
    $charge_money     = sprintf('%0.2f', $pay_price / $charge_rate); // 换算RMB
    $yongjin          = sprintf('%0.2f', $charge_money * $charge_ref_float);
    // 有推介人 发放
    $Reflog = new Reflog($author_id);
    $Reflog->add_total_bonus($yongjin); //添加佣金 .
    return;
}

// 筛选条件 搜索框
//
function cao_only_selected_category($query) {
    //is_search判断搜索页面  !is_admin排除后台  $query->is_main_query()只影响主循环
    if (!is_admin() && $query->is_main_query()) {
        // 排序：
        $order           = !empty($_GET['order']) ? sanitize_text_field( wp_unslash( $_GET[ 'order' ] ) ) : null;
        $cat             = !empty($_GET['cat']) ? (int) $_GET['cat'] : null;
        $cao_type        = !empty($_GET['cao_type']) ? (int) $_GET['cao_type'] : null;
        $custom_meta_arr = !empty($_GET) ? $_GET : null;

        if ($order) {
            if ($order == 'hot') {
                $query->set('meta_key', 'views');
                $query->set('orderby', 'meta_value_num');
                $query->set('order', 'DESC');
            } else {
                $query->set('orderby', $order);
            }
        }
        //有cat值传入
        if ($cat) {
            $term_id   = (int) $cat;
            $tax_query = array(
                array(
                    'taxonomy' => 'category', //可换为自定义分类法
                    'field'    => 'term_id',
                    'operator' => 'IN',
                    'terms'    => array($term_id),
                ),
            );
            $query->set('tax_query', $tax_query);
        }

        $custom_meta_query = array();
        if ($cao_type) {
            switch ($cao_type) {
            case '1':
                $_type_meta_key = 'cao_price';
                $_type_value    = '0';
                $_type_compare  = '=';
                break;
            case '2':
                $_type_meta_key = 'cao_price';
                $_type_value    = '0';
                $_type_compare  = '>';
                break;
            case '3':
                $_type_meta_key = 'cao_vip_rate';
                $_type_value    = '0';
                $_type_compare  = '=';
                break;
            case '4':
                $_type_meta_key = 'cao_vip_rate';
                $_type_value    = '1';
                $_type_compare  = '!=';
                break;
            default:
                break;
            }

            $type_meta_query = array(
                array(
                    'key'     => $_type_meta_key,
                    'value'   => $_type_value,
                    'compare' => $_type_compare,
                ),
            );
            array_push($custom_meta_query, $type_meta_query);
        }

        if ($custom_meta_arr && _cao('is_custom_post_meta_opt', '0') && _cao('custom_post_meta_opt', '0')) {
            $custom_post_meta_opt = _cao('custom_post_meta_opt', '0');
            foreach ($custom_post_meta_opt as $filter) {
                $_meta_key = $filter['meta_ua'];
                if (array_key_exists($_meta_key, $custom_meta_arr) && $_GET[$_meta_key] != 'all') {
                    $opt_meta_query = array(
                        array(
                            'key'     => $_meta_key,
                            'value'   => $_GET[$_meta_key],
                            'compare' => '=',
                        ),
                    );
                    array_push($custom_meta_query, $opt_meta_query);
                }
            }

        }

        $query->set('meta_query', $custom_meta_query);

    }
    return $query;
}
add_filter('pre_get_posts', 'cao_only_selected_category');

//投稿者也可上传图片
if (_cao('is_all_publish_posts', false)) {
    if (current_user_can('contributor') && !current_user_can('upload_files')) {
        add_action('admin_init', 'allow_contributor_uploads');
    }

    function allow_contributor_uploads() {
        $contributor = get_role('contributor');
        $contributor->add_cap('upload_files');
    }
}

/**
 * [dimox_breadcrumbs 面包屑导航]
 * @Author   Dadong2g
 * @DateTime 2019-10-25T20:59:35+0800
 * @return   [type]                   [修复附件页面报错问题]
 */
function dimox_breadcrumbs() {
    global $post;
    if (is_single() && !_cao('is_archive_crumbs') && !is_attachment()) {
        $categorys = get_the_category();
        $category  = $categorys[0];
        return '当前位置：<a href="' . get_bloginfo('url') . '">' . get_bloginfo('name') . '</a> <small>></small> ' . get_category_parents($category->term_id, true, ' <small>></small> ') . get_the_title();
    } elseif (is_attachment()) {
        $parent = get_post($post->post_parent);
        $cat    = get_the_category($parent->ID);
        if (!$cat) {
            return false;
        }
        $cat = $cat[0];
        return '当前位置：<a href="' . get_bloginfo('url') . '">' . get_bloginfo('name') . '</a> <small>></small> ' . get_category_parents($cat->term_id, true, ' <small>></small> ') . get_the_title();
    } else {
        return false;
    }
}

//发送html格式邮件
function _sendMail($email, $title, $message) {
    $headers    = array('Content-Type: text/html; charset=UTF-8');
    $message    = tpl_email_html($email, $title, $message);
    $send_email = wp_mail($email, $title, $message, $headers);
    if ($send_email) {
        return true;
    }
    return false;
}
//html格式邮件
function tpl_email_html($user, $title, $desc) {
    $html = '<div style="background-color:#eef2fa;border:1px solid #d8e3e8;color: #111;padding:0 15px;-moz-border-radius:5px;-webkit-border-radius:5px;-khtml-border-radius:5px;">';
    $html .= '<p style="font-weight: bold;color: #2196F3;font-size: 18px;">' . $title . '</p>';
    $html .= sprintf("<p>您好，%s</p>", $user);
    $html .= sprintf("<p>内容: %s</p>", $desc);
    $html .= sprintf("<p>时间: %s</p>", date("Y-m-d H:i:s"));
    $a_href = '<a href="' . home_url() . '">' . get_bloginfo('name') . '</a>';
    $html .= sprintf("<p>官网： %s</p>", $a_href);
    $html .= '</div>';
    return $html;
}

/**
 * [_target_blank 链接新窗口打开]
 * @Author   Dadong2g
 * @DateTime 2019-05-28T12:28:35+0800
 * @return   [type]                   [description]
 */
function _target_blank() {
    return _cao('target_blank') ? ' target="_blank"' : '';
}

/**
 * 在 WordPress 编辑器添加“下一页”按钮
 */
add_filter('mce_buttons', 'wp_add_next_page_button');
function wp_add_next_page_button($mce_buttons) {
    $pos = array_search('wp_more', $mce_buttons, true);
    if ($pos !== false) {
        $tmp_buttons   = array_slice($mce_buttons, 0, $pos + 1);
        $tmp_buttons[] = 'wp_page';
        $mce_buttons   = array_merge($tmp_buttons, array_slice($mce_buttons, $pos + 1));
    }
    return $mce_buttons;
}

/**
 * [_the_ads 自定义广告代码]
 * @Author   Dadong2g
 * @DateTime 2019-05-28T12:14:38+0800
 * @param    string                   $name  [description]
 * @param    string                   $class [description]
 * @return   [type]                          [description]
 */
function _the_cao_ads($name = '', $class = '') {
    if (!_cao($name . '_s')) {
        return;
    }
    echo '<div class="site-ads ads-' . $class . '">' . _cao($name) . '</div>';
}

/**
 * [getTime 获取今天的开始和结束时间]
 * @Author   Dadong2g
 * @DateTime 2019-05-28T12:25:26+0800
 * @return   [type]                   [description]
 */
function getTime() {
    $str          = date("Y-m-d", time()) . "0:0:0";
    $data["star"] = strtotime($str);
    $str          = date("Y-m-d", time()) . "24:00:00";
    $data["end"]  = strtotime($str);
    return $data;
}

/**
 * [get_category_root_id description]
 * @Author   Dadong2g
 * @DateTime 2019-08-15T09:57:46+0800
 * @param    [type]                   $cat [description]
 * @return   [type]                        [通过子分类id获取父分类id]
 */
function get_category_root_id($cat) {
    $this_category = get_category($cat); // 取得当前分类
    while ($this_category->category_parent) // 若当前分类有上级分类时，循环
    {
        $this_category = get_category($this_category->category_parent); // 将当前分类设为上级分类（往上爬）
    }
    return $this_category->term_id; // 返回根分类的id号
}

function get_category_deel($cat) {

    $categories        = get_terms('category', array('hide_empty' => 0, 'parent' => 0)); //获取所有主分类
    $get_term_children = get_term_children($cat_ID, 'category'); //获取当前分类的子分类
}

/**
 * [is_boosvip_status description]
 * @Author   Dadong2g
 * @DateTime 2019-08-16T10:29:40+0800
 * @param    [type]                   $user_id [description]
 * @return   boolean                           [是否永久会员]
 */
function is_boosvip_status($user_id) {
    $vip_type     = get_user_meta($user_id, 'cao_user_type', true);
    $vip_end_date = get_user_meta($user_id, 'cao_vip_end_time', true);
    if ($vip_type == 'vip' && $vip_end_date == '9999-09-09') {
        return true;
    }
    return false;
}

/**
 * [_timeago 时间显示几分钟 几天优化]
 * @Author   Dadong2g
 * @DateTime 2019-09-05T16:19:41+0800
 * @param    [type]                   $time [时间]
 * @return   [type]                         [description]
 */
function _timeago($time) {
    $time       = strtotime($time);
    $difference = time() - $time;
    if (!_cao('post_is_timeago', '1')) {
        return date('Y-m-d', $time);
    }
    switch ($difference) {
    case $difference <= '1':
        $msg = '刚刚';
        break;
    case $difference > '1' && $difference <= '60':
        $msg = floor($difference) . '秒前';
        break;
    case $difference > '60' && $difference <= '3600':
        $msg = floor($difference / 60) . '分钟前';
        break;
    case $difference > '3600' && $difference <= '86400':
        $msg = floor($difference / 3600) . '小时前';
        break;
    case $difference > '86400' && $difference <= '2592000':
        $msg = floor($difference / 86400) . '天前';
        break;
    case $difference > '2592000':
        $msg = '' . date('Y-m-d', $time) . '';
        break;
    }
    return $msg;
}

// GET URL
function get_url_contents($url) {
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_TIMEOUT, 60);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
    curl_setopt($ch, CURLOPT_URL, $url);
    $result = curl_exec($ch);
    if ($result === false) {
        echo 'Curl error: ' . curl_error($ch);
    }
    curl_close($ch);
    return $result;
}

/**
 * [reset_password_message 修复WordPress找回密码提示“抱歉，该key似乎无效”问题解决找回密码链接无效问题]
 * @Author   Dadong2g
 * @DateTime 2019-10-26T19:16:15+0800
 * @param    [type]                   $message [description]
 * @param    [type]                   $key     [description]
 * @return   [type]                            [description]
 */
function reset_password_message($message, $key) {
    if (strpos($_POST['user_login'], '@')) {
        $user_data = get_user_by('email', trim($_POST['user_login']));
    } else {
        $login     = trim($_POST['user_login']);
        $user_data = get_user_by('login', $login);
    }
    $user_login = $user_data->user_login;
    $msg        = __('有人要求重设如下帐号的密码：') . "\r\n\r\n";
    $msg .= network_site_url() . "\r\n\r\n";
    $msg .= sprintf(__('用户名：%s'), $user_login) . "\r\n\r\n";
    $msg .= __('若这不是您本人要求的，请忽略本邮件，一切如常。') . "\r\n\r\n";
    $msg .= __('要重置您的密码，请打开下面的链接：') . "\r\n\r\n";
    $msg .= network_site_url("wp-login.php?action=rp&key=$key&login=" . rawurlencode($user_login), 'login');
    return $msg;
}
add_filter('retrieve_password_message', 'reset_password_message', null, 2);

/**
 * [ripro_custom_login_img 更换wordpress默认登录页面LOGO]
 * @Author   Dadong2g
 * @DateTime 2019-11-17T20:48:54+0800
 * @return   [type]                   [description]
 */
function ripro_custom_login_img() {
    echo '<style type="text/css">
h1 a {background-image: url(' . _cao('site_logo') . ') !important; height: 50px !important;width: 150px !important;background-size: 150px !important;}
</style>';
}
add_action('login_head', 'ripro_custom_login_img');

/**
 * [custom_loginlogo_url 修改wordpress自带注册登陆页面链接]
 * @Author   Dadong2g
 * @DateTime 2019-11-17T20:55:29+0800
 * @param    [type]                   $url [description]
 * @return   [type]                        [description]
 */
function ripro_custom_loginlogo_url($url) {
    return get_bloginfo('url');
}
add_filter('login_headerurl', 'ripro_custom_loginlogo_url');

/**
 * [is_site_shop_open 网站商城等功能开关]
 * @Author   Dadong2g
 * @DateTime 2019-11-17T21:16:38+0800
 * @return   boolean                  [description]
 */
function is_site_shop_open() {
    $is_close_site_shop = _cao('close_site_shop', '0');
    return !$is_close_site_shop;
}

/**
 * [get_client_ip 获取用户访问IP]
 * @Author   Dadong2g
 * @DateTime 2019-12-25T14:49:54+0800
 * @return   [type]                   [description]
 */
function _cao_get_client_ip() {
    if ($_SERVER["HTTP_CLIENT_IP"] && strcasecmp($_SERVER["HTTP_CLIENT_IP"], "unknown")) {
        $ip = $_SERVER["HTTP_CLIENT_IP"];
    } else {
        if ($_SERVER["HTTP_X_FORWARDED_FOR"] && strcasecmp($_SERVER["HTTP_X_FORWARDED_FOR"], "unknown")) {
            $ip = $_SERVER["HTTP_X_FORWARDED_FOR"];
        } else {
            if ($_SERVER["REMOTE_ADDR"] && strcasecmp($_SERVER["REMOTE_ADDR"], "unknown")) {
                $ip = $_SERVER["REMOTE_ADDR"];
            } else {
                if (isset($_SERVER['REMOTE_ADDR']) && $_SERVER['REMOTE_ADDR'] && strcasecmp($_SERVER['REMOTE_ADDR'],
                    "unknown")
                ) {
                    $ip = $_SERVER['REMOTE_ADDR'];
                } else {
                    $ip = "unknown";
                }
            }
        }
    }
    return ($ip);
}




//初始化支付方式配置 如需修改改这里即可 可以用 add_filter()添加或修改
function cao_pay_type_options(){
    $paytypeArr=[
        1=>['badge'=>'badge-blue','name'=>'支付宝'],
        2=>['badge'=>'badge-primary','name'=>'微信'],
        4=>['badge'=>'badge-primary','name'=>'PAYJS'],
        5=>['badge'=>'badge-primary','name'=>'虎皮椒-微信'],
        6=>['badge'=>'badge-blue','name'=>'虎皮椒-支付宝'],
        7=>['badge'=>'badge-blue','name'=>'码支付-支付宝'],
        8=>['badge'=>'badge-primary','name'=>'码支付-微信'],
        9=>['badge'=>'badge-blue','name'=>'讯虎-支付宝'],
        10=>['badge'=>'badge-primary','name'=>'讯虎-微信'],
        11=>['badge'=>'badge-blue','name'=>'易支付-支付宝'],
        12=>['badge'=>'badge-primary','name'=>'易支付-微信'],
    ];
    return  apply_filters( 'cao_pay_type_options',$paytypeArr);
}


/**
 * [_cao_get_pay_type_html 获取后台设置的支付方式HTML]
 * @Author   Dadong2g
 * @DateTime 2020-01-15T10:14:19+0800
 * @return   [type]                   [description]
 */
function _cao_get_pay_type_html() {
    $alipay      = false;
    $weixinpay   = false;
    $alipay_type = 0;
    $wxpay_type  = 0;

    if (_cao('is_codepay')) {
        $codepay = _cao('codepay');
        switch ($codepay['pay_mode']) {
        case 'all':
            $alipay      = true;
            $alipay_type = 7;
            $weixinpay   = true;
            $wxpay_type  = 8;
            break;
        case 'weixin':
            $weixinpay  = true;
            $wxpay_type = 8;
            break;
        case 'alipay':
            $alipay      = true;
            $alipay_type = 7;
            break;
        }
    }

    if (_cao('is_payjs')) {
        $weixinpay  = true;
        $wxpay_type = 4;
    }
    if (_cao('is_xunhupay')) {
        $weixinpay  = true;
        $wxpay_type = 5;
    }
    if (_cao('is_xunhualipay')) {
        $alipay      = true;
        $alipay_type = 6;
    }

    if (_cao('is_xunhupay_ali')) {
        $alipay      = true;
        $alipay_type = 9;
    }
    if (_cao('is_xunhupay_wx')) {
        $weixinpay  = true;
        $wxpay_type = 10;
    }

    if (_cao('is_alipay')) {
        $alipay      = true;
        $alipay_type = 1;
    }
    if (_cao('is_weixinpay')) {
        $weixinpay  = true;
        $wxpay_type = 2;
    }
    if (_cao('is_yzf')) {
        $yzf=_cao('yzf');
        if ($yzf['is_yzf_ali']) {
            $alipay      = true;
            $alipay_type = 11;
        }
        if ($yzf['is_yzf_wx']) {
            $weixinpay   = true;
            $wxpay_type  = 12;
        }
    }
    $html = '<div class="pay-button-box">';

    $is_user_logged_in    = is_user_logged_in();
    $is_online_pay_status = _cao('is_online_pay_status', true);
    $is_online_pay_reta   = _cao('is_online_pay_reta', true);

    if (!$is_user_logged_in || ($is_user_logged_in && $is_online_pay_status)) {
        if ($alipay) {
            $html .= '<div class="pay-item" id="alipay" data-type="' . $alipay_type . '">';
            $html .= '<i class="alipay"></i><span>支付宝</span>';
            $html .= '</div>';
        }
        if ($weixinpay) {
            $html .= '<div class="pay-item" id="weixinpay" data-type="' . $wxpay_type . '">';
            $html .= '<i class="weixinpay"></i><span>微信支付</span>';
            $html .= '</div>';
        }
    }

    //余额支付 必备开启 支付识别ID 9999 _cao('is_ripro_nologin_pay','1')

    if ($is_user_logged_in && !(cao_get_page_by_slug('user') == get_the_ID() && _cao('is_pay_vip_dashed_yec'))) {
        $html .= '<div class="pay-item" id="yecpay" data-type="9999">';
        $html .= '<i class="yecpay"></i><span>余额支付</span>';
        $html .= '</div>';
    }

    $html .= '</div>';
    if (cao_get_page_by_slug('user') != get_the_ID()) {
        if (!$is_user_logged_in && _cao('is_ripro_nologin_pay', '1')) {
            $html .= '<p style="font-size: 13px; padding: 0; margin: 0;">当前为游客购买模式</p>';
        } else {
            $html .= '<p style="font-size: 13px; padding: 0; margin: 0;">免费或' . _cao('site_vip_name') . '免费资源仅限余额支付</p>';
            if (!$is_online_pay_reta && $is_online_pay_status) {
                $html .= '<p style="font-size: 13px; padding: 0; margin: 0;">仅余额支付享受折扣特权</p>';
            }
        }
    }

    return array('html' => $html, 'alipay' => $alipay_type, 'weixinpay' => $wxpay_type);

}


/**
 * [cao_get_post_downBtn 输出小工具下载按钮]
 * @Author   Dadong2g
 * @DateTime 2020-01-16T00:30:09+0800
 * @param    integer                  $post_id [description]
 * @return   [type]                            [description]
 */
function cao_get_post_downBtn($post_id = 0) {
    if (_cao('is_nojs_downurl_blank')) {
        return '<a target="_blank" href="' . esc_url(home_url('/go?post_id=' . $post_id)) . '" class="go-downblank btn btn--secondary btn--block"><i class="fa fa-cloud-download"></i> 立即下载</a>';
    } else {
        return '<a target="_blank" data-id="' . $post_id . '" class="go-down btn btn--secondary btn--block"><i class="fa fa-cloud-download"></i> 立即下载</a>';
    }
}


/**
 * [cao_theme_archive_title 获取页面标题]
 * @Author   Dadong2g
 * @DateTime 2021-01-12T09:43:17+0800
 * @param    [type]                   $title [description]
 * @return   [type]                          [description]
 */
function cao_theme_archive_title($title) {
    if (is_category()) {
        $title = single_cat_title('', false);
    } elseif (is_tag()) {
        $title = single_tag_title('', false);
    } elseif (is_author()) {
        $title = '<span class="vcard">' . get_the_author() . '</span>';
    } elseif (is_post_type_archive()) {
        $title = post_type_archive_title('', false);
    } elseif (is_tax()) {
        $title = single_term_title('', false);
    }

    return $title;
}
add_filter('get_the_archive_title', 'cao_theme_archive_title');


/**
 * [is_cao_site_list_blog 是否博客模式]
 * @Author   Dadong2g
 * @DateTime 2021-01-12T09:42:14+0800
 * @return   boolean                  [description]
 */
function is_cao_site_list_blog() {

    if (empty($_SESSION['is_blog_style']) && _cao('site_list_style', 'default') == 'blog') {
        return true;
    } else {
        $retVal = (!empty($_SESSION['is_blog_style'])) ? $_SESSION['is_blog_style'] : false;
        return $retVal;
    }
}

/**
 * [cao_get_page_by_slug 获取页面别名]
 * @Author   Dadong2g
 * @DateTime 2021-01-12T09:42:31+0800
 * @param    [type]                   $slug [description]
 * @return   [type]                         [description]
 */
function cao_get_page_by_slug($slug) {
    global $wpdb;
    $page_id = $wpdb->get_var("SELECT ID FROM $wpdb->posts WHERE post_name = '$slug'");
    return $page_id;
}



/**
 * [cao_wp_die 错误页面跳转提示]
 * @Author   Dadong2g
 * @DateTime 2020-03-10T16:19:06+0800
 * @param    string                   $title [description]
 * @param    string                   $msg   [description]
 * @return   [type]                          [description]
 */
function cao_wp_die($title = '', $msg = '') {
    ob_start();?>
    <!doctype html>
    <html <?php language_attributes();?>>
    <head><meta charset="<?php bloginfo('charset');?>"><meta name="viewport" content="width=device-width, initial-scale=1"><link rel="profile" href="https://gmpg.org/xfn/11"><?php wp_head();?></head>
    <body <?php body_class();?>>
    <script type="text/javascript">
    jQuery(function(){Swal.fire({title:'<?php echo $title; ?>',html:'<?php echo $msg; ?>',icon:"warning",allowOutsideClick:!1}).then(e=>{e.isConfirmed&&(window.location.href=document.referrer)})});
    </script>
    <?php wp_footer();?>
    </body></html>
    <?php echo ob_get_clean();exit;
}


/**
 * [is_weixin_view 是否微信内访问]
 * @Author   Dadong2g
 * @DateTime 2021-01-12T09:42:42+0800
 * @return   boolean                  [description]
 */
function is_weixin_view() {
    if (strpos($_SERVER['HTTP_USER_AGENT'], 'MicroMessenger') !== false) {
        return true;
    } else {
        return false;
    }
}


/**
 * [ripro_echo_ads 广告位置钩子]
 * @Author   Dadong2g
 * @DateTime 2021-01-12T09:43:06+0800
 * @param    [type]                   $slug [description]
 * @return   [type]                         [description]
 */
function ripro_echo_ads($slug) {
    if (defined('DOING_AJAX') && DOING_AJAX) {
        return false;
    }
    $is_ads     = _cao($slug);
    $ads_pc     = _cao($slug . '_pc');
    $ads_mobile = _cao($slug . '_mobile');
    // var_dump($is_ads);die;
    $html = '';
    if (wp_is_mobile() && $is_ads && isset($ads_mobile)) {
        $html = '<div class="ripro_gg_wrap mobile">';
        $html .= $ads_mobile;
        $html .= '</div>';
    } else if ($is_ads && isset($ads_pc)) {
        $html = '<div class="ripro_gg_wrap pc">';
        $html .= $ads_pc;
        $html .= '</div>';
    }
    echo $html;
}
add_action('ripro_echo_ads', 'ripro_echo_ads', 10, 1);