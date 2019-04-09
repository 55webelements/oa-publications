<?php
$jsonObj=@json_decode($jsonObj);
$address=@$jsonObj->address;
$sociallinks=@$jsonObj->sociallinks;
$guidelines=@$jsonObj->guidelines;
$indexing=@$jsonObj->indexing;
$adminUrl=@$jsonObj->adminUrl;
$quickLinks=@$jsonObj->quickLinks;
$footerContent=@$jsonObj->footerContent;
?>
	</div>
	<div class="inner-1">
		<footer>
			<div class="row bgcolor11">
				<div class="col-md-12">
					<div class="footerdet">
						<div class="col-md-12 col-sm-12">	
							<p><?php echo @ucwords($footerContent[0]->description);?></p>
						</div>
					</div>
				</div>
			</div>
		</footer>	
	</div>
</div>
	<!-- Sidebar -->
	<div id="sidebar">
		<div class="inner">
			<!-- Search -->
			<section id="search" class="alt">
				<a href="http://hostgenie.in/phpdev/oap-main">
					<img src="<?php echo base_url();?>includes/img/logo.png"/>
				</a>
			</section>
			<!-- Menu -->
			<nav id="menu">
				<header class="major">
					<h2>Menu</h2>
				</header>
				<ul>
					<li><a href="<?php echo base_url();?>">Home</a></li>
					<li><a href="<?php echo base_url();?>index.php/home/editorialBoard">Editorial Board</a></li>
					<li><a href="<?php echo base_url();?>index.php/home/submission">Submission</a></li>
					<li><a href="<?php echo base_url();?>index.php/home/articles">Articles</a></li>
					<?php
					if(@sizeOf($guidelines) > 0)
					{
					?>
					<li>
						<span class="opener">Guidelines</span>
						<ul>
							<?php
							for($g=0;$g<@sizeOf($guidelines);$g++)
							{
							?>
							<li><a href="<?php echo base_url();?>index.php/home/page/<?php echo @$guidelines[$g]->alias_title;?>"><?php echo @$guidelines[$g]->title;?></a></li>
							<?php
							}
							?>
						</ul>
					</li>
					<?php
					}
					?>
				</ul>
			</nav>
			<!-- Section -->
			<?php
			if(@sizeOf($indexing) > 0)
			{
			?>
			<section>
				<header class="major">
					<h2>Indexing</h2>
				</header>
				<div class="mini-posts">
					<?php
					for($i=0;$i<@sizeOf($indexing);$i++)
					{
					?>
					<article>
						<a target="_blank" href="<?php echo @$indexing[$i]->absUrl;?>" class="image"><img src="<?php echo @$adminUrl[0]->admin_url;?>uploads/abstract/<?php echo @$indexing[$i]->absImg;?>" alt="indexing-<?php echo @$i;?>" /></a>
						<p><?php echo @$indexing[$i]->absTitle;?></p>
					</article>
					<?php
					}
					?>
				</div>
				<ul class="actions">
					<li><a href="<?php echo base_url();?>index.php/home/indexing" class="button">More</a></li>
				</ul>
			</section>
			<?php
			}
			?>
			<!-- Section -->
			<section>
				<header class="major">
					<h2>Get in touch</h2>
				</header>
				<ul class="contact">
					<?php 
					if(@$address[0]->address !='')
					{
					?>
					<li class="fa-home"><?php echo @$address[0]->address;?></li>
					
					<?php
					}
					if(@$address[0]->email !='')
					{
					?>
					<li class="fa-envelope-o">
						<a href="mailto:<?php echo @$address[0]->email;?>"><?php echo @$address[0]->email;?></a>
					</li>
					<?php
					}
					if(@$address[0]->phone !='')
					{
					?>
					<li class="fa-phone">
						<?php echo @$address[0]->phone;?>
					</li>
					<?php
					}
					?>
				</ul>
			</section>

			<!-- Footer -->
			<footer id="footer">
				<p class="copyright">&copy; OA Publications. All rights reserved. Developed By: <a href="http://www.55web.in/">55web Elements PVT Ltd</a>.</p>
			</footer>
		</div>
	</div>
</div>

<!-- Scripts -->
<script src="<?php echo base_url();?>includes/js/browser.min.js"></script>
<script src="<?php echo base_url();?>includes/js/breakpoints.min.js"></script>
<script src="<?php echo base_url();?>includes/js/util.js"></script>
<script src="<?php echo base_url();?>includes/js/main.js"></script>
<script>
<?php
if(@$jsonObj->noJs == 0)
{
?>
var element_position = $('#scroll-to').offset().top;
var screen_height = $(window).height();
var activation_offset = 0.5;//determines how far up the the page the element needs to be before triggering the function
var activation_point = element_position - (screen_height * activation_offset);
var max_scroll_height = $('body').height() - screen_height - 5;//-5 for a little bit of buffer

//Does something when user scrolls to it OR
//Does it when user has reached the bottom of the page and hasn't triggered the function yet

$(window).on('scroll', function() {
    var y_scroll_pos = window.pageYOffset;

    var element_in_view = y_scroll_pos > activation_point;
    var has_reached_bottom_of_page = max_scroll_height <= y_scroll_pos && !element_in_view;

    if(element_in_view || has_reached_bottom_of_page) {
		$(".prm-img").css("position","fixed");
		$(".prm-img").css("top","0");
    }
	else
	{
		$(".prm-img").css("position","");
		$(".prm-img").css("top","");
	}
});
<?php
}
?>
function chechCaptcha(){
	//alert(1); 
	var checkcaptcha = $('#checkcaptcha').val();
	var captcha = $('#captchaen').val();
	if(captcha != checkcaptcha){
		alert("Captcha Mismatch. Please Enter Correct Captcha");
		$("#captchaen").css("border","1px solid red");
		$("#captchaen").attr("placeholder","Captcha Mismatch"); 
		$("#captchaen").val("");
		return false;
	}
	else
	{
		var attch=$("#upload-1").val();
		if(attch !='')
		{
			return true;
		}
		else
		{
			alert("Please upload file.");
			return false;
		}
	}
}
</script>
</body>
</html>