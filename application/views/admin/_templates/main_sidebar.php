<?php
defined('BASEPATH') OR exit('No direct script access allowed');

?>

            <aside class="main-sidebar">
                <section class="sidebar">
<?php if ($admin_prefs['user_panel'] == TRUE): ?>
                    <!-- Sidebar user panel -->
                    <div class="user-panel">
                        <div class="pull-left image">
                            <img src="<?php echo base_url($avatar_dir . '/m_001.png'); ?>" class="img-circle" alt="User Image">
                        </div>
                        <div class="pull-left info">
                            <p><?php echo $user_login['firstname'].$user_login['lastname']; ?></p>
                            <a href="#"><i class="fa fa-circle text-success"></i> <?php echo lang('menu_online'); ?></a>
                        </div>
                    </div>

<?php endif; ?>
<?php if ($admin_prefs['sidebar_form'] == TRUE): ?>
                    <!-- Search form -->
                    <form action="#" method="get" class="sidebar-form">
                        <div class="input-group">
                            <input type="text" name="q" class="form-control" placeholder="<?php echo lang('menu_search'); ?>...">
                            <span class="input-group-btn">
                                <button type="submit" name="search" id="search-btn" class="btn btn-flat"><i class="fa fa-search"></i></button>
                            </span>
                        </div>
                    </form>

<?php endif; ?>
                    <!-- Sidebar menu -->
                    <ul class="sidebar-menu">
                        <li>
                            <a href="<?php echo site_url('/'); ?>">
                                <i class="fa fa-home text-primary"></i> <span><?php echo lang('menu_access_website'); ?></span>
                            </a>
                        </li>

                        <li class="header text-uppercase"><?php echo lang('menu_main_navigation'); ?></li>
                        <li class="<?=active_link_controller('dashboard')?>">
                            <a href="<?php echo site_url('admin/dashboard'); ?>">
                                <i class="fa fa-dashboard"></i> <span><?php echo lang('menu_dashboard'); ?></span>
                            </a>
                        </li>
                        
                        <li class="header text-uppercase"><?php echo lang('menu_administration'); ?></li>
                        
                        <li class="treeview <?=active_link_controller('prefs')?>">
                            <a href="#">
                                <i class="fa fa-cogs"></i><span><?php echo lang('menu_preferences'); ?></span>
                                <span class="pull-right-container"><i class="fa fa-angle-left pull-right"></i></span>
                            </a>
                            <ul class="treeview-menu">
                                <li class="<?=active_link_function('interfaces')?>"><a href="<?php echo site_url('admin/prefs/interfaces/admin'); ?>"><i class="fa fa-cog"></i><?php echo lang('menu_interfaces'); ?></a></li>
                            </ul>
                        </li>
                        
                        <li class="treeview <?=active_link_controller('courts')?>">
                            <a href="#">
                                <i class="fa fa-balance-scale"></i><span><?php echo lang('menu_courts'); ?></span>
                                <span class="pull-right-container"><i class="fa fa-angle-left pull-right"></i></span>
                            </a>
                            <ul class="treeview-menu">
                            	<li class="<?=active_link_function('add_judge')?>"><a href="<?php echo site_url('admin/courts/index'); ?>"><i class="fa fa-list"></i><?php echo lang('menu_courts_list'); ?></a></li>
                                <li class="<?=active_link_function('add_judge')?>"><a href="<?php echo site_url('admin/courts/judges'); ?>"><i class="fa fa-list"></i><?php echo lang('menu_judge'); ?></a></li>
                                <li class="<?=active_link_function('add_designation')?>"><a href="<?php echo site_url('admin/courts/designations'); ?>"><i class="fa fa-list"></i><?php echo lang('menu_desgn'); ?></a></li>
                            </ul>
                        </li>
                        
                        <li class="treeview <?=active_link_controller('users')?><?=active_link_controller('groups')?>">
                            <a href="#">
                                <i class="fa fa-users"></i><span><?php echo lang('menu_users'); ?></span>
                                <span class="pull-right-container"><i class="fa fa-angle-left pull-right"></i></span>
                            </a>
                            <ul class="treeview-menu">
                                <li class="<?=active_link_controller('users')?>"><a href="<?php echo site_url('admin/users'); ?>"><i class="fa fa-list"></i><?php echo lang('menu_users_list'); ?></a></li>
                                <li class="<?=active_link_function('users')?>"><a href="<?php echo site_url('admin/users/districts'); ?>"><i class="fa fa-list"></i><?php echo lang('menu_users_districts'); ?></a></li>
                                <li class="<?=active_link_controller('groups')?>"><a href="<?php echo site_url('admin/groups'); ?>"><i class="fa fa-shield"></i><?php echo lang('menu_security_groups'); ?></a></li>
                            </ul>
                        </li>

                        <li class="treeview <?=active_link_controller('districts')?>">
                            <a href="#">
                                <i class="fa fa-map-marker"></i><span><?php echo lang('menu_districts'); ?></span>
                                <span class="pull-right-container"><i class="fa fa-angle-left pull-right"></i></span>
                            </a>
                            <ul class="treeview-menu">
                            	<li class="<?=active_link_function('index')?>"><a href="<?php echo site_url('admin/districts');?>"><i class="fa fa-list"></i><?php echo lang('menu_city_list'); ?></a></li>
                            	<li class="<?=active_link_function('add')?>"><a href="<?php echo site_url('admin/districts/add');?>"><i class="fa fa-plus-square"></i><?php echo lang('menu_city_add'); ?></a></li>
                            </ul>
                        </li>
                        
                        <li class="treeview <?=active_link_controller('category')?>">
                            <a href="#">
                                <i class="fa fa-bars"></i><span><?php echo lang('menu_category'); ?></span>
                                <span class="pull-right-container"><i class="fa fa-angle-left pull-right"></i></span>
                            </a>
                            <ul class="treeview-menu">
                            	<li class="<?=active_link_function('index')?>"><a href="<?php echo site_url('admin/category');?>"><i class="fa fa-list"></i><?php echo lang('menu_category_list'); ?></a></li>
                            	<li class="<?=active_link_function('add')?>"><a href="<?php echo site_url('admin/category/add');?>"><i class="fa fa-plus-square"></i><?php echo lang('menu_category_add'); ?></a></li>
                            </ul>
                            
                            <ul class="treeview-menu">
                            	<li class="<?=active_link_function('njp_categories')?>"><a href="<?php echo site_url('admin/category/njp_categories');?>"><i class="fa fa-list"></i><?php echo lang('menu_njp_cats'); ?></a></li>
                            	<li class="<?=active_link_function('njp_category_add')?>"><a href="<?php echo site_url('admin/category/njp_category_add');?>"><i class="fa fa-plus-square"></i><?php echo lang('menu_njp_cat_add'); ?></a></li>
                            </ul>
                            
                            <ul class="treeview-menu">
                            	<li class="<?=active_link_function('monthly_categories')?>"><a href="<?php echo site_url('admin/category/monthly_categories');?>"><i class="fa fa-list"></i><?php echo lang('menu_monthly_cats'); ?></a></li>
                            	<li class="<?=active_link_function('monthly_category_add')?>"><a href="<?php echo site_url('admin/category/monthly_category_add');?>"><i class="fa fa-plus-square"></i><?php echo lang('menu_monthly_cat_add'); ?></a></li>
                            </ul>
                            
                        </li>
                        
                         <li class="treeview <?=active_link_controller('heads')?>">
                            <a href="#">
                                <i class="fa fa-bars"></i><span><?php echo "Headings"; ?></span>
                                <span class="pull-right-container"><i class="fa fa-angle-left pull-right"></i></span>
                            </a>
                            <ul class="treeview-menu">
                            	<li class="<?=active_link_function('index')?>"><a href="<?php echo site_url('admin/heads');?>"><i class="fa fa-list"></i><?php echo "List"; ?></a></li>
                            	<li class="<?=active_link_function('add')?>"><a href="<?php echo site_url('admin/heads/add');?>"><i class="fa fa-plus-square"></i><?php echo "Add headings"; ?></a></li>
                            </ul>
                        </li>
            
                        <li class="header text-uppercase"><?php echo $title; ?></li>
                    </ul>
                </section>
            </aside>
