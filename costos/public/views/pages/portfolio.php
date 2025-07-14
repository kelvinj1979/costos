<!-- Projects Section -->
<section id="projects" class="py-20 bg-background">
  <div class="container mx-auto px-4 sm:px-6 lg:px-8">
    <div class="space-y-2 mb-12 text-center">
      <h2 class="text-3xl font-bold">My Projects</h2>
      <p class="text-foreground/70 max-w-2xl mx-auto">
        Explore my recent work across web development, software engineering,
        and data analysis.
      </p>
    </div>

    <div class="flex flex-wrap justify-center gap-3 mb-10">
      <button class="filter-btn active" data-filter="all">All</button>
      <button class="filter-btn" data-filter="web">Web Dev</button>
      <button class="filter-btn" data-filter="software">Software</button>
      <button class="filter-btn" data-filter="data">Data</button>
      <button class="filter-btn" data-filter="mobile">Mobile</button>
    </div>

    <div id="loader" class="hidden">
      <div class="spinner"></div>
    </div>

    <div id="projects-container" class="grid grid-cols-1 md:grid-cols-2 gap-8 projects-container">
      <!-- Los proyectos iniciales se cargan aquí -->
    </div>
  </div>
</section>