<?php
  session_start();
  setcookie("test","test",time()+3600);
  if( !isset($_COOKIE["Authority"]) ){
    setcookie("Authority","newer",time() + 86400);
  }
  // if( !isset($_COOKIE["queryResult"]) ){
  //   setcookie("queryResult","empty",time()+3600);
  // }
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>SheSL GAMES DB - Digital Agency</title>
<meta name="description" content="">
<meta name="author" content="">

<!-- Favicons
    ================================================== -->
<link rel="shortcut icon" href="img/nankai.jpg" type="image/x-icon">
<link rel="apple-touch-icon" href="img/apple-touch-icon.png">
<link rel="apple-touch-icon" sizes="72x72" href="img/apple-touch-icon-72x72.png">
<link rel="apple-touch-icon" sizes="114x114" href="img/apple-touch-icon-114x114.png">

<!-- Bootstrap -->
<link rel="stylesheet" type="text/css"  href="css/bootstrap.css">
<link rel="stylesheet" type="text/css" href="fonts/font-awesome/css/font-awesome.css">

<!-- Stylesheet
    ================================================== -->
<link rel="stylesheet" type="text/css"  href="css/style.css">
<link rel="stylesheet" type="text/css" href="css/prettyPhoto.css">
<link href="http://fonts.googleapis.com/css?family=Open+Sans:400,700,800,600,300" rel="stylesheet" type="text/css">

<!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
<!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>
<body id="page-top" data-spy="scroll" data-target=".navbar-fixed-top">
<!-- Navigation -->
<nav id="menu" class="navbar navbar-default navbar-fixed-top">
  <div class="container"> 
    <!-- Brand and toggle get grouped for better mobile display -->
    <div class="navbar-header">
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1"> <span class="sr-only">Toggle navigation</span> <span class="icon-bar"></span> <span class="icon-bar"></span> <span class="icon-bar"></span> </button>
      <a class="navbar-brand page-scroll" href="#page-top"><i class="fa fa-moon-o fa-rotate-90"></i> SheSL GAMES DB</a> </div>
    
    <!-- Collect the nav links, forms, and other content for toggling -->
    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
      <ul class="nav navbar-nav navbar-right">
        <li><a href="#page-top" class="page-scroll">Home</a></li>
        <li><a href="#services" class="page-scroll">Function</a></li>
        <li><a href="#about" class="page-scroll">Query</a></li>
        <li><a href="#portfolio" class="page-scroll">Gamelist</a></li>
        <li><a href="#team" class="page-scroll">Team</a></li>
        <li><a href="#contact" class="page-scroll">Contact</a></li>
        <?php if ($_COOKIE["Authority"] == "newer"){ ?>
  		<li><a class="btn js-signin-modal-trigger" href="#0" data-signin="login" id="login-btn">Log In</a></li>
  		<li><a class="btn js-signin-modal-trigger" href="#0" data-signin="signup" id="signup-btn">Sign Up</a></li>
        <?php }elseif ($_COOKIE["Authority"] == "login" && isset($_COOKIE["userName"])){ 
          echo '<li><a class="btn js-signin-modal-trigger" id="user-message">User:'.$_COOKIE["userName"].'</a></li>'?>
      <li><a class="btn js-signin-modal-trigger" href="goodbye.php" data-signin="logout" id="logout-btn">Log Out</a></li>
      <?php } ?>

      </ul>
    </div>
    <!-- /.navbar-collapse --> 
  </div>
  <!-- /.container-fluid --> 
</nav>

<div class="cd-signin-modal js-signin-modal"> <!-- this is the entire modal form, including the background -->
	<div class="cd-signin-modal__container"> <!-- this is the container wrapper -->
		<ul class="cd-signin-modal__switcher js-signin-modal-switcher js-signin-modal-trigger">
			<li><a href="#0" data-signin="login" data-type="login">Log in</a></li>
			<li><a href="#0" data-signin="signup" data-type="signup">New account</a></li>
		</ul>

		<div class="cd-signin-modal__block js-signin-modal-block" data-type="login"> <!-- log in form -->
			<form action="php/accessin.php" class="cd-signin-modal__form" method="POST">
        <p class="cd-signin-modal__fieldset">
          <label class="cd-signin-modal__label cd-signin-modal__label--email cd-signin-modal__label--image-replace" for="signin">E-mail</label>
          <input class="cd-signin-modal__input cd-signin-modal__input--full-width cd-signin-modal__input--has-padding cd-signin-modal__input--has-border" id="signin-key" type="text" placeholder="E-mail/User-name" name="signin-key">
          <span class="cd-signin-modal__error">Error message here!</span>
        </p>

        <p class="cd-signin-modal__fieldset">
          <label class="cd-signin-modal__label cd-signin-modal__label--password cd-signin-modal__label--image-replace" for="signin-password">Password</label>
          <input class="cd-signin-modal__input cd-signin-modal__input--full-width cd-signin-modal__input--has-padding cd-signin-modal__input--has-border" id="signin-password" type="text"  placeholder="Password" name="signin-password">
          <span class="cd-signin-modal__error">Error message here!</span>
          <a href="#0" class="cd-signin-modal__hide-password js-hide-password">Hide</a>
        </p>

        <p class="cd-signin-modal__fieldset">
          <input type="checkbox" id="remember-me" checked class="cd-signin-modal__input ">
          <label for="remember-me">Remember me</label>
        </p>

        <p class="cd-signin-modal__fieldset">
          <input class="cd-signin-modal__input cd-signin-modal__input--full-width self-defined__login-submit" type="submit" value="Login">
        </p>
      </form>
			
			<p class="cd-signin-modal__bottom-message js-signin-modal-trigger"><a href="#0" data-signin="reset">Forgot your password?</a></p>
		</div> <!-- cd-signin-modal__block -->

		<div class="cd-signin-modal__block js-signin-modal-block" data-type="signup"> <!-- sign up form -->
			<form action="php/signup.php" class="cd-signin-modal__form" method="POST">
				<p class="cd-signin-modal__fieldset">
					<label class="cd-signin-modal__label cd-signin-modal__label--username cd-signin-modal__label--image-replace" for="signup-username">Username</label>
					<input class="cd-signin-modal__input cd-signin-modal__input--full-width cd-signin-modal__input--has-padding cd-signin-modal__input--has-border" id="signup-username" type="text" placeholder="Username" name="signup-username">
					<span class="cd-signin-modal__error">Error message here!</span>
				</p>

				<p class="cd-signin-modal__fieldset">
					<label class="cd-signin-modal__label cd-signin-modal__label--email cd-signin-modal__label--image-replace" for="signup-email">E-mail</label>
					<input class="cd-signin-modal__input cd-signin-modal__input--full-width cd-signin-modal__input--has-padding cd-signin-modal__input--has-border" id="signup-email" type="email" placeholder="E-mail" name="signup-email">
					<span class="cd-signin-modal__error">Error message here!</span>
				</p>

				<p class="cd-signin-modal__fieldset">
					<label class="cd-signin-modal__label cd-signin-modal__label--password cd-signin-modal__label--image-replace" for="signup-password">Password</label>
					<input class="cd-signin-modal__input cd-signin-modal__input--full-width cd-signin-modal__input--has-padding cd-signin-modal__input--has-border" id="signup-password" type="text"  placeholder="Password" name="signup-password">
					<span class="cd-signin-modal__error">Error message here!</span>
          <a href="#0" class="cd-signin-modal__hide-password js-hide-password">Hide</a>
				</p>

				<p class="cd-signin-modal__fieldset">
					<label for="accept-terms">I agree to the <a href="#0">Terms</a></label>
          <input type="checkbox" id="accept-terms" class="cd-signin-modal__input ">
          <span class="cd-signin-modal__error">Please agree to the Terms first!</span>
				</p>

				<p class="cd-signin-modal__fieldset">
					<input class="cd-signin-modal__input cd-signin-modal__input--full-width cd-signin-modal__input--has-padding self-defined__create-submit" type="submit" value="Create account">
				</p>
			</form>
		</div> <!-- cd-signin-modal__block -->

		<div class="cd-signin-modal__block js-signin-modal-block" data-type="reset"> <!-- reset password form -->
			<p class="cd-signin-modal__message">Lost your password? Please enter your email address. You will receive a link to create a new password.</p>

			<form class="cd-signin-modal__form">
				<p class="cd-signin-modal__fieldset">
					<label class="cd-signin-modal__label cd-signin-modal__label--email cd-signin-modal__label--image-replace" for="reset-email">E-mail</label>
					<input class="cd-signin-modal__input cd-signin-modal__input--full-width cd-signin-modal__input--has-padding cd-signin-modal__input--has-border" id="reset-email" type="email" placeholder="E-mail">
					<span class="cd-signin-modal__error">Error message here!</span>
				</p>

				<p class="cd-signin-modal__fieldset">
					<input class="cd-signin-modal__input cd-signin-modal__input--full-width cd-signin-modal__input--has-padding" type="submit" value="Reset password">
				</p>
			</form>

			<p class="cd-signin-modal__bottom-message js-signin-modal-trigger"><a href="#0" data-signin="login">Back to log-in</a></p>
		</div> <!-- cd-signin-modal__block -->
		<a href="#0" class="cd-signin-modal__close js-close">Close</a>
	</div> <!-- cd-signin-modal__container -->
</div> <!-- cd-signin-modal -->
	

<!-- Header -->
<header id="header">
  <div class="intro text-center">
    <div class="overlay">
      <div class="container">
        <div class="row">
          <div class="intro-text">
            <h1>Welcome to <span class="brand">SheSL GAMES DB</span></h1>
            <p>This is a web databases system stored the player message.</p>
            <a href="#services" class="btn btn-default btn-lg page-scroll">Learn More</a> </div>
        </div>
      </div>
    </div>
  </div>
</header>
<!-- Services Section -->
<div id="services" class="text-center">
  <div class="container">
    <div class="col-md-8 col-md-offset-2 section-title">
      <h2>DataBase Function</h2>
      <p>html-css-javascript-php construction, use PHP connecet mysql database.</p>
      <p>Student Number: 1613574; Student Name: 佘崧林</p>
    </div>
    <div class="row">
      <div class="col-xs-6 col-md-3"> <i class="fa fa-desktop"></i>
        <h4>Sign Up</h4>
        <p>允许用户通过SignUp注册框（网页右上角黄色按钮），在数据库中进行注册操作。注册框利用jQuery的ajax框架读取mysql数据库检测登录用户名和邮箱是否已经注册。</p>
      </div>
      <div class="col-xs-6 col-md-3"> <i class="fa fa-gears"></i>
        <h4>Log In</h4>
        <p>用户在已经进行注册之后可以通过LogIn登录框（网页右上角灰色按钮），进行登录操作。登录框同样利用jQuery的ajax框架读取mysql数据库以检测用户输入信息用户名不存在或密码错误。</p>
      </div>
      <div class="col-xs-6 col-md-3"> <i class="fa fa-rocket"></i>
        <h4>Log Out</h4>
        <p>用户在已经登录之后得到一小时的cookie，可以在右上角查看登录所用的用户名。可以通过使用LogOut注销框（登录后同样在右上角显示），进行注销操作。注销通过设置cookie为expired退出。</p>
      </div>
      <div class="col-xs-6 col-md-3"> <i class="fa fa-line-chart"></i>
        <h4>Redirection</h4>
        <p>本网页通过编写javaScript调用time()函数，设置跳转页面，五秒跳转时间并在页面上显示跳转时间。</p>
      </div>
    </div>
  </div>
</div>
<!-- About Section -->
<div id="about">
  <div class="container">
    <div class="col-md-8 col-md-offset-2 section-title text-center">
      <h2>Query</h2>
      <?php if($_COOKIE["Authority"] == "newer"){ ?>
      <p>您可以在登录之后在右下角进行本系统中用户信息游戏分数排行榜<p>
      <?php }elseif( $_COOKIE["Authority"] == "login" ){ ?>
      <p>数据库视图查询</p>
      <?php } ?>
    </div>
    <div class="row">
      <div class="col-xs-12 col-md-6" name="query-image"> <img src="img/about.jpg" class="img-responsive" alt=""> </div>
      <div class="col-xs-12 col-md-6">
        <?php if($_COOKIE["Authority"] == "newer"){ ?>
        <div class="about-text">
          <h4>Users Query</h4>
          <p>本网站同样采用ajax连接php方式，通过javascript控件连接后台数据库实现查询功能。在Users的查询框中输入用户名或邮箱，后台会返回用户名、邮箱、性别等信息。</p>
          <h4>Games Ranking</h4>
          <p>本网站拟搭建javascript网页游戏并记录用户最高分以及用户对游戏的评分，使用该输入框输入游戏名称，返回游戏排行榜。因时间原因，此处不以实现。</p>
          <h4>Return Result</h4>
          <p>查询结果将在这里显示，欲查询请先登录。</p>
        </div>
      <?php }elseif($_COOKIE["Authority"] == "login"){ ?>
        <div class="about-text">
          <h4>Query by user-name or email</h4>
            <div class="query-box">
              <form action="php/query.php" id="query-user-box" class="query-user-class" method="POST">
                <label class="query-prefix-text" for="query-user">USER NAME</label>
                <input class="query-user-text query-user-class" id="query-user" type="text"  placeholder="user name/email address" name="query-user">
                <input class="query-button query-user-class" id="query-user-sm" type="submit" value="QUERY">
              </form>
            </div>
          <br><br>
          <h4>Query by Games name</h4>
            <div class="query-box">
              <form action="php/queryGame.php" id="query-games-box" class="query-games-class" method="POST">
                <label class="query-prefix-text" for="query-game">GAME NAME</label>
                <input class="query-user-text query-games-class" id="query-game" type="text"  placeholder="Please select a games" name="query-game">
                <input class="query-button query-games-class" id="query-games-sm" type="submit" value="QUERY">
              </form>
            </div>
          <br><br>
          <h4>Query Result</h4>
            <div class="query-box">
              <p id='query-result'>
                <?= $_COOKIE["queryResult"] ?>
              </p>
            </div>
        </div>
      <?php }?>
      </div>
    </div>
  </div>
</div>
<!-- Portfolio Section -->
<div id="portfolio">
  <div class="container">
    <div class="col-md-8 col-md-offset-2 section-title text-center">
      <h2>Game List</h2>
      <p>此处应列有javascript网页游戏列表，时间原因没做完</p>
    </div>
    <div class="categories">
      <ul class="cat">
        <li>
          <ol class="type">
            <li><a href="#" data-filter="*" class="active">All</a></li>
            <li><a href="#" data-filter=".web">RPG</a></li>
            <li><a href="#" data-filter=".app">Puzzle</a></li>
            <li><a href="#" data-filter=".branding">Casual</a></li>
          </ol>
        </li>
      </ul>
      <div class="clearfix"></div>
    </div>
    <div class="row">
      <div class="portfolio-items">
        <div class="col-sm-6 col-md-3 col-lg-3 web">
          <div class="portfolio-item">
            <div class="hover-bg"> <a href="img/portfolio/01-large.jpg" title="Project description" rel="prettyPhoto">
              <div class="hover-text">
                <h4>Project Title</h4>
                <small>Web Design</small> </div>
              <img src="img/portfolio/01-small.jpg" class="img-responsive" alt="Project Title"> </a> </div>
          </div>
        </div>
        <div class="col-sm-6 col-md-3 col-lg-3 app">
          <div class="portfolio-item">
            <div class="hover-bg"> <a href="img/portfolio/02-large.jpg" title="Project description" rel="prettyPhoto">
              <div class="hover-text">
                <h4>Project Title</h4>
                <small>App Development</small> </div>
              <img src="img/portfolio/02-small.jpg" class="img-responsive" alt="Project Title"> </a> </div>
          </div>
        </div>
        <div class="col-sm-6 col-md-3 col-lg-3 web">
          <div class="portfolio-item">
            <div class="hover-bg"> <a href="img/portfolio/03-large.jpg" title="Project description" rel="prettyPhoto">
              <div class="hover-text">
                <h4>Project Title</h4>
                <small>Web Design</small> </div>
              <img src="img/portfolio/03-small.jpg" class="img-responsive" alt="Project Title"> </a> </div>
          </div>
        </div>
        <div class="col-sm-6 col-md-3 col-lg-3 web">
          <div class="portfolio-item">
            <div class="hover-bg"> <a href="img/portfolio/04-large.jpg" title="Project description" rel="prettyPhoto">
              <div class="hover-text">
                <h4>Project Title</h4>
                <small>Web Design</small> </div>
              <img src="img/portfolio/04-small.jpg" class="img-responsive" alt="Project Title"> </a> </div>
          </div>
        </div>
        <div class="col-sm-6 col-md-3 col-lg-3 app">
          <div class="portfolio-item">
            <div class="hover-bg"> <a href="img/portfolio/05-large.jpg" title="Project description" rel="prettyPhoto">
              <div class="hover-text">
                <h4>Project Title</h4>
                <small>App Development</small> </div>
              <img src="img/portfolio/05-small.jpg" class="img-responsive" alt="Project Title"> </a> </div>
          </div>
        </div>
        <div class="col-sm-6 col-md-3 col-lg-3 branding">
          <div class="portfolio-item">
            <div class="hover-bg"> <a href="img/portfolio/06-large.jpg" title="Project description" rel="prettyPhoto">
              <div class="hover-text">
                <h4>Project Title</h4>
                <small>Branding</small> </div>
              <img src="img/portfolio/06-small.jpg" class="img-responsive" alt="Project Title"> </a> </div>
          </div>
        </div>
        <div class="col-sm-6 col-md-3 col-lg-3 branding app">
          <div class="portfolio-item">
            <div class="hover-bg"> <a href="img/portfolio/07-large.jpg" title="Project description" rel="prettyPhoto">
              <div class="hover-text">
                <h4>Project Title</h4>
                <small>App Development, Branding</small> </div>
              <img src="img/portfolio/07-small.jpg" class="img-responsive" alt="Project Title"> </a> </div>
          </div>
        </div>
        <div class="col-sm-6 col-md-3 col-lg-3 web">
          <div class="portfolio-item">
            <div class="hover-bg"> <a href="img/portfolio/08-large.jpg" title="Project description" rel="prettyPhoto">
              <div class="hover-text">
                <h4>Project Title</h4>
                <small>Web Design</small> </div>
              <img src="img/portfolio/08-small.jpg" class="img-responsive" alt="Project Title"> </a> </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<!-- Team Section -->
<div id="team" class="text-center">
  <div class="container">
    <div class="col-md-8 col-md-offset-2 section-title">
      <h2>Meet Us</h2>
      <p>一个充满活力的团队</p>
    </div>
      <div class="col-md-3 col-sm-6 team">
        <div class="thumbnail"> <img src="img/team/01.jpg" alt="..." class="img-circle team-img">
          <div class="caption">
            <h3>She Songlin</h3>
            <p>Group Leader</p>
          </div>
        </div>
      </div>
      <div class="col-md-3 col-sm-6 team">
        <div class="thumbnail"> <img src="img/team/02.jpg" alt="..." class="img-circle team-img">
          <div class="caption">
            <h3>Songlin She</h3>
            <p>Web Designer</p>
          </div>
        </div>
      </div>
      <div class="col-md-3 col-sm-6 team">
        <div class="thumbnail"> <img src="img/team/03.jpg" alt="..." class="img-circle team-img">
          <div class="caption">
            <h3>shesonglin</h3>
            <p>JavaScript Animation</p>
          </div>
        </div>
      </div>
      <div class="col-md-3 col-sm-6 team">
        <div class="thumbnail"> <img src="img/team/04.jpg" alt="..." class="img-circle team-img">
          <div class="caption">
            <h3>SheSL</h3>
            <p>MySQL Management</p>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<!-- Contact Section -->
<div id="contact" class="text-center">
  <div class="overlay">
    <div class="container">
      <div class="col-md-8 col-md-offset-2 section-title">
        <h2>Get In Touch</h2>
        <p>欢迎bug反馈。</p>
      </div>
      <div class="col-md-8 col-md-offset-2">
        <form name="sentMessage" id="contactForm" novalidate>
          <div class="row">
            <div class="col-md-6">
              <div class="form-group">
                <input type="text" id="name" class="form-control" placeholder="Name" required="required">
                <p class="help-block text-danger"></p>
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group">
                <input type="email" id="email" class="form-control" placeholder="Email" required="required">
                <p class="help-block text-danger"></p>
              </div>
            </div>
          </div>
          <div class="form-group">
            <textarea name="message" id="message" class="form-control" rows="4" placeholder="Message" required></textarea>
            <p class="help-block text-danger"></p>
          </div>
          <div id="success"></div>
          <button type="submit" class="btn btn-default">Send Message</button>
        </form>
        <div class="social">
          <ul>
            <li><a href="https://www.facebook.com/profile.php?id=100009120472845"><i class="fa fa-facebook"></i></a></li>
            <li><a href="https://twitter.com/shesonglin"><i class="fa fa-twitter"></i></a></li>
            <li><a href="https://space.bilibili.com/13238960/#/"><i class="fa fa-dribbble"></i></a></li>
            <li><a href="https://github.com/shesl-meow"><i class="fa fa-github"></i></a></li>
            <li><a href="https://www.instagram.com/shesonglin/"><i class="fa fa-instagram"></i></a></li>
            <li><a href="#"><i class="fa fa-linkedin"></i></a></li>
          </ul>
        </div>
      </div>
    </div>
  </div>
</div>
<div id="footer">
  <div class="container text-center">
    <div class="fnav">
      <p>Copyright &copy; 2016 Designed by <a href="http://www.templatewire.com" rel="nofollow">TemplateWire</a></p>
      <p>Copyright &copy; 2018 SheSL GAMES DB. Modyfied by <a href="http://github.com/shesl-meow" rel="nofollow">shesl-meow</a></p>
    </div>
  </div>
</div>
<script type="text/javascript" src="js/jquery.1.11.1.js"></script> 
<script type="text/javascript" src="js/bootstrap.js"></script> 
<script type="text/javascript" src="js/SmoothScroll.js"></script> 
<script type="text/javascript" src="js/jquery.prettyPhoto.js"></script> 
<script type="text/javascript" src="js/jquery.isotope.js"></script> 
<script type="text/javascript" src="js/jqBootstrapValidation.js"></script> 
<script type="text/javascript" src="js/contact_me.js"></script> 
<script type="text/javascript" src="js/main.js"></script>
<?php if($_COOKIE["Authority"] == "newer" ){ ?>
<script type='text/javascript' src='js/logblock.js'></script>
<?php }elseif($_COOKIE["Authority"] == "login" ){ ?>
<script type='text/javascript' src='js/queryblock.js'></script>
<?php } ?>
</body>
</html>