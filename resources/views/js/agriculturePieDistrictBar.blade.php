<script>
// Use regex to add commas to a number
function numberWithCommas(x) {
    return x.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ',');
}

/* The Beneficiary Pie Chart Class that extends the chart class
*/
class BenPieChart extends Chart {
    /* Constructor of the Beneficiary Pie Chart that stores the
       pie chart's variables
    */
    constructor(selector, params={}) {
        // Set the parent class parameters
        super(selector, params);

        // Set the default subset of the beneficiary types
        this.benType = 'Direct Trainees';
        // Get the full data set
        this.fullSet = <?php echo json_encode( $agBens ) ?>;

        // Initialize the subset placeholder for charting the data
        this.subSet;
        // Initialize the total final beneficiaries placeholder for
        // charting the data
        this.total;
        // Initialize the percent female final beneficiaries placeholder for
        // charting the data
        this.fPct;

        // Get the initial sub set of the default beneficiary type
        this.getSubset();
        // Initialize the class
        this.init();

    }

    /* Gets the subset of the beneficiary type from the full data set
       for charting
    */
    getSubset() {
        this.subSet = [];
        for (var x in this.fullSet) {
            if(this.fullSet[x].beneficiaryType==this.benType) {
                if(this.fullSet[x].keyActivity == 'Total') {
                    this.total = this.fullSet[x].totalBeneficiaries;
                    this.fPct = Math.round(this.fullSet[x].fTot / this.fullSet[x].totalBeneficiaries * 100, 0) + '% F';
                }
                else {
                    this.subSet.push(this.fullSet[x]);
                }
            }
        }
    }

    /* Updates the chart using the new beneficiary type
    */
    updateChart(newBenType) {
        // Set the new benType
        this.benType = newBenType;
        // Get the new subset
        this.getSubset();
        // Redraw the chart
        this.resize();
    }

    /* Draws the doughnut of the key activity slices
    */
    drawDoughnut() {
        // Set the radius to halve the width and height of the image
        var radius = Math.min(this.width, this.height) / 2,
        // Set the radii of the slices when the chart is loaded
        pathLoad = d3.arc().outerRadius(radius).innerRadius(radius * 0.99),
        // Set the default radii of the slices
        path = d3.arc().outerRadius(radius).innerRadius(radius * 0.4),
        // Set the radii of the slices when the mouse hovers over it
        pathOver = d3.arc().outerRadius(radius * 1.02).innerRadius(radius * 0.4),
        // Set the radius of the labels
        pathLabels = d3.arc().outerRadius(radius * 0.75).innerRadius(radius * 0.75),

        // Set the beneficiary type locally so that it can
        // be called within sub-function of D3
        benType = this.benType,

        // D3 function to convert the data into slices of the chart
        pie = d3.pie()
            .sort(null)
            .value(function(d) { return d.totalBeneficiaries; });

        // Initialize this group
        this.newGroup('benDoughnut', this.chart);

        // Initialize the placeholder for the doughnut and labels that enables
        // clicking on either to update the beneficiary bar chart
        var arc = this.chart.benDoughnut
            // Move to the center of the container
            .attr('transform',
                  `translate(${this.width / 2}, ${this.height / 2})`
            )
            // Show the hand when the mouse hovers over the slices to indicate
            // the the slices are clickable
            .style('cursor', 'pointer')
            // Select the pie chart data
            .selectAll('.arc')
            .data(pie(this.subSet))
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
            // Update the bar chart when the current slice is clicked
            .on('click', function(d) {
                updateBenBarChart(benType, d.data.keyActivity)
            });

        // Draw graphical slices of the doughnut
        arc.append('path')
            // Set the slice radii when the chart is loaded
            .attr('d', pathLoad)
            // Set the slice widths using the data points
            .attr('class', function(d) { return d.data.keyActivity})
            // Transition to the default slice radii after the page is loaded
            .transition()
            .duration(750)
            .delay(10)
            .attr('d', path);

        // Draw the keyActivity Labels
        arc.append('text')
            .attr('transform', function(d) { return 'translate(' + pathLabels.centroid(d) + ')'; })
            .text(function(d) { return d.data.keyActivity; });

        // Draw the corresponding beneficiary numbers
        arc.append('text')
            .attr('transform', function(d) {
                return 'translate(' + pathLabels.centroid(d) + ') translate(0,15)';
            })
            .text(function(d) {
                return numberWithCommas(d.data.totalBeneficiaries);
            });

        // Draw the corresponding percent female
        arc.append('text')
            .attr('transform', function(d) {
                return 'translate(' + pathLabels.centroid(d) + ') translate(0,30)';
            })
            .text(function(d) {
                return Math.round(d.data.fTot/d.data.totalBeneficiaries * 100, 0) + '% F';
            });
    }

    /* Draws the central total's circle and label
    */
    drawTotalsCircle() {

        // Set the radius to halve the width and height of the image
        var inRadius = (Math.min(this.width, this.height) / 2) * 0.4,
        // Set the beneficiary type locally so that it can
        // be called within sub-function of D3
        benType = this.benType;
        // Initialize this group
        this.newGroup('benTotalCircle');
        // Initialize the placeholder for the circle and label that enables
        // clicking on either to update the beneficiary bar chart
        this.benTotalCircle
            .attr('transform',
                  `translate(${this.width / 2}, ${this.height / 2})`
            )
            // Include the Total class for coloring the circle
            .classed('Total', true)
            // Set the cursor to the pointer hand for easy indication
            // that the circle is clickable
            .style('cursor','pointer')
            // Update the beneficiary bar chart when the circle is
            // clicked
            .on('click', function() {
                updateBenBarChart(benType, 'Total')
            })
            // Increase the radius of the circle when the mouse hovers
            .on('mouseover',function(d,i){
                d3.select(this)
                .select('circle')
                .transition()
                .duration(300)
                .attr('r', inRadius * 1.05);
            })
            // Return to the default state of the circle when the mouse leaves
            .on('mouseout',function(d,i){
                d3.select(this)
                .select('circle')
                .transition()
                .duration(300)
                .attr('r', inRadius);
            });

        // Draw the circle
        this.benTotalCircle
            .append('circle')
            .attr('r', 0)
            // Transition to the default state after the page is loaded
            .transition()
            .duration(750)
            .delay(10)
            .attr('r', inRadius);

        // Label the beneficiary type
        this.benTotalCircle
            .append('text')
            .text(this.benType);
        // Label the number of beneficiaries
        this.benTotalCircle
            .append('text')
            .attr('transform', 'translate(0,15)')
            .text(numberWithCommas(this.total));
        // Label the percent of female beneficiaries
        this.benTotalCircle
            .append('text')
            .attr('transform', 'translate(0,30)')
            .text(this.fPct);
    }

    /* Draw the complete chart
    */
    draw() {
        this.drawTotalsCircle();
        this.drawDoughnut();
    }
}


/* Load the charts
 *
 *
 */

// Reset the select menu option to Direct Trainees
$('#benSelect option').prop('selected', function() {
        return this.defaultSelected;
    });


// Create the pie chart
const benPie = new BenPieChart(
    '#keyActivityPie',
    {
        margin: {
            top: 10,
            bottom: 10,
            left: 10,
            right: 10,
        },
    }
)

// Update the pie and bar charts when the beneficiary type is changed
d3.select('#benSelect')
    .on('change', function() {

        // Set the current beneficiary type to the select menu value
        var newBenType = d3.select(this).select('select').property('value');

        // Update the charts
        benBar.updateChart(newBenType, benBar.keyActivity);
        benPie.updateChart(newBenType);
    });

// Update the beneficiary bar chart when the pie chart
// keyActivity is clicked
function updateBenBarChart(newBenType, keyActivity) {
    benBar.updateChart(newBenType, keyActivity);
}

</script>
