<div class="logo">
    <a href="#">
        <img src="{{ asset('asset/images/logo/JIIPE_SEZ_Logo.png') }}" alt="Cms" loading="lazy" decoding="async"/>
    </a>
</div>
<div class="headerinner">
    <ul class="headmenu">
        <li>
            <a class="dropdown-toggle" href="#">
                <span class="head-icon fa fa-phone"></span>
                <span class="headmenu-label">Contact Us</span>
            </a>
        </li>f
        <li class="right">
            <div class="userloggedinfo">
                <div class="userinfo">
                    <h5>{{ auth()->user()->name ?? 'Admin' }} <small>-
                            {{ auth()->user()->name ?? 'Admin' }}</small></h5>
                    <ul>
                        <li>
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button type="submit" class="text-red-600 hover:underline">
                                    Logout
                                </button>
                            </form>

                        </li>
                    </ul>
                </div>
            </div>
        </li>
    </ul><!-- headmenu -->
</div>