<?php

/**






 */

defined('ABSPATH') || exit;

/**
 * check order OR coipon
 */

$jumawu_com_global_db = array(
    'order_table_name'       => 'cao_order', //订单表
    'paylog_table_name'      => 'cao_paylog', //购买记录表
    'coupon_table_name'      => 'cao_coupon', //卡密表名称
    'balance_log_table_name' => 'cao_balance_log', //余额记录表
    'ref_log_table_name'     => 'cao_ref_log', //推广记录表
    'down_log_table_name'    => 'cao_down_log', //下载记录表
    'mpwx_log_table_name'    => 'cao_mpwx_log', //微信公众号登录记录表
);

foreach ($jumawu_com_global_db as $name => $db) {
    $$name = isset($table_prefix) ? ($table_prefix . $db) : ($wpdb->prefix . $db);
}

if (!function_exists('caozhuti_setup')):

    function caozhuti_setup() {

        // if (extension_loaded('swoole_loader')) {
        //     $setupDb = new setupDb();
        //     $setupDb->install();
        // }
		$setupDb = new setupDb();
		$setupDb->install();

        add_theme_support('title-tag');

        add_theme_support('post-thumbnails');

        add_theme_support('html5', array(
            'search-form',
            'comment-form',
            'comment-list',
            'gallery',
            'caption',
        ));

        add_theme_support('editor-styles');
        add_theme_support('wp-block-styles');
        add_theme_support('customize-selective-refresh-widgets');
        add_filter('pre_option_link_manager_enabled', '__return_true');

        register_nav_menus(array(
            'menu-1' => '顶部主菜单',
        ));

        $init_pages = array(
            'pages/user.php'     => array('用户中心', 'user'),
            'pages/zhuanti.php'  => array('专题', 'zhuanti'),
            'pages/archives.php' => array('存档', 'archives'),
            'pages/tags.php'     => array('标签云', 'tags'),
        );
        foreach ($init_pages as $template => $item) {
            $one_page = array(
                'post_title'  => $item[0],
                'post_name'   => $item[1],
                'post_status' => 'publish',
                'post_type'   => 'page',
                'post_author' => 1,
            );
            ///////////S CACHE ////////////////
            if (CaoCache::is()) {
                $_the_cache_key  = 'jumawu.com_functions_init_pages_' . $template;
                $_the_cache_data = CaoCache::get($_the_cache_key);
                if (false === $_the_cache_data) {
                    $_the_cache_data = get_page_by_title($item[0]); //缓存数据
                    CaoCache::set($_the_cache_key, $_the_cache_data);
                }
                $one_page_check = $_the_cache_data;
            } else {
                $one_page_check = get_page_by_title($item[0]);
            }
            ///////////S CACHE ////////////////

            if (!isset($one_page_check->ID)) {
                $one_page_id = wp_insert_post($one_page);
                update_post_meta($one_page_id, '_wp_page_template', $template);
            }
        }
    }
    add_action('after_setup_theme', 'caozhuti_setup');
endif;



/**
 * [register_session 启用session 初始化本地时间]
 * @Author   Dadong2g
 * @DateTime 2021-01-12T09:45:29+0800
 * @return   [type]                   [description]
 */
function register_session_and_timezone() {
    //获取wordpress系统中设置的时区 进行初始化
    if ($timezone = get_option('timezone_string')) {
        date_default_timezone_set($timezone);
    }
    //检测系统是否支持启用session
    if (!session_id()) {
        session_start();
    }
}
add_action('init', 'register_session_and_timezone');



/**
 * [Init_theme 激活主题跳转设置页面]
 * @Author   Dadong2g
 * @DateTime 2019-05-28T11:16:53+0800
 * @param    [type]                   $oldthemename [description]
 */
function init_to_admin_theme($oldthemename) {
    global $pagenow;
    if ('themes.php' == $pagenow && isset($_GET['activated'])) {
        wp_redirect(admin_url('/admin.php?page=csf-caozhuti#tab=%e4%b8%bb%e9%a2%98%e6%8e%88%e6%9d%83'));
        exit;
    }
}

add_action('after_switch_theme', 'init_to_admin_theme');





/**
 * [caozhuti_widgets_init Register widget area.]
 * @Author   Dadong2g
 * @DateTime 2019-05-28T23:47:36+0800
 * @return   [type]                   [description]
 */
function caozhuti_widgets_init() {
    $sidebars = array(
        'sidebar'    => '文章页侧栏',
        'off_canvas' => '全站侧栏菜单',
    );

    if (is_cao_site_list_blog() || true) {
        $sidebars['blog'] = '博客模式侧边栏';
    }

    foreach ($sidebars as $key => $value) {
        register_sidebar(array(
            'name'          => $value,
            'id'            => $key,
            'before_widget' => '<div id="%1$s" class="widget %2$s">',
            'after_widget'  => '</div>',
            'before_title'  => '<h5 class="widget-title">',
            'after_title'   => '</h5>',
        ));
    }

}
add_action('widgets_init', 'caozhuti_widgets_init');

/**
 * [caozhuti_scripts 加载主题JS和CSS资源，可以采用子主题全部替换函数方法]
 * @Author   Dadong2g
 * @DateTime 2019-05-28T23:46:28+0800
 * @return   [type]                   [description]
 */
if (!function_exists('caozhuti_scripts')):
    function caozhuti_scripts() {
        $__f = get_template_directory_uri() . '/assets';
        $__v = _the_theme_version();
        if (!is_admin()) {

            // 禁用jquery和110n翻译
            wp_deregister_script('jquery');
            wp_deregister_script('l10n');
            //注册CSS引入CSS
            wp_enqueue_style('sweetalert2', $__f . '/css/sweetalert2.min.css', array(), $__v, 'all');
            wp_enqueue_style('app', $__f . '/css/app.css', array(), $__v, 'all');
            wp_enqueue_style('diy', $__f . '/css/diy.css', array(), $__v, 'all');

            // 引入JS
            wp_enqueue_script('jquery', $__f . '/js/jquery-2.2.4.min.js', '', '2.2.4', false);
            wp_enqueue_script('plugins', $__f . '/js/plugins.js', array('jquery'), $__v, true);
            wp_enqueue_script('sweetalert2', $__f . '/js/plugins/sweetalert2.min.js', array(), $__v, false);
            wp_enqueue_script('app', $__f . '/js/app.js', array('plugins'), $__v, true);

            if (_cao('is_captcha_qq')) {
                wp_enqueue_script('captcha', 'https://ssl.captcha.qq.com/TCaptcha.js', array(), '', true);
            }

            if (is_page_template('pages/user.php')) {
                wp_enqueue_script('llqrcode', $__f . '/js/plugins/llqrcode.js', array('jquery'), '2.0.1', true);
            }

            if (is_singular() && _cao('is_fancybox_img', true)) {

                if (_cao('poster_share_open','1')) {
                    wp_enqueue_script('html2canvas', $__f . '/js/plugins/html2canvas.min.js', array(),'1.0.0', true);
                }

                wp_enqueue_style('fancybox', $__f . '/css/jquery.fancybox.min.css', array(), $__v, 'all');
                wp_enqueue_script('fancybox', $__f . '/js/plugins/jquery.fancybox.min.js', array('jquery'), $__v, true);
            }

            if (is_singular() && comments_open() && get_option('thread_comments')) {
                wp_enqueue_script('comment-reply');
            }

            //脚本本地化
            wp_localize_script('app', 'caozhuti',
                array(
                    'site_name'        => get_bloginfo('name'),
                    'home_url'         => esc_url(home_url()),
                    'ajaxurl'          => esc_url(admin_url('admin-ajax.php')),
                    'is_singular'      => is_singular() ? 1 : 0,
                    'tencent_captcha'  => array('is' => _cao('is_captcha_qq', '0'), 'appid' => _cao('captcha_qq_appid', '')),
                    'infinite_load'    => '加载更多',
                    'infinite_loading' => '<i class="fa fa-spinner fa-spin"></i> 加载中...',
                    'site_notice'      => array('is' => _cao('is_site_notify', '0'), 'color' => _cao('site_notify_color', 'rgb(33, 150, 243)'), 'html' => '<div class="notify-content"><h3>' . _cao('site_notify_title', '') . '</h3><div>' . _cao('site_notify_desc', '') . '</div></div>'),
                    'pay_type_html'    => _cao_get_pay_type_html(),
                )
            );

        }
    }
    add_action('wp_enqueue_scripts', 'caozhuti_scripts');
endif;


// 禁用古腾堡小工具
if (true) {
    // Disables the block editor from managing widgets in the Gutenberg plugin.
    add_filter( 'gutenberg_use_widgets_block_editor', '__return_false' );
    // Disables the block editor from managing widgets.
    add_filter( 'use_widgets_block_editor', '__return_false' );
}


// 管理页面CSS
function caoAdminScripts() {
    if (isset($_GET['page']) && strpos($_GET['page'], 'cao') !== false) {
        wp_enqueue_style('caoadmin', get_template_directory_uri() . '/assets/css/admin.css', array(), '', 'all');
    }
}
add_action('admin_enqueue_scripts', 'caoAdminScripts');

$jumawu_com_inc_dir   = get_template_directory();
$jumawu_com_theme_uri = get_template_directory_uri();
$jumawu_com_includes  = array(
    '/inc/codestar-framework/codestar-framework.php',
    '/inc/core-functions.php',
    '/inc/theme-functions.php',
    '/inc/core-ajax.php',
    'swoole',
    '/inc/class/walker.class.php',
    '/vendor/autoload.php',
    '/inc/admin/init.php',
);

// Include files.
foreach ($jumawu_com_includes as $file) {
    if ($file === 'swoole') {      
            require_once $jumawu_com_inc_dir . '/inc/class/core.class.7.4.php';
        
    } else {
        require_once $jumawu_com_inc_dir . $file;
    }
}

///////////////////////////// RITHEME.COM END ///////////////////////////
//■■■■■■■■■■■■■在后台文章列表增加一列数据■■■■■■■■■■■
add_filter( 'manage_posts_columns', 'ashuwp_customer_posts_columns' );
function ashuwp_customer_posts_columns( $columns ) {
	$columns['views'] = '浏览次数';
	return $columns;
}
//■■■■■■■■■■■输出浏览次数■■■■■■■
//■■■■注意：代码中 post_views_count 指的是你记录文章浏览量的自定义栏目名称，例如views或者post-views，这个可以在你的统计浏览量代码里看到，也可以直接在文章修改面板下面自定义栏目看到。
add_action('manage_posts_custom_column', 'ashuwp_customer_columns_value', 10, 2);
function ashuwp_customer_columns_value($column, $post_id){
	if($column=='views'){
		$count = get_post_meta($post_id, 'views', true);//■■■■注意：这样代码中 views 指的是你记录文章浏览量的自定义栏目名称，例如views或者post-views，这个可以在你的统计浏览量代码里看到，也可以直接在文章修改面板下面自定义栏目看到。
		if(!$count){
			$count = 0;
		}
		echo $count;
	}
	return;
}
