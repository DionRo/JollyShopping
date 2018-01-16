const elDropdownButton = document.getElementById('dropdown-button');
const elDropdown = document.getElementById('dropdown');
let isClicked = false;

elDropdownButton.addEventListener('click', () => {
    if(isClicked == false){
        elDropdown.style.display = 'block';
        isClicked = true;
    }
    else{
        elDropdown.style.display = 'none';
        isClicked = false;
    }
});
