<?php
$jsonObj=@json_decode($jsonObj);
$journalInfo=@$jsonObj->journalInfo;
$adminUrl=@$jsonObj->adminUrl;
$chiefEditor=@$jsonObj->chiefEditor;
$editorBoard=@$jsonObj->editorBoard;
$associate=@$jsonObj->associate;
$ads=@$jsonObj->ads;
$categories=@$jsonObj->categories;
?>
		<!-- Section -->
		<section class="page-body">
			<div class="row">
				<div class="col-sm-12">
					<div class="page-title">
						<h2>Submit Your Article</h2>
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-sm-5 hidden-xs">
					<div class="sub-process">
						<h3>Article Strength</h3>
						<div class="progress">
							<div class="progress-bar" role="progressbar" aria-valuenow="70"aria-valuemin="0" aria-valuemax="100" style="width:0%">
								<span class="sr-only">0% Complete</span>
							</div>
						</div>
						<div class="space_3"></div>
						<ul>
							<li id="step_1"><i class="fa fa-minus-square"></i> &nbsp; Article Title</li>
							<li id="step_2"><i class="fa fa-minus-square"></i> &nbsp;First Author</li>
							<li id="step_3"><i class="fa fa-minus-square"></i> &nbsp;Your Abstract</li>
							<li id="step_4"><i class="fa fa-minus-square"></i> &nbsp;Upload Document</li>
						</ul>
					</div>
				</div>
				<div class="col-sm-7 col-xs-12">
					<div class="row">
					<?php
					if(@$this->session->userdata("err_abstract") != '')
					{
					?>
					  <div class="alert alert-danger" style="width: 75%;font-size: 16px;">
						<?php echo @$this->session->userdata("err_abstract");?>
					  </div>
					<?php
					  @$this->session->set_userdata(array("err_abstract" => ''));
					}
					
					if(@$this->session->userdata("success_abstract") != '')
					{
					?>
					  <div class="alert alert-success" style="width: 75%;;font-size: 16px;    ">
						<?php echo @$this->session->userdata("success_abstract");?>
					  </div>
					<?php
					  @$this->session->unset_userdata("success_abstract");
					}
					?>
						<h3 class="adart">Add A New Article</h3>
						<form class="form-horizontal sub-form" method="POST" action="<?php echo base_url(); ?>index.php/home/savesubmission" enctype="multipart/form-data" onSubmit="return chechCaptcha()">
							<div class="col-sm-12 col-xs-12">
								<div class="form-group">
									<select class="form-control" name="articleType" id="articleType" required>
										<option value="">Select Article Type</option>
										<?php
										if(@sizeOf($categories) > 0)
										{
											for($a=0;$a<@sizeOf($categories);$a++)
											{
										?>
										<option value="<?php echo @$categories[$a]->category_name;?>"><?php echo @$categories[$a]->category_name;?></option>
										<?php
											}
										}
										?>
									</select>
								</div>
							</div>
							
							<div class="col-sm-12 col-xs-12">
								<div class="form-group">
									<input type="text" class="form-control artstrnth" name="article_title" id="article_title" placeholder="Title Of Article">
								</div>
							</div>
							
							<div class="col-sm-5 col-xs-12">
								<div class="form-group">
									<input type="text" class="form-control artstrnth" name="authorname1" id="authorname1" placeholder="Name" required />
								</div>
							</div>
							
							<div class="col-sm-5 col-xs-10">
								<div class="form-group w-auto">
									<input type="email" class="form-control artstrnth" name="authoremail1" id="authoremail1" placeholder="Email" required />
								</div>
							</div>
							
							<input type="hidden" name="authrorsCnt" id="authrorsCnt" value="1">
							
							<div class="col-sm-1 col-xs-1">
								<div class="form-group">
									<i class="fa fa-plus addmore"></i>
								</div>
							</div>
							
							<div id="moreAuthors"></div>
							
							<div class="col-sm-12 col-xs-12">
								<div class="form-group">
									<input type="text" class="form-control" name="orcidid" id="orcidid" placeholder="ORCID (If Any)">
								</div>
							</div>
							
							<div class="col-sm-12 col-xs-12">
								<div class="form-group">
									<textarea rows="8" class="form-control artstrnth" name="abstract_content" id="abstract_content" placeholder="Enter Your Abstarct" required style="height:auto;"></textarea>
								</div>
							</div>
							
							<div class="col-sm-12 col-xs-12">
								<div class="form-group input-group">
									<input type="text" class="form-control" id="uploadFile" disabled="disabled" placeholder="Choose File" >
									<div class="input-group-addon bordernone">
										<div class="file-upload">
										  <label for="upload-1" class="btn1">Browse File</label>
										  <input class="artstrnth" type="file" id="upload-1" onChange="getFilename(this.value)" name="userdocs" />
										</div>
									</div>
							  </div>
							</div>
							
							<div class="col-sm-8 col-xs-12">
								<div class="form-group">
									<input type="text" class="form-control" name="captcha" id="captchaen" placeholder="Enter Captcha">
								</div>
							</div>
							
							<div class="col-sm-4 col-xs-12">
								<div class="form-group">
									<span id="captcha" class="caert"><?php echo @$jsonObj->captcha;?></span>
									<input type="hidden" name="checkcaptcha" id="checkcaptcha" value="<?php echo @$jsonObj->captcha;?>" />
								</div>
							</div>

							<div class="col-sm-6 col-xs-12">
								<div class="form-group">
									<button type="submit" class="btn btn-danger btn-res">SUBMIT</button>
								</div>
							</div>
						</form>
					</div>
				</div>
			</div>
		</section>
<script>
$(document).ready(function() {
    var max_fields      = 100; //maximum input boxes allowed
    var wrapper         = $("#moreAuthors"); //Fields wrapper
    var add_button      = $(".addmore"); //Add button ID
    var x = 1; //initlal text box count
    $(add_button).click(function(e){ //on add input button click
        e.preventDefault();
		var rowCnt=$("#authrorsCnt").val();
		var newCnt=parseInt(rowCnt)+1;
		$("#authrorsCnt").val(newCnt);
        if(x < max_fields){ //max input box allowed
            x++; //text box increment
            $(wrapper).append('<div id="row_'+newCnt+'"><div class="col-sm-5 col-xs-12"><div class="form-group"><input type="text" class="form-control" name="authorname'+newCnt+'" id="authorname'+newCnt+'" placeholder="Name" required /></div></div><div class="col-sm-5 col-xs-10"><div class="form-group w-auto"><input type="email" class="form-control" name="authoremail'+newCnt+'" id="authoremail'+newCnt+'" placeholder="Email" required /></div></div><div class="col-sm-1 col-xs-1"><i class="fa fa-trash removefield" id="remove_'+newCnt+'"></i></div></div>'); //add input box
        }
    });

    $(wrapper).on("click",".removefield", function(e){ //user click on remove text
        e.preventDefault(); 
		var clickId=$(this).attr("id");
		if(clickId !='')
		{
			var spt=clickId.split("_");
			var rowId=spt[1];
			$("#row_"+rowId).remove();
		}
    })
});
function getFilename(oVal){
	 var path = oVal;
 var filename = path.replace(/^.*\\/, "");
 	$("#uploadFile").val(filename);
	 var artTitle=$("#article_title").val();
	 var authorName=$("#authorname1").val();
	 var authorEmail=$("#authoremail1").val();
	 var artContent=$("#abstract_content").val();
	 var artFile=$("#upload-1").val();
	 var percentage=0;
	 if(artTitle !='')
	 {
		 var percentage=parseInt(25)+percentage;
		 $("#step_1").html('');
		 $("#step_1").html('<i class="fa fa-check"></i> &nbsp; Article Title');
	 }
	 else{
		 $("#step_1").html('<i class="fa fa-minus-square"></i> &nbsp; Article Title');
	 }
	 if(authorName !='' && authorEmail !='')
	 {
		 var percentage=parseInt(25)+percentage;
		 $("#step_2").html('');
		 $("#step_2").html('<i class="fa fa-check"></i> &nbsp;First Author');
	 }
	 else{
		 $("#step_2").html('<i class="fa fa-minus-square"></i> &nbsp;First Author');
	 }
	 if(artContent)
	 {
		 var percentage=parseInt(25)+percentage;
		 $("#step_3").html('');
		 $("#step_3").html('<i class="fa fa-check"></i> &nbsp;Your Abstract');
	 }
	 else{
		 $("#step_3").html('<i class="fa fa-minus-square"></i> &nbsp;Your Abstract');
	 }
	 if(artFile)
	 {
		 var percentage=parseInt(25)+percentage;
		 $("#step_4").html('');
		 $("#step_4").html('<i class="fa fa-check"></i> &nbsp;Upload Document');
	 }
	 else{
		 $("#step_4").html('<i class="fa fa-minus-square"></i> &nbsp;Upload Document');
	 }
	 $(".progress-bar").css("width",percentage+"%");
	 $(".sr-only").html("");
	 $(".sr-only").html(percentage+"% Complete");
}
$(".artstrnth").blur(function(e){
	 e.preventDefault(); 
	 var artTitle=$("#article_title").val();
	 var authorName=$("#authorname1").val();
	 var authorEmail=$("#authoremail1").val();
	 var artContent=$("#abstract_content").val();
	 var artFile=$("#upload-1").val();
	 var percentage=0;
	 if(artTitle !='')
	 {
		 var percentage=parseInt(25)+percentage;
		 $("#step_1").html('');
		 $("#step_1").html('<i class="fa fa-check"></i> &nbsp; Article Title');
	 }
	 else{
		 $("#step_1").html('<i class="fa fa-minus-square"></i> &nbsp; Article Title');
	 }
	 if(authorName !='' && authorEmail !='')
	 {
		 var percentage=parseInt(25)+percentage;
		 $("#step_2").html('');
		 $("#step_2").html('<i class="fa fa-check"></i> &nbsp;First Author');
	 }
	 else{
		 $("#step_2").html('<i class="fa fa-minus-square"></i> &nbsp;First Author');
	 }
	 if(artContent)
	 {
		 var percentage=parseInt(25)+percentage;
		 $("#step_3").html('');
		 $("#step_3").html('<i class="fa fa-check"></i> &nbsp;Your Abstract');
	 }
	 else{
		 $("#step_3").html('<i class="fa fa-minus-square"></i> &nbsp;Your Abstract');
	 }
	 if(artFile)
	 {
		 var percentage=parseInt(25)+percentage;
		 $("#step_4").html('');
		 $("#step_4").html('<i class="fa fa-check"></i> &nbsp;Upload Document');
	 }
	 else{
		 $("#step_4").html('<i class="fa fa-minus-square"></i> &nbsp;Upload Document');
	 }
	 $(".progress-bar").css("width",percentage+"%");
	 $(".sr-only").html("");
	 $(".sr-only").html(percentage+"% Complete");
});
</script>