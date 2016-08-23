<?php
/**
 * headerbar.html.php
 *
 * Page header navigation. This navbar is at the top of
 * every page underneath the MPC banner.
 *
 */

$button_hover_class = 'cl-effect-3';

?>
<div class="page-header-nav">

    <hr style="position: absolute; right: 0; left: 0; margin: 0px 0px 0px 0px;" />

    <nav role="navigation" class="navbar navbar-default cl-effect-1">
        <ul class="nav navbar-nav">
            <li id='headerbar-home'>
                <a href='/'>
                    mpc
                </a>
            </li>
        </ul>
        <ul class="nav navbar-nav">

            <li id='headerbar-community'>
                <a href='/community'>
                    community
                </a>
            </li>

            <li id="headerbar-connect">
                <a href='/connect'>
                    connect
                </a>
            </li>

            <li id='headerbar-forum'>
                <a href='/forum'>
                    forum
                </a>
            </li>

            <li id='headerbar-games' class='dropdown'>
                <a href='/games'>
                    games
                </a>
            </li>

            <li id="headerbar-streams">
                <a href='/streams'>
                    streams
                </a>
            </li>

        </ul>
        <ul class="nav navbar-nav pull-right">
            <?php if ($authorized): ?>
            <li id='headerbar-user' class='dropdown'>
                <a href='/user/profile'>
                    profile
                    
                </a>
                <ul class='dropdown-menu' role='menu'>
                    <li>
                        <a href='/user/profile'>
                            Profile
                        </a>
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
                <a href='/signup'>
                    signup
                </a>
            </li>
            <li id='headerbar-login'>
                <a href='/login'>
                    login
                </a>
            </li>
            <?php endif; ?>
        </ul>
    </nav>

    <hr style="position: absolute; right: 0; left: 0; margin: 0px 0px 0px 0px;" />

</div>
