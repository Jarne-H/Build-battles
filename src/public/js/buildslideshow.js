document.addEventListener("DOMContentLoaded", function(event) {
    var imageFolder = "src/public/img/buildbattles"; // Replace "images/" with the path to your image folder
    var imageExtension = ".webp"; // Replace ".jpg" with the file extension of your images
    var slideshow = document.getElementById("slideshow");
    var currentIndex = 0;
  
    function preloadImages(callback) {
      var xhr = new XMLHttpRequest();
      xhr.open("GET", imageFolder, true);
      xhr.responseType = "document";
  
      xhr.onload = function() {
        if (xhr.status === 200) {
          var doc = xhr.responseXML;
          var links = doc.getElementsByTagName("a");
  
          var imagePaths = [];
          for (var i = 0; i < links.length; i++) {
            var href = links[i].getAttribute("href");
            if (href.toLowerCase().endsWith(imageExtension.toLowerCase())) {
              imagePaths.push(href);
            }
          }
  
          callback(imagePaths);
        }
      };
  
      xhr.send();
    }
  
    function startSlideshow(images) {
      function changeBackground() {
        slideshow.style.backgroundImage = "url('" + imageFolder + images[currentIndex] + "')";
  
        currentIndex++;
        if (currentIndex === images.length) {
          currentIndex = 0;
        }
      }
  
      setInterval(changeBackground, 5000); // Change image every 5 seconds
    }
  
    preloadImages(startSlideshow);
  });
  