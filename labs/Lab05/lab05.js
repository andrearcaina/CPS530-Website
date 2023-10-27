$(document).ready(function() {
    // makes the tags with the class name "draggable"
    // draggable within the #images div 
    $('.draggable').draggable({
        containment: '#images',
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

    // Store the original width, height, top and left of jQuery.png
    const originalWidth = $('#animate-image').width();
    const originalHeight = $('#animate-image').height();
    const originalTop = $('#animate-image').offset().top;
    const originalLeft = $('#animate-image').offset().left;

    $('#animate-image').hover(function() {
        if (!hoverEffect) {
            hoverEffect = true;

            console.log(originalWidth, originalHeight, originalTop, originalLeft);

            // Enlarge the image to the size of the entire screen
            $(this).animate({
                width: '100vw',
                height: '100vh',
                top: 0,
                left: 0,
            }, 'slow');

            // Show the revert icon and add a click function
            $('#revert-icon').show().click(function() {
                $('#animate-image').animate({
                    width: originalWidth,
                    height: originalHeight,
                    top: originalTop,
                    left: originalLeft,
                }, 'slow', function() {
                    hoverEffect = false;
                });
    
                $('#revert-icon').hide();
            });
        }
    });
});
