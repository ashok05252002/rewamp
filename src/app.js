
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
