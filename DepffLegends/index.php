<?php
  require "header.php";
 ?>

 <main>
    <div class="wrapper">
     <section class="section-default">
       <div class="login-status">
       <?php
          if (isset($_SESSION['userId'])) {
            echo '<p>You are logged in!</p>';
          }
          else {
            echo '<p>You are Logged out!</p>';
          }
        ?>
        </div>
      </section>
    </div>

    <!-- Blurred image -->
    <div class="wrapper">
     <section class="showcase">
      <div class="content">
        <img src="assets/logo.png" class="logo" alt="AJLeague">
        <div class="title">
          Welcome To AJLeague
        </div>
      </div>
    </section>
  </div>

    <!-- Services -->
    <section class="services bg-dark">
      <div class="container grid-4 center">
        <div>
          <i class="fas fa-search fa-3x"> </i>
          <h3>Search Feature</h3>
          <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit,
          sed do eiusmod.</p>
        </div>
        <div>
          <i class="fas fa-chalkboard-teacher fa-3x"></i>
          <h3>Guides</h3>
          <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit,
          sed do eiusmod.</p>
        </div>
        <div>
          <i class="fas fa-theater-masks fa-3x"></i>
          <h3>Champions</h3>
          <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit,
          sed do eiusmod.</p>
        </div>
        <div>
          <i class="far fa-comments fa-3x"></i>
          <h3>Blog</h3>
          <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit,
          sed do eiusmod.</p>
        </div>
      </div>
    </section>


  </main>

 <?php
 require "footer.php";
 ?>
