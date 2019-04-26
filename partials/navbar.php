<?php 
  session_start();
  $user = new User();
  $userdata = $user->userSignedIn($_SESSION['session_id']);
?>
<script>
  document.addEventListener('DOMContentLoaded', () => {

  // Get all "navbar-burger" elements
  const $navbarBurgers = Array.prototype.slice.call(document.querySelectorAll('.navbar-burger'), 0);

  // Check if there are any navbar burgers
  if ($navbarBurgers.length > 0) {

    // Add a click event on each of them
    $navbarBurgers.forEach( el => {
      el.addEventListener('click', () => {

        // Get the target from the "data-target" attribute
        const target = el.dataset.target;
        const $target = document.getElementById(target);

        // Toggle the "is-active" class on both the "navbar-burger" and the "navbar-menu"
        el.classList.toggle('is-active');
        $target.classList.toggle('is-active');

      });
    });
  }

  });
</script>

<nav class="navbar has-background-grey-lighter" role="navigation" aria-label="main navigation">
  <div class="navbar-brand">
    <a class="navbar-item" href="/index.php">
      <img src="/img/logo.png" width="112" height="28">
    </a>

    <a role="button" class="navbar-burger burger" aria-label="menu" aria-expanded="false" data-target="navbarBasicExample">
      <span aria-hidden="true"></span>
      <span aria-hidden="true"></span>
      <span aria-hidden="true"></span>
    </a>
  </div>

  <div id="navbarBasicExample" class="navbar-menu">
    <div class="navbar-start">
      <a class="navbar-item" href="/index.php">
        Home
      </a>

      <a class="navbar-item" href="/galerie.php">
        Galerie
      </a>
    <?php if ($userdata) { ?>
      <a class="navbar-item" href="/montage">
        Montage
      </a>
    <?php } ?>

      <div class="navbar-item has-dropdown is-hoverable">
        <a class="navbar-link">
          More
        </a>

        <div class="navbar-dropdown">
          <a class="navbar-item">
            About
          </a>
          <a class="navbar-item">
            Jobs
          </a>
          <a class="navbar-item">
            Contact
          </a>
          <hr class="navbar-divider">
          <a class="navbar-item">
            Report an issue
          </a>
        </div>
      </div>
    </div>

    <div class="navbar-end">
      <div class="navbar-item">
        <div class="buttons">
        <?php if (!$userdata) { ?>
          <a class="button is-primary" href="/user/sign_up.php">
            <strong>Sign up</strong>
          </a>
          <a class="button is-light" href="/user/login.php">
            Log in
          </a>
        <?php }
          else 
          { ?>
          <a class="button is-primary" href="/user/modif.php">
            <strong>Modify account</strong>
          </a>
          <a class="button is-danger" href="/index.php?action=logout">
            <strong>Log out</strong>
          </a>
          <?php } ?>
        </div>
      </div>
    </div>
  </div>
</nav>