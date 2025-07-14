
<main>
    <!-- Hero Section -->
    <section id="home" class="min-h-screen flex flex-col justify-center pt-16 pb-20">
      <div class="container mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 items-center">
          <div class="flex flex-col space-y-6 animate-fade-in">
            <div class="space-y-2">
              <p class="text-primary font-medium animate-fade-in-delay-2">Hello, I'm</p>
              <h1 class="text-4xl md:text-5xl lg:text-6xl font-bold animate-fade-in-delay-3"><?php echo $portfolio["name"]; ?></h1>
              <h2 class="text-2xl md:text-3xl lg:text-4xl font-semibold gradient-text animate-fade-in-delay-4"><?php echo $portfolio["title"];  ?></h2>
            </div>

            <p class="text-foreground/80 text-lg max-w-xl animate-fade-in-delay-5">
              <?php echo $portfolio["description"]; ?>
            </p>

            <div class="flex flex-wrap gap-4 animate-fade-in-delay-6">
              <a href="<?php echo $portfolio["domain"]; ?>#projects" class="btn btn-primary">View My Work</a>
              <a href="<?php echo $portfolio["domain"]; ?>#contact" class="btn btn-outline">Get In Touch</a>
            </div>

            <div class="flex items-center space-x-4 pt-2 animate-fade-in-delay-7">
              <?php

              $social = json_decode($portfolio["social_networks"], true);
           
              foreach ($social as $key => $value) {
                echo '<a href="'.$value["url"].'" target="_blank" rel="noopener noreferrer" class="text-foreground/80 hover:text-primary transition-colors" aria-label="GitHub">
                        <i data-lucide="'.$value["icon"].'" class="h-6 w-6"></i>
                      </a>';
              }
              ?>
              
              <a href="mailto:<?php echo $portfolio["email"]; ?>" class="text-foreground/80 hover:text-primary transition-colors" aria-label="Email">
                <i data-lucide="mail" class="h-6 w-6"></i>
              </a>
            </div>
          </div>

          <div class="relative hidden lg:block animate-fade-in-scale">
            <div class="relative w-full h-[500px] rounded-2xl overflow-hidden">
              <img src="<?php echo $portfolio["cover_img"];  ?>" alt="Developer working on code" class="w-full h-full object-cover">
              <div class="absolute inset-0 bg-gradient-to-t from-background via-background/40 to-transparent"></div>
            </div>
            
            <div class="absolute -bottom-6 -left-6 w-32 h-32 bg-primary/20 rounded-full blur-2xl"></div>
            <div class="absolute -top-6 -right-6 w-32 h-32 bg-primary/20 rounded-full blur-2xl"></div>
          </div>
        </div>

        <div class="absolute bottom-10 left-1/2 transform -translate-x-1/2 hidden md:flex flex-col items-center animate-fade-in-delay-8">
          <span class="text-foreground/60 text-sm mb-2">Scroll Down</span>
          <div class="animate-bounce">
            <i data-lucide="arrow-down" class="h-5 w-5 text-primary"></i>
          </div>
        </div>
      </div>
    </section>