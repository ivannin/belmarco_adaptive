                <div>
					<div class="thumbnail">
						<a href="">
						<div class="img-responsive pull-left">
							<?php 
							$attachmentId = get_comment_meta($comment->comment_ID, 'attachmentId', TRUE);
							if(is_numeric($attachmentId) && !empty($attachmentId)){
								echo wp_get_attachment_image($attachmentId,'thumbnail');
							}else {
								echo wp_get_attachment_image(191,'thumbnail');
							} /*Надо заменить картинкой-заглушкой*/
							?>
						</div>
						</a>
					</div><!--/.thumbnails-->
					</div>
						<a href="#">
                        	<div class="rev_txt">
                        		<p><?php 
								$args = array( 
									'maxchar' => 100, 
									'text' => $comment->comment_content,
									'save_format' => false,
									'more_text' => '',
									'echo' => false, 
								);
								echo text_excerpt( $args);?>
								</p>
                        	</div>
                        </div>
                        	<div class="rev_meta clear">
                        		<div class="row">
                                
                                	<div class="col-xs-12"><b><?php echo $comment->comment_author; ?></b><a href="<?php echo $comment->comment_author_url; ?>" class="vk" title="Мы в Вконтакте" target="_blank"></a></div>
                                </div><!--/.row-->
                        	</div><!--/.rev_meta-->
						</a>
					</div>
				</div>
                    


	