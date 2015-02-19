<?php
include '../includes/session.php';
?>


<html xmlns="http://www.w3.org/1999/xhtml">
<head>

    <?php include '../assets/meta-tags.php'; ?>

    <title>University map | Search</title>

    <?php include '../assets/css-paths/common-css-paths.php'; ?>

    <script src="https://maps.google.com/maps/api/js?sensor=false" type="text/javascript"></script>
    <script type="text/javascript">
    //<![CDATA[
    var map;
    var markers = [];
    var infoWindow;
    var locationSelect;
    var type;

    function load() {
        map = new google.maps.Map(document.getElementById("map"), {
        center: new google.maps.LatLng(51.527287, -0.103842),
        zoom: 15,
        mapTypeId: 'roadmap',
        mapTypeControlOptions: {style: google.maps.MapTypeControlStyle.DROPDOWN_MENU}
        });
        infoWindow = new google.maps.InfoWindow({
            maxWidth: 400
        });

        locationSelect = document.getElementById("locationSelect");
        locationSelect.onchange = function() {
        var markerNum = locationSelect.options[locationSelect.selectedIndex].value;
        if (markerNum != "none"){
            google.maps.event.trigger(markers[markerNum], 'click');
        }
        };
    }

    function searchLocations() {
        var address = document.getElementById("addressInput").value;
        var geocoder = new google.maps.Geocoder();
        geocoder.geocode({address: address}, function(results, status) {
        if (status == google.maps.GeocoderStatus.OK) {
            searchLocationsNear(results[0].geometry.location);
        } else {
            alert(address + ' not found');
        }
        });
    }

    function clearLocations() {
        infoWindow.close();
        for (var i = 0; i < markers.length; i++) {
            markers[i].setMap(null);
        }
        markers.length = 0;

        locationSelect.innerHTML = "";
        var option = document.createElement("option");
        option.value = "none";
        option.innerHTML = "See all results:";
        locationSelect.appendChild(option);
    }

    function searchLocationsNear(center) {
        clearLocations();

        var radius = document.getElementById('radiusSelect').value;
        var searchUrl = '../../includes/university-map/map_source1.php?lat=' + center.lat() + '&lng=' + center.lng() + '&radius=' + radius;
        downloadUrl(searchUrl, function(data) {
        var xml = parseXml(data);
        var markerNodes = xml.documentElement.getElementsByTagName("marker");
        var bounds = new google.maps.LatLngBounds();
        for (var i = 0; i < markerNodes.length; i++) {
        var name = markerNodes[i].getAttribute("name");
        var description = markerNodes[i].getAttribute("description");
        var distance = parseFloat(markerNodes[i].getAttribute("distance"));
        var latlng = new google.maps.LatLng(
        parseFloat(markerNodes[i].getAttribute("lat")),
        parseFloat(markerNodes[i].getAttribute("lng")));

        createOption(name, distance, i);
        createMarker(latlng, name, description);
        bounds.extend(latlng);
        }
        map.fitBounds(bounds);
        locationSelect.style.display = "block";
        locationSelect.onchange = function() {
        var markerNum = locationSelect.options[locationSelect.selectedIndex].value;
        google.maps.event.trigger(markers[markerNum], 'click');
        };
        });
    }

    function createMarker(latlng, name, address) {
        var html = "<b>" + name + "</b> <br/>" + address;
        var marker = new google.maps.Marker({
        map: map,
        position: latlng
        });
        google.maps.event.addListener(marker, 'click', function() {
        infoWindow.setContent(html);
        infoWindow.open(map, marker);
        });
        markers.push(marker);
    }

    function createOption(name, distance, num) {
        var option = document.createElement("option");
        option.value = num;
        option.innerHTML = name + " " + "(" + distance.toFixed(1) + ")";
        locationSelect.appendChild(option);
    }

    function downloadUrl(url, callback) {
        var request = window.ActiveXObject ?
        new ActiveXObject('Microsoft.XMLHTTP') :
        new XMLHttpRequest;

        request.onreadystatechange = function() {
        if (request.readyState == 4) {
        request.onreadystatechange = doNothing;
        callback(request.responseText, request.status);
        }
        };

    request.open('GET', url, true);
    request.send(null);
    }

    function parseXml(str) {
        if (window.ActiveXObject) {
        var doc = new ActiveXObject('Microsoft.XMLDOM');
        doc.loadXML(str);
        return doc;
        } else if (window.DOMParser) {
        return (new DOMParser).parseFromString(str, 'text/xml');
        }
    }

    function doNothing() {}

    //]]>
    </script>

</head>
<body style="margin:0px; padding:0px;" onload="load()">

    <?php include '../includes/menus/portal_menu.php'; ?>

    <div id="university-map-portal" class="container">

    <ol class="breadcrumb">
        <li><a href="../overview/">Overview</a></li>
        <li><a href="../university-map/">University Map</a></li>
        <li class="active">Search</li>
    </ol>

    <form class="form-custom">

    <input class="form-control" type="text" id="addressInput"/>

    <select id="radiusSelect">
    <option value="25" selected>25mi</option>
    <option value="100">100mi</option>
    <option value="200">200mi</option>
    </select>

    <input class="btn btn-primary btn-lg" type="button" onclick="searchLocations()" value="Search"/>

    <div><select id="locationSelect" style="width:100%; display: none;"></select></div>

    <div id="map-wrapper">
        <div id="map"></div>
    </div>

    </form>

    </div>

    <?php include '../includes/footers/footer.php'; ?>

</body>
</html>
