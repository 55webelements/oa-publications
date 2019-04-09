<?php
$jsonObj=@json_decode($jsonObj);
$journalInfo=@$jsonObj->journalInfo;
$adminUrl=@$jsonObj->adminUrl;
$articleInfo=@$jsonObj->articleInfo;
$peerContent=@$jsonObj->peerContent;
$aritleAuthors=@$jsonObj->aritleAuthors;
$aritleContent=@$jsonObj->aritleContent;
$ads=@$jsonObj->ads;
$current_url = "http://".$_SERVER["SERVER_NAME"].$_SERVER["REQUEST_URI"];
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
					<div class="row">
						<div class="col-sm-12">
							<div class="arti-info">
								<h5><?php echo @$articleInfo[0]->artshortTitle;?></h5>
								<h1><?php echo @$articleInfo[0]->artTitle;?></h1>
								<?php
								if(@sizeOf($aritleAuthors) > 0)
								{
								?>
								<div class="row">
									<div class="col-sm-12">
										<ul class="auth-list">
											<?php 
											if(@sizeOf($aritleAuthors) > 0)
											{
												for ($q=0; $q < @sizeOf($aritleAuthors); $q++) 
												{
											?>
												<li>
													<a class="authors" data-toggle="popover" id="author_<?php echo @$aritleAuthors[$q]->id;?>">
														<?php echo @$aritleAuthors[$q]->autorname; ?>
														<?php
														if(@$aritleAuthors[$q]->autoremail != '')
														{
														?>
														<i class="fa fa-envelope-o"></i>
														<?php
														}
														if(@$aritleAuthors[$q]->autorocd != '')
														{
														?>
														<img src="<?php echo base_url();?>includes/img/orcid.png" class="img-reponsive orcid-icon"/>
														<?php
														}
														?>
													</a>
													<?php if(@sizeOf($aritleAuthors) > $q+1	){echo ',';}?>&nbsp;
													<div class="auth-info" id="aff_<?php echo @$aritleAuthors[$q]->id;?>">
														<?php echo @$aritleAuthors[$q]->affliation; ?>
													</div>
													<?php
														if(@$aritleAuthors[$q]->autoremail != ''){
													?>
													<div class="auth-info" id="mail_<?php echo @$aritleAuthors[$q]->id;?>">
														<a target="_blank" href="mailto:<?php echo @$aritleAuthors[$q]->autoremail; ?>" class="EmailAuthor" title="Email author">
														  <span class="u-srOnly">Email author
														  </span>
														</a>
													</div>
													<?php
													}
													?>
													<div class="auth-info" id="orcid_<?php echo @$aritleAuthors[$q]->id;?>">
														<?php
														if(@$aritleAuthors[$q]->autorocd != '')
														{
														?>
														<a href="<?php echo @$aritleAuthors[$q]->autorocd;?>" target="_blank" class="EmailAuthor" title="Orcid author">
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
									</div>
								</div>
								
								<?php
								}
								?>
								<h5><?php echo @$articleInfo[0]->bmc;?></h5>
								<h5><?php echo @$articleInfo[0]->copyRights;?> &nbsp;<b>|</b>&nbsp; <b>DOI:</b> <?php echo @$articleInfo[0]->doi;?> </h5>
								
								<h5>
									<b>Received on:</b> <?php echo @date("d F Y",strtotime(@$articleInfo[0]->receviedDate));?> &nbsp;<b>|</b>&nbsp;
									<b>Accepted on:</b> <?php echo @date("d F Y",strtotime(@$articleInfo[0]->acceptedDate));?> &nbsp;<b>|</b>&nbsp;
									<b>Published on:</b> <?php echo @date("d F Y",strtotime(@$articleInfo[0]->publishedDate));?>
								</h5>
							</div>
						</div>
					</div>
					<div class="space_1"></div>
					<div class="row">
						<div class="col-sm-12">
							<div class="peer-ropr">
								<h4>Open Peer Review Reports</h4>
							</div>
						</div>
					</div>
					<div class="space_1"></div>
					<div class="row">
						<div class="col-sm-12" id="togPeer" style="display:none;">
							<div class="arttable">
								<h4></h4>
								<div id="page-wrap1">
									<table class="peer">
										<?php
										if(@sizeOf($peerContent) > 0)
										{
											for ($p=0; $p <@sizeOf($peerContent) ; $p++) 
											{
												$tableInfo=$peerContent[$p]->tableInfo;
										?>
										<tbody class="bordclr">
											<tr>
												<th colspan="3"><?php echo @$peerContent[$p]->tableTitle;?></th>
											</tr>
											<?php
											if(@sizeOf($tableInfo) > 0)
											{
												for ($r=0; $r <@sizeOf($tableInfo) ; $r++) 
												{
											?>
											<tr class="arclr">
												<td><?php echo @date("dS M Y",strtotime($tableInfo[$r]->commentDate)) ?></td>
												<td class="bordno"><?php echo @$tableInfo[$r]->title ?></td>
												<?php 
												if(@$tableInfo[$r]->comment1pdf != '')
												{ 
												?>
												<td class="bordno">
													<a href="<?php echo @$adminUrl[0]->admin_url;?>uploads/peer/<?php echo @$tableInfo[$r]->comment1pdf; ?>" download>
													<?php echo @$tableInfo[$r]->comment1;?></a>
												</td>
												<?php
												}
												else{
												?>
												<td class="bordno"><?php echo @$tableInfo[$r]->comment1 ?></td>
												<?php
												}
												?>
											</tr>
											<?php
												}
											}
											?>
										</tbody>
										<?php
											}
										}
										?>
									</table>
								</div>
							</div>
							<div class="space_1"></div>
						</div>
					</div>
					<?php
					if(@sizeOf($aritleContent) > 0)
					{
						for ($aa=0; $aa <sizeOf($aritleContent) ; $aa++) 
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
							<div class="articleinfo-content" id="article_<?php echo @$aritleContent[$aa]->id; ?>">
								<h4><?php echo @$aritleContent[$aa]->title; ?></h4>
								<div class="space_1"></div>
								<?php echo @$aritleContent[$aa]->description; ?>
							</div>
						</div>
					</div>
					<?php
						}
					}
					?>
				</div>
				<div class="col-sm-3">
					<div class="row prm-img">
						<?php
						if(@$articleInfo[0]->pdf !='')
						{
						?>
						<div class="col-sm-12">
							<a class="btn btn-oap" href="<?php echo @$adminUrl[0]->admin_url;?>uploads/articles/<?php echo @$articleInfo[0]->pdf;?>" download>DOWNLOAD PDF</a>
						</div>
						<div class="col-sm-12">
							<hr class="divider-light">
						</div>
						<?php
						}
						?>
						<div class="col-sm-12 hidden-xs">
							<ul class="tableabs">
								<h5 class="tablec"><img src="<?php echo base_url();?>includes/img/meterial.png" class="img-responsive" alt=""/>Table of Content</h5>
								<?php
								if(@sizeOf($aritleContent) > 0)
								{
									for ($i=0; $i <@sizeOf($aritleContent) ; $i++) 
									{
								?>
								<li><a href="#0" id="<?php echo @$aritleContent[$i]->id; ?>" class="dessy"><?php echo @$aritleContent[$i]->title; ?></a></li>
								<?php
									}
								}
								?>
							</ul>
						</div>
						<div class="col-sm-12">
							<hr class="divider-light">
						</div>
						<div class="col-sm-12">
							<h5>Metrics</h5>
							<p>Article accesses: <?php echo @$articleInfo[0]->viewsCnt;?></p>
						</div>
						<div class="col-sm-12">
							<hr class="divider-light">
						</div>
						<div class="col-sm-12">
							<h5>Share This Article</h5>
							<ul class="shr-art">
								<a href="https://www.facebook.com/sharer/sharer.php?u=<?php echo $current_url; ?>" target="_blank">
									<li>
										<i class="fa fa-facebook"></i>
									</li>
								</a>
								<a href="http://twitter.com/share?text=An%20Awesome%20Link&url=<?php echo $current_url; ?>" target="_blank">
									<li href="">
										<i class="fa fa-twitter"></i>
									</li>
								</a>
								<a href="http://www.reddit.com/submit?url=<?php echo $current_url; ?>" target="_blank">
									<li href="">
										<i class="fa fa-reddit"></i>
									</li>
								</a>
							</ul>
						</div>
					</div>
				</div>
			</div>
		</section>
<div class="FulltextWrapper" style="height: 0;">
<?php 
if(@sizeOf($aritleAuthors) > 0)
{
	for ($fuc=0; $fuc < sizeOf($aritleAuthors); $fuc++) 
	{
?>
	<section  class="Section1 RenderAsSection1 Affiliations" id="Aff<?php echo @$fuc; ?>">
	<h2 class="Heading js-ToggleCollapseSection">
	</h2>
		<div class="js-CollapseSection">
		
		  <div class="Affiliation" id="Aff<?php echo @$fuc; ?>">
			
			<div class="AffiliationText"><?php echo $aritleAuthors[$fuc]->affliation; ?>
			</div>
		  </div>
		 

		</div>
	</section>
  
<?php
	}
}
?>
</div>
<script>
$(".peer-ropr").click(function(){$("#togPeer").toggle("slow");});
$(".dessy").click(function() {
	var clikId=$(this).attr("id");
    $('html,body').animate({
        scrollTop: $("#article_"+clikId).offset().top},
        'slow');
});
</script>
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