<?php

if ($portfolio) {
  $location = json_decode($portfolio["location"], true);

  $link = "";
  $city = "";

  foreach ($location as $key => $value) {
      $link = $value["link"];
      $city = $value["city"];
  }
} else {
  echo "Error: The portfolio could not be obtained.";
}


?>


    <!-- Contact Section -->
    <section id="contact" class="py-20 bg-background">
      <div class="container mx-auto px-4 sm:px-6 lg:px-8">
        <div class="space-y-2 mb-12 text-center animate-on-scroll">
          <h2 class="text-3xl font-bold">Get In Touch</h2>
          <p class="text-foreground/70 max-w-2xl mx-auto">
            Have a project in mind or want to discuss potential opportunities? Feel
            free to reach out!
          </p>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-2 gap-12">
          <div class="space-y-8 animate-on-scroll">
            <div class="space-y-4">
              <h3 class="text-xl font-semibold">Contact Information</h3>
              <p class="text-foreground/70">
                Feel free to reach out through any of the following channels. I'm
                always open to discussing new projects, creative ideas, or
                opportunities to be part of your vision.
              </p>
            </div>

            <div class="space-y-4">
              <a href="mailto:<?php echo $portfolio["email"];  ?>" class="flex items-center p-4 rounded-lg border border-border bg-card hover:border-primary/50 transition-colors">
                <div class="mr-4">
                  <i data-lucide="mail" class="h-5 w-5 text-primary"></i>
                </div>
                <div>
                  <h4 class="text-sm font-medium text-foreground/70">Email</h4>
                  <p class="font-medium"><?php echo $portfolio["email"];  ?></p>
                </div>
              </a>

              <a href="tel:<?php echo $portfolio["phones"];  ?>" class="flex items-center p-4 rounded-lg border border-border bg-card hover:border-primary/50 transition-colors">
                <div class="mr-4">
                  <i data-lucide="phone" class="h-5 w-5 text-primary"></i>
                </div>
                <div>
                  <h4 class="text-sm font-medium text-foreground/70">Phone</h4>
                  <p class="font-medium"><?php echo $portfolio["phones"];  ?></p>
                </div>
              </a>

              <a href="<?php echo $link; ?>" target="_blank" rel="noopener noreferrer" class="flex items-center p-4 rounded-lg border border-border bg-card hover:border-primary/50 transition-colors">
                <div class="mr-4">
                  <i data-lucide="map-pin" class="h-5 w-5 text-primary"></i>
                </div>
                <div>                 
                  <h4 class="text-sm font-medium text-foreground/70">Location</h4>
                  <p class="font-medium"><?php echo $city;  ?></p>
                </div>
              </a>
            </div>

            <div class="relative h-64 rounded-lg overflow-hidden">
              <img src="views/img/contact1.avif" alt="Contact" class="w-full h-full object-cover">
              <div class="absolute inset-0 bg-gradient-to-t from-background via-background/40 to-transparent"></div>
            </div>
          </div>

          <div class="animate-on-scroll">
            <form id="contact-form" class="space-y-6">
              <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                <div class="space-y-2">
                  <label for="name" class="text-sm font-medium text-foreground/70">Your Name</label>
                  <input id="name" name="name" type="text" required class="contact-input w-full" placeholder="John Doe">
                </div>
                <div class="space-y-2">
                  <label for="email" class="text-sm font-medium text-foreground/70">Your Email</label>
                  <input id="email" name="email" type="email" required class="contact-input w-full" placeholder="john@example.com">
                </div>
              </div>

              <div class="space-y-2">
                <label for="subject" class="text-sm font-medium text-foreground/70">Subject</label>
                <input id="subject" name="subject" type="text" required class="contact-input w-full" placeholder="Project Inquiry">
              </div>

              <div class="space-y-2">
                <label for="message" class="text-sm font-medium text-foreground/70">Message</label>
                <textarea id="message" name="message" required rows="6" class="contact-input w-full resize-none" placeholder="Hello, I'd like to talk about..."></textarea>
              </div>

              <button type="submit" class="btn btn-primary w-full">
                Send Message <i data-lucide="send" class="ml-2 h-4 w-4"></i>
              </button>
             
            </form>
          </div>
        </div>
      </div>
    </section>
  </main>
