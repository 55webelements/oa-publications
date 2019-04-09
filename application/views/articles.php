<?php
$jsonObj=@json_decode($jsonObj);
$journalInfo=@$jsonObj->journalInfo;
$adminUrl=@$jsonObj->adminUrl;
$totalRecords=@$jsonObj->totalRecords;
$articles=@$jsonObj->articles;
$volumes=@$jsonObj->volumes;
$keywords=@$jsonObj->keywords;
$pagecnt=@$jsonObj->pagecnt;
$volumeInfo=@$jsonObj->volumeInfo;
if($keywords == "0")
{
	$keywords="";
}
$volumeId=@$jsonObj->volumeId;
$ads=@$jsonObj->ads;
?>
<style type="text/css">
.popover-title .close{
	position: relative;
	bottom: 3px;
}
</style>
		<!-- Section -->
		<section class="page-body">
			<div class="row">
				<div class="col-sm-9">
					<div class="page-title">
						<h2>Articles</h2>
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-sm-9">
					<div class="row">
						<div class="col-sm-12">
							<form class="form-horizontal" role="form" method="GET" action="<?php echo base_url();?>index.php/home/articles" enctype="multipart/form-data">
								<div class="row">
									<div class="col-sm-7 col-xs-12">
										<input class="form-control" name="keywords" id="keyword" placeholder="Search By Keyword" value="<?php echo @$keywords;?>" />
									</div>
									<div class="col-sm-5 col-xs-12">
										<select class="form-control vol-search" name="volumeId" id="volumeId">
											<option value="">All Volumes</option>
											<?php
											if(@sizeOf($volumes) > 0)
											{
												for($v=0;$v<@sizeOf($volumes);$v++)
												{
											?>
											<option <?php if(@$volumeId == @$volumes[$v]->id){echo "selected='selected'";}?> value="<?php echo @$volumes[$v]->id;?>"><?php echo @$volumes[$v]->volume_name ." (".@$volumes[$v]->endYear .")";?></option>
											<?php
												}
											}
											?>
										</select>
									</div>
								</div>
								<div class="space_1"></div>
								<div class="row">
									<div class="col-sm-2">
										<button class="btn btn-oap" type="submit">Search</button>
									</div>
								</div>
							</form>	
							<?php
							if(@$keywords !='')
							{
							?>
							<h4><?php echo @sizeOf($totalRecords);?> result(s) for '<?php echo @$keywords;?>'</h4>
							<?php
							}
							elseif(@sizeOf($volumeInfo) > 0){
							?>
							<h4><?php echo @sizeOf($totalRecords);?> result(s) for '<?php echo @$volumeInfo[0]->volume_name ." ". @$volumeInfo[0]->endYear;?>'</h4>
							<?php
							}
							if(@sizeOf($totalRecords) > 10)
							{
							?>
								<h4>Page <?php echo @($pagecnt/10)+1;?> of 
								<?php
								if(@$keywords !='' && @$keywords !=0 || @$volumeId !='' && @$volumeId !=0)
								{
								?>
									<?php echo @round(sizeOf($totalRecords)/10)+1;?></h4>
								<?php
								}
								else
								{
								?>
									<?php echo @round(sizeOf($totalRecords)/10);?></h4>
								<?php
								}
							}
							?>
							<hr class="divider-light">							
						</div>
					</div>
					<div class="row">
						<div id="scroll-to"></div>
						<?php
						if(@sizeOf($articles) > 0)
						{
							for($a=0;$a<@sizeOf($articles);$a++)
							{
						?>
						<div class="col-sm-12">
							<div class="arti-info">
								<h5><?php echo @$articles[$a]->artshortTitle;?></h5>
								<h4>
									<a target="_blank" href="<?php echo base_url();?>index.php/home/articleDetails/<?php echo @$articles[$a]->alias_title;?>">
										<?php echo @$articles[$a]->artTitle;?>
									</a>
								</h4>
								<div class="row">
									<div class="col-sm-12">
										<?php
										$authours=@$articles[$a]->authours;
										if(@sizeOf($authours) > 0)
										{
										?>
										<ul class="auth-list">
											<?php 
											if(@sizeOf($authours) > 0)
											{
												for ($q=0; $q < @sizeOf($authours); $q++) 
												{
											?>
												<li>
													<a class="authors" data-toggle="popover" id="author_<?php echo @$authours[$q]->id;?>">
														<?php echo @$authours[$q]->autorname; ?>
														<?php
														if(@$authours[$q]->autoremail != '')
														{
														?>
														<i class="fa fa-envelope-o"></i>
														<?php
														}
														if(@$authours[$q]->autorocd != '')
														{
														?>
														<img src="<?php echo base_url();?>includes/img/orcid.png" class="img-reponsive orcid-icon"/>
														<?php
														}
														?>
														</a>
													<?php if(@sizeOf($authours) > $q+1	){echo ',';}?>&nbsp;
													<div class="auth-info" id="aff_<?php echo @$authours[$q]->id;?>">
														<?php echo @$authours[$q]->affliation; ?>
													</div>
													<?php
														if(@$authours[$q]->autoremail != ''){
													?>
													<div class="auth-info" id="mail_<?php echo @$authours[$q]->id;?>">
														<a target="_blank" href="mailto:<?php echo @$authours[$q]->autoremail; ?>" class="EmailAuthor" title="Email author">
														  <span class="u-srOnly">Email author
														  </span>
														</a>
													</div>
													<?php
													}
													?>
													<div class="auth-info" id="orcid_<?php echo @$authours[$q]->id;?>">
														<?php
														if(@$authours[$q]->autorocd != '')
														{
														?>
														<a href="<?php echo @$authours[$q]->autorocd;?>" target="_blank" class="EmailAuthor" title="Orcid author">
															<span class="u-srOnly">ORCID</span>
														</a>
														<?php
														}
														?>
													</div>
												</li>
											<?php 
												}
											} 
											?>
											</ul>
										<?php
										}
										?>
									</div>
								</div>
								<h5><?php echo @$articles[$a]->bmc;?> &nbsp;<b>|</b>&nbsp;  <b>Published on:</b> <?php echo @date("d F Y",strtotime(@$articles[$a]->publishedDate));?></h5>

								<?php
								if(@$articles[$a]->pdf !='')
								{
								?>
								<h5>
									<a target="_blank" href="<?php echo base_url();?>index.php/home/articleDetails/<?php echo @$articles[$a]->alias_title;?>">Full Text</a>
									&nbsp;<b>|</b>&nbsp;
									<a target="_blank" href="<?php echo @$adminUrl[0]->admin_url;?>uploads/articles/<?php echo @$articles[$a]->pdf;?>">PDF</a>
								</h5>
								<?php
								}
								?>	
								<hr class="divider-light">	
							</div>
						</div>
						<?php
							}
						}
						else{
							echo "No Articles Found...";
						}
						?>
					</div>
					<?php
					if($pagination !='')
					{
					?>
					<div class="pagination">
						<?php echo $pagination;?>
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
				<div class="bs-example">
					<button type="button" class="btn btn-primary" data-toggle="popover">Click Me</button>
				</div>
			</div>
		</section>
<script src="https://code.jquery.com/jquery-1.11.2.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>

<script type="text/javascript">	
$('[data-toggle="popover"]').popover({
	placement : 'top',
	html : true,
	title : function () {
		var clickId=$(this).attr("id");
		var sptId=clickId.split("_");
		var authorId=sptId[1];
		var author=$(this).html();
		return author+' <a href="#" class="close" data-dismiss="alert">&times;</a>';
	},
	content : function () {
		var clickId=$(this).attr("id");
		var sptId=clickId.split("_");
		var authorId=sptId[1];
		var content=$("#aff_"+authorId).html();
		var mail=$("#mail_"+authorId).html();
		if(mail == undefined)
		{
			var mail='';
		}
		var orcid=$("#orcid_"+authorId).html();
		if(orcid == undefined)
		{
			var orcid='';
		}
		return '<div class="media-body"><p>'+content+'</p><h5>'+mail+'&nbsp;'+orcid+'</h5></div>';
	}
});
$(document).on("click", ".popover .close" , function(){
	$(this).parents(".popover").popover('hide');
});

</script>