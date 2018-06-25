<script>
// Use regex to add commas to a number
function numberWithCommas(x) {
    return x.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ',');
}



/* The Beneficiary Bar Chart Class that extends the chart class
*/
class SeedlingsBarChart extends Chart {
    constructor(selector, params={}) {
        // Set the parent class parameters
        super(selector, params);

        // Get the full data set
        this.fullSet = <?php echo json_encode( $seedlings ) ?>;

        // Initialize the class
        this.init();
    }


    /* Returns the total number of seedlings for title
    */
    getSeedlings() {
        var cnt = 0;

        for (var x in this.fullSet) {
            cnt += (this.fullSet[x].seedlingsGrown*1);
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

        // Set the scale of the chart
        xMin = -1500,//this is the minimum value that the chart will graph (for aestheticc purposes some values will be graphed innacurately)
        xMax = (36000),
        xScale = d3.scaleLinear()
            .domain([xMin, xMax])
            .range([0, this.width]);


        // Initialize this group
        this.newGroup('seedBars');

        // Draw the bars of the chart
        var seedBarholder = this.seedBars
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
                .select('text.xLabels')
                .transition()
                .duration(750)
                .delay(10)
                .attr('fill', '#333');
            });

        // Draw the bar for the current data point
        seedBarholder.append('rect')
            // Set the initial x coordinate of the left side of the bar
            .attr('x', function(d) {
                return 0;
            })
            // Set the y coordinate of the top of the bar to the
            // bottom of the chart area
            .attr('y', function(d,i){
                return i * (height / valueCnt);
            })
            // Set width of the bar as a function of the total width
            // of the chart
            .attr('width', 0)
            // Set the initail height to 0
            .attr('height', height / valueCnt - padding)
            // Set the class to the sector for proper coloring
            .classed('name', true)
            // Adjust the opacity for every second row
            .attr('fill-opacity', function(d,i){
                if(i%2 == 0){ return 0.5; }
                else { return 0.3; }
            })
            .attr('fill', '#a3d02f')

            // Transition to the default state after the page is loaded
            .transition()
            .duration(750)
            .delay(10)
            // Grow the height of the bar from 0 to the scaled value
            // This includes adjusting the y location and setting the
            // height
            .attr('width', function(d){
                return xScale(d.seedlingsGrown);
            });

        seedBarholder.append("svg:title")
        .text(function(d) { return d.name; });

        // Draw the label for the current data point
        seedBarholder.append('text')
            // Set the class
            .classed('xLabels', true)
            // Set the text using the beneficiary total
            .text(function(d){
                return numberWithCommas(d.seedlingsGrown);
            })
            // Set the x coordinate of the label
            .attr('x', function(d) {
                return -10;
            })
            // Set the initial y coordinate of the label to the
            // bottom of the chart
            .attr('y', function(d,i){
                return (i+0.7) * (height / valueCnt);
            })
            // Set the font style
            .attr('font-family', 'sans-serif')
            .attr('font-size', '11px')

            .attr('fill', '#00420a')
            .attr('text-anchor', 'end')


            // Transition to the default state after the page is loaded
            .transition()
            .duration(750)
            .delay(10)
            // Grow the label as the bar grows to the scaled size
            .attr('x', function(d){
                return xScale(d.seedlingsGrown) - 10;
            });
    }

    /* Draws the X-Axis labels
    */
    drawYLabels() {

        // Set the total number of data points
        var valueCnt = this.fullSet.length,

        // Set the width and height locally so that they
        // can be called within sub-functions of D3
        width = this.width,
        height = this.height;

        // Initialize this group
        this.newGroup('yLabels');

        // Draw the F/M labels
        this.yLabels
            .selectAll('text.name')
            // Loop through the data points
            .data(this.fullSet)
            .enter()
            .append('text')
            .classed('name', true)
            // Set the label
            .text(function(d) {
                return d.name;
            })
            // Set x coordinate to the left edge of each bar plus half
            // the bar width
            .attr('x', function(d) {
                return -15;
            })
            // Set the initial y coordinates of the agency names
            .attr('y', function(d,i){
                return (i+0.7) * (height / valueCnt);
            })
            .attr('fill', '#00420a')
            .attr('text-anchor', 'end');
    }



    /* Draws the title of the chart
    */
    drawTitle() {

        // Initialize this group
        this.newGroup('title');

        // Draw the title
        this.title
            // Move to the center of the chart
            .attr('transform', 'translate(' + this.width/2 + ',' + (225 - this.margin.top) + ')')
            .append('text')
        .classed('title', true)
            // Set the text to the title
        .text(numberWithCommas(`${this.getSeedlings()} `))
            // Center the text and set its size
            .attr('text-anchor', 'middle')
            .attr('fill', '#a3d02f')
            .style('font-weight','bold')
            .attr('font-size', '225px')





    }
    /* Draws the title of the chart
    */
    drawSubTitle() {

        // Initialize this group
        this.newGroup('subTitle');

        // Draw the title
        this.subTitle
            // Move to the center of the chart
            .attr('transform', 'translate(' + this.width/2 + ',' + (290 - this.margin.top) + ')')
            .append('text')
        .classed('title', true)
            // Set the text to the title
        .text(`Seedlings Grown `)
            // Center the text and set its size
            .attr('text-anchor', 'middle')
            .attr('fill', '#a3d02f')
            .style('font-weight','bold')
            .attr('font-size', '30px')





    }

    /* Draw the complete chart
    */
    draw() {
        this.drawBars();
        this.drawYLabels();
        this.drawTitle();
        this.drawSubTitle();
    }


}


/* Load the charts
 *
 *
 */



// Create the bar chart
const seedlingsBar= new SeedlingsBarChart(
    '#seedlingsGrownBar',
    {
        margin: {
            top: 315,
            bottom: 70,
            left: 150,
            right: 150,
        },
    }
)


</script>
