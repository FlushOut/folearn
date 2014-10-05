<?php 
$egravatar = $user->email;
$default = "http://learn.flushoutsolutions.com/img/user-thumb.jpg";
$size = 50;
$size_circle = 70;
$grav_url = "http://www.gravatar.com/avatar/" . md5( strtolower( trim( $egravatar ) ) ) . "?d=" . urlencode( $default ) . "&s=" . $size;
$grav_url_circle = "http://www.gravatar.com/avatar/" . md5( strtolower( trim( $egravatar ) ) ) . "?d=" . urlencode( $default ) . "&s=" . $size_circle;
?>
<script type="text/javascript">
    function soloNumeros(e){
        var key = window.Event ? e.which : e.keyCode
        return (key >= 48 && key <= 57)
    }
</script>
<header class="header" data-spy="affix" data-offset-top="0">
            <!--nav bar helper-->
            <div class="navbar-helper">
                <div class="row-fluid">
                    <!--panel site-name-->
                    <div class="span2">
                        <div class="panel-sitename">
                            <h2><a href="<?php echo $url; ?>"><span class="color-teal">fo</span>Learn</a></h2>
                        </div>
                    </div>
                    <!--/panel name-->

                    <div class="span6">
                    </div>
                    <div class="span4">
                        <!--panel button ext-->
                        <div class="panel-ext">
                            <div class="btn-group">
                                <a class="btn btn-inverse btn-small dropdown-toggle" data-toggle="dropdown" href="#">
                                    <?php echo $user->name ?>
                                </a>
                            </div>
                            <div class="btn-group user-group">
                                <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                                    <img class="corner-all" align="middle" src="<?php echo $grav_url; ?>" title="<?php echo $user->name ?>" alt="<?php echo $user->name ?>" /> <!--this for display on PC device-->
                                    <button class="btn btn-small btn-inverse"><?php echo $user->name ?></button> <!--this for display on tablet and phone device-->
                                </a>
                                <ul class="dropdown-menu dropdown-user" role="menu" aria-labelledby="dLabel">
                                    <li>
                                        <div class="media">
                                            <a class="pull-left" href="https://gravatar.com" target="_BLANK">
                                                <img class="img-circle" src="<?php echo $grav_url_circle; ?>" title="Change your profile image in Gravatar" alt="Change your profile image in Gravatar" />
                                            </a>
                                            <div class="media-body description">
                                                <p><strong><?php echo $user->name ?></strong></p>
                                                <p class="muted"><?php echo $company->name ?></p>
                                                <p class="muted"><?php echo $user->email ?></p>
                                            </div>
                                        </div>
                                    </li>
                                    <li class="dropdown-footer">
                                        <div>
                                            <a class="btn btn-small pull-right" href="/pages/logout.php">Logout</a>
                                            <a class="btn btn-small" style="visibility:hidden;" href="#"></a>
                                        </div>
                                    </li>
                                </ul>
                            </div>
                        </div><!--panel button ext-->
                    </div>
                </div>
            </div><!--/nav bar helper-->
        </header>