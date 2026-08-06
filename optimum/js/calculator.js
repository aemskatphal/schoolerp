
    
// calculator custom functions
var oper = "";
var num = "";

function getDisplayElement() {
    if (window.jQuery) {
        var $display = $("#display");
        if ($display.length) {
            return $display;
        }
    }

    if (document.form1 && document.form1.t1) {
        return $(document.form1.t1);
    }

    return null;
}

function getDisplayValue() {
    var $display = getDisplayElement();
    if ($display && $display.length) {
        return $display.val();
    }
    return "";
}

function setDisplayValue(value) {
    var $display = getDisplayElement();
    if ($display && $display.length) {
        $display.val(value);
        return;
    }

    if (document.form1 && document.form1.t1) {
        document.form1.t1.value = value;
    }
}

function displaynum(n) {
    var currentValue = getDisplayValue();
    if (currentValue === null || currentValue === undefined) {
        currentValue = "";
    }
    setDisplayValue(String(currentValue) + String(n));
}

function operator(op) {
    oper = op;
    num = getDisplayValue();
    setDisplayValue("");
}

function equals() {
    var left = parseFloat(num);
    var right = parseFloat(getDisplayValue());

    if (isNaN(left) || isNaN(right)) {
        setDisplayValue("Error");
        return;
    }

    doesthejob(left, right, oper);
}

function doesthejob(n1, n2, op) {
    if (op === "+") {
        setDisplayValue(n1 + n2);
    } else if (op === "-") {
        setDisplayValue(n1 - n2);
    } else if (op === "*") {
        setDisplayValue(n1 * n2);
    } else if (op === "/") {
        if (n2 === 0) {
            setDisplayValue("Error");
            return;
        }
        setDisplayValue(n1 / n2);
    } else if (op === "nCr") {
        setDisplayValue(fact2(n1) / fact2(n1 - n2) / fact2(n2));
    } else if (op === "nPr") {
        setDisplayValue(fact2(n1) / fact2(n1 - n2));
    } else {
        setDisplayValue("Error");
    }
}

function fact2(n) {
    if (errorchecking(n) === false) {
        return 0;
    }

    var answer = 1;
    for (var i = n; i >= 2; i--) {
        answer = answer * i;
    }
    return answer;
}

function fact() {
    var n = Number(getDisplayValue());
    if (errorchecking(n) === false) {
        return;
    }

    var answer = 1;
    for (var i = n; i >= 2; i--) {
        answer = answer * i;
    }
    setDisplayValue(answer);
}

function errorchecking(n) {
    if (isNaN(n)) {
        alert("Please enter a valid number");
        return false;
    }

    if (n < 0) {
        alert("Number shouldn't be negative");
        return false;
    }

    if (n % 1 !== 0) {
        alert("The number should be an integer");
        return false;
    }

    return true;
}

function prime(n) {
    if (errorchecking(n) === false) {
        return;
    }

    var b = true;
    for (var i = 2; i <= n / 2; i++) {
        if (n % i === 0) {
            setDisplayValue("Not prime; first divided by " + i);
            b = false;
            break;
        }
    }

    if (b) {
        setDisplayValue("Is prime");
    }
}

function negation() {
    var currentValue = Number(getDisplayValue());
    if (!isNaN(currentValue)) {
        setDisplayValue(currentValue * -1);
    }
}

function reset() {
    setDisplayValue("");
    num = "";
    oper = "";
}

window.displaynum = displaynum;
window.operator = operator;
window.equals = equals;
window.doesthejob = doesthejob;
window.fact2 = fact2;
window.fact = fact;
window.errorchecking = errorchecking;
window.prime = prime;
window.negation = negation;
window.reset = reset;
// Calculator functions end here.