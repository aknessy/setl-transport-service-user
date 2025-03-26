<!-- leftbar-tab-menu -->
<div class="startbar d-print-none">
     <!--start brand-->
     <div class="brand">
          <a href="<?=base_url()?>" class="logo">
               <span>
                    <img src="<?=base_url()?>assets/images/logo-sm.png" alt="logo-small" class="logo-sm">
               </span>

          </a>
     </div>
     <!--end brand-->
     <!--start startbar-menu-->
     <div class="startbar-menu">
          <div class="startbar-collapse" id="startbarCollapse" data-simplebar>
               <div class="d-flex align-items-start flex-column w-100">
                    <!-- Navigation -->
                    <ul class="navbar-nav mb-auto w-100">
                         <li class="menu-label pt-0 mt-0">
                              <!-- <small class="label-border">
                                <div class="border_left hidden-xs"></div>
                                <div class="border_right"></div>
                            </small> -->
                              <span>Main Menu</span>
                         </li>
                         <li class="nav-item">
                              <a class="nav-link <? echo ($this->uri->segment(1)=='dashboard') ? 'active' : ''; ?>"
                                   href="<?=base_url('dashboard')?>">
                                   <i class="iconoir-home-simple menu-icon"></i>
                                   <span>Dashboard</span>
                              </a>
                         </li>

                         <?php if(in_array('roles', $features) || $this->session->usertype == "Super Admin"){ ?>
                         <li class="menu-label pt-0 mt-2">
                              <span>Acccounting</span>
                         </li>

                         <li class="nav-item <?=($this->uri->segment(1)=='invoicing') ? 'active' : ''; ?>">
                              <a class="nav-link <?=($this->uri->segment(1)=='invoicing') ? 'active' : ''; ?>"
                                   href="<?=base_url('invoicing')?>" aria-expanded="false">
                                   <i class="las la-file-invoice-dollar menu-icon"></i>
                                   <span>Invoices</span>
                              </a>
                         </li>

                         <li class="menu-label pt-0 mt-2">
                              <span>Role Management</span>
                         </li>

                         <li class="nav-item <?=($this->uri->segment(1)=='roles') ? 'active' : ''; ?>">
                              <a class="nav-link <?=($this->uri->segment(1)=='roles') ? 'active' : ''; ?>"
                                   href="<?=base_url('roles')?>" aria-expanded="false">
                                   <i class="iconoir-shield menu-icon"></i>
                                   <span>Roles & Permissions</span>
                              </a>
                         </li>

                         <?php 
                    }

                    if(in_array('staff', $features) || $this->session->usertype == "Super Admin"){ ?>

                         <li class="menu-label pt-0 mt-2">
                              <span>Staff Management</span>
                         </li>

                         <li class="nav-item <? echo ($this->uri->segment(1)=='staff') ? 'active' : ''; ?>">
                              <a class="nav-link <? echo ($this->uri->segment(1)=='staff') ? 'active' : ''; ?>"
                                   href="<?=base_url('staff')?>" aria-expanded="false">
                                   <i class="iconoir-user-star menu-icon"></i>
                                   <span class=" ">Staff Management</span>
                              </a>
                         </li>
                         <li class="nav-item <? echo ($this->uri->segment(1)=='drivers') ? 'active' : ''; ?>">
                              <a class="nav-link <? echo ($this->uri->segment(1)=='drivers') ? 'active' : ''; ?>"
                                   href="<?=base_url('drivers')?>" aria-expanded="false">
                                   <i class="las la-snowboarding menu-icon"></i>
                                   <span class=" ">Driver Management</span>
                              </a>
                         </li>
                         <?php 
                } 
                
                if($this->session->usertype == 'Super Admin'):
                    $seats_uri_arr = ['view_bus_seat', 'bus', 'edit_bus_seat'];
                ?>

                         <li class="menu-label pt-0 mt-2">
                              <span>Operator</span>
                         </li>
                         <li class="nav-item">
                              <a class="nav-link <?=($this->uri->segment(1)=='buses') ? 'active collapsed ' : ''; ?>"
                                   href="#busOperator" aria-expanded="false" data-bs-toggle="collapse" role="button"
                                   aria-controls="busOperator">
                                   <i class="iconoir-cube-bandage menu-icon"></i>
                                   <span>Bus Management</span>
                              </a>
                              <div id="busOperator"
                                   class="collapse <?=($this->uri->segment(1)=='buses' || $this->uri->segment(1)=='seats') ? 'show' : ''; ?>">
                                   <ul class="nav flex-column">
                                        <li
                                             class="nav-item <?=($this->uri->segment(1)=='buses' && $this->uri->segment(2) == 'buses') ? 'active':''?>">
                                             <a class="nav-link <?=($this->uri->segment(1)=='buses' && $this->uri->segment(2) == 'buses') ? 'active':''?>"
                                                  href="<?=base_url('buses')?>">Buses</a>
                                        </li>
                                        <li
                                             class="nav-item <?=($this->uri->segment(1)=='terminals' && (NULL == $this->uri->segment(2))) ? 'active':''?>">
                                             <a class="nav-link <?=($this->uri->segment(1)=='terminals' && (NULL != $this->uri->segment(2))) ? 'active':''?>"
                                                  href="<?=base_url('terminals')?>">Terminals</a>
                                        </li>
                                        <li
                                             class="nav-item <?=($this->uri->segment(1)=='seats' && (NULL == $this->uri->segment(2))) ? 'active':''?>">
                                             <a class="nav-link <?=($this->uri->segment(1)=='seats' && in_array($this->uri->segment(2), $seats_uri_arr)) ? 'active':''?>"
                                                  href="<?=base_url('seats')?>">Seats</a>
                                        </li>
                                        <li
                                             class="nav-item <?=($this->uri->segment(1)=='trips' && (NULL == $this->uri->segment(2))) ? 'active':''?>">
                                             <a class="nav-link <?=($this->uri->segment(1)=='trips') ? 'active':''?>"
                                                  href="<?=base_url('trips')?>">Trips</a>
                                        </li>
                                   </ul>
                              </div>
                         </li>
                         <?php
                endif;

                if(in_array('staff', $features) || $this->session->usertype == 'Super Admin'):
                    $booking_uri_segments = ['bookings'];
                ?>
                         <li class="nav-item">
                              <a class="nav-link <?=in_array($this->uri->segment(1), $booking_uri_segments) ? 'active collapsed ' : ''; ?>"
                                   href="#bookingOperator" aria-expanded="false" data-bs-toggle="collapse" role="button" aria-controls="busOperator">
                                   <i class="las la-chair menu-icon"></i>
                                   <span>Booking Management</span>
                              </a>
                              <div id="bookingOperator" class="collapse <?=($this->uri->segment(1)=='bookings') ? 'show' : ''; ?>">
                                   <ul class="nav flex-column">
                                        <li class="nav-item <?=($this->uri->segment(1)=='bookings' && (NULL==$this->uri->segment(2))) ? 'active':''?>">
                                             <a class="nav-link <?=($this->uri->segment(1)=='bookings' && (NULL==$this->uri->segment(2))) ? 'active':''?>"
                                                  href="<?=base_url('bookings')?>">Bookings</a>
                                        </li>
                                        <li class="nav-item <?=($this->uri->segment(1)=='bookings' && $this->uri->segment(2) == 'reserve') ? 'active':''?>">
                                             <a class="nav-link <?=($this->uri->segment(1)=='bookings' && $this->uri->segment(2) == 'reserve') ? 'active':''?>"
                                                  href="<?=base_url('bookings/reserve')?>">Bus Reservation</a>
                                        </li>
                                   </ul>
                              </div>
                         </li>

                         <li class="nav-item">
                              <a class="nav-link <?=$this->uri->segment(1) == 'tfare' ? 'active collapsed ' : ''; ?>"
                                   href="#FareOperator" aria-expanded="false" data-bs-toggle="collapse" role="button"
                                   aria-controls="busOperator">
                                   <i class="las la-coins menu-icon"></i>
                                   <span>Fare Management</span>
                              </a>
                              <div id="FareOperator"
                                   class="collapse <?=($this->uri->segment(1)=='tfare') ? 'show' : ''; ?>">
                                   <ul class="nav flex-column">
                                        <li
                                             class="nav-item <?=($this->uri->segment(1)=='tfare' && (NULL==$this->uri->segment(2))) ? 'active':''?>">
                                             <a class="nav-link <?=($this->uri->segment(1)=='tfare' && (NULL==$this->uri->segment(2))) ? 'active':''?>"
                                                  href="<?=base_url('tfare')?>">Transportation Fare</a>
                                        </li>
                                        <li
                                             class="nav-item <?=($this->uri->segment(1)=='tfare' && $this->uri->segment(2) == 'discounts') ? 'active':''?>">
                                             <a class="nav-link <?=($this->uri->segment(1)=='tfare' && $this->uri->segment(2) == 'discounts') ? 'active':''?>"
                                                  href="<?=base_url('tfare/discounts')?>">Disounts</a>
                                        </li>
                                   </ul>
                              </div>
                         </li>
                         <?php
                endif;
                ?>

               </div>
          </div>
          <!--end startbar-collapse-->
     </div>
     <!--end startbar-menu-->
</div>
<!--end startbar-->
<div class="startbar-overlay d-print-none"></div>
<!-- end leftbar-tab-menu-->
<div class="page-wrapper">

     <!-- Page Content-->
     <div class="page-content">