
    <!-- About Section -->
    <section id="about" class="py-20 bg-background">
      <div class="container mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-12">
          <div class="lg:col-span-1 animate-on-scroll">
            <div class="sticky top-24">
              <h2 class="text-3xl font-bold mb-6">About Me</h2>
              <div class="relative overflow-hidden rounded-xl mb-6">
                <img src="<?php echo $portfolio["photo"]; ?>" alt="John Doe" class="w-full aspect-square object-cover">
                <div class="absolute inset-0 bg-gradient-to-t from-background via-transparent to-transparent"></div>
              </div>
              <p class="text-foreground/80 mb-6">
                
              <?php echo $portfolio["about_me"]; ?>

              </p>
              <a href="<?php echo $portfolio["resume"]; ?>" download class="btn btn-primary w-full">
                <i data-lucide="file-text" class="mr-2 h-4 w-4"></i> Download Resume
              </a>
            </div>
          </div>

          <div class="lg:col-span-2 space-y-12">
            <!-- Skills -->
            <div class="space-y-4 animate-on-scroll">
              <div class="flex items-center space-x-2">
                <i data-lucide="award" class="h-5 w-5 text-primary"></i>
                <h3 class="text-xl font-bold">Skills & Expertise</h3>
              </div>
              <div class="flex flex-wrap gap-2">
              <?php
                $skills = json_decode($portfolio["skills"], true);
           
                foreach ($skills as $key => $value) {
                  echo '<span class="skill-item">'.$value.'</span>';
                }               

              ?>
                
              </div>
            </div>

            <!-- Experience -->
            <div class="space-y-4 animate-on-scroll">
              <div class="flex items-center space-x-2">
                <i data-lucide="briefcase" class="h-5 w-5 text-primary"></i>
                <h3 class="text-xl font-bold">Work Experience</h3>
              </div>
              <div class="space-y-6">

              <?php foreach ($experience as $key => $value): ?>

                <div class="relative pl-6 border-l border-border">
                  <div class="absolute right-0 top-0 transform translate-x-full h-3 w-3 rounded-full bg-primary"></div>
                  <div class="space-y-1">
                    <h4 class="text-lg font-semibold"><?php echo $value["experience"]; ?></h4>
                    <div class="flex items-center text-sm text-foreground/70">
                      <span><?php echo $value["company"]; ?></span>
                      <span class="mx-2">•</span>
                      <span><?php echo $value["start_date"].' - '.$value["end_date"]; ?></span>
                    </div>
                    <p class="text-foreground/80"><?php echo $value["exp_detail"]; ?></p>
                  </div>
                </div>

              <?php endforeach ?>

              </div>
            </div>

            <!-- Education -->
            <div class="space-y-4 animate-on-scroll">
              <div class="flex items-center space-x-2">
                <i data-lucide="graduation-cap" class="h-5 w-5 text-primary"></i>
                <h3 class="text-xl font-bold">Education</h3>
              </div>
              <div class="space-y-6">

              <?php foreach ($education as $key => $value): ?>

                <div class="relative pl-6 border-l border-border">
                  <div class="absolute right-0 top-0 transform translate-x-full h-3 w-3 rounded-full bg-primary"></div>
                  <div class="space-y-1">
                    <h4 class="text-lg font-semibold"><?php echo $value["education"]; ?></h4>
                    <div class="flex items-center text-sm text-foreground/70">
                      <span><?php echo $value["institution"]; ?></span>
                      <span class="mx-2">•</span>
                      <span><?php echo $value["start_date"].' - '.$value["end_date"]; ?></span>
                    </div>
                    <p class="text-foreground/80"><?php echo $value["edu_detail"]; ?></p>
                  </div>
                </div>

              <?php endforeach ?>
                
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
