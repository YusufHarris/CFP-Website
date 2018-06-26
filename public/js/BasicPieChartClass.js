/* Creates a basic pie chart of the size of the corresponding html element.
   Parameters:
        selector: Corresponding html element id or class where the chart
                  will appear
        params: Chart parameters.
                margins: { top, bottom, left, right }: margins of the chart
                dataSet: the data to be displayed in the chart - required
                valueField: the field name of the values to be charted - required
                catField: the field name of the categories to be included - required

                classField: the field name of the class to be used for coloring
                            the chart.  If no classField is provided, then the
                            catField will be used as the class

                valueUnit: the unit to be appended to the values when labeling
                fillRatio: the ratio of the doughnut width

                showTotals: flag to indicate if the center of the pie chart
                            should show the totals
                showAsPercent: flag to indicate if the value to display should
                               be the percent of the slice instead of its
                               absolute value
                colorPalette: the color palette to be used for the chart
                sliceTextColor: the color of the text within the slices
                totalsTextColor: the color of the totals text in the center of
                                 the chart
    This class was originally copied from:
*/
class BasicPieChart extends Chart {
    /* Constructor of the Beneficiary Pie Chart that stores the
       pie chart's variables
    */
    constructor(selector, params={}) {
        // Set the parent class parameters
        super(selector, params);

        // Get the full data set
        this.dataSet = params.dataSet || 'dataSet';
        // Get the key of the values to chart
        this.valueField = params.valueField || 'valueField';
        // Get the key of the categories to chart
        this.catField = params.catField || 'catField';

        // Get the key of the category classes to chart
        this.classField = params.classField || 'default';

        // Get the unit type
        this.valueUnit = params.valueUnit || '';
        // Get the ratio to fill in the pie chart width
        this.fillRatio = Math.min(params.fillRatio || 0.4, 1);

        // Get the flag that indicates if the pie chart should
        // show the total of the values in the middle of the chart
        this.showTotals = params.showTotals || false;
        // Get the flag that indicates if the pie chart should
        // show slice values a percentages
        this.showAsPercent = params.showAsPercent || false;

        // Get the color palette if it was set
        this.colorPalette = params.colorPalette || '';
        // Get the text color for the slices
        this.sliceTextColor = params.sliceTextColor || '#fff';
        // Get the text color for the total displayed in the center
        this.totalsTextColor = params.totalsTextColor || '#666';

        // Set the error flag if any required parameters are missing
        if ( this.dataSet == 'dataSet' || this.valueField == 'valueField' || this.catField == 'catField' ) {
            this.missingParams = true;
        }
        else {
            this.missingParams = false;
        }

        // Calculate the total of the values
        if (this.showTotals) {
            this.totals = 0;
            for (var x in this.dataSet) {
                this.totals += Number(this.dataSet[x][this.valueField]);
            }
            this.totals = Math.round(this.totals);
        }
        // Initialize the class
        this.init();

    }

    /* Draws the doughnut
    */
    drawDoughnut() {
        // Set the local variable for the field name of the value to graph
        var valueField = this.valueField,
        // Set the local variable to the field name of the category to graph
        catField = this.catField,
        // Set the local variable to the field name of the category to graph
        classField = this.classField,
        // Set the local variable to the unit
        unitType = this.valueUnit,
        // Set the local variable to the show as percent flag
        showAsPercent = this.showAsPercent;

        // Set the radius to halve the width and height of the image
        var radius = Math.min(this.width, this.height) / 2,
        // Set the radii of the slices when the chart is loaded
        pathLoad = d3.arc().outerRadius(radius).innerRadius(radius * 0.99),
        // Set the default radii of the slices
        path = d3.arc().outerRadius(radius).innerRadius(radius * (1 - this.fillRatio)),
        // Set the radii of the slices when the mouse hovers over it
        pathOver = d3.arc().outerRadius(radius * 1.02).innerRadius(radius * (1 - this.fillRatio)),
        // Set the radius of the labels
        pathLabels = d3.arc().outerRadius(radius * (1 - this.fillRatio/2)).innerRadius(radius * (1 - this.fillRatio/2)),

        // D3 function to convert the data into slices of the pie chart
        pie = d3.pie()
            .sort(null)
            .value(function(d) { return d[valueField]; });

        // Initialize the doughnut group
        this.newGroup('doughnut');

        // Initialize the placeholder to contain the slices and labels
        var arc = this.doughnut
            // Move to the center of the chart
            .attr('transform',
                  `translate(${this.width / 2}, ${this.height / 2})`
            )
            // Select the pie chart data
            .selectAll('.arc')
            .data(pie(this.dataSet))
            // Loop through the data points
            .enter().append('g')
            .classed('arc', true)
            // For each slice increase the outter radius slightly when the
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

        // Draw the slices of the doughnut
        var slices = arc.append('path')
            // Set the slice radii when the chart is loaded
            .attr('d', pathLoad)
            // Transition to the default slice radii after the page is loaded
            .transition()
            .duration(750)
            .delay(10)
            .attr('d', path);

        // Set the color of the slices using either the class or a
        // color palette depending on if a color palette was passed
        // as a parameter
        if (this.colorPalette == '') {
            // Color the slices using their class
            slices.attr('class', function(d) {
                    return d.data[classField].split(" ").join("_");
                })
        } else {
            // If the colorPalette is set color the slices using
            // the color palette
            var color = d3.scaleOrdinal(this.colorPalette);
            slices.attr('fill', function(d) {
                    return color(d.data[catField]);
                })
        }

        // Draw the category labels
        arc.append('text')
            .attr('transform', function(d) { return 'translate(' + pathLabels.centroid(d) + ')'; })
            .text(function(d) { return d.data[catField]; })
            .attr('text-anchor', 'middle')
            .style('font', '14px sans-serif')
            .style('font-weight', 'bold')
            .attr('fill', this.sliceTextColor);

        // Draw the value labels
        arc.append('text')
            .attr('transform', function(d) {
                return 'translate(' + pathLabels.centroid(d) + ') translate(0,18)';
            })
            .text(function(d) {
                if (showAsPercent == true) {
                    return Math.round((d.endAngle - d.startAngle)/(2*(Math.PI))*100) + "%";
                }
                else {
                    return numberWithCommas(d.data[valueField]) + ' ' + unitType;
                }
            })
            .attr('text-anchor', 'middle')
            .style('font', '14px sans-serif')
            .style('font-weight', 'bold')
            .attr('fill', this.sliceTextColor);

        // Draw the totals in the center of the pie chart
        if (this.showTotals) {
            this.doughnut
                .append('text')
                .attr('transform', 'translate(0,15)')
                .text(this.totals + ' ' + this.valueUnit)
                .attr('text-anchor', 'middle')
                .style('font', '32px sans-serif')
                .style('font-weight', 'bold')
                .attr('fill', this.totalsTextColor);
        }

    }

    /* Draw the error message if any parameters are missing
    */
    showErrors() {

        // Initialize the error message group
        this.newGroup('errors');

        this.errors
            .append('text')
            // Move to the center of the chart
            .attr('transform',
                  `translate(${this.width / 2}, ${this.height / 2})`)
            .text('Missing required parameters.')
            .attr('text-anchor', 'middle')
            .style('font', '12px sans-serif');
    }

    /* Draw the complete chart
    */
    draw() {

        // draw the error message
        if (this.missingParams) {
            this.showErrors();
        }
        else {
            this.drawDoughnut();
        }
    }
}
