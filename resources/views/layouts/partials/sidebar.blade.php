<div class="nk-sidebar nk-sidebar-fixed " data-content="sidebarMenu">
    @php
        $user = Auth::user();
    @endphp
    <div class="nk-sidebar-element nk-sidebar-head">
        <div class="nk-sidebar-brand">
            <a href="/" class="logo-link nk-sidebar-logo">
                <img class="logo-light logo-img" src="/images/logo.png" srcset="/images/logo2x.png 2x" alt="logo">
                <img class="logo-dark logo-img" src="/images/logo-dark.png" srcset="/images/logo-dark2x.png 2x" alt="logo-dark">
                <span class="nio-version">v1.0</span>
            </a>
        </div>
        <div class="nk-menu-trigger me-n2">
            <a href="#" class="nk-nav-toggle nk-quick-nav-icon d-xl-none" data-target="sidebarMenu"><em class="icon ni ni-arrow-left"></em></a>
        </div>
    </div><!-- .nk-sidebar-element -->
    <div class="nk-sidebar-element">
        <div class="nk-sidebar-body" data-simplebar>
            <div class="nk-sidebar-content">
                <div class="nk-sidebar-widget d-none d-xl-block">
                    <div class="user-account-info between-center">
                        <div class="user-account-main">
                            <h6 class="overline-title-alt">Wallet Balance</h6>
                            <div class="user-balance">{{ number_format($user->wallet->balance, 2) }} <small class="currency currency-btc">NGN</small></div>
                            <div class="user-balance-alt">{{ number_format($user->wallet->ledger, 2) }} <span class="currency currency-btc">NGN</span></div>
                        </div>
                        <a href="#" class="btn btn-white btn-icon btn-light"><em class="icon ni ni-line-chart"></em></a>
                    </div>
                    <ul class="user-account-data gy-1">
                        
                        <li>
                            <div class="user-account-label">
                                <span class="sub-text">Deposit in orders</span>
                            </div>
                            <div class="user-account-value">
                                <span class="sub-text">{{ number_format($user->wallet->ledger, 2) }} <span class="currency currency-nio">NGN</span></span>
                            </div>
                        </li>
                    </ul>
                    <div class="user-account-actions">
                        <ul class="g-3">
                            <li><a href="{{ route('deposit.index') }}" class="btn btn-lg btn-primary"><span>Deposit</span></a></li>
                            <li><a href="{{ route('withdraw.index') }}" class="btn btn-lg btn-warning"><span>Withdraw</span></a></li>
                        </ul>
                    </div>
                </div><!-- .nk-sidebar-widget -->
                <div class="nk-sidebar-widget nk-sidebar-widget-full d-xl-none pt-0">
                    <a class="nk-profile-toggle toggle-expand" data-target="sidebarProfile" href="#">
                        <div class="user-card-wrap">
                            <div class="user-card">
                                <div class="user-avatar">
                                    <span>{{ $user->initials() }}</span>
                                </div>
                                <div class="user-info">
                                    <span class="lead-text">{{ $user->name }}</span>
                                    <span class="sub-text">{{ $user->email ?? $user->phone }}</span>
                                </div>
                                <div class="user-action">
                                    <em class="icon ni ni-chevron-down"></em>
                                </div>
                            </div>
                        </div>
                    </a>
                    <div class="nk-profile-content toggle-expand-content" data-content="sidebarProfile">
                        <div class="user-account-info between-center">
                            <div class="user-account-main">
                                <h6 class="overline-title-alt">Wallet Balance</h6>
                                <div class="user-balance">{{ number_format($user->wallet->balance, 2) }} <small class="currency currency-btc">NGN</small></div>
                                <div class="user-balance-alt">{{ number_format($user->wallet->ledger, 2) }} <span class="currency currency-btc">NGN</span></div>
                            </div>
                            <a href="#" class="btn btn-white btn-icon btn-light"><em class="icon ni ni-line-chart"></em></a>
                        </div>
                        <ul class="user-account-data gy-1">
                            
                            <li>
                                <div class="user-account-label">
                                    <span class="sub-text">Deposit in orders</span>
                                </div>
                                <div class="user-account-value">
                                    <span class="sub-text">{{ number_format($user->wallet->ledger, 2) }} <span class="currency currency-nio">NGN</span></span>
                                </div>
                            </li>
                        </ul>
                        <ul class="user-account-links">
                            <li><a href="{{ route('withdraw.index') }}" class="link"><span>Withdraw Funds</span> <em class="icon ni ni-wallet-out"></em></a></li>
                            <li><a href="{{ route('deposit.index') }}" class="link"><span>Deposit Funds</span> <em class="icon ni ni-wallet-in"></em></a></li>
                        </ul>
                        <ul class="link-list">
                            <li><a href="#coming-soon"><em class="icon ni ni-user-alt"></em><span>View Profile</span></a></li>
                            <li><a href="#coming-soon"><em class="icon ni ni-setting-alt"></em><span>Account Setting</span></a></li>
                            <li><a href="#coming-soon"><em class="icon ni ni-activity-alt"></em><span>Login Activity</span></a></li>
                        </ul>
                        @include('components.logout')
                    </div>
                </div><!-- .nk-sidebar-widget -->
                <div class="nk-sidebar-menu">
                    <!-- Menu -->
                    <ul class="nk-menu">
                        <li class="nk-menu-heading">
                            <h6 class="overline-title">Menu</h6>
                        </li>
                        <li class="nk-menu-item">
                            <a href="{{ route('dashboard') }}" class="nk-menu-link">
                                <span class="nk-menu-icon"><em class="icon ni ni-dashboard"></em></span>
                                <span class="nk-menu-text">Dashboard</span>
                            </a>
                        </li>
                        <li class="nk-menu-item">
                            <a href="{{ route('profile.show') }}" class="nk-menu-link">
                                <span class="nk-menu-icon"><em class="icon ni ni-user-c"></em></span>
                                <span class="nk-menu-text">My Account</span>
                            </a>
                        </li>
                        <li class="nk-menu-item">
                            <a href="{{ route('wallets.index') }}" class="nk-menu-link">
                                <span class="nk-menu-icon"><em class="icon ni ni-wallet-alt"></em></span>
                                <span class="nk-menu-text">My Wallet</span>
                            </a>
                        </li>
                        @hasrole('agent|rider|collection-hub')
                        <li class="nk-menu-item">
                            <a href="{{ route('recyclables.create') }}" class="nk-menu-link">
                                <span class="nk-menu-icon"><em class="icon ni ni-coins"></em></span>
                                <span class="nk-menu-text">Collect Recyclable</span>
                            </a>
                        </li>
                        @endhasrole
                        <li class="nk-menu-item">
                            <a href="{{ route('transactions.index') }}" class="nk-menu-link">
                                <span class="nk-menu-icon"><em class="icon ni ni-repeat"></em></span>
                                <span class="nk-menu-text">Transactions</span>
                            </a>
                        </li>
                        <li class="nk-menu-item">
                            <a href="#coming-soon" class="nk-menu-link">
                                <span class="nk-menu-icon"><em class="icon ni ni-chat-circle"></em></span>
                                <span class="nk-menu-text">Messages</span>
                            </a>
                        </li>

                        <li class="nk-menu-item has-sub">
                            <a href="#" class="nk-menu-link nk-menu-toggle">
                                <span class="nk-menu-icon"><em class="icon ni ni-files"></em></span>
                                <span class="nk-menu-text">Miscellaneous</span>
                            </a>
                            <ul class="nk-menu-sub">
                                <li class="nk-menu-item">
                                    <a href="#coming-soon" class="nk-menu-link"><span class="nk-menu-text">Self Help</span></a>
                                </li>
                                <li class="nk-menu-item">
                                    <a href="#coming-soon" class="nk-menu-link"><span class="nk-menu-text">KYC - Get Started</span></a>
                                </li>
                                <li class="nk-menu-item">
                                    <a href="#coming-soon" class="nk-menu-link"><span class="nk-menu-text">Become Agent - Application Form</span></a>
                                </li>
                            </ul><!-- .nk-menu-sub -->
                        </li><!-- .nk-menu-item -->
                        
                    </ul><!-- .nk-menu -->
                </div><!-- .nk-sidebar-menu -->
                <div class="nk-sidebar-widget">
                    <div class="widget-title">
                        <h6 class="overline-title">SRS Wallets Overview <span>(2)</span></h6>
                    </div>
                    <ul class="wallet-list">
                        <li class="wallet-item">
                            <a href="#">
                                <div class="wallet-icon"><em class="icon ni ni-sign-kobo"></em></div>
                                <div class="wallet-text">
                                    <h6 class="wallet-name">Main Balance</h6>
                                    <span class="wallet-balance">{{ number_format($user->wallet->balance, 2) }} <span class="currency currency-nio">NGN</span></span>
                                </div>
                            </a>
                        </li>
                        <li class="wallet-item">
                            <a href="#">
                                <div class="wallet-icon"><em class="icon ni ni-sign-kobo"></em></div>
                                <div class="wallet-text">
                                    <h6 class="wallet-name">Ledger Balance</h6>
                                    <span class="wallet-balance">{{ number_format($user->wallet->ledger, 2) }} <span class="currency currency-btc">NGN</span></span>
                                </div>
                            </a>
                        </li>
                    </ul>
                </div><!-- .nk-sidebar-widget -->
                <div class="nk-sidebar-footer">
                    <ul class="nk-menu nk-menu-footer">
                        <li class="nk-menu-item">
                            <a href="#" class="nk-menu-link">
                                <span class="nk-menu-icon"><em class="icon ni ni-help-alt"></em></span>
                                <span class="nk-menu-text">Support</span>
                            </a>
                        </li>
                        <li class="nk-menu-item ms-auto">
                            <div class="dropup">
                                <a href="" class="nk-menu-link dropdown-indicator has-indicator" data-bs-toggle="dropdown" data-offset="0,10">
                                    <span class="nk-menu-icon"><em class="icon ni ni-globe"></em></span>
                                    <span class="nk-menu-text">English</span>
                                </a>
                                <div class="dropdown-menu dropdown-menu-sm dropdown-menu-end">
                                    <ul class="language-list">
                                        <li>
                                            <a href="#" class="language-item">
                                                <img src="/images/flags/english.png" alt="" class="language-flag">
                                                <span class="language-name">English</span>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="#" class="language-item">
                                                <img src="/images/flags/spanish.png" alt="" class="language-flag">
                                                <span class="language-name">Español</span>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="#" class="language-item">
                                                <img src="/images/flags/french.png" alt="" class="language-flag">
                                                <span class="language-name">Français</span>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="#" class="language-item">
                                                <img src="/images/flags/turkey.png" alt="" class="language-flag">
                                                <span class="language-name">Türkçe</span>
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </li>
                    </ul><!-- .nk-footer-menu -->
                </div><!-- .nk-sidebar-footer -->
            </div><!-- .nk-sidebar-content -->
        </div><!-- .nk-sidebar-body -->
    </div><!-- .nk-sidebar-element -->
</div>