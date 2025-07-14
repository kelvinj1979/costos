<?php
$start = 0; // Starting index for pagination
$count = 4; // Number of projects to fetch
$projects1 = ControllerPortfolio::ctrShowProject($start, $count);

$proj_details = json_encode($projects1);

 $datos = []; // We use an array instead of a string for better JSON handling.

 foreach ($projects1 as $value) { 
     $info = json_decode($value["project_info"], true);
 
     // We check if there is information in "project_info"
     $completedDate = $info[0]["completedDate"] ?? "";
     $teamSize = $info[0]["teamSize"] ?? "";
     $status = $info[0]["status"] ?? "";
 
     // We build the project array
     $proyecto = [
         "id" => $value["project_id"],
         "title" => $value["project_name"],
         "description" => $value["overview"],
         "image" => $value["project_img"],
         "tags" => json_decode($value["tags"], true) ?? [],
         "technologies" => json_decode($value["technologies"], true) ?? [],
         "liveUrl" => $value["live_demo"],
         "githubUrl" => $value["view_code"],
         "completedDate" => $completedDate,
         "teamSize" => $teamSize,
         "status" => $status,
         "features" => json_decode($value["key_features"], true) ?? [],
         "challenge" => $value["challenges_solutions"]
     ];
 
     // We add the project to the main array
     $datos[] = $proyecto;
 }
 
 //echo json_encode($datos, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);
 

?>
<div id="info1" data-json='<?php echo json_encode($datos); ?>'></div>
<!-- Projects Section -->
    <section id="projects" class="py-20 bg-background">
      <div class="container mx-auto px-4 sm:px-6 lg:px-8">
        <div class="space-y-2 mb-12 text-center animate-on-scroll">
          <h2 class="text-3xl font-bold">My Projects</h2>
          <p class="text-foreground/70 max-w-2xl mx-auto">
            Explore my recent work across web development, software engineering,
            and data analysis.
          </p>
        </div>

        <div class="flex flex-wrap justify-center gap-3 mb-10 animate-on-scroll">
          <button class="filter-btn active" data-filter="all">All</button>
          <button class="filter-btn" data-filter="web">Web Dev</button>
          <button class="filter-btn" data-filter="software">Software</button>
          <button class="filter-btn" data-filter="data">Data</button>
          <button class="filter-btn" data-filter="mobile">Mobile</button>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-8 projects-container">
          <!-- Project 1 -->
          <?php foreach ($projects1 as $key => $value): 
            
            $jsonString = $value["tags"]; // JSON en formato string
            $tags = json_decode($jsonString, true); // Convertir JSON a array PHP

            if (is_array($tags)) {
                $tags_detail = implode(",", $tags);              
            } else {
                echo "Error: JSON inválido";
            }  
                      ?>
          
          <div class="project-card animate-on-scroll" data-tags="<?php echo $tags_detail; ?>" data-project-id="<?php echo $value["project_id"]; ?>">
            <div class="relative h-48 mb-4 overflow-hidden rounded-md">
              <img src="<?php echo $value["project_img"]; ?>" alt="E-Commerce Dashboard" class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-105">
              <div class="absolute inset-0 bg-gradient-to-t from-background to-transparent"></div>
              <div class="absolute bottom-4 left-4 flex space-x-3">
                <?php
                  $tags = json_decode($value["technologies"], true);
                  foreach ($tags as $key => $tag) {
                    echo '<span class="text-xs font-medium py-1 px-2 rounded-full bg-background/80 backdrop-blur-sm">'.$tag.'</span>';
                  }
                ?>
              </div>
            </div>

            <h3 class="text-xl font-bold mb-2"><?php echo $value["project_name"]; ?></h3>
            <p class="text-foreground/70 mb-4"><?php echo $value["description"]; ?></p>

            <div class="flex items-center justify-between mt-auto pt-4 border-t border-border">
              <div class="flex space-x-3">
                <a href="<?php echo $value["view_code"]; ?>" target="_blank" rel="noopener noreferrer" class="text-foreground/70 hover:text-primary transition-colors" aria-label="GitHub repository">
                  <i data-lucide="github" class="h-5 w-5"></i>
                </a>
                <a href="<?php echo $value["live_demo"]; ?>" target="_blank" rel="noopener noreferrer" class="text-foreground/70 hover:text-primary transition-colors" aria-label="Live demo">
                  <i data-lucide="external-link" class="h-5 w-5"></i>
                </a>
              </div>
              <button class="btn-ghost text-primary group-hover:translate-x-1 transition-transform view-details-btn">
                View Details <i data-lucide="chevron-right" class="ml-1 h-4 w-4"></i>
              </button>
            </div>
          </div>

          <?php endforeach ?>

         
        </div>

        <div class="text-center mt-12 animate-on-scroll">
          <a href="<?php echo $portfolio["domain"].'portfolio' ?>" target="_self" rel="noopener noreferrer" class="btn btn-outline btn-lg">
            View All Projects <i data-lucide="app-window" class="ml-2 h-4 w-4"></i>
          </a>
        </div>
      </div>
    </section>
