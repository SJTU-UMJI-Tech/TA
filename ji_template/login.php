<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- 上述3个meta标签*必须*放在最前面，任何其他内容都*必须*跟随其后！ -->
    <meta name="description" content="">
    <meta name="author" content="">
    <title>Login Page</title>
    <!-- Bootstrap core CSS -->
	<link rel="stylesheet" type="text/css" href="//cdn.bootcss.com/bootstrap/3.3.5/css/bootstrap.min.css">
    <!-- Custom styles for this template -->
    <link href="/ji_style/login.css" rel="stylesheet">

</head>

<body>

<div class="container">
    <img src="/ji_style/images/JI-logo-02.png" alt="JI Logo" width="210">
    <?php echo form_open(base_url('login/test?url='.$url), 'class="form-signin"');?>
    <label for="inputID" class="sr-only">Student ID</label>
    <input type="text" name="username" class="form-control" placeholder="Student ID" required autofocus>
    <label for="inputPassword" class="sr-only">Password</label>
    <input type="password" name="password" class="form-control" placeholder="Password" required>
    <div class="checkbox">
        <a href="#">Login with jAccount</a>
    </div>
    <button class="btn btn-lg btn-primary btn-block" type="submit">Sign in</button>
    </form>

</div> <!-- /container -->


<!--
<? if($logout == 1):?>
	<a class="jaccount" href="/jaccount_logout.php" ><span>权限不足，切换账户</span></a>
<? else:?>
	<a class="jaccount" href="/jaccount.php" ><span>Jaccount统一账户认证</span></a>
<? endif?>
-->


</body>
</html>
