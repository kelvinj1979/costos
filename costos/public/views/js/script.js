let projects = []; // Declarar como variable global

document.addEventListener('DOMContentLoaded', function() {
  // Configurar los filtros al cargar la página
  setupFilters();

  const div = document.getElementById('info1');
  if (div) {
    try {
      const datos = JSON.parse(div.getAttribute('data-json'));
      console.log(datos);
      projects = Array.isArray(datos) ? datos : []; // Asegúrate de que sea un array
    } catch (error) {
      console.error('Error al parsear el JSON del atributo data-json:', error);
      projects = []; // Inicializa como un array vacío en caso de error
    }
  } else {
    console.error('El elemento con id="info1" no existe en el DOM.');
    projects = []; // Inicializa como un array vacío si el elemento no existe
  }
 
  // Initialize Lucide icons
  if (typeof lucide !== 'undefined') {
    lucide.createIcons();
  }
  
  // Set current year in footer
  document.getElementById('current-year').textContent = new Date().getFullYear();
  
  // Mobile menu toggle
  const mobileMenuButton = document.getElementById('mobile-menu-button');
  const mobileMenu = document.getElementById('mobile-menu');
  const menuIcon = document.getElementById('menu-icon');
  const closeIcon = document.getElementById('close-icon');
  
  mobileMenuButton.addEventListener('click', function() {
    mobileMenu.classList.toggle('hidden');
    menuIcon.classList.toggle('hidden');
    closeIcon.classList.toggle('hidden');
  });
  
  // Close mobile menu when clicking on a link
  const mobileMenuLinks = mobileMenu.querySelectorAll('a');
  mobileMenuLinks.forEach(link => {
    link.addEventListener('click', function() {
      mobileMenu.classList.add('hidden');
      menuIcon.classList.remove('hidden');
      closeIcon.classList.add('hidden');
    });
  });
  
  // Navbar background change on scroll
  const header = document.getElementById('header');
  window.addEventListener('scroll', function() {
    if (window.scrollY > 50) {
      header.classList.add('bg-background/80', 'backdrop-blur-md', 'shadow-md');
    } else {
      header.classList.remove('bg-background/80', 'backdrop-blur-md', 'shadow-md');
    }
    
    // Update active section in navbar
    updateActiveSection();
  });
  
  // Scroll to top button
  const scrollToTopButton = document.getElementById('scroll-to-top');
  scrollToTopButton.addEventListener('click', function() {
    window.scrollTo({
      top: 0,
      behavior: 'smooth'
    });
  });
  
  // Smooth scroll for navigation links
  const navLinks = document.querySelectorAll('a[href^="#"]');
  navLinks.forEach(link => {
    link.addEventListener('click', function(e) {
      e.preventDefault();
      
      const targetId = this.getAttribute('href');
      const targetElement = document.querySelector(targetId);
      
      if (targetElement) {
        // Add offset for fixed header
        const headerHeight = document.getElementById('header').offsetHeight;
        const targetPosition = targetElement.getBoundingClientRect().top + window.pageYOffset - headerHeight;
        
        window.scrollTo({
          top: targetPosition,
          behavior: 'smooth'
        });
        
        // Update URL hash without jumping
        history.pushState(null, null, targetId);
      }
    });
  });
  
  // Check for hash in URL on page load and scroll to it
  if (window.location.hash) {
    const targetElement = document.querySelector(window.location.hash);
    if (targetElement) {
      // Delay to ensure page is fully loaded
      setTimeout(() => {
        const headerHeight = document.getElementById('header').offsetHeight;
        const targetPosition = targetElement.getBoundingClientRect().top + window.pageYOffset - headerHeight;
        
        window.scrollTo({
          top: targetPosition,
          behavior: 'smooth'
        });
      }, 100);
    }
  }
  
  // Add scroll indicator
  const scrollIndicator = document.createElement('div');
  scrollIndicator.className = 'fixed bottom-10 right-10 z-40 hidden md:block';
  scrollIndicator.innerHTML = `
    <div class="flex flex-col items-center space-y-2">
      <span class="text-foreground/60 text-sm">Scroll to explore</span>
      <div class="w-6 h-10 border-2 border-foreground/30 rounded-full flex justify-center">
        <div class="w-1.5 h-1.5 bg-primary rounded-full animate-scroll-indicator mt-2"></div>
      </div>
    </div>
  `;
  document.body.appendChild(scrollIndicator);
  
  // Hide scroll indicator after scrolling
  window.addEventListener('scroll', function() {
    if (window.scrollY > 300) {
      scrollIndicator.classList.add('opacity-0');
      setTimeout(() => {
        scrollIndicator.classList.add('hidden');
      }, 500);
    }
  });
  
  // Project filtering
  setupFilters();
  
  // Project Modal
  const modal = document.getElementById('project-modal');
  const modalContent = document.getElementById('modal-content');
  const modalClose = document.getElementById('modal-close');
  const modalOverlay = document.getElementById('modal-overlay');
  const viewDetailsButtons = document.querySelectorAll('.view-details-btn');
  const projectItems = document.querySelectorAll('.project-card');
  
  function openModal(projectId) {
    console.log(projects); // Verifica si projects no es undefined o null
    const project = projects.find(p => p.id === parseInt(projectId));
    
    if (!project) return;
    
    const modalHTML = `
      <div class="space-y-6">
        <div>
          <h2 class="text-2xl font-bold">${project.title}</h2>
          <p class="text-foreground/70">${project.tags.join(" • ")}</p>
        </div>
        
        <!-- Project Image -->
        <div class="relative h-64 sm:h-80 overflow-hidden rounded-lg">
          <img src="${project.image}" alt="${project.title}" class="w-full h-full object-cover">
          <div class="absolute inset-0 bg-gradient-to-t from-background/80 to-transparent"></div>
        </div>
        
        <!-- Project Description -->
        <div class="space-y-4">
          <h3 class="text-lg font-semibold">Overview</h3>
          <p class="text-foreground/80 leading-relaxed">${project.description}</p>
          <p class="text-foreground/80 leading-relaxed">
            This project demonstrates advanced implementation techniques and modern design patterns.
            It was developed with a focus on performance, accessibility, and user experience.
          </p>
        </div>
        
        <!-- Project Details -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
          <!-- Technologies -->
          <div class="space-y-3">
            <h3 class="text-lg font-semibold">Technologies</h3>
            <div class="flex flex-wrap gap-2">
              ${project.technologies.map(tech => `<span class="skill-item">${tech}</span>`).join('')}
            </div>
          </div>
          
          <!-- Project Info -->
          <div class="space-y-3">
            <h3 class="text-lg font-semibold">Project Info</h3>
            <ul class="space-y-2">
              <li class="flex items-center gap-2 text-foreground/80">
                <i data-lucide="calendar" class="h-4 w-4 text-primary"></i>
                <span>Completed: ${project.completedDate}</span>
              </li>
              <li class="flex items-center gap-2 text-foreground/80">
                <i data-lucide="users" class="h-4 w-4 text-primary"></i>
                <span>Team Size: ${project.teamSize}</span>
              </li>
              <li class="flex items-center gap-2 text-foreground/80">
                <i data-lucide="check-circle" class="h-4 w-4 text-primary"></i>
                <span>Status: ${project.status}</span>
              </li>
            </ul>
          </div>
        </div>
        
        <!-- Key Features -->
        <div class="space-y-3">
          <h3 class="text-lg font-semibold">Key Features</h3>
          <ul class="grid grid-cols-1 md:grid-cols-2 gap-2">
            ${project.features.map(feature => `
              <li class="flex items-center gap-2">
                <i data-lucide="check-circle" class="h-4 w-4 text-primary flex-shrink-0"></i>
                <span class="text-foreground/80">${feature}</span>
              </li>
            `).join('')}
          </ul>
        </div>
        
        <!-- Challenges & Solutions -->
        <div class="space-y-3">
          <h3 class="text-lg font-semibold">Challenges & Solutions</h3>
          <p class="text-foreground/80 leading-relaxed">${project.challenge}</p>
        </div>
        
        <!-- Project Links -->
        <div class="flex flex-wrap gap-4 pt-4 border-t border-border">
          <a href="${project.liveUrl}" target="_blank" rel="noopener noreferrer" class="btn btn-primary">
            Live Demo <i data-lucide="external-link" class="ml-2 h-4 w-4"></i>
          </a>
          <a href="${project.githubUrl}" target="_blank" rel="noopener noreferrer" class="btn btn-outline">
            View Code <i data-lucide="github" class="ml-2 h-4 w-4"></i>
          </a>
        </div>
      </div>
    `;
    
    modalContent.innerHTML = modalHTML;
    modal.classList.remove('hidden');
    document.body.style.overflow = 'hidden'; // Prevent scrolling
    
    // Initialize icons in modal
    lucide.createIcons({
      attrs: {
        class: ["lucide-icon"]
      }
    });
  }
  
  function closeModal() {
    modal.classList.add('hidden');
    document.body.style.overflow = ''; // Restore scrolling
  }
  
  // Open modal when clicking on project card
  projectItems.forEach(item => {
    item.addEventListener('click', function() {
      const projectId = this.getAttribute('data-project-id');
      openModal(projectId);
    });
  });
  
  // Open modal when clicking on view details button
  viewDetailsButtons.forEach(button => {
    button.addEventListener('click', function(e) {
      e.stopPropagation(); // Prevent triggering the card click event
      const projectId = this.closest('.project-card').getAttribute('data-project-id');
      openModal(projectId);
    });
  });
  
  // Close modal when clicking close button or overlay
  modalClose.addEventListener('click', closeModal);
  modalOverlay.addEventListener('click', closeModal);
  
  // Close modal when pressing Escape key
  document.addEventListener('keydown', function(e) {
    if (e.key === 'Escape' && !modal.classList.contains('hidden')) {
      closeModal();
    }
  });


  function setupViewDetailsButtons() {
    const viewDetailsButtons = document.querySelectorAll('.view-details-btn');
    viewDetailsButtons.forEach(button => {
      button.addEventListener('click', function (e) {
        e.preventDefault();
        e.stopPropagation();

        const projectCard = this.closest('.project-card');
        if (!projectCard) return;

        const projectId = projectCard.getAttribute('data-project-id');
        if (projectId) {
          openModal(projectId);
        }
      });
    });
  }

  function assignProjectCardEvents() {
    const projectCards = document.querySelectorAll('.project-card');
    projectCards.forEach(card => {
      card.addEventListener('click', function (e) {
        if (!e.target.closest('.view-details-btn, a')) {
          const projectId = this.getAttribute('data-project-id');
          openModal(projectId);
        }
      });
    });
  }
   
  // Initial call to set active section
  updateActiveSection();

  // Load more projects on scroll
  const projectsContainer = document.getElementById('projects-container');
  const loader = document.getElementById('loader');
  let start = 0; // Comienza después de los primeros 10 proyectos
  const count = 10; // Número de proyectos a cargar por solicitud
  let isLoading = false; // Evita múltiples solicitudes simultáneas
  // projects is already declared globally, no need to redeclare it here

  async function loadMoreProjects() {
    if (isLoading) return;
    isLoading = true;

    const loader = document.getElementById('loader');
    if (loader) loader.style.display = 'block';

    try {
      const response = await fetch(`controllers/load_projects.php?start=${start}&count=${count}`);
      if (!response.ok) throw new Error('Error al cargar los proyectos');

      const newProjects = await response.json();
      projects = [...projects, ...newProjects]; // Actualizar la variable global

      if (newProjects.length === 0) {
        // No hay más proyectos para cargar
        window.removeEventListener('scroll', loadMoreProjects);
        return;
      }

      newProjects.forEach(project1 => {
        const projectHTML = `
          <div class="project-card" data-tags="${project1.tags.join(',')}" data-project-id="${project1.id}">
            <div class="relative h-48 mb-4 overflow-hidden rounded-md">
              <img src="${project1.image}" alt="${project1.title}" class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-105">
              <div class="absolute inset-0 bg-gradient-to-t from-background to-transparent"></div>
              <div class="absolute bottom-4 left-4 flex space-x-3">
                ${project1.technologies.map(tech => `<span class="text-xs font-medium py-1 px-2 rounded-full bg-background/80 backdrop-blur-sm">${tech}</span>`).join('')}
              </div>
            </div>
            <h3 class="text-xl font-bold mb-2">${project1.title}</h3>
            <p class="text-foreground/70 mb-4">${project1.description}</p>
            <div class="flex items-center justify-between mt-auto pt-4 border-t border-border">
              <div class="flex space-x-3">
                <a href="${project1.githubUrl}" target="_blank" rel="noopener noreferrer" class="text-foreground/70 hover:text-primary transition-colors" aria-label="GitHub repository">
                  <i data-lucide="github" class="h-5 w-5"></i>
                </a>
                <a href="${project1.liveUrl}" target="_blank" rel="noopener noreferrer" class="text-foreground/70 hover:text-primary transition-colors" aria-label="Live demo">
                  <i data-lucide="external-link" class="h-5 w-5"></i>
                </a>
              </div>
              <button type="button" class="btn-ghost text-primary group-hover:translate-x-1 transition-transform view-details-btn">
                View Details <i data-lucide="chevron-right" class="ml-1 h-4 w-4"></i>
              </button>
            </div>
          </div>
        `;
        projectsContainer.insertAdjacentHTML('beforeend', projectHTML);
      });

      start += count;

      // Reasigna los eventos a los nuevos botones
      setupViewDetailsButtons();
      assignProjectCardEvents();

      // Reasigna los filtros para los nuevos proyectos
      setupFilters();

      // Recrea los íconos Lucide para los nuevos elementos
      if (typeof lucide !== 'undefined') {
        lucide.createIcons();
      }
    } catch (error) {
      console.error('Error:', error);
    } finally {
      if (loader) loader.style.display = 'none';
      isLoading = false;
    }
  }

  // Detectar el scroll al final de la página
  window.addEventListener('scroll', () => {
    if (window.innerHeight + window.scrollY >= document.body.offsetHeight - 100) {
      loadMoreProjects();
    }
  });
  
  // Contact form submission
  const contactForm = document.getElementById('contact-form');
  const toast = document.getElementById('toast');
  const toastTitle = document.getElementById('toast-title');
  const toastDescription = document.getElementById('toast-description');
  const toastClose = document.getElementById('toast-close');

  if (contactForm) {
    contactForm.addEventListener('submit', function(e) {
      e.preventDefault();
      
      // Get form data
      const formData = new FormData(contactForm);
      const formValues = Object.fromEntries(formData.entries());
      
      // Simulate form submission (replace with actual submission in PHP)
      setTimeout(() => {
        // Show success toast
        showToast('Message sent!', 'Thank you for your message. I\'ll get back to you soon.');
        
        // Reset form
        contactForm.reset();
      }, 1000);
    });
        
  } else {
    console.error('El elemento con id="contact-form" no existe en el DOM.');
  }
  
  
  function showToast(title, description) {
    toastTitle.textContent = title;
    toastDescription.textContent = description;
    toast.classList.remove('hidden');
    
    // Auto hide after 5 seconds
    setTimeout(() => {
      hideToast();
    }, 5000);
  }
  
  function hideToast() {
    toast.classList.add('hidden');
  }
  
  toastClose.addEventListener('click', hideToast);
  
  // Intersection Observer for scroll animations
  const animatedElements = document.querySelectorAll('.animate-on-scroll');
  
  const observer = new IntersectionObserver((entries) => {
    entries.forEach(entry => {
      if (entry.isIntersecting) {
        entry.target.classList.add('is-visible');
      }
    });
  }, {
    threshold: 0.1
  });
  
  animatedElements.forEach(element => {
    observer.observe(element);
  });
  
  // Update active section in navbar
  function updateActiveSection() {
    const sections = ['home', 'projects', 'about', 'contact'];
    const navLinks = document.querySelectorAll('.nav-link');
    
    let currentSection = '';
    
    for (let i = sections.length - 1; i >= 0; i--) {
      const section = document.getElementById(sections[i]);
      if (section) {
        const rect = section.getBoundingClientRect();
        if (rect.top <= 100) {
          currentSection = sections[i];
          break;
        }
      }
    }
    
    navLinks.forEach(link => {
      const href = link.getAttribute('href').substring(1);
      if (href === currentSection) {
        link.classList.add('text-primary');
        link.classList.remove('text-foreground/80');
      } else {
        link.classList.remove('text-primary');
        link.classList.add('text-foreground/80');
      }
    });
  }
 
});

function setupFilters() {
  const filterButtons = document.querySelectorAll('.filter-btn');

  filterButtons.forEach(button => {
    button.addEventListener('click', function () {
      // Remove active class from all buttons
      filterButtons.forEach(btn => btn.classList.remove('active'));

      // Add active class to clicked button
      this.classList.add('active');

      const filter = this.getAttribute('data-filter');

      // Selecciona los elementos actuales del DOM
      const projectCards = document.querySelectorAll('.project-card');

      projectCards.forEach(card => {
        const tags = card.getAttribute('data-tags').split(',');

        if (filter === 'all' || tags.includes(filter)) {
          card.style.display = 'block';
        } else {
          card.style.display = 'none';
        }
      });
    });
  });
}