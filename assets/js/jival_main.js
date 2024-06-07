Fancybox.bind("[data-fancybox]", {
  // Your custom options
});

let featuredListings = document.getElementById('featured-listings');

if(featuredListings){
  featuredListings= new Splide( '#featured-listings', {
    perPage: 3,
    perMove: 1,
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
    type   : 'loop',
    pagination: true,
  } );
  
  homeGallery.mount();
}

let model_gallery = document.getElementById('model_gallery');

if(model_gallery){
  model_gallery = new Splide( '#model_gallery', {
    type   : 'loop',
    drag   : 'free',
    focus  : 'center',
    perPage: 4,
    pagination: false,
    autoplay: 'play',
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
  
  model_gallery.mount();
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

document.addEventListener('DOMContentLoaded', function() {
  var navItemEsp = document.getElementById('menu-item-61');
  var navItemEng = document.getElementById('menu-item-84');

  if (navItemEsp) {
      var iconElement = document.createElement('i');
      iconElement.className = 'fa-solid fa-earth-americas me-1';

      var linkEsp = navItemEsp.querySelector('a');

      if (linkEsp) {
          linkEsp.insertBefore(iconElement, linkEsp.firstChild);
      }else{
          console.log('No se encontró el elemento en Español');
      }

  }

  if(navItemEng){
      var iconElement = document.createElement('i');
      iconElement.className = 'fa-solid fa-earth-americas me-1';

      var linkEng = navItemEng.querySelector('a');

      if (linkEng) {
          linkEng.insertBefore(iconElement.cloneNode(true), linkEng.firstChild);
      }else{
          console.log('No se encontró el elemento en Inglés');
      }
  }
});