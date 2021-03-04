<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Login</title>

    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" ></script> 
    
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css" integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css" integrity="sha384-UHRtZLI+pbxtHCWp1t77Bi1L4ZtiqrqD80Kn4Z8NTSRyMA2Fd33n5dQ8lWUE00s/" crossorigin="anonymous">
    <link rel ="stylesheet"type="text/css" href="style.css"> 
    <link rel="stylesheet" href="seatchart.css">

  </head>
  <body>
  
  <header>


</header>    

    

    <main role="main" style="padding-top: 40px; padding-bottom: 30px">
    <div id="map-container">test</div>
    <div id="legend-container"></div>
    <div id="shoppingCart-container"></div>
    </main>
  </body>
  <script type="text/javascript" src="seatchart.js"></script>
  <script>
    console.log(document.getElementById("map-container"));
  var options = {
      // Reserved and disabled seats are indexed
      // from left to right by starting from 0.
      // Given the seatmap as a 2D array and an index [R, C]
      // the following values can obtained as follow:
      // I = columns * R + C
      map: {
          id: 'map-container',
          rows: 9,
          columns: 9,
          // e.g. Reserved Seat [Row: 1, Col: 2] = 7 * 1 + 2 = 9
          reserved: {
              seats: [1, 2, 3, 5, 6, 7, 9, 10, 11, 12, 14, 15, 16, 17, 18, 19, 20, 21],
          },
          disabled: {
              seats: [0, 8],
              rows: [4],
              columns: [4]
          }
      },
      types: [
          { type: "regular", backgroundColor: "#006c80", price: 10, selected: [23, 24] },
          { type: "reduced", backgroundColor: "#287233", price: 7.5, selected: [25, 26] }
      ],
      cart: {
          id: 'cart-container',
          width: 280,
          height: 250,
          currency: '£',
      },
      legend: {
          id: 'legend-container',
      },
      assets: {
          path: "./assets",
      }
  };

  var sc = new Seatchart(options);
</script>   
</html>