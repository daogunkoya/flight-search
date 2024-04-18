import { fetchFlightsData } from './fetchFlightsData.js';
import { generateFlightList } from './flightTableGenerator.js';

document.addEventListener('DOMContentLoaded', function () {
    const form = document.getElementById('searchForm');
    const resultsDiv = document.getElementById('results');

    form.addEventListener('submit', async function (event) {
        event.preventDefault();

        const formData = new FormData(form);

        try {
            const response = await fetch('search.php', {
                method: 'POST',
                body: formData
            });

            const data = await response.json();

            if (data.errors) {
                displayError(data.errors);
            } else {
                const searchId = data.searchId;
                const flightsData = await fetchFlightsData(searchId);

                if (flightsData.flights && flightsData.flights.length > 0) {
                    resultsDiv.innerHTML = generateFlightList(flightsData.flights);
                } else {
                    resultsDiv.innerHTML = '<div class="error">No flights found.</div>';
                }

                form.reset();
            }
        } catch (error) {
            console.error('Error:', error);
            displayError('An error occurred while processing your request.');
        }
    });

    function displayError(errors) {
        resultsDiv.innerHTML = `<div class="error">${errors.join('<br>')}</div>`;
    }
});
