<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Simple Calculator</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            background: #f7f7f7;
        }
        .calculator {
            background: #fff;
            border-radius: 10px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
            padding: 20px;
            width: 320px;
        }
        .display {
            width: 100%;
            height: 50px;
            background: #f2f2f2;
            border: none;
            border-radius: 5px;
            font-size: 2em;
            text-align: right;
            margin-bottom: 10px;
            padding: 10px;
        }
        .buttons {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 10px;
        }
        button {
            padding: 20px;
            font-size: 1.2em;
            border: none;
            border-radius: 5px;
            background: #e0e0e0;
            cursor: pointer;
            transition: background 0.2s;
        }
        button:active {
            background: #ccc;
        }
        .equals {
            background: #ff7f50;
            color: #fff;
        }
        .equals:active {
            background: #e0663a;
        }
    </style>
</head>
<body>
    <div class="calculator">
        <div style="text-align: center; margin-bottom: 15px; font-size: 1.2em; color: #666;">
            <?php echo shell_exec('hostname -f'); ?>
        </div>
        <input type="text" class="display" id="display" disabled style="box-sizing: border-box;" />
        <div class="buttons">
            <button onclick="clearDisplay()">C</button>
            <button onclick="appendValue('(')">(</button>
            <button onclick="appendValue(')')">)</button>
            <button onclick="appendValue('/')">÷</button>
            <button onclick="appendValue('7')">7</button>
            <button onclick="appendValue('8')">8</button>
            <button onclick="appendValue('9')">9</button>
            <button onclick="appendValue('*')">×</button>
            <button onclick="appendValue('4')">4</button>
            <button onclick="appendValue('5')">5</button>
            <button onclick="appendValue('6')">6</button>
            <button onclick="appendValue('-')">−</button>
            <button onclick="appendValue('1')">1</button>
            <button onclick="appendValue('2')">2</button>
            <button onclick="appendValue('3')">3</button>
            <button onclick="appendValue('+')">+</button>
            <button onclick="appendValue('0')">0</button>
            <button onclick="appendValue('.')">.</button>
            <button onclick="appendValue('%')">%</button>
            <button class="equals" onclick="calculate()">=</button>
        </div>
    </div>
    <script>
        const display = document.getElementById('display');
        function appendValue(val) {
            display.value += val;
        }
        function clearDisplay() {
            display.value = '';
        }
        function calculate() {
            try {
                let expr = display.value.replace(/÷/g, '/').replace(/×/g, '*').replace(/−/g, '-');
                expr = expr.replace(/%/g, '/100');
                display.value = eval(expr);
            } catch {
                display.value = 'Error';
            }
        }
    </script>
</body>
</html>
