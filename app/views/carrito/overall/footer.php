<?php

$template = '
<footer class="page-footer font-small unique-color-dark pt-4">
    <div class="container">
      <ul class="list-unstyled list-inline text-center py-2">
        <li class="list-inline-item">
          <h5 class="mb-1">Registrate Gratis</h5>
        </li>
        <li class="list-inline-item">
          <a data-toggle="modal" data-target="#modalLRFormDemo" class="btn btn-outline-white btn-rounded">Registrarse!</a>
        </li>
      </ul>
    </div>
    <div class="footer-copyright text-center py-3">© 2018 Programación Web 2
      <a href="#" class="d-block">Peralta Christian - Garra Martín - Prada Alexander</a>
    </div>
  </footer>
  <script src="./public/js/jquery-3.3.1.min.js"></script>
  <script src="./public/js/bootstrap.min.js"></script>
  <script src="./public/js/mdb.min.js"></script>
</body>
</html>';

printf($template);