// Use regex to add commas to a number
function numberWithCommas(x) {
    return x.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ',');
}

// Return the sum of all field values in an SQL $result
function getFieldSum(dataSet, field) {
    var cnt = 0;
    for (var x in dataSet) {
        cnt += dataSet[x][field];
    }
    return cnt;
}
