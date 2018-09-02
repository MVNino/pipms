
    <meta name="description" content="Vali is a responsive and free admin theme built with Bootstrap 4, SASS and PUG.js. It's fully customizable and modular.">
    <!-- Twitter meta-->
    <meta property="twitter:card" content="summary_large_image">
    <meta property="twitter:site" content="@pratikborsadiya">
    <meta property="twitter:creator" content="@pratikborsadiya">
    <!-- Open Graph Meta-->
    <meta property="og:type" content="website">
    <meta property="og:site_name" content="Vali Admin">
    <meta property="og:title" content="Vali - Free Bootstrap 4 admin theme">
    <meta property="og:url" content="http://pratikborsadiya.in/blog/vali-admin">
    <meta property="og:image" content="http://pratikborsadiya.in/blog/vali-admin/hero-social.png">
    <meta property="og:description" content="Vali is a responsive and free admin theme built with Bootstrap 4, SASS and PUG.js. It's fully customizable and modular.">
    <title>{{ config('app.name', 'PIPMS') }} - Administrator</title>
    <link rel="icon" href="/storage/images/pipms_logo.png">
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1"> 
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <script>window.Laravel = { csrfToken: '{{ csrf_token() }}' }</script>
    <!-- Main CSS-->
    <link rel="stylesheet" type="text/css" href="{{ asset('vali/css/main.css') }}">
    <!-- Main Modified CSS -->
    <link rel="stylesheet" type="text/css" href="{{ asset('css/app.css') }}">
    <style>
       /* .app-sidebar {
            background-color: #f8f8f8;   
        }
        .app-sidebar__user {
            color: #333;
        }
        .app-menu__item {
            color: #333;
            &.active,
            &:hover,
            &:focus {
                color: maroon;
            }
        }
        .treeview {
            &.is-expanded {
                [data-toggle='treeview'] {
                    border-left-color: maroon;
                    background: darken(#f8f8f8, 10);
                }
            }
        }
        .treeview-menu {
            background: darken(#f8f8f8, 4);
        }
        .treeview-item {
            color: #333;
            &.active,
            &:hover,
            &:focus{
                background: darken(#f8f8f8, 10);
                color: maroon;
            }
        }
*/
        /*mini*/
/*        .app-menu__label {
            background: darken(#f8f8f8, 10);
        }
        .treeview {
            &:hover {
                .app-menu__item {
                    background: darken(#f8f8f8, 10);
                    border-left-color: maroon;
                    color: maroon;
                }
            }
        }
*/    </style>

    