document.addEventListener('DOMContentLoaded', function () {
    const imageGrid = document.querySelector('.image-grid');
    const images = document.querySelectorAll('.image-grid img');

    // Function to check image orientation and set object-fit
    function setImageOrientation(img) {
        if (img.naturalWidth > img.naturalHeight) {
            img.style.objectFit = 'cover';
        } else {
            img.style.objectFit = 'contain';
        }
    }

    // Set image orientation for all images
    images.forEach(img => {
        if (img.complete) {
            setImageOrientation(img);
        } else {
            img.addEventListener('load', function () {
                setImageOrientation(this);
            });
        }
    });

    // Add 'loaded' class to image grid for smooth fade-in effect
    setTimeout(() => {
        imageGrid.classList.add('loaded');
    }, 100);

    // page transitions
    const paginationLinks = document.querySelectorAll('.pagination a');
    paginationLinks.forEach(link => {
        link.addEventListener('click', function (e) {
            e.preventDefault();
            const href = this.getAttribute('href');
            imageGrid.style.opacity = '0';
            imageGrid.style.transform = 'translateY(0px)';
            setTimeout(() => {
                window.location.href = href;
            }, 300);
        });
    });

    // Help modal functionality
    const modal = document.getElementById("helpModal");
    const btn = document.getElementById("helpBtn");
    const span = document.getElementsByClassName("close")[0];

    // Open the modal when the help button is clicked
    btn.onclick = function () {
        modal.style.display = "block";
    }

    // Close the modal when the close button is clicked
    span.onclick = function () {
        modal.style.display = "none";
    }

    // Close the modal when clicking outside of it
    window.onclick = function (event) {
        if (event.target == modal) {
            modal.style.display = "none";
        }
    }
});

// Ensure pagination starts from page 1 by default
if (!window.location.search.includes('page=')) {
    history.replaceState(null, '', '?page=1');
}

// Full size image functionality
function openFullSize(src) {
    const modal = document.getElementById('fullSizeModal');
    const img = document.getElementById('fullSizeImage');
    img.src = src;
    modal.style.display = "block";
}

function closeFullSize() {
    document.getElementById('fullSizeModal').style.display = "none";
}

// Close full size image when clicking outside the image
window.onclick = function (event) {
    const modal = document.getElementById('fullSizeModal');
    if (event.target == modal) {
        modal.style.display = "none";
    }
}