let jobItems = document.getElementsByClassName("job");
let jobItemButtons = document.getElementsByClassName("job-detail-button");
let sidebar = document.getElementById('sidebar');


let showJobDetails = function (event) {
    let id = event.target.getAttribute('data-id');
    sidebar.style.display = 'block';

    setImage(id);
    setDescription(id);
    showSidebar();
};

function showSidebar() {
    document.getElementById('sidebar').style.display = 'block !important';
}

function setDescription(id) {
    let desc = document.getElementById(`product-${id}-description`);
    if (desc)
        document.getElementById('product-description').innerHTML = desc.innerHTML;
}

function setImage(id) {
    let image = document.getElementById(`product-${id}-image`);
    if (image)
        document.getElementById('product-image').src = image.src;
}

for (let i = 0; i < jobItems.length; i++) {
    jobItems[i].addEventListener('mouseover', showJobDetails, false);
    jobItemButtons[i].addEventListener('click', showJobDetails, false);
}
