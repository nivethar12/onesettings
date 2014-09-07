	<div class="recentblogs">
		<?php foreach($recentPromotions as $row){?>
		<?php if(is_object($row)){?>
        <div class="blogsmall" data-toggle="tooltip" title="<?php echo $row->tumblr_domain;?>">
			<div class="follow-done"></div>        
			<a href="#" data-domain="<?php echo $row->tumblr_domain;?>" target="_blank" class="followBlogLnk" >
				<span class="followblog">Follow</span>
			</a>
			<a href="http://<?php echo $row->tumblr_domain;?>" target="_blank"  class="outlink" >
				<span class="viewblog">View Blog</span>
			</a>
        	<img src="http://api.tumblr.com/v2/blog/<?php echo $row->tumblr_domain;?>/avatar/64"  style="width:64px; height:64px; border-radius: 5px;">
        </div>
        <?php }}?>
	</div>	