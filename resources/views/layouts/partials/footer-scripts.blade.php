<!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.js"></script> -->

<script>
        function imageChange(lkk) {
			$('.nav-link').removeClass('active');
			$(lkk).addClass('active');
			
            const images = ['dashboard', 'compinfo', 'events', 'subscription', 'sales'];
            for (let i = 0; i < images.length; i++) {
                var vid = document.getElementById("v-pills-" + images[i] + "-tab");
                if (vid.classList.contains('active')) {
                    var prelink = `{{asset('images/icons/`;
                    var postlink = `-selected.png')}}`;
                    document.getElementById(images[i]).src = prelink + images[i] + postlink;
                    console.log(prelink + images[i] + postlink);
                } else {
                    var prelink = `{{asset('images/icons/`;
                    var postlink = `.png')}}`;
                    document.getElementById(images[i]).src = prelink + images[i] + postlink;
                    console.log(prelink + images[i] + postlink);
                }
            }
        }

        function offCanvas(){
            const oc = document.getElementById("offcanvasExample");
            const img = document.getElementById("iimg");
            if(oc.classList.contains("show")){
                iimg.src = `{{asset('images/icons/close-icon.png')}}`;
            } else {
                iimg.src = `{{asset('images/icons/hamburger-menu.png')}}`;
            }
        }
    </script>

<script>  
  // $(document).ready( function () {   
    
  //   $.ajax({
  //     type:'get',
  //     url:"{{url('/get-bookinglist')}}",
  //     success:function(response){
        
  //       $('#bookingList').html('');
  //       $.each(response, function (key, value) {          
  //           $('#bookingList').append("<tr>\
  //                           <td>"+value.name+"</td>\
  //                           <td>"+value.event_id+"</td>\
  //                           <td>"+value.payment_status+"</td>\
  //                           <td>"+value.amount+"</td><td><a href='#' class='btn bookbtn'>View</a></td></tr>");
  //           })
  //       }
  //   });
  // });

  // function byPaymentStatus(pstatus) {
  //   var payment_status=pstatus;  
   
  //   $.ajax({
  //     type:'get',
  //     url:"{{url('/get-bookinglist?payment_status=')}}"+payment_status,
  //     success:function(response){
  //       $('#bookingList').html('');
  //       $.each(response, function (key, value) {          
  //         $('#bookingList').append("<tr>\
  //                         <td>"+value.name+"</td>\
  //                         <td>"+value.event_id+"</td>\
  //                         <td>"+value.payment_status+"</td>\
  //                         <td>"+value.amount+"</td><td><a href='#' class='btn bookbtn'>View</a></td></tr>");
  //         })
  //       }
  //   });
  // }
</script>