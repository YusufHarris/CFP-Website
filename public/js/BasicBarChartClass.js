[this.xField]/* Creates a basic pie chart of the size of the corresponding html element.
   Parameters:
        selector: Corresponding html element id or class where the chart
                  will appear
        params: Chart parameters.
                margins: { top, bottom, left, right }: margins of the chart
                dataSet: the data to be displayed in the chart - required
                xField: the field name of the x-values to be charted - required
                yField: the field name of the y-values to be charted - required

                classField: the field name of the class to be used for coloring
                            the chart.  If no classField is provided, then the
                            yField will be used as the class
                titleText: the text to display in the title

                unit: the unit to be appended to the values when labeling
                fillRatio: the ratio of the doughnut width

                showTotals: flag to indicate if the center of the pie chart
                            should show the totals
                showAsPercent: flag to indicate if the value to display should
                               be the percent of the slice instead of its
                               absolute value
                colorPalette: the color palette to be used for the chart
                yTextColor: the color of the y-axis text
                xTextColor: the color of the x-axis text
                totalsTextColor: the color of the totals text in the center of
                                 the chart
    This class was originally copied from:
*/
class BasicBarChart extends Chart {
    /* Constructor of the Beneficiary Pie Chart that stores the
       pie chart's variables
    */
    constructor(selector, params={}) {
        // Set the parent class parameters
        super(selector, params);

        // Get the full data set
        this.dataSet = params.dataSet;

        // Get the key of the values to chart
        this.xField = params.xField;
        // Get the key of the categories to chart
        this.yField = params.yField;
        // Get the key of the category classes to chart
        this.classField = params.classField || params.yField;
        // Get the key of the popupField
        this.popupField = params.popupField || '';

        // Get the title text
        this.titleText = params.titleText || '';

        // Get the color palette if it was set
        this.colorPalette = params.colorPalette || '';
        // Get the text color for the slices
        this.xTextColor = params.sliceTextColor || '#666';
        // Get the text color for the total displayed in the center
        this.yTextColor = params.totalsTextColor || '#666';

        // Initialize the class
        this.init();

    }

    /* Draws the bars of the chart
    */
    drawBars() {

        // Set the local variable for the x-axis field name
        var xField = this.xField,
        // Set the local variable for the y-axis field name
        yField = this.yField,
        // Set the local variable for the popup field name when the mouse
        // hovers on the bar
        popupField = this.popupField;

        // Set the padding between bars
        var padding = 1,

        // Set the total number of data points
        valueCnt = this.dataSet.length,

        // Set the width and height locally so that they
        // can be called within sub-functions of D3
        width = this.width,
        height = this.height,

        // Set the scale of the chart
        xMax = d3.max(this.dataSet, function(d){ return parseInt(d[xField]); }),
        xScale = d3.scaleLinear()
            .domain([0, xMax])
            .range([0, this.width]);

        // Initialize this group
        this.newGroup('chartBars');

        // Draw the bars of the chart
        var barHolder = this.chartBars
            .selectAll('g.bars')
            // Loop through the data points
            .data(this.dataSet)
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

        // Adjust the bar chart graph below the title if it has been set
        if (this.titleText != '') {
            barHolder.attr('transform', 'translate(0,30)');
            height = height - 30;
        }

        // Draw the bar for the current data point
        barHolder.append('rect')
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
                return xScale(d[xField]);
            });

        // Add the popup text when the mouse hovers on a bar
        if (popupField != '') {
            barHolder.append("svg:title")
            .text(function(d) { return d[popupField]; });

        }

        // Draw the label for the current data point
        barHolder.append('text')
            // Set the class
            .classed('xLabels', true)
            // Set the text using the beneficiary total
            .text(function(d){
                return d[xField];
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
                return xScale(d[xField]) - 10;
            });
    }

    /* Draws the X-Axis labels, i.e. the F/M labels and the Districts
    */
    drawYLabels() {

        // Set the local variable for the y-axis field name
        var yField = this.yField;

        // Set the total number of data points
        var valueCnt = this.dataSet.length,

        // Set the width and height locally so that they
        // can be called within sub-functions of D3
        width = this.width,
        height = this.height;

        // Initialize this group
        this.newGroup('yLabels');

        var yLabels = this.yLabels;

        // Adjust the bar chart graph below the title if it has been set
        if (this.titleText != '') {
            yLabels.attr('transform', 'translate(0,30)');
            height = height - 30;
        }

        // Draw the F/M labels
        yLabels.selectAll('text')
            // Loop through the data points
            .data(this.dataSet)
            .enter()
            .append('text')
            // Set the label
            .text(function(d) {
                return d[yField];
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
    		.text(this.titleText)
            // Center the text and set its size
            .attr('text-anchor', 'middle')
            .attr('font-size', '24px');

    }

    /* Draw the complete chart
    */
    draw() {
        this.drawBars();
        this.drawYLabels();
        if(this.titleText != '') {
            this.drawTitle();
        }
    }
}
