<aside class="app-sidebar bg-body-secondary shadow" data-bs-theme="dark">
        <!--begin::Sidebar Brand-->
        <div class="sidebar-brand">
          <!--begin::Brand Link-->
          <a href="{{  url('/') }}" class="brand-link">
            <!--begin::Brand Image-->
            <img src="{{url('/') }}/img/logo.png" alt="CostCake Logo" class="brand-image opacity-75 shadow">
            <!--end::Brand Image-->
            <!--begin::Brand Text-->
            <span class="brand-text fw-light">Costo APP</span>
            <!--end::Brand Text-->
          </a>
          <!--end::Brand Link-->
        </div>
        <!--end::Sidebar Brand-->
        <!--begin::Sidebar Wrapper-->
        <div class="sidebar-wrapper" data-overlayscrollbars="host"><div class="os-size-observer"><div class="os-size-observer-listener"></div></div><div class="" data-overlayscrollbars-viewport="scrollbarHidden overflowXHidden overflowYHidden" tabindex="-1" style="margin-right: -16px; margin-bottom: -16px; margin-left: 0px; top: -8px; right: auto; left: -8px; width: calc(100% + 16px); padding: 8px;">
          <nav class="mt-2">
            <!--begin::Sidebar Menu-->
            <ul class="nav sidebar-menu flex-column" data-lte-toggle="treeview" role="menu" data-accordion="false">
              
                <li class="nav-item">
                    <a href="{{url('/') }}" class="nav-link">
                    <i class="nav-icon bi bi-speedometer"></i>
                    <p>Dashboard</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{url('/ingredientes') }}" class="nav-link">
                    <i class="nav-icon bi bi-basket"></i>
                    <p>Ingredientes</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{url('/materiales') }}" class="nav-link">
                    <i class="nav-icon bi bi-box-seam"></i>
                    <p>Materiales Desechables</p>
                    </a>
                </li> 
                <li class="nav-item">
                    <a href="{{url('/gastos') }}" class="nav-link">
                    <i class="nav-icon bi bi-receipt-cutoff"></i>
                    <p>Gastos Indirectos</p>
                    </a>
                </li>                 
                <li class="nav-item">
                    <a href="{{url('/recetas') }}" class="nav-link">
                    <i class="nav-icon bi bi-card-list"></i>
                    <p>Recetas</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{url('/productos') }}" class="nav-link">
                    <i class="nav-icon bi bi-cake2"></i>
                    <p>Productos</p>
                    </a>
                </li> 
              {{--  <li class="nav-item">
                    <a href="{{url('/unidad_medidas') }}" class="nav-link">
                    <i class="nav-icon bi bi-cash"></i>
                    <p>Unidades Medidas</p>
                    </a>
                </li> 
                <li class="nav-item">
                    <a href="{{url('/conversion_unidades') }}" class="nav-link">
                    <i class="nav-icon bi bi-bar-chart"></i>
                    <p>Conversion de Unidades</p>
                    </a>
                </li>  --}}

                <li class="nav-item menu-open">
                    <a href="#" class="nav-link">
                    <i class="nav-icon bi bi-ui-checks-grid"></i>
                    <p>
                        Conversiones Tools
                        <i class="nav-arrow bi bi-chevron-right"></i>
                    </p>
                    </a>
                    <ul class="nav nav-treeview" role="navigation" aria-label="Navigation 13" style="box-sizing: border-box; display: block;">
                    <li class="nav-item">
                        <a href="{{url('/unidad_medida') }}" class="nav-link">
                        <i class="nav-icon bi bi-circle"></i>
                        <p>Unidades Medidas</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{url('/conversion_unidades') }}" class="nav-link">
                        <i class="nav-icon bi bi-circle"></i>
                        <p>Conversion de Unidades</p>
                        </a>
                    </li>
                    </ul>
                </li>
                 <li class="nav-item menu-open">
                    <a href="#" class="nav-link">
                    <i class="nav-icon bi bi-table"></i>
                    <p>
                        Tabla Nutricional
                        <i class="nav-arrow bi bi-chevron-right"></i>
                        
                    </p>
                    </a>
                    <ul class="nav nav-treeview" role="navigation" aria-label="Navigation 13" style="box-sizing: border-box; display: block;">
                    <li class="nav-item">
                        <a href="{{url('/ingredientes_nutricion') }}" class="nav-link">
                        <i class="nav-icon bi bi-circle"></i>
                        <p>Ingredientes Nutricion</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{url('/producto_nutricion') }}" class="nav-link">
                        <i class="nav-icon bi bi-circle"></i>
                        <p>Producto Nutricion</p>
                        </a>
                    </li>
                    </ul>
                </li>
                                 
                <li class="nav-item">
                    <a href="{{url('/usuarios') }}" class="nav-link">
                    <i class="nav-icon bi bi-person"></i>
                    <p>Usuarios</p>
                    </a>
                </li>
            </ul>
            <!--end::Sidebar Menu-->
            
          </nav>
        </div><div class="os-scrollbar os-scrollbar-horizontal os-theme-light os-scrollbar-auto-hide os-scrollbar-handle-interactive os-scrollbar-track-interactive os-scrollbar-cornerless os-scrollbar-unusable os-scrollbar-auto-hide-hidden" style="--os-viewport-percent: 1; --os-scroll-direction: 0;"><div class="os-scrollbar-track"><div class="os-scrollbar-handle"></div></div></div><div class="os-scrollbar os-scrollbar-vertical os-theme-light os-scrollbar-auto-hide os-scrollbar-handle-interactive os-scrollbar-track-interactive os-scrollbar-cornerless os-scrollbar-unusable os-scrollbar-auto-hide-hidden" style="--os-viewport-percent: 1; --os-scroll-direction: 0;"><div class="os-scrollbar-track"><div class="os-scrollbar-handle"></div></div></div></div>
        <!--end::Sidebar Wrapper-->
      </aside>