<!DOCTYPE HTML>
<html lang="en">
<head>
  <meta http-equiv = "content-type" content = "text/html; charset=UTF-8">
  <title>Trav3lling</title>
  <link href="<?= BASE; ?>App/assets/css/bootstrap.min.css" rel="stylesheet">
  <link href="<?= BASE; ?>App/assets/css/font-awesome.css" rel="stylesheet">
  <link href="<?= BASE; ?>App/assets/css/main.css" rel="stylesheet">
  <link href="<?= BASE; ?>App/assets/css/jquery.toast.css" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.5/css/select2.min.css" >
  <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.9.0/fullcalendar.min.css">
  <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.9.0/fullcalendar.print.css">
  <link href="https://fonts.googleapis.com/css?family=Handlee" rel="stylesheet">
  <link rel="icon" href="<?= BASE; ?>App/assets/img/icon-swix-64.png">
  <meta name='viewport' content='width=device-width, initial-scale=1.0, user-scalable=0'>

  <!--<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.12.2/css/bootstrap-select.min.css">-->
  

  <style>

  .menu-swix {



  } 

   /*.navbar-collapse.collapse{
    transition: height 0.2s ;
    }
    .navbar-collapse.collapsing {
        height: auto !important;
    }
    .navbar-collapse.collapse.in{
        max-height: none;
        height: 100vh;
    }
*/
  @media only screen and (min-width: 960px) {
  /*  body {
      height: auto !important;
    }  */ 
    .menu-swix {
     
      height: 80px;


    }

   
  }


</style>

</head>
<body >

  <nav class="navbar navbar-expand-lg navbar-light bg-home fixed-top py-2 menu-swix d-flex justify-content-between">
    <div class="container">
      <div class="logotipo d-flex align-items-center">
        <a class="navbar-brand bg-gradient-primary font-weight-bold" href="<?= BASE; ?>">
          <img src="<?= BASE; ?>App/assets/img/trav3lling_logo.png" style="width: 200px;">
        </a>
      </div>
      <button class="navbar-toggler border-0" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Abrir Navegação">
        <span class="navbar-toggler-icon"></span>
      </button>


      <div id="navbarSupportedContent" class="collapse navbar-collapse ">

        <ul class="nav navbar-nav ml-auto text-uppercase ">
          <li>
            <a class="nav-link <?= ( $this->exp($viewName) == 'home' ? 'active' : '' ); ?>" href="<?= BASE; ?>">Home</a>
          </li>
        <div class="dropdown-divider "></div> 
          <?php if(isset($_SESSION['user']) && !empty($_SESSION['user'])): ?>    

            <li>
              <a class="nav-link <?= ( $this->exp($viewName) == 'search' ? 'active' : '' ); ?>" href="<?= BASE; ?>search" >Search</a>
            </li>
        <div class="dropdown-divider "></div>

            <li class="">
              <a class="nav-link <?= ( $this->exp($viewName) == 'YourSubscribes' ? 'active' : '' ); ?>" href="<?= BASE; ?>yourSubscribes" > Your Subscribes</a>
            </li>
        <div class="dropdown-divider"></div>    
            <li class="">
              <a class="nav-link <?= ( $this->exp($viewName) == 'orders' ? 'active' : '' ); ?>" href="<?= BASE; ?>orders" >Orders</a>
            </li>
        <div class="dropdown-divider "></div>

            <li>
              <a class="nav-link <?= ( $this->exp($viewName) == 'account' ? 'active' : '' ); ?>" href="<?= BASE; ?>account" >Account</a>
            </li>
        <div class="dropdown-divider "></div>
            <li >
              <a class="nav-link <?= ( $this->exp($viewName) == 'donate' ? 'active' : '' ); ?>" href="<?= BASE; ?>donate" >Donate</a>
            </li>
        <div class="dropdown-divider "></div> 
            <li class="mobile-menu d-lg-none">
              <a class="nav-link <?= ( $this->exp($viewName) == 'inbox' ? 'active' : '' ); ?>" href="<?= BASE; ?>inbox">Inbox</a>
            </li>

            <li class="mobile-menu d-lg-none">
              <a class="nav-link <?= ( $this->exp($viewName) == 'profile' ? 'active' : '' ); ?>" href="<?= BASE; ?>profile">Edit Profile</a>
            </li>
            <li class="mobile-menu d-lg-none">
              <a class="nav-link" href="<?= BASE; ?>login/logout">Exit</a>
            </li>


          </ul>
        <div class="dropdown-divider d-md-none d-sm-none"></div>
          <div class="list-unstyled dropdown user-dash clearfix mr-5 d-none d-lg-block"> 
            <div class="pl-5 rounded-bottom " id="dropDownCuston" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">     

              <a id="dropdownMenuLink" > 
               <img src="<?= BASE; ?><?= ($viewData['url'] ? 'App/assets/img/users/'.$viewData['url'] : 'App/assets/img/users/user-img.jpg'); ?>" class="rounded-circle  user-dashboard" data-toggle="tooltip" data-placement="left" title="<?= $this->exp(($viewData['name']) ? $viewData['name'] : ''); ?>" style="width: 64px; height: 64px; text-decoration-style: none !important;"> 
             </a>


            <!--  <span class="dropdown-toggle d-block text-center caret"></span> -->


           </div>
           <div class="dropdown-menu text-center mt-2 mx-auto my-0 box-shadow bg-white border-0 rounded-0" aria-labelledby="dropdownMenuLink">

            <a class="dropdown-item"  href="<?= BASE; ?>inbox">Inbox</a>
            <a class="dropdown-item"  href="<?= BASE; ?>profile">Edit profile</a>
            <a class="dropdown-item"  href="<?= BASE; ?>login/logout">Exit</a>
          </div>
        </div> 
      <?php else: ?> 
        <li class="md-py-2 mx-1 my-1">
          <a class="btn btn-success btn-block" href="<?= BASE; ?>login">Sign In</a>
        </li>
        <li class="md-py-2 mx-1 my-1">
          <a class="btn btn-outline-primary btn-block" href="<?= BASE; ?>register">Sign Up</a>
        </li>


      <?php endif; ?>


    </div>
  </div>

</nav>





<?php $this->loadViewInTemplate($viewName, $viewData); ?>

<footer class="bg-dark text-white my-0">
 <div class="container py-4">
   <div class="row">
     <div class="col-md-3 col-6">
       <h4 class="h6 text-uppercase">Páginas</h4>
       <ul class="list-unstyled">
         <li><a href="planos.html">Planos</a></li>
         <li><a href="contato.html">Contato</a></li>
         <li><a href="inscricao.html">Inscreva-se</a></li>
       </ul>
     </div>

     <div class="col-md-3 col-6">
       <h4 class="h6 text-uppercase">Locais</h4>
       <ul class="list-unstyled">
         <li><a href="local.html">California</a></li>
         <li><a href="local.html">Paris</a></li>
         <li><a href="local.html">Dublin</a></li>
       </ul>
     </div>

     <div class="col-md-4">
       <h4 class="h6 text-uppercase">Dados de contato</h4>
       <ul class="list-unstyled text-secondary">
         <li><a href="mailto:caravan@caravan.com.br">caravan@caravan.com.br</a></li>
         <li><a href="contato.html">85 98581-4800</a></li>
         <li>De Seg. à Sex. das 8h às 18h</li>
       </ul>
     </div>

     <div class="col-md-2">
       <h4 class="h6 text-uppercase">Rede sociais</h4>
       <ul class="list-unstyled">
         <li><a class="btn btn-outline-secondary btn-sm btn-block mb-2" href="#" style="max-width: 140px">Facebook</a></li>
         <li><a class="btn btn-outline-secondary btn-sm btn-block mb-2" href="#" style="max-width: 140px">Twitter</a></li>
         <li><a class="btn btn-outline-secondary btn-sm btn-block mb-2" href="#" style="max-width: 140px">Youtube</a></li>
       </ul>
     </div>
   </div>
 </div>

 <div class="bg-primary text-center py-3">
   <p class="mb-0">Caravan @ 2017. Alguns direitos reservados.</p>
 </div>
</footer>



<script src="https://code.jquery.com/jquery-3.3.1.min.js" integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>
<script type="text/javascript" src="<?= BASE; ?>App/assets/js/jquery.expander.min.js"></script> 
<script src="https://code.jquery.com/ui/1.12.0/jquery-ui.min.js"
    integrity="sha256-eGE6blurk5sHj+rmkfsGYeKyZx3M4bG+ZlFyA7Kns7E="
    crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.5/js/select2.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.5/js/i18n/en.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.22.1/moment.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.9.0/fullcalendar.min.js
"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" crossorigin="anonymous"></script>

    <!-- <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAwCO10-iR4RRUngcqP_m1J47pf-3WdWqM" async defer></script> -->
    <script type="text/javascript" src="<?= BASE; ?>App/assets/js/app.js"></script>  
    <script type="text/javascript">const BASE = '<?= BASE; ?>';</script>
    <!-- <script src="<?// BASE; ?>App/assets/js/jquery.toast.js"></script> -->

    


  <script type="text/javascript">
    $(document).ready(function() {
    // var calendar = $('#calendar').fullCalendar('getCalendar'); calendar.next();
    // $('#calendar').fullCalendar({
    // header: {
    //     left: 'prev,next today',
    //     center: 'title',
    //     right: 'month,agendaWeek,agendaDay,listWeek'
    //   },
    //   defaultDate: '2018-03-12',
    //   navLinks: true, // can click day/week names to navigate views
    //   editable: true,
    //   eventLimit: true, // allow "more" link when too many events
    //   events: [
    //     {
    //       title: 'All Day Event',
    //       start: '2018-03-01',
    //     },
    //     {
    //       title: 'Long Event',
    //       start: '2018-03-07',
    //       end: '2018-03-10'
    //     },
    //     {
    //       id: 999,
    //       title: 'Repeating Event',
    //       start: '2018-03-09T16:00:00'
    //     },
    //     {
    //       id: 999,
    //       title: 'Repeating Event',
    //       start: '2018-03-16T16:00:00'
    //     },
    //     {
    //       title: 'Conference',
    //       start: '2018-03-11',
    //       end: '2018-03-13'
    //     },
    //     {
    //       title: 'Meeting',
    //       start: '2018-03-12T10:30:00',
    //       end: '2018-03-12T12:30:00'
    //     },
    //     {
    //       title: 'Lunch',
    //       start: '2018-03-12T12:00:00'
    //     },
    //     {
    //       title: 'Meeting',
    //       start: '2018-03-12T14:30:00'
    //     },
    //     {
    //       title: 'Happy Hour',
    //       start: '2018-03-12T17:30:00'
    //     },
    //     {
    //       title: 'Dinner',
    //       start: '2018-03-12T20:00:00'
    //     },
    //     {
    //       title: 'Birthday Party',
    //       start: '2018-03-13T07:00:00'
    //     },
    //     {
    //       title: 'Click for Google',
    //       url: 'http://google.com/',
    //       start: '2018-03-28'
    //     }
    //   ]
    // });
  });
  </script>  
    
    <script type="text/javascript">
      $(document).ready(function(){
        $(function () {
            $('.readmore').expander({
                expandText: 'Read More',
                userCollapseText: 'Hidden',
                slicePoint: 235
                
            });
          });  
        });
    </script>
 
    <script type="text/javascript">
     $(document).ready(function() {
      $('#Carousel').carousel({
        interval: 5000
      });
    });

  </script> 


</body>
</html>
