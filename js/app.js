const L = require('leaflet');
require('leaflet.markercluster');

const map = L.map('mapid').setView([46.90296, 1.90925], 6);
const stamenToner = L.tileLayer('http://stamen-tiles-{s}.a.ssl.fastly.net/toner/{z}/{x}/{y}.png', {
    attribution: 'Map tiles by <a href="https://stamen.com">Stamen Design</a>, <a href="https://creativecommons.org/licenses/by/3.0">CC BY 3.0</a> — Map data © <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a>',
    subdomains: 'abcd',
    minZoom: 0,
    maxZoom: 20,
    ext: 'png'
});

map.addLayer(stamenToner);

const markerGroups = new L.MarkerClusterGroup({
    iconCreateFunction: function(cluster) {
        const digits = (cluster.getChildCount()+'').length;
        return L.divIcon({
            html: cluster.getChildCount(),
            className: 'cluster digits-'+digits,
            iconSize: null
        });
    }
});

function displayData(year) {
    const request = new Request('http://127.0.0.1:8080/cities/'+year);

    fetch(request).then(response => {
        return response.json();
    }).then(json => {
        for (let i = 0; i < json.length; i++) {

            const latLng = new L.LatLng(json[i].lat, json[i].lon);
            const marker = new L.Marker(latLng, {title: json[i].city});
            marker.bindPopup(
                '<strong>'+json[i].city+'</strong><br />'+
                '<strong>redevables : '+json[i].people+'</strong><br />'+
                '<strong>patrimoine : '+json[i].weatlh_avg+' &euro;</strong><br />'+
                '<strong>impots : '+json[i].tax_avg+' &euro;</strong><br />'
            );
            markerGroups.addLayer(marker);
        }
        map.addLayer(markerGroups);
    });
}

displayData(2016);

