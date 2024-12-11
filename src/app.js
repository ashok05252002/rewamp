
function toggleDropdown() {
    const dropdown = document.getElementById("mega-menu-full-dropdown");
    dropdown.classList.toggle("hidden");
}

const buttons = document.querySelectorAll('button');
const contentSections = document.querySelectorAll('div[id$="-content"]');

buttons.forEach(button => {
    button.addEventListener('click', () => {
        buttons.forEach(btn => btn.classList.remove('border-b-2', 'border-white', 'text-white'));
        button.classList.add('border-b-2', 'border-white', 'text-white');
        contentSections.forEach(section => section.classList.add('hidden'));
        const contentId = button.id.replace('btn', 'content');
        document.getElementById(contentId).classList.remove('hidden');
    });
});

document.getElementById('sales-team-btn').click();

document.addEventListener('DOMContentLoaded', function () {
    // First swiper instance (left to right)
    var swiper1 = new Swiper('.logo-slider', {
      slidesPerView: 2,
      spaceBetween: 15,
      loop: true,
      speed: 2000,
      autoplay: {
        delay: 0,
        disableOnInteraction: false, // Keeps autoplay on interaction
      },
      breakpoints: {
        640: { slidesPerView: 2, spaceBetween: 20 },
        768: { slidesPerView: 3, spaceBetween: 30 },
        1024: { slidesPerView: 5, spaceBetween: 40 },
      }
    });
  });
  
  function toggleModal() {
    const modal = document.getElementById('contactModal');
    modal.classList.toggle('hidden'); // Toggle the hidden class to show or hide the modal
}


document.querySelectorAll('button[data-target]').forEach((button) => {
  button.addEventListener('click', () => {
    // Hide all content sections
    document.querySelectorAll('div[id$="-content"]').forEach((content) => content.classList.add('hidden'));

    // Show the targeted content section
    const targetId = button.getAttribute('data-target');
    document.getElementById(targetId).classList.remove('hidden');
  });
});



// home page starts

module.exports = {
  theme: {
    extend: {
      animation: {
        fadeInLeft: 'fadeInLeft 1s ease-out',
        fadeInUp: 'fadeInUp 1s ease-out',
      },
      keyframes: {
        fadeInLeft: {
          '0%': { opacity: '0', transform: 'translateX(-50px)' },
          '100%': { opacity: '1', transform: 'translateX(0)' },
        },
        fadeInUp: {
          '0%': { opacity: '0', transform: 'translateY(50px)' },
          '100%': { opacity: '1', transform: 'translateY(0)' },
        },
      },
    },
  },
  plugins: [],
};


const animatedText = document.getElementById('animatedText');
            const section = document.querySelector('section');

            section.addEventListener('mousemove', (e) => {
                // Calculate the horizontal mouse movement as a percentage of the window width
                const moveAmount = e.clientX / window.innerWidth * 100;

                // Apply the calculated move amount as a transform to the text
                animatedText.style.transform = `translateX(${moveAmount}px)`;
                animatedText.style.transition = 'transform 0.2s ease'; // Add smooth transition
            });

            section.addEventListener('mouseleave', () => {
                // Reset the position of the text when the mouse leaves the section
                animatedText.style.transform = `translateX(0)`;
            });

            document
            .querySelectorAll('.tilt-card')
            .forEach(card => {
                const glow = card.querySelector('.glow');
                const content = card.querySelector('.tilt-card-content');

                card.addEventListener('mousemove', (e) => {
                    const rect = card.getBoundingClientRect();
                    const x = e.clientX - rect.left;
                    const y = e.clientY - rect.top;

                    const centerX = rect.width / 2;
                    const centerY = rect.height / 2;

                    const percentX = (x - centerX) / centerX;
                    const percentY = -((y - centerY) / centerY);

                    card.style.transform = `perspective(1000px) rotateY(${percentX * 10}deg) rotateX(${percentY * 10}deg)`;
                    content.style.transform = `translateZ(50px)`;
                    glow.style.opacity = '1';
                    glow.style.backgroundImage = `
                                radial-gradient(
                                    circle at 
                                    ${x}px ${y}px, 
                                    #ffffff44,
                                    #0000000f
                                )
                            `;
                });

                card.addEventListener('mouseleave', () => {
                    card.style.transform = 'perspective(1000px) rotateY(0deg) rotateX(0deg)';
                    content.style.transform = 'translateZ(0px)';
                    glow.style.opacity = '0';
                });
            });

            
  // Initialize Leaflet Map
  var map = L.map('map', {
    scrollWheelZoom: false, // Disable zooming with the mouse scroll
    dragging: true // Enable dragging for panning
  }).setView([20, 78], 3); // Set initial view to show India and Middle East

  // Disable zooming for mobile screens
  if (window.innerWidth <= 768) {
    map.touchZoom.disable(); // Disable pinch-zoom
    map.doubleClickZoom.disable(); // Disable double tap zoom
  }

  // Set up OpenStreetMap tiles
  L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
    maxZoom: 18,
    attribution: ''
  }).addTo(map);

  // Office Locations with Links
  var offices = [
    { coords: [13.0827, 80.2707], popup: "Chennai, India - Head Office", link: "https://maps.app.goo.gl/GKm4YrC8AQD37xJR9" },
    { coords: [10.7905, 78.7047], popup: "Trichy, India - Branch Office", link: "https://maps.app.goo.gl/gxxytCmCe7xkfjot5" },
    { coords: [22.5726, 88.3639], popup: "Kolkata, India - Branch Office", link: "https://maps.app.goo.gl/LT3EMAPVYXSkkYXG8" },
    { coords: [23.5859, 58.4059], popup: "Oman - Overseas branch Office", link: "https://maps.app.goo.gl/yDSyP3nuWE1BqaPD8" },
    { coords: [25.276987, 55.296249], popup: "<b>UAE - Coming Soon</b>", link: "#" }
  ];

  // Add markers for each office with clickable links
  offices.forEach(function (office) {
    L.marker(office.coords).addTo(map).bindPopup(
      `<b>${office.popup}</b><br><a href="${office.link}" target="_blank" style="color:blue; text-decoration:underline;">Visit Office Page</a>`
    ).on('click', function () {
      if (office.link !== "#") {
        window.open(office.link, '_blank');
      } else {
        alert('This office location is coming soon!');
      }
    });
  });

  // Auto-Move Map to Office Locations
  let currentIndex = 0;

  // Function to animate and move the map
  function autoMoveMap() {
    const nextLocation = offices[currentIndex].coords;
    map.flyTo(nextLocation, 6, { // flyTo method moves the map with animation
      animate: true,
      duration: 3 // Animation duration in seconds
    });

    // Open the popup for the current location
    map.eachLayer(function (layer) {
      if (layer.getLatLng && layer.getLatLng() && layer.getLatLng().lat === nextLocation[0]) {
        layer.openPopup();
      }
    });

    currentIndex = (currentIndex + 1) % offices.length; // Loop through the office locations
  }

  // Set an interval to auto-move the map every 5 seconds
  setInterval(autoMoveMap, 5000);





  module.exports = {
    content: [
      './path/to/your/files/**/*.html',
      './path/to/your/files/**/*.js',
    ],
    theme: {
      extend: {
        animation: {
          'slide-in-left': 'slideInLeft 1s ease-out forwards',
        },
        keyframes: {
          slideInLeft: {
            '0%': { transform: 'translateX(-100%)' },
            '100%': { transform: 'translateX(0)' },
          },
        },
      },
    },
    plugins: [],
  }
  
// home page ends
// pro people start

tailwind.config = {
  theme: {
      extend: {
          fontFamily: {
              sans: ['Poppins', 'sans-serif'],
          },
      }
  }
}



const carousel = document.querySelector('.carousel');
const prevButton = document.querySelector('.carousel-control-prev');
const nextButton = document.querySelector('.carousel-control-next');

prevButton.addEventListener('click', () => {
    carousel.scrollBy({
        left: -carousel.offsetWidth,
        behavior: 'smooth'
    });
});

nextButton.addEventListener('click', () => {
    carousel.scrollBy({
        left: carousel.offsetWidth,
        behavior: 'smooth'
    });
});



document.getElementById('toggleOpen').addEventListener('click', function() {
  document.getElementById('collapseMenu').classList.toggle('max-lg:hidden');
});

document.getElementById('toggleClose').addEventListener('click', function() {
  document.getElementById('collapseMenu').classList.add('max-lg:hidden');
});                   
                                      


// pro people end

// pro-task start




// pro-task end