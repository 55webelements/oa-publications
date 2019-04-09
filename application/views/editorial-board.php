<?php
$jsonObj=@json_decode($jsonObj);
$journalInfo=@$jsonObj->journalInfo;
$adminUrl=@$jsonObj->adminUrl;
$chiefEditor=@$jsonObj->chiefEditor;
$editorBoard=@$jsonObj->editorBoard;
$associate=@$jsonObj->associate;
$ads=@$jsonObj->ads;
?>
		<!-- Section -->
		<section class="page-body">
			<div class="row">
				<div class="col-sm-12">
					<div class="page-title">
						<h2>Editorial Board</h2>
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-sm-9">
					<?php
					if(@sizeOf($chiefEditor) > 0)
					{
					?>
					<div class="row">
						<div class="editorial">
							<h3>Editor in Chief</h3>
							<div class="clear"></div>
							<div class="col-sm-12">
								<div class="edit-image">
									<img src="<?php echo @$adminUrl[0]->admin_url;?>uploads/editors/<?php echo @$chiefEditor[0]->editorImage;?>" class="img-responsive" alt=""/>
									<h4><?php echo @$chiefEditor[0]->editorName;?></h4>
									<p><?php echo @$chiefEditor[0]->designation;?></p>
									<p class="editimg"><span class="editdet"><?php echo $chiefEditor[0]->city;?>, <?php echo @$chiefEditor[0]->countryInfo[0]->country_name;?></span></p>
									<!--<p class="editimg"><img src="<?php //echo base_url();?>administrator/includes/uploads/country/<?php //echo @$chiefEditor[0]->image.".png";?>" class="img-responsive cnt-img" alt=""/></p>-->
								</div>
							
								<div class="edit-dets">
									<?php echo @$chiefEditor[0]->description;?>
								</div>
							</div>
						</div>
					</div>
					<div id="scroll-to"></div>
					<hr class="divider-1">
					<?php
					}
					if(@sizeOf($editorBoard) > 0)
					{
					?>		
					<div class="row">
						<div class="editorial">
							<h3>Editorial Board</h3>
							<div class="clear"></div>
							<?php
							for($e=0;$e<@sizeOf($editorBoard);$e++)
							{
							?>
							<div class="col-sm-12">
								<div class="edit-image">
									<img src="<?php echo @$adminUrl[0]->admin_url;?>uploads/editors/<?php echo @$editorBoard[$e]->editorImage;?>" class="img-responsive" alt=""/>
									<h4><?php echo @$editorBoard[$e]->editorName;?></h4>
									<p><?php echo @$editorBoard[$e]->affliation;?></p>
									<p class="editimg"><span class="editdet"><?php echo @$editorBoard[$e]->countryInfo[0]->country_name;?></span></p>
									<!--<p class="editimg"><img src="<?php //echo base_url();?>administrator/includes/uploads/country/<?php //echo @$chiefEditor[0]->image.".png";?>" class="img-responsive cnt-img" alt=""/></p>-->
								</div>
								<div class="edit-dets">
									<?php echo @$editorBoard[$e]->description;?>
								</div>
							</div>
							<div class="col-sm-12">
								<hr class="divider-light">
							</div>
							<?php
							}
							?>
						</div>
					</div>
					<?php
					}
					if(@sizeOf($associate) > 0)
					{
					?>		
					<div class="row">
						<div class="editorial">
							<h3>Associate Editors</h3>
							<div class="clear"></div>
							<?php
							for($a=0;$a<@sizeOf($associate);$a++)
							{
							?>
							<div class="col-sm-12">
								<div class="edit-dets">
									<?php echo @$associate[$a]->description;?>
								</div>
							</div>
							<?php
							}
							?>
						</div>
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