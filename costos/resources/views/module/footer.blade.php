<footer class="app-footer">
    <!--begin::To the end-->
    <div class="float-end d-none d-sm-inline">Kelvin Jimenez - Software Developer & Data Analyst</div>
    <!--end::To the end-->
    <!--begin::Copyright-->
    <strong>
        Copyright © 
        @php
            $year = date('Y');
            echo $year;
        @endphp
        &nbsp;
        <a href="{{substr(url('/'),0,-11) }}" class="text-decoration-none">Sistema de Costo</a>.
    </strong>
    All rights reserved.
    <!--end::Copyright-->
</footer>