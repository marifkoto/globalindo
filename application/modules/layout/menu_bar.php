<div class="navbar-default sidebar" role="navigation">
                <div class="sidebar-nav navbar-collapse">
                    <ul class="nav" id="side-menu">
                        <li class="sidebar-search">
                            <div class="input-group custom-search-form">
                                <!--
                                <input type="text" class="form-control" placeholder="Search...">
                                <span class="input-group-btn">
                                <button class="btn btn-default" type="button">
                                    <i class="fa fa-search"></i>
                                </button>
                                </span>
                                -->
                                <h4>Welcome Admin</h4>
                            </div>
                        </li>
                        <li <?php if($this->router->class=='dashboard'){echo "class='active'";}?>>
                            <a href="<?php echo base_url();?>dashboard"><i class="fa fa-home fa-fw"></i> Dashboard</a>
                        </li>
                        <li>
                            <a href="#"><i class="fa fa-truck fa-fw"></i> Supplier</a>
                        </li>
                        <li <?php if($this->router->class=='barang'){echo "class='active'";}?>>
                            <a href="<?php echo base_url();?>barang"><i class="fa fa-shopping-bag fa-fw"></i> Barang</a>
                        </li>
                        <li>
                            <a href="#"><i class="fa fa-user-plus fa-fw"></i> Sales</a>
                        </li>
                        <li>
                            <a href="#"><i class="fa fa-industry fa-fw"></i> Toko</a>
                        </li>
                        <li>
                            <a href="<?php echo base_url();?>nota"><i class="fa fa-sticky-note fa-fw"></i> Nota</a>
                        </li>
                        <li>
                            <a href="#"><i class="fa fa-cart-plus fa-fw"></i> Transaksi</a>
                        </li>
                        <li>
                            <a href="#"><i class="fa fa-thumbs-down fa-fw"></i> Pengembalian</a>
                        </li>
                        <li <?php if($this->router->class=='users'){echo "class='active'";}?>>
                            <a href="<?php echo base_url();?>users"><i class="fa fa-wrench fa-fw"></i> Users</a>
                        </li>
                    </ul>
                </div>
                <!-- /.sidebar-collapse -->
            </div>
            <!-- /.navbar-static-side -->
        </nav>