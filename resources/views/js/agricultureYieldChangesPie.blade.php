<script>
// Use regex to add commas to a number
function numberWithCommas(x) {
    return x.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ',');
}

/* The Beneficiary Pie Chart Class that extends the chart class
*/
class YieldChgPieChart extends Chart {
    /* Constructor of the Beneficiary Pie Chart that stores the
       pie chart's variables
    */
    constructor(selector, params={}) {
        // Set the parent class parameters
        super(selector, params);

        // Set the default subset of the beneficiary types
        this.benType = 'Direct Trainees';
        // Get the full data set
        this.fullSet = <?php echo json_encode( $yieldChgs ) ?>;

        // Initialize the total final beneficiaries placeholder for
        // charting the data
        this.impPct;
        this.getImprovedPct();

        // Initialize the percent female final beneficiaries placeholder for
        // charting the data
        this.fPct;

        // Initialize the class
        this.init();

    }

    /* Gets the percent reporting improved yields
    */
    getImprovedPct() {

        var impTot,
            tot = 0;

        for (var x in this.fullSet) {
            if(this.fullSet[x].yield01=="Improved") {
                impTot = this.fullSet[x].beneficiaries;
            }
            tot += this.fullSet[x].beneficiaries;
        }

        this.impPct = Math.round(impTot / tot * 100, 0);
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
            .value(function(d) { return d.beneficiaries; });

        // Initialize this group
        this.newGroup('yieldDoughnut');

        // Initialize the placeholder for the doughnut and labels that enables
        // clicking on either to update the beneficiary bar chart
        var arc = this.yieldDoughnut
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
                    return d.data.yield01.substring(0, 4);
                }
            )
            // Transition to the default slice radii after the page is loaded
            .transition()
            .duration(750)
            .delay(10)
            .attr('d', path);

        // Draw the percent improved
        this.yieldDoughnut
            .append('text')
            .attr('transform', 'translate(0,25)')
            .classed('Impr', true)
            .style('text-anchor', 'middle')
            .style('font', '72px sans-serif')
            .text(this.impPct + "%");
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
const yieldChgPie = new YieldChgPieChart(
    '#yieldPie',
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
