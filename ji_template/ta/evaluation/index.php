<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no">
	<!-- To be revised -->
	<title><?php echo $page_name?></title>
    <script src="/ji_js/jquery-1.8.3.min.js"></script>
	<script src="/ji_js/ta/evaluation.js"></script>
    <script src="/ji_js/base64.js"></script>
    <script src="/ji_js/confirmLogout.js"></script>
	<noscript>Your browser does not support JavaScript!</noscript>
<!--    <link rel="stylesheet" type="text/css"-->
<!--          href="//cdn.bootcss.com/bootstrap/3.3.5/css/bootstrap.min.css">-->
<!--    <script src="//cdn.bootcss.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>-->
	<link rel="stylesheet" type="text/css" href="/ji_style/ta/evaluation.css">
	<base target="_self">
</head>

<body>
<div class="wholeBody">
<!-- Top Banner -->
    <div class="_top">
    	<a href="http://umji.sjtu.edu.cn/cn/"><img src="/ji_style/ta/images/JI logo-01.png" height="110" alt="Logo of Joint Institute" title="上海交大密西根学院"></a>
        <h1 title="Teaching Assistant Evaluation System">Teaching Assistant Evaluation System</h1>
    </div>
    <div class="banner">
        <div>
            <div class="jAccount_login"><a href="student/SignIn_jAccount.html">jAccount Login</a></div>
            <div class="regular_login"><a href="/login?url=<?php echo base64_encode($_SERVER["REQUEST_URI"]);?>">TAES Login</a></div>
        </div>
    </div>

<!-- The main page content is here -->
    <div class="body">
    <!-- SideBar is here -->
    <div class="sidebar">
            <table>
                <tbody>
                    <tr>
                        <td id="tag1"><a href="index.php">Welcome</a></td>
                    </tr>
                    <tr>
                        <td id="tag2"><a href="student/About.html">About</a></td>
                    </tr>
                    <tr>
                        <td id="tag3"><a href="student/Features.html">Features</a></td>
                    </tr>
                    <tr>
                        <td id="tag4"><a href="student/Acknowledgments.html">Acknowledgments</a></td>
                    </tr>
                    <tr>
                        <td id="tag5"><a href="student/Help.html">Help</a></td>
                    </tr>
                </tbody>
            </table>
        </div>
        <!-- The main content part is here -->
        <div class="maincontent">
            <div class="announcement">
                <h2>Homepage: Announcement</h2>
                <p>Dear student:<br/><br/>
                    If you got any problem regarding Teaching Assistant Evaluation System, please dial hotline at 021-3420 6765 Ext 3182. You can also send mail to <a href="mailto:dengpan.huang@sjtu.edu.cn?subject=Report problems: ">dengpan.huang@sjtu.edu.cn</a>. Thanks.
                </p>
            </div>
            <div class="welcome">
                <h2>Homepage: Welcome!</h2>
                <p><span>Welcome to use TA Evaluation System!</span><br/><br/>
                    Description about this site is here. To be determined...
                </p>
            </div>
        </div>
    </div>


<?php include 'common_footer.php'; ?>