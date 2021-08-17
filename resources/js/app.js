require('./bootstrap');

const btnCopy = document.getElementById("copyBtn");

const selectedFile = document.getElementById("selectFile");

if (selectedFile) {
    selectedFile.onchange = function() {
        document.getElementById("formUpload").submit();
    }
}

if (btnCopy) {
    btnCopy.onclick = function() {
        //Select text kemudian lakukan copy
        btnCopy.innerHTML = "Copied";
        btnCopy.classList.remove("btn-outline-secondary");
        btnCopy.classList.add("btn-outline-success");

        const filePath = document.getElementById("copyUrl");
        filePath.select();
        document.execCommand("copy");
    }
}

