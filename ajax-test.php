<html>
<head>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <title>Ajax Data Insert</title>
</head>
<body>
    <label>Name</label>
    <input type="text" id="name"> 
    <label>Email</label>
    <input type="text" id="email">
    <button type="submit" id="button">SAVE</button>   
    <p id="msg"></p> 
    <script>
        var reserved_seats_str = "0,1,2,3,4";
        $(document).ready(function(){
            $("#button").click(function(){
                var reserved_seats=reserved_seats_str;//$("#name").val();
                var email=$("#email").val();
                $.ajax({
                    url:'ajax-data-insert.php',
                    method:'POST',
                    data:{
                      key123:reserved_seats,
                        email:email
                    },
                   success:function(data){
                       //alert(data);
                       $('#msg').html(data);
                   }
                });
            });
        });
    </script>
    <script>
    /*
            //sc will contain a reference to the map
      var sc = $('#sc-container').seatCharts({
        //... 
      });

      setInterval(function() {
        $.ajax({
          type     : 'get',
          url      : '/bookings/get/100',
          dataType : 'json',
          success  : function(response) {
            //iterate through all bookings for our event 
            $.each(response.bookings, function(index, booking) {
              //find seat by id and set its status to unavailable
              sc.status(booking.seat_id, 'unavailable');
            });
          }
        });
      }, 10000); //every 10 seconds
      */
    </script>

</body>
</html>