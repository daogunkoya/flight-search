export async function fetchFlightsData(searchId) {
    const response = await fetch(`results.php?searchId=${searchId}`);
    const data = await response.json();
    return data;
}
