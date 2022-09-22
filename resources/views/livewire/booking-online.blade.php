<div>
    {{-- Be like water. --}}
   
    <section id="counts" class="counts">
        @livewire('order.summary')
    </section>
  
  	<!-- PERHATIKAN FORM INI -->
    <section id="appointment" class="appointment section-bg">
      	<!-- LOAD COMPONENT APPOINTMENT DARI FOLDER RESOURCES/VIEWS/LIVEWIRE/ORDER -->
        @livewire('order.appointment')
    </section>
</div>
