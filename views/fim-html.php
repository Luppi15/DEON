</body>
<script>
document.addEventListener("DOMContentLoaded", function() {
    const videoContainers = document.querySelectorAll('.video-container');

    videoContainers.forEach(container => {
        const thumbnail = container.querySelector('.video-thumbnail');
        const iframeContainer = container.querySelector('.video-iframe-container');
        const videoUrl = iframeContainer.getAttribute('data-video-url');

        container.addEventListener('mouseenter', function() {
            if (!iframeContainer.querySelector('iframe')) {
                const iframe = document.createElement('iframe');
                iframe.src = videoUrl;
                iframe.width = "100%";
                iframe.height = "100%";
                iframe.frameBorder = "0";
                iframe.allow = "accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture";
                iframe.allowFullscreen = true;
                iframeContainer.appendChild(iframe);
            }
        });
    });
});

</script>
</html>
