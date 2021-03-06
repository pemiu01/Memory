<?php
/**
 * ┌─┐┬ ┬┌─┐┬ ┬┌┐┌┌─┐┌─┐┌┐┌┌─┐ ┌─┐┌─┐┌┬┐
 * └─┐├─┤├─┤││││││┌─┘├┤ ││││ ┬ │  │ ││││
 * └─┘┴ ┴┴ ┴└┴┘┘└┘└─┘└─┘┘└┘└─┘o└─┘└─┘┴ ┴
 *
 * @package WordPress
 * @Theme Memory
 *
 * @author admin@shawnzeng.com
 * @link https://shawnzeng.com
 */
	get_header();
	setPostViews(get_the_ID());
?>
   	<div id="main">
        <div id="main-part">
			<?php if (have_posts()) : the_post(); update_post_caches($posts); ?>
			<article class="art">
				<header class="art-header">
					<?php echo get_avatar( get_the_author_meta( 'ID' ) ); ?>
					<div class="right-box">
						<h3 class="article-author"><?php the_author(); ?>
					 		<i class="fa fa-vcard"></i>
					 		<span class="normal">发布了一篇文章</span>
						</h3>
						<h3 class="article-title"><a href="<?php the_permalink(); ?>" rel="bookmark">「<?php the_title(); ?>」</a></h3>
						<div class="art-info">
			                <span class="art-info-date">
			                	<i class="fa fa-calendar"></i>&nbsp;<?php echo human_time_diff(get_the_time('U'), current_time('timestamp')) . '前'; ?>
							</span>&nbsp;•&nbsp;
							<span class="art-info-category">
								<i class="fa fa-archive"></i>&nbsp;<?php the_category( ', ' ); ?>
							</span>&nbsp;•&nbsp;
			                <span class="art-info-tag">
			                	<i class="fa fa-tags"></i>&nbsp;<?php the_tags('', ', ', ''); ?>
			                </span>&nbsp;•&nbsp;
							<span class="art-info-view">
			                	<i class="fa fa-eye"></i>&nbsp;<?php echo getPostViews(get_the_ID()); ?>
			                </span>&nbsp;•&nbsp;
			                <span class="art-info-comment">
			                	<i class="fa fa-comment-o"></i>&nbsp;<?php comments_popup_link('0', '1', '%', '', '评论已关闭'); ?>
			            	</span>
							<span class="art-info-edit">
							<?php edit_post_link('编辑', '&nbsp;•&nbsp;&nbsp;', ''); ?>
							</span>
							<?php 
								if( current_user_can( 'manage_options') )
									if(d4v(get_permalink()) == 1) 
										$shoulu="•&nbsp;&nbsp;<i class='fa fa-paw'></i>&nbsp;<span>已收录</span>"; 
									else 
										$shoulu="•&nbsp;&nbsp;<i class='fa fa-paw'>&nbsp;</i><span><a target='_blank' href='http://zhanzhang.baidu.com/sitesubmit/index?sitename=".get_permalink()."'>未收录!点此提交</a></span>";  
								echo $shoulu;
							?>
			        	</div>
					</div>
				</header>
                <div class="art-main">
                    <div class="art-content">
						<?php if ( has_post_thumbnail() ) {
							the_post_thumbnail();
						}
						the_content();
						?>
                    </div>
					<div class="article-info">
						<span class="post-like">
         					<a href="javascript:;" data-action="ding" data-id="<?php the_ID(); ?>" class="favorite<?php if(isset($_COOKIE['memory_ding_'.$post->ID])) echo ' done';?>"><span class="count">
           					<?php if( get_post_meta($post->ID,'memory_ding',true) ){
                    			echo get_post_meta($post->ID,'memory_ding',true);
                 			} else {
                    			echo '0';
                 			}?></span>
        					</a>
 						</span>
						<span class="share">
							分享
						</span>
						<span class="dashang">
							打赏
						</span>
			        </div>
					<div class="social-share" data-sites="<?php if( get_option('memory_share')!=null ) echo get_option('memory_share'); ?>"></div>
					<script src="<?php bloginfo('template_url'); ?>/js/jquery.share.min.js"></script>
					<?php memory_donate(); ?>
				</div>
            </article>
			<?php endif; ?>
			<div class="art nearby-article">
				<div class="nearby-article-left"><?php if (get_previous_post()) { previous_post_link('上一篇: %link','%title',false);} else { echo "没有了，已经是最后文章啦";} ?></div>    
				<div class="nearby-article-right"><?php if (get_next_post()) { next_post_link('下一篇: %link','%title',false);} else { echo "没有了，已经是最新文章啦";} ?></div>    
			</div>
			<?php comments_template(); ?>
        </div>
        <?php get_sidebar(); ?>
    </div>
<?php get_footer(); ?>