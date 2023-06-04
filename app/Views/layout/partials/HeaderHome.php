<header class="header-area">
        <div class="header-top">
            <div class="container">
                <div class="row">
                    <div class="col-lg-9 d-md-flex">
                        <h6 class="mr-3"><span class="mr-2"><i class="fa fa-mobile"></i></span> call us now! +1 305 708 2563</h6>
                        <h6 class="mr-3"><span class="mr-2"><i class="fa fa-envelope-o"></i></span> medical@example.com</h6>
                        <h6><span class="mr-2"><i class="fa fa-map-marker"></i></span> Find our Location</h6>
                    </div>
                    <div class="col-lg-3">
                        <div class="social-links">
                            <ul>
                                <li><a href="#"><i class="fa fa-facebook"></i></a></li>
                                <li><a href="#"><i class="fa fa-linkedin"></i></a></li>
                                <li><a href="#"><i class="fa fa-twitter"></i></a></li>
                                <li><a href="#"><i class="fa fa-instagram"></i></a></li>
                                <li><a href="#"><i class="fa fa-vimeo"></i></a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div id="header" id="home">
            <div class="container">
                <div class="row align-items-center justify-content-between d-flex">
                    <div id="logo">
                        <a href="#"><img src="<?= base_url('assets-fe/images/logo/logo.png') ?>" alt="" title="" /></a>
                    </div>
                    <nav id="nav-menu-container">
                        <ul class="nav-menu">
                            <li class="menu-active"><a href="<?= base_url('') ?>">Home</a></li>
                            <li><a href="<?= base_url('antrian-online') ?>">Antrian Online</a></li>
                            <li class="menu-has-children"><a href="#">Drop Down Sample</a>
                                <ul>
                                    <li><a href="#">1 Drop</a></li>
                                    <li><a href="#">2 Drop</a></li>
                                </ul>
                            </li>
                            <?php if (session()->get('isLoggedIn')): ?>
                                <li class="profile-menu menu-has-children">
                                    <a href="#"><i class="fa fa-user-circle"></i> John Doe</a>
                                    <ul class="dropdown-menu">
                                        <li><a href="#">Profile</a></li>
                                        <li><a href="#">Settings</a></li>
                                        <li><a href="#">Logout</a></li>
                                    </ul>
                                </li>
                            <?php else: ?>
                                <li>
                                    <a href="<?= base_url('signin') ?>" class="button">Login/Register</a>
                                </li>
                            <?php endif ?>         				          
                        </ul>
                    </nav>    		
                </div>
            </div>
        </div>
    </header>