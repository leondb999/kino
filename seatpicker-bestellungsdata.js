function getSelectedSeats(){
    // API Referenz: https://seatchart.js.org/api.html#SeatchartonChange
    var seats_json = sc.getCart();
    /*document.getElementById('selected-seats').innerHTML = seats_json + ", Total Price" + sc.getTotal(); 
    document.getElementById('selected-seats-items').innerHTML = "regular seats: "+  sc.getCart()["regular"] + "<br>" + "reduced seats: " + sc.getCart()["reduced"] + "<br> Total Price: " + sc.getTotal() + options.cart["currency"] ;
    console.log("keys: "+ Object.keys(sc.getCart()));
    console.log("reduced: " + sc.getCart()["reduced"]);
        typeof
        - options.types --> object
        - typof options.types[0] --> object
    */

    console.log("Kathegorie: options.types[i]: " + options.types[0].type);
    console.log("Elemente der Kathegorie 'regular:'" + sc.getCart()[options.types[0].type])
    //get kathegorien
    var seat_data ="";
    var all_selected_seats =[];

    for(var i = 0; i < options.types.length; i++){
        // Sitzkategorie z.B. regular oder reduced
        var seat_type =  options.types[i].type;
        console.log("options.types["+i+"]: " + seat_type);    

        seat_data += seat_type + " seats: " + sc.getCart()[seat_type] + "// Price pro Sitz: " +sc.getPrice(seat_type)+ "<br>";
        
        Array.prototype.push.apply(all_selected_seats, sc.getCart()[seat_type])
    }
    console.log("all_seats: " +   all_selected_seats);
    console.log("length all_seats: " + all_selected_seats.length);

    seat_data += "Total Price: " + sc.getTotal() + options.cart["currency"] ;
    
    document.getElementById('selected-seats').innerHTML = seat_data + "<br> All seats: " + all_selected_seats + "   Length All seats: " + all_selected_seats.length;
   console.log("Reserved: " + options.map.reserved.seats);
   console.log("Item in all_elements: " +  all_selected_seats.keys());
   for (x of  all_selected_seats){
       console.log("y: " + x);
   }
}

function disableSeat(){
   var seat_arr = [];
   Array.prototype.push.apply(seat_arr,sc.getCart['regular']);
   console.log(sc.selectSeats());
   //console.log(s);
   
}