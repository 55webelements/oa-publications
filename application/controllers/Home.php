<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Home extends CI_Controller {
	public function __construct()
	{
		parent::__construct();
		$this->load->model("home_model");
	}
	public function index()
	{
		$hurl=base_url();
		$journalsUrl=$this->home_model->getTableRowDataOrder('55web_z_journals',array("status"=>1,"url"=>@$hurl),"id","ASC");
		$journalsId = $journalsUrl[0]->id;
		/**** HEADER ****/
		$meta = $this->home_model->getTableRowDataOrder('55web_z_metadesc',array("status"=>1,"journalsId"=>$journalsId,"pageType" => 1),"id","ASC");
		$title=$this->home_model->getTableRowDataOrder('55web_z_journals',array("status"=>1,"id"=>$journalsId));
		$journalInfo=$this->home_model->getTableRowDataOrder('55web_z_journal_info',array("status"=>1,"journalsId"=>$journalsId));
		$adminUrl=$this->home_model->getTableRowDataOrder('configurations',array("status"=>1));
		$ads=$this->home_model->getTableRowDataOrder('55web_z_ads',array("status"=>1,"journalsId"=>$journalsId));
		/**** HEADER ****/
		
		/**** PAGE ****/
		$aboutus = $this->home_model->getTableRowDataOrder('55web_z_content',array("status"=>1,"journalsId"=>$journalsId,"parent_id" => 0,"pageType" => 1),"id","ASC");
		$articles = $this->home_model->getTableRowDataOrderByLimit('55web_z_articles',array("status"=>1,"journalId"=>$journalsId),"id","DESC",0,10);
		$artarray=array();
		if(@sizeOf($articles) > 0)
		{
			for($i=0;$i<@sizeOf($articles);$i++)
			{
				$artarray[$i] = array(
					'id'=>$articles[$i]->id,
					'journalId'=>$articles[$i]->journalId,
					'artTitle'=>$articles[$i]->artTitle,
					'alias_title'=>$articles[$i]->alias_title,
					'artshortTitle'=>$articles[$i]->artshortTitle,
					'doi'=>$articles[$i]->doi,
					'publishedDate'=>$articles[$i]->publishedDate,
					'article_img'=>$articles[$i]->article_img,
					'authours'=>$this->home_model->getTableRowDataOrder('55web_z_authosrs',array("status"=>1,"articleid"=>$articles[$i]->id),"id","ASC"),
				);
			}
		}
		/**** PAGE ****/
		
		/**** FOOTER ****/
		$footerContent = $this->home_model->getTableRowDataOrder('55web_z_footer_content',array("status"=>1),"id","ASC");
		
		$guidelines = $this->home_model->getTableRowDataOrder('55web_z_content',array("status"=>1,"journalsId"=>$journalsId,"parent_id" => 0,"pageType" => 5),"id","ASC");
		$indexing = $this->home_model->getTableRowDataOrderByLimit('55web_z_abstract',array("status"=>1,"journalsId"=>$journalsId),"id","ASC",0,2);
		$address = $this->home_model->getTableRowDataOrder('55web_z_address',array("status"=>1,"journalsId"=>$journalsId));
		$sociallinks = $this->home_model->getTableRowDataOrder('55web_social_links',array("status"=>1));
		/**** FOOTER ****/
		
		//echo "<pre>";print_r($artarray);echo "</pre>";die();
		$json = array(
			"journalsId" => @$journalsId,
			"meta" => @$meta,
			"title" => @$title,
			"journalInfo" => @$journalInfo,
			"adminUrl" => @$adminUrl,
			"ads" => @$ads,
			"footerContent" => @$footerContent,
			"quickLinks" => @$quickLinks,
			"guidelines" => @$guidelines,
			"aboutus" => @$aboutus,
			"articles" => @$artarray,
			"indexing" => @$indexing,
			"address" => @$address,			
			"sociallinks" => @$sociallinks,			
			"noJs" => 0,
		);
		$encodeJson = json_encode($json);
		$data["jsonObj"] = $encodeJson;
		$data["menu"] = "homeAct";
		$this->load->view('header',$data);		
		$this->load->view('index',$data);		
		$this->load->view('footer',$data);		
	}
	
	public function editorialBoard()
	{
		$hurl=base_url();
		$journalsUrl=$this->home_model->getTableRowDataOrder('55web_z_journals',array("status"=>1,"url"=>@$hurl),"id","ASC");
		$journalsId = $journalsUrl[0]->id;
		/**** HEADER ****/
		$meta = $this->home_model->getTableRowDataOrder('55web_z_metadesc',array("status"=>1,"journalsId"=>$journalsId,"pageType" => 2),"id","ASC");
		$title=$this->home_model->getTableRowDataOrder('55web_z_journals',array("status"=>1,"id"=>$journalsId));
		$journalInfo=$this->home_model->getTableRowDataOrder('55web_z_journal_info',array("status"=>1,"journalsId"=>$journalsId));
		$adminUrl=$this->home_model->getTableRowDataOrder('configurations',array("status"=>1));
		$ads=$this->home_model->getTableRowDataOrder('55web_z_ads',array("status"=>1,"journalsId"=>$journalsId));
		/**** HEADER ****/

		/**** PAGE ****/
		$chiefArray=$boardArray=array();
		$chief=$this->home_model->getTableRowDataOrder('55web_z_editorcheif',array("status"=>1,"journalsId"=>$journalsId));
		if(@sizeOf($chief) > 0)
		{
			for($c=0;$c<@sizeOf($chief);$c++)
			{
				$chiefArray[$c]=array(
					"id" => @$chief[$c]->id,
					"editorName" => @$chief[$c]->editorName,
					"designation" => @$chief[$c]->designation,
					"city" => @$chief[$c]->city,
					"editorImage" => @$chief[$c]->editorImage,
					"description" => @$chief[$c]->description,
					"countryInfo" => $this->home_model->getTableRowDataOrder('55web_country',array("id"=>@$chief[$c]->countryId)),
				);
			}
		}
		$board=$this->home_model->getTableRowDataOrder('55web_z_editorboard',array("status"=>1,"pageType"=>1,"journalsId"=>$journalsId));
		if(@sizeOf($board) > 0)
		{
			for($b=0;$b<@sizeOf($board);$b++)
			{
				$boardArray[$b]=array(
					"id" => @$board[$b]->id,
					"editorName" => @$board[$b]->editorName,
					"subjectName" => @$board[$b]->subjectName,
					"affliation" => @$board[$b]->affliation,
					"editorImage" => @$board[$b]->editorImage,
					"description" => @$board[$b]->description,
					"countryInfo" => $this->home_model->getTableRowDataOrder('55web_country',array("id"=>@$board[$b]->countryId)),
				);
			}
		}
		$associate=$this->home_model->getTableRowDataOrder('55web_z_editorboard',array("status"=>1,"pageType"=>2,"journalsId"=>$journalsId));
		/**** PAGE ****/
		
		/**** FOOTER ****/
		$footerContent = $this->home_model->getTableRowDataOrder('55web_z_footer_content',array("status"=>1),"id","ASC");
		
		$guidelines = $this->home_model->getTableRowDataOrder('55web_z_content',array("status"=>1,"journalsId"=>$journalsId,"parent_id" => 0,"pageType" => 5),"id","ASC");
		$indexing = $this->home_model->getTableRowDataOrderByLimit('55web_z_abstract',array("status"=>1,"journalsId"=>$journalsId),"id","ASC",0,2);
		$address = $this->home_model->getTableRowDataOrder('55web_z_address',array("status"=>1,"journalsId"=>$journalsId));
		$sociallinks = $this->home_model->getTableRowDataOrder('55web_social_links',array("status"=>1));
		/**** FOOTER ****/
		
		//echo "<pre>";print_r($boardArray);echo "</pre>";die();
		$json = array(
			"journalsId" => @$journalsId,
			"meta" => @$meta,
			"title" => @$title,
			"journalInfo" => @$journalInfo,
			"adminUrl" => @$adminUrl,
			"ads" => @$ads,
			"footerContent" => @$footerContent,
			"quickLinks" => @$quickLinks,
			"guidelines" => @$guidelines,
			"chiefEditor" => @$chiefArray,
			"editorBoard" => @$boardArray,
			"associate" => @$associate,
			"indexing" => @$indexing,
			"address" => @$address,			
			"sociallinks" => @$sociallinks,
			"noJs" => 0,
		);
		$encodeJson = json_encode($json);
		$data["jsonObj"] = $encodeJson;
		$data["menu"] = "homeAct";
		$this->load->view('header',$data);		
		$this->load->view('editorial-board',$data);		
		$this->load->view('footer',$data);		
	}
	
	public function submission()
	{
		$hurl=base_url();
		$journalsUrl=$this->home_model->getTableRowDataOrder('55web_z_journals',array("status"=>1,"url"=>@$hurl),"id","ASC");
		$journalsId = $journalsUrl[0]->id;
		/**** HEADER ****/
		$meta = $this->home_model->getTableRowDataOrder('55web_z_metadesc',array("status"=>1,"journalsId"=>$journalsId,"pageType" => 3),"id","ASC");
		$title=$this->home_model->getTableRowDataOrder('55web_z_journals',array("status"=>1,"id"=>$journalsId));
		$journalInfo=$this->home_model->getTableRowDataOrder('55web_z_journal_info',array("status"=>1,"journalsId"=>$journalsId));
		$adminUrl=$this->home_model->getTableRowDataOrder('configurations',array("status"=>1));
		$ads=$this->home_model->getTableRowDataOrder('55web_z_ads',array("status"=>1,"journalsId"=>$journalsId));
		/**** HEADER ****/

		/**** PAGE ****/
		$categories=$this->home_model->getTableRowDataOrder('55web_categories',array("status"=>1));
		$captcha=@rand("999999","9999999");
		/**** PAGE ****/
		
		/**** FOOTER ****/
		$footerContent = $this->home_model->getTableRowDataOrder('55web_z_footer_content',array("status"=>1),"id","ASC");
		
		$guidelines = $this->home_model->getTableRowDataOrder('55web_z_content',array("status"=>1,"journalsId"=>$journalsId,"parent_id" => 0,"pageType" => 5),"id","ASC");
		$indexing = $this->home_model->getTableRowDataOrderByLimit('55web_z_abstract',array("status"=>1,"journalsId"=>$journalsId),"id","ASC",0,2);
		$address = $this->home_model->getTableRowDataOrder('55web_z_address',array("status"=>1,"journalsId"=>$journalsId));
		$sociallinks = $this->home_model->getTableRowDataOrder('55web_social_links',array("status"=>1));
		/**** FOOTER ****/
		
		//echo "<pre>";print_r($boardArray);echo "</pre>";die();
		$json = array(
			"journalsId" => @$journalsId,
			"meta" => @$meta,
			"title" => @$title,
			"journalInfo" => @$journalInfo,
			"adminUrl" => @$adminUrl,
			"ads" => @$ads,
			"footerContent" => @$footerContent,
			"quickLinks" => @$quickLinks,
			"guidelines" => @$guidelines,
			"categories" => @$categories,
			"captcha" => @$captcha,
			"indexing" => @$indexing,
			"address" => @$address,			
			"sociallinks" => @$sociallinks,
			"noJs" => 1,
		);
		$encodeJson = json_encode($json);
		$data["jsonObj"] = $encodeJson;
		$data["menu"] = "homeAct";
		$this->load->view('header',$data);		
		$this->load->view('submission',$data);		
		$this->load->view('footer',$data);		
	}
	
	public function savesubmission()
	{
		$hurl=base_url();
		$journalsUrl=$this->home_model->getTableRowDataOrder('55web_z_journals',array("status"=>1,"url"=>@$hurl),"id","ASC");
		$journalsId = $journalsUrl[0]->id;
		$articleType=$this->input->post("articleType");
		$article_title=$this->input->post("article_title");
		$authrorsCnt=$this->input->post("authrorsCnt");
		$authArray=array();
		if(@$authrorsCnt > 0)
		{
			for($a=0;$a<@$authrorsCnt;$a++)
			{
				$authorName=$this->input->post("authorname".(@$a+1));
				$authorEmail=$this->input->post("authoremail".(@$a+1));
				if(@$authorName !='')
				{
					$authArray[]=array(
						"name" => @$authorName,
						"email" => @$authorEmail,
					);
				}
			}
		}
		$ab_info="";
		if(@sizeOf($authArray) > 0)
		{
			$ab_info=@json_encode($authArray);
		}
		$orcidid=$this->input->post("orcidid");
		$abstract_content=$this->input->post("abstract_content");
		$bhanu=@$_FILES["userdocs"]["name"];
		if(@$bhanu !='')
		{
			$file=explode(".",$bhanu);
			$abstract_file=time().".".end($file);
			@move_uploaded_file($_FILES["userdocs"]["tmp_name"],"includes/uploads/".$abstract_file);
		}
		else
		{
			$abstract_file="";
		}
		$name=$this->input->post("authorname1");
		$email=$this->input->post("authoremail1");
		$params=array(
			"journalsId" => @$journalsId,
			"article_title" => @$article_title,
			"article_type" => @$articleType,
			"orcid_id" => @$orcidid,
			"abstract_content" => @$abstract_content,
			"abstract_file" => base_url()."includes/uploads/".@$abstract_file,
			"ab_info" => @$ab_info,
			"created_date" => @date("Y-m-d H:i:s"),
		);
		$store=$this->home_model->storeItems("55web_users",$params);
		if(@$store > 0)
		{
			$contact_email=$this->home_model->getTableRowDataOrder('55web_z_address',array("status"=>1,"journalsId"=>@$journalsId),"id","ASC");		
			$to1=$email;
			$from1=$contact_email[0]->email;
			$subject1="Acknowledgement";
			
			$messages1 = 'Thank you for your interest to  OA Publication Journal. <br>Your article has been received and we will update your article status at our earliest. <br>Thank you once again. <br><br>Regards, <br>Journals Manager<br>OA Publication Journals';
			
			$send1=$this->_send($to1,$from1,$subject1,$messages1);
			
			$from=$email;
			$to=$contact_email[0]->email;
			//$to="bhanu@55web.in";
			$subject="User Submission Details";
			
			$messages = '<table  border="1" style="text-align:center;"><tr><td style="padding: 15px;">Author Name:</td><td style="padding: 15px;">'.@$name.'</td></tr><tr><td style="padding: 15px;">Author Email :</td><td style="padding: 15px;">'.@$from.'</td></tr><tr><td style="padding: 15px;">Article:</td><td style="padding: 15px;">'.@$article_title.'</td></tr><tr><td style="padding: 15px;">Type:</td><td style="padding: 15px;">'.@$articleType.'</td></tr><tr><td style="padding: 15px;">Abstract Content:</td><td style="padding: 15px;">'.@$abstract_content.'</td></tr></table>';
			
			$send=$this->_sendsub($to,$from,$subject,$messages,$abstract_file);
			
			$success_abstract=array(
				'success_abstract' => "Successfully Submitted. We Will Contact You Soon."
			);
			$this->session->set_userdata($success_abstract);
		}
		else
		{
			$err_abstract=array(
				'err_abstract' => "Failed to Submit Details.Please try again once."
			);
			$this->session->set_userdata($err_abstract);
		}
		redirect(base_url()."index.php/home/submission");
	}
	
	public function articles($keywords=null,$volumeId=null,$pagecnt = 0)
	{	
		@extract($_REQUEST);
		$end=20;
		$hurl=base_url();
		$journalsUrl=$this->home_model->getTableRowDataOrder('55web_z_journals',array("status"=>1,"url"=>@$hurl),"id","ASC");
		$journalsId = $journalsUrl[0]->id;
		/**** HEADER ****/
		$meta = $this->home_model->getTableRowDataOrder('55web_z_metadesc',array("status"=>1,"journalsId"=>$journalsId,"pageType" => 4),"id","ASC");
		$title=$this->home_model->getTableRowDataOrder('55web_z_journals',array("status"=>1,"id"=>$journalsId));
		$journalInfo=$this->home_model->getTableRowDataOrder('55web_z_journal_info',array("status"=>1,"journalsId"=>$journalsId));
		$adminUrl=$this->home_model->getTableRowDataOrder('configurations',array("status"=>1));
		$ads=$this->home_model->getTableRowDataOrder('55web_z_ads',array("status"=>1,"journalsId"=>$journalsId));
		/**** HEADER ****/

		/**** PAGE ****/
		$this->load->library('pagination');
		if(@$keywords == '')
		{
			$keywords=0;
		}
		else{
			$keywords=@str_replace("%20"," ",$keywords);
		}
		if(@$volumeId == '')
		{
			$volumeId=0;
		}
		$config['base_url'] = base_url().'index.php/home/articles/'.@$keywords."/".@$volumeId;
		$volumes=$this->home_model->getTableRowDataOrder('55web_z_volumes',array("status"=>1,"journalsId"=>$journalsId),"endYear","DESC");
		if(@$keywords !='' || @$volumeId !='' || @$keywords !=0 || @$volumeId !=0)
		{
			if(@$keywords == '')
			{
				$keywords=0;
			}
			if(@$volumeId == '')
			{
				$volumeId=0;
			}
			$totalRecords=$this->home_model->getArtTotalRecords($journalsId,$keywords,$volumeId);
			$articles=$this->home_model->getArtTotalRecords($journalsId,$keywords,$volumeId,$pagecnt,$end);
		}
		else
		{
			$totalRecords=$this->home_model->getTableRowDataOrder('55web_z_articles',array("status"=>1,"journalId"=>$journalsId),"id","DESC");
			$articles=$this->home_model->getTableRowDataOrderByLimit('55web_z_articles',array("status"=>1,"journalId"=>$journalsId),"id","DESC",$pagecnt,$end);
		}
		$artarray=array();
		if(@sizeOf($articles) > 0)
		{
			for($i=0;$i<@sizeOf($articles);$i++)
			{
				$artarray[$i] = array(
					'id'=>$articles[$i]->id,
					'journalId'=>$articles[$i]->journalId,
					'artTitle'=>$articles[$i]->artTitle,
					'alias_title'=>$articles[$i]->alias_title,
					'artshortTitle'=>$articles[$i]->artshortTitle,
					'doi'=>$articles[$i]->doi,
					'copyRights'=>$articles[$i]->copyRights,
					'bmc'=>$articles[$i]->bmc,
					'receviedDate'=>$articles[$i]->receviedDate,
					'acceptedDate'=>$articles[$i]->acceptedDate,
					'publishedDate'=>$articles[$i]->publishedDate,
					'pdf'=>$articles[$i]->pdf,
					'article_img'=>$articles[$i]->article_img,
					'authours'=>$this->home_model->getTableRowDataOrder('55web_z_authosrs',array("status"=>1,"articleid"=>$articles[$i]->id),"id","ASC"),
				);
			}
		}
		$volumeInfo=array();
		if(@$volumeId !='' && @$volumeId !='0')	
		{
			$volumeInfo=$this->home_model->getTableRowDataOrder("55web_z_volumes",array("id" => @$volumeId));
		}
		
		$config['total_rows'] = @sizeOf($totalRecords);
		$config['per_page'] = $end; 
		//$config['first_tag_open']="<div>";
		//$config['first_tag_close']="</div>";
		$this->pagination->initialize($config);
		$data["pagination"]=$this->pagination->create_links();	
		/**** PAGE ****/
		
		/**** FOOTER ****/
		$footerContent = $this->home_model->getTableRowDataOrder('55web_z_footer_content',array("status"=>1),"id","ASC");
		$guidelines = $this->home_model->getTableRowDataOrder('55web_z_content',array("status"=>1,"journalsId"=>$journalsId,"parent_id" => 0,"pageType" => 5),"id","ASC");
		$indexing = $this->home_model->getTableRowDataOrderByLimit('55web_z_abstract',array("status"=>1,"journalsId"=>$journalsId),"id","ASC",0,2);
		$address = $this->home_model->getTableRowDataOrder('55web_z_address',array("status"=>1,"journalsId"=>$journalsId));
		$sociallinks = $this->home_model->getTableRowDataOrder('55web_social_links',array("status"=>1));
		/**** FOOTER ****/
		
		//echo "<pre>";print_r($articles);echo "</pre>";die();
		$json = array(
			"journalsId" => @$journalsId,
			"meta" => @$meta,
			"title" => @$title,
			"journalInfo" => @$journalInfo,
			"adminUrl" => @$adminUrl,
			"ads" => @$ads,
			"footerContent" => @$footerContent,
			"guidelines" => @$guidelines,
			"volumes" => @$volumes,
			"volumeInfo" => @$volumeInfo,
			"articles" => @$artarray,
			"totalRecords" => @$totalRecords,
			"keywords" => @$keywords,
			"volumeId" => @$volumeId,
			"pagecnt" => @$pagecnt,
			"indexing" => @$indexing,
			"address" => @$address,			
			"sociallinks" => @$sociallinks,
			"noJs" => 0,
		);
		$encodeJson = json_encode($json);
		$data["jsonObj"] = $encodeJson;
		$data["menu"] = "artAct";
		$this->load->view('header',$data);		
		$this->load->view('articles',$data);		
		$this->load->view('footer',$data);		
	}
	
	public function articleDetails($artTitle=null)
	{
		if(@$artTitle !='')
		{
			$hurl=base_url();
			$journalsUrl=$this->home_model->getTableRowDataOrder('55web_z_journals',array("status"=>1,"url"=>@$hurl),"id","ASC");
			$journalsId = $journalsUrl[0]->id;
			/**** HEADER ****/
			$title=$this->home_model->getTableRowDataOrder('55web_z_journals',array("status"=>1,"id"=>$journalsId));
			$journalInfo=$this->home_model->getTableRowDataOrder('55web_z_journal_info',array("status"=>1,"journalsId"=>$journalsId));
			$adminUrl=$this->home_model->getTableRowDataOrder('configurations',array("status"=>1));
			$ads=$this->home_model->getTableRowDataOrder('55web_z_ads',array("status"=>1,"journalsId"=>$journalsId));
			/**** HEADER ****/

			/**** PAGE ****/
			$articleInfo=$this->home_model->getTableRowDataOrder('55web_z_articles',array("status"=>1,"journalId"=>$journalsId,"alias_title" => @$artTitle),"id","ASC");
			$peerContent=$aritleAuthors=$aritleContent=$volumeInfo=array();
			if(@sizeOf($articleInfo) > 0)
			{
				$articleId=@$articleInfo[0]->id;
				$updateCnt=$this->home_model->updateCnt($articleId);
				$tableTitle=$this->home_model->getTableRowDataOrder("55web_z_peertable",array("status"=>1,"journalsId"=>$journalsId,"articleid" => @$articleId));
				if(@sizeOf($tableTitle) > 0)
				{
					for($t=0;$t<@sizeOf($tableTitle);$t++)
					{
						$peerContent[$t]=array(
							'tableTitle'=> $tableTitle[$t]->table_title,
							'tableInfo'=> $this->home_model->getTableRowDataOrder("55web_z_peerpreview",array("status"=>1,"journalId"=>$journalsId,"articleid" => @$articleId,"table_id" => $tableTitle[$t]->id)),
						);
					}
				}
				$aritleAuthors=$this->home_model->getTableRowDataOrder("55web_z_authosrs",array("status"=>1,"journalId"=>$journalsId,"articleid" => @$articleId));
				$aritleContent=$this->home_model->getTableRowDataOrder("55web_z_articlecontent",array("status"=>1,"journalId"=>$journalsId,"articleid" => @$articleId));
				$volumeInfo=$this->home_model->getTableRowDataOrder("55web_z_volumes",array("id" => @$articleInfo[0]->volume_id));
			}
			else
			{
				redirect(base_url()."index.php/home/articles");
			}
			
			/**** PAGE ****/
			
			/**** FOOTER ****/
			$footerContent = $this->home_model->getTableRowDataOrder('55web_z_footer_content',array("status"=>1),"id","ASC");
			
			$guidelines = $this->home_model->getTableRowDataOrder('55web_z_content',array("status"=>1,"journalsId"=>$journalsId,"parent_id" => 0,"pageType" => 5),"id","ASC");
			$indexing = $this->home_model->getTableRowDataOrderByLimit('55web_z_abstract',array("status"=>1,"journalsId"=>$journalsId),"id","ASC",0,2);
			$address = $this->home_model->getTableRowDataOrder('55web_z_address',array("status"=>1,"journalsId"=>$journalsId));
			$sociallinks = $this->home_model->getTableRowDataOrder('55web_social_links',array("status"=>1));
			/**** FOOTER ****/
			
			//echo "<pre>";print_r($boardArray);echo "</pre>";die();
			$json = array(
				"journalsId" => @$journalsId,
				"meta" => @$articleInfo,
				"title" => @$title,
				"journalInfo" => @$journalInfo,
				"adminUrl" => @$adminUrl,
				"ads" => @$ads,
				"footerContent" => @$footerContent,
				"guidelines" => @$guidelines,
				"articleInfo" => @$articleInfo,
				"peerContent" => @$peerContent,
				"aritleAuthors" => @$aritleAuthors,
				"aritleContent" => @$aritleContent,
				"volumeInfo" => @$volumeInfo,
				"indexing" => @$indexing,
				"address" => @$address,			
				"sociallinks" => @$sociallinks,
				"noJs" => 0,
			);
			$encodeJson = json_encode($json);
			$data["jsonObj"] = $encodeJson;
			$data["menu"] = "artDetAct";
			$this->load->view('header',$data);		
			$this->load->view('article-details',$data);		
			$this->load->view('footer',$data);	
		}
		else		
		{
			redirect(base_url()."index.php/home/articles");
		}
	}
	
	public function page($pageName=null)
	{
		if(@$pageName !='')
		{
			$hurl=base_url();
			$journalsUrl=$this->home_model->getTableRowDataOrder('55web_z_journals',array("status"=>1,"url"=>@$hurl),"id","ASC");
			$journalsId = $journalsUrl[0]->id;
			/**** HEADER ****/
			$title=$this->home_model->getTableRowDataOrder('55web_z_journals',array("status"=>1,"id"=>$journalsId));
			$journalInfo=$this->home_model->getTableRowDataOrder('55web_z_journal_info',array("status"=>1,"journalsId"=>$journalsId));
			$adminUrl=$this->home_model->getTableRowDataOrder('configurations',array("status"=>1));
			$ads=$this->home_model->getTableRowDataOrder('55web_z_ads',array("status"=>1,"journalsId"=>$journalsId));
			/**** HEADER ****/

			/**** PAGE ****/
			$content=$this->home_model->getTableRowDataOrder('55web_z_content',array("status"=>1,"journalsId"=>$journalsId,"alias_title" => @$pageName));
			$contArray=$meta=array();
			if(@sizeOf($content) > 0)
			{
				for($c=0;$c<@sizeOf($content);$c++)
				{
					$contArray[$c]=array(
						"id" => @$content[$c]->id,
						"title" => @$content[$c]->title,
						"alias_title" => @$content[$c]->alias_title,
						"description" => @$content[$c]->description,
						"contentData" => $this->home_model->getTableRowDataOrder('55web_z_content',array("status"=>1,"journalsId"=>$journalsId,"parent_id" => @$content[$c]->id)) ,
					);
				}
				$meta[] = array(
					"metaTitle" => @$content[0]->meta_title,
					"metaDesc" => @$content[0]->meta_keywords,
					"metaKeyWords" => @$content[0]->meta_desc,
				);
			}
			/**** PAGE ****/
			
			/**** FOOTER ****/
			$footerContent = $this->home_model->getTableRowDataOrder('55web_z_footer_content',array("status"=>1),"id","ASC");
			
			$guidelines = $this->home_model->getTableRowDataOrder('55web_z_content',array("status"=>1,"journalsId"=>$journalsId,"parent_id" => 0,"pageType" => 5),"id","ASC");
			$indexing = $this->home_model->getTableRowDataOrderByLimit('55web_z_abstract',array("status"=>1,"journalsId"=>$journalsId),"id","ASC",0,2);
			$address = $this->home_model->getTableRowDataOrder('55web_z_address',array("status"=>1,"journalsId"=>$journalsId));
			$sociallinks = $this->home_model->getTableRowDataOrder('55web_social_links',array("status"=>1));
			/**** FOOTER ****/
			
			//echo "<pre>";print_r($boardArray);echo "</pre>";die();
			$json = array(
				"journalsId" => @$journalsId,
				"meta" => @$meta,
				"title" => @$title,
				"journalInfo" => @$journalInfo,
				"adminUrl" => @$adminUrl,
				"ads" => @$ads,
				"content" => @$contArray,
				"footerContent" => @$footerContent,
				"guidelines" => @$guidelines,
				"indexing" => @$indexing,
				"address" => @$address,			
				"sociallinks" => @$sociallinks,
				"noJs" => 0,
			);
			$encodeJson = json_encode($json);
			$data["jsonObj"] = $encodeJson;
			$data["menu"] = "pageAct";
			$this->load->view('header',$data);		
			$this->load->view('pages',$data);		
			$this->load->view('footer',$data);
		}
		else		
		{
			redirect(base_url());
		}
	}
	
	public function indexing()
	{
		$hurl=base_url();
		$journalsUrl=$this->home_model->getTableRowDataOrder('55web_z_journals',array("status"=>1,"url"=>@$hurl),"id","ASC");
		$journalsId = $journalsUrl[0]->id;
		/**** HEADER ****/
		$meta = $this->home_model->getTableRowDataOrder('55web_z_metadesc',array("status"=>1,"journalsId"=>$journalsId,"pageType" => 5),"id","ASC");
		$title=$this->home_model->getTableRowDataOrder('55web_z_journals',array("status"=>1,"id"=>$journalsId));
		$journalInfo=$this->home_model->getTableRowDataOrder('55web_z_journal_info',array("status"=>1,"journalsId"=>$journalsId));
		$adminUrl=$this->home_model->getTableRowDataOrder('configurations',array("status"=>1));
		$ads=$this->home_model->getTableRowDataOrder('55web_z_ads',array("status"=>1,"journalsId"=>$journalsId));
		/**** HEADER ****/

		/**** PAGE ****/
		$indexingContent = $this->home_model->getTableRowDataOrder('55web_z_abstract',array("status"=>1,"journalsId"=>$journalsId),"id","ASC");
		/**** PAGE ****/
		
		/**** FOOTER ****/
		$footerContent = $this->home_model->getTableRowDataOrder('55web_z_footer_content',array("status"=>1),"id","ASC");
		
		$guidelines = $this->home_model->getTableRowDataOrder('55web_z_content',array("status"=>1,"journalsId"=>$journalsId,"parent_id" => 0,"pageType" => 5),"id","ASC");
		$indexing = $this->home_model->getTableRowDataOrderByLimit('55web_z_abstract',array("status"=>1,"journalsId"=>$journalsId),"id","ASC",0,2);
		$address = $this->home_model->getTableRowDataOrder('55web_z_address',array("status"=>1,"journalsId"=>$journalsId));
		$sociallinks = $this->home_model->getTableRowDataOrder('55web_social_links',array("status"=>1));
		/**** FOOTER ****/
		
		//echo "<pre>";print_r($boardArray);echo "</pre>";die();
		$json = array(
			"journalsId" => @$journalsId,
			"meta" => @$meta,
			"title" => @$title,
			"journalInfo" => @$journalInfo,
			"adminUrl" => @$adminUrl,
			"ads" => @$ads,
			"footerContent" => @$footerContent,
			"quickLinks" => @$quickLinks,
			"guidelines" => @$guidelines,
			"indexingContent" => @$indexingContent,
			"indexing" => @$indexing,
			"address" => @$address,			
			"sociallinks" => @$sociallinks,
			"noJs" => 1,
		);
		$encodeJson = json_encode($json);
		$data["jsonObj"] = $encodeJson;
		$data["menu"] = "homeAct";
		$this->load->view('header',$data);		
		$this->load->view('indexing',$data);		
		$this->load->view('footer',$data);		
	}
	
	public function _send($to,$from,$subject,$messages)
	{
		$config = Array(
			  'mailtype' => 'html', 
			  'charset' => 'utf-8',
			  'wordwrap' => TRUE

		);
		  //print_r($from);die();
		$this->load->library('email');
		$this->email->initialize($config);
		$this->email->from($from);
		$this->email->to($to); 
		$this->email->subject($subject);
		
		$this->email->message($messages);
		$this->email->send();		
	}
	
	public function _sendsub($to,$from,$subject,$messages,$attachment)
	{
		$config = Array(
			  'mailtype' => 'html', 
			  'charset' => 'utf-8',
			  'wordwrap' => TRUE

		);
		  //print_r($to);die();
		$this->load->library('email');
		$this->email->initialize($config);
		$this->email->from($from);
		$this->email->to($to); 
		$this->email->subject($subject);		
		$this->email->message($messages);
		$this->email->attach('includes/uploads/'.$attachment);	
		$this->email->send();		
	}
}