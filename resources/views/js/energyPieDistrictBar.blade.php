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
        this.fullSet = <?php echo json_encode( $enBens ) ?>;

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
                if(this.fullSet[x].shortenedName == 'Total') {
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
                updateBenBarChart(benType, d.data.shortenedName)
            });

        // Draw graphical slices of the doughnut
        arc.append('path')
            // Set the slice radii when the chart is loaded
            .attr('d', pathLoad)
            // Set the slice widths using the data points
            .attr('class', function(d) {
                    var startIdx = d.data.shortenedName.indexOf('-') + 1;
                    return d.data.shortenedName.substring(startIdx);
                }
            )
            // Transition to the default slice radii after the page is loaded
            .transition()
            .duration(750)
            .delay(10)
            .attr('d', path);

        // Draw the keyActivity Labels
        arc.append('text')
            .attr('transform', function(d) { return 'translate(' + pathLabels.centroid(d) + ')'; })
            .text(function(d) { return d.data.shortenedName; });

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
                  `translate(${this.width / 2}, ${this.height / 2})`)
            // Include the Total class for coloring the circle
            .classed('Energy', true)
            // Set the cursor to the pointer hand for easy indication
            // that the circle is clickable
            .style('cursor','pointer')
            // Update the beneficiary bar chart when the circle is
            // clicked
            .on('click', function() {
                updateBenBarChart(benType, 'Energy');
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
        this.drawDoughnut();
        this.drawTotalsCircle();
    }
}


/* The Beneficiary Bar Chart Class that extends the chart class
*/
class BenBarChart extends Chart {
    constructor(selector, params={}) {
        // Set the parent class parameters
        super(selector, params);

        // Set the default subset of the beneficiary types
        this.benType = 'Direct Trainees';
        // Set the default key activity type to include all
        this.ka = 'Energy';
        // Get the full data set
        this.fullSet = <?php echo json_encode( $districtBens ) ?>;
        // Initialize the subset placeholder for charting the data
        this.subSet;

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
                if(this.fullSet[x].shortenedName == this.ka) {
                    this.subSet.push(this.fullSet[x]);
                }
            }
        }
    }

    /* Updates the chart using the new beneficiary type
       and key activity
    */
    updateChart(newBenType, newKa) {
        // Set the new benType
        this.benType = newBenType;
        // Set the new key activity
        this.ka = newKa;
        // Get the new subset
        this.getSubset();
        // Redraw the chart
        this.resize();
    }

    /* Draws the bars of the chart
    */
    drawBars() {
        // Set the padding between bars
        var padding = 1,

        // Set the total number of data points
        valueCnt = this.subSet.length,

        // Set the width and height locally so that they
        // can be called within sub-functions of D3
        width = this.width,
        height = this.height,

        // Set the scale of the chart
        yMax = d3.max(this.subSet, function(d){ return parseInt(d.tot); }),
        yScale = d3.scaleLinear()
            .domain([0, yMax])
            .range([0, this.height]);

        // Initialize this group
        this.newGroup('benBars');

        // Draw the bars of the chart
        var benBarholder = this.benBars
            .selectAll('g.bars')
            // Loop through the data points
            .data(this.subSet)
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
                .select('text.yLabels')
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
                .select('text.yLabels')
                .transition()
                .duration(750)
                .delay(10)
                .attr('fill', '#333');
            });

        // Draw the bar for the current data point
        benBarholder.append('rect')
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
            .classed(this.ka.substring(this.ka.indexOf('-') + 1), true)
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
            .attr('y', function(d){
                return height - yScale(d.tot);
            })
            .attr('height', function(d){
                return yScale(d.tot);
            });

        // Draw the label for the current data point
        benBarholder.append('text')
            // Set the class
            .classed('yLabels', true)
            // Set the text using the beneficiary total
            .text(function(d){
                return d.tot;
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
            .attr('font-size', '13px')
            .attr('fill', '#333')
            .attr('text-anchor', 'middle')
            // Transition to the default state after the page is loaded
            .transition()
            .duration(750)
            .delay(10)
            // Grow the label as the bar grows to the scaled size
            .attr('y', function(d){
                return height - yScale(d.tot) + 15;
            });
    }

    /* Draws the X-Axis labels, i.e. the F/M labels and the Districts
    */
    drawXLabels() {

        // Set the total number of data points
        var valueCnt = this.subSet.length,

        // Set the width and height locally so that they
        // can be called within sub-functions of D3
        width = this.width,
        height = this.height;

        // Initialize this group
        this.newGroup('xLabels');

        // Draw the F/M labels
        this.xLabels
            .selectAll('text.mfLabels')
            // Loop through the data points
            .data(this.subSet)
            .enter()
            .append('text')
            .classed('mfLabels', true)
            // Set the label
            .text(function(d) {
                return d.mF;
            })
            // Set x coordinate to the left edge of each bar plus half
            // the bar width
            .attr('x', function(d, i) {
                return (i+0.5) * (width / valueCnt);
            })
            // Set the y coordinate to just below the bars
            .attr('y', height + 30)
            .attr('fill', '#666')
            .attr('text-anchor', 'middle');

        // Draw the District labels
        this.xLabels
            .selectAll('text.DistLabels')
            .data(this.subSet)
            .enter()
            .append('text')
    		.classed('DistLabels', true)
    		.text(function(d,i) {
                if(i%2 == 0)
                    return d.district;
            })
    		// Set x position to the left edge of each bar plus half the bar width
    		.attr('x', function(d, i) {
                if(i%2 == 0)
                    if(i < valueCnt-1) {
                        return (i+1) * (width / valueCnt);
                    } else {
                        return (i+0.5) * (width / valueCnt);
                    }
    		})
    		.attr('y', height + 60)
            .attr('fill', '#333')
    		.attr('text-anchor', 'middle')
            .attr('font-weight', 'bold');
    }

    /* Draws the title of the chart
    */
    drawTitle() {

        // Initialize this group
        this.newGroup('title');

        // Set the current class
        var curClass = this.ka.substring(this.ka.indexOf('-') + 1);

        // Draw the title
        this.title
            // Move to the center of the chart
            .attr('transform', 'translate(' + this.width/2 + ',' + (30 - this.margin.top) + ')')
            .append('text')
    		.classed('title ' + curClass, true)
            // Set the text to the title
    		.text(`${this.subSet[0].keyActivity} ${this.benType}`)
            // Center the text and set its size
            .attr('text-anchor', 'middle')
            .attr('font-size', '24px');

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

// Reset the select menu option to Direct Trainees
$('#benSelect option').prop('selected', function() {
        return this.defaultSelected;
    });

// Create the bar chart
const benBar= new BenBarChart(
    '#enDistrictBar',
    {
        margin: {
            top: 50,
            bottom: 70,
            left: 10,
            right: 10,
        },
    }
)

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
        benBar.updateChart(newBenType, benBar.ka);
        benPie.updateChart(newBenType);
    });

// Update the beneficiary bar chart when the pie chart
// keyActivity is clicked
function updateBenBarChart(newBenType, ka) {
    benBar.updateChart(newBenType, ka);
}

</script>
