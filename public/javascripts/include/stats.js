$(document).ready(function() {
//var rose1 = new RGraph.Rose('rose3', [[4,5,2],[3,5,4],[2,9,4],[1,8,5],[3,6,7],[4,8,5],[6,5,8],[6,9,8]]);
//
//            if (!RGraph.isOld()) {
//                rose1.Set('chart.tooltips',
//                    function (index)
//                    {
//                        if (index % 3 == 0) {
//                            return 'Julie';
//                        } else if (index % 3 == 1) {
//                            return 'Frederick';
//                        } else if (index % 3 == 2) {
//                            return 'Jobe';
//                        }
//                    }
//                )
//            }
//            rose1.Set('chart.colors.alpha', 0.5);
//            rose1.Set('chart.labels', ['NE','E','SE','S','SW','W','NW','']);
//            rose1.Set('chart.labels.position', 'edge');
//            rose1.Set('chart.margin', 5);
//            rose1.Draw();



            $.getJSON('/wordsAnalyzer/stats/countsByFirstLetter', function(data) {
                // Create the br chart. The arguments are the ID of the canvas tag and the data
                var bar = new RGraph.Bar('rose3', data['values_list']);

                // Now configure the chart to appear as wanted by using the .Set() method.
                // All available properties are listed below.
                bar.Set('chart.labels', data['labels_list']);
                bar.Set('chart.tooltips', data['values_string_list']);
                bar.Set('chart.gutter.left', 45);
                bar.Set('chart.background.barcolor1', 'white');
                bar.Set('chart.background.barcolor2', 'white');
                bar.Set('chart.background.grid', true);
                bar.Set('chart.colors', ['red']);


                // Now call the .Draw() method to draw the chart
                bar.Draw();

            });

            $.getJSON('/wordsAnalyzer/stats/validatedStats', function(data) {
                var myProgress = new RGraph.VProgress('validated', data['validated_words'], data['total_words']);
                // Configure the chart to look as you want.
                myProgress.Set('chart.colors', ['blue']);
                myProgress.Set('chart.title', ['Validated %']);
                myProgress.Set('chart.tickmarks.inner', true);
                myProgress.Set('chart.gutter.right', 50);
                myProgress.Set('chart.tooltips',  data['validated_words'].toString());

                // Now call the .Draw() method to draw the chart.
                myProgress.Draw();
            });



}); // END Document.ready