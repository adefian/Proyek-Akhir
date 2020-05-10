
// "use strict";

// // Get the modal
// var modal = document.getElementById("myModal");

// // Get the image and insert it inside the modal - use its "alt" text as a caption
// var img = document.getElementById("myImg");
// var modalImg = document.getElementById("img01");
// var captionText = document.getElementById("caption");
// img.onclick = function(){
//   modal.style.display = "block";
//   modalImg.src = this.src;
//   captionText.innerHTML = this.alt;
// }

// // Get the <span> element that closes the modal
// var span = document.getElementsByClassName("close")[0];

// // When the user clicks on <span> (x), close the modal
// span.onclick = function() {
//   modal.style.display = "none";
// }

     
     $(document).ready(function() {
 
         var table = $('#dataTable').DataTable();

        var modal = document.getElementById("myModal");

         var modalImg = document.getElementById("img01");
        var captionText = document.getElementById("caption");
        
         // Get the <span> element that closes the modal
         var span = document.getElementsByClassName("close")[0];
 
         table.on('click', '#myImg', function (){
 
             $tr = $(this).closest('tr');
             if ($($tr).hasClass('child')) {
                 $tr = $tr.prev('.parent');
             }
 
             var data = table.row($tr).data();
             console.log(data);
 
            modalImg.src = this.src;
            captionText.innerHTML = data[3];

 
             $('#myModal').modal('show');
         });


 
      });