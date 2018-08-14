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

                xUnit: the unit to be appended to the xField values when labeling
                fillRatio: the ratio of the doughnut width

                showTotals: flag to indicate if the center of the pie chart
                            should show the totals
                showAsPercent: flag to indicate if the value to display should
                               be the percent of the slice instead of its
                               absolute value
                colorPalette: the color palette to be used for the chart
                yTextColor: the color of the y-axis text
                xTextColor: the color of the x-axis text
                titleTextColor: the color of the totals text in the center of
                                 the chart
                titleSize: the size of the title
                titleDistance: title distance from the top of field
                minVal: minimum value for graph
                maxVal: max value fro graph to display
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
        this.classField = params.classField || '';
        // Get the key of the popupField
        this.popupField = params.popupField || '';
        //get the minimum value for the graph to display
        this.minVal = params.minVal || '0';
        //get the maximum value for graph to display
        this.maxVal = params.maxVal || d3.max(this.dataSet, function(d){ return parseInt(d[params.xField]); });


        // Get the title text
        this.titleText = params.titleText || '';
        this.titleTextSize = params.titleTextSize || '24px';
        // Get the title text color
        this.titleTextColor = params.titleTextColor || '#666';
        //get the title title size
        this.titleSize = params.titleSize || '24px';
        //get the title distance
        this.titleDistance = params.titleDistance || '30';
        //get the title's font
        this.titleFont = params.titleFont || 'sans-serif';
        //get the title font weight
        this.fontWeight = params.fontWeight || 'normal';
        // Get the unit for the xField values
        this.xUnit = params.xUnit || '';
        // Get the color palette if it was set
        this.colorPalette = params.colorPalette || '';
        // Get the text color for the slices
        this.xTextColor = params.xTextColor || '#fff';
        // Get the text color for the total displayed in the center
        this.yTextColor = params.yTextColor || '#666';


        // Get the subtitle text
        this.subTitleText = params.subTitleText || '';
        this.subTitleTextSize = params.subTitleTextSize || '16px';
        // Get the title text color
        this.subTitleTextColor = params.subTitleTextColor || '#666';
        //get the title title size
        this.subTitleSize = params.subTitleSize || '24px';
        //get the title distance
        this.subTitleDistance = params.subTitleDistance || '30';

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
        popupField = this.popupField,
        // Set the local variable for the class field
        classField = this.classField,
        // Set the local variable for the x-axis unit
        xUnit = this.xUnit || '';

        // Set the padding between bars
        var padding = 1,

        // Set the total number of data points
        valueCnt = this.dataSet.length,

        // Set the width and height locally so that they
        // can be called within sub-functions of D3
        width = this.width,
        height = this.height,

        // Set the scale of the chart

        xScale = d3.scaleLinear()
            .domain([this.minVal, this.maxVal])
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
            .classed('barholder', true)
            // Darken the bar and lighten the labels when the mouse
            // hovers over it
            .on('mouseover',function(d){
                d3.select(this)
                .select('rect')
                .transition()
                .duration(750)
                .delay(10)
                .attr('fill-opacity', 0.8);
            })
            // Return to the default opacity and font color when
            // the mouse leaves
            .on('mouseout',function(d){
                d3.select(this)
                .select('rect')
                .transition()
                .duration(750)
                .delay(10)
                .attr('fill-opacity', 1.0);
            });

        // Adjust the bar chart graph below the title if it has been set
        if (this.titleText != '') {
            barHolder.attr('transform', 'translate(0,30)');
            height = height - 30;
        }

        // Draw the bars
        var thebars = barHolder.append('rect')
            // Set the initial x coordinate of the left side of the bar
            .attr('x', function(d) {
                return 0;
            })
            // Set the y coordinate of the top of the bar to the
            // bottom of the chart area
            .attr('y', function(d,i){
                return i * (height / valueCnt);
            })
            // Set the initail width to 0
            .attr('width', 0)
            // Set height of the bar as a function of the total height
            // of the bar chart
            .attr('height', height / valueCnt - padding)
            // Set the original opacity to 100%
            .attr('fill-opacity', 1.0);

        // Set the bar color using either the class, the color scheme,
        // or the default grayscale
        if (this.classField != '') {
            // Set color using the class
            thebars.attr('class', function(d) {
                    return d[classField].split(" ").join("_");
                })
        } else if (this.colorPalette != '') {
            // If the colorPalette is set color the slices using
            // the color palette
            var color = d3.scaleOrdinal(this.colorPalette);
            thebars.attr('fill', function(d) {
                    return color(d[yField]);
                })
        } else {
            // If the colorPalette is set color the slices using
            // the color palette
            var color = d3.scaleOrdinal(['#666', '#999']);
            thebars.attr('fill', function(d) {
                    return color(d[yField]);
                })
        }

            // Transition to the default state after the page is loaded
            thebars.transition()
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
                    return numberWithCommas(d[xField]) + xUnit;
            })
            // Set the x coordinate of the label
            .attr('x', function(d) {
                return -5;
            })
            // Set the initial y coordinate of the label to the
            // bottom of the chart
            .attr('y', function(d,i){
                return (i+0.7) * (height / valueCnt);
            })
            // Set the font style
            .attr('font-family', this.titleFont)
            .attr('font-size', '16px')
            .attr('fill', this.xTextColor)
            .attr('text-anchor', 'end')
            // Transition to the default state after the page is loaded
            .transition()
            .duration(750)
            .delay(10)
            // Grow the label as the bar grows to the scaled size
            .attr('x', function(d){
                return xScale(d[xField]) - 5;
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
            .attr('fill', this.yTextColor)
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
            .attr('transform', 'translate(' + this.width/2 + ',' + (this.titleDistance - this.margin.top) + ')')
            .append('text')
    		.classed('title', true)
            // Set the text to the title
    		.text(this.titleText)
            // Center the text and set its size
            .attr('text-anchor', 'middle')
            .attr('font-size', this.titleSize)
            .style('font-weight',this.fontWeight)
            .attr('fill', this.titleTextColor);

    }

    /*Draws the subtitle of the charts
    */
    /* Draws the title of the chart
    */
    drawSubTitle() {

        // Initialize this group
        this.newGroup('subTitle');

        // Draw the title
        this.subTitle
            // Move to the center of the chart
            .attr('transform', 'translate(' + this.width/2 + ',' + (this.subTitleDistance - this.margin.top) + ')')
            .append('text')
    		.classed('title', true)
            // Set the text to the title
    		.text(this.subTitleText)
            // Center the text and set its size
            .attr('text-anchor', 'middle')
            .attr('font-size', this.subTitleSize)
            .style('font-weight',this.fontWeight)
            .attr('fill', this.subTitleTextColor);

    }

    /* Draw the complete chart
    */
    draw() {
        this.drawBars();
        this.drawYLabels();
        if(this.titleText != '') {
            this.drawTitle();
        }
        if(this.subTitleText != '') {
            this.drawSubTitle();
        }
    }
}
