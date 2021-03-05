function getSelectedSeats(){
    // API Referenz: https://seatchart.js.org/api.html#SeatchartonChange
    var seats_json = sc.getCart();
    //console.log("Kathegorie: options.types[i]: " + options.types[0].type);
    //console.log("Elemente der Kathegorie 'regular:'" + sc.getCart()[options.types[0].type])
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
        // console.log("y: " + x);
        //var s = sc.get(4);
        console.log("seat: " );
    }
}