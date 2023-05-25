<ul class="link-list">
    <form method="POST" action="{{ route('logout') }}">
        @csrf

        <li><a href="{{ route('logout') }}"
                onclick="event.preventDefault();
               this.closest('form').submit();"><em
                    class="icon ni ni-signout"></em><span>Sign out</span></a></li>
    </form>
</ul>