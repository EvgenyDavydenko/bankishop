</head>
  <body>
    <header class="mb-5">
        <nav class="navbar navbar-expand-lg bg-dark border-bottom border-body" data-bs-theme="dark">
            <div class="container">
              <a class="navbar-brand" href="{{ route('images.index') }}">Banki.shop</a>
              <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
              </button>
              <div class="collapse navbar-collapse" id="navbarSupportedContent">

                @include('layouts.sort')
                @include('layouts.upload')

                <ul class="navbar-nav ms-auto mb-2 mb-lg-0">

                  <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                      API
                    </a>
                    <ul class="dropdown-menu">
                    <li><a class="dropdown-item" href="/api/images">GET Images </a></li>
                    <li><a class="dropdown-item" href="/api/images/1">GET Images/{id} </a></li>
                    </ul>
                  </li>

                </ul>
              </div>
            </div>
          </nav>
    </header>
  