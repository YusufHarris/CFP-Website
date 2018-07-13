<script>
// Use regex to add commas to a number
function numberWithCommas(x) {
    return x.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ',');
}



/* The Trees Planted Bar Chart Class that extends the chart class
*/
class CookStovesBarChart extends Chart {
    constructor(selector, params={}) {
        // Set the parent class parameters
        super(selector, params);

        // Get the full data set
        this.fullSet = <?php echo json_encode( $cookstoves ) ?>;
        console.log(this.fullSet);

        // Initialize the class
        this.init();
    }


    /* Returns the total number of trees for title
    */
    getTotalStoves() {
        var cnt = 0;

        for (var x in this.fullSet) {
            cnt += (this.fullSet[x].totalStoves*1);
        }

        return cnt;
    }


    /* Draws the bars of the chart
    */
    drawBars() {
        // Set the padding between bars
        var padding = 1,

        // Set the total number of data points
        valueCnt = this.fullSet.length,

        // Set the width and height locally so that they
        // can be called within sub-functions of D3
        width = this.width,
        height = this.height,

        yMax = d3.max(this.fullSet, function(d){ return parseInt(d.totalStoves); }),
        yScale = d3.scaleLinear()
            .domain([0, yMax])
            .range([0, this.height]);


        // Initialize this group
        this.newGroup('stoveBars');

        // Draw the bars of the chart
        var stoveBarholder = this.stoveBars
            .selectAll('g.bars')
            // Loop through the data points
            .data(this.fullSet)
            .enter()
            // Initialize the container for the bars and labels
            .append('g')
            .classed('bars', true)
            // Darken the bar and lighten the labels when the mouse
            // hovers over it
            .on('mouseover',function(d,i){
                if(i%2 == 0) {
                    d3.select(this)
                    .select('rect')
                    .transition()
                    .duration(750)
                    .delay(10)
                    .attr('fill-opacity', 1.0)

                } else {
                    d3.select(this)
                    .select('rect')
                    .transition()
                    .duration(750)
                    .delay(10)
                    .attr('fill-opacity', 0.8)

                }
                // Lighten the color of the labels to the default
                d3.select(this)
                .select('text.xLabels')
                .transition()
                .duration(750)
                .delay(10)
                .attr('fill', '#fff');
            })
            // Return to the default opacity and font color when
            // the mouse leaves
            .on('mouseout',function(d,i){
                // Return to the default opacity
                if(i%2 == 0) {
                    d3.select(this)
                    .select('rect')
                    .transition()
                    .duration(750)
                    .delay(10)
                    .attr('fill-opacity', 0.5);
                // Return to the default opacity
                } else {
                    d3.select(this)
                    .select('rect')
                    .transition()
                    .duration(750)
                    .delay(10)
                    .attr('fill-opacity', 0.3);
                }
                // Return to the default color of the labels
                d3.select(this)
                .select('text.yLabels')
                .transition()
                .duration(750)
                .delay(10)
                .attr('fill', '#fff');
            });

        // Draw the bar for the current data point
        stoveBarholder.append('rect')
            // Set the initial x coordinate of the left side of the bar
            .attr('x', function(d,i) {
                return i * (width / valueCnt);
            })
            // Set the y coordinate of the top of the bar to the
            // bottom of the chart area
            .attr('y', function(d){
                return height;
            })
            // Set width of the bar as a function of the total width
            // of the chart
            .attr('width', width / valueCnt - padding)
            // Set the initail height to 0
            .attr('height', 0)
            // Set the class to the key activity for proper coloring
            .classed('name', true)
            // Adjust the opacity for females and males
            .attr('fill-opacity', function(d,i){
                if(i%2 == 0){ return 0.5; }
                else { return 0.3; }
            })
            .attr('fill', '#052a5e')

            // Transition to the default state after the page is loaded
            .transition()
            .duration(750)
            .delay(10)
            // Grow the height of the bar from 0 to the scaled value
            // This includes adjusting the y location and setting the
            // height
            .attr('y', function(d){
                return height - yScale(d.totalStoves);
            })
            .attr('height', function(d){
                return yScale(d.totalStoves);
            });

      stoveBarholder.append("svg:title")
        .text(function(d) { return d.district; });

        // Draw the label for the current data point
        stoveBarholder.append('text')
            // Set the class
            .classed('yLabels', true)
            // Set the text using the trees Planted total
            .text(function(d){
                return numberWithCommas(d.totalStoves);
            })
            // Set the x coordinate of the label
            .attr('x', function(d,i) {
                return (i+0.5) * (width / valueCnt) ;
            })
            // Set the initial y coordinate of the label to the
            // bottom of the chart
            .attr('y', function(d){
                return height + 15;
            })
            // Set the font style
            .attr('font-family', 'sans-serif')
            .attr('font-size', '11px')

            .attr('fill', '#fff')
            .attr('text-anchor', 'end')


            // Transition to the default state after the page is loaded
            .transition()
            .duration(750)
            .delay(10)
            // Grow the label as the bar grows to the scaled size
            .attr('y', function(d){
                return height - yScale(d.totalStoves) + 15;
            });
    }

    /* Draws the X-Axis labels
    */
    drawXLabels() {

        // Set the total number of data points
        var valueCnt = this.fullSet.length,

        // Set the width and height locally so that they
        // can be called within sub-functions of D3
        width = this.width,
        height = this.height;

        // Initialize this group
        this.newGroup('xLabels');

        // Draw the system type labels
        this.xLabels
            .selectAll('district')
            // Loop through the data points
            .data(this.fullSet)
            .enter()
            .append('text')
            .classed('district', true)
            // Set the label
            .text(function(d) {
                return d.district;
            })
            // Set x coordinate to the left edge of each bar plus half
            // the bar width
            .attr('x', function(d, i) {
                return (i+0.5) * (width / valueCnt);
            })
            // Set the y coordinate to just below the bars
            .attr('y', height + 30)
            .attr('fill', '#fff')
            .attr('text-anchor', 'middle');
    }



    /* Draws the title of the chart
    */
    drawTitle() {

        // Initialize this group
        this.newGroup('title');

        // Draw the title
        this.title
            // Move to the center of the chart
            .attr('transform', 'translate(' + this.width/2 + ',' + (24 - this.margin.top) + ')')
            .append('text')
        .classed('title', true)
            // Set the text to the title

        .text(`${this.getTotalStoves()} Fuel Efficient Cookstoves`)
            // Center the text and set its size
            .attr('text-anchor', 'middle')
            .attr('fill', '#052a5e')
            .style('font-weight','bold')
            .attr('font-size', '24px')





    }


    /* Draw the complete chart
    */
    draw() {
        this.drawBars();
        this.drawXLabels();
        this.drawTitle();
    }


}


/* Load the charts
 *
 *
 */



// Create the bar chart
const cookstoveBar= new CookStovesBarChart(
    '#cookstoveBar',
    {
        margin: {
            top: 40,
            bottom: 40,
            left: 20,
            right: 20,
        },
    }
)


</script>
