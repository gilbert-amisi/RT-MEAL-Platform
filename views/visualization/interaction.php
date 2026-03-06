<script>
    var geojson;

    function getColor(d) {
        return d > 20 ? '#800026' :
            d > 10 ? '#BD0026' :
            d > 8 ? '#E31A1C' :
            d > 5 ? '#FC4E2A' :
            d > 3 ? '#FD8D3C' :
            d > 2 ? '#FEB24C' :
            d > 1 ? '#FED976' :
            '#FFEDA0';
    }


    function style(feature) {
        return {
            fillColor: getColor(feature.properties.density),
            weight: 2,
            opacity: 1,
            color: 'white',
            dashArray: '3',
            fillOpacity: 0.7
        };
    }

    function stylePoint(feature) {
        return {
            // fillColor: getColor(feature.properties.density),
            weight: 2,
            opacity: 1,
            color: 'white',
            dashArray: '3',
            fillOpacity: 0.7
        };
    }

    function zoomToFeature(e) {
        map.fitBounds(e.target.getBounds());
        location.href = "home.php?render=<?= sha1("feedback") ?>&sub=<?= sha1("start") ?>&use_category=<?= $useCategory ?>"+"&territory="+actualTerr;

    }

    function zoomToFeaturePoint(e) {
        map.fitBounds(e.target.getBounds());
    }

    function onEachFeaturePoint(feature, layer) {
        layer.on({
            mouseover: highlightFeaturePoint,
            mouseout: resetHighlightPoint,
            click: zoomToFeaturePoint
        });
    }

    function onEachFeature(feature, layer) {
        layer.on({
            mouseover: highlightFeature,
            mouseout: resetHighlight,
            click: zoomToFeature
        });
    }

    var actualTerr = ""

    function highlightFeature(e) {
        var layer = e.target;

        layer.setStyle({

            weight: 5,
            color: '#666',
            dashArray: '',
            fillOpacity: 0.7
        });

        if (!L.Browser.ie && !L.Browser.opera && !L.Browser.edge) {
            layer.bringToFront();
        }

        actualTerr = e.target.feature.properties.name;

        // console.log(actualTerr)

        info.update(layer.feature.properties);

        var gpm = [];

        var vilgpm;

        gpmVls = (<?= json_encode($groupementNb, JSON_NUMERIC_CHECK) ?>)

        Object.entries(gpmVls).forEach(entry => {
            const [key, value] = entry;
            if (key == actualTerr) {
                vilgpm = value;
            }

        });

        // console.log(vilgpm);

        if (vilgpm != null) {
            Object.entries(vilgpm).forEach(entry => {
                const [key, value] = entry;
                gpm.push({
                    label: key,
                    y: value
                });

            });
        }

        // console.log(gpm);

        var chart = new CanvasJS.Chart("chartContainer", {
            animationEnabled: true,
            exportEnabled: true,
            theme: "light1", // "light1", "light2", "dark1", "dark2"
            title: {
                text: actualTerr,
            },
            axisY: {
                includeZero: true,
            },
            data: [{
                type: "bar", //change type to bar, line, area, pie, etc
                //indexLabel: "{y}", //Shows y value on all Data Points
                indexLabelFontColor: "#5A5757",
                indexLabelFontSize: 16,
                indexLabelPlacement: "outside",
                dataPoints: gpm
            }]
        });
        chart.render();

    }

    function highlightFeaturePoint(e) {
        var layer = e.target;

        info.updatePoint(layer.feature.properties);
    }


    function resetHighlight(e) {
        geojson.resetStyle(e.target);

        info.update();
    }

    function resetHighlightPoint(e) {
        geojson.resetStyle(e.target);

        info.updatePoint();
    }

    var info = L.control();

    info.onAdd = function(map) {
        this._div = L.DomUtil.create('div', 'info'); // create a div with a class "info"

        this.update();
        return this._div;
    };

    info.onAddPoint = function(map) {
        this._div = L.DomUtil.create('div', 'info'); // create a div with a class "info"

        this.updatePoint();
        return this._div;
    };

    // method that we will use to update the control based on feature properties passed
    info.update = function(props) {
        this._div.innerHTML = '<h4>Territory</h4>' + (props ?
            '<b>' + props.name + '</b><br /><h3>' + props.density + ' </h3>case(s)' :
            'Hover over a territory');

    };


    // method that we will use to update the control based on feature properties passed
    info.updatePoint = function(props) {
        this._div.innerHTML = '<h4>Village/District/Town</h4>' + (props ?
            '<b>' + props.name + '</b><br />' + props.thematic + '</b><br />' :
            'Hover over a village');
    };

    info.addTo(map);

    var legend = L.control({
        position: 'bottomright'
    });

    legend.onAdd = function(map) {

        var div = L.DomUtil.create('div', 'info legend'),
            grades = [1, 2, 3, 5, 8, 10, 20],
            labels = [];

        // loop through our density intervals and generate a label with a colored square for each interval
        for (var i = 0; i < grades.length; i++) {
            div.innerHTML +=
                '<i style="background-color:' + getColor(grades[i] + 1) + '"></i> ' +
                grades[i] + (grades[i + 1] ? '&ndash;' + grades[i + 1] + '<br>' : '+');
        }

        return div;
    };

    legend.addTo(map);
</script>