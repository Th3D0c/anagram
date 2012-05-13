$(document).ready(function() {
var rose1 = new RGraph.Rose('rose3', [[4,5,2],[3,5,4],[2,9,4],[1,8,5],[3,6,7],[4,8,5],[6,5,8],[6,9,8]]);

            if (!RGraph.isOld()) {
                rose1.Set('chart.tooltips',
                    function (index)
                    {
                        if (index % 3 == 0) {
                            return 'Julie';
                        } else if (index % 3 == 1) {
                            return 'Frederick';
                        } else if (index % 3 == 2) {
                            return 'Jobe';
                        }
                    }
                )
            }
            rose1.Set('chart.colors.alpha', 0.5);
            rose1.Set('chart.labels', ['NE','E','SE','S','SW','W','NW','']);
            rose1.Set('chart.labels.position', 'edge');
            rose1.Set('chart.margin', 5);
            rose1.Draw();
}); // END Document.ready