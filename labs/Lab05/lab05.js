$(document).ready(function() {
    let isDragging = false;
    let currentElement = null;
    const images = $('#images');

    images.on('mousedown', '.draggable', function(e) {
        isDragging = true;
        currentElement = $(this);
        // Calculate the offset of the mouse pointer relative to the top-left corner of the currentElement
        let offset = currentElement.offset();
        // Calculate the difference between the mouse pointer and the top-left corner of the currentElement
        // This will be used to ensure that the mouse pointer remains at the same position relative to the 
        // top-left corner of the currentElement
        let deltaX = e.pageX - offset.left;
        let deltaY = e.pageY - offset.top;

        // Calculate the minimum and maximum boundaries for images div
        let minX = images.offset().left;
        let minY = images.offset().top;
        let maxX = minX + images.width() - currentElement.width();
        let maxY = minY + images.height() - currentElement.height();

        $(document).on('mousemove', function(e) {
            if (isDragging) {
                let newLeft = e.pageX - deltaX;
                let newTop = e.pageY - deltaY;

                // Apply boundary checks to newLeft and newTop to ensure that the image 
                // does not go outside the boundaries of the images div
                newLeft = Math.max(minX, Math.min(maxX, newLeft));
                newTop = Math.max(minY, Math.min(maxY, newTop));

                // Move the currentElement to the newLeft and newTop positions
                // Note that we are using absolute positioning
                currentElement.offset({
                    left: newLeft,
                    top: newTop
                });
            }
        });

        images.on('mouseup', function() {
            isDragging = false;
            currentElement = null;
        });
    });

    // download a screenshot of the images div with the capture button
    $('#capture-button').click(function() {
        html2canvas(document.getElementById('images')).then(function(canvas) {
            const image = canvas.toDataURL('image/png');
            const a = document.createElement('a');
            
            a.setAttribute('download', 'potato_screenshot.png');
            a.setAttribute('href',image);
            a.click();
            
            canvas.remove();
        });

        const downloaded = document.getElementById('downloaded-text');

        if (downloaded.innerHTML === '') {
            downloaded.innerHTML = 'Screenshot taken! Check your downloads folder.';
            downloaded.classList.add('mt-3');
        }
    });

    let hoverEffect = false;

    // Enlarge the image on hover and add a button to revert the size
    $('#animate-image').hover(function() {
        if (!hoverEffect) {
            hoverEffect = true;

            // Store the original image dimensions and position of the image
            const originalWidth = $(this).width();
            const originalHeight = $(this).height();
            const originalTop = $(this).offset().top;
            const originalLeft = $(this).offset().left;

            // Enlarge the image to the size of the entire screen
            $(this).animate({
                width: '100vw',
                height: '100vh',
                top: 0,
            }, 'slow');

            // Show the revert icon
            $('#revert-icon').show().click(function() {
                $('#animate-image').animate({
                    width: originalWidth,
                    height: originalHeight,
                    top: originalTop,
                    left: originalLeft,
                }, 'slow');

                // Hide the revert icon
                $('#revert-icon').hide();

                let OT = $('#animate-image').offset().top;
                let OL = $('#animate-image').offset().left;

                console.log(OT, OL);
                console.log(originalTop, originalLeft);


                /* 
                    do this later 
                    trying to make it so that the user can hover
                    it more than once
                */
                
                if (OT === originalTop && OL === originalLeft) {
                    hoverEffect = false;
                    console.log(hoverEffect);
                }
            });
        }
    });
});
