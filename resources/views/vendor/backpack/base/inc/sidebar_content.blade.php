<!-- This file is used to store sidebar items, starting with Backpack\Base 0.9.0 -->
<li class="nav-item"><a class="nav-link" href="{{ backpack_url('dashboard') }}"><i class="la la-home nav-icon"></i> {{ trans('backpack::base.dashboard') }}</a></li>
<!-- Users, Roles, Permissions -->
<li class="nav-item nav-dropdown">
    <a class="nav-link nav-dropdown-toggle" href="#"><i class="nav-icon la la-users"></i> Authentication</a>
    <ul class="nav-dropdown-items">
        <li class="nav-item"><a class="nav-link" href="{{ backpack_url('user') }}"><i class="nav-icon la la-user"></i> <span>Users</span></a></li>
        <li class="nav-item"><a class="nav-link" href="{{ backpack_url('role') }}"><i class="nav-icon la la-id-badge"></i> <span>Roles</span></a></li>
        <li class="nav-item"><a class="nav-link" href="{{ backpack_url('permission') }}"><i class="nav-icon la la-key"></i> <span>Permissions</span></a></li>
    </ul>
</li>


@includeWhen(class_exists(\Backpack\DevTools\DevToolsServiceProvider::class), 'backpack.devtools::buttons.sidebar_item')

<li class='nav-item'><a class='nav-link' href='{{ backpack_url('wallet') }}'><i class='nav-icon la la-wallet'></i> Wallets</a></li>
<li class='nav-item'><a class='nav-link' href='{{ backpack_url('transaction') }}'><i class='nav-icon la la-credit-card'></i> Transactions</a></li> <!--briefcase for pricing -->
<li class='nav-item'><a class='nav-link' href='{{ backpack_url('recyclable-type') }}'><i class='nav-icon la la-tags'></i> Recyclable Types</a></li>
<li class='nav-item'><a class='nav-link' href='{{ backpack_url('recyclable') }}'><i class='nav-icon la la-cubes'></i> Recyclables</a></li>
<li class='nav-item'><a class='nav-link' href='{{ backpack_url('recyclable-price') }}'><i class='nav-icon la la-briefcase'></i> Recyclable Prices</a></li>
<li class='nav-item'><a class='nav-link' href='{{ backpack_url('setting') }}'><i class='nav-icon la la-cog'></i> <span>Settings</span></a></li>
<li class='nav-item'><a class='nav-link' href='{{ backpack_url('backup') }}'><i class='nav-icon la la-hdd-o'></i> Backups</a></li>
<li class='nav-item'><a class='nav-link' href='{{ backpack_url('location') }}'><i class='nav-icon la la-map-marker'></i> Locations</a></li>