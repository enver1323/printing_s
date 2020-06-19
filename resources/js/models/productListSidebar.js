let jobItems = document.getElementsByClassName("job");
let jobItemButtons = document.getElementsByClassName("job-detail-button");
let sidebar = document.getElementById('sidebar');

let showJobDetails = function (event) {
    let id = event.target.getAttribute('data-id');
    sidebar.style.display = 'block';

    setImage(id);
    setDescription(id);
    setReadMoreLink(id);
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

function setReadMoreLink(id) {
    let readMore = document.getElementById('product-link');
    let link = document.getElementById(`product-${id}-image`);
    if(link) {
        readMore.href = link.parentNode.href;
        readMore.style.display = 'block';
    }
}

for (let i = 0; i < jobItems.length; i++) {
    jobItems[i].addEventListener('mouseover', showJobDetails, false);
}
