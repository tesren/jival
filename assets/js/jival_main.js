Fancybox.bind("[data-fancybox]", {
  // Your custom options
});

let featuredListings = document.getElementById('featured-listings');

if(featuredListings){
  featuredListings= new Splide( '#featured-listings', {
    perPage: 3,
    perMove: 1,
    loop: true,
    padding: '15px',
    pagination: false,
    breakpoints: {
      640: {
        perPage: 2,
      },
      480: {
        perPage: 1,
        padding: '0px',
      },
    },
  } );
  
  featuredListings.mount();
}

let featuredRentals = document.getElementById('featured-rentals');

if(featuredRentals){
  featuredRentals= new Splide( '#featured-rentals', {
    perPage: 3,
    perMove: 1,
    loop: true,
    padding: '15px',
    pagination: false,
    breakpoints: {
      640: {
        perPage: 2,
      },
      480: {
        perPage: 1,
        padding: '0px',
      },
    },
  } );
  
  featuredRentals.mount();
}

let homeGallery = document.getElementById('home-gallery');

if(homeGallery){
  homeGallery= new Splide( '#home-gallery', {
    perPage: 1,
    perMove: 1,
    loop: true,
    pagination: true,
  } );
  
  homeGallery.mount();
}

const form_inputs = document.getElementById('searchform');

if(form_inputs){

  if (window.innerWidth <= 768) {
    // Código a ejecutar solo en dispositivos móviles (ancho menor o igual a 768px)
    form_inputs.classList.remove('input-group');
  }else{
    form_inputs.classList.add('input-group');
  }

}