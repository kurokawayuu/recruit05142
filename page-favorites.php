<?php
/**
 * Template Name: Favorites Page Revised
 *
 * @package WordPress
 * @subpackage Your_Theme_Name
 * @since Your_Theme_Version
 */

get_header(); ?>

<div id="primary" class="content-area">
    <main id="main" class="site-main" role="main">

        <?php if ( is_user_logged_in() ) : ?>
            <style>
            /* カード全体のスタイル（検索結果と一致） */
            .job-cards-container {
                display: flex;
                flex-direction: column;
                align-items: center;
                width: 100%;
                max-width: 1000px;
                margin: 0 auto;
            }
            
            .job-card {
                background-color: white;
                border-radius: 15px;
                box-shadow: 0 2px 10px rgba(0,0,0,0.1);
                width: 100%;
                max-width: 1000px;
                overflow: hidden;
                padding: 20px;
                margin-bottom: 30px;
            }
            
            .job-content {
                display: flex;
                gap: 20px;
                margin-bottom: 20px;
            }
            
            /* 左側のスタイル */
            .left-content {
                width: 30%;
                display: flex;
                flex-direction: column;
                gap: 15px;
            }
            
            .job-image {
                width: 100%;
                border-radius: 8px;
                overflow: hidden;
                position: relative;
            }
            
            .job-image img {
                width: 100%;
                height: auto;
                object-fit: cover;
            }
            
            /* お気に入りボタン（左上に配置） */
            .favorite-icon {
                position: absolute;
                top: 8px;
                left: 8px;
                background: rgba(0, 0, 0, 0.5);
                color: white;
                padding: 5px;
                border-radius: 50%;
                cursor: pointer;
                z-index: 10;
            }
            
            .favorite-icon.favorited {
                color: #ff4757;
            }
            
            /* 施設アイコン */
            .facility-icons {
                display: flex;
                gap: 10px;
                margin-top: 10px;
                margin-bottom: 10px;
            }
            
            .facility-icon {
                display: flex;
                align-items: center;
                justify-content: center;
                width: 60px;
                height: 60px;
                background-color: #fff;
            }
            
            .facility-icon img {
                width: 100%;
                height: 100%;
                object-fit: contain;
            }
            
            /* タグ */
            .tags-container {
                display: flex;
                flex-wrap: nowrap;
                gap: 5px;
                justify-content: flex-start;
                width: 100%;
            }
            
            .tag {
                background-color: #fff;
                border: 1px solid #FFB74D;
                color: #FF9800;
                padding: 3px 5px;
                border-radius: 20px;
                font-size: 10px;
                white-space: nowrap;
                flex: 1;
                text-align: center;
            }
            
            /* 右側のスタイル */
            .right-content {
                width: 70%;
                display: flex;
                flex-direction: column;
                gap: 10px;
            }
            
            .company-section {
                display: flex;
                justify-content: space-between;
                align-items: center;
                margin-bottom: 5px;
            }
            
            .company-name {
                color: #666;
                font-size: 14px;
                text-align: left;
                margin-left: 0;
                padding-left: 0;
            }
            
            .employment-type {
                background-color: #90CAF9;
                color: white;
                padding: 6px 15px;
                border-radius: 30px;
                font-size: 14px;
                margin-left: auto;
                display: inline-block;
            }
            
            .job-title {
                font-size: 20px;
                font-weight: bold;
                margin-bottom: 10px;
            }
            
            .job-title a {
                color: inherit;
                text-decoration: none;
            }
            
            .job-title a:hover {
                color: #2196F3;
            }
            
            .job-subtitle {
                font-size: 16px;
                margin-bottom: 10px;
            }
            
            .job-description {
                font-size: 14px;
                color: #333;
                line-height: 1.6;
            }
            
            /* 区切り線 */
            .divider {
                height: 1px;
                background-color: #eee;
                margin: 15px 0;
            }
            
            .job-info {
                display: flex;
                flex-direction: column;
                gap: 10px;
                margin-bottom: 15px;
            }
            
            .info-item {
                display: flex;
                align-items: center;
                gap: 10px;
            }
            
            .info-icon {
                width: 20px;
                color: #999;
                display: flex;
                align-items: center;
                justify-content: center;
            }
            
            /* ボタンエリア */
            .buttons-container {
                display: flex;
                justify-content: space-between;
                margin-top: 20px;
            }
            
            .keep-button, .remove-from-favorites {
                background-color: #fff;
                border: 1px solid #FFB74D;
                color: #FF9800;
                padding: 15px 20px;
                border-radius: 8px;
                font-size: 16px;
                font-weight: bold;
                width: 45%;
                display: flex;
                align-items: center;
                justify-content: center;
                cursor: pointer;
                text-decoration: none;
            }
            
            .keep-button.kept, .remove-from-favorites {
                background-color: #FFF8E1;
            }
            
            .keep-button .star, .remove-from-favorites .star {
                color: #FFB74D;
                margin-right: 10px;
            }
            
            .detail-view-button {
                background-color: #26A69A;
                border: none;
                color: white;
                padding: 15px 20px;
                border-radius: 8px;
                font-size: 16px;
                font-weight: bold;
                width: 45%;
                display: flex;
                align-items: center;
                justify-content: center;
                cursor: pointer;
                text-decoration: none;
            }
            
            /* ページヘッダー */
            .favorites-page-header {
                text-align: center;
                margin-bottom: 30px;
            }
            
            .favorites-page-header h1 {
                font-size: 28px;
                margin-bottom: 10px;
                color: #333;
            }
            
            /* 通知エリア */
            .favorites-notice {
                background-color: #f0f8ff;
                padding: 15px;
                border-left: 4px solid #2196F3;
                margin-bottom: 25px;
                border-radius: 4px;
                text-align: center;
                max-width: 1000px;
                margin-left: auto;
                margin-right: auto;
            }
            
            .favorites-notice p {
                margin: 0;
                color: #333;
            }
            
            /* お気に入りなしの状態 */
            .no-favorites {
                text-align: center;
                padding: 60px 20px;
                background: #f9f9f9;
                border-radius: 8px;
                max-width: 1000px;
                margin: 0 auto;
            }
            
            .no-favorites h2 {
                font-size: 24px;
                margin-bottom: 15px;
                color: #333;
            }
            
            .no-favorites p {
                font-size: 16px;
                margin-bottom: 25px;
                color: #666;
            }
            
            .search-jobs-btn {
                background: #2196F3;
                color: white;
                padding: 12px 30px;
                border-radius: 25px;
                text-decoration: none;
                font-weight: bold;
                display: inline-block;
                transition: background 0.2s;
            }
            
            .search-jobs-btn:hover {
                background: #1976d2;
            }
            
            /* レスポンシブデザイン */
            @media (max-width: 768px) {
                .job-content {
                    flex-direction: column;
                }
                
                .left-content, .right-content {
                    width: 100%;
                }
                
                .buttons-container {
                    flex-direction: column;
                    gap: 10px;
                }
                
                .keep-button, .detail-view-button, .remove-from-favorites {
                    width: 100%;
                }
            }
            </style>

            <div class="favorites-page-header">
                <h1>気になる求人リスト</h1>
                
                <?php
                // JavaScriptの読み込み
                wp_enqueue_script('favorites-script', get_template_directory_uri() . '/js/favorites.js', array('jquery'), '1.0.0', true);
                wp_localize_script('favorites-script', 'favoritesAjax', array(
                    'ajaxurl' => admin_url('admin-ajax.php'),
                    'nonce'   => wp_create_nonce('favorites_nonce')
                ));
                ?>
            </div>

            <div id="favorites-list-container">
                <?php
                $current_user_id = get_current_user_id();
                $favorite_job_ids = get_user_meta( $current_user_id, 'user_favorites', true );

                if ( ! empty( $favorite_job_ids ) && is_array( $favorite_job_ids ) ) :
                    $args = array(
                        'post_type'      => 'job',
                        'post__in'       => $favorite_job_ids,
                        'posts_per_page' => -1,
                        'orderby'        => 'post__in',
                        'post_status'    => 'publish'
                    );
                    $favorite_jobs_query = new WP_Query( $args );

                    if ( $favorite_jobs_query->have_posts() ) :
                ?>
                        <div class="favorites-notice">
                            <p>現在<strong><?php echo count($favorite_job_ids); ?>件</strong>の求人をキープしています。</p>
                        </div>
                        
                        <div class="job-cards-container">
                            <?php while ( $favorite_jobs_query->have_posts() ) : $favorite_jobs_query->the_post(); 
                                // 求人の詳細情報を取得
                                $job_id = get_the_ID();
                                $facility_name = get_post_meta($job_id, 'facility_name', true);
                                $facility_company = get_post_meta($job_id, 'facility_company', true);
                                $job_content_title = get_post_meta($job_id, 'job_content_title', true);
                                $salary_range = get_post_meta($job_id, 'salary_range', true);
                                $working_hours = get_post_meta($job_id, 'working_hours', true);
                                $facility_address = get_post_meta($job_id, 'facility_address', true);
                                
                                // タクソノミーの取得
                                $job_location = wp_get_object_terms($job_id, 'job_location', array('fields' => 'names'));
                                $job_position = wp_get_object_terms($job_id, 'job_position', array('fields' => 'names'));
                                $job_type = wp_get_object_terms($job_id, 'job_type', array('fields' => 'names'));
                                $facility_type = wp_get_object_terms($job_id, 'facility_type', array('fields' => 'names'));
                                $job_feature = wp_get_object_terms($job_id, 'job_feature', array('fields' => 'names'));
                                
                                // 施設形態のスラッグを配列で取得
                                $facility_slugs = array();
                                if ($facility_type && !is_wp_error($facility_type)) {
                                    foreach ($facility_type as $type) {
                                        $facility_slugs[] = $type->slug;
                                    }
                                }
                                
                                // 放デイと児発支援のフラグを設定
                                $has_houkago = in_array('houkago-day', $facility_slugs) || 
                                              in_array('houkago', $facility_slugs) || 
                                              in_array('houkago-dayservice', $facility_slugs);
                                
                                $has_jidou = in_array('jidou-hattatsu', $facility_slugs) || 
                                            in_array('jidou', $facility_slugs) || 
                                            in_array('jidou-hattatsu-shien', $facility_slugs);
                                
                                // 雇用形態に基づくカラークラスを設定
                                $employment_color_class = '';
                                if ($job_type && !is_wp_error($job_type)) {
                                    switch($job_type[0]->slug) {
                                        case 'full-time':
                                        case 'seishain':
                                            $employment_color_class = 'full-time-color';
                                            break;
                                        case 'part-time':
                                        case 'part':
                                        case 'arubaito':
                                            $employment_color_class = 'part-time-color';
                                            break;
                                        case 'contract':
                                        case 'keiyaku':
                                            $employment_color_class = 'contract-color';
                                            break;
                                        case 'temporary':
                                        case 'haken':
                                            $employment_color_class = 'temporary-color';
                                            break;
                                    }
                                }
                                
                                // サムネイル画像
                                $thumbnail_url = get_the_post_thumbnail_url($job_id, 'medium');
                                if (!$thumbnail_url) {
                                    $thumbnail_url = get_template_directory_uri() . '/assets/images/no-image.jpg';
                                }
                            ?>
                                <div id="favorite-item-<?php echo $job_id; ?>" class="job-card">
                                    <!-- 上部コンテンツ：左右に分割 -->
                                    <div class="job-content">
                                        <!-- 左側：サムネイル画像、施設形態アイコン、特徴タグ -->
                                        <div class="left-content">
                                            <!-- サムネイル画像 -->
                                            <div class="job-image">
                                                <img src="<?php echo esc_url($thumbnail_url); ?>" alt="<?php echo esc_attr($facility_name); ?>">
                                                <!-- お気に入りアイコン（左上） -->
                                                <div class="favorite-icon favorited" onclick="removeFavorite(<?php echo $job_id; ?>)">
                                                    ★
                                                </div>
                                            </div>
                                            
                                            <!-- 施設形態を画像アイコン -->
                                            <div class="facility-icons">
                                                <?php if ($has_houkago): ?>
                                                <!-- 放デイアイコン -->
                                                <div class="facility-icon">
                                                    <img src="<?php echo get_stylesheet_directory_uri(); ?>/img/day.png" alt="放デイ">
                                                </div>
                                                <?php endif; ?>
                                                
                                                <?php if ($has_jidou): ?>
                                                <!-- 児発支援アイコン -->
                                                <div class="facility-icon red-icon">
                                                    <img src="<?php echo get_stylesheet_directory_uri(); ?>/img/support.png" alt="児発支援">
                                                </div>
                                                <?php endif; ?>
                                            </div>
                                            
                                            <!-- 特徴タクソノミータグ - 3つまで表示 -->
                                            <?php if ($job_feature && !is_wp_error($job_feature)): ?>
                                            <div class="tags-container">
                                                <?php 
                                                $features_count = 0;
                                                foreach ($job_feature as $feature):
                                                    if ($features_count < 3):
                                                        // プレミアム特徴の判定
                                                        $premium_class = (in_array($feature->slug, ['high-salary', 'bonus-available'])) ? 'premium' : '';
                                                ?>
                                                    <span class="tag <?php echo $premium_class; ?>"><?php echo esc_html($feature->name); ?></span>
                                                <?php
                                                        $features_count++;
                                                    endif;
                                                endforeach; 
                                                ?>
                                            </div>
                                            <?php endif; ?>
                                        </div>
                                        
                                        <!-- 右側：運営会社名、施設名、本文詳細 -->
                                        <div class="right-content">
                                            <!-- 会社名と雇用形態を横に並べる -->
                                            <div class="company-section">
                                                <span class="company-name"><?php echo esc_html($facility_company); ?></span>
                                                <?php if ($job_type && !is_wp_error($job_type)): ?>
                                                <div class="employment-type <?php echo $employment_color_class; ?>">
                                                    <?php echo esc_html($job_type[0]->name); ?>
                                                </div>
                                                <?php endif; ?>
                                            </div>
                                            
                                            <!-- 施設名を会社名の下に配置 -->
                                            <h1 class="job-title">
                                                <a href="<?php the_permalink(); ?>" rel="bookmark">
                                                    <?php echo esc_html($facility_name); ?>
                                                </a>
                                            </h1>
                                            
                                            <h2 class="job-subtitle"><?php echo esc_html($job_content_title); ?></h2>
                                            
                                            <p class="job-description">
                                                <?php echo wp_trim_words(get_the_content(), 40, '...'); ?>
                                            </p>
                                            
                                            <!-- 本文の下に区切り線を追加 -->
                                            <div class="divider"></div>
                                            
                                            <!-- 職種、給料、住所情報 -->
                                            <div class="job-info">
                                                <?php if ($job_position && !is_wp_error($job_position)): ?>
                                                <div class="info-item">
                                                    <span class="info-icon"><i class="fa-solid fa-user"></i></span>
                                                    <span><?php echo esc_html($job_position[0]->name); ?></span>
                                                </div>
                                                <?php endif; ?>
                                                
                                                <div class="info-item">
                                                    <span class="info-icon"><i class="fa-solid fa-money-bill-wave"></i></span>
                                                    <span><?php echo esc_html($salary_range); ?></span>
                                                </div>
                                                
                                                <div class="info-item">
                                                    <span class="info-icon"><i class="fa-solid fa-location-dot"></i></span>
                                                    <span><?php echo esc_html($facility_address); ?></span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <!-- 区切り線 -->
                                    <div class="divider"></div>
                                    
                                    <!-- ボタンエリア -->
                                    <div class="buttons-container">
                                        <button class="remove-from-favorites kept" data-job-id="<?php echo $job_id; ?>">
                                            <span class="star">★</span>
                                            キープ済み
                                        </button>
                                        
                                        <a href="<?php the_permalink(); ?>" class="detail-view-button">詳細をみる</a>
                                    </div>
                                </div>
                            <?php endwhile; ?>
                        </div>
                <?php
                        wp_reset_postdata();
                    else :
                        echo '<div class="no-favorites">';
                        echo '<h2>お気に入りの求人がありません</h2>';
                        echo '<p>気になる求人をお気に入りに追加してリストを作成しましょう。</p>';
                        echo '<a href="' . home_url('/jobs/') . '" class="search-jobs-btn">求人を検索する</a>';
                        echo '</div>';
                    endif;
                else :
                    echo '<div class="no-favorites">';
                    echo '<h2>お気に入りの求人がありません</h2>';
                    echo '<p>気になる求人をお気に入りに追加してリストを作成しましょう。</p>';
                    echo '<a href="' . home_url('/jobs/') . '" class="search-jobs-btn">求人を検索する</a>';
                    echo '</div>';
                endif;
                ?>
            </div>

            <script type="text/javascript">
            // お気に入り削除用の関数
            function removeFavorite(jobId) {
                if (!confirm('この求人をお気に入りから削除しますか？')) {
                    return;
                }
                
                jQuery.ajax({
                    url: favoritesAjax.ajaxurl,
                    type: 'POST',
                    data: {
                        action: 'toggle_job_favorite',
                        job_id: jobId,
                        nonce: favoritesAjax.nonce
                    },
                    success: function(response) {
                        if (response.success) {
                            jQuery('#favorite-item-' + jobId).fadeOut(300, function() {
                                jQuery(this).remove();
                                
                                // リストが空になった場合のメッセージ表示
                                if (jQuery('.job-card').length === 0) {
                                    jQuery('#favorites-list-container').html(
                                        '<div class="no-favorites">' +
                                        '<h2>お気に入りの求人がありません</h2>' +
                                        '<p>気になる求人をお気に入りに追加してリストを作成しましょう。</p>' +
                                        '<a href="<?php echo home_url('/jobs/'); ?>" class="search-jobs-btn">求人を検索する</a>' +
                                        '</div>'
                                    );
                                }
                                
                                // 件数を更新
                                var currentCount = jQuery('.favorites-notice strong').text();
                                var newCount = parseInt(currentCount) - 1;
                                if (newCount > 0) {
                                    jQuery('.favorites-notice strong').text(newCount);
                                } else {
                                    jQuery('.favorites-notice').hide();
                                }
                            });
                        } else {
                            alert('エラー: ' + response.data.message);
                        }
                    },
                    error: function() {
                        alert('通信エラーが発生しました。');
                    }
                });
            }
            
            jQuery(document).ready(function($) {
                $('.remove-from-favorites').on('click', function() {
                    var button = $(this);
                    var jobId = button.data('job-id');
                    
                    if (!confirm('この求人をお気に入りから削除しますか？')) {
                        return;
                    }
                    
                    // 削除ボタンの処理
                    $.ajax({
                        url: favoritesAjax.ajaxurl,
                        type: 'POST',
                        data: {
                            action: 'toggle_job_favorite',
                            job_id: jobId,
                            nonce: favoritesAjax.nonce
                        },
                        beforeSend: function() {
                            button.prop('disabled', true).css('opacity', '0.5');
                        },
                        success: function(response) {
                            if (response.success) {
                                $('#favorite-item-' + jobId).fadeOut(300, function() {
                                    $(this).remove();
                                    
                                    // リストが空になった場合のメッセージ表示
                                    if ($('.job-card').length === 0) {
                                        $('#favorites-list-container').html(
                                            '<div class="no-favorites">' +
                                            '<h2>お気に入りの求人がありません</h2>' +
                                            '<p>気になる求人をお気に入りに追加してリストを作成しましょう。</p>' +
                                            '<a href="<?php echo home_url('/jobs/'); ?>" class="search-jobs-btn">求人を検索する</a>' +
                                            '</div>'
                                        );
                                    }
                                    
                                    // 件数を更新
                                    var currentCount = $('.favorites-notice strong').text();
                                    var newCount = parseInt(currentCount) - 1;
                                    if (newCount > 0) {
                                        $('.favorites-notice strong').text(newCount);
                                    } else {
                                        $('.favorites-notice').hide();
                                    }
                                });
                            } else {
                                alert('エラー: ' + response.data.message);
                                button.prop('disabled', false).css('opacity', '1');
                            }
                        },
                        error: function() {
                            alert('通信エラーが発生しました。');
                            button.prop('disabled', false).css('opacity', '1');
                        }
                    });
                });
            });
            </script>

        <?php else : ?>
            <div class="login-required">
                <h2>気になる求人リストを見るにはログインが必要です</h2>
                <p>お気に入りの求人を保存してマイページで管理できます。</p>
                <div class="login-buttons">
                    <a href="<?php echo wp_login_url(get_permalink()); ?>" class="login-btn">ログイン</a>
                    <a href="<?php echo home_url('/register/'); ?>" class="register-btn">新規会員登録</a>
                </div>
            </div>
        <?php endif; ?>

    </main>
</div>

<?php get_footer(); ?>'); ?>