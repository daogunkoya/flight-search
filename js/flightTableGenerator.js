export function generateFlightList(flights) {
    let list = '<div class="flight-list">';

    flights.forEach((flight, index) => {
        list += `
            <div class="flight-item">
                <img src="img/airlinelogos/${flight.airline_code}.gif" alt="${flight.airline_code}" class="flight-icon">
                <div class="flight-info">
                    <div class="flight-time">${new Date(flight.departure_time * 1000).toLocaleTimeString()}</div>
                    <div class="flight-detail">
                        <div class="flight-date">${new Date(flight.departure_time * 1000).toLocaleDateString()}</div>
                        <div class="flight-info-separator"></div>
                        <div>${flight.departure_airport}</div>
                    </div>
                </div>
                <div class="flight-info">
                    <div class="flight-time">${new Date(flight.arrival_time * 1000).toLocaleTimeString()}</div>
                    <div class="flight-detail">
                        <div class="flight-date">${new Date(flight.arrival_time * 1000).toLocaleDateString()}</div>
                        <div class="flight-info-separator"></div>
                        <div>${flight.destination_airport}</div>
                    </div>
                </div>
                <div class="flight-airline">
                    <img src="img/seat.png" class="seat-icon">
                    <div class="seat-type">Economy</div>
                </div>
                 <div class="flight-price">
                 <div class =" price">£ ${flight.price}</div>
                  <div class="flight-person">per person</div>
                 </div>
            </div>
        `;

        if (index !== flights.length - 1) {
            list += '<div class="flight-divider"></div>';
        }
    });

    list += '</div>';

    return list;
}
