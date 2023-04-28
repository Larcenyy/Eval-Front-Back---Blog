let sliderContainer = document.querySelector(".slide_container");
let sliderBox = document.querySelectorAll('.slider')


function scrollSlider(sliderContainer) {
    var slider = sliderContainer.find('.slider');
    var firstSlide = slider.first();

    // Calcul de la largeur totale du slider
    var sliderWidth = slider.width() * slider.length;

    // Calcul de la position actuelle du slider
    var currentPos = slider.position().left;

    // Calcul de la position de fin du slider
    var endPos = currentPos - sliderWidth;

    // Si le slider est arrivé à la fin, on remet la première slide à la fin
    if (currentPos <= endPos) {
        sliderContainer.append(firstSlide.clone());
        firstSlide.remove();
        slider = sliderContainer.find('.slider');
    }

    // Défilement du slider
    slider.animate({left: '-=30%'}, 500, 'linear', function() {
        scrollSlider(sliderContainer);
    });
}

// Appel de la fonction de défilement
scrollSlider($('.slider-1'));
