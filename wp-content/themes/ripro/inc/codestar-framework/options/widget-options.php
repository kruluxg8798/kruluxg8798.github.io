<?php if (!defined('ABSPATH')) {die;}
//
// Create a widget cao_widget_pay
//
CSF::createWidget('cao_widget_pay', array(
    'title'       => 'RIPRO-购买资源小工具（必选）',
    'classname'   => 'widget-pay',
    'description' => 'RIPRO主题的小工具',
    'fields'      => array(
        
        array(
            'id'      => 'is_paynum',
            'type'    => 'switcher',
            'title'   => '是否显示已销售数量',
            'default' => true,
        ),
        array(
            'id'      => 'is_desc_info',
            'type'    => 'switcher',
            'title'   => '是否显示其他信息',
            'default' => true,
        ),
        array(
            'id'      => 'is_datetime',
            'type'    => 'switcher',
            'title'   => '是否显示其他信息-(最新更新时间)',
            'default' => true,
            'dependency' => array( 'is_desc_info', '==', 'true' ),
        ),
        array(
            'id'      => 'is_qqhao',
            'type'    => 'switcher',
            'title'   => '是否显示QQ咨询按钮',
            'default' => true,
        ),
        array(
            'id'      => 'is_end_time',
            'type'    => 'switcher',
            'title'   => '是否关闭过期天数提示',
            'default' => false,
        ),
        array(
            'id'         => 'ac_qqhao',
            'type'       => 'text',
            'title'      => '咨询QQ号码',
            'default'    => '88888888',
            'dependency' => array('is_qqhao', '==', 'true'),
        ),
    ),
));

//
// ：：友情提示！此处为核心下载小工具，高能注意：：
// ：：如果您要修改一些东西，请准备好烧脑的准备：：
//
if (!function_exists('cao_widget_pay')) {
    function cao_widget_pay($args, $instance)
    {
        if (_cao('close_site_shop','0')) {
            return false;
        }
        global $post;
        $post_id = $post->ID;
        $user_id = is_user_logged_in() ? wp_get_current_user()->ID : 0;
        // 判断是否资源文章 cao_status
        if (!_get_post_shop_status()) {
            return false;
        }
        echo $args['before_widget'];
        
        // 内容区域
        $cao_price = get_post_meta($post_id, 'cao_price', true);
        if ($cao_price==='') {
            //如果没有设置价格 默认为1 防止报错
            $cao_price = 1;
        }
        $cao_vip_rate = get_post_meta($post_id, 'cao_vip_rate', true);
        if ($cao_vip_rate == '') {
            //如果没有设置折扣 默认为1 防止报错
            $cao_vip_rate = 1;
        }
        $cao_downurl     = get_post_meta($post_id, 'cao_downurl', true);
        $cao_pwd         = get_post_meta($post_id, 'cao_pwd', true);
        $cao_demourl     = get_post_meta($post_id, 'cao_demourl', true);
        $cao_paynum      = get_post_meta($post_id, 'cao_paynum', true);
        $cao_info        = get_post_meta($post_id, 'cao_info', true);
        $cao_is_boosvip  = get_post_meta($post_id, 'cao_is_boosvip', true);
        $cao_close_novip_pay  = get_post_meta($post_id, 'cao_close_novip_pay', true);
       
        $site_vip_name=_cao('site_vip_name');
        $site_no_vip_name=_cao('site_no_vip_name');
        $site_money_ua=_cao('site_money_ua');
        
        $CaoUser = new CaoUser($user_id);
        $cao_this_am   = $cao_price . $site_money_ua;
        echo '<div class="pay--rateinfo">';
        //最低价格
        $min_price = ($cao_price * $cao_vip_rate==0 || $cao_is_boosvip) ? 0 : $cao_price * $cao_vip_rate ;
        if ($cao_price==0) {
            echo '<b><span class="price">免费</span></b>';
        }else{
            echo '<b><span class="price">' . $cao_price . '<sup>'. $site_money_ua.' <i class="'._cao('site_money_icon').'"></i></sup></span></b>';
        }
        // if ($min_price < $cao_price) {
        //   //最高价格 
        //     echo '<i class="fa fa-minus"></i><b><span class="price">' . $cao_price . '<sup>'. $site_money_ua.'</sup></span></b>';
        // }
        echo '</div>';
        if ($min_price < $cao_price || $cao_close_novip_pay) {
            echo '<ul class="pricing-options">';
            if ($cao_close_novip_pay) {
                echo '<li><i class="fa fa-circle-o"></i> 普通用户暂无购买权限  <a class="label label-warning" href="/user?action=vip" class="pay-vip">升级'.$site_vip_name.'</a></li>';
            }else{
                echo '<li><i class="fa fa-circle-o"></i> '.$site_no_vip_name.'用户购买价格 : <span class="pricing__opt">' . $cao_price . $site_money_ua. '</span></li>';
            }
            if ($min_price < $cao_price || $cao_close_novip_pay) {
                if ($CaoUser->vip_status()) {
                    echo '<li style="color: #21b3fc;"><i class="fa fa-check-circle"></i> '.$site_vip_name.'会员购买价格 : <span class="pricing__opt">' . ($cao_price * $cao_vip_rate) . $site_money_ua. '</span></li>';
                    $cao_this_am   = ($cao_price * $cao_vip_rate) . $site_money_ua;
                }else{
                    echo '<li><i class="fa fa-circle-o"></i> '.$site_vip_name.'会员购买价格 : <span class="pricing__opt">' . ($cao_price * $cao_vip_rate) . $site_money_ua. '</span></li>';
                }
            }
            if ($cao_is_boosvip) {
                if (is_boosvip_status($user_id)) {
                    echo '<li style="color: #FF9800;"><i class="fa fa-check-circle"></i> 终身'.$site_vip_name.'购买价格 : <span class="pricing__opt">免费</span></li>';
                    $cao_this_am   = '免费获取';
                }else{
                    echo '<li><i class="fa fa-circle-o"></i> 终身'.$site_vip_name.'购买价格 : <span class="pricing__opt">免费</span></li>';
                }
            }
            echo '</ul>';
        }
        // header
        echo '<div class="pay--content">';

        $create_nonce = wp_create_nonce('caopay-' . $post_id);
        echo '<div class="pay-box">';

        $RiProPayAuth = new RiProPayAuth($user_id,$post_id);
        $cao_pwd_html = (empty($cao_pwd)) ? '' : '<span class="pwd">文件密码：<span title="点击一键复制密码" id="refurl" class="copypaw" data-clipboard-text="'.$cao_pwd.'">'.$cao_pwd.'</span></span>' ;

        switch ($RiProPayAuth->ThePayAuthStatus()) {
          case 11: //免登陆  已经购买过 输出OK
            echo cao_get_post_downBtn($post_id); // 输出下载按钮
            echo $cao_pwd_html;
            break;
          case 12: //免登陆  登录后查看
            if (!_cao('is_ripro_free_no_login')) {
                echo '<a class="login-btn btn btn--primary btn--block"><i class="fa fa-user"></i> 登录后下载</a>';
            }else{
                echo cao_get_post_downBtn($post_id); // 输出下载按钮
                echo $cao_pwd_html;
            }
            break;
          case 13: //免登陆 输出购买按钮信息
            if ($cao_close_novip_pay && !$CaoUser->vip_status()) {
                echo '<button type="button" class="btn btn--primary btn--block disabled" >暂无购买权限</button>';
            }else{
                echo '<button type="button" class="click-pay btn btn--primary btn--block" data-postid="' . $post_id . '" data-nonce="' . $create_nonce . '" data-price="' . $cao_this_am . '">支付下载</button>';
            }
            break;
          case 21: //登陆后  已经购买过 输出OK
            echo cao_get_post_downBtn($post_id); // 输出下载按钮
            echo $cao_pwd_html;
            break;
          case 22: //登陆后  输出购买按钮信息
            if ($cao_close_novip_pay && !$CaoUser->vip_status()) {
                echo '<button type="button" class="btn btn--primary btn--block disabled" >暂无购买权限</button>';
            }else{
                echo '<button type="button" class="click-pay btn btn--primary btn--block" data-postid="' . $post_id . '" data-nonce="' . $create_nonce . '" data-price="' . $cao_this_am . '">支付下载</button>';
            }
            break;
          case 31: //没有开启免登录 没有登录 输出登录后进行操作
            echo '<a class="login-btn btn btn--primary btn--block"><i class="fa fa-user"></i> 登录后购买</a>';
            break;
        }
        // 自定义按钮
        $cao_diy_btn =get_post_meta($post_id, 'cao_diy_btn', true);
        $btn_array=explode('|', $cao_diy_btn);
        if ($cao_diy_btn) {
            echo '<a target="_blank" href="'.trim($btn_array[1]).'" class="btn btn--danger btn--block mt-10">'.trim($btn_array[0]).'</a>';
        }
       
        echo '</div>';
        echo '</div>';
         //其他信息
        if ($instance['is_desc_info']) {
            echo '<div class="agent--contact">';
            echo '<ul class="list-paybody">';
            if ($cao_demourl) {
                echo '<li><span>演示地址</span><span><a target="_blank" rel="nofollow" href="'.$cao_demourl.'"><i class="fa fa-television"></i> 查看</a></span></li>';
            }
            if ($cao_info) {
                foreach ($cao_info as $key => $value) {
                    echo '<li><span>' . $value['title'] . '</span><span>' . $value['desc'] . '</span></li>';
                }
            }
            if (empty($instance['is_end_time'])) {
                $post_expire = get_post_meta($post_id,'cao_expire_day',1);
                $shop_expire = (empty($post_expire)) ? _cao('ripro_expire_day','0') : $post_expire ;
                $shop_expire = ($shop_expire==0) ? '永久' : $post_expire.'天' ;
                echo '<li><span>有效期</span><span>' . $shop_expire . ' </span></li>';
            }
            if ($instance['is_paynum']) {
                echo '<li><span>已售</span><span>' . $cao_paynum . '</span></li>';
            }
            if ($instance['is_datetime']) {
                echo '<li><span>最近更新</span><span>' . get_the_modified_time('Y年m月d日') . '</span></li>';
            }
            echo '</ul></div>';
        }
        // 在线咨询信息
        if ($instance['is_qqhao'] && $instance['ac_qqhao']) {
            echo '<div class="ac_qqhao"><a target="_blank" href="http://wpa.qq.com/msgrd?v=3&uin=' . $instance['ac_qqhao'] . '&site=qq&menu=yes"><i class="fa fa-qq"></i> QQ咨询</a></div>';
        }
        // 内容区域END
        echo $args['after_widget'];

    }
}

// 用户信息小工具
CSF::createWidget('cao_widget_userinfo', array(
    'title'       => 'RIPRO-用户信息展示',
    'classname'   => 'widget-userinfo',
    'description' => 'RIPRO主题的小工具',
    'fields'      => array(
        
    ),
));
if (!function_exists('cao_widget_userinfo')) {
    function cao_widget_userinfo($args, $instance)
    {
        if (_cao('close_site_shop','0')) {
            return false;
        }
        if (!is_user_logged_in()) {
            return false;
        }
        global $current_user;
        $CaoUser = new CaoUser($current_user->ID);
        $site_money_ua = _cao('site_money_ua');
        echo $args['before_widget'];
        // start
        ob_start(); ?>
        <div class="author-card_content">
            <div class="author_avatar">
                <div class="col-auto"><?php echo get_avatar($current_user->user_email); ?></div>
                <div class="col n2">
                    <a href="<?php echo esc_url(home_url('/user'))?>"><?php echo $current_user->display_name;?></a>
                    <?php 
                    if ($CaoUser->vip_status()) {
                        echo '<small class="d-block">'.$CaoUser->vip_name().'<span class="tips">会员</span></small>';
                    }else{
                        echo '<small class="d-block">'.$CaoUser->vip_name().'<span class="tips">用户</span></small>';
                    }
                    ?>
                </div>
                <?php if (_cao('is_qiandao','1')) : ?>
                    <div class="col-auto">
                    <?php if (_cao_user_is_qiandao()) {
                        echo '<button type="button" class="btn btn-qiandao disabled"><i class="fa fa-check"></i> 已签到</button>';
                    }else{
                        echo '<button type="button" class="click-qiandao btn btn-qiandao"><i class="fa fa-hand-peace-o"></i> 签到</button>';
                    }
                    ?>
                    </div>
                <?php endif; ?>
            </div>
            <div class="author-fields">
                <div class="row">
                    <div class="col-6 text-center">
                        <span class="num"><?php echo $CaoUser->get_balance();?></span>
                        <span class="d-block"><i class="<?php echo _cao('site_money_icon'); ?>"></i> <?php echo $site_money_ua;?>余额</span>
                    </div>
                    <div class="col-6 text-center">
                        <span class="num"><?php echo $CaoUser->get_consumed_balance();?></span>
                        <span class="d-block"><i class="<?php echo _cao('site_money_icon'); ?>"></i> 已消费</span>
                    </div>
                </div>
            </div>
        </div>
        <?php echo ob_get_clean();
        // end
        echo $args['after_widget'];
    }
}


// CAO主题的广告展示小工具
CSF::createWidget('cao_widget_ads', array(
    'title'       => 'RIPRO-广告展示',
    'classname'   => 'widget-adss',
    'description' => 'RIPRO主题的小工具',
    'fields'      => array(
        array(
            'id'         => '_color',
            'type'       => 'color',
            'title'      => '背景颜色',
            'default'    => '#21add1',
        ),
        array(
            'id'         => '_title',
            'type'       => 'text',
            'title'      => '主标题',
            'default'    => '免费领50元优惠券',
        ),
        array(
            'id'         => '_desc',
            'type'       => 'text',
            'title'      => '描述',
            'default'    => '推荐RiPro主题正版，安全有保障',
        ),
        array(
            'id'         => '_href',
            'type'       => 'text',
            'title'      => '链接地址',
            'default'    => 'http://www.haodaima.cc/',
        ),
    ),
));
if (!function_exists('cao_widget_ads')) {
    function cao_widget_ads($args, $instance)
    {
        echo $args['before_widget'];
        // if ( ! empty( $instance['title'] ) ) {
        //   echo $args['before_title'] . apply_filters( 'widget_title', $instance['title'] ) . $args['after_title'];
        // }
        // start
        $_color   = $instance['_color'];
        $_title     = $instance['_title'];
        $_desc     = $instance['_desc'];
        $_href     = $instance['_href'];
       
        echo '<div class="adsbg">';
        echo '<a class="asr" href="'.$_href.'" target="_blank" style="background-color:'.$_color.'">';
        echo '<h4>'.$_title.'</h4>';
        echo '<h5>'.$_desc.'</h5>';
        echo '<span class="btn btn-outline">立即查看</span>';
        echo '</a>';
        echo '</div>';
       
        // end
        echo $args['after_widget'];
    }
}




// CAO主题的评论展示小工具
CSF::createWidget('cao_widget_comments', array(
    'title'       => 'RIPRO-评论展示',
    'classname'   => 'widget-comments',
    'description' => 'RIPRO主题的小工具',
    'fields'      => array(

        array(
            'id'         => 'title',
            'type'       => 'text',
            'title'      => '标题',
            'default'    => '评论展示',
        ),
        array(
            'id'         => 'limit',
            'type'       => 'text',
            'title'      => '显示数量',
            'default'    => '4',
        ),
        array(
            'id'         => 'outer',
            'type'       => 'text',
            'title'      => '排除某用户ID',
            'default'    => '0',
        ),
        
    ),
));
if (!function_exists('cao_widget_comments')) {
    function cao_widget_comments($args, $instance)
    {
        echo $args['before_widget'];
        if ( ! empty( $instance['title'] ) ) {
          echo $args['before_title'] . apply_filters( 'widget_title', $instance['title'] ) . $args['after_title'];
        }
        // start
        $limit   = $instance['limit'];
        $outer     = isset($instance['outer']) ? $instance['outer'] : 0;
        $output = '';
        global $wpdb;
        $sql      = "SELECT DISTINCT ID, post_title, post_password, comment_ID, comment_post_ID, comment_author, comment_date, comment_approved,comment_author_email, comment_type,comment_author_url, SUBSTRING(comment_content,1,60) AS com_excerpt FROM $wpdb->comments LEFT OUTER JOIN $wpdb->posts ON ($wpdb->comments.comment_post_ID = $wpdb->posts.ID) WHERE user_id!='" . $outer . "' AND comment_approved = '1' AND post_password = '' ORDER BY comment_date DESC LIMIT $limit";
        $comments = $wpdb->get_results($sql);
        foreach ($comments as $comment) {
            $output .= '<li><a href="' . get_permalink($comment->ID) . '#comment-' . $comment->comment_ID . '" title="' . $comment->post_title . __('上的评论', 'haoui') . '">';
            $output .= '<div class="inner">'.get_avatar($comment->comment_author_email).'<time><strong>' . strip_tags($comment->comment_author) . '</strong>' . ($comment->comment_date) . '</time><small>' . str_replace(' src=', ' data-src=', convert_smilies(strip_tags($comment->com_excerpt))) . '</small></div>';
            $output .= '</a></li>';
        }
        echo '<ul>' . $output . '</ul>';
        // end
        echo $args['after_widget'];
    }
}



// CAO主题的用户余额排行榜
CSF::createWidget('cao_widget_userstop', array(
    'title'       => 'RIPRO-用户排行榜',
    'classname'   => 'widget-userstop',
    'description' => 'RIPRO主题的小工具',
    'fields'      => array(

        array(
            'id'         => 'title',
            'type'       => 'text',
            'title'      => '标题',
            'default'    => '排行榜',
        ),
        array(
            'id'         => 'limit',
            'type'       => 'text',
            'title'      => '显示数量',
            'default'    => '6',
        ),
        
    ),
));
if (!function_exists('cao_widget_userstop')) {
    function cao_widget_userstop($args, $instance)
    {
        if (_cao('close_site_shop','0')) {
            return false;
        }
        
        echo $args['before_widget'];
        if ( ! empty( $instance['title'] ) ) {
          echo $args['before_title'] . apply_filters( 'widget_title', $instance['title'] ) . $args['after_title'];
        }
        // start
        $limit   = $instance['limit'];
        $outer     = isset($instance['outer']) ? $instance['outer'] : 0;
        $output = '';
        //查询用户
        $arg = array(
            'meta_key'     => 'cao_balance',
            'meta_query'   => array(),
            'orderby'      => 'meta_value_num',
            'order'        => 'DESC',
            'number'       => $limit,
            'count_total'  => false,
        );

        ///////////S CACHE ////////////////
        if (CaoCache::is()) {
            $_the_cache_key = 'ripro_widgets_user_list';
            $_the_cache_data = CaoCache::get($_the_cache_key);
            if(false === $_the_cache_data ){
                $_the_cache_data = get_users($arg); //缓存数据
                CaoCache::set($_the_cache_key,$_the_cache_data);
            }
            $users = $_the_cache_data;
        }else{
            $users = get_users($arg); //原始输出
        }
        ///////////S CACHE ////////////////
        $site_money_ua = _cao('site_money_ua');
        if(!empty($users)){
            foreach($users as $key => $search_user){
                $CaoUser = new CaoUser($search_user->ID);
                $output .= '<li>';
                $output .= '<span class="index num-'.($key+1).'">'.($key+1).'</span>';
                $output .= '<span class="avatar">'.get_avatar($search_user->ID).'</span>';
                $output .= '<span class="name">'.$search_user->display_name.'</span>';
                $output .= '<span class="credits"><span class="num">'.(int)$CaoUser->get_balance().'</span>'.$site_money_ua.'</span>';
                $output .= '</li>';
            }
        }
        echo '<ul>' . $output . '</ul>';
        // end
        echo $args['after_widget'];
    }
}


// CAO主题文章展示小工具2
CSF::createWidget('cao_widget_post', array(
    'title'       => 'RIPRO-文章展示',
    'classname'   => 'cao-widget-posts',
    'description' => 'RIPRO主题的小工具',
    'fields'      => array(

        array(
            'id'         => 'title',
            'type'       => 'text',
            'title'      => '标题',
            'default'    => '文章展示',
        ),
        array(
            'id'      => 'is_cure_cat',
            'type'    => 'switcher',
            'title'   => '当前文章分类',
            'default' => false,
        ),
        array(
          'id'          => 'cat',
          'type'        => 'select',
          'title'       => '展示分类',
          'placeholder' => '选择分类',
          'options'     => 'categories',
          'dependency' => array('is_cure_cat', '==', 'false'),
        ),

        array(
            'id'      => 'is_grid',
            'type'    => 'switcher',
            'title'   => '大图模式',
            'default' => false,
        ),
        array(
          'id'          => 'orderby',
          'type'        => 'select',
          'title'       => '排序方式',
          'options'     => array(
            'date'     => '日期',
            'rand'     => '随机',
            'comment_count' => '评论数',
          ),
        ),
        
        array(
            'id'         => 'limit',
            'type'       => 'text',
            'title'      => '显示数量',
            'default'    => '4',
        ),
        array(
            'id'      => 'ignore',
            'type'    => 'switcher',
            'title'   => '排除置顶文章',
            'default' => true,
        ),
        
    ),
));
if (!function_exists('cao_widget_post')) {
    function cao_widget_post($args, $instance)
    {
        echo $args['before_widget'];
        if ( ! empty( $instance['title'] ) ) {
          echo $args['before_title'] . apply_filters( 'widget_title', $instance['title'] ) . $args['after_title'];
        }
        // start
        $limit   = $instance['limit'];
        $cat     = isset($instance['cat']) ? $instance['cat'] : '';
        $orderby = $instance['orderby'];
        $ignore = $instance['ignore'];
        $is_grid = (!empty($instance['is_grid'])) ? true : false ;
        $is_grid_class = ($is_grid) ? 'grid' : 'left' ;
        
        if (!empty($instance['is_cure_cat']) && is_singular('post') ) {
            $terms = get_the_category();
            $term_ids = array();
            foreach ($terms as $term) {
              $term_ids[] = $term->term_id;
            }
            $_args = array(
                'order'               => 'DESC',
                'category__in'  => $term_ids,
                'post__not_in'   => array(get_the_ID()),
                'orderby'             => $orderby,
                'posts_per_page'           => $limit,
                'ignore_sticky_posts' => $ignore,
            );
        }else{
            $_args = array(
                'order'               => 'DESC',
                'cat'                 => $cat,
                'orderby'             => $orderby,
                'posts_per_page'           => $limit,
                'ignore_sticky_posts' => $ignore,
            );
        }
        
        ///////////S CACHE ////////////////
        if (CaoCache::is()) {
            $_the_cache_key = 'ripro_widgets_posts_'.$cat;
            $_the_cache_data = CaoCache::get($_the_cache_key);
            if(false === $_the_cache_data ){
                $_the_cache_data = new WP_Query( $_args ); //缓存数据
                CaoCache::set($_the_cache_key,$_the_cache_data);
            }
            $PostData = $_the_cache_data;
        }else{
            $PostData =  new WP_Query( $_args ); //原始输出
        }
        ///////////S CACHE ////////////////
        echo '<div class="posts">';
        while ($PostData->have_posts()): $PostData->the_post(); 
        echo '<div class="'.$is_grid_class.'">';
        cao_entry_media( array( 'layout' => 'rect_300' ) );
        echo '<a href="' . esc_url( get_permalink() ) . '" rel="bookmark" title="' . get_the_title() . '">' . get_the_title() . '</a>';
        echo '</div>';
        endwhile;
        echo '</div>';
        wp_reset_query();
        // end
        echo $args['after_widget'];
    }
}



//magsy_about_widget

CSF::createWidget('magsy_about_widget', array(
    'title'       => 'RIPRO-关于本站',
    'classname'   => 'widget_magsy_about_widget',
    'description' => 'RIPRO主题的小工具',
    'fields'      => array(
        array(
            'id'         => 'profile_image',
            'type'       => 'upload',
            'title'      => '图像介绍',
            'default'    => '',
        ),
        array(
            'id'         => 'description',
            'type'       => 'textarea',
            'title'      => '描述详情',
            'default'    => '',
        ),
    ),
));
if (!function_exists('magsy_about_widget')) {
    function magsy_about_widget($args, $instance)
    {
        echo $args['before_widget'];
        if ( ! empty( $instance['title'] ) ) {
          echo $args['before_title'] . apply_filters( 'widget_title', $instance['title'] ) . $args['after_title'];
        }
        // start
        $name = isset( $instance['name'] ) ? $instance['name'] : '';
        $profile_image = isset( $instance['profile_image'] ) ? $instance['profile_image'] : '';
        $description = isset( $instance['description'] ) ? $instance['description'] : '';
       
        ob_start(); ?>
        <img class="profile-image lazyload" data-src="<?php echo esc_url( $profile_image ); ?>" src="data:image/gif;base64,R0lGODlhAQABAAAAACH5BAEKAAEALAAAAAABAAEAAAICTAEAOw==" alt="<?php echo esc_attr( $name ); ?>">
        <?php if ( $description != '' ) : ?>
            <div class="bio">
                <?php echo wp_kses( $description, array(
                    'a'      => array( 'href' => array() ),
                    'span'   => array( 'style' => array() ),
                    'i'      => array( 'class' => array(), 'style' => array() ),
                    'em'     => array(),
                    'strong' => array(),
                    'br'     => array()
                ) ); ?>
            </div>
        <?php endif; ?>
        
        <?php

        echo ob_get_clean();
       
        // end
        echo $args['after_widget'];
    }
}


//magsy_category_widget

CSF::createWidget('magsy_category_widget', array(
    'title'       => 'RIPRO-分类链接',
    'classname'   => 'widget_magsy_category_widget',
    'description' => 'RIPRO主题的小工具',
    'fields'      => array(
        array(
            'id'         => 'title',
            'type'       => 'text',
            'title'      => '标题',
            'default'    => '',
        ),
    ),
));
if (!function_exists('magsy_category_widget')) {
    function magsy_category_widget($args, $instance)
    {
        echo $args['before_widget'];
        if ( ! empty( $instance['title'] ) ) {
          echo $args['before_title'] . apply_filters( 'widget_title', $instance['title'] ) . $args['after_title'];
        }
        // start
        $categories = get_categories();
        ob_start(); ?>
        <ul>
        <?php foreach ( $categories as $category ) :
          $color = '#ff7473' 
        ?>
          <li class="category-item">
            <a href="<?php echo esc_url( get_category_link( $category->term_id ) ); ?>" title="<?php echo esc_attr( sprintf( esc_html__( 'View all posts in %s', 'magsy' ), $category->name ) ); ?>">
              <span class="category-name">
                <i class="dot" style="background-color: <?php echo esc_attr( $color ); ?>;"></i>
                <?php echo esc_html( $category->name ); ?>
              </span>
              <span class="category-count"><?php echo esc_html( $category->count ); ?></span>
            </a>
          </li>

        <?php endforeach; ?>

        </ul> <?php

        echo ob_get_clean();
        // end
        echo $args['after_widget'];
    }
}
