<?php
$jsonObj=@json_decode($jsonObj);
$journalInfo=@$jsonObj->journalInfo;
$adminUrl=@$jsonObj->adminUrl;
$indexingContent=@$jsonObj->indexingContent;
$ads=@$jsonObj->ads;
?>
		<!-- Section -->
		<section class="page-body">
			<div class="row">
				<div class="col-sm-9">
					<div class="page-title">
						<h2>Indexing</h2>
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-sm-9">
					<?php
					if(@sizeOf($indexingContent) > 0)
					{
					?>
					<div class="row">
						<div id="scroll-to"></div>
						
							<?php
							for($i=0;$i<@sizeOf($indexingContent);$i++)
							{
							?>
							<div class="col-sm-6">
								<div class="mini-posts">
									<article class="ind-art">
										<a target="_blank" href="<?php echo @$indexingContent[$i]->absUrl;?>" class="image"><img src="<?php echo @$adminUrl[0]->admin_url;?>uploads/abstract/<?php echo @$indexingContent[$i]->absImg;?>" alt="indexing-<?php echo @$i;?>" /></a>
										<p><?php echo @$indexingContent[$i]->absTitle;?></p>
									</article>
								</div>
							</div>
							<?php
							}
							?>
							
						
					</div>
					<?php
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