console.log('connect to showExtractData.js\n');
var delayInMilliseconds = 500;

function showElement(id, delay) {
    document.getElementById(id).style.opacity = "1";
    setTimeout(function(){
        document.getElementById(id).style.display = "block";
    }, delay);
}

function hideElement(id, delay) {
    document.getElementById(id).style.opacity = "0";
    setTimeout(function(){
        document.getElementById(id).style.display = "none";
    }, delay);
}

function extractDataOne() {
    console.log('enter in extractDataOne\n');
    var stateOfOne = document.getElementById('extractOnePST');

    if (stateOfOne.style.display == "none") {
        showElement('extractOnePST', 300);
        hideElement('extractMine', 300);
        hideElement('extractYear', 300);
        hideElement('extractAll', 300);

        hideElement('extractMark', 300);
        hideElement('extractStudent', 300);
        hideElement('extractOrders', 300);
        hideElement('extractReport', 300);
    } else {
        hideElement('extractOnePST', 300);
        hideElement('extractMine', 300);
        hideElement('extractYear', 300);
        hideElement('extractAll', 300);

        hideElement('extractMark', 300);
        hideElement('extractStudent', 300);
        hideElement('extractOrders', 300);
        hideElement('extractReport', 300);
    }
}

function extractDataMine() {
    console.log('enter in extractDataMine\n');
    var stateOfMine = document.getElementById('extractMine');

    if (stateOfMine.style.display == "none") {
        hideElement('extractOnePST', 300);
        showElement('extractMine', 300);
        hideElement('extractYear', 300);
        hideElement('extractAll', 300);

        hideElement('extractMark', 300);
        hideElement('extractStudent', 300);
        hideElement('extractOrders', 300);
        hideElement('extractReport', 300);
    } else {
        hideElement('extractOnePST', 300);
        hideElement('extractMine', 300);
        hideElement('extractYear', 300);
        hideElement('extractAll', 300);

        hideElement('extractMark', 300);
        hideElement('extractStudent', 300);
        hideElement('extractOrders', 300);
        hideElement('extractReport', 300);
    }
}

function extractDataYear() {
    console.log('enter in extractDataYear\n');
    var stateOfYear = document.getElementById('extractYear');

    if (stateOfYear.style.display == "none") {
        hideElement('extractOnePST', 300);
        hideElement('extractMine', 300);
        showElement('extractYear', 300);
        hideElement('extractAll', 300);

        hideElement('extractMark', 300);
        hideElement('extractStudent', 300);
        hideElement('extractOrder', 300);
        hideElement('extractReport', 300);
    } else {
        hideElement('extractOnePST', 300);
        hideElement('extractMine', 300);
        hideElement('extractYear', 300);
        hideElement('extractAll', 300);

        hideElement('extractMark', 300);
        hideElement('extractStudent', 300);
        hideElement('extractOrder', 300);
        hideElement('extractReport', 300);
    }
}

function extractDataAll() {
    console.log('enter in extractDataAll\n');
    var stateOfAll = document.getElementById('extractAll');

    if (stateOfAll.style.display == "none") {
        hideElement('extractOnePST', 300);
        hideElement('extractMine', 300);
        hideElement('extractYear', 300);
        showElement('extractAll', 300);

        hideElement('extractMark', 300);
        hideElement('extractStudent', 300);
        hideElement('extractOrder', 300);
        hideElement('extractReport', 300);
    } else {
        hideElement('extractOnePST', 300);
        hideElement('extractMine', 300);
        hideElement('extractYear', 300);
        hideElement('extractAll', 300);

        hideElement('extractMark', 300);
        hideElement('extractStudent', 300);
        hideElement('extractOrder', 300);
        hideElement('extractReport', 300);
    }
}

function extractDataMark() {
    console.log('enter in extractDataMark\n');
    var stateOfMark = document.getElementById('extractMark');

    if (stateOfMark.style.display == "none") {
        hideElement('extractOnePST', 300);
        hideElement('extractMine', 300);
        hideElement('extractYear', 300);
        hideElement('extractAll', 300);

        showElement('extractMark', 300);
        hideElement('extractStudent', 300);
        hideElement('extractOrder', 300);
        hideElement('extractReport', 300);
    } else {
        hideElement('extractOnePST', 300);
        hideElement('extractMine', 300);
        hideElement('extractYear', 300);
        hideElement('extractAll', 300);

        hideElement('extractMark', 300);
        hideElement('extractStudent', 300);
        hideElement('extractOrder', 300);
        hideElement('extractReport', 300);
    }
}

function extractDataOrder() {
    console.log('enter in extractDataOrder\n');
    var stateOfOrder = document.getElementById('extractOrder');

    if (stateOfOrder.style.display == "none") {
        hideElement('extractOnePST', 300);
        hideElement('extractMine', 300);
        hideElement('extractYear', 300);
        hideElement('extractAll', 300);

        hideElement('extractMark', 300);
        hideElement('extractStudent', 300);
        showElement('extractOrder', 300);
        hideElement('extractReport', 300);
    } else {
        hideElement('extractOnePST', 300);
        hideElement('extractMine', 300);
        hideElement('extractYear', 300);
        hideElement('extractAll', 300);

        hideElement('extractMark', 300);
        hideElement('extractStudent', 300);
        hideElement('extractOrder', 300);
        hideElement('extractReport', 300);
    }
}

function extractDataReport() {
    console.log('enter in extractDataReport\n');
    var stateOfReport = document.getElementById('extractReport');

    if (stateOfReport.style.display == "none") {
        hideElement('extractOnePST', 300);
        hideElement('extractMine', 300);
        hideElement('extractYear', 300);
        hideElement('extractAll', 300);

        hideElement('extractMark', 300);
        hideElement('extractStudent', 300);
        hideElement('extractOrder', 300);
        showElement('extractReport', 300);
    } else {
        hideElement('extractOnePST', 300);
        hideElement('extractMine', 300);
        hideElement('extractYear', 300);
        hideElement('extractAll', 300);

        hideElement('extractMark', 300);
        hideElement('extractStudent', 300);
        hideElement('extractOrder', 300);
        hideElement('extractReport', 300);
    }
}

function extractDataStudent() {
    console.log('enter in extractDataStudent\n');
    var stateOfStudent = document.getElementById('extractStudent');

    if (stateOfStudent.style.display == "none") {
        hideElement('extractOnePST', 300);
        hideElement('extractMine', 300);
        hideElement('extractYear', 300);
        hideElement('extractAll', 300);

        hideElement('extractMark', 300);
        showElement('extractStudent', 300);
        hideElement('extractOrder', 300);
        hideElement('extractReport', 300);
    } else {
        hideElement('extractOnePST', 300);
        hideElement('extractMine', 300);
        hideElement('extractYear', 300);
        hideElement('extractAll', 300);

        hideElement('extractMark', 300);
        hideElement('extractStudent', 300);
        hideElement('extractOrder', 300);
        hideElement('extractReport', 300);
    }
}
