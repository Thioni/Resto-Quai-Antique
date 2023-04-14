const pathInput = document.querySelector("#photo_path");
const imgElement = document.querySelector("#photo_preview");

pathInput.addEventListener("change", (event) => {
    imgElement.src = event.target.value;
})