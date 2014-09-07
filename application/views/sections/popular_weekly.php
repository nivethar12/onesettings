  <div class="featuredblogs">
		<?php foreach($topUsersWeekly as $row){?>
		<?php if(is_object($row) && is_numeric($row->week) && $row->week > 0){?>
        <div class="blogsmall">
        	<div class="follow-done"></div>   
			<a href="http://www.gatherfollowers.com/follow/highlyglamorous" target="_blank" class="followBlogLnk" >
				<span class="followblog">Follow</span>
			</a>
			<a href="http://<?php echo $row->tumblr_domain;?>" target="_blank">
				<span class="viewblog">View Blog</span>
			</a>
        	<img src="http://api.tumblr.com/v2/blog/<?php echo $row->tumblr_domain;?>/avatar/64"  style="width:64px; height:64px; border-radius: 5px;">
        	<div class="daysleft"><font><font>+ <?php if(is_numeric($row->week)){echo $row->week;}else{echo "0";}?> Cr</font></font></div>
        </div>
        <?php }}?>
	</div>	
	