<?php
  session_start();
  $user = new User();
  if (isset($_SESSION['session_id']))
    $userdata = $user->userSignedIn($_SESSION['session_id']);
  else
    $userdata = NULL;
?>
<script>
  document.addEventListener('DOMContentLoaded', () => {
  const $navbarBurgers = Array.prototype.slice.call(document.querySelectorAll('.navbar-burger'), 0);
  if ($navbarBurgers.length > 0) {
    $navbarBurgers.forEach( el => {
      el.addEventListener('click', () => {
        const target = el.dataset.target;
        const $target = document.getElementById(target);
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