<aside class="main-sidebar">
    <section class="sidebar">
        <div class="user-panel">
            <div class="pull-left image">
                <img src="{{ Auth::user()->avatar }}" class="img-circle" alt="">
            </div>
            <div class="pull-left info">
                <p>{{ Auth::user()->username }}</p>
                <a href="#"><i class="fa fa-circle text-success"></i> {{ trans('supplier.online') }}</a>
            </div>
        </div>
        <form action="#" method="get" class="sidebar-form" id="sidebar-search-form">
            <div class="input-group">
                <input type="text" name="q" class="form-control" placeholder="{{ trans('supplier.search') }}">
                <span class="input-group-btn">
                    <button type="submit" name="search" id="search-btn" class="btn btn-flat"><i class="fa fa-search"></i>
                    </button>
                </span>
            </div>
        </form>
        <ul class="sidebar-menu" data-widget="tree">
            <li class="header">{{ trans('supplier.main_navigation') }}</li>
            <li><a href="{{ route('supplier.products.index') }}"><i class="fa fa-product-hunt" aria-hidden="true"></i> <span>{{ trans('supplier.manage_product') }}</span></a></li>
            <li><a href="{{ route('voucher.index') }}"><i class="fa fa-newspaper-o" aria-hidden="true"></i> <span>{{ trans('supplier.manager_voucher') }}</span></a></li>
            <li><a href="{{ route('orders.index', config('config.order_status_pending')) }}"><i class="fa fa-list-alt" aria-hidden="true"></i> <span>{{ trans('supplier.manage_order') }}</span></a></li>
            <li><a href="{{ route('supplier.month.statistic') }}"><i class="fa fa-bar-chart-o" aria-hidden="true"></i> <span>{{ trans('sentences.monthly_revenue_statistics') }}</span></a></li>
        </ul>
    </section>
</aside>
