<?php
/*
* -------------------------------------------------------------------------------------
* @author: Doothemes
* @author URI: https://doothemes.com/
* @copyright: (c) 2021 Doothemes. All rights reserved
* -------------------------------------------------------------------------------------
*
* @since 2.5.0
*
*/

function dt_comments_args( $args = array() ){

	$comments_args = array(
		'avatar_size' => 60,
		'style'       => 'ul',
		'callback'    => 'dt_theme_comment_template'
	);

	return wp_parse_args( $args, $comments_args );
}


function dt_theme_comment_template($comment, $args, $depth) {
	$GLOBALS['comment'] = $comment;
	extract($args, EXTR_SKIP);
	$tag =  ('div' == $args['style'] ) ? 'div' : 'li';
	$add_below = 'comment-inner';
?>
	<<?php echo $tag ?> <?php comment_class( empty( $args['has_children'] ) ? '' : 'parent') ?> id="comment-<?php comment_ID() ?>">
	<div class="comment-avatar">
		<?php if ( $args['avatar_size'] != 0 ) echo get_avatar( $comment, $args['avatar_size'] ); ?>
	</div>
	<div class="scontent">
		<div id="comment-inner-<?php comment_ID() ?>">
			<div class="comment-header">
				<?php
					if( $comment->user_id > 0 ){
						echo ''. get_user_option('display_name', $comment->user_id ) .'';
					}
					else{
						printf( __d('%s'), get_comment_author_link() );
					}
				?>
				<?php  ?>
				<span class="comment-time"><?php printf( __d('%1$s'), get_comment_date() ); ?></span>
				<?php
					comment_reply_link( array_merge( $args,
						array(
							'add_below' => $add_below,
							'depth' => $depth,
							'max_depth' => $args['max_depth']
						)
					) );
				?>
                <div class="comment-sentiment">
                    <?php

                    // 输入文本
                    $input_text = comment_just_text(); // 你需要实现这个函数来获取评论内容

                    // 构建 POST 请求的数据
                    $data = array('text' => $input_text);
                    $data_json = json_encode($data);

                    // 设置 cURL 选项
                    $ch = curl_init('http://flask-api:5000/lstm-predict');
                    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
                    curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));
                    curl_setopt($ch, CURLOPT_POSTFIELDS, $data_json);
                    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

                    // 执行 cURL 请求
                    $response = curl_exec($ch);

                    // 检查 cURL 请求是否成功
                    if ($response === false) {
                        echo 'cURL Error: ' . curl_error($ch);
                    } else {
                        // 解析 JSON 响应
                        $result = json_decode($response, true);

                        // 获取情感分析和概率
                        $sentiment = $result['sentiment'];

                        $percentage = $result['probability'] * 100;
                        $formatted_percentage = number_format($percentage, 0, '.', '') . '%';

                        echo 'LSTM-sentiment：' ;
                        if ($sentiment == 1) {
                            echo '<img src="/wp-content/themes/dooplay/assets/img/zan.png" alt="zan" style="width: 20px; height: 20px;">';
                        } else {
                            echo '<img src="/wp-content/themes/dooplay/assets/img/cai.png" alt="cai" style="width: 20px; height: 20px;">';
                        }

                        echo '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;probability：' . $formatted_percentage;
                    }

                    // 关闭 cURL 资源
                    curl_close($ch);
                    ?>
                </div>

            </div>
			<?php if ( $comment->comment_approved == '0') { ?>
				<em class="text-red"><?php _d('Your comment is awaiting moderation.'); ?></em>
			<?php } ?>
			<?php comment_text(); ?>
		</div>
	</div>
<?php }


// Form comments
function dt_theme_comments_args(){
	$commenter = wp_get_current_commenter();
	$required =  ' <em class="text-red" title="'. __d('Required') .'">*</em>';
	$comments_args = array(
		'label_submit'         => __d('Post comment'),
		'title_reply'          => __d('Leave a comment'),
		'logged_in_as'         => '',
		'comment_notes_after'  => '',
		'comment_notes_before' => '',
		'comment_field' => '
			<div class="comment-form-comment">
				<textarea id="comment" name="comment" required="true" class="normal" placeholder="'. __d('Your comment..') .'"></textarea>
			</div>
		',
		'fields' => apply_filters('comment_form_default_fields', array(
			'author' => '
				<div class="grid-container">
					<div class="grid desk-8 alpha">
						<div class="form-label">'. __d('Name') .' '.$required .'</div>
						<div class="form-description">'. __d('Add a display name') .'</div>
						<input name="author" type="text" class="fullwidth" value="'.esc_attr($commenter['comment_author']).'" required="true"/>
					</div>
				</div>
			',
			'email' => '
				<div class="grid-container fix-grid">
					<div class="grid desk-8 alpha">
						<div class="form-label">'. __d('Email') .' '.$required .'</div>
						<div class="form-description">'. __d('Your email address will not be published') .'</div>
						<input name="email" type="text" class="fullwidth" value="'.esc_attr($commenter['comment_author_email']).'" required="true"/>
					</div>
				</div>
			')
		)
	);
	return $comments_args;
}
