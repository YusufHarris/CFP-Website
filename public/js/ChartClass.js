/* Creates a chart of the size of the corresponding html element.
   Parameters:
        selector: Corresponding html element id or class where the chart
                  will appear
        params: Chart parameters.  This parent class only uses the margin
                within the params dictionary to set the margins of the chart
                additional parameters can be used within the children classes
    This class was originally copied from:
*/
class Chart {
    constructor(selector, params={}) {
        // selector is just the selection string that corresponds to the
        // id or class of the div element
        this.selector = selector;
        // svg is the d3 svg element
        this.svg = d3.select(selector).append('svg');
        // margins are the empty space outside the chart
        this.margin = params.margin || {
            top: 0,
            bottom: 0,
            left: 0,
            right: 0,
        }
        // chart is the main group that we use for everything
        // it is offset by the margins
        this.chart = this.svg.append('g')
            .attr('transform', `translate(${this.margin.left}, ${this.margin.top})`)
            .classed('chart', true);
    }

    get selected() {
        // getter for the jquery selector
        return $(this.selector);
    }

    init() {
        // need to initialize chart initially
        this.resize();
        // and on resize, redraw
        $(window).resize(() => {
            this.resize();
        })
    }

    draw() {
        // this is overridden by subclass
    }

    resize() {
        // calculates new dimensions and draws
        // https://bl.ocks.org/curran/3a68b0c81991e2e94b19
        this.containerWidth = this.selected.width();
        this.containerHeight = this.selected.height();

        this.width = this.containerWidth - this.margin.left - this.margin.right;
        this.height = this.containerHeight - this.margin.top - this.margin.bottom;

        this.svg
            .attr('width', this.containerWidth)
            .attr('height', this.containerHeight);

        this.chart
            .attr('width', this.width)
            .attr('height', this.height);

        this.draw();
    }

    newGroup(name, parent=undefined) {
        if (parent === undefined) {
            this.chart.selectAll(`.${name}`).remove();
            this[name] = this.chart.append('g').classed(name, true);
        } else {
            parent.selectAll(`.${name}`).remove();
            parent[name] = parent.append('g').classed(name, true);
        }
    }
}
