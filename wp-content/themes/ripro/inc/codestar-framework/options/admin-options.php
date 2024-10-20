<?php if (!defined('ABSPATH')) {die;} // Cannot access directly.



$prefix = '_caozhuti_options';
$tips_6_2 = '';
$tips_6_3 = '';
$tips_6_4 = '';
$tips_6_5 = '';
$tips_6_6 = '';


//
// Create options
//
CSF::createOptions($prefix, array(
    'menu_title' => 'RiPro主题设置',
    'menu_slug'  => 'csf-caozhuti',
));

//
// 基本设置
//
CSF::createSection($prefix, array(
    'title'  => '基本设置',
    'icon'   => 'fa fa-rocket',
    'fields' => array(

        array(
            'id'      => 'site_logo',
            'type'    => 'upload',
            'title'   => '网站LOGO',
            'default' => get_template_directory_uri() . '/assets/images/logo/logo-light.png',
        ),
        array(
            'id'      => 'site_favicon',
            'type'    => 'upload',
            'title'   => 'favicon',
            'default' => get_template_directory_uri() . '/assets/images/favicon/favicon.png',
        ),
        array(
            'id'      => 'is_site_max_width',
            'type'    => 'switcher',
            'title'   => '网站整体使用宽屏模式(nwe)',
            'label'   => '宽屏模式下，文章网格自动为五列模式显示',
            'default' => false,
        ),
        array(
            'id'      => 'is_ripro_blog_style_btn',
            'type'    => 'switcher',
            'title'   => '左下角显示切换博客模式按钮'.$tips_6_2,
            'label'   => '',
            'default' => true,
        ),

        array(
            'id'      => 'is_ripro_dark_btn',
            'type'    => 'switcher',
            'title'   => '左下角显示切换夜间模式按钮',
            'label'   => '',
            'default' => true,
        ),
        
        array(
            'id'         => 'is_ripro_dark',
            'type'       => 'switcher',
            'title'      => '网站默认使用暗黑风格',
            'label'      => '',
            'default'    => false,
        ),

        array(
            'id'      => 'is_site_comments',
            'type'    => 'switcher',
            'title'   => '关闭全站评论',
            'label'   => '评论很多时候没什么用，直接干掉',
            'default' => false,
        ),

        array(
            'id'      => 'is_all_publish_posts',
            'type'    => 'switcher',
            'title'   => '所有人都可投稿',
            'label'   => '关闭后网站仅限有作者权限的用户投稿发布文章',
            'default' => true,
        ),

        array(
            'id'      => 'is_wp_admin_write',
            'type'    => 'switcher',
            'title'   => '使用wp自带后台编辑投稿',
            'label'   => '开启后用户在个人中心投稿，编辑文章都会跳转到wp自带的发布文章和编辑界面,注意如果界面进不去跳回用户中心，请编辑用户-角色-贡献者（投稿），保存即可，如果要新用户注册就有投稿权限，在wp设置-常规-新用户默认角色，编辑保存即可',
            'default' => true,
        ),

        array(
            'id'      => 'is_site_notify',
            'type'    => 'switcher',
            'title'   => '全站弹窗公告',
            'label'   => '开启后用户首次打开网站弹出',
            'default' => true,
        ),
        array(
            'id'         => 'site_notify_title',
            'type'       => 'text',
            'title'      => '全站弹窗公告-标题',
            'desc'       => '例如：RiPro最新版本更新日志',
            'attributes' => array(
                'style' => 'width: 100%;',
            ),
            'default'    => 'RiPro最新版本更新日志',
            'dependency' => array('is_site_notify', '==', 'true'),
        ),
        array(
            'id'         => 'site_notify_desc',
            'type'       => 'textarea',
            'title'      => '全站弹窗公告-内容',
            'desc'       => '全站弹窗公告，通知，纯文本通知弹窗',
            'attributes' => array(
                'style' => 'width: 100%;',
            ),
            'default'    => '这是一条网站公告，可在后台开启或关闭，可自定义背景颜色，标题，内容，用户首次打开关闭后不再重复弹出，此处可使用html标签...',
            'dependency' => array('is_site_notify', '==', 'true'),
        ),
        array(
            'id'         => 'site_notify_color',
            'type'       => 'color',
            'title'      => '全站弹窗公告-背景颜色',
            'default'    => 'rgb(33, 150, 243)',
            'dependency' => array('is_site_notify', '==', 'true'),
        ),
        array(
            'id'         => 'site_kefu_qq',
            'type'       => 'text',
            'title'      => '网站右下角客服QQ按钮',
            'desc'       => '输入您的QQ，不设置则不现实',
            'attributes' => array(
                'style' => 'width: 100%;',
            ),
            'default'    => '88888888',
        ),

    ),
));

//
// SEO设置
//
CSF::createSection($prefix, array(
    'title'  => 'SEO设置',
    'icon'   => 'fa fa-circle',
    'fields' => array(
        array(
            'id'      => 'del_ripro_seo',
            'type'    => 'switcher',
            'title'   => '禁用主题内置的SEO功能',
            'label'   => '有部分会员在用插件做SEO，可以在此关闭S主题自带SEO功能',
            'default' => false,
        ),
        
        array(
            'id'      => 'is_post_meta_og',
            'type'    => 'switcher',
            'title'   => '文章页开启新版OG(open-graph)协议',
            'label'   => '利于SEO，更加容易被社交媒体，新闻等发现收录，规范了文章的链接图片标题和描述',
            'default' => false,
        ),
        

        array(
            'id'     => 'seo',
            'type'   => 'fieldset',
            'title'  => '首页SEO信息',
            'fields' => array(
                array(
                    'id'         => 'web_keywords',
                    'type'       => 'text',
                    'title'      => '网站关键词',
                    'desc'       => '3-5个关键词，用英文逗号隔开',
                    'attributes' => array(
                        'style' => 'width: 100%;',
                    ),
                    'default'    => 'RiPro主题,ritheme,rizhuti.com,rizhuti',
                ),
                array(
                    'id'      => 'web_description',
                    'type'    => 'textarea',
                    'title'   => '网站描述',
                    'default' => 'RiPro主题，用户消费首选的WordPress主题，喜欢你就CAO一下',
                ),

            ),
            'dependency' => array('del_ripro_seo', '==', 'false'),
        ),
        array(
            'id'      => 'connector',
            'type'    => 'text',
            'title'   => '全站链接符',
            'desc'    => '一经选择，切勿更改，对SEO不友好，一般为“-”或“_”',
            'default' => '-',
            'dependency' => array('del_ripro_seo', '==', 'false'),
        ),
        array(
            'id'      => 'no_categoty',
            'type'    => 'switcher',
            'title'   => '分类去除category/前缀',
            'label'   => '',
            'default' => true,
        ),

        array(
            'id'      => 'is_archive_crumbs',
            'type'    => 'switcher',
            'title'   => '禁用文章内页面包屑导航',
            'label'   => '',
            'default' => false,
        ),

    ),
));

//
// Field: 顶部设置
//
CSF::createSection($prefix, array(
    'title'  => '顶部设置',
    'icon'   => 'fa fa-long-arrow-up',
    'fields' => array(
        array(
            'id'      => 'is_header_loaing',
            'type'    => 'switcher',
            'title'   => '全站顶部加载效果'.$tips_6_2,
            'label'   => '就是一个进度条的加载效果',
            'default' => false,
        ),
        array(
            'id'      => 'navbar_style',
            'type'    => 'radio',
            'title'   => '导航风格',
            'inline'  => true,
            'options' => array(
                'sticky'             => esc_html__('跟随', 'cao'),
                'regular'            => esc_html__('常规', 'cao'),
            ),
            'default' => 'sticky',
        ),

        array(
            'id'      => 'is_navbar_newhover',
            'type'    => 'switcher',
            'title'   => '顶部登陆后显示弹出会员大菜单样式',
            'label'   => '鼠标滑到菜单上的用户名时出现一个好看的弹出信息',
            'default' => true,
        ),

        array(
            'id'         => 'navbar_newhover_text1',
            'type'       => 'text',
            'title'      => '大菜单中开通会员介绍1',
            'default'      => '开通会员享受折扣优惠',
            'dependency' => array('is_navbar_newhover', '==', 'true'),
        ),
        array(
            'id'         => 'navbar_newhover_text2',
            'type'       => 'text',
            'title'      => '大菜单中开通会员介绍2',
            'default'      => '限时开放，尊享永久',
            'dependency' => array('is_navbar_newhover', '==', 'true'),
        ),
        array(
            'id'      => 'navbar_newhover_isbtn',
            'type'    => 'switcher',
            'title'   => '显示底部快捷按钮',
            'default' => true,
            'dependency' => array('is_navbar_newhover', '==', 'true'),
        ),

        array(
            'id'      => 'is_navbar_ava_name',
            'type'    => 'switcher',
            'title'   => '顶部右侧菜单只显示头像',
            'label'   => '用户登录后顶部隐藏用户名，只显示头像',
            'default' => false,
        ),

        array(
            'id'      => 'navbar_full',
            'type'    => 'switcher',
            'title'   => '全宽导航',
            'label'   => '',
            'default' => false,
        ),

        array(
            'id'      => 'navbar_slide',
            'type'    => 'switcher',
            'title'   => '滚动时隐藏导航栏',
            'label'   => '',
            'default' => false,
        ),

        array(
            'id'      => 'navbar_hidden',
            'type'    => 'switcher',
            'title'   => '隐藏主菜单',
            'label'   => '',
            'default' => false,
        ),

        array(
            'id'      => 'disable_search',
            'type'    => 'switcher',
            'title'   => '关闭搜索按钮',
            'label'   => '',
            'default' => false,
        ),

        array(
            'id'       => 'web_css',
            'type'     => 'code_editor',
            'title'    => '自定义CSS样式代码（这里美化 不怕更新 哈哈哈）',
            'before'   => '<p class="csf-text-muted"><strong>位于顶部，自定义修改CSS</strong>不用添加<strong>&lt;style></strong>标签</p>',
            'settings' => array(
                'theme' => 'mbo',
                'mode'  => 'css',
            ),
            'sanitize' => false,
            'default'  => '',
        ),

    ),
));

//
// 首页设置: 首页设置
//
CSF::createSection($prefix, array(
    'id'          => 'home_fields',
    'title'       => '首页设置',
    'icon'        => 'fa fa-home',
    'description' => '首页设置',
));

//
// 首页设置: 布局设置
//
CSF::createSection($prefix, array(
    'parent'      => 'home_fields',
    'title'       => '——首页模块布局',
    'icon'        => 'fa fa-home',
    'description' => '拖拽要启用的模块和排序',
    'fields'      => array(
        array(
            'type'    => 'notice',
            'style'   => 'success',
            'content' => '注意，这里模块如果是比较旧的版本升级最新版后不现实新的模块，请重置【当前分区】重新布局拖拽一下，然后再模块参数设置具体参数即可，千万别手贱点击全部重置。',
        ),
        array(
            'id'             => 'home_mode',
            'type'           => 'sorter',
            'title'          => '',
            'enabled_title'  => '显示的模块',
            'disabled_title' => '隐藏',
            'default'        => array(
                'enabled'  => array(
                    'search'  => '搜索条模块',
                    'catbox'  => '分类滑块模块-风格1',
                    'lastpost' => '最新文章模块',
                ),
                'disabled' => array(
                    'slider'  => '幻灯片模块',
                    'codecdk'  => '卡密发放模块',
                    'ulist'   => '纯标题文章模块',
                    'vip'     => '会员介绍模块',
                    'gridpost'  => '网格文章展示模块',
                    'catbox2' => '分类滑块模块-风格2',
                    'catpost' => '分类CMS文章展模块',
                ),
            ),
        ),

    ),
));


//
// 首页幻灯片
//
CSF::createSection($prefix, array(
    'parent' => 'home_fields',
    'title'  => '——幻灯片模块',
    'icon'   => 'fa fa-home',
    'fields' => array(

        // 幻灯片
        array(
            'id'     => 'mode_slider',
            'type'   => 'fieldset',
            'title'  => '',
            'fields' => array(

                array(
                    'id'      => 'autoplay',
                    'type'    => 'switcher',
                    'title'   => '自动播放',
                    'label'   => '',
                    'default' => true,
                ),
                array(
                    'id'      => 'height',
                    'type'    => 'text',
                    'title'   => '自定义幻灯片高度（px）',
                    'default' => '400',
                    'desc' => '默认推荐尺寸： 1920 * 400 px，自适应模式，具体效果前台观察',
                ),

                array(
                    'id'      => 'diy_slider',
                    'type'    => 'switcher',
                    'title'   => '自定义全屏幻灯片图片和链接',
                    'label'   => '关闭后可以以文章内容获自动取幻灯片',
                    'default' => true,
                ),

                array(
                    'id'         => 'diy_data',
                    'type'       => 'group',
                    'title'      => '新建自定义幻灯片',
                    'fields'     => array(

                        array(
                            'id'      => '_title',
                            'type'    => 'text',
                            'title'   => '标题（new）',
                            'default' => 'RiPro主题',
                        ),
                        array(
                            'id'      => '_desc',
                            'type'    => 'text',
                            'title'   => '描述',
                            'default' => 'RiPro是一个优秀的主题，你喜欢的样子我都有！',
                        ),
                        array(
                            'id'          => '_img',
                            'type'        => 'upload',
                            'title'       => '上传幻灯片',
                            'library'     => 'image',
                            'placeholder' => 'http://',
                            'default'     => get_template_directory_uri() . '/assets/images/hero/6.jpg',
                        ),
                        array(
                            'id'      => '_blank',
                            'type'    => 'switcher',
                            'title'   => '新窗口打开链接',
                            'label'   => '',
                            'default' => true,
                        ),
                        array(
                            'id'      => '_href',
                            'type'    => 'text',
                            'title'   => '链接地址',
                            'default' => '#',
                        ),
                    ),
                    'dependency' => array('diy_slider', '==', 'true'),
                ),

                array(
                    'id'         => 'count',
                    'type'       => 'text',
                    'title'      => '显示数量',
                    'default'    => '3',
                    'dependency' => array('diy_slider', '==', 'false'),
                ),
                array(
                    'id'         => 'offset',
                    'type'       => 'text',
                    'title'      => '第几页',
                    'default'    => '0',
                    'dependency' => array('diy_slider', '==', 'false'),
                ),
                array(
                    'id'          => 'category',
                    'type'        => 'select',
                    'title'       => '推荐的推荐的分类（分类下必须有文章）',
                    'placeholder' => '选择一个分类',
                    'options'     => 'categories',
                    'dependency'  => array('diy_slider', '==', 'false'),
                ),

                array(
                    'id'         => 'orderby',
                    'type'       => 'radio',
                    'title'      => '排序',
                    'inline'     => true,
                    'options'    => array(
                        'date'          => esc_html__('日期', 'cao'),
                        'rand'          => esc_html__('随机', 'cao'),
                        'comment_count' => esc_html__('评论数量', 'cao'),
                        'id'            => esc_html__('文章ID', 'cao'),
                    ),
                    'default'    => 'date',
                    'dependency' => array('diy_slider', '==', 'false'),
                ),

                array(
                    'id'         => 'is_styles_rand',
                    'type'       => 'switcher',
                    'title'      => '随机切换幻灯片风格',
                    'label'      => '',
                    'default'    => false,
                    'dependency' => array('diy_slider', '==', 'false'),
                ),
                // 幻灯片风格化
                array(
                    'id'         => 'styles',
                    'type'       => 'image_select',
                    'title'      => '幻灯片风格',
                    'options'    => array(
                        '1' => get_template_directory_uri() . '/assets/images/option/op-slider1.jpg',
                        '2' => get_template_directory_uri() . '/assets/images/option/op-slider2.jpg',
                    ),
                    'default'    => '1',
                    'dependency' => array('diy_slider', '==', 'false'),
                ),

            ),
        ),

    ),
));


//
// 首页搜索条
//
CSF::createSection($prefix, array(
    'parent' => 'home_fields',
    'title'  => '——搜索条模块',
    'icon'   => 'fa fa-home',
    'fields' => array(

        // 搜索条
        array(
            'id'     => 'home_search_mod',
            'type'   => 'fieldset',
            'title'  => '',
            'fields' => array(
                array(
                    'id'      => 'title',
                    'type'    => 'text',
                    'title'   => '搜索条主标题',
                    'desc'    => '',
                    'default' => '搜索本站精品资源',
                ),
                array(
                    'id'      => 'desc',
                    'type'    => 'text',
                    'title'   => '搜索条主标题',
                    'desc'    => '',
                    'default' => '本站所有资源均为高质量资源，各种姿势下载。',
                ),
                array(
                    'id'          => 'bg',
                    'type'        => 'upload',
                    'title'       => '背景图片',
                    'library'     => 'image',
                    'placeholder' => 'http://',
                    'default'     => get_template_directory_uri() . '/assets/images/hero/6.jpg',
                ),
            ),
        ),
        

    ),
));

//
// 首页最新文章模块
//
CSF::createSection($prefix, array(
    'parent' => 'home_fields',
    'title'  => '——最新文章模块'.$tips_6_2,
    'icon'   => 'fa fa-home',
    'fields' => array(
        // 首页最新文章模块
        array(
            'id'     => 'home_last_post',
            'type'   => 'fieldset',
            'title'  => '',
            'fields' => array(
                array(
                    'type'       => 'notice',
                    'style'      => 'success',
                    'content'    => '注意：如需设置首页模块的文章数量对齐，请前往WP的设置-阅读-调整数量即可-一般设置为12最佳，在AJAX模式获取分类文章时候，翻页模式切勿使用自动加载，推荐使用ajax按钮模式',
                ),
                array(
                    'id'       => 'home_title_s',
                    'type'     => 'text',
                    'title'    => '模块显示的标题'.$tips_6_2,
                    'default'  => '最新资源',
                ),
                array(
                    'id'      => 'is_home_cat_nav',
                    'type'    => 'switcher',
                    'title'   => '模块顶部AJAX分类获取文章按钮'.$tips_6_2,
                    'label'   => '设置几个分类按钮，可以无刷新AJAX获取分类的最新文章',
                    'default' => false,
                ),

                array(
                    'id'          => 'nav_cat_id',
                    'type'        => 'select',
                    'title'       => '要显示分类按钮（分类下必须有文章）'.$tips_6_2,
                    'placeholder' => '选择分类',
                    'chosen'      => true,
                    'multiple'    => true,
                    'options'     => 'categories',
                    'dependency' => array('is_home_cat_nav', '==', 'true'),
                ),

                array(
                    'id'          => 'home_postlist_no_cat',
                    'type'        => 'select',
                    'title'       => '首页要排除的分类',
                    'placeholder' => '选择要排除的分类',
                    'chosen'      => true,
                    'multiple'    => true,
                    'options'     => 'categories',
                ),
                

            ),
        ),
        

    ),
));


//
// 首页分类滑块
//
CSF::createSection($prefix, array(
    'parent' => 'home_fields',
    'title'  => '——分类滑块模块',
    'icon'   => 'fa fa-home',
    'fields' => array(
            // 分类快
        array(
            'id'     => 'mode_catbox',
            'type'   => 'fieldset',
            'title'  => '分类块展示-风格1',
            'fields' => array(

                array(
                    'id'          => 'cat_id',
                    'type'        => 'select',
                    'title'       => '要展示的分类（分类下必须有文章）',
                    'placeholder' => '选择4个分类',
                    'chosen'      => true,
                    'multiple'    => true,
                    'options'     => 'categories',
                ),
            ),
        ),

        // 分类快2
        array(
            'id'     => 'mode_catbox2',
            'type'   => 'fieldset',
            'title'  => '分类块展示-风格2',
            'fields' => array(

                array(
                    'id'          => 'cat_id',
                    'type'        => 'select',
                    'title'       => '要展示的分类',
                    'placeholder' => '（分类下必须有文章）',
                    'chosen'      => true,
                    'multiple'    => true,
                    'options'     => 'categories',
                ),

            ),
        ),
        

    ),
));

//
// 首页网格文章展示
//
CSF::createSection($prefix, array(
    'parent' => 'home_fields',
    'title'  => '——网格文章展示模块',
    'icon'   => 'fa fa-home',
    'fields' => array(
        // 网格文章展示
        array(
            'id'     => 'mode_gridpost',
            'type'   => 'fieldset',
            'title'  => '',
            'fields' => array(
                array(
                    'id'          => 'bgimg',
                    'type'        => 'upload',
                    'title'       => '上传背景图',
                    'library'     => 'image',
                    'placeholder' => 'http://',
                    'default'     => get_template_directory_uri() . '/assets/images/background/bg-2.png',
                ),
                array(
                    'id'         => 'posts_1',
                    'type'       => 'text',
                    'title'      => '大图文章ID',
                    'default'    => '1',
                    'desc' => '设置1个要展示的文章ID',
                ),
                array(
                    'id'          => 'posts_4',
                    'type'        => 'select',
                    'title'       => '4小图所属分类（分类下必须有文章）',
                    'placeholder' => '选择一个分类',
                    'options'     => 'categories',
                ),
                array(
                    'id'      => 'orderby',
                    'type'    => 'radio',
                    'title'   => '4小图文章排序',
                    'inline'  => true,
                    'options' => array(
                        'date'          => esc_html__('日期', 'cao'),
                        'rand'          => esc_html__('随机', 'cao'),
                        // 'view' => esc_html__( '查看次数', 'cao' ),
                        'comment_count' => esc_html__('评论数量', 'cao'),
                        'id'            => esc_html__('文章ID', 'cao'),
                    ),
                    'default' => 'date',
                ),

                
            ),
        ),
        

    ),
));

//
// 首页分类CMS文章
//
CSF::createSection($prefix, array(
    'parent' => 'home_fields',
    'title'  => '——分类CMS文章模块',
    'icon'   => 'fa fa-home',
    'fields' => array(
        // 分类CMS
        array(
            'id'     => 'mode_catpost',
            'type'   => 'fieldset',
            'title'  => '',
            'fields' => array(
                array(
                    'id'     => 'catcms',
                    'type'   => 'repeater',
                    'title'  => '无限分类CMS',
                    'fields' => array(

                        array(
                            'id'      => 'count',
                            'type'    => 'text',
                            'title'   => '显示数量',
                            'default' => '8',
                        ),
                        array(
                            'id'          => 'category',
                            'type'        => 'select',
                            'title'       => '推荐的推荐的分类（分类下必须有文章）',
                            'placeholder' => '选择一个分类',
                            'options'     => 'categories',
                        ),

                        array(
                            'id'      => 'orderby',
                            'type'    => 'radio',
                            'title'   => '排序',
                            'inline'  => true,
                            'options' => array(
                                'date'          => esc_html__('日期', 'cao'),
                                'rand'          => esc_html__('随机', 'cao'),
                                // 'view' => esc_html__( '查看次数', 'cao' ),
                                'comment_count' => esc_html__('评论数量', 'cao'),
                                'id'            => esc_html__('文章ID', 'cao'),
                            ),
                            'default' => 'date',
                        ),

                        array(
                            'id'      => 'latest_layout',
                            'type'    => 'image_select',
                            'title'   => '文章布局',
                            'options' => array(
                                'grid' => get_template_directory_uri() . '/assets/images/option/grid.jpg',
                                'list' => get_template_directory_uri() . '/assets/images/option/list.jpg',
                            ),
                            'default' => 'grid',
                        ),

                    ),
                ),
            ),
        ),

    ),
));

//
// 首页纯标题文章
//
CSF::createSection($prefix, array(
    'parent' => 'home_fields',
    'title'  => '——纯标题文章模块',
    'icon'   => 'fa fa-home',
    'fields' => array(
        // 标题文章ulist
        array(
            'id'     => 'mode_ulistpost',
            'type'   => 'fieldset',
            'title'  => '',
            'fields' => array(
                array(
                    'id'     => 'catulist',
                    'type'   => 'repeater',
                    'title'  => '分类ulist',
                    'fields' => array(
                        array(
                            'id'      => 'count',
                            'type'    => 'text',
                            'title'   => '显示数量',
                            'default' => '8',
                        ),
                        array(
                            'id'          => 'category',
                            'type'        => 'select',
                            'title'       => '推荐的推荐的分类',
                            'placeholder' => '选择一个分类',
                            'options'     => 'categories',
                            'desc'     => '（分类下必须有文章）',
                        ),

                        array(
                            'id'      => 'orderby',
                            'type'    => 'radio',
                            'title'   => '排序',
                            'inline'  => true,
                            'options' => array(
                                'date'          => esc_html__('日期', 'cao'),
                                'rand'          => esc_html__('随机', 'cao'),
                                // 'view' => esc_html__( '查看次数', 'cao' ),
                                'comment_count' => esc_html__('评论数量', 'cao'),
                                'id'            => esc_html__('文章ID', 'cao'),
                            ),
                            'default' => 'date',
                        ),

                        array(
                            'id'      => 'desc',
                            'type'    => 'text',
                            'title'   => '描述内容',
                            'default' => '好的东西值得描述内容',
                        ),
                        array(
                            'id'      => 'bgimg',
                            'type'    => 'upload',
                            'title'   => '背景图像',
                            'default' => '',
                        ),

                    ),
                ),
            ),
        ),

    ),
));


//
// 首页卡密发放模块
//
CSF::createSection($prefix, array(
    'parent' => 'home_fields',
    'title'  => '——卡密发放模块',
    'icon'   => 'fa fa-home',
    'fields' => array(
        // 优惠码领取
        array(
            'id'     => 'home_codecdk',
            'type'   => 'fieldset',
            'title'  => '',
            'fields' => array(
                array(
                    'id'          => 'bg',
                    'type'        => 'upload',
                    'title'       => '背景图片',
                    'library'     => 'image',
                    'placeholder' => 'http://',
                    'default'     => get_template_directory_uri() . '/assets/images/background/subscribe-bg.png',
                ),

                array(
                  'id'        => 'home_coupon',
                  'type'      => 'group',
                  'title'     => '添加新的卡密发放',
                  'max'     => '6',
                  'fields'    => array(
                    array(
                      'id'    => '_price',
                      'type'  => 'text',
                      'title' => '卡密面值',
                    ),
                    array(
                      'id'    => '_code',
                      'type'  => 'text',
                      'title' => '卡密代码',
                    ),
                    array(
                      'id'    => '_desc',
                      'type'  => 'text',
                      'title' => '卡密说明',
                    ),
                  ),
                ),
            ),
        ),

    ),
));


//
// 首页会员开通引导模块
//
CSF::createSection($prefix, array(
    'parent' => 'home_fields',
    'title'  => '——会员介绍模块',
    'icon'   => 'fa fa-home',
    'fields' => array(
        // 会员开通引导模块
        array(
            'id'     => 'home_vip_mod',
            'type'   => 'fieldset',
            'title'  => '',
            'fields' => array(
                array(
                    'id'      => 'title',
                    'type'    => 'text',
                    'title'   => '主标题',
                    'dsec'    => '',
                    'default' => '加入本站会员<br>开启尊贵特权之体验',
                ),
                array(
                    'id'      => 'desc',
                    'type'    => 'textarea',
                    'title'   => '描述',
                    'dsec'    => '',
                    'default' => '本站资源支持会员下载专享，普通注册会员只能原价购买资源或者限制免费下载次数，付费会员所有资源可无限下载。并可享受资源折扣或者免费下载。',
                ),

                array(
                    'id'     => 'vip_group',
                    'type'   => 'group',
                    'title'  => '添加介绍',
                    'max'    => '3',
                    'fields' => array(
                        array(
                            'id'      => '_time',
                            'type'    => 'text',
                            'title'   => '时长',
                            'default' => '一个月',
                        ),
                        array(
                            'id'      => '_price',
                            'type'    => 'text',
                            'title'   => '价格',
                            'default' => '10',
                        ),
                        array(
                            'id'      => '_tehui',
                            'type'    => 'text',
                            'title'   => '优惠信息',
                            'default' => '限时优惠',
                        ),
                        array(
                            'id'      => '_desc',
                            'type'    => 'textarea',
                            'title'   => '描述',
                            'default' => 'VIP专享资源<br>1个月无限下载次数<br>享受资源专属折扣<br>第一时间获取优质资源',
                        ),
                        array(
                            'id'      => '_color',
                            'type'    => 'color',
                            'title'   => '模块自定义主颜色',
                            'desc'    => '',
                            'default' => '#34495e',
                        ),
                    ),
                ),

            ),
        ),

    ),
));




//
// 列表设置
//
CSF::createSection($prefix, array(
    'title'  => '列表设置',
    'icon'   => 'fa fa-th-list',
    'fields' => array(
        array(
            'id'      => 'site_list_style',
            'type'    => 'image_select',
            'title'   => '全站整体风格模式'.$tips_6_2,
            'options' => array(
                'default' => get_template_directory_uri() . '/assets/images/option/op-default.jpg',
                'blog' => get_template_directory_uri() . '/assets/images/option/op-blog.jpg',
            ),
            'desc' => '可以启用博客模式布局，也可以使用经典的ripro网格布局。博客模式请到外观-小工具-配置博客侧边栏，博客模式下将强制文章列表横排一列',
            'default' => 'default',
        ),

        array(
            'id'      => 'post_tim_rload',
            'type'    => 'switcher',
            'title'   => '鼠标划过文章网格加载动效（新）',
            'label'   => '',
            'default' => false,
        ),

        array(
            'id'      => 'target_blank',
            'type'    => 'switcher',
            'title'   => '新窗口打开文章',
            'label'   => '',
            'default' => false,
        ),

        array(
            'id'      => 'latest_layout',
            'type'    => 'image_select',
            'title'   => '内页默认文章列表排版'.$tips_6_2,
            'options' => array(
                'grid' => get_template_directory_uri() . '/assets/images/option/grid.jpg',
                'list' => get_template_directory_uri() . '/assets/images/option/list.jpg',
            ),
            'default' => 'grid',
            'desc' => '仅在非博客布局模式下有效，单独控制某个分类的排版请到分类-编辑里进行设置即可，具体效果多设置前台观察',
        ),

        array(
            'id'      => 'is_mobele_list',
            'type'    => 'switcher',
            'title'   => '手机端使用列表模式（全部）',
            'label'   => '',
            'default' => true,
        ),

        // 是否显示摘要文字
        array(
            'id'      => 'grid_is_favbtn',
            'type'    => 'switcher',
            'title'   => '显示快速收藏按钮',
            'label'   => '',
            'default' => false,
        ),
        array(
            'id'      => 'post_is_timeago',
            'type'    => 'switcher',
            'title'   => '近期文章是否显示几天前几小时格式',
            'label'   => '',
            'default' => true,
        ),

        array(
            'id'      => 'grid_is_excerpt',
            'type'    => 'switcher',
            'title'   => '显示摘要[grid模式]',
            'label'   => '',
            'default' => false,
        ),
        array(
            'id'      => '_site_excerpt_length',
            'type'    => 'text',
            'title'   => '摘要字数',
            'dsec'    => '统一字数可以解决摘要文字太多不美观问题',
            'default' => '42',
        ),

        array(
            'id'      => 'grid_is_author',
            'type'    => 'switcher',
            'title'   => '显示作者头像',
            'label'   => '',
            'default' => true,
        ),

        array(
            'id'      => 'grid_is_time',
            'type'    => 'switcher',
            'title'   => '显示日期',
            'label'   => '',
            'default' => true,
        ),
        array(
            'id'      => 'grid_is_views',
            'type'    => 'switcher',
            'title'   => '显示阅读数量',
            'label'   => '',
            'default' => true,
        ),
        array(
            'id'      => 'grid_is_coments',
            'type'    => 'switcher',
            'title'   => '显示评论数',
            'label'   => '',
            'default' => false,
        ),
        array(
            'id'      => 'grid_is_price',
            'type'    => 'switcher',
            'title'   => '显示价格',
            'label'   => '',
            'default' => true,
        ),
        array(
            'id'      => 'pagination',
            'type'    => 'radio',
            'title'   => '翻页按钮',
            'inline'  => true,
            'options' => array(
                'navigation'      => esc_html__('上下页', 'cao'),
                'numeric'         => esc_html__('数字分页', 'cao'),
                'infinite_button' => esc_html__('AJAX + 按钮', 'cao'),
                'infinite_scroll' => esc_html__('AJAX + 自动', 'cao'),
            ),
            'default' => 'infinite_button',
        ),

        array(
            'id'        => 'post_default_thumb',
            'type'      => 'media',
            'title'     => '文章默认缩略图',
            'add_title' => '上传图片',
            'desc'      => '设置文章默认缩略图（建议和自定义文章缩略图宽高保持一致）',
            'default'   => array('url' => get_template_directory_uri() . '/assets/images/thumb/1.jpg'),
        ),
        
        array(
            'id'      => 'thumbnail_def_get_size',
            'type'    => 'radio',
            'title'   => '默认获取缩略图尺寸',
            'desc'    => '默认获取缩略图的原图大小，如果网站图片较多可以选择为最小，原图，（大，中，小，对应wordpress设置里-媒体-大尺寸
，中等尺寸，缩略图）',
            'options' => array(
                'thumbnail' => '缩略图尺寸',
                'medium'  => '中等尺寸',
                'large'  => '大尺寸',
                'full'  => '原图大小',
            ),
            'default' => 'thumbnail',
        ),
        
        array(
            'id'      => 'thumbnail_handle',
            'type'    => 'radio',
            'title'   => '缩略图裁剪模式',
            'desc'    => '默认为timthumb.php模式，如果有外链图片不显示缩略图，请设置外链域名白名单，<a href="https://www.kancloud.cn/rizhuti/ritheme/1837353#timthumbphp_10" target="_blank" rel="nofollow">设置教程</a>',
            'options' => array(
                'timthumb_php' => 'timthumb.php裁剪（可保持缩略图大小一致）',
                'timthumb_mi'  => 'WP自带裁剪',
                'other'  => '自定义参数（例如OSS裁剪模式）',
            ),
            'default' => 'timthumb_mi',
        ),

        array(
            'id'         => 'thumbnail_other',
            'type'       => 'text',
            'title'      => '自定义缩略图文件后缀参数',
            'desc'       => "一般用于第三方储存裁剪，例如OSS在图片地址后加（?x-oss-process=image/resize,m_fill,h_180,w_300）,h_高度，w_宽度 ,<br>原理说明，例如本身图片地址是：https://本站域名.com/wp-content/uploads/2019/08/a.jpg，使用插件接入oss后是https://oss域名.com/wp-content/uploads/2019/08/a.jpg，加入自定义参数后是，https://oss域名.com/wp-content/uploads/2019/08/a.jpg?x-oss-process=image/resize,m_fill,h_180,w_300，这样就实现oss裁剪",
            'default'    => '?x-oss-process=image/resize,m_fill,h_180,w_300',
            'dependency' => array('thumbnail_handle', '==', 'other'),
        ),


        array(
            'id'      => 'thumbnail-px',
            'type'    => 'dimensions',
            'title'   => '自定义文章缩略图宽高',
            'default' => array(
                'width'  => '300',
                'height' => '200',
                'unit'   => 'px',
            ),
        ),

        array(
            'id'      => 'thumb_postfirstimg_s',
            'type'    => 'switcher',
            'title'   => '自动抓取缩略图',
            'label'   => '文章没有缩略图的情况下搜多第一张站内图片作为缩略图,可能会导致文章缩略图不整齐！',
            'default' => true,
        ),

        array(
            'id'      => 'set_postthumbnail',
            'type'    => 'switcher',
            'title'   => '自动保存文章第一张图片为缩略图',
            'label'   => '设置本地发布时候上传的第一张图片为缩略图',
            'default' => true,
        ),

    ),
));

//
// Field: 文章内页设置
//
CSF::createSection($prefix, array(
    'title'  => '内页设置'.$tips_6_4,
    'icon'   => 'fa fa-circle',
    'fields' => array(
        array(
            'id'         => 'cao_lazy_content_images',
            'type'       => 'switcher',
            'title'      => '文章内容中的图片使用延迟加载'.$tips_6_4,
            'dsec'       => '注意：如果有个别采集或者复制的图片不显示请不要开启，对于wp后台插入的图片完美兼容',
        ),
        array(
            'id'         => 'zhuanti_postnum',
            'type'       => 'text',
            'title'      => '存档页展示文章数量(4.6)',
            'dsec'       => '设置存档页面的文章数量',
            'default'    => '30',
        ),
        array(
            'id'         => 'deft_term_bar_img',
            'type'       => 'upload',
            'title'      => '分类等内页顶部背景图片',
            'dsec'       => '如果没有文章图片或者其他页面没有图片则用此图片显示美化',
            'default'    => get_template_directory_uri() . '/assets/images/hero/6.jpg',
        ),
        array(
            'id'      => 'is_fancybox_img_one',
            'type'    => 'switcher',
            'title'   => '所有分类等内页顶部背景图固定一张',
            'label'   => '',
            'default' => false,
        ),

        array(
            'id'      => 'is_fancybox_img',
            'type'    => 'switcher',
            'title'   => '点击文章内图片自动灯箱',
            'label'   => '将插入的图片指向链接为媒体文件即可实现',
            'default' => true,
        ),

        array(
            'id'      => 'post_copyright_s',
            'type'    => 'switcher',
            'title'   => '文章底部版权',
            'label'   => '',
            'default' => true,
        ),

        array(
            'id'      => 'post_copyright',
            'type'    => 'textarea',
            'title'   => '文章底部版权内容',
            'desc'    => '',
            'default' => 'RIPRO主题是一个优秀的主题，极致后台体验，无插件，集成会员系统',
        ),

        array(
            'id'      => 'single_disable_author_box',
            'type'    => 'switcher',
            'title'   => '显示作者信息',
            'label'   => '',
            'default' => true,
        ),

        array(
            'id'      => 'disable_related_posts',
            'type'    => 'switcher',
            'title'   => '相关文章推荐'.$tips_6_2,
            'label'   => '',
            'default' => true,
        ),
        array(
            'id'         => 'related_posts_num',
            'type'       => 'text',
            'title'      => '相关文章显示数量'.$tips_6_2,
            'dsec'       => '',
            'default'    => '4',
        ),
        array(
            'id'         => 'related_posts_style',
            'type'       => 'select',
            'title'      => '相关文章显示位置风格'.$tips_6_2,
            'options'     => array(
                'grid'     => '新文章底部-标准网格',
                // 'list'     => '新文章底部-标准纯标题',
                'fullgrid'     => '旧版文章底部-全宽网格',
            ),
            'default'    => 'grid',
            'dependency' => array('disable_related_posts', '==', 'true'),
        ),

        // 分享设置
        array(
            'id'      => 'post_share_mod',
            'type'    => 'switcher',
            'title'   => '关闭文章底部所有分享组件(4.6)',
            'label'   => '关闭后分享组件将不展示',
            'default' => false,
        ),

        array(
            'id'      => 'poster_share_open',
            'type'    => 'switcher',
            'title'   => '海报功能开启',
            'default' => false,
        ),

        array(
            'id'         => 'poster_logo',
            'type'       => 'upload',
            'title'      => '左下角LOGO',
            'dsec'       => '上传一张显示在封面底部的LOGO',
            'default'    => get_template_directory_uri() . '/assets/images/logo/logo-dark.png',
            'dependency' => array('poster_share_open', '==', 'true'),
        ),

        array(
            'id'         => 'poster_desc',
            'type'       => 'text',
            'title'      => '网站宣传语',
            'dsec'       => '显示在LOGO下方的一句宣传语',
            'default'    => '扫码识别右侧二维码阅读全文',
            'dependency' => array('poster_share_open', '==', 'true'),
        ),

    ),
));

//
// Field: 文章内页设置
//
CSF::createSection($prefix, array(
    'title'  => '分类页筛选(新)',
    'icon'   => 'fa fa-circle',
    'fields' => array(
        array(
            'id'      => 'is_filter_bar',
            'type'    => 'switcher',
            'title'   => '分类内页禁用筛选',
            'label'   => '全站，如需个别分类关闭请到分类编辑单独定制即可',
            'default' => false,
        ),

        array(
            'id'         => 'is_filter_item_cat',
            'type'       => 'switcher',
            'title'      => '启用内页一级分类筛选',
            'label'      => '',
            'default'    => true,
            'dependency' => array('is_filter_bar', '==', 'false'),
        ),
        array(
            'id'          => 'archive_filter_cat_1',
            'type'        => 'select',
            'title'       => '一级主分类筛选配置',
            'desc'        => '排序规则以设置的顺序为准',
            'placeholder' => '选择分类',
            'inline'      => true,
            'chosen'      => true,
            'multiple'    => true,
            'options'     => 'categories',
            'query_args'  => array(
                'orderby' => 'count',
                'order'   => 'DESC',
                'parent'  => 0,
            ),
            'dependency' => array('is_filter_item_cat', '==', 'true'),
        ),
        
        array(
            'id'         => 'is_filter_item_cat2',
            'type'       => 'switcher',
            'title'      => '启用二级分类筛选',
            'label'      => '当前筛选条件分类下如果有二级分类 自动显示二级分类',
            'default'    => true,
            'dependency' => array('is_filter_bar', '==', 'false'),
        ),
        array(
            'id'         => 'is_filter_item_cat3',
            'type'       => 'switcher',
            'title'      => '启用三级分类筛选',
            'label'      => '当前筛选条件分类下的二级分类有三级分类则自动显示三级分类',
            'default'    => true,
            'dependency' => array('is_filter_bar', '==', 'false'),
        ),
        array(
            'id'      => 'is_filter_item_cat_orderby',
            'type'    => 'radio',
            'title'   => '分类筛选排序方式'.$tips_6_2,
            'inline'  => true,
            'options' => array(
                'id'    => esc_html__('分类ID', 'cao'),
                'name' => esc_html__( '分类名称', 'cao' ),
                'count' => esc_html__('文章数量', 'cao'),
            ),
            'default' => 'id',
        ),

        array(
            'id'         => 'is_filter_item_tags',
            'type'       => 'switcher',
            'title'      => '启用相关标签筛选',
            'label'      => '有相关标签 自动显示',
            'default'    => true,
            'dependency' => array('is_filter_bar', '==', 'false'),
        ),
       array(
            'id'      => 'filter_item_tags_num',
            'type'    => 'text',
            'title'   => '相关标签筛选展示数量',
            'default' => '10',
            'dependency' => array('is_filter_item_tags', '==', 'true'),
        ),

        array(
            'id'         => 'is_filter_item_price',
            'type'       => 'switcher',
            'title'      => '启用价格快速筛选',
            'label'      => '',
            'default'    => true,
            'dependency' => array('is_filter_bar', '==', 'false'),
        ),
        array(
            'id'         => 'is_filter_item_order',
            'type'       => 'switcher',
            'title'      => '启用排序筛选',
            'label'      => '',
            'default'    => true,
            'dependency' => array('is_filter_bar', '==', 'false'),
        ),

        // 高级自定义文章属性-筛选 感谢会员昵称 股东·烧饼 QQ：6337766 的赞助和监督
        array(
            'id'      => 'is_custom_post_meta_opt',
            'type'    => 'switcher',
            'title'   => '高级自定义文章字段属性',
            'desc'    => '主要用于增强筛选细化资源，高级自定义文章字段属性<b><font color="red">每个字段名称，必须有两个或两个字段选项，否则会报错</font></b>',
            'default' => false,
        ),
        array(
            'id'         => 'custom_post_meta_opt',
            'type'       => 'group',
            'title'      => '自定义字段设置',
            'max'        => '50',
            'fields'     => array(
                
                array(
                    'id'      => 'meta_name',
                    'type'    => 'text',
                    'title'   => '字段名称',
                    'default' => '字段1',
                ),
                array(
                    'id'      => 'meta_ua',
                    'type'    => 'text',
                    'title'   => '字段英文标识',
                    'default' => 'my_meta_1',
                ),
                array(
                    'id'          => 'meta_category',
                    'type'        => 'select',
                    'title'       => '只在该分类下显示高级筛选属性',
                    'placeholder' => '全部显示',
                    'chosen'      => true,
                    'multiple'    => true,
                    'options'     => 'categories',
                ),
                array(
                    'id'     => 'meta_opt',
                    'type'   => 'group',
                    'title'  => '字段选项',
                    'fields' => array(
                        array(
                            'id'      => 'opt_name',
                            'type'    => 'text',
                            'title'   => '选项中文名称',
                            'default' => '字段选项1',
                        ),
                        array(
                            'id'      => 'opt_ua',
                            'type'    => 'text',
                            'title'   => '选项英文标识',
                            'default' => 'opt_1',
                        ),
                    ),
                ),

            ),
            'dependency' => array('is_custom_post_meta_opt', '==', 'true'),
        ),

    ),
));


//
// Basic 商城设置
//
CSF::createSection($prefix, array(
    'id'    => 'shop_fields',
    'title' => '商城设置(新)',
    'icon'  => 'fa fa-plus-circle',
));

//
// 商城-核心设置
//
CSF::createSection($prefix, array(
    'parent' => 'shop_fields',
    'title'  => '初始设置'.$tips_6_2,
    'icon'   => 'fa fa-circle',
    'fields' => array(

        // 自定义商品名称
        array(
            'id'       => 'is_ripro_diy_shop_name',
            'type'     => 'switcher',
            'title'    => '自定义订单商品资源名称',
            'desc'    => '自定义订单时商品名称，防止各别支付接口不允许虚拟资源交易问题影响付款，仅在支付平台窗口显示，例如默认是XXX站资源购买，自定义为（商品自助购买）后支付窗口显示订单中的商品名称为（商品自助购买），防止各别接口不允许没有资质进行虚拟资源收款问题,，经会员反应，如果是用的是非企业支付接口，或者是个人当面付接口，建议修改，防止官方停用你个人的支付接口',
            'default'  => false,
        ),

        array(
            'id'         => 'ripro_diy_shop_name_pay',
            'type'       => 'text',
            'title'      => '购买资源时显示的订单名称',
            'desc'       => '单独购买资源时显示订单名称',
            'default'    => '商品自助购买',
            'dependency' => array('is_ripro_diy_shop_name', '==', 'true'),
        ),
        array(
            'id'         => 'ripro_diy_shop_name_charge',
            'type'       => 'text',
            'title'      => '会员中心充值时显示的订单名称',
            'desc'       => '会员中心充值时显示的订单名称',
            'default'    => '商品自助购买',
            'dependency' => array('is_ripro_diy_shop_name', '==', 'true'),
        ),


        array(
            'id'       => 'is_ripro_free_no_login',
            'type'     => 'switcher',
            'title'    => '免费资源不需要登录即可直接下载查看',
            'default'  => false,
        ),
        //新增免登陆购买模式和全新付款方式弹窗，如此真诚的开发我们希望您能支持正版 感谢支持 vip.ylit.cc
        array(
            'id'      => 'is_ripro_nologin_pay',
            'type'    => 'switcher',
            'title'   => '开启RiPro免登陆购买支持',
            'label'   => '此功能过于牛逼，没啥好说的',
            'default' => true,
        ),
        array(
            'id'         => 'ripro_nologin_payKey',
            'type'       => 'text',
            'title'      => '免登陆购买临时密钥',
            'desc'       => '设置随机6-18位字符串，防止被人恶意请求安全验证和检测用',
            'default'       => 'WOAI_RiPro_666',
            'attributes'  => array(
                'type'      => 'password',
                'autocomplete' => 'off',
            ),
            'dependency' => array('is_ripro_nologin_pay', '==', 'true'),
        ),
        array(
            'id'         => 'ripro_nologin_days',
            'type'       => 'text',
            'title'      => '免登录购买后有效期天数',
            'desc'       => '游客购买的时候会利用浏览器缓存技术记录游客购买的凭证密钥，在游客不清楚自己浏览器缓存数据的情况下，默认有效期天数',
            'default'    => 7,
            'dependency' => array('is_ripro_nologin_pay', '==', 'true'),
            'attributes' => array(
                'style'    => 'width: 100px;'
            ),
        ),

        array(
            'id'      => 'ripro_expire_day',
            'type'    => 'text',
            'title'   => '登录用户默认购买有效期天数',
            'default' => '0',
            'desc'    => '0 无限期；N天后失效需要重新购买，如果文章有单独设置天数则文章设置的天数优先级最高',
            'attributes' => array(
                'style'    => 'width: 100px;'
            ),
        ),

        array(
            'id'      => 'is_online_pay_status',
            'type'    => 'switcher',
            'title'   => '已登录用户在线支付开关',
            'label'   => '例如你想让登录用户使用余额消费，可以关闭在线支付付款方式，只能使用余额付款',
            'default' => true,
        ),

        array(
            'id'      => 'is_online_pay_reta',
            'type'    => 'switcher',
            'title'   => _cao('site_vip_name').'用户在线支付折扣支付开关',
            'label'   => '例如你想让用户尽量使用余额消费，可以关闭在线支付折扣，这样就只有余额支付才享受会员折扣',
            'default' => true,
            'dependency' => array('is_online_pay_status', '==', 'true'),
        ),

        array(
            'id'      => 'site_money_ua',
            'type'    => 'text',
            'title'   => '网站货币名称',
            'default' => '积分',
            'desc'    => '例如：积分，CB',
            'attributes' => array(
                'style'    => 'width: 100px;'
            ),
        ),
        array(
            'id'      => 'site_money_icon',
            'type'    => 'icon',
            'title'   => '网站货币图标',
            'default' => 'fa fa-paypal',
        ),
        array(
            'id'      => 'site_change_rate',
            'type'    => 'text',
            'title'   => '网站充值比例（必须是正整数1~10000）',
            'default' => '10',
            'desc'    => '默认：1元等于10个货币(建议一次设置好，后续谨慎更改，会影响后台订单的汇率)',
            'attributes' => array(
                'style'    => 'width: 100px;'
            ),
        ),
        array(
            'id'      => 'min_cahrge_num',
            'type'    => 'text',
            'title'   => '网站最低充值' . _cao('site_money_ua') . '数量'.$tips_6_2,
            'default' => '1',
            'desc'    => '默认：1 (注意换算自己的比例，单位为网站货币)',
            'attributes' => array(
                'style'    => 'width: 100px;'
            ),
        ),
        array(
            'id'      => 'max_cahrge_num',
            'type'    => 'text',
            'title'   => '网站最高充值' . _cao('site_money_ua') . '数量'.$tips_6_2,
            'default' => '1000',
            'desc'    => '默认：1000 (注意换算自己的比例，单位为网站货币)',
            'attributes' => array(
                'style'    => 'width: 100px;'
            ),
        ),

        array(
            'id'      => 'site_no_vip_name',
            'type'    => 'text',
            'title'   => '网站普通用户标识',
            'default' => '普通',
            'desc'    => '例如：VIP，普通，平民',
            'attributes' => array(
                'style'    => 'width: 100px;'
            ),
        ),

        array(
            'id'      => 'site_vip_name',
            'type'    => 'text',
            'title'   => '网站付费用户标识',
            'default' => '钻石',
            'desc'    => '例如：SVIP，会员，皇帝',
            'attributes' => array(
                'style'    => 'width: 100px;'
            ),
        ),
        
         // 启用传统跳转下载链接模式
        array(
            'id'      => 'is_nojs_downurl_blank',
            'type'    => 'switcher',
            'title'   => '启用传统跳转下载链接模式',
            'label'   => '部分浏览器，手机端下载时弹窗不弹出或者跳转下载地址，可用启用传统按钮跳转链接模式',
            'default' => false,
        ),
        
        

    ),
));
//
// 商城-支付配置
//
CSF::createSection($prefix, array(
    'parent' => 'shop_fields',
    'title'  => '支付配置（NEW）',
    'icon'   => 'fa fa-circle',
    'fields' => array(
        array(
            'type'       => 'notice',
            'style'      => 'success',
            'content'    => '支付宝配置教程在会员群有文档!<br/>本支付会自动判断，如果是PC则是扫码支付，如果是手机，则自动跳转手机H5支付',
            'dependency' => array('alpay', '==', 'true'),
        ),
        // 卡密开关
        array(
            'id'      => 'is_cdk_charge',
            'type'    => 'switcher',
            'title'   => '卡密充值开关',
            'label'   => '关闭后则不显示卡密充值方式',
            'default' => true,
        ),

        array(
            'id'         => 'cdk_charge_href',
            'type'       => 'text',
            'title'      => '卡密购买地址（可以填写发卡平台的购买地址）',
            'desc'       => '不填写则不开启该按钮',
            'dependency' => array('is_cdk_charge', '==', 'true'),
        ),

        // 支付宝配置
        array(
            'id'      => 'is_alipay',
            'type'    => 'switcher',
            'title'   => '支付宝（企业支付）',
            'label'   => '',
            'default' => true,
        ),
        array(
            'id'         => 'alipay',
            'type'       => 'fieldset',
            'title'      => '配置详情',
            'fields'     => array(

                array(
                    'id'    => 'pid',
                    'type'  => 'text',
                    'title' => '(mapi网关)-合作伙伴身份PID',
                ),
                array(
                    'id'    => 'md5Key',
                    'type'  => 'text',
                    'title' => '(mapi网关)-MD5密钥',
                    'attributes'  => array(
                        'type'      => 'password',
                        'autocomplete' => 'off',
                    ),
                ),
                // array(
                //   'id'    => 'acc',
                //   'type'  => 'text',
                //   'title' => '(mapi网关)-卖家支付宝账号',
                // ),
                array(
                    'id'      => 'is_mobile',
                    'type'    => 'switcher',
                    'title'   => '手机端自动跳转支付',
                    'label'   => '(需签约手机网站支付产品，只支持手机浏览器打开唤醒APP支付，并不能在应用内，如QQ/微信/支付宝内部浏览器无效)',
                    'default' => false,
                ),

                // 开放平台-当面付
                array(
                    'id'      => 'is_pcqr',
                    'type'    => 'switcher',
                    'title'   => '当面付-扫码支付',
                    'label'   => '扫码支付体验就是好（需签约当面付）',
                    'default' => false,
                ),
                array(
                    'id'         => 'appid',
                    'type'       => 'text',
                    'title'      => '开放平台-应用appid',
                    'dependency' => array('is_pcqr', '==', 'true'),
                    'attributes'  => array(
                        'type'      => 'password',
                        'autocomplete' => 'off',
                    ),
                ),
                array(
                    'id'         => 'privateKey',
                    'type'       => 'textarea',
                    'title'      => '开放平台-应用私钥',
                    'dependency' => array('is_pcqr', '==', 'true'),

                ),
                array(
                    'id'         => 'publicKey',
                    'type'       => 'textarea',
                    'title'      => '开放平台-支付宝公钥',
                    'dependency' => array('is_pcqr', '==', 'true'),
                ),

            ),
            'dependency' => array('is_alipay', '==', 'true'),
        ),

        // 微信支付配置
        array(
            'id'      => 'is_weixinpay',
            'type'    => 'switcher',
            'title'   => '微信支付（企业支付）',
            'label'   => '',
            'default' => false,
        ),
        array(
            'id'         => 'weixinpay',
            'type'       => 'fieldset',
            'title'      => '配置详情',
            'fields'     => array(
                array(
                    'id'      => 'mch_id',
                    'type'    => 'text',
                    'title'   => '微信支付商户号',
                    'desc'    => '微信支付商户号 PartnerID 通过微信支付商户资料审核后邮件发送',
                    'default' => '',
                ),
                array(
                    'id'      => 'appid',
                    'type'    => 'text',
                    'title'   => '公众号或小程序APPID',
                    'desc'    => '公众号APPID 通过微信支付商户资料审核后邮件发送',
                    'default' => '',
                ),
                array(
                    'id'      => 'key',
                    'type'    => 'text',
                    'title'   => '微信支付API密钥',
                    'desc'    => '帐户设置-安全设置-API安全-API密钥-设置API密钥',
                    'default' => '',
                    'attributes'  => array(
                        'type'      => 'password',
                        'autocomplete' => 'off',
                    ),
                ),
                array(
                    'id'      => 'is_jsapi',
                    'type'    => 'switcher',
                    'title'   => 'JSAPI支付'.$tips_6_3,
                    'label'   => '微信端内打开可以直接发起支付，开启此项需要登录注册里开启公众号登录，开启后网站用户在微信内登录后可以直接支付，免登录无法绑定openid暂不支持jsapi模式',
                    'default' => true,
                ),
                array(
                    'id'      => 'is_mobile',
                    'type'    => 'switcher',
                    'title'   => '手机跳转H5支付',
                    'label'   => '移动端自动自动切换为跳转支付（需开通H5支付，只支持手机浏览器打开唤醒APP支付，并不能在应用内，如QQ/微信/支付宝内部浏览器无效）',
                    'default' => false,
                ),
            ),
            'dependency' => array('is_weixinpay', '==', 'true'),
        ),

        
        //虎皮椒V3 微信支付
        array(
            'id'      => 'is_xunhupay',
            'type'    => 'switcher',
            'title'   => '虎皮椒V3-微信支付',
            'label'   => ' 最新的虎皮椒V3版，微信完美收款，无企业商户资质推荐用此方法完美替代*_* ',
            'default' => false,
        ),
        array(
            'id'         => 'xunhupay',
            'type'       => 'fieldset',
            'title'      => '配置详情',
            'fields'     => array(
                array(
                    'type'    => 'notice',
                    'style'   => 'success',
                    'content' => '虎皮椒V3 <a target="_blank" href="https://admin.xunhupay.com/sign-up/4123.html" style=" color: red; font-weight: 600; ">-->>注册地址</a><br/>如测试可使用测试mchid和密钥进行。但只支持0.1元付款测试<br/>',
                ),
                array(
                    'id'      => 'is_pop_qrcode',
                    'type'    => 'switcher',
                    'title'   => '启用牛逼的弹窗扫码支付-全网独家（新）',
                    'label'   => '如虎皮椒接口更新等导致不弹出二维码可关闭使用原生跳转支付模式',
                    'default' => true,
                ),
                array(
                    'id'      => 'appid',
                    'type'    => 'text',
                    'title'   => 'APPID',
                    'desc'    => 'APPID（测试：201906130530）',
                    'default' => '',
                ),
                array(
                    'id'      => 'appsecret',
                    'type'    => 'text',
                    'title'   => 'APPSECRET',
                    'desc'    => '密钥（测试：e97a75d2ee14e353fa745f7c47d23ed0）',
                    'default' => '',
                    'attributes'  => array(
                        'type'      => 'password',
                        'autocomplete' => 'off',
                    ),
                ),
                array(
                    'id'      => 'url_do',
                    'type'    => 'text',
                    'title'   => '支付网关',
                    'desc'    => '一般不用动，如虎皮椒官方有调整手动更新即可',
                    'default' => 'https://api.xunhupay.com/payment/do.html',
                ),

            ),
            'dependency' => array('is_xunhupay', '==', 'true'),
        ),

        //虎皮椒V3 支付宝支付
        array(
            'id'      => 'is_xunhualipay',
            'type'    => 'switcher',
            'title'   => '虎皮椒V3-支付宝支付',
            'label'   => ' 最新的虎皮椒V3版，支付宝完美收款，无企业商户资质推荐用此方法完美替代*_*',
            'default' => false,
        ),
        array(
            'id'         => 'xunhualipay',
            'type'       => 'fieldset',
            'title'      => '配置详情',
            'fields'     => array(
                array(
                    'type'    => 'notice',
                    'style'   => 'success',
                    'content' => '虎皮椒V3 <a target="_blank" href="https://admin.xunhupay.com/sign-up/4123.html" style=" color: red; font-weight: 600; ">-->>注册地址</a><br/>如测试可使用测试mchid和密钥进行。但只支持0.1元付款测试<br/>',
                ),
                array(
                    'id'      => 'is_pop_qrcode',
                    'type'    => 'switcher',
                    'title'   => '启用牛逼的弹窗扫码支付-全网独家（新）',
                    'label'   => '如虎皮椒接口更新等导致不弹出二维码可关闭使用原生跳转支付模式',
                    'default' => true,
                ),
                array(
                    'id'      => 'appid',
                    'type'    => 'text',
                    'title'   => 'APPID',
                    'desc'    => 'APPID',
                    'default' => '',
                ),
                array(
                    'id'      => 'appsecret',
                    'type'    => 'text',
                    'title'   => 'APPSECRET',
                    'desc'    => '密钥',
                    'default' => '',
                    'attributes'  => array(
                        'type'      => 'password',
                        'autocomplete' => 'off',
                    ),
                ),
                array(
                    'id'      => 'url_do',
                    'type'    => 'text',
                    'title'   => '支付网关',
                    'desc'    => '一般不用动，如虎皮椒官方有调整手动更新即可',
                    'default' => 'https://api.xunhupay.com/payment/do.html',
                ),

            ),
            'dependency' => array('is_xunhualipay', '==', 'true'),
        ),

        //XUNHUPAY ALI 注册地址：https://admin.xunhuweb.com/register/0ddbfa6c701f4f309e8d0bd99cdcc513
        array(
            'id'      => 'is_xunhupay_ali',
            'type'    => 'switcher',
            'title'   => '迅虎支付-支付宝支付',
            'label'   => '当前是新版迅虎支付，支付宝完美收款，无资质可以用此方法完美替代*_*',
            'default' => false,
        ),
        array(
            'id'         => 'xunhupay_ali',
            'type'       => 'fieldset',
            'title'      => '配置详情',
            'fields'     => array(
                array(
                    'type'    => 'notice',
                    'style'   => 'success',
                    'content' => '讯虎支付 <a target="_blank" href="https://admin.xunhuweb.com/register/0ddbfa6c701f4f309e8d0bd99cdcc513" style=" color: red; font-weight: 600; ">-->>注册地址</a><br/>如测试可使用测试mchid和密钥进行。但只支持0.1元付款测试<br/>',
                ),
                array(
                    'id'      => 'mchid',
                    'type'    => 'text',
                    'title'   => 'MCHID',
                    'desc'    => 'MCHID（测试：a0e5b19a8b4047c88184412997a421d1）',
                    'default' => '',
                ),
                array(
                    'id'      => 'private_key',
                    'type'    => 'text',
                    'title'   => 'Private Key',
                    'desc'    => '密钥（测试：a0c76773b8ca44ac9fa5100f5675c95f）',
                    'default' => '',
                    'attributes'  => array(
                        'type'      => 'password',
                    ),
                ),
                array(
                    'id'      => 'url_do',
                    'type'    => 'text',
                    'title'   => '支付网关',
                    'desc'    => '一般不用动，如虎皮椒官方有调整手动更新即可',
                    'default' => 'https://admin.xunhuweb.com',
                ),

            ),
            'dependency' => array('is_xunhupay_ali', '==', 'true'),
        ),
        //XUNHUPAY WX  注册地址：https://admin.xunhuweb.com/register/15235553019447ebb7e54725220a7cb9
        array(
            'id'      => 'is_xunhupay_wx',
            'type'    => 'switcher',
            'title'   => '迅虎支付-微信支付',
            'label'   => '当前是新版迅虎支付，微信支付完美收款，支持微信H5支付，无资质可以用此方法完美替代*_*',
            'default' => false,
        ),
        array(
            'id'         => 'xunhupay_wx',
            'type'       => 'fieldset',
            'title'      => '配置详情',
            'fields'     => array(
                array(
                    'type'    => 'notice',
                    'style'   => 'success',
                    'content' => '讯虎支付 <a target="_blank" href="https://admin.xunhuweb.com/register/15235553019447ebb7e54725220a7cb9" style=" color: red; font-weight: 600; ">-->>注册地址</a><br/>如测试可使用测试mchid和密钥进行。但只支持0.1元付款测试<br/>',
                ),
                array(
                    'id'      => 'mchid',
                    'type'    => 'text',
                    'title'   => 'MCHID',
                    'desc'    => 'MCHID（测试：a0e5b19a8b4047c88184412997a421d1）',
                    'default' => '',
                ),
                array(
                    'id'      => 'private_key',
                    'type'    => 'text',
                    'title'   => 'Private Key',
                    'desc'    => '密钥（测试：a0c76773b8ca44ac9fa5100f5675c95f）',
                    'default' => '',
                    'attributes'  => array(
                        'type'      => 'password',
                    ),
                ),
                array(
                    'id'      => 'url_do',
                    'type'    => 'text',
                    'title'   => '支付网关',
                    'desc'    => '一般不用动，如虎皮椒官方有调整手动更新即可',
                    'default' => 'https://admin.xunhuweb.com',
                ),

            ),
            'dependency' => array('is_xunhupay_wx', '==', 'true'),
        ),


        // PAYJS支付配置
        array(
            'id'      => 'is_payjs',
            'type'    => 'switcher',
            'title'   => 'PAYJS（支持个人·微信）',
            'label'   => 'PAYJS也支持个人资质开户',
            'default' => false,
        ),
        array(
            'id'         => 'payjs',
            'type'       => 'fieldset',
            'title'      => '配置详情',
            'fields'     => array(
                array(
                    'id'      => 'mchid',
                    'type'    => 'text',
                    'title'   => 'PAYJS商户号',
                    'desc'    => 'PAYJS商户号',
                    'default' => '',
                ),
                array(
                    'id'      => 'key',
                    'type'    => 'text',
                    'title'   => 'PAYJS通信密钥',
                    'desc'    => 'PAYJS通信密钥',
                    'default' => '',
                    'attributes'  => array(
                        'type'      => 'password',
                        'autocomplete' => 'off',
                    ),
                ),

            ),
            'dependency' => array('is_payjs', '==', 'true'),
        ),


        // 码支付配置
        array(
            'id'      => 'is_codepay',
            'type'    => 'switcher',
            'title'   => '码支付4.1新增（个人免签约）',
            'label'   => '码支付配置，个人免签约支付，需要挂机监听，使用码支付建议不要和其他支付混合开启，单独使用，不建议和其他支付混合使用',
            'default' => false,
        ),
        
        array(
            'id'         => 'codepay',
            'type'       => 'fieldset',
            'title'      => '配置详情',
            'fields'     => array(
                array(
                    'type'    => 'notice',
                    'style'   => 'success',
                    'content' => '码支付免签约官网：https://codepay.fateqq.com<br/>请在码支付后台云端设置设置通知地址为：' . get_template_directory_uri() . '/shop/codepay/notify.php',
                ),
                array(
                  'id'          => 'pay_mode',
                  'type'        => 'select',
                  'title'       => '码支付支付通道',
                  'options'     => array(
                    'all'     => '全部',
                    'weixin'     => '微信',
                    'alipay'     => '支付宝',
                  ),
                ),
                array(
                    'id'         => 'mzf_appid',
                    'type'       => 'text',
                    'title'      => '码支付-ID',
                    'desc'       => '必填-前往码支付云端设置查看',
                    'default'    => '',
                ),
                array(
                    'id'         => 'mzf_secret',
                    'type'       => 'text',
                    'title'      => '码支付-通信密钥',
                    'desc'       => '必填-前往码支付云端设置查看',
                    'default'    => '',
                    'attributes'  => array(
                        'type'      => 'password',
                        'autocomplete' => 'off',
                    ),
                ),
                array(
                    'id'         => 'mzf_token',
                    'type'       => 'text',
                    'title'      => '码支付-token',
                    'desc'       => '必填',
                    'default'    => '',
                    'attributes'  => array(
                        'type'      => 'password',
                        'autocomplete' => 'off',
                    ),
                ),

            ),
            'dependency' => array( 'is_codepay', '==', 'true' ),
        ),

        //易支付配置
        array(
            'id'      => 'is_yzf',
            'type'    => 'switcher',
            'title'   => '易支付',
            'label'   => '易支付',
            'default' => false,
        ),
        array(
            'id'         => 'yzf',
            'type'       => 'fieldset',
            'title'      => '配置详情',
            'fields'     => array(
            array(
                  'id'          => 'is_yzf_wx',
                  'type'        => 'switcher',
                  'title'       => '易支付微信通道',
                  'label'   => '易支付微信通道',
                  'default' => false,
                ),
                array(
                'id'         => 'yzf_wxpay',
                'type'       => 'fieldset',
                'title'      => '配置详情',
                'fields'     => array(
                    array(
                    'id'         => 'yzf_id',
                    'type'       => 'text',
                    'title'      => '易支付-ID',
                    'desc'       => '请填写你的易支付-ID',
                    'default'    => '',
                ),
                    array(
                    'id'         => 'yzf_key',
                    'type'       => 'text',
                    'title'      => '易支付-KEY',
                    'desc'       => '请填写你的易支付-KEY',
                    'default'    => '',
                    'attributes'  => array(
                        'type'      => 'password',
                        'autocomplete' => 'off',
                    ),
                ),
                    array(
                    'id'         => 'yzf_url',
                    'type'       => 'text',
                    'title'      => '易支付- 接口地址',
                    'desc'       => '请填写你的易支付-接口地址,格式为:http[s]://www.xxxxx.xx/记得协议和最后的/别少',
                    'default'    => '',
                ),
                    ),
                'dependency' => array( 'is_yzf_wx', '==', 'true' ),
                ),
            array(
                  'id'          => 'is_yzf_ali',
                  'type'        => 'switcher',
                  'title'       => '易支付支付宝通道',
                  'label'   => '易支付支付宝通道',
                  'default' => false,
                ),
                array(
                'id'         => 'yzf_alipay',
                'type'       => 'fieldset',
                'title'      => '配置详情',
                'fields'     => array(
                    array(
                    'id'         => 'yzf_id',
                    'type'       => 'text',
                    'title'      => '易支付-ID',
                    'desc'       => '请填写你的易支付-ID',
                    'default'    => '',
                ),
                    array(
                    'id'         => 'yzf_key',
                    'type'       => 'text',
                    'title'      => '易支付-KEY',
                    'desc'       => '请填写你的易支付-KEY',
                    'default'    => '',
                    'attributes'  => array(
                        'type'      => 'password',
                        'autocomplete' => 'off',
                    ),
                ),
                    array(
                    'id'         => 'yzf_url',
                    'type'       => 'text',
                    'title'      => '易支付- 接口地址',
                    'desc'       => '请填写你的易支付-接口地址,格式为:http[s]://www.xxxxx.xx/记得协议和最后的/别少',
                    'default'    => '',
                ),
                    ),
                'dependency' => array( 'is_yzf_ali', '==', 'true' ),
                ),
            ),
            'dependency' => array( 'is_yzf', '==', 'true' ),
        ),
    ),
));
//
// 商城-会员设置
//
CSF::createSection($prefix, array(
    'parent' => 'shop_fields',
    'title'  => '会员设置'.$tips_6_6,
    'icon'   => 'fa fa-user',
    'fields' => array(
        array(
            'id'      => 'is_pay_vip_dashed_yec',
            'type'    => 'switcher',
            'title'   => '开通会员时禁用余额方式购买会员'.$tips_6_6,
            'label'   => '',
            'default' => false,
        ),
        array(
            'id'      => 'vip-price',
            'type'    => 'text',
            'default' => '1',
            'desc'    => '开通一天' . _cao('site_vip_name') . '所需的' . _cao('site_money_ua') . '数量',
            'title'   => _cao('site_vip_name') . '售价/天',
        ),

        array(
            'id'      => 'is_all_down_num',
            'type'    => 'switcher',
            'title'   => '所有下载行为均计算次数（严格模式）'.$tips_6_2,
            'desc'       => '开启此项后，所有下载行为均计算次数，不管是免费资源还是当天购买的资源进行下载都计算次数，否则只计算免费资源下载的次数，如果为了防止搬运，建议可以开启，比较严格',
            'default' => false,
        ),
        array(
            'id'      => 'is_novip_down_num',
            'type'    => 'switcher',
            'title'   => '普通用户每日可下载次数限制',
            'label'   => '',
            'default' => false,
        ),
        array(
            'id'         => 'novip_down_num',
            'type'       => 'text',
            'default'    => '5',
            'desc'       => '普通用户每日可下载次数限制，仅免费资源计算真实点击下载次数，重复点击下载也计算次数',
            'title'      => '普通用户每日可下载次数',
            'dependency' => array('is_novip_down_num', '==', 'true'),
        ),

        array(
            'id'      => 'is_vip_down_num',
            'type'    => 'switcher',
            'title'   => _cao('site_vip_name') . '每日可下载次数限制',
            'label'   => '',
            'default' => false,
        ),
        array(
            'id'         => 'vip_down_num',
            'type'       => 'text',
            'default'    => '10',
            'desc'       => _cao('site_vip_name') . '用户每日可下载次数限制，仅免费资源计算真实点击下载次数，重复点击下载也计算次数',
            'title'      => _cao('site_vip_name') . '用户每日可下载次数',
            'dependency' => array('is_vip_down_num', '==', 'true'),
        ),

        array(
            'id'      => 'is_boosvip_down_num',
            'type'    => 'switcher',
            'title'   => '永久'._cao('site_vip_name') . '每日可下载次数限制',
            'label'   => '',
            'default' => false,
        ),
        array(
            'id'         => 'boosvip_down_num',
            'type'       => 'text',
            'default'    => '100',
            'desc'       => '永久'._cao('site_vip_name') . '用户每日可下载次数限制，仅免费资源计算真实点击下载次数，重复点击下载也计算次数',
            'title'      => '永久'._cao('site_vip_name') . '用户每日可下载次数',
            'dependency' => array('is_boosvip_down_num', '==', 'true'),
        ),

        array(
            'id'      => 'vip-pay-setting',
            'type'    => 'repeater',
            'title'   => '开通套餐设置（' . _cao('site_vip_name') . '）',
            'fields'  => array(
                array(
                    'id'      => 'daynum',
                    'type'    => 'text',
                    'default' => '30',
                    'desc'    => '比如你想设置一个套餐是月费，则填写30，如果要设置终身会员套餐，填写：9999',
                    'title'   => '开通天数',
                ),
                array(
                    'id'      => 'price',
                    'type'    => 'text',
                    'default' => '20',
                    'desc'    => '此套餐所需的' . _cao('site_money_ua') . '数量，例： 会员一天需要1，设置一个月费则是30，如果填写为15，则相当于在打折',
                    'title'   => '套餐价格',
                ),
                array(
                    'id'      => 'desc',
                    'type'    => 'textarea',
                    'default' => '<p>VIP专享资源<br>一年无限下载次数<br>享受资源专属折扣<br>第一时间获取优质资源</p>',
                    'desc'    => '开通描述简介，用br标签换行',
                    'title'   => '开通描述'.$tips_6_6,
                ),
                array(
                    'id'      => 'color',
                    'type'    => 'color',
                    'default' => '#ff6a6d',
                    'title'   => '背景颜色',
                ),
            ),
            'default' => array(
                array(
                    'daynum' => '1',
                    'price'  => '1',
                    'color'  => '#ff6a6d',
                ),
            ),
        ),

    ),
));

//
// 商城-佣金设置
//
CSF::createSection($prefix, array(
    'parent' => 'shop_fields',
    'title'  => '佣金设置',
    'icon'   => 'fa fa-circle',
    'fields' => array(

        array(
            'id'      => 'is_ref_to_rmb',
            'type'    => 'switcher',
            'title'   => '关闭RMB提现功能',
            'label'   => '关闭后只支持提现到站内余额',
            'default' => false,
        ),

        array(
            'id'      => 'is_charge_ref_float',
            'type'    => 'switcher',
            'title'   => '用户充值佣金奖励',
            'label'   => '',
            'default' => false,
        ),

         array(
            'id'         => 'site_novip_ref_float',
            'type'       => 'text',
            'title'      => _cao('site_no_vip_name') . '推荐充值消费佣金奖励比例*',
            'default'    => '0.1',
            'desc'       => '0.2为20%,用户A推荐B注册充值，A可以得到B的实际付款RMB金额的20%的佣金，以此类推，0为关闭，此处佣金只在RMB充值站内余额的时候有效，卡密等不给佣金 怕血亏',
            'dependency' => array('is_charge_ref_float', '==', 'true'),
        ),
        array(
            'id'         => 'site_vip_ref_float',
            'type'       => 'text',
            'title'      => _cao('site_vip_name') . '推荐充值消费佣金奖励比例*',
            'default'    => '0.1',
            'desc'       => '0.2为20%,用户A推荐B注册充值，A可以得到B的实际付款RMB金额的20%的佣金，以此类推，0为关闭，此处佣金只在RMB充值站内余额的时候有效，卡密等不给佣金 怕血亏',
            'dependency' => array('is_charge_ref_float', '==', 'true'),
        ),

        array(
            'id'      => 'is_postpay_ref_float',
            'type'    => 'switcher',
            'title'   => '资源购买作者佣金',
            'label'   => '',
            'default' => false,
        ),

        array(
            'id'         => 'site_postpay_ref_float',
            'type'       => 'text',
            'title'      => '作者佣金分红比例*',
            'default'    => '0.1',
            'desc'       => '如果文章是用户发布的，被购买时奖励此作者佣金比例,0.1等于百分之10',
            'dependency' => array('is_postpay_ref_float', '==', 'true'),
        ),

        array(
            'id'      => 'site_min_tixian_num',
            'type'    => 'text',
            'title'   => '网站最低提现金额限制/元',
            'default' => '1',
        ),

    ),
));


//
// 商城-发布付费资源默认字段
//
CSF::createSection($prefix, array(
    'parent' => 'shop_fields',
    'title'  => '发布付费资源默认字段',
    'icon'   => 'fa fa-circle',
    'fields' => array(
        array(
            'id'      => 'cao_price',
            'type'    => 'text',
            'title'   => '默认资源价格：*' . _cao('site_money_ua'),
            'default' => '0',
            'label'    => '免费请填写：0',
            'attributes' => array(
                'style'    => 'width: 100px;'
            ),
        ),
        array(
            'id'      => 'cao_vip_rate',
            'type'    => 'text',
            'title'   => _cao('site_vip_name') . '会员默认折扣：*',
            'default' => '1',
            'label'    => '0.N 等于N折；1 等于不打折；0 等于免费',
            'attributes' => array(
                'style'    => 'width: 100px;'
            ),
        ),
        array(
            'id'    => 'cao_close_novip_pay',
            'type'  => 'checkbox',
            'title' => '默认普通用户禁止购买',
            'label' => '勾选后普通用户不能下单支付，只允许会员可以购买',
        ),
        array(
            'id'    => 'cao_is_boosvip',
            'type'  => 'checkbox',
            'title' => '默认永久'._cao('site_vip_name').'会员免费',
            'label' => '勾选后永久'._cao('site_vip_name').'会员免费，其他会员按折扣或者原价购买',
        ),


        array(
            'id'    => 'cao_status',
            'type'  => 'switcher',
            'title' => '默认启用付费下载模块',
            'label' => '开启后可设置付费下载专有内容',
        ),

        array(
            'id'         => 'cao_downurl',
            'type'       => 'upload',
            'title'      => '默认资源下载地址：',
            'desc'       => '可直接粘贴：支持https:,thunder:,magnet:,ed2k 开头地址，可本地上传',
            'dependency' => array('cao_status', '==', 'true'),
        ),
        array(
            'id'         => 'cao_downurl_bak',
            'type'       => 'upload',
            'title'      => '默认备用资源地址：',
            'desc'       => '该地址方便站长记录备用资源地址，注意此地址不在前端展示',
            'dependency' => array('cao_status', '==', 'true'),
        ),
        array(
            'id'         => 'cao_diy_btn',
            'type'       => 'text',
            'title'      => '默认自定义按钮(NEW)',
            'subtitle'   => '为空则不显示，用 | 隔开',
            'desc'       => '格式： 下载免费版|https://www.baidu.com/',
            'dependency' => array('cao_status', '==', 'true'),
        ),
        array(
            'id'         => 'cao_pwd',
            'type'       => 'text',
            'title'      => '默认文件密码',
            'label'       => '不填写则无需密码',
            'attributes' => array( 'style' => 'width: 100px;' ),
            'dependency' => array('cao_status', '==', 'true'),
        ),
        array(
            'id'         => 'cao_demourl',
            'type'       => 'text',
            'title'      => '默认演示地址',
            'label'   => '为空则不显示',
            'dependency' => array('cao_status', '==', 'true'),
        ),
        array(
            'id'         => 'cao_info',
            'type'       => 'repeater',
            'title'      => '默认资源其他信息属性',
            'dependency' => array('cao_status', '==', 'true'),
            'fields'     => array(
                array(
                    'id'      => 'title',
                    'type'    => 'text',
                    'title'   => '标题',
                    'default' => '标题',
                ),
                array(
                    'id'      => 'desc',
                    'type'    => 'text',
                    'title'   => '描述内容',
                    'default' => '这里是描述内容',
                ),
            ),
        ),
        
        array(
            'id'      => 'cao_paynum',
            'type'    => 'text',
            'title'   => '已售数量',
            'default' => '0',
            'label'   => '可自定义修改数字',
            'attributes' => array(
                'style'    => 'width: 100px;'
            ),
            // 'dependency' => array('cao_status', '==', 'true'),
        ),
        
    ),
));


//
// 网站-登录注册
//
CSF::createSection($prefix, array(
    'title'  => '登录注册'.$tips_6_3,
    'icon'   => 'fa fa-user-o',
    'fields' => array(
        array(
            'id'      => 'is_avatar_loaz',
            'type'    => 'switcher',
            'title'   => '用户头像懒加载',
            'label'   => '开启后网站速度明显翻倍，因为头像是通过API获取',
            'default' => true,
        ),
        array(
            'id'      => 'is_captcha_qq',
            'type'    => 'switcher',
            'title'   => '开启腾讯防水墙',
            'label'   => '开启后需要点击验证哦，申请地址：https://007.qq.com/',
            'default' => false,
        ),
        array(
            'type'       => 'notice',
            'style'      => 'success',
            'content'    => '请注意。如果站长本人自己配置好一直验证失败，请不要惊慌，这是正常现象。因为自己在自己i网站频繁操作，防水墙自然会检测到，换个电脑或者手机上，测试效果即可，如果觉得太严格，平时不要开启，被人恶意注册的时候开启，效果明显',
            'dependency' => array('is_captcha_qq', '==', 'true'),
        ),
        array(
            'id'         => 'captcha_qq_appid',
            'type'       => 'text',
            'title'      => 'APPID',
            'desc'       => '你在腾讯防水墙申请到的APPID',
            'dependency' => array('is_captcha_qq', '==', 'true'),
        ),
        array(
            'id'         => 'captcha_qq_secretkey',
            'type'       => 'text',
            'title'      => 'Secret Key',
            'desc'       => '你在腾讯防水墙申请到的Secret Key',
            'dependency' => array('is_captcha_qq', '==', 'true'),
        ),

        array(
            'id'      => 'is_close_wplogin',
            'type'    => 'switcher',
            'title'   => '仅限社交登录',
            'label'   => '仅限第三方登录，关闭表单登录',
            'default' => false,
        ),
        array(
            'id'      => 'is_close_wpreg',
            'type'    => 'switcher',
            'title'   => '仅限社交账号注册',
            'label'   => '仅限第三方注册，关闭表单注册',
            'default' => false,
        ),
        array(
            'id'      => 'is_email_reg_cap',
            'type'    => 'switcher',
            'title'   => '网站注册需要邮件验证码',
            'label'   => '需要开启SMTP服务，可有效防止垃圾注册等',
            'default' => false,
        ),
        array(
            'id'      => 'is_oauth_qq',
            'type'    => 'switcher',
            'title'   => 'QQ登录',
            'label'   => '申请地址：https://connect.qq.com/',
            'default' => false,
        ),
        array(
            'id'         => 'oauth_qq',
            'type'       => 'fieldset',
            'title'      => '配置详情',
            'fields'     => array(
                array(
                    'id'         => 'backurl',
                    'type'       => 'text',
                    'title'      => '回调地址',
                    'attributes' => array(
                        'readonly' => 'readonly',
                    ),
                    'default'    => esc_url(home_url('/oauth/qq/callback')),
                    'desc'    => '如果中途切换域名或者升级https，请备份appid参数，然后重置当前分区设置即可刷新为最新的网址',
                ),
                array(
                    'id'      => 'appid',
                    'type'    => 'text',
                    'title'   => 'Appid',
                    'default' => '',
                ),
                array(
                    'id'      => 'appkey',
                    'type'    => 'text',
                    'title'   => 'Appkey',
                    'default' => '',
                    'attributes'  => array(
                        'type'      => 'password',
                        'autocomplete' => 'off',
                    ),
                ),
                // array(
                //     'id'      => 'agent',
                //     'type'    => 'switcher',
                //     'title'   => 'CAO-qq-Agent',
                //     'label'   => '开启此项可完美解决只能设置一个回调域名的问题',
                //     'default' => false,
                // ),

            ),
            'dependency' => array('is_oauth_qq', '==', 'true'),
        ),

        // 微信登录
        array(
            'id'      => 'is_oauth_weixin',
            'type'    => 'switcher',
            'title'   => '微信登录',
            'label'   => '申请地址：https://open.weixin.qq.com/',
            'default' => false,
        ),
        array(
            'id'         => 'oauth_weixin',
            'type'       => 'fieldset',
            'title'      => '配置详情',
            'fields'     => array(
                 
                array(
                    'id'         => 'backurl',
                    'type'       => 'text',
                    'title'      => '开放平台 回调地址',
                    'attributes' => array(
                        'readonly' => 'readonly',
                    ),
                    'default'    => esc_url(home_url('/oauth/weixin/callback')),
                    'desc'    => '如果中途切换域名或者升级https，请备份appid参数，然后重置当前分区设置即可刷新为最新的网址',
                ),
                array(
                    'id'      => 'appid',
                    'type'    => 'text',
                    'title'   => '开放平台 Appid',
                    'default' => '',
                ),
                array(
                    'id'      => 'appkey',
                    'type'    => 'text',
                    'title'   => '开放平台 AppSecret',
                    'default' => '',
                    'attributes'  => array(
                        'type'      => 'password',
                        'autocomplete' => 'off',
                    ),
                ),
            ),
            'dependency' => array('is_oauth_weixin', '==', 'true'),
        ),

        // 微信公主号登录 待测试
        array(
            'id'      => 'is_oauth_mpweixin',
            'type'    => 'switcher',
            'title'   => '公众号登录'.$tips_6_3,
            'desc'   => '(认证服务号公众号模式)设置后已登录用户可以直接在微信内登录和调用JSAPI直接微信内支付注意：请不要和开发平台模式同时开启以免出现登录错误！申请地址：https://mp.weixin.qq.com/',
            'default' => false,
        ),
        array(
            'id'         => 'oauth_mpweixin',
            'type'       => 'fieldset',
            'title'      => '配置详情',
            'fields'     => array(
                array(
                    'id'      => 'mp_appid',
                    'type'    => 'text',
                    'title'   => '公众号Appid',
                    'default' => '',
                ),
                array(
                    'id'      => 'mp_appsecret',
                    'type'    => 'text',
                    'title'   => '公众号appsecret',
                    'default' => '',
                    'attributes'  => array(
                        'type'      => 'password',
                        'autocomplete' => 'off',
                    ),
                ),
                array(
                    'id'      => 'mp_token',
                    'type'    => 'text',
                    'title'   => '公众号Token',
                    'desc'   => '例如：ripro45aer1',
                    'default' => '',
                    'attributes'  => array(
                        'type'      => 'password',
                        'autocomplete' => 'off',
                    ),
                ),
                
                array(
                    'id'         => 'mp_backurl',
                    'type'       => 'text',
                    'title'      => '授权回调页面域名',
                    'attributes' => array(
                        'readonly' => 'readonly',
                    ),
                    'default'    => esc_url(home_url('/oauth/mpweixin/callback')),
                    'desc'    => '如果中途切换域名或者升级https，请备份appid参数，然后重置当前分区设置即可刷新为最新的网址',
                ),
                array(
                    'id'      => 'mp_msg',
                    'type'    => 'textarea',
                    'title'   => '关注后自动回复的消息',
                    'default' => '欢迎使用RiPro高级主题\n发送关键词可直接搜索相关文章\n官网购买：https://ritheme.com/',
                ),
                
            ),
            'dependency' => array('is_oauth_mpweixin', '==', 'true'),
        ),

        // 微博登录
        array(
            'id'      => 'is_oauth_weibo',
            'type'    => 'switcher',
            'title'   => '微博登录',
            'label'   => '申请地址：https://open.weibo.com/authentication/',
            'default' => false,
        ),
        array(
            'id'         => 'oauth_weibo',
            'type'       => 'fieldset',
            'title'      => '配置详情',
            'fields'     => array(
                array(
                    'id'         => 'backurl',
                    'type'       => 'text',
                    'title'      => '回调地址',
                    'attributes' => array(
                        'readonly' => 'readonly',
                    ),
                    'default'    => esc_url(home_url('/oauth/weibo/callback')),
                    'desc'    => '如果中途切换域名或者升级https，请备份appid参数，然后重置当前分区设置即可刷新为最新的网址',
                ),
                array(
                    'id'      => 'appid',
                    'type'    => 'text',
                    'title'   => 'Appid',
                    'default' => '',
                ),
                array(
                    'id'      => 'appkey',
                    'type'    => 'text',
                    'title'   => 'Appkey',
                    'default' => '',
                ),
                // array(
                //     'id'      => 'agent',
                //     'type'    => 'switcher',
                //     'title'   => 'CAO-weibo-Agent',
                //     'label'   => '开启此项可完美解决只能设置一个回调域名的问题',
                //     'default' => false,
                // ),
            ),
            'dependency' => array('is_oauth_weibo', '==', 'true'),
        ),

    ),
));

//
// 网站-用户中心
//
CSF::createSection($prefix, array(
    'title'  => '用户中心',
    'icon'   => 'fa fa-user-o',
    'fields' => array(

        array(
            'id'      => 'is_qiandao',
            'type'    => 'switcher',
            'title'   => '开启签到功能(4.0)',
            'label'   => '',
            'default' => true,
        ),
        array(
            'id'      => 'qiandao_to_money',
            'type'    => 'text',
            'title'   => '每日签到成功赠送'._cao('site_money_ua').'数量',
            'default' => '5',
            'dependency' => array('is_qiandao', '==', 'true'),
        ),

        array(
            'id'      => 'is_nav_myfav',
            'type'    => 'switcher',
            'title'   => '开启收藏功能',
            'label'   => '',
            'default' => true,
        ),
        
        array(
            'id'      => 'is_nav_write',
            'type'    => 'switcher',
            'title'   => '显示投稿/我的文章菜单',
            'label'   => '',
            'default' => true,
        ),
        
        array(
            'id'      => 'is_nav_ref',
            'type'    => 'switcher',
            'title'   => '显示推广佣金菜单',
            'label'   => '',
            'default' => true,
        ),

        array(
            'id'      => 'is_user_bang_email',
            'type'    => 'switcher',
            'title'   => '用户修改邮箱需要验证码',
            'label'   => '需要开启SMTP服务，可有效防止垃圾注册等',
            'default' => false,
        ),

        array(
            'id'      => 'is_userpage_vip_head',
            'type'    => 'switcher',
            'title'   => '我的会员页面',
            'label'   => '我的会员页面顶部显示余额块',
            'default' => false,
        ),

        array(
            'id'      => 'is_userpage_charge_head',
            'type'    => 'switcher',
            'title'   => '充值中心页面',
            'label'   => '充值中心页面顶部显示余额块',
            'default' => false,
        ),

        array(
            'id'      => 'is_mail_nitfy_reg',
            'type'    => 'switcher',
            'title'   => '用户注册成功邮件提醒',
            'default' => false,
        ),

        array(
            'id'      => 'is_mail_nitfy_charge',
            'type'    => 'switcher',
            'title'   => '用户在线充值成功邮件提醒',
            'default' => false,
        ),
        array(
            'id'      => 'is_mail_nitfy_cdk',
            'type'    => 'switcher',
            'title'   => '用户卡密充值成功邮件提醒',
            'default' => false,
        ),
        array(
            'id'      => 'is_mail_nitfy_vip',
            'type'    => 'switcher',
            'title'   => '用户开通/续费' . _cao('site_vip_name', '会员') . '成功邮件提醒',
            'default' => false,
        ),
        array(
            'id'      => 'is_mail_nitfy_pay',
            'type'    => 'switcher',
            'title'   => '用户购买资源成功邮件提醒',
            'default' => false,
        ),

    ),
));

//
// SMTP设置
//
CSF::createSection($prefix, array(
    'title'       => 'SMTP设置',
    'icon'        => 'fa fa-envelope',
    'description' => 'SMTP设置可以解决wordpress无法发送邮件问题，建议用QQ邮箱，注意QQ邮箱的密码是独立密码。不是QQ密码！',
    'fields'      => array(

        array(
            'id'      => 'mail_smtps',
            'type'    => 'switcher',
            'title'   => '启用SMTP服务',
            'label'   => '该设置主题自带，不能与插件重复开启',
            'default' => false,
        ),
        array(
            'id'       => 'mail_name',
            'type'     => 'text',
            'title'    => '发信邮箱',
            'subtitle' => '请填写发件人邮箱帐号',
            'default'  => '88888888@qq.com',
            'validate' => 'csf_validate_email',
        ),
        array(
            'id'       => 'mail_nicname',
            'type'     => 'text',
            'title'    => '发信人昵称',
            'subtitle' => '昵称',
            'default'  => 'Ripro主题',
        ),
        array(
            'id'       => 'mail_host',
            'type'     => 'text',
            'title'    => '邮件服务器',
            'subtitle' => '请填写SMTP服务器地址',
            'default'  => 'smtp.qq.com',
        ),
        array(
            'id'       => 'mail_port',
            'type'     => 'text',
            'title'    => '服务器端口',
            'subtitle' => '请填写SMTP服务器端口',
            'default'  => '465',
        ),
        array(
            'id'       => 'mail_passwd',
            'type'     => 'text',
            'title'    => '邮箱密码',
            'subtitle' => '请填写SMTP服务器邮箱密码，特别注意：QQ邮箱的密码在账户设置，最底下，是独立生成的授权码，而不是qq密码和邮箱密码',
            'default'  => '88888888',
            'attributes'  => array(
                'type'      => 'password',
                'autocomplete' => 'off',
            ),
        ),
        array(
            'id'      => 'mail_smtpauth',
            'type'    => 'switcher',
            'title'   => '启用SMTPAuth服务',
            'label'   => '启用SMTPAuth服务',
            'default' => true,
        ),
        array(
            'id'       => 'mail_smtpsecure',
            'type'     => 'text',
            'title'    => 'SMTPSecure设置',
            'subtitle' => '若启用SMTPAuth服务则填写ssl，若不启用则留空',
            'default'  => 'ssl',
        ),

    ),
));



//
// 广告设置
//

$ripro_ads_opt = array(
    'ad_last_1'    => '首页最新文章模块-顶部广告',
    'ad_last_2'    => '首页最新文章模块-底部广告',
    'ad_cms_1'    => '首页分类CMS模块-顶部广告',
    'ad_cms_2'    => '首页分类CMS模块-底部广告',
    'ad_archive_1' => '分类/标签/搜索页-顶部广告',
    'ad_archive_2' => '分类/标签/搜索页-底部广告',
    'ad_single_1'  => '文章内页-顶部',
    'ad_single_2'  => '文章内页-底部',
);
$ripro_ads_opt_c = [];
foreach ($ripro_ads_opt as $slug => $name) {
    // 是否开启
    $ripro_ads_opt_c[] = array(
        'id'      => $slug,
        'type'    => 'switcher',
        'title'   => $name,
        'default' => false,
    );

    $ripro_ads_opt_c[] = array(
        'id'         => $slug . '_pc',
        'type'       => 'code_editor',
        'title'      => '电脑端广告代码',
        'default'    => '<a href="https://ritheme.com/" target="_blank"><img src="' . get_template_directory_uri() . '/assets/images/hero/ads.jpg" style=" width: 100%; margin: 20px 0; text-align: center; "></a>',
        'sanitize' => false,
        'dependency' => array($slug, '==', 'true'),
    );
    $ripro_ads_opt_c[] = array(
        'id'         => $slug . '_mobile',
        'type'       => 'code_editor',
        'title'      => '手机端广告代码',
        'default'    => '<a href="https://ritheme.com/" target="_blank"><img src="' . get_template_directory_uri() . '/assets/images/hero/ads.jpg" style=" width: 100%; margin: 20px 0; text-align: center; "></a>',
        'sanitize' => false,
        'dependency' => array($slug, '==', 'true'),
    );

}

CSF::createSection($prefix, array(
    'title'  => '广告设置',
    'icon'   => 'fa fa-legal',
    'fields' => $ripro_ads_opt_c,
));

//
// Field: 底部设置
//
CSF::createSection($prefix, array(
    'title'  => '底部设置',
    'icon'   => 'fa fa-circle',
    'fields' => array(

        //自定义全站右侧功能按钮


        // Banner
        array(
            'id'      => 'is_footer_banner',
            'type'    => 'switcher',
            'title'   => '开启全局底部Banner',
            'default' => true,
        ),
        array(
            'id'         => 'mode_banner',
            'type'       => 'fieldset',
            'title'      => 'banner背景图块',
            'fields'     => array(
                array(
                    'id'      => 'bgimg',
                    'type'    => 'upload',
                    'title'   => '背景图',
                    'default' => get_template_directory_uri() . '/assets/images/background/bg-1.jpg',
                ),
                array(
                    'id'      => 'text',
                    'type'    => 'text',
                    'title'   => '标题',
                    'default' => '提供最优质的资源集合',
                ),

                array(
                    'id'      => 'primary_text',
                    'type'    => 'text',
                    'title'   => '按钮1名称',
                    'default' => '立即查看',
                ),
                array(
                    'id'      => 'primary_link',
                    'type'    => 'text',
                    'title'   => '按钮1链接',
                    'default' => '#',
                ),

                array(
                    'id'      => 'secondary_text',
                    'type'    => 'text',
                    'title'   => '按钮2名称',
                    'default' => '了解详情',
                ),
                array(
                    'id'      => 'secondary_link',
                    'type'    => 'text',
                    'title'   => '按钮2链接',
                    'default' => '#',
                ),
            ),
            'dependency' => array('is_footer_banner', '==', 'true'),
        ),

        array(
            'id'      => 'is_site_footer_links',
            'type'    => 'switcher',
            'title'   => '开启底部友情链接模块',
            'desc'   => '添加友情链接在wp后台左侧 链接 添加即可',
            'default' => true,
        ),
        array(
            'id'          => 'site_footer_links_type',
            'type'        => 'select',
            'title'       => '友情链接权重类型',
            'placeholder' => '权重类型',
            'options'     => array(
                'all' => '全站底部展示',
                'home' => '只在首页底部展示',
            ),
            'default'     => 'home',
            'dependency' => array('is_site_footer_links', '==', 'true'),
        ),
        array(
            'id'      => 'is_diy_footer',
            'type'    => 'switcher',
            'title'   => '开启底部DIY的html结构',
            'default' => true,
        ),
        array(
            'id'      => 'site_footer_logo',
            'type'    => 'upload',
            'title'   => '底部LOGO',
            'default' => get_template_directory_uri() . '/assets/images/logo/logo-light.png',
            'dependency' => array('is_diy_footer', '==', 'true'),
        ),
        array(
            'id'       => 'site_footer_desc',
            'type'     => 'textarea',
            'title'    => '底部LOGO下文字介绍',
            'subtitle' => '自定义文字介绍',
            'default'  => 'RIPRO主题/付费下载/查看/余额管理/自定义积分，集成支付，卡密，推广奖励等。',
            'dependency' => array('is_diy_footer', '==', 'true'),
        ),

        array(
            'id'       => 'site_footer_link1',
            'type'     => 'text',
            'title'    => '底部链接块1',
            'default'  => '本站导航',
            'dependency' => array('is_diy_footer', '==', 'true'),
        ),

        array(
          'id'        => 'site_footer_link1_group',
          'type'      => 'group',
          'title'     => '底部链接块1-链接设置',
          'max'     => '3',
          'fields'    => array(
            array(
              'id'    => '_title',
              'type'  => 'text',
              'title' => '链接标题',
              'default' => '链接标题',
            ),
            array(
              'id'    => '_link',
              'type'  => 'text',
              'title' => '链接地址',
              'default' => 'https://ritheme.com/',
            ),
            array(
                'id'      => '_blank',
                'type'    => 'switcher',
                'title'   => '新窗口打开',
                'default' => false,
            ),
          ),
          'dependency' => array('is_diy_footer', '==', 'true'),
        ),

        array(
            'id'       => 'site_footer_link2',
            'type'     => 'text',
            'title'    => '底部链接块2',
            'default'  => '友情链接',
            'dependency' => array('is_diy_footer', '==', 'true'),
        ),

        array(
          'id'        => 'site_footer_link2_group',
          'type'      => 'group',
          'title'     => '底部链接块2-链接设置',
          'max'     => '3',
          'fields'    => array(
            array(
              'id'    => '_title',
              'type'  => 'text',
              'title' => '链接标题',
              'default' => '链接标题',
            ),
            array(
              'id'    => '_link',
              'type'  => 'text',
              'title' => '链接地址',
              'default' => 'https://ritheme.com/',
            ),
            array(
                'id'      => '_blank',
                'type'    => 'switcher',
                'title'   => '新窗口打开',
                'default' => false,
            ),
          ),
          'dependency' => array('is_diy_footer', '==', 'true'),
        ),

        array(
            'id'       => 'site_footer_copdesc',
            'type'     => 'textarea',
            'title'    => '底部快速搜索下文字',
            'default'  => '本站由<a href="https://ritheme.com/" target="_blank" rel="noreferrer nofollow">RiPro主题</a>强力驱动',
            'dependency' => array('is_diy_footer', '==', 'true'),
        ),



        array(
            'id'       => 'cao_copyright_text',
            'type'     => 'textarea',
            'title'    => '底部版权信息',
            'subtitle' => '自定义版权信息',
            'default'  => '© 2018 Theme by - <a href="https://ritheme.com/" target="_blank" rel="noreferrer nofollow">RiPro主题</a> &amp; WordPress Theme. All rights reserved',
        ),

        array(
            'id'       => 'cao_ipc_info',
            'type'     => 'text',
            'title'    => '网站备案号',
            'subtitle' => '',
            'default'  => '京ICP备18888888号 ',
        ),
        array(
            'id'       => 'cao_ipc2_info',
            'type'     => 'textarea',
            'title'    => '网站公安备案号',
            'subtitle' => '',
            'default'  => '<a href="http://www.beian.gov.cn/portal/registerSystemInfo?recordcode=188888888" target="_blank" rel="noreferrer nofollow">京公网安备 188888888</a>',
        ),

        array(
            'id'      => 'is_console_footer',
            'type'    => 'switcher',
            'title'   => '在浏览器开发者选项显示网站系查询日志',
            'default' => true,
        ),

        array(
            'id'       => 'web_js',
            'type'     => 'code_editor',
            'title'    => '网站底部自定义JS代码',
            'subtitle' => '位于底部，用于添加第三方流量数据统计代码，如：Google analytics、百度统计、CNZZ',
            'settings' => array(
                'theme' => 'dracula',
                'mode'  => 'javascript',
            ),
            'sanitize' => false,
            'default'  => '',
        ),

    ),
));

//
// 辅助其他
//
CSF::createSection($prefix, array(
    'title'       => '高级功能(新)',
    'icon'        => 'fa fa-envelope',
    'description' => '包含网站的功能组件，例如通知风格等设置',
    'fields'      => array(

        array(
            'id'      => 'cao_disabled_f12',
            'type'    => 'switcher',
            'title'   => '启用浏览器防止F12查看源代码'.$tips_6_6,
            'desc'    => '',
        ),
        array(
            'id'      => 'all_slte_ob_cache',
            'type'    => 'switcher',
            'title'   => '开启缓存'.$tips_6_3,
            'desc'    => '开发级工具，小白误入，如果网站利用第三方插件优化加速，可以配合wpjam插件开启缓存，sql优化效果达到三倍以上，如果自己利用子主题改写代码和缩略图可以优化到最低首页只有2个sql查询，ripro没有使用缓存技术首页模块全展示大概130次查询以上，本技术需要LINUX服务器支持，小白误入。消费级优化可以联系油条付费改写子主题进行优化',
            'default' => false,
        ),

        array(
            'id'      => 'cao_disabled_wp_update',
            'type'    => 'switcher',
            'title'   => '彻底关闭WordPress的自动更新和检测',
            'desc'    => '完全关闭WordPress的自动更新和检测，加快后台速度，完美解决国内目前访问wp官网不稳定问题，既然访问不了，那就直接关闭，防止wp自动访问检测导致速度超慢',
            'default' => true,
        ),

        array(
            'id'      => 'disabled_wp_cdn',
            'type'    => 'switcher',
            'title'   => '启用OSS或CDN兼容模式',
            'desc'    => '如果您使用了CDN或者OSS插件加速，在此设置CDN域名可解决头像 海报等图片无法显示问题<p><b><font color="red">已测试：</font>WPOSS插件开启此项可兼容。OSS Upload插件无需开启此项，插件本身完美兼容</b></p>',
            'default' => false,
        ),
        array(
            'id'      => 'disabled_up_ava',
            'type'    => 'switcher',
            'title'   => '禁止前台用户上传头像',
            'desc'    => '如果您使用了CDN或者OSS插件加速，可能因为上传权限和兼容性问题，个人中心的头像上传后空白或者出于安全考虑，建议您关闭上传头像功能</p>',
            'default' => false,
        ),
        array(
            'id'      => '_wp_cdn_domain',
            'type'    => 'text',
            'title'   => 'CDN或者OSS域名',
            'desc'    => '<b><font color="red">例：</font></b> <code>https://testripro.oss-cn-beijing.aliyuncs.com/</code> 注意http和https要加，并且以斜杠结尾</p><p><b><font color="red">注意：</font></b>海报和头像的本地目录为： <code>wp-content/uploads/posterimg</code>和<code>wp-content/uploads/avatar</code></p> 如果有个的插件或者CDN上传时不保存本地文件，请注意排除这两个目录，以免头像或者海报上传后被自动删除，导致无法显示问题',
            'default' => '',
            'dependency' => array('disabled_wp_cdn', '==', 'true'),
        ),
        
        
        array(
            'id'      => 'close_site_shop',
            'type'    => 'switcher',
            'title'   => '关闭全部商城和会员功能'.$tips_6_2,
            'desc'    => '关闭网站所有的商城和付费以及会员模块，博客，展示型网站专用开关,包括收藏，付费相关小工具也不现实',
            'default' => false,
        ),

        array(
            'id'      => 'md5_file_udpate',
            'type'    => 'switcher',
            'title'   => '上传文件重命名',
            'desc'    => '建议开启，可解决部分中文图片无法调用问题',
            'default' => true,
        ),

        array(
            'id'      => 'autu_post_haibao',
            'type'    => 'switcher',
            'title'   => '实时更新文章海报图片模式',
            'desc'    => '开启后，文章的海报每次有用户点击系统都会新绘制一次，建议关闭可以节省带宽和加快海报打开速度',
            'default' => false,
        ),
        array(
            'id'      => 'disabled_block_editor',
            'type'    => 'switcher',
            'title'   => '禁用WP5.0+ 古滕堡反人类编辑器',
            'desc'    => '建议关闭，使用传统编辑器',
            'default' => true,
        ),
        array(
            'id'      => 'close_site_rest_json',
            'type'    => 'switcher',
            'title'   => '禁用WP自带的REST API功能(新)',
            'desc'    => '安全功能，可以防止有人利用wp api 恶意请求等，建议不用小程序或者其他功能的情况下关闭',
            'default' => false,
            'dependency' => array('disabled_block_editor', '==', 'true'),
        ),

        

    ),
));



//
// Field: backup
//
CSF::createSection($prefix, array(
    'title'       => '备份恢复',
    'icon'        => 'fa fa-shield',
    'description' => '备份-恢复您的主题设置，方便迁移快速复刻网站</a>',
    'fields'      => array(

        array(
            'type' => 'backup',
        ),

    ),
));

CSF::createSection($prefix, array(
    'title'       => '主题授权',
    'icon'        => 'fa fa-handshake-o',
    'description' => '<i class="fa fa-heart" style=" color: red; "></i> 感谢您使用本主题进行创作，请先填写vip.ylit.cc个人中心您的授权ID和授权码点击保存验证。<i class="fa fa-heart" style=" color: red; "></i>
  <br/>------授权错误会提示错误消息，成功则顶部显示-设置已保存。</br></br><i class="fa fa-heart" style=" color: red; "></i> PS：承蒙您对本主题的喜爱，我们愿向小三一样，做大哥的女人，做大哥网站中最想日的一个。开发者不易，我们真诚的希望和感谢每一个真心建站运营的朋友能支持日系列的正版主题，更好的更用心的等你来调教。</br></br><b><font color="red">授权注意事项：</font></b>中途更换域名，更换HTTPS，更换网站标题等，都需要后台主题设置重新保存一下设置和授权，请修正数据库中的域名，保证你绑定的域名和你WP后台，常规设置里面的域名一致。其次，中途从不同版本的数据库SQL操作迁移数据库，导入导出都会促使编码格式不对，个例情况，如果有个别弹出授权提示，请检查授权信息不要有空格，重新填写正确的授权保存即可，数据无损。如果都没有问题请检查自己网站根目录所有wordpress文件的权限是否标准的755和拥有者一致，个别网站权限错乱修复后重新保存授权即可！',
    'fields'      => array(

        array(
            'id'    => 'ripro_vip_id',
            'type'  => 'text',
            'title' => '会员ID',
			'default' => '天皇盖地虎',
            'after' => '<p><b><font color="red">注意不要有空格 </font></b>会员购买授权中心 <a href="https://ritheme.com/" target="_blank"> RI-VIP官网</a></p>',
            
        ),
        array(
            'id'    => 'ripro_vip_code',
            'type'  => 'text',
            'title' => '授权码',
			'default' => '宝塔镇河妖',
            'after' => '<p><b><font color="red">注意不要有空格</font></b> 会员购买授权中心 <a href="https://ritheme.com/" target="_blank"> RI-VIP官网</a></p>',
            'attributes'  => array(
                'type'      => 'password',
                'autocomplete' => 'off',
            ),
        ),

    ),
));



//美化二次开发用户请添加自定义设置框架到本目录下 diy-options.php


