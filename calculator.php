<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Calculator</title>
  <style>
    body {
      background: #222;
      display: flex;
      justify-content: center;
      align-items: center;
      height: 100vh;
      margin: 0;
      font-family: 'Segoe UI', Arial, sans-serif;
    }
    .calculator {
      background: #fff;
      border-radius: 12px;
      box-shadow: 0 4px 24px rgba(0,0,0,0.2);
      width: 340px;
      padding: 0;
      overflow: hidden;
    }
    .calc-header {
      display: flex;
      align-items: center;
      justify-content: space-between;
      padding: 10px 16px 0 16px;
      background: #f7f7f7;
      border-bottom: 1px solid #e0e0e0;
    }
    .calc-header .title {
      font-weight: 500;
      font-size: 1.1em;
    }
    .calc-header .window-controls {
      display: flex;
      gap: 6px;
    }
    .calc-header .window-controls span {
      display: inline-block;
      width: 14px;
      height: 14px;
      border-radius: 50%;
      background: #e0e0e0;
      margin-left: 2px;
    }
    .calc-header .window-controls span:nth-child(1) { background: #e0e0e0; }
    .calc-header .window-controls span:nth-child(2) { background: #e0e0e0; }
    .calc-header .window-controls span:nth-child(3) { background: #e0e0e0; }
    .calc-header .menu {
      font-size: 0.95em;
      color: #444;
      margin-left: 10px;
    }
    .calc-display {
      background: #f7f7f7;
      padding: 18px 16px 8px 16px;
      min-height: 80px;
      display: flex;
      flex-direction: column;
      justify-content: flex-end;
      border-bottom: 1px solid #e0e0e0;
    }
    .calc-history {
      color: #444;
      font-size: 1.1em;
      min-height: 24px;
      display: flex;
      justify-content: space-between;
      align-items: center;
    }
    .calc-history .result {
      font-weight: bold;
      font-size: 1.2em;
      color: #444;
    }
    .calc-main-result {
      font-size: 1.6em;
      font-weight: bold;
      color: #222;
      margin-top: 4px;
      min-height: 32px;
    }
    .calc-buttons {
      display: grid;
      grid-template-columns: repeat(5, 1fr);
      gap: 8px;
      padding: 16px;
      background: #fff;
    }
    .calc-btn {
      font-size: 1.2em;
      padding: 16px 0;
      border: none;
      border-radius: 8px;
      background: #f0f0f0;
      color: #222;
      cursor: pointer;
      transition: background 0.15s;
      outline: none;
    }
    .calc-btn:active {
      background: #e0e0e0;
    }
    .calc-btn.orange {
      background: #ff7f1f;
      color: #fff;
      font-weight: bold;
    }
    .calc-btn.orange:active {
      background: #e06d00;
    }
    .calc-btn.wide {
      grid-column: span 2;
    }
  </style>
</head>
<body>
  <div class="calculator">
    <div class="calc-display">
      <div class="calc-history">
        <span id="history"></span>
        <span class="result" id="history-result"></span>
      </div>
      <div class="calc-main-result" id="main-result">0</div>
    </div>
    <div class="calc-buttons">
      <button class="calc-btn" onclick="clearCalc()">C</button>
      <button class="calc-btn" onclick="appendChar('(')">(</button>
      <button class="calc-btn" onclick="appendChar(')')">)</button>
      <button class="calc-btn" onclick="appendOp('mod')">mod</button>
      <button class="calc-btn" onclick="appendChar('π')">π</button>
      <button class="calc-btn" onclick="appendChar('7')">7</button>
      <button class="calc-btn" onclick="appendChar('8')">8</button>
      <button class="calc-btn" onclick="appendChar('9')">9</button>
      <button class="calc-btn" onclick="appendOp('/')">÷</button>
      <button class="calc-btn" onclick="appendOp('sqrt')">√</button>
      <button class="calc-btn" onclick="appendChar('4')">4</button>
      <button class="calc-btn" onclick="appendChar('5')">5</button>
      <button class="calc-btn" onclick="appendChar('6')">6</button>
      <button class="calc-btn" onclick="appendOp('*')">×</button>
      <button class="calc-btn" onclick="appendOp('^2')">x²</button>
      <button class="calc-btn" onclick="appendChar('1')">1</button>
      <button class="calc-btn" onclick="appendChar('2')">2</button>
      <button class="calc-btn" onclick="appendChar('3')">3</button>
      <button class="calc-btn" onclick="appendOp('-')">-</button>
      <button class="calc-btn orange" style="grid-row: span 2;" onclick="calculate()">=</button>
      <button class="calc-btn wide" onclick="appendChar('0')">0</button>
      <button class="calc-btn" onclick="appendChar('.')">.</button>
      <button class="calc-btn" onclick="appendOp('%')">%</button>
      <button class="calc-btn" onclick="appendOp('+')">+</button>
    </div>
  </div>
  <script>
    let current = '';
    let history = '';
    let lastResult = '';

    // Updates the calculator display with current values
    function updateDisplay() {
      // Update main result display, show '0' if current is empty
      document.getElementById('main-result').textContent = current || '0';
      // Update history display with previous calculation
      document.getElementById('history').textContent = history;
      // Update history result display, showing '= result' if there is a last result
      document.getElementById('history-result').textContent = lastResult ? `= ${lastResult}` : '';
    }

    function clearCalc() {
      current = '';
      history = '';
      lastResult = '';
      updateDisplay();
    }

    function appendChar(char) {
      if (char === 'π') {
        current += Math.PI.toFixed(8);
      } else {
        current += char;
      }
      updateDisplay();
    }

    function appendOp(op) {
      if (op === 'mod') {
        current += '%';
      } else if (op === 'sqrt') {
        current += '√(';
      } else if (op === '^2') {
        current += '^2';
      } else {
        current += op;
      }
      updateDisplay();
    }

    function calculate() {
      let expr = current.replace(/√\(([^)]+)\)/g, 'Math.sqrt($1)')
                       .replace(/π/g, Math.PI)
                       .replace(/(\d+)\^2/g, 'Math.pow($1,2)');
      try {
        // Replace mod with %
        expr = expr.replace(/mod/g, '%');
        // Evaluate
        let result = Function('return ' + expr)();
        if (typeof result === 'number' && !isNaN(result)) {
          lastResult = result;
          history = current;
          current = result.toString();
        } else {
          lastResult = 'Error';
        }
      } catch {
        lastResult = 'Error';
      }
      updateDisplay();
    }

    updateDisplay();
  </script>
</body>
</html>
