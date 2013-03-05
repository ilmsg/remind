<?php
	header('Expires: Thu, 01-Jan-70 00:00:01 GMT');
	header('Last-Modified: ' . gmdate('D, d M Y H:i:s') . ' GMT');
	header('Cache-Control: no-store, no-cache, must-revalidate');
	header('Cache-Control: post-check=0, pre-check=0', false);
	header('Pragma: no-cache');
	header('Content-type: text/html; charset=utf-8');
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title>ธรรมะเตือนใจ - บ้านธรรมะ</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="ธรรมะเตือนใจ - บ้านธรรมะ ข้อความธรรมเตือนใจจากพระไตรปิฎก">
    <meta name="author" content="บ้านธรรมะ">
	<meta property="og:title" content="ธรรมะเตือนใจ - บ้านธรรมะ" />
    <meta property="og:type" content="website" />
    <meta property="og:url" content="<?php echo current_url(); ?>" />
    <meta property="og:image" content="<?php echo base_url('img/dhammahome.jpg'); ?>" />
    <meta property="og:site_name" content="ธรรมะเตือนใจ" />
    <meta property="fb:admins" content="100003564668438" />
    <!-- Le styles -->
    <link href="<?php echo base_url('css/bootstrap.css');?>" rel="stylesheet">
    <style type="text/css">
      body {
        padding-top: 20px;
        padding-bottom: 40px;
      }

      /* Custom container */
      .container-narrow {
        margin: 0 auto;
        max-width: 700px;
      }
      .container-narrow > hr {
        margin: 30px 0;
      }

      /* Main marketing message and sign up button */
      .jumbotron {
        margin: 60px 0;
        text-align: center;
      }
      .jumbotron h1 {
        font-size: 72px;
        line-height: 1;
      }
      .jumbotron .btn {
        font-size: 21px;
        padding: 14px 24px;
      }

      /* Supporting marketing content */
      .marketing {
        margin: 60px 0;
      }
      .marketing p + h4 {
        margin-top: 28px;
      }
    </style>
    <link href="<?php echo base_url('css/bootstrap-responsive.css');?>" rel="stylesheet">

    <!-- HTML5 shim, for IE6-8 support of HTML5 elements -->
    <!--[if lt IE 9]>
      <script src="<?php echo base_url('js/html5shiv.js');?>"></script>
    <![endif]-->

    <!-- Fav and touch icons -->
    <link rel="apple-touch-icon-precomposed" sizes="144x144" href="<?php echo base_url('img/apple-touch-icon-144-precomposed.png');?>">
    <link rel="apple-touch-icon-precomposed" sizes="114x114" href="<?php echo base_url('img/apple-touch-icon-114-precomposed.png');?>">
    <link rel="apple-touch-icon-precomposed" sizes="72x72" href="<?php echo base_url('img/apple-touch-icon-72-precomposed.png');?>">
    <link rel="apple-touch-icon-precomposed" href="<?php echo base_url('img/apple-touch-icon-57-precomposed.png');?>">
    <link rel="shortcut icon" href="<?php echo base_url('img/favicon.png');?>">
  </head>
  <body>
    <div id="fb-root"></div>
    <script>
      window.fbAsyncInit = function() {
        FB.init({
          appId: '<?php echo $this->facebook->getAppID() ?>',
          cookie: false,
          xfbml: true,
          oauth: true
        });
		
        FB.Event.subscribe('auth.login', function(response) {
          //window.location.reload();
        });
		
        FB.Event.subscribe('auth.logout', function(response) {
          //window.location.reload();
        });
	};	
	
	function postToFeed(caption, description, link) {
		var obj = {
			method: 'feed',
			//redirect_uri: 'http://remind.ilmsg.com/',
			link: link,
			picture: '<?php echo base_url('img/dhammahome.jpg'); ?>',
			name: 'ธรรมะเตือนใจ',
			caption: caption,
			description: description
		};
		
		function callback(response) {			
			if( response ){
				alert('โพสลงกระดานเรียบร้อยแล้ว');
			}
			//document.getElementById('msg').innerHTML = "Post ID: " + response['post_id'];
		}
		
		FB.ui(obj, callback);
	}

      (function() {
        var e = document.createElement('script'); e.async = true;
        e.src = document.location.protocol +
          '//connect.facebook.net/th_TH/all.js#xfbml=1&appId=<?php echo $this->facebook->getAppID() ?>';
        document.getElementById('fb-root').appendChild(e);
      }());
    </script>
    <div class="container-narrow">
      <div class="masthead">
        <ul class="nav nav-pills pull-right">
          <li class="<?php echo ( $this->uri->segment(2) == '' || $this->uri->segment(2) == 'home' ) ? 'active':''; ?>"><?php echo anchor('main', 'หน้าแรก'); ?></li>
          <li class="<?php echo ( $this->uri->segment(2) == 'lists' ) ? 'active':''; ?>"><?php echo anchor('main/lists', 'รายการทั้งหมด'); ?></li>                    
          <?php if( !$this->user ){ ?>
          	<li class="<?php echo ( $this->uri->segment(2) == 'login' ) ? 'active':''; ?>"><?php echo anchor('main/login', 'เข้าระบบผ่านทาง facebook'); ?></li>
          <?php }else{ ?>
          	<?php /*
          	<li data-toggle="dropdown" class="<?php echo ( $this->uri->segment(2) == 'logout' ) ? 'active dropdown-toggle':'dropdown-toggle'; ?>"><?php echo anchor('main/logout', 'ออกระบบ'); ?></li>
          	*/ ?>
			<li class="dropdown">
                <a class="dropdown-toggle" id="drop5" role="button" data-toggle="dropdown" href="#"><?php echo $this->user_profile['name']; ?><b class="caret"></b></a>
                <ul id="menu3" class="dropdown-menu" role="menu" aria-labelledby="drop5">
                  <?php /*
                  <li role="presentation"><a role="menuitem" tabindex="-1" href="#">Action</a></li>
                  <li role="presentation"><a role="menuitem" tabindex="-1" href="#">Another action</a></li>
                  <li role="presentation"><a role="menuitem" tabindex="-1" href="#">Something else here</a></li>
                  <!-- <li role="presentation" class="divider"></li> -->
				  */ ?>
				  <?php if( $this->user == $this->admin ){ ?>
                  	<li role="presentation"><?php echo anchor('main/addnew', 'เพิ่มใหม่'); ?></li>
                  <?php } ?>
                  <li role="presentation"><?php echo anchor('main/logout', 'ออกระบบ','role="menuitem" tabindex="-1"'); ?></li>
                </ul>
              </li>
              
            
            
		  <?php } ?>
        </ul>
        <h3 class="muted">ธรรมะเตือนใจ</h3>
        <p>ข้อความธรรมเตือนใจจากพระไตรปิฎก</p>
      </div>
      <hr>