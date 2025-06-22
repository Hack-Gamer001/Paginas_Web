function encryptText() {
    const inputText = document.getElementById('inputText').value;
    const encryptedText = inputText
        .replace(/e/g, 'enter')
        .replace(/i/g, 'imes')
        .replace(/a/g, 'ai')
        .replace(/o/g, 'ober')
        .replace(/u/g, 'ufat');
    document.getElementById('outputText').value = encryptedText;
}

function decryptText() {
    const inputText = document.getElementById('inputText').value;
    const decryptedText = inputText
        .replace(/enter/g, 'e')
        .replace(/imes/g, 'i')
        .replace(/ai/g, 'a')
        .replace(/ober/g, 'o')
        .replace(/ufat/g, 'u');
    document.getElementById('outputText').value = decryptedText;
}

function copyText() {
    const outputText = document.getElementById('outputText');
    outputText.select();
    outputText.setSelectionRange(0, 99999); // Para dispositivos móviles
    document.execCommand('copy');
    alert('Texto encriptado copiado');
}

function clearText() {
    document.getElementById('inputText').value = '';
    document.getElementById('outputText').value = '';
}
