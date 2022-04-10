<div class="app-sidebar__overlay" data-toggle="sidebar"></div>
<aside class="app-sidebar">

    <div class="app-sidebar__user">
        <div class="avatar-box">
            <img class="app-sidebar__user-avatar" src="{{asset('س.jpg')}}" style="size:20px;"alt="User Image">
        </div>
        <div>
            <p class="app-sidebar__user-name">{{ auth()->user()->full_name }}</p>
            <p class="app-sidebar__user-name" style="font-size: 14px; color: #f2f2f2">{{ auth()->user()->is_admin == 1 ? "Admin" : (auth()->user()->role ? auth()->user()->role->name : null)}}</p>
        </div>
    </div>
    <ul class="app-menu">
        @if(hasPermissions("view-dashboard"))
        <li><a class="app-menu__item @if(request()->routeIs("dashboard.index")) active @endif" href="{{route("dashboard.index",app()->getLocale())}}"><i class="app-menu__icon fas fa-tachometer-alt"></i><span class="app-menu__label">{{__('Dashboard')}}</span></a></li>
        @endif
        @if(hasPermissions(["create-branch-category" ,"edit-branch-category", "delete-branch-category"]))
            <li class="treeview @if(request()->routeIs("categories_branches.*")) is-expanded @endif"><a class="app-menu__item" href="#" data-toggle="treeview"><i class="app-menu__icon fas fa-list"></i><span class="app-menu__label">{{__('Categories Branches')}}</span><i class="treeview-indicator fa fa-angle-right"></i></a>
                <ul class="treeview-menu">
                    @if(hasPermissions("create-branch-category"))
                        <li><a class="treeview-item @if(request()->routeIs("categories_branches.create")) active @endif" href="{{ route("categories_branches.create",app()->getLocale()) }}"><i class="icon fa fa-circle-o"></i> {{__('Create New Category')}}</a></li>
                    @endif
                    <li><a class="treeview-item @if(request()->routeIs("categories_branches.index")) active @endif" href="{{ route("categories_branches.index",app()->getLocale()) }}"><i class="icon fa fa-circle-o"></i> {{__('All Categories')}}</a></li>
                </ul>
            </li>
        @endif
        @if(hasPermissions(["create-branch" ,"edit-branch", "delete-branch", "control-sliders-branches"]))
        <li class="treeview @if(request()->routeIs("branches.*")) is-expanded @endif"><a class="app-menu__item" href="#" data-toggle="treeview"><i class="app-menu__icon fas fa-store"></i><span class="app-menu__label">{{__('Branches')}}</span><i class="treeview-indicator fa fa-angle-right"></i></a>
            <ul class="treeview-menu">
                @if(hasPermissions("create-branch"))
                <li><a class="treeview-item @if(request()->routeIs("branches.create")) active @endif" href="{{ route("branches.create",app()->getLocale())}}"><i class="icon fa fa-circle-o"></i>{{__('Create New Branch')}} </a></li>
                @endif
                <li><a class="treeview-item @if(request()->routeIs("branches.index")) active @endif" href="{{ route("branches.index",app()->getLocale()) }}"><i class="icon fa fa-circle-o"></i>{{__('All Branches')}} </a></li>
            </ul>
        </li>
        @endif
        @if(hasPermissions(["create-category" ,"edit-category", "delete-category"]))
        <li class="treeview @if(request()->routeIs("categories.*")) is-expanded @endif"><a class="app-menu__item" href="#" data-toggle="treeview"><i class="app-menu__icon fas fa-list"></i><span class="app-menu__label">{{__('Categories')}}</span><i class="treeview-indicator fa fa-angle-right"></i></a>
            <ul class="treeview-menu">
                @if(hasPermissions("create-category"))
                <li><a class="treeview-item @if(request()->routeIs("categories.create")) active @endif" href="{{ route("categories.create",app()->getLocale()) }}"><i class="icon fa fa-circle-o"></i>{{__('Create New Category')}} </a></li>
                @endif
                <li><a class="treeview-item @if(request()->routeIs("categories.index")) active @endif" href="{{ route("categories.index",app()->getLocale()) }}"><i class="icon fa fa-circle-o"></i> {{__('All Categories')}}</a></li>
            </ul>
        </li>
        @endif

        @if(hasPermissions(["create-items" ,"edit-items", "delete-items"]))
        <li class="treeview @if(request()->routeIs("items.*")) is-expanded @endif"><a class="app-menu__item" href="#" data-toggle="treeview"><i class="app-menu__icon fas fa-tags"></i><span class="app-menu__label">{{__('Items')}}</span><i class="treeview-indicator fa fa-angle-right"></i></a>
            <ul class="treeview-menu">
                @if(hasPermissions("create-items"))
                <li><a class="treeview-item @if(request()->routeIs("items.create")) active @endif" href="{{ route("items.create",app()->getLocale()) }}"><i class="icon fa fa-circle-o"></i> {{__('Create New Items')}}</a></li>
                @endif
                <li><a class="treeview-item @if(request()->routeIs("items.index")) active @endif" href="{{ route("items.index",app()->getLocale()) }}"><i class="icon fa fa-circle-o"></i>{{__('All Items')}} </a></li>
            </ul>
        </li>
        @endif

        @if(hasPermissions(["create-offers" ,"edit-offers", "delete-offers"]))
            <li class="treeview @if(request()->routeIs("offers.*")) is-expanded @endif"><a class="app-menu__item" href="#" data-toggle="treeview"><i class="app-menu__icon fas fa-hand-holding-usd"></i><span class="app-menu__label">{{__('Offers')}}</span><i class="treeview-indicator fa fa-angle-right"></i></a>
                <ul class="treeview-menu">
                    @if(hasPermissions("create-offers"))
                        <li><a class="treeview-item @if(request()->routeIs("offers.create")) active @endif" href="{{ route("offers.create",app()->getLocale()) }}"><i class="icon fa fa-circle-o"></i> {{__('Create New Offer')}}</a></li>
                    @endif
                    <li><a class="treeview-item @if(request()->routeIs("offers.index")) active @endif" href="{{ route("offers.index",app()->getLocale()) }}"><i class="icon fa fa-circle-o"></i>{{__('All Offers')}} </a></li>
                </ul>
            </li>
        @endif


        @if(hasPermissions(["create-services" ,"edit-services", "delete-services"]))
        <li class="treeview @if(request()->routeIs("services.*")) is-expanded @endif"><a class="app-menu__item" href="#" data-toggle="treeview"><i class="app-menu__icon fas fa-hand-sparkles"></i><span class="app-menu__label">{{__('Services')}}</span><i class="treeview-indicator fa fa-angle-right"></i></a>
                    <ul class="treeview-menu">

                         <li><a class="treeview-item @if(request()->routeIs("services.index")) active @endif" href="{{ route("services.index",app()->getLocale()) }}"><i class="icon fa fa-circle-o"></i> {{__('All Service')}}</a></li>

                        <li><a class="treeview-item @if(request()->routeIs("services.create")) active @endif" href="{{ route("services.create",app()->getLocale()) }}"><i class="icon fa fa-circle-o"></i>{{__('Create Service')}}</a></li>

                        <li><a class="treeview-item @if(request()->routeIs("services.link")) active @endif" href="{{ route("services.link",app()->getLocale()) }}"><i class="icon fa fa-circle-o"></i>{{__('Link Service with item')}}</a></li>

                    </ul>
        </li>
         @endif
        @if(hasPermissions(["create-slider" ,"edit-slider", "delete-slider"]))
        <li class="treeview @if(request()->routeIs("sliders.*")) is-expanded @endif"><a class="app-menu__item" href="#" data-toggle="treeview"><i class="app-menu__icon fas far fa-images"></i><span class="app-menu__label">{{__('Sliders')}}</span><i class="treeview-indicator fa fa-angle-right"></i></a>
            <ul class="treeview-menu">
                @if(hasPermissions("create-slider"))
                <li><a class="treeview-item @if(request()->routeIs("sliders.create")) active @endif" href="{{ route("sliders.create",app()->getLocale()) }}"><i class="icon fa fa-circle-o"></i> {{__('Create New Slider')}}</a></li>
                @endif
                <li><a class="treeview-item @if(request()->routeIs("sliders.index")) active @endif" href="{{ route("sliders.index",app()->getLocale()) }}"><i class="icon fa fa-circle-o"></i> {{__('All Sliders')}}</a></li>
            </ul>
        </li>
        @endif

            @if(hasPermissions("view-and-control-users-application"))
                <li class="treeview @if(request()->routeIs("users.*")) is-expanded @endif"><a class="app-menu__item" href="#"  data-toggle="treeview" ><i class="app-menu__icon  fas fa-user"></i><span class="app-menu__label">{{__('Users')}}</span><i class="treeview-indicator fa fa-angle-right"></i></a>
                    <ul class="treeview-menu">
                        <li><a class="treeview-item @if(request()->routeIs("users.app.index")) active @endif" href="{{route("users.app.index",[app()->getLocale()])}}"><i class="app-menu__icon fas fa-mobile-alt"></i><span class="app-menu__label">{{__('App Users')}}</span></a></li>
                        <li><a class="treeview-item  @if(request()->routeIs("users.driver.index")) active @endif" href="{{route("users.driver.index",app()->getLocale())}}"><i class="app-menu__icon fas fa-truck"></i><span class="app-menu__label">{{__('Driver Users')}}</span></a></li>
                        <li><a class="treeview-item @if(request()->routeIs("users.cashier.index")) active @endif" href="{{route("users.cashier.index",app()->getLocale())}}"><i class="app-menu__icon fas fa-calculator"></i><span class="app-menu__label">{{__('Cashier Users')}}</span></a></li>
                        <li><a class="treeview-item  @if(request()->routeIs("users.vendor.index")) active @endif" href="{{route("users.vendor.index",app()->getLocale())}}"><i class="h4">V</i><span class="app-menu__label">{{__('vendor Users')}}</span></a></li>


                    </ul>

                </li>
            @endif
{{--        @if(hasPermissions("view-and-control-users-application"))--}}
{{--        <li><a class="app-menu__item @if(request()->routeIs("users.app.index")) active @endif" href="{{route("users.app.index")}}"><i class="app-menu__icon fas fa-mobile-alt"></i><span class="app-menu__label">App Users</span></a></li>--}}
{{--        @endif--}}

        @if(hasPermissions("admin-control"))
        <li class="treeview @if(request()->routeIs("admins.*","roles.*")) is-expanded @endif"><a class="app-menu__item" href="#" data-toggle="treeview"><i class="app-menu__icon fas fa-users-cog"></i><span class="app-menu__label">{{__('Admins')}}</span><i class="treeview-indicator fa fa-angle-right"></i></a>
            <ul class="treeview-menu">

                <li><a class="treeview-item @if(request()->routeIs("admins.create")) active @endif" href="{{ route("admins.create",app()->getLocale()) }}"><i class="icon fa fa-circle-o"></i> {{__('Create New Admin')}}</a></li>
                <li><a class="treeview-item @if(request()->routeIs("admins.index")) active @endif" href="{{ route("admins.index",app()->getLocale()) }}"><i class="icon fa fa-circle-o"></i> {{__('All Admins')}}</a></li>
                <li><a class="treeview-item @if(request()->routeIs("roles.create")) active @endif" href="{{ route("roles.create",app()->getLocale()) }}"><i class="icon fa fa-circle-o"></i> {{__('Create New Roles')}}</a></li>
                <li><a class="treeview-item @if(request()->routeIs("roles.index")) active @endif" href="{{ route("roles.index",app()->getLocale()) }}"><i class="icon fa fa-circle-o"></i> {{__('Roles & Permissions')}}</a></li>

            </ul>
        </li>
        @endif
        @if(hasPermissions("view-orders"))
                <li class="treeview @if(request()->routeIs("orders.*")) is-expanded @endif"><a class="app-menu__item" href="#" data-toggle="treeview"><i class="app-menu__icon fas fa-users-cog"></i><span class="app-menu__label">{{__('Orders')}}</span><i class="treeview-indicator fa fa-angle-right"></i></a>
                                    <ul class="treeview-menu">

                            <li><a class="treeview-item @if(request()->routeIs("orders.index")) active @endif" href="{{ route("orders.index",app()->getLocale()) }}"><i class="icon fa fa-circle-o"></i>{{__('User Orders')}}</a></li>
                            <li><a class="treeview-item @if(request()->routeIs("orders.posOrders")) active @endif" href="{{ route("orders.posOrders",app()->getLocale()) }}"><i class="icon fa fa-circle-o"></i>{{__('Cashier Orders')}}</a></li>
                       </ul>
                </li>

        @endif

        @if(hasPermissions("control-and-edit-application-settings"))
           <li><a class="app-menu__item @if(request()->routeIs("settings.*")) active @endif" href="{{route("settings.index",app()->getLocale())}}"><i class="app-menu__icon fas fa-tools"></i><span class="app-menu__label">{{__('App Settings')}}</span></a></li>
        @endif


                        <ul class="treeview-menu">
                            @if(hasPermissions("create-delivery-price"))
                                <li><a class="treeview-item @if(request()->routeIs("delivery_price.create")) active @endif" href="{{ route("delivery_price.create") }}"><i class="icon fa fa-circle-o"></i> {{__('Add New Location')}}</a></li>
                            @endif
                            <li><a class="treeview-item @if(request()->routeIs("delivery_price.index")) active @endif" href="{{ route("delivery_price.index") }}"><i class="icon fa fa-circle-o"></i> {{__('View All Locations as a Table')}}</a></li>
                            <li><a class="treeview-item @if(request()->routeIs("delivery_price.tree")) active @endif" href="{{ route("delivery_price.tree") }}"><i class="icon fa fa-circle-o"></i> {{__('View All Locations as a Tree')}}</a></li>
                        </ul>



            @if(hasPermissions(["view-items-ordered-report", "view-users-ordered-report", "view-branches-sales-report"]))
                <li class="treeview @if(request()->routeIs("reports.*")) is-expanded @endif"><a class="app-menu__item" href="#" data-toggle="treeview"><i class="app-menu__icon fas fa-file-alt"></i><span class="app-menu__label">{{__('Reports')}}</span><i class="treeview-indicator fa fa-angle-right"></i></a>
                    <ul class="treeview-menu">

                        @if(hasPermissions("view-items-ordered-report"))
                        <li><a class="treeview-item @if(request()->routeIs("reports.items_count_order")) active @endif" href="{{ route("reports.items_count_order",app()->getLocale()) }}"><i class="icon fa fa-circle-o"></i>{{__('Items Ordered')}}</a></li>
                        @endif

                        @if(hasPermissions("view-users-ordered-report"))
                        <li><a class="treeview-item @if(request()->routeIs("reports.users_with_count_him_orders")) active @endif" href="{{ route("reports.users_with_count_him_orders",app()->getLocale()) }}"><i class="icon fa fa-circle-o"></i>{{__('Users Ordered')}}</a></li>
                        @endif

                        @if(hasPermissions("view-branches-sales-report"))
                        <li><a class="treeview-item @if(request()->routeIs("reports.branches_sales")) active @endif" href="{{ route("reports.branches_sales",app()->getLocale()) }}"><i class="icon fa fa-circle-o"></i> {{__('Branches Sales')}}</a></li>
                        @endif

                    </ul>
                </li>
            @endif



    </ul>
</aside>
