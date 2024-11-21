const stars = document.querySelectorAll('.star-label');
    const radioButtons = document.querySelectorAll('.star-radio');

    let selectedRating = 0;

    // Update the star colors based on the selected rating
    function updateStars() {
        stars.forEach((star, index) => {
            if (index < selectedRating) {
                star.classList.remove('text-gray-400');
                star.classList.add('text-yellow-400');
            } else {
                star.classList.remove('text-yellow-400');
                star.classList.add('text-gray-400');
            }
        });
    }

    stars.forEach((star, index) => {
        star.addEventListener('mouseover', () => {
            // Show hover effect (highlight up to the hovered star)
            if (selectedRating === 0 || index >= selectedRating) {
                stars.forEach((s, i) => {
                    if (i <= index) {
                        s.classList.add('text-yellow-400');
                    } else {
                        s.classList.remove('text-yellow-400');
                    }
                });
            }
        });

        star.addEventListener('mouseout', () => {
            // Reset hover effect when mouse leaves
            if (selectedRating === 0) {
                updateStars();
            } else {
                updateStars();
            }
        });

        star.addEventListener('click', () => {
            // Toggle selection
            selectedRating = selectedRating === index + 1 ? 0 : index + 1;
            updateStars();
        });
    });

    // Initialize the stars to reflect the current selected rating
    updateStars();