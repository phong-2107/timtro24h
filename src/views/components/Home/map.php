<link rel="stylesheet" href="/public/styles/home/Map.css">

<div class="map-section">
    <div class="title">
        <div class="text-wrapper-7">VỊ TRÍ DỰ ÁN NỔI BẬT</div>
    </div>

    <div class="place-2">
        <div class="content-map">
            <div class="map-container" id="google-map" style="width: 100%; height: 500px;"></div>
        </div>
    </div>
</div>

<!-- Load Google Maps JavaScript API -->
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBlnuQeQdc1-TQb_zYzW0XbQ6DzcXP2BIc&callback=initMap" async
    defer>
</script>

<script>
function initMap() {
    const center = {
        lat: 10.762622,
        lng: 106.660172
    }; // Ho Chi Minh City

    const map = new google.maps.Map(document.getElementById("google-map"), {
        center: center,
        zoom: 12,
        fullscreenControl: true,
        zoomControl: true,
        streetViewControl: true,
        mapTypeControl: false
    });

    // Optional: Add a marker
    new google.maps.Marker({
        position: center,
        map: map,
        title: "TP. Hồ Chí Minh"
    });
}
</script>