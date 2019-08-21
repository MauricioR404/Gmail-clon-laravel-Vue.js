@extends('layout.app')

@section('content')
<list-messages></list-messages>
@endsection


@push('styles')
    <style>
      .sidebar-menu  li{
        background: #fce8e6;
        border-radius: 0 20px 20px 0;
      }
      
      .skin-blue .sidebar-menu > li:hover > a{
        background: #fce8e6!important;
        border-radius: 0 20px 20px 0;
      }

      .sidebar-menu a{
        color: #d93025!important;
      }

      /* Header */
      .main-header .logo{
        background-color: white!important;
        color: black!important;
      }

      .main-header .navbar{
        margin-left: 0px!important;
      }

      .skin-blue .main-header .navbar .sidebar-toggle:hover{
        background: white!important;
        color: black!important;
      }
      

      .skin-blue .main-header .navbar .sidebar-toggle{
        background: white!important;
        color: black!important;
      }

      @media (min-width: 768px)
      .sidebar-mini.sidebar-collapse .main-header .navbar {
          margin-left: 0px!important; 
      }

      .logo-lg{
        float: left;
        background-color: transparent;
        background-image: none;
        padding: 8px 8px;
        color: black;
        font-size: 24px;
      }
      .skin-blue .main-header .navbar{
        background-color: white!important;
        border-bottom: 1px solid #f4f4f4;
      }
      
      /** efecto positiion fiex*/
      .main-sidebar{
        position: fixed;
      }
      
      .navbar.navbar-static-top{
        position: fixed;
        width: 100%;
      }

      .content-header{
        margin-top: 52px;
      }

    </style>
@endpush