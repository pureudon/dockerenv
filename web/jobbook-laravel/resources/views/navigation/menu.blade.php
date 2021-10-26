<!-- menu nav -->
<nav>
<nav id="sidebar-nav">
    <ul class="nav nav-pills nav-stacked">
    @if (isset($menu))
        @if(false)
        <li class="{{ ($menu=='dashboard') ? 'selected' : '' }}"><a href="{{ route('company.index') }}" {{ (false) ? 'target="_blank"' : '' }}>{{ __('Dashboard') }}</a></li>
        @endif
        @if(true)
        <li class="{{ ($menu=='quotation') ? 'selected' : '' }}"><a href="{{ route('company.index') }}" {{ (false) ? 'target="_blank"' : '' }}>{{ __('Quotation') }}</a></li>
        @endif
        @if(true)
        <li class="{{ ($menu=='order') ? 'selected' : '' }}"><a href="{{ route('company.index') }}" {{ (false) ? 'target="_blank"' : '' }}>{{ __('Order') }}</a></li>
        @endif
        @if(true)
        <li class="{{ ($menu=='delivery') ? 'selected' : '' }}"><a href="{{ route('company.index') }}" {{ (false) ? 'target="_blank"' : '' }}>{{ __('Delivery') }}</a></li>
        @endif
        @if(true)
        <li class="{{ ($menu=='collection') ? 'selected' : '' }}"><a href="{{ route('company.index') }}" {{ (false) ? 'target="_blank"' : '' }}>{{ __('Collection') }}</a></li>
        @endif
        @if(true)
        <li class="{{ ($menu=='inventory') ? 'selected' : '' }}"><a href="{{ route('company.index') }}" {{ (false) ? 'target="_blank"' : '' }}>{{ __('Inventory') }}</a></li>
        @endif
        @if(true)
        <li class="{{ ($menu=='price') ? 'selected' : '' }}"><a href="{{ route('company.index') }}" {{ (false) ? 'target="_blank"' : '' }}>{{ __('Price') }}</a></li>
        @endif
        @if(true)
        <li class="{{ ($menu=='invoice') ? 'selected' : '' }}"><a href="{{ route('invoice.index') }}" {{ (false) ? 'target="_blank"' : '' }}>{{ __('Invoice') }}</a></li>
        @endif
        @if(true)
        <li class="{{ ($menu=='products') ? 'selected' : '' }}"><a href="{{ route('company.index') }}" {{ (false) ? 'target="_blank"' : '' }}>{{ __('Products') }}</a></li>
        @endif
        @if(true)
        <li class="{{ ($menu=='services') ? 'selected' : '' }}"><a href="{{ route('company.index') }}" {{ (false) ? 'target="_blank"' : '' }}>{{ __('Services') }}</a></li>
        @endif
        @if(true)
        <li class="{{ ($menu=='customers') ? 'selected' : '' }}"><a href="{{ route('company.index') }}" {{ (false) ? 'target="_blank"' : '' }}>{{ __('Customers') }}</a></li>
        @endif
    @else
        <li ><a href='#'>Empty</a></li>
    @endif
    
    <li class="{{ ($menu=='jobbookprofile') ? 'selected' : '' }}"><a href="{{ route('jobbookprofile.index') }}">{{ auth()->user()->name }}</a></li>
    <li >
        <form method="POST" action="{{ route('logout') }}">
        @csrf
        <a class="" href="{{ route('logout') }}" onclick="event.preventDefault();
        this.closest('form').submit();">{{ __('Logout') }}</a>
        </form>
    </li>

    </ul>
</nav>
</nav>
<section id="navspace">
    <br>
</section>