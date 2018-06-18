<script>
// Use regex to add commas to a number
function numberWithCommas(x) {
    return x.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ',');
}

/* The Beneficiary Pie Chart Class that extends the chart class
*/
class WaterSysPieChart extends Chart {
    /* Constructor of the Beneficiary Pie Chart that stores the
       pie chart's variables
    */
    constructor(selector, params={}) {
        // Set the parent class parameters
        super(selector, params);

        // Set the default subset of the beneficiary types
        this.benType = 'Direct Trainees';
        // Get the full data set
        this.fullSet = <?php echo json_encode( $waSys ) ?>;

        // Initialize the class
        this.init();

    }

    /* Draws the doughnut of the key activity slices
    */
    drawDoughnut() {
        // Set the radius to halve the width and height of the image
        var radius = Math.min(this.width, this.height) / 2,
        // Set the radii of the slices when the chart is loaded
        pathLoad = d3.arc().outerRadius(radius).innerRadius(radius * 0.99),
        // Set the default radii of the slices
        path = d3.arc().outerRadius(radius).innerRadius(radius * 0.6),
        // Set the radii of the slices when the mouse hovers over it
        pathOver = d3.arc().outerRadius(radius * 1.02).innerRadius(radius * 0.6),
        // Set the radius of the labels
        pathLabels = d3.arc().outerRadius(radius * 0.75).innerRadius(radius * 0.75),

        // D3 function to convert the data into slices of the chart
        pie = d3.pie()
            .sort(null)
            .value(function(d) { return d.totalSystems; });

        // Initialize this group
        this.newGroup('waterSysDoughnut');

        // Initialize the placeholder for the doughnut and labels that enables
        // clicking on either to update the beneficiary bar chart
        var arc = this.waterSysDoughnut
            // Move to the center of the container
            .attr('transform',
                  `translate(${this.width / 2}, ${this.height / 2})`
            )
            // Select the pie chart data
            .selectAll('.arc')
            .data(pie(this.fullSet))
            // Loop through the data points
            .enter().append('g')
            .classed('arc', true)
            // For each slice incraese the outter radius slightly when the
            // mouse hovers over it
            .on('mouseover',function(d,i){
                d3.select(this)
                .select('path')
                .transition()
                .duration(300)
                .attr('d', pathOver);
            })
            // For each slice return to the default radius when the mouse leaves
            .on('mouseout',function(d,i){
                d3.select(this)
                .select('path')
                .transition()
                .duration(300)
                .attr('d', path);
            })

        // Draw graphical slices of the doughnut
        arc.append('path')
            // Set the slice radii when the chart is loaded
            .attr('d', pathLoad)
            // Set the slice widths using the data points
            .attr('class', function(d) {
                    return d.data.status;
                }
            )
            // Transition to the default slice radii after the page is loaded
            .transition()
            .duration(750)
            .delay(10)
            .attr('d', path);

        // Draw the total households
        this.waterSysDoughnut
            .append('text')
            .attr('transform', 'translate(0,15)')
            .classed('Impr', true)
            .style('text-anchor', 'middle')
            .style('font', '54px sans-serif')
            .text(this.fullSet[0].totalSystems + " Sys");
        // Draw the percent acheived
        this.waterSysDoughnut
            .append('text')
            .attr('transform', 'translate(0,45)')
            .classed('Impr', true)
            .style('text-anchor', 'middle')
            .style('font', '32px sans-serif')
            .text(this.fullSet[0].pct + "%");
    }

    /* Draw the complete chart
    */
    draw() {
        this.drawDoughnut();
    }
}

/* Load the charts
 *
 *
 */

// Create the pie chart
const waterSysPie = new WaterSysPieChart(
    '#waterSysPie',
    {
        margin: {
            top: 10,
            bottom: 10,
            left: 10,
            right: 10,
        },
    }
)

</script>
