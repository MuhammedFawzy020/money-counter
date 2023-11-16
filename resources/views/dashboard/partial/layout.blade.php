<!DOCTYPE html>

<html>
    <head>
        @include('dashboard.partial.header')
    </head>
    @if(session()->get('locale'))
    <style>
        table.dataTable thead th, table.dataTable thead td, table.dataTable tfoot th, table.dataTable tfoot td{
        text-align:right !important;
        }
    </style>
    @endif
    <body class="hold-transition sidebar-mini layout-fixed">
    <div class="wrapper">
        @include('dashboard.partial.sidnav')

        <div class="content-wrapper">
            @include('dashboard.partial.sessions')
            @yield('content')
        </div>

        @include('dashboard.partial.scripts')
        @yield('scripts')
        
    </div>

    
    </body>
</html>
