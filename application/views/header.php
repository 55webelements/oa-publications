<?php
$jsonObj=@json_decode($jsonObj);
$meta=@$jsonObj->meta;
$title=@$jsonObj->title;
$journalInfo=@$jsonObj->journalInfo;
$sociallinks=@$jsonObj->sociallinks;
?>
<!DOCTYPE HTML>
<html>
	<head>
		<?php
		if(@sizeOf(@$meta) > 0)
		{
		?>
		<title><?php echo @$meta[0]->metaTitle?></title>
		<meta name="description" content="<?php echo @$meta[0]->metaDesc?>">
		<meta name="keywords" content="<?php echo @$meta[0]->metaKeyWords?>">
		<?php
		}
		else
		{
		?>
		<title>OA Publications</title>
		<?php
		}
		?>
		<meta charset="utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no" />
		<?php
		if(@$menu == "artDetAct")
		{
	
		if(@sizeOf($jsonObj->aritleAuthors) > 0)
		{
			for ($q=0; $q < @sizeOf($jsonObj->aritleAuthors); $q++) 
			{
		?>
		<meta name="citation_author" content="<?php echo @$jsonObj->aritleAuthors[$q]->autorname; ?>, <?php echo @$jsonObj->aritleAuthors[$q]->affliation; ?>">
		<?php
			}
		}
		?>
		<meta name="citation_publication_date" content="<?php echo @date("Y/m/d",strtotime(@$jsonObj->articleInfo[0]->publishedDate));?>">
		<meta name="citation_journal_title" content="<?php echo @$title[0]->journalTitle;?>">
		<meta name="citation_volume" content="<?php echo @$jsonObj->volumeInfo[0]->volume_name;?>">
		<?php
		if(@$jsonObj->articleInfo[0]->pdf !='')
		{
		?>
		<meta name="citation_pdf_url" content="<?php echo @$jsonObj->adminUrl[0]->admin_url;?>uploads/articles/<?php echo @$jsonObj->articleInfo[0]->pdf;?>">
		<?php
		}
		}
		?>
		<link rel="stylesheet" href="<?php echo base_url();?>includes/css/main.css" />
		<link rel="stylesheet" href="<?php echo base_url();?>includes/css/font-awesome.min.css" />
		<link rel="stylesheet" href="<?php echo base_url(); ?>includes/css/jquery.loopmovement.css">
		<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css" />
		
		<script src="<?php echo base_url();?>includes/js/jquery.min.js"></script>
	</head>
	<body class="is-preload">
	<!-- Wrapper -->
		<div id="wrapper">
			<!-- Main -->
				<div id="main">
					<div class="inner">
						<!-- Header -->
						<div class="row">
							<div class="col-sm-12 menu-bg">
								<div class="s-menu">
									<ul>
										<li>
											<a href="http://hostgenie.in/phpdev/oap-main/index.php/home/journals">
												Explore Journals
											</a>
										</li>
										<li>
											<a href="http://hostgenie.in/phpdev/oap-main/index.php/home/aboutus">
												About OAP
											</a>
										</li>
										<li>
											Follow Us:
										</li>
										<?php
										if(@$sociallinks[0]->twitter_link !='')
										{
										?>
										<li class="slicns"><a href="<?php echo @$sociallinks[0]->twitter_link;?>" class="icon fa-twitter" target="_blank"><span class="label">Twitter</span></a></li>
										<?php
										}
										if(@$sociallinks[0]->facebook_link !='')
										{
										?>
										<li class="slicns"><a href="<?php echo @$sociallinks[0]->facebook_link;?>" class="icon fa-facebook" target="_blank"><span class="label">Facebook</span></a></li>
										<?php
										}
										if(@$sociallinks[0]->reddit_link !='')
										{
										?>
										<li class="slicns"><a href="<?php echo @$sociallinks[0]->reddit_link;?>" class="icon fa-reddit" target="_blank"><span class="label">Reddit</span></a></li>
										<?php
										}
										?>
									</ul>
								</div>
							</div>
						</div>
						<header id="header">
							<div class="row">
								<div class="col-sm-9">
									<h1><strong><?php echo @$title[0]->journalTitle;?></strong></h1>
								</div>
								<div class="col-sm-3">
									<?php
									if(@$journalInfo[0]->issn_number !='')
									{
									?>
									<ul class="icons">
										<li>
											ISSN:
										</li>
										<li>
											<?php echo @$journalInfo[0]->issn_number?>
										</li>
									</ul>
									<?php
									}
									?>
								</div>
							</div>
							
							
						</header>