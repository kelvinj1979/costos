
  <!-- Footer -->
  <footer class="bg-secondary py-12">
    <div class="container mx-auto px-4 sm:px-6 lg:px-8">
      <div class="flex flex-col items-center">
        <div class="flex items-center space-x-2 mb-6">
          <i data-lucide="code" class="h-8 w-8 text-primary"></i>
          <span class="text-xl font-bold"><a href="<?php echo $portfolio["domain"] ?>">
          <?php echo $portfolio["logo"] ?></a></span>
        </div>

        <div class="flex space-x-8 mb-8">
          <a href="<?php echo $portfolio["domain"]; ?>#home" class="text-foreground/70 hover:text-primary transition-colors">Home</a>
          <a href="<?php echo $portfolio["domain"]; ?>#projects" class="text-foreground/70 hover:text-primary transition-colors">Projects</a>
          <a href="<?php echo $portfolio["domain"]; ?>#about" class="text-foreground/70 hover:text-primary transition-colors">About</a>
          <a href="<?php echo $portfolio["domain"]; ?>#contact" class="text-foreground/70 hover:text-primary transition-colors">Contact</a>
        </div>

        <div class="flex items-center space-x-6 mb-8">
          <a href="https://github.com/kelvinj1979" target="_blank" rel="noopener noreferrer" class="text-foreground/70 hover:text-primary transition-colors" aria-label="GitHub">
            <i data-lucide="github" class="h-5 w-5"></i>
          </a>
          <a href="https://linkedin.com/in/kelvin-jimenez/" target="_blank" rel="noopener noreferrer" class="text-foreground/70 hover:text-primary transition-colors" aria-label="LinkedIn">
            <i data-lucide="linkedin" class="h-5 w-5"></i>
          </a>
          <a href="mailto:kelvin.jimenez@gmail.com" class="text-foreground/70 hover:text-primary transition-colors" aria-label="Email">
            <i data-lucide="mail" class="h-5 w-5"></i>
          </a>
        </div>

        <div class="text-center text-foreground/60 text-sm">
          <p>© <span id="current-year"></span> Kelvin Jimenez. All rights reserved.</p>
        </div>

        <button id="scroll-to-top" class="mt-8 p-3 rounded-full bg-primary/10 text-primary hover:bg-primary/20 transition-colors" aria-label="Scroll to top">
          <i data-lucide="arrow-up" class="h-5 w-5"></i>
        </button>
      </div>
    </div>
  </footer>
