<header>
  <!-- header em inglês by luizzmg -->

  <link rel="stylesheet" href="/site/header/style.css">

  <nav class="nav-bar"> <!-- barra de navegação desktop -->
      
    <!-- logo do site que leva à página inicial -->
    <div><a href="/site/">
      <img class="logo" src="/site/assets/images/DiscoveryLogo.png">
    </a></div>
      
    <!-- navegação entre as principais partes do site (para desktop) -->
    <div class="nav-list">
      
      <div class="nav-item"> <!-- home -->
        <a class="nav-link" href="/site/">
          Home
          <hr class="title-lines">
        </a>
      </div>
      
      <div class="nav-item"> <!-- services -->
        
        <a class="nav-link" href="#">
          Services
          <hr class="title-lines">
        </a>
        
        <ul class="item-content">
          <li>
            <a href="/site/nif/">Get your NIF<br>
              <hr class="sub-lines"><br>
              <p>Your NIF, your gateway to Portugal</p>
            </a>
          </li>
          <li>
            <a href="/site/niss/">Get your NISS<br>
              <hr class="sub-lines"><br>
              <p>Start your journey in Portugal</p>
            </a>
          </li>
        </ul>
        
      </div>
      
      <div class="nav-item"> <!-- contact us -->
        <a class="nav-link" href="/site/contact-us/">
          Contact us
          <hr class="title-lines">
        </a>
      </div>
      
      <div class="nav-item"> <!-- about-us -->
        <a class="nav-link" href="/site/about-us/">
          About us
          <hr class="title-lines">
        </a>
      </div>
      
    </div>
    
    <!-- seleção de idiomas desktop -->
    <div class="language-selector">
      
      <!-- botão da linguagem atual -->
      <!-- ao passar o mouse em cima, exibe as opções de mudança de idioma -->
      <button class="idioma-atual-desktop">
        <!-- inglês --><img class="icons-language" src ="/site/assets/images/countries/united-kingdom.png"> EN
      </button>
      
      <ul class="language-selector-content">
        <!--português--><li><a href="pt.html" class="opcao-idioma"><img class="icons-language" src ="/site/assets/images/countries/portugal.png"> PT</a></li>
        <!--espanhol--><li><a href="es.html" class="opcao-idioma"><img class="icons-language" src ="/site/assets/images/countries/spain.png"> ES</a></li>
        <!--francês--><li><a href="fr.html" class="opcao-idioma"><img class="icons-language" src ="/site/assets/images/countries/france.png"> FR</a></li>
        <!--italiano--><li><a href="it.html" class="opcao-idioma"><img class="icons-language" src ="/site/assets/images/countries/italy.png"> IT</a></li>
        <!--alemão--><li><a href="de.html" class="opcao-idioma"><img class="icons-language" src ="/site/assets/images/countries/germany.png"> DE</a></li>
      </ul>
      
    </div>
    
    <!-- botão que exibe menu mobile (aqueles "três tracinhos")-->
    <div class="mobile-menu-icon">
      <button onclick="menuShow()">
        <img class="icon" src="/site/assets/mobile-icons/menu_white_36dp.svg" alt="">
      </button>
    </div>
    
  </nav>

  <!-- menu que aparece ao clicar nos "três tracinhos" -->
  <div class="mobile-menu">
    <ul>
      
      <li class="nav-item"><a class="nav-link" href="/site/"> <!-- home -->
        Home
      </a></li>
      <li class="nav-item"><a class="nav-link" href="/site/nif/"> <!-- services -->
        Get your NIF
      </a></li>
      <li class="nav-item"><a class="nav-link" href="/site/niss/"> <!-- services -->
        Get your NISS
      </a></li>
      <li class="nav-item"><a class="nav-link" href="/site/contact-us/"> <!-- contact us -->
        Contact us
      </a></li>
      <li class="nav-item"><a class="nav-link" href="/site/about-us/"> <!-- about us -->
        About us
      </a></li>
      <li class="nav-item nav-link"> <!-- language -->
        Language:
      </li>
      
      <!-- opções de idiomas (versão de celular) -->
      <li class="language-selector-mobile">

        <!-- inglês ----><button class = "ling-opcoes" id="ling-atual"><img class="icons-language" src ="/site/assets/images/countries/united-kingdom.png"></button>
        <!-- português--><a href="pt.html"><button class="ling-opcoes"><img class="icons-language" src ="/site/assets/images/countries/portugal.png"></button></a>
        <!-- espanhol --><a href="es.html"><button class = "ling-opcoes"><img class="icons-language" src ="/site/assets/images/countries/spain.png"></button></a>
        <!-- francês ---><a href="fr.html"><button class = "ling-opcoes"><img class="icons-language" src ="/site/assets/images/countries/france.png"></button></a>
        <!-- italiano---><a href="it.html"><button class = "ling-opcoes"><img class="icons-language" src ="/site/assets/images/countries/italy.png"></button></a>
        <!-- alemão-----><a href="de.html"><button class = "ling-opcoes"><img class="icons-language" src ="/site/assets/images/countries/germany.png"></button></a>

      </li>

    </ul>
  </div>

</header>