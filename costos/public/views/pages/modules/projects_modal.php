<!-- Project Modal -->
<div id="project-modal" class="fixed inset-0 z-50 hidden flex items-center justify-center">
  <div class="fixed inset-0 bg-background/80 backdrop-blur-sm" id="modal-overlay"></div>
   <div class="relative z-50 w-auto max-w-[90%] max-h-[90vh] bg-background p-6 border shadow-lg overflow-y-auto sm:rounded-lg mx-4 modal-centered"> 
  <!--<div class="relative z-50 w-full max-w-3xl max-h-[90vh] bg-background p-6 border shadow-lg overflow-y-auto sm:rounded-lg mx-4" style="top: 50%; left: 50%; transform: translate(-50%, -50%);">-->
    <button id="modal-close" class="absolute right-4 top-4 rounded-sm opacity-70 ring-offset-background transition-opacity hover:opacity-100 focus:outline-none focus:ring-2 focus:ring-ring focus:ring-offset-2 disabled:pointer-events-none">
      <i data-lucide="x" class="h-4 w-4"></i>
      <span class="sr-only">Close</span>
    </button>
    
   <!--  <div id="modal-content" class="overflow-y-auto"> -->
    <div id="modal-content">
      <!-- Content will be dynamically inserted here -->
    </div>
  </div>
</div>


  

