<!-- Header/Navbar -->
<header class="fixed top-0 left-0 right-0 z-50 transition-all duration-300" id="header">
    <div class="container mx-auto px-4 sm:px-6 lg:px-8">
      <div class="flex h-16 items-center justify-between">
        <!-- Logo -->
        <div class="flex items-center space-x-2">
          <i data-lucide="code" class="h-8 w-8 text-primary"></i>
          <span class="text-xl font-bold">
            <a href="<?php echo $portfolio["domain"] ?>">
              <?php echo $portfolio["logo"] ?>
            </a> 
        </span>
        </div>

        <!-- Desktop Navigation -->
        <nav class="hidden md:flex space-x-8">
          <a href="<?php echo $portfolio["domain"]; ?>#home" class="nav-link text-sm font-medium transition-colors text-primary">Home</a>
          <a href="<?php echo $portfolio["domain"]; ?>#projects" class="nav-link text-sm font-medium transition-colors text-foreground/80 hover:text-foreground">Projects</a>
          <a href="<?php echo $portfolio["domain"]; ?>#about" class="nav-link text-sm font-medium transition-colors text-foreground/80 hover:text-foreground">About</a>
          <a href="<?php echo $portfolio["domain"]; ?>#contact" class="nav-link text-sm font-medium transition-colors text-foreground/80 hover:text-foreground">Contact</a>
        </nav>

        <!-- Social Links -->
        <div class="hidden md:flex items-center space-x-4">
        <?php
          
          $social = json_decode($portfolio["social_networks"], true);
           
          foreach ($social as $key => $value) {
            echo '<a href="'.$value["url"].'" target="_blank" rel="noopener noreferrer" class="text-foreground/80 hover:text-primary transition-colors">
                    <i data-lucide="'.$value["icon"].'" class="h-5 w-5"></i>
                  </a>';
          }
        ?>            
        </div>

        <!-- Mobile Menu Button -->
        <div class="md:hidden">
          <button id="mobile-menu-button" class="text-foreground hover:text-primary transition-colors">
            <i data-lucide="menu" class="h-6 w-6" id="menu-icon"></i>
            <i data-lucide="x" class="h-6 w-6 hidden" id="close-icon"></i>
          </button>
        </div>
      </div>
    </div>

    <!-- Mobile Menu -->
    <div id="mobile-menu" class="md:hidden bg-background/95 backdrop-blur-md border-b border-border hidden">
      <div class="container mx-auto px-4 py-4 space-y-4">
        <a href="<?php echo $portfolio["domain"]; ?>#home" class="block py-2 text-base font-medium text-primary">Home</a>
        <a href="<?php echo $portfolio["domain"]; ?>#projects" class="block py-2 text-base font-medium text-foreground/80">Projects</a>
        <a href="<?php echo $portfolio["domain"]; ?>#about" class="block py-2 text-base font-medium text-foreground/80">About</a>
        <a href="<?php echo $portfolio["domain"]; ?>#contact" class="block py-2 text-base font-medium text-foreground/80">Contact</a>
        <div class="flex space-x-4 pt-2">
        <?php
          
          $social = json_decode($portfolio["social_networks"], true);
           
          foreach ($social as $key => $value) {
            echo '<a href="'.$value["url"].'" target="_blank" rel="noopener noreferrer" class="text-foreground/80 hover:text-primary transition-colors">
                    <i data-lucide="'.$value["icon"].'" class="h-5 w-5"></i>
                  </a>';
          }
        ?> 
        </div>
      </div>
    </div>
  </header>