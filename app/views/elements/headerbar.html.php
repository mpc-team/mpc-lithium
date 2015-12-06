<?php
/**
 * headerbar.html.php
 *
 * Page header navigation. This navbar is at the top of
 * every page underneath the MPC banner.
 *
 */

?>
<div class="page-header-navigation">

    <hr style="position: absolute; right: 0; left: 0; margin: 0px 0px 0px 0px;" />

    <nav role="navigation" class="navbar navbar-default">
        <div class="navbar-header">
            <button type="button" data-target=".navbar-collapse" data-toggle="collapse" class="navbar-toggle">
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <ul class="nav navbar-nav">
                <li id='headerbar-home'>
                    <a href='/'>MPC</a>
                </li>
            </ul>
        </div>
        <div class="collapse navbar-collapse">
            <ul class="nav navbar-nav">

                <li id='headerbar-members'>
                    <a href='/members'>Members</a>
                </li>

                <li id='headerbar-forum'>
                    <a href='/forum'>Forum</a>
                </li>

                <li id='headerbar-games' class='dropdown'>
                    <a href='/games' role='button'>
                        Games
                    </a>
                </li>

            </ul>
            <ul class="nav navbar-nav pull-right">
                <?php if ($authorized): ?>
                <li id='headerbar-user' class='dropdown'>
                    <a href='/user/profile' role='button'>
                        <span class='glyphicon glyphicon-user'></span>
                        <?= $authorized['alias'] ?>
                    </a>
                    <ul class='dropdown-menu' role='menu'>
                        <li>
                            <a href='/user/profile'>Profile</a>
                        </li>
                        <li class='divider'></li>
                        <li>
                            <a href='/logout'>
                                <span class='glyphicon glyphicon-log-out'></span>
                                Logout
                            </a>
                        </li>
                    </ul>
                </li>
                <?php else: ?>
                <li id='headerbar-signup'>
                    <a href='/signup'>Signup</a>
                </li>
                <li id='headerbar-login'>
                    <a href='/login'>Login</a>
                </li>
                <?php endif; ?>
            </ul>
        </div>
    </nav>

    <hr style="position: absolute; right: 0; left: 0; margin: 0px 0px 0px 0px;" />
    
</div>