// console.log(gpm3);

window.onload = function () {

    // console.log(selectedT);

    selectedT.forEach(trrs);

    function trrs(trs) {

        var gpm3 = [];

        // console.log(myTabTerr);

        Object.entries(myTabTerr).forEach(entry => {
            const [key, value] = entry;

            if (key == trs) {
                Object.entries(value).forEach(entry2 => {
                    const [key2, value2] = entry2;


                    if ((selectedG.includes(key2)) || (selectedG.length==0)) {

                        gpm3.push({
                            label: key2,
                            y: value2
                        });
                    }



                });
            }

        });


        var chart2 = new CanvasJS.Chart("chartContainer" + trs, {
            animationEnabled: true,
            exportEnabled: true,
            theme: "light2", // "light1", "light2", "dark1", "dark2"
            title: {
                text: trs
                // + "(n)" + effectifTerr + ": " + effectifCase + " case(s)"
            },
            axisY: {
                includeZero: true,
            },
            data: [{
                type: "bar", //change type to bar, line, area, pie, etc
                indexLabel: "{y}", //Shows y value on all Data Points
                indexLabelFontColor: "#5A5757",
                indexLabelFontSize: 16,
                indexLabelPlacement: "outside",
                dataPoints: gpm3
            }]
        });
        chart2.render();

    }

    // Object.entries(myTabTerr).forEach(entry => {
    //     const [key, value] = entry;


    // Object.entries(value).forEach(entry2 => {
    //     const [key2, value2] = entry2;

    //     gpm3.push({
    //         label: key2,
    //         y: value2
    //     });

    // });


    // });





    // var chart3 = new CanvasJS.Chart("chartContainer3", {
    //     animationEnabled: true,
    //     exportEnabled: true,
    //     theme: "light2", // "light1", "light2", "dark1", "dark2"
    //     title: {
    //         text: "All Territories " + "(n)" + effectifTerr + ": " + effectifCase + " case(s)"
    //     },
    //     axisY: {
    //         includeZero: true,
    //     },
    //     data: [{
    //         type: "bar", //change type to bar, line, area, pie, etc
    //         indexLabel: "{y}", //Shows y value on all Data Points
    //         indexLabelFontColor: "#5A5757",
    //         indexLabelFontSize: 16,
    //         indexLabelPlacement: "outside",
    //         dataPoints: gpm3
    //     }]
    // });

    // chart3.render();

}
