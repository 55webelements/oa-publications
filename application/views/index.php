<?php
$jsonObj=@json_decode($jsonObj);
$journalInfo=@$jsonObj->journalInfo;
$adminUrl=@$jsonObj->adminUrl;
$aboutus=@$jsonObj->aboutus;
$articles=@$jsonObj->articles;
$ads=@$jsonObj->ads;
?>
		<!-- Banner -->
		<section id="banner">
			<div class="jour-content">
				<img src="<?php echo @$adminUrl[0]->admin_url;?>uploads/banners/<?php echo @$journalInfo[0]->book_img;?>" alt="book-image" />
				<h1><?php echo @$journalInfo[0]->title;?></h1>
				<?php echo @$journalInfo[0]->description;?>
			</div>
		</section>

		<!-- Section -->
		<section>
			<div class="row">
				<div class="col-sm-9">
					<?php
					if(@sizeOf($aboutus) > 0)
					{
						for($a=0;$a<@sizeOf($aboutus);$a++)
						{
							if($a == 1)
							{
					?>
					<div id="scroll-to"></div>
					<?php
							}
					?>
					<header class="major">
						<h2><?php echo @$aboutus[$a]->title;?></h2>
					</header>
					<div class="features">
						<article>
							<div class="content">
								<?php echo @$aboutus[$a]->description;?>
							</div>
						</article>
					</div>
					<?php
						}
					}
					?>
					<hr class="divider">
					<!-- Section -->
					<?php
					if(@sizeOf($articles) > 0)
					{
					?>
					<header class="major">
						<h2>Recently Published Articles</h2>
					</header>
					<?php
					for($a=0;$a<@sizeOf($articles);$a++)
					{
					?>
					<div class="row">
						<div class="col-sm-3">
							<div class="rcat-img">
								<img class="img-responsive" src="<?php echo @$adminUrl[0]->admin_url;?>uploads/articles/<?php echo @$articles[$a]->article_img;?>" alt="article-image" />
							</div>
						</div>
						<div class="col-sm-9">
							<div class="rcat-content">
								<h5><?php echo @$articles[$a]->artshortTitle;?>&nbsp;|&nbsp;<?php echo @date("d F Y",strtotime($articles[$a]->publishedDate));?></h5>
								<h3>
									<a target="_blank" href="<?php echo base_url();?>index.php/home/articleDetails/<?php echo @$articles[$a]->alias_title;?>"><?php echo @$articles[$a]->artTitle;?></a>
								</h3>
								<?php
								$authours=@$articles[$a]->authours;
								if(@sizeOf($authours) > 0)
								{
								?>
								<h5>
									<?php
									for($at=0;$at<@sizeOf($authours);$at++)
									{
										echo @$authours[$at]->autorname;
										if($at+1 == @sizeOf($authours) - 1){
										   echo ", ";
										}
									}
									?>
								</h5>
								<?php
								}
								if(@$articles[$a]->doi !='')
								{
								?>	
								<h5><b>DOI:</b> <?php echo @$articles[$a]->doi;?></h5>
								<?php
								}
								?>								
							</div>
						</div>
					</div>
					<hr class="divider-light">
					<?php
						}
					}
					?>				
				</div>
				<div class="col-sm-3">
					<?php
					if(@sizeOf($ads) > 0)
					{
						for($ad=0;$ad<@sizeOf($ads);$ad++)
						{
					?>
					<div class="row hidden-xs">
						<div class="col-sm-12">
							<a target="_blank" href="<?php echo @$ads[$ad]->url;?>">
								<img class="img-responsive prm-img" src="<?php echo @$adminUrl[0]->admin_url;?>uploads/promotions/<?php echo @$ads[$ad]->promotion_img;?>" alt="article-image" />
							</a>
						</div>
					</div>
					<div class="space_2"></div>
					<?php
						}
					}
					?>
				</div>
			</div>
		</section>