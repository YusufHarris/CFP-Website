<script>
// Use regex to add commas to a number
function numberWithCommas(x) {
    return x.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ',');
}

/* The Beneficiary Bar Chart Class that extends the chart class
*/
class GovBarChart extends Chart {
    constructor(selector, params={}) {
        // Set the parent class parameters
        super(selector, params);

        // Get the full data set
        this.fullSet = <?php echo json_encode( $agencies ) ?>;

        // Initialize the class
        this.init();
    }

    /* Returns the total number of government Trainees
    */
    getTraineeCount() {
        var cnt = 0;

        for (var x in this.fullSet) {
            cnt += this.fullSet[x].members;
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
        xMax = d3.max(this.fullSet, function(d){ return parseInt(d.members); }),
        xScale = d3.scaleLinear()
            .domain([0, xMax])
            .range([0, this.width]);


        // Initialize this group
        this.newGroup('govBars');

        // Draw the bars of the chart
        var govBarholder = this.govBars
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
                // Return to the default opacity of the F bars
                if(i%2 == 0) {
                    d3.select(this)
                    .select('rect')
                    .transition()
                    .duration(750)
                    .delay(10)
                    .attr('fill-opacity', 0.5);
                // Return to the default opacity of the F bars
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
        govBarholder.append('rect')
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
            .classed('govMembers', true)
            // Adjust the opacity for females and males
            .attr('fill-opacity', function(d,i){
                if(i%2 == 0){ return 0.5; }
                else { return 0.3; }
            })
            // Transition to the default state after the page is loaded
            .transition()
            .duration(750)
            .delay(10)
            // Grow the height of the bar from 0 to the scaled value
            // This includes adjusting the y location and setting the
            // height
            .attr('width', function(d){
                return xScale(d.members);
            });

        govBarholder.append("svg:title")
        .text(function(d) { return d.agencyName; });

        // Draw the label for the current data point
        govBarholder.append('text')
            // Set the class
            .classed('xLabels', true)
            // Set the text using the beneficiary total
            .text(function(d){
                return d.members;
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
            .attr('font-size', '13px')
            .attr('fill', '#333')
            .attr('text-anchor', 'middle')
            // Transition to the default state after the page is loaded
            .transition()
            .duration(750)
            .delay(10)
            // Grow the label as the bar grows to the scaled size
            .attr('x', function(d){
                return xScale(d.members) - 10;
            });
    }

    /* Draws the X-Axis labels, i.e. the F/M labels and the Districts
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
            .selectAll('text.agencyLabels')
            // Loop through the data points
            .data(this.fullSet)
            .enter()
            .append('text')
            .classed('agencyLabels', true)
            // Set the label
            .text(function(d) {
                return d.agencyAcronym;
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
            .attr('fill', '#666')
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
            .attr('transform', 'translate(' + this.width/2 + ',' + (30 - this.margin.top) + ')')
            .append('text')
    		.classed('title', true)
            // Set the text to the title
    		.text(`${this.getTraineeCount()} Government Trainees`)
            // Center the text and set its size
            .attr('text-anchor', 'middle')
            .attr('font-size', '24px');

    }

    /* Draw the complete chart
    */
    draw() {
        this.drawBars();
        this.drawYLabels();
        this.drawTitle();
    }
}


/* Load the charts
 *
 *
 */

// Create the bar chart
const govBar= new GovBarChart(
    '#govTrainees',
    {
        margin: {
            top: 40,
            bottom: 10,
            left: 150,
            right: 10,
        },
    }
)
</script>
