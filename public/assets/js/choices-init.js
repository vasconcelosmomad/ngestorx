document.addEventListener("DOMContentLoaded", function () {
    // Inicializa todos os elementos com o atributo data-trigger
    var genericExamples = document.querySelectorAll("[data-trigger]");
    for (var i = 0; i < genericExamples.length; ++i) {
        var element = genericExamples[i];
        new Choices(element, {
            placeholderValue: "Selecione uma opção",
            searchPlaceholderValue: "Pesquisar...",
        });
    }

 
});