<style>
    .calculator {
        /* Remover estilos de posicionamento fixo */
        border-radius: 10px;
        box-shadow: none;
        padding: 20px;
        width: 100%;
        max-width: 100%;
        /* Remover display: none e position: fixed */
    }

    /* Remover media queries de posicionamento */

    #display-container {
        position: relative;
        width: 100%;
        margin-bottom: 15px;
    }

    #display {
        width: 100%;
        height: 50px;
        text-align: right;
        font-size: 32px;
        padding: 10px;
        margin-bottom: 15px;
        border: 1px solid #ccc;
        border-radius: 5px;
        background-color: #f9f9f9;
    }

    #history-list {
        position: absolute;
        top: 0;
        left: 10px;
        /* Coloca o histórico no canto superior esquerdo */
        font-size: 16px;
        color: #888;
        pointer-events: none;
    }

    .buttons {
        display: grid;
        grid-template-columns: repeat(4, 1fr);
        gap: 15px;
    }

    .buttons button {
        font-size: 28px;
        padding: 10px;
        background-color: #f1f1f1;
        border: 1px solid #ccc;
        border-radius: 5px;
        cursor: pointer;
        transition: background-color 0.3s;
    }

    .buttons button:hover {
        background-color: #e0e0e0;
    }

    .buttons button:active {
        background-color: #ddd;
    }

    .buttons button.operator {
        background-color: #ff9f00;
        color: white;
    }

    .buttons button.operator:hover {
        background-color: #ff7f00;
    }

    .buttons button.equal {
        background-color: rgb(82, 192, 174);
        color: white;
        grid-column: span 3;
    }

    .buttons button.clear {
        background-color: #dc3545;
        color: white;
        grid-column: span 2;
    }

    .buttons button.clear:hover {
        background-color: #c82333;
    }

    .close-button {
        font-size: 24px;
        background: none;
        border: none;
        color: #333;
        cursor: pointer;
    }

    .close-button:hover {
        color: rgb(199, 154, 154);
    }

    @media screen and (max-width: 768px) {
        .offcanvas-body-calculator {
            display: flex;
            justify-content: center;
            align-items: center;
            padding: 0;
        }

        .calculator {
            width: 95%;
            max-width: 350px;
            padding: 15px;
            margin: 0 auto;
        }

        .offcanvas.offcanvas-bottom-calculator {
            height: 80vh;
        }

        #display {
            height: 40px;
            font-size: 24px;
            padding: 8px;
            margin-bottom: 10px;
        }

        .buttons {
            gap: 8px;
        }

        .buttons button {
            font-size: 20px;
            padding: 12px;
            border-radius: 4px;
        }

        .buttons button.equal,
        .buttons button.clear {
            padding: 12px;
        }

        .buttons button.operator {
            padding: 12px;
        }

        .close-button {
            font-size: 20px;
            padding: 8px;
        }
    }
</style>

<!-- Substituir a div da calculadora por um offcanvas -->
<div class="offcanvas offcanvas-bottom offcanvas-bottom-calculator rounded-top" tabindex="-1" id="calculatorOffcanvas" aria-labelledby="calculatorOffcanvasLabel">
    <div class="offcanvas-header">
        <h5 class="card-title" id="calculatorOffcanvasLabel">Calculadora</h5>
        <span data-bs-dismiss="offcanvas" aria-label="Close"><i class="bi bi-chevron-bar-down fs-2  w-25"></i></span>
    </div>
    <div class="offcanvas-body offcanvas-body-calculator">
        <div class="calculator bg-white" id="calculator">
            <div id="display-container">
                <input type="text" id="display">
                <span hidden id="history-list"></span>
            </div>
            <div class="buttons">
                <button class="bg-danger text-white" onclick="clearDisplay()">C</button>
                <button class="bg-secondary text-white" onclick="backspace()"><i class="fa-solid fa-arrow-left-long"></i></button>
                <button class="operator" onclick="appendToDisplay('/')">÷</button>
                <button class="operator" onclick="appendToDisplay('*')">x</button>
                <button class="operator" onclick="appendToDisplay('-')">-</button>

                <button onclick="appendToDisplay('7')">7</button>
                <button onclick="appendToDisplay('8')">8</button>
                <button onclick="appendToDisplay('9')">9</button>
                <button class="operator" onclick="appendToDisplay('+')">+</button>

                <button onclick="appendToDisplay('4')">4</button>
                <button onclick="appendToDisplay('5')">5</button>
                <button onclick="appendToDisplay('6')">6</button>

                <button onclick="appendToDisplay('1')">1</button>
                <button onclick="appendToDisplay('2')">2</button>
                <button onclick="appendToDisplay('3')">3</button>

                <button onclick="appendToDisplay('0')">0</button>
                <button onclick="appendToDisplay('.')">.</button>
                <button class="equal bg-primary text-white" onclick="calculateResult()">=</button>
            </div>
        </div>
    </div>
</div>

<script>
    //Script Calculadora 
    let history = []; // Armazena os resultados anteriores
    function appendToDisplay(value) {
        const display = document.getElementById('display');
        display.value += value;
    }

    function clearDisplay() {
        const display = document.getElementById('display');
        display.value = '';
    }
    //Calcula o resultado da expressão
    function calculateResult() {
        const display = document.getElementById('display');
        let expression = display.value;

        if (!expression) {
            return;
        }

        try {
            const result = Function('"use strict";return (' + expression.replace(/÷/g, '/').replace(/x/g, '*') + ')')();
            display.value = `${result}`;
            history.push(`${expression} = ${result}`);
            updateHistoryList();
        } catch (error) {
            display.value = 'Erro';
        }
    }

    document.addEventListener('keypress', function(event) {
        if (event.key === 'Enter') {
            calculateResult();
        }
    });

    function updateHistoryList() {
        const historyList = document.getElementById('history-list');
        historyList.innerHTML = ''; // Clear the list before adding new items
        history.forEach((item) => {
            const listItem = document.createElement('span');
            listItem.textContent = item;
            historyList.appendChild(listItem);
        });
    }

    function toggleCalculator() {
        const calculatorOffcanvas = new bootstrap.Offcanvas(document.getElementById('calculatorOffcanvas'));
        calculatorOffcanvas.show();
    }

    function backspace() {
        const display = document.getElementById('display');
        if (display) {
            display.value = display.value.slice(0, -1);
        } else {
            console.error('Elemento com ID "display" não encontrado.');
        }
    }
</script>