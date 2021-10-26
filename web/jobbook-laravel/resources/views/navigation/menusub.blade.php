<!-- menusub nav -->
<nav>
<nav id='nav2'>
    <ul>
    @if (isset($menu))
        @if ($menu=='quotation')
            <li class="{{ ($submenu=='dashboard') ? 'selected' : '' }}"><a href="{{ route('company.index') }}">{{ __('Dashboard') }}</a></li>
        @elseif ($menu=='quotation')    
            <li class="{{ ($submenu=='quotation') ? 'selected' : '' }}"><a href="{{ route('company.index') }}">{{ __('Quotation') }}</a></li>
            <li class="{{ ($submenu=='productquotation') ? 'selected' : '' }}"><a href="{{ route('company.index') }}">{{ __('ProductQuotation') }}</a></li>
            <li class="{{ ($submenu=='servicequotation') ? 'selected' : '' }}"><a href="{{ route('company.index') }}">{{ __('ServiceQuotation') }}</a></li>
        @elseif ($menu=='order')
            <li class="{{ ($submenu=='ordermemo') ? 'selected' : '' }}"><a href="{{ route('company.index') }}">{{ __('OrderMemo') }}</a></li>
            <li class="{{ ($submenu=='po') ? 'selected' : '' }}"><a href="{{ route('company.index') }}">{{ __('PurchaseOrder') }}</a></li>
            <li class="{{ ($submenu=='so') ? 'selected' : '' }}"><a href="{{ route('company.index') }}">{{ __('SalesOrder') }}</a></li>
            <li class="{{ ($submenu=='do') ? 'selected' : '' }}"><a href="{{ route('company.index') }}">{{ __('DeliveryOrder') }}</a></li>
            <li class="{{ ($submenu=='task') ? 'selected' : '' }}"><a href="{{ route('company.index') }}">{{ __('Task') }}</a></li>
            <li class="{{ ($submenu=='job') ? 'selected' : '' }}"><a href="{{ route('company.index') }}">{{ __('Job') }}</a></li>
            <li class="{{ ($submenu=='schedule') ? 'selected' : '' }}"><a href="{{ route('company.index') }}">{{ __('Schedule') }}</a></li>
        @elseif ($menu=='delivery')
            <li class="{{ ($submenu=='dn') ? 'selected' : '' }}"><a href="{{ route('company.index') }}">{{ __('DeliveryNote') }}</a></li>
        @elseif ($menu=='collection')
            <li class="{{ ($submenu=='cn') ? 'selected' : '' }}"><a href="{{ route('company.index') }}">{{ __('CollectionNote') }}</a></li>
        @elseif ($menu=='inventory')
            <li class="{{ ($submenu=='inventory') ? 'selected' : '' }}"><a href="{{ route('company.index') }}">{{ __('Inventory') }}</a></li>
            <li class="{{ ($submenu=='warehouse') ? 'selected' : '' }}"><a href="{{ route('company.index') }}">{{ __('Warehouse') }}</a></li>
            <li class="{{ ($submenu=='opening') ? 'selected' : '' }}"><a href="{{ route('company.index') }}">{{ __('Opening') }}</a></li>
            <li class="{{ ($submenu=='in') ? 'selected' : '' }}"><a href="{{ route('company.index') }}">{{ __('In') }}</a></li>
            <li class="{{ ($submenu=='out') ? 'selected' : '' }}"><a href="{{ route('company.index') }}">{{ __('Out') }}</a></li>
            <li class="{{ ($submenu=='lost') ? 'selected' : '' }}"><a href="{{ route('company.index') }}">{{ __('Lost') }}</a></li>
            <li class="{{ ($submenu=='damaged') ? 'selected' : '' }}"><a href="{{ route('company.index') }}">{{ __('Damaged') }}</a></li>
        @elseif ($menu=='price')
            <li class="{{ ($submenu=='price') ? 'selected' : '' }}"><a href="{{ route('company.index') }}">{{ __('Price') }}</a></li>
        @elseif ($menu=='invoice')
            <li class="{{ ($submenu=='invoice') ? 'selected' : '' }}"><a href="{{ route('invoice.index') }}">{{ __('Invoice') }}</a></li>
            <li class="{{ ($submenu=='debitnote') ? 'selected' : '' }}"><a href="{{ route('invoice.index') }}">{{ __('DebitNote') }}</a></li>
            <li class="{{ ($submenu=='creditnote') ? 'selected' : '' }}"><a href="{{ route('invoice.index') }}">{{ __('CreditNote') }}</a></li>
            <li class="{{ ($submenu=='statement') ? 'selected' : '' }}"><a href="{{ route('invoice.index') }}">{{ __('Statement') }}</a></li>
            <li class="{{ ($submenu=='receipt') ? 'selected' : '' }}"><a href="{{ route('invoice.index') }}">{{ __('Receipt') }}</a></li>
            <li class="{{ ($submenu=='pv') ? 'selected' : '' }}"><a href="{{ route('invoice.index') }}">{{ __('PaymentVoucher') }}</a></li>
            <li class="{{ ($submenu=='rv') ? 'selected' : '' }}"><a href="{{ route('invoice.index') }}">{{ __('ReceivedVoucher') }}</a></li>
            <li class="{{ ($submenu=='fax') ? 'selected' : '' }}"><a href="{{ route('invoice.index') }}">{{ __('Fax') }}</a></li>
            <li class="{{ ($submenu=='notice') ? 'selected' : '' }}"><a href="{{ route('invoice.index') }}">{{ __('Notice') }}</a></li>
            <li class="{{ ($submenu=='deposit') ? 'selected' : '' }}"><a href="{{ route('invoice.index') }}">{{ __('Deposit') }}</a></li>
            <li class="{{ ($submenu=='payslip') ? 'selected' : '' }}"><a href="{{ route('invoice.index') }}">{{ __('Payslip') }}</a></li>
            <li class="{{ ($submenu=='bankcheck') ? 'selected' : '' }}"><a href="{{ route('invoice.index') }}">{{ __('BankCheck') }}</a></li>
            <li class="{{ ($submenu=='report') ? 'selected' : '' }}"><a href="{{ route('invoice.index') }}">{{ __('Report') }}</a></li>
        @elseif ($menu=='products')
            <li class="{{ ($submenu=='products') ? 'selected' : '' }}"><a href="{{ route('company.index') }}">{{ __('Products') }}</a></li>
        @elseif ($menu=='services')
            <li class="{{ ($submenu=='services') ? 'selected' : '' }}"><a href="{{ route('company.index') }}">{{ __('Services') }}</a></li>
        @elseif ($menu=='customers')
            <li class="{{ ($submenu=='company') ? 'selected' : '' }}"><a href="{{ route('company.index') }}">{{ __('Company') }}</a></li>
            <li class="{{ ($submenu=='client') ? 'selected' : '' }}"><a href="{{ route('company.index') }}">{{ __('Client') }}</a></li>
            <li class="{{ ($submenu=='deliverycontact') ? 'selected' : '' }}"><a href="{{ route('company.index') }}">{{ __('DeliveryContact') }}</a></li>
            <li class="{{ ($submenu=='sitecontact') ? 'selected' : '' }}"><a href="{{ route('company.index') }}">{{ __('SiteContact') }}</a></li>
        @elseif ($menu=='jobbookprofile')
            <li class="{{ ($submenu=='jobbookprofile') ? 'selected' : '' }}"><a href="{{ route('jobbookprofile.index') }}">{{ __('Profile') }}</a></li>
        @else
            <li><a href="#">Empty</a></li>
        @endif
    @else
        <li><a href="#">Empty</a></li>
    @endif
    </ul>
</nav>
</nav>
<section id="nav2space">
    <br>
</section>
