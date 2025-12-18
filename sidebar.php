{{-- Web View Sidebar --}}
<aside>
    <div class="flex-shrink-0 sidebar">
        <div class="nav col-md-11">
            <a href="./index.php" class="mx-auto"><img src="{{ asset('assets/images/logo.png') }}" alt="" height="50px"
                    class="mx-auto"></a>
        </div>

        <div class="sidebardiv">
            <!-- Responsive navigation -->
            <ul class="list-unstyled mt-5 ps-0">
                @if (Session::get('Dashboard_show') == '1')
                <li class="mb-1">
                    <a href="{{ route('dashboard') }}">
                        <button
                            class="btn0 bn1 mx-auto btn-toggle collapsed {{ Request::routeIs('dashboard') ? 'active' : '' }}"
                            data-bs-toggle="collapse" data-bs-target="#collapse1" aria-expanded="false">
                            <div class="btnname">
                                {{-- <i class="bx bxs-dashboard"></i> &nbsp;Dashboard --}}
                                <i class="fas fa-user"></i> &nbsp;Dashboard
                            </div>
                        </button>
                    </a>
                </li>
                @endif

                @if (Session::get('Project_show') == '1')
                <li class="mb-1">
                    <button
                        class="btn0 bn2 mx-auto btn-toggle collapsed  {{ Request::routeIs('projects.index') ? 'active' : '' }}"
                        data-bs-toggle="collapse" data-bs-target="#collapse2" aria-expanded="false">
                        <div class="btnname">
                            <i class="fa-solid fa-city"></i>
                            &nbsp;Projects
                        </div>
                        <div class="righticon">
                            <i class="fa-solid fa-angle-down toggle-icon"></i>
                        </div>
                    </button>
                    <div class="collapse" id="collapse2">
                        <ul class="btn-toggle-nav list-unstyled text-center px-0 pb-3">
                            <li><a href="{{ route('projects.index') }}"
                                    class="d-inline-flex text-decoration-none rounded mt-3">Project List</a></li>
                        </ul>
                    </div>
                </li>
                @endif
                @if (Session::get('Employee_show') == '1')
                <li class="mb-1">
                    <button
                        class="btn0 bn3 mx-auto btn-toggle collapsed {{ Request::routeIs('employee.index') ? 'active' : '' }}"
                        data-bs-toggle="collapse" data-bs-target="#collapse3" aria-expanded="false">
                        <div class="btnname">
                            <i class="fa-solid fa-user-group"></i> &nbsp;Employee
                        </div>
                        <div class="righticon">
                            <i class="fa-solid fa-angle-down toggle-icon"></i>
                        </div>
                    </button>
                    <div class="collapse" id="collapse3">
                        <ul class="btn-toggle-nav list-unstyled text-center px-0 pb-3">
                            <li><a href="{{ route('employee.index') }}"
                                    class="d-inline-flex text-decoration-none rounded mt-3">Employee List</a></li>
                        </ul>
                    </div>
                </li>
                @endif
                @if (Session::get('Permission_show') == '1')
                <li class="mb-1">
                    <a href="{{ route('permission.index') }}">
                        <button
                            class="btn0 bn4 mx-auto btn-toggle collapsed {{ Request::routeIs('permission.index', 'permission.*') ? 'active' : '' }}"
                            data-bs-toggle="collapse" data-bs-target="#collapse4" aria-expanded="false">
                            <div class="btnname">
                                <i class="fa-solid fa-user-lock"></i> &nbsp;Permissions
                            </div>
                        </button>
                    </a>
                </li>
                @endif
                @if (Session::get('Desgination_show') == '1')
                <!-- Designation -->
                <li class="mb-1">
                    <button
                        class="btn0 bn4 mx-auto btn-toggle collapsed {{ Request::routeIs('desgination.index', 'desgination.*') ? 'active' : '' }}"
                        data-bs-toggle="collapse" data-bs-target="#collapse4" aria-expanded="false">
                        <div class="btnname">
                            <i class="fa-solid fa-briefcase"></i> &nbsp;Designation
                        </div>
                        <div class="righticon">
                            <i class="fa-solid fa-angle-down toggle-icon"></i>
                        </div>
                    </button>
                    <div class="collapse" id="collapse4">
                        <ul class="btn-toggle-nav list-unstyled text-center px-0 pb-3">
                            <li><a href="{{ route('desgination.index') }}"
                                    class="d-inline-flex text-decoration-none rounded mt-3">Designation List</a>
                            </li>
                        </ul>
                    </div>
                </li>
                @endif
                @if (Session::get('VendorMaster_show') == '1')
                <li class="mb-1">
                    <a href="{{ route('vendors.index') }}">
                        <button
                            class="btn0 bn5 mx-auto btn-toggle collapsed {{ Request::routeIs('vendors.index') ? 'active' : '' }}"
                            data-bs-toggle="collapse" data-bs-target="#collapse5" aria-expanded="false">
                            <div class="btnname">
                                <i class="fa-solid fa-people-carry-box"></i> &nbsp;Vendor Master
                            </div>
                        </button>
                    </a>
                </li>
                @endif
                @if (Session::get('MaterialMaster_show') == '1')
                <li class="mb-1">
                    <a href="{{ route('material.index') }}">
                        <button
                            class="btn0 bn6 mx-auto btn-toggle collapsed {{ Request::routeIs('material.index') ? 'active' : '' }}"
                            data-bs-toggle="collapse" data-bs-target="#collapse6" aria-expanded="false">
                            <div class="btnname">
                                <i class="fa-solid fa-magnifying-glass-chart"></i> &nbsp;Material Master
                            </div>
                        </button>
                    </a>
                </li>
                @endif
                @if (Session::get('OverheadMaster_show') == '1')
                <li class="mb-1">
                    <a href="{{ route('overhead.index') }}">
                        <button
                            class="btn0 bn7 mx-auto btn-toggle collapsed {{ Request::routeIs('overhead.index') ? 'active' : '' }}"
                            data-bs-toggle="collapse" data-bs-target="#collapse7" aria-expanded="false">
                            <div class="btnname">
                                <i class="fa-solid fa-cable-car"></i> &nbsp;Overhead Master
                            </div>
                        </button>
                    </a>
                </li>
                @endif
                @if (Session::get('AssetCode_show') == '1')
                <li class="mb-1">
                    <a href="{{ route('asset_code.index') }}">
                        <button
                            class="btn0 bn8 mx-auto btn-toggle collapsed {{ Request::routeIs('asset_code.index') ? 'active' : '' }}"
                            data-bs-toggle="collapse" data-bs-target="#collapse8" aria-expanded="false">
                            <div class="btnname">
                                <i class="fa-solid fa-barcode"></i> &nbsp;Asset Code
                            </div>
                        </button>
                    </a>
                </li>
                @endif
                @if (Session::get('SubDivision_show') == '1')
                <li class="mb-1">
                    <a href="{{ route('division.index') }}">
                        <button
                            class="btn0 bn9 mx-auto btn-toggle collapsed {{ Request::routeIs('division.index') ? 'active' : '' }}"
                            data-bs-toggle="collapse" data-bs-target="#collapse9" aria-expanded="false">
                            <div class="btnname">
                                <i class="fa-solid fa-qrcode"></i> &nbsp;Sub Division Code
                            </div>
                        </button>
                    </a>
                </li>
                @endif
                @if (Session::get('Unit_show') == '1')
                <li class="mb-1">
                    <a href="{{ route('unit.index') }}">
                        <button
                            class="btn0 bn11 mx-auto btn-toggle collapsed {{ Request::routeIs('unit.index') ? 'active' : '' }}"
                            data-bs-toggle="collapse" data-bs-target="#collapse10" aria-expanded="false">
                            <div class="btnname">
                                <i class="fa-solid fa-weight-scale"></i> &nbsp;Unit
                            </div>
                        </button>
                    </a>
                </li>
                @endif
                @if (Session::get('Warehouse_show') == '1')
                <li class="mb-1">
                    <a href="{{ route('warehouse.index') }}">
                        <button
                            class="btn0 bn11 mx-auto btn-toggle collapsed {{ Request::routeIs('warehouse.index') ? 'active' : '' }}"
                            data-bs-toggle="collapse" data-bs-target="#collapse11" aria-expanded="false">
                            <div class="btnname">
                                <i class="fa-solid fa-warehouse"></i> &nbsp;WareHouse Master
                            </div>
                        </button>
                    </a>
                </li>
                @endif
                @if (Session::get('Purchaserequest_show') == '1')
                <li class="mb-1">
                    <a href="{{ route('purchaseorder.index') }}">
                        <button
                            class="btn0 bn11 mx-auto btn-toggle collapsed {{ Request::routeIs('purchaseorder.index') ? 'active' : '' }}"
                            data-bs-toggle="collapse" data-bs-target="#collapse12" aria-expanded="false">
                            <div class="btnname">
                                <i class="fa-solid fa-shopping-cart"></i> &nbsp;Purchase Request
                            </div>
                        </button>
                    </a>
                </li>
                @endif
                @if (Session::get('Quotation_show') == '1')
                <li class="mb-1">
                    <a href="{{ route('quotation.index') }}">
                        <button
                            class="btn0 bn11 mx-auto btn-toggle collapsed {{ Request::routeIs('quotation.index') ? 'active' : '' }}"
                            data-bs-toggle="collapse" data-bs-target="#collapse13" aria-expanded="false">
                            <div class="btnname">
                                <i class="fa-solid fa-file-invoice"></i>&nbsp;Quotation
                            </div>
                        </button>
                    </a>
                </li>
                @endif
                @if (Session::get('QuotationComparission_show') == '1')
                <li class="mb-1">
                    <a href="{{ route('comparision.index') }}">
                        <button
                            class="btn0 bn11 mx-auto btn-toggle collapsed {{ Request::routeIs('comparision.index') ? 'active' : '' }}"
                            data-bs-toggle="collapse" data-bs-target="#collapse14" aria-expanded="false">
                            <div class="btnname">
                                <i class="fa-solid fa-code-compare"></i>&nbsp;Quotation Comparison
                            </div>
                        </button>
                    </a>
                </li>
                @endif
                @if (Session::get('PR Recived_show') == '1')
                <li class="mb-1">
                    <a href="{{ route('po_received.index') }}">
                        <button
                            class="btn0 bn11 mx-auto btn-toggle collapsed {{ Request::routeIs('po_received.index') ? 'active' : '' }}"
                            data-bs-toggle="collapse" data-bs-target="#collapse15" aria-expanded="false">
                            <div class="btnname">
                                <i class="fa-solid fa-circle-down"></i> &nbsp;PR Received
                            </div>
                        </button>
                    </a>
                </li>
                @endif
                @if (Session::get('Stocks_show') == '1')
                <li class="mb-1">
                    <a href="{{ route('stocks.index') }}">
                        <button
                            class="btn0 bn11 mx-auto btn-toggle collapsed {{ Request::routeIs('stocks.index') ? 'active' : '' }}"
                            data-bs-toggle="collapse" data-bs-target="#collapse16" aria-expanded="false">
                            <div class="btnname">
                                <i class="fa-solid fa-boxes-stacked"></i> &nbsp;Stocks
                            </div>
                        </button>
                    </a>
                </li>
                @endif
            </ul>

            <!-- Logout -->
            <ul class="list-unstyled lgt">
                <li class="mb-1">
                    <a href="{{ route('logout') }}">
                        <button class="btn0 mx-auto btn-toggle collapsed " aria-expanded="false">
                            <div class="btnname">
                                <i class="fa-solid fa-right-from-bracket" style="color: red;"></i> &nbsp;Logout
                            </div>
                        </button>
                    </a>
                </li>
            </ul>
        </div>
    </div>
</aside>

{{-- Responsive Sidebar --}}
<div class="offcanvas offcanvas-start" tabindex="-1" id="offcanvasExample" aria-labelledby="offcanvasExampleLabel">
    <div class="offcanvas-header">
        <div class="user ps-1">
            <img src="{{ asset('assets/images/avatar.png') }}" height="40px" class="rounded-5" alt="">
            <h6 class="bg-dark px-3 py-1 m-0 rounded-2">{{ Auth::user()->vemp_name }}</h6>
        </div>
        <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
    </div>
    <div class="offcanvas-body">
        <div class="flex-shrink-0 sidebar">

            <div class="sidebardiv">
                <!-- Responsive navigation -->
                <ul class="list-unstyled mt-2 ps-0">

                    <!-- Dashboard -->
                    @if (Session::get('Dashboard_show') == '1')
                    <li class="mb-1">
                        <a href="{{ route('dashboard') }}">
                            <button
                                class="btn0 bn1 mx-auto btn-toggle collapsed {{ Request::routeIs('dashboard') ? 'active' : '' }}"
                                data-bs-toggle="collapse" data-bs-target="#collapse1" aria-expanded="false">
                                <div class="btnname">
                                    {{-- <i class="bx bxs-dashboard"></i> &nbsp;Dashboard --}}
                                    <i class="fas fa-user"></i> &nbsp;Dashboard
                                </div>
                            </button>
                        </a>
                    </li>
                    @endif

                    <!-- Projects -->
                    @if (Session::get('Project_show') == '1')
                    <li class="mb-1">
                        <button
                            class="btn0 bn2 mx-auto btn-toggle collapsed  {{ Request::routeIs('projects.index') ? 'active' : '' }}"
                            data-bs-toggle="collapse" data-bs-target="#collapse2" aria-expanded="false">
                            <div class="btnname">
                                <i class="fa-solid fa-city"></i>
                                &nbsp;Projects
                            </div>
                            <div class="righticon">
                                <i class="fa-solid fa-angle-down toggle-icon"></i>
                            </div>
                        </button>
                        <div class="collapse" id="collapse2">
                            <ul class="btn-toggle-nav list-unstyled text-center px-0 pb-3">
                                <li><a href="{{ route('projects.index') }}"
                                        class="d-inline-flex text-decoration-none rounded mt-3">Project List</a></li>
                            </ul>
                        </div>
                    </li>
                    @endif

                    <!-- Employee -->
                    @if (Session::get('Employee_show') == '1')
                    <li class="mb-1">
                        <button
                            class="btn0 bn3 mx-auto btn-toggle collapsed {{ Request::routeIs('employee.index') ? 'active' : '' }}"
                            data-bs-toggle="collapse" data-bs-target="#collapse3" aria-expanded="false">
                            <div class="btnname">
                                <i class="fa-solid fa-user-group"></i> &nbsp;Employee
                            </div>
                            <div class="righticon">
                                <i class="fa-solid fa-angle-down toggle-icon"></i>
                            </div>
                        </button>
                        <div class="collapse" id="collapse3">
                            <ul class="btn-toggle-nav list-unstyled text-center px-0 pb-3">
                                <li><a href="{{ route('employee.index') }}"
                                        class="d-inline-flex text-decoration-none rounded mt-3">Employee List</a>
                                </li>
                            </ul>
                        </div>
                    </li>
                    @endif

                    <!-- Permission -->
                    @if (Session::get('Permission_show') == '1')
                    <li class="mb-1">
                        <a href="">
                            <button
                                class="btn0 bn4 mx-auto btn-toggle collapsed {{ Request::routeIs('desgination.index', 'desgination.*') ? 'active' : '' }}"
                                data-bs-toggle="collapse" data-bs-target="#collapse4" aria-expanded="false">
                                <div class="btnname">
                                    <i class="fa-solid fa-user-lock"></i> &nbsp;Permissions
                                </div>
                            </button>
                        </a>
                    </li>
                    @endif

                    <!-- Designation -->
                    @if (Session::get('Desgination_show') == '1')
                    <li class="mb-1">
                        <button
                            class="btn0 bn5 mx-auto btn-toggle collapsed {{ Request::routeIs('desgination.index', 'desgination.*') ? 'active' : '' }}"
                            data-bs-toggle="collapse" data-bs-target="#collapse5" aria-expanded="false">
                            <div class="btnname">
                                <i class="fa-solid fa-briefcase"></i> &nbsp;Designation
                            </div>
                            <div class="righticon">
                                <i class="fa-solid fa-angle-down toggle-icon"></i>
                            </div>
                        </button>
                        <div class="collapse" id="collapse5">
                            <ul class="btn-toggle-nav list-unstyled text-center px-0 pb-3">
                                <li><a href="{{ route('desgination.index') }}"
                                        class="d-inline-flex text-decoration-none rounded mt-3">Designation
                                        List</a>
                                </li>
                            </ul>
                        </div>
                    </li>
                    @endif

                    <!-- Vendor Master -->
                    @if (Session::get('VendorMaster_show') == '1')
                    <li class="mb-1">
                        <a href="{{ route('vendors.index') }}">
                            <button
                                class="btn0 bn6 mx-auto btn-toggle collapsed {{ Request::routeIs('vendors.index') ? 'active' : '' }}"
                                data-bs-toggle="collapse" data-bs-target="#collapse6" aria-expanded="false">
                                <div class="btnname">
                                    <i class="fa-solid fa-people-carry-box"></i> &nbsp;Vendor Master
                                </div>
                            </button>
                        </a>
                    </li>
                    @endif

                    <!-- Material Master -->
                    @if (Session::get('MaterialMaster_show') == '1')
                    <li class="mb-1">
                        <a href="{{ route('material.index') }}">
                            <button
                                class="btn0 bn7 mx-auto btn-toggle collapsed {{ Request::routeIs('material.index') ? 'active' : '' }}"
                                data-bs-toggle="collapse" data-bs-target="#collapse7" aria-expanded="false">
                                <div class="btnname">
                                    <i class="fa-solid fa-magnifying-glass-chart"></i> &nbsp;Material Master
                                </div>
                            </button>
                        </a>
                    </li>
                    @endif

                    <!-- Overhead Master -->
                    @if (Session::get('OverheadMaster_show') == '1')
                    <li class="mb-1">
                        <a href="{{ route('overhead.index') }}">
                            <button
                                class="btn0 bn8 mx-auto btn-toggle collapsed {{ Request::routeIs('overhead.index') ? 'active' : '' }}"
                                data-bs-toggle="collapse" data-bs-target="#collapse8" aria-expanded="false">
                                <div class="btnname">
                                    <i class="fa-solid fa-cable-car"></i> &nbsp;Overhead Master
                                </div>
                            </button>
                        </a>
                    </li>
                    @endif

                    <!-- Asset Code -->
                    @if (Session::get('AssetCode_show') == '1')
                    <li class="mb-1">
                        <a href="{{ route('asset_code.index') }}">
                            <button
                                class="btn0 bn9 mx-auto btn-toggle collapsed {{ Request::routeIs('asset_code.index') ? 'active' : '' }}"
                                data-bs-toggle="collapse" data-bs-target="#collapse9" aria-expanded="false">
                                <div class="btnname">
                                    <i class="fa-solid fa-barcode"></i> &nbsp;Asset Code
                                </div>
                            </button>
                        </a>
                    </li>
                    @endif

                    <!-- Sub Division Code -->
                    @if (Session::get('SubDivision_show') == '1')
                    <li class="mb-1">
                        <a href="{{ route('division.index') }}">
                            <button
                                class="btn0 bn10 mx-auto btn-toggle collapsed {{ Request::routeIs('division.index') ? 'active' : '' }}"
                                data-bs-toggle="collapse" data-bs-target="#collapse10" aria-expanded="false">
                                <div class="btnname">
                                    <i class="fa-solid fa-qrcode"></i> &nbsp;Sub Division Code
                                </div>
                            </button>
                        </a>
                    </li>
                    @endif

                    <!-- Unit -->
                    @if (Session::get('Unit_show') == '1')
                    <li class="mb-1">
                        <a href="{{ route('unit.index') }}">
                            <button
                                class="btn0 bn12 mx-auto btn-toggle collapsed {{ Request::routeIs('unit.index') ? 'active' : '' }}"
                                data-bs-toggle="collapse" data-bs-target="#collapse12" aria-expanded="false">
                                <div class="btnname">
                                    <i class="fa-solid fa-weight-scale"></i> &nbsp;Unit
                                </div>
                            </button>
                        </a>
                    </li>
                    @endif

                    <!-- Warehouse -->
                    @if (Session::get('Warehouse_show') == '1')
                    <li class="mb-1">
                        <a href="{{ route('warehouse.index') }}">
                            <button
                                class="btn0 bn13 mx-auto btn-toggle collapsed {{ Request::routeIs('warehouse.index') ? 'active' : '' }}"
                                data-bs-toggle="collapse" data-bs-target="#collapse13" aria-expanded="false">
                                <div class="btnname">
                                    <i class="fa-solid fa-warehouse"></i> &nbsp;WareHouse Master
                                </div>
                            </button>
                        </a>
                    </li>
                    @endif

                    <!-- Purchase Order -->
                    @if (Session::get('Purchaserequest_show') == '1')
                    <li class="mb-1">
                        <a href="{{ route('purchaseorder.index') }}">
                            <button
                                class="btn0 bn14 mx-auto btn-toggle collapsed {{ Request::routeIs('purchaseorder.index') ? 'active' : '' }}"
                                data-bs-toggle="collapse" data-bs-target="#collapse14" aria-expanded="false">
                                <div class="btnname">
                                    <i class="fa-solid fa-shopping-cart"></i> &nbsp;Purchase Request
                                </div>
                            </button>
                        </a>
                    </li>
                    @endif

                    <!-- Quotation -->
                    @if (Session::get('Quotation_show') == '1')
                    <li class="mb-1">
                        <a href="{{ route('quotation.index') }}">
                            <button
                                class="btn0 bn15 mx-auto btn-toggle collapsed {{ Request::routeIs('quotation.index') ? 'active' : '' }}"
                                data-bs-toggle="collapse" data-bs-target="#collapse15" aria-expanded="false">
                                <div class="btnname">
                                    <i class="fa-solid fa-quote-left"></i>&nbsp;Quotation
                                </div>
                            </button>
                        </a>
                    </li>
                    @endif

                    <!-- Comparison -->
                    @if (Session::get('QuotationComparission_show') == '1')
                    <li class="mb-1">
                        <a href="{{ route('comparision.index') }}">
                            <button
                                class="btn0 bn16 mx-auto btn-toggle collapsed {{ Request::routeIs('comparision.index') ? 'active' : '' }}"
                                data-bs-toggle="collapse" data-bs-target="#collapse16" aria-expanded="false">
                                <div class="btnname">
                                    <i class="fa-solid fa-code-compare"></i>&nbsp;Quotation Comparision
                                </div>
                            </button>
                        </a>
                    </li>
                    @endif

                    <!-- PR Received -->
                    @if (Session::get('PR Recived_show') == '1')
                    <li class="mb-1">
                        <a href="{{ route('po_received.index') }}">
                            <button
                                class="btn0 bn17 mx-auto btn-toggle collapsed {{ Request::routeIs('po_received.index') ? 'active' : '' }}"
                                data-bs-toggle="collapse" data-bs-target="#collapse17" aria-expanded="false">
                                <div class="btnname">
                                    <i class="fa-solid fa-circle-down"></i> &nbsp;PR Received
                                </div>
                            </button>
                        </a>
                    </li>
                    @endif

                    <!-- Stocks -->
                    @if (Session::get('Stocks_show') == '1')
                    <li class="mb-1">
                        <a href="{{ route('stocks.index') }}">
                            <button
                                class="btn0 bn18 mx-auto btn-toggle collapsed {{ Request::routeIs('stocks.index') ? 'active' : '' }}"
                                data-bs-toggle="collapse" data-bs-target="#collapse18" aria-expanded="false">
                                <div class="btnname">
                                    <i class="fa-solid fa-boxes-stacked"></i> &nbsp;Stocks
                                </div>
                            </button>
                        </a>
                    </li>
                    @endif
                </ul>

                <!-- Logout -->
                <ul class="list-unstyled lgt">
                    <li class="mb-1">
                        <a href="{{ route('logout') }}">
                            <button class="btn0 mx-auto btn-toggle collapsed " aria-expanded="false">
                                <div class="btnname">
                                    <i class="fa-solid fa-right-from-bracket" style="color: red;"></i> &nbsp;Logout
                                </div>
                            </button>
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</div>