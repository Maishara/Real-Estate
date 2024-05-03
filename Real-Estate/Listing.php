<!DOCTYPE html>
<html>
<head>
    <title>Submit Property for Verification</title>
    <!-- Include Leaflet.js for map functionality -->
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.7.1/dist/leaflet.css"/>
    <script src="https://unpkg.com/leaflet@1.7.1/dist/leaflet.js"></script>
</head>
<body>
    <h2>Submit Property for Verification</h2>
    <fieldset>
        <form id="propertyForm" action="Listed.php" method="post" enctype="multipart/form-data">
            Property Title: <input type="text" name="title" required><br><br>
            Location: <input type="text" id="location" name="location" required><br><br>
            Longitude: <input type="text" id="longitude" name="longitude"><br><br>
            Latitude: <input type="text" id="latitude" name="latitude"><br><br>
            Image: <input type="file" name="image"><br><br>
            Status: <input type="text" name="status"><br><br>
            Price: <input type="text" name="price"><br><br>
            Description: <textarea name="description"></textarea><br><br>
            Agent name: <input type="text" name="username"> <br><br>
            <input type="submit" value="Submit for Verification">
        </form>
        <!-- Map container to display map and allow selection of location -->
        <div id="map" style="height: 400px;"></div>
    </fieldset>

    <script>
        var mymap = L.map('map').setView([0, 0], 2);
        var marker;

        // Initialize Leaflet map
        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            maxZoom: 18,
        }).addTo(mymap);

        // Function to handle map click event
        function onMapClick(e) {
            if (marker) {
                mymap.removeLayer(marker);
            }
            marker = L.marker(e.latlng).addTo(mymap);
            document.getElementById('latitude').value = e.latlng.lat;
            document.getElementById('longitude').value = e.latlng.lng;
        }
        mymap.on('click', onMapClick);

        // Function to geocode location input
        document.getElementById('location').addEventListener('change', function() {
            var location = this.value;
            fetch('https://nominatim.openstreetmap.org/search?format=json&q=' + location)
                .then(response => response.json())
                .then(data => {
                    if (data.length > 0) {
                        var lat = data[0].lat;
                        var lon = data[0].lon;
                        mymap.setView([lat, lon], 15);
                        if (marker) {
                            mymap.removeLayer(marker);
                        }
                        marker = L.marker([lat, lon]).addTo(mymap);
                        document.getElementById('latitude').value = lat;
                        document.getElementById('longitude').value = lon;
                    }
                })
                .catch(error => console.error('Error:', error));
        });
    </script>
</body>
</html>
