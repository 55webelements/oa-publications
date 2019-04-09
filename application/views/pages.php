<?php
$jsonObj=@json_decode($jsonObj);
$journalInfo=@$jsonObj->journalInfo;
$adminUrl=@$jsonObj->adminUrl;
$content=@$jsonObj->content;
$ads=@$jsonObj->ads;
?>
		<!-- Section -->
		<section class="page-body">
			<div class="row">
				<div class="col-sm-9">
					<div class="page-title">
						<h2><?php echo @ucwords($content[0]->description);?></h2>
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-sm-9">
					<?php
					$contentData=@$content[0]->contentData;
					if(@sizeOf($contentData) > 0)
					{
						for ($aa=0; $aa <sizeOf($contentData) ; $aa++) 
						{
					?>
					<div class="row">
						<div class="col-sm-12">
							<?php
							if($aa == 0)
							{
							?>
							<div id="scroll-to"></div>
							<?php
							}
							?>
							<div class="pageinfo-content">
								<h3><?php echo @$contentData[$aa]->title; ?></h3>
								<div class="space_1"></div>
								<?php echo @$contentData[$aa]->description; ?>
							</div>
						</div>
					</div>
					<?php
						}
					}
					?>
				</div>
				<div class="col-sm-3 hidden-xs">
					<?php
					if(@sizeOf($ads) > 0)
					{
						for($ad=0;$ad<@sizeOf($ads);$ad++)
						{
					?>
					<div class="row">
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