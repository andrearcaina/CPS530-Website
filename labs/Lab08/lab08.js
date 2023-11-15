$(document).ready(function () {
    function updateTime() {
        let time = new Date();
        let hours = time.getHours().toString().padStart(2, '0');
        let minutes = time.getMinutes().toString().padStart(2, '0');
        let seconds = time.getSeconds().toString().padStart(2, '0');

        let timeString = hours + ':' + minutes + ':' + seconds;
        $('#timeContainer').text('Current time in Toronto: ' + timeString);
    }

    updateTime();

    setInterval(updateTime, 1000);
});
