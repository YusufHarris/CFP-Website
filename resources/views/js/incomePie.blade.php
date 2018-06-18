<script>
// Use regex to add commas to a number
function numberWithCommas(x) {
    return x.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ',');
}

/* The Beneficiary Pie Chart Class that extends the chart class
*/
class IncomePieChart extends Chart {
    /* Constructor of the Beneficiary Pie Chart that stores the
       pie chart's variables
    */
    constructor(selector, params={}) {
        // Set the parent class parameters
        super(selector, params);

        // Get the full data set
        this.fullSet = <?php echo json_encode( $incomeChange ) ?>;

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
        path = d3.arc().outerRadius(radius).innerRadius(radius * 0.43),
        // Set the radii of the slices when the mouse hovers over it
        pathOver = d3.arc().outerRadius(radius * 1.02).innerRadius(radius * 0.43),
        // Set the radius of the labels
        pathLabels = d3.arc().outerRadius(radius * 0.75).innerRadius(radius * 0.43),

        //color = d3.scale.category20c(),

        // D3 function to convert the data into slices of the chart
        pie = d3.pie()
            .sort(null)
            .value(function(d) { return d.benCount; });



        // Initialize this group
        this.newGroup('incomeDoughnut');

        var color = d3.scaleOrdinal(['#A0FF9F','#1AAB19','#5BFF5A']);

        // Initialize the placeholder for the doughnut and labels that enables
        // clicking on either to update the beneficiary bar chart
        var arc = this.incomeDoughnut
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
            .attr('d', path)
            // Set the slice widths using the data points
            .attr('class', function(d) { return d.data.ovallIncomeChange})
            // Transition to the default slice radii after the page is loaded
            .transition()
            .duration(750)
            .delay(10)
            .attr('d', path)
            .attr("fill", function(d) { return color(d.data.ovallIncomeChange); });

        // Draw the Income Responses
        arc.append('text')
            .attr('transform', function(d) { return 'translate(' + pathLabels.centroid(d) + ')'; })
            .text(function(d) { return (d.data.ovallIncomeChange); })
            .style('fill','white')
            .attr('font','12px')
            .style('text-anchor','middle')
            .style('font-weight','bold')
            ;

        // Draw the corresponding percentages
        arc.append('text')
            .attr('transform', function(d) {
                return 'translate(' + pathLabels.centroid(d) + ') translate(0,15)';
            })
            .text(function(d) {
                return Math.round((d.endAngle - d.startAngle)/(2*(Math.PI))*100) + "%";
            })
            .style('fill','white')
            .attr('font','12px')
            .style('text-anchor','middle')
            .style('font-weight','bold')

            ;
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
const incomePie = new IncomePieChart(
    '#incomeChange',
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
