<nav class="navbar navbar-expand-md navbar-dark bg-dark mb-4">
  <a class="navbar-brand" href="/"><img src="storage/mainmenu_logo.png"></a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse" id="navbarCollapse">
    <ul class="navbar-nav mr-auto">
      <li class="nav-item {{ Request::is('agriculture') ? 'active' : '' }}">
        <a class="nav-link" href="/agriculture">Agriculture</a>
      </li>
      <li class="nav-item">
        <a class="nav-link {{ Request::is('energy') ? 'active' : '' }}" href="/energy">Energy</a>
      </li>
      <li class="nav-item">
        <a class="nav-link {{ Request::is('forestry') ? 'active' : '' }}" href="/forestry">Forestry</a>
      </li>
      <li class="nav-item">
        <a class="nav-link {{ Request::is('water') ? 'active' : '' }}" href="/water">Water</a>
      </li>
      <li class="nav-item">
        <a class="nav-link {{ Request::is('gender') ? 'active' : '' }}" href="/gender">Gender</a>
      </li>
      <li class="nav-item">
        <a class="nav-link {{ Request::is('land-rights') ? 'active' : '' }}" href="/land-rights">Land Rights</a>
      </li>
      <li class="nav-item">
        <a class="nav-link {{ Request::is('gov-links') ? 'active' : '' }}" href="/gov-links">Gov Links</a>
      </li>
      <li class="nav-item">
        <a class="nav-link {{ Request::is('tree_diagram') ? 'active' : '' }}" href="/tree_diagram">Beneficiaries</a>
      </li>
    </ul>
    <!--<form class="form-inline mt-2 mt-md-0">
      <input class="form-control mr-sm-2" type="text" placeholder="Search" aria-label="Search">
      <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
  </form>-->
  </div>
</nav>
